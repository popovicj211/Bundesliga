<?php
//session_start();
   $statusCode = 404;


if($_SERVER['REQUEST_METHOD'] != "POST"){
    echo "You don't have access on this page!";
}

if(isset($_POST['id'])&& $_SESSION['user']->role_id == 1){
    require_once '../../../config/connection.php';
    require_once 'functions.php';
    $id = $_POST['id'];


try{
  if(DelUsers($id)){
    $statusCode = 204;
  }else{
    $statusCode = 500;
  }
}catch(PDOException $e){
    $statusCode = 500;
    $dataError ="Error delete user:".$e->getMessage()."\n";
    echo $dataError;
    SiteException($dataError);
}

}

http_response_code($statusCode);