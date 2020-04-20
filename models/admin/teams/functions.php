<?php
function getTeamsSchedule(){
  return "SELECT * FROM teams";
}

function queryTeamsSchedule(){
      return executeQuery(getTeamsSchedule());
}

/*
function InsertUserAdmin( $name , $w,  $d, $l  , $pts , $teamId  ){
    global $connection;
  
   $queryImage = "INSERT INTO images (img_id , href, alt ) values(null , ? , ?)";
    $InsertPhoto = $connection->prepare($queryImage);
    $InsertPhoto -> execute([ $href , $alt ]);
      
  return  ;
  }
  */

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

  
function imageresizeAdmin($tmp_nameImg,  $newWidth ,$typeImg , $path_newimage){


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
 // $newHeight = ($newWidth/$width) * $height;
 $newHeight = $newWidth;
// $newHeight = 381;
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

  
function InsertTeamAdmin( $name , $w,  $d, $l  , $href , $alt ){
    global $connection;
  try{
    $connection->beginTransaction();
    $pts = ($w * 3) + $d;
  
   $queryImage = "INSERT INTO images (img_id , href, alt ) values(null , ? , ?)";
    $InsertPhoto = $connection->prepare($queryImage);
    $InsertPhoto -> execute([ $href , $alt ]);
      
    $imgId = $connection -> lastInsertId();
  
   $queryInset = "INSERT INTO teams (team_id , id_img , name ,w ,d ,l , pts )
   values (null, ? , ?, ?, ? ,? , ? )";
    $insertUsers = $connection->prepare($queryInset);
    $insertUsers -> execute([ $imgId ,$name , $w , $d , $l , $pts ]);
    
    $transaction = $connection->commit();
  
  } catch(PDOException $e) {
    $connection->rollback();
    echo $e->getMessage();
   
  }
  
  
  return $transaction ;
  }
  
function getTm(){
    return "SELECT t.* , i.href , i.alt FROM teams t INNER JOIN images i ON t.id_img = i.img_id";
}
/*
function getTm(){
  return "SELECT m1.team1_id as m1team1_id, m1.team2_id as m1team2_id , m2.team1_id as m2team1_id , m2.team2_id as m2team2_id, m1.result as res1, m2.result as res2, t.* , im1.href, im1.alt FROM matches m1 INNER JOIN teams t ON m1.team1_id = t.team_id INNER JOIN matches m2 ON m2.team2_id = t.team_id INNER JOIN images im1 ON im1.img_id = t.id_img ";
}
*/
/*
function  getTm(){
  return "SELECT matches.match_id, matches.result, matches.date , t.name as team1 , t2.name as team2 , matches.team1_id , matches.team2_id FROM matches INNER JOIN teams t ON matches.team1_id = t.team_id INNER JOIN teams t2 ON matches.team2_id = t2.team_id INNER JOIN images im1 ON im1.img_id = t.id_img ";
}
*/
function getAllTeams(){
      return executeQuery(getTm()." ORDER BY t.pts DESC");
}

  function getTeam($upId){
    global $connection;
    $queryGet = getTm();
    $queryGet .= " WHERE id_img = :id";
    $upPrepare = $connection->prepare($queryGet);
    $upPrepare->bindParam(":id",  $upId );
       $upPrepare->execute();
         $upUsers = $upPrepare->fetch();
         return $upUsers;
  }


   /*
function UpdateTeamAdmin( $teamid , $name , $w,  $d, $l , $href , $alt ){
  global $connection;
try{
  $connection->beginTransaction();
  $pts = ($w * 3) + $d;
  
  $queryImg = "SELECT t.id_img FROM teams t INNER JOIN images i ON i.img_id = t.id_img WHERE team_id = ?";
  $prImg = $connection->prepare($queryImg);
    $prImg->execute([$teamid ]);
  $roes = $prImg->fetch();
   $roesImgId = $roes->img_id;

 $imgId = intval($roesImgId);


  $queryUpteam = "UPDATE teams SET name = ?, w = ?, d = ?, l = ?, pts = ? WHERE team_id = ?";
  $upteam = $connection->prepare($queryUpteam);

  $upteam -> execute([ $name , $w , $d , $l , $pts , $teamid]);
  
  $queryUpimg = "UPDATE images SET href = ?, alt = ? WHERE img_id = ?";
  $upimg = $connection->prepare($queryUpimg);
  $upimg -> execute([ $href , $alt , $imgId  ]);
    

  $transaction = $connection->commit();

} catch(PDOException $e) {
  $connection->rollback();
  echo $e->getMessage();
 
}


return $transaction ;
}
*/


function UpdateTeamAdmin( $imgid , $name , $w,  $d, $l , $href , $alt ){
  global $connection;
try{
  $connection->beginTransaction();
  $pts = ($w * 3) + $d;
  
  $queryUpteam = "UPDATE teams SET name = ?, w = ?, d = ?, l = ?, pts = ? WHERE id_img = ?";
  $upteam = $connection->prepare($queryUpteam);
  $upteam -> execute([ $name , $w , $d , $l , $pts , $imgid]);
  
  $queryUpimg = "UPDATE images SET href = ?, alt = ? WHERE img_id = ?";
  $upimg = $connection->prepare($queryUpimg);
  $upimg -> execute([ $href , $alt , $imgid  ]);

  $transaction = $connection->commit();

} catch(PDOException $e) {
  $connection->rollback();
  echo $e->getMessage();
 
}


return $transaction ;
}

function UpdateTeamAdmin2($imgid, $name , $w,  $d, $l  ){
  global $connection;
    $pts = ($w * 3) + $d;
    $queryUpteam = "UPDATE teams SET name = ?, w = ?, d = ?, l = ?, pts = ? WHERE id_img = ?";
    $upteam = $connection->prepare($queryUpteam);
  $upTm = $upteam -> execute([ $name , $w , $d , $l , $pts , $imgid]);
  return $upTm;    
}


function  DelTeams($id){
  global $connection;

  $delUser = "DELETE FROM images WHERE img_id = ? ";
   $prepareDelUser = $connection->prepare($delUser);
   $resDel = $prepareDelUser->execute([$id]);

  return $resDel;
}