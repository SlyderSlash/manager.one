<?php
    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF-8");
    header("Access-Control-Allow-Methods: GET");
    header("Access-Control-Max-Age: 3600");
    header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
    
    include_once 'config/Database.php';
    include_once 'models/Users.php';
    include_once 'users/get.php';
    include_once 'users/get_one.php';
    include_once 'users/post.php';
    include_once 'users/delete.php';

    $request_method = $_SERVER["REQUEST_METHOD"];

    switch($request_method)
	{
		case 'GET':
            $id = $_GET['uid'];
			if(empty($id)){
				if($_SERVER['SERVER_NAME'] === "localhost"){
                    get();
                    break;
                }
                else {
                    header("HTTP/1.0 404 Not Found");
                    break;
                }
			}
			else {
				$id=intval($id);
				get_one($id);
			}
			break;
		default:
			header("HTTP/1.0 405 Method Not Allowed");
			break;
			
		case 'POST':
            error_log("POST");
			post();
			break;
			
		case 'DELETE':
            if ($_SERVER['SERVER_NAME'] === "localhost")
            {
                $id = $_GET['uid'];
			    $id = intval($id);
                if (!empty($id)){
                    delete($id);
                }
                else {
                    $response=array(
                        'status' => 0,
                        'error_type' => 'Missing Value ',
                        'status_message' =>'ERREUR : La valeur : /:id est obligatoire'
                    );
                    header('Content-Type: application/json');
                    echo json_encode($response);
                }
            }
            else {
                $response=array(
                    'status' => 0,
                    'error_type' => 'ACCESS ERROR',
                    'status_message' =>'ERREUR! : Vous n\'êtes pas autorisé à accéder à cette fonction'
                );
                header('Content-Type: application/json');
                echo json_encode($response);
            }
            break;
    }
?>