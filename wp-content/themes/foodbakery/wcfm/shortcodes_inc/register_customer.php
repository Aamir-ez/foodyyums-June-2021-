<?php

/*
 * 
 */

add_action("wp_ajax_ez_register_customer", "ez_register_customer");

add_action("wp_ajax_nopriv_ez_register_customer", "ez_register_customer");

function ez_register_customer() {
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

    $user_id = wp_create_user($_REQUEST['customer_first_name'], $user_password, $_REQUEST['Email']);
    if ($user_id) {
        $id_check = true;
    }
////
////if (!is_wp_error( $user_id )) {
//// Set the nickname
    $restorant_name = preg_replace('/\s+/', '-', $_REQUEST['user_login']);
    wp_update_user(
            array(
                'ID' => $user_id,
                'nickname' => $_REQUEST['customer_first_name']
            )
    );

    update_user_meta($user_id, 'name', $_REQUEST['customer_first_name'] . ' ' . $_REQUEST['customer_last_name']);
    update_user_meta($user_id, 'customer_display_name', $_REQUEST['customer_display_name']);

    $firstname = $_REQUEST['customer_first_name'];
    $lastname = $_REQUEST['customer_last_name'];
    update_user_meta($user_id, 'first_name', $firstname);
    update_user_meta($user_id, 'last_name', $lastname);
    wp_set_password($user_password, $user_id);


    update_user_meta($user_id, 'wp_user_level', 0);

    update_user_meta($user_id, 'wp_capabilities', 'wcfm_customer');
   //
    $user = new WP_User($user_id);
    $user->add_role('wcfm_customer');

    echo json_encode(array('Status' => true));
//    echo json_encode(array('Status' => true, 'request'=>$_REQUEST));
    
    $message = "Your Password is: $user_password.<br/><br/>For further queries please contact us @ info@foodyyums.com. <br/><br/>Thanks.";
    wp_mail($_REQUEST['restorant_email'], "Thank you for registering with Foodyyums", $message);

    exit();
}
