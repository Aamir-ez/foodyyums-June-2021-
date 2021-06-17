<?php
//REGISTRATION PURPOSE
add_shortcode('register_customer_form', 'ez_register_customer_form');

function ez_register_customer_form() {
    ez_scripts();
    ob_start();
    ?>
    <style>
        .ez_form .input-filed field-holder {
            position: relative;
        }
        .ez_form .input-filed.field-holder i, .login-form .input-filed.field-holder span {
            position: absolute;
            left: 12px;
            top: 13px;
            font-size: 16px;
            color: #9097a1;
        }
        .ez_form .input-filed.field-holder input[type="text"], .ez_form .input-filed.field-holder input[type="email"], .ez_form .input-filed.field-holder input[type="password"] {
            border-color: #d1d3d8;
            color: #9097a1;
            border-radius: 3px;
            font-size: 14px;
            height: 42px;
            letter-spacing: 1px;
            margin: 0 0 20px;
            padding: 0 0 0 35px;
            text-transform: unset;
        }
        .btn-submit{display:block !important;width:100% !important;}
        .ajax-signup-button.input-button-loader {            margin: 10px 0 30px 0;        }
        .input-filed.field-holder{position: relative;}
        .input-filed.field-holder [class^="icon"], .input-filed.field-holder [class*=" icon"]{    position: absolute;    left: 12px;    top: 13px;    font-size: 16px;    color: #9097a1;}
    </style>
    <div class="row">
        <div class="col-md-6 ml-auto mr-auto">
            <form method="post" class="wp-user-form demo_test ez_form" id="customer_signup" enctype="multipart/form-data">
                <!--                <div class="input-filed field-holder">
                                    <input type="hidden" name="customer_profile_type" value="buyer">
                                </div>
                                <div class="input-filed field-holder foodyyums-company-name" style="display:none;"><i class="icon-v-card"></i>
                                    <input type="text" placeholder="Company Name" id="customer_company_name" name="customer_company_name">
                                </div>-->
                <div class="input-filed field-holder"><i class="icon-user4"></i>
                    <input type="text" id="customer_first_name" name="customer_first_name" class="required" placeholder="First name">
                    <span class='text-danger error form_field_error'></span>
                </div>
                <div class="input-filed field-holder"><i class="icon-user4"></i>
                    <input type="text" id="customer_last_name" name="customer_last_name" class="required" placeholder="Last name">
                    <span class='text-danger error form_field_error'></span>
                </div>
                <div class="input-filed field-holder"><i class="icon-user4"></i>
                    <input type="text" id="user_login" name="user_login" class="required" placeholder="Username">
                    <span class='text-danger error form_field_error'></span>
                </div>
                <div class="input-filed field-holder">
                    <i class="icon-v-card"></i>
                    <input type="text" id="customer_display_name" name="customer_display_name" class="required" placeholder="Display Name">
                    <span class='text-danger error form_field_error'></span>
                </div>
                <div class="input-filed field-holder"><i class="icon-email"></i>
                    <input type="email" id="customer_user_email" name="Email" class="Email required" placeholder="Email">
                    <span class='text-danger error form_field_error'></span>
                </div>
                <span class="signup-alert">
                    <b>Note :</b> Please enter your correct email and we will send you a password on that email.</span>     
                <div class="checkbox-area field-holder">
                    <input type="checkbox" id="terms" name="terms" class="foodyyums-dev-req-field required" value="1">
                    <span class='text-danger error form_field_error'></span>
                    <label for="terms-">
                        By Registering You Confirm That You Accept The
                        <a target="_blank" href="https://foodyyums.com/contact-us/">
                            Terms &amp; Conditions
                        </a>
                        And
                        <a target="_blank" href="https://foodyyums.com/">
                            Privacy Policy
                        </a>
                    </label>
                </div>
                <input type="hidden" id="customer_user_role_type" class="input-holder" name="customer_user_role_type" value="publisher">
                <div class="side-by-side select-icon clearfix">
                    <div class="select-holder"></div>

                </div>
                <div class="checks-holder">
                    <div class="input-filed field-holder input-field-btn">
                        <div class="ajax-signup-button input-button-loader">
                            <input type="hidden" id="signin-role" name="role" data-role="wp_user_level" value="0"/>
                            <input type="button" tabindex="103" onclick="" class="btn-submit" id="submitbtn" name="user-submit" value="Sign Up">
                        </div>
                    </div>
                    <!--<input type="hidden" name="action" value="customer_registration_validation">-->
                </div>
            </form>
        </div>
    </div>
    <script>
        jQuery(function () {
            let adminAjaxUrl = '<?php echo admin_url('admin-ajax.php'); ?>';
    <?php $nonce = wp_create_nonce("addcate_nonce"); ?>
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
                        jQuery($this).closest('.field-holder').find('.form_field_error')
                                .html('This email has already registered!.').removeClass('hidden').show();
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
            //////////////////////////////////
            jQuery('#submitbtn').on('click', function () {
    //                console.log('clicked!'); debugger;
                let formData = jQuery("#customer_signup").serializeArray();
    //VALIDATION HERE
                let required_fields = jQuery(this).closest('#customer_signup').find('.required');
                let FocusObj;
                if(jQuery("#customer_first_name") == ""){
                    jQuery("#customer_first_name").focus();
                    console.log();
                }
               /* jQuery.each(required_fields, function (i, v) {
                    if (i === "") {
                        FocusObj = this;
                        FocusObj.addClass('not-valid');
                        FocusObj.find('field-holder').closest('form_field_error').html("This field is required!");
                        console.log(FocusObj);
                        return false;
                    } else {
                        jQuery.ajax({
                            url: adminAjaxUrl + '?action=ez_register_customer',
                            type: "Post",
                            dataType: "json",
                            data: formData
                        }).done(function (response) {
                            console.log(response);
                            jQuery("#customer_signup")[0].reset();
                        });
                    }//ends else     
                }); //ends each
                */
            }); //ends customer
        });
    </script>
    <?php
    $formHtml = ob_get_clean();
    echo $formHtml;
}
