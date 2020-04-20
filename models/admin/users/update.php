<?php
 //ob_start();
//session_start();


if($_SERVER['REQUEST_METHOD'] != "POST"){
    echo "You don't have access on this page!";
}

//$status = 404;

if(isset($_POST['adminUpdateSub'])&& $_SESSION['user']->role_id == 1){
    require_once '../../../config/connection.php';
    require_once 'functions.php';

     $imgUpload = $_FILES['profileUpdate'];
   $showUpload = empty($_POST['showUploadUser']) ? null : $_POST['showUploadUser'] ;  
    $imgId = $_POST['hiddenUserId'];
    $email = $_POST['adminUpdateEmail'];
    $name = $_POST['adminUpdateName'];
    $username = $_POST['adminFormUpdatename'];
    $pass = isset($_POST['adminUpdatePass']) ? $_POST['adminUpdatePass'] : null ;
    $roleid = $_POST['adminUpdateRole'];
    $active = isset($_POST['adminUpdateActive']) ? $_POST['adminUpdateActive'] : null ;
    $token = md5(time().$email);
    $arrayErrors = [];
 
    
    $regName ="/^[A-ZČĆŽŠĐ][a-zčćžšđ]{2,20}(\s[A-ZČĆŽŠĐ][a-zčćžšđ]{2,20})$/";
     $regUseR ="/^[\.\_\-\w\d\@]{3,20}$/";  
       $regPassR ="/^[A-z0-9\.\-\*\_\$\:\;\@\,]{6,20}$/";
      
       if(!preg_match($regName, $name))
       {
          array_push($arrayErrors, "Invalid name");
       }
 
       if(!preg_match($regUseR, $username))
       {
          array_push($arrayErrors, "Invalid username");
       }
 
       if(!filter_var($email, FILTER_VALIDATE_EMAIL))
       {
          array_push($arrayErrors, "Invalid email");
       }
      
       if($roleid == "0"){
           array_push($arrayErrors, "Invalid role");
       }
 
       if(empty($active))
       {
          array_push($arrayErrors, "Active is not checked ");
       }

    if(count($arrayErrors) == 0) {
      if(isset($showUpload)){
           if(isset($imgUpload)){
                                   $sizeMax = 2 * (1024 * 1024);
                                     $imageTypes = ['image/jpeg','image/jpg','image/png'];

                                       $imgProfile = imagedataAdmin($_FILES['profileUpdate']);

                                     $file = time()."_".$imgProfile['nameImg'];
                                      $path = "../../../assets/images/".$file;
                                      $path_newimage = "assets/images/new_".$file;

                                         InarrayAdmin(  $imgProfile['typeImg'], $imageTypes, $arrayErrors);
                                       SizeImageAdmin($imgProfile['sizeImg'] ,  $sizeMax , $arrayErrors );

                                      $altSm = explode(".", $file);
                                        $alt = $altSm[0];
  
                                       $imgResize = imageresizeAdmin($imgProfile['tmpImg'],  $newWidth = 50 , $imgProfile['typeImg'] , $path_newimage);
                                       $imgResize2 = explode("/", $imgResize);
                                   if(move_uploaded_file($imgProfile['tmpImg'] , $path)){
                                                  
                                                  try{
                                                    $upUsr = UpdateUserPass( $name , $username , $email , $pass , $token,  $active , $roleid , $imgId , $imgResize2[2] , $alt );
                                                            if($upUsr){
                                                                   $code = 204;
                                                                   $message = "Update is successfully";
                                                                 // header('Location: '. BASE_URL .'index.php?page=newsadmin');
                                                            }else{
                                                                   $code = 500;
                                                                //   header('Location: '. BASE_URL .'index.php?page=newsadmin');
                                                            }
                                                   }catch(PDOException $e){
                                                    $code = 500;
                                                    $dataError ="Error update user:".$e->getMessage()."\n";
                                                    echo $dataError;
                                                    SiteException($dataError);       
                                                   }   
                                     }
                    }     
                }else{
                      try{
                        $upUsr2 =  UpdateUserPass2( $name , $username , $email , $pass , $token,  $active , $roleid , $imgId  );
                                if($upUsr2){
                                       $code = 204;
                                       $message = "Update is successfully";
                                     // header('Location: '. BASE_URL .'index.php?page=newsadmin');
                                }else{
                                       $code = 500;
                                   //    header('Location: '. BASE_URL .'index.php?page=newsadmin');
                                }
                       }catch(PDOException $e){
                        $code = 500;
                        $dataError ="Error update user:".$e->getMessage()."\n";
                        echo $dataError;
                        SiteException($dataError);       
                       }      
                    }
              }else{
                $code = 422;
              }
              header('Location: '. BASE_URL .'index.php?page=usersadmin');       
}

