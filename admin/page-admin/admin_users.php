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
 <div class="container">
   <div class="row">
     <div class="col-lg-6">
            <h1 class="page-header">Admin users</h1>
        </div>
        <div class="col-lg-6" style="">
            <div class="page-action-links text-right">
            <a href="create_user.php"> <button class="btn btn-success">Add new</button></a>
            </div>
        </div>
</div>
 <?php
  if (Session::exists('delete')) {
    echo '<div class="alert alert-danger alert-dismissable">
   		<a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>
    		'.Session::flash('delete').'
  	  </div>';
  }
  if (Session::exists('create')) {
    echo '<div class="alert alert-success alert-dismissable">
   		<a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>
    		'.Session::flash('create').'
  	  </div>';
  }
  if (Session::exists('update')) {
    echo '<div class="alert alert-success alert-dismissable">
   		<a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>
    		'.Session::flash('update').'
  	  </div>';
  }
  ?>
<hr>
    <table class="table table-striped table-bordered table-condensed">
        <thead>
            <tr>
                <th class="header">#</th>
                <th>Name</th>
                <th>username</th>
                <th>Admin type</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>

            <?php $db = DB::getInstance();
             $db->getAll('*', 'users');
               if ($db->count()) {
                 $datas = $db->results();
                 foreach ($datas as  $data) {
                     $role ="";
                     $type = $data->group_id;
                   switch ($type) {
                     case '1':
                       $role ="Branch worker ";
                       break;
                     case '2':
                       $role = "Administrator";
                       break;
                     case '3':
                       $role = "monitor";
                       break;

                     default:
                       // code...
                       break;
                   }
                  // echo $type;
                   if($type != 2){   // Administrator Not delete hemselfi in this section
                  //echo $type;
                  echo '
                  <tr>
                      <td>'.$data->id.'</td>
                      <td> '.$data->name.' </td>
                      <td> '.$data->username.' </td>
                      <td> '.$role.' </td>


                      <td>
                          <a href="edit_user.php?users_id= '.$data->id.'&usertype='.$role.'" class="btn btn-success"><i class="fa fa-edit" style="font-size:20px"></i>Edit</a>

                          <a href=""  class="btn btn-danger delete_btn" data-toggle="modal" data-target="#confirm-delete-'.$data->id.'" style="margin-right: 8px;"><i class="fa fa-trash" style="font-size:20px"></i>Delete</a>

                      </td>
                  </tr>

                 <div class="modal fade" id="confirm-delete-'.$data->id.'" role="dialog">
                    <div class="modal-dialog">
                      <form action=" " method="POST">
                      <!-- Modal content-->
                          <div class="modal-content">
                            <div class="modal-header">
                              <button type="button" class="close" data-dismiss="modal">&times;</button>
                              <h4 class="modal-title">close</h4>
                            </div>
                            <div class="modal-body">
                                <input type="hidden" name="del_id" id = "del_id" value="'.$data->id.'">
                                <h4 class="text-danger" >Are you sure you want to delete this user?</h4>

                            </div>
                            <div class="modal-footer">

                                <button type="submit" class="btn btn-danger float-left" >Yes</button>
                                <button type="button" class="btn btn-success" data-dismiss="modal">No</button>

                            </div>
                          </div>
                      </form>

                    </div>
                </div>
                     ';
                   }else {
                     echo '
                     <tr>
                         <td>'.$data->id.'</td>
                         <td> '.$data->name.' </td>
                         <td> '.$data->username.' </td>
                         <td> '.$role.' </td>


                         <td>
                        <a href="edit_user.php?users_id= '.$data->id.'&usertype='.$role.'" class="btn btn-success"><i class="fa fa-edit" style="font-size:20px"></i>Edit</a>
                         </td>
                     </tr>
                     ';
                   }
                 }
               }
              ?>



        </tbody>
    </table>
  </div>

  <?php    //Delete a user using user_id
  $del_id = Input::get('del_id');
   //echo "id".$del_id;
   //$db = DB::getInstance();
  if (Input::exists()) {
    //$deleted =
    $db->delete('users', array('id', '=', ''.$del_id.''));

   //if($deleted){
      Session::flash('delete', "User deleted successfully!");

       header("Refresh:0");
//  }
}
?>
 <?php include_once '../../master/footer.php';  ?>
