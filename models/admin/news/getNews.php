<?php
header("Content-Type: application/json");
require_once "../../../config/connection.php";
include "functions.php";

$data = null;
$status = 404;

$exeCount = CountNews();

$per_page = 2; 
$number_of_links = ceil($exeCount->counts/$per_page); 
$number = isset($_GET['numb']) ? $_GET['numb'] : 1; 
$from = $per_page * ($number - 1);

$limit = " LIMIT $from, $per_page";
 $pag =  getLimitnNews($limit ,  GetAllNewsQ());

 $array = array(
    "count" => $exeCount,
    "news" => $pag 
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
    $dataError ="Error get all news:".$e->getMessage()."\n";
    echo $dataError;
    SiteException($dataError);
}
http_response_code($status);
echo json_encode($data);