
<div id="menu_items_sidebar" class="col-md-3 rgt right_sidebar widget-area sidebar sticky-sidebar" style="position: relative; overflow: visible; box-sizing: border-box; min-height: 1px;">
    <?php ?>
    <div class="theiaStickySidebar" style="padding-top: 0px; padding-bottom: 1px; position: static; transform: none; top: 0px; left: 1098.27px;"><div class="user-order-holder">
            <div class="user-order">
                <h6><i class="icon-shopping-basket"></i>Your Order</h6>
                <span class="error-message pre-order-msg" style="display: none;">This restaurant allows Pre orders.</span>
                <span class="discount-info" style="display: none;">If you have a discount code,<br> you will be able to input it<br> at the payments stage.</span>
                <div class="select-option dev-select-fee-option">

                    <ul>
                        <?php
                        $segments = explode('/', trim(parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH), '/'));
                        $restaurant_name = $segments[1];
                        $author_id = get_user_id_by_user_nicename($restaurant_name);
                        $restaurant_delivery_or_pickup = get_user_meta($author_id, 'restaurant_delivery_or_pickup', true);
                        global $woocommerce;
//                        session_destroy();
                        ?>
                        <?php if ($restaurant_delivery_or_pickup == 'pickup' || $restaurant_delivery_or_pickup == 'delivery_and_pickup'): ?>

                            <?php $the_order_fee = get_option('_order_fee'); ?>
                            <li>
                                <input id="order-pick-up-fee" <?php echo $the_order_fee == pickup_fee() ? 'checked="checked"' : ''; ?> type="radio" value="pickup" name="order_fee_type" data-fee="<?php
                                echo pickup_fee();
                                ?>" value="<?php
                                       echo pickup_fee();
                                       ?>" data-label="Pick-Up" data-type="pickup" class="order_fee"/>
                                <label for="order-pick-up-fee">Pick-Up</label>
                                <span>£<?php echo pickup_fee();
                                       ?></span>

                            </li>
                        <?php endif; ?>
                        <?php if ($restaurant_delivery_or_pickup == 'delivery' || $restaurant_delivery_or_pickup == 'delivery_and_pickup'): ?>
                            <li>
                                <input id="order-delivery-fee" type="radio" <?php echo $the_order_fee == delivery_fee() ? 'checked="checked"' : ''; ?>  name="order_fee_type" value="delivery" data-fee="<?php echo delivery_fee(); ?>" value="<?php echo delivery_fee(); ?>" data-label="Delivery" data-type="delivery" class="order_fee">
                                <label for="order-delivery-fee">Delivery</label>
                                <span>£<?php echo delivery_fee(); ?></span>
                            </li>
                        <?php endif; ?>
                    </ul>
                </div>

                <!--MENU ORDERS LIST-->
                <div class="dev-menu-orders-list" style="">
                    <!--THE LIST-->
                    <ul class="categories-order"></ul>
                    <!--/THE LIST-->
                    <div class="price-area dev-menu-price-con" <?php if (WC()->cart->get_cart_contents_count() == 0): ?>style="display:none;"<?php endif; ?>>
                        <ul>
                            <?php // print_r($_SESSION)    ?>
                            <li>Subtotal
                                <span class="price">£<em class="menu-subtotal" id="sub_total">
                                        <?php
                                        if (WC()->cart->get_cart_contents_count() > 0) {
                                            echo WC()->cart->subtotal_ex_tax;
                                        } else {
                                            echo "";
                                        }
                                        ?>
                                    </em>
                                </span>
                            </li>

                            <li class="restaurant-fee-con"><span class="fee-title">Order fee</span>
                                <span class="price">£<em class="menu-charges" id="fee" data-fee="<?php
                                    echo get_option('_order_fee');
                                    ?>"><?php echo get_option('_order_fee'); ?></em>                                                                                    </span>
                            </li>

                            <li>VAT (13%) 
                                <span class="price">£<em class="vtax"><?php echo get_option('_order_vat'); ?></em></span>
                            </li>
                        </ul>
                        <p class="total-price">Total 
                            <span class="price">
                                £<em class="menu-grtotal" data-grant_total="">
                                    <?php
                                    if (WC()->cart->get_cart_contents_count() > 0) {
                                        echo WC()->cart->total;
                                    } else {
                                        echo "";
                                    }
                                    ?>
                                </em>
                            </span>
                        </p>
                    </div>
                </div>
                <!--/MENU ORDERS LIST-->
                <?php if ($woocommerce->cart->cart_contents_count == 0) { ?>
                    <div id="no-menu-orders" style="">
                        <span class="success-message">There are no items in your basket.</span>                                                       
                    </div>
                <?php } ?>
                <div class="pay-option dev-order-pay-options">
                </div>
                <div class="btn_container">
                    <?php if (is_user_logged_in()) { ?>
                        <a href="<?php echo site_url() ?>/checkout" class="menu-order-confirm" id="menu-order-confirm">Confirm Order</a>
                    <?php } else { ?>
                        <a href="javascript:void(0)" class="menu-order-confirm" id="menu-order-confirm" onclick="loginFirst(this);">Confirm Order</a>
                        <!--<a class="cs-color cs-popup-joinus-btn login-popup" data-target="#sign-in" data-toggle="modal" href="#user-register">Confirm Order</a>-->
                    <?php }
                    ?>                
                    <div class="text-center lead mt-3 text-danger" id="btn-resp"></div>
                </div>     
            </div>
        </div></div>
    <?php ?>
</div>

<script>
    function remove_item_from_cart(obj) {
        let $this = obj;
        let child_ids = "";
        let child_items = jQuery(obj).closest('li.menu-added').find('.extra_item');
        child_items.each(function () {
            child_ids += jQuery(this).data('id') + ',';
        });


        let the_item = $this.parentNode;
        let the_id = the_item.getAttribute('data-id');
        let adminAjaxUrl = '<?php echo admin_url('admin-ajax.php'); ?>';
        console.log(child_ids);
//        console.log('clicked ' + the_id);
        jQuery.ajax({
            //debugger;
            url: adminAjaxUrl + '?action=ez_remove_menu_item_from_cart',
            type: "Post",
            dataType: "json",
            data: {the_id: the_id, child_ids: child_ids},
            ascync: false
        }).done(function (response) {
            the_item.remove();
            jQuery('.price-area>ul>li:first-child').html(response.subtotal_price);
            jQuery('.total-price').html(response.total_price);
            let child_ids = "";
            //            console.log(child_ids);
        });

    }

    function loginFirst(obj) {
        jQuery('#btn-resp').html('<p>Please <a href="<?php echo site_url();?>/my-account/">login </a> to confirm your order</p>');
    }
</script>