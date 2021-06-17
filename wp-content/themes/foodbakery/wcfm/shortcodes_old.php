<?php

//REGISTRATION PURPOSE
add_shortcode('register_restorant', 'ez_register_restorant');

function ez_register_restorant() {
    ez_scripts();
    ?>
    <style>
        .current{color: #28a745 !important;}
        .steps {
            padding: 4rem 0;
            box-shadow: 0px 6px 38px -6px #EEE;
            margin: 0 0 4rem 0;
        }
        .stephead {
            font-size: 16px;
            cursor: pointer;
            position: relative;
            margin: 0px 16%;
            text-align: center;
            font-weight: 600;
        }.step {
            border-radius: 50%;
            border: 5px double #BCBCBC;
            padding: 6px 12px;
            position: relative;
            top: 12px;
            color: #BCBCBC;
        }.step-title {
            top: 29px;
            position: relative;color: #BCBCBC;
        }.step-title-active {
            position: relative;
            top: 5px;
        }
        .step-buttons{margin:2rem 0 1rem 0;padding:2rem 0 1rem 0;}
        .step-buttons button{padding: 6px 26px;font-size: 15px;}
        .is-invalid{border-color:red !important;}
        .form-control.is-invalid, .was-validated .form-control:invalid {
            border-color: #dc3545;
            background-position: right calc(0.375em + 1.9rem) center;
            background-size: calc(.75em + .9rem) calc(.75em + .9rem);
        }
    </style>
    <div class="tabs-container-main">
        <div class="row steps">
            <div class="col-md-3"><div class="stephead current"><span class="step-active"><i class="fa fa-3x fa-check-circle-o"></i></span><div class="step-title-active">Information</div></div></div>
            <div class="col-md-3"><div class="stephead"><span class="step">2</span><div class="step-title">Select Package</div></div></div>
            <div class="col-md-3"><div class="stephead"><span class="step">3</span><div class="step-title">Payment Information</div></div></div>
            <div class="col-md-3"><div class="stephead"><span class="step">4</span><div class="step-title">Activation</div></div></div>
        </div>
        <!--<div class="row">-->
        <form id="ez_restorant_registration_form" class="ez_restorant_registration_form">
            <fieldset id="step_1" data-id="1" class="pt-5 pb-5">
                <div class="row ml-0 mr-0">
                    <div class="col-md-6">
                        <div class="field-holder">
                            <div class="mt-2 mb-1"><label for="restorant_name">Restorant name</label></div>
                            <input type="text" name="restorant_name" class="form-control required" id="manager_name" placeholder="i.e Pizza Hut" value=""/>
                            <span class="text-danger form_field_error hidden"></span>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="field-holder">
                            <div class="mt-2 mb-1"><label for="restorant_phone">Restaurant phone</label></div>
                            <input type="text" name="restorant_phone" class="form-control required" id="restorant_phone" placeholder="i.e +1 3432 549875" value=""/>
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
                            <input type="text" name="manager_phone" class="form-control required" id="manager_phone" placeholder="i.e +1 3432 549875" value=""/>
                            <span class="text-danger form_field_error hidden"></span>
                        </div>
                    </div>
                </div>
                <div class="row ml-0 mr-0">
                    <div class="col-md-6">
                        <div class="field-holder">
                            <div class="mt-2 mb-1"><label for="restorant_email">Restaurant email</label></div>
                            <input type="email" name="restorant_email" class="form-control required" id="restorant_email" placeholder="i.e joe@example.com" value=""/>
                            <span class="text-danger form_field_error hidden"></span>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="field-holder">
                            <div class="mt-2 mb-1"><label for="payment_username">Username</label></div>
                            <input type="text" name="payment_username" class="form-control required" id="payment_username" placeholder="Username" value=""/>
                            <span class="text-danger form_field_error hidden"></span>
                        </div>
                    </div>
                </div>
                <div class="row ml-0 mr-0">
                    <h4>Location</h4>

                </div>

                <div class="row ml-0 mr-0">
                    <div class="col-md-12">
                        <div class="field-holder">
                            <div class="mt-2 mb-1"><label for="restaurant_country">Country</label></div>
                            <select name="restaurant_country" class="form-control required" id="restaurant_country"></select>
                            <span class="text-danger form_field_error hidden"></span>
                        </div>
                    </div>
                </div>

                <div class="row ml-0 mr-0">
                    <div class="col-md-6">
                        <div class="field-holder">
                            <div class="mt-2 mb-1"><label for="restaurant_state">State</label></div>
                            <select name="restaurant_state" class="form-control required" id="restaurant_state"></select>
                            <span class="text-danger form_field_error hidden"></span>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="field-holder">
                            <div class="mt-2 mb-1"><label for="restaurant_city">City</label></div>
                            <select name="restaurant_city" class="form-control required" id="restaurant_city"></select>
                            <span class="text-danger form_field_error hidden"></span>
                        </div>
                    </div>
                </div>

                <div class="row ml-0 mr-0">
                    <div class="col-md-12">
                        <div class="field-holder">
                            <div class="mt-2 mb-1"><label for="restaurant_address">Complete address</label></div>
                            <textarea name="restaurant_address" class="form-control required" id="restaurant_address"></textarea>
                            <span class="text-danger form_field_error hidden"></span>
                        </div>
                    </div>
                </div>

                <div class="row ml-0 mr-0">
                    <div class="col-md-12">
                        <div class="field-holder">
                            <div class="mt-2 mb-1"><label for="restaurant_delivery_or_pickup">Delivery/Pickup</label></div>
                            <select name="restaurant_delivery_or_pickup" class="form-control required" id="restaurant_delivery_or_pickup"></select>
                            <span class="text-danger form_field_error hidden"></span>
                        </div>
                    </div>
                </div>

                <div class="row ml-0 mr-0">
                    <div class="col-md-12">
                        <div class="field-holder">
                            <div class="mt-2 mb-1"><label for="restaurant_suisines">Cuisines</label></div>
                            <select name="restaurant_suisines" class="form-control required" id="restaurant_suisines"></select>
                            <span class="text-danger form_field_error hidden"></span>
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

            <fieldset id="step_2" data-id="2" class="pt-5 pb-5 hidden">

                <div class="row ml-0 mr-0">
                    <div class="col-md-12">
                        <h4>
                            Buy Membership
                        </h4>
                    </div>
                </div>

                <div class="row ml-0 mr-0">
                    <div class="col-md-12">
                        <div class="field-holder">
                            <div class="mt-2 mb-2"><label for="restaurant_membership_free"><input type="radio" name="restaurant_membership" value="free" class="" id="restaurant_membership_free"> Basic(Free)</label>
                            </div>
                            <span class="text-danger form_field_error hidden"></span>
                        </div>
                        <div class="field-holder">
                            <div class="mt-2 mb-2"><label for="restaurant_membership_standard"><input type="radio" name="restaurant_membership" value="standard" class="" id="restaurant_membership_standard">  Standard (500)</label>
                            </div><span class="text-danger form_field_error hidden"></span>
                        </div>
                        <div class="field-holder">
                            <div class="mt-2 mb-2"><label for="restaurant_membership_premium"> <input type="radio" name="restaurant_membership" value="premium" class="" id="restaurant_membership_premium"> Premium(1000)</label>
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


            <fieldset id="step_3" data-id="3" class="pt-5 pb-5 hidden">
                <div class="row ml-0 mr-0">
                    <div class="col-md-12">
                        <h4>Payment Information</h4>
                    </div>
                </div>

                <div class="row ml-0 mr-0">
                    <div class="col-md-6">
                        <div class="field-holder">
                            <div class="mt-2 mb-1"><label for="payment_firstname">First name</label></div>
                            <input type="text" name="payment_firstname" class="form-control required" id="payment_firstname" placeholder="First name" value=""/>
                            <span class="text-danger form_field_error hidden"></span>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="field-holder">
                            <div class="mt-2 mb-1"><label for="payment_lastname">Last name</label></div>
                            <input type="text" name="payment_firstname" class="form-control required" id="payment_firstname" placeholder="Last name" value=""/>
                            <span class="text-danger form_field_error hidden"></span>
                        </div>
                    </div>
                </div>
                <div class="row ml-0 mr-0">
                    <div class="col-md-6">
                        <div class="field-holder">
                            <div class="mt-2 mb-1"><label for="payment_email">Email</label></div>
                            <input type="email" name="payment_email" class="form-control required" id="payment_email" placeholder="Email" value=""/>
                            <span class="text-danger form_field_error hidden"></span>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="field-holder">
                            <div class="mt-2 mb-1"><label for="payment_phone">Manager phone</label></div>
                            <input type="text" name="payment_phone" class="form-control required" id="payment_phone" placeholder="Phone Number" value=""/>
                            <span class="text-danger form_field_error hidden"></span>
                        </div>
                    </div>
                </div>
                <div class="row ml-0 mr-0">
                    <div class="col-md-12">
                        <div class="field-holder">
                            <div class="mt-2 mb-1"><label for="payment_address">Complete address</label></div>
                            <textarea name="payment_address" class="form-control required" id="payment_address"></textarea>
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
            <fieldset id="step_4" data-id="4" class="pt-5 pb-5 hidden">
                <div class="row ml-0 mr-0">
                    <div class="col-md-12">
                        <div class="ml-auto mr-auto">
                            <h1 class="text-center text-success"><i class="fa fa-check-circle-o"></i></h1>
                            <h2 class="text-center text-success">Thank You</h2>
                            <p class="text-center lead">You have successfully created your restaurant, to add more details, go to your email inbox for login details.</p>
                            <div class="text-center mt-4">
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
                            <button class="btn btn-success float-left prev_button" type="button"><i class="fa fa-backward"></i> Back</button>
                        </div>  
                    </div>   
                    <div class="col-md-6 col-6">
                        <div class="field-holder">
                            <button id="add_restorant_info" class="btn btn-success float-right" type="button"><i class="fa fa-plus-circle"></i> Submit Order </button>
                        </div>     
                    </div>     
                </div>
            </fieldset>


        </form>
        <div class="clearfix">&nbsp;</div>
        <!--</div>-->
    </div>
    <script>
        jQuery(function () {
            jQuery('.next_button').on('click', function () {
                let must_fill = jQuery(this).closest('fieldset').find('.required');
                let FocusObj;
                jQuery.each(must_fill, function (i, v) {
                    if (i === 0) {
                        FocusObj = this;
                    }
                    jQuery(this).removeClass('is-invalid');
                    jQuery('.form_field_error').hide();

                    if (jQuery(this).val() == "" || jQuery(this).val() == null) {
                        let this_id = jQuery(this).attr('id');
                        jQuery('.form_field_error').show();
                        jQuery(this).closest('.field-holder').find('.form_field_error').html('Please provide this information.').removeClass('hidden');
                        jQuery(this).addClass('is-invalid');
                    } else {
                        jQuery(this).removeClass('is-invalid required');
                        jQuery(this).closest('.field-holder').find('.form_field_error').remove();
                    }
                    jQuery(this).on('keyup', function () {
                        jQuery(this).removeClass('is-invalid required');
                        if (jQuery(this).val().length > 4) {
                            jQuery(this).addClass('is-valid');
                        }
                        jQuery(this).closest('.field-holder').find('.form_field_error').remove();
                    });

                });

                jQuery(FocusObj).focus();
            });

        });
    </script>
    <?php

    echo '<pre>';
    $search = "Pakistan";
    $decode_data = file_get_contents(get_template_directory() . "/wcfm/countries+states+cities.json");
    $all_data = json_decode($decode_data);
    foreach ($all_data as $single) {
//        echo $single->name;
//        print_r($single);
        if ($single->name == $search) {
            print_r($single->states);
//            count($single->states[0]);
//            sizeof($single->states[0]);
//            foreach ($single->states as $state) {
//                print_r("<li>$state</li>");
//            }
        }
//        print_r($single->states);
    }
}
