<?php
use TfApiPlugin\Service\Products as ProductsService;
use TfApiPlugin\Constant\Products as ProductsConstant;

/*
 * Enable guest checkout, in fact we use woocommerce_checkout_customer_id filter to assign order to
 * existing user (or create user prior to that)
 */
add_filter( 'woocommerce_checkout_registration_required', 'tf_not_require_registration_during_checkout', 99, 1);
function tf_not_require_registration_during_checkout($account_required) {
    return false;
}

// check if an order is account reset order
function tf_is_order_account_reset($order) {
    $items = $order->get_items();
    if(!$items) return false;

    $firstItemSku = array_values($items)[0];
    $product = wc_get_product($firstItemSku->get_product_id());
    $sku = $product->get_sku();
    $last3 = substr($sku, -3);
    return $last3 === 'S01';
}

function tf_get_order_detail_data($order) {
    global $wpdb;
    $orderItems = $order->get_items();
    if(!$orderItems) return [];
    $result = [];

    $productIds = [];
    $price = []; // mapping product id => price
    foreach ($orderItems as $item) {
        $productId = $item->get_product_id();
        $productIds[] = $productId;
        $price[$productId] = round($order->get_item_total( $item ));
    }
    $productIdsString = implode(',', $productIds);

    $sql = "SELECT p.ID, p.post_content, p.post_title, p.post_excerpt, t.name term " .
        "FROM {$wpdb->posts} p " .
        "INNER JOIN {$wpdb->term_relationships} tr ON p.ID=tr.object_id " .
        "INNER JOIN {$wpdb->term_taxonomy} tt ON tr.term_taxonomy_id=tt.term_taxonomy_id " .
        "INNER JOIN {$wpdb->terms} t ON tt.term_id=t.term_id " .
        "WHERE p.ID IN ($productIdsString)";
    $items = $wpdb->get_results($sql);
    $productService = new ProductsService();

    $products = $productService->formatProductsDataFromList($items);
    foreach ($products as $id => $product) {
        $assetClass = $productService->getAssetClassFromTerms($product['terms']);
        if($assetClass) $result['asset-class'] = $assetClass;

        $customizableCategory = $productService->getProductCustomizableCategory($product['terms'], $assetClass);
        $product['price'] = $price[$product['id']];

        if($customizableCategory) {
            $result['options'][$customizableCategory][] = $product;

        } else {
            // is main plan
            $plan = $productService->getProductPlan($product['terms']);
            if($plan) {
                $result['plan'] = $plan;
            }

            $result['label'] = $productService->getPlanLabel($plan);
            $result['asset_class'] = $productService->getAssetClassFromTerms($product['terms']);
            $result['price'] = $product['price'];
        }
    }
    return $result;
}

function tf_get_order_card_info($order) {
    $customerId = $order->get_customer_id();
    global $wpdb;
    $sql1 = "SELECT token_id, token FROM {$wpdb->prefix}woocommerce_payment_tokens WHERE user_id=$customerId";
    $tokens = $wpdb->get_results($sql1);
    $tokenIds = array_column($tokens, 'token', 'token_id');

    $sql2 = "SELECT meta_value FROM {$wpdb->postmeta} o " .
        "WHERE o.post_id={$order->get_id()} AND o.meta_key='_stripe_source_id' ";
    $orderSourceId = $wpdb->get_var($sql2);
    $token = false;
    foreach ($tokenIds as $tokenId => $sourceId) {
        if($sourceId === $orderSourceId) {
            $token = $tokenId;
            break;
        }
    }

    if(!$token) return [];
    $sql13= "SELECT * FROM {$wpdb->prefix}woocommerce_payment_tokenmeta WHERE " .
            "payment_token_id=$token";
    $rows = $wpdb->get_results($sql13);
    return array_column($rows, 'meta_value', 'meta_key');
}

function tf_order_payment_url($url, $order) {
    return get_site_url() . '/dashboard/user-profile?section=billing';
}
add_filter('woocommerce_get_checkout_payment_url', 'tf_order_payment_url', 10, 2);