<?php require_once $_SERVER['DOCUMENT_ROOT']. '/amonecenter/core/init.php';   ?>
<?php
$incoract="";
$nameError ="";
$passwordError="";

if(Token::check(Input::get('token'))){
    if(Input::exists()){

        $validate= new Validate();
        $validation=$validate->check($_POST, array(
            'username'=>array(
                'required' => true
                ),

            'password' => array(
                'required' => true,
                 )


        ));
    }
    if ($validation->passed()) {
      $user = new User();
      $remember = (Input::get('remember') === 'on') ? true : false;
      $login = $user->login(Input::get('username'), Input::get('password'), $remember);
      if ($login) {
        //echo "succes";
        //Redirect::to('index.php');
        if($user->hasPermission()){
           $type = $user->Permission()->permisstion;

           if ($type == "admin") {
             //echo "wow adminstroter";
           Redirect::to('admin/page-admin/index.php');
           }elseif ($type == "monitor") {
             Redirect::to('admin/monitor/index.php');
           }else {
            Redirect::to('index.php');
           }
        }

      }else {
        $incoract = "<p> sory. login falid</p>";
      }
    }else {
      foreach ($validation->errors() as $x=>$x_value) {

                switch ($x){
                    case 'username':
                        $nameError=$x_value;
                        break;

                    case 'password':
                        $passwordError=$x_value;
                        break;

                    default :
                        break;

                }

            }
    }
  }
    ?>
<div class="wrap">
 <div class="card">

       <div class="card-header bg-light"> <p class="form-title">አርባምንጭ አንድ ማዕከል</p> </div>
   <div class="card-body login-box">
           <span class="error"> <?php echo $incoract;?></span>
       <form class="login" action="" method="post">

       <span class="error"> <?php echo $nameError;?></span>
       <input type="text" class="form-control" name="username" placeholder="Username" autocomplete="off" />
       <span class="error"> <?php echo $passwordError;?></span>
       <input type="password" class="form-control" name="password" placeholder="Password" />

      <input type="hidden" name="token" value="<?php echo Token::generate()?>" >
     <input type="submit" value="Sign In" class="btn btn-success btn-sm" />

       <div class="remember-forgot">
           <div class="row">
               <div class="col-md-6">
                   <div class="checkbox">
                       <label class="text-info" >
                           <input type="checkbox" name="remember"  />
                           Remember Me
                       </label>
                   </div>
               </div>
               <div class="col-md-6 forgot-pass-content">


     <a href="javascript:void(0)" class="forgot-pass text-info ">Forgot Password</a>

               </div>
           </div>
       </div>
       </form>
   </div>
 </div>
</div>
   <!-- this code is for forgot password  -->
   <div class="pr-wrap">
       <div class="pass-reset">
           <label>
               Enter the email you signed up with ***</label>
           <input type="email" placeholder="Email" />
           <input type="submit" value="Submit" class="pass-reset-submit btn btn-success btn-sm" />
       </div>
   </div>
