<?php include_once '../master/header.php';  ?>
<?php
// $db = DB::getInstance();
//
// $db->update('users', 'id', 6 , array(
//   'name'    =>'WILEL',
//   'email'   =>'mikls@gmail.com'
//  ));

 ?>
 <h1>R</h1>
 <?php
  if (Input::exists()) {
    $validate = new Validate();
    $validation = $validate->check($_POST, array(
      'name' => array(
        'required' => true,
        'min' => 2
      )
    ));
    if ($validate->passed()) {
      echo "sucsse";
    }else {
      print_r($validate->errors());
    }
  }
  ?>
<form action="" method="post">
  <br>
<label for="name">firstname </label>
<input name="name" value="<?php echo escape(Input::get('name')); ?>" type="text">
<input  type="submit" value="register">
</form>
