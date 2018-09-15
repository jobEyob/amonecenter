<?php
include_once ('../../master/header.php');
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

<div class="container-fluid">
 <?php
 if (Session::exists('update')) {
   echo '<div class="alert alert-success alert-dismissable">
     <a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>
       '.Session::flash('update').'
     </div>';
 }
 if (Session::exists('delete')) {
   echo '<div class="alert alert-danger alert-dismissable">
     <a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>
       '.Session::flash('delete').'
     </div>';
 }

  ?>
<div class="row">

  <div class="col-12" style="margin:50px 0px 0px 0px;" >
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
<th>---Action---</th>

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
      <a href="" id="getEdit" class="btn btn-success btn-sm " data-toggle="modal" data-target="#myModal" data-id="'.$data->ent_id.'" ><i class="fa fa-edit" style="font-size:10px"></i>edit</a>

      <a href="teble.php?delete='.$data->ent_id.'"  class="btn btn-danger delete_btn " onclick="return confirm(\' Are You Sure you want to Delete ?\')" style="margin-right: 4px;"><i class="fa fa-trash" style="font-size:10px"></i></a>

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
</div>


<!--create modal dialog for display detail info for edit on button cell click-->
   <div class="modal fade" id="myModal" role="dialog">
       <div class="modal-dialog">
           <div id="content-data"></div>

       </div>
   </div>

</div>
</div>

<script type="text/javascript">

$(document).ready( function () {

    $('#example').DataTable();

    } );
</script>

<script>
    $(document).on('click','#getEdit',function(e){
        e.preventDefault();
        var per_id=$(this).data('id');
        //alert(per_id);
        $('#content-data').html('');
        $.ajax({
            url:'edit_enterprise.php',
            type:'POST',
            data:'id='+per_id,
            dataType:'html'
        }).done(function(data){
            $('#content-data').html('');
            $('#content-data').html(data);
        }).fial(function(){
            $('#content-data').html('<p>Error</p>');
        });
    });
</script>

<?php
$db = DB::getInstance();
//for update
if(isset($_POST['btnEdit'])){

  $edit_id = Input::get('entid');

  $result_update = $db->update('Enterprises', 'id', $edit_id ,array(

    'entname' =>Input::get('entname'),
    'ent_growth_level' =>Input::get('Glevel'),
    'ent_mesk' =>Input::get('workarea')

   ));

    if($result_update){
        echo '<script>window.location.href="enterprises_list.php"</script>';
        Session::flash('update', 'Enterprises data updated Successfull');
    }
    else{
        echo '<script>alert("Update Failed")</script>';
    }
}

//for delete
if(isset($_GET['delete'])){
    $del_id=$_GET['delete'];
   $result_delete = $db->delete('Enterprises', array('id', '=', ''.$del_id.''));

    if($result_delete){
        echo'<script>window.location.href="enterprises_list.php"</script>';
        Session::flash('delete', "Enterprise deleted successfully!");
    }
    else{
        echo'<script>alert("Delete Failed")</script>';
    }

}

 ?>
<br><br>
<?php include '../../master/footer.php'; ?>
