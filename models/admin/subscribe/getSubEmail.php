<?php
header("Content-Type: application/json");
require_once "../../../config/connection.php";
include "functions.php";

$data = null;
$status = 404;

$exeCount = CountSub();

$per_page = 3; 
$number_of_links = ceil($exeCount->counts/$per_page); 
$number = isset($_GET['numb']) ? $_GET['numb'] : 1; 
$from = $per_page * ($number - 1);

$limit = " LIMIT $from, $per_page";
 $pag = getLimitSub($limit , SubAll());

 $array = array(
    "broj" => $exeCount,
    "pag" => $pag 
);

try{
if($array){
    $status = 200;
    $data = $array;
}else{
    $status = 500;
}
}catch(PDOException $e){
    $status = 500;
    $dataError ="Error get email for subscribe:".$e->getMessage()."\n";
    echo $dataError;
    SiteException($dataError);
}
http_response_code($status);
echo json_encode($data);