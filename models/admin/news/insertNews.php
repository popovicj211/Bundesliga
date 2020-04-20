<?php
header("Content-Type:application/json");
//define("FILE_SIZE" , 2000000);
$code = 404;
if($_SERVER['REQUEST_METHOD'] != "POST"){
       echo "You don't have access on this page!";
    }

// $allowedTypes = ['image/jpeg' , 'image/jpg' , 'image/png'];
if(isset($_POST['btnInsNews'])&& $_SESSION['user']->role_id == 1){
      require_once "../../../config/connection.php";
      include "functions.php";

       $sizeMax = 2 * (1024 * 1024);
       $imageTypes = ['image/jpeg','image/jpg','image/png'];

      $imgProfile = imagedataAdmin($_FILES['insPhotoNews']);

      $file = time()."_".$imgProfile['nameImg'];
      $path = "../../../assets/images/".$file;
      $path_newimage = "assets/images/new_".$file;

       $errors = [];
       
       $team = $_POST['insTeamNews'];
       $name = $_POST['insNameNews'];
       $text = $_POST['insTextNews'];
      
        
      $regName ="/^[A-Z](([\wÜÖÄüöä\.\,\*\+\?\!\-\/\'\:\;\"])+(\s)?)+$/";
      $regText = "/^[A-ZÜÖÄa-züöä\d\s\.\,\*\+\?\!\-\_\/\'\:\;\"]{5,}$/";

        
     InarrayAdmin(  $imgProfile['typeImg'], $imageTypes, $errors);
     SizeImageAdmin($imgProfile['sizeImg'] ,  $sizeMax , $errors );
          
         if($team == "0"){
               array_push($erorrs , "Team is not selected");
          }

        if(!preg_match($regName,  $name))
        {
               array_push($errors, "Invalid name");
        }

         if(!preg_match($regText, $text))
         {
               array_push($errors, "Invalid text");
         }
      
       if(count($errors) != 0)
       {
      $code = 422;
       }else{
              $imgResize= imageresizeAdmin($imgProfile['tmpImg'] , $newWidth = 488  ,$imgProfile['typeImg'] , $path_newimage);
              $imgResize2 = explode("/", $imgResize);

              $alt = explode(".", $file);
              $altSm = $alt[0];

              if(move_uploaded_file($imgProfile['tmpImg'] , $path)){

       try{
                $ins = InsertNewsAdmin( $team , $name , $text, $imgResize2[2] , $altSm  );
              //  unlink("../../../assets/images/".$file);
                if($ins){
                       $code = 201;
                       $message = "Register is successfully";
                      header('Location: '. BASE_URL .'index.php?page=newsadmin');
                }else{
                       $code = 500;
                       header('Location: '. BASE_URL .'index.php?page=newsadmin');
                }
       }catch(PDOException $e){
              $code = 500;
              $dataError ="Error insert news:".$e->getMessage()."\n";
              echo $dataError;
              SiteException($dataError);
       }      
     }
    }
          
}

