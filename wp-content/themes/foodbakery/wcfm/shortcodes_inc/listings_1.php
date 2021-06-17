<?php
add_shortcode("ez_restorant_search_list", "ez_restorant_search_list");

function ez_restorant_search_list() {
    ob_start();
    @$search_restorant = $_GET['search_restorant'];
    ?><style>li{list-style: none;}.listing.simple.slide-loader::before {display: none;}</style>
    <div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 ">
            <div class="row">
                <div class="foodbakery-restaurant-content" id="foodbakery-restaurant-content-40058">
                    <div class="detail-map-restaurant">
                        <div id="Restaurant-content-40058">
                            <form id="frm_restaurant_arg40058">

                                                <!--<input type="hidden" name="search_type" value="autocomplete">-->

                                <?php include_once 'listings_left-sidebar.php'; ?>    


                                <div class="col-lg-7 col-md-7 col-sm-12 col-xs-12">

                                    <div class="listing-sorting-holder">
                                        <div class="row">
                                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                                <?php
                                                $Args = array(
                                                    'meta_query' => array(
                                                        array(
                                                            'key' => 'business_name',
                                                            'value' => $search_restorant,
                                                            'compare' => 'LIKE'
                                                        )
                                                    )
                                                );
                                                $restorant_query = new WP_User_Query($Args);
                                                $wcfm_store = new WCFMmp_Store();
                                                $restorants = $restorant_query->get_results();
                                                ?>
                                                <?php if (empty($restorants)): ?> <h4> 0 Restaurant found  </h4><?php endif; ?>
                                                <?php if ($search_restorant != ""): ?>    
                                                    <ul class="search-results"><li>"<?php echo $search_restorant; ?>", </li><li> </li></ul>
                                                    <a class="clear-tags" href="<?php echo site_url(); ?>/foodyyum-listings/">Reset</a>
                                                <?php endif; ?>    
                                            </div>
                                        </div>
                                    </div>


                                    <?php
                                    if (!empty($restorants)) {
                                        foreach ($restorants as $restorant) {
                                            $wcfmmp_profile_settings = get_user_meta($restorant->ID, 'wcfmmp_profile_settings', true);
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
                                            ?>

                                            <div class="listing simple">

                                                <ul>
                                                    <li>
                                                        <div class="img-holder">
                                                            <figure>
                                                                <a href="<?= site_url() ?>/store/<?= $restorant->user_nicename ?>">
                                                                    <img src="<?php echo $gravatar; ?>" class="img-list wp-post-image" alt="" loading="lazy"/>                        </a>
                                                            </figure>
                                                            <span data-status="<?php echo $restorant_status; ?>" class="restaurant-status <?php echo $restorant_status; ?>">
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
                                                                $cuisines = get_user_meta($restorant->ID, 'restaurant_cuisines', true);
                                                                foreach ($cuisines as $cuisine):
                                                                    ?>
                                                                    <span data-id="<?php echo $cuisine; ?>"><?php echo $cuisine; ?>, </span>
                                                                    <?php
                                                                endforeach;
                                                                ?>
                                                            </span>
                                                            <!--<div class="clearfix">&nbsp;</div>-->
                                                            <div class="delivery-potions">
                                                                <div class="post-time">
                                                                    <i class="icon-motorcycle"></i>
                                                                    <div class="time-tooltip">
                                                                        <div class="time-tooltip-holder"> <b class="tooltip-label">Delivery time</b> <b class="tooltip-info">Your order will be delivered in <?php echo $deliver_in; ?></b> </div>
                                                                    </div>
                                                                </div>
                                                                <div class="post-time">
                                                                    <i class="icon-clock4"></i>
                                                                    <div class="time-tooltip">
                                                                        <div class="time-tooltip-holder"> <b class="tooltip-label">Pickup time</b> <b class="tooltip-info">You can pickup order in  <?php echo $deliver_in; ?></b> </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="list-option">
                                                <!--<button class="shortlist-btn"><i class="icon-heart-o"></i></button>-->
                                                            <a href="<?= site_url() ?>/store/<?= $restorant->user_nicename ?>" class="viewmenu-btn text-color">View Menu</a>
                                                        </div>
                                                    </li>
                                                </ul>
                                                <!--Foodbakery Element End-->                       
                                            </div>
                                            <?php
                                        }
                                    } else {
                                        ?>
                                        <div class="listing simple slide-loader">
                                            <!--Element Section Start-->
                                            <!--Foodbakery Element Start-->
                                            <div class="no-restaurant-match-error"><h6><i class="icon-warning"></i><strong> Sorry !</strong>&nbsp; There are no restaurants matching your search. </h6></div><!--Foodbakery Element End-->                  
                                        </div>
                                    <?php } ?>
                                    <!--                                    <div class="row">
                                                                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                                                            </div>
                                                                        </div> -->
                                </div>
                                <!-- Column Start -->
                                <?php include_once 'listings_right-sidebar.php'; ?>  
                                <!-- Column End -->
                            </form>

                        </div>
                    </div> 
                </div>   
            </div>
        </div>
    </div>
    <script>
        jQuery(function () {

            let opened = jQuery("span[data-status*='open").length;
            let closed = jQuery("span[data-status*='close").length;
            jQuery('#open>span').html('(' + opened + ')');
            jQuery('#close>span').html('(' + closed + ')');

            let url = window.location.href + '?restaurant_timings=all&restaurant_pre_order=all&sort-by=best_match';

            jQuery('.foodyyums_restaurant_category').on('change', function () {
                if (jQuery(this).is(':checked')) {

                    console.log(jQuery(this).val());
                    console.log(url);
                    url = url + '&cuisine=' + jQuery(this).val();
                    console.log(url);

                }
            });
            
        });
    </script>
    <?php
    return $html = ob_get_clean();
}
