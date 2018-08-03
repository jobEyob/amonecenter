<?php
class Config{
  public static function get($path=null){ //by defalte path set null
    if($path){ //if path set
      $config=$GLOBALS['config']; //this put $GLOBALS['config'] value to $config from init.php

      $path= explode('/', $path); //explode tack charachter if you whant explode and = array back

      //print_r($path);  =  Array ( [0] => mysql [1] => host )   for  <?php Config::get('mysql/host');
      foreach ($path as $bit) {
        // echo $bit;   = mysqlhost
        if (isset($config[$bit])) {

          $config = $config[$bit];
        }
      }
      // print_r($config);
      return $config;
    }
    return false;
  }
}
 ?>
