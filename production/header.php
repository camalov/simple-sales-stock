<?php 
ob_start();
session_start();
include 'dbnet/connection.php';
include 'input-security/standart-input-security.php';

$user_info_query = $db->prepare("SELECT * FROM user WHERE user_name = :name ");
$user_info_query->execute(array( 'name' => $_SESSION['user'] ));
$user_info_result = $user_info_query->fetch(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
  <!-- Meta, title, CSS, favicons, etc. -->
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <title>İnzibatçı bölməsi | </title>

  <!-- FontAwesome -->
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">

  <!-- Bootstrap -->
  <link href="../vendors/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
  <!-- Font Awesome -->
  <link href="../vendors/font-awesome/css/font-awesome.min.css" rel="stylesheet">
  <!-- NProgress -->
  <link href="../vendors/nprogress/nprogress.css" rel="stylesheet">
  <!-- iCheck -->
  <link href="../vendors/iCheck/skins/flat/green.css" rel="stylesheet">
  <!-- bootstrap-wysiwyg -->
  <link href="../vendors/google-code-prettify/bin/prettify.min.css" rel="stylesheet">
  <!-- Select2 -->
  <link href="../vendors/select2/dist/css/select2.min.css" rel="stylesheet">
  <!-- Switchery -->
  <link href="../vendors/switchery/dist/switchery.min.css" rel="stylesheet">
  <!-- starrr -->
  <link href="../vendors/starrr/dist/starrr.css" rel="stylesheet">
  <!-- bootstrap-daterangepicker -->
  <link href="../vendors/bootstrap-daterangepicker/daterangepicker.css" rel="stylesheet">
  <!-- Custom Theme Style -->
  <link href="../build/css/custom.min.css" rel="stylesheet">
  <!-- Animate.css -->
  <link href="../vendors/animate.css/animate.min.css" rel="stylesheet">
  <!-- PNotify -->
  <link href="../vendors/pnotify/dist/pnotify.css" rel="stylesheet">
  <link href="../vendors/pnotify/dist/pnotify.buttons.css" rel="stylesheet">
  <link href="../vendors/pnotify/dist/pnotify.nonblock.css" rel="stylesheet">

  <!-- Datatables -->
  <link href="../vendors/datatables.net-bs/css/dataTables.bootstrap.min.css" rel="stylesheet">
  <link href="../vendors/datatables.net-buttons-bs/css/buttons.bootstrap.min.css" rel="stylesheet">
  <link href="../vendors/datatables.net-fixedheader-bs/css/fixedHeader.bootstrap.min.css" rel="stylesheet">
  <link href="../vendors/datatables.net-responsive-bs/css/responsive.bootstrap.min.css" rel="stylesheet">
  <link href="../vendors/datatables.net-scroller-bs/css/scroller.bootstrap.min.css" rel="stylesheet">


</head>

<body class="nav-md">
  <div class="container body">
    <div class="main_container">
      <div class="col-md-3 left_col">
        <div class="left_col scroll-view">


          <div class="clearfix"></div>

          <!-- menu profile quick info -->
          <div class="profile clearfix">
            <div class="profile_pic">
              <img src="<?php if(strlen($user_info_result['user_photo_url']) == '0' ){ if($user_info_result['user_gender'] == '1'){ $user_img = "jpeg/user_profile_photo/admin-male.png"; echo $user_img; }else if($user_info_result['user_gender'] == '0'){ $user_img = "jpeg/user_profile_photo/admin-female.png"; echo $user_img; }else{ $user_img = "jpeg/user_profile_photo/admin-male.png"; echo $user_img; } }else{ $user_img = $user_info_result['user_photo_url']; echo $user_img; } ?>" class="img-circle profile_img">
            </div>
            <div class="profile_info">
              <span>Xoş gəlmisiniz,</span>
              <h2><?php echo $user_info_result['user_namelastname']; ?></h2>
            </div>
            <div class="clearfix"></div>
          </div>
          <!-- /menu profile quick info -->
          <br />

          <!-- sidebar -->
          <?php include 'sidebar.php'; ?>
          <!-- /sidebar -->

          <!-- /menu footer buttons -->
          <div class="sidebar-footer hidden-small">
            <a data-toggle="tooltip" href="logout.php" data-placement="top" title="Çıxış">
              <span class="glyphicon glyphicon-off" aria-hidden="true"></span>
            </a>
          </div>
          <!-- /menu footer buttons -->
        </div>
      </div>

      <!-- top navigation -->
      <div class="top_nav">
        <div class="nav_menu">
          <nav>
            <div class="nav toggle">
              <a id="menu_toggle"><i class="fa fa-bars"></i></a>
            </div>

            <ul class="nav navbar-nav navbar-right">
              <li class="">
                <a href="javascript:;" class="user-profile dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                  <img src="<?php echo $user_img; ?>" alt=""><?php echo $user_info_result['user_namelastname']; ?>
                  <span class=" fa fa-angle-down"></span>
                </a>
                <ul class="dropdown-menu dropdown-usermenu pull-right">
                  <li><a href="user-profile.php"> Hesab məlumatları</a></li>
                  <li>
                    <a href="user-security-detail.php">
                      <span class="pull-right "><i class="fa fa-lock fa-1x" tyle=""></i></span>
                      <span>Təhlükəsizlik && Şifrə</span>
                    </a>
                  </li>
                  <li><a href="logout.php"><i class="fa fa-sign-out pull-right"></i> Çıxış</a></li>
                </ul>
              </li>
            </ul>
          </nav>
        </div>
      </div>
        <!-- /top navigation -->