<?php
require('app/help.php');

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
  <link href="<?php echo RUTA_CSS ?>bootstrap.css" rel="stylesheet" />
  <link rel="stylesheet" href="<?php echo RUTA_CSS ?>componentes.css">
  <link rel="stylesheet" href="<?php echo RUTA_CSS ?>bootstrap-select.css">
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
  background: url('imgs/iconos/load-img.gif') 50% 50% no-repeat rgb(249,249,249);
  }
  .hovercolor:hover{
  background: rgba(0, 120, 238, .8) !important;
  }

  .cont-puntos{
    border-bottom: 3px solid #3399cc;
    box-shadow: 1px 1px 5px #EDEDED;
  }

  .titulo-punto{
    font-size: 1.25em;
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

  function ConfiguracionTanques(){
  window.location.href = "configuracion-tanques"; 
  }
  function ConfiguracionDispensario(){
  window.location.href = "configuracion-dispensario"; 
  }
  function ConfiguracionSondas(){
  window.location.href = "configuracion-sondas-medicion"; 
  }
  function ConfiguracionJarra(){
  window.location.href = "configuracion-jarra-patron"; 
  }
  function Bitacora(){
  window.location.href = "bitacora-calibracion-equipos";
  }
   </script>
  </head>
  <body>

    <div class="LoaderPage"></div>
    <div class="fixed-top navbar-admin">
    <?php require('public/componentes/header.menu.php'); ?>
    </div>

    <div class="magir-top-principal p-3">

    <div class="float-left" style="padding-right: 20px;margin-top: 5px;">
    <a onclick="regresarP()" style="cursor: pointer;" data-toggle="tooltip" data-placement="right" title="Regresar"><img src="<?php echo RUTA_IMG_ICONOS."regresar.png"; ?>"></a>
    </div>   
    <!-- TITULO / ENCABEZADO -->
    <div class="float-left">
    <h4>Calibración de equipos</h4>
    </div>
    <div class="mt-5">

    <div class="row">
      
      <div class="col-xl-3 col-lg-3 col-md-6 col-sm-12 mt-2 mb-2"> 
        <div class="p-3 cont-puntos mb-3 bg-white">
        <div class="titulo-punto">1. Configuración de Tanques de almacenamiento</div>   
        <div class="text-right mt-3">
        <button type="button" class="btn btn-primary rounded-0" onclick="ConfiguracionTanques()">Entrar</button>
        </div>
        </div>
      </div>

        <div class="col-xl-3 col-lg-3 col-md-6 col-sm-12 mt-2 mb-2"> 
        <div class="p-3 cont-puntos mb-3 bg-white">
        <div class="titulo-punto">2. Configuración de Dispensarios</div>   
        <div class="text-right mt-3">
        <button type="button" class="btn btn-primary rounded-0" onclick="ConfiguracionDispensario()">Entrar</button>
        </div>
        </div>
      </div>

      <div class="col-xl-3 col-lg-3 col-md-6 col-sm-12 mt-2 mb-2"> 
        <div class="p-3 cont-puntos mb-3 bg-white">
        <div class="titulo-punto">3. Configuración de Sondas de medición</div>   
        <div class="text-right mt-3">
        <button type="button" class="btn btn-primary rounded-0" onclick="ConfiguracionSondas()">Entrar</button>
        </div>
        </div>
      </div>

      <div class="col-xl-3 col-lg-3 col-md-6 col-sm-12 mt-2 mb-2"> 
        <div class="p-3 cont-puntos mb-3 bg-white">
        <div class="titulo-punto">4. Configuración de Jarra patron</div>   
        <div class="text-right mt-3">
        <button type="button" class="btn btn-primary rounded-0" onclick="ConfiguracionJarra()">Entrar</button>
        </div>
        </div>
      </div>

        <div class="col-xl-3 col-lg-3 col-md-6 col-sm-12 mt-2 mb-2"> 
        <div class="p-3 cont-puntos mb-3 bg-white">
        <div class="titulo-punto">5. Bitácora calibración de equipos </div>   
        <div class="text-right mt-3">
        <button type="button" class="btn btn-primary rounded-0" onclick="Bitacora()">Entrar</button>
        </div>
        </div>
      </div>

      </div>

    </div>

    </div>


  <script src="<?php echo RUTA_JS ?>bootstrap.min.js"></script>
  </body>
  </html>
