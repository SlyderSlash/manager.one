<?php
    function get($user){
        $database = new Database();
        $db = $database->getConnection();

        $tasks = new Tasks($db);
        $getTasks = $tasks->getTasks($user);

        if($getTasks->rowCount() > 0){
            $tasksArray = [];
            $tasksArray['tasks'] = [];

            while($row = $getTasks->fetch(PDO::FETCH_ASSOC)){
                extract($row);

                $task = [
                    "id" => $id,
                    "user_id" => $user_id,
                    "title" => $title,
                    "description" => $description,
                    "creation_date" => $creation_date,
                    "status" => $status
                ];

                $tasksArray['tasks'][] = $task;
            }

            http_response_code(200);

            echo json_encode($tasksArray);
        }
        else{
            http_response_code(404);
        
            echo json_encode(array("message" => "Aucune tâche trouvées"));
        }
    }