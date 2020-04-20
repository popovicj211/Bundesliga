<div class="slide-one-item home-slider owl-carousel">
       <?php  $slides = executeQuery("SELECT * FROM slider");  foreach($slides as $slide): ?>
      <div class="site-blocks-cover overlay" style="background-image: url(assets/images/<?= $slide->href?>);" data-aos="fade" data-stellar-background-ratio="0.5">
        <div class="container">
          <div class="row align-items-center justify-content-start">
            <div class="col-md-6 text-center text-md-left" data-aos="fade-up" data-aos-delay="400">
                 <h1 class="bg-text-line"> <?= $slide->name ?> </h1>
                <p class="mt-4"> <?= $slide->text ?> </p>
            </div>
          </div>
        </div>
      </div> 
       <?php  endforeach; ?>
</div> 
    

