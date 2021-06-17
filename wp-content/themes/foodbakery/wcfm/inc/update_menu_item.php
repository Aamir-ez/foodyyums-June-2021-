<?php

add_action("wp_ajax_EZ_update_menu_item", "EZ_update_menu_item");

function EZ_update_menu_item() {
//    print_r($_REQUEST); die();
    $current_user = wp_get_current_user();
    $restorant_id = $_REQUEST['restorant']; // != "") ? $_REQUEST['restorant'] : $current_user->ID;

    $post = array(
        'post_author' => $restorant_id,
        'post_content' => $_REQUEST['excerpt'],
        'post_excerpt' => $_REQUEST['excerpt'],
        'post_status' => "publish",
        'post_title' => $_REQUEST['post_title'],
        'post_parent' => '',
        'post_type' => "product",
        'ID' => $_REQUEST['post_id'],
        'post_category' => $_REQUEST['restaurant_menu']
    );
//update post
    $post_id = wp_update_post($post, $wp_error);
    
//print_r($attach_id );exit();
    wp_set_object_terms($post_id, $_REQUEST['restaurant_menu'], 'product_cat');
    wp_set_object_terms($post_id, 'simple', 'product_type');
//wp_set_object_terms( $post_id, $_REQUEST['excerpt'], 'post_excerpt');
    wc_delete_product_transients($post_id);
    update_post_meta($post_id, '_visibility', 'visible');
    update_post_meta($post_id, '_stock_status', 'instock');
    update_post_meta($post_id, 'total_sales', '0');
    update_post_meta($post_id, '_downloadable', 'no');
    update_post_meta($post_id, '_virtual', 'no');
    update_post_meta($post_id, '_regular_price', $_REQUEST['_price']);
//    update_post_meta($post_id, '_sale_price', $_REQUEST['_regular_price']);
    update_post_meta($post_id, '_purchase_note', "");
    update_post_meta($post_id, '_featured', "no");
    update_post_meta($post_id, '_weight', "");
    update_post_meta($post_id, '_length', "");
    update_post_meta($post_id, '_width', "");
    update_post_meta($post_id, '_height', "");
    update_post_meta($post_id, '_sku', "");
    update_post_meta($post_id, '_product_attributes', array());
    update_post_meta($post_id, '_sale_price_dates_from', "");
    update_post_meta($post_id, '_sale_price_dates_to', "");
    update_post_meta($post_id, '_price', $_REQUEST['_price']);
    update_post_meta($post_id, '_sold_individually', "");
    update_post_meta($post_id, '_manage_stock', "no");
    update_post_meta($post_id, '_backorders', "no");
    update_post_meta($post_id, '_stock', "");
//    update_post_meta($post_id, '_thumbnail_id', $attach_id);
    update_post_meta($post_id, 'nutritional_information', $_REQUEST['nutritional_information']);
    
    /*     * *****************
     * MENU ITEM EXTRA**
     * **************** */
    $menu_item_extra = $_REQUEST['menu_item_extra'];
    if ($menu_item_extra != "") {

        foreach ($menu_item_extra as $key => $item_extra) {

            foreach ($item_extra['sub_title'] as $k => $item) {

                if (isset($item_extra['product_id'][$k])) {
                    //product id exists so may need to update name and price
                    $product_id = $item_extra['product_id'][$k];
                    $title = $item_extra['sub_title'][$k];
                    $price = $item_extra['sub_price'][$k];
                    apply_filters('cp_update_extra_item_product', $restorant_id, $product_id, $post_id, $title, $price); //update case
                } else {
                    //Product not exists so need to create it
                    $title = $item_extra['sub_title'][$k];
                    $price = $item_extra['sub_price'][$k];
                    //$product_id = cp_add_extra_item_product_callback($restorant_id, $post_id, $title, $price);
                    $product_id = apply_filters('cp_add_extra_item_product', $restorant_id, $post_id, $title, $price); //add case
                    $menu_item_extra[$key]['product_id'][$k] = $product_id;
                }
            }
        }
        update_post_meta($post_id, 'menu_item_extra', $menu_item_extra);
    }
////////|||=====UPDATE IMAGE UPLOAD======|||\\\\\\\\
    if ($_FILES["file"]["name"] != "" && $_FILES["file"]["name"] != "undefined") {
        $uploaddir = wp_upload_dir();
        $file = $_FILES["file"]["name"];
//     print_r($_FILES); die();
        $uploadfile = $uploaddir['path'] . '/' . basename($file);

        move_uploaded_file($_FILES["file"]["tmp_name"], $uploadfile);
        $filename = basename($uploadfile);

        $wp_filetype = wp_check_filetype(basename($filename), null);

        $attachment = array(
            'post_mime_type' => $wp_filetype['type'],
            'post_title' => preg_replace('/\.[^.]+$/', '', $filename),
            'post_content' => '',
            'post_status' => 'inherit',
            'menu_order' => $_i + 1000
        );
// print_r($attachment ); //die();
        $attach_id = wp_insert_attachment($attachment, $uploadfile);
//    $attach_id = wp_update_attachment_metadata($attachment, $uploadfile);
//        print_r($attach_id ); die();
        set_post_thumbnail($post_id, $attach_id);
        update_post_meta($post_id, '_thumbnail_id', $attach_id);
    }
    echo json_encode(array('Status' => true, 'MSG' => 'Menu item updated.', 'Request' => $_REQUEST));
    exit;
}
