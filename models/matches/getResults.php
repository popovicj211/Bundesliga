<?php
header("Content-Type: application/json");
require_once "../../config/connection.php";
include "functions.php";

$data = null;
$status = 404;

$limit = " LIMIT 0,9";
$func = resultsIndex();
$res = getQueryLimit($limit, $func);

$limit2 = " ORDER BY date ASC LIMIT 0,1";
$func2 = DateFirst();
$resDate =  getQueryLimitOne($limit2 , $func2);

$limit3 = " ORDER BY date DESC LIMIT 0,1";
$func3 = DateFirst();
$resDate2 =  getQueryLimitOne($limit3 , $func3);

$array = array(
    "result" => $res,
    "firstdate" => $resDate ,
    "firstdatedesc" => $resDate2                           
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
    $dataError ="Error get results:".$e->getMessage()."\n";
    echo $dataError;
    SiteException($dataError);
}
http_response_code($status);
echo json_encode($data);