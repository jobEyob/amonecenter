<?php
require_once $_SERVER['DOCUMENT_ROOT']. '/amonecenter/core/init.php';

$user = new User();

$user->Logout();

Redirect::to('../index.php');
 ?>
