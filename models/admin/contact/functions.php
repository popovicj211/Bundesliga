<?php

function CountContact(){
    global $connection;
    $queryCon = "SELECT COUNT(*) as counts FROM contact";
    $prepCon = $connection -> prepare($queryCon);
    $prepCon -> execute();
  $resCon = $prepCon -> fetch();
  return $resCon;
}

function getLimitCont($limit , $func){
    global $connection;
    $queryResM = $func;
   $queryResM .= $limit;
    $resultMLimit = executeQuery($queryResM);
    return $resultMLimit;
}

function getAllContQuery(){
    return "SELECT * FROM contact";
}

function Contact(){
    return executeQuery("SELECT * FROM contact");
  }

  function DelCont($id){

    global $connection;
    $queryDel = "DELETE FROM contact WHERE con_id = ?";
    $prepConDel = $connection->prepare($queryDel); 
    $exeConDel = $prepConDel -> execute([$id]);
    return $exeConDel;
  
   }