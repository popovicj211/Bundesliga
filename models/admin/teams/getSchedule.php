<?php
//session_start();
header("Content-type: application/json"); 

$code =404;
$data = null;

		require_once '../../../config/connection.php';
		require_once "functions.php";
       
try{
		$data = getAllTeams();
	    if($data){
			$code = 200;
		}else{
			$code = 500;
        }
	}catch(PDOException $e){
		$code = 500;
		$dataError ="Error get all teams:".$e->getMessage()."\n";
		echo $dataError;
		SiteException($dataError);
	}
http_response_code($code);
echo json_encode($data);

