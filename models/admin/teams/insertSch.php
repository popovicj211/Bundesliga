<?php
header("Content-Type:application/json");
//define("FILE_SIZE" , 2000000);
$code = 404;
if($_SERVER['REQUEST_METHOD'] != "POST"){
       echo "You don't have access on this page!";
    }

// $allowedTypes = ['image/jpeg' , 'image/jpg' , 'image/png'];
if(isset($_POST['btnInsSch'])&& $_SESSION['user']->role_id == 1){
      require_once "../../../config/connection.php";
      include "functions.php";

    /*  $file = $_FILES['insPhotoTeam'];
       $size = $file['size'];
       $type = $file['type'];
       
       $tmp = $file['tmp_name'];
       $fileName = $file['name'];
       $fileLoc = time()."_team_".$fileName;
       $path = "../../../assets/images/".$fileLoc;
       $dbFile = "assets/images/".$fileLoc;*/

       $sizeMax = 2 * (1024 * 1024);
       $imageTypes = ['image/jpeg','image/jpg','image/png'];

      $imgProfile = imagedataAdmin($_FILES['insPhotoTeam']);

      $file = time()."_".$imgProfile['nameImg'];
      $path = "../../../assets/images/".$file;
      $path_newimage = "assets/images/new_".$file;

       $errors = [];

       $name = $_POST['insNameTeam'];
       $w = $_POST['insWTeam'];
       $d = $_POST['insDTeam'];
       $l = $_POST['insLTeam'];
      
        
      $regName ="/^[A-Z](([\wÜÖÄüöä])+(\s)?)+$/";
       $regNumb ="/^[\d]{1,3}$/";  
     $imgExist ="/^assets\/images\/[\w]{3,50}\.(jpg|png)$/";
        
     InarrayAdmin(  $imgProfile['typeImg'], $imageTypes, $errors);
     SizeImageAdmin($imgProfile['sizeImg'] ,  $sizeMax , $errors );

        if(!preg_match($regName,  $name))
        {
               array_push($errors, "Invalid name");
        }

         if(!preg_match($regNumb, $w))
         {
               array_push($errors, "Invalid number of matches won");
         }

          if(!preg_match($regNumb, $d))
          {
               array_push($errors, "Invalid number of matches draw");
          }

          if(!preg_match($regNumb,  $l))
          {
                 array_push($errors, "Invalid number of matches lost");
          }

    /*   if(!in_array($type , $allowedTypes)){
              array_push($errors , "Type of file is not valid");
       } else if($size > FILE_SIZE){
               array_push($errors , "Size of file is not valid");
       } else*/
      
       if(count($errors) != 0)
       {
      $code = 422;
       }else{
              $imgResize = imageresizeAdmin($imgProfile['tmpImg'],  $newWidth = 50 , $imgProfile['typeImg'] , $path_newimage);
              $imgResize2 = explode("/", $imgResize);
              $alt = $name;
              if(move_uploaded_file($imgProfile['tmpImg'] , $path)){

       try{
                $ins = InsertTeamAdmin( $name , $w,  $d, $l , $imgResize2[2] , $alt );
                if($ins){
                       $code = 201;
                       header('Location: '. BASE_URL .'index.php?page=teamsadmin');
                }else{
                       $code = 500;
                       header('Location: '. BASE_URL .'index.php?page=teamsadmin');
                }
       }catch(PDOException $e){
              $dataError ="Error insert team:".$e->getMessage()."\n";
              echo $dataError;
              SiteException($dataError);
       }      
     }
    }
               
}

//http_response_code($code);