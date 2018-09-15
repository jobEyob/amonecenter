<?php include_once '../../master/header.php';  ?>
<?php
if(!$user->isLoggendIn()) {
  Redirect::to(' ../../page-login.php');
}else {
if($user->hasPermission()){
     $type = $user->Permission()->permisstion;

     if ($type == "admin") {
       //echo "wow adminstroter";
       Redirect::to(404);
     }elseif ($type == "worker") {
       Redirect::to(404);
     }
}
}
 ?>
 <!-- datatable lib -->
     <link rel="stylesheet" href="https://cdn.datatables.net/1.10.19/css/jquery.dataTables.min.css">
     <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
     <script src="https://cdn.datatables.net/1.10.19/js/jquery.dataTables.min.js"></script>
     <!-- <script type="text/javascript" charset="utf8" src="http://ajax.aspnetcdn.com/ajax/jQuery/jquery-1.8.2.min.j"> </script> -->
<style>
input[type="search" i] {
    padding: 1px;
    background: #b5c5ccba;
    border-radius: 8px 4px 4px 8px;
    box-shadow: 0 0 8px 2px #47826c;
}
 </style>
<div class="container">
<div class="row">
  <div class="col"> </div>
  <div class="col-11" style="margin:50px 0px 0px 0px;" >
    <?php
    if (Session::exists('update')) {
      echo '<div class="alert alert-success alert-dismissable">
        <a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>
          '.Session::flash('update').'
        </div>';
    }   ?>

<form id="enterprises_list_form" method="post" action="">
        <div class="request_replay_controller  ">
          <button type="submit" name="reject" id="reject" class="btn btn-danger ">Reject</button>
          <button type="submit" name="accept"  id="accept" class="btn btn-success">Accept</button>
        </div>
        <br> <br>

<table id="example" class="display table table-striped " width="100%" cellspacing="0">
<thead class="table-light">
<tr>
<th>view</th>
<th>#</th>
<th>ስም</th>
<th>የተመ ዘመን</th>
<th>የተሰማራበት ዘርፍ</th>
<th>የሥራ መስክ</th>
<th>አደረጃጀት ዓይነት </th>
<th> የግብር ቁጥር</th>
<th>የዕድገት ደረጃ</th>
<th>መነሻየ ሃብት መጠን</th>
<th>Select</th>

</tr>
</thead>
<tbody>
  <?php $db = DB::getInstance();
      //$db->get('Enterprises', array('id', '=', '31'));
    //$db->getAll('*', 'Enterprises');
    $db->joinget('', '');
      if ($db->count()) {
        $datas = $db->results();
        foreach ($datas as $data) {
          echo '
          <tr>
            <td>
    <a href="" id="getEdit" class="btn btn-link" data-toggle="modal" data-target="#myModal" data-id="'.$data->ent_id.'" ><i class="fa fa-arrow-circle-right" style="font-size:10px"></i>detail</a>
            </td>

            <td>'.$data->ent_id.'</td>
            <td>'.$data->entname.'</td>
            <td>'.$data->ent_found_year.'</td>
            <td>'.$data->zerif_name.'</td>
            <td>'.$data->ent_mesk.'</td>
            <td>'.$data->org_type_name.'</td>
            <td>'.$data->ent_tin.'</td>
            <td>'.$data->ent_growth_level.'</td>
            <td>'.$data->insal_capetal.'</td>
            <td>
            <input type="checkbox" name="select_checkbox[]" class="selectedID"  value="'.$data->ent_id.'"/>
            <i class="fa fa-check-square" style="font-size:20px;color:"></i>
            </td>

          </tr>
          ';
        }
      }
    ?>
</tbody>
 <tfoot>
   <tr>
     <th>  </th>
   </tr>
 </tfoot>
</table>

</form>

</div>
  <div class="col"> </div>
</div>
</div>

<script type="text/javascript">

$(document).ready( function () {

    $('#example').DataTable();

    } );
</script>

<?php
 if(isset($_POST['select_checkbox'])){   // if checkbox is checked do this
          if(isset($_POST['reject'])){
          //print_r($_POST);
          foreach ($_POST['select_checkbox'] as $key => $id_value) {
            $result_update = $db->update('Enterprises', 'id', $id_value ,array(
              'status' =>"deactivate"
             ));

              if($result_update){
                  echo '<script>window.location.href="enterprises.php"</script>';
                  Session::flash('update', 'Enterprises data Deaccepted Successfull');
              }
              else{
                  echo '<script>alert("Update Failed")</script>';
              }
          }
          }elseif(isset($_POST['accept'])){
            foreach ($_POST['select_checkbox'] as $key => $id_value) {
              $result_update = $db->update('Enterprises', 'id', $id_value ,array(
                'status' =>"deactivate"
               ));
                if($result_update){
                    echo '<script>window.location.href="enterprises.php"</script>';
                    Session::flash('update', 'Enterprises Data Accepted Successfull');
                }
                else{
                    echo '<script>alert("Update Failed")</script>';
                }
            }
          }
      }elseif(isset($_POST['reject']) || isset($_POST['accept']) ) {   // if not chechbox checked but accept or reject cliked
        echo '<script>alert("please Select checkbox !!! ")</script>';
      }
  ?>

<br><br>

<?php include_once '../../master/footer.php';  ?>
