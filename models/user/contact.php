<?php

 header("Content-Type:application/json");
 $code = 404;
$message = null;

if($_SERVER['REQUEST_METHOD'] != "POST"){
   echo "You don't have access on this page!";
   $status = 400;
}

if(isset($_POST['btncontact'])) 
   {
      require_once '../../config/connection.php';
      include "functions.php";
       $fname = $_POST['fnameC']; 
       $lname = $_POST['lnameC']; 
       $email = $_POST['emailC'];
       $subj = $_POST['subjectC'];
       $text = $_POST['messageC'];
  
       $regFname ="/^[A-ZČĆŠĐŽ][a-zčćšđž]{3,30}$/";
       $regLname ="/^[A-ZČĆŠĐŽ][a-zčćšđž]{3,30}(\s[A-ZČĆŠĐŽ][a-zčćšđž]{2,})*$/";
       $regText ="/^[A-ZČĆŠĐŽa-zčćšđž\d\s\.\,\*\+\?\!\-\_\/\'\:\;]{5,}$/";
      $arrayErrors = [];
     

      if(!preg_match($regFname, $fname))
      {
         array_push($arrayErrors, "Invalid firstname");
      }
      if(!preg_match($regLname, $lname))
      {
         array_push($arrayErrors, "Invalid lastname");
      }

      if(!filter_var($email, FILTER_VALIDATE_EMAIL))
      {
         array_push($arrayErrors, "Invalid email");
      }

      if(!preg_match($regLname, $subj))
      {
         array_push($arrayErrors, "Invalid subject");
      }

      if(!preg_match($regText,  $text))
      {
         array_push($arrayErrors, "Invalid text");
      }

      if(count($arrayErrors) != 0)
      {
       
     $code = 422;
     $message = ["message" => $arrayErrors];
  
 
      }else {
         try{
         $resInsert = ContactIns($fname , $lname , $email , $subj , $text );
        
          if($resInsert){
               $code = 201;
               $message = ["message" => "Contact entered successfully"];   
                
          }else{
            $code = 500;
            $message = ["message" => "Error"];
            
          }
         }catch(PDOException $e){
            $code = 500;
            $dataError ="Error contact form:".$e->getMessage()."\n";
            echo $dataError;
            SiteException($dataError);
         }    
        
     }

     http_response_code($code);
     echo json_encode($message); 
    

   }
 