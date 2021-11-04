<?php
    function post(){
        $database = new Database();
        $db = $database->getConnection();

        $task = new Tasks($db);
    
        if(!empty($_POST['title']) && !empty($_POST['description']) && !empty($_POST['user_id']) && !empty($_POST['status'])){
            $task->title = $_POST['title'];
            $task->description = $_POST['description'];
            $task->user_id = intval($_POST['user_id']);
            $task->status = $_POST['status'];

            if($task->newTask()){
                http_response_code(201);
                echo json_encode(["message" => "La tâche à été ajoutée"]);
            }else{
                http_response_code(503);
                echo json_encode(["message" => "Erreur lors de l'ajout"]);         
            }
        }
        else{
            http_response_code(400);
            echo json_encode(["message" => "Champ Manquant"]);         
        }
    }
