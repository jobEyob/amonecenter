
<?php include_once '../../master/header.php';  ?>
<?php
if(!$user->isLoggendIn()) {
  Redirect::to(' ../../page-login.php');
}else {
if($user->hasPermission()){
     $type = $user->Permission()->permisstion;

     if ($type == "monitor") {
       //echo "wow adminstroter";
       Redirect::to(404);
     }elseif ($type == "worker") {
       Redirect::to(404);
     }
}
}
 ?>
  <!--
 </div>
</div> -->
<?php
$db = DB::getInstance();

    $db->getAll('count(*)','Enterprises');
     $total_datas=$db->results();
   //  print_r($total_datas);
     foreach ($total_datas as $key => $value) {

       foreach ($value as $key => $value) {
         $numEnter=$value;
       }
     }

    ?>

<div class="container">

    <div class="row">
        <div class="col-12">
            <h1 class="page-header">Dashboard</h1>
        </div>
        <!-- /.col-lg-12 -->
    </div>
  <div class="form-row">
      <!-- Register Box -->
      <div class="col-6 ">
        <div class="card  text-white">
                  <div class="card-body bg-success ">
                      <div class="row">
                          <div class="col-3">
                              <i class="fa fa-user fa-5x"></i>
                          </div>
                          <div class="col-9 text-right" style="  font-size: 40px;" >
                              <div class="huge"><?php echo $numEnter; ?></div>
                              <div>Enterprises</div>
                          </div>
                      </div>
                  </div>
                  <a href="enterprises_list.php">
                      <div class="card-footer bg-info ">
                          <span class="pull-left">View Details</span>
                          <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                          <div class="clearfix"></div>
                      </div>
                  </a>
              </div>
              <br>
      </div>

       <div class="col">
       </div>

     </div>
   </div>
   <?php include_once '../../master/footer.php';  ?>
