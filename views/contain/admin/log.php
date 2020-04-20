<?php


        if(isset($_SESSION['user'])){
          if($_SESSION['user']->role_id != 1){
        
         //   $_SESSION['error_admin'] ="You are not admin!";
                 //  header("Location: http://localhost:8080/phppraktikums/index.php?page=index");
                 header("Location: ".BASE_URL."index.php?page=index");
             }   
        } else {
        //  $_SESSION['error_admin'] ="You are not logged in!";
          header("Location: ".BASE_URL."index.php?page=index");
        }


                    $file = file(BASE_URL."data/log.txt");
                      $now = time();
                      $pageNames = ['Home', 'News' , 'Matches','Schedule', 'Author', 'Contact', 'User admin', 'Matches admin', 'Teams admin', 'News admin', 'Log'];     
                      $pages = [0,0,0,0,0,0,0,0,0,0,0];
                      $sum = 0;
                      foreach($file as $row){
                          $rowData = explode("\t", $row);
                          if($now - strtotime($rowData[2]) <= 86400 ){
                               if(strpos($rowData[0] , 'index.php?') !== false ){
                                   $url = explode('=', $rowData[0]);
                                   $page = $url[1];
                                   switch($page){
                                         case 'index':
                                         $pages[0] = $pages[0] + 1;
                                         break;
                                         case 'news':
                                         $pages[1] = $pages[1] + 1;
                                         break;
                                         case 'matches':
                                         $pages[2] = $pages[2] + 1;
                                         break;
                                         case 'schedule':
                                         $pages[3] = $pages[3] + 1;
                                         break;
                                         case 'about':
                                         $pages[4] = $pages[4] + 1;
                                         break;
                                         case 'contact':
                                         $pages[5] = $pages[5] + 1;
                                         break;
                                         case 'usersadmin':
                                         $pages[6] = $pages[6] + 1;
                                         break;
                                         case 'matchesadmin':
                                         $pages[7] = $pages[7] + 1;
                                         break;
                                         case 'teamsadmin':
                                         $pages[8] = $pages[8] + 1;
                                         break;
                                         case 'newsadmin':
                                         $pages[9] = $pages[9] + 1;
                                         break;
                                         case 'log':
                                         $pages[10] = $pages[10] + 1;
                                         break;
                                   }
                                   $sum = $sum + 1;
                               }
                          }  
                      }      
?>    
<div class="site-section">
    <div class="container">
         <div class="row mb-5">
                <div id="pagmerAdm" class="col-md-2 col-sm-12" ></div>  
               <div class="col-md-8 col-sm-12 text-center"  >
                      <h2 class="text-black"> Percentage of page access </h2>
              </div>
        </div>      
          <?php
                 for($i = 0; $i < count($pageNames); $i++){
                     $percentage = round($pages[$i]/$sum*100); ?>
                        <div class="row">
                              <div class="col-10 pt-1">
                                   <div class="progress">
                                          <div class="progress-bar progress-bar-dark" aria-valuenow="<?= $percentage ?>" aria-valuemin="0" aria-valuemax="100" style="width:<?= $percentage ?>%" > 
                                         </div>
                                   </div>
                              </div>                            
                               <div class="col-2"> 
                                       <label><?= $percentage ?>%  <?= $pageNames[$i] ?></label>
                              </div>
                        </div>
               <?php  }
            ?>
     </div>                    
</div>    
