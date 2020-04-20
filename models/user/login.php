<?php
 //ob_start();
session_start();

   header("Content-Type:application/json");
   $code = 404;
$message = null;



if($_SERVER['REQUEST_METHOD'] != "POST"){
    echo "You don't have access on this page!";
 }

               if(isset($_POST['btnlog'])) {
                
                require_once '../../config/connection.php';
                include "functions.php";

                  $emailL = $_POST['logemail'];
                  $passwordL = $_POST['logpassword'];
                $errorsL = [];
               
                $regPassL = "/^[A-z0-9\.\-\*\_\$\:\;\@\,]{6,20}$/";
                

                if(!filter_var($emailL , FILTER_VALIDATE_EMAIL)){
                    $errorsL[] ="Invalid email";
                }

                if(!preg_match($regPassL,$passwordL)){
                    $errorsL[] ="Invalid password";
                }

                if(count($errorsL) > 0){
                        $_SESSION['errors'] = $errorsL;
                        $code = 422;
                        header("Location: ".BASE_URL."index.php");
                        $message = ["message" => $errorsL];
                }else {        
                    $queryL = "SELECT * FROM user WHERE active = 1 AND email = :email AND password = :passwordL";
                    $passwordL = md5($passwordL);
                   $prepareL = $connection->prepare($queryL);
                    $prepareL->bindParam(":email", $emailL);
                    $prepareL->bindParam(":passwordL", $passwordL);
       

              try{    
                  $restL = $prepareL->execute();    
                  if($restL){
                      if($prepareL->rowCount()==1){
                        $userRow = $prepareL->fetch();
                        header($_SERVER["SERVER_PROTOCOL"]." 200 OK");
                        header('Location: '. BASE_URL .'index.php?page=news');
                       
                        $message = ["message" => "LogIn is succesfully"];
                        $code=200;
                        $_SESSION['user_id'] = $userRow->user_id;
                        $_SESSION['user'] = $userRow;   

                  /*     if($_SESSION['user']->function_id == 1){
                    
                            header("Location: ".BASE_URL."index.php?page=table");
                        } else {
                            header("Location: ".BASE_URL."index.php?page=index");
                        }*/
                        
                     //   if(isset($_SESSION['user'])){

                       
                 //      UpdateLogin($setLog = 1 ,$whereLog = 0 , $_SESSION['user']->user_id , $trufal = true );
                    //   }

                       
                      } else {
                      
                        
                        if($prepareL->rowCount() == 0){
                           // echo "<br/> You are not registered!!";
                           $message = ["message" => "LogIn is not valid!"];
                           header($_SERVER["SERVER_PROTOCOL"]." 401 UNAUTHORIZED");
                            $code = 401;
                            header('Location: '. BASE_URL .'index.php?page=index');
                     
                        }
        
                   
                  }
                  
               
              
              } else {
                header($_SERVER["SERVER_PROTOCOL"]." 500 INTERNAL SERVER ERROR");
                $code = 500;
                $message = ["message" => "Error on server!"];
                header('Location: '. BASE_URL .'index.php?page=index');
            }
        }catch(PDOExeception $e){
            header($_SERVER["SERVER_PROTOCOL"]." 500 INTERNAL SERVER ERROR");
            $code = 500;
            $dataError ="Error login:".$e->getMessage()."\n";
            echo $dataError;
            SiteException($dataError);
        } 
            
        }
        echo json_encode($message);
   
 }     