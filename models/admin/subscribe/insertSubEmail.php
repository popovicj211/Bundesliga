<?php
header("Contant-Type: application/json");

$code = 404;

if($_SERVER['REQUEST_METHOD'] != "POST"){
    echo "You don't have access on this page!";
    $code = 400;
 }

  if(isset($_POST['subEmBtn'])&& $_SESSION['user']->role_id == 1){

     require_once "../../../config/connection.php";
     include "functions.php";

         $emailS = $_POST['addSubEmail'];
        $error = null;
        

        if(!filter_var($emailS, FILTER_VALIDATE_EMAIL)){
            $error = "Email is not valid";
        }

        $existEmail = ExistEmail($emailS);

          
        if(!empty($error)){
              $code = 422;
             
        }
        else if($existEmail == true) {
            $code = 409;
        }else{
            try{  
             $insSub = insertSubEm($emailS);
            
                  if($insSub){
                        $code = 201;
            
                   }else{
                         $code = 500;
                    }
               }catch(PDOException $e){
                $code = 500;
                $dataError ="Error insert email for subscribe:".$e->getMessage()."\n";
                echo $dataError;
                SiteException($dataError);
               }
        }

    }
    http_response_code($code);
