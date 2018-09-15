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


<?php
$nameError ="";
$fullnameError = "";
$emailError ="";
$passwordError="";
$password_confirmError="";

  $in= new Input();

if(Token::check($in::get('token'))){ /*this tack token from input send to check method in Token class*/
    if ($in::exists()) {
       $validate = new Validate();
       $validation = $validate->check($_POST, array(
           /* $item */ 'fullname' => array(
               'required' => true,
               'min' => 2,
             ),
           /* $item */ 'username' => array(
               'required' => true,
               'min' => 2,
               'max' => 20,
               'unique' => 'users'
           ),
           /* $item */ 'email' => array(
               'required' => true
           ),
           'password' => array(
               'required' => true,
               'min' => 6
           ),
           'confirm_password' => array(
               'required' => true,
               'matches' => 'password'
           )
       ));
       if ($validation->passed()) {
           $user=new User();

       $salt = Hash::salt(32);

           try {
               $user->create('users', array(

                  'name' => Input::get('fullname'),
                  'username'=> Input::get('username'),
                  'email'=> Input::get('email'),
                  'password'=> Hash::make(Input::get('password'), $salt),
                  'salt'=>$salt,
                  // 'reg_date'=> date("Y-m-d"),
                  // 'reg_time'=> date("h:i:s"),
                  'group_id'=>Input::get('usertype')

               ));

                Session::flash('create', 'User acount crated Successfull');

                  // header("location: login.php");
                     Redirect::to('admin_users.php');

                   ob_end_flush();// this is opstional is for Turn of output buffering we Turn on biging of header.php

           } catch (Exception $exc) {
               die ($exc->getMessage());
           }


       } else {
           foreach ($validation->errors() as $x=>$x_value) {

               switch ($x){
                   case 'fullname':
                       $fullnameError=$x_value;
                       break;
                   case 'username':
                       $nameError=$x_value;
                       break;
                   case 'email':
                       $emailError=$x_value;
                       break;
                   case 'password':
                       $passwordError=$x_value;
                       break;
                   case 'confirm_password':
                       $password_confirmError=$x_value;
                       break;
                   default :
                       break;

               }

           }
          /*print_r($validation->errors()[0]);
           $nameError=$validation->errors()[0];
           //print_r($usename_error);
           $emailError=$validation->errors()[1];
           $passwordError=$validation->errors()[2];
           $password_confirmError=$validation->errors()[3]; */
       }
   }
}


   ?>


   <div class="container">
     <div class="row">
 		<div class="col-12">
 			<h2 class="page-header">Add User</h2>
      <hr>
 		</div>
 	</div>
     <div class="row">
         <!-- Register Box -->
         <div class="col-3 ">

         </div>
          <div class="col-8 card">
               <form class="form-horizontal card-body" action="" method='post'>
                   <div class=" ">
                     <p class="text-info" >create a new employee account</p>
                     <hr>
                   </div>

                   <div class="form-group row">
                     <label for="fullname" class="col-sm-2 col-form-label">Full name</label>

                     <div class="col-sm-6">
                       <input type="text" class="form-control" name="fullname" id="fullname" placeholder="Employee full name" value="<?php echo escape($in::get('fullname')); ?>" >
                     </div>
                     <span class=" col-sm-2 error">* <?php echo $fullnameError;?></span>
                   </div>
                   <!-- ...email..... -->
                   <div class="form-group row">
                       <label class="col-sm-2 col-form-label" for="email">E-Mail</label>

                        <div class="col-sm-6">

                         <input name="email" id="email" placeholder="E-Mail Address" class="form-control "
                                      type="text" value="<?php echo escape($in::get('email')); ?>" >
                        </div>
                        <span class=" col-sm-2 error">* <?php echo $emailError;?></span>
                    </div>

                   <div class="form-group row">
                       <label class="col-sm-2 col-form-label" for="uname">username</label>

                       <div class="col-sm-6">

                <input name="username" type="text" class="form-control "  id="uname" placeholder="Enter user name" value="<?php echo escape($in::get('username')); ?>" >
                       </div>
                       <span class=" col-sm-2 error">* <?php echo $nameError;?></span>

                     </div>



                      <div class="form-group row">
                       <label class="col-sm-2 col-form-label" for="password">Password:</label>

                        <div class="col-sm-6">

                        <input name="password" type="password" class="form-control" id="password" placeholder="Enter password">
                        </div>
                        <span class=" col-sm-2 error">* <?php echo $passwordError;?></span>
                      </div>


                      <div class="form-group row">
                       <label class="col-sm-2 col-form-label" for="cpwd">confirm Password:</label>

                       <div class="col-sm-6">


                           <input name="confirm_password" type="password" class="form-control" id="cpwd" placeholder="Enter password again">
                       </div>
                        <span class=" col-sm-2 error">* <?php echo $password_confirmError;?></span>
                      </div>
                      <div class="form-group row">
                        <label for="usertype" class="col-sm-2 col-form-label">User type </label>
                        <div class="col-sm-6">
                          <select class="custom-select mr-sm-2" id="usertype" name="usertype" >
                            <option >  ምረጥ....</option>
                            <option value="1">worker</option>
                            <option value="3">monitor</option>

                          </select>
                        </div>
                        <div class="col-sm-2"> </div>
                      </div>


                   <hr>
                       <div class="row">
                        <div class="col-lg-8">
                       <input type="hidden" name="token" value="<?php echo Token::generate()?>" >
                       <input class="btn btn-primary" type="submit" value="Save">
                           </div>

                   </div>
               </form>
           </div>
           <div class="col">
           </div>
       </div>
       <br>
   </div>

<?php include_once '../../master/footer.php';  ?>
