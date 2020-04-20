const BaseUrl = "http://localhost:8080/php2/sajt1/";
window.onload = function(){
    $('#showUploadTeam').change(ShowUpload);
   getSch()
   UpdateTeam();
   DeleteTeams()
   document.getElementById('upPhotoTeam').addEventListener("change" , UpdateImgBoxHideSchs)
}
$(window).load(HideUpload);
$(window).load(HideUpdate);
/*
 function Errors(xhr,status,Msgerror){
    var poruka = "";
    switch(xhr.status) {
        case 404 :
            poruka = "Page not found";
            break;
       case 422:
           poruka = "Data are not validate.";
            break;
        case 500:
            poruka = "Error on server";
            break;
    }
 }*/

function schins(){
    let photo = $('#insPhotoTeam');
    let existP = $('#upExistPhoto')
    let name = $('#insNameTeam');
    let w = $('#insWTeam');
    let d = $('#insDTeam');
    let l = $('#insLTeam');
    let pts = $('#insPTeam');
    let btnPhoto = $('#btnPhotoIns');
    let errors = [];
    
    let  regName = /^[A-Z](([\wÜÖÄüöä])+(\s)?)+$/;
     let  regNumb = /^[\d]{1,3}$/;
  
     if(photo.val() == ""){
        errors.push("Photo not upload")
      //  btnPhoto.css("border","1px solid #ff0000");
      btnPhoto.css("border","1px solid #ff0000");
     }else{
        btnPhoto.css("border","1px solid #ced4da");
     }

    if(!regName.test(name.val())){
         errors.push("Name not valid")
         name.css("border","1px solid #ff0000");
         name.attr("placeholder", "Name not valid!");
    }else{
        name.css("border","1px solid #ced4da");
    }

    if(!regNumb.test(w.val())){
        errors.push("W not valid")
        w.css("border","1px solid #ff0000");
        w.attr("placeholder", "W not valid!");
   }else{
       w.css("border","1px solid #ced4da");
   }
   
   if(!regNumb.test(d.val())){
          errors.push("D not valid")
          d.css("border","1px solid #ff0000");
          d.attr("placeholder", "D not valid!");
     }else{
        d.css("border","1px solid #ced4da");
     }
    
     if(!regNumb.test(l.val())){
        errors.push("L not valid")
        l.css("border","1px solid #ff0000");
        l.attr("placeholder", "L not valid!");
   }else{
       l.css("border","1px solid #ced4da");
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


function schup(){

    let photoUp = $('#upPhotoTeam');
    let showUpload = $('#showUploadTeam');
    let btnPhoto = $('#btnPhotoUp')
    let nameUp = $('#upNameTeam');
    let wUp = $('#upWTeam');
    let dUp = $('#upDTeam');
    let lUp = $('#upLTeam');
  
    let errorsUp = [];

    let  regNameUp = /^[A-Z](([\wÜÖÄüöä])+(\s)?)+$/;
    let  regNumbUp = /^[\d]{1,3}$/;

    if(showUpload.is(':checked')){
        if(photoUp.val() == ""){
            btnPhoto.css("border","1px solid #ff0000")
             errorsUp.push("Invalid upload");
        }else{
            btnPhoto.css("border","1px solid #ced4da");  
        }
   }  

   if(!regNameUp.test(nameUp.val())){
        errorsUp.push("Name not valid")
        nameUp.css("border","1px solid #ff0000");
   }else{
       nameUp.css("border","1px solid #ced4da");
   }

   if(!regNumbUp.test(wUp.val())){
       errorsUp.push("W not valid")
       wUp.css("border","1px solid #ff0000");
  }else{
      wUp.css("border","1px solid #ced4da");
  }
  
  if(!regNumbUp.test(dUp.val())){
         errorsUp.push("D not valid")
         dUp.css("border","1px solid #ff0000");
    }else{
       dUp.css("border","1px solid #ced4da");
    }
   
    if(!regNumbUp.test(lUp.val())){
       errorsUp.push("L not valid")
       lUp.css("border","1px solid #ff0000");
  }else{
      lUp.css("border","1px solid #ced4da");
  }


    if(errorsUp.length > 0){
        /*   for(let i in errors){
               //  alert(errors[i]);
                 $(this).attr("placeholder", errors[i]);
            }*/
        return false;
    }else{
        return true;
    }

}

function HideUpload(){
    $('#btnPhotoUp').css('display','none');   
    $('label[for="photouploadteam"]').css('display','none')
 }

function ShowUpload(){
 $('#btnPhotoUp').css('display','block');   
 $('label[for="photouploadteam"]').css('display','block')
 $("#showUploadTeam").hide()
    $('label[for="uploadshowteam"]').hide()
}

function HideUpdate(){ 
    $('#updateTeamsAdm').css('display','none')
 }


function err(xhr, statusTxt, error){
    var status = xhr.status;
    switch(status){
        case 500:
            alert("Error on server. It is currently not possible to update users.");
            break;
            case 404:
                alert("Page not found.");
                break;
        default:
            alert("Greska: " + status + " - " + statusTxt);
            break;
    }
}



function getSch(){
   
   
    $.ajax({
        method: 'get',
        url: BaseUrl + "models/admin/teams/getSchedule.php",
        dataType: 'json',
        success: function(data){
             let isp = "";
             let br = 0;
              for(let i of data){
              isp += ` <tr>
                 <td scope="row"> ${br + 1}  </td>
                 <td> ${i.name} </td>
                 <td> ${i.w} </td>
                 <td> ${i.d} </td>
                 <td> ${i.l} </td>
                 <td> ${i.pts} </td>
                 <td> <a class="btn btn-primary updateTeamSch" data-id="${i.id_img}"  href="#">  Update </a> </td>
                 <td> <a  class="btn btn-dark deleteTeamSch"  data-id="${i.id_img}" href="#"> Delete </a>  </td>
     </tr>`
      br++
              }
              $('#tableTeamsSch').html(isp)
        }, error: err
    })   
}




function UpdateTeam(){
    $('#tableTeamsSch').on("click" ,"tr td .updateTeamSch", function(e){
        e.preventDefault();  
        $('#updateTeamsAdm').slideDown(2000)
        var id = $(this).data('id');
        // alert(id);
console.log(id)
        $.ajax({
            method: 'post',
            url: BaseUrl + "models/admin/teams/updateGetSch.php",
            dataType: 'json',
            data: {
                id : id
            },
            success: function(data,status,jqXHR){
                console.log(data)
                console.log(jqXHR.status)
                $('#upNameTeam').val(data.name);
                $('#upWTeam').val(data.w);
                $('#upDTeam').val(data.d);
                $('#upLTeam').val(data.l);
             $('#idTeam').val(data.id_img);
               
            },
            error: err
        });
})
}

function UpdateImgBoxHideSchs(){

    $('#UpdateImgVal').html($(this).val());  
   /* $('#upExistPhoto').css("display" , "none"); 
    $('label[for="existphotosch"]').css("display" , "none");*/
     
  
    }

    function DeleteTeams(){

        $('#tableTeamsSch').on("click" ,"tr td .deleteTeamSch", function(e){
            e.preventDefault();
            var id = $(this).data('id');
    console.log(id);
            $.ajax({
                method: 'post',
                url: BaseUrl + "models/admin/teams/deleteSch.php",
                dataType: 'json',
                data: {
                    id : id
                },
                success: function(data){
                    alert("The user was successfully deleted");
                },
                error: err
            });
         })

    }