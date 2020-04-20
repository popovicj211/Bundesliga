<?php
define("BASE_URL","http://localhost:8080/php2/sajt1/");
define("ABSOLUTE_PATH", $_SERVER['DOCUMENT_ROOT']."/php2/sajt1");
define("ENV_FILE", BASE_URL."config/.env");
define("LOG_FILE", ABSOLUTE_PATH."/data/log.txt");
define("ERROR_FILE", ABSOLUTE_PATH."/data/errors.txt");

define("SERVER", env("SERVER"));
define("DATABASE", env("DBNAME"));
define("USERNAME", env("USERNAME"));
define("PASSWORD", env("PASSWORD"));

function env($name){
     
      $open = fopen(ENV_FILE, "r");
      $file = file(ENV_FILE);

      $val ="";
      foreach($file as $key=>$value){
            $conf = explode("=", $value);
             if($conf[0] == $name){
                   $val = trim($conf[1]);
             }
      }
       fclose($open);
      return $val;
}

