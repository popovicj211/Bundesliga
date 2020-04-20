<footer class="site-footer border-top">
      <div class="container">
        <div class="row">
          <div class="col-lg-4">
            <div class="mb-5">
              <h3 class="footer-heading mb-4"> Bundesliga </h3>
              <p>  We are represent all teams in bundesliga in season 2019/20.  You can see news about teams and all results  .</p>
            </div>
            
          </div>
          <div class="col-lg-4 mb-5 mb-lg-0">
            <div class="row mb-5">
              <div class="col-md-12">
                <h3 class="footer-heading mb-4">Quick Menu</h3>
              </div>
              <div class="col-md-6 col-lg-6" >
                <ul class="list-unstyled">
                  <?php
                
                 // $nav = executeQuery("SELECT * FROM menu LIMIT 0,4");
                   $navFooter = Navigation(0,0);
                   foreach($navFooter as $link):
                            if($link->parent == null){
                                    $subNavFooter = subMenu($link->menu_id , subMenuAsc() );
                                    if(!$subNavFooter){
                                    echo "<li><a href='".BASE_URL."index.php?page=$link->href'>   $link->name  </a> </li>";
                                    }
                            }
                            
                    endforeach; 
                   
              ?>
            
                </ul>
              </div>
            
             </div>

          </div>
          <div class="col-lg-4 mb-5 mb-lg-0"  >
            <div class="mb-5">
              <h3 class="footer-heading mb-2">Subscribe Newsletter and follow us</h3>
              <p>Please subscribe </p>

              <form >
                <div class="input-group mb-3">
                  <input type="text" name="addSubEmail" class="form-control border-secondary text-white bg-transparent" placeholder="Enter Email" id="addSubEmail" >
                  <div class="input-group-append">
                    <input class="btn btn-primary"  id="subEmBtn" name="subEmBtn" type="button" value="SEND" >
                  </div>
                </div>
              </form>
            
              <div>
                  <a href="https://facebook.com" class="pl-0 pr-3"><span class="icon-facebook"></span></a>
                  <a href="https://twitter.com/" class="pl-3 pr-3"><span class="icon-twitter"></span></a>
                  <a href="https://www.instagram.com" class="pl-3 pr-3"><span class="icon-instagram"></span></a>
                  <a href="https://www.linkedin.com" class="pl-3 pr-3"><span class="icon-linkedin"></span></a>
                </div>
               </div> 
            </div>
          </div>
          
        </div>
        <p class="text-center" >
            Copyright &copy;<script data-cfasync="false" src="/cdn-cgi/scripts/5c5dd728/cloudflare-static/email-decode.min.js"></script><script>document.write(new Date().getFullYear());</script> All rights reserved | This template is made with <i class="icon-heart-o" aria-hidden="true"></i> by <a href="https://colorlib.com" target="_blank" >Colorlib </a> and Jovan Popovic
            </p>
      </div>
    </footer>
  </div>

  <script src="assets/js/jquery-3.3.1.min.js"></script>
  <script src="assets/js/jquery-migrate-3.0.1.min.js"></script>
  <script src="assets/js/jquery-ui.js"></script>
  <script src="assets/js/popper.min.js"></script>
  <script src="assets/js/bootstrap.min.js"></script>
  <script src="assets/js/owl.carousel.min.js"></script>
  <script src="assets/js/jquery.stellar.min.js"></script> 
  <script src="assets/js/jquery.countdown.min.js"></script>
  <script src="assets/js/jquery.magnific-popup.min.js"></script> 
  <script src="assets/js/aos.js"></script> 

  <script src="assets/js/main.js"></script>
  <script src="assets/js/validate.js"></script>
  
  <?php  if(isset($_GET['page'])){   
    if($_GET['page'] == "contact"){ ?>
          <script type="text/javascript" src="assets/js/contact.js" 
          charset="UTF-8" > </script>
         
        <?php } if($_GET['page'] == "index" ){  ?>
          <script type="text/javascript" src="assets/js/results.js"></script>
        <?php } if($_GET['page'] == "matches") { ?>
          <script type="text/javascript" src="assets/js/matches.js"></script>    
      
  <?php  }  if($_GET['page'] == "usersadmin") {    ?>  
 
    <script type="text/javascript" src="assets/js/usersadmin.js"></script> 
    <script type="text/javascript" src="assets/js/insertuser.js"></script>   

  <?php }  if($_GET['page'] == "teamsadmin") { ?>    
    <script type="text/javascript" src="assets/js/insertsch.js"></script>                 
  <?php } if($_GET['page'] == "matchesadmin"){ ?>
          <script type="text/javascript" src="assets/js/insertmatca.js"></script>              
  <?php } if($_GET['page'] == "newsadmin"){ ?>
    <script type="text/javascript" src="assets/js/insertnews.js"></script>    
  <?php  }  if($_GET['page'] == "newsdetails" ){      ?>
    <script type="text/javascript" src="assets/js/insertcomm.js"></script>
         <?php     }   if($_GET['page'] == "news"){      ?>
                  <script type="text/javascript" src="assets/js/news.js"></script> 
      <?php  } }else{ ?>
          <script type="text/javascript" src="assets/js/results.js"></script>
          
       <?php }  ?>

  </body>
</html>