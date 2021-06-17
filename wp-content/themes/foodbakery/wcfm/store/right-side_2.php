<div class="col-md-3 rgt right_sidebar widget-area sidebar sticky-sidebar" style="position: relative; overflow: visible; box-sizing: border-box; min-height: 1px;">

    <?php ?>
    <div class="theiaStickySidebar" style="padding-top: 0px; padding-bottom: 1px; position: static; transform: none; top: 0px; left: 1098.27px;"><div class="user-order-holder">
            <div class="user-order">
                <h6>
                    <i class="icon-shopping-basket"></i>Your Order                                                        </h6>
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
                        session_destroy();
                        ?>
                        <?php if ($restaurant_delivery_or_pickup == 'pickup' || $restaurant_delivery_or_pickup == 'delivery_and_pickup'): ?>
                            <li>
                                <input id="order-pick-up-fee" checked="checked" type="radio" value="pickup" name="order_fee_type" data-fee="<?php
                                echo pickup_fee();
                                ;
                                ?>" value="<?php
                                       echo pickup_fee();
                                       ;
                                       ?>" data-label="Pick-Up" data-type="pickup" class="order_fee"/>
                                <label for="order-pick-up-fee">Pick-Up</label>
                                <span>£<?php echo pickup_fee();
                                       ?></span>

                            </li>
                        <?php endif; ?>
                        <?php if ($restaurant_delivery_or_pickup == 'delivery' || $restaurant_delivery_or_pickup == 'delivery_and_pickup'): ?>
                            <li>
                                <input id="order-delivery-fee" type="radio" name="order_fee_type" value="delivery" data-fee="<?php echo delivery_fee(); ?>" value="<?php echo delivery_fee(); ?>" data-label="Delivery" data-type="delivery" class="order_fee">
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
                    <div class="price-area dev-menu-price-con" style="display:none;">
                        <ul>
                            <?php // print_r($_SESSION)  ?>
                            <li>Subtotal
                                <span class="price">£<em class="menu-subtotal" id="sub_total"><?php // echo $;   ?></em>
                                </span>
                            </li>

                            <li class="restaurant-fee-con"><span class="fee-title">Order fee</span>
                                <span class="price">£<em class="menu-charges" id="fee" data-fee="<?php
                                    echo pickup_fee();
                                    ;
                                    ?>"><?php echo pickup_fee(); ?></em>                                                                                    </span>
                            </li>

                            <li>VAT (13%)
                                <span class="price">£<em class="vtax">00</em></span>
                            </li>
                        </ul>
                        <p class="total-price">Total <span class="price">
                                £<em class="menu-grtotal" data-grant_total=""></em>

                            </span>
                        </p>
                    </div>
                </div>
                <!--/MENU ORDERS LIST-->

                <div id="no-menu-orders" style="">
                    <span class="success-message">There are no items in your basket.</span>                                                        </div>
                <div class="pay-option dev-order-pay-options">
                    <ul>

                        <li>
                            <input id="order-cash-payment" value="cash" type="radio" name="order_payment_method" data-type="cash">
                            <label for="order-cash-payment">
                                <i class="icon-coins"></i>
                                Cash
                            </label>
                        </li>
                        <li>
                            <input id="order-card-payment" value="card" type="radio" checked="checked" name="order_payment_method" data-type="card">
                            <label for="order-card-payment">
                                <i class="icon-credit-card4"></i>
                                Card
                            </label>
                        </li>
                    </ul>
                </div>
                <div class="row">


                    <!--<div class="col-sm-12">
                    <div class="form-group">
                    <div class="input-group date">
                    <input type="text" name="delivery_date" id="datetimepicker1" class="form-control" value="16-04-2021 22:08" placeholder="Select Date and Time">
                    <span class="input-group-addon">
                    <span class="icon-event_available"></span>
                    </span>
                    </div>
                    </div>
                    </div>-->

                </div>
                <a href="javascript:void(0)" class="menu-order-confirm" id="menu-order-confirm" data-rid="1698">Confirm Order</a>
                <span class="menu-loader"></span>
            </div>
        </div></div>
    <?php ?>
    <?php //echo do_shortcode("[woocommerce_cart]");  ?>
</div>