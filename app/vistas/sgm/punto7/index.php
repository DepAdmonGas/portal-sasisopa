<?php
require('app/help.php');
?> 
<html lang="es">
  <head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
  <title>SGM</title>
  <meta name="description" content="">
  <meta name="viewport" content="width=device-width initial-scale=1.0">
  <link rel="shortcut icon" href="<?=RUTA_IMG_ICONOS?>/icono-web.png">
  <link rel="apple-touch-icon" href="<?=RUTA_IMG_ICONOS?>/icono-web.png">
  <link rel="stylesheet" href="<?=RUTA_CSS?>alertify.css">
  <link rel="stylesheet" href="<?=RUTA_CSS?>themes/default.rtl.css">
  <link href="<?=RUTA_CSS ?>bootstrap.css" rel="stylesheet" />
  <link rel="stylesheet" href="<?=RUTA_CSS?>componentes.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.0/umd/popper.min.js"></script>
  <script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.13.2/jquery-ui.min.js"></script>
  <script type="text/javascript" src="<?=RUTA_JS?>alertify.js"></script>
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
  background: url('imgs/iconos/load-index-img.gif') 50% 50% no-repeat rgb(255,255,255);
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

    function btnAyuda(){
  $('#myModal').modal('show');
  }

  function ProgramaAnualCalibracion(){
    window.location = "programa-anual-calibracion-patrones-instrumentos-medida";
  }

  function ProgramaAnualVerificacionEquipo(){
    window.location = "programa-anual-verificacion-equipos";
  }

  function BitacoraCalibracionEquipos(){
    window.location = "bitacora-calibracion-equipos-sgm";
  }

  function BitacoraVerificacionEquipo(){
    window.location = "bitacora-verificacion-equipo-medicion-sgm";
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
    <div class="float-left"><h4>7. Procesos de medición</h4></div>

    <div class="float-right" style="margin-top: 6px;margin-left: 10px;">
    <a onclick="btnAyuda()" style="cursor: pointer;" data-toggle="tooltip" data-placement="left" title="Ayuda" >
    <img src="<?php echo RUTA_IMG_ICONOS."info.png"; ?>">
    </a> 
    </div>
    </div>
   
    <div class="card-body">

      <div class="row">
        <div class="col-xl-3 col-lg-3 col-md-12 col-sm-12">
         <div class="bg-primary p-3 text-white" onclick="ProgramaAnualCalibracion()">
          <h5>1. Programa anual de calibración de patrones e instrumentos de medida</h5>
         </div>
        </div>

        <div class="col-xl-3 col-lg-3 col-md-12 col-sm-12">
          <div class="bg-info p-3 text-white" onclick="BitacoraCalibracionEquipos()">
          <h5>2.  Bitácora la para la calibración de equipos </h5>
         </div>
        </div>

        <div class="col-xl-3 col-lg-3 col-md-12 col-sm-12">
          <div class="bg-primary p-3 text-white" onclick="ProgramaAnualVerificacionEquipo()">
          <h5>3.  Programa anual de verificación de equipos</h5>
         </div>
        </div>

        <div class="col-xl-3 col-lg-3 col-md-12 col-sm-12">
          <div class="bg-info p-3 text-white" onclick="BitacoraVerificacionEquipo()">
          <h5>4.  Bitácora para la verificación de equipos de medicion</h5>
         </div>
        </div>
      </div>

    </div>
    </div>
    </div>
    </div>
    </div>

        <div class="modal fade bd-example-modal-lg" id="myModal" >
    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
      <div class="modal-content" style="border-radius: 0px;border: 0px;">
        <div class="modal-header">
          <h4 class="modal-title">Ayuda</h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
        </div>
        <div class="modal-body">

          Bienvenido al elemento <b>7. PROCESOS DE MEDICIÓN.</b> A continuación, encontraras los programas de calibración y verificación de equipos de medición y patrones de medida, asi como sus respectivas bitácoras para el registro. 

        </div>
       </div>
    </div>
    </div>
 
  <script src="<?php echo RUTA_JS ?>bootstrap.min.js"></script>
  </body>
  </html>

