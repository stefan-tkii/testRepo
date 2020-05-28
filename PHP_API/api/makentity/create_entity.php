<?php
     header('Access-Control-Allow-Origin: *');
     header('Content-Type: application/json');
     header('Access-Control-Allow-Methods: POST');
     header('Access-Control-Allow-Headers: Access-Control-Allow-Headers, Content-Type, Access-Control-Allow-Methods, Authorization, X-Requested-With');
     include_once('../../config/Database.php');
     include_once('../../models/makentity.php');

     $database = new Database();
     $db = $database->connect();
     $makentity = new makentity($db);
     $data = json_decode(file_get_contents("php://input"));
     $makentity->field = $data->field;
     $makentity->userId = $data->userId;
     if($makentity->create_entity())
     {
         echo json_encode(array(
             'message' => 'New makentity created'
         ));
     }
     else
     {
         echo json_encode(array(
             'message' => 'Makentity creation failed'
         ));
     }
?>