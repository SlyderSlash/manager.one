<?php
    function get(){
        $database = new Database();
        $db = $database->getConnection();

        $users = new Users($db);
        $getUsers = $users->getUsers();

        if($getUsers->rowCount() > 0){
            $usersArray = [];
            $usersArray['users'] = [];

            while($row = $getUsers->fetch(PDO::FETCH_ASSOC)){
                extract($row);

                $user = [
                    "id" => $id,
                    "name" => $name,
                    "email" => $email
                ];

                $usersArray['users'][] = $user;
            }

            http_response_code(200);

            echo json_encode($usersArray);
        }
        else{
            http_response_code(404);
        
            echo json_encode(array("message" => "Aucune tâche trouvées"));
        }
    }