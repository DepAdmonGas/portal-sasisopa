<?php
require('app/help.php');
$result_tema = $ClassCursos->NombreTemaEvaluacion($idTema, $con);
$temadescripcion = $result_tema['tema'];
?>
<html lang="es">
  <head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
  <title>SASISOPA</title>
  <meta name="description" content="">
  <meta name="viewport" content="width=device-width initial-scale=1.0">
  <link rel="shortcut icon" href="<?php echo RUTA_IMG_ICONOS ?>/icono-web.png">
  <link rel="apple-touch-icon" href="<?php echo RUTA_IMG_ICONOS ?>/icono-web.png">
  <link rel="stylesheet" href="<?php echo RUTA_CSS ?>alertify.css">
  <link rel="stylesheet" href="<?php echo RUTA_CSS ?>themes/default.rtl.css">
  <link rel="stylesheet" href="<?php echo RUTA_CSS ?>componentes.css">
  <link href="<?php echo RUTA_CSS ?>bootstrap.css" rel="stylesheet" />
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.0/umd/popper.min.js"></script>
  <script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
  <script type="text/javascript" src="<?php echo RUTA_JS ?>alertify.js"></script>
  <link href="https://fonts.googleapis.com/css?family=Montserrat" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.7.0/animate.min.css">
  <style media="screen">
  .LoaderPage {
  position: fixed;
  left: 0px;
  top: 0px;
  width: 100%;
  height: 100%;
  z-index: 9999;
  background: white;
  background: url('../imgs/iconos/load-index-img.gif') 50% 50% no-repeat rgb(255,255,255);
  }
  </style>
  <script type="text/javascript">
  $(document).ready(function($){
  $(".LoaderPage").fadeOut("slow");

ListaModulos();
  });

 
function ListaModulos(){
    $('#DivDetalleModulos').load('../public/cursos/lista-modulos.php?idTema=<?php echo $idTema; ?>');
    }

   function regresarP(){
    window.history.back();
   }
   

  </script>
  </head>
  <body>
  <div class="LoaderPage"></div>
  <div class="fixed-top navbar-admin">
  <?php require('public/componentes/header.menu.php'); ?>
  </div>
  <div class="magir-top-principal">

  <div class="row no-gutters">
  <div class="col-12">
  <div class="card adm-card" style="border: 0;">
  <div class="adm-car-title">
    <div class="float-left" style="padding-right: 20px;margin-top: 5px;">
    <a onclick="regresarP()" style="cursor: pointer;" data-toggle="tooltip" data-placement="right" title="Regresar"><img src="<?php echo RUTA_IMG_ICONOS."regresar.png"; ?>"></a>
    </div>
  <div class="float-left"><h4><?php echo $temadescripcion; ?></h4></div>
  </div>
 
 <div class="card-body">
 
 <h6 class="card-subtitle mb-2 text-muted">MODULOS</h6>
 <div id="DivDetalleModulos"></div>

 </div>

  </div>
  </div>
  </div>
  </div>
  
  <script src="<?php echo RUTA_JS ?>bootstrap.min.js"></script>
  </body>
  </html>
