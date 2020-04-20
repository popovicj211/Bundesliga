<?php
session_start();
if(isset($_GET['a'])) {
    require_once "../../config/connection.php";
    include "functions.php";
    $token = $_GET['a'];
    $act = 1;
    $updateAct = "UPDATE user SET active = :act WHERE token = :token";
    $statement = $connection->prepare($updateAct);
    $statement->bindParam(":act", $act);
    $statement->bindParam(":token", $token);


    try {
        $statement->execute();
        if($statement->rowCount()) {
            $messageAct = "Register is success, please login!";
        } else {
        
            $messageAct = "Register is not success!";
            
        }
    } catch (PDOException $e) {
        $status = 500;
        $messageAct = "Account is not actived!";
        $dataError ="Error activate:".$e->getMessage()."\n";
        echo $dataError;
        SiteException($dataError);
    }

 

} else {
    $messageAct = "Page not found!";
}
header('Location: '. BASE_URL .'index.php?page=matches');
//$_SESSION['messageRegister'] = $messageAct;
$_SESSION['messageActive'] = $messageAct;

