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
?>
<div class="site-section">
    <div class="container">
        <div class="row mb-5">
               <div class="col-md-12 text-center">
                      <h2 class="text-black"> Add or modify news </h2>
              </div>
        </div>
       <div class="row">
             <div class="col-md-6 col-sm-12 " >
                 <form method="post" action="<?= BASE_URL.'models/admin/news/insertNews.php'?>" enctype="multipart/form-data" onsubmit="return newsins()" >
                 <div class="form-group">
                     <label for="photo">  News photo </label> 
                     <button type="button" class="btn btn-light form-control" id="btnPhotoNewsIns"  onclick="document.getElementById('insPhotoNews').click()" >Add news photo</button>  <span id="InsertImageNewsValue"></span>
                      <input type="file" name="insPhotoNews" id="insPhotoNews" style="display:none;"  onchange="document.getElementById('InsertImageNewsValue').innerHTML=this.value;"  /> 
                </div>
                <div class="form-group">            
                      <label for="team"> Team </label>
                       <select name="insTeamNews" id="insTeamNews" class="form-control" >
                                  <option value="0">Choose</option>
                                  <?php 
                                   include "models/admin/news/functions.php";
                                    $newsQuery = TeamNews();
                                    foreach($newsQuery as $n):
                                  ?>
                                  <option value="<?=$n->team_id?>"> <?= $n->name ?> </option>
                                  <?php
                                   endforeach;
                                 ?>
                       </select>
                 </div>
                 <div class="form-group">       
                         <label for="name">  Name </label> 
                         <input type="text" name="insNameNews"  class="form-control" id="insNameNews" >
                 </div>  
                 <div class="form-group">
                          <label for="text">  Text </label> 
                           <textarea name="insTextNews"  class="form-control" id="insTextNews" cols="30" rows="10"></textarea>
                  </div> 
                   <button type="submit" class="btn btn-primary mt-4" name="btnInsNews"  id="btnInsNews"> Send </button>
              </form>
                    
            </div>
            <div class="col-md-6 col-sm-12 " id="updateNewsAdm">
               <form method="post" action="<?= BASE_URL.'models/admin/news/updateNews.php'?>" enctype="multipart/form-data" onsubmit="return newsup()" >
               <div class="form-group">
                     <label for="photoup">  News photo </label> 
                     <button type="button" class="btn btn-light form-control" id="btnPhotoNewsUp"  onclick="document.getElementById('upPhotoNews').click()" >Add news photo</button>  <span id="UpdateImgValNews"></span>
                      <input type="file" name="upPhotoNews" id="upPhotoNews" style="display:none;" /> 
               </div>
               <div class="form-group">       
                    <!--  <input type="hidden" id="upExistPhotoNews" name="upExistPhotoNews"> -->
                    <label for="uploadshow" > Show taster for upload </label> 
                      <input type="checkbox" name="showUpload" id="showUpload" value="showUpload"   >
              </div>    
              <div class="form-group">   
                      <label for="team" > Team </label>
                       <select name="upTeamNews" id="upTeamNews" class="form-control" >
                                  <option value="0">Choose</option>
                                  <?php 
                                    $newsQueryUp = TeamNews();
                                    foreach($newsQueryUp as $n):
                                  ?>
                                  <option value="<?=$n->team_id?>"> <?= $n->name ?> </option>
                                  <?php
                                   endforeach;
                                 ?>
                       </select>     
              </div>
              <div class="form-group">
                       <label for="name">  Name </label> 
                    <input type="text" name="upNameNews"  class="form-control" id="upNameNews" >
             </div>      
             <div class="form-group">
                   <label for="text">  Text </label> 
                   <textarea name="upTextNews"  class="form-control" id="upTextNews" cols="30" rows="10"></textarea>
             </div>      
                   <input type="hidden" id="upIdNews" name="upIdNews">
                   <input type="hidden" id="upIdImgN" name="upIdImgN">
                   <button type="submit" class="btn btn-primary mt-4" name="btnUpNews" id="btnUpNews" > Send </button>
                   </form>
        </div>  
   </div> 

    <div class="row " >
          <div class="col-md-12 table-responsive margin-top-md" >
                <table class="table mt-4">
                <thead>
                       <tr>
                                <th scope="col">#</th>
                                <th scope="col"> Image </th>
                               <th scope="col"> Team </th>
                                <th scope="col"> Name </th>
                               <th scope="col"> Text </th>
                                <th scope="col"> Date </th>
                            
                      </tr>
              </thead>
              <tbody id="tableTeamsNews">
                       <?php
                       
                                 $showAll = GetAllNews();
                                 foreach($showAll as $key=>$value): 
                       ?>
                        <tr>
                                <td scope="col"><?= $key+1 ?></td>
                                <td scope="col"> <img src="assets/images/<?= $value->href?>" alt="<?= $value->alt?>" class="imgNews" /> </td>
                               <td scope="col"><?= $value->teamname ?></td>
                                <td scope="col"><?= $value->name ?></td>
                               <td scope="col"> <p class="textNews"> <?= $value->text?> </p> </td>
                               <td scope="col"><?=date("d-M-Y H:i:s",  strtotime($value->date))?></td>
                               <td> <a class="btn btn-primary updateTeamNews" data-id="<?=  $value->news_id.'-'.$value->img_id ?>"  href="#">  Update </a> </td>
                                    <td> <a  class="btn btn-dark deleteTeamNews"  data-id="<?=$value->news_id.'-'.$value->img_id ?>" href="#"> Delete </a>  </td>
                      </tr>
                       <?php 
                            endforeach;
                       ?>
             </tbody>
                </table>
           </div>       
         </div>   
         <div class="row">
              <div class="col-md-12 text-center">
                    <div class="site-block-27 pagNewsAdm">
             
                    </div>
             </div>
         </div>  
         <div class="row mb-5">
               <div class="col-md-12 text-center">
                      <h2 class="text-black"> Add comment</h2>
              </div>
        </div>
        <div class="row mb-5">
               <div class="col-md-12 text-center">
                       <form action="<?=BASE_URL.'models/newscomm/insertNewsComm.php' ?>"">
                            <select name="listCommNewsAdm" id="listCommNewsAdm">
                                <option value="0">Choose</option>
                              <?php
                                  include "models/admin/newscomm/functions.php";
                              $listCommAdm = NewsList();
                                   foreach($listCommAdm as $a):
                              ?>
                                 <option value="<?= $a->news_id ?>"> <?=   substr($a->name , 0,20).'...' ?> </option>
                                   <?php endforeach; ?>
                            </select>      
                                  <input type="text" id="commAdmIns" name="commAdmIns" />
                                   <input type="button" id="commAdmBtn" name="commAdmBtn" value="Send" class="btn btn-primary" />
                                   
                       </form>
              </div>
        </div>
        <div class="row mb-5">
               <div class="col-md-12 text-center">
                      <h2 class="text-black"> Show comments</h2>
              </div>
        </div>
         <div class="row " >  
                   <div id="listUsrNews" >
                            <select name="listUsersNews" id="listUsersNews">
                                <option value="0">Choose</option>
                              <?php
                            
                              $listUsr = UsersList();
                                   foreach($listUsr as $v):
                              ?>
                                 <option value="<?= $v->user_id ?>"> <?=  $v->name ?> </option>
                                   <?php endforeach; ?>
                            </select>  
                            <select name="listNews" id="listNews">
                                <option value="0">Choose</option>
                              <?php
                                
                              $listNews = NewsList();
                                   foreach($listNews as $v):
                              ?>
                                 <option value="<?= $v->news_id ?>"> <?= substr($v->name , 0 ,20).'...' ?> </option>
                                   <?php endforeach; ?>
                            </select>      
                   </div>         
         </div>
         <div class="row " >
          <div class="col-md-12 table-responsive margin-top-md" >
                <table class="table mt-4">
                <thead>
                       <tr>
                                <th scope="col">#</th>
                                <th scope="col"> Image </th>
                                <th scope="col"> Name </th>
                               <th scope="col"> Text </th>
                                <th scope="col"> Date </th>
                            
                      </tr>
              </thead>
              <tbody id="tableTeamsNewsComm">           
              <?php
                                  
                                 $showAllComm = getUsrComm();
                                 foreach($showAllComm as $key=>$value): 
                       ?>
                        <tr>
                                <td scope="col"><?= $key+1 ?></td>
                                <td scope="col"> <img src="assets/images/<?= $value->href?>" alt="<?= $value->alt?>" class="rounded" /> </td>
                               <td scope="col"><?= $value-> name ?></td>
                               <td scope="col"> <p > <?= $value->text?> </p> </td>
                               <td scope="col"><?=date("d-M-Y H:i:s",  strtotime($value->date))?></td>
                                    <td> <a  class="btn btn-dark deleteTeamNewsComm"  data-id="<?$value->comm_id.'-'.$value->user_id.'-'.$value->news_id?>" href="#"> Delete </a>  </td>
                      </tr>
                       <?php 
                            endforeach;
                       ?>
                            
             </tbody>
                </table>
           </div>       
         </div>  
         <div class="row">
              <div class="col-md-12 text-center  ">
                    <div class="site-block-27 pagNewsAdmUsr">
             
                    </div>
             </div>
         </div>  
   </div>           
</div>    



        