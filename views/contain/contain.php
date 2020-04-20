<div class="site-blocks-vs site-section bg-light">
      <div class="container">

        <div class="border mb-3 rounded d-block d-lg-flex align-items-center p-3 next-match bg-danger">
          
          <div class="mr-auto order-md-1 w-60 text-center text-lg-left mb-3 mb-lg-0">
            <p class="h3 text-white"> Next match </p>  
            <div id="date-countdown">
            
            </div>
          </div>

        <!--  <div class="ml-auto pr-4 order-md-2">
            <div class="h5 text-black text-uppercase text-center text-lg-left">
              <div class="d-block d-md-inline-block mb-3 mb-lg-0">
                <img src="" alt="Image" class="mr-3 image"><span class="d-block d-md-inline-block ml-0 ml-md-3 ml-lg-0">Sea Hawlks </span>
              </div>
              <span class="text-muted mx-3 text-normal mb-3 mb-lg-0 d-block d-md-inline ">vs</span> 
              <div class="d-block d-md-inline-block">
                <img src="" alt="Image" class="mr-3 image"><span class="d-block d-md-inline-block ml-0 ml-md-3 ml-lg-0">Patriots</span>
              </div>
            </div>
          </div> -->
          
          
        </div>


        <div class="row">
          <div class="col-md-12">

            <h2 class="h6 text-uppercase text-black font-weight-bold mb-3"> Matches of this round</h2>
            <div class="site-block-tab">
             
              <div class="tab-content" id="pills-tabContent">
                <div class="tab-pane fade show active" id="pills-home" role="tabpanel" aria-labelledby="pills-home-tab">

                  <div class="row align-items-center">
                    <div class="col-md-12" id="results">


               
                      <!-- END row -->

             

                      <!-- END row -->

                    </div>

                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    

    <div class="site-section block-13 bg-primary fixed overlay-primary bg-image"  style="background-image: url('images/hero_bg_3.jpg');"  data-stellar-background-ratio="0.5">

      <div class="container">
        <div class="row mb-5">
          <div class="col-md-12 text-center">
            <h2 class="text-white"> News </h2>
          </div>
        </div>

        <div class="row">
          <div class="nonloop-block-13 owl-carousel" id="newsInd">
               
            <?php
                  include "models/news/functions.php";
                         $news = GetAllNews();
                         foreach($news as $n):
               ?>
        <div class="item">
          <div class="block-12">
            <figure>
              <img src="assets/images/<?= $n->href?>" alt="<?= $n->alt ?>" class="img-fluid">
            </figure>
            <div class="text">
              <span class="meta"><?=date("d M Y", strtotime($n->date)) ?></span>
              <div class="text-inner">
                <h2 class="heading mb-3"><a href="<?=BASE_URL.'index.php?page=newsdetails&idnews='.$n->news_id?>" class="text-black"><?= $n->name
                ?></a></h2>
                <p><?php $pos = strpos($n->text,"."); echo substr($n->text,0,$pos)."..."; ?></p>
              </div>
            </div>
          </div>
        </div> 

                         <?php endforeach; ?>

        
      </div>
        </div>
      </div>
      
    </div>



    