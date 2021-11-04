<?php
    function delete($id){
        $database = new Database();
        $db = $database->getConnection();

        $task = new Tasks($db);
        if(!empty($id)){
            $task->id = $id;
    
            if($task->deleteTask()){
                http_response_code(200);
                echo json_encode(["message" => "La suppression a été effectuée"]);
            }else{
                http_response_code(503);
                echo json_encode(["message" => "La suppression n'a pas été effectuée"]);         
            }
        }
    }