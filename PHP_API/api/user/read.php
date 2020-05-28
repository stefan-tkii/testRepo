<?php
    header('Access-Control-Allow-Origin: *');
    header('Content-Type: application/json');
    include_once('../../config/Database.php');
    include_once('../../models/user.php');

    $database = new Database();
    $db = $database->connect();
    $user = new user($db);
    $result = $user->read();
    $num = $result->rowCount();
    if($num >0)
    {
        $user_arr = array();
        while($row = $result->fetch(PDO::FETCH_ASSOC))
        {
            extract($row);
            $user_item = array(
                'Id' => $Id,
                'fistname' => $firstname,
                'lastname' => $lastname,
                'ssid' => $ssid
            );
            array_push($user_arr, $user_item);
        }
        echo json_encode($user_arr);
    }
?>