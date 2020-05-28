<?php
      header('Access-Control-Allow-Origin: *');
      header('Content-Type: application/json');
      header('Access-Control-Allow-Methods: DELETE');
      header('Access-Control-Allow-Headers: Access-Control-Allow-Headers, Content-Type, Access-Control-Allow-Methods, Authorization, X-Requested-With');
      include_once('../../config/Database.php');
      include_once('../../models/variable.php');
   
      $database = new Database();
      $db = $database->connect();
      $variable= new variable($db);
      $data = json_decode(file_get_contents("php://input"));
      $variable->Id = $data->Id;
      if($variable->delete())
     {
         echo json_encode(array(
             'message' => 'Existing variable deleted'
         ));
     }
     else
     {
         echo json_encode(array(
             'message' => 'Variable deletion failed'
         ));
     }


?>