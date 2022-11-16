<?php
  session_start();
	if(isset($_SESSION["SAEP_session"])){
    header("Location: ../dashboard/");
	}
  include 'developer/var.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<title>SAEP - Sistema de Admisión y Entrevista Psicológica</title>
<link rel="icon" type="image/png" href="<?php url('favicon.png'); ?>">
<!-- Tell the browser to be responsive to screen width -->
<meta name="viewport" content="width=device-width, initial-scale=1">

<!-- v4.0.0-alpha.6 -->
<link rel="stylesheet" href="<?php url('assets/bootstrap/css/bootstrap.min.css'); ?>">

<!-- Google Font -->
<link href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700" rel="stylesheet">

<!-- Theme style -->
<link rel="stylesheet" href="<?php url('assets/css/style.css'); ?>">
<link rel="stylesheet" href="<?php url('assets/css/font-awesome/css/font-awesome.min.css'); ?>">
<link rel="stylesheet" href="<?php url('assets/css/et-line-font/et-line-font.css'); ?>">
<link rel="stylesheet" href="<?php url('assets/css/themify-icons/themify-icons.css'); ?>">

<!-- Toast -->
<link rel="stylesheet" href="<?php url('assets/css/toastr.min.css'); ?>">

<!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
<!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
<![endif]-->

<!-- jQuery 3 --> 
<script src="<?php url('assets/js/jquery.min.js'); ?>"></script> 
<!-- Functions --> 
<script src="<?php url('assets/js/functions.js'); ?>"></script> 
<!-- v4.0.0-alpha.6 --> 
<script src="<?php url('assets/bootstrap/js/bootstrap.min.js'); ?>"></script> 

<!-- Toast --> 
<script src="<?php url('assets/js/toastr.min.js'); ?>"></script> 



</head>
<body class="hold-transition login-page sty1">
<div class="login-box sty1">
  <div class="login-box-body sty1">
  <div class="login-logo">
    <a href="./"><img src="<?php url('assets/img/logo-login.png'); ?>" alt=""></a>
  </div>
    <p class="login-box-msg">Ingresa tus datos de SINU</p>
    <form id="frmLogin" method="post">
      <div class="form-group has-feedback">
        <input type="number" id="txtUsuario" name="txtUsuario" class="form-control sty1" placeholder="Usuario">
      </div>
      <div class="form-group has-feedback">
        <input type="password" id="txtPassword" name="txtPassword" class="form-control sty1" placeholder="Contraseña">
      </div>
      <div>
        <!-- <div class="col-xs-8">
          <div class="checkbox icheck">
            <label>
              <input type="checkbox">
              Recordarme </label>
            <a href="pages-recover-password.html" class="pull-right"><i class="fa fa-lock"></i> ¿Olvidaste tu contraseña?</a> </div>
        </div> -->
        <!-- /.col -->
        <div class="col-xs-4 m-t-1">
          <button type="submit" class="btn btn-primary btn-block btn-flat">Ingresar</button>
        </div>
        <!-- /.col --> 
      </div>
    </form>
   <!--  <div class="social-auth-links text-center">
      <p>- OR -</p>
      <a href="#" class="btn btn-block btn-social btn-facebook btn-flat"><i class="fa fa-facebook"></i> Sign in using
      Facebook</a> <a href="#" class="btn btn-block btn-social btn-google btn-flat"><i class="fa fa-google-plus"></i> Sign in using
      Google+</a> </div> -->
    <!-- /.social-auth-links -->
    
    <!-- <div class="m-t-2">Don't have an account? <a href="pages-register2.html" class="text-center">Sign Up</a></div> -->
    <footer style="position: fixed;bottom: 5px;text-align: center;font-size: 12px;">
      Copyright © 2020 SAEP. All rights reserved Departamento de Bienestar Institucional, Desarrollo Humano.
    </footer>
  </div>

  <!-- /.login-box-body --> 
</div>
<!-- /.login-box --> 



<script>

  $("#frmLogin").submit(function( event ) {
      event.preventDefault();
      
      var usuario = $("#txtUsuario").val();
      var password = $("#txtPassword").val();
      if($.trim(usuario) == ''){
          toastr.warning('Por favor, ingrese Usuario.');
          $("#txtUsuario").focus();
      }else if($.trim(password) == ''){

          toastr.warning('Por favor, ingrese Contraseña.');
          $("#txtPassword").focus();
      }else{
          $.ajax({
              url : "<?php url('cLogin/iniciarsesion'); ?>",
              type : "POST",
              data : {
                  'usuario' : usuario,
                  'password' : password
              },
              dataType : "JSON",
              success : function (json){
                  if(json.success == true){
                    toastr.success("Logueado exitosamente!");
                    window.location='../dashboard/';
                  }else{
                      toastr.error(json.mensaje);
                  }
              }
          });
      }
  });
</script>


</body>
</html>