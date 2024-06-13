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
    <?php require('public/componentes/header.menu.php'); ?>
    </div>

    <div class="magir-top-principal p-3">

    <div class="float-left" style="padding-right: 20px;margin-top: 5px;">
    <a onclick="regresarP()" style="cursor: pointer;" data-toggle="tooltip" data-placement="right" title="Regresar"><img src="<?php echo RUTA_IMG_ICONOS."regresar.png"; ?>"></a>
    </div>
    <div class="float-left"><h4>PROGRAMA DE IMPLEMENTACION</h4></div>

    <div class="mt-5 p-3 bg-white">
    <?php if ($session_nomestacion == "Ventura Puente") { ?>

    <div style="overflow-y: hidden;">
    <table class="table table-bordered table-sm mb-0 pb-0">
   <tr style="background: #F8F8F8">
    <td class="font-weight-bold align-middle text-center" style="font-size: 1.4em;">Programa de implementación del Sistema de Administración</td>
    <td class="align-middle text-center" colspan="3" style="font-size: 1.4em;"><b>Fecha:</b> 07-Agosto-19</td>
   </tr>
   <tr style="background: #F8F8F8">
     <td class="align-middle text-center" style="font-size: 1.4em;"><b>Realizado por:</b> Nelly Garcia Estrada</td>
     <td class="align-middle text-center" style="font-size: 1.4em;"><b>Revisado por:</b> Eduardo Galicia Flores</td>
     <td class="align-middle text-center" style="font-size: 1.4em;"><b>Aprobado por:</b> Jose Luis Quinzaños Suarez</td>
   </tr>
   <tr class="table-active">
     <td class="align-middle text-center font-weight-bold" style="font-size: 1.4em;">Actividad</td>
     <td class="align-middle text-center font-weight-bold" style="font-size: 1.4em;">Fecha de Inicio</td>
     <td class="align-middle text-center font-weight-bold" style="font-size: 1.4em;">Fecha de Termino</td>
   </tr>
   <!----------->
    <tr style="font-size: 1.3em;">
     <td colspan="1" class=""><b>II.</b> Identificación de peligros y aspectos ambientales, análisis de riesgo y evaluación de impactos ambientales.</td>
     <td class="align-middle text-center font-weight-bold text-secondary">05/01/2020</td>
     <td class="align-middle text-center font-weight-bold text-secondary">25/03/2020</td>
     </tr>
     <tr style="font-size: 1.3em;">
     <td colspan="1" class=""><b>III.</b> Requisitos legales.</td>
     <td class="align-middle text-center font-weight-bold text-secondary">01/10/2019</td>
     <td class="align-middle text-center font-weight-bold text-secondary">30/11/2019</td>
     </tr>
     <tr style="font-size: 1.3em;">
     <td colspan="1" class=""><b>IV.</b> Objetivos, metas, indicadores</td>
     <td class="align-middle text-center font-weight-bold text-success">01/09/2019</td>
     <td class="align-middle text-center font-weight-bold text-success">24/10/2019</td>
     </tr>
     <tr style="font-size: 1.3em;">
     <td colspan="1" class=""><b>V.</b> Funciones, responsabilidades y autoridad.</td>
     <td class="align-middle text-center font-weight-bold text-secondary">14/09/2019</td>
     <td class="align-middle text-center font-weight-bold text-secondary">27/09/2019</td>
     </tr>
     <tr style="font-size: 1.3em;">
     <td colspan="1" class=""><b>VI.</b> Competencia del personal, capacitación y entrenamiento.</td>
     <td class="align-middle text-center font-weight-bold text-secondary">28/08/2019</td>
     <td class="align-middle text-center font-weight-bold text-secondary">09/12/2019</td>
     </tr>
     <tr style="font-size: 1.3em;">
     <td colspan="1" class=""><b>VII.</b> Comunicación, participación y consulta.</td>
     <td class="align-middle text-center font-weight-bold text-success">01/09/2019</td>
     <td class="align-middle text-center font-weight-bold text-success">06/09/2019</td>
     </tr>
     <tr style="font-size: 1.3em;">
     <td colspan="1" class=""><b>VIII.</b> Control de documentos y registros.</td>
     <td class="align-middle text-center font-weight-bold text-success">01/09/2019</td>
     <td class="align-middle text-center font-weight-bold text-success">06/09/2019</td>
     </tr>
     <tr style="font-size: 1.3em;">
     <td colspan="1" class=""><b>IX.</b> Mejores prácticas y estándares.</td>
     <td class="align-middle text-center font-weight-bold text-secondary">10/02/2020</td>
     <td class="align-middle text-center font-weight-bold text-secondary">23/02/2020</td>
     </tr>
     <tr style="font-size: 1.3em;">
     <td colspan="1" class=""><b>X.</b> Control de actividades y procesos.</td>
     <td class="align-middle text-center font-weight-bold text-success">01/09/2019</td>
     <td class="align-middle text-center font-weight-bold text-success">20/09/2019</td>
     </tr>
     <tr style="font-size: 1.3em;">
     <td colspan="1" class=""><b>XI.</b> Integridad mecánica y aseguramiento de la calidad.</td>
     <td class="align-middle text-center font-weight-bold text-secondary">24/02/2020</td>
     <td class="align-middle text-center font-weight-bold text-secondary">28/03/2020</td>
     </tr>
     <tr style="font-size: 1.3em;">
     <td colspan="1" class=""><b>XII.</b> Seguridad de contratistas. </td>
     <td class="align-middle text-center font-weight-bold text-secondary">01/11/2019</td>
     <td class="align-middle text-center font-weight-bold text-secondary">24/11/2019</td>
     </tr>
     <tr style="font-size: 1.3em;">
     <td colspan="1" class=""><b>XIII.</b> Preparación y respuesta a emergencias.</td>
     <td class="align-middle text-center font-weight-bold text-secondary">26/04/2020</td>
     <td class="align-middle text-center font-weight-bold text-secondary">15/05/2020</td>
     </tr>
     <tr style="font-size: 1.3em;">
     <td colspan="1" class=""><b>XIV.</b> Monitoreo, verificación y evaluación.</td>
     <td class="align-middle text-center font-weight-bold text-secondary">07/06/2020</td>
     <td class="align-middle text-center font-weight-bold text-secondary">03/07/2020</td>
     </tr>
     <tr style="font-size: 1.3em;">
     <td colspan="1" class=""><b>XV.</b> Auditorias.</td>
     <td class="align-middle text-center font-weight-bold text-secondary">29/12/2019</td>
     <td class="align-middle text-center font-weight-bold text-secondary">02/02/2020</td>
     </tr>
     <tr style="font-size: 1.3em;">
     <td colspan="1" class=""><b>XVI.</b> Investigación de incidentes y accidentes. </td>
     <td class="align-middle text-center font-weight-bold text-secondary">16/04/2020</td>
     <td class="align-middle text-center font-weight-bold text-secondary">16/06/2020</td>
     </tr>
     <tr style="font-size: 1.3em;">
     <td colspan="1" class=""><b>XVIII.</b> Informes de desempeño.</td>
     <td class="align-middle text-center font-weight-bold text-secondary">04/08/2020</td>
     <td class="align-middle text-center font-weight-bold text-secondary">29/09/2020</td>
     </tr>
   </table>
  </div>


    <?php }else if($session_nomestacion == "Xochimilco") { ?>

<div style="overflow-y: hidden;">
    <table class="table table-bordered table-sm mb-0 pb-0">
   <tr style="background: #F8F8F8">
    <td class="font-weight-bold align-middle text-center" style="font-size: 1.4em;">Programa de implementación del Sistema de Administración</td>
    <td class="align-middle text-center" colspan="3" style="font-size: 1.4em;"><b>Fecha:</b> 04-Diciembre-18</td>
   </tr>
   <tr style="background: #F8F8F8">
     <td class="align-middle text-center" style="font-size: 1.4em;"><b>Realizado por:</b> Nelly Garcia Estrada</td>
     <td class="align-middle text-center" style="font-size: 1.4em;"><b>Revisado por:</b> Eduardo Galicia Flores</td>
     <td class="align-middle text-center" style="font-size: 1.4em;"><b>Aprobado por:</b> Tomas Tarno Quinzaños</td>
   </tr>
   <tr class="table-active">
     <td class="align-middle text-center font-weight-bold" style="font-size: 1.4em;">Actividad</td>
     <td class="align-middle text-center font-weight-bold" style="font-size: 1.4em;">Fecha de Inicio</td>
     <td class="align-middle text-center font-weight-bold" style="font-size: 1.4em;">Fecha de Termino</td>
   </tr>
   <!----------->
    <tr style="font-size: 1.3em;">
     <td colspan="1" class=""><b>II.</b> Identificación de peligros y aspectos ambientales, análisis de riesgo y evaluación de impactos ambientales.</td>
     <td class="align-middle text-center font-weight-bold text-secondary">05/09/2019</td>
     <td class="align-middle text-center font-weight-bold text-secondary">25/09/2019</td>
     </tr>
     <tr style="font-size: 1.3em;">
     <td colspan="1" class=""><b>III.</b> Requisitos legales.</td>
     <td class="align-middle text-center font-weight-bold text-secondary">01/03/2019</td>
     <td class="align-middle text-center font-weight-bold text-secondary">31/04/2019</td>
     </tr>
     <tr style="font-size: 1.3em;">
     <td colspan="1" class=""><b>IV.</b> Objetivos, metas, indicadores</td>
     <td class="align-middle text-center font-weight-bold text-success">01/02/2019</td>
     <td class="align-middle text-center font-weight-bold text-success">24/03/2019</td>
     </tr>
     <tr style="font-size: 1.3em;">
     <td colspan="1" class=""><b>V.</b> Funciones, responsabilidades y autoridad.</td>
     <td class="align-middle text-center font-weight-bold text-secondary">14/02/2019</td>
     <td class="align-middle text-center font-weight-bold text-secondary">27/02/2019</td>
     </tr>
     <tr style="font-size: 1.3em;">
     <td colspan="1" class=""><b>VI.</b> Competencia del personal, capacitación y entrenamiento.</td>
     <td class="align-middle text-center font-weight-bold text-secondary">28/02/2019</td>
     <td class="align-middle text-center font-weight-bold text-secondary">09/07/2019</td>
     </tr>
     <tr style="font-size: 1.3em;">
     <td colspan="1" class=""><b>VII.</b> Comunicación, participación y consulta.</td>
     <td class="align-middle text-center font-weight-bold text-success">01/02/2019</td>
     <td class="align-middle text-center font-weight-bold text-success">06/02/2019</td>
     </tr>
     <tr style="font-size: 1.3em;">
     <td colspan="1" class=""><b>VIII.</b> Control de documentos y registros.</td>
     <td class="align-middle text-center font-weight-bold text-success">01/02/2019</td>
     <td class="align-middle text-center font-weight-bold text-success">13/02/2019</td>
     </tr>
     <tr style="font-size: 1.3em;">
     <td colspan="1" class=""><b>IX.</b> Mejores prácticas y estándares.</td>
     <td class="align-middle text-center font-weight-bold text-secondary">10/07/2019</td>
     <td class="align-middle text-center font-weight-bold text-secondary">23/07/2019</td>
     </tr>
     <tr style="font-size: 1.3em;">
     <td colspan="1" class=""><b>X.</b> Control de actividades y procesos.</td>
     <td class="align-middle text-center font-weight-bold text-success">01/02/2019</td>
     <td class="align-middle text-center font-weight-bold text-success">20/02/2019</td>
     </tr>
     <tr style="font-size: 1.3em;">
     <td colspan="1" class=""><b>XI.</b> Integridad mecánica y aseguramiento de la calidad.</td>
     <td class="align-middle text-center font-weight-bold text-secondary">24/07/2019</td>
     <td class="align-middle text-center font-weight-bold text-secondary">04/09/2019</td>
     </tr>
     <tr style="font-size: 1.3em;">
     <td colspan="1" class=""><b>XII.</b> Seguridad de contratistas. </td>
     <td class="align-middle text-center font-weight-bold text-secondary">01/04/2019</td>
     <td class="align-middle text-center font-weight-bold text-secondary">24/04/2019</td>
     </tr>
     <tr style="font-size: 1.3em;">
     <td colspan="1" class=""><b>XIII.</b> Preparación y respuesta a emergencias.</td>
     <td class="align-middle text-center font-weight-bold text-secondary">26/09/2019</td>
     <td class="align-middle text-center font-weight-bold text-secondary">15/10/2019</td>
     </tr>
     <tr style="font-size: 1.3em;">
     <td colspan="1" class=""><b>XIV.</b> Monitoreo, verificación y evaluación.</td>
     <td class="align-middle text-center font-weight-bold text-secondary">07/11/2019</td>
     <td class="align-middle text-center font-weight-bold text-secondary">03/12/2019</td>
     </tr>
     <tr style="font-size: 1.3em;">
     <td colspan="1" class=""><b>XV.</b> Auditorias.</td>
     <td class="align-middle text-center font-weight-bold text-secondary">29/05/2019</td>
     <td class="align-middle text-center font-weight-bold text-secondary">02/07/2019</td>
     </tr>
     <tr style="font-size: 1.3em;">
     <td colspan="1" class=""><b>XVI.</b> Investigación de incidentes y accidentes. </td>
     <td class="align-middle text-center font-weight-bold text-secondary">16/09/2019</td>
     <td class="align-middle text-center font-weight-bold text-secondary">16/11/2019</td>
     </tr>
     <tr style="font-size: 1.3em;">
     <td colspan="1" class=""><b>XVIII.</b> Informes de desempeño.</td>
     <td class="align-middle text-center font-weight-bold text-secondary">04/12/2019</td>
     <td class="align-middle text-center font-weight-bold text-secondary">29/01/2020</td>
     </tr>
   </table>
</div>

    <?php }else if($session_nomestacion == "Interlomas" || $session_nomestacion == "Palo Solo" || $session_nomestacion == "San Agustin" || $session_nomestacion == "Gasomira" || $session_nomestacion == "Valle de Guadalupe" || $session_nomestacion == "Esmegas"){?>

<div style="overflow-y: hidden;">
    <table class="table table-bordered table-sm mb-0 pb-0">
    <tr style="background: #F8F8F8">
     <td class="font-weight-bold align-middle text-center" style="font-size: 1.4em;">Programa de implementación del Sistema de Administración</td> 
     <td class="align-middle text-center" colspan="3" style="font-size: 1.4em;"><b>Fecha:</b> 04-Diciembre-18</td>
    </tr>
    <tr style="background: #F8F8F8">
      <td class="align-middle text-center" style="font-size: 1.4em;"><b>Realizado por:</b> Nelly Garcia Estrada</td>
      <td class="align-middle text-center" style="font-size: 1.4em;"><b>Revisado por:</b> Eduardo Galicia Flores</td>
      <td class="align-middle text-center" style="font-size: 1.4em;"><b>Aprobado por:</b> Tomas Tarno Quinzaños</td>
    </tr>
    <tr class="table-active">
      <td class="align-middle text-center font-weight-bold" style="font-size: 1.4em;">Actividad</td>
      <td class="align-middle text-center font-weight-bold" style="font-size: 1.4em;">Fecha de Inicio</td>
      <td class="align-middle text-center font-weight-bold" style="font-size: 1.4em;">Fecha de Termino</td>
    </tr>
    <!----------->
     <tr style="font-size: 1.3em;">
      <td colspan="1" class=""><b>II.</b> Identificación de peligros y aspectos ambientales, análisis de riesgo y evaluación de impactos ambientales.</td>
      <td class="align-middle text-center font-weight-bold text-secondary">05/08/2019</td>
      <td class="align-middle text-center font-weight-bold text-secondary">25/08/2019</td>
      </tr>
      <tr style="font-size: 1.3em;">
      <td colspan="1" class=""><b>III.</b> Requisitos legales.</td>
      <td class="align-middle text-center font-weight-bold text-success">01/02/2019</td>
      <td class="align-middle text-center font-weight-bold text-success">31/03/2019</td>
      </tr>
      <tr style="font-size: 1.3em;">
      <td colspan="1" class=""><b>IV.</b> Objetivos, metas, indicadores</td>
      <td class="align-middle text-center font-weight-bold text-success">01/01/2019</td>
      <td class="align-middle text-center font-weight-bold text-success">24/02/2019</td>
      </tr>
      <tr style="font-size: 1.3em;">
      <td colspan="1" class=""><b>V.</b> Funciones, responsabilidades y autoridad.</td>
      <td class="align-middle text-center font-weight-bold text-success">14/01/2019</td>
      <td class="align-middle text-center font-weight-bold text-success">27/01/2019</td>
      </tr>
      <tr style="font-size: 1.3em;">
      <td colspan="1" class=""><b>VI.</b> Competencia del personal, capacitación y entrenamiento.</td>
      <td class="align-middle text-center font-weight-bold text-success">28/01/2019</td>
      <td class="align-middle text-center font-weight-bold text-success">09/06/2019</td>
      </tr>
      <tr style="font-size: 1.3em;">
      <td colspan="1" class=""><b>VII.</b> Comunicación, participación y consulta.</td>
      <td class="align-middle text-center font-weight-bold text-success">01/01/2019</td>
      <td class="align-middle text-center font-weight-bold text-success">06/01/2019</td>
      </tr>
      <tr style="font-size: 1.3em;">
      <td colspan="1" class=""><b>VIII.</b> Control de documentos y registros.</td>
      <td class="align-middle text-center font-weight-bold text-success">01/01/2019</td>
      <td class="align-middle text-center font-weight-bold text-success">13/01/2019</td>
      </tr>
      <tr style="font-size: 1.3em;">
      <td colspan="1" class=""><b>IX.</b> Mejores prácticas y estándares.</td>
      <td class="align-middle text-center font-weight-bold text-secondary">10/06/2019</td>
      <td class="align-middle text-center font-weight-bold text-secondary">23/06/2019</td>
      </tr>
      <tr style="font-size: 1.3em;">
      <td colspan="1" class=""><b>X.</b> Control de actividades y procesos.</td>
      <td class="align-middle text-center font-weight-bold text-success">01/01/2019</td>
      <td class="align-middle text-center font-weight-bold text-success">20/01/2019</td>
      </tr>
      <tr style="font-size: 1.3em;">
      <td colspan="1" class=""><b>XI.</b> Integridad mecánica y aseguramiento de la calidad.</td>
      <td class="align-middle text-center font-weight-bold text-secondary">24/06/2019</td>
      <td class="align-middle text-center font-weight-bold text-secondary">04/08/2019</td>
      </tr>
      <tr style="font-size: 1.3em;">
      <td colspan="1" class=""><b>XII.</b> Seguridad de contratistas. </td>
      <td class="align-middle text-center font-weight-bold text-secondary">01/03/2019</td>
      <td class="align-middle text-center font-weight-bold text-secondary">24/03/2019</td>
      </tr>
      <tr style="font-size: 1.3em;">
      <td colspan="1" class=""><b>XIII.</b> Preparación y respuesta a emergencias.</td>
      <td class="align-middle text-center font-weight-bold text-secondary">26/08/2019</td>
      <td class="align-middle text-center font-weight-bold text-secondary">15/09/2019</td>
      </tr>
      <tr style="font-size: 1.3em;">
      <td colspan="1" class=""><b>XIV.</b> Monitoreo, verificación y evaluación.</td>
      <td class="align-middle text-center font-weight-bold text-secondary">07/10/2019</td>
      <td class="align-middle text-center font-weight-bold text-secondary">03/11/2019</td>
      </tr>
      <tr style="font-size: 1.3em;">
      <td colspan="1" class=""><b>XV.</b> Auditorias.</td>
      <td class="align-middle text-center font-weight-bold text-secondary">29/04/2019</td>
      <td class="align-middle text-center font-weight-bold text-secondary">02/06/2019</td>
      </tr>
      <tr style="font-size: 1.3em;">
      <td colspan="1" class=""><b>XVI.</b> Investigación de incidentes y accidentes. </td>
      <td class="align-middle text-center font-weight-bold text-secondary">16/08/2019</td>
      <td class="align-middle text-center font-weight-bold text-secondary">16/10/2019</td>
      </tr>
      <tr style="font-size: 1.3em;">
      <td colspan="1" class=""><b>XVIII.</b> Informes de desempeño.</td>
      <td class="align-middle text-center font-weight-bold text-secondary">04/11/2019</td>
      <td class="align-middle text-center font-weight-bold text-secondary">29/12/2019</td>
      </tr>
    </table>  
    </div> 

    <?php } ?>
    </div>

    </div>

  <script src="<?php echo RUTA_JS ?>bootstrap.min.js"></script>
  </body>
  </html>
