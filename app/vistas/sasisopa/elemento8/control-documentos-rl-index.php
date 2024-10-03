<?php
require('app/help.php');
include_once "app/modelo/RequisitoLegal.php";

$class_requisito_legal = new RequisitoLegal();

?>
<html lang="es">
  <head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
  <title>SASISOPA</title>
  <meta name="description" content="">
  <meta name="viewport" content="width=device-width initial-scale=1.0">
  <link rel="shortcut icon" href="<?=RUTA_IMG_ICONOS?>/icono-web.png">
  <link rel="apple-touch-icon" href="<?=RUTA_IMG_ICONOS?>/icono-web.png">
  <link rel="stylesheet" href="<?=RUTA_CSS?>alertify.css">
  <link rel="stylesheet" href="<?=RUTA_CSS?>themes/default.rtl.css">
  <link rel="stylesheet" href="<?=RUTA_CSS ?>bootstrap.css" />
  <link rel="stylesheet" href="<?=RUTA_CSS?>componentes.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.7.0/animate.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/2.9.2/umd/popper.min.js"></script>
  <script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.13.2/jquery-ui.min.js"></script>
  <script type="text/javascript" src="<?=RUTA_JS?>alertify.js"></script>
  <link href="https://fonts.googleapis.com/css?family=Montserrat" rel="stylesheet">
      <style media="screen">
  .LoaderPage {
  position: fixed;
  left: 0px;
  top: 0px;
  width: 100%;
  height: 100%;
  z-index: 9999;
  background: url('imgs/iconos/load-img.gif') 50% 50% no-repeat rgb(249,249,249);
}
  </style>
  <script type="text/javascript">
  $(document).ready(function(){
  $('[data-toggle="tooltip"]').tooltip();
  $(".LoaderPage").fadeOut("slow");
  });
  function regresarP(){
   window.history.back();
  }

  function btnDescargar(){
  window.location = "descargar-control-documentos-rl";  
  }
 
   </script>
  </head>
  <body>

    <div class="LoaderPage"></div>
    <div class="fixed-top navbar-admin">
    <?php require('app/vistas/componentes/navbar-perfil.php'); ?>
    </div>

    <div class="magir-top-principal p-3">

    <!-- Inicio -->
    <div aria-label="breadcrumb" style="padding-left: 0; margin-bottom: 0;">
    <ol class="breadcrumb breadcrumb-caret">
    <li class="breadcrumb-item text-primary c-pointer" onclick="regresarP()"><i class="fa-solid fa-house"></i> SASISOPA</li>
    <li aria-current="page" class="breadcrumb-item active">Control y documentos de Requisitos Legales</li>
    </ol>
    </div>
    <!-- Fin -->

    <div class="float-end" style="margin-top: 6px;margin-left: 10px;">
    <a onclick="btnDescargar()" style="cursor: pointer;" data-toggle="tooltip" data-placement="left" title="Descargar" >
    <img src="<?php echo RUTA_IMG_ICONOS."pdf.png"; ?>">
    </a>
    </div>

    <h3>Control y documentos de Requisitos Legales</h3>

    <div class="bg-white mt-3 p-3">
      <div class="p-2 bg-primary text-white">Nivel de gobierno <b>Municipal</b></div>
      <?php echo $class_requisito_legal->RequisitosLegales($Session_IDEstacion,'municipal');?>
      <div class="p-2 bg-primary text-white">Nivel de gobierno <b>Federal</b></div>
      <?php echo $class_requisito_legal->RequisitosLegales($Session_IDEstacion,'federal');?>
      <div class="p-2 bg-primary text-white">Nivel de gobierno <b>Estatal</b></div>
      <?php echo $class_requisito_legal->RequisitosLegales($Session_IDEstacion,'estatal');?>
      <div class="p-2 bg-primary text-white">Nivel de gobierno <b>Varios</b></div>
      <?php echo $class_requisito_legal->RequisitosLegales($Session_IDEstacion,'varios');?>
    </div>

    </div>


  <script src="<?=RUTA_JS?>bootstrap.min.js"></script>
  </body>
  </html>
