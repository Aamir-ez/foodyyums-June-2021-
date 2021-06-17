<aside class="col-lg-2 col-md-2 col-sm-12 col-xs-12">

    </script>
    <div class="filter-toggle"><span class="filter-toggle-text">Filters By</span><i class="icon-chevron-down"></i></div>
    <div class="filter-wrapper">

        <div class="foodbakery-filters listing-filter"> 
            <div id="foodbakery-filters-40058">
                <!--<input type="hidden" name="search_title" value="xyz restorant">-->
                <!--<input type="hidden" name="location" value="">-->
                <!--<input type="hidden" name="foodbakery_radius" value="364">-->
                <!--<input type="hidden" id="hidden_input-foodbakery_restaurant_category" class="foodbakery_restaurant_category" onchange="foodbakery_restaurant_content('40058');" name="foodbakery_restaurant_category" value="">                    <div class="filter-holder panel-default">-->
                <div class="filter-heading">
                    <h6><i class=" icon-food"></i>Cuisines</h6>
                </div>
                <div class="select-categories">

                    <ul class="filter-list cs-checkbox-list">
                        <?php
                        $categories = get_terms('product_cat', 'orderby=name&hide_empty=0&parent=0');

                        foreach ($categories as $category):
                            ?>
                            <li>
                                <div class="checkbox">
                                    <input data-t="hussain" type="checkbox" id="foodyyums_<?php echo $category->name; ?>" class="foodyyums_restaurant_category" value="<?php echo $category->name; ?>">
                                    <label for="foodyyums_<?php echo $category->name; ?>"><?php echo $category->name; ?></label>
                                    <?php
                                    global $wpdb;
                                    $the_query = "SELECT * FROM wp_usermeta WHERE meta_key = 'restaurant_cuisines' AND meta_value LIKE '%$category->name%' ";
                                    $query = $wpdb->get_results($the_query);
                                    ?>
                                    <span>(<?php echo count($query); ?>)</span>
                                </div>
                            </li>
                            <?php
                        endforeach;
                        ?>
                        <!--<li class="expand">See more cuisines</li>-->
                    </ul>

                </div>

            </div>

            <div class="filter-holder panel-default">
                <div class="filter-heading">
                    <h6><i class="icon-clock4"></i>Opening Status</h6>
                </div>

                <div class="select-categories restaurant_timings">
                    <ul class="filter-list cs-parent-checkbox-list">
                        <li>
                            <div class="checkbox">
                                <input type="checkbox" id="restaurant_timings_open" name="restaurant_timings_checkbox" class="restaurant_timings_open" value="open"> 
                                <label for="restaurant_timings_open" id="open">Open Now
                                    <span>(0)</span> 
                                </label>
                            </div>
                        </li>
                        <li>
                            <div class="checkbox">
                                <input type="checkbox" id="restaurant_timings_close" name="restaurant_timings_checkbox" class="restaurant_timings_close" value="close">   
                                <label for="restaurant_timings_close" id="close">Closed Now 
                                    <span>(0)</span> 
                                </label>
                            </div>
                        </li>
                    </ul>
                    <input type="hidden" value="all" name="restaurant_timings">
                    <script>
                        jQuery(function () {

                            let opened = jQuery("span[data-status*='open").length;
                            let closed = jQuery("span[data-status*='close").length;

                            jQuery('#open>span').html('(' + opened + ')');
                            jQuery('#closed>span').html('(' + closed + ')');

                        });
                    </script>
                </div>
            </div>
            <?php /* ?>
              <div class="filter-holder panel-default">
              <div class="filter-heading">
              <h6><i class="icon-external-link"></i>Pre Orders</h6>
              </div>

              <div class="select-categories restaurant_pre_order">
              <ul class="filter-list cs-parent-checkbox-list">
              <li>
              <div class="checkbox">
              <input type="checkbox" id="restaurant_pre_order_yes" name="restaurant_pre_order_checkbox" class="restaurant_pre_order_yes" value="yes">                                            <label for="restaurant_pre_order_yes">Yes                                                <span>(0)</span>
              </label>
              </div>
              </li>
              <li>
              <div class="checkbox">
              <input type="checkbox" id="restaurant_pre_order_no" name="restaurant_pre_order_checkbox" class="restaurant_pre_order_no" value="no">                                            <label for="restaurant_pre_order_no">No                                                <span>(0)</span>
              </label>
              </div>
              </li>
              </ul>

              <input type="hidden" value="no" name="restaurant_pre_order">
              <script>
              jQuery(function () {

              });
              </script>
              </div>
              </div>

              <div class="filter-holder panel-default">
              <div class="filter-heading">
              <h6><i class="icon-folder_special"></i>Specials</h6>
              </div>

              <div class="select-categories">
              <input type="hidden" id="hidden_input-specials" class="specials" onchange="foodbakery_restaurant_content('40058');" name="specials" value="">
              <script>
              jQuery(function () {

              });
              </script>
              <ul class="filter-list cs-checkbox-list">                                                                <li style="">
              <div class="checkbox">
              <input type="checkbox" id="specials_1" class="specials" value="deals" onchange="">
              <label for="specials_1">Deals</label>
              <span>(0)</span>                                                                    </div>
              </li>

              <li style="">
              <div class="checkbox">
              <input type="checkbox" id="specials_2" class="specials" value="free-delivery" onchange="">
              <label for="specials_2">Free Delivery</label>
              <span>(0)</span>                                                                    </div>
              </li>

              </ul>

              </div>


              </div>
              <?php */ ?>

        </div>

    </div><!-- end of filters-->

    <div class="restaurant-filters-ads">
    </div>
</div>
</aside>     