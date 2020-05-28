<?php
    header('Access-Control-Allow-Origin: *');
    header('Content-Type: application/json');
    header('Access-Control-Allow-Methods: POST');
    header('Access-Control-Allow-Headers: Access-Control-Allow-Headers, Content-Type, Access-Control-Allow-Methods, Authorization, X-Requested-With');
    include_once('../../config/Database.php');
    include_once('../../models/user.php');
 
    $database = new Database();
    $db = $database->connect();
    $user = new user($db);
    $data = json_decode(file_get_contents("php://input"));
    $user->firstname = $data->firstname;
    $user->lastname = $data->lastname;
    $user->ssid = $data->ssid;
    if($user->create())
    {
        echo json_encode(array(
            'message' => 'New user created'
        ));
    }
    else
    {
        echo json_encode(array(
            'message' => 'User creation failed'
        ));
    }
?>