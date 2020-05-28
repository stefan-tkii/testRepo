<?php
    header('Access-Control-Allow-Origin: *');
    header('Content-Type: application/json');
    include_once('../../config/Database.php');
    include_once('../../models/makentity.php');

    $database = new Database();
    $db = $database->connect();
    $makentity = new makentity($db);
    $userId= isset($_GET['userId']) ? $_GET['userId'] : die();
    $result = $makentity->readAllByUser($userId);
    $num = $result->rowCount();

    if($num >0)
    {
        $makentity_arr = array();
        while($row = $result->fetch(PDO::FETCH_ASSOC))
        {
            extract($row);
            $makentity_item = array(
                'Id' => $Id,
                'field' => $field,
                'userId' => $userId
            );
            array_push($makentity_arr, $makentity_item);
        }
        echo json_encode($makentity_arr);
    }
?>