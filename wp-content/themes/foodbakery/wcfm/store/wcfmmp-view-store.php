<?php
/**
 * The Template for displaying store.
 *
 * @package WCfM Markeplace Views Store
 *
 * For edit coping this to yourtheme/wcfm/store 
 *
 */
if (!defined('ABSPATH'))
    exit; // Exit if accessed directly

global $WCFM, $WCFMmp;

$wcfm_store_url = wcfm_get_option('wcfm_store_url', 'store');
$wcfm_store_name = apply_filters('wcfmmp_store_query_var', get_query_var($wcfm_store_url));
if (empty($wcfm_store_name))
    return;
$seller_info = get_user_by('slug', $wcfm_store_name);
if (!$seller_info)
    return;

$store_user = wcfmmp_get_store($seller_info->ID);
$store_info = $store_user->get_shop_info();

$store_sidebar_pos = isset($WCFMmp->wcfmmp_marketplace_options['store_sidebar_pos']) ? $WCFMmp->wcfmmp_marketplace_options['store_sidebar_pos'] : 'left';

$wcfm_store_wrapper_class = apply_filters('wcfm_store_wrapper_class', '');

$wcfm_store_color_settings = get_option('wcfm_store_color_settings', array());
$mob_wcfmmp_header_background_color = ( isset($wcfm_store_color_settings['header_background']) ) ? $wcfm_store_color_settings['header_background'] : '#3e3e3e';

get_header('shop');
ez_scripts();
?>

<?php if ($WCFMmp->wcfmmp_vendor->is_store_sidebar() && ($store_sidebar_pos != 'left' )) { ?>
    <style>
        #wcfmmp-store .right_side{float:left !important;}
        #wcfmmp-store .left_sidebar{float:right !important;}
        form#foodyyum-listings {    background-color: transparent !important;    padding: 30px 20px 0 !important;}
    </style>
<?php } ?>
<style>
    #wcfmmp-store .banner_text h1:after, #wcfmmp-store .banner_text h1:before{display: none !important;}
    #wcfmmp-store .logo_area a img {
        position: absolute;
        top: 50%;
        left: 145%;
        border-radius: 0;}
    #wcfmmp-store .banner_text h1 {
        color: #fff !important;
        font: 400 32px/34px 'Montserrat', sans-serif !important;
        letter-spacing: 0;
        word-spacing: 0;
        text-transform: none;
        margin: 0 0 9px 0;
        display: block;
        float: left;
    }#wcfmmp-store .logo_area {
        background: transparent;
        box-shadow: none;
    }
    #wcfmmp-store .logo_area a img {
        position: absolute;
        top: -50%;
        left: 86%;
        border-radius: 5px;
        max-width: 89px;
        max-height: 89px;
    }
    #wcfmmp-store .banner_text {    position: absolute;    top: 50%;    left: 20%; text-align: center;}
    #wcfmmp-store #wcfm_store_header {
        background: transparent;
        min-height: 5px !important;
        max-height: 6px !important;
    }
    #wcfm_store_header .wcfmmp-store-rating::before{display:none;}
    @media screen and (max-width: 480px) {
        #wcfmmp-store .header_right {
            background: <?php echo $mob_wcfmmp_header_background_color; ?>;
        }
    }
    .rgt.right_sidebar.widget-area.sidebar.sticky-sidebar.col-lg-3.col-md-3.col-sm-12.col-xs-12 {
        top: -590px;
        border: 1px solid #CCC;
        padding-top: 70px;
        background: #FFF;
    }
</style>	
<link href="<?php echo get_template_directory_uri() ?>/wcfm/store/store.css" type="text/css" rel="stylesheet"/>
<?php //do_action( 'woocommerce_before_main_content' ); ?>
<?php echo '<div id="primary" class="content-area"><main id="main" class="site-main" role="main">'; ?>
<?php do_action('wcfmmp_before_store', $store_user->data, $store_info); ?>
<?php

function pickup_fee() {
    return 10;
}

function delivery_fee() {
    return 20;
}

function order_vat_percent() {
    return 14;
}
?>
<div id="wcfmmp-store" class="wcfmmp-single-store-holder <?php echo $wcfm_store_wrapper_class; ?>">
    <div id="wcfmmp-store-content" class="wcfmmp-store-page-wrap woocommerce" role="main">

        <?php $WCFMmp->template->get_template('store/wcfmmp-view-store-banner.php', array('store_user' => $store_user, 'store_info' => $store_info)); ?>

<?php
if (apply_filters('wcfmmp_is_allow_legacy_header', false)) {
    $WCFMmp->template->get_template('store/legacy/wcfmmp-view-store-header.php', array('store_user' => $store_user, 'store_info' => $store_info));
} else {
    $WCFMmp->template->get_template('store/wcfmmp-view-store-header.php', array('store_user' => $store_user, 'store_info' => $store_info));
}
?>

                        <?php do_action('wcfmmp_after_store_header', $store_user->data, $store_info); ?>

        <div class="container" id="store_container">
            <div class="row">
                <!--<div class="spacer"></div>-->
                        <?php include_once 'wcfmmp-view-store-sidebar.php'; ?>


                <div class="col-md-6 <?php if (!$WCFMmp->wcfmmp_vendor->is_store_sidebar()) echo 'right_side_full'; ?>">
                    <div id="tabsWithStyle" class="tab_area">

                        <?php do_action('wcfmmp_before_store_tabs', $store_user->data, $store_info); ?>

                        <?php $WCFMmp->template->get_template('store/wcfmmp-view-store-tabs.php', array('store_user' => $store_user, 'store_info' => $store_info, 'store_tab' => $store_tab)); ?>

                        <?php do_action('wcfmmp_after_store_tabs', $store_user->data, $store_info); ?>

                        <?php
                        switch ($store_tab) {
                            case 'about':
                                $WCFMmp->template->get_template('store/wcfmmp-view-store-about.php', array('store_user' => $store_user, 'store_info' => $store_info));
                                break;

                            /* case 'policies':
                              $WCFMmp->template->get_template( 'store/wcfmmp-view-store-policies.php', array( 'store_user' => $store_user, 'store_info' => $store_info ) );
                              break; */

                            case 'reviews':
                                $WCFMmp->template->get_template('store/wcfmmp-view-store-reviews.php', array('store_user' => $store_user, 'store_info' => $store_info));
                                break;

                            case 'book':
                                $WCFMmp->template->get_template('store/wcfmmp-view-store-book.php', array('store_user' => $store_user, 'store_info' => $store_info));
                                break;

                            /* case 'followers':
                              $WCFMmp->template->get_template( 'store/wcfmmp-view-store-followers.php', array( 'store_user' => $store_user, 'store_info' => $store_info ) );
                              break;

                              case 'followings':
                              $WCFMmp->template->get_template( 'store/wcfmmp-view-store-followings.php', array( 'store_user' => $store_user, 'store_info' => $store_info ) );
                              break; */

                            case 'articles':
                                $WCFMmp->template->get_template('store/wcfmmp-view-store-articles.php', array('store_user' => $store_user, 'store_info' => $store_info));
                                break;

                            default:
                                $WCFMmp->template->get_template(apply_filters('wcfmmp_store_default_template', apply_filters('wcfmp_store_default_template', 'store/wcfmmp-view-store-products.php', $store_tab), $store_tab), array('store_user' => $store_user, 'store_info' => $store_info), '', apply_filters('wcfmp_store_default_template_path', '', $store_tab));
                                break;
                        }
                        ?>

                    </div><!-- .tab_area -->
                </div><!-- .right_side -->

<?php include_once 'right-side.php'; ?>

                <div class="spacer"></div>
            </div><!-- .body_area -->
        </div><!-- .body_area -->

        <div class="wcfm-clearfix"></div>
    </div><!-- .wcfmmp-store-page-wrap -->



    <div class="wcfm-clearfix"></div>
</div><!-- .wcfmmp-single-store-holder -->

<div class="wcfm-clearfix"></div>

<?php do_action('wcfmmp_after_store', $store_user->data, $store_info); ?>
<?php //do_action( 'woocommerce_after_main_content' );   ?>
<?php echo '</main></div>'; ?>
<script>
    jQuery(document).ready(function ($) {

        $('#tab_links_area').find('a').each(function () {
            $(this).off('click').on('click', function () {
                window.location.href = $(this).attr('href');
            });
        });
    });

</script>
<?php get_footer('shop'); ?>