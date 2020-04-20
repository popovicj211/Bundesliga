
const BaseUrl = "http://localhost:8080/php2/sajt1/"
$(document).ready(function(){
    function error(xhr,status, statusTxt){
        console.log(xhr.status)
        console.log(statusTxt);
       var status = xhr.status;
       switch(status){
           case 500:
               alert("Error!");
               break;
           case 400:
               alert("Bad request!");
               break;
           case 404:
              alert("Page not found!");
               break;
           default:
               alert("Error: " + status + " - ");
               break;
       }
    } 


    Results()


function Results(){
 
    $.ajax({
        url: BaseUrl + "models/matches/getResults.php",
        dataType: "json",
        method: "get",
        success: function(data){

            let dateFirst = data.firstdate
            let dateFirstDesc = data.firstdatedesc
         
            let dateFirstd = dateFirst.date.split(" ")
            let dateFirsts = dateFirstd[0].split("-")

            let dateFirstdl = dateFirstDesc.date.split(" ")
            let dateFirstsl = dateFirstdl[0].split("-")
      
            //    console.log(dateFirstDesc)


          /*  for(let j of dateFirst){
              
              let dateFirstd = j.date.split(" ")
                var dateFirsts = dateFirstd[0].split("-")

                }*/
               
             //   let dateFirstd = dateFirst.date.split(" ")
             //   let dateFirsts = dateFirstd[0].split("-")

            /*    for(let k of dateFirstDesc){
                    
                   let dateFirstd = k.date.split(" ")
                    let dateFirsts = dateFirstd[0].split("-")
          
                }  */

           //     let dateFirstdl = dateFirstDesc.date.split(" ")
            //    let dateFirstsl = dateFirstdl[0].split("-")
      

          /*         console.log(new Date(gtTimeAsc).getTime());   
                    console.log(new Date(gtTimeDesc).getTime());

                  let now = new Date()
                   let nowDt = (now.getMonth() + 1) + "-" + now.getDate() + "-" + now.getFullYear() + " " + now.getHours() + ":" + now.getMinutes() + ":" + now.getSeconds();
                
                   let gtNow = new Date(nowDt).getTime()
                   console.log(gtNow)
                   
                  let distance = gtTimeAsc - now 
                  console.log(distance)*/

               
              let FullDateTame = dateFirstsl[0] + "/" + dateFirstsl[1] + "/" + dateFirstsl[2];
           

                   var siteCountDown = function() {

                    $('#date-countdown').countdown(FullDateTame, function(event) {
                      var $this = $(this).html(event.strftime(''
                        + '<span class="countdown-block"><span class="label text-white">%w</span> weeks </span>'
                        + '<span class="countdown-block"><span class="label text-white">%d</span> days </span>'
                        + '<span class="countdown-block"><span class="label text-white">%H</span> hr </span>'
                        + '<span class="countdown-block"><span class="label text-white">%M</span> min </span>'
                        + '<span class="countdown-block"><span class="label text-white">%S</span> sec</span>'));
                    });
                            
                };
                siteCountDown();


             let isp = ""
        for(let i of data.result){
            let datetime = new Date(i.date1)
            
             let month = ["Jan" , "Feb" , "Mar" , "Apr" , "May" , "Jun" , "Jul" , "Aug" , "Sep" , "Okt" , "Nov" ,"Dec"]         
             let dtime =  datetime.getDate() + "-" +  month[datetime.getMonth()] + "-" + datetime.getFullYear() + " " + datetime.getHours() + ":" + datetime.getMinutes()
            
             let daysInWeek = ["Sunday" , "Monday", "Tuesday" , "Wednesday" ,"Thursday", "Friday", "Saturday"]
             let dayIW = daysInWeek[datetime.getDay()]



isp +=  `<div class="row bg-white align-items-center ml-0 mr-0 py-4 match-entry">
            <div class="col-md-4 col-lg-4 mb-4 mb-lg-0">
           
              <div class="text-center text-lg-left">
                <div class="d-block d-lg-flex align-items-center">
                  <div class="image image-small text-center mb-3 mb-lg-0 mr-lg-3">
                    <img src="assets/images/${i.img1href}" alt="${i.alt}" class="img-fluid">
                  </div>
                  <div class="text">
                    <h3 class="h5 mb-0 text-black"> ${i.nameTeam1} </h3>
                  </div>
                </div>
              </div>
           
            </div>
            <div class="col-md-4 col-lg-4 text-center mb-4 mb-lg-0">
              <div class="d-inline-block">
                <div class="bg-black py-2 px-4 mb-2 text-white d-inline-block rounded"><span class="h5"> ${i.result}  </span></div>
                <p> ${dtime}, ${dayIW} </p>
              </div>
            </div>
           
            <div class="col-md-4 col-lg-4 text-center text-lg-right">
              <div class="">
                <div class="d-block d-lg-flex align-items-center">
                  <div class="image image-small ml-lg-3 mb-3 mb-lg-0 order-2">
                    <img src="assets/images/${i.img2href}" alt="Image" class="img-fluid">
                  </div>
                  <div class="text order-1 w-100">
                    <h3 class="h5 mb-0 text-black"> ${i.nameTeam2} </h3>
                  </div>
                </div>
              </div>
            </div>
           </div>`
        }
           $('#results').html(isp)
        },
        error: error
    })

}


/*

 <div class="row bg-white align-items-center ml-0 mr-0 py-4 match-entry">
 <div class="col-md-4 col-lg-4 mb-4 mb-lg-0">

   <div class="text-center text-lg-left">
     <div class="d-block d-lg-flex align-items-center">
       <div class="image image-small text-center mb-3 mb-lg-0 mr-lg-3">
         <img src="images/img_1_sq.jpg" alt="Image" class="img-fluid">
       </div>
       <div class="text">
         <h3 class="h5 mb-0 text-black"> <?= $res->name ?> </h3>
       </div>
     </div>
   </div>

 </div>
 <div class="col-md-4 col-lg-4 text-center mb-4 mb-lg-0">
   <div class="d-inline-block">
     <div class="bg-black py-2 px-4 mb-2 text-white d-inline-block rounded"><span class="h5"> <?= $res->result  ?> </span></div>
   </div>
 </div>

 <div class="col-md-4 col-lg-4 text-center text-lg-right">
   <div class="">
     <div class="d-block d-lg-flex align-items-center">
       <div class="image image-small ml-lg-3 mb-3 mb-lg-0 order-2">
         <img src="images/img_4_sq.jpg" alt="Image" class="img-fluid">
       </div>
       <div class="text order-1 w-100">
         <h3 class="h5 mb-0 text-black">Steelers</h3>
       </div>
     </div>
   </div>
 </div>
</div>
*/







})