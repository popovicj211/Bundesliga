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
                <div id="pagmerAdm" class="col-md-2 col-sm-12" ></div>  
               <div class="col-md-8 col-sm-12 text-center"  >
                      <h2 class="text-black"> Add or modify scores of matches </h2>
              </div>
        </div>
       <div class="row">
             <div class="col-md-6 col-sm-12 ">
                 <form> 
                    <label for="team1">  Team 1 </label> 
                         <select name="insTeam1" id="insTeam1" class="form-control">
                                 <option value="0"> Choose</option>
                                 <?php
                                    include "models/admin/matches/functions.php";
                                    $queryTm1 =  Team();
                                    foreach($queryTm1 as $tm1):
                                 ?>
                                 <option value="<?=$tm1->team_id?>"> <?= $tm1->name ?> </option>
                                    <?php  endforeach; ?>
                         </select>
                    <label for="team2">  Team 2 </label> 
                         <select name="insTeam2" id="insTeam2" class="form-control">
                                 <option value="0"> Choose</option>
                                 <?php
                                    $queryTm2 =  Team();
                                    foreach($queryTm2 as $tm2):
                                 ?>
                                 <option value="<?=$tm2->team_id?>"> <?= $tm2->name ?> </option>
                                    <?php  endforeach; ?>
                         </select>
                   <label for="team1score">  Team 1 score </label> 

                    <select name="insTeam1Sc" id="insTeam1Sc" class="form-control">
                              <option value="-1">Choose</option>
                              <?php
                                    $arrScores = [0,1,2,3,4,5,6,7,8,9,10,11,12];
                                    foreach($arrScores as $sc):
                                 ?>
                                 <option value="<?=$sc?>"> <?= $sc ?> </option>
                                    <?php  endforeach; ?>
                    </select>

                   <label for="team2score">  Team 2 score </label> 
                   <select name="insTeam2Sc" id="insTeam2Sc" class="form-control">
                              <option value="-1">Choose</option>
                              <?php
                                    foreach($arrScores as $sc2):
                                 ?>
                                 <option value="<?=$sc2?>"> <?= $sc2 ?> </option>
                                    <?php  endforeach; ?>
                    </select>

                   <label for="datematch">  Date of the match</label>    <input type="date"   name="insDateMat" id="insDateMat"  class="form-control"  >
                   <label for="timematch">  Match start time </label>    <input type="time"    name="insTimeMat" id="insTimeMat"  class="form-control"  > 
       
                <!--  <button  class="btn btn-primary mt-4" name="btnInsMatch"  id="btnInsMatch"> Send </button> -->
                <input type="button"  class="btn btn-primary mt-4" name="btnInsMatch"  id="btnInsMatch" value="Send">  
              </form>
                    
            </div>
            <div class="col-md-6 col-sm-12 ">
               <form>
                      
               <label for="team1">  Team 1 </label> 
                         <select name="upTeam1" id="upTeam1" class="form-control">
                                 <option value="0"> Choose</option>
                                 <?php
                                 $queryTm1up =  Team();
                                    foreach($queryTm1up as $tm1up):
                                 ?>
                                 <option value="<?=$tm1up->team_id?>"> <?= $tm1up->name ?> </option>
                                    <?php  endforeach; ?>
                         </select>
                    <label for="team2">  Team 2 </label> 
                         <select name="upTeam2" id="upTeam2" class="form-control">
                                 <option value="0"> Choose</option>
                                 <?php
                                 $queryTm2up =  Team();
                                    foreach($queryTm2up as $tm2up):
                                 ?>
                                 <option value="<?=$tm2up->team_id?>"> <?= $tm2up->name ?> </option>
                                    <?php  endforeach; ?>
                         </select>
                   <label for="team1score">  Team 1 score </label> 
                   <select name="upTeam1Sc" id="upTeam1Sc" class="form-control">
                              <option value="-1">Choose</option>
                              <?php
                                    foreach($arrScores as $scup):
                                 ?>
                                 <option value="<?=$scup?>"> <?= $scup ?> </option>
                                    <?php  endforeach; ?>
                    </select>
                   <label for="team2score">  Team 2 score </label>  
                   <select name="upTeam2Sc" id="upTeam2Sc" class="form-control">
                              <option value="-1">Choose</option>
                              <?php
                                    
                                    foreach($arrScores as $sc2up):
                                 ?>
                                 <option value="<?=$sc2up?>"> <?= $sc2up ?> </option>
                                    <?php  endforeach; ?>
                    </select>
                   <label for="datematch">  Date of the match</label>    <input type="date"   name="upDateMat" id="upDateMat"  class="form-control"  >
                   <label for="timematch">  Match start time </label>    <input type="time"    name="upTimeMat" id="upTimeMat"  class="form-control"  >
                   
                   <input type="hidden" id="idMatch" name="idMatch">
                   <input type="button"  class="btn btn-primary mt-4" name="btnUpMatch" id="btnUpMatch" value="Send" >
                   </form>
              </div>  
       </div>  
      <div class="row " >
          <div class="col-md-12 table-responsive margin-top-md" >
              
                <table class="table mt-4">
                <thead>
                       <tr>
                                <th scope="col">#</th>
                               <th scope="col"> Team 1 </th>
                                <th scope="col"> Score </th>
                               <th scope="col"> Team 2 </th>
                                <th scope="col"> Date </th>
                                <th scope="col"> Start match </th>
                      </tr>
              </thead>
              <tbody id="tableMatchesM">
              <?php   
                     
                     $matchesAll = getAllScores();
                      foreach($matchesAll as $key => $value ) : 
                         $dateStr = strtotime($value->date);
                        $date = date("d-M-Y H:i", $dateStr);
                        $datTime = explode(" ", $date); 
                 ?>

                         <tr>
                                 <td scope="row"> <?= $key+1 ?> </td>
                                    <td> <?= $value->team1 ?> </td>
                                    <td> <?= $value->result ?> </td>
                                    <td> <?= $value->team2 ?> </td>
                                    <td> <?=  $datTime[0] ?> </td>
                                    <td> <?=   $datTime[1] ?> </td>
                                    <td> <a class="btn btn-primary updateTeamMat" data-id="<?=  $value->match_id ?>"  href="#">  Update </a> </td>
                                    <td> <a  class="btn btn-dark deleteTeamMat"  data-id="<?=  $value->match_id ?>" href="#"> Delete </a>  </td>
                                  
                        </tr>

                        <?php  
                              endforeach;
                        ?>
             </tbody>
                </table>
           </div>
           <div class="row">
          <div class="col-md-12 text-center">
                <div class="site-block-27" id="pagMatchesAdm">
                 <!-- <ul>
                    <li><a href="#">&lt;</a></li>
                    <li class="active"><span>1</span></li>
                    <li><a href="#">2</a></li>
                    <li><a href="#">3</a></li>
                    <li><a href="#">4</a></li>
                    <li><a href="#">5</a></li>
                    <li><a href="#">&gt;</a></li>
                  </ul> -->
                </div>
              </div>
        </div>
     </div>                    
</div>    
