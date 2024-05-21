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
  <link rel="stylesheet" href="<?php echo RUTA_CSS ?>componentes.css">
  <link href="<?php echo RUTA_CSS ?>bootstrap.css" rel="stylesheet" />
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

  .hover-div:hover{
  background-color: rgba(248,248,248,0.6);
  -moz-box-shadow: 0 10px 8px -5px #F2F2F2;
  box-shadow: 0 10px 8px -5px #F2F2F2;
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

 function MQuincenal(){
  window.location.href = 'bitacora-mantenimiento-quincenal';
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
    <div class="float-left"><h4>Mantenimiento</h4></div>

    </div>
    <div class="card-body">

      
      <div class="row">
        
        <div class="col-xl-4 col-lg-4 col-md-12 col-sm-12 mb-2">
          <div class="card">
          <div class="card-header font-weight-bold">
            Mantenimiento Preventivo
          </div>
          <div class="card-body">
            <p class="card-text">Su objetivo es mantener un nivel de servicio determinado en los equipos mediante la planificación de acciones de mantenimiento orientadas a evitar que se produzcan incidencias y fallos. Para ello, utilizan información basada en el histórico de funcionamiento del aparato y en sus características.</p>
            <p class="card-text">Las intervenciones se programan de manera sistemática, aunque el equipo no haya dado ningun síntoma de fallo, y se centran especialmente sobre aquellos componentes mas vulnerables. Este tipo de mantenimiento permite ampliar el tiempo de funcionamiento de los equipos en las condiciones apropiadas y ayuda a evitar o reducir las paradas inesperadas.</p>

            <hr>
            
            <div class="text-right">
            <button type="button" class="btn btn-info rounded-0 btn-sm ml-2 mb-2" onclick="MQuincenal()">Mantenimiento Quincenal</button>
            </div>

          </div>
        </div>
        </div>
        

        <div class="col-xl-4 col-lg-4 col-md-12 col-sm-12 mb-2 mt-2">
          <div class="card">
          <div class="card-header font-weight-bold">
            Mantenimiento Correctivo
          </div>
          <div class="card-body">
            <p class="card-text">Se refiere él conjunto de acciones ejecutadas para a corregir incidencias que van presentándose. Es completamente reactivo, la acción se lleva a cabo una vez que se ha producido la incidencia. A partir de ahí los usuarios informan al departamento de mantenimiento que diagnóstica las causas y trata de buscar soluciones. Este nivel de mantenimiento no permite actuar de manera proactiva antes de que se produzca el falló.</p>

          </div>
        </div>
        </div>
       

        <div class="col-xl-4 col-lg-4 col-md-12 col-sm-12 mb-2 mt-2">
          <div class="card">
          <div class="card-header font-weight-bold">
            Mantenimiento Predictivo
          </div>
          <div class="card-body">
            <p class="card-text">Este tipo de mantenimiento es capaz de predecir cuando van a producirse averías y solucionarlas antes de que sucedan. En base a toda la información recogida, a las condiciones de funcionamiento y a las acciones realizadas previamente, el sistema detecta fallos potenciales y actúa de acuerdo a un conjunto de acciones previas diseñado para evitar que ocurran las incidencias.</p>
            <p class="card-text">Busca conocer en tiempo real y permanente el estado y la capacidad de funcionamiento de las instalaciones. Para ello, identifica y mide múltiples parámetros representativos que ayudan a describir ese estado general y cuya variación pueda indicar potenciales problemas para el equipo. Esto ayuda a mejorar la eficiencia de los equipos de producción.</p>
           
          </div>
        </div>
        </div>
      </div>

    </div>
    </div>
    </div>
    </div>
    </div>

  <script src="<?php echo RUTA_JS ?>bootstrap.min.js"></script>
  </body>
  </html>