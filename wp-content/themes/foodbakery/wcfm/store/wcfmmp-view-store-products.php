<?php
@session_start();
/**
 * The Template for displaying all store products.
 *
 * @package WCfM Markeplace Views Store/products
 *
 * For edit coping this to yourtheme/wcfm/store 
 *
 */
if (!defined('ABSPATH'))
    exit; // Exit if accessed directly

global $WCFM, $WCFMmp, $avia_config;

$counter = 0;

wc_set_loop_prop('is_filtered', true);

// Enfold Theme Compatibility
if ($avia_config && is_array($avia_config)) {
    $avia_config['overview'] = true;
}
?>

<?php do_action('wcfmmp_store_before_products', $store_user->get_id()); ?>
<!--<pre><?php // print_r($_SESSION);                                      ?></pre>-->
<style>html {
        scroll-behavior: smooth;
    }.modal-body * {
        font-size: 18px;
        font-weight: 400;
        line-height: 33px;
    }.modal-body .row {
        padding: 10px 0;
        border-bottom: 1px solid #DEDEDE;
    }a.added_to_cart.wc-forward {
        display: none !important;
    }</style>
<form id="menu_order_form">
    <div class="" id="products">
        <div id="home" class="tab-pane fade in active">
            <div class="menu-itam-holder" style="height: auto;">
                <!--            <div class="field-holder sticky-search" style="position: relative; width: 592.5px; top: auto;">
                                <input id="menu-srch-1555" data-id="1555" class="input-field dev-menu-search-field" type="text" placeholder="Search food item">
                            </div>-->
                <div id="menu-item-list-1555" class="menu-itam-list">
                    <?php $product_categories = get_terms('product_cat', 'orderby=name&hide_empty=0&parent=0'); ?>
                    <?php // echo '<pre>';print_r($product_categories); echo '</pre>'?>
                    <?php foreach ($product_categories as $category): //print_r($category)?>
                        <div class="element-title <?php echo $category->name; ?> <?php echo $category->term_id; ?>" id="menu-category-<?php echo $category->term_id; ?>">
                            <h5 class="text-color" id="<?php echo $category->name; ?>"><?php echo $category->name; ?></h5>
                            <span><!---Go for BBQ sauce or Piri Piri sauce on your pizza base for no extra cost.----></span>
                        </div>
                        <ul><?php
//                        $current_restaurant= $_GET[''];
                            global $has_extra_class;
                            $segments = explode('/', trim(parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH), '/'));
                            $restaurant_name = $segments[1];
                            $author_id = get_user_id_by_user_nicename($restaurant_name);

                            $args = array('post_type' => 'product', 'posts_per_page' => -1, 'product_cat' => $category->name,
//                            'author' => current_user_can('administrator') ? $restorant_auth_id : get_current_user_id()
                                'author' => $author_id
                            );
                            $loop = new WP_Query($args);
                            ?>
                            <?php
                            while ($loop->have_posts()) : $loop->the_post();
                                global $product;
//                echo '<pre>'; //print_r($loop);
                                $nutrition_info_array = get_post_meta(get_the_ID(), 'nutritional_information', true);
                                $product = wc_get_product($loop->post->ID);
                                $img = wp_get_attachment_image_src($product->image_id)[0];
//                                pre($img, false);
                                ?>
                                <li>
                                    <div class="image-holder">
                                        <a rel="prettyPhoto">
                                            <img src="<?php echo $img; ?>" alt="">
                                        </a>
                                    </div>
                                    <div class="text-holder">
                                        <h6><?php echo the_title(); ?></h6>
                                        <span><?php
                                            $cuisines = get_post_meta(get_the_ID(), 'nutritional_information', true);

                                            echo trim(implode(', ', $cuisines));
                                            ?></span>

                                        <ul class="nutri-icons">
                                            <li><a data-toggle="tooltip" title="">
                                                    <img src="<?= get_the_post_thumbnail_url(get_the_ID()); ?>" alt=""></a>
                                            </li>
                                        </ul>
                                    </div>
                                    <div class="price-holder">
                                        <span class="price"><?php
                                            $price_arr = get_post_meta(get_the_ID(), '_price', false);
                                            $price = $price_arr['0'];

                                            $has_extra = get_post_meta(get_the_ID(), 'menu_item_extra', true);
//                                            print_r($has_extra);
                                            if ($has_extra == 0 || empty($has_extra) || $has_extra == "") {
                                                $has_extra_class = "";
                                            } else {/* print_r( $has_extra); */
                                                $has_extra_class = "has_extra_items";
                                            }
                                            ?> 
                                            <?php echo wc_price($price); ?></span>
                                                                                                                                        <!--<a href="?add-to-cart=<?php echo get_the_ID(); ?>"--> 

                                        <a href="javascript:void(0)" 
                                           class="add_to_cart_button restaurant-add-menu-btn add_menu_item_to_cart <?php echo $has_extra_class; ?>" 
                                           data-product_id="<?php echo get_the_ID(); ?>" data-id="<?php echo get_the_ID(); ?>" 
                                           data-cate_id="<?php echo $category->term_id; ?>"
                                           data-p="<?php echo $price ?>" 
                                           data-title="<?php echo the_title(); ?>"
                                           data-n="<?php echo the_title(); ?>">
                                            <i class="icon-plus4 text-color"></i>
                                        </a>
                                    </div>
                                </li>
                                <?php
                            endwhile;
                            wp_reset_query();
                            ?>      
                        </ul>
                    <?php endforeach; ?>

                </div>

            </div>
        </div>

    </div><!-- .product_area -->

    <input type="hidden" id="order_product_id" name="order_product_id" value=""/>
    <input type="hidden" id="order_title" name="order_title" value=""/>
    <input type="hidden" id="order_price" name="order_price" value=""/>
    <input type="hidden" id="sub_total_amount" name="sub_total_amount" value=""/>
    <input type="hidden" id="total_amount" name="total_amount" value=""/>

    <input type="hidden" id="order_fee_amount" name="order_fee_amount" value="<?php echo pickup_fee(); ?>"/>
    <input type="hidden" id="order_vat_percent" name="order_vat_percent" value="<?php echo order_vat_percent(); ?>">
    <input type="hidden" id="order_vat_cal_price" name="order_vat_cal_price" value=""/>
</form>
<!-- The Modal -->
<div class="modal" id="modal_menu_item_extra">
    <div class="modal-dialog">

        <div class="modal-content">
            <div class="modal-header"><h3>Extras</h3></div>
            <!-- Modal body -->
            <div class="modal-body">                   

            </div>
        </div>

    </div>
</div>
<script>
    jQuery(function () {

        jQuery('.add_this_extra').on('click', function () {
            jQuery(this).attr('data-price', jQuery(this).data('p'));
        });
        jQuery('.has_extra_items').on('click', function () {
//            debugger;
            jQuery('#modal_menu_item_extra').modal('show');
            jQuery('#modal_menu_item_extra .modal-body').html('<?php loading(); ?>');
            let adminAjaxUrl = '<?php echo admin_url('admin-ajax.php'); ?>';
            let the_id = jQuery(this).data('id');
            let formData = {the_id: the_id};
//            console.log(the_id);
//            debugger;
//jQuery('#modal_menu_item_extra').show();
            jQuery.ajax({
                //debugger;
                url: adminAjaxUrl + '?action=add_menu_item_extra_to_cart',
                type: "Post",
                dataType: "json",
                data: formData,
//                ascync: false
            }).done(function (response) {
//                jQuery('#modal_menu_item_extra').show();
                jQuery('#modal_menu_item_extra .modal-body').html(response.modal_content);
//                console.log(response.modal_content);
            });
        });

        jQuery('.order_fee').on('click', function () {
            let the_fee = jQuery(this).data('fee');
//            console.log(the_fee);
            jQuery('#order_fee_amount').val(the_fee);
            jQuery('#fee').html(the_fee);
            let adminAjaxUrl = '<?php echo admin_url('admin-ajax.php'); ?>';

            jQuery.ajax({
                //debugger;
                url: adminAjaxUrl + '?action=ez_update_cart_based_on_fee',
                type: "Post",
                dataType: "json",
                data: {the_fee: the_fee},
//                ascync: false
            }).done(function (response) {
                jQuery('.price-area>ul>li:first-child').html(response.subtotal_price);
                jQuery('.total-price').html(response.total_price);
            });

        });

        jQuery('.add_to_cart_button').on('click', function () {
            let $this = jQuery(this);
            let prod_id = $this.data('id');
//            jQuery('a.added_to_cart.wc-forward').hide();
//            debugger;
            jQuery('#order_product_id').val(prod_id);
            jQuery('#order_title').val($this.data('n'));
            jQuery('#order_price').val($this.data('p'));
            jQuery('#no-menu-orders').hide();
            jQuery('#menu-orders-list').show();
            jQuery('.price-area').show();
//            debugger;
            let adminAjaxUrl = '<?php echo admin_url('admin-ajax.php'); ?>';
            let formData = $this.closest('form#menu_order_form').serializeArray();

            jQuery.ajax({
                //debugger;
                url: adminAjaxUrl + '?action=add_menu_item_to_cart',
                type: "Post",
                dataType: "json",
                data: formData,
                ascync: false
            }).done(function (response) {
//                console.log(response);
//                if(jQuery('#modal_menu_item_extra').hasClass('.has_extra_items')){jQuery('#modal_menu_item_extra').show();}
                jQuery('.categories-order').append(response.item_to_cart);
                jQuery('#sub_total').text(response.sub_total);

                jQuery('#sub_total_amount').val(response.sub_total);
                jQuery('#order_vat_cal_price').val(response.order_vat_cal_price);
                jQuery('.vtax').text(response.order_vat_cal_price);
                jQuery('.menu-grtotal').text(response.total);
//                    let items_inside_cart = jQuery('.categories-order');
//                    console.log(items_inside_cart);
//                    jQuery('.rgt').append(items_inside_cart);
                /********=/\|NOW ADDING MENU ITEMS TO STORAGE|\/=*********/

                //alert($(this).val());
                let menu_items_sidebar_html = jQuery(".categories-order").html();

                setTimeout(function () {
                    if (window.sessionStorage) {
                        sessionStorage.setItem("menu_items_sidebar", menu_items_sidebar_html);
                        console.log(menu_items_sidebar);
                    }
                }, 2800);
                //ENDS SESSION
            });

        });//ends add to cart 


    });//ENDS DOC READY

    function add_ext_crt(obj) {
//debugger;
        let the_ids = "";
        let the_data;
        let adminAjaxUrl = '<?php echo admin_url('admin-ajax.php'); ?>';
        jQuery('#modal_menu_item_extra').find("input[type='radio'],input[type='checkbox']").each(function () {
            let isChecked = jQuery(this).is(':checked');
            jQuery('#no-menu-orders').hide();
            if (isChecked == true) {
                let val = jQuery(this).data('val');
                let name = jQuery(this).data('name');
                let parent_id = jQuery(this).data('parent-id');
                let its_id = jQuery(this).data('id');
                the_ids += (its_id + ',');
                the_data = {'parent_id': parent_id, 'sub_ids': the_ids};
//                console.log(the_ids);
//                console.log(parent_id);

                let sub_item = '<li data-id="' + its_id + '" class="extra_item">Extras - ' + name + ' : <span class="category-price">£' + val + '</span></li>';
                let len = jQuery('.menu-added').length;
                let i;
                for (i = len; i > 0; i--) {
                    let li = jQuery('.menu-added:nth-child(' + i + ')');
                    if (li.data('id') == parent_id) {
                        li.append('<ul>' + sub_item + '</ul>');
//                        jQuery(li + '>ul.exrtas_here').append(sub_item);
//                        jQuery('li.menu-added').find('ul.exrtas_here').html(sub_item);
                        jQuery('#modal_menu_item_extra').modal('hide');
                        return;
                    }
                }
            }
        });

        jQuery.ajax({
            //debugger;
            url: adminAjaxUrl + '?action=add_items_to_woo_cart',
            type: "Post",
            dataType: "json",
            data: the_data,
            ascync: false
        }).done(function (response) {
//            console.log(response);
            jQuery('.price-area>ul>li:first-child').html(response.subtotal_price);
            jQuery('.total-price').html(response.total_price);

            let menu_items_sidebar_html = jQuery(".categories-order").html();

            setTimeout(function () {
                if (window.sessionStorage) {
                    sessionStorage.setItem("menu_items_sidebar", menu_items_sidebar_html);
//                    console.log(menu_items_sidebar);
                }
            }, 2800);

        });

    }//add_menu_extra_to_cart done
    function close_modal(obj) {
        jQuery(obj).on('click', function () {
            jQuery('#modal_menu_item_extra').modal('hide');
        });
    }

//    function check_n_calc(obj) {
//        let _this = jQuery(obj);
//        _this.closest('.modal-body').find("input[type='radio'],input[type='checkbox']").each(function () {
//            let isChecked = jQuery(this).is(':checked');
//        let number_checked = isChecked.length;
//        console.log(number_checked);
//        });
//    }

//    jQuery('.add_this_extra').on('click', function () {
//        console.log('checked');
//        let allowed = jQuery(this).closest('.row').find('.allowed');
//        let isChecked = jQuery(this).prop('checked');
//        let number_checked = isChecked.length;
//        console.log(number_checked);
//    });

</script>
<?php do_action('wcfmmp_store_after_products', $store_user->get_id()); ?>