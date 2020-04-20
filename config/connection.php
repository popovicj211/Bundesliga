<?php

require_once "config.php";

Logs();

function SiteException($dataError){
    $openError = fopen(ERROR_FILE,"a");
   $fw = fwrite($openError, $dataError);
    fclose($openError);
    return $fw;
}

try {
    $connection = new PDO("mysql:host=".SERVER.";dbname=".DATABASE.";charset=utf8", USERNAME, PASSWORD);
    $connection->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);
    $connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
}
catch(PDOException $ex){
    $dataError ="Error database connection:".$ex->getMessage()."\n";
    echo $dataError;
    SiteException($dataError);
}

function executeQuery($query){
    global $connection;
    return $connection->query($query)->fetchAll();
}

function Logs(){
    $openLog = fopen(LOG_FILE, "a");
    $string = basename($_SERVER['REQUEST_URI'])."\t".$_SERVER['REMOTE_ADDR']."\t".date("d.m.Y H:i:s")."\n";

    fwrite($openLog, $string);
    fclose($openLog); 
    }