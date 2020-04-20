<?php

function queryUserComm(){
    return "SELECT u.name , i.href, i.alt , co.text , co.date FROM images i INNER JOIN user u ON i.img_id = u.img_id INNER JOIN user_comment uc ON u.user_id = uc.user_id INNER JOIN comment co ON uc.comm_id = co.comm_id INNER JOIN news_comment nc ON co.comm_id = nc.comm_id";
}


 function  getUsrComm($news_id ){
    global $connection;
    $role_id = 1;
    $queryUsrImgShow = queryUserComm();
    $queryUsrImgShow .= " WHERE nc.news_id = ?";
    $prepUsrImgShow =  $connection->prepare($queryUsrImgShow);
     $prepUsrImgShow -> execute([$news_id ]);
    $rowUsrImgShow =  $prepUsrImgShow -> fetchAll();
    return $rowUsrImgShow; 
  
   }



   function InsertComm( $user_id , $text , $news_id ){
    global $connection;
   
  
    try{
      $connection->beginTransaction();
    
    
     $queryComm = "INSERT INTO comment (comm_id, text )
     values (null, ? )";
      $insertComm = $connection->prepare($queryComm);
      $insertComm -> execute([ $text  ]);
  
      $comm_id = $connection -> lastInsertId();
      $queryUsrComm = "INSERT INTO user_comment (uscom_id , comm_id, user_id ) values(null , ? , ?)";
      $InsertUsrCimm = $connection->prepare($queryUsrComm);
      $InsertUsrCimm -> execute([ $comm_id , $user_id  ]);
  
      $queryNewsComm = "INSERT INTO news_comment (necomm_id, news_id , comm_id)
      values (null, ? , ? )";
       $insertNewsComm = $connection->prepare($queryNewsComm);
       $insertNewsComm -> execute([ $news_id , $comm_id ]);
      
      $transaction = $connection->commit();
    
    } catch(PDOException $e) {
      $connection->rollback();
      echo $e->getMessage();
     
    }
    return $transaction ;
  
  }

