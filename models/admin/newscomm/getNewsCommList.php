<?php
header("Content-Type: application/json");

$status = 400;
$data = null;
 if(isset($_GET['id']) && $_SESSION['user']->role_id == 1){
           
require_once "../../../config/connection.php";
require_once "functions.php";
        $id = $_GET['id'];  
        if(empty($id)){
                   $exeCount = CountNewsCo($id , false);
        }else{
          $exeCount = CountNewsCo($id , true);
        }
     

        $per_page = 2; 
//$number_of_links = ceil($exeCount->counts/$per_page); 
$number = isset($_GET['numb']) ? $_GET['numb'] : 1; 
$from = $per_page * ($number - 1);
          if(empty($id)){
            $newsCommFilt = getNewsCommFilt($id , $from , $per_page , false);
          }else{
            $newsCommFilt = getNewsCommFilt($id , $from , $per_page , true );
            }
         $arrNews = array(
             "count" => $exeCount,
              "newslist" => $newsCommFilt
         );

       try{
         if($arrNews){
            $status = 200;
            $data = $arrNews;
         }else{
            $status = 500;
           
         }
         
      }catch(PDOException $e){
    
    $status = 500;
    $dataError ="Error list of users:".$e->getMessage()."\n";
    echo $dataError;
    SiteException($dataError);
    }

    http_response_code($status);

}

echo json_encode($data);
