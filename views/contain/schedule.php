<div class="site-section">
      <div class="container">
        <div class="row mb-5">
          <div class="col-md-12 text-center">
            <h2 class="text-black"> Current table </h2>
          </div>
        </div>
        <div class="row">
          
        <table class="table">
                <thead>
                       <tr>
                              <th scope="col">#</th>
                               <th scope="col"> Team </th>
                                <th scope="col"> w </th>
                               <th scope="col"> d </th>
                                <th scope="col"> l </th>
                                <th scope="col"> pts </th>
                      </tr>
              </thead>
               <tbody>
                 <?php   
                     include "models/matches/functions.php";
                     $table = getQueryLimit( " ORDER BY pts DESC ", TeamsTable());
                      foreach($table as $key => $value ) :
                 ?>

                         <tr>
                                 <th scope="row"> <?= $key+1 ?> </th>
                                   <td> <?= $value->name  ?> </td>
                                    <td> <?=  $value->w ?> </td>
                                    <td> <?=  $value->d ?> </td>
                                    <td> <?=  $value->l ?> </td>
                                    <td> <?=  $value->pts ?> </td>
                        </tr>

                        <?php  
                              endforeach;
                        ?>
             </tbody>
       </table>
        
        </div>
    </div>
 </div>