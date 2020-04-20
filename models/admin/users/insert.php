<?php
header("Content-Type:application/json");




//$code = 404;
//$message = null;
$arrayErrors = [];
   

if($_SERVER['REQUEST_METHOD'] != "POST"){
   echo "You don't have access on this page!";
}


if(isset($_POST['adminInsertSub'])&& $_SESSION['user']->role_id == 1) 
   {
      require_once '../../../config/connection.php';
       include "functions.php";

       $sizeMax = 2 * (1024 * 1024);
       $imageTypes = ['image/jpeg','image/jpg','image/png'];

      $imgProfile = imagedataAdmin($_FILES['profileInsert']);

      $file = time()."_".$imgProfile['nameImg'];
      $path = "../../../assets/images/".$file;
      $path_newimage = "assets/images/new_".$file;
     


       $name = $_POST['adminInsertName'];
       $username = $_POST['adminFormInsertname']; 
       $email = $_POST['adminInsertEmail'];
       $password = $_POST['adminInsertPass'];
       $role = $_POST['adminInsertRole'];
       $active = isset($_POST['adminInsertActive']) ? $_POST['adminInsertActive'] : null ;
    
         $regName ="/^[A-ZČĆŽŠĐ][a-zčćžšđ]{2,20}(\s[A-ZČĆŽŠĐ][a-zčćžšđ]{2,20})$/";
         $regUseR ="/^[\.\_\-\w\d\@]{3,20}$/"; 
         
       $regPassR ="/^[A-z0-9\.\-\*\_\$\:\;\@\,]{6,20}$/";
      
    

      InarrayAdmin(  $imgProfile['typeImg'], $imageTypes, $arrayErrors);
      SizeImageAdmin($imgProfile['sizeImg'] ,  $sizeMax , $arrayErrors );

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

      if(!preg_match($regPassR,  $password))
      {
         array_push($arrayErrors, "Invalid password");
      }
   
     
      if($role == "0"){
          array_push($arrayErrors, "Invalid role");
      }

      if(empty($active))
      {
         array_push($arrayErrors, "Active is not checked ");
      }

      if(count($arrayErrors) != 0)
      {
    
    // $code = 422;
   //  $message =  ["message" => $arrayErrors];
   $message = $arrayErrors;
      }else {
         
      /*   $query = 'INSERT INTO user (user_id ,username,email,password,verifypassword,token , function_id)
           values (null,:usernm, :email, :pass, :verifypass,:token, :fid)';
           $password = md5($password);
           $verifyPasword = md5($verifyPasword);
         $statement = $connection->prepare($query);
         $statement->bindParam(":usernm", $username);
         $statement->bindParam(":email", $email);
         $statement->bindParam(":pass", $password);
         $statement->bindParam(":verifypass", $verifyPasword );
         $token = md5(time().$email);
         $statement->bindParam(":token", $token );
         $statement->bindParam(":fid", $fid);*/

         $imgResize = imageresizeAdmin($imgProfile['tmpImg'],  $newWidth = 50 , $imgProfile['typeImg'] , $path_newimage);
         $imgResize2 = explode("/", $imgResize);
         $alt = $name;

         if(move_uploaded_file($imgProfile['tmpImg'] , $path)){
            $token = md5(time().$email);
            $data = InsertUserAdmin($name ,  $username,  $email, $password  , $token ,  $active , $role , $imgResize2[2] , $alt );
         

             
        
    try{
        if($data){
             //  $code = 201;
             // $message = ["message" => "Register is successfully"];
              $message = "Register is successfully";
                
          }else{
          //  $code = 500;
           // $message = ["message" => "Error on server"];
           $message = "Error";
           header('Location: '. BASE_URL .'index.php?page=usersadmin');
          }
    }catch(PDOException $e){
         // $code = 500;
         $dataError ="Error insert user:".$e->getMessage()."\n";
         echo $dataError;
         SiteException($dataError);
    }
   }  
     }
     
   header('Location: '. BASE_URL .'index.php?page=usersadmin');


  //   echo "<script type='text/javascript'>alert('$message');</script>";

   }
 