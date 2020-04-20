<?php

function quertUsrComm(){
    return "SELECT co.comm_id , u.name , i.href, i.alt , co.text , co.date , nc.news_id , u.user_id FROM images i INNER JOIN user u ON i.img_id = u.img_id INNER JOIN user_comment uc ON u.user_id = uc.user_id INNER JOIN comment co ON uc.comm_id = co.comm_id INNER JOIN news_comment nc ON co.comm_id = nc.comm_id ORDER BY co.date DESC";
}

 function  getUsrComm(){
    global $connection;
    $queryUsrImgShow = quertUsrComm();
    $prepUsrImgShow =  $connection->prepare($queryUsrImgShow);
     $prepUsrImgShow -> execute();
    $rowUsrImgShow =  $prepUsrImgShow -> fetchAll();
    return $rowUsrImgShow; 
  
   }

   function  getUsrCommFilt($user_id , $start , $length  , $idTF){
    global $connection;
    $role_id = 1;
    if($idTF == true)
     $queryUsrImgShow = "SELECT co.comm_id , u.name , i.href, i.alt , co.text , co.date FROM images i INNER JOIN user u ON i.img_id = u.img_id INNER JOIN user_comment uc ON u.user_id = uc.user_id INNER JOIN comment co ON uc.comm_id = co.comm_id INNER JOIN news_comment nc ON co.comm_id = nc.comm_id WHERE u.user_id = ? ORDER BY co.date DESC";
     else 
     $queryUsrImgShow = "SELECT co.comm_id , u.name , i.href, i.alt , co.text , co.date FROM images i INNER JOIN user u ON i.img_id = u.img_id INNER JOIN user_comment uc ON u.user_id = uc.user_id INNER JOIN comment co ON uc.comm_id = co.comm_id INNER JOIN news_comment nc ON co.comm_id = nc.comm_id ORDER BY co.date DESC";
     $queryUsrImgShow .= " LIMIT $start , $length";
    $prepUsrImgShow =  $connection->prepare($queryUsrImgShow);
    if($idTF == true)
     $prepUsrImgShow -> execute([$user_id  ]);
     else
     $prepUsrImgShow -> execute();
    $rowUsrImgShow =  $prepUsrImgShow -> fetchAll();
    return $rowUsrImgShow; 
  
   }


   function  getNewsCommFilt($news_id , $start , $length  , $idTF){
    global $connection;
    $role_id = 1;
    if($idTF == true)
     $queryUsrImgShow = "SELECT co.comm_id , u.name , i.href, i.alt , co.text , co.date FROM images i INNER JOIN user u ON i.img_id = u.img_id INNER JOIN user_comment uc ON u.user_id = uc.user_id INNER JOIN comment co ON uc.comm_id = co.comm_id INNER JOIN news_comment nc ON co.comm_id = nc.comm_id WHERE nc.news_id = ? ORDER BY co.date DESC";
     else 
     $queryUsrImgShow = "SELECT co.comm_id , u.name , i.href, i.alt , co.text , co.date FROM images i INNER JOIN user u ON i.img_id = u.img_id INNER JOIN user_comment uc ON u.user_id = uc.user_id INNER JOIN comment co ON uc.comm_id = co.comm_id INNER JOIN news_comment nc ON co.comm_id = nc.comm_id ORDER BY co.date DESC";
     $queryUsrImgShow .= " LIMIT $start , $length";
    $prepUsrImgShow =  $connection->prepare($queryUsrImgShow);
    if($idTF == true)
     $prepUsrImgShow -> execute([$news_id  ]);
     else
     $prepUsrImgShow -> execute();
    $rowUsrImgShow =  $prepUsrImgShow -> fetchAll();
    return $rowUsrImgShow; 
  
   }

   function getLimitnNewsUser($limit , $func){
    global $connection;
    $queryResNews = $func;
   $queryResNews .= $limit;
    $resultNewsLimit = executeQuery($queryResNews);
    return $resultNewsLimit;
}

   function CountNewsComm(){

    global $connection;
      $queryConNews = "SELECT COUNT(*) as counts FROM comment";
      $prepConNews = $connection -> prepare($queryConNews);
      $prepConNews -> execute();
    $resConNews = $prepConNews -> fetch();
    return $resConNews;
 }


 function CountNewsCommUser($user_id , $CTF){
  global $connection;
    if($CTF == true)
    $queryConNews = "SELECT COUNT(*) as counts FROM comment c INNER JOIN user_comment uc ON c.comm_id = uc.comm_id  WHERE uc.user_id = ? ";
    else
    $queryConNews = "SELECT COUNT(*) as counts FROM comment c INNER JOIN user_comment uc ON c.comm_id = uc.comm_id ";
    $prepConNews = $connection -> prepare($queryConNews);
    if($CTF == true)
    $prepConNews -> execute([$user_id ]);
    else
    $prepConNews -> execute();
  $resConNews = $prepConNews -> fetch();
  return $resConNews;
}

function CountNewsCo($news_id , $CTF){
  global $connection;
    if($CTF == true)
    $queryConNews = "SELECT COUNT(*) as counts FROM comment c INNER JOIN user_comment uc ON c.comm_id = uc.comm_id INNER JOIN news_comment nc ON c.comm_id = nc.comm_id WHERE nc.news_id = ? ";
    else
    $queryConNews = "SELECT COUNT(*) as counts FROM comment c INNER JOIN user_comment uc ON c.comm_id = uc.comm_id INNER JOIN news_comment nc ON c.comm_id = nc.comm_id";
    $prepConNews = $connection -> prepare($queryConNews);
    if($CTF == true)
    $prepConNews -> execute([$news_id ]);
    else
    $prepConNews -> execute();
  $resConNews = $prepConNews -> fetch();
  return $resConNews;
}


 function UsersList(){
       //  return executeQuery("SELECT user_id , name FROM user WHERE role_id = ");
         global $connection;
          $role = 2;
         $queryAllUsr = "SELECT u.user_id , u.name FROM user u INNER JOIN user_comment uc ON u.user_id = uc.user_id  WHERE u.role_id = ? ";
         $prepConUsr = $connection -> prepare($queryAllUsr);
         $prepConUsr -> execute([ $role]);
       $resConUsr = $prepConUsr -> fetchAll();
       return $resConUsr;

 }

 function NewsList(){
    return executeQuery("SELECT  news_id , name FROM news");
    global $connection;


}

function  DelComm($idComm , $idUser , $idNews){
  global $connection;
  $connection->beginTransaction();
  try{

  $delComm = "DELETE FROM comment WHERE comm_id = ? ";
   $prepareDelComm = $connection->prepare($delComm);
    $prepareDelComm->execute([$idComm]);

    $delUsrCom = "DELETE FROM user_comment WHERE comm_id = ? AND user_id = ? ";
    $prepareDelUsrCom = $connection->prepare($delUsrCom);
     $prepareDelUsrCom->execute([ $idComm , $idUser]);

     $delNewsCom = "DELETE FROM news_comment WHERE news_id = ? AND comm_id = ?";
     $prepareDelNewsCom = $connection->prepare($delNewsCom);
      $prepareDelNewsCom->execute([$idNews , $idComm]);

   $transactionDelComm = $connection->commit();

  }catch(PDOException $e){
         $connection->rollback();
         $e->getMessage();
  }
  return  $transactionDelComm;
}



function InsertCommAdm( $user_id , $text , $news_id ){
  global $connection;
 

  try{
    $connection->beginTransaction();
  
  
   $queryCommAdm = "INSERT INTO comment (comm_id, text )
   values (null, ? )";
    $insertCommAdm = $connection->prepare($queryCommAdm);
    $insertCommAdm -> execute([ $text  ]);

    $comm_id = $connection -> lastInsertId();
    $queryUsrCommAdm = "INSERT INTO user_comment (uscom_id , comm_id, user_id ) values(null , ? , ?)";
    $InsertUsrCimmAdm = $connection->prepare($queryUsrCommAdm);
    $InsertUsrCimmAdm -> execute([ $comm_id , $user_id  ]);

    $queryNewsCommAdm = "INSERT INTO news_comment (necomm_id, news_id , comm_id)
    values (null, ? , ? )";
     $insertNewsCommAdm = $connection->prepare($queryNewsCommAdm);
     $insertNewsCommAdm -> execute([ $news_id , $comm_id ]);
    
    $transactionInsAdm = $connection->commit();
  
  } catch(PDOException $e) {
    $connection->rollback();
    echo $e->getMessage();
   
  }
  return $transactionInsAdm ;

}