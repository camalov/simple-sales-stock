<?php 
ob_start();
session_start();

if(isset($_SESSION['user']))
   Header("Location:index.php");


?>


<!DOCTYPE html>
<html lang="en">
<head>
  <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
  <!-- Meta, title, CSS, favicons, etc. -->
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <title>CL Yazılım İnzibatçı Girişi | </title>

  <!-- Bootstrap -->
  <link href="../vendors/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
  <!-- Font Awesome -->
  <link href="../vendors/font-awesome/css/font-awesome.min.css" rel="stylesheet">
  <!-- NProgress -->
  <link href="../vendors/nprogress/nprogress.css" rel="stylesheet">
  <!-- Animate.css -->
  <link href="../vendors/animate.css/animate.min.css" rel="stylesheet">

  <!-- Custom Theme Style -->
  <link href="../build/css/custom.min.css" rel="stylesheet">
</head>

<body class="login">
  <div>
    <a class="hiddenanchor" id="signup"></a>
    <a class="hiddenanchor" id="signin"></a>

    <div class="login_wrapper">
      <div class="animate form login_form">
        <section class="login_content">
          <h1>İnzibatçı Paneli</h1>
          <form action="dbnet/operations.php" method="POST">
            <div>
              <input type="text" name="user_name" autofocus="" class="form-control" placeholder="İstifadəçi adı" required="" />
            </div>
            <div>
              <input type="password" name="user_password" class="form-control" placeholder="Şifrə" required="" />
            </div>
            <div>
              <button class="btn btn-default submit" type="submit" name="login" style="width:100%; background-color:#73879C; color:white;">Daxil ol</button>
            </div>
          </form>
          <div class="clearfix"></div>

          <div class="separator">
            <p class="change_link"><?php  

            if($_GET['status'] == 'false'){

              echo "İstifadəçi tapılmadı";
            }else if($_GET['status'] == 'logout'){ 
              echo "Səhifədən çıxış etdiniz. Yenidən daxil olmaq üçün istifadəçi məlumatlarını daxil edin.";
            }else if($_GET['status'] == 'systemless_command'){ ?>

             <b style="color:red;">Sistemdən kənar əməliyyat qeydə alındı. Səhifəyə girişiniz məhdudlaşdırıldı</b>

           <?php } ?>
         </p>

         <div class="clearfix"></div>
         <br />

         <div>
          <h1><i class="fa fa-paw"></i></h1>
          <p>© <?php date_default_timezone_set("Asia/Baku"); echo date("Y"); ?> <small></small></p>
        </div>
      </div>
    </section>
  </div>
</div>
</div>
<!-- jQuery -->
<script src="../vendors/jquery/dist/jquery.min.js"></script>
<!-- Bootstrap -->
<script src="../vendors/bootstrap/dist/js/bootstrap.min.js"></script>

<script type="text/javascript">
  $(document).on({
    "contextmenu": function(e) {
      console.log("ctx menu button:", e.which); 

        // Stop the context menu
        e.preventDefault();
      },
      "mousedown": function(e) { 
        console.log("normal mouse down:", e.which); 
      },
      "mouseup": function(e) { 
        console.log("normal mouse up:", e.which); 
      }
    });

  </script>

</body>
</html>
