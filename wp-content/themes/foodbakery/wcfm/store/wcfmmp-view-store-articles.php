<?php
if (!defined('ABSPATH'))
    exit; // Exit if accessed directly

global $WCFM, $WCFMmp, $post;
?>

<div class="_area" id="book">

    <div class="booking-info-sec">
        <form name="booking-form" id="booking-form" class="booking-form" method="post">
            <div class="row">
                <div class="booking-info">
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <div class="row">
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                <h5>Book This Restaurant</h5>
                                <p class="booking-desc">All kinds of dining experiences are waiting to be discovered. Check out the best restaurants and Book Using following Form.</p>
                            </div>
                            <div class="col-lg-6 col-md-6 col-sm-12 col-xs-12"><div class="field-holder has-icon"><i class="icon icon-user"></i><input type="text" placeholder="First Name" class="input-field foodbakery-dev-req-field" id="first-name" name="first-name"></div></div><div class="col-lg-6 col-md-6 col-sm-12 col-xs-12"><div class="field-holder has-icon"><i class="icon icon-user"></i><input type="text" placeholder="Last Name" class="input-field foodbakery-dev-req-field" id="lastname-booking" name="lastname-booking"></div></div><div class="col-lg-6 col-md-6 col-sm-12 col-xs-12"><div class="field-holder has-icon"><i class="icon icon-envelope2"></i><input type="text" placeholder="Email" class="input-field foodbakery-email-field foodbakery-dev-req-field" id="email-booking" name="email-booking"></div></div><div class="col-lg-6 col-md-6 col-sm-12 col-xs-12"><div class="field-holder has-icon"><i class="icon icon-users3"></i><select class="chosen-select foodbakery-dev-req-field" id="no-of-guests" name="no-of-guests" style="display: none;"><option selected="selected" value="">Guests</option><option value="2-guest">2 Guests</option><option value="4-guest">4 Guests</option><option value="6-guest">6 Guests</option><option value="8-guest">8 Guests</option></select><div class="chosen-container chosen-container-single" style="width: 0px;" title="" id="no_of_guests_chosen"><a class="chosen-single" tabindex="-1"><span>4 Guests</span><div><b></b></div></a><div class="chosen-drop"><div class="chosen-search"><input type="text" autocomplete="off"></div><ul class="chosen-results"><li class="active-result result-selected" style="" data-option-array-index="0">Guests</li><li class="active-result" style="" data-option-array-index="1">2 Guests</li><li class="active-result" style="" data-option-array-index="2">4 Guests</li><li class="active-result" style="" data-option-array-index="3">6 Guests</li><li class="active-result" style="" data-option-array-index="4">8 Guests</li></ul></div></div></div></div><div class="col-lg-6 col-md-6 col-sm-12 col-xs-12"><div class="field-holder has-icon"><div class="date-sec"><i class="icon-event_available"> </i><input type="text" class="form-control booking-date foodbakery-required-field" id="date-of-booking" name="date-of-booking" placeholder="Booking date"><div id="datepicker_1698" class="reservaion-calendar hasDatepicker" style="display: none;"><div class="ui-datepicker-inline ui-datepicker ui-widget ui-widget-content ui-helper-clearfix ui-corner-all" style="display: block;"><div class="ui-datepicker-header ui-widget-header ui-helper-clearfix ui-corner-all"><a class="ui-datepicker-prev ui-corner-all ui-state-disabled" title=""><span class="ui-icon ui-icon-circle-triangle-w"></span></a><a class="ui-datepicker-next ui-corner-all" data-handler="next" data-event="click" title=""><span class="ui-icon ui-icon-circle-triangle-e"></span></a><div class="ui-datepicker-title"><span class="ui-datepicker-month">Apr</span>&nbsp;<span class="ui-datepicker-year">2021</span></div></div><table class="ui-datepicker-calendar"><thead><tr><th scope="col"><span title="Monday">M</span></th><th scope="col"><span title="Tuesday">T</span></th><th scope="col"><span title="Wednesday">W</span></th><th scope="col"><span title="Thursday">T</span></th><th scope="col"><span title="Friday">F</span></th><th scope="col" class="ui-datepicker-week-end"><span title="Saturday">S</span></th><th scope="col" class="ui-datepicker-week-end"><span title="Sunday">S</span></th></tr></thead><tbody><tr><td class=" ui-datepicker-other-month ui-datepicker-unselectable ui-state-disabled undefined"><span class="ui-state-default">29</span></td><td class=" ui-datepicker-other-month ui-datepicker-unselectable ui-state-disabled undefined"><span class="ui-state-default">30</span></td><td class=" ui-datepicker-other-month ui-datepicker-unselectable ui-state-disabled undefined"><span class="ui-state-default">31</span></td><td class=" ui-datepicker-unselectable ui-state-disabled undefined"><span class="ui-state-default">1</span></td><td class=" ui-datepicker-unselectable ui-state-disabled undefined"><span class="ui-state-default">2</span></td><td class=" ui-datepicker-week-end ui-datepicker-unselectable ui-state-disabled undefined"><span class="ui-state-default">3</span></td><td class=" ui-datepicker-week-end ui-datepicker-unselectable ui-state-disabled undefined"><span class="ui-state-default">4</span></td></tr><tr><td class=" ui-datepicker-unselectable ui-state-disabled undefined"><span class="ui-state-default">5</span></td><td class=" ui-datepicker-unselectable ui-state-disabled undefined"><span class="ui-state-default">6</span></td><td class=" ui-datepicker-unselectable ui-state-disabled undefined"><span class="ui-state-default">7</span></td><td class=" ui-datepicker-unselectable ui-state-disabled undefined"><span class="ui-state-default">8</span></td><td class=" ui-datepicker-unselectable ui-state-disabled undefined"><span class="ui-state-default">9</span></td><td class=" ui-datepicker-week-end ui-datepicker-unselectable ui-state-disabled undefined"><span class="ui-state-default">10</span></td><td class=" ui-datepicker-week-end ui-datepicker-unselectable ui-state-disabled undefined"><span class="ui-state-default">11</span></td></tr><tr><td class=" ui-datepicker-unselectable ui-state-disabled undefined"><span class="ui-state-default">12</span></td><td class=" ui-datepicker-unselectable ui-state-disabled undefined"><span class="ui-state-default">13</span></td><td class=" undefined ui-datepicker-today" data-handler="selectDay" data-event="click" data-month="3" data-year="2021"><a class="ui-state-default ui-state-highlight" href="#">14</a></td><td class=" undefined" data-handler="selectDay" data-event="click" data-month="3" data-year="2021"><a class="ui-state-default" href="#">15</a></td><td class=" undefined" data-handler="selectDay" data-event="click" data-month="3" data-year="2021"><a class="ui-state-default" href="#">16</a></td><td class=" ui-datepicker-week-end undefined" data-handler="selectDay" data-event="click" data-month="3" data-year="2021"><a class="ui-state-default" href="#">17</a></td><td class=" ui-datepicker-week-end undefined" data-handler="selectDay" data-event="click" data-month="3" data-year="2021"><a class="ui-state-default" href="#">18</a></td></tr><tr><td class=" undefined" data-handler="selectDay" data-event="click" data-month="3" data-year="2021"><a class="ui-state-default" href="#">19</a></td><td class=" undefined" data-handler="selectDay" data-event="click" data-month="3" data-year="2021"><a class="ui-state-default" href="#">20</a></td><td class=" undefined" data-handler="selectDay" data-event="click" data-month="3" data-year="2021"><a class="ui-state-default" href="#">21</a></td><td class=" undefined" data-handler="selectDay" data-event="click" data-month="3" data-year="2021"><a class="ui-state-default" href="#">22</a></td><td class=" undefined ui-datepicker-current-day" data-handler="selectDay" data-event="click" data-month="3" data-year="2021"><a class="ui-state-default ui-state-active" href="#">23</a></td><td class=" ui-datepicker-week-end undefined" data-handler="selectDay" data-event="click" data-month="3" data-year="2021"><a class="ui-state-default" href="#">24</a></td><td class=" ui-datepicker-week-end undefined" data-handler="selectDay" data-event="click" data-month="3" data-year="2021"><a class="ui-state-default" href="#">25</a></td></tr><tr><td class=" undefined" data-handler="selectDay" data-event="click" data-month="3" data-year="2021"><a class="ui-state-default" href="#">26</a></td><td class=" undefined" data-handler="selectDay" data-event="click" data-month="3" data-year="2021"><a class="ui-state-default" href="#">27</a></td><td class=" undefined" data-handler="selectDay" data-event="click" data-month="3" data-year="2021"><a class="ui-state-default" href="#">28</a></td><td class=" undefined" data-handler="selectDay" data-event="click" data-month="3" data-year="2021"><a class="ui-state-default" href="#">29</a></td><td class=" undefined" data-handler="selectDay" data-event="click" data-month="3" data-year="2021"><a class="ui-state-default" href="#">30</a></td><td class=" ui-datepicker-week-end ui-datepicker-other-month ui-datepicker-unselectable ui-state-disabled undefined"><span class="ui-state-default">1</span></td><td class=" ui-datepicker-week-end ui-datepicker-other-month ui-datepicker-unselectable ui-state-disabled undefined"><span class="ui-state-default">2</span></td></tr></tbody></table></div></div>

                                        <script type="text/javascript">
                                            jQuery(document).ready(function () {
                                                var disabledDays = [""];

                                                jQuery("#datepicker_1698").datepicker({
                                                    showOtherMonths: true,
                                                    firstDay: 1,
                                                    minDate: 0,
                                                    dateFormat: "dd-mm-yy",
                                                    prevText: "",
                                                    nextText: "",
                                                    monthNames: ["Jan", "Feb", "Mar", "Apr", "May", "Jun", "Jul", "Aug", "Sep", "Oct", "Nov", "Dec"],
                                                    beforeShowDay: function (date) {
                                                        var day = date.getDay();
                                                        var string = jQuery.datepicker.formatDate("dd-mm-yy", date);
                                                        var isDisabled = (jQuery.inArray(string, disabledDays) != -1);
                                                        //day != 0 disables all Sundays
                                                        return [!isDisabled];
                                                    },
                                                    onSelect: function (date) {
                                                        jQuery("#date-of-booking").val(date);
                                                        load_available_time(date, '1698');
                                                    }
                                                });
                                            });
                                        </script>
                                        <ul class="calendar-options">
                                            <li class="avilable">Available</li>
                                            <li class="unavailable">Unavailable</li> 
                                        </ul></div></div></div><div class="col-lg-6 col-md-6 col-sm-12 col-xs-12"><div class="field-holder has-icon"><div class="booking_time_wrapper"><div id="time-div-time-date-of-booking" class=""><i class="icon-clock-o"></i><select class="chosen-select input-field" id="time-date-of-booking" name="time-date-of-booking" style="display: none;"><option value="1618370100">03:15 AM</option><option value="1618371000">03:30 AM</option><option value="1618371900">03:45 AM</option><option value="1618372800">04:00 AM</option><option value="1618373700">04:15 AM</option><option value="1618374600">04:30 AM</option><option value="1618375500">04:45 AM</option><option value="1618376400">05:00 AM</option><option value="1618377300">05:15 AM</option><option value="1618378200">05:30 AM</option><option value="1618379100">05:45 AM</option><option value="1618380000">06:00 AM</option><option value="1618380900">06:15 AM</option><option value="1618381800">06:30 AM</option><option value="1618382700">06:45 AM</option><option value="1618383600">07:00 AM</option><option value="1618384500">07:15 AM</option><option value="1618385400">07:30 AM</option><option value="1618386300">07:45 AM</option><option value="1618387200">08:00 AM</option><option value="1618388100">08:15 AM</option><option value="1618389000">08:30 AM</option><option value="1618389900">08:45 AM</option><option value="1618390800">09:00 AM</option><option value="1618391700">09:15 AM</option><option value="1618392600">09:30 AM</option><option value="1618393500">09:45 AM</option><option value="1618394400">10:00 AM</option><option value="1618395300">10:15 AM</option><option value="1618396200">10:30 AM</option><option value="1618397100">10:45 AM</option><option value="1618398000">11:00 AM</option><option value="1618398900">11:15 AM</option><option value="1618399800">11:30 AM</option><option value="1618400700">11:45 AM</option><option value="1618401600">12:00 PM</option><option value="1618402500">12:15 PM</option><option value="1618403400">12:30 PM</option><option value="1618404300">12:45 PM</option><option value="1618405200">01:00 PM</option><option value="1618406100">01:15 PM</option><option value="1618407000">01:30 PM</option><option value="1618407900">01:45 PM</option><option value="1618408800">02:00 PM</option><option value="1618409700">02:15 PM</option><option value="1618410600">02:30 PM</option><option value="1618411500">02:45 PM</option><option value="1618412400">03:00 PM</option><option value="1618413300">03:15 PM</option></select><div class="chosen-container chosen-container-single" style="width: 100%;" title="" id="time_date_of_booking_chosen"><a class="chosen-single" tabindex="-1"><span>03:15 AM</span><div><b></b></div></a><div class="chosen-drop"><div class="chosen-search"><input type="text" autocomplete="off"></div><ul class="chosen-results"></ul></div></div></div></div></div></div><script type="text/javascript">
                                            function load_available_time(date_field, restaurant_id) {
                                                var data = "date_field=" + date_field + "&restaurant_id=" + restaurant_id + "&action=foodbakery_available_restaurant_time&field_id=time-date-of-booking&field_name=time-date-of-booking";
                                                jQuery("#time-div-time-date-of-booking").html("<i class=\"icon-spinner\"></i>");
                                                jQuery("#time-div-time-date-of-booking").addClass("time-loading");
                                                jQuery.ajax({
                                                    type: "POST",
                                                    url: foodbakery_globals.ajax_url,
                                                    dataType: "json",
                                                    data: data,
                                                    success: function (response) {
                                                        jQuery("#time-div-time-date-of-booking").removeClass("time-loading");
//                                                    if(response.status == "false"){ 
//                                                        alert("Restaurant not opened this day, Please choose another day");
//                                                    }
                                                        jQuery("#time-div-time-date-of-booking").html(response.html);
                                                        if (jQuery(".chosen-select, .chosen-select-deselect, .chosen-select-no-single, .chosen-select-no-results, .chosen-select-width").length != "") {
                                                            var config = {
                                                                ".chosen-select": {width: "100%"},
                                                                ".chosen-select-deselect": {allow_single_deselect: true},
                                                                ".chosen-select-no-single": {disable_search_threshold: 4, width: "100%"},
                                                                ".chosen-select-no-results": {no_results_text: "Oops, nothing found!"},
                                                                ".chosen-select-width": {width: "95%"}
                                                            }
                                                            for (var selector in config) {
                                                                jQuery(selector).chosen(config[selector]);
                                                            }
                                                        }
                                                    }
                                                });
                                            }
                            </script><div class="col-lg-12 col-md-12 col-sm-12 col-xs-12"><div class="field-holder has-icon field-textarea"><i class="icon icon-mode_edit"></i> <textarea id="contact-booking" name="contact-booking" class="input-field" placeholder="Your Instructions"></textarea></div></div>					<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                <div class="field-holder">
                                    <div class="submit-btn">
                                        <input type="hidden" id="foodbakery_restaurant_id" name="foodbakery_restaurant_id" value="1698"><input type="hidden" id="foodbakery_restaurant_type_id" name="foodbakery_restaurant_type_id" value="566"><input type="hidden" id="foodbakery_restaurant_publisher" name="foodbakery_restaurant_publisher" value="0"><input type="hidden" id="foodbakery_restaurant_user" name="foodbakery_restaurant_user" value="0"><input type="hidden" id="foodbakery_booking_publisher" name="foodbakery_booking_publisher" value="0"><input type="hidden" id="foodbakery_booking_user" name="foodbakery_booking_user" value="0">						    <button type="button" class="field-btn bgcolor booking-submit-btn input-button-loader" onclick="javascript:foodbakery_booking_submit();">Submit</button>
                                        <span class="booking-loader"></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>

</div>