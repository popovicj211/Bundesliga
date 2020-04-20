<?php
 //ob_start();
//session_start();


if($_SERVER['REQUEST_METHOD'] != "POST"){
    echo "You don't have access on this page!";
}



if(isset($_POST['btnUpSch']) && $_SESSION['user']->role_id == 1){
    require_once '../../../config/connection.php';
    require_once 'functions.php';

     $imgUpload = $_FILES['upPhotoTeam'];
     $teamid = $_POST['idTeam'];
     $name = $_POST['upNameTeam'];
     $w = $_POST['upWTeam'];
     $d = $_POST['upDTeam'];
     $l = $_POST['upLTeam'];
     $showUpload = empty($_POST['showUploadTeam']) ? null : $_POST['showUploadTeam'] ; 
  
    $arrayErrors = [];

    $regName ="/^[A-Z](([\wÜÖÄüöä])+(\s)?)+$/";
     $regNumb ="/^[\d]{1,3}$/";  
      
       if(!preg_match($regName,  $name))
       {
          array_push($arrayErrors, "Invalid name");
       }
 
       if(!preg_match($regNumb, $w))
       {
          array_push($arrayErrors, "Invalid number of matches won");
       }
 
       if(!preg_match($regNumb, $d))
       {
          array_push($arrayErrors, "Invalid number of matches draw");
       }
 
       if(!preg_match($regNumb,  $l))
       {
          array_push($arrayErrors, "Invalid number of matches lost");
       }
    
       
       if(count($arrayErrors) == 0) {
         if(isset($showUpload)){
              if(isset($imgUpload)){
        
                               $sizeMax = 2 * (1024 * 1024);
                               $imageTypes = ['image/jpeg','image/jpg','image/png'];

                                $imgProfile = imagedataAdmin($_FILES['upPhotoTeam']);

                                $file = time()."_".$imgProfile['nameImg'];
                                  $path = "../../../assets/images/".$file;
                              $path_newimage = "assets/images/new_".$file;

         
                              InarrayAdmin(  $imgProfile['typeImg'], $imageTypes, $arrayErrors);
                              SizeImageAdmin($imgProfile['sizeImg'] ,  $sizeMax , $arrayErrors );

                               $imgResize = imageresizeAdmin($imgProfile['tmpImg'],  $newWidth = 50 , $imgProfile['typeImg'] , $path_newimage);
                               $imgResize2 = explode("/", $imgResize);
                                $altr = explode("." , $imgProfile['nameImg']  );
                                $alt = $altr[0];
                                 if(move_uploaded_file($imgProfile['tmpImg'] , $path)){
                                          try{
                                                 $upTeam =  UpdateTeamAdmin($teamid, $name , $w,  $d, $l , $imgResize2[2] , $alt );
                                                  if($upTeam) {
                                                       $status = 204;
                                                           //   header('Location: '. BASE_URL .'index.php?page=teamsadmin');
                                                   } else { 
                                                        $status = 500;
                                                      //    header('Location: '. BASE_URL .'index.php?page=teamsadmin');
                                                       
                                                      }
                                             }catch(PDOException $e){
                                                    $dataError ="Error update team:".$e->getMessage()."\n";
                                                      echo $dataError;
                                                     SiteException($dataError);
                                              }
                           
                                   }
  
             }
         }else{
                 try{
                          $upTeam2 =  UpdateTeamAdmin2($teamid, $name , $w,  $d, $l  );
                             if($upTeam2) {
                                     $status = 204;
                                     //   header('Location: '. BASE_URL .'index.php?page=teamsadmin');
                               } else { 
                                     $status = 500;
                                    //    header('Location: '. BASE_URL .'index.php?page=teamsadmin');
                     
                                }
                     }catch(PDOException $e){
                                $dataError ="Error update team:".$e->getMessage()."\n";
                                  echo $dataError;
                                  SiteException($dataError);
                    }
         }
     }else{
      $code = 422;
     }
     header('Location: '. BASE_URL .'index.php?page=teamsadmin');       
}













