<?php
//session_start();
header("Content-type: application/json"); 

$code =404;
$data = null;

if($_SERVER['REQUEST_METHOD'] != "POST"){
    echo "You don't have access on this page!";
}

 	if(isset($_POST['id'])&& $_SESSION['user']->role_id == 1){
		require_once '../../../config/connection.php';
		require_once "functions.php";
         $upIsd = intval($_POST['id']);
try{
	     $upDat = getTeam($upIsd);
	    if($upDat){
			 $data = $upDat ;
			$code = 200;
		}else{
			$code = 500;
		}
    }catch(PDOException $e){
		$code = 500;
		$dataError ="Error get team for update:".$e->getMessage()."\n";
		echo $dataError;
		SiteException($dataError);
    }
 	}
http_response_code($code);
echo json_encode($data);