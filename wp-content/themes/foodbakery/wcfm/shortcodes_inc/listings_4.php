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
                                <!--<input type="hidden" name="foodyyums_cuisine_arr" value="<?php // echo isset($_REQUEST['foodyyums_cuisine']) ? $_REQUEST['foodyyums_cuisine'] : ""            ?>">-->
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
        //        let the_data = jQuery('#ez_search_restaurants').serializeArray();
        function ez_get_restaurents(obj, sub = null) {
            //                        debugger;
            let the_data = jQuery('#ez_search_restaurants').serializeArray();
            let adminAjaxUrl = '<?php echo admin_url('admin-ajax.php'); ?>';
            let $this = jQuery(obj);
            jQuery('#the_listings').html('<?php loading(); ?>');
            //            console.log(the_data);
            jQuery.ajax({
                url: adminAjaxUrl + '?action=ez_list_restaurants',
                type: "Post",
                dataType: "json",
                //                async: false,
                data: the_data
            }).done(function (response) {
                //                console.log(response.status_arr);
                $this.prop("checked", true);
                jQuery('#the_listings').html(response.SHtml);
                jQuery('.select-categories ul.fy-filter-list').html(response.the_cuisines);
                jQuery('.restaurant_status_open_total').html('(' + response.status_arr.open + ')');
                jQuery('.restaurant_status_close_total').html('(' + response.status_arr.close + ')');
                //                console.log(response.q);
            }); //ajax done

        }//ends funct
        /* ********************************************************
         * =========|| GETTING subQuery LISTING ||===============** 
         * ********************************************************/
        //        let the_data = jQuery('#ez_search_restaurants').serializeArray();
        function ez_get_restaurents_subquery(obj) {
            //                        debugger;
            let $this = jQuery(obj);
            if ($this.hasClass('sort_it')) {
                jQuery("#sort_by").val($this.data('key'));
                //                console.log(); debugger;
            }
            let the_data = jQuery('#ez_search_restaurants').serializeArray();
            let adminAjaxUrl = '<?php echo admin_url('admin-ajax.php'); ?>';
            $this.closest('li').siblings().removeClass('active');

            $this.closest('li').addClass('active');
            jQuery('#the_listings').html('<?php loading(); ?>');
            //            console.log(the_data);
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
        /* * * *
         * DOC READY FUNCTION
         * * * */
        jQuery(function () {
            ez_get_restaurents();
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
    $restaurant_status_now = $_REQUEST['restaurant_timings_checkbox'];
    $sort_by = $_REQUEST['sort_by'];
    $condition = " 1=1 ";
    $_order = "";
    $_results_total = "";
    if (isset($search_restaurant) && $search_restaurant != "") {
        $condition .= " AND u1.user_nicename LIKE '%" . $search_restaurant . "%'";
    }
    if ($restaurant_cuisines != "" || !empty($restaurant_cuisines)) {// IF CUISINES ARE SEARCHED
        foreach ($restaurant_cuisines as $param) {
            $condition .= " AND m3.meta_key = 'restaurant_cuisines' AND m3.meta_value LIKE '%" . $param . "%' ";
        }
    }
    if ($restaurant_status_now != "") {
        $condition .= "  AND m6.meta_key = 'restorant_status' AND m6.meta_value='" . $restaurant_status_now . "' ";
    }


//    if ($sort_by != "") {
    if ($sort_by == 'best_match') {
        $_order .= "";
    } elseif ($sort_by == 'alphabetical') {
        $_order .= " ORDER BY u1.user_nicename";
    } elseif ($sort_by == 'fastest_delivery') {
        $_order .= "";
    } else {
        
    }
//    }

    echo $query = " 
       SELECT
    u1.*,
    m1.meta_value AS business_name,
    m2.meta_value AS wcfm_vendor_store_hours,
    m3.meta_value AS restaurant_cuisines,
    m4.meta_value AS restaurant_delivery_or_pickup,
    m5.meta_value AS wcfmmp_profile_settings,
    m6.meta_value AS restorant_status

FROM {$wpdb->prefix}users u1
INNER JOIN {$wpdb->prefix}usermeta m1 ON (m1.user_id = u1.id AND m1.meta_key = 'business_name')
INNER JOIN {$wpdb->prefix}usermeta m2 ON (m2.user_id = u1.id AND m2.meta_key = 'wcfm_vendor_store_hours')
INNER JOIN {$wpdb->prefix}usermeta m3 ON (m3.user_id = u1.id AND m3.meta_key = 'restaurant_cuisines')
INNER JOIN {$wpdb->prefix}usermeta m4 ON (m4.user_id = u1.id AND m4.meta_key = 'restaurant_delivery_or_pickup')
LEFT JOIN {$wpdb->prefix}usermeta m5 ON (m5.user_id = u1.id AND m5.meta_key = 'wcfmmp_profile_settings')
LEFT JOIN {$wpdb->prefix}usermeta m6 ON (m6.user_id = u1.id AND m6.meta_key = 'restorant_status')

WHERE $condition  
AND u1.user_status=1

$_order
    
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

//    $status_arr['open']=0;
//    $status_arr['close']=0;  

        $cuisine_arr = array();
        $status_arr = array();
        $IDs_arr = "";
        $_results_total .= count($restaurants);
        $counter = 1;
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
            ?>

            <div class="listing simple" data-item="<?php echo $counter; ?>">

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
            $counter++;
        }
        ob_start();
        $_results_total; //THIS ONE
        $_per_page = 2; // THIS ONE
        echo $_total_pages = ceil($_results_total / $_per_page);
        ?>           
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <input type="hidden" id="current_page" name="current_page" value="1">
                <div class="page-nation">
                    <!--                    <ul class="pagination pagination-large">
                                            <li><a onclick="foodyyums_paginate();" href="javascript:void(0);">Prev </a></li>
                                            <li><a onclick="foodyyums_paginate();" href="javascript:void(0);">1</a></li>
                                            <li class="active"><span><a class="page-numbers active">2</a></span></li>
                                            <li class="disabled" ><span>Next</span></li> 
                                        </ul>-->
                    <ul class="pagination">
                        <li id="prev" class="page-item" data-action='prev'><a class="page-link" href="javascript:void(0);">Previous</a></li>
                        <?php for ($index = 1; $index < $_total_pages; $index++): ?>
                            <li class="pagination_item page-item" data-index="<?php echo $index; ?>"><a class="page-link" href="javascript:void(0);"><?php echo $index; ?></a></li>
                        <?php endfor; ?>
                            <li id="next" class="page-item" data-action='next'><a class="page-link" href="javascript:void(0);">Next</a></li>
                    </ul> 
                </div>                            
            </div>
        </div>
        <script>
            jQuery(function () {
                jQuery('.pagination_item').on('click', function () {
                    let total_records = <?php echo $_results_total; ?>;
                    let per_page = <?php echo $_per_page; ?>;
                    let total_pages = Math.ceil(total_records / per_page);
                    let page_number = jQuery(this).data('index');
                    jQuery('#current_page').val(page_number)
                    let current_page = jQuery('#current_page').val();
                    let record_number = jQuery('.listing').data('item');
        //                    jQuery('.listing').hide();
//                   console.log(current_page);
//                   console.log(per_page);
                    let show_record_start = ((current_page * per_page)-per_page)+1;
                    let show_record_end = (current_page * per_page);
                    if(jQuery(this).attr('id')=="prev"){
                        jQuery('#current_page').val(page_number-1);
                    }
                    console.log(show_record_start, show_record_end);
                });//ends foodyyums_paginate

            });
        </script>
        <?php
        $pagination = ob_get_clean();
        echo $pagination;
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
     * * ****** */
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
    if (!isset($status_arr['open'])) {
        $status_arr['open'] = 0;
    }
    if (!isset($status_arr['close'])) {
        $status_arr['close'] = 0;
    }
    $the_cuisines = ob_get_clean();
//    $IDs_arr = substr(trim($IDs_arr), 0, -1);
//    $page_page = 2;
//      echo $pages = ($_results_total );
//      echo ceil($pages);



    echo json_encode(
            array(
                'Status' => true,
                'MSG' => 'ok',
                'q' => $query,
                'SHtml' => $html,
                'the_cuisines' => $the_cuisines,
                'rq' => $restorant_query,
                'status_arr' => $status_arr,
                'requeust' => $_REQUEST
            )
    );
    exit();
}
