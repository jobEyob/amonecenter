<?php
session_start();

$GLOBALS['config']=array(
  'mysql'=>array(
    'host'=>'127.0.0.1',
    'username'=>'root',
    'password'=>'root',
    'db'=>'am_enterprise'

  ),
  'remember'=>array(
    'cookie_name'=>'hash',
    'cookie_expiry'=>604800
  ),
  'session'=>array(
    'session_name'=>'user',
    'token_name'=>'token'
  )
);
   //require_once 'classes/Config.php';

spl_autoload_register(function($class){
     //require_once 'classes/' .$class. '.php';
     require_once $_SERVER['DOCUMENT_ROOT']. '/amonecenter/classes/' . $class . '.php';
});
      //require_once 'functions/sanitize.php';
    require_once $_SERVER['DOCUMENT_ROOT']. '/amonecenter/functions/sanitize.php';



 ?>
