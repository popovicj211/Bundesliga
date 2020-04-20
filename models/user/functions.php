<?php

function UpdateLogin($setLog ,$whereLog , $id , $trufal ){
    global $connection;
          $queryUpLog = "UPDATE user SET login = :setLog WHERE login = :whereLog";
          if($trufal == true){
              $queryUpLog .= " AND user_id = :id";
          }
          $queryPrepare = $connection -> prepare($queryUpLog);
          $queryPrepare -> bindParam(":setLog" , $setLog);
          $queryPrepare -> bindParam(":whereLog" , $whereLog);  
          if($trufal == true){  
           $queryPrepare -> bindParam(":id" , $id);
          }
          $queryExec = $queryPrepare -> execute();
          return $queryExec;
  }


  
function UpdateLogin2($setLog ,$whereLog ){
    global $connection;
          $queryUpLog = "UPDATE user SET login = :setLog WHERE login = :whereLog "; 
          $queryPrepare = $connection -> prepare($queryUpLog);
          $queryPrepare -> bindParam(":setLog" , $setLog);
          $queryPrepare -> bindParam(":whereLog" , $whereLog);    
          $queryExec = $queryPrepare -> execute();
          return $queryExec;
  }







  function InsertUser( $name , $username,  $email, $password  , $token , $fid , $href , $alt ){
    global $connection;
  try{
    $connection->beginTransaction();

 /* $queryInset = "INSERT INTO user (user_id , name ,username,email,password ,token, function_id)
 values (null, :name ,:usernm, :email, :pass ,:token, :fid)";
      $password = md5($password);
  $insertUsers = $connection->prepare($queryInset);
  $insertUsers->bindParam(":name", $name);
  $insertUsers->bindParam(":usernm", $username);
  $insertUsers->bindParam(":email", $email);
  $insertUsers->bindParam(":pass", $password);
  $token = md5(time().$email);
  $insertUsers->bindParam(":token", $token);
  $insertUsers->bindParam(":fid", $fid);
   $insertUsers->execute(); */

   $queryImage = "INSERT INTO images (img_id , href, alt ) values(null , ? , ?)";
    $InsertPhoto = $connection->prepare($queryImage);
    $InsertPhoto -> execute([ $href , $alt ]);
      
    $imgId = $connection -> lastInsertId();

   $queryInset = "INSERT INTO user (user_id , name ,username,email,password , dateregister ,token, role_id , img_id)
   values (null, ? , ?, ?, ? ,?, ? , ? , ?)";
    
   $password = md5($password);
   $dateregister = date("Y-m-d H:i:s");
    $insertUsers = $connection->prepare($queryInset);
    $insertUsers -> execute([$name , $username , $email , $password , $dateregister , $token , $fid , $imgId]);
    
    $transaction = $connection->commit();

  } catch(PDOException $e) {
    $connection->rollback();
    echo $e->getMessage();
   
  }


  return $transaction ;
  }



  function imagedata($image){
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


  function Inarray($typeImg , $imageTypes, $arrayErrors){
    $resIA = null;
           if(!in_array($typeImg , $imageTypes)){
     array_push($arrayErrors , "Type file isn't ok");
     $resIA = $arrayErrors;
        }
      return $resIA;
  }

  function SizeImage($sizeImg , $sizeMax , $arrayErrors ){
    $resS = null;
    if($sizeImg > $sizeMax){
       array_push($arrayErrors , "Size file isn't ok");
       $resS = $arrayErrors;
     }
     return $resS;
  }


  function imageresize($tmp_nameImg,  $newWidth ,$typeImg , $path_newimage){


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
           imagejpeg($newImage, '../../'.$path_newimage, 75);
           break;
       case 'image/png':
           imagepng($newImage, '../../'.$path_newimage);
           break;
   }

   imagedestroy($existingImage);
   imagedestroy($newImage);
   return $path_newimage;
  }


  function DelUser($act){
    global $connection;
    $connection->beginTransaction();
    try{
     $idImd = $connection -> lastInsertId();

    $delUser = "DELETE FROM user WHERE active = ? AND img_id = ? ";
     $prepareDelUser = $connection->prepare($delUser);
     $prepareDelUser->execute([$act , $idImd]);

     $delUser = "DELETE FROM images WHERE img_id = ? ";
     $prepareDelUser = $connection->prepare($delUser);
     $prepareDelUser->execute([$idImd]);

     $connection->commit();
    }catch(PDOException $e){
           $connection->rollback();
           echo $e -> getMessage();
    }
  }


  function Login($emailL , $passwordL){
           
  global $connection;
   $queryL = "SELECT * FROM user WHERE active = 1 AND email = :email AND password = :passwordL";
   $passwordL = md5($passwordL);
  $prepareL = $connection->prepare($queryL);
   $prepareL->bindParam(":email", $emailL);
   $prepareL->bindParam(":passwordL", $passwordL);
   
   return $prepareL->execute();

  }


function getUserPhotoAll(){
    return "SELECT * FROM user u INNER JOIN images i ON u.img_id = i.img_id";
}


  function UserPhotoHome($id){
      global $connection; 
      $queryPhoto = getUserPhotoAll();
      $queryPhoto .= " WHERE u.user_id = ?";
     $preparePhoto = $connection->prepare($queryPhoto);
     $preparePhoto -> execute([$id]);
      $getPhoto =  $preparePhoto->fetch();
     return  $getPhoto;
  }

    function showEmail(){
      return  executeQuery("SELECT email FROM user");
    }


  function ContactIns($fname , $lname , $emailC , $subj , $txt ){
    global $connection;
    $queryCont = 'INSERT INTO contact (con_id,firstname, lastname ,email, subject , text)
    values (null, :fnm, :lnm , :emailC, :subj , :textC)';
  $statement = $connection->prepare($queryCont);
  $statement->bindParam(":fnm", $fname);
  $statement->bindParam(":lnm", $lname);
  $statement->bindParam(":emailC", $emailC);
  $statement->bindParam(":subj", $subj);
  $statement->bindParam(":textC", $txt);
 $resInsert = $statement->execute(); 
  return $resInsert;
  }