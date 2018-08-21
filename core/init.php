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

    /**********************************************************
     * this for if user chack remember me on last login time
     *  Created on : Mar 26, 2018, 8:50:28 AM
     *   Author    : job
     **********************************************************/

    if (Cookie::exists(Config::get('remember/cookie_name')) && !Session::exists(Config::get('session/session_name'))) {
         //die('user asked to remembered');
        $hash = Cookie::get(Config::get('remember/cookie_name'));
        // die($hash);

           $hashChack = DB::getInstance();
           $hashChack->get('users_session', array('hash', '=', $hash));

        if ($hashChack->count()) {
            // die('hash machs, login user');

            $user = new User($hashChack->first()->user_id);  //$hashChack->first()->user_id this return user_id form users_session tabel
            $user->login();

        }
    }


 ?>
