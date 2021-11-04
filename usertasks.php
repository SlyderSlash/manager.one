<?php
    header("Access-Control-Allow-Origin: *");
    header("Content-Type: application/json; charset=UTF-8");
    header("Access-Control-Allow-Methods: GET");
    header("Access-Control-Max-Age: 3600");
    header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");
    
    include_once 'config/Database.php';
    include_once 'models/Tasks.php';
    include_once 'tasks/get.php';

    $request_method = $_SERVER["REQUEST_METHOD"];

    switch($request_method)
	{
		case 'GET':
			if($_GET['userid'] !== null)
			{
				$userid=intval($_GET['userid']);
				get($userid);
			}
            break;
        default:
			header("HTTP/1.0 405 Method Not Allowed");
			break;

	}