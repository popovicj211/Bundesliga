const BaseUrl = "http://localhost:8080/php2/sajt1/";
window.onload = function(){
    $('#showUpload').change(ShowUpload);
    getNews("models/admin/news/getNews.php" , "news" )
    getNews("models/admin/newscomm/getNewsComm.php" , "usr"  )
 //   getUserId()
 UpdateNews();
   DeleteNews()
   document.getElementById('upPhotoNews').addEventListener("change" , UpdateImgBoxHideNews)
    DeleteComm()
  $('#listUsersNews').change(getUserIdList);
  $('#listNews').change(getNewsIdList);
  document.getElementById("commAdmBtn").addEventListener("click", commInsAdm);

}
$(window).load(HideUpload);
$(window).load(HideUpdate)

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
            case 400:
                 alert("Bad request!");     
        default:
            alert("Greska: " + status + " - " + statusTxt);
            break;
    }
  }

  function hidePag(){
    $('.pagNewsAdmUsr ').hide();
  }

function newsins(){
    let photo = document.getElementById("insPhotoNews")
    let team = document.getElementById("insTeamNews")     
    let teamlist = team.options[team.selectedIndex].value
    let name = document.getElementById("insNameNews")   
    let text = document.getElementById("insTextNews") 
    let btnPhoto = document.getElementById("btnPhotoNewsIns")
    let errors = [];
    
    let  regName = /^[A-Z](([\wÜÖÄüöä\.\,\*\+\?\!\-\/\'\:\;\"])+(\s)?)+$/;
    let regText = /^[A-ZÜÖÄa-züöä\d\s\.\,\*\+\?\!\-\_\/\'\:\;\"]{5,}$/;

     if(photo.value == ""){
        errors.push("Photo not uploaded")
      //  btnPhoto.css("border","1px solid #ff0000");
      btnPhoto.style.border = "1px solid #ff0000";
     }else{
        btnPhoto.style.border = "1px solid #ced4da";
     }

     if(teamlist == "0"){
        errors.push("Team is not selected")  
          team.style.border = "1px solid #ff0000"
     
      }else{
           team.style.border = "1px solid #ced4da";
 
       }

    if(!regName.test(name.value)){
         errors.push("Name not valid")
         name.style.border = "1px solid #ff0000";
    }else{
        name.style.border = "1px solid #ced4da";
    }

    if(!regText.test(text.value)){
        errors.push("Text not valid")
        text.style.border = "1px solid #ff0000";
   }else{
       text.style.border = "1px solid #ced4da";
   }
   
   
     if(errors.length > 0){
         /*   for(let i in errors){
                //  alert(errors[i]);
                  $(this).attr("placeholder", errors[i]);
             }*/
         return false;
     }else{
         return true;
     }

}


function newsup(){
    let showUload = document.getElementById("showUpload")
    let photoUp = document.getElementById("upPhotoNews")
 //   let photoExist = document.getElementById("upExistPhotoNews")
    let teamUp = document.getElementById("upTeamNews")     
    let teamlistUp = teamUp.options[teamUp.selectedIndex].value
    let nameUp = document.getElementById("upNameNews")   
    let textUp = document.getElementById("upTextNews") 
    let btnPhotoUp = document.getElementById("btnPhotoNewsUp")
    let errorsUp = [];

    let  regNameUp = /^[A-Z](([\wÜÖÄüöä\.\,\*\+\?\!\-\/\'\:\;\"])+(\s)?)+$/;
    let regTextUp = /^[A-ZÜÖÄa-züöä\d\s\.\,\*\+\?\!\-\_\/\'\:\;\"]{5,}$/;
//    let regExistP = /^assets\/images\/[\w]{3,50}\.(jpg|png)$/;

        
if(showUload.checked == true){
    if(photoUp.value == ""){
        btnPhotoUp.style.border = "1px solid #ff0000"
         errorsUp.push("Invalid upload");
    }else{
        btnPhotoUp.style.border = "1px solid #ced4da";  
    }
}  

    if(teamlistUp == "0"){
        errorsUp.push("Team is not selected")  
          teamUp.style.border = "1px solid #ff0000"
     
      }else{
           teamUp.style.border = "1px solid #ced4da";
 
       }

   if(!regNameUp.test(nameUp.value)){
        errorsUp.push("Name not valid")
        nameUp.style.border = "1px solid #ff0000";
   }else{
       nameUp.style.border = "1px solid #ced4da";
   }

   if(!regTextUp.test(textUp.value)){
         errorsUp.push("Text not valid")
        textUp.style.border = "1px solid #ff0000";
   }else{
       textUp.style.border = "1px solid #ced4da";
}

  

    if(errorsUp.length > 0){
        return false;
    }else{
        return true;
    }

}

function getNews(loc  , prin){
   
   
    $.ajax({
        method: 'get',
        url: BaseUrl + loc,
        dataType: 'json',
        success: function(data){
          
           switch(prin){
                case "news":  NewsPrinting(data.news);
                pagination( data ,"models/admin/news/getNews.php", ".pagNewsAdm" , "news"  )
                break;
                case "usr": NewsComment(data.usr);
                pagination( data ,"models/admin/newscomm/getNewsComm.php", ".pagNewsAdmUsr" , "usr")
                break;
               
               
         }
       

        }, error: err
    })   
}

function getUserIdList(){
    let id = $(this).val() 
      let loc = "models/admin/newscomm/getNewsCommUser.php"
    let url = BaseUrl + loc;
    if($('#listUsersNews').val() != 0){
  
      $.ajax({
             url: url,
            method:"get",
           dataType:"json",
            data : { id : id  },
            success:function(data){
           
        
         NewsComment(data.usrlist) 
        
           pagination(data , loc, ".pagNewsAdmUsr" , "usrlist"  )
        
          } , error : err                        
  })
    }

  $("#listUsersNews option").each(function() {
         $('#listUsersNews option:first-child').hide()
           
  });
  
  
  
  }


  function getNewsIdList(){
    let id = $(this).val() 
      let loc = "models/admin/newscomm/getNewsCommList.php"
    let url = BaseUrl + loc;
    if($('#listNews').val() != 0){
  
      $.ajax({
             url: url,
            method:"get",
           dataType:"json",
            data : { id : id  },
            success:function(data){
    
         NewsComment(data.newslist) 
     
           pagination(data , loc, ".pagNewsAdmUsr" , "newslist"  )
        
          } , error : err                        
  })
    }

  $("#listNews option").each(function() {
         $('#listNews option:first-child').hide()
           
  });
  
  
  
  }



function NewsPrinting(data){
    let isp = "";
    let br = 0;
     for(let i of data){
       let dateTime = new Date(i.date)
       let arrMonth = ["Jan","Feb","Mar","Apr","May","Jun","Jul","Aug" ,"Sep","Okt","Nov","Dec"]
       let dateTimeS = dateTime.getDate() + "-" + arrMonth[dateTime.getMonth()] + "-" + dateTime.getFullYear() + " " + dateTime.getHours() + ":" + dateTime.getMinutes() + ":" + dateTime.getSeconds()
     isp += ` <tr>
        <td scope="col">  ${br + 1} </td>
        <td scope="col"> <img src="assets/images/${i.href}" alt="${i.alt}" class="imgNews" /> </td>
       <td scope="col">${i.teamname}</td>
        <td scope="col"><p class="textNews">${i.name}</p></td>
       <td scope="col"> <p class="textNews"> ${i.text} </p> </td>
       <td scope="col"> ${dateTimeS}</td>
       <td> <a class="btn btn-primary updateTeamNews" data-id="${i.news_id}-${i.img_id}"  href="#">  Update </a> </td>
            <td> <a  class="btn btn-dark deleteTeamNews"  data-id="${i.news_id}-${i.img_id}" href="#"> Delete </a>  </td>

</tr>`
br++
     }
     $('#tableTeamsNews').html(isp)
}


function NewsComment(data){

    let isp = "";
    let br = 0;
     for(let i of data){
       let dateTime = new Date(i.date)
       let arrMonth = ["Jan","Feb","Mar","Apr","May","Jun","Jul","Aug" ,"Sep","Okt","Nov","Dec"]
       let dateTimeS = dateTime.getDate() + "-" + arrMonth[dateTime.getMonth()] + "-" + dateTime.getFullYear() + " " + dateTime.getHours() + ":" + dateTime.getMinutes() + ":" + dateTime.getSeconds()
     isp += ` <tr>
        <td scope="col">  ${br + 1} </td>
        <td scope="col"> <img  src="assets/images/${i.href}" alt="${i.alt}" class="rounded" /> </td>
        <td scope="col"><p >${i.name}</p></td>
       <td scope="col"> <p> ${i.text} </p> </td>
       <td scope="col"> ${dateTimeS}</td>
            <td> <a  class="btn btn-dark deleteTeamNewsComm"  data-id="${i.comm_id}-${i.user_id}-${i.news_id}" href="#"> Delete </a>  </td>

</tr>`
br++
     }
     $('#tableTeamsNewsComm').html(isp)    


}


function UpdateNews(){
    $('#tableTeamsNews').on("click" ,"tr td .updateTeamNews", function(e){
        e.preventDefault();
        $('#updateNewsAdm').slideDown(2000)
        var id = $(this).data('id');
         let newImg = id.split("-")
          let news = parseInt(newImg[0])
          let img = parseInt(newImg[1])

        $.ajax({
            method: 'POST',
            url: BaseUrl + "models/admin/news/getNewUp.php",
            dataType: 'json',
            data: {
                idnews: news,
                idimg: img
            },
            success: function(data,status,jqXHR){

             $('#upTeamNews').val(data.team_id);
             $('#upNameNews').val(data.name);
             $('#upTextNews').val(data.text);
             $('#upIdNews').val(data.news_id);
              $('#upIdImgN').val(data.img_id);
            },
            error: err
        });
})
}

function UpdateImgBoxHideNews(){
    $('#UpdateImgValNews').html($(this).val());  
    }

    function HideUpload(){
       $('#btnPhotoNewsUp').css('display','none');   
       $('label[for="photoup"]').css('display','none')
    }

   function ShowUpload(){
    $('#btnPhotoNewsUp').css('display','block');   
    $('label[for="photoup"]').css('display','block')
    $("#showUpload").hide()
    $('label[for="uploadshow"]').hide()
   }

   function HideUpdate(){ 
    $('#updateNewsAdm').css('display','none')
  }


    function DeleteNews(){

        $('#tableTeamsNews').on("click" ,"tr td .deleteTeamNews", function(e){
            e.preventDefault();
            var id = $(this).data('id');
            let newImg = id.split("-")
          let news = parseInt(newImg[0])
          let img = parseInt(newImg[1])

            $.ajax({
                method: 'post',
                url: BaseUrl + "models/admin/news/deleteNews.php",
                dataType: 'json',
                data: {
                    idnews: news,
                    idimg: img
                },
                success: function(data){
                    alert("The news was successfully deleted");
                },
                error: err
            });
         })

    }


function pagination( data , pr , write , print ){

    PagValue( pr, write , print )
    function PagValue(  pr ,pgvalue , print ){
        $(pgvalue).on("click",".page-part-otr a" , function(e){
          e.preventDefault()          
        let numb = $(this).data("value");
      
        pag(numb , pr , print )
      
        
        })
      }
         
      pagLinks(data , write)
      function pagLinks(data , wr){
        var br = data.count.counts
        var countPerPage = 2
        var countMatches = parseInt(br); 
        var countLink = (Math.ceil(countMatches / countPerPage)); 
           var isp = ''; 
        
           isp +=  '<ul>'
       
           for(var i = 1; i <= countLink ; i++) {                                           
                                           isp += '<li class="page-part-otr"  >   <a  data-value="'+ i +'" href="#">'+ i +'</a>  </li>'     
                                           
           } 
           isp += '</ul>'
              
           $(wr).html(isp);
    
      }
      
      
      function pag(numb , loc , print ){
        let url = BaseUrl + loc;
      
        $.ajax({ 
            url: url, 
            type: 'GET', 
            dataType: 'json', 
            data : { numb : numb },
           success:function(data){
            
                      let pager = data.news
                      let pager2 = data.usr  
                      let pager3 = data.usrlist         
                     switch(print){
                             case "news":  NewsPrinting(pager);
                             break;
                             case "usr": NewsComment(pager2);
                             break   
                             case "usrlist": NewsComment(pager3);
                             break             
                      }  
                      
            },error: err
      
          })
       } 


}


 function DeleteComm(){

    $('#tableTeamsNewsComm').on("click" ,"tr td .deleteTeamNewsComm", function(e){
        e.preventDefault();
        var id = $(this).data('id');
        let newsComm = id.split("-")
      let comm = parseInt(newsComm[0])
      let user = parseInt(newsComm[1])
      let news = parseInt(newsComm[2])
      console.log(comm)
console.log(user);

        $.ajax({
            method: 'post',
            url: BaseUrl + "models/admin/newscomm/deleteComm.php",
            dataType: 'json',
            data: {
                idcomm: comm,                      
                iduser: user ,
                idnews: news                   

            },
            success: function(data){
                alert("The news was successfully deleted");
            },
            error: err
        });
     })
 

 }






 function commInsAdm(){
    var commnews = document.getElementById("commAdmIns")     
    var newsId = document.getElementById("listCommNewsAdm")
    var newsIdList = newsId.options[newsId.selectedIndex].value


  let regCommNews = /^[A-ZČĆŽŠĐÜÖÄa-züöäčćžšđ\d\s\.\,\*\+\?\!\-\_\/\'\:\;\"\#\@\$\%\^]{5,}$/
let errors = [];
    
    if(newsIdList == "0"){
        newsId.style.border = "1px solid #ff0000"
        errors.push("News is not selected!")
    }else{
        newsId.style.border = "1px solid #ced4da";
    }

    if(!regCommNews.test(commnews.value)){
           commnews.style.border = "1px solid #ff0000"
           errors.push("Comm is not valid!")
    } else{
        commnews.style.border = "1px solid #ced4da";
    }
      

     if(errors.length > 0){
          alert(errors);
     }else{
         ajaxInsCAdm()
     }

    function ajaxInsCAdm() {

            $.ajax({
                url: BaseUrl + "models/admin/newscomm/insertNewsComm.php",
                method: "post",
                dataType: "json",
                data : {
                              commAdmBtn:"Send",
                              listCommNewsAdm:newsIdList ,
                              commAdmIns:commnews.value,
                           
                },
                success : function(data){
                
                 alert (data.message);
                },
                 error : err
                
            })
      
          
    
    }


}