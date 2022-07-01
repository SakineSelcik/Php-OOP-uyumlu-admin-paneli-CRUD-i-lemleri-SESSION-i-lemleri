<?php
ob_start();
session_start();
if (isset($_SESSION['admins'])){
    header("Location:index.php");
    exit();
}
require_once 'netting/class.crud.php';
$db=new curd();

?><!DOCTYPE html>
<html lang="tr" >
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width,initial-scale=1.0,user-scalable=0,minimal-ui">
  <meta name="description" content="Vuexy admin is super flexible, powerful, clean &amp; modern responsive bootstrap 4 admin template with unlimited possibilities.">
  <meta name="keywords" content="admin template, Vuexy admin template, dashboard template, flat admin template, responsive admin template, web app">
  <meta name="author" content="PIXINVENT">
  <title>Masadan</title>
  <link rel="apple-touch-icon" href="app-assets/images/ico/apple-icon-120.png">
  <link rel="shortcut icon" type="image/x-icon" href="Masadancom.svg">
  <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,300;0,400;0,500;0,600;1,400;1,500;1,600" rel="stylesheet">

  <!-- Tell the browser to be responsive to screen width -->
  <!-- <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">-->
  <!-- Bootstrap 3.3.7 -->
   <link rel="stylesheet" type="text/css" href="app-assets/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="app-assets/css/bootstrap-extended.min.css">
    <link rel="stylesheet" type="text/css" href="app-assets/css/colors.min.css">
    <link rel="stylesheet" type="text/css" href="app-assets/css/components.min.css">
    <link rel="stylesheet" type="text/css" href="app-assets/css/themes/dark-layout.min.css">
    <link rel="stylesheet" type="text/css" href="app-assets/css/themes/bordered-layout.min.css">
    <link rel="stylesheet" type="text/css" href="app-assets/css/themes/semi-dark-layout.min.css">

    <!-- BEGIN: Page CSS-->
    <link rel="stylesheet" type="text/css" href="app-assets/css/core/menu/menu-types/vertical-menu.min.css">
    <link rel="stylesheet" type="text/css" href="app-assets/css/plugins/forms/form-validation.css">
    <link rel="stylesheet" type="text/css" href="app-assets/css/pages/page-auth.min.css">
    <!-- END: Page CSS-->

    <!-- BEGIN: Custom CSS-->
    <link rel="stylesheet" type="text/css" href="assets/css/style.css">

      <style type="text/css">
          .vertical-layout{
              background: #f2f5ff   ;
              height: 500px;
              background-position: center;
              background-repeat: no-repeat;
              background-size: cover;
              -webkit-background-size:cover;
              -moz-background-size:cover;
              -o-background-size:cover;
              position: relative;
          }
          body {
              overflow: hidden;
          }
      </style>
    <!-- END: Custom CSS-->

</head>
<body class="vertical-layout vertical-menu-modern blank-page navbar-floating footer-static  " data-open="click" data-menu="vertical-menu-modern" data-col="blank-page">
<div class="maindiv">

<div class="container">
  
  <div class="card-body loginalani">
    
    <h3 class="brand-text "  style="color: #fd7e14">Hoşgeldiniz </h3>
    <p class="login-box-msg">Merhaba kullanıcı bilgilerinizi girerek başlayın</p>
    <br>
    <?php

    //echo"<pre>";
   // print_r("dkmgldskmbgl".json_decode($_COOKIE['adminsLogin']));
   // echo"</pre>";
    if (isset($_COOKIE['adminsLogin'])) {

        $login = json_decode($_COOKIE['adminsLogin']);
    }

    if (isset($_POST['admins_login'])){
        $sonuc=$db->adminsLogin(htmlspecialchars($_POST['admins_username']),htmlspecialchars($_POST['admins_pass']),$_POST['remember_me']);
       if ($sonuc['status']){
           header("Location:index.php");
           exit();
       }
       else{ ?>
          <div class="alert alert-danger">Lütfen bilgilerinizi kontrol ediniz..</div>
       <?php }
    }
    ?>
    <form action="" method="post">
      <div class="form-group has-feedback">
        <input type="text" class="form-control"
            <?php
            if (isset($_COOKIE['adminsLogin']))
            {
                echo 'value="'.$login->admins_username.'"';
            }
            else  echo 'placeholder= "username"';
            ?>
              name="admins_username">
        <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
      </div>
      <div class="form-group has-feedback">
        <input type="password" class="form-control"

            <?php
            if (isset($_COOKIE['adminsLogin'])) {
                echo 'value="'.$login->admins_pass.'"';
            }
            else  echo 'placeholder= "Password"';
            ?>
            name="admins_pass">
        <span class="glyphicon glyphicon-lock form-control-feedback"></span>
      </div>
      
          <div >
              <div class="checkbox icheck">
                  <label>
                      <input type="checkbox"
                          <?php
                          if (isset($_COOKIE['adminsLogin'])) {
                              echo 'checked';
                          }
                          ?>
                             name="remember_me"> Beni Hatırla
                  </label>
              </div>
          
        <!-- /.col -->
          

          <button type="submit" onclick="signinbutton()" style="width:100%; margin-top: 2%; margin-left:auto; margin-right: auto;" class="btn btn-outline-primary  btn-block mb-lg-50" name="admins_login" >Sign in</button>
          
        
        <!-- /.col -->
      </div>
    </form>
  </div>
  </div>
</div>
  <!-- /.login-box-body -->
</div>
<!-- /.login-box -->

<!-- jQuery 3 -->
<script src="../bower_components/jquery/dist/jquery.min.js"></script>
<!-- Bootstrap 3.3.7 -->
<script src="../bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
<!-- iCheck -->
<script src="../plugins/iCheck/icheck.min.js"></script>
<script>
    $(function () {
        $('input').iCheck({
            checkboxClass: 'icheckbox_square-blue',
            radioClass: 'iradio_square-blue',
            increaseArea: '20%' /* optional */
        });
    });
    function signinbutton(){
        window.location.reload();
    }
</script>
</body>
<style type="text/css">
  .loginalani{
    margin: auto;
    margin-top: 15%;
    width: 30%;
    height: 40%;
    background-color: white;
    border-radius: 10px;
  }
  .maindiv{
    vertical-align: bottom;
    padding-top: auto;
    padding-bottom: auto;

  }

</style>
</html>
<?php ob_end_flush(); ?>