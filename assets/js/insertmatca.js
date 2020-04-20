const BaseUrl = "http://localhost:8080/php2/sajt1/";
window.onload = function(){
 
    document.getElementById("btnInsMatch").addEventListener("click", mins);
    document.getElementById("btnUpMatch").addEventListener("click", mup);
   getSch()
   UpdateTeam();
   DeleteTeams()
 //  $("#btnInsMatch").click(mins)
 pagination()
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
          case 400:
               alert("Bad request!");     
      default:
          alert("Greska: " + status + " - " + statusTxt);
          break;
  }
}

function mins(){
    let team1 = document.getElementById("insTeam1")     
    let team1list = team1.options[team1.selectedIndex].value
    let team2 = document.getElementById("insTeam2")
    let team2list = team2.options[team2.selectedIndex].value
    let team1score = document.getElementById("insTeam1Sc")
  let team1sclist = team1score.options[team1score.selectedIndex].value
    let team2score = document.getElementById("insTeam2Sc")
    let team2sclist = team2score.options[team2score.selectedIndex].value
   let datem = document.getElementById("insDateMat")
   let timem = document.getElementById("insTimeMat")
    let errors = [];
    

    if(parseInt(team1list) == parseInt(team2list)){
       errors.push("Team 1 and Team 2 are equal")  
         team1.style.border = "1px solid #ff0000"
         team2.style.border = "1px solid #ff0000"
   }else{
        if(team1list == "0"){
                errors.push("Team 1 is not selected")  
                 team1.style.border = "1px solid #ff0000"
    
        }else{
                 team1.style.border = "1px solid #ced4da";

          }
          if(team2list == "0"){
                  errors.push("Team 2 is not selected")  
                  team2.style.border = "1px solid #ff0000"

          }else{
                  team2.style.border = "1px solid #ced4da";

          }  
    }



       if(team1sclist == "-1"){
        errors.push("Team 1 score is not selected")  
          team1score.style.border = "1px solid #ff0000"
     
      }else{
           team1score.style.border = "1px solid #ced4da";
 
       }
      if(team2sclist == "-1"){
         errors.push("Team 2 score is not selected")  
           team2score.style.border = "1px solid #ff0000"
      
       }else{
            team2score.style.border = "1px solid #ced4da";
  
        }

    if(datem.value == ""){
           datem.style.border = "1px solid #ff0000"
    } else{
        datem.style.border = "1px solid #ced4da";
    }
     
    if(timem.value == ""){
        timem.style.border = "1px solid #ff0000"
     } else{
       timem.style.border = "1px solid #ced4da";
      }
    

     if(errors.length > 0){
          alert(errors);
     }else{
         ajaxInsM()
     }

    function ajaxInsM() {

            $.ajax({
                url: BaseUrl + "models/admin/matches/insertMatch.php",
                method: "post",
                dataType: "json",
                data : {
                            btnInsMatch:"Send",
                            insTeam1:team1list,
                            insTeam2:team2list,
                            insTeam1Sc:team1sclist,
                            insTeam2Sc:team2sclist,
                            insDateMat:datem.value,
                            insTimeMat:timem.value
                },
                success : function(data){
                
                  alert(data.message);
                },
                 error : err
                
            })
      
          
    
    }


}


function mup(){
    let team1 = document.getElementById("upTeam1")     
    let team1list = team1.options[team1.selectedIndex].value
    let team2 = document.getElementById("upTeam2")
    let team2list = team2.options[team2.selectedIndex].value
    let team1score = document.getElementById("upTeam1Sc")
  let team1sclist = team1score.options[team1score.selectedIndex].value
    let team2score = document.getElementById("upTeam2Sc")
    let team2sclist = team2score.options[team2score.selectedIndex].value
   let datem = document.getElementById("upDateMat")
   let timem = document.getElementById("upTimeMat")
   let matchId = document.getElementById("idMatch")
    let errors = [];
    
     
  if(parseInt(team1list) == parseInt(team2list)){
          errors.push("Team 1 and Team 2 are equal")  
           team1.style.border = "1px solid #ff0000"
           team2.style.border = "1px solid #ff0000"
  }else{
     if(team1list == "0"){
            errors.push("Team 1 is not selected")  
            team1.style.border = "1px solid #ff0000"
            
       }else{
         team1.style.border = "1px solid #ced4da";
        
       }
     
       if(team2list == "0"){
        errors.push("Team 2 is not selected")  
        team2.style.border = "1px solid #ff0000"
        
       }else{
          team2.style.border = "1px solid #ced4da";
    
       } 
  }

  
     

    if(team1sclist == "-1"){
       errors.push("Team 1 is not selected")  
         team1score.style.border = "1px solid #ff0000"
    
     }else{
          team1score.style.border = "1px solid #ced4da";

      }
     if(team2sclist == "-1"){
        errors.push("Team 1 is not selected")  
          team2score.style.border = "1px solid #ff0000"
     
      }else{
           team2score.style.border = "1px solid #ced4da";
 
       }

    if(datem.value == ""){
           datem.style.border = "1px solid #ff0000"
    } else{
        datem.style.border = "1px solid #ced4da";
    }
     
    if(timem.value == ""){
        timem.style.border = "1px solid #ff0000"
     } else{
       timem.style.border = "1px solid #ced4da";
      }
    

     if(errors.length > 0){
          alert(errors);
     }else{
         ajaxUpM()
     }

    function ajaxUpM() {

            $.ajax({
                url: BaseUrl + "models/admin/matches/updateMatch.php",
                method: "post",
                dataType: "json",
                data : {
                             btnUpMatch:"Send",
                             upTeam1:team1list,
                             upTeam2:team2list,
                             upTeam1Sc:team1sclist,
                             upTeam2Sc:team2sclist,
                             upDateMat:datem.value,
                             upTimeMat:timem.value,
                             idMatch:matchId.value
                },
                success : function(data){
                
                  alert("Match is successfully modified");
                },
                 error : err
                
            })
      
          
    
    }
    
}







function getSch(){
   
   
    $.ajax({
        method: 'get',
        url: BaseUrl + "models/admin/matches/getMatches.php",
        dataType: 'json',
        success: function(data){
            readAll(data.matches)
        }, error: err
    })   
}


function readAll(data){
    let isp = "";
    let br = 0;
     for(let i of data){
       let datetime = new Date(i.date)
       let month = ["Jan" , "Feb" , "Mar" , "Apr" , "May" , "Jun" , "Jul" , "Aug" , "Sep" , "Okt" , "Nov" ,"Dec"]
        let newDate = datetime.getDate() + "-" + month[datetime.getMonth()] + "-" + datetime.getFullYear()
        let newTime = datetime.getHours() + ":" + datetime.getMinutes()
     isp += ` <tr>
        <td scope="row"> ${br + 1}  </td>
        <td> ${i.team1} </td>
        <td> ${i.result} </td>
        <td> ${i.team2} </td>
        <td> ${newDate} </td>
        <td> ${newTime} </td>
        <td> <a class="btn btn-primary updateTeamMat" data-id="${i.match_id}"  href="#">  Update </a> </td>
        <td> <a  class="btn btn-dark deleteTeamMat"  data-id="${i.match_id}" href="#"> Delete </a>  </td>
</tr>`
br++
     }
     $('#tableMatchesM').html(isp)
}



function UpdateTeam(){
    $('#tableMatchesM').on("click" ,"tr td .updateTeamMat", function(e){
        e.preventDefault();
        var id = $(this).data('id');
        // alert(id);
console.log(id)
        $.ajax({
            method: 'post',
            url: BaseUrl + "models/admin/matches/getUpMatch.php",
            dataType: 'json',
            data: {
                id : id
            },
            success: function(data,status,jqXHR){
                console.log(data)
                console.log(jqXHR.status)

                $('#upTeam1').val(data.team1_id);
                $('#upTeam2').val(data.team2_id);
                let score = data.result
                let scoreTm = score.split(":");
                let scTeam1 = scoreTm[0].trim()
                let scTeam2 = scoreTm[1].trim()
                $('#upTeam1Sc').val(scTeam1);
                $('#upTeam2Sc').val(scTeam2);
                 let datetime = data.date
                 let newDatetime = datetime.split(" ");
    
                $('#upDateMat').val(newDatetime[0]);
               $('#upTimeMat').val(newDatetime[1]);
             $('#idMatch').val(data.match_id);
               
            },
            error: err
        });
})
}


    function DeleteTeams(){

        $('#tableMatchesM').on("click" ,"tr td .deleteTeamMat", function(e){
            e.preventDefault();
            var id = $(this).data('id');
    console.log(id);
            $.ajax({
                method: 'post',
                url: BaseUrl + "models/admin/matches/deleteMatch.php",
                dataType: 'json',
                data: {
                    id : id
                },
                success: function(data){
                    alert("The match is successfully deleted");
                },
                error: err
            });
         })

    }


    function PagValue(){
        $('#pagMatchesAdm').on("click",".page-part-otr a" , function(e){
          e.preventDefault()          
        let numb = $(this).data("value");
      
        pag(numb)
      
        
        })
      }
     
    
    
      function pagination() { 
    
        let url = BaseUrl + "models/admin/matches/getMatches.php";
       
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
              
           $('#pagMatchesAdm').html(isp);
          
            $('#pagmerAdm').html("<h2>Matchday "+ countLink +"</h2>")
    
      }
      
    
      function pag(numb){
        let url = BaseUrl + "models/admin/matches/getMatches.php";
      
        $.ajax({ 
            url: url, 
            type: 'GET', 
            dataType: 'json', 
            data : { numb : numb},
           success:function(data){
                      let pager = data.matches
                      readAll(pager)
            },error: err
      
          })
       } 
      
    
    
