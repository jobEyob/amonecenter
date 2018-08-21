<?php include_once '../../master/header.php';  ?>



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
                  'groups'=>1

               ));

                Session::flash('success', 'acount crated Successfull');

                  // header("location: login.php");
                     Redirect::to('index.php');

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
    <!-- === END HEADER === -->
                       <!-- === BEGIN CONTENT === -->
                       <br>
     <div class="form-row">
         <!-- Register Box -->
         <div class="col ">

         </div>
          <div class="col-8">
               <form class="form-horizontal signup-page" action="" method='post'>
                   <div class="signup-header">
                                       <p>create a new employee account</p>

                                   </div>

                   <div class="form-row">
                     <label for="fullname" class="col-sm-3 col-form-label">Full name</label>
                       <span class="error">* <?php echo $fullnameError;?></span>
                     <div class="col-sm-9">
                       <input type="text" class="form-control" name="fullname" id="fullname" placeholder="Employee full name" value="<?php echo escape($in::get('fullname')); ?>" >
                     </div>
                   </div>
                   <!-- ...email..... -->
                   <div class="form-group">
                       <label  for="email">E-Mail</label>
                       <span class="error">* <?php echo $emailError;?></span>
                       <div  >
                           <div class="input-group">
                               <span class="input-group-addon"><i class="glyphicon glyphicon-envelope"></i></span>
                               <input name="email" id="email" placeholder="E-Mail Address" class="form-control margin-bottom-20"
                                      type="text" value="<?php echo escape($in::get('email')); ?>" >

                           </div>
                       </div>
                   </div>
                   <div class="form-group">
                       <label  for="uname">username:</label>
                      <span class="error">* <?php echo $nameError;?></span>
                       <div  >
                           <div class="input-group">
                               <span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
                <input name="username" type="text" class="form-control margin-bottom-20"  id="uname" placeholder="Enter user name" value="<?php echo escape($in::get('username')); ?>" >
                           </div>
                       </div>
                   </div>


                      <div class="form-group">
                       <label  for="password">Password:</label>
                       <span class="error">* <?php echo $passwordError;?></span>
                       <div >
                           <div class="input-group">
                            <span class="input-group-addon"><i class="glyphicon glyphicon glyphicon-lock"></i></span>
                            <input name="password" type="password" class="form-control" id="password" placeholder="Enter password">

                           </div>
                   </div>
                   </div>

                      <div class="form-group">
                       <label  for="cpwd">confirm Password:</label>
                       <span class="error">* <?php echo $password_confirmError;?></span>
                       <div  >
                           <div class="input-group">
                           <span class="input-group-addon"><i class="glyphicon glyphicon glyphicon-lock"></i></span>
                           <input name="confirm_password" type="password" class="form-control" id="cpwd" placeholder="Enter password again">
                       </div>
                       </div>
                   </div>


                   <hr>
                       <div class="row">
                        <div class="col-lg-8">
                       <input type="hidden" name="token" value="<?php echo Token::generate()?>" >
                       <input class="btn btn-primary" type="submit" value="Register">
                           </div>

                   </div>
               </form>
           </div>
           <div class="col">
           </div>
       </div>
       <br>
   </div>

<?php include_once '../master/footer.php';  ?>
