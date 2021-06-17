<?php
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
<style>html {
        scroll-behavior: smooth;
    }.modal-body * {
        font-size: 18px;
        font-weight: 400;
        line-height: 33px;
    }.modal-body .row {
        padding: 10px 0;
        border-bottom: 1px solid #DEDEDE;
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
                        <ul>

                            <?php
//                        $current_restaurant= $_GET[''];
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
//                            print_r($product);
                                $img = $product->get_image('full');
                                ?>
                                <li>
                                    <div class="image-holder"> <a href="https://foodyyums.com/wp-content/uploads/2016/12/cover-photo24-1-1024x187.jpg" rel="prettyPhoto"><img src="https://foodyyums.com/wp-content/uploads/2016/12/cover-photo24-1-150x150.jpg" alt=""></a></div>
                                    <div class="text-holder">
                                        <h6><?php echo the_title(); ?></h6>
                                        <span><?php
                                            $cuisines = get_post_meta(get_the_ID(), 'nutritional_information', true);

                                            echo trim(implode(', ', $cuisines));
                                            ?></span>

                                        <ul class="nutri-icons">
                                            <li><a data-toggle="tooltip" title="" data-original-title="Contains Bnana">
                                                    <img src="<?= get_the_post_thumbnail_url(get_the_ID()); ?>" alt=""></a>
                                            </li>
                                        </ul>
                                    </div>
                                    <div class="price-holder">
                                        <span class="price"><?php
                                            $price_arr = get_post_meta(get_the_ID(), '_price', false);
                                            $price = $price_arr['0'];
                                            ?>

                                            <?php
                                            $has_extra_class = "";
                                            $has_extra = get_post_meta(get_the_ID(), 'menu_item_extra', true);
                                            if ($has_extra == 0) {
                                                echo '';
                                                $has_extra_class = "";
                                            } else {/* print_r( $has_extra); */
                                                $has_extra_class = "has_extra_items";
                                            }
                                            ?> 
                                            <?php echo wc_price($price); ?></span>
                                        <!--<a href="?add-to-cart=<?php echo get_the_ID(); ?>"--> 
                                        <a href="javascript.void(0)" 
                                           class="restaurant-add-menu-btn add_menu_item_to_cart add_to_cart_button ajax_add_to_cart <?php echo $has_extra_class; ?>" 
                                           data-product_id="<?php echo get_the_ID(); ?>" data-id="<?php echo get_the_ID(); ?>" 
                                           data-cate_id="<?php echo $category->term_id; ?>"
                                           data-p="<?php echo $price ?>" 
                                           data-title="<?php echo the_title(); ?>"
                                           data-n="<?php echo the_title(); ?>"
                                           aria-label="Add “<?php echo the_title(); ?>” to your cart" rel="nofollow"
                                           <?php if ($has_extra != 0): ?>data-toggle="modal" data-target="#menu_item_extra_on_cart"<?php endif; ?>>
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
    <input type="hidden" id="order_vat_cal_price" name="order_vat_cal_price" value="">
</form>
<!-- The Modal -->
<div class="modal" id="menu_item_extra_on_cart">
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
            jQuery('.add_this_extra').attr('data-price', jQuery(this).data('p'));
        });
        jQuery('.has_extra_items').on('click', function () {
            let adminAjaxUrl = '<?php echo admin_url('admin-ajax.php'); ?>';
            let the_id = jQuery('.add_menu_item_to_cart').data('id');
            let formData = {the_id: the_id};
//            console.log(the_id);
//            debugger;
//jQuery('#menu_item_extra_on_cart').show();
            jQuery.ajax({
                //debugger;
                url: adminAjaxUrl + '?action=add_menu_item_extra_to_cart',
                type: "Post",
                dataType: "json",
                data: formData,
//                ascync: false
            }).done(function (response) {
//                jQuery('#menu_item_extra_on_cart').show();
                jQuery('#menu_item_extra_on_cart .modal-body').html(response.modal_content);
                console.log(response.modal_content);
            });
        });

        jQuery('.order_fee').on('click', function () {
            let the_fee = jQuery(this).data('fee');
//            console.log(the_fee);
            jQuery('#order_fee_amount').val(the_fee);
            jQuery('#fee').html(the_fee);
        });

        jQuery('.add_to_cart_button').on('click', function () {
            let $this = jQuery(this);
            let prod_id = $this.data('id');
            jQuery('#order_product_id').val(prod_id);
            jQuery('#order_title').val($this.data('n'));
            jQuery('#order_price').val($this.data('p'));
            jQuery('#no-menu-orders').hide();
            jQuery('#menu-orders-list').show();
            jQuery('.price-area').show();

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
                console.log(response);

//                let subTotal = 0;
//                jQuery('.menu-added').each(function () {
//                    let singlePrice = jQuery(this).data('val');
//                    subTotal += singlePrice;
//                });

                jQuery('.categories-order').append(response.item_to_cart);
                jQuery('#sub_total').text(response.sub_total);
                jQuery('#sub_total_amount').text(response.sub_total);
                jQuery('#order_vat_cal_price').text(response.order_vat_cal_price);
                jQuery('.vtax').text(response.order_vat_cal_price);
                jQuery('.menu-grtotal').text(response.total);

//                if (response == 1) {
//                    jQuery($this).closest('.form_field_error').show();
//                    jQuery($this).closest('.field-holder').find('.form_field_error')
//                            .html('This email has already registered!.').removeClass('hidden').show();
//                    jQuery($this).addClass('is-invalid');
//                    jQuery($this).removeClass('is-valid');
//                    jQuery($this).focus();
//                    NotValid = true;
//                }
            });

        });


    });
</script>
<?php do_action('wcfmmp_store_after_products', $store_user->get_id()); ?>