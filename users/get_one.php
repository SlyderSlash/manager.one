<?php
    function get_one($id){
        $database = new Database();
        $db = $database->getConnection();
        $user = new Users($db);
        if(!empty($id)){
            $user->id = $id;

            $user->getUser("id");

            if($user->name != null){

                $userf = [
                    "id" => $user->id,
                    "name" => $user->name,
                    "email" => $user->email
                ];
                http_response_code(200);

                echo json_encode($userf);
            }
            else{
                http_response_code(404);
            
                echo json_encode(array("message" => "L'utilisateur n'existe pas."));
            }
        }
        else{
            http_response_code(404);
        
            echo json_encode(array("message" => "Veuillez spécifier un ID"));
        }
    }