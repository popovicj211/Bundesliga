<?php
header("Content-Type: application/json");
require_once "../../../config/connection.php";
include "functions.php";

$data = null;
$status = 404;
//try{
//$getSc = getAllScores();
$exeCount = CountMatches();

$per_page = 9; 
$number_of_links = ceil($exeCount->counts/$per_page); 
$number = isset($_GET['numb']) ? $_GET['numb'] : 1; 
$from = $per_page * ($number - 1);

$limit = " LIMIT $from, $per_page";
 $pag = getLimitMat($limit , getAllScQuery()." ORDER BY matches.date DESC");

 $array = array(
    "count" => $exeCount,
    "matches" => $pag 
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
                $dataError ="Error get all matches:".$e->getMessage()."\n";
                echo $dataError;
                SiteException($dataError);
   }
http_response_code($status);
echo json_encode($data);