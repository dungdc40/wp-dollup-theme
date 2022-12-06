<?php
/**
 * Customer payment retry email
 *
 * @author  Prospress
 * @package WooCommerce_Subscriptions/Templates/Emails
 * @version 2.6.0
 */
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

do_action( 'woocommerce_email_header', $email_heading, $email );

$isPauseOrder = false;
if(class_exists(' \TfApiPlugin\Service\Order')) {
    $orderService = new \TfApiPlugin\Service\Order();
    $isPauseOrder = $orderService->isPauseOrder($order);
}
?>

<?php /* translators: %s: Customer first name */ ?>
<p><?php printf( esc_html__( 'Hi %s,', 'woocommerce-subscriptions' ), esc_html( $order->get_billing_first_name() ) ); ?></p>
<?php /* translators: %s: lowercase human time diff in the form returned by wcs_get_human_time_diff(), e.g. 'in 12 hours' */ ?>
<p><?php printf( esc_html_x( 'The automatic payment to renew your subscription has failed. We will retry the payment %s.', 'In customer renewal invoice email', 'woocommerce-subscriptions' ), esc_html( wcs_get_human_time_diff( $retry->get_time() ) ) ); ?></p>

<?php if(!$isPauseOrder): ?>
<p>
    If your selected payment method fail after 5 retries, your subscription will be cancelled and you will lose access to all trading tools on TradeFundrr and associated partners. To ensure that does not happen, please go to your Funding Dashboard, and initiate the payment manually to avoid any service interruption.
</p>
<?php endif; ?>

<?php
do_action( 'woocommerce_subscriptions_email_order_details', $order, $sent_to_admin, $plain_text, $email );

/**
 * Show user-defined additional content - this is set in each email's settings.
 */
if ( $additional_content ) {
	echo wp_kses_post( wpautop( wptexturize( $additional_content ) ) );
}

do_action( 'woocommerce_email_footer', $email );
