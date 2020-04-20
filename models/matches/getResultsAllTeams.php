<?php
header("Content-type: application/json");

require_once "../../config/connection.php";
require_once "functions.php";
$status = 404;

$filter = null;
$trueFalse = false;
$countFIlt = null;

$exeCount = CountExtra( CountMatches() ,$countFIlt, $filter, $trueFalse);
$per_page = 9; 
$number_of_links = ceil($exeCount->counts/$per_page); 
$number = isset($_GET['numb']) ? $_GET['numb'] : 1; 
$from = $per_page * ($number - 1);

$limit = " LIMIT $from, $per_page";
$pag = getQueryLimit($limit , resultsIndex());


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
    $dataError ="Error get all results:".$e->getMessage()."\n";
    echo $dataError;
    SiteException($dataError);
}
echo json_encode($data);
http_response_code($status);