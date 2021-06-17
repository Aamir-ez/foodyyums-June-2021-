<?php

/*
 * 
 */

add_action("wp_ajax_ez_register_customer", "ez_register_customer");

add_action("wp_ajax_nopriv_ez_register_customer", "ez_register_customer");

function ez_register_customer() {
    $fields_arr = array(
        array(
            'field' => $_REQUEST['customer_first_name'],
            'id' => 'customer_first_name',
            'label' => 'First Name',
            'type' => 'text'
        ),
        array(
            'field' => $_REQUEST['customer_last_name'],
            'id' => 'customer_last_name',
            'label' => 'Last Name',
            'type' => 'text'
        ),
        array(
            'field' => $_REQUEST['user_login'],
            'id' => 'user_login',
//            'field' => 'user_login',
            'label' => 'Username',
            'type' => 'text'
        ),
        array(
            'field' => $_REQUEST['customer_display_name'],
            'id' => 'customer_display_name',
            'label' => 'Display Name',
            'type' => 'text'
        ),
        array(
            'field' => $_REQUEST['customer_user_email'],
            'id' => 'customer_user_email',
            'label' => 'Email',
            'type' => 'email'
        ),
        array(
            'field' => $_REQUEST['terms'],
            'id' => 'terms',
            'label' => 'terms',
            'type' => 'terms'
        ),
    );
    ez_validation($fields_arr);
    /*$validation_err = ez_validation($fields_arr);
    if(is_null($validation_err)){
        echo 'register the user!';
    }*/
    exit();
}

function ez_validation($fields_arr) {
    foreach ($fields_arr as $field) {
//        echo '<pre>';
//        print_r($field);
        if ($field['field'] == "" && $field['type'] == "terms") {
            $data = ['field' => $field['id'], 'error' => "You must accept the terms."];
        } elseif ($field['field'] == "" && $field['type'] != "terms") {
            $data = ['field' => $field['id'], 'error' => "Please provide " . $field['label']];
        } elseif ($field['field'] == 3 && $field['type'] != "email") {
            $data = ['field' => $field['id'], 'error' => $field['label'] . " must be at least 3 characters long"];
        } elseif ($field['type'] == "email") {
            if (!filter_var($field['field'], FILTER_VALIDATE_EMAIL)) {
                $data = ['field' => $field['id'], 'error' => "Please enter a valid email"];
            }
            if (email_exists($field['field']) != 0) {
                $data = ['field' => $field['id'], 'error' => "Email has already registered!"];
            }
        } else {
            $data  = null;
        }

        return json_encode($data);
    }
    exit();
}
