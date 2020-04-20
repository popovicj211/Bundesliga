<div class="site-section">
      <div class="container">
        <div class="row mb-5" id="newsAll">
          <?php
          include "models/news/functions.php";
               $news = GetAllNews();
                foreach($news as $n):
          ?>
               <div class="col-md-6 col-lg-4 mb-4">
                      <div class="post-entry">
                           <div class="image">
                                <img src="assets/imeges/<?= $n->href?>" alt="<?= $n->alt?>" class="img-fluid">
                         </div>
                         <div class="text p-4">
                                <h2 class="h5 text-black newslink"><a href="<?=BASE_URL.'index.php?page=newsdetails&idnews='.$n->news_id?>"><?= $n->name?></a></h2>
                                <p> <?php  $pos = strpos($n->text,"."); echo substr($n->text,0,$pos)."..."; ?></p>
                                <span class="text-uppercase date d-block mb-3"><small>Date posted: <?= date("d M Y  H:i", strtotime($n->date))?> </small></span>
               
                         </div>
                    </div>
              </div>
          <?php
             endforeach;
             ?>
        </div>
        <div class="row">
          <div class="col-md-12 text-center">
                <div class="site-block-27" id="newsUsr">
        
                </div>
              </div>
        </div>
      </div>
    </div>