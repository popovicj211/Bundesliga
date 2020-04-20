<?php
header("Contant-Type: application/json");

$code = 404;

if($_SERVER['REQUEST_METHOD'] != "POST"){
    echo "You don't have access on this page!";
    $code = 400;
 }

  if(isset($_POST['btnInsMatch']) && $_SESSION['user']->role_id == 1){

     require_once "../../../config/connection.php";
     include "functions.php";

         $team1 = $_POST['insTeam1'];
         $team2 = $_POST['insTeam2'];
         $team1sc = $_POST['insTeam1Sc'];
         $team2sc = $_POST['insTeam2Sc'];
         $date = isset($_POST['insDateMat']) ? $_POST['insDateMat'] : null ;
         $time = isset($_POST['insTimeMat']) ? $_POST['insTimeMat'] : null ;
        
        
         $erorrs = [];
         if($team1 == $team2){
               array_push($erorrs , "Team 1 and Team 2 are equal");
         }else{ 
            if($team1 == "0"){
                array_push($erorrs , "Team 1 is not selected");
         }

             if($team2 == "0"){
            array_push($erorrs , "Team 2 is not selected");
             }
         }
        

        if($team1sc == "-1"){
            array_push($erorrs , "Team 1 score is not selected");
        }

        if($team2sc == "-1"){
            array_push($erorrs , "Team 2 score is not selected");
        }

        if(empty($date)){
            array_push($erorrs , "Date is not added");
        }

        if(empty($date)){
            array_push($erorrs , "Time is not added");
        }
          
        if(count($erorrs) != 0){
              $code = 422;
              $message = $erorrs;
        }else{
              $score = $team1sc." : ".$team2sc;
              $dateTime = $date." ".$time.":00"; 
           //   $dateIns = date("Y-m-d H:i:s" , $dateTime);
           try{
             $insT = insertMatch($team1, $team2, $score , $dateTime );
           
                  if($insT){
                        $code = 201;
                        $message = "Match is successfully added";
                   }else{
                         $code = 500;
                    }
               }catch(PDOException $e){
                $code = 500;
                $dataError ="Error insert match:".$e->getMessage()."\n";
                echo $dataError;
                SiteException($dataError);
               }
        }

    }
    echo json_encode(["message" => $message]);
    http_response_code($code);