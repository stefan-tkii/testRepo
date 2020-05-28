<?php
    header('Access-Control-Allow-Origin: *');
    header('Content-Type: application/json');
    include_once('../../config/Database.php');
    include_once('../../models/user.php');

    $database = new Database();
    $db = $database->connect();
    $user = new user($db);
    $id = isset($_GET['Id']) ? $_GET['Id'] : die();
    $user->read_single($id);
    $result_arr = array();
    $post_arr = array(
        'Id' => $user->Id,
        'firstname' => $user->firstname,
        'lastname' => $user->lastname,
        'ssid' => $user->ssid 
    );
    array_push($result_arr, $post_arr);
    echo json_encode($result_arr);
?>