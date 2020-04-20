<?php

function CountNewsUsr(){
    // return executeQuery("SELECT COUNT(*) as counts FROM matches");
    global $connection;
      $queryConNews = "SELECT COUNT(*) as counts FROM news";
      $prepConNews = $connection -> prepare($queryConNews);
      $prepConNews -> execute();
    $resConNews = $prepConNews -> fetch();
    return $resConNews;
 }


function GetAllNewsQUsr(){
  return "SELECT t.team_id , t.name as teamname,n.news_id, n.name, n.text , n.date, i.* FROM teams t INNER JOIN news_teams nt ON t.team_id = nt.team_id INNER JOIN news n ON nt.news_id = n.news_id INNER JOIN images i ON n.img_id = i.img_id ";
}

function GetAllUsrImg($usr_id){
        global $connection;
        $queryUsrImg = "SELECT u.* , i.href , i.alt FROM user u INNER JOIN images i ON u.img_id = i.img_id WHERE u.user_id = ?";
        $prepUsrImgQ = $connection->prepare($queryUsrImg);
        $prepUsrImgQ -> execute([$usr_id]);
        $rowUsrImgQ =  $prepUsrImgQ -> fetch();
        return $rowUsrImgQ;  
}






  function GetAllNews(){
    return executeQuery(GetAllNewsQUsr());
  }


  function getLimitnNewsUsr($limit , $func){
    global $connection;
    $queryResNews = $func;
   $queryResNews .= $limit;
    $resultNewsLimit = executeQuery($queryResNews);
    return $resultNewsLimit;
}


function NewsDetal($nwId){
 global $connection;
  //$queryNewsDet = "SELECT n.* , i.href , i.alt FROM news n INNER JOIN images i ON n.img_id = i.img_id WHERE n.news_id = ?";
  $queryNewsDet = GetAllNewsQUsr();
   $queryNewsDet .= " WHERE n.news_id = ?";
  $prepQueryNewsDet = $connection -> prepare($queryNewsDet);
  $prepQueryNewsDet -> execute([$nwId]);
  $resNDet = $prepQueryNewsDet -> fetchAll();
 return $resNDet;
}


