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
  <link rel="stylesheet" href="<?=RUTA_CSS?>bootstrap-select.css">
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

  ListaAsistencia(104);
  ListaSeguimientoObjetivoIndicadores();

  });


  function regresarP(){
  window.history.back();
  }

  function btnAyuda(){
  $('#myModal').modal('show');
  }

  function ListaAsistencia(idSasisopa){
  $('#ListaAsistencia').load('app/vistas/sasisopa/asistencia/lista-asistencia.php?idSasisopa=' + idSasisopa); 
  }

  function btnListaAsistencia(elemento,herramienta){
  var parametros = {
   "accion" : "agregar-lista-asistencia",
   "PuntoSasisopa" : elemento,
   "herramienta" : herramienta
   };

    $.ajax({
    data:  parametros,
   url:   'app/controlador/AsistenciaControlador.php',
   type:  'post',
   beforeSend: function() {
   },
   complete: function(){
   },
   success:  function (response) {

    if(response != 0){
     window.location = "lista-asistencia/" + response;
    }else{
     alertify.error('Error al crear registro'); 
    }

   
   }
   });
  }

function EditarAsistencia(id){
window.location = "lista-asistencia/" + id; 
}

  function DescargarAsistencia(id){
  window.location = "descargar-lista-asistencia-sgm/" + id;   
  }

  function EliminarAsistencia(id){

  var parametros = {
    "accion" : "eliminar-lista-asistencia",
    "id" : id
    };


  alertify.confirm('',
  function(){


 $.ajax({
     data:  parametros,
     url:   'app/controlador/AsistenciaControlador.php',
     type:  'post',
     beforeSend: function() {
     },
     complete: function(){
    
     },
     success:  function (response) {

    if (response == 1) {
    ListaAsistencia(101)
    }else{
    alertify.error('Error al eliminar')
    }

     }
     });
    
  },
  function(){
  }).setHeader('Lista de asistencia').set({transition:'zoom',message: '¿Desea eliminar la lista de asistencia de la estación?',labels:{ok:'Aceptar', cancel: 'Cancelar'}}).show();
  }

  //-----------------------------------------------------------------

  function ListaSeguimientoObjetivoIndicadores(){
  $('#ListaSeguimientoObjetivoIndicadores').load('app/vistas/sgm/punto4/lista-seguimiento-objetivo-indicadores.php'); 
  }

  function btnSeguridadIndicadores(){

  $.ajax({
   url:   'app/vistas/sgm/punto4/agregar-seguimiento-objetivos-indicadores.php',
   type:  'post',
   beforeSend: function() {
   },
   complete: function(){
   },
   success:  function (response) {

    if(response != 0){
     window.location = "seguimiento-objetivos-indicadores/" + response;
    }else{
     alertify.error('Error al crear registro'); 
    }

   
   }
   });

  }

  function EditarSeguimiento(id){
    window.location = "seguimiento-objetivos-indicadores/" + id;
  }

    function EliminarSeguimiento(id){

  var parametros = {
    "id" : id
    };


  alertify.confirm('',
  function(){


 $.ajax({
     data:  parametros,
     url:   'app/vistas/sgm/punto4/eliminar-seguimiento-objetivos-indicadores.php',
     type:  'post',
     beforeSend: function() {
     },
     complete: function(){
    
     },
     success:  function (response) {

    if (response == 1) {
    ListaSeguimientoObjetivoIndicadores()
    }else{
    alertify.error('Error al eliminar')
    }

     }
     });
    
  },
  function(){
  }).setHeader('Mensaje').set({transition:'zoom',message: '¿Desea eliminar el seguimiento de objetivos e indicadores de la estación?',labels:{ok:'Aceptar', cancel: 'Cancelar'}}).show();
  }

function DescargarSeguimiento(id){
window.location = "descargar-seguimiento-objetivos-indicadores/" + id;
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
    <div class="float-left"><h4>4. Establecimiento de objetivos enfocados al cliente</h4></div>
    <div class="float-right" style="margin-top: 6px;margin-left: 10px;">
    <a onclick="btnAyuda()" style="cursor: pointer;" data-toggle="tooltip" data-placement="left" title="Ayuda" >
    <img src="<?php echo RUTA_IMG_ICONOS."info.png"; ?>">
    </a> 
    </div>
    </div>
   
    <div class="card-body">

      <div class="row">
      <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12 mt-2 mb-2">

      <div class="border p-3">
      <p>
      <b>Objetivos generales</b>
      <ul>
        <li>Implementar los 10 procedimientos del Sistema de Gestión de medición en la estación de Servicio durante 2024 para la correcta cuantificación de petrolíferos.</li>
        <li>Mantener los equipos de medición dentro de las fechas de calibración durante el 2024.</li>
        <li>Disminuir el 30% de reclamaciones por suministro de combustibles a nuestros clientes en el segundo semestre del 2024.</li>
      </ul>
    </p>
    </div>
    </div>
    </div>

          <div class="row">
          <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12 mt-2 mb-2">
            <div class="border">
            <div class="p-3">        
            <div class="row">
            <div class="col-10">
            <h5>Fo.SGM.001 Lista de asistencia</h5>
            </div>
            <div class="col-2">
            <a class="float-right" onclick="btnListaAsistencia(104,2)" style="cursor: pointer;" data-toggle="tooltip" data-placement="left" title="Crear" >
            <img src="<?php echo RUTA_IMG_ICONOS."agregar.png"; ?>">
            </a>
            </div>
            </div>
            <div id="ListaAsistencia"></div>
            </div>
          </div>
        </div>

        <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12 mt-2 mb-2">
            <div class="border">
            <div class="p-3">        
            <div class="row">
            <div class="col-10">
            <h5>Fo.SGM.004 Seguimiento de objetivos e indicadores </h5>
            </div>
            <div class="col-2">
            <a class="float-right" onclick="btnSeguridadIndicadores()" style="cursor: pointer;" data-toggle="tooltip" data-placement="left" title="Crear" >
            <img src="<?php echo RUTA_IMG_ICONOS."agregar.png"; ?>">
            </a>
            </div>
            </div>
            <div id="ListaSeguimientoObjetivoIndicadores"></div>
            </div>
          </div>
        </div>
      </div>


    </div>
    </div>
    </div>
    </div>
    </div>

    <div class="modal fade bd-example-modal-lg" id="myModal" data-backdrop="static">
    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
      <div class="modal-content border-0 rounded-0">
      <div class="modal-header">
      <h4 class="modal-title">Ayuda</h4>
      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
      <span aria-hidden="true">&times;</span>
      </button>
      </div>
        <div class="modal-body">

        <p><b>Bienvenido al elemento 4 Establecimiento de objetivos enfocados al cliente</b>, en este elemento deberás analizar los datos obtenidos durante cada año de implementación del SGM, donde deberás identificar los resultados de los siguientes indicadores:</p>
        
        <ul class="ul">
          <li>Implementación del SGM</li>
          <li>Calibración de equipos de medición</li>
          <li>Satisfacción del cliente</li>
        </ul>

        <p>Una vez analizados los resultados, deberás de verificar el % de cumplimiento de acuerdo a las metas propuestas, en caso de tener resultados desfavorables únete con tu equipo y propongan acciones a tomar para que en la siguiente evaluación los resultados sean mejores, no olvides hacer el registro en el formato 004 y dar a conocer al personal involucrado los resultados con el formato 001.</p>
        
        </div>
      </div>
    </div>
  </div>
 
  <script src="<?php echo RUTA_JS ?>bootstrap.min.js"></script>
  </body>
  </html>
