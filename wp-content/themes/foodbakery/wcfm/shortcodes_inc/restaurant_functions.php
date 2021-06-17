<?php

function ez_restaurant_status($info, $only = null) {
//    echo '<pre>';
//    echo ();
//    echo '</pre>';
    $wcfm_vendor_store_hours = unserialize($info->wcfm_vendor_store_hours);
    $today = date("w") - 1;
//       $today = date("w");
//        @$todays_timings = $wcfmmp_profile_settings['wcfm_delivery_time']['day_times'][$today][0];
    $now = date("h:i:s");
    $start = ($wcfm_vendor_store_hours['day_times'][$today][0]['start']);
    $end = ($wcfm_vendor_store_hours['day_times'][$today][0]['end']);

    if ($now > $start && $now < $end) {
        $restaurant_status = "open";
    } else {
        $restaurant_status = "close";
    }
    if ($only != "") {
        return $restaurant_status;
    }
    return $restaurant_status == "open" ? ucfirst($restaurant_status) : ucfirst($restaurant_status) . 'd';
}

function restaurant_gravatar($record) {
    $gravatar = wp_get_attachment_url(unserialize($record->wcfmmp_profile_settings)['gravatar']);
    ob_start();
    ?>
    <a href="<?= site_url() ?>/store/<?= $record->user_nicename ?>">
        <img src="<?php echo $gravatar; ?>" class="img-list wp-post-image" alt="" loading="lazy"/> 
    </a>
    <?php
        return ob_get_clean();
}

function restaurant_cuisines($record) {
    $restaurant_cuisines = trim(implode(", ", unserialize($record->restaurant_cuisines)));
    echo "Type of Food: $restaurant_cuisines";
}

function restaurant_title($record) {
    ob_start();
    ?>
    <a href="<?= site_url() ?>/store/<?= $record->user_nicename ?>">
        <h5 class="restaurant_title"><?php echo $record->business_name; ?></h5>
    </a>
    <?php
    echo ob_get_clean();
}

function restaurant_pickup_delivery($record) {
    $restaurant_delivery_or_pickup = $record->restaurant_delivery_or_pickup;
    $deliv_time = unserialize($record->wcfmmp_profile_settings)['wcfm_delivery_time']['start_from'];
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
    ob_start();
    ?>
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
    <?php
    $delivery = ob_get_clean();
    echo $delivery;
}

function restaurant_link($record) {
    ob_start();
    ?>
    <a href="<?= site_url() ?>/store/<?= $record->user_nicename ?>" class="viewmenu-btn text-color">View Menu</a>
    <?php
    $link = ob_get_clean();
    echo $link;
}

function the_pagination($_results_total, $per_page){
        $_results_total; //THIS ONE
        $total_pages = ceil($_results_total / $per_page);
        ?>
    <!--<div class="row">-->
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <!--<input type="hidden" id="current_page" name="current_page" value="1">-->
                <div class="page-nation">
                    <ul class="pagination">
                        <li id="prev" class="page-item" data-action='prev'><a class="page-link" href="javascript:void(0);">Previous</a></li>
                        <?php for ($index = 1; $index < $total_pages; $index++): ?>
                        <li onclick="cp_pagination(this, <?php echo $index; ?>);" class="pagination_item page-item" data-index="<?php echo $index; ?>"><a class="page-link" href="javascript:void(0);"><?php echo $index; ?></a></li>
                        <?php endfor; ?>
                            <li id="next" class="page-item" data-action='next'><a class="page-link" href="javascript:void(0);">Next</a></li>
                    </ul> 
                </div>                            
            </div>
        <!--</div>-->
<?php }

  function pagination_bar( $_results_total, $per_page ) {?>
    <style>.page-numbers {
    font-size: 12page-numberspx;
    color: #999ba3;
    margin-left: -1px;
    height: 26px;
    border: 1px solid #ddd;
    background-color: transparent;
    padding: 0 10px;
    line-height: 25px;
    text-align: center;
    border-radius: 3px;
    font-weight: 400;
    display: inline-block;
}
    .page-numbers:hover,.page-numbers:focus ,.page-numbers.current {
    background-color: #fff;
    border-color: transparent;
    color: #c33332 !important;
    /*z-index: 0;*/
    -webkit-box-shadow: 2px 2px 4px 0 rgba(0, 0, 0, 0.2);
    box-shadow: 2px 2px 4px 0 rgba(0, 0, 0, 0.2);
}.page-nation {
    margin: 10px 0 30px 0;
}</style>  
      <?php 
         $total_pages = ceil($_results_total / $per_page);
         
    $big = 999999999; // need an unlikely integer

    if ($total_pages > 1){
        $current_page = max(1, get_query_var('page'));

        echo paginate_links(array(
            'base' => str_replace( $big, '%#%', esc_url( get_pagenum_link( $big ) ) ),
            'format' => '?paged=%#%',
            'current' => $current_page,
            'total' => $total_pages,
        ));
    }
}
