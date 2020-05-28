<?php
     header('Access-Control-Allow-Origin: *');
     header('Content-Type: application/json');
     header('Access-Control-Allow-Methods: DELETE');
     header('Access-Control-Allow-Headers: Access-Control-Allow-Headers, Content-Type, Access-Control-Allow-Methods, Authorization, X-Requested-With');
     include_once('../../config/Database.php');
     include_once('../../models/user.php');
  
     $database = new Database();
     $db = $database->connect();
     $user = new user($db);
     $data = json_decode(file_get_contents("php://input"));
     $user->Id = $data->Id;
     if($user->delete())
    {
        echo json_encode(array(
            'message' => 'Existing user deleted'
        ));
    }
    else
    {
        echo json_encode(array(
            'message' => 'User deletion failed'
        ));
    }
?>