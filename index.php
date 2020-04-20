<?php 
 //ob_start();  Ovu funkciju sam koristio za uključivanje izlaznog baferovanja zbog sesije
   session_start();
    require_once 'config/connection.php';
 


    $page = "";
if (isset($_GET['page'])) {
    $page = $_GET['page'];
}
	include 'views/fixed/head.php';
    include 'views/fixed/logo.php';
    include 'views/fixed/header.php';
  if (($page == "index") || (!$page)) {
    include "views/sliders/homeslider.php";
  } else {
    include "views/sliders/otherslider.php";
   }

   switch ($page) {

    case "index":
        include "views/contain/contain.php";
        break;
 case "news":
        include "views/contain/news.php";
        break; 
 case "newsdetails":
        include "views/contain/newsdetails.php";
        break; 
  case "matches":
        include "views/contain/matches.php";
        break; 
   case "contact":
        include "views/contain/contact.php";
        break; 
   case "schedule":
        include "views/contain/schedule.php";
        break; 
   case "usersadmin":
        include "views/contain/admin/users.php";
        break; 
    case "teamsadmin":
        include "views/contain/admin/teams.php";
        break; 
    case "matchesadmin":
        include "views/contain/admin/matches.php";
        break; 
    case "newsadmin":
        include "views/contain/admin/news.php";
        break; 
    case "log":
        include "views/contain/admin/log.php";
        break;     
   case "about":
        include "views/contain/about.php";
        break;            
      default:
        include "views/contain/contain.php";
        break;
}

    include 'views/fixed/footer.php';
