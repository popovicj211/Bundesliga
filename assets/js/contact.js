window.onload = function(){
    document.getElementById("btncontact").addEventListener("click", processcont);
}


function processcont(){

    var fname = $('#fnameC');
    var lname = $('#lnameC');
    var emailC = $('#emailC');
    var subj = $('#subjectC')
    var message = $('#messageC')

    var regFname =/^[A-ZČĆŠĐŽ][a-zčćšđž]{3,30}$/;
    var regLname =/^[A-ZČĆŠĐŽ][a-zčćšđž]{3,30}(\s[A-ZČĆŠĐŽ][a-zčćšđž]{2,30})*$/;
   var regEmail =/^[\w]+[\.\_\-\w\d]*\@((gmail\.com)|(ict\.edu\.rs))$/;
    var regMessage =/^[A-ZČĆŠĐŽa-zčćšđž\d\s\.\,\*\+\?\!\-\_\/\'\:\;]{5,}$/; 

    var errors = [];

    if(!regFname.test(fname.val()))
    {
           fname.css("border","1px solid #ff0000");
             errors.push("Invalid first name");
    }
    else
    {     
           fname.css("border","1px solid #ced4da");

    }
    
    if(!regLname.test(lname.val()))
    {
               
               lname.css("border","1px solid #ff0000");
               errors.push("Invalid last name");
    }
    else
    {
         lname.css("border","1px solid #ced4da");
         
    }

    if(!regEmail.test(emailC.val()))
    {
               
               emailC.css("border","1px solid #ff0000");
               errors.push("Invalid email");
    }
    else
    {
         emailC.css("border","1px solid  #ced4da");
    }

    if(!regLname.test(subj.val()))
    {
           subj.css("border","1px solid #ff0000");
             errors.push("Invalid subject");
    }
    else
    {     
           subj.css("border","1px solid #ced4da");

    }

    if(!regMessage.test(message.val()))
    {
           message.css("border","1px solid #ff0000");
             errors.push("Invalid message");
    }
    else
    {     
           message.css("border","1px solid #ced4da");

    }
    
    
    var resultc = ''

    if(errors.length != 0)
	{
        resultc += ' <ul>'
		for(var x in errors)
		{	
            resultc += ' <li style="color:#ff0000;"> ' + errors[x] + '</li> ';
           
        }
        resultc += ' </ul>'
        $('#errorMsgCont').html(resultc)
	}else{
        ajaxContact()
    }

/*	if(errors.length != 0)
	{
		for(var x in errors)
		{	
            result = ' <p style="color:#ff0000;"> ' + errors[x] + '</p> ';
           document.getElementsByClassName("coninstruction")[x].innerHTML = result;
        }
       
	}
    else
	{
        for(var y in goodArray)
		{	
            result = ' <p style="color:#fff;"> ' + goodArray[y] + '</p> ';
            document.getElementsByClassName("coninstruction")[y].innerHTML = result;
        }
        ajaxContact()
    }*/

    function ajaxContact(){
         
        $.ajax({
            url: "http://localhost:8080/php2/sajt1/models/user/contact.php",
            method: "post",
            dataType: "json",
            data : {
                        btncontact:"Send",
                        fnameC:fname.val(),
                        lnameC:lname.val(),
                        emailC:emailC.val(),
                        subjectC:subj.val(),
                        messageC:message.val()
            },
            success : function(data){
            
             alert(data.message);
            
            },
             error : function(xhr,status,Msgerror){
                   var poruka = "";
                   switch(xhr.status) {
                       case 404 :
                           poruka = "Page not found";
                           break;
                      case 422:
                          poruka = "Data are not validate.";
                           break;
                       case 500:
                           poruka = "Your data does not exist in the database";
                           break;
                   }
                   console.log(xhr.responseText);
             }
            
        })
  
      }


}