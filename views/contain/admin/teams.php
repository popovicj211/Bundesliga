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
                      <h2 class="text-black"> Add or modify score od schedule </h2>
              </div>
        </div>
       <div class="row">
             <div class="col-md-6 col-sm-12 ">
                 <form method="post" action="<?= BASE_URL.'models/admin/teams/insertSch.php'?>" enctype="multipart/form-data" onsubmit="return schins()" >
                 <div class="form-group"> 
                         <label for="photo">  Team photo </label> 
                        <button type="button" class="btn btn-light form-control" id="btnPhotoIns"  onclick="document.getElementById('insPhotoTeam').click()" >Add your profile photo</button>  
                        <input type="file" name="insPhotoTeam" id="insPhotoTeam" style="display:none;" /> 
                </div> 
                <div class="form-group">      
                       <label for="name">  Name </label> <input type="text"  name="insNameTeam" id="insNameTeam"  class="form-control"> 
                </div>
                <div class="form-group">        
                       <label for="w">  W </label>  <input type="text"   name="insWTeam" id="insWTeam"  class="form-control" >
                </div>
                <div class="form-group">        
                        <label for="d">  D </label>    <input type="text"   name="insDTeam" id="insDTeam"  class="form-control"  >
                </div>
                <div class="form-group">         
                       <label for="l">  L </label>    <input type="text"    name="insLTeam" id="insLTeam"  class="form-control"  >
               </div>       
                      <button type="submit" class="btn btn-primary mt-4" name="btnInsSch"  id="btnInsSch"> Send </button>
              </form>
                    
            </div>
            <div class="col-md-6 col-sm-12 " id="updateTeamsAdm">
               <form method="post" action="<?= BASE_URL.'models/admin/teams/updateSch.php'?>" enctype="multipart/form-data" onsubmit="return schup()" >
               <div class="form-group">  
                     <label for="photouploadteam">  Team photo </label> 
                     <button type="button" class="btn btn-light form-control" id="btnPhotoUp"  onclick="document.getElementById('upPhotoTeam').click()" >Add your profile photo</button>  <span id="UpdateImgVal"></span>
                      <input type="file" name="upPhotoTeam" id="upPhotoTeam" style="display:none;" /> 
               </div> 
               <div class="form-group">
               <label for="uploadshowteam" > Show taster for upload </label> 
                      <input type="checkbox" name="showUploadTeam" id="showUploadTeam" value="showUploadTeam"   >
               </div> 
               <div class="form-group">      

                    <label for="name">  Name </label> <input type="text" class="form-control" name="upNameTeam" id="upNameTeam"> 
               </div>
               <div class="form-group">       
                    <label for="w">  W </label>  <input type="text"  class="form-control" name="upWTeam" id="upWTeam">
               </div>
               <div class="form-group">  
                   <label for="d">  D </label>    <input type="text" class="form-control" name="upDTeam" id="upDTeam">
               </div>
               <div class="form-group">      
                   <label for="l">  L </label>    <input type="text" class="form-control"  name="upLTeam" id="upLTeam">
               </div>    
                   <input type="hidden" id="idTeam" name="idTeam">
                   <button type="submit" class="btn btn-primary mt-4" name="btnUpSch" id="btnUpSch" > Send </button>
                   </form>
              </div>  
       </div> 
       <div class="row " >
          <div class="col-md-12 table-responsive margin-top-md" >
                <table class="table mt-4">
                <thead>
                       <tr>
                                <th scope="col">#</th>
                               <th scope="col"> Team </th>
                                <th scope="col"> W </th>
                               <th scope="col"> D </th>
                                <th scope="col"> L </th>
                                <th scope="col"> Pts </th>
                      </tr>
              </thead>
              <tbody id="tableTeamsSch">
              <?php   
                     include "models/admin/teams/functions.php";
                     $schedule =  queryTeamsSchedule();
                      foreach($schedule as $key => $value ) :
                 ?>

                         <tr>
                                 <td scope="row"> <?= $key+1 ?> </td>
                                    <td> <?= $value->name ?> </td>
                                    <td> <?= $value->w ?> </td>
                                    <td> <?= $value->d ?> </td>
                                    <td> <?= $value->l ?> </td>
                                    <td> <?= $value->pts ?> </td>
                                    <td> <a class="btn btn-primary updateTeamSch" data-id="<?=  $value->id_img ?>"  href="#">  Update </a> </td>
                                    <td> <a  class="btn btn-dark deleteTeamSch"  data-id="<?=  $value->id_img ?>" href="#"> Delete </a>  </td>
                        </tr>

                        <?php  
                              endforeach;
                        ?>
             </tbody>
                </table>
           </div>
     </div>                    
</div>    
