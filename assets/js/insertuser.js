const BaseUrl = "http://localhost:8080/php2/sajt1/" 
$(document).ready(function(){
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
                alert("Error");
                break;
        }
    }
    document.getElementById('profileUpdate').addEventListener("change" , UpdateImgBoxHide)
    $('#showUploadUser').change(ShowUpload);
 del();


 
 function del(){
     $('#tableUsers ').on("click" ,"tr td .deleteUser", function(e){
         e.preventDefault();
         var id = $(this).data('id');
 
         $.ajax({
             method: 'post',
             url: BaseUrl + "models/admin/users/delete.php",
             dataType: 'json',
             data: {
                 id : id
             },
             success: function(data){
                 alert("The user is successfully deleted");
             },
             error: err
         });
      })
 
    }

    Update()
    function Update(){
      $('#tableUsers').on("click" , "tr td .updateUser", function(e){
          e.preventDefault();
          $('#updateAdm').slideDown(2000)
          var id = $(this).data('id'); 
          $.ajax({
              method: 'POST',
              url: BaseUrl + "models/admin/users/updateGetUser.php",
              dataType: 'json',
              data: {
                  id : id
              },
              success: function(data,status,jqXHR){
                  console.log(jqXHR.status)
              
                //  let photo = BaseUrl + data.href 
            //    $('#adminUpdatePhoto').val(data.href);
                  $('#adminUpdateName').val(data.name);
                  $('#adminFormUpdatename').val(data.username);
                  $('#adminUpdateEmail').val(data.email);
             //     $('#adminUpdatePass').val(data.password);
            //     $('#updateReg').val(data.dateregister);
                  $('input[name="adminUpdateActive"]').removeAttr('checked');
                  if(data.active == 1){
                      $('input[name="adminUpdateActive"]').prop('checked',true);
                  $('input[name="adminUpdateActive"]').val(data.active);
                  }
                 $('#adminUpdateRole').val(data.role_id);
                           
                        $('#hiddenUserId').val(data.img_id);
                 
              },
              error: err
          });
  })
  }
})

$(window).load(HideUpload);
$(window).load(HideUpdate);
function HideUpload(){
  $('#btnUpdateImage').css('display','none');   
  $('label[for="photouserup"]').css('display','none')
}

function ShowUpload(){
$('#btnUpdateImage').css('display','block');   
$('label[for="photouserup"]').css('display','block')
$("#showUploadUser").hide()
    $('label[for="uploadshowuser"]').hide()
}

function HideUpdate(){ 
  $('#updateAdm').css('display','none')
}

function InsertUsers(){

    var regName = /^[A-ZČĆŽŠĐ][a-zčćžšđ]{2,20}(\s[A-ZČĆŽŠĐ][a-zčćžšđ]{2,20})$/; 
    var regUserR =/^[\.\_\-\w\d\@]{3,20}$/;
    var regEmailR =/^[\w]+[\.\_\-\w\d]*\@((gmail\.com)|(ict\.edu\.rs))$/;
  
    var nameR = $('#adminInsertName'); 
      var usernameR = $('#adminFormInsertname');
      var emailR = $('#adminInsertEmail'); 
      var passR = $('#adminInsertPass');
      var role = $('#adminInsertRole');
      var roleOption = $('#adminInsertRole option:selected');
      var active = $('#adminInsertActive') 
      var profile = $('#profileInsert');
      var profileBtn = $('#btnInsertImage')
  
    var regPassR =/^[A-z0-9\.\-\*\_\$\:\;\@\,]{6,20}$/;
  
      var errorsR = [];
  
            if(profile.val() == ""){
             // profileBtn.css("backgroundColor" , "#ff0000") 
             profileBtn.css("border","1px solid #ff0000");
              errorsR.push("Invalid photo");
            }else{
              profileBtn.css("backgroundColor" , "#f8f9fa") 
            }
  
            if(!regName.test(nameR.val()))
             {
                nameR.css("border","1px solid #ff0000");
                errorsR.push("Invalid name");
              }
            else
              { 
                nameR.css("border","1px solid #ced4da");
                
               }
  
               if(!regUserR.test(usernameR.val()))
               {
                  usernameR.css("border","1px solid #ff0000");
                  errorsR.push("Invalid username");
                 
                }
              else
                { 
                  usernameR.css("border","1px solid #ced4da");
                    
                 
                 }
     
              if(!regEmailR.test(emailR.val()))
              {
                       emailR.css("border","1px solid #ff0000");
                        errorsR.push("Invalid email");
                     
               }
             else
              {     
                    emailR.css("border","1px solid #ced4da");
                 
                  
              }
  
              if(!regPassR.test(passR.val()))
              {            
               passR.css("border","1px solid #ff0000");
               errorsR.push("Invalid password");
              
              }
             else
              {
                  passR.css("border","1px solid #ced4da");  
               }  
  
              let valList = ""
              $(roleOption ).each(function(){
                valList = $(this).val();
              });
  
               if(valList == "0"){
                role.css("border","1px solid #ff0000");
                errorsR.push("Role is not selected");
               }else{
                role.css("border","1px solid #ced4da");  
               }

               if ($("#adminInsertActive").is(":checked")) {
                alert("Active is checked");
            }
            else {
                errorsR.push("Active is not checked");
                alert("none checked");
                
            }


     var resultR = ''
     if(errorsR.length != 0)
     {
         for(var a in errorsR)
         {	
             resultR = ' <p style="color:#ff0000;"> ' + errorsR[a] + '</p> ';
      // document.getElementsByClassName("insadminstruction")[a].innerHTML = resultR;
            $('.insadminstruction').html(resultR)
         }
         return false;
     }
     else{
      
       alert("Data are successfully sent"); 
  
     return true;
  }
  
  
  
  }


  function UpdateUsers(){

    let regName = /^[A-ZČĆŽŠĐ][a-zčćžšđ]{2,20}(\s[A-ZČĆŽŠĐ][a-zčćžšđ]{2,20})$/; 
    let regUserR =/^[\.\_\-\w\d\@]{3,20}$/;
    let regEmailR =/^[\w]+[\.\_\-\w\d]*\@((gmail\.com)|(ict\.edu\.rs))$/;
    
    let showUload = $('#showUploadUser');
    let nameR = $('#adminUpdateName'); 
      let usernameR = $('#adminFormUpdatename');
      let emailR = $('#adminUpdateEmail'); 
      let passR = $('#adminUpdatePass');
      let role = $('#adminUpdateRole');
      let roleOption = $('#adminUpdateRole option:selected');
    let active = $('#adminUpdateActive') 
      let profile = $('#profileUpdate');
      let profileBtn = $('#btnUpdateImage');
      
  
    let regPassR =/^[A-z0-9\.\-\*\_\$\:\;\@\,]{6,20}$/;
  
      let errorsR = [];
              if(showUload.is(':checked')){
                   if(profile.val() == ""){
                        profileBtn.css("border","1px solid #ff0000")
                        errorsR.push("Invalid upload");
                   }else{
                       profileBtn.css("border","1px solid #ced4da");  
                   }
              }  

             
            if(!regName.test(nameR.val()))
             {
                nameR.css("border","1px solid #ff0000");
                errorsR.push("Invalid name");
              }
            else
              { 
                nameR.css("border","1px solid #ced4da");
                
               }

  
               if(!regUserR.test(usernameR.val()))
               {
                  usernameR.css("border","1px solid #ff0000");
                  errorsR.push("Invalid username");
                 
                }
              else
                { 
                  usernameR.css("border","1px solid #ced4da");
                    
                 
                 }
     
              if(!regEmailR.test(emailR.val()))
              {
                       emailR.css("border","1px solid #ff0000");
                        errorsR.push("Invalid email");
                     
               }
             else
              {     
                    emailR.css("border","1px solid #ced4da");
                 
                  
              }
  
              if(passR.val().length > 0)
              {            
                if(!regPassR.test(passR.val()))
                {
                         passR.css("border","1px solid #ff0000");
                          errorsR.push("Invalid password");
                       
                 }
               else
                {     
                      passR.css("border","1px solid #ced4da");
                   
                    
                }
              }
            
  
              let valList = ""
              $(roleOption ).each(function(){
                valList = $(this).val();
              });
  
               if(valList == "0"){
                role.css("border","1px solid #ff0000");
                errorsR.push("Role is not selected");
               }else{
                role.css("border","1px solid #ced4da");  
               }

               if ($("#adminUpdateActive").is(":checked")) {
                alert("Active is checked");
            }
            else {
                errorsR.push("Active is not checked");
                alert("none checked");
                
            }


     var resultR = ''
     if(errorsR.length != 0)
     {
      alert("Data are not successfully sent"); 
         return false;
     }
     else{
      
       alert("Data are successfully sent"); 
  
     return true;
  }
  
  
  
  }


  function UpdateImgBoxHide(){

  $('#UpdateImageValue').html($(this).val());  
 /* $('#adminUpdatePhoto').css("display" , "none"); 
  $('label[for="existphoto"]').css("display" , "none");*/
   

  }

  