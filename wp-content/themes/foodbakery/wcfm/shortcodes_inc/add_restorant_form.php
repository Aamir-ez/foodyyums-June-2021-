<?php
//REGISTRATION PURPOSE
add_shortcode('register_restaurant_form', 'ez_register_restorant_form');

function ez_register_restorant_form() {
    ez_scripts();
//    ob_start();
    ?>
    <style>
        .tabs-container-main{margin-top:60px}.tabs-container-main{padding:25px 0}.tabs-container-main .row:not(.steps){padding:0 30px}.current{color:#28a745!important}.steps{padding:3rem 0;border-bottom:1px dotted #dedede;margin:0}.stephead{font-size:16px;cursor:pointer;position:relative;margin:0 16%;text-align:center;font-weight:600}.step{border-radius:50%;border:5px double #bcbcbc;padding:6px 12px;position:relative;top:12px;color:#bcbcbc}.step-title{top:29px;position:relative;color:#bcbcbc}.step-title-active{position:relative;top:5px}.step-buttons{margin:2rem 0 1rem 0;padding:2rem 0 1rem 0}.step-buttons button{padding:6px 26px;font-size:15px}.is-invalid{border-color:red!important}.form-control.is-invalid,.form-control.is-valid,.was-validated .form-control:invalid,.was-validated .form-control:valid{background-position:right calc(.375em + 1.9rem) center;background-size:calc(.75em + .9rem) calc(.75em + .9rem)}#loading{position:relative}#loading .loader{top:120px;padding-top:200px;max-height:410px}.thank_you{margin:50px auto;padding:50px 10px}.thank_you h1{font-size:80px!important;margin-bottom:20px}.thank_you h2{font-size:40px!important;margin-bottom:20px}.thank_you .lead{font-size:18px;margin-top:45px;margin-bottom:25px}.links{text-align:center;margin-top:95px}.links p{font-size:16px}.links a{font-size:13px}.final-inner{padding-top:90px!important;padding-bottom:260px!important}.cuisines_container div{float:left;margin-right:35px;line-height:26px;position:relative}.cuisines_container div label{font-size:15px;font-weight:400;position:relative}.cuisines_container div label input{top:2px;position:relative;left:10px}        
    </style>
    <div class="tabs-container-main">

        <!--<div class="row">-->
        <form id="ez_restorant_registration_form" class="ez_restorant_registration_form">
            <fieldset id="step_1">
                <div class="row steps">
                    <div class="col-md-3"><div class="stephead current"><span class="step-active"><i class="fa fa-3x fa-check-circle-o"></i></span><div class="step-title-active">Information</div></div></div>
                    <div class="col-md-3"><div class="stephead"><span class="step">2</span><div class="step-title">Select Package</div></div></div>
                    <div class="col-md-3"><div class="stephead"><span class="step">3</span><div class="step-title">Payment Information</div></div></div>
                    <div class="col-md-3"><div class="stephead"><span class="step">4</span><div class="step-title">Activation</div></div></div>
                </div>
                <div class="row ml-0 mr-0 mt-5 mb-4 clearfix">
                    <div class="col-md-12"><h3>Basic Information</h3></div>
                </div>
                <div class="row ml-0 mr-0">
                    <div class="col-md-6">
                        <div class="field-holder">
                            <div class="mt-2 mb-1"><label for="restorant_name">Restorant name</label></div>
                            <input type="text" name="restorant_name" class="form-control required" id="restorant_name" placeholder="i.e Pizza Hut" value=""/>
                            <span class="text-danger form_field_error hidden"></span>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="field-holder">
                            <div class="mt-2 mb-1"><label for="restorant_phone">Restaurant phone</label></div>
                            <input type="tel" onkeyup="if (/\D/g.test(this.value))
                                        this.value = this.value.replace(/\D/g, '')" name="restorant_phone" class="form-control required" id="restorant_phone" placeholder="i.e +1 3432 549875" value=""/>
                            <span class="text-danger form_field_error hidden"></span>
                        </div>
                    </div>
                </div>
                <div class="row ml-0 mr-0">
                    <div class="col-md-6">
                        <div class="field-holder">
                            <div class="mt-2 mb-1"><label for="manager_name">Manager name</label></div>
                            <input type="text" name="manager_name" class="form-control required" id="manager_name" placeholder="" value=""/>
                            <span class="text-danger form_field_error hidden"></span>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="field-holder">
                            <div class="mt-2 mb-1"><label for="manager_phone">Manager phone</label></div>
                            <input type="tel" onkeyup="if (/\D/g.test(this.value))
                                        this.value = this.value.replace(/\D/g, '')" name="manager_phone" class="form-control required" id="manager_phone" placeholder="i.e +1 3432 549875" value=""/>
                            <span class="text-danger form_field_error hidden"></span>
                        </div>
                    </div>
                </div>
                <div class="row ml-0 mr-0">
                    <div class="col-md-6">
                        <div class="field-holder">
                            <div class="mt-2 mb-1"><label for="restorant_email">Restaurant email</label></div>
                            <input type="email" name="restorant_email" class="form-control Email" id="restorant_email" placeholder="i.e joe@example.com" value=""/>
                            <span class="text-danger form_field_error hidden"></span>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="field-holder">
                            <div class="mt-2 mb-1"><label for="restorant_username">Username</label></div>
                            <input type="text" name="restorant_username" class="form-control required" id="restorant_username" placeholder="Username" value=""/>
                            <span class="text-danger form_field_error hidden"></span>
                        </div>
                    </div>
                </div>

                <div class="row ml-0 mr-0 mt-5 mb-4 clearfix">
                    <div class="col-md-12"><h3>Location</h3></div>
                </div>
                <div class="row ml-0 mr-0">
                    <div class="col-md-6">
                        <div class="field-holder">
                            <div class="mt-2 mb-1"><label for="restaurant_country">Country</label></div>
                            <?php $country_array = array("Afghanistan", "Aland Islands", "Albania", "Algeria", "American Samoa", "Andorra", "Angola", "Anguilla", "Antarctica", "Antigua", "Argentina", "Armenia", "Aruba", "Australia", "Austria", "Azerbaijan", "Bahamas", "Bahrain", "Bangladesh", "Barbados", "Barbuda", "Belarus", "Belgium", "Belize", "Benin", "Bermuda", "Bhutan", "Bolivia", "Bosnia", "Botswana", "Bouvet Island", "Brazil", "British Indian Ocean Trty.", "Brunei Darussalam", "Bulgaria", "Burkina Faso", "Burundi", "Caicos Islands", "Cambodia", "Cameroon", "Canada", "Cape Verde", "Cayman Islands", "Central African Republic", "Chad", "Chile", "China", "Christmas Island", "Cocos (Keeling) Islands", "Colombia", "Comoros", "Congo", "Congo, Democratic Republic of the", "Cook Islands", "Costa Rica", "Cote d'Ivoire", "Croatia", "Cuba", "Cyprus", "Czech Republic", "Denmark", "Djibouti", "Dominica", "Dominican Republic", "Ecuador", "Egypt", "El Salvador", "Equatorial Guinea", "Eritrea", "Estonia", "Ethiopia", "Falkland Islands (Malvinas)", "Faroe Islands", "Fiji", "Finland", "France", "French Guiana", "French Polynesia", "French Southern Territories", "Futuna Islands", "Gabon", "Gambia", "Georgia", "Germany", "Ghana", "Gibraltar", "Greece", "Greenland", "Grenada", "Guadeloupe", "Guam", "Guatemala", "Guernsey", "Guinea", "Guinea-Bissau", "Guyana", "Haiti", "Heard", "Herzegovina", "Holy See", "Honduras", "Hong Kong", "Hungary", "Iceland", "India", "Indonesia", "Iran (Islamic Republic of)", "Iraq", "Ireland", "Isle of Man", "Israel", "Italy", "Jamaica", "Jan Mayen Islands", "Japan", "Jersey", "Jordan", "Kazakhstan", "Kenya", "Kiribati", "Korea", "Korea (Democratic)", "Kuwait", "Kyrgyzstan", "Lao", "Latvia", "Lebanon", "Lesotho", "Liberia", "Libyan Arab Jamahiriya", "Liechtenstein", "Lithuania", "Luxembourg", "Macao", "Macedonia", "Madagascar", "Malawi", "Malaysia", "Maldives", "Mali", "Malta", "Marshall Islands", "Martinique", "Mauritania", "Mauritius", "Mayotte", "McDonald Islands", "Mexico", "Micronesia", "Miquelon", "Moldova", "Monaco", "Mongolia", "Montenegro", "Montserrat", "Morocco", "Mozambique", "Myanmar", "Namibia", "Nauru", "Nepal", "Netherlands", "Netherlands Antilles", "Nevis", "New Caledonia", "New Zealand", "Nicaragua", "Niger", "Nigeria", "Niue", "Norfolk Island", "Northern Mariana Islands", "Norway", "Oman", "Pakistan", "Palau", "Palestinian Territory, Occupied", "Panama", "Papua New Guinea", "Paraguay", "Peru", "Philippines", "Pitcairn", "Poland", "Portugal", "Principe", "Puerto Rico", "Qatar", "Reunion", "Romania", "Russian Federation", "Rwanda", "Saint Barthelemy", "Saint Helena", "Saint Kitts", "Saint Lucia", "Saint Martin (French part)", "Saint Pierre", "Saint Vincent", "Samoa", "San Marino", "Sao Tome", "Saudi Arabia", "Senegal", "Serbia", "Seychelles", "Sierra Leone", "Singapore", "Slovakia", "Slovenia", "Solomon Islands", "Somalia", "South Africa", "South Georgia", "South Sandwich Islands", "Spain", "Sri Lanka", "Sudan", "Suriname", "Svalbard", "Swaziland", "Sweden", "Switzerland", "Syrian Arab Republic", "Taiwan", "Tajikistan", "Tanzania", "Thailand", "The Grenadines", "Timor-Leste", "Tobago", "Togo", "Tokelau", "Tonga", "Trinidad", "Tunisia", "Turkey", "Turkmenistan", "Turks Islands", "Tuvalu", "Uganda", "Ukraine", "United Arab Emirates", "United Kingdom", "United States", "Uruguay", "US Minor Outlying Islands", "Uzbekistan", "Vanuatu", "Vatican City State", "Venezuela", "Vietnam", "Virgin Islands (British)", "Virgin Islands (US)", "Wallis", "Western Sahara", "Yemen", "Zambia", "Zimbabwe"); ?>
                            <select name="restaurant_country" class="form-control required" id="restaurant_country">
                                <option value=""> Select Country </option>
                                <?php foreach ($country_array as $country): ?>
                                    <option value="<?= $country; ?>"><?= $country; ?></option>
                                <?php endforeach; ?>
                            </select>
                            <span class="text-danger form_field_error hidden"></span>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="field-holder">
                            <div class="mt-2 mb-1"><label for="restaurant_zipcode">Zipcode</label></div>
                            <input type="text" name="restaurant_zipcode" class="form-control required" id="restaurant_zipcode"/>
                            <span class="text-danger form_field_error hidden"></span>
                        </div>
                    </div>
                </div>

                <div class="row ml-0 mr-0">
                    <div class="col-md-6">
                        <div class="field-holder">
                            <div class="mt-2 mb-1"><label for="restaurant_state">State</label></div>
                            <!--<select name="restaurant_state" class="form-control required" id="restaurant_state"></select>-->
                            <input type="text" name="restaurant_state" class="form-control required" id="restaurant_state"/>
                            <span class="text-danger form_field_error hidden"></span>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="field-holder">
                            <div class="mt-2 mb-1"><label for="restaurant_city">City</label></div>
                            <input type="text" name="restaurant_city" class="form-control required" id="restaurant_city"/>
                            <span class="text-danger form_field_error hidden"></span>
                        </div>
                    </div>
                </div>

                <div class="row ml-0 mr-0">
                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                        <div class="field-holder">
                            <label>Latitude</label>
                            <input type="text" onkeyup="if (/\D/g.test(this.value))
                                        this.value = this.value.replace(/\D/g, '')" class="form-control gllpLatitude" id="ez_location_latitude" name="ez_location_latitude_restaurant" placeholder="Latitude"/>							</div>
                    </div>
                    <div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
                        <div class="field-holder">
                            <label>Longitude</label>
                            <input type="text" onkeyup="if (/\D/g.test(this.value))
                                        this.value = this.value.replace(/\D/g, '')" class="form-control gllpLongitude" id="ez_location_longitude" name="ez_location_longitude_restaurant" placeholder="Longitude"/>							</div>
                    </div>

                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <!--<input type="hidden" id="foodbakery__loc_bounds_rest" name="foodbakery_loc_bounds_rest_restaurant" value=""><input type="hidden" id="foodbakery_add_new_loc" class="gllpSearchField" style="margin-bottom:10px;" name="foodbakery_add_new_loc_restaurant" value="Mughal Market, Street 49, G-13/2 G 13/2 G-13, Islamabad, Pakistan"><input type="hidden" id="foodbakery_post_loc_zoom" class="gllpZoom" name="foodbakery_post_loc_zoom_restaurant" value="9">-->						
                        <div class="field-holder">
                            <label>Enter Full Address</label>
                            <input type="text" onkeypress="foodbakery_gl_search_map(this.value)" class="foodbakery-search-location pac-target-input required" id="loc_address" name="EZ_loc_address" autocomplete="off" placeholder="Type Your Address">
                        </div>
                    </div>
                </div>
                
                <div class="row ml-0 mr-0">
                    <div class="col-md-12">
                        <div class="field-holder">
                            <div class="mt-2 mb-1"><label for="restaurant_delivery_or_pickup">Delivery/Pickup</label></div>
                            <select name="restaurant_delivery_or_pickup" class="form-control required" id="restaurant_delivery_or_pickup"><option value=""> Select One
                                </option><option value="delivery">Delivery</option><option value="pickup">Pickup</option><option value="delivery_and_pickup">Delivery &amp; Pickup</option></select>
                            <span class="text-danger form_field_error hidden"></span>
                        </div>
                    </div>
                </div>
                <?php
                $product_categories = get_terms('product_cat', 'orderby=name&hide_empty=0&parent=0');
// print_r($product_categories);
                ?>
                <div class="row ml-0 mr-0">
                    <div class="col-md-12">
                        <div class="field-holder">
                            <div class="mt-2 mb-1"><label for="restaurant_cuisines">Cuisines</label></div>
                            <div class="cuisines_container">
                                <?php foreach ($product_categories as $cate): ?>
                                    <div class=""><label><?php echo $cate->name; ?><input type="checkbox" name="restaurant_cuisines[]" class="" value="<?php echo $cate->name; ?>"/></label></div>
                                <?php endforeach; ?>
                                <span class="text-danger form_field_error hidden"></span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row ml-0 mr-0 step-buttons">
                    <div class="col-md-6 col-6">
                        <div class="field-holder">

                        </div>  
                    </div>   
                    <div class="col-md-6 col-6">
                        <div class="field-holder">
                            <button class="btn btn-success float-right next_button" type="button"><i class="fa fa-forward"></i> Next</button>
                        </div>     
                    </div>     
                </div>
            </fieldset>

            <fieldset id="step_2" data-id="2" class="hidden">
                <div class="row steps">
                    <div class="col-md-3"><div class="stephead"><span class="step">1</span><div class="step-title">Information</div></div></div>
                    <div class="col-md-3"><div class="stephead current"><span class="step-active"><i class="fa fa-3x fa-check-circle-o"></i></span><div class="step-title-active">Select Package</div></div></div>
                    <div class="col-md-3"><div class="stephead"><span class="step">3</span><div class="step-title">Payment Information</div></div></div>
                    <div class="col-md-3"><div class="stephead"><span class="step">4</span><div class="step-title">Activation</div></div></div>
                </div>

                <div class="row ml-0 mr-0 mt-5 mb-4 clearfix">
                    <div class="col-md-12"><h3>Buy Membership</h3></div>
                </div>

                <div class="row ml-0 mr-0">
                    <div class="col-md-12">
                        <div class="field-holder">
                            <div class="mt-2 mb-2">
                                <label for="restaurant_membership_free">
                                    <input checked class="validate_it" type="radio" name="restaurant_membership" value="free" id="restaurant_membership_free"/>
                                    Basic(Free)
                                </label>
                            </div>
                            <span class="text-danger form_field_error hidden"></span>
                        </div>
                        <div class="field-holder">
                            <div class="mt-2 mb-2">
                                <label for="restaurant_membership_standard">
                                    <input class="validate_it" type="radio" name="restaurant_membership" value="standard" id="restaurant_membership_standard"/>  
                                    Standard (500)
                                </label>
                            </div><span class="text-danger form_field_error hidden"></span>
                        </div>
                        <div class="field-holder">
                            <div class="mt-2 mb-2">
                                <label for="restaurant_membership_premium">
                                    <input class="validate_it" type="radio" name="restaurant_membership" value="premium" class="required" id="restaurant_membership_premium"/> 
                                    Premium(1000)
                                </label>
                            </div><span class="text-danger form_field_error hidden"></span>
                        </div>
                    </div>
                </div>
                <div class="row ml-0 mr-0 step-buttons">
                    <div class="col-md-6 col-6">
                        <div class="field-holder">
                            <button class="btn btn-success float-left prev_button" type="button"><i class="fa fa-backward"></i> Back</button>
                        </div>  
                    </div>   
                    <div class="col-md-6 col-6">
                        <div class="field-holder">
                            <button class="btn btn-success float-right next_button" type="button"><i class="fa fa-forward"></i> Next</button>
                        </div>     
                    </div>     
                </div>
            </fieldset>


            <fieldset id="step_3" data-id="3" class="hidden">
                <div class="row steps">
                    <div class="col-md-3"><div class="stephead"><span class="step">1</span><div class="step-title">Information</div></div></div>
                    <div class="col-md-3"><div class="stephead"><span class="step">2</span><div class="step-title">Select Package</div></div></div>
                    <div class="col-md-3"><div class="stephead current"><span class="step-active"><i class="fa fa-3x fa-check-circle-o"></i></span><div class="step-title-active">Payment Information</div></div></div>
                    <div class="col-md-3"><div class="stephead"><span class="step">4</span><div class="step-title">Activation</div></div></div>
                </div>
                <div class="row ml-0 mr-0 mt-5 mb-4 clearfix">
                    <div class="col-md-12"><h3>Payment Information</h3></div>
                </div>

                <div class="row ml-0 mr-0">
                    <div class="col-md-6">
                        <div class="field-holder">
                            <div class="mt-2 mb-1"><label for="billing_firstname">First name</label></div>
                            <input type="text" name="billing_firstname" class="form-control required" id="billing_firstname" placeholder="First name" value=""/>
                            <span class="text-danger form_field_error hidden"></span>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="field-holder">
                            <div class="mt-2 mb-1"><label for="billing_lastname">Last name</label></div>
                            <input type="text" name="billing_lastname" class="form-control required" id="billing_lastname" placeholder="Last name" value=""/>
                            <span class="text-danger form_field_error hidden"></span>
                        </div>
                    </div>
                </div>
                <div class="row ml-0 mr-0">
                    <div class="col-md-6">
                        <div class="field-holder">
                            <div class="mt-2 mb-1"><label for="billing_email">Email</label></div>
                            <input type="email" name="billing_email" class="form-control Email" id="billing_email" placeholder="Email" value=""/>
                            <span class="text-danger form_field_error hidden"></span>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="field-holder">
                            <div class="mt-2 mb-1"><label for="billing_phone">Manager phone</label></div>
                            <input type="tel" onkeyup="if (/\D/g.test(this.value))
                                        this.value = this.value.replace(/\D/g, '')" name="billing_phone" class="form-control required" id="billing_phone" placeholder="Phone Number" value=""/>
                            <span class="text-danger form_field_error hidden"></span>
                        </div>
                    </div>
                </div>
                <div class="row ml-0 mr-0">
                    <div class="col-md-12">
                        <div class="field-holder">
                            <div class="mt-2 mb-1"><label for="billing_address">Complete address</label></div>
                            <textarea name="billing_address" class="form-control required" id="billing_address"></textarea>
                            <span class="text-danger form_field_error hidden"></span>
                        </div>
                    </div>
                </div>
                <div class="row ml-0 mr-0 step-buttons">
                    <div class="col-md-6 col-6">
                        <div class="field-holder">
                            <button class="btn btn-success float-left prev_button" type="button"><i class="fa fa-backward"></i> Back</button>
                        </div>  
                    </div>   
                    <div class="col-md-6 col-6">
                        <div class="field-holder">
                            <button class="btn btn-success float-right next_button" type="button"><i class="fa fa-forward"></i> Next</button>

                        </div>     
                    </div>     
                </div>
            </fieldset>
            <fieldset id="step_4" data-id="4" class="hidden">
                <div id="loading">&nbsp;</div>
                <div class="row steps">
                    <div class="col-md-3"><div class="stephead"><span class="step">1</span><div class="step-title">Information</div></div></div>
                    <div class="col-md-3"><div class="stephead"><span class="step">2</span><div class="step-title">Select Package</div></div></div>
                    <div class="col-md-3"><div class="stephead current"><span class="step-active"><i class="fa fa-3x fa-check-circle-o"></i></span><div class="step-title-active">Payment Information</div></div></div>
                    <div class="col-md-3"><div class="stephead"><span class="step">4</span><div class="step-title">Activation</div></div></div>
                </div>
                <div class="row final-inner clearfix">
                    <div class="col-md-12"><h2 class="text-center">Submit all Information</h2></div>
                </div> 

                <div class="row ml-0 mr-0 step-buttons">
                    <div class="col-md-6 col-6">
                        <div class="field-holder">
                            <button class="btn btn-success float-left prev_button" type="button"><i class="fa fa-backward"></i> Back</button>
                        </div>  
                    </div>   
                    <div class="col-md-6 col-6">
                        <div class="field-holder">
                            <button id="register_restorant" class="btn btn-success float-right" type="button"><i class="fa fa-plus-circle"></i> Submit Order </button>

                        </div>     
                    </div>     
                </div>
            </fieldset>
            <fieldset id="step_5" data-id="5" class="hidden">
                <div class="row steps">
                    <div class="col-md-3"><div class="stephead"><span class="step">1</span><div class="step-title">Information</div></div></div>
                    <div class="col-md-3"><div class="stephead"><span class="step">2</span><div class="step-title">Select Package</div></div></div>
                    <div class="col-md-3"><div class="stephead"><span class="step">3</span><div class="step-title">Payment Information</div></div></div>
                    <div class="col-md-3"><div class="stephead current"><span class="step-active"><i class="fa fa-3x fa-check-circle-o"></i></span><div class="step-title-active">Activation</div></div></div>
                </div>
                <div class="row ml-0 mr-0">
                    <div class="col-md-12">
                        <div class="thank_you">
                            <h1 class="text-center text-success"><i class="fa fa-check-circle-o"></i></h1>
                            <h2 class="text-center text-success">Thank You</h2>
                            <p class="text-center lead">You have successfully created your restaurant, to add more details, go to your email inbox for login details.</p>
                            <div class="links">
                                <p class="text-center pb-2">For cancellation or more infomation Please Contact Us</p>
                                <a href=""><i class="fa fa-phone"></i> +1 301 1213 1216</a> |
                                <a href=""><i class="fa fa-fax"></i> +1 202 3239 1216 </a> |
                                <a href=""><i class="fa fa-envelope-o"></i> info@example.com </a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row ml-0 mr-0 step-buttons">
                    <div class="col-md-6 col-6">
                        <div class="field-holder">
                            <!--<button class="btn btn-success float-left prev_button" type="button"><i class="fa fa-backward"></i> Back</button>-->
                        </div>  
                    </div>   
                    <div class="col-md-6 col-6">
                        <div class="field-holder">
                        </div>     
                    </div>     
                </div>
            </fieldset>


        </form>
        <div class="clearfix">&nbsp;</div>
        <!--</div>-->
    </div>
    <!--<script type='text/javascript' src='https://maps.googleapis.com/maps/api/js?key=AIzaSyCAHpcM94Q5WRRfdwMzFSjH6ti14DXw9Og&#038;libraries=places%2Cdrawing&#038;ver=5.6.2' id='google-autocomplete-js'></script>-->
    <script type="text/javascript">
        // Call Map gMapsLatLonPicker Class
        jQuery("#loc_address").keydown(function () {
            initialize();
        });

        function initialize() {
            var input = document.getElementById('loc_address');
            var autocomplete = new google.maps.places.Autocomplete(input);
            autocomplete.addListener('place_changed', function () {
                var place = autocomplete.getPlace();
                // place variable will have all the information you are looking for.
                jQuery('#ez_location_latitude').val(place.geometry['location'].lat());
                jQuery('#ez_location_longitude').val(place.geometry['location'].lng());
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
            vals = jQuery('#loc_address').val();
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
        (function ($) {
            jQuery(function () {
    <?php // $foodbakery_obj->foodbakery_google_place_scripts();                   ?> //var autocomplete;
                autocomplete = new google.maps.places.Autocomplete(document.getElementById('loc_address'));
    <?php // if (isset($selected_iso_code) && !empty($selected_iso_code)) {                   ?>
                //                    autocomplete.setComponentRestrictions({'country': '<?php // echo esc_js($selected_iso_code)                   ?>'});
    <?php // }                   ?>
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

    <script>
    <?php $nonce = wp_create_nonce("addcate_nonce"); ?>
        let adminAjaxUrl = '<?php echo admin_url('admin-ajax.php'); ?>';
        /******=EMPTY FIELDS VALIDATION=***/
        function ez_valid_field(obj) {
            obj.on('keyup', function () {
                obj.removeClass('is-invalid required');
                if (obj.val().length > 3) {
                    obj.addClass('is-valid');
                }
                obj.closest('.field-holder').find('.form_field_error').hide();
            });
            obj.on('change', function () {
                obj.removeClass('is-invalid required');
                if (obj.val().length !== "") {
                    obj.addClass('is-valid');
                }
                obj.closest('.field-holder').find('.form_field_error').hide();
            });
        }


        jQuery(function () {
            /*=============NEXT==================*/
            let NotValid;
            jQuery('.Email').on('keyup', function () {
                jQuery(this).removeClass('is-invalid');
                jQuery('.form_field_error').hide();
            });

            jQuery('.Email').on('blur', function () {
                let $this = jQuery(this);
                let regex = /^([a-zA-Z0-9_\.\-\+])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
                //                console.log(jQuery(this));
                let Email = jQuery(this).val();
                jQuery.ajax({
                    //debugger;
                    url: adminAjaxUrl + '?action=ez_check_email_existance&_wpnonce=<?= $nonce ?>',
                    type: "Post",
                    //dataType: "json",
                    data: {'Email': Email},
                    ascync: false
                }).done(function (response) {
                    if (response == 1) {
                        jQuery($this).closest('.form_field_error').show();
                        jQuery($this).closest('.field-holder').find('.form_field_error').html('There is already a restorant registerd with the provided email!.').removeClass('hidden').show();
                        jQuery($this).addClass('is-invalid');
                        jQuery($this).removeClass('is-valid');
                        jQuery($this).focus();
                        NotValid = true;
                    }
                });

                if (jQuery(this).val() == "") {
                    jQuery(this).closest('.form_field_error').show();
                    jQuery(this).closest('.field-holder').find('.form_field_error').html('Please provide this information.').removeClass('hidden');
                    jQuery(this).addClass('is-invalid');
                    jQuery(this).focus();
                    NotValid = true;
                } else if (!regex.test(jQuery(this).val())) {
                    jQuery(this).closest('.field-holder').find('.form_field_error').show();
                    jQuery(this).closest('.field-holder').find('.form_field_error').html('Please provide a valid email.').removeClass('hidden');
                    jQuery(this).addClass('is-invalid');
                    jQuery(this).focus();
                    NotValid = true;
                } else {
                    jQuery(this).removeClass('is-invalid required');
                    jQuery(this).closest('.field-holder').find('.form_field_error').hide();
                    jQuery(this).addClass('is-valid');
                    NotValid = false;
                }
            });
            jQuery('.next_button').on('click', function () {
                let parent = jQuery(this).closest('fieldset');
                let must_fill = jQuery(this).closest('fieldset').find('.required');
                let FocusObj;
    //debugger;
                jQuery.each(must_fill, function (i, v) {
                    if (i === 0) {
                        FocusObj = this;
                    }
                    jQuery(this).removeClass('is-invalid');
                    jQuery('.form_field_error').hide();
                    if (jQuery('.Email').val() == "") {
                        jQuery('.Email').closest('.form_field_error').show();
                        jQuery('.Email').closest('.field-holder').find('.form_field_error').html('Please provide this information.').removeClass('hidden');
                        jQuery('.Email').addClass('is-invalid');
                        jQuery('.Email').focus();

                        NotValid = true;
                    }

    //                    if (jQuery("#restaurant_cuisines:checked").length ==0) {
    //                        jQuery('.cuisines_container>label').addClass('text-danger');
    //                        jQuery('.form_field_error').show();
    //                        jQuery(this).closest('.field-holder').find('.form_field_error').html('Please provide this information.').removeClass('hidden');
    //                        jQuery(this).addClass('is-invalid');
    //
    //                        NotValid = true;
    //                    }

                    if (jQuery(this).val() == "" || jQuery(this).val() == null) {
                        let this_id = jQuery(this).attr('id');
                        jQuery('.form_field_error').show();
                        jQuery(this).closest('.field-holder').find('.form_field_error').html('Please provide this information.').removeClass('hidden');
                        jQuery(this).addClass('is-invalid');

                        NotValid = true;

                    } else {
                        jQuery(this).removeClass('is-invalid required');
                        jQuery(this).closest('.field-holder').find('.form_field_error').hide();
                        jQuery('html, body').animate({
                            scrollTop: jQuery(".tabs-container-main").offset().top
                        }, 1000);

                        NotValid = false;
                    }

                    ez_valid_field(jQuery(this));
                });
                if (NotValid != true) {
                    //                    debugger;
                    parent.addClass('hidden');
                    parent.next().removeClass('hidden');
                }
                jQuery(FocusObj).focus();
            });
            /*=============PREVIOUS==================*/
            jQuery('.prev_button').on('click', function () {
                let parent = jQuery(this).closest('fieldset');
                parent.addClass('hidden');
                parent.prev().removeClass('hidden');
            });
            /*=============REGISTRATION==================*/
            jQuery('#register_restorant').on('click', function () {
                //                let thisForm = jQuery(this).closest('form');
                //                debugger;
                jQuery('.prev_button').hide();
                $this = this;
                let formData = jQuery(this).closest('form').serializeArray();
                jQuery('#loading').html('<div class="loader"><?php loading(); ?></div>');
                console.log(formData);
                //                debugger;
                //jQuery('html, body').animate({
                //scrollTop: jQuery('.tabs-container-main').offset().top
                //}, 90);
                setTimeout(function () {
                    jQuery.ajax({
                        //debugger;
                        url: adminAjaxUrl + '?action=ez_register_restorant&_wpnonce=<?= $nonce ?>',
                        type: "Post",
                        //dataType: "json",
                        data: formData,
                        ascync: false
                                //                        cache: false,
                                //                        contentType: false,
                                //                        processData: false
                    }).done(function (response) {

                        jQuery('#loading').hide();
                        jQuery('.loader').hide();
                        console.log(response);
                        jQuery('form')[0].reset();
                        //                             console.log(jQuery('form'));
                        //                             alert(jQuery('form'));
                        //                            alert(jQuery('.prev_button'));
                        let parent = jQuery($this).closest('fieldset');
                        parent.addClass('hidden');
                        parent.next().removeClass('hidden');
                    }).error(function (error) {
                        //                        debugger;
                        //                        console.log('error: ' + JSON.stringify(error));
                        jQuery('#loading').hide();
                        jQuery('.loader').remove();
                        jQuery('#loading').html(error).show();
                    }); //ajax done
                }, 500); //settimeout
            });

            jQuery('.main-section .col-lg-8.col-md-8.col-sm-12.col-xs-12').removeClass('col-lg-8').addClass('col-lg-12').removeClass('col-md-8').addClass('col-md-12');

        });
    </script>
    <?php
//    $formHtml = ob_get_clean();
//    return $formHtml;
}
