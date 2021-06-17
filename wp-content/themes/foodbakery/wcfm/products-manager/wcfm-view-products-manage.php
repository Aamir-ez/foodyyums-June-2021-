<?php global $wp, $WCFM, $wc_product_attributes; ?>
<div class="collapse wcfm-collapse" id="wcfm_products_manage">

    <?php
    /*     * * * *
     * FOOD MENU
     * * * * * */
    $product_categories = get_terms('product_cat', 'orderby=name&hide_empty=0&parent=0');
    ?><div class="tabs-container-main">
    <?php ez_scripts(); ?>
    <?php $nonce = wp_create_nonce("addcate_nonce"); ?>
        <div class="row">
            <?php
            global $wpdb;
            $restorants = $wpdb->get_results("SELECT * FROM wp_usermeta WHERE meta_key='store_name'");
            ?>
            <div class="col-md-4 float-right mr-0 ml-auto">
                <?php if (current_user_can('administrator')): ?><label>Restorant Menus</label>    
                    <select id="restorants_dd">
                        <option value="">Show All</option>
                        <?php foreach ($restorants as $restorant): ?>
                            <option value="<?= $restorant->user_id ?>"><?= $restorant->meta_value ?></option>
                        <?php endforeach; ?>
                    </select><?php endif; ?>
            </div>
        </div>
        <script>
            var adminAjaxUrl = '<?php echo admin_url('admin-ajax.php'); ?>';
            function GetMenuCategoriesList() {
            jQuery('ul#ez_categoreies_ul').html('<?php loading(); ?>');
            jQuery.ajax({
            url: adminAjaxUrl + '?action=EZ_get_categories_of_menu',
                    type: "post",
                    dataType: "json",
                    async: false
            }).done(function (response) {
            //debugger;
//            console.log(response);
            if (response.Status == true) {
            jQuery('ul#ez_categoreies_ul').html(response.SHtml);
            // FOR LOADING IN MENU ITEMS TAB 
            //console.log(response.category_options_list);
            jQuery('#restaurant_menu').html(response.category_options_list);
            // jQuery('.edit_menu_cate_list').html(response.category_options_list);

            } else {
            alert('Something went wrong, Please try again later!');
            }
            }); //ajax done
            }

            ////////////////////////////////////////////////////////||||||UPDATING CATEGORY|||||||||||||//////////////////////////////////////////////                                 
            function ez_update_category(obj) {
            // debugger;
            var id = jQuery(obj).data('id');
            var data = jQuery(obj).closest('form').find('input,select,textarea').serializeArray();
            var thisForm = jQuery(obj).closest('form');
            // console.log(data);
            jQuery.ajax({
            //debugger;
            url: adminAjaxUrl + '?action=EZ_update_category_of_menu&_wpnonce=<?= $nonce; ?>',
                    type: "Post",
                    dataType: "json",
                    async: false,
                    data: data,
            }).done(function (resp) {
            //console.log(resp);
            GetMenuCategoriesList();
            GetMenuCategoriesList_WithMenuItems();
            ez_successful_response(resp);
            }); //ajax done
            }

            ////////////////////////////////////////////////////////||||||REMOVING CATEGORY|||||||||||||//////////////////////////////////////////////

            function ez_delete_category(obj) { // debugger;
            var d_id = jQuery(obj).data('id');
            var d_name = jQuery(obj).data('name');
            var c = confirm("Are you sure you want to remove " + d_name + "?");
            if (c == true) {
            jQuery.ajax({// debugger;
            url: adminAjaxUrl + '?action=EZ_delete_category_of_menu&_wpnonce=<?= $nonce ?>',
                    type: "Post",
                    dataType: "json",
                    async: false,
                    data: {'id': d_id, 'name': d_name},
            }).done(function (resp) {
            //console.log(resp);
            ez_successful_response(resp);
            GetMenuCategoriesList();
            GetMenuCategoriesList_WithMenuItems();
            }); //ajax done
            }//endsif
            }
            //ENDS REMOVE FUNCT                                      

            ////////////////////////////////////////////////////////||||||LOADING MENU ITEMS WITH CATEGORIES LIST|||||||||||||//////////////////////////////////////////////

            function GetMenuCategoriesList_WithMenuItems() {
            jQuery('#ez_categories_with_food-menu').html('<?php loading(); ?>');
            var restorant_id = jQuery('#restorants_dd').val();
            jQuery.ajax({
            //debugger;
            url: adminAjaxUrl + '?action=EZ_get_categories_with_menu_items',
                    type: "post",
                    dataType: "json",
//                    async: false
                    data: {'restorant_user_id': restorant_id},
//                    beforeSend: ez_loading_func()
            }).done(function (response) {
            // debugger;
//                    console.log(response);
            if (response.Status == true) {
            jQuery('#ez_categories_with_food-menu').html(response.SHtml);
            } else {
            alert('Error loading categories with menu items');
            }
            }); //ajax done
            }

            ////////////////////////////////////////////////////////||||||UPDATING MENU ITEM|||||||||||||//////////////////////////////////////////////                                 
            function ez_update_menu_item(obj) {
            // debugger;
            var id = jQuery(obj).data('id');
<?php if (current_user_can('administrator')): ?>
                if (jQuery('#restorants_dd').val().length == "") {
                ez_menu_item_field_validate('#restorants_dd', 'Please select a restorant.');
                } else
<?php endif; ?>
            // var data = jQuery(obj).closest('form').find('input,select,textarea').serializeArray();
            var thisForm = jQuery(obj).closest('form');
            // var data = jQuery('form.edit-menu-item-form').serializeArray();
            var data = thisForm.serializeArray();
            var file = thisForm.find('.food_image').get(0).files[0];
            var formData = new FormData();
            jQuery(data).each(function (i, field) {
            if (field.value) {
            formData.append(field.name, field.value);
            }
            });
<?php if (current_user_can('administrator')): ?>
                formData.append('restorant', jQuery('#restorants_dd').val());
<?php else: ?>
                formData.append('restorant', <?= get_current_user_id(); ?>);
<?php endif; ?>
            thisForm.prepend('<div class="loader"><?php loading(); ?></div>');
            jQuery('html, body').animate({
            scrollTop: thisForm.offset().top
            }, 90);
            jQuery.ajax({
            url: adminAjaxUrl + '?action=EZ_update_menu_item&_wpnonce=<?= $nonce; ?>',
                    type: "Post",
                    dataType: "json",
                    data: formData,
                    cache: false,
                    contentType: false,
                    processData: false
            }).done(function (resp) {
            jQuery('loader').hide();
            GetMenuCategoriesList();
            GetMenuCategoriesList_WithMenuItems();
            ez_successful_response(resp);
            }); //ajax done
            }//ENDS UPDATE MENU ITEM FUNC
            ////////////////////////////////////////////////////////||||||REMOVING MENU ITEM|||||||||||||//////////////////////////////////////////////

            function ez_delete_menu_item(obj) {
            // debugger;
            var d_id = jQuery(obj).data('id');
            //                                    console.log(d_id);
            var d_name = jQuery(obj).data('name');
            //                                    console.log(d_name);
            var c = confirm("Are you sure you want to remove " + d_name + "?");
            if (c == true) {
            jQuery.ajax({
            // debugger;
            url: adminAjaxUrl + '?action=EZ_delete_menu_item&_wpnonce=<?= $nonce ?>',
                    type: "Post",
                    dataType: "json",
                    async: false,
                    data: {'id': d_id, 'name': d_name},
            }).done(function (resp) {
            //console.log(resp);
            ez_successful_response(resp);
            GetMenuCategoriesList();
            GetMenuCategoriesList_WithMenuItems();
            }); //ajax done
            }
            }
            //ENDS REMOVE MENU ITEM FUNCT

            /**********===MENU ITEM EXTRAS====********/
            var num_forms = 0;
            function ez_add_menu_extras(obj) {
            num_forms++;
            var thisForm = jQuery(obj).closest('form');
            var extras = thisForm.find('.extras');
            var extras_response = jQuery('#extras_response');
            var the_data = {index_num: num_forms};
            jQuery.ajax({
            //debugger;
            url: adminAjaxUrl + '?action=EZ_get_menu_item_extra',
                    type: "post",
                    dataType: "json",
                    data: the_data,
                    async: false
            }).done(function (response) {
            // debugger;
            if (response.Status == true) {
            extras.append(response.SHtml);
            extras_response.append(response.MSG).show("slow").delay(4000).hide("slow");
            } else {
            extras.html('Error loading categories with menu items');
            }
            // console.log(num_forms);
            }); //ajax done
            }//ends menu item extra

            /**********===ADD: MENU ITEM EXTRA Sub====********/
            var sub_index = 1;
            function ez_add_extra_item_sub(obj) {
            sub_index++;
            var parent = jQuery(obj).closest('.extra_item');
            var sub = jQuery(obj).closest('.extra_sub');
            sub.clone().insertAfter(sub).find('input[type=text]').val(''); // EMPTYING ALL CLONED INPUTS
            }

            /* * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * *
             *  * * * = = = = ON LOAD FUNCTIONS | BINDINGS: 
             * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * * */
            jQuery(function () {
            GetMenuCategoriesList();
            GetMenuCategoriesList_WithMenuItems();
            show_hide_act('#open-cate-form', '#close-cate-form', '#add-new-cate-form');
            show_hide_act('#open-menu-item-form', '#close-menu-item-form', '#add-menu-item-form');
            ////////////////////////////////////////////////////////||||||ADDING CATEGORY|||||||||||||//////////////////////////////////////////////

            jQuery('#add_category').on('click', function () {
            // debugger;
            var form_data = jQuery('form#add-new-cate-form').serializeArray();
            // console.log(form_data);
            if (jQuery('#category-name').val().length == "") {
            alert('Please fill the name field!');
            } else {
            jQuery('form#add-new-cate-form').prepend('<div class="loader"><?php loading(); ?></div>');
            jQuery('html, body').animate({
            scrollTop: jQuery("#wcfm_products_manage").offset().top
            }, 90);
            jQuery.ajax({
            //debugger;
            url: adminAjaxUrl + '?action=EZ_add_category_of_menu',
                    type: "Post",
                    dataType: "json",
                    async: false,
                    data: form_data,
            }).done(function (resp) {
            jQuery('.loader').hide();
            jQuery('form#add-new-cate-form')[0].reset();
            jQuery('form#add-new-cate-form').hide();
            GetMenuCategoriesList();
            GetMenuCategoriesList_WithMenuItems();
            ez_successful_response(resp);
            jQuery('#open-cate-form').show('slow');
            }); //ajax done
            }
            }); //on click
            ////////////////////////////////////////////////////////||||||ADDING MENU ITEMS|||||||||||||//////////////////////////////////////////////
            removeHighlightClass('#restorants_dd');
            removeHighlightClass('#restaurant_menu');
            removeHighlightClass('#post_title');
            removeHighlightClass('#menu_item_price');
            removeHighlightClass('#food_image');
            removeHighlightClass('#excerpt');
            jQuery('#add_menu_item').on('click', function () {
<?php if (current_user_can('administrator')): ?>
                if (jQuery('#restorants_dd').val().length == "") {
                ez_menu_item_field_validate('#restorants_dd', 'Please select a restorant.');
                } else <?php endif; ?>if (jQuery('#restaurant_menu').val().length == "") {
            ez_menu_item_field_validate('#restaurant_menu', 'Please select a menu.');
            } else if (jQuery('#post_title').val().length == "") {
            ez_menu_item_field_validate('#post_title', 'Please add menu item name.');
            } else if (jQuery('#menu_item_price').val().length == "") {
            ez_menu_item_field_validate('#menu_item_price', 'Please mention menu item price.');
            } else if (jQuery('#food_image').val().length == "") {
            ez_menu_item_field_validate('#food_image', 'Please upload an image for menu item.');
            } else if (jQuery('#excerpt').val().length == "") {
            ez_menu_item_field_validate('#excerpt', 'Please write some description for this menu item.');
            } else {
            var data = jQuery('form#add-menu-item-form').serializeArray();
            //debugger;
            var file = jQuery('#food_image').get(0).files[0];
            //debugger;
            var formData = new FormData();
            jQuery(data).each(function (i, field) {
            if (field.value) {
            formData.append(field.name, field.value);
            }
            });
            formData.append('file', file);
<?php if (current_user_can('administrator')): ?>
                formData.append('restorant', jQuery('#restorants_dd').val());
<?php else: ?>
                formData.append('restorant', <?= get_current_user_id(); ?>);
<?php endif; ?>
            jQuery('form#add-menu-item-form').prepend('<div class="loader"><?php loading(); ?></div>');
            jQuery('html, body').animate({
            scrollTop: jQuery('.tabs-container-main').offset().top
            }, 90);
            setTimeout(function () {
            jQuery.ajax({
            //debugger;
            url: adminAjaxUrl + '?action=EZ_add_menu_item&_wpnonce=<?= $nonce ?>',
                    type: "Post",
                    dataType: "json",
                    data: formData,
                    cache: false,
                    contentType: false,
                    processData: false
            }).done(function (resp) {
            jQuery('.loader').hide();
            // console.log(resp);
            jQuery('form#add-menu-item-form')[0].reset();
            jQuery('#preview_img').attr('src', '');
            jQuery('form#add-menu-item-form').hide();
            ez_successful_response(resp);
            // GetMenuCategoriesList();
            GetMenuCategoriesList_WithMenuItems();
            jQuery('#open-menu-item-form').show('slow');
            }); //ajax done
            }, 500); //settimeout
            }//ends else if not isFormValid  
            }
            ); //on click
            /*====|RESTORANT BASED MENU|=====*/
            jQuery(document).on('change', '#restorants_dd', function () {
            jQuery('#restorants_dd').removeClass("highlight");
            var restorant_name = jQuery("#restorants_dd option:selected").text();
            var restorant_userId = jQuery(this).val();
            var the_data = {'restorant_user_id': restorant_userId, 'restorant_name': restorant_name};
            jQuery('#ez_categories_with_food-menu').html('<?php loading(); ?>');
            jQuery.ajax({
            //debugger;
            url: adminAjaxUrl + '?action=EZ_get_categories_with_menu_items&_wpnonce=<?= $nonce ?>',
                    type: "Post",
                    dataType: "json",
                    data: the_data
            }).done(function (response) {
//console.log(response);
            if (response.MSG == 0) {
            jQuery('#ez_categories_with_food-menu').html('<h4 class="alert text-danger text-center mt-5 pt-5"><i class="fa fa-info-circle"></i> &nbsp;No Menu items were added for this restorant!</h4>').show("slow");
            return;
            }
            if (response.Status == true) {
            jQuery('#ez_categories_with_food-menu').html(response.SHtml);
            ez_successful_response(response);
            } else {
            alert('Error loading categories with menu items for this restorant!');
            }

            }); // ajax done

            }); //restorants_dd on change

            }
            ); //doc ready
            /**********=== LOADING....====********/
//function ez_loading_func(the_div) {
//    setTimeout(function () {
//        jQuery(the_div).html('<?php loading(); ?>').show();
//        jQuery('form#add-menu-item-form').hide();
//    }, 1000);
//}
        </script>
        <?php ?>
        <div id="response" class="alert"></div>
        <ul class="nav nav-tabs">
            <li class="nav-item">
                <a class="nav-link active" data-toggle="tab" href="#cate">Categories</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" data-toggle="tab" href="#food-menu">Food Menu</a>
            </li>
        </ul>
        <!-- Tab panes -->
        <div class="tab-content">
            <div class="tab-pane container active" id="cate">   
                <?php include_once('add_category_and_list_categories.php'); ?>
            </div>
            <!--    ////////////////    cagtegories list with menu items section  started /////////////////////////////////  -->
            <div class="tab-pane container fade" id="food-menu">
                <?php include_once('add_menu_item_and_list_menu_items.php'); ?>
            </div>
            <!--    ////////////////    cagtegories list with menu items section  ended /////////////////////////////////  -->
        </div>
    </div>
    <!--ends tabs-container-main-->
</div>