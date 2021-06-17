<?php
add_action("wp_ajax_EZ_get_categories_with_menu_items", "EZ_get_categories_with_menu_items");

function EZ_get_categories_with_menu_items() {
    if (isset($_REQUEST['restorant_user_id']) && $_REQUEST['restorant_user_id'] != "") {
        $restorant_auth_id = $_REQUEST['restorant_user_id'];
        $msg = "Now showing menu Of Restorant: " . $_REQUEST['restorant_name'];
    } else {
        $restorant_auth_id = "";
        $msg = "Showing menus from all restorants.";
    }
    ob_start();
    $product_categories = get_terms('product_cat', 'orderby=name&hide_empty=0&parent=0');
    $total_by_author_query = array('post_type' => 'product', 'author' => $restorant_auth_id);
    $total_by_author = new WP_Query($total_by_author_query);
//    print_r($total_by_author);
    if ($total_by_author->post_count == 0) {
        $msg = 0;
    }
//         $author_name = get_post_meta($post->ID, 'author_name', true); 
//    echo 'current user: '. get_current_user_id();//print_r($current_user);
    ?>
    <?php foreach ($product_categories as $category): ?>
        <?php
        $args = array('post_type' => 'product', 'posts_per_page' => -1, 'product_cat' => $category->name,
            'author' => current_user_can('administrator') ? $restorant_auth_id : get_current_user_id());
        $loop = new WP_Query($args);
        ?>
        <div class="row parent_row">
            <div class="parent_category col-md-12 <?= $category->name; ?>">
                <div class="float-left"><i class="fa fa-bars"></i> &nbsp;<?= $category->name; ?></div>
                <div class="float-right" title="Expand"><i class="fa fa-plus red"></i></div>
            </div> 
            <?php
            while ($loop->have_posts()) : $loop->the_post();
                global $product;
//                echo '<pre>'; //print_r($loop);
                $nutrition_info_array = get_post_meta(get_the_ID(), 'nutritional_information', true);
                $product = wc_get_product($loop->post->ID);
                $img = $product->get_image('full');
                ?>
                <div class="col-md-12 mb-3 child-post child-of-<?= $category->name; ?> child-of-<?= $category->term_id; ?>" style="display:none;">
                    <div class="clearfix">&nbsp;</div>
                    <!--<pre><?php // print_r($loop);                              ?></pre>-->
                    <div class="row ml-0 mr-0 middle-items">
                        <div class="col-md-1"><i class="fa fa-bars"></i></div>
                        <div class="col-md-2"><?= $img ?></div>
                        <div class="col-md-5"><h4 class="product-title"><?= $loop->post->post_title; ?></h4><br/><div class="product-information"><?= $loop->post->post_excerpt; ?></div></div>
                        <div class="col-md-2 price-container">   <?php
                            $price_arr = get_post_meta(get_the_ID(), '_price', false);
                            $price = $price_arr['0'];
                            ?>
                            <p><?php echo wc_price($price); ?></p>
                        </div>
                        <!--<div class="col-md-1"></div>-->
                        <div class="col-md-2 menu-item-controls">
                            <a href="javascript:void(0)" class="float-right open-menu-item-edit-form" title="Edit"><i class="fa fa-pencil"></i></a>
                            <a href="javascript:void(0)" class="float-right delete-menu-item" data-id="<?= get_the_ID(); ?>" data-name="<?= $loop->post->post_title; ?>" onclick="ez_delete_menu_item(this)"  title="Remove"><i class="fa fa-times red"></i></a>
                        </div>
                    </div>
                    <div class="row ml-0 mr-0 middle-items edit-menu-item-form-container" style="display:none;">
                        <div class="col-md-12">
                            <form class="form edit-menu-item-form">
                                <div class="field-holder mb-3">
                                    <a class="close-menu-item-form float-right red" id="" type="button" title="Close"><i class="fa fa-times"></i></a>
                                </div>

                                <div class="row ml-0 mr-0">
                                    <div class="col-md-12">
                                        <div class="field-holder">
                                            <div class="mt-2 mb-1"><label for="restaurant-menu">Restaurant Menu</label></div>
                                            <select type="text" name="restaurant_menu" class="form-field required edit_menu_cate_list" id="">
                                                <?php foreach ($product_categories as $cate): ?>
                                                    <option value="<?= $cate->name; ?>" <?= ($category->name == $cate->name) ? 'selected' : ''; ?>><?= $cate->name; ?></option>
                                                <?php endforeach; ?>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="row ml-0 mr-0">
                                    <div class="col-md-4">
                                        <div class="field-holder">
                                            <div class="mt-2 mb-1"><label for="post_title_<?= get_the_ID(); ?>">Title</label></div>
                                            <input type="text" name="post_title" class="form-field required" id="post_title_<?= get_the_ID(); ?>" placeholder="Menu item title" value="<?= $loop->post->post_title; ?>"/>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="field-holder">
                                            <div class="mt-2 mb-1"><label for="_price_<?= get_the_ID(); ?>">Price</label></div>
                                            <input type="text" name="_price" class="form-field required" id="_price_<?= get_the_ID(); ?>" placeholder="Menu item price" value="<?php echo strip_tags($price); ?>"/>
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="field-holder">
                                            <div class="mt-2 mb-1"><label for="food_image_<?= get_the_ID(); ?>">Food Image</label></div>
                                            <input type="file" name="food_image" class="form-field required food_image" id="food_image_<?= get_the_ID(); ?>" onchange="document.getElementById('preview_img_edit_<?= get_the_ID(); ?>').src = window.URL.createObjectURL(this.files[0])"/>
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="field-holder">
                                            <div class="mt-2 mb-1">&nbsp;</div>
                                            <img src="<?= get_the_post_thumbnail_url(get_the_ID()); ?>" class="img-fluid img-thumbnail" id="preview_img_edit_<?= get_the_ID(); ?>"/> 
                                        </div>
                                    </div>
                                </div>

                                <div class="row ml-0 mr-0">
                                    <div class="col-md-12">
                                        <div class="field-holder">
                                            <div class="mt-2 mb-1"><label>Nutritional Information</label></div>
                                            <div class="nutritional_info_container">
                                                <?php $nutritional_info_icons = array('Bnana', 'Egg', 'Chilli', 'Onion', 'Garlic', 'Tomato', 'Lettuce', 'Lactose', 'NoSugar', 'LowFat', 'Milk', 'Fish', 'Beef', 'Mutton', 'Chicken', 'Gluten'); ?>
                                                <?php foreach ($nutritional_info_icons as $nutrition_item): ?>
                                                    <div><?= $nutrition_item; ?>
                                                        <input type="checkbox" name="nutritional_information[]" id="<?= $nutrition_item; ?>" value="<?= $nutrition_item; ?>" class="required nutritional_info_check" title="Contains <?= $nutrition_item; ?>" <?= (in_array($nutrition_item, $nutrition_info_array) ? 'checked' : ''); ?>/>
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
                                            <div class="mt-2 mb-1"><label for="product-description_<?= get_the_ID(); ?>">Description</label></div>
                                            <textarea class="form-field required" name="excerpt" id="excerpt_<?= get_the_ID(); ?>" placeholder="Menu category description"><?= $loop->post->post_excerpt; ?></textarea>
                                        </div>
                                    </div>
                                </div>
                                <input type="hidden" name="post_id" value="<?= get_the_ID(); ?>"/>
                                <div id="extras_<?= get_the_ID(); ?>" class="extras row">
                                    <?php
                                    $menu_item_extras = get_post_meta(get_the_ID(), 'menu_item_extra');
                                    if (!empty($menu_item_extras)) {
//                                    echo '<pre>';  //print_r($menu_item_extras); 
//                                    echo '<hr>';

                                        foreach ($menu_item_extras as $menu_item_extra) {
                                            $n = 1001;
                                            foreach ($menu_item_extra as $item_extra):
//                                            echo $n;
//                                          echo ($item_extra['heading'][0].'<br>-').$item_extra['type'][0].'<br>-'.$item_extra['req'][0];
                                                ?>


                                                <div class="extra_item col-md-11 ml-auto mr-auto">
                                                    <div class="ribbon"><span>Extra</span></div>
                                                    <div class="field-holder mb-3 remove_extra">
                                                        <a onclick="ez_remove_extra_item(this)" class="float-right red" id="close-menu-item-form" type="button" title="Remove">
                                                            <i class="fa fa-times-circle"></i>
                                                        </a>
                                                    </div>
                                                    <div class="row ml-0 mr-0">
                                                        <div class="col-md-4">
                                                            <div class="field-holder item_extras">
                                                                <div class="mt-2 mb-1"><label for="heading_menu_item_extra_">Heading</label></div>
                                                                <input type="text" name="menu_item_extra[<?= $n ?>][heading][]" class="form-field" placeholder="Heading" value="<?= $item_extra['heading'][0]; ?>"/>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-4">
                                                            <div class="field-holder item_extras">
                                                                <div class="mt-2 mb-1"><label for="type_menu_item_extra_">Extra Type</label></div>
                                                                <select type="text" name="menu_item_extra[<?= $n ?>][type][]" class="form-field" value="<?= $item_extra['type'][0]; ?>">
                                                                    <option value="single">Single</option>
                                                                    <option value="multiple">Multiple</option>
                                                                </select>
                                                            </div>
                                                        </div>

                                                        <div class="col-md-4">
                                                            <div class="field-holder item_extras">
                                                                <div class="mt-2 mb-1"><label for="heading_menu_item_required_extra_">Required</label></div>
                                                                <input type="text" name="menu_item_extra[<?= $n ?>][req][]" class="form-field" placeholder="Required?" value="<?= $item_extra['req'][0]; ?>"/>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <?php
                                                    for ($index = 0; $index <= count($item_extra['sub_title']) - 1; $index++):
                                                        ?>
                                                        <div class="row ml-0 mr-0 extra_sub">
                                    <input type="hidden" name="menu_item_extra[<?= $n ?>][product_id][]" value="<?= $item_extra['product_id'][$index]; ?>"/>
                                                            <?php //$sub = rand(0, 50000);        ?>
                                                            <div class="col-md-4">
                                                                <div class="field-holder item_extras">
                                                                    <div class="mt-2 mb-1"><label for="title_menu_item_extra_">Title</label></div>
                                                                    <input type="text" name="menu_item_extra[<?= $n ?>][sub_title][]" class="form-field extra_sub_title" placeholder="Title" value="<?= $item_extra['sub_title'][$index]; ?>"/>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-4">
                                                                <div class="field-holder item_extras">
                                                                    <div class="mt-2 mb-1"><label for="price_menu_item_extra_">Price</label></div>
                                                                    <input type="text" name="menu_item_extra[<?= $n ?>][sub_price][]" class="form-field extra_sub_price" placeholder="Price" value="<?= $item_extra['sub_price'][$index]; ?>"/>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-4">
                                                                <div class="field-holder item_extras">
                                                                    <div class="mt-2 mb-1"><label>&nbsp;</label></div>
                                                                    <button type="button" class="btn btn-outline btn-outline-success" id="" onclick="ez_add_extra_item_sub(this)" title="Add more"><i class="fa fa-plus"></i></button> 
                                                                    <button type="button" class="btn btn-outline btn-outline-danger" id="" onclick="ez_remove_extra_item_sub(this)" title="Remove this"><i class="fa fa-minus"></i></button>                                                    
                                                                </div>
                                                            </div>
                                                        </div><?php endfor; ?>

                                                </div><?php
                                                $n++;
                                            endforeach;
                                            ?>

                                            <?php
                                        }//ends main foreach
                                    }
                                    ?>    
                                </div>
                                <div class="row ml-0 mr-0">
                                    <div class="col-md-6">
                                        <div class="field-holder">
                                            <button onclick="ez_add_menu_extras(this)" id="update_menu_item_extra_<?= get_the_ID(); ?>" class="btn btn-info float-left add_extra" type="button"><i class="fa fa-plus-square"></i> Add Menu Item Extra</button>
                                        </div>     
                                    </div>   
                                    <div class="col-md-6">
                                        <div class="field-holder">
                                            <button onclick="ez_update_menu_item(this)" id="update_menu_item_<?= get_the_ID(); ?>" data-id="<?= get_the_ID(); ?>" class="btn btn-success float-right" type="button"><i class="fa fa-check"></i> Update Menu Item</button>
                                        </div>     
                                    </div>     
                                </div>

                            </form>
                            <div class="clearfix">&nbsp;</div>
                        </div>
                    </div>
                </div>
                <?php
            endwhile;
            wp_reset_query();
            ?>
        </div>    
    <?php endforeach; ?>
    <script>
        jQuery(function () {
            jQuery('.parent_category').off('click').on('click', function () {
                jQuery(this).closest('.row').find('.child-post').toggle('slow');
            });
            //EDIT MENU ITEM FORM TOGGLE
            jQuery('.open-menu-item-edit-form').off('click').on('click', function () {
                console.log('open');
                jQuery(this).closest('.child-post').find('.edit-menu-item-form-container').toggle('slow');
            });
            jQuery('.close-menu-item-form').off('click').on('click', function () {
                console.log('close');
                jQuery(this).closest('.child-post').find('.edit-menu-item-form-container').hide('slow');
            });
        });
    </script>
    <?php
    $html = ob_get_clean();
    echo json_encode(array('Status' => true, 'MSG' => $msg, 'SHtml' => $html));
    exit;
}
