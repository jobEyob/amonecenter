<?php ob_start() //Turn on output buffering , help as use header(location: ) after html element  ?>
<?php require_once $_SERVER['DOCUMENT_ROOT']. '/amonecenter/core/init.php';   ?>
<!DOCTYPE html>
<html lang="en">
<head>
 <title>አርባምንጭ አንድ ማዕከል</title>
 <meta charset="utf-8">
 <meta name="viewport" content="width=device-width, initial-scale=1">
 <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.0/css/bootstrap.min.css">
 <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
 <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.0/umd/popper.min.js"></script>
 <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.1.0/js/bootstrap.min.js"></script>
 <!-- Font Awesome JS -->
 <script defer src="https://use.fontawesome.com/releases/v5.0.13/js/solid.js" integrity="sha384-tzzSw1/Vo+0N5UhStP3bvwWPq+uvzCMfrN1fEFe+xBmv1C/AtVX5K0uZtmcHitFZ" crossorigin="anonymous"></script>
 <script defer src="https://use.fontawesome.com/releases/v5.0.13/js/fontawesome.js" integrity="sha384-6OIrr52G08NpOFSZdxxz1xdNSndlD4vdcf/q2myIUVO0VsqaGHJsB0RaBE01VTOY" crossorigin="anonymous"></script>
 <!-- date picker -->
  <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
  <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
 <link rel="stylesheet" href=" /amonecenter/css/master_custom.css">
 <link rel="stylesheet" href=" /amonecenter/css/coustem-css.css">
 <link rel="stylesheet" href="/amonecenter/admin/page-admin/style_admin.css">
 <script src=" /amonecenter/js/costome_js.js"> </script>
</head>
<?php $user = new User();
if($user->isLoggendIn()){
    if($user->hasPermission()){
      $type = $user->Permission()->permisstion;
      if ($type == 'admin') {  ?>

        <div class="wrapper">
            <!-- Sidebar  -->
            <nav id="sidebar">
                <div class="sidebar-header">
                    <h4>One center Adminstrator</h4>
                    <strong>AM</strong>
                </div>

                <ul class="list-unstyled components">
                    <li class="active">
                        <a href="/amonecenter/admin/page-admin/index.php" >
                            <i class="fas fa-home"></i>
                            Dashboard
                        </a>

                    </li>
                    <li>

                        <a href="#pageSubmenu" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">
                            <i class="fas fa-copy"></i>
                            Enterprises
                        </a>
                        <ul class="collapse list-unstyled" id="pageSubmenu">
                            <li>
                                <a href="/amonecenter/admin/page-admin/enterprises_list.php">Enterprise list</a>
                            </li>

                        </ul>
                        <a href="/amonecenter/admin/page-admin/admin_users.php">
                            <i class="fas fa-briefcase"></i>
                            users
                        </a>
                    </li>

                </ul>


            </nav>

            <!-- Page Content  -->
            <div id="content">

                <nav class="navbar navbar-expand-lg  ">
                    <div class="container-fluid">

                        <button type="button" id="sidebarCollapse" class="btn btn-info">
                            <i class="fas fa-align-left"></i>
                            <span>Toggle Sidebar</span>
                            <!-- js file is in footer.php  -->
                        </button>
                        <button class="btn btn-dark d-inline-block d-lg-none ml-auto" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                            <i class="fas fa-align-justify"></i>
                        </button>

                        <div class="collapse navbar-collapse text-white" id="navbarSupportedContent">
                          <ul class="nav navbar-nav ml-auto">
                        <li class="nav-item dropdown">

                          <!-- <a class="nav-link dropdown-toggle" href="#" id="navbardrop" data-toggle="dropdown">
                              <strong><?php //echo escape($user->data()->username);  ?></strong>
                          </a> -->

                            <button class="btn btn-info dropdown-toggle dropdown-toggle-split rounded-circle " type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            <strong><?php echo escape($user->data()->username);  ?></strong>
                            <i class="fa fa-user-secret" ></i>
                            </button>
                                  <div class="dropdown-menu dropdown-menu-right ">
                                       <!-- <a class="dropdown-item" href="#">notifications</a> -->
                                       <div class="dropdown-divider"></div>
                                       <a class="dropdown-item" href="/amonecenter/pages/acountsting.php"><i class="fa fa-cogs" style="font-size:20px"></i> Account Settings </a>
                                       <div class="dropdown-divider"></div>
                                       <a class="dropdown-item" href="/amonecenter/pages/logout.php"><i class="fas fa-sign-out-alt"></i> Logout</a>
                                       <div class="dropdown-divider"></div>

                                   </div>
                                </li>

                              </ul>
                        </div>
                    </div>
                </nav>

               <!--  -->
            <!-- </div></div> this div movide admin page -->
        <!--navebare end container  -->   <!--hedare section end  -->
  <?php    }elseif ($type == 'monitor')  {  ?>
        <!--man navebare container  -->
        <nav class="navbar navbar-expand-sm bg-dark navbar-dark">
          <a class="navbar-brand" href="/amonecenter/admin/monitor/index.php"><i class="fas fa-home"></i>አንድ ማዕከል</a>
          <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#collapsibleNavbar">
            <span class="navbar-toggler-icon"></span>
          </button>
          <div class="collapse navbar-collapse" id="collapsibleNavbar">
            <ul class="navbar-nav">

              <li class="nav-item">
                <a class="nav-link" href="/amonecenter/admin/monitor/enterprises.php"><i class="fas fa-sign-out-alt"></i>Enterprse</a>
              </li>
            </ul>
            <ul class="nav navbar-nav ml-auto">
          <li class="nav-item dropdown">

            <!-- <a class="nav-link dropdown-toggle" href="#" id="navbardrop" data-toggle="dropdown">
                <strong><?php //echo escape($user->data()->username);  ?></strong>
            </a> -->

              <button class="btn btn-info dropdown-toggle dropdown-toggle-split rounded-circle " type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              <strong><?php echo escape($user->data()->username);  ?></strong>
              <i class="fa fa-user-secret" ></i>
              </button>
                    <div class="dropdown-menu dropdown-menu-right ">
                         <!-- <a class="dropdown-item" href="#">notifications</a> -->
                         <div class="dropdown-divider"></div>
                         <a class="dropdown-item" href="/amonecenter/pages/acountsting.php"><i class="fa fa-cogs" style="font-size:20px"></i> Account Settings </a>
                         <div class="dropdown-divider"></div>
                         <a class="dropdown-item" href="/amonecenter/pages/logout.php"><i class="fas fa-sign-out-alt"></i> Logout</a>
                         <div class="dropdown-divider"></div>

                     </div>
                  </li>

                </ul>
          </div>
        </nav>
        <!--navebare end container  -->   <!--hedare section end  -->
  <?php    }else  { ?>
        <!--man navebare container  -->
        <nav class="navbar navbar-expand-sm ">
          <a class="navbar-brand text-white " href="/amonecenter/index.php"><i class="fas fa-home"></i>አንድ ማዕከል</a>
          <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#collapsibleNavbar">
            <span class="navbar-toggler-icon"></span>
          </button>
          <div class="collapse navbar-collapse" id="collapsibleNavbar">
            <ul class="navbar-nav text-white ">
              <li class="nav-item">
                <a class="nav-link text-white" href="#">ቅጽ 001</a>
              </li>
              <li class="nav-item">
                <a class="nav-link text-white" href="#">ቅጽ 002</a>
              </li>
              <li class="nav-item">
                <a class="nav-link text-white" href="/amonecenter/pages/kits003.php">ቅጽ 003</a>
              </li>

            </ul>
            <ul class="nav navbar-nav ml-auto">
          <li class="nav-item dropdown">

            <!-- <a class="nav-link dropdown-toggle" href="#" id="navbardrop" data-toggle="dropdown">
                <strong><?php //echo escape($user->data()->username);  ?></strong>
            </a> -->

              <button class="btn btn-info dropdown-toggle dropdown-toggle-split rounded-circle " type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              <strong><?php echo escape($user->data()->username);  ?></strong>
              <i class="fa fa-user-secret" ></i>
              </button>
                    <div class="dropdown-menu dropdown-menu-right ">
                         <!-- <a class="dropdown-item" href="#">notifications</a> -->
                         <div class="dropdown-divider"></div>
                         <a class="dropdown-item" href="/amonecenter/pages/acountsting.php"><i class="fa fa-cogs" style="font-size:20px"></i> Account Settings </a>
                         <div class="dropdown-divider"></div>
                         <a class="dropdown-item" href="/amonecenter/pages/logout.php"><i class="fas fa-sign-out-alt"></i> Logout</a>
                         <div class="dropdown-divider"></div>

                     </div>
                  </li>

                </ul>

          </div>
        </nav>
        <!--navebare end container  -->   <!--hedare section end  -->

    <?php
   }
   }
 }
 ?>
