<?php
add_shortcode("ez_restorant_search_list", "ez_restorant_search_list");

function ez_restorant_search_list() {
    ob_start();
    @$search_restorant = $_GET['search_restorant'];
    ?><style>li{list-style: none;}.listing.simple.slide-loader::before {display: none;}</style>
    <?php //ez_scripts();?>
    <div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 ">
            <div class="row">
                <div class="foodbakery-restaurant-content" id="foodbakery-restaurant-content">
                    <div class="detail-map-restaurant">
                        <div id="Restaurant-content">
                            <form id="ez_search_restaurants">

                                <input type="hidden" name="search_title" value="<?php echo isset($_GET['search_title']) ? $_GET['search_title'] : "" ?>">
                                <input type="hidden" name="location" value="<?php echo isset($_GET['location']) ? $_GET['location'] : "" ?>">
                                <input type="hidden" name="radius" value="<?php echo isset($_GET['search_radius']) ? $_GET['search_radius'] : "" ?>">
                                <input type="hidden" name="foodyyums_cuisine_arr" value="<?php echo isset($_REQUEST['foodyyums_cuisine']) ? $_REQUEST['foodyyums_cuisine'] : "" ?>">

                                                                                        <!--<input type="hidden" value="best_match" id="sort_by" name="sort_by"/>-->
                                                                                        <!--<input type="hidden" value="all" name="restaurant_timings"/>-->

                                                                                        <!--<input type="hidden" value="no" name="restaurant_pre_order"/>-->
                                                                                        <!--<input type="hidden" id="hidden_input-specials" class="specials foodyyums_restaurant_search_by" name="specials"/>-->

                                <div class="cs-rich-editor">
                                    <?php include_once 'listings_left-sidebar.php'; ?>    
                                    <div class="col-lg-7 col-md-7 col-sm-12 col-xs-12" id="the_listings"></div>
                                    <!-- Column Start -->
                                    <?php include_once 'listings_right-sidebar.php'; ?>  
                                    <!-- Column End -->
                                </div>
                            </form>
                        </div>
                    </div> 
                </div>   
            </div>
        </div>
    </div>
    <script>
        /* ********************************************************
         * =========|| GETTING ALL RESTAURANTS LISTING ||========** 
         * ********************************************************/
        //        let the_data = jQuery('#ez_search_restaurants').serializeArray();
        function ez_get_restaurents(obj) {
            //                        debugger;
            let the_data = jQuery('#ez_search_restaurants').serializeArray();
            let adminAjaxUrl = '<?php echo admin_url('admin-ajax.php'); ?>';
            let $this = jQuery(obj);
            jQuery('#the_listings').html('<?php loading(); ?>');
            console.log(the_data);
            jQuery.ajax({
                url: adminAjaxUrl + '?action=ez_list_restaurants',
                type: "Post",
                dataType: "json",
                //                async: false,
                data: the_data
            }).done(function (response) {
                //                debugger;
                //                $this.prop("checked", true);
                //                debugger;
                console.log(response.request);
                console.log(response.rq);
                //                console.log(response.SHtml);
                jQuery('#the_listings').html(response.SHtml);
                jQuery('.select-categories ul.fy-filter-list').html(response.the_cuisines);
                //                console.log(response.q);
            }); //ajax done

        }//ends funct
        /* ********************************************************|
         * =========|| GETTING FILTERING STATUS COUNT ||========***| 
         * ********************************************************|*/
        function restaurant_status() {
            let opened = jQuery(".listing li.item[data-status*='open").length;
            let closed = jQuery(".listing li.item[data-status*='close").length;
            jQuery('.restaurant_timings_total_open>span').html('(' + opened + ')');
            jQuery('.restaurant_timings_total_close>span').html('(' + closed + ')');
        }



        /* * * *
         * DOC READY FUNCTION
         * * * */
        jQuery(function () {
            ez_get_restaurents();
            setTimeout(function () {
                restaurant_status();
            }, 3000);
            //            jQuery.when(ez_get_restaurents()).done(function () {
            //                restaurant_status();
            //            });
            /* *****************************************
             * =========|| FILTERING STATUS ||========** 
             * *************************************** */
            jQuery('.restaurant_timings_total').on('click', function () {
                let its_id = jQuery(this).closest('.checkbox').find('.timings').attr('id');//debugger;
                jQuery('.item').hide();//debugger;
                jQuery(".item[data-status*='" + its_id).show();
                let is_checked = jQuery(this).closest('.checkbox').find('.timings').is(':checked');
                if (is_checked == true) {
                    jQuery(".item[data-status*='" + its_id).show();
                }
            });

            /* *******************************************
             * =========|| FILTERING CATEGORY ||========** 
             * *******************************************/
            //            jQuery('.foodyyums_restaurant_category').on('click', function () {
            //                let its_value = jQuery(this).val();//debugger;
            //                let its_cuisines = jQuery(this).data('cuisines');//debugger;
            //                console.log('checked the value: ' + its_value);
            //                let cuisines = jQuery(".item").data('cuisines');
            //                console.log(cuisines);
            //                jQuery('.item').hide();//debugger;
            //                jQuery(".item[data-cuisines*='" + its_value).show();
            //                //                console.log('and its cuisines: ' + its_cuisines);
            //            });

            /* *******************************************
             * =========|| ALPHABETICAL ORDER ||========** 
             * *******************************************/
            jQuery('a.sort-by-alphabetical').on('click', function () {
                jQuery(this).closest('li').addClass('active');
                jQuery(this).closest('li').siblings('li').removeClass('active');
                let $items = jQuery('.listing');
                let alphabeticallyOrdered = $items.sort(function (a, b) {//debugger;
                    return jQuery(a).find(".item").data("name") > jQuery(b).find(".item").data("name");
                });

                alphabeticallyOrdered.each(function (i, item) {
                    jQuery("#the_listings").append(item);
                });
            });
            /* *******************************************
             * ============|| BEST MATCH ||=============** 
             * *******************************************/
            jQuery('.sort-by-best_match').on('click', function () {
                let search_title = jQuery("input[name=search_title]").val();
                jQuery(this).closest('li').addClass('active');
                jQuery(this).closest('li').siblings('li').removeClass('active');
                let $items = jQuery('.listing');
                if (search_title != "") {//debugger;
                    let bestMatch = $items.sort(function (a, b) {
                        return jQuery(a).find(".item").data("name") == search_title >
                                jQuery(b).find(".item").data("name") != search_title;
                    });
                    bestMatch.each(function (i, item) {
                        jQuery("#the_listings").append(item);
                    });
                }

            });
            //            ON ANY FORM FIELD
            /*jQuery('.foodyyums_restaurant_search_by').on('click', function () {
             //                debugger;
             let adminAjaxUrl = '<?php // echo admin_url('admin-ajax.php');              ?>';
             let $this = jQuery(this);
                 
             //                let the_type = jQuery(this).get(0).tagName;
             //                //console.log(the_type);
             //                if (the_type == 'A') {// if clicked on Anchor tag
             //                    jQuery('#sort_by').val(jQuery(this).data('key'));
             //                    //                            console.log(jQuery(this).data('key'));
             //                }
             //                debugger;
             let the_data = jQuery(this).closest('form').serializeArray();
             console.log(the_data);
             //                ez_get_restaurents(the_data);
             //                let the_data = jQuery('#ez_search_restaurants').serializeArray();
                 
             jQuery('#the_listings').html('<?php //loading();              ?>');
                 
             //                debugger;
             jQuery.ajax({
             //                debugger;
             url: adminAjaxUrl + '?action=ez_list_restaurants',
             type: "Post",
             dataType: "json",
             async: false,
             data: the_data
             }).done(function (response) {
             //                debugger;
             //                console.log(response);
             //                console.log(response.SHtml);
             jQuery('#the_listings').html(response.SHtml);
             jQuery('.select-categories ul.fy-filter-list').html(response.the_cuisines);
             console.log(response.q);
             $this.prop("checked", true);
             }); //ajax done
             });*/


        });
    </script>
    <?php
    return $html = ob_get_clean();
}

add_action("wp_ajax_ez_list_restaurants", "ez_list_restaurants");
add_action("wp_ajax_nopriv_ez_list_restaurants", "ez_list_restaurants");

function ez_list_restaurants() {
//    $test = 'THIS IS THE RESPONSE!';
//    print_r($_REQUEST);
//    exit();
    ob_start(); //restaurant_cuisines

    $search_restaurant = $_REQUEST['search_title'];
    $restaurant_cuisines = $_REQUEST['foodyyums_cuisine'];
//    echo "$search_restaurant";
//    print_r($restaurant_cuisines);
    $restaurant_cuisines_impl = implode(", ", $restaurant_cuisines);
    echo $restaurant_cuisines_impl;
    /////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

    if (isset($search_restaurant) && $search_restaurant != "") {
        if ($restaurant_cuisines == "" || empty($restaurant_cuisines)) {
            $Args = array(
                'meta_query' => array(
                    array(
                        'key' => 'business_name',
                        'value' => " $restaurant_cuisines_impl ",
                        'compare' => 'LIKE'
                    ),
                )
            );
        } else {
            $Args = array(
                'meta_query' => array(
                    'relation' => 'AND',
                    array(
                        'key' => 'business_name',
                        'value' => $search_restaurant,
                        'compare' => 'LIKE'
                    ),
                    array(
                        'key' => 'restaurant_cuisines',
                        'value' => $restaurant_cuisines_impl,
                        'compare' => 'LIKE',
                        
                    ),
                )
            );
        }
    } else {
        if ($restaurant_cuisines != "" || !empty($restaurant_cuisines)) {
            $Args = array(
                'meta_query' => array(
                    'relation' => 'AND',
                    array(
                        'key' => 'business_name'
                    ),
                    array(
                        'key' => 'restaurant_cuisines',
                        'value' => $restaurant_cuisines,
                        'compare' => 'LIKE',
                        'type'=>'array'
                    ),
                )
            );
        } else {
            $Args = array(
                'meta_query' => array(
                    array(
                        'key' => 'business_name'
                    )
                )
            );
        }
    }
    $restorant_query = new WP_User_Query($Args);
//               echo '<pre>';
//               print_r($restorant_query);
//               echo '</pre>';
    $restorants = $restorant_query->get_results();
//                print_r($restorants);
//                               echo '</pre>';
    ?>
    <div class="listing-sorting-holder">
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">

                <?php if (empty($restorants)): ?> <h4> 0 Restaurant found  </h4><?php endif; ?>
                <?php if ($search_restorant != ""): ?>    
                    <ul class="search-results"><li>"<?php echo $search_restorant; ?>", </li><li> </li></ul>
                    <a class="clear-tags" href="<?php echo site_url(); ?>/foodyyum-listings/">Reset</a>
                <?php endif; ?>    
            </div>
        </div>
    </div>


    <?php
    $restaurant_ids_arr = '';
    if (!empty($restorants)) {
        foreach ($restorants as $restorant) {
            $wcfmmp_profile_settings = get_user_meta($restorant->ID, 'wcfmmp_profile_settings', true);
            $restaurant_delivery_or_pickup = get_user_meta($restorant->ID, 'restaurant_delivery_or_pickup', true);
//            $restaurant_cuisines = get_user_meta($restorant->ID, 'restaurant_cuisines', true);

            $restaurant_ids_arr .= $restorant->ID . ',';
//                print_r($restaurant_ids_arr);

            $today = date("w") - 1;
            @$todays_timings = $wcfmmp_profile_settings['wcfm_delivery_time']['day_times'][$today][0];

            $now = date("h:i:s");
            if ($now > @$todays_timings['start'] && $now < @$todays_timings['end']) {
                $restorant_status = "open";
            } else {
                $restorant_status = "close";
            }
            @$deliv_time = $wcfmmp_profile_settings['wcfm_delivery_time']['start_from'];

            switch ($deliv_time) {
                case 0:
                    $deliver_in = "10 minutes";
                    break;
                case 1:
                    $deliver_in = "15 minutes";
                    break;
                case 2:
                    $deliver_in = "30 minutes";
                    break;
                case 3:
                    $deliver_in = "60 minutes";
                    break;
                case 4:
                    $deliver_in = "2 hours";
                    break;
                case 5:
                    $deliver_in = "3 hours";
                    break;
                case 6:
                    $deliver_in = "6 hours";
                    break;
                default:
                    $deliver_in = "10 minutes";
            }
            @$gravatar = wp_get_attachment_url($wcfmmp_profile_settings['gravatar']);
            $cuisines = get_user_meta($restorant->ID, 'restaurant_cuisines', true);
            $cuisines_string = implode(', ', $cuisines);
            ?>

            <div class="listing simple">

                <ul>
                    <li data-status='<?php echo $restorant_status; ?>' data-cuisines='<?php echo $cuisines_string; ?>' class="item status-<?php echo $restorant_status; ?>" data-name='<?php echo get_user_meta($restorant->ID, 'business_name', true); ?>' data-delivery-time='<?php echo $deliver_in; ?>'>
                        <div class="img-holder">
                            <figure>
                                <a href="<?= site_url() ?>/store/<?= $restorant->user_nicename ?>">
                                    <img src="<?php echo $gravatar; ?>" class="img-list wp-post-image" alt="" loading="lazy"/> 
                                </a>
                            </figure>
                            <span class="restaurant-status <?php echo $restorant_status; ?>">
                                <em class="bookmarkRibbon"></em>
                                <?php echo $restorant_status == "open" ? ucfirst($restorant_status) : ucfirst($restorant_status) . 'd'; ?></span>
                        </div>
                        <div class="text-holder">
                            <div class="post-title">
                                <h5>
                                    <a href="<?= site_url() ?>/store/<?php echo $restorant->user_nicename; ?>"><?php echo get_user_meta($restorant->ID, 'business_name', true); ?></a>
                                    <!--<span class="sponsored text-color">Sponsored</span>-->
                                </h5>
                            </div>
                            <span class="post-categories"><span>Type of food : </span> 
                                <?php
                                foreach ($cuisines as $cuisine):
                                    ?>
                                    <span data-id="<?php echo $cuisine; ?>"><?php echo $cuisine; ?>, </span>
                                    <?php
                                endforeach;
                                ?>
                            </span>
                            <!--<div class="clearfix">&nbsp;</div>-->
                            <div class="delivery-potions">
                                <?php if ($restaurant_delivery_or_pickup == 'delivery' || $restaurant_delivery_or_pickup == 'delivery_and_pickup'): ?>
                                    <div class="post-time">
                                        <i class="icon-motorcycle"></i>
                                        <div class="time-tooltip">
                                            <div class="time-tooltip-holder"> <b class="tooltip-label">Delivery time</b> <b class="tooltip-info">Your order will be delivered in <?php echo $deliver_in; ?></b> </div>
                                        </div>
                                    </div>
                                <?php endif; ?>
                                <?php if ($restaurant_delivery_or_pickup == 'pickup' || $restaurant_delivery_or_pickup == 'delivery_and_pickup'): ?>
                                    <div class="post-time">
                                        <i class="icon-clock4"></i>
                                        <div class="time-tooltip">
                                            <div class="time-tooltip-holder"> <b class="tooltip-label">Pickup time</b> <b class="tooltip-info">You can pickup order in  <?php echo $deliver_in; ?></b> </div>
                                        </div>
                                    </div>
                                <?php endif; ?>
                            </div>
                        </div>
                        <div class="list-option">
                <!--<button class="shortlist-btn"><i class="icon-heart-o"></i></button>-->
                            <a href="<?= site_url() ?>/store/<?= $restorant->user_nicename ?>" class="viewmenu-btn text-color">View Menu</a>
                        </div>
                    </li>
                </ul>
                <!--Foodyyums element Ends-->                       
            </div>
            <?php
        }
    } else {
        ?>
        <style>.fy-filter-list{display:none !important;}</style>
        <div class="listing simple slide-loader">
            <!--Element Section Start-->
            <!-- Foodyyums Element Starts-->
            <div class="no-restaurant-match-error"><h6><i class="icon-warning"></i><strong> Sorry!</strong>&nbsp; There are no restaurants matching your search. </h6></div><!--Foodbakery Element End-->                  
        </div>
        <?php
    }
    $html = ob_get_clean();
//GETTING CATE/CUISINE LISTS
    ob_start();
    $categories = get_terms('product_cat', 'orderby=name&hide_empty=0&parent=0');

    $restaurant_ids_arr = rtrim($restaurant_ids_arr, ',');
    $the_cuisines = '';
    foreach ($categories as $category):
//                    print_r($restaurant_ids_arr);
        global $wpdb;
//                                $the_query = "SELECT * FROM wp_usermeta WHERE meta_key='restaurant_cuisines' AND meta_value LIKE '%$category->name%'";
//  $the_query = "SELECT COUNT(*) AS total FROM wp_usermeta WHERE meta_key='restaurant_cuisines' AND meta_value LIKE '%".$category->name."%' AND user_id IN ($restaurant_ids_arr) ORDER BY '".$category->name."' ASC;
//echo $search_restaurant;
        if ($restorants != "" || !empty($restaurants)) {
            $and = " AND user_id IN ($restaurant_ids_arr) ";
        } else {
            $and = "";
        }
//$and = " AND user_id IN (106) ";
        $the_query = "SELECT COUNT(*) AS total FROM wp_usermeta WHERE meta_key='restaurant_cuisines' AND meta_value LIKE '%" . $category->name . "%' $and ORDER BY '" . $category->name . "' ASC";
        $query = $wpdb->get_results($the_query);
//echo '<pre>';print_r($query);echo '</pre>';
        $checked = (in_array($category->name, $_REQUEST['foodyyums_cuisine'])) ? "checked" : "";
        ?>
        <li>
            <div class="checkbox">
                <input <?php echo $checked; ?> onclick="ez_get_restaurents(this);" type="checkbox" name="foodyyums_cuisine[]" id="foodyyums_<?php echo $category->name ?>" class="foodyyums_<?php echo $category->name ?> foodyyums_restaurant_category foodyyums_restaurant_search_by" value="<?php echo $category->name ?>"/>
                <label for="foodyyums_<?php echo $category->name ?>"><?php echo $category->name ?></label>                         
                <span>(<?php echo $query[0]->total ?>)</span>
            </div>
        </li>
        <?php
    endforeach;
    $the_cuisines = ob_get_clean();
    echo json_encode(
            array(
                'Status' => true,
                'MSG' => 'ok',
                'q' => $query,
                'SHtml' => $html,
                'the_cuisines' => $the_cuisines,
                'rq' => $restorant_query,
                'requeust' => $_REQUEST
            )
    );
    exit();
}
