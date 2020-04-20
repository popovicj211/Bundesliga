<?php
session_start();
header("Content-Type:application/json");

 use PHPMailer\PHPMailer\PHPMailer;
 use PHPMailer\PHPMailer\Exception;
 
 require '../php_mailer/src/Exception.php';
 require '../php_mailer/src/PHPMailer.php';
 require '../php_mailer/src/SMTP.php';


//$code = 404;
//$message = null;
$arrayErrors = [];
$message = "Page not found";   

if($_SERVER['REQUEST_METHOD'] != "POST"){
   echo "You don't have access on this page!";
   $message = "Bad request"; 
}


  if(isset($_POST['btnsignup']))
   {
      require_once '../../config/connection.php';
       include "functions.php";

       $sizeMax = 2 * (1024 * 1024);
       $imageTypes = ['image/jpeg','image/jpg','image/png'];

      $imgProfile = imagedata($_FILES['profile']);

      $file = time()."_".$imgProfile['nameImg'];
      $path = "../../assets/images/".$file;
      $path_newimage = "assets/images/new_".$file;
     


       $name = $_POST['regname'];
       $username = $_POST['regusername']; 
       $email = $_POST['regemail'];
       $password = $_POST['regpassword'];
  

         $regName ="/^[A-ZČĆŽŠĐ][a-zčćžšđ]{2,20}(\s[A-ZČĆŽŠĐ][a-zčćžšđ]{2,20})$/";
         $regUseR ="/^[\.\_\-\w\d\@]{3,20}$/"; 
         
       $regPassR ="/^[A-z0-9\.\-\*\_\$\:\;\@\,]{6,20}$/";
      
      $fid = 2;

      Inarray(  $imgProfile['typeImg'], $imageTypes, $arrayErrors);
      SizeImage($imgProfile['sizeImg'] ,  $sizeMax , $arrayErrors );

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

         $imgResize = imageresize($imgProfile['tmpImg'],  $newWidth = 50 , $imgProfile['typeImg'] , $path_newimage);
         $imgResize2 = explode("/", $imgResize);
         $alt = explode("." , $imgProfile['nameImg']  );

         if(move_uploaded_file($imgProfile['tmpImg'] , $path)){
            $token = md5(time().$email);
            $data = InsertUser($name ,  $username,  $email, $password  , $token ,  $fid  , $imgResize2[2] , $alt[0] );
         

             
        
    try{
        if($data){
             //  $code = 201;
           //    header("Location:".BASE_URL."index.php");
             // $message = ["message" => "Register is successfully"];
            
              $message = "Please verify your email address";
            
     $mail = new PHPMailer(true);            
try {
   //Server settings
   $mail->SMTPDebug = 0;                                      // Enable verbose debug output
 //  $mail->SMTPOptions = array('ssl' => array('verify_peer' => false, 'verify_peer_name'
//=> false,'allow_self_signed' => true));
   $mail->isSMTP();                                            // Set mailer to use SMTP
   $mail->Host       = 'smtp.gmail.com';  // Specify main and backup SMTP servers
   $mail->SMTPAuth   = true;                                   // Enable SMTP authentication
   $mail->Username   = 'armygamesict2@gmail.com';                     // SMTP username
   $mail->Password   = 'Ar25Gam2*';                               // SMTP password
   $mail->SMTPSecure = 'ssl';                                  // Enable TLS encryption, `ssl` also accepted
  // $mail->Port       = 587;                                    // TCP port to connect to
  $mail->Port = 465;
   //Recipients
   $mail->setFrom('armygamesict2@gmail.com', 'Registration Form');
  // $mail->addAddress($email);     // Add a recipient
  $mail->addAddress('armygamesict@gmail.com');

   // Content
   $mail->isHTML(true);                                  // Set email format to HTML
   $mail->Subject = 'Activate your account';
   $href = "http://localhost:8080/php2/sajt1/models/user/activate.php?a=" . $token;
    $mail->Body   = 'To activate your account please fallow <a href="' . $href . '">this</a> link';

   $mail->send();
   echo 'Message has been sent';
} catch (Exception $e) {
   echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
}
           
          
          }else{


           $message = "Error";
           header('Location: '. BASE_URL .'index.php?page=index');
          }
    }catch(PDOException $e){
         // $code = 500;
         $message = "Email or username exist!";
         $dataError ="Error register:".$e->getMessage()."\n";
         echo $dataError;
         SiteException($dataError);
    }
   }  
     }
     $_SESSION['messageRegister'] = $message;
     header('Location: '. BASE_URL .'index.php?page=matches');
   }
 

  