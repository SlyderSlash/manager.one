<?php
/*     header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF-8");
    header("Access-Control-Allow-Methods: GET");
    header("Access-Control-Max-Age: 3600");
    header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
    
    include_once 'config/Database.php';
    include_once 'models/Tasks.php'; */

    function get_one($id){
        $database = new Database();
        $db = $database->getConnection();
        $task = new Tasks($db);

        if(!empty($id)){
            $task->id = $id;

            $task->getTask("id");

            if($task->title != null){

                $taskf = [
                    "id" => $task->id,
                    "title" => $task->title,
                    "user_id" => $task->user_id,
                    "description" => $task->description,
                    "creation_date" => $task->creation_date,
                    "status" => $task->status
                ];
                http_response_code(200);

                echo json_encode($taskf);
            }
            else{
                http_response_code(404);
            
                echo json_encode(array("message" => "La Tâche n'existe pas."));
            }
        }
        else{
            http_response_code(404);
        
            echo json_encode(array("message" => "Veuillez spécifier un ID"));
        }
    }