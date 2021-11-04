<?php
    function post(){
        $database = new Database();
        $db = $database->getConnection();

        $user = new Users($db);
    
        if(!empty($_POST['name']) && !empty($_POST['email'])){
            $user->name = $_POST['name'];
            $user->email = $_POST['email'];

            if($user->newUser()){
                http_response_code(201);
                echo json_encode(["message" => "L'utilisateur à été ajoutée"]);
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
