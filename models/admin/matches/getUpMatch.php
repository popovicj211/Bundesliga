<?php
header("Content-Type: application/json");
require_once "../../../config/connection.php";
include "functions.php";

$data = null;
$status = 404;

if(isset($_POST['id'])){
$id = $_POST['id'];

try{
    $getSc = getUpScore($id);

    if($getSc){
        $status = 200;
        $data = $getSc;
    }else{
        $status = 500;
    }
}catch(PDOException $e){
    $status = 500;
    $dataError ="Error get match for update:".$e->getMessage()."\n";
    echo $dataError;
    SiteException($dataError);
}
}



http_response_code($status);
echo json_encode($data);