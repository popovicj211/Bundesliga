<?php
//session_start();
   $statusCode = 404;


if($_SERVER['REQUEST_METHOD'] != "POST"){
    echo "You don't have access on this page!";
    $statusCode = 400;
}

if(isset($_POST['idcomm']) && isset($_POST['iduser']) &&  isset($_POST['idnews']) && $_SESSION['user']->role_id == 1 ){
    require_once '../../../config/connection.php';
    require_once 'functions.php';
    $idComm = $_POST['idcomm'];
    $idUser = $_POST['iduser'];
    $idNews = $_POST['idnews'];
     try{
  if(DelComm($idComm , $idUser , $idNews)){
    $statusCode = 204;
  }else{
    $statusCode = 500;
  }
 }catch(PDOException $e){
  $statusCode = 500;
  $dataError ="Error delete news:".$e->getMessage()."\n";
  echo $dataError;
  SiteException($dataError);
 }

}

http_response_code($statusCode);