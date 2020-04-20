const BaseUrl = "http://localhost:8080/php2/sajt1/";
window.onload = function(){
       

    document.getElementById("btncommnews").addEventListener("click", cins);


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
           case 400:
            alert("Bad request!");
         break;
          case 422:
              alert("Data are not validate!");
              console.log(statusTxt)
               break;
          case 400:
               alert("Bad request!");     
               default:
                alert("Error: " + status + " - " + statusTxt);
                break;
  }
}

function cins(){
    let commnews = document.getElementById("commnews")     
    let newsId = document.getElementById("newSId")
  let regCommnews = /^[A-ZČĆŽŠĐÜÖÄa-zčćžšđüöä\d\s\.\,\*\+\?\!\-\_\/\'\:\;\"\#\@\$\%\^]{5,}$/
let errors = "";
    

    if(!regCommnews.test(commnews.value)){
           commnews.style.border = "1px solid #ff0000"
           errors = "Comment is not valid!"
    } else{
        commnews.style.border = "1px solid #ced4da";
    }
      

     if(errors != ""){
          alert(errors);
     }else{
         ajaxInsC()
     }

    function ajaxInsC() {

            $.ajax({
                url: BaseUrl + "models/newscomm/insertNewsComm.php",
                method: "post",
                dataType: "json",
                data : {
                             btncommnews:"Send",
                             commnews:commnews.value ,
                            newSId:newsId.value,
                          
                },
                success : function(data){
                
                  alert(data.message);
                },
                 error : err
                
            })
      
          
    
    }


}