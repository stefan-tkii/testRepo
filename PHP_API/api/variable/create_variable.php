<?php
  header('Access-Control-Allow-Origin: *');
  header('Content-Type: application/json');
  header('Access-Control-Allow-Methods: POST');
  header('Access-Control-Allow-Headers: Access-Control-Allow-Headers, Content-Type, Access-Control-Allow-Methods, Authorization, X-Requested-With');
  include_once('../../config/Database.php');
  include_once('../../models/variable.php');

  $database = new Database();
  $db = $database->connect();
  $variable = new variable($db);
  $data = json_decode(file_get_contents("php://input"));
  $variable->testfieldId = 1;
  $variable->count = $data->count;
  $variable->userId = $data->userId;
  if($variable->create())
    {
        echo json_encode(array(
            'message' => 'New variable created'
        ));
    }
    else
    {
        echo json_encode(array(
            'message' => 'Variable creation failed'
        ));
    }
?>