<?php
    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF-8");
    header("Access-Control-Allow-Methods: GET");
    header("Access-Control-Max-Age: 3600");
    header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
    
    include_once 'config/Database.php';
    include_once 'models/Tasks.php';
    include_once 'tasks/get_one.php';
    include_once 'tasks/get.php';
    include_once 'tasks/post.php';
    include_once 'tasks/delete.php';

    $request_method = $_SERVER["REQUEST_METHOD"];

    switch($request_method)
	{
		case 'GET':
			$id = $_GET['id'];
			if(empty($id)){
				get(false);
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
			post();
			break;
			
		case 'DELETE':
            $id = $_GET['id'];
			$id = intval($id);
			delete($id);
			break;

	}