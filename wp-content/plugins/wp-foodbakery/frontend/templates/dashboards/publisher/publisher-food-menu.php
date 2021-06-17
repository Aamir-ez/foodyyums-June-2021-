<?php
/**
 * Publisher FoodMenus
 *
 */
if (!class_exists('Foodbakery_Publisher_FoodMenus')) {

    class Foodbakery_Publisher_FoodMenus {

        /**
         * Start construct Functions
         */
        public function __construct() {
            add_action('wp_ajax_foodbakery_publisher_food_menu', array($this, 'foodbakery_publisher_foodmenus_callback'));
        }

        public function foodbakery_publisher_foodmenus_callback() {
            global $restaurant_add_counter;

//			$restaurant_add_counter = rand(1000000, 99999999);
//            echo '<pre>';
//            $current_user = wp_get_current_user();
//            print_r($current_user);
//                        echo $current_user['ID'];
//                        echo $current_user['roles'][0];
            $publisher_id = foodbakery_company_id_form_user_id($current_user->ID);
            ?></pre>

            <div class="tabs-container-main">   
                <script src=" https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
                <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
                <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
                <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
                <link rel="stylesheet" href="<?= site_url() ?>/wp-content/plugins/wc-frontend-manager/assets/css/food-menu.css"/>
                <?php // $nonce = wp_create_nonce("addcate_nonce"); ?>
            <?php global $nonce; ?>
                <script>
                    var adminAjaxUrl = '<?php echo admin_url('admin-ajax.php'); ?>';
                    function GetMenuCategoriesList() {
                        jQuery('ul#ez_categoreies_ul').html('<li><h1>Loading...</h1></li>');
                        jQuery.ajax({
                            url: adminAjaxUrl + '?action=EZ_get_categories_of_menu',
                            type: "post",
                            dataType: "json",
                            async: false
                        }).done(function (response) {
                            //debugger;
                            console.log(response);
                            if (response.Status == true) {
                                jQuery('ul#ez_categoreies_ul').html(response.SHtml);
                                // FOR LOADING IN MENU ITEMS TAB 
                                //console.log(response.category_options_list);
                                jQuery('#restaurant_menu').html(response.category_options_list);
                                //                                            jQuery('.edit_menu_cate_list').html(response.category_options_list);

                            } else {
                                alert('Something went wrong');
                            }
                        });//ajax done
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
                            jQuery('#response').html('<i class="fa fa-info-circle"></i> &nbsp;' + resp.MSG).removeClass('alert-danger').addClass('alert-info').show("slow").delay(4000).hide("slow");
                            jQuery('html, body').animate({
                                scrollTop: jQuery("#response").offset().top
                            }, 1000);
                        });//ajax done

                    }

                    ////////////////////////////////////////////////////////||||||REMOVING CATEGORY|||||||||||||//////////////////////////////////////////////

                    function ez_delete_category(obj) {
                        // debugger;
                        var d_id = jQuery(obj).data('id');
                        //                                    console.log(d_id);
                        var d_name = jQuery(obj).data('name');
                        //                                    console.log(d_name);
                        //return;
                        jQuery.ajax({
                            // debugger;
                            url: adminAjaxUrl + '?action=EZ_delete_category_of_menu&_wpnonce=<?= $nonce ?>',

                            type: "Post",
                            dataType: "json",
                            async: false,
                            data: {'id': d_id, 'name': d_name},
                        }).done(function (resp) {
                            //console.log(resp);
                            jQuery('#response').html('<i class="fa fa-info-circle"></i> &nbsp;' + resp.MSG).addClass('alert-danger').show("slow").delay(4000).hide("slow");
                            GetMenuCategoriesList();
                            jQuery('html, body').animate({
                                scrollTop: jQuery("#response").offset().top
                            }, 1000);
                        });//ajax done
                    }
                    //ENDS REMOVE FUNCT                                      

                    ////////////////////////////////////////////////////////||||||LOADING MENU ITEMS WITH CATEGORIES LIST|||||||||||||//////////////////////////////////////////////

                    function GetMenuCategoriesList_WithMenuItems() {
                        jQuery('#ez_categories_with_food-menu').html('<li><h1>Loading...</h1></li>');
                        jQuery.ajax({
                            //debugger;
                            url: adminAjaxUrl + '?action=EZ_get_categories_with_menu_items',
                            type: "post",
                            dataType: "json",
                            async: false
                        }).done(function (response) {
                            // debugger;
                            console.log(response);
                            if (response.Status == true) {
                                jQuery('#ez_categories_with_food-menu').html(response.SHtml);
                            } else {
                                alert('Error loading categories with menu items');
                            }
                        });//ajax done
                    }
                    function show_hide_act(open, close, target) {
                        jQuery(open).on('click', function () {
                            //            debugger;
                            jQuery(target).show('slow');
                            jQuery(this).hide();

                        });
                        //on close hide form
                        jQuery(close).on('click', function () {
                            //            debugger;
                            jQuery(target).hide('slow');
                            jQuery(open).show('slow');
                        });
                    }
                    ////////////////////////////////////////////////////////||||||UPDATING MENU ITEM|||||||||||||//////////////////////////////////////////////                                 
                    function ez_update_menu_item(obj) {
                        // debugger;
                        var id = jQuery(obj).data('id');
                        //                                    var data = jQuery(obj).closest('form').find('input,select,textarea').serializeArray();
                        var thisForm = jQuery(obj).closest('form');
                        //                                    var data = jQuery('form.edit-menu-item-form').serializeArray();
                        var data = thisForm.serializeArray();

                        //debugger;
                        //                                    var file = jQuery('.food_image').get(0).files[0];
                        var file = thisForm.find('.food_image').get(0).files[0];
                        console.log(file);
                        //debugger;
                        //var formData = new FormData().serializeArray();
                        var formData = new FormData();
                        jQuery(data).each(function (i, field) {
                            if (field.value) {
                                formData.append(field.name, field.value);
                            }
                        });
                        //                                     console.log(formData);
                        jQuery.ajax({
                            //debugger;
                            url: adminAjaxUrl + '?action=EZ_update_menu_item&_wpnonce=<?= $nonce; ?>',
                            type: "Post",
                            dataType: "json",
                            data: formData,
                            cache: false,
                            contentType: false,
                            processData: false
                        }).done(function (resp) {
                            //console.log(resp);
                            GetMenuCategoriesList();
                            GetMenuCategoriesList_WithMenuItems();
                            jQuery('#response').html('<i class="fa fa-info-circle"></i> &nbsp;' + resp.MSG).removeClass('alert-danger').addClass('alert-info').show("slow").delay(4000).hide("slow");
                            jQuery('html, body').animate({
                                scrollTop: jQuery("#response").offset().top
                            }, 1000);
                        });//ajax done

                    }//ENDS UPDATE MENU ITEM FUNC
                    ////////////////////////////////////////////////////////||||||REMOVING MENU ITEM|||||||||||||//////////////////////////////////////////////

                    function ez_delete_menu_item(obj) {
                        // debugger;
                        var d_id = jQuery(obj).data('id');
                        //                                    console.log(d_id);
                        var d_name = jQuery(obj).data('name');
                        //                                    console.log(d_name);
                        //return;
                        jQuery.ajax({
                            // debugger;
                            url: adminAjaxUrl + '?action=EZ_delete_menu_item&_wpnonce=<?= $nonce ?>',
                            type: "Post",
                            dataType: "json",
                            async: false,
                            data: {'id': d_id, 'name': d_name},
                        }).done(function (resp) {
                            //console.log(resp);
                            jQuery('#response').html('<i class="fa fa-info-circle"></i> &nbsp;' + resp.MSG).addClass('alert-danger').show("slow").delay(4000).hide("slow");
                            GetMenuCategoriesList();
                            GetMenuCategoriesList_WithMenuItems();
                            jQuery('html, body').animate({
                                scrollTop: jQuery("#response").offset().top
                            }, 1000);
                        });//ajax done
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
                            console.log(response);
                            if (response.Status == true) {
                                extras.append(response.SHtml);

                                extras_response.append(response.MSG).show("slow").delay(4000).hide("slow");

                            } else {
                                extras.html('Error loading categories with menu items');
                            }
                            //                                        console.log(num_forms);
                        });//ajax done
                    }//ends menu item extra
                    /**********=== REMOVE: MENU ITEM EXTRA====********/
                    function ez_remove_extra_item(obj) {
                        var parent = jQuery(obj).closest('.extra_item');
                        parent.remove();
                    }
                    /**********===ADD: MENU ITEM EXTRA Sub====********/
                    var sub_index = 1;
                    function ez_add_extra_item_sub(obj) {
                        sub_index++;
                        var parent = jQuery(obj).closest('.extra_item');
                        var sub = jQuery(obj).closest('.extra_sub');

                        sub.clone().insertAfter(sub).find('input[type=text]').val('');// EMPTYING ALL CLONED INPUTS
                    }
                    //                                var sub_index=1;
                    //                                function ez_add_extra_item_sub(obj) {
                    //                                    sub_index++;
                    //                                    var parent = jQuery(obj).closest('.extra_item');
                    //                                    var sub = jQuery(obj).closest('.extra_sub');
                    //                                            var extrasub_title = sub.find('.extra_sub_title').attr('name');
                    //                                            var updated_extrasub_title = extrasub_title.slice(0, -1) + sub_index;//adding the last number at the end of the name: NEW NAME WITH +1
                    //                                            sub.find('.extra_sub_title').attr('name',updated_extrasub_title);//replace name of the subitemtitle with the increased index;
                    //                                            
                    //                                            var extrasub_price = sub.find('.extra_sub_price').attr('name');
                    //                                             var updated_extrasub_price = extrasub_price.slice(0, -1) + sub_index;
                    //                                          sub.find('.extra_sub_price').attr('name',updated_extrasub_price);
                    //                                    sub.clone().insertAfter(sub).find('input[type=text]').val('');// EMPTYING ALL CLONED INPUTS
                    //                                }
                    /**********=== REMOVE: MENU ITEM EXTRA Sub====********/
                    function ez_remove_extra_item_sub(obj) {
                        var parent = jQuery(obj).closest('.extra_sub');
                        parent.remove();
                    }


                    /* * * *
                     * ON LOAD FUNCTIONS | BINDINGS: 
                     * * * */
                    jQuery(function () {
                        GetMenuCategoriesList();
                        GetMenuCategoriesList_WithMenuItems();
                        show_hide_act('#open-cate-form', '#close-cate-form', '#add-new-cate-form');
                        show_hide_act('#open-menu-item-form', '#close-menu-item-form', '#add-nenu-item-form');

                        ////////////////////////////////////////////////////////||||||ADDING CATEGORY|||||||||||||//////////////////////////////////////////////

                        jQuery('#add_category').on('click', function () {
                            //                                                    debugger;
                            var form_data = jQuery('form#add-new-cate-form').serializeArray();
                            //                                        console.log(form_data);
                            if (jQuery('#category-name').val().length == "") {
                                alert('Please fill the name field!');
                            } else {
                                jQuery.ajax({
                                    //debugger;
                                    url: adminAjaxUrl + '?action=EZ_add_category_of_menu',
                                    type: "Post",
                                    dataType: "json",
                                    async: false,
                                    data: form_data,
                                }).done(function (resp) {
                                    console.log(resp);
                                    jQuery('form#add-new-cate-form')[0].reset();
                                    jQuery('form#add-new-cate-form').hide();
                                    jQuery('#response').html('<i class="fa fa-info-circle"></i> &nbsp;' + resp.MSG).removeClass('alert-danger').addClass('alert-info').show("slow").delay(4000).hide("slow");
                                    GetMenuCategoriesList();
                                    GetMenuCategoriesList_WithMenuItems();
                                    jQuery('html, body').animate({
                                        scrollTop: jQuery("#response").offset().top
                                    }, 1000);
                                    jQuery('#open-cate-form').show('slow');
                                });//ajax done
                            }
                        });//on click


                        ////////////////////////////////////////////////////////||||||ADDING MENU ITEMS|||||||||||||//////////////////////////////////////////////

                        jQuery('#add_menu_item').on('click', function () {

            //                                        var isFormValid;// = true;
            //                                        jQuery("#add-new-cate-form").find(".required").each(function () {
            //                                            //debugger;
            //                                            if (jQuery(this).val().length == "") {
            //                                                jQuery(this).addClass("highlight");
            //                                                isFormValid = false;
            //                                                //jQuery(this).focus();
            //
            //                                            } else {
            //                                                jQuery(this).removeClass("highlight");
            //                                                isFormValid = true;
            //                                            }
            //                                        });
            //
            //                                        if (isFormValid == false) {
            //                                            jQuery('#response').html('<i class="fa fa-info-circle"></i> &nbsp;Please fill in all the required fields.').addClass('alert-danger').show("slow").delay(4000).hide("slow");
            //                                            jQuery('html, body').animate({
            //                                                scrollTop: jQuery("#response").offset().top
            //                                            }, 1000);
            //                                            //         
            //                                        } else {

                            var data = jQuery('form#add-nenu-item-form').serializeArray();
                            //debugger;
                            var file = jQuery('#food_image').get(0).files[0];
                            //debugger;
                            //var formData = new FormData().serializeArray();
                            var formData = new FormData();
                            jQuery(data).each(function (i, field) {
                                if (field.value) {
                                    formData.append(field.name, field.value);
                                }
                            });
                            formData.append('file', file);
                            console.log(formData);
                            //                                             console.log('Form Data: '+formData);
                            //                                            return;
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
                                // console.log(resp);
                                jQuery('form#add-nenu-item-form')[0].reset();
                                jQuery('#preview_img').attr('src', '');
                                jQuery('form#add-nenu-item-form').hide();
                                jQuery('#response').html('<i class="fa fa-info-circle"></i> &nbsp;' + resp.MSG).removeClass('alert-danger').addClass('alert-info').show("slow").delay(4000).hide("slow");
                                jQuery('html, body').animate({
                                    scrollTop: jQuery(".tabs-container-main").offset().top
                                }, 1000);
                                //                                            GetMenuCategoriesList();
                                GetMenuCategoriesList_WithMenuItems();
                                jQuery('#open-menu-item-form').show('slow');
                            });//ajax done
                            //}//ends else if not isFormValid  
                        });//on click


                    });//doc ready
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
                        <div class="add-new">
                            <div class="field-holder">
                                <button class="btn btn-success float-right" type="button" id="open-cate-form"><i class="fa fa-plus"></i> Add Category </button>
                            </div>
                            <form id="add-new-cate-form" class="form" style="display:none;">
                                <div class="field-holder">
                                    <a class=" float-right red" id="close-cate-form" type="button"><i class="fa fa-times"></i></a>
                                </div>
                                <div class="field-holder">
                                    <div class="mt-2 mb-1"><label for="category-category">Category</label></div>
                                    <input required="required" type="text" name="category-name" class="form-field required" id="category-name" placeholder="Menu Category title" value=""/>
                                </div>
                                <div class="field-holder">
                                    <div class="mt-2 mb-1"><label for="category-description">Description</label></div>
                                    <textarea class="form-field" name="category-description" id="category-description" placeholder="Menu category description"></textarea>
                                </div>
                                <div class="field-holder">
                                    <button id="add_category" class="btn btn-success float-right" type="button"><i class="fa fa-plus-circle"></i> Save Category </button>
                                </div>
                            </form>
                        </div>
                        <div class="clearfix">&nbsp;</div>

                        <!--    ////////////////    cagtegories list section  started /////////////////////////////////  -->
                        <ul id="ez_categoreies_ul"></ul>
                        <!--    ////////////////    cagtegories list section  ended /////////////////////////////////  -->
                    </div>
                    <!--    ////////////////    cagtegories list with menu items section  started /////////////////////////////////  -->
                    <div class="tab-pane container fade" id="food-menu">

                        <div class="field-holder mb-3">
                            <button class="btn btn-success float-right mb-4" type="button" id="open-menu-item-form"><i class="fa fa-plus"></i> Add Menu Item </button>
                        </div>
                        <form id="add-nenu-item-form" class="form" style="display: none;">
                            <div class="field-holder mb-3">
                                <a class=" float-right red" id="close-menu-item-form" type="button" title="Close"><i class="fa fa-times"></i></a>
                            </div>

                            <div class="row">
                                <div class="col-md-12">
                                    <div class="field-holder">
                                        <div class="mt-2 mb-1"><label for="restaurant-menu">Restaurant Menu</label></div>
                                        <select type="text" name="restaurant_menu" class="form-field required" id="restaurant_menu"></select>
                                    </div>
                                </div>
                            </div>
                            <div class="row ml-0 mr-0">
                                <div class="col-md-4">
                                    <div class="field-holder">
                                        <div class="mt-2 mb-1"><label for="post_title">Title</label></div>
                                        <input type="text" name="post_title" class="form-field required" id="post_title" placeholder="Menu item title" value=""/>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="field-holder">
                                        <div class="mt-2 mb-1"><label for="_price">Price</label></div>
                                        <input type="text" name="_price" class="form-field required" id="_price" placeholder="Menu item price" value=""/>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="field-holder">
                                        <div class="mt-2 mb-1"><label for="food_image">Food Image</label></div>
                                        <input type="file" name="food_image" class="form-field required" id="food_image" size="24" onchange="document.getElementById('preview_img').src = window.URL.createObjectURL(this.files[0])"/>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="field-holder">
                                        <div class="mt-2 mb-1">&nbsp;</div>
                                        <img src="#" class="img-fluid img-thumbnail" id="preview_img"/> 
                                    </div>
                                </div>
                            </div>

                            <div class="row ml-0 mr-0">
                                <div class="col-md-12">
                                    <div class="field-holder">
                                        <div class="mt-2 mb-1"><label for="">Nutritional Information</label></div>
                                        <div class="nutritional_info_container">
                                            <?php $nutritional_info_icons = array('Bnana', 'Egg', 'Chilli', 'Onion', 'Garlic', 'Lettuce', 'Tomato', 'Lactose', 'NoSugar', 'LowFat', 'Milk', 'Fish', 'Beef', 'Mutton', 'Chicken', 'Gluten'); ?>
                                            <?php foreach ($nutritional_info_icons as $nutrition_item): ?>
                                                <div><?= $nutrition_item; ?>
                                                    <input type="checkbox" name="nutritional_information[]" id="<?= $nutrition_item; ?>" value="<?= $nutrition_item; ?>" class="nutritional_info_check" title="Contains <?= $nutrition_item; ?>"/>
                                                    <!--<img src="<?= $nutrition_item_icon_url; ?>" class="nutritional_info_icon"/>-->
                                                </div>
                                            <?php endforeach; ?>
                                        </div>
                                    </div>
                                </div>                                          
                            </div>

                            <div class="row ml-0 mr-0">
                                <div class="col-md-12">
                                    <div class="field-holder">
                                        <div class="mt-2 mb-1"><label for="product-description">Description</label></div>
                                        <textarea class="form-field required" name="excerpt" id="excerpt" placeholder="Menu category description"></textarea>
                                    </div>
                                </div>
                            </div>
                            <div id="extras_new" class="extras row">
                                <div id="extras_response" class="alert alert-success" style="display: none;"></div>
                            </div>
                            <div class="row ml-0 mr-0">
                                <div class="col-md-6">
                                    <div class="field-holder">
                                        <button onclick="ez_add_menu_extras(this)" id="add_menu_item_extra" class="btn btn-info float-left add_menu_item_extra" type="button"><i class="fa fa-plus-square"></i> Add Menu Item Extra</button>
                                    </div>     
                                </div>   
                                <div class="col-md-6">
                                    <div class="field-holder">
                                        <button id="add_menu_item" class="btn btn-success float-right" type="button"><i class="fa fa-plus-circle"></i> Save Menu Item</button>
                                    </div>     
                                </div>     
                            </div>

                        </form>
                        <div class="clearfix">&nbsp;</div>
                        <div id="ez_categories_with_food-menu"></div>
                        <div class="clearfix">&nbsp;</div>

                    </div>
                    <!--    ////////////////    cagtegories list with menu items section  ended /////////////////////////////////  -->
                </div>
            </div>

            <?php
            die;
        }

    }

    global $publisher_foodmenus;
    $publisher_foodmenus = new Foodbakery_Publisher_FoodMenus();
}
?>

