$(document).ready(function(){
    const BaseUrl = "http://localhost:8080/php2/sajt1/" 
   
    function error(xhr,status, statusTxt){
     console.log(xhr.status)
     console.log(statusTxt);
    var status = xhr.status;
    switch(status){
        case 500:
         //   alert("Error on server!");
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


 matches()
 pagination()

 function matches(){

    let url = BaseUrl + "models/matches/getResultsAllTeams.php";

   $.ajax({
       url:url,
       method:"GET",
        dataType:"json",
        success:function(data){

       dataMatches(data.pag)
          
          pagLinks(data)
        

        }, error : error
   })
}



function dataMatches(dataArt){
  let isp=""
   
  for(let i of dataArt){

    let datetime = new Date(i.date1)
            
    let month = ["Jan" , "Feb" , "Mar" , "Apr" , "May" , "Jun" , "Jul" , "Aug" , "Sep" , "Okt" , "Nov" ,"Dec"]         
    let dtime =  datetime.getDate() + "-" +  month[datetime.getMonth()] + "-" + datetime.getFullYear() + " " + datetime.getHours() + ":" + datetime.getMinutes()
    let daysInWeek = ["Sunday" , "Monday", "Tuesday" , "Wednesday" ,"Thursday", "Friday", "Saturday"]
     let dayIW = daysInWeek[datetime.getDay()]
     isp +=`<div class="row bg-white align-items-center ml-0 mr-0 py-4 match-entry">
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

            $('#matchesAll').html(isp);
}



function PagValue(){
    $('#pagMatches').on("click",".page-part-otr a" , function(e){
      e.preventDefault()          
    let numb = $(this).data("value");
  
    pag(numb)
  
    
    })
  }
  


  function pagination() { 

    let url = BaseUrl + "models/matches/getResultsAllTeams.php";
   
      $.ajax({ 
          url: url, 
          method: 'GET', 
          dataType: 'json', 
          success: function(data) { 
           pagLinks(data)
          /*  
             $('.page-part').on("click",".page-part-otr a" , function(e){
               e.preventDefault()          
             let numb = $(this).data("value");
            
             pag(numb)
          
             
             })
             */ 
            PagValue()
          }, 
          error: error
          
      }); 
    }
   


function pagLinks(data){
    var br = data.broj.counts
    var countPerPage = 9
    console.log(br)
    var countMatches = parseInt(br); 
    var countLink = (Math.ceil(countMatches / countPerPage)); 
       var isp = ''; 
    
       isp +=  '<ul>'
   
       for(var i = 1; i <= countLink ; i++) {              
      //  for(let i = countLink; i >= 1; i--){                                   
                                       isp += '<li class="page-part-otr"  >   <a  data-value="'+ i +'" href="#">'+ i +'</a>  </li>'     
                                       
       } 
       isp += '</ul>'
          
       $('#pagMatches').html(isp);
      
        $('#pagmer').html("<h2>Matchday "+ countLink +"</h2>")

  }
  

  function pag(numb){
    let url = BaseUrl + "models/matches/getResultsAllTeams.php";
  
    $.ajax({ 
        url: url, 
        type: 'GET', 
        dataType: 'json', 
        data : { numb : numb},
       success:function(data){
                  let pager = data.pag
                  dataMatches(pager)
      
        },error: error
  
      })
   } 
  


})