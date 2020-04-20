<?php

function TeamQuery(){
    return "SELECT team_id , name FROM teams ";
}


function TeamNews(){
    return executeQuery(TeamQuery());
}

function GetAllNewsQ(){
  return "SELECT t.team_id , t.name as teamname,n.news_id, n.name, n.text , n.date, i.* FROM teams t INNER JOIN news_teams nt ON t.team_id = nt.team_id INNER JOIN news n ON nt.news_id = n.news_id INNER JOIN images i ON n.img_id = i.img_id";
}

function GetAllNews(){
  return executeQuery(GetAllNewsQ());
}


    function imagedataAdmin($image){
      $nameImg = $image['name'];
      $tmp_nameImg = $image['tmp_name'];
      $sizeImg = $image['size'];
      $typeImg = $image['type'];
       $arrImgData = array(
         "nameImg" => $nameImg , 
        "tmpImg" => $tmp_nameImg,
        "sizeImg" => $sizeImg,
        "typeImg" => $typeImg
    );
    return $arrImgData;
    }
  
    function InarrayAdmin($typeImg , $imageTypes, $arrayErrors){
      $resIA = null;
             if(!in_array($typeImg , $imageTypes)){
       array_push($arrayErrors , "Type file isn't ok");
       $resIA = $arrayErrors;
          }
        return $resIA;
    }
    
    function SizeImageAdmin($sizeImg , $sizeMax , $arrayErrors ){
      $resS = null;
      if($sizeImg > $sizeMax){
         array_push($arrayErrors , "Size file isn't ok");
         $resS = $arrayErrors;
       }
       return $resS;
    }
  
    
  function imageresizeAdmin($tmp_nameImg, $newWidth  ,$typeImg , $path_newimage){
  
  
    list($width, $height) = getimagesize($tmp_nameImg);
  
    $existingImage = null;
    switch($typeImg){
        case 'image/jpeg':
            $existingImage = imagecreatefromjpeg($tmp_nameImg);
            break;
        case 'image/png':
            $existingImage = imagecreatefrompng($tmp_nameImg);
            break;
    }
  
  //   $newWidth = 262;
    $newHeight = ($newWidth/$width) * $height;

  // $newHeight = $newWidth;

 
    $newImage = imagecreatetruecolor($newWidth,  $newHeight );
  
    imagecopyresampled($newImage, $existingImage, 0, 0, 0, 0, $newWidth, $newHeight, $width, $height);
  
  
    switch($typeImg){
       case 'image/jpeg':
           imagejpeg($newImage, '../../../'.$path_newimage, 75);
           break;
       case 'image/png':
           imagepng($newImage, '../../../'.$path_newimage);
           break;
   }
  
   imagedestroy($existingImage);
   imagedestroy($newImage);
   return $path_newimage;
  }
  
    
  function InsertNewsAdmin( $team , $name , $text,  $href , $alt  ){
      global $connection;
    try{
      $connection->beginTransaction();
    
     $queryImage = "INSERT INTO images (img_id , href, alt ) values(null , ? , ?)";
      $InsertPhoto = $connection->prepare($queryImage);
      $InsertPhoto -> execute([ $href , $alt  ]);
   
      $imgId = $connection -> lastInsertId();


      
    
     $queryNews = "INSERT INTO news (news_id, name , text ,img_id)
     values (null, ? , ?, ? )";
      $insertNews = $connection->prepare($queryNews);
      $insertNews -> execute([ $name , $text , $imgId ]);

      $newsId = $connection -> lastInsertId();


      $queryNewsTeam = "INSERT INTO news_teams (nete_id, team_id , news_id)
      values (null, ? , ? )";
       $insertNewsTeam = $connection->prepare($queryNewsTeam);
       $insertNewsTeam -> execute([ $team , $newsId ]);
      
      $transaction = $connection->commit();
    
    } catch(PDOException $e) {
      $connection->rollback();
      echo $e->getMessage();
     
    }
    
    
    return $transaction ;
    }


  function getLimitnNews($limit , $func){
    global $connection;
    $queryResNews = $func;
   $queryResNews .= $limit;
    $resultNewsLimit = executeQuery($queryResNews);
    return $resultNewsLimit;
}

function CountNews(){
   // return executeQuery("SELECT COUNT(*) as counts FROM matches");
   global $connection;
     $queryConNews = "SELECT COUNT(*) as counts FROM news";
     $prepConNews = $connection -> prepare($queryConNews);
     $prepConNews -> execute();
   $resConNews = $prepConNews -> fetch();
   return $resConNews;
}


function getNewsOne($upIdnews , $upIdimg){
  global $connection;
  $queryGetNews = GetAllNewsQ();
  $queryGetNews .= " WHERE n.news_id = ? AND n.img_id = ?";
  $upPrepareNews = $connection->prepare($queryGetNews);
     $upPrepareNews->execute([$upIdnews,  $upIdimg]);
       $upNews = $upPrepareNews->fetch();
       return $upNews;
}

function  DelNews($idNews , $idImg){
  global $connection;
  $connection->beginTransaction();
  try{

  $delNews = "DELETE FROM news WHERE news_id = ? ";
   $prepareDelNews = $connection->prepare($delNews);
    $prepareDelNews->execute([$idNews]);

    $delNewsImg = "DELETE FROM images WHERE img_id = ? ";
    $prepareDelNewsImg = $connection->prepare($delNewsImg);
     $prepareDelNewsImg->execute([$idImg]);

   $transactionDel = $connection->commit();

  }catch(PDOException $e){
         $connection->rollback();
         $e->getMessage();
  }
  return  $transactionDel;
}


 function UpdateNewsAdmin($teamName , $newsName , $text, $image , $alt , $newsid,  $imgid){
  global $connection;
  $connection->beginTransaction();
  try{
    
  $queryUpteam = "UPDATE news SET name = ?, text = ? WHERE news_id = ?";
  $upteam = $connection->prepare($queryUpteam);
  $upteam -> execute([ $newsName , $text ,$newsid]);
    
  $queryUpTeam = "UPDATE news_teams SET team_id = ? WHERE news_id = ?";
  $upTeam = $connection->prepare($queryUpTeam);
  $upTeam -> execute([ $teamName , $newsid ]);
  
    $queryUpimg = "UPDATE images SET href = ?, alt = ? WHERE img_id = ?";
    $upimg = $connection->prepare($queryUpimg);
    $upimg -> execute([ $image , $alt , $imgid  ]);
  

    $transaction = $connection->commit();
  
  } catch(PDOException $e) {
    $connection->rollback();
    echo $e->getMessage();
   
  }
  
  
  return $transaction ;
}

 function UpdateNewsAdmin2($teamName , $newsName , $text, $newsid,  $imgid){
  global $connection;
  $connection->beginTransaction();
  try{
    
  $queryUpteam = "UPDATE news SET name = ?, text = ? WHERE news_id = ?";
  $upteam = $connection->prepare($queryUpteam);
  $upteam -> execute([ $newsName , $text ,$newsid]);
    
  $queryUpTeam = "UPDATE news_teams SET team_id = ? WHERE news_id = ?";
  $upTeam = $connection->prepare($queryUpTeam);
  $upTeam -> execute([ $teamName , $newsid ]);

    $transaction = $connection->commit();
  
  } catch(PDOException $e) {
    $connection->rollback();
    echo $e->getMessage();
   
  }
  
  
  return $transaction ;
 }