const BaseUrl = "http://localhost:8080/php2/sajt1/";
window.onload = function(){
 
   getSch()
  
 pagination()
 //newsId()
}


function err(xhr, statusTxt, error){
    var status = xhr.status;
    switch(status){
        case 500:
            alert("Error");
            break;
            case 404:
                alert("Page not found!");
             break;
            case 422:
                alert("Data are not validate!");
                console.log(statusTxt)
                 break;
            case 500:
                 alert("Bad request!");     
        default:
            alert("Greska: " + status + " - " + statusTxt);
            break;
    }
  }

function getSch(){
   
   
    $.ajax({
        method: 'get',
        url: BaseUrl + "models/news/getNews.php",
        dataType: 'json',
        success: function(data){
            readAll(data.news)
        }, error: err
    })   
}


function readAll(data){
    let isp = "";
    
    let br = 0;
     for(let i of data){
       let datetime = new Date(i.date)
       let month = ["Jan" , "Feb" , "Mar" , "Apr" , "May" , "Jun" , "Jul" , "Aug" , "Sep" , "Okt" , "Nov" ,"Dec"]
        let newDate = datetime.getDate() + " " + month[datetime.getMonth()] + " " + datetime.getFullYear()
         let newTime = datetime.getHours() + ":" + datetime.getMinutes()
        let text = i.text;
        let pos = text.indexOf(".")
        let txt = text.substring(0, pos);
 isp += `<div class="col-md-6 col-lg-4 mb-4">
              <div class="post-entry">
                     <div class="image">
                               <img src="assets/images/${i.href}" alt="${i.alt}" class="img-fluid">
                    </div>
                     <div class="text p-4">
                                 <h2 class="h5 text-black newslink"><a href="${BaseUrl}index.php?page=newsdetails&idnews=${i.news_id}">${i.name} </a></h2>
                                 <p> ${txt}... </p>
                                  <span class="text-uppercase date d-block mb-3"><small>Date posted: &bullet;  ${newDate} ${newTime} </small></span>
                     </div>
              </div>
        </div>`

br++
     }
     $('#newsAll').html(isp)
}





    function PagValue(){
        $('#newsUsr').on("click",".page-part-otr a" , function(e){
          e.preventDefault()          
        let numb = $(this).data("value");
      
        pag(numb)
      
        
        })
      }
     
    
    
      function pagination() { 
    
        let url = BaseUrl + "models/news/getNews.php";
       
          $.ajax({ 
              url: url, 
              method: 'GET', 
              dataType: 'json', 
              success: function(data) { 
               pagLinks(data)
           
               PagValue()
              }, 
              error: err
              
          }); 
        }
       
    
    
    function pagLinks(data){
        var br = data.count.counts
        var countPerPage = 9    
        var countMatches = parseInt(br); 
        var countLink = (Math.ceil(countMatches / countPerPage)); 
           var isp = ''; 
        
           isp +=  '<ul>'
       
           for(var i = 1; i <= countLink ; i++) {              
          //  for(let i = countLink; i >= 1; i--){                                   
                                           isp += '<li class="page-part-otr"  >   <a  data-value="'+ i +'" href="#">'+ i +'</a>  </li>'     
                                           
           } 
           isp += '</ul>'
              
           $('#newsUsr').html(isp);
          
    
      }
      
    
      function pag(numb){
        let url = BaseUrl + "models/news/getNews.php";
      
        $.ajax({ 
            url: url, 
            type: 'GET', 
            dataType: 'json', 
            data : { numb : numb},
           success:function(data){
                      let pager = data.news
                      readAll(pager)
            },error: err
      
          })
       } 
      
    
       function newsId(){
        let url = BaseUrl + "models/news/getNews.php";
      
        $.ajax({ 
            url: url, 
            type: 'GET', 
            dataType: 'json', 
           success:function(data){
            $('.newslink a').click(function(e){  
                e.preventDefault();      
             
                  var newsid="";
               for(let i of data.news){
                  //   newsid = i.news_id
                  window.location.href = BaseUrl + "index.php?page=newsdetails&idnews="+ i.news_id; 
               }
         //     console.log(newsid) 
       //           window.location.href = BaseUrl + "index.php?page=newsdetails&idnews="+ newsid;   
            
        
        })
            },error: err
      
          })
       } 
