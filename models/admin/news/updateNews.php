<?php
/*header("Content-Type:application/json");

$code = 404;

if($_SERVER['REQUEST_METHOD'] != "POST"){
       echo "You don't have access on this page!";
       $code = 400;
    }


if(isset($_POST['btnUpNews'])){
      require_once "../../../config/connection.php";
      include "functions.php";

      $imgUploadNews = $_FILES['upPhotoNews'];
     $imgExistNews = $_POST['upExistPhotoNews'];
     $newsid = $_POST['upIdNews'];
     $imgid = $_POST['upIdImgN'];
     $teamName = $_POST['upTeamNews'];
     $newsName = $_POST['upNameNews'];
     $text = $_POST['upTextNews'];
     $errors = [];
     $data = "";
     $image = "";

     $alt = substr($imgExistNews ,14,-4 );

     $regName ="/^[A-Z](([\wÜÖÄüöä\.\,\*\+\?\!\-\/\'\:\;\"])+(\s)?)+$/";
     $regText ="/^[A-ZÜÖÄa-züöä\d\s\.\,\*\+\?\!\-\_\/\'\:\;\"]{5,}$/";  
       $regImgExist ="/^assets\/images\/[\w]{3,50}\.(jpg|png)$/";

     
       

       if($teamName == "0"){
        array_push($erorrs , "Team is not selected");
         }

       if(!preg_match($regName,  $newsName))
         {
         array_push($errors, "Invalid name");
         }

         if(!preg_match($regText, $text))
         {
            array_push($errors, "Invalid text");
          }
     
          if(isset($imgExistNews)){
                   $image = $imgExistNews;
          } else if(isset($imgUploadNews)){

       $sizeMax = 2 * (1024 * 1024);
       $imageTypes = ['image/jpeg','image/jpg','image/png'];

      $imgProfile = imagedataAdmin($_FILES['upPhotoNews']);

      $file = time()."_".$imgProfile['nameImg'];
      $path = "../../../assets/images/".$file;
      $path_newimage = "assets/images/new_".$file;

      $altSm = explode(".", $file);
              $alt = $altSm[0];
        
     InarrayAdmin(  $imgProfile['typeImg'], $imageTypes, $errors);
     SizeImageAdmin($imgProfile['sizeImg'] ,  $sizeMax , $errors );

     $imgResize= imageresizeAdmin($imgProfile['tmpImg'] , $newWidth = 488  ,$imgProfile['typeImg'] , $path_newimage);
     if(move_uploaded_file($imgProfile['tmpImg'] , $path)){
        $image = $imgResize;
      }
          
    }   
      
       if(count($errors) != 0)
       {
      $code = 422;
       }else{
            
      try{
                $upN = UpdateNewsAdmin( $teamName , $newsName , $text, $image , $alt , $newsid,  $imgid  );

                if($upN){
                       $code = 201;
                       $message = "Register is successfully";
                     // header('Location: '. BASE_URL .'index.php?page=newsadmin');
                }else{
                       $code = 500;
                    //   header('Location: '. BASE_URL .'index.php?page=newsadmin');
                }
       }catch(PDOException $e){
          echo $e->getMessage();
           $code = 500;
       }      
     
    }
          
}

*/


header("Content-Type:application/json");

$code = 404;

if($_SERVER['REQUEST_METHOD'] != "POST"){
       echo "You don't have access on this page!";
       $code = 400;
    }


if(isset($_POST['btnUpNews'])&& $_SESSION['user']->role_id == 1){
      require_once "../../../config/connection.php";
      include "functions.php";

      $imgUploadNews = $_FILES['upPhotoNews'];
 //    $imgExistNews = $_POST['upExistPhotoNews'];
     $newsid = $_POST['upIdNews'];
     $imgid = $_POST['upIdImgN'];
     $teamName = $_POST['upTeamNews'];
     $newsName = $_POST['upNameNews'];
     $text = $_POST['upTextNews'];
     $errors = [];
    // $data = "";
     $showUpload = empty($_POST['showUpload']) ? null : $_POST['showUpload'] ;  

   //  $image = "";
  //   $alt = substr($imgExistNews ,14,-4 );;
     $regName ="/^[A-Z](([\wÜÖÄüöä\.\,\*\+\?\!\-\/\'\:\;\"])+(\s)?)+$/";
     $regText ="/^[A-ZÜÖÄa-züöä\d\s\.\,\*\+\?\!\-\_\/\'\:\;\"]{5,}$/";  

       if($teamName == "0"){
        array_push($erorrs , "Team is not selected");
         }

       if(!preg_match($regName,  $newsName))
         {
         array_push($errors, "Invalid name");
         }

         if(!preg_match($regText, $text))
         {
            array_push($errors, "Invalid text");
          }
     
            if(count($errors) == 0) {
              if(isset($showUpload)){
                   if(isset($imgUploadNews)){

                                 $sizeMax = 2 * (1024 * 1024);
                                 $imageTypes = ['image/jpeg','image/jpg','image/png'];

                                 $imgProfile = imagedataAdmin($_FILES['upPhotoNews']);

                                 $file = time()."_".$imgProfile['nameImg'];
                                 $path = "../../../assets/images/".$file;
                                 $path_newimage = "assets/images/new_".$file;

                                 $altSm = explode(".",  $imgProfile['nameImg']);
                                  $alt = $altSm[0];
        
                                  InarrayAdmin(  $imgProfile['typeImg'], $imageTypes, $errors);
                                 SizeImageAdmin($imgProfile['sizeImg'] ,  $sizeMax , $errors );

                                  $imgResize= imageresizeAdmin($imgProfile['tmpImg'] , $newWidth = 488  ,$imgProfile['typeImg'] , $path_newimage);
                                  $imgResize2 = explode("/", $imgResize);
                                   if(move_uploaded_file($imgProfile['tmpImg'] , $path)){
                                                
                                                  try{
                                                    $upN = UpdateNewsAdmin( $teamName , $newsName , $text,  $imgResize2[2] ,$alt , $newsid,  $imgid );
                                                            if($upN){
                                                                   $code = 204;
                                                                   $message = "Update is successfully";
                                                                 // header('Location: '. BASE_URL .'index.php?page=newsadmin');
                                                            }else{
                                                                   $code = 500;
                                                                //   header('Location: '. BASE_URL .'index.php?page=newsadmin');
                                                            }
                                                   }catch(PDOException $e){
                                                    $code = 500;
                                                    $dataError ="Error update news:".$e->getMessage()."\n";
                                                    echo $dataError;
                                                    SiteException($dataError);       
                                                   }      

                                   }
          
                 }
            }else{
              try{
                $upN2 = UpdateNewsAdmin2( $teamName , $newsName , $text , $newsid,  $imgid );
                        if($upN2){
                               $code = 204;
                               $message = "Update is successfully";
                             // header('Location: '. BASE_URL .'index.php?page=newsadmin');
                        }else{
                               $code = 500;
                           //    header('Location: '. BASE_URL .'index.php?page=newsadmin');
                        }
               }catch(PDOException $e){
                $code = 500;
                $dataError ="Error update news:".$e->getMessage()."\n";
                echo $dataError;
                SiteException($dataError);       
               }      
            }
      }else{
        $code = 422;
      }
      header('Location: '. BASE_URL .'index.php?page=newsadmin');
     
    }
          
