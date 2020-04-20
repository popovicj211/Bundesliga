const BASE_URL = "http://localhost:8080/php2/sajt1/"

   window.onload = function(){
 // $(document).ready(function(){
//    document.getElementById("btnlog").addEventListener("click", ValidationLogin);
  // $('#btnlog').click(ValidationLogin);

 //   document.getElementById("btnsignup").addEventListener("click", ValidationSignup);

// ValidationSignup()

  $('.close').click(Reset)
  // })
}

window.addEventListener("load", loading); 
window.addEventListener("load", loadingreg)

$('#subEmBtn').click(SubscribeEmail)

function  Errors(xhr,status,Msgerror){
  var poruka = "";
  switch(xhr.status) {
    case 404 :
      alert("Page not found!");
      break;
      case 400 :
        alert("Bad request!");
        break;
     case 422:
       alert("Data are not validate!");
      break;
      case 401:
        alert("User is not authorized!");
       break;
       case 409:
        alert("Data exist!");
       break;
      case 500:
      alert("Error!");
       break;
  }
}

var emailL = $("#logemail"); 
var passL = $("#logpassword"); 
var icon = $(".icon"); 

var nameR = $('#regname'); 
    var usernameR = $('#regusername');
    var emailR = $('#regemail'); 
    var passR = $('#regpassword'); 
    var profile = $('#profile');
    var profileBtn = $('#btnProImage')

function loading(){
    let  loadArray = ["Please enter your email ","Password should be at least 6 characters upper case , lower case and digits"]
   // let  loadArrayReg = ["Please enter your name","Please enter your username","Please enter your e-mail","Password should be at least 6 characters  upper case, lower case and digits"]
    let result = ''
    for(var z in loadArray)
    {	
        result = ' <p style="color:#000;"> ' + loadArray[z] + '</p> ';
         document.getElementsByClassName("loginstruction")[z].innerHTML = result;
    }

  /*  let resultReg = ''
    for(var c in loadArrayReg)
    {	
        resultReg = ' <p style="color:#000;"> ' + loadArrayReg[c] + '</p> ';
         document.getElementsByClassName("reginstruction")[c].innerHTML = resultReg;
    }
*/

}


function loadingreg(){
    let  loadArrayReg = ["Please choose your photo","Please enter your name","Please enter your username","Please enter your e-mail","Password should be at least 6 characters  upper case, lower case and digits"]
    let result = ''
    for(var c in loadArrayReg)
    {	
        result = ' <p style="color:#000;"> ' + loadArrayReg[c] + '</p> ';
         document.getElementsByClassName("reginstruction")[c].innerHTML = result;
    }
  }
 


    function ValidationLogin(){
       
		var regEmail =/^[\w]+[\.\_\-\w\d]*\@((gmail\.com)|(ict\.edu\.rs))$/;
		var regPass =/^[A-z0-9\.\-\*\_\$\:\;\@\,]{6,60}$/;
	
		var goodArray = [];
		var errors = [];
	
		if(!regEmail.test(emailL.val()))
		{
				 emailL.css("border","1px solid #ff0000");
                 errors.push("Invalid email");
                 icon.css("color" , "#ff0000")
		}
		else
		{     
			emailL.css("border","1px solid #ced4da");
            goodArray.push("Email successfully entered");
              icon.css("color" , "#444")
		}
		
		if(!regPass.test(passL.val()))
		{
				   
			passL.css("border","1px solid #ff0000");
            errors.push("Invalid password");
            icon.css("color" , "#ff0000")
		}
		else
		{
			passL.css("border","1px solid #ced4da");
            goodArray.push("Password successfully entered");
            icon.css("color" , "#444")
		}
		
		var result = ''
		if(errors.length != 0)
		{
			for(var x in errors)
			{	
				result = ' <p style="color:#ff0000;"> ' + errors[x] + '</p> ';
			   document.getElementsByClassName("loginstruction")[x].innerHTML = result;
      }
      return false;
		}
		else
		{
			for(var y in goodArray)
			{	
				result = ' <p style="color:#000;"> ' + goodArray[y] + '</p> ';
				document.getElementsByClassName("loginstruction")[y].innerHTML = result;
			}
      //ajaxLogin()
      return true;
		}
	
		function ajaxLogin(){
			 
			$.ajax({
				url: BASE_URL + "models/user/login.php",
				method: "post",
				dataType: "json",
				data : {
						 btnlog:"LogIn", 
						 logemail:emailL.val(),       
                         logpassword:passL.val()
					  
				},
				success : function(data){
				
				  alert(data.message);
     //   Swal.fire(data.message);
				},
				 error : Errors
				
			})
	  
		  }
    }
    
   
   function ValidationSignup(){

    
    var regName = /^[A-ZČĆŽŠĐ][a-zčćžšđ]{2,20}(\s[A-ZČĆŽŠĐ][a-zčćžšđ]{2,20})$/; 
    var regUserR =/^[\.\_\-\w\d\@]{3,20}$/;
    var regEmailR =/^[\w]+[\.\_\-\w\d]*\@((gmail\.com)|(ict\.edu\.rs))$/;

 
    var regPassR =/^[A-z0-9\.\-\*\_\$\:\;\@\,]{6,20}$/;

      var goodArrayR = [];
      var errorsR = [];

            if(profile.val() == ""){
              profileBtn.css("backgroundColor" , "#ff0000") 
              errorsR.push("Invalid photo");
            }else{
              profileBtn.css("backgroundColor" , "#17a2b8") 
              goodArrayR.push("Photo is successfully selected"); 
            }

            if(!regName.test(nameR.val()))
             {
                nameR.css("border","1px solid #ff0000");
                errorsR.push("Invalid name");
                icon.css("color" , "#ff0000")
              }
            else
              { 
                nameR.css("border","1px solid #ced4da");
                goodArrayR.push("Name successfully entered");       
                icon.css("color" , "#444")
               }


               if(!regUserR.test(usernameR.val()))
               {
                  usernameR.css("border","1px solid #ff0000");
                  errorsR.push("Invalid username");
                  icon.css("color" , "#ff0000")
                }
              else
                { 
                  usernameR.css("border","1px solid #ced4da");
                  goodArrayR.push("Username successfully entered");       
                  icon.css("color" , "#444")
                 }
     
              if(!regEmailR.test(emailR.val()))
              {
                       emailR.css("border","1px solid #ff0000");
                        errorsR.push("Invalid email");
                        icon.css("color" , "#ff0000")
               }
             else
              {     
                    emailR.css("border","1px solid #ced4da");
                    goodArrayR.push("Email successfully entered");
                    icon.css("color" , "#444")
              }

              if(!regPassR.test(passR.val()))
              {            
               passR.css("border","1px solid #ff0000");
               errorsR.push("Invalid password");
               icon.css("color" , "#ff0000")
              }
             else
              {
                  passR.css("border","1px solid #ced4da");
                  goodArrayR.push("Password successfully entered");
                  icon.css("color" , "#444")
               }  


     var resultR = ''
     if(errorsR.length != 0)
     {
         for(var a in errorsR)
         {	
             resultR = ' <p style="color:#ff0000;"> ' + errorsR[a] + '</p> ';
       document.getElementsByClassName("reginstruction")[a].innerHTML = resultR;
         }
         return false;
     }
     else{
     for(var b in goodArrayR)
     {	
         resultR = ' <p style="color:#000;"> ' + goodArrayR[b] + '</p> ';
         document.getElementsByClassName("reginstruction")[b].innerHTML = resultR;
         
     }

     return true;
 }



   }


   function Reset(){
      
    emailL.val(""); 
    passL.val("");
    icon.css("color" , "#444")
    nameR.val("")
    usernameR.val("")
    emailR.val("")
    passR.val("")
    profile.val("")

    loading()

   }



   function SubscribeEmail(){

    let emailS = $('#addSubEmail')
    let regEmail = /^[\w]+[\.\_\-\w\d]*\@((gmail\.com)|(ict\.edu\.rs))$/;
    
     if(!regEmail.test(emailS.val())){
            emailS.removeClass("border-secondary")
           emailS.css({"border" : "1px solid #df1b0e"})
       alert("Not validate")
     }else{
  
           emailS.addClass("border-secondary")
           ajaxSub()
     }

    function ajaxSub(){

      $.ajax({ 
        url: BASE_URL + "models/admin/subscribe/insertSubEmail.php", 
        type: 'post', 
        dataType: 'json', 
        data : { 
          subEmBtn: "Send",
          addSubEmail: emailS.val()
        },
       success:function(data){
             alert("Email is successfully send!")
        },error: Errors
  
      })

    }
    
    }

   