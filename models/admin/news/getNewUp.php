<?php
//session_start();

header("Content-type: application/json"); 
$code = 404;
$data = null;

if($_SERVER['REQUEST_METHOD'] != "POST"){
    echo "You don't have access on this page!";
    $code = 400;
}

 	if(isset($_POST['idnews']) && isset($_POST['idimg']) && $_SESSION['user']->role_id == 1){
		require_once '../../../config/connection.php';
		require_once "functions.php";
		 $upIsNews = $_POST['idnews'];
		 $upIsImg = $_POST['idimg'];
	
	
try{
	     $upDatNews = getNewsOne($upIsNews ,  $upIsImg);
	    if($upDatNews){
			 $data = $upDatNews ;
			$code = 200;
		}else{
			$code = 500;
		}
    }catch(PDOException $e){
		$code = 500;
		$dataError ="Error get news for update:".$e->getMessage()."\n";
		echo $dataError;
		SiteException($dataError);
	
    }
}
http_response_code($code);
echo json_encode($data);

