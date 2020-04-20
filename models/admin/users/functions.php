<?php
/*
function queryGetUsers(){
      return  executeQuery("SELECT u.* , i.href , i.alt FROM user u INNER JOIN images i ON i.img_id = u.img_id");     
}*/

function getUsers(){
  return "SELECT u.* , i.href , i.alt FROM user u INNER JOIN images i ON i.img_id = u.img_id";
}

function Func(){
  return executeQuery("SELECT * FROM role");
}


function queryGetUsers(){
  return  executeQuery(getUsers());     
}

function CountUsers(){
  return "SELECT COUNT(*) as counts FROM user";
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

function getQueryLimit($limit , $func){
  global $connection;
  $queryRes = $func;
 $queryRes .= $limit;
  $resultRLimit = executeQuery($queryRes);
  return $resultRLimit;
}




function InsertUserAdmin( $name , $username,  $email, $password  , $token , $active , $fid , $href , $alt ){
  global $connection;
try{
  $connection->beginTransaction();


 $queryImage = "INSERT INTO images (img_id , href, alt ) values(null , ? , ?)";
  $InsertPhoto = $connection->prepare($queryImage);
  $InsertPhoto -> execute([ $href , $alt ]);
    
  $imgId = $connection -> lastInsertId();

 $queryInset = "INSERT INTO user (user_id , name ,username,email,password , dateregister ,token, active , role_id , img_id)
 values (null, ? , ?, ?, ? ,?, ? , ? , ? , ?)";
  
 $password = md5($password);
 $dateregister = date("Y-m-d H:i:s");
  $insertUsers = $connection->prepare($queryInset);
  $insertUsers -> execute([$name , $username , $email , $password , $dateregister , $token ,  $active, $fid , $imgId]);
  
  $transaction = $connection->commit();

} catch(PDOException $e) {
  $connection->rollback();
  echo $e->getMessage();
 
}


return $transaction ;
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
/*
function GetIdImg($id){
  global $connection;
  $queryImg = "SELECT u.img_id FROM user u INNER JOIN images i ON i.img_id = u.img_id WHERE user_id = ?";
  $prImg = $connection->prepare($queryImg);
    $prImg->execute([$id ]);
  $roes = $prImg->fetch();
   $roesImgId = $roes->img_id;

   return $idImd = intval($roesImgId);
}*/

/*

function DelUsers($id){
  global $connection;
  $connection->beginTransaction();
  try{
   //$idImd = $connection -> lastInsertId();

   $queryImg = "SELECT u.img_id FROM user u INNER JOIN images i ON i.img_id = u.img_id WHERE user_id = ?";
   $prImg = $connection->prepare($queryImg);
     $prImg->execute([$id ]);
   $roes = $prImg->fetch();
    $roesImgId = $roes->img_id;

  $idImd = intval($roesImgId);
 // $idImd = GetIdImg($id);
  $delUser = "DELETE FROM user WHERE  user_id = ?  AND img_id = ? ";
   $prepareDelUser = $connection->prepare($delUser);
   $prepareDelUser->execute([$id , $idImd]);

   $delUser = "DELETE FROM images WHERE img_id = ? ";
   $prepareDelUser = $connection->prepare($delUser);
   $prepareDelUser->execute([$idImd]);

  $transactionDel = $connection->commit();
  }catch(PDOException $e){
         $connection->rollback();
         echo $e -> getMessage();
  }

  return $transactionDel;

}

*/



function DelUsers($id){
  global $connection;
   $delUser = "DELETE FROM images WHERE img_id = ? ";
   $prepareDelUser = $connection->prepare($delUser);
  $reDel = $prepareDelUser->execute([$id]);
  return $reDel;

}


function getUserPhotoAllAdmin(){
  return "SELECT * FROM user u INNER JOIN images i ON u.img_id = i.img_id";
}


function UserPhotoHomeAdmin($id){
    global $connection; 
    $queryPhoto = getUserPhotoAllAdmin();
    $queryPhoto .= " WHERE u.user_id = ?";
   $preparePhoto = $connection->prepare($queryPhoto);
   $preparePhoto -> execute([$id]);
    $getPhoto =  $preparePhoto->fetch();
   return  $getPhoto;
}

function getUser($upId){
  global $connection;
  $queryGet = "SELECT u.* , i.href , i.alt , r.name as roleName FROM role r INNER JOIN  user u ON u.role_id = r.role_id INNER JOIN images i ON i.img_id = u.img_id";
  $queryGet.= " WHERE u.img_id = :id";
  $upPrepare = $connection->prepare($queryGet);
  $upPrepare->bindParam(":id",  $upId );
     $upPrepare->execute();
       $upUsers = $upPrepare->fetch();
       return $upUsers;
}

function UpdateUserPass( $name , $username , $email , $pass  , $token,  $active , $roleid , $imgId , $image , $alt ){
  global $connection;

    $connection->beginTransaction();
    try{
    
     $date = date("Y-m-d H:i:s");

  if(isset($pass)){ 
        $queryUsr = "UPDATE user SET name=? , username=?, email=?, password=?, dateregister=? , token=? ,active=?, role_id=?  WHERE img_id=?";
        $pass = md5($pass);
        $updatePr = $connection->prepare($queryUsr); 
        $updatePr->execute([ $name , $username , $email , $pass , $date ,$token , $active , $roleid , $imgId]);
  
}else{
  $queryUsr = "UPDATE user SET name=? , username=?, email=?,  dateregister=? , token=? ,active=?, role_id=?  WHERE img_id=?";
  $updatePr = $connection->prepare($queryUsr); 
  $updatePr->execute([ $name , $username , $email , $date ,$token , $active , $roleid , $imgId]);
}

 $queryImgu = "UPDATE images SET href=? , alt=? WHERE img_id=?";  
  $updatePri = $connection->prepare($queryImgu); 
  $updatePri->execute([ $image , $alt ,  $imgId]);

  $transactionUp = $connection->commit();
  
  }catch(PDOException $e){
    $connection->rollback();
        $e->getMessage();
  }

   return $transactionUp;
}



function UpdateUserPass2( $name , $username , $email , $pass  , $token,  $active , $roleid , $imgId ){
  global $connection;

    $connection->beginTransaction();
    try{
    
     $date = date("Y-m-d H:i:s");

  if(isset($pass)){ 
        $queryUsr = "UPDATE user SET name=? , username=?, email=?, password=?, dateregister=? , token=? ,active=?, role_id=?  WHERE img_id=?";
        $pass = md5($pass);
        $updatePr = $connection->prepare($queryUsr); 
        $updatePr->execute([ $name , $username , $email , $pass , $date ,$token , $active , $roleid , $imgId]);
  
}else{
  $queryUsr = "UPDATE user SET name=? , username=?, email=?,  dateregister=? , token=? ,active=?, role_id=?  WHERE img_id=?";
  $updatePr = $connection->prepare($queryUsr); 
  $updatePr->execute([ $name , $username , $email , $date ,$token , $active , $roleid , $imgId]);
}


  $transactionUp = $connection->commit();
  
  }catch(PDOException $e){
    $connection->rollback();
        $e->getMessage();
  }

   return $transactionUp;
}






