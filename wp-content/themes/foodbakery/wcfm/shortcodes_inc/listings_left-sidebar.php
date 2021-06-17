<aside class="col-lg-2 col-md-2 col-sm-12 col-xs-12">

    <style>.listing-filter ul li{display:block;}</style>
<div class="filter-toggle"><span class="filter-toggle-text">Filters By</span><i class="icon-chevron-down"></i></div>
<div class="filter-wrapper">

    <div class="foodbakery-filters listing-filter"> 
        <div id="foodbakery-filters-40058">

            <div class="filter-heading">
                <h6><i class=" icon-food"></i>Cuisines</h6>
            </div>
            <div class="select-categories">

                <ul class="fy-filter-list"></ul>

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
                            <input onclick="ez_get_restaurents_subquery(this)" type="radio" id="open" name="restaurant_timings_checkbox" class="restaurant_timings_open foodyyums_restaurant_search_by timings" value="1"> 
                            <label for="open" class="restaurant_timings_total restaurant_timings_total_open">Open Now
                                <span class="restaurant_status_open_total">(0)</span> 
                            </label>
                        </div>
                    </li>
                    <li>
                        <div class="checkbox">
                            <input onclick="ez_get_restaurents_subquery(this)" type="radio" id="close" name="restaurant_timings_checkbox" class="restaurant_timings_close foodyyums_restaurant_search_by timings" value="0">   
                            <label for="close" class="restaurant_timings_total restaurant_timings_total_close">Closed Now 
                                <span class="restaurant_status_close_total">(0)</span> 
                            </label>
                        </div>
                    </li>
                    <li>
                        <div class="checkbox">
                            <input onclick="ez_get_restaurents_subquery(this)" type="radio" id="all" name="restaurant_timings_checkbox" class="restaurant_timings_all foodyyums_restaurant_search_by timings" value="">   
                            <label for="all" class="restaurant_timings_total restaurant_timings_total_all">All
                                <span class="restaurant_status_all_total">(0)</span> 
                            </label>
                        </div>
                    </li>
                </ul>

            </div>
        </div>
        <?php /*?>
        <div class="filter-holder panel-default">
            <div class="filter-heading">
                <h6><i class="icon-external-link"></i>Pre Orders</h6>
            </div>

            <div class="select-categories restaurant_pre_order">
                <ul class="filter-list cs-parent-checkbox-list">
                    <li>
                        <div class="checkbox">
                            <input type="checkbox" id="restaurant_pre_order_yes" name="restaurant_pre_order_checkbox" class="restaurant_pre_order_yes foodyyums_restaurant_search_by" value="yes">                                            <label for="restaurant_pre_order_yes">Yes                                                <span>(0)</span>
                            </label>
                        </div>
                    </li>
                    <li>
                        <div class="checkbox">
                            <input type="checkbox" id="restaurant_pre_order_no" name="restaurant_pre_order_checkbox" class="restaurant_pre_order_no foodyyums_restaurant_search_by" value="no">                                            <label for="restaurant_pre_order_no">No                                                <span>(0)</span>
                            </label>
                        </div>
                    </li>
                </ul>


            </div>
        </div>

        <div class="filter-holder panel-default">
            <div class="filter-heading">
                <h6><i class="icon-folder_special"></i>Specials</h6>
            </div>

            <div class="select-categories">

                <ul class="filter-list cs-checkbox-list">                                                                
                    <li style="">
                        <div class="checkbox">
                            <input type="checkbox" id="specials_1" class="specials  foodyyums_restaurant_search_by" value="deals">
                            <label for="specials_1">Deals</label>
                            <span>(0)</span>                                                                 
                        </div>
                    </li>

                    <li style="">
                        <div class="checkbox">
                            <input type="checkbox" id="specials_2" class="specials  foodyyums_restaurant_search_by" value="free-delivery"/>
                            <label for="specials_2">Free Delivery</label>
                            <span>(0)</span>                                                                
                        </div>
                    </li>

                </ul>

            </div>


        </div>
        <?php */?>

    </div>

</div><!-- end of filters-->

<div class="restaurant-filters-ads">
</div>

</aside>     