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
                                <input type="hidden" name="sort_by" id="sort_by"/>
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
        function ez_get_restaurents(obj, sub = null) {
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
                $this.prop("checked", true);
                jQuery('#the_listings').html(response.SHtml);
                jQuery('.select-categories ul.fy-filter-list').html(response.the_cuisines);
                //                console.log(response.q);
            }); //ajax done

        }//ends funct
        /* ********************************************************
         * =========|| GETTING subQuery LISTING ||===============** 
         * ********************************************************/
        //        let the_data = jQuery('#ez_search_restaurants').serializeArray();
        function ez_get_restaurents_subquery(obj) {
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
                //                $this.prop("checked", true);
                jQuery('#the_listings').html(response.SHtml);
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
            /*jQuery('.restaurant_timings_total').on('click', function () {
             let its_id = jQuery(this).closest('.checkbox').find('.timings').attr('id');//debugger;
             jQuery('.item').hide();//debugger;
             jQuery(".item[data-status*='" + its_id).show();
             let is_checked = jQuery(this).closest('.checkbox').find('.timings').is(':checked');
             if (is_checked == true) {
             jQuery(".item[data-status*='" + its_id).show();
             }
             });*/

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
            /*jQuery('a.sort-by-alphabetical').on('click', function () {
             jQuery(this).closest('li').addClass('active');
             jQuery(this).closest('li').siblings('li').removeClass('active');
             let $items = jQuery('.listing');
             let alphabeticallyOrdered = $items.sort(function (a, b) {//debugger;
             return jQuery(a).find(".item").data("name") > jQuery(b).find(".item").data("name");
             });
                 
             alphabeticallyOrdered.each(function (i, item) {
             jQuery("#the_listings").append(item);
             });
             });*/
            /* *******************************************
             * ============|| BEST MATCH ||=============** 
             * *******************************************/
            /*jQuery('.sort-by-best_match').on('click', function () {
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
                 
             });*/



        });
    </script>
    <?php
    return $html = ob_get_clean();
}

add_action("wp_ajax_ez_list_restaurants", "ez_list_restaurants");
add_action("wp_ajax_nopriv_ez_list_restaurants", "ez_list_restaurants");

function ez_list_restaurants() {

    global $wpdb;
    include_once 'restaurant_functions.php';

    ob_start(); //restaurant_cuisines

    $search_restaurant = $_REQUEST['search_title'];
    $restaurant_cuisines = $_REQUEST['foodyyums_cuisine'];
    $sort_by = $_REQUEST['sort_by'];
    $condition = " 1=1 ";

    if (isset($search_restaurant) && $search_restaurant != "") { //IF SEARCH IS NOT EMPTY: SOME RESTAURANTS ARE SEARCHED
        if ($restaurant_cuisines == "" || empty($restaurant_cuisines)) {// IF CUISINES ARE NOT SEARCHED
            echo "here may be!";
        } else {// DEFAULT BEHAVIOUR
            echo "or here!";
        }
    } else {// IF SEARCH IS EMPTY: DEFAULT LOAD ALL
        if ($restaurant_cuisines != "" || !empty($restaurant_cuisines)) {// IF CUISINES ARE SEARCHED
            foreach ($restaurant_cuisines as $param) {
                $condition .= " AND m3.meta_key = 'restaurant_cuisines' AND m3.meta_value LIKE '%" . $param . "%' ";
            }
        } else {// DEFAULT BEHAVIOUR
            echo "else check on cuisines";
        }
    }
    //IF SEARCH IS NOT EMPTY
    // IF SEARCH IS EMPTY: DEFAULT LOAD ALL
    // IF SEARCH IS NOT EMPTY AND 
    // IF SEARCH IS EMPTY AND RECORDS ARE ALSO EMPTY NOT LIKELY AT ALL

    if ($sort_by != "") {
        if ($sort_by == 'best_match') {
            $_order .= "";
        } elseif ($sort_by == 'alphabetical') {
            $_order .= "ORDER BY m1.business_name";
        } elseif ($sort_by == 'fastest_delivery') {
            $_order .= "";
        } else {
            
        }
    }

    $query = " 
       SELECT
    u1.*,
    m1.meta_value AS business_name,
    m2.meta_value AS wcfm_vendor_store_hours,
    m3.meta_value AS restaurant_cuisines,
    m4.meta_value AS restaurant_delivery_or_pickup,
    m5.meta_value AS wcfmmp_profile_settings

FROM {$wpdb->prefix}users u1
INNER JOIN {$wpdb->prefix}usermeta m1 ON (m1.user_id = u1.id AND m1.meta_key = 'business_name')
INNER JOIN {$wpdb->prefix}usermeta m2 ON (m2.user_id = u1.id AND m2.meta_key = 'wcfm_vendor_store_hours')
INNER JOIN {$wpdb->prefix}usermeta m3 ON (m3.user_id = u1.id AND m3.meta_key = 'restaurant_cuisines')
INNER JOIN {$wpdb->prefix}usermeta m4 ON (m4.user_id = u1.id AND m4.meta_key = 'restaurant_delivery_or_pickup')
LEFT JOIN {$wpdb->prefix}usermeta m5 ON (m5.user_id = u1.id AND m5.meta_key = 'wcfmmp_profile_settings')

WHERE $condition $_order 
AND u1.user_status=1

";

//select * 
//AND m1.meta_value LIKE 'abc'
//AND (m2.meta_value IS NULL OR m2.meta_value like 'xyz')

    $restaurants = $wpdb->get_results($query);
//    print_r($restaurants);
//    echo count($restaurants);
    ?>
    <div class="listing-sorting-holder">
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">

                <?php if (empty($restaurants)): ?> <h4> 0 Restaurant found  </h4><?php endif; ?>
                <?php if ($search_restaurant != ""): ?>    
                    <ul class="search-results"><li>"<?php echo $search_restaurant; ?>", </li><li><?php
                            if (!empty($restaurants)) {
                                echo count($restaurants);
                            }
                            ?></li></ul>
                    <a class="clear-tags" href="<?php echo site_url(); ?>/foodyyum-listings/">Reset</a>
                <?php endif; ?>    
            </div>
        </div>
    </div>


    <?php
    if (!empty($restaurants)) {
//       
        $cuisine_arr = array();
        $status_arr = array();
        $IDs_arr = "";
        foreach ($restaurants as $restaurant) {
            $IDs_arr .= $restaurant->ID . ', ';
//            $cuisine_arr .= unserialize(implode(', ', $restaurant->restaurant_cuisines));
            if (array_key_exists(ez_restaurant_status($restaurant, 'return names only'), $status_arr)) {
                $status_arr[ez_restaurant_status($restaurant, 'return names only')] += 1;
            } else {
                $status_arr[ez_restaurant_status($restaurant, 'return names only')] = 1;
            }
            $restaurant_cuisines = unserialize($restaurant->restaurant_cuisines);
            foreach ($restaurant_cuisines as $cuisine) {
//                echo $cuisine;
                if (isset($cuisine_arr[$cuisine])) {
                    $cuisine_arr[$cuisine] += 1;
                } else {
                    $cuisine_arr[$cuisine] = 1;
                }
            }
//            $status_arr .= ez_restaurant_status($restaurant, 'return names only');
            ?>

            <div class="listing simple">

                <ul>
                    <li class="item status-<?php echo ez_restaurant_status($restaurant, 'name only'); ?>">
                        <div class="img-holder">
                            <figure>
                                <?php restaurant_gravatar($restaurant); ?>
                            </figure>
                            <span class="restaurant-status <?php echo ez_restaurant_status($restaurant, 'only'); ?>">
                                <em class="bookmarkRibbon"></em>
                                <?php ez_restaurant_status($restaurant); ?></span>
                        </div>
                        <div class="text-holder">
                            <div class="post-title">
                                <?php restaurant_title($restaurant); ?>
                            </div>
                            <span class="post-categories"> 
                                <?php restaurant_cuisines($restaurant); ?>
                            </span>
                            <!--<div class="clearfix">&nbsp;</div>-->
                            <?php restaurant_pickup_delivery($restaurant); ?>
                        </div>
                        <div class="list-option">
                <!--<button class="shortlist-btn"><i class="icon-heart-o"></i></button>-->
                            <?php restaurant_link($restaurant); ?>
                        </div>
                    </li>
                </ul>
                <!--Foodyyums element Ends-->                       
            </div>
            <?php
        }
    } else {
        ?>
        <div class="listing simple slide-loader">
            <!--Element Section Start-->
            <!-- Foodyyums Element Starts-->
            <div class="no-restaurant-match-error"><h6 class="text-danger"><i class="icon-warning text-danger"></i><strong class="text-danger"> Sorry!</strong>&nbsp;<span class="text-danger"> There are no restaurants matching your search.</span> </h6></div><!--Foodbakery Element End-->                  
        </div>
        <?php
    }

    $html = ob_get_clean();
    /*     * ***********
     * FOR CATEGORIES
     * ******* */
    if (!empty($restaurants)) {
        ob_start();
        foreach ($cuisine_arr as $category => $count):
            ?>
            <li>
                <div class="checkbox">
                    <input onclick="ez_get_restaurents_subquery(this)" type="checkbox" name="foodyyums_cuisine[]" id="foodyyums_<?php echo $category; ?>" class="foodyyums_<?php echo $category; ?> foodyyums_restaurant_category foodyyums_restaurant_search_by" value="<?php echo $category; ?>"/>
                    <label for="foodyyums_<?php echo $category; ?>"><?php echo $category; ?></label>                         
                    <span>(<?php echo $count; ?>)</span>
                </div>
            </li>
            <?php
        endforeach;
    }
    /*else {
        ob_start();
        $categories = get_terms('product_cat', 'orderby=name&hide_empty=0&parent=0');

        $restaurant_ids_arr = rtrim($restaurant_ids_arr, ',');
        $the_cuisines = '';
        foreach ($categories as $category):
//                    print_r($restaurant_ids_arr);
            global $wpdb;


            $the_query = "SELECT COUNT(*) AS total FROM wp_usermeta WHERE meta_key='restaurant_cuisines' AND meta_value LIKE '%" . $category->name . "%' ORDER BY '" . $category->name . "' ASC";
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
    }*/

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
