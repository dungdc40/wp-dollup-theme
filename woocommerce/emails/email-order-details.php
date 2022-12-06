<?php
/**
 * Order details table shown in emails.
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/emails/email-order-details.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates\Emails
 * @version 3.7.0
 */

defined( 'ABSPATH' ) || exit;

$text_align = is_rtl() ? 'right' : 'left';
global $isAccountReset;
$isAccountReset = tf_is_order_account_reset($order);
global $orderDetailData;
$orderService = new TfApiPlugin\Service\Order();
$orderDetailData = $orderService->getDetail($order);
do_action( 'woocommerce_email_before_order_table', $order, $sent_to_admin, $plain_text, $email ); ?>

<p class="dim">Order summary</p>
<div style="margin-bottom: 40px;">
	<table class="td" cellspacing="0" cellpadding="6" id="order-details"
       style="width: 100%; font-family: 'Helvetica Neue', Helvetica, Roboto, Arial, sans-serif;" border="1"
    >
		<tbody>
            <?php
                if(!$isAccountReset):
            ?>
                <tr>
                    <td class="td">
                        <p class="dim">Asset Class</p>
                        <b><?= ucfirst($orderDetailData['asset_class']); ?></b>
                    </td>
                </tr>
                <tr>
                    <td class="td">
                        <p class="dim">Trader Funding Path</p>
                        <b><?= $orderDetailData['label']; ?></b>
                    </td>
                </tr>
                <tr>
                    <td class="td" colspan="2">
                        <p class="dim">Selected Qualification</p>
                        <b><?= ucfirst($orderDetailData['plan']);?></b>
                    </td>
                    <td class="td">
                        <b>$<?= $orderDetailData['price'];?>/month</b>
                    </td>
                </tr>
            <?php
                endif;
            ?>
			<?php
			echo wc_get_email_order_items( // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
				$order,
				array(
					'show_sku'      => $sent_to_admin,
					'show_image'    => false,
					'image_size'    => array( 32, 32 ),
					'plain_text'    => $plain_text,
					'sent_to_admin' => $sent_to_admin,
				)
			);
			?>
		</tbody>
		<tfoot>
			<?php
			$total = $order->get_total();
            ?>
            <tr class="total">
                <td class="td total" colspan="3">
                    <table>
                        <tr>
                            <td>Total</td>
                            <td>$<?= round($total); ?><?php if(!$isAccountReset) echo '/month'; ?></td>
                        </tr>
                    </table>
                </td>
            </tr>

            <?php
			if ( $order->get_customer_note() ) {
				?>
				<tr>
					<th class="td" scope="row" colspan="2" style="text-align:<?php echo esc_attr( $text_align ); ?>;"><?php esc_html_e( 'Note:', 'woocommerce' ); ?></th>
					<td class="td" style="text-align:<?php echo esc_attr( $text_align ); ?>;"><?php echo wp_kses_post( nl2br( wptexturize( $order->get_customer_note() ) ) ); ?></td>
				</tr>
				<?php
			}
			?>
		</tfoot>
	</table>
</div>
