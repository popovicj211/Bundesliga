<?php

function SubAll(){
     return "SELECT * FROM subscribe";
}

function getLimitSub($limit , $func){
    global $connection;
    $queryResS = $func;
   $queryResS .= $limit;
    $resultSLimit = executeQuery($queryResS);
    return $resultSLimit;
}

function ExistEmail($emailS){
    $resMess = false;
   $subEm = Sub();
     foreach($subEm as $key => $value){
             if($emailS == $value->email){
               $resMess = true;
             }  
     }
  return $resMess;
}

function CountSub(){
    global $connection;
    $querySub = "SELECT COUNT(*) as counts FROM subscribe";
    $prepSub = $connection -> prepare($querySub);
    $prepSub -> execute();
  $resS = $prepSub -> fetch();
  return $resS;
}

function Sub(){
    return executeQuery("SELECT * FROM subscribe");
  }

  function  insertSubEm($emailS){
        global $connection;    
        $queryInsSub = "INSERT INTO subscribe (id_sub , email) VALUES(null,?)";
        $prepSubEm = $connection->prepare($queryInsSub); 
        $exeSubEm = $prepSubEm -> execute([$emailS]);
        return $exeSubEm;

  }

 function DelSub($id){

  global $connection;
  $queryDel = "DELETE FROM subscribe WHERE id_sub = ?";
  $prepSubDel = $connection->prepare($queryDel); 
  $exeSubDel = $prepSubDel -> execute([$id]);
  return $exeSubDel;

 }