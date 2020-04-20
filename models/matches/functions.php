
<?php
function resultsIndex(){
    return "SELECT *  , im1.href as img1href , im2.href as img2href, t.name as nameTeam1 , t2.name as nameTeam2 , matches.date as date1 FROM matches INNER JOIN teams t ON matches.team1_id = t.team_id INNER JOIN teams t2 ON matches.team2_id = t2.team_id INNER JOIN images im1 ON im1.img_id = t.id_img INNER JOIN images im2 ON im2.img_id = t2.id_img ORDER BY date1 DESC";
}

function CountMatches(){
    return "SELECT COUNT(*) as counts FROM matches";
}


function DateFirst(){
    return "SELECT * FROM matches";
}

function TeamsTable(){
    return "SELECT * FROM teams";
}

function getQueryLimit($limit , $func){
    global $connection;
    $queryRes = $func;
   $queryRes .= $limit;
    $resultRLimit = executeQuery($queryRes);
    return $resultRLimit;
}


function getQueryLimitOne($limit , $func){
    global $connection;
    $queryResO = $func;
   $queryResO .= $limit;
    $resultRLimitO = $connection -> prepare($queryResO);
     $resultRLimitO -> execute();
     $resultRLimitFetchO = $resultRLimitO -> fetch();
      return $resultRLimitFetchO;
}


function CountExtra($qCount ,$countFIlt, $filter, $trueFalse){
    global $connection;
   $queryCount = $qCount;
   //$queryCount .= " WHERE g.comp_id = :idC";
   if($trueFalse == true){
       $queryCount .= $countFIlt;
      
   }
   $countPrepare = $connection->prepare($queryCount);
   //$countPrepare -> bindParam(":idC", $filter);
   if($trueFalse == true){
       $countPrepare -> execute([$filter]);
   }else{
       $countPrepare -> execute();
   }
    
    $execCount = $countPrepare -> fetch();
   return $execCount;
}
