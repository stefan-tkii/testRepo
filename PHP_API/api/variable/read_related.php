<?php
    header('Access-Control-Allow-Origin: *');
    header('Content-Type: application/json');
    include_once('../../config/Database.php');
    include_once('../../models/variable.php');

    $database = new Database();
    $db = $database->connect();
    $variable = new variable($db);
    $userId = isset($_GET['userId']) ? $_GET['userId'] : die();
    $result = $variable->read_related($userId);
    $num = $result->rowCount();
    if($num>0)
    {
        $result_arr = array();
        while($row = $result->fetch(PDO::FETCH_ASSOC))
        {
            extract($row);
            $result_item = array(
                'Id' => $Id,
                'count' => $count,
                'userId' => $userId,
                'testfieldId' => $testfieldId
            );
            array_push($result_arr, $result_item);
        }
        echo json_encode($result_arr);
    }
?>