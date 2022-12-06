<?php
/**
 * Email Order Items
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/emails/email-order-items.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates\Emails
 * @version 3.7.0
 */

defined( 'ABSPATH' ) || exit;

$text_align  = is_rtl() ? 'right' : 'left';
$margin_side = is_rtl() ? 'left' : 'right';
global $orderDetailData;
global $isAccountReset;


foreach ($orderDetailData['options'] as $category => $items) {
    ?>
        <tr>
            <td class="td category">
                <b>Your Customized <?= ucfirst($category); ?></b>
            </td>
        </tr>
    <?php
    foreach ($items as $item) {
        ?>
        <tr class="line-item">
            <td class="td"  colspan="2" style="vertical-align: middle; font-family: 'Helvetica Neue', Helvetica, Roboto, Arial, sans-serif; word-wrap:break-word;">
                <?= $item['description']; ?>
            </td>
            <td class="td" style="vertical-align:middle; font-family: 'Helvetica Neue', Helvetica, Roboto, Arial, sans-serif;">
                $<?= $item['price']; ?><?php if(!$isAccountReset) echo '/month'; ?>
            </td>
        </tr>

        <?php
    }
}
