<?php
/**
 * Checkout Form
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/checkout/form-checkout.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 3.5.0
 */
if (!defined('ABSPATH')) {
    exit;
}

do_action('woocommerce_before_checkout_form', $checkout);

// If checkout registration is disabled and not logged in, the user cannot checkout.
if (!$checkout->is_registration_enabled() && $checkout->is_registration_required() && !is_user_logged_in()) {
    echo esc_html(apply_filters('woocommerce_checkout_must_be_logged_in_message', __('You must be logged in to checkout.', 'woocommerce')));
    return;
}
?>
<style>.shop_table.woocommerce-checkout-review-order-table, .wc_payment_methods.payment_methods.methods, .woocommerce-terms-and-conditions-wrapper {
    display: none !important;
}.checkout.woocommerce-checkout {
    width: 68% !important;
    float: left;
}.rgt.right_sidebar.widget-area.sidebar.sticky-sidebar {
    width: 30%;
    float: right;
}</style>
<form name="checkout" method="post" class="checkout woocommerce-checkout" action="<?php echo esc_url(wc_get_checkout_url()); ?>" enctype="multipart/form-data">

    <?php if ($checkout->get_checkout_fields()) : ?>

        <?php do_action('woocommerce_checkout_before_customer_details'); ?>

        <div class="col2-set" id="customer_details">
            <div class="col-1">
                <?php do_action('woocommerce_checkout_billing'); ?>
            </div>

            <div class="col-2">
                <?php do_action('woocommerce_checkout_shipping'); ?>
            </div>
        </div>

        <?php do_action('woocommerce_checkout_after_customer_details'); ?>

    <?php endif; ?>

    <?php do_action('woocommerce_checkout_before_order_review_heading'); ?>

    <!--<h3 id="order_review_heading"><?php // esc_html_e('Your order', 'woocommerce'); ?></h3>-->

    <?php do_action('woocommerce_checkout_before_order_review'); ?>

    <div id="order_review" class="woocommerce-checkout-review-order">
        <?php do_action('woocommerce_checkout_order_review'); ?>
    </div>

    <?php do_action('woocommerce_checkout_after_order_review'); ?>

</form>

<?php do_action('woocommerce_after_checkout_form', $checkout); ?>
<?php // do_action('woocommerce_after_checkout_form', right_side()); ?>
<script>jQuery(function () {
jQuery('.main-section .col-lg-8.col-md-8.col-sm-12.col-xs-12').removeClass('col-lg-8').addClass('col-lg-12').removeClass('col-md-8').addClass('col-md-12'); 
	});
</script>
<style>html.js.flexbox.canvas.canvastext.webgl.no-touch.geolocation.postmessage.no-websqldatabase.indexeddb.hashchange.history.draganddrop.websockets.rgba.hsla.multiplebgs.backgroundsize.borderimage.borderradius.boxshadow.textshadow.opacity.cssanimations.csscolumns.cssgradients.no-cssreflections.csstransforms.csstransforms3d.csstransitions.fontface.generatedcontent.video.audio.localstorage.sessionstorage.webworkers.applicationcache.svg.inlinesvg.smil.svgclippaths body.page-template-default.page.page-id-9.theme-foodbakery.woocommerce-checkout.woocommerce-page.woocommerce-js.wp-foodbakery.wcfm-theme-foodbakery div.wrapper.wrapper-full_width div.main-section div.page-content-fullwidth.foodbakery-checkout-page div.col-xs-12 div.container{margin-top:40px;}h1 {    color: #FFF !important;}</style>