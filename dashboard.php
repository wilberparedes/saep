<?php
  include 'developer/var.php';
  include 'developer/security.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<title>SAEP - Sistema de Admisión y Entrevista Psicológica</title>
<!-- Tell the browser to be responsive to screen width -->
<meta name="viewport" content="width=device-width, initial-scale=1">

<!-- v4.0.0 -->
<link rel="stylesheet" href="<?php url('assets/bootstrap/css/bootstrap.min.css'); ?>">

<!-- Favicon -->
<link rel="icon" type="image/png" sizes="16x16" href="<?php url('assets/img/favicon.png'); ?>">

<!-- Google Font -->
<link href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700" rel="stylesheet">

<!-- Theme style -->
<link rel="stylesheet" href="<?php url('assets/css/style.css'); ?>">
<link rel="stylesheet" href="<?php url('assets/css/font-awesome/css/font-awesome.min.css'); ?>">
<link rel="stylesheet" href="<?php url('assets/css/et-line-font/et-line-font.css'); ?>">
<link rel="stylesheet" href="<?php url('assets/css/themify-icons/themify-icons.css'); ?>">
<link rel="stylesheet" href="<?php url('assets/css/simple-lineicon/simple-line-icons.css'); ?>">

<!-- Toast -->
<link rel="stylesheet" href="<?php url('assets/css/toastr.min.css'); ?>">
<link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">

<!-- TABLE STYLES-->
<link rel="stylesheet" href="<?php url('assets/plugins/jquery-ui/jquery-ui.min.css'); ?>">

<!-- tooltip -->
<!-- <link rel="stylesheet" href="<?php url('assets/plugins/tooltip/tooltip.css'); ?>"> -->


<!-- popover -->
<link rel="stylesheet" href="<?php url('assets/plugins/popover/bootstrap-popover-x.css'); ?>"/>

<!-- Calendar -->
<link rel="stylesheet" href="<?php url('assets/plugins/calendar/fullcalendar.min.css'); ?>">
<link rel="stylesheet" href="<?php url('assets/plugins/calendar/fullcalendar.print.min.css'); ?>" media="print">

<link rel="stylesheet" href="<?php url('assets/css/bootstrap-select.min.css'); ?>">
<!-- DataTables -->
<link rel="stylesheet" href="<?php url('assets/plugins/datatables/css/dataTables.bootstrap.min.css'); ?>">


<!-- dropify -->
<link rel="stylesheet" href="<?php url('assets/plugins/dropify/dropify.min.css'); ?>">

<!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
<!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
<![endif]-->

<!--  JS -->
<!-- jQuery 3 --> 
<script src="<?php url('assets/js/jquery.min.js'); ?>"></script> 
<script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
<!-- POPPER --> 
<script src="<?php url('assets/plugins/popper/popper.min.js'); ?>"></script> 

<!-- v4.0.0-alpha.6 --> 
<script src="<?php url('assets/bootstrap/js/bootstrap.min.js'); ?>"></script> 

<!-- template --> 
<script src="<?php url('assets/js/adminkit.js'); ?>"></script> 

<!-- Morris JavaScript --> 
<script src="<?php url('assets/plugins/raphael/raphael-min.js'); ?>"></script> 
<script src="<?php url('assets/plugins/morris/morris.js'); ?>"></script> 
<!--<script src="<?php url('assets/plugins/functions/dashboard1.js'); ?>"></script> -->

<!-- Chart Peity JavaScript --> 
<script src="<?php url('assets/plugins/peity/jquery.peity.min.js'); ?>"></script> 
<script src="<?php url('assets/plugins/functions/jquery.peity.init.'); ?>js"></script>

<!-- Toast --> 
<script src="<?php url('assets/js/toastr.min.js'); ?>"></script> 

<!-- DataTable --> 
<script src="<?php url('assets/plugins/datatables/jquery.dataTables.min.js'); ?>"></script>
<script src="<?php url('assets/plugins/datatables/dataTables.bootstrap.min.js'); ?>"></script>
<!-- <script src="https://cdn.datatables.net/buttons/1.7.1/js/dataTables.buttons.min.js"></script>  
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>  
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>  
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>  
<script src="https://cdn.datatables.net/buttons/1.7.1/js/buttons.html5.min.js"></script>  
<script src="https://cdn.datatables.net/buttons/1.7.1/js/buttons.print.min.js"></script>   -->

<!-- <script type="text/javascript" src="https://cdn.datatables.net/v/dt/dt-1.10.18/datatables.min.js"></script> -->


<script src="<?php url('assets/js/bootbox.min.js'); ?>"></script>

<script src="<?php url('assets/js/functions.js'); ?>"></script> 

<script src="<?php url('assets/plugins/jquery-ui/jquery-ui.min.js'); ?>"></script>

<!-- tooltip -->
 <!-- // <script src="<?php url('assets/plugins/tooltip/tooltip.js'); ?>"></script>  -->
<!-- // <script src="<?php url('assets/plugins/tooltip/script.js'); ?>"></script>   -->

<!-- popover --> 
<script src="<?php url('assets/plugins/popover/bootstrap-popover-x.js'); ?>"></script>


<!-- Calendar --> 
<script src="<?php url('assets/plugins/moment/moment.js'); ?>"></script> 
<script src="<?php url('assets/plugins/calendar/fullcalendar.js'); ?>"></script> 
<script src="<?php url('assets/plugins/calendar/locale/es.js'); ?>"></script>

<script src="<?php url('assets/js/bootstrap-select.min.js'); ?>"></script>

<!-- dropify --> 
<script src="<?php url('assets/plugins/dropify/dropify.min.js'); ?>"></script> 


<!--JS Scripts-->
    <script>
      var interval;
        $(document).ready(function () {
          if(localStorage.paginaSAEP){
            loadpag(localStorage.paginaSAEP,localStorage.idpaginaSAEP,localStorage.codsuppagSAEP);
          }else{
            loadpag('../graficas.php',1);
          }
        });
        var aa = 0;
        document.addEventListener("DOMContentLoaded", function(){
          const milisegundos = 8 *1000;
          interval = setInterval(function(){
              fetch("../refrescar.php")
              .then(function(response) {
                return response.json();
              })
              .then(function(myJson) {
                if(aa == 0){
                  if(myJson.refresh){
                    aa = 1;
                    // clearInterval(interval);
                    bootbox.confirm("<b style='color:#333;'>"+myJson.title+"</b> <br/>"+myJson.message, function(result) {
                      if (result) {
                        $.ajax({
                          url: "<?php url('Lopersa/saveUpdate'); ?>",
                          type : "POST",
                          dataType : "JSON", 
                          success : function (json){
                            if(json.success){
                              toastr.success("Muchas gracias por actualizar su plataforma!", "Departamento de Bienestar Institucional");
                              window.location.reload();
                            }
                          }
                        });
                      }else{
                        aa=0;
                      }
                    });
                  }
                }
              });
          },milisegundos);
        });
    </script>

</head>
<body class="skin-blue sidebar-mini">
  <div class="desactivarC" style="height: 100%;width: 100%;position: fixed;top: 0;left: 0;background: rgba(255,255,255,0.8); z-index: 999999;display:none;"><img src="<?php url('assets/img/loading.gif'); ?>" style="margin-left:50%; margin-top:300px;width: 60px;"><p style="width: 100%;text-align: center;color: #000;font-size: 18px;">Gestionando datos, por favor, espere...</p></div>
<div class="wrapper boxed-wrapper">
  

  <!-- HEADER -->
  <?php include 'component/header.php'; ?>
  <!-- END HEADER -->



  <!-- Left side column. contains the logo and sidebar -->
  <div id="menuu">

  </div>
  
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper" id="contenido"> 
    
  </div>
  <!-- /.content-wrapper -->
  
<?php
  include 'component/footer.php';
?>


</body>
</html>
