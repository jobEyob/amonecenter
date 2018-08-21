<?php
// include($_SERVER['DOCUMENT_ROOT'] . 'master/header.php');
include_once ('master/header.php');
?>
<?php
 $user = new User();
 if(!$user->isLoggendIn()) {
   Redirect::to(' page-login.php');
}else {
  if($user->hasPermission()){
     $type = $user->Permission()->permisstion;

     if ($type == "admin") {
       //echo "wow adminstroter";
       Redirect::to('admin/page-admin/create.php');
     }elseif ($type == "monitor") {
       Redirect::to('admin/monitor/index.php');
     }else {
       echo "you are stardared user";
     }
  }
}
  ?>
<!--  -->
<body>
  <div class="container ">
    <div class="jumbotron">


      <div class="row">
        <div class="col-sm-4">

        </div>
        <div class="col-sm-6">
          <h3>ተመዝገብው የሚገኙ ኢንተርፕራይዞች </h3>

          <form class="form-inline" action="/action_page.php">
            <input class="form-control mr-sm-2" type="text" placeholder="Search..">
            <button class="btn btn-success" type="submit">Search</button>
          </form>
        </div>
        <div class="col-sm-2">

        </div>

      </div>
     </div>
    </div>
  <?php
     //$user = DB::getInstance()->query("SELECT * FROM users WHERE username = ?", array('job'));

     //$user = DB::getInstance();
    //  $user->get('users', array('username', '=', 'job'));
    //
    // if(!$user->count()){
    //   echo "no user";
    // }else {
    //  // print_r($user->results());
    // // echo "<br>";
    // // $data=$user->results()[0]->username;
    // // echo $data;
    // //  echo $user->first()->password;
    // // foreach ($data as $value) {
    // // echo  $value->name;
    // // echo "<br>";
    // // echo "email= ".$value->email;
    // // }
    // }
    // $db = DB::getInstance();
    //
    // $db->update('users', 'id', 6 , array(
    //   'name'    =>'TILEL',
    //   'email'   =>'mikls@gmail.com'
    //  ));

   ?>

  <div class="container bg-secondary text-white text-center ">
  <h3>ምን ምን ሰራን</h3><br>
  <div class="row">
    <div class="col-sm-4">
      <img src="https://placehold.it/150x80?text=IMAGE" class="img-responsive" style="width:100%" alt="Image">
      <p>Current Project</p>
    </div>
    <div class="col-sm-4">
      <img src="https://placehold.it/150x80?text=IMAGE" class="img-responsive" style="width:100%" alt="Image">
      <p>Project 2</p>
    </div>
    <div class="col-sm-4">
      <div class="well">
       <p>Some text..</p>
      </div>
      <div class="well">
       <p>Some text..</p>
      </div>
    </div>
  </div>
  </div><br>
</body>

<?php include 'master/footer.php'; ?>
