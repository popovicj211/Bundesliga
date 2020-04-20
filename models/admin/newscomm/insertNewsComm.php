<?php
session_start();
header("Content-Type: application/json");
 $message = "";
 $code = 404;

if($_SERVER['REQUEST_METHOD'] != "POST"){
    echo "You don't have access on this page!";
    $code = 400;
 }
     
  if(isset($_POST['commAdmBtn'])&& $_SESSION['user']->role_id == 1){
      
     require_once "../../../config/connection.php";
     include "functions.php";

         $comm = $_POST['commAdmIns'];
         $regComm = "/^[A-ZČĆŽŠĐÜÖÄa-zčćžšđüöä\d\s\.\,\*\+\?\!\-\_\/\'\:\;\"\#\@\$\%\^]{5,}$/";

         $news_id = $_POST['listCommNewsAdm'];
         
        $user_id = $_SESSION['user']->user_id;

         $erorr = [];
          if(empty($_POST['listCommNewsAdm'])){
            $erorr[] = "News is not selected!";
          }
          
         if(!preg_match( $regComm, $comm) || empty($comm)){
                $erorr[] = "Comment is not valid!";
         }
 
        if(count($erorr) > 0){         
            
              $code = 422;
        }else{
           try{
             $insCAdm = InsertCommAdm( $user_id , $comm , $news_id );
           
                  if($insCAdm){
                        $code = 201;
                        $message = "Commment is successfully added";
                   }else{
                         $code = 500;
                    }
               }catch(PDOException $e){
                $code = 500;
                $dataError ="Error insert comment:".$e->getMessage()."\n";
                echo $dataError;
                SiteException($dataError);
               }
        }

    }
    echo json_encode(["message" => $message]);
    http_response_code($code);