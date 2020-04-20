<header class="site-navbar absolute transparent" role="banner">
      <div class="py-3">
        <div class="container">
          <div class="row align-items-center">
            <div  class="col-3 ">
                  <nav class="nav">
                        <?php  if(isset($_SESSION['user'])){ ?>
                          <a class="nav-link sign btn btn-primary" id="logout"   href="<?=BASE_URL.'models/user/logout.php'?>"> Logout </a> 

                        <?php } else {  ?>
                        <a class="nav-link sign d-inline" id="login" data-toggle="modal" data-target="#modalLoginForm"  href="#"> Login </a> <span class="line"> | </span>
                        <a class="nav-link sign d-inline" id="signup" data-toggle="modal" data-target="#modalRegisterForm" href="#">Sign Up</a>
                        <?php }  ?>   
                 </nav>  
           </div>   
            <div class="col-4">    <?php   if(isset($_SESSION['messageRegister'])){
                                                   echo $_SESSION['messageRegister'];
                                           }  
                                           unset($_SESSION['messageRegister']);
                                        
                                         if(isset($_SESSION['messageActive'])){
                                            echo $_SESSION['messageActive'];
                                    }  
                                            unset($_SESSION['messageActive']);
                                         //   echo $_SESSION['messageActive'];
                                          include "models/user/functions.php";
                        
                             
          ?> 
                     <?php 
                             
                                
                                if(isset($_SESSION['user'])){  
                                $id = $_SESSION['user']->user_id;
                                $getPhotos = UserPhotoHome($id);
                                  
                              
                       ?>
                        <img class="rounded-circle d-inline" src="assets/images/<?= $getPhotos->href ?>" alt="<?=  $getPhotos->alt ?>">
                        <?php  if($_SESSION['user']->role_id == "1") { ?>
                          <p class="d-inline "> Admin: <?= $getPhotos->name ?> </p>
                        <?php } if($_SESSION['user']->role_id == "2") {?>
                       <p class="d-inline"> User: <?= $getPhotos->name ?> </p>
                        <?php } } ?>  
            </div>
            <div  class=".col-6 .col-md-4">
              <div class="d-inline-block"><a href="#" class="text-secondary p-2 d-flex align-items-center"><span class="icon-envelope mr-3"></span> <span class="d-none d-md-block">bundesliga@domain.com</span></a></div>
              <div class="d-inline-block"><a href="#" class="text-secondary p-2 d-flex align-items-center"><span class="icon-phone mr-0 mr-md-3"></span> <span class="d-none d-md-block">+49 1111 1111 </span></a></div>
            </div>
          </div>
        </div>
      </div>
      <nav class="site-navigation position-relative text-right bg-black text-md-right" role="navigation">
        <div class="container position-relative">
          <div class="site-logo">
            <a  href="<?= BASE_URL.'index.php?page=index' ?>"><img src="assets/images/logo.png" alt="Image"></a>
          </div>

          <div class="d-inline-block d-md-none ml-md-0 mr-auto py-3"><a href="#" class="site-menu-toggle js-menu-toggle text-white"><span class="icon-menu h3"></span></a></div>
          <ul class="site-menu js-clone-nav d-none d-md-block">
                <?php
                   include "models/menu/menu.php";
                    if(isset($_SESSION['user'])){
                               $nav = Navigation($_SESSION['user'] ->role_id, 0);
                    }else{
                                  $nav = Navigation( 0 , 0);
                    }
                   
                   foreach($nav as $link):
                         if($link->parent == null){
                             $subnav = subMenu($link->menu_id , subMenuAsc());    
                             if(!$subnav){
                              echo  "<li><a href='".BASE_URL."index.php?page=$link->href' >   $link->name  </a> </li>  ";
                       
                             }else{
     
                                  $isp = "<li class='has-children'> <a href='#'> $link->name </a> <ul class='dropdown arrow-top'>  ";
                                  foreach($subnav as $sub){            
                                        $isp .=  "<li><a href='".BASE_URL."index.php?page=$sub->href' > $sub->name  </a> </li>";
                                       
                                  } 
                                  
                                $isp .= "</ul> </li>"; 
                                  echo $isp;
                                
                             }
                         }
              
               //   echo  "<li><a href='index.php?page='.$link->href >   $link->name  </a> </li>";
            
                    endforeach;
              ?>
          </ul>
          
        </div>
      </nav>
    </header>
    
         

    <div class="modal fade" id="modalLoginForm" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
  aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header text-center">
        <h4 class="modal-title w-100 font-weight-bold">Login</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <form method="post" action=" <?= BASE_URL.'models/user/login.php' ?>"   onsubmit="return ValidationLogin()" >
      <div class="modal-body mx-3">
        <div class="md-form mb-5">
        <span class="icon-envelope mr-3 icon"> </span>
          <input type="email" id="logemail" name="logemail" class="form-control validate padicon">  
        <span class="loginstruction" >   </span>
        </div>

        <div class="md-form mb-4">
        <span class="icon-lock2 mr-3 icon"> </span>
          <input type="password" name="logpassword" id="logpassword" class="form-control validate padicon">
         <span class="loginstruction" >   </span>
        </div>
      </div>
      <div class="modal-footer d-flex justify-content-center">
        <button type="submit" id="btnlog" name="btnlog" class="btn btn-primary">Login</button>
      </div>
      </form>
    </div>
  </div>
</div> 





    <div class="modal fade" id="modalRegisterForm" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
  aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content" >
      <div class="modal-header text-center">
        <h4 class="modal-title w-100 font-weight-bold">Sign up</h4>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body mx-3">
      <form method="post" enctype="multipart/form-data"  action=" <?= BASE_URL.'models/user/register.php' ?>" onsubmit="return ValidationSignup()" >
      <div class="md-form mb-5">
        <button type="button" class="btn btn-light" id="btnProImage"  onclick="document.getElementById('profile').click()" >Add your profile photo</button>  <span class="reginstruction" >   </span>
        <input type="file" name="profile" id="profile" style="display:none;"  />
        </div>
        <div class="md-form mb-5">
        <span class="icon-user mr-3 icon"> </span>
          <input type="text" id="regname" name="regname" class="form-control validate padicon">
          <span class="reginstruction" >   </span>
        </div>
        <div class="md-form mb-5">
        <span class="icon-user mr-3 icon"> </span>
          <input type="text" id="regusername" name="regusername" class="form-control validate padicon">
          <span class="reginstruction" >   </span>
        </div>
        <div class="md-form mb-5">
        <span class="icon-envelope mr-3 icon"> </span>
          <input type="email" id="regemail" name="regemail" class="form-control validate padicon">
          <span class="reginstruction" >   </span>
        </div>

        <div class="md-form mb-4">
        <span class="icon-lock2 mr-3 icon"> </span>
          <input type="password" id="regpassword" name="regpassword" class="form-control validate padicon">
          <span class="reginstruction" >   </span>
        </div>
      </div>
      <div class="modal-footer d-flex justify-content-center">
        <button type="submit" id="btnsignup" name="btnsignup" class="btn btn-primary">Sign up</button>
      </div>
              
      </form>
    </div>
  </div>
</div>



