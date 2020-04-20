
  
 //$(document).ready(function(){
  window.onload = function(){ 
    const BaseUrl = "http://localhost:8080/php2/sajt1/" 

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




 //users()
 //pagination()
 UserPag('#pagUser' , "models/admin/users/getAllUsers.php" , '#pagUser' , 1 , 1)
 UserPag('#pagContact' , "models/admin/contact/getAllCont.php" , '#pagContact' , 2 , 2)
 UserPag('#pagSub' , "models/admin/subscribe/getSubEmail.php" , '#pagSub' , 3 , 3)
 DeleteSubs()
 DeleteCont()
 /*
 function users(){

    let url = BaseUrl + "models/admin/users/getAllUsers.php";

   $.ajax({
       url:url,
       method:"GET",
        dataType:"json",
        success:function(data){

       dataUsers(data.pag)
          
          pagLinks(data)
        

        }, error : error
   })
}
*/


function dataUsers(dataArt){
  let isp=""
   let c = 0;
  for(let i of dataArt){

    let datetime = new Date(i.dateregister)
            
    let month = ["Jan" , "Feb" , "Mar" , "Apr" , "May" , "Jun" , "Jul" , "Aug" , "Sep" , "Okt" , "Nov" ,"Dec"]         
    let dtime =  datetime.getDate() + "-" +  month[datetime.getMonth()] + "-" + datetime.getFullYear() + " " + datetime.getHours() + ":" + datetime.getMinutes() + ":" + datetime.getSeconds();
     
     isp +=` <tr>
                     <td scope="row"> ${c + 1} </td>
                     <td> <img class="rounded-circle" src="assets/images/${i.href}" alt="${i.alt}">  </td>
                    <td> ${i.name } </td>
                    <td> ${i.username} </td>
                     <td> ${i.email}  </td>     
                     <td> ${dtime} </td>
                     <td> <a class="btn btn-primary updateUser" data-id="${i.img_id}" href="#">  Update </a> </td>
                     <td> <a  class="btn btn-dark deleteUser " data-id="${i.img_id}" href="#"> Delete </a>  </td>
              </tr>` 
              c++
  }

            $('#tableUsers').html(isp);
}


function ContactData(pag){
  let isp = ""
  let br = 0;   
   for(let i of pag){
   isp += `<tr>
           <td scope="col"> ${br+1} </td>
            <td scope="col"> ${i.firstname}</td>
            <td scope="col"> ${i.lastname}  </td>
             <td scope="col"> ${i.email}  </td>
            <td scope="col"> ${i.subject}  </td>
             <td scope="col"> ${i.text}  </td>
             <td scope="col"> <a  class="btn btn-dark deleteCont"  data-id="${i.con_id}" href="#"> Delete </a> </td>
    </tr>`
      br++
  }
  $("#tableCont").html(isp)
}

function SubEmailData(pag){

  let isp = ""
  let br = 0;   
   for(let i of pag){
     let dateTime = new Date(i.datetime)
      let dateTimeS = dateTime.getDate() + "-" + dateTime.getMonth() + 1 + "-" + dateTime.getFullYear() + " " + dateTime.getHours() + ":" + dateTime.getMinutes()  + ":" + dateTime.getSeconds()
   isp += `<tr>
           <td scope="col"> ${br+1} </td>
            <td scope="col"> ${i.email}</td>
            <td scope="col"> ${dateTimeS}  </td>
             <td scope="col"> <a class="btn btn-dark deleteSub" data-id="${i.id_sub}" href="#"> Delete </a> </td>
    </tr>`
      br++
  }
  $("#tableSub").html(isp)

}


/*

function PagValue(){
    $('#pagUser').on("click",".page-part-otr a" , function(e){
      e.preventDefault()          
    let numb = $(this).data("value");
  
    pag(numb)
  
    
    })
  }
  


  function pagination() { 

    let url = BaseUrl + "models/admin/users/getAllUsers.php";
   
      $.ajax({ 
          url: url, 
          method: 'GET', 
          dataType: 'json', 
          success: function(data) { 
           pagLinks(data)
         
            PagValue()
          }, 
          error: error
          
      }); 
    }
   


function pagLinks(data){
    var br = data.broj.counts
    var countPerPage = 3
    var countMatches = parseInt(br); 
    var countLink = (Math.ceil(countMatches / countPerPage)); 
       var isp = ''; 
    
       isp +=  '<ul>'
   
       for(var i = 1; i <= countLink ; i++) {              
      //  for(let i = countLink; i >= 1; i--){                                   
                                       isp += '<li class="page-part-otr"  >   <a  data-value="'+ i +'" href="#">'+ i +'</a>  </li>'     
                                       
       } 
       isp += '</ul>'
          
       $('#pagUser').html(isp);
     

  }
  

  function pag(numb){
    let url = BaseUrl + "models/admin/users/getAllUsers.php";
  
    $.ajax({ 
        url: url, 
        type: 'GET', 
        dataType: 'json', 
        data : { numb : numb},
       success:function(data){
                  let pager = data.pag
                  dataUsers(pager)
      
        },error: error
  
      })
   } 
   
 */



//})

function UserPag(idSelector , location , links ,showData , showDataInit){
  users()
  pagination()
  
 

  function users(){

    let url = BaseUrl + location;

   $.ajax({
       url:url,
       method:"GET",
        dataType:"json",
        success:function(data){

       if(showDataInit == 1){
            dataUsers(data.pag)
       }else if(showDataInit == 2){
            ContactData(data.pag)
        }else{
          SubEmailData(data.pag)
        }
          
          pagLinks(data)
        

        }, error : error
   })
}

function PagValue(){
  $(idSelector).on("click",".page-part-otr a" , function(e){
    e.preventDefault()          
  let numb = $(this).data("value");

  pag(numb)

  
  })
}

       

function pagination() { 

  let url = BaseUrl + location;
 
    $.ajax({ 
        url: url, 
        method: 'GET', 
        dataType: 'json', 
        success: function(data) { 
         pagLinks(data)
       
          PagValue()
        }, 
        error: error
        
    }); 
  }
 


function pagLinks(data){
  var br = data.broj.counts
  var countPerPage = 3
  var countMatches = parseInt(br); 
  var countLink = (Math.ceil(countMatches / countPerPage)); 
     var isp = ''; 
  
     isp +=  '<ul>'
 
     for(var i = 1; i <= countLink ; i++) {              
    //  for(let i = countLink; i >= 1; i--){                                   
                                     isp += '<li class="page-part-otr"  >   <a  data-value="'+ i +'" href="#">'+ i +'</a>  </li>'     
                                     
     } 
     isp += '</ul>'
        
     $(links).html(isp);
   

}


function pag(numb){
  let url = BaseUrl + location;

  $.ajax({ 
      url: url, 
      type: 'GET', 
      dataType: 'json', 
      data : { numb : numb},
     success:function(data){
                let pager = data.pag             
                if(showData == 1){
                      dataUsers(pager)
                }else if(showData == 2){
                  ContactData(pager)
                }else{
                  SubEmailData(pager)
                }
      },error: error

    })
 }

}

function DeleteSubs(){

  $('#tableSub').on("click" ,"tr td .deleteSub", function(e){
      e.preventDefault();
      var id = $(this).data('id');
      $.ajax({
          method: 'post',
          url: BaseUrl + "models/admin/subscribe/deleteSub.php",
          dataType: 'json',
          data: {
              id : id
          },
          success: function(data){
              alert("The user was successfully deleted");
          },
          error: error
      });
   })

}

function DeleteCont(){

  $('#tableCont').on("click" ,"tr td .deleteCont", function(e){
      e.preventDefault();
      var id = $(this).data('id');
      $.ajax({
          method: 'post',
          url: BaseUrl + "models/admin/contact/deleteCont.php",
          dataType: 'json',
          data: {
              id : id
          },
          success: function(data){
              alert("The user was successfully deleted");
          },
          error: error
      });
   })

}

  }


