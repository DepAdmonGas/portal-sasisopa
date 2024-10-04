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
  <li class="breadcrumb-item text-primary c-pointer" onclick="window.history.go(-2);"><i class="fa-solid fa-house"></i> SASISOPA</li>
  <li class="breadcrumb-item c-pointer" onclick="regresarP()">11. INTEGRIDAD MECÁNICA Y ASEGURAMIENTO DE LA CALIDAD</li>
  <li aria-current="page" class="breadcrumb-item active">Bitacoras</li>
  </ol>
  </div>
  <!-- Fin -->

  <h3>Bitacoras</h3>

  <div class="bg-white p-4 mt-3">
  <div class="container text-justify">

  <p class="text-primary" style="font-size: 1.3em;"><b>Apartados de la NORMA Oficial Mexicana NOM-005-ASEA-2016, Diseño, construcción, operación y mantenimiento de Estaciones de Servicio para almacenamiento y expendio de diésel y gasolinas.</b></p>

  <div>
  <ul style="font-size: 1.2em;">
  <ol><b>7.1.  Disposiciones Operativas.</b><br>
  <div class="ml-4">
  Para efectos de control y verificación de las actividades de operación, debe contar con uno o varios libros de bitácoras foliadas, se permite el uso de aplicaciones (software) de base(s) de datos electrónica(s), para el registro de las incidencias y actividades de operación, entre otros de: recepción y descarga de productos, limpiezas programadas o no programadas, desviaciones en el balance de producto, Incidentes e inspecciones de operación. La bitácora(s) debe cumplir con los incisos del numeral 8.3.
  </div><br>
  </ol>
  <ol><b>8.3.  Bitácora.</b><br>
  <div class="ml-4">Para efectos de control y verificación de las actividades de mantenimiento la Estación de Servicio debe contar con uno o varios libros de bitácoras foliadas, para el registro de lo siguiente: mantenimiento preventivo y correctivo de edificaciones, elementos constructivos, equipos, sistemas e instalaciones de la Estación de Servicio, pruebas de hermeticidad, incidentes e inspecciones de mantenimiento, entre otros.</div>
  <div class="ml-4">
  <ul>
  <ol><b>a.</b>  La(s) bitácora(s) no debe(n) contener tachaduras y en caso de requerirse alguna corrección, ésta será a través de un nuevo registro, sin eliminar ni tachar el registro previo.</ol>
  <ol><b>b.</b>  La(s) bitácora(s) estará(n) disponible(s) en todo momento en la Estación de Servicio y en un lugar de fácil acceso tanto para el responsable de dicha estación como para los trabajadores autorizados.</ol>
  <ol><b>c.</b>  La(s) bitácora(s) debe(n) contener como mínimo, lo siguiente: nombre de la Estación de Servicio, domicilio, nombre del equipo y firmas de los trabajadores autorizados, firma autógrafa del o los trabajadores que realizaron el registro de actividades, así como la fecha y hora del registro. </ol>
  </ul>
  </div>
  <div class="ml-4">
  Se permite el uso de aplicaciones (software) de base(s) de datos electrónica(s) para dar el seguimiento a las labores que deben ser registradas en la(s) bitácora(s), éstas deben permitir la rastreabilidad de las actividades y los registros requeridos de operación y/o mantenimiento, tales como actividades ejecutadas por personal competente o interacción con personal competente externo en la actividad, informes externos, evidencias objetivas (reportes de servicio, fotografías, manejo de residuos, manifiestos de disposición de residuos, entre otros). Se deben de incluir todos los registros de concepto requeridos a lo largo de esta Norma.
  </div>
  </ol>
  </ul>

  </div>

  </div>
  </div>
  
    </div>

  
  <script src="<?php echo RUTA_JS ?>bootstrap.min.js"></script>
  </body>
  </html>
