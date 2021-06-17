<?php
add_shortcode("ez_restorant_search_form", "ez_restorant_search_form");

function ez_restorant_search_form() {
    ob_start();
    ?><style>form#foodyyum-listings{background-color:#c33332!important;padding:30px 20px}input[type=text]{text-transform:uppercase;margin:0;padding:0 15px;border-radius:inherit;height:50px;line-height:50px;color:#d1d1d1;font-size:12px}button[type=submit]{margin:0;padding:10px 15px;border-radius:inherit;border:none;-webkit-box-shadow:none;box-shadow:none;width:100%;height:50px;line-height:30px;font-size:18px;letter-spacing:1px;text-transform:uppercase;background-color:#4cce4a;color:#fff}#radius_container label, #radius_container output{color:#FFF;}
        #target {position: absolute;display: inline;top: 15px;right: 30px;cursor: pointer;}
        .relative{position: relative;}
        #radius_container_outer {min-width: 100%;min-height: 30px;overflow: hidden;position: relative;height: 40px !important;display: block;padding: 0 0 1px 3px;            margin-bottom: 0;        }
        #radius_container label{display:block;}
        #radius_container label output, #radius_container label input[type="range"]{display:inline-block !important;float:left;}
        #radius_container label input[type="range"]{width: 80%;margin-right: 16px;padding:0;}
    </style>
    <?php // print_r($_GET);?>
    <?php // echo '<hr/>the request'; print_r($_REQUEST);?>
    <form action="foodyyum-listings" method="GET" id="foodyyum-listings">
        <div class="row">
            <div class="col-md-10">
                <div class="row">
                <div class="col-md-4"><input type="text" class="form-control" id="search_title" name="search_title" placeholder="Resturant name" value="<?php echo isset($_GET['search_title']) ? $_GET['search_title'] : ''; ?>"/></div>
                <div class="col-md-4"><input type="text" class="form-control" id="search_zipcode" name="search_zipcode" placeholder="Resturant zipcode" value="<?php echo isset($_GET['search_zipcode']) ? $_GET['search_zipcode'] : ''; ?>"/></div>
                <div class="col-md-4 relative">
                    <input type="text" class="form-control" id="location" name="location" placeholder="All locations" value="<?php echo isset($_GET['location']) ? $_GET['location'] : ''; ?>"/>
                    <div id="target" data-toggle="collapse" data-target="#radius_container"><i class="icon-target5"></i></div>
                    <div id="radius_container_outer" class="">
                        <div id="radius_container" class="collapse">
                            <label>
                                <input type="range" value="<?php echo isset($_GET['search_radius']) ? $_GET['search_radius'] : 20; ?>" min="0" max="4000" oninput="this.nextElementSibling.value=this.value"  name="search_radius" class="">
                                <output><?php echo isset($_GET['search_radius']) ? $_GET['search_radius'] : 20; ?></output>
                                <output>&nbsp;Miles</output>
                            </label> 
                        </div>
                    </div>
                </div>
            </div>
            </div>
            <div class="col-md-2">
                <button type="submit" name="submit" id="submit">Search</button>
                <input type="hidden" class="form-control" id="foodyyums_locations_position" name="foodyyums_locations_position"/>
            </div>
        </div>
        &nbsp;
    </form>
    <script type="text/javascript">
        console.log(navigator.geolocation.getCurrentPosition);
        // Call Map gMapsLatLonPicker Class
        jQuery("#search_radius").keydown(function () {
            initialize();
        });

        function initialize() {
    //        debugger;
            var input = document.getElementById('location');
            var autocomplete = new google.maps.places.Autocomplete(input);
            autocomplete.addListener('place_changed', function () {
    //            debugger;
                var place = autocomplete.getPlace();
                // place variable will have all the information you are looking for.
    //            jQuery('#ez_location_latitude').val(place.geometry['location'].lat());
    //            jQuery('#ez_location_longitude').val(place.geometry['location'].lng());
            });
        }
        //        jQuery(document).on("change", "#myonoffswitch2", function () {
        //
        //            // alert('fsdfsd');
        //            $check = jQuery(this).is(':checked');
        //            if ($check) {
        //                jQuery(".gllpLatlonPicker").each(function () {
        //                    var radius = jQuery(this).data('radius');
        //                    $obj = jQuery(document).gMapsLatLonPicker(radius);
        //                    $obj.init(jQuery(this));
        //                });
        //            } else {
        //                jQuery(".gllpLatlonPicker").each(function () {
        //
        //                    $obj = jQuery(document).gMapsLatLonPicker();
        //                    $obj.init(jQuery(this));
        //                });
        //            }
        //        });
        jQuery(document).ready(function () {
            chosen_selectionbox();

            jQuery(".gllpLatlonPicker").each(function () {
                var radius = jQuery(this).data('radius');
                var show_rad = jQuery(this).data('radiusshow');
                if (show_rad == 'on') {
                    $obj = jQuery(document).gMapsLatLonPicker(radius);
                } else {
                    $obj = jQuery(document).gMapsLatLonPicker();
                }
                $obj.init(jQuery(this));
            });
        });


        function foodbakery_gl_search_map() {
            var vals;
            vals = jQuery('#location').val();
            if (jQuery('#loc_town').length > 0) {
                vals = vals + ", " + jQuery('#loc_town').val();
            }
            if (jQuery('#loc_city').length > 0) {
                vals = vals + ", " + jQuery('#loc_city').val();
            }
            if (jQuery('#loc_state').length > 0) {
                vals = vals + ", " + jQuery('#loc_state').val();
            }
            if (jQuery('#loc_country').length > 0) {
                vals = vals + ", " + jQuery('#loc_country').val();
            }
            jQuery('.gllpSearchField').val(vals);
        }
        //        function foodbakery_fe_search_map() {
        //            var vals;
        //            vals = jQuery('#fe_map<?php //echo absint($field_postfix)                       ?> #location').val();
        //            jQuery('#fe_map<?php // echo absint($field_postfix);                       ?> .gllpSearchField_fe').val(vals);
        //        }

        (function ($) {
            jQuery(function () {
    <?php // $foodbakery_obj->foodbakery_google_place_scripts();                       ?> //var autocomplete;
                autocomplete = new google.maps.places.Autocomplete(document.getElementById('location'));
    <?php // if (isset($selected_iso_code) && !empty($selected_iso_code)) {                       ?>
                //                    autocomplete.setComponentRestrictions({'country': '<?php // echo esc_js($selected_iso_code)                       ?>'});
    <?php // }                       ?>
            });
        })(jQuery);
        jQuery(document).ready(function () {
            var $ = jQuery;
            jQuery("[id^=map_canvas]").css("pointer-events", "none");
            jQuery("[id^=cs-map-location]").css("pointer-events", "none");
            // on leave handle
            var onMapMouseleaveHandler = function (event) {
                var that = jQuery(this);
                that.on('click', onMapClickHandler);
                that.off('mouseleave', onMapMouseleaveHandler);
                jQuery("[id^=map_canvas]").css("pointer-events", "none");
                jQuery("[id^=cs-map-location]").css("pointer-events", "none");
            }
            // on click handle
            var onMapClickHandler = function (event) {
                var that = jQuery(this);
                // Disable the click handler until the user leaves the map area
                that.off('click', onMapClickHandler);
                // Enable scrolling zoom
                that.find('[id^=map_canvas]').css("pointer-events", "auto");
                that.find('[id^=cs-map-location]').css("pointer-events", "auto");
                // Handle the mouse leave event
                that.on('mouseleave', onMapMouseleaveHandler);
            }
            // Enable map zooming with mouse scroll when the user clicks the map
            jQuery('.cs-map-section').on('click', onMapClickHandler);
            // new addition
        });
    </script>
    <?php
    $html = ob_get_clean();
    return $html;
}
