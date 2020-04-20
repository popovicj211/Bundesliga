<?php
 //ob_start();
 require_once '../../config/connection.php';
 include "functions.php";
session_start();
if(isset($_SESSION['user'])){
    unset($_SESSION['user']);
    session_destroy();
    header("Location: ".BASE_URL."index.php?page=index");
   // UpdateLogin($setLog = 0 ,$whereLog = 1 , $id = null , $trufal = false );
}

