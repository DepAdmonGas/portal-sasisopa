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
    <?php require('app/vistas/componentes/navbar-perfil.php'); ?>
    </div>

    <div class="magir-top-principal p-3">

     <!-- Inicio -->
      <div class="float-end">
      <div class="dropdown dropdown-sm d-inline ms-2">
      <button type="button" class="btn dropdown-toggle btn-primary" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
      <i class="fa-solid fa-screwdriver-wrench"></i></span>
      </button>
      <ul class="dropdown-menu">
      <li onclick="btnAyuda()"><a class="dropdown-item c-pointer"> <i class="fa-regular fa-circle-question"></i> Ayuda</a></li>
      </ul>
      </div>
      </div>
      <!-- Fin -->

      <!-- Inicio -->
      <div aria-label="breadcrumb" style="padding-left: 0; margin-bottom: 0;">
      <ol class="breadcrumb breadcrumb-caret">
      <li class="breadcrumb-item text-primary c-pointer" onclick="regresarP()"><i class="fa-solid fa-house"></i> SGM</li>
      <li aria-current="page" class="breadcrumb-item active">7. Procesos de medición</li>
      </ol>
      </div>
      <!-- Fin -->

      <h3>7. Procesos de medición</h3>

      <div class="mt-3">

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

        <div class="modal fade bd-example-modal-lg" id="myModal" >
    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
      <div class="modal-content" style="border-radius: 0px;border: 0px;">
        <div class="modal-header rounded-0 head-modal">
          <h4 class="modal-title text-white">Ayuda</h4>
          <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
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

