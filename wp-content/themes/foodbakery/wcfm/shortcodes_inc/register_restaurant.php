<?php

add_action("wp_ajax_ez_register_restorant", "ez_register_restorant");

add_action("wp_ajax_nopriv_ez_register_restorant", "ez_register_restorant");

function ez_register_restorant() {
//    echo '<pre>';
//    print_r($_REQUEST);
//    echo '</pre>';
//    die();
    $id_check = false;

//    function generateRandomString($length = 10) {
//        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
//        $charactersLength = strlen($characters);
//        $randomString = '';
//        for ($i = 0; $i < $length; $i++) {
//            $randomString .= $characters[rand(0, $charactersLength - 1)];
//        }
//        return $randomString;
//    }
//    $user_password = generateRandomString();
    $user_password = "Foodyyums@2021";

    $user_id = wp_create_user($_REQUEST['manager_name'], $user_password, $_REQUEST['restorant_email']);
    if ($user_id) {
        $id_check = true;
    }
////
////if (!is_wp_error( $user_id )) {
//// Set the nickname
    $restorant_name = preg_replace('/\s+/', '-', $_REQUEST['restorant_name']);
    wp_update_user(
            array(
                'ID' => $user_id,
                'nickname' => $restorant_name
            )
    );

    update_user_meta($user_id, 'name', $_REQUEST['manager_name']);
    update_user_meta($user_id, 'display_name', $_REQUEST['restorant_name']);

    $parts = explode(" ", $_REQUEST['manager_name']);
    $firstname = $parts[0];
    $lastname = $parts[1];
    update_user_meta($user_id, 'first_name', $firstname);
    update_user_meta($user_id, 'last_name', $lastname);
    update_user_meta($user_id, 'business_name', $_REQUEST['restorant_name']);
    wp_set_password($user_password, $user_id);
//    update_user_meta($user_id, 'user_nicename', $restorant_name);
    wp_update_user(array(
        'ID' => $user_id,
        'user_nicename' => $restorant_name
    ));

    update_user_meta($user_id, 'store_name', $_REQUEST['restorant_name']);
    update_user_meta($user_id, 'wcfmmp_store_name', $_REQUEST['restorant_name']);
    update_user_meta($user_id, 'wcfm_user_location', array('Country' => $_REQUEST['restaurant_country'], 'State' => $_REQUEST['restaurant_state'], 'City' => $_REQUEST['restaurant_city']));



    update_user_meta($user_id, 'wp_capabilities', 'wcfm_vendor');
    update_user_meta($user_id, 'wp_user_level', '6');

    update_user_meta($user_id, '_wcfm_city', $_REQUEST['restaurant_city']);
    update_user_meta($user_id, '_wcfm_state', $_REQUEST['restaurant_state']);
    update_user_meta($user_id, '_wcfm_country', $_REQUEST['restaurant_country']);
//    update_user_meta($user_id, 'restaurant_zipcode', $_REQUEST['restaurant_zipcode']);
    update_user_meta($user_id, 'restorant_phone', $_REQUEST['restorant_phone']);

    update_user_meta($user_id, '_wcfm_store_location', $_REQUEST['EZ_loc_address']);

    update_user_meta($user_id, 'EZ_loc_address', $_REQUEST['EZ_loc_address']);
    update_user_meta($user_id, 'ez_location_longitude_restaurant', $_REQUEST['ez_location_longitude_restaurant']);
    update_user_meta($user_id, '_wcfm_store_lat', $_REQUEST['ez_location_longitude_restaurant']);
    update_user_meta($user_id, 'ez_location_latitude_restaurant', $_REQUEST['ez_location_latitude_restaurant']);
    update_user_meta($user_id, '_wcfm_store_lng', $_REQUEST['ez_location_latitude_restaurant']);


    update_user_meta($user_id, 'restaurant_membership', $_REQUEST['restaurant_membership']);

    update_user_meta($user_id, '_wcfm_billing_first_name', $_REQUEST['billing_firstname']);
    update_user_meta($user_id, 'billing_first_name', $_REQUEST['billing_firstname']);
    update_user_meta($user_id, '_wcfm_billing_last_name', $_REQUEST['billing_lastname']);
    update_user_meta($user_id, 'billing_last_name', $_REQUEST['billing_lastname']);
    update_user_meta($user_id, '_wcfm_billing_phone', $_REQUEST['billing_phone']);
    update_user_meta($user_id, 'billing_phone', $_REQUEST['billing_phone']);
    update_user_meta($user_id, '_wcfm_billing_address_1', $_REQUEST['billing_address']);
    update_user_meta($user_id, 'billing_address_1', $_REQUEST['billing_address']);
    update_user_meta($user_id, '_wcfm_zip', $_REQUEST['restaurant_zipcode']);
    update_user_meta($user_id, 'billing_address', $_REQUEST['billing_address']);
    update_user_meta($user_id, 'billing_email', $_REQUEST['billing_email']);

    update_user_meta($user_id, 'restaurant_cuisines', $_REQUEST['restaurant_cuisines']);
    update_user_meta($user_id, 'restaurant_delivery_or_pickup', $_REQUEST['restaurant_delivery_or_pickup']);

    $wcfmmp_profile_settings = array(
        'store_name' => $_REQUEST['restorant_name'],
        'store_slug' => $restorant_name,
        'store_email' => $_REQUEST['restorant_email'],
        'phone' => $_REQUEST['restorant_phone'],
        'vendor_id' => $user_id,
        'address' => array
            (
            'street_1' => $_REQUEST['EZ_loc_address'],
            'street_2' => '',
            'zip' => $_REQUEST['restaurant_zipcode'],
            'country' => $_REQUEST['restaurant_country'],
            'state' => $_REQUEST['restaurant_state'],
            'city' => $_REQUEST['restaurant_city'],
        ),
        'geolocation' => array(
            'store_location' => $_REQUEST['restaurant_country'],
            'store_lat' => $_REQUEST['ez_location_longitude_restaurant'],
            'store_lng' => $_REQUEST['ez_location_longitude_restaurant']
        ),
        'store_name_position' => 'on_banner',
        'store_ppp' => 10,
        'store_hide_email' => 'no',
        'store_hide_phone' => 'no',
        'store_hide_address' => 'no',
        'store_hide_map' => 'no',
        'store_hide_description' => 'no',
        'store_hide_policy' => 'no',
        'store_location' => $_REQUEST['EZ_loc_address'],
        'store_lat' => $_REQUEST['ez_location_longitude_restaurant'],
        'store_lng' => $_REQUEST['ez_location_longitude_restaurant']
    );
    update_user_meta($info->ID, 'restorant_status', 0);
    update_user_meta($user_id, 'wcfmmp_profile_settings', $wcfmmp_profile_settings);

//
    $user = new WP_User($user_id);
    $user->add_role('wcfm_vendor');

    echo json_encode(array('Status' => true));
    $message = "Your Password is: $user_password.<br/><br/>For further queries please contact us @ info@foodyyums.com. <br/><br/>Thanks.";
    wp_mail($_REQUEST['restorant_email'], "Thank you for registering with Foodyyums", $message);

    exit();
}
