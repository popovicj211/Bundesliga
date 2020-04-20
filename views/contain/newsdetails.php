<?php 
         
try{
            if(isset($_GET['idnews'])){
     
                include "models/news/functions.php";
                include "models/newscomm/functions.php";
                    $nwId = $_GET['idnews'];
    
            $newsDetal = NewsDetal($nwId);
            }
        }catch(PDOException $e){
              echo $e->getMessage();
        }         
?>

<div class="site-section">
      <div class="container">
            <div class="row">
               <div class="col">
      <?php    foreach($newsDetal as $n):  ?>
               <div class="row mb-5">
                     <div class="col-md-12 text-left">
                             <h2 class="text-black"> <?= $n->name ?> </h2>
                     </div>
              </div>
    
            <div class="row"> 
                 
                  <div class="col-sm-12 col-md-6 column-in-left"  >
                          <img src="assets/images/<?= $n->href ?>" alt="<?= $n->alt ?>" class="rounded mx-auto d-block" />
                     </div>
      
            </div>
             <div class="row">
                     <div class="col-sm-12  column-in-left" > 
                     <p  class="text-justify"><?= $n->text ?></p>
                     </div> 
                    
             </div>
             <div class="row">
                     <div class="col-sm-12 col-md-6 column-in-left" >
                                <p> <small> Date posted: <?=  date("d-m-Y H:i:s",  strtotime($n->date)) ?> </small> </p>
                     </div>
                    
             </div>
                  
             <?php  endforeach;   ?>   </div> <div class="col"> 
                                                <?php  if(isset($_SESSION['user'])){  ?>
                                                    <div class="detailBox">
                                                                        <div class="titleBox">
                                                                                           <label class="text-white">Comment Box</label>
                                                                                          
                                                                        </div>
                                                                          <div class="commentBox">
        
                                                                                              <p class="taskDescription"> Please write your comment </p>
                                                                         </div>
                                                                           <div class="actionBox">
                                                                                             <ul class="commentList">
                                                                                                    <?php   
                                                                                                  
                                                                                                    $comments = getUsrComm( $nwId ); 
                                                                                                                foreach($comments as $c):
                                                                                                    ?>    
                                                                                                              <li>
                                                                                                                   <div class="commenterImage">
                                                                                                                          <img src="assets/images/<?= $c->href ?>" alt="<?= $c->alt ?>" />
                                                                                                                  </div>
                                                                                                                 
                                                                                                                   <div class="commentText">
                                        
                                                                                                                                  <p class=""><?= $c->text ?></p> <span class="date sub-text"> <?= date("d-M-Y H:i" ,strtotime($c->date));   ?>  </span>

                                                                                                                   </div>
                                                                                                            </li>
                                                                                                                <?php endforeach;  ?>
 
                                                                                             </ul>  
                                                                                             <form method="post" action="<?=BASE_URL.'models/newscomm/insertNewsComm.php' ?>">
                                                                                                           <div class="form-group">
                                                                                                                      <input name="commnews" id="commnews"  type="text" placeholder="Your comments" />
                                                                                                                      <input type="hidden" name="newSId" id="newSId" value="<?=$nwId?>">
                                                                                                           </div>
                                                                                                            <div class="form-group">
                                                                                                                        <input type="button" value="Add"  id="btncommnews" name="btncommnews" class="btn btn-default"/>
                                                                                                            </div>
                                                                                             </form>
                                                                            </div>
                                                     </div>
                                                          <?php }  ?>
                                 </div>
      </div>
   </div>
</div>      
