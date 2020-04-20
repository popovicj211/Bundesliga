<?php

function Navigation($session1, $session2 ){
      global $connection;
     
     /*    $queryNav = "SELECT * FROM menu1 ";
        $menu = executeQuery($queryNav);*/
        $queryNav = "SELECT * FROM menu1 WHERE session = ? OR session = ?"; 
        $pripareNav = $connection -> prepare($queryNav);
        $pripareNav -> execute([$session1 , $session2]);
        $menu = $pripareNav -> fetchAll();

     return $menu;

}


function subMenuAsc(){
   return "SELECT * FROM menu1 WHERE parent = ? ";
}



function subMenu($id_parent , $queryAD){

   global $connection;

   $querySubNav = $queryAD;
   $queryPrepare = $connection->prepare($querySubNav);
    $queryPrepare->execute([$id_parent]);
    $getSubNav = $queryPrepare->fetchAll();

    if($queryPrepare->rowCount() == 0){
        return 0;
    }else{
        return $getSubNav;
    }
   

}