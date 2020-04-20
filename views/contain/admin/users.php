<?php
if(isset($_SESSION['user'])){
    if($_SESSION['user']->role_id != 1){
  
      $_SESSION['error_admin'] ="You are not admin!";
           
           header("Location: ".BASE_URL."index.php?page=index");
       }   
  } else {
    $_SESSION['error_admin'] ="You are not logged in!";
    header("Location: ".BASE_URL."index.php?page=index");
  }
?>
<div class="site-section">
      <div class="container">
        <div class="row mb-5">
         <!-- <div class="col-md-12 text-center">
            <h2 class="text-black"> Create user </h2>
          </div> -->
          <div class="col-md-6 text-center">
            <h2 class="text-black"> Create user </h2>
          </div>
          <div class="col-md-6 text-center">
            <h2 class="text-black"> Update user </h2>
          </div>

        </div>

        <div class="row">
         <div class="col-md-6 col-sm-12 ">
        <form method="post"  enctype="multipart/form-data" action=" <?= BASE_URL.'models/admin/users/insert.php' ?>" onsubmit="return InsertUsers()"  >
        <div class="form-group">
                <label for="photo"> Photo </label>
              <button type="button" class="btn btn-light form-control" id="btnInsertImage"  onclick="document.getElementById('profileInsert').click()" >Add your profile photo</button>  <span id="InsertImageValue"></span>
        <input type="file" name="profileInsert" id="profileInsert" style="display:none;" onchange="document.getElementById('InsertImageValue').innerHTML=this.value;" />
        </div>
              <div class="form-group">
                   <label for="name">Name </label>
                    <input type="text" class="form-control" id="adminInsertName" name="adminInsertName"  placeholder="Enter name">
                    
            </div>
            <div class="form-group">
                   <label for="username"> Username </label>
                    <input type="text" class="form-control" id="adminFormInsertname" name="adminFormInsertname" placeholder="Enter username">
                   
            </div>
            <div class="form-group">
                   <label for="email">Email address</label>
                    <input type="email" class="form-control" id="adminInsertEmail" name="adminInsertEmail"  placeholder="Enter email">
                
            </div>
             <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" class="form-control" id="adminInsertPass" name="adminInsertPass" placeholder="Password">
             </div>
             <div class="form-group">
                    <label for="password">Role </label>
                     <?php
                       include "models/admin/users/functions.php";
                              $func = Func();
                     ?>
                    <select name="adminInsertRole" id="adminInsertRole" class="form-control">
                                                      <option value="0"> Change </option>
                                                                  <?php foreach($func as $u): ?>
                                                                   <option  value="<?= $u->role_id ?>"> <?= $u->name ?></option>
                                                                         <?php endforeach; ?>
                   </select>
             </div>
             <div class="form-check">
                     <input type="checkbox" value="1" name="adminInsertActive" id="adminInsertActive">
                     <label class="form-check-label" for="active"> Active </label>
             </div>
               <button type="submit"  id="adminInsertSub"  name="adminInsertSub" class="btn btn-outline-primary">Send</button>
       </form>
       </div>

       <div class="col-md-6 col-sm-12 " id="updateAdm">
        <form method="post"  enctype="multipart/form-data" action=" <?= BASE_URL.'models/admin/users/update.php' ?>"  onsubmit = "return UpdateUsers()" >
                 <div class="form-group">
                              <label for="photouserup"> Photo </label>
                             <button type="button" class="btn btn-light form-control" id="btnUpdateImage"  onclick="document.getElementById('profileUpdate').click()" >Add your profile photo</button>  <span id="UpdateImageValue"></span>
                            <input type="file" name="profileUpdate" id="profileUpdate" style="display:none;" />
               </div>
               <div class="form-group">
                <!--    <input type="text" class="form-control" id="adminUpdatePhoto" name="adminUpdatePhoto" disabled >  -->
                  <!--    <input type="hidden" id="adminUpdatePhoto" name="adminUpdatePhoto" />  -->
                  <label for="uploadshowuser" > Show taster for upload </label> 
                  <input type="checkbox" name="showUploadUser" id="showUploadUser" value="showUploadUser"   >

              </div>
              <div class="form-group">
                   <label for="name">Name </label>
                    <input type="text" class="form-control" id="adminUpdateName" name="adminUpdateName" >
                    
            </div>
            <div class="form-group">
                   <label for="username"> Username </label>
                    <input type="text" class="form-control" id="adminFormUpdatename" name="adminFormUpdatename">
                   
            </div>
            <div class="form-group">
                   <label for="email">Email address</label>
                    <input type="email" class="form-control" id="adminUpdateEmail" name="adminUpdateEmail"  >
                
            </div>
             <div class="form-group">
                    <label for="password">Password</label>
                    <input type="password" class="form-control" id="adminUpdatePass" name="adminUpdatePass" >
             </div>
             <div class="form-group">
                    <label for="role">Role </label>
                     <?php
                     
                              $func = Func();
                     ?>
                    <select name="adminUpdateRole" id="adminUpdateRole" class="form-control">
                                                      <option value="0"> Change </option>
                                                                  <?php foreach($func as $u): ?>
                                                                   <option  value="<?= $u->role_id ?>"> <?= $u->name ?></option>
                                                                         <?php endforeach; ?>
                   </select>
             </div>
             <div class="form-check">
                     <input type="checkbox" class="form-check-input" name="adminUpdateActive" id="adminUpdateActive">
                     <label class="form-check-label" for="active"> Active </label>
             </div>
             <div class="form-group">
                  <input type="hidden" id="hiddenUserId" name="hiddenUserId" />
                                                                                      
             </div>
               <button type="submit" id="adminUpdateSub"  name="adminUpdateSub" class="btn btn-outline-primary">Send</button>
       </form>
       </div>
        </div>
        <div class="row " >
          <div class="col-md-12 table-responsive margin-top-md" >
        <table class="table mt-4">
                <thead>
                       <tr>
                              <th scope="col">#</th>
                               <th scope="col"> Photo </th>
                                <th scope="col"> Name </th>
                               <th scope="col"> Username </th>
                                <th scope="col"> Email </th>
                                <th scope="col">  Date </th>
                                <th scope="col">  Update </th>
                                <th scope="col">  Delete </th>
                      </tr>
              </thead>
               <tbody id="tableUsers">
                 <?php   
                     
                     $table = queryGetUsers();
                      foreach($table as $key => $value ) :
                 ?>

                         <tr>
                                 <td scope="row"> <?= $key+1 ?> </td>
                                   <td> <img class="rounded-circle" src="assets/images/<?= $value->href  ?>" alt="<?= $value->alt ?>">  </td>
                                    <td> <?=  $value->name ?> </td>
                                    <td> <?=  $value->username ?> </td>
                                    <td> <?=  $value->email ?> </td>
                                   
                                    <td> <?php  
                                    
                                    $dateTime =strtotime($value->dateregister);
					                                                                  
						
					                                                                   
                                    echo date("d-M-Y H:i:s" , $dateTime );
                                    ?>
                                    
                                    </td>
                                    <td> <a class="btn btn-primary updateUser" data-id="<?= $value->img_id ?>"  href="#">  Update </a> </td>
                                    <td> <a  class="btn btn-dark deleteUser"  data-id="<?= $value->img_id ?>" href="#"> Delete </a>  </td>
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
                  <div class="site-block-27" id="pagUser" >
                 
                   </div>
                </div>
           </div>
      <!--     <div class="row " >  
                   <h2 class="col-md-12 text-center" > Add and modify email for subscribe </h2>
                        <div class="col-md-6 col-sm-12 " id="subAdd">
                                <form>
                                     <div class="form-group">
                                          <label for="add email"> Add email address</label>
                                          <input type="email" class="form-control" id="subAddEmail" name="subAddEmail"  >
                
                                     </div>
                                </form>
                        </div>
                        <div class="col-md-6 col-sm-12 " id="subMods">
                                <form>
                                     <div class="form-group">
                                          <label for="modify email"> Modify email address</label>
                                          <input type="email" class="form-control" id="subModEmail" name="subModEmail"  >
                
                                     </div>
                                </form>
                        </div>
            </div> -->
               
            <div class="row " >
                  <div class="col-md-12 table-responsive margin-top-md" >
                        <table class="table mt-4">
                              <thead>
                                     <tr>
                                          <th scope="col">#</th>
                                           <th scope="col"> Email </th>
                                           <th scope="col">  Date </th>
                                            <th scope="col">  Delete </th>
                                     </tr>
                               </thead>
                                <tbody id="tableSub">
                                <?php
                                 include "models/admin/subscribe/functions.php";
                                              $contact = Sub();
                                              foreach($contact as $key => $value):
                                            ?>
                                        
                                      <tr>
                                          <td scope="col"><?= $key+1 ?></td>
                                           <td scope="col"><?= $value->email ?></td>
                                           <td scope="col">  <?= date("d-m-Y H:i:s",  strtotime($value->datetime)) ?></td>
                                            <td scope="col"><a  class="btn btn-dark deleteSub"  data-id="<?= $value->id_sub ?>" href="#"> Delete </a> </td>
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
                  <div class="site-block-27" id="pagSub" >
                 
                   </div>
                </div>
           </div>
           <div class="row " >
                   <h2 class="col-md-12 text-center" > Message from user (Contact) </h2>
                  <div class="col-md-12 table-responsive margin-top-md" >
                        <table class="table mt-4">
                              <thead>
                                     <tr>
                                          <th scope="col">#</th>
                                           <th scope="col"> First Name </th>
                                           <th scope="col">  Last Name </th>
                                           <th scope="col"> Email </th>
                                            <th scope="col"> Subject </th>
                                            <th scope="col"> Message </th>
                                            <th scope="col">  Delete </th>
                                     </tr>
                               </thead>
                                <tbody id="tableCont">
                                <?php
                                         include "models/admin/contact/functions.php";
                                              $contact = Contact();
                                              foreach($contact as $key => $value):
                                            ?>
                                        
                                      <tr>
                                          <td scope="col"><?= $key+1 ?></td>
                                           <td scope="col"><?= $value->firstname ?></td>
                                           <td scope="col"> <?= $value->lastname ?> </td>
                                           <td scope="col"> <?= $value->email ?> </td>
                                            <td scope="col"> <?= $value->subject ?> </td>
                                            <td scope="col"> <?= $value->text ?> </td>
                                            <td scope="col"> <a  class="btn btn-dark deleteCont"  data-id="<?= $value->con_id ?>" href="#"> Delete </a> </td>
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
                  <div class="site-block-27" id="pagContact" >
                 
                   </div>
                </div>
           </div>
        </div>
    </div>
</div>

<?php


?>