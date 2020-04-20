<?php
session_start();
header("Content-Type: application/json");
 $message = "";
 $code = 404;

if($_SERVER['REQUEST_METHOD'] != "POST"){
    echo "You don't have access on this page!";
    $code = 400;
 }
     
  if(isset($_POST['btncommnews'])){
      
     require_once "../../config/connection.php";
     include "functions.php";

         $comm = $_POST['commnews'];
         $regComm = "/^[A-ZČĆŽŠĐÜÖÄa-zčćžšđüöä\d\s\.\,\*\+\?\!\-\_\/\'\:\;\"\#\@\$\%\^]{5,}$/";

         $news_id = $_POST['newSId'];
         
        $user_id = $_SESSION['user']->user_id;

         $erorr = "";
         if(!preg_match( $regComm, $comm) || empty($_POST['commnews'])){
                $erorr = "Comment is not valid!";
                $code = 422;
         }
 
        if($erorr != ""){         
              $message = $erorr;
        }else{
           try{
             $insC = InsertComm( $user_id , $comm , $news_id );
           
                  if($insC){
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