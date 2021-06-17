<?php
add_shortcode("ez_restorant_search_list", "ez_restorant_search_list");

function ez_restorant_search_list() {
    global $foodbakery_var_static_text;
    ob_start();
    $search_restorant = !empty($_GET['search_restorant']) ? $_GET['search_restorant'] : '';
    ?><style>li{list-style:none}.listing.simple.slide-loader::before{display:none}span.page-numbers.current{color:#777;background-color:#fff;border-color:#ddd;cursor:not-allowed;border:1px solid #ddd;padding:3px 10px;border-radius:3px;}#custom_pagination a{font-size:12px;color:#999ba3;margin-left:-1px;height:26px;border:1px solid #ddd;background-color:transparent;padding:0 10px;line-height:25px;text-align:center;border-radius:3px;font-weight:400;display:inline-block}#custom_pagination a:hover{background-color:#fff;border-color:transparent;color:#fff;z-index:0;-webkit-box-shadow:2px 2px 4px 0 rgb(0 0 0 / 20%);box-shadow:2px 2px 4px 0 rgb(0 0 0 / 20%);color:#c33332!important}</style>
    <?php //ez_scripts();?>
    <div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 ">
            <div class="row">
                <div class="foodbakery-restaurant-content" id="foodbakery-restaurant-content">
                    <div class="detail-map-restaurant">
                        <div id="Restaurant-content">
                            <form id="ez_search_restaurants">

                                <input type="hidden" name="zip" value="<?php echo isset($_GET['zip']) ? $_GET['zip'] : "" ?>">
                                <input type="hidden" name="search_title" value="<?php echo isset($_GET['search_title']) ? $_GET['search_title'] : "" ?>">
                                <input type="hidden" name="location" value="<?php echo isset($_GET['location']) ? $_GET['location'] : "" ?>">
                                <input type="hidden" name="radius" value="<?php echo isset($_GET['search_radius']) ? $_GET['search_radius'] : "" ?>">
                                <!--<input type="hidden" name="foodyyums_cuisine_arr" value="<?php // echo isset($_REQUEST['foodyyums_cuisine']) ? $_REQUEST['foodyyums_cuisine'] : ""                 ?>">-->
                                <input type="hidden" name="sort_by" id="sort_by" value=""/>
                                <input type="hidden" name="total_results" id="total_results" value=""/>
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
        function ez_get_restaurents(latlng, is_page_loaded) {
            jQuery('#the_listings').html('<div class="ml-auto mr-auto text-center"><div class="spinner-border text-info"></div><h2 class="mt-4 text-info">Please wait...</h2></div>');
    //            debugger;
            let the_data = jQuery('#ez_search_restaurants').serializeArray();
            the_data.push({name: 'p', value: GlobalPage});
            if (latlng) {
                the_data.push({name: 'lat', value: latlng.lat()});
                the_data.push({name: 'lng', value: latlng.lng()});
                let radius = <?php echo!empty($_REQUEST['search_radius']) ? $_REQUEST['search_radius'] : 20 ?>;
                the_data.push({name: 'radius', value: radius});
            }
            if (is_page_loaded == null) {
                the_data.push({name: 'is_page_loaded', value: 1});
            }
            let adminAjaxUrl = '<?php echo admin_url('admin-ajax.php'); ?>';
            jQuery.ajax({
                url: adminAjaxUrl + '?action=ez_list_restaurants',
                type: "Post",
                dataType: "json",
                //async: false,
                data: the_data
            }).done(function (response) {

    //                debugger;
                //console.log(response.status_arr);
                //imdad//$this.prop("checked", true);
                if (response.the_cuisines) {
                    jQuery('.select-categories ul.fy-filter-list').html(response.the_cuisines);
                    jQuery('.restaurant_status_open_total').html('(' + response.status_arr.open + ')');
                    jQuery('.restaurant_status_close_total').html('(' + response.status_arr.close + ')');
                    jQuery('.restaurant_status_all_total').html('(' + response.status_arr.all + ')');
                }

                jQuery('#the_listings').html(response.restaurants_list);

                //console.log(response.q);
            }); //ajax done

        }//ends funct
        /* ********************************************************
         * =========|| GETTING subQuery LISTING ||===============** 
         * ********************************************************/
        //        let the_data = jQuery('#ez_search_restaurants').serializeArray();

        function geocodeAddress(address, is_page_loaded) {
            const geocoder = new google.maps.Geocoder();
            debugger;
            address = address.split(' ').join('+');
            address = address.split('%20').join('+');
            address = address.split('&nbsp;').join('+');
            geocoder.geocode({address: address}, (results, status) => {

                if (status === "OK") {
                    ez_get_restaurents(results[0].geometry['location'], is_page_loaded);
                } else {
                    alert("Geocode was not successful for the following reason: " + status);
                }
            });
        }
        function ez_get_restaurents_subquery(obj) {
            jQuery('#the_listings').html('<div class="ml-auto mr-auto text-center"><div class="spinner-border text-info"></div><h2 class="mt-4 text-info">Please wait...</h2></div>');
            debugger;
            GlobalPage = 1;
            let $this = jQuery(obj);
            if ($this.hasClass('sort_it')) {
                jQuery("#sort_by").val($this.data('key'));
            }
            $this.closest('li').siblings().removeClass('active');
            $this.closest('li').addClass('active');

            if (GlobalAddress != '') {
                geocodeAddress(GlobalAddress, 1);
            } else {
                ez_get_restaurents(null, 1);
            }
        }//ends funct
        /* ********************************************************|
         * =========|| GETTING FILTERING STATUS COUNT ||========***| 
         * ********************************************************|*/
        /* * * *
         * DOC READY FUNCTION
         * * * */
        let GlobalAddress = '<?php echo isset($_REQUEST['location']) ? $_REQUEST['location'] : ''; ?>';
        let GlobalPage = 1;
        jQuery(function () {
            if (GlobalAddress != '') {
                geocodeAddress(GlobalAddress, null);
            } else {
                ez_get_restaurents(null, null);
            }
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

    @$search_restaurant = $_REQUEST['search_title'];
    @$restaurant_cuisines = $_REQUEST['foodyyums_cuisine'];
    @$restaurant_status_now = $_REQUEST['restaurant_timings_checkbox'];
    @$sort_by = $_REQUEST['sort_by'];
    @$is_page_loaded = $_REQUEST['is_page_loaded'];

    $condition = " 1=1 ";
    $_results_total = "";



    if (isset($search_restaurant) && $search_restaurant != "") {
        $condition .= " AND u1.user_nicename LIKE '%" . $search_restaurant . "%'";
    }
    if (isset($_GET['restaurant_zipcode']) && $_GET['restaurant_zipcode'] != "") {
//        $condition .= " AND u1._wcfm_zip LIKE '%" . $_GET['restaurant_zipcode'] . "%'";
        $condition .= " AND u1._wcfm_zip =" . $_GET['restaurant_zipcode'];
    }
    if ($restaurant_cuisines != "" || !empty($restaurant_cuisines)) {// IF CUISINES ARE SEARCHED
        foreach ($restaurant_cuisines as $param) {
            $condition .= " AND m3.meta_value LIKE '%" . $param . "%' ";
        }
    }

    $open_restaurant_ids = get_option('_open_restaurants');

    if (is_array($open_restaurant_ids) && count($open_restaurant_ids)) {
        if ($restaurant_status_now == 1) {
            $condition .= "  AND u1.ID IN (" . implode(',', $open_restaurant_ids) . ")";
        } else if ($restaurant_status_now != '' && $restaurant_status_now == 0) {
            $condition .= "  AND u1.ID NOT IN (" . implode(',', $open_restaurant_ids) . ")";
        }
    } else {
        $open_restaurant_ids = array(); //no open restaurant
    }


    $earth_radius = 69; //radius in miles for KM use 6371
    $distance = 20;
    $lat = '';
    $lng = '';
    if (isset($_REQUEST['lat']) && isset($_REQUEST['lng']) && !empty($_REQUEST['lat']) && !empty($_REQUEST['lng'])) {
        $lat = $_REQUEST['lat'];
        $lng = $_REQUEST['lng'];
        $distance = $_REQUEST['radius'];
    }

    $_order = "";
    if ($sort_by == 'best_match') {
        $_order .= "";
    } elseif ($sort_by == 'alphabetical') {
        $_order .= " ORDER BY u1.user_nicename";
    } elseif ($sort_by == 'fastest_delivery') {
        $_order .= "";
    } else if (!empty($lat) && !empty($lng)) {
        $_order .= " Order By distance";
    }

    $select_count = "SELECT 
    u1.*,
    m1.meta_value AS business_name,
    m2.meta_value AS wcfm_vendor_store_hours,
    m3.meta_value AS restaurant_cuisines,
    m4.meta_value AS restaurant_delivery_or_pickup,
    m5.meta_value AS wcfmmp_profile_settings,
    m6.meta_value AS restaurant_status,
    m7.meta_value AS _wcfm_zip
    ";
    $select_page = $select_count;
    $join_count = "
INNER JOIN {$wpdb->prefix}usermeta m1 ON (m1.user_id = u1.id AND m1.meta_key = 'business_name')
INNER JOIN {$wpdb->prefix}usermeta m2 ON (m2.user_id = u1.id AND m2.meta_key = 'wcfm_vendor_store_hours')
INNER JOIN {$wpdb->prefix}usermeta m3 ON (m3.user_id = u1.id AND m3.meta_key = 'restaurant_cuisines')
INNER JOIN {$wpdb->prefix}usermeta m4 ON (m4.user_id = u1.id AND m4.meta_key = 'restaurant_delivery_or_pickup')
INNER JOIN {$wpdb->prefix}usermeta m7 ON (m7.user_id = u1.id AND m7.meta_key = '_wcfm_zip')
LEFT JOIN {$wpdb->prefix}usermeta m5 ON (m5.user_id = u1.id AND m5.meta_key = 'wcfmmp_profile_settings')
LEFT JOIN {$wpdb->prefix}usermeta m6 ON (m6.user_id = u1.id AND m6.meta_key = 'restaurant_status')";

    $join_page = $join_count;
//    $lat = 73.0752068;
//    $lng = 33.6676974;
    //

 if (!empty($lat) && !empty($lng)) {
        /////////////////////-Count-////////////////////
        $select_count .= " , ($earth_radius *
    DEGREES(ACOS(LEAST(1.0, COS(RADIANS($lat))
         * COS(RADIANS(latitude.meta_value))
         * COS(RADIANS($lng - longitude.meta_value))
         + SIN(RADIANS($lat))
         * SIN(RADIANS(latitude.meta_value))))) ) as distance";
        $query_count = " $select_count FROM {$wpdb->prefix}users u1
    $join_count
    INNER JOIN {$wpdb->prefix}usermeta latitude ON (latitude.user_id = u1.id AND latitude.meta_key = 'ez_location_latitude_restaurant')
    INNER JOIN {$wpdb->prefix}usermeta longitude ON (longitude.user_id = u1.id AND longitude.meta_key = 'ez_location_longitude_restaurant')
    WHERE $condition 
    HAVING distance < $distance
    ";
        /////////////////////Single Page/////////////////////
        $select_page .= $select_count;
        $query_page = $query_count . " " . $_order;
    } else {//without lat long normal condition
        /////////////////////Count////////////////////
        $query_count = " $select_count FROM {$wpdb->prefix}users u1
    $join_count
    WHERE $condition 
    ";
        /////////////////////Single Page/////////////////////
        $query_page = " $select_page FROM {$wpdb->prefix}users u1
    $join_page
    WHERE $condition 
    $_order
    ";
    }

//use only when loading first time= is_page_loaded=1;
    $restaurants_all = $wpdb->get_results($query_count); //getting all restaurants
// count the number of users found in the query
    $total_users = $restaurants_all ? count($restaurants_all) : 0;

// grab the current page number and set to 1 if no page number is set
    $page = isset($_REQUEST['p']) ? $_REQUEST['p'] : 1;

// how many users to show per page
    $users_per_page = 2;

// calculate the total number of pages.
    $total_pages = 1;
    $offset = $users_per_page * ($page - 1);
    $total_pages = ceil($total_users / $users_per_page);

    $query_page .= " Limit $offset,$users_per_page";

//    print_r($query_page);

    $restaurants = $wpdb->get_results($query_page); //displays restaurants page-wise , i.e: how many on one page
    /////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    /*     * ***********
     * FOR CATEGORIES
     * * ****** */

    $cuisine_arr = array();
    $status_arr = array('open' => 0, 'close' => 0, 'all' => 0);
    if (!empty($restaurants_all) && $is_page_loaded == 1) {
        $open_restautant_ids = array();
        foreach ($restaurants_all as $restaurant):
            //Open Close Status
            $current_status = ez_restaurant_status($restaurant, 'return names only');
            if ($current_status == 'open') {
                $open_restautant_ids[] = $restaurant->ID;
                $status_arr['open'] += 1;
                $status_arr['all'] += 1;
            } else {
                $status_arr['close'] += 1;
                $status_arr['all'] += 1;
            }

            //cuisines count of all restaurants
            $restaurant_cuisines = unserialize($restaurant->restaurant_cuisines);
            foreach ($restaurant_cuisines as $cuisine) {

                if (isset($cuisine_arr[$cuisine])) {
                    $cuisine_arr[$cuisine] += 1;
                } else {
                    $cuisine_arr[$cuisine] = 1;
                }
            }

        endforeach;
        if (count($open_restautant_ids) > 0) {
            update_option('_open_restaurants', $open_restautant_ids);
            //$sql = "Update {$wpdb->prefix}usermeta set meta_value=1 Where meta_key='restaurant_status' and user_id in (". implode(',', $open_restautant_ids).")";
            //$rez = $wpdb->query($sql);
        }
//        if(count($close_restautant_ids) > 0){
//            $sql = "Update {$wpdb->prefix}usermeta set meta_value=1 Where meta_key='restaurant_status' and user_id in (". implode(',', $close_restautant_ids).")";
//            $rez = $wpdb->query($sql);
//        }
    }

    $the_cuisines = '';
    if (!empty($restaurants_all) && $is_page_loaded == 1) {
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
        $the_cuisines = ob_get_clean();
    }

    ////////////////////////////////////////////////////////////////////////////////////////////////////////////////
    ob_start(); //restaurant middle section
    ?>
    <div class="listing-sorting-holder">
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">

                <?php if (empty($restaurants)): ?> <h4> 0 Restaurant found  </h4><?php endif; ?>
                <?php if ($search_restaurant != ""): ?>    
                    <ul class="search-results"><li>"<?php echo $search_restaurant; ?>", </li><li><?php
                            if (!empty($restaurants)) {
//                                echo count($restaurants);
                            }
                            ?></li></ul>
                    <a class="clear-tags" href="<?php echo site_url(); ?>/foodyyum-listings/">Reset</a>
                <?php endif; ?>    
            </div>
        </div>
    </div>

    <?php
    if (!empty($restaurants)) {

//    $status_arr['open']=0;
//    $status_arr['close']=0;  



        $_results_total .= count($restaurants);
        $counter = 1;
        foreach ($restaurants as $restaurant) {
            $st = 'Close';
            if (in_array($restaurant->ID, $open_restaurant_ids)) {
                $st = 'Open';
            }
            ?>

            <div class="listing simple" data-item="<?php echo $counter; ?>">
                <ul>
                    <li class="item status-<?php echo strtolower($st); ?>">
                        <div class="img-holder">
                            <figure>
                                <?php echo restaurant_gravatar($restaurant); ?>
                            </figure>
                            <span class="restaurant-status <?php echo strtolower($st); ?>">
                                <em class="bookmarkRibbon"></em>
                                <?php echo $st . 'd'; ?></span>
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
            $counter++;
        }

        $big = 999999999; // need an unlikely integer
        echo '<div id="custom_pagination">' . paginate_links(array(
            'base' => str_replace($big, '%#%', esc_url(get_pagenum_link($big))),
            'format' => '?paged=%#%',
            'current' => max(1, $page),
            'total' => $total_pages
        )) . '</div>';
        ?>
        <script>
            jQuery(function () {
                jQuery('#custom_pagination a').each(function () {
                    let href = $(this).attr('href');
                    let ind = href.indexOf('paged=');
                    let page = href.substr(ind + 6);
                    $(this).attr('href', 'javascript:void(0)');
                    $(this).attr('onclick', 'LoadData(' + page + ')');
                });
            });
            function LoadData(page) {
                GlobalPage = page;
                if (GlobalAddress != '') {
                    geocodeAddress(GlobalAddress, 1);
                } else {
                    ez_get_restaurents(null, 1);
                }
            }
        </script>
        <?php
    } else {
        ?>
        <div class="listing simple slide-loader">
            <!--Element Section Start-->
            <!-- Foodyyums Element Starts-->
            <div class="no-restaurant-match-error"><h6 class="text-danger"><i class="icon-warning text-danger"></i><strong class="text-danger"> Sorry!</strong>&nbsp;<span class="text-danger"> There are no restaurants matching your search.</span> </h6></div><!--Foodbakery Element End-->                  
        </div>

        <?php
    }
    $restaurants_list = ob_get_clean();
    echo json_encode(
            array(
                'Status' => true,
                'MSG' => 'ok',
                'query_count' => $query_count,
                'query_page' => $query_page,
                'restaurants_list' => $restaurants_list,
                'the_cuisines' => $the_cuisines,
                'rq' => $restorant_query,
                'status_arr' => $status_arr,
                'requeust' => $_REQUEST
            )
    );
    exit();
}
