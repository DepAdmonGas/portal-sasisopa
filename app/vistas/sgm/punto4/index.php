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
  <link href="https://cdn.datatables.net/v/bs5/jszip-3.10.1/dt-2.0.3/b-3.0.1/b-colvis-3.0.1/b-html5-3.0.1/b-print-3.0.1/datatables.min.css" rel="stylesheet">
  <style media="screen">
  .LoaderPage {
  position: fixed;
  left: 0px;
  top: 0px; 
  width: 100%;
  height: 100%; 
  z-index: 9999;
  background: white;
  background: url('imgs/iconos/load-img.gif') 50% 50% no-repeat rgb(249,249,249);
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
    let targets = [1,2,3];
  $('#ListaAsistencia').load('app/vistas/sasisopa/asistencia/lista-asistencia.php?idSasisopa=' + idSasisopa, function() {
  $('#lista-asistencia').DataTable({
    "language": {
    "url": "<?=RUTA_JS?>es-ES.json"
  },
  "stateSave": true,
    "lengthMenu": [15,35,45],
    "columnDefs": [
    { "orderable": false, "targets": targets },
    { "searchable": false, "targets": targets }
    ]
  });
  });  
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
    ListaAsistencia(104)
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
    let targets = [1,2,3];
  $('#ListaSeguimientoObjetivoIndicadores').load('app/vistas/sgm/punto4/lista-seguimiento-objetivo-indicadores.php', function() {
  $('#table-seguimiento-objetivo-indicadores').DataTable({
    "language": {
    "url": "<?=RUTA_JS?>es-ES.json"
  },
  "stateSave": true,
    "lengthMenu": [15,35,45],
    "columnDefs": [
    { "orderable": false, "targets": targets },
    { "searchable": false, "targets": targets }
    ]
  });
  });  
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
      <li aria-current="page" class="breadcrumb-item active">4. Establecimiento de objetivos enfocados al cliente</li>
      </ol>
      </div>
      <!-- Fin -->

      <h3>4. Establecimiento de objetivos enfocados al cliente</h3>

      <div class="bg-white mt-3 p-3">

      <h5 class="text-secondary">Objetivos generales</h5>
      <ul class="fs-5">
      <li>Implementar los 10 procedimientos del Sistema de Gestión de medición en la estación de Servicio durante 2024 para la correcta cuantificación de petrolíferos.</li>
      <li>Mantener los equipos de medición dentro de las fechas de calibración durante el 2024.</li>
      <li>Disminuir el 30% de reclamaciones por suministro de combustibles a nuestros clientes en el segundo semestre del 2024.</li>
      </ul>

      </div>

      <div class="mt-3">
      <div class="row">
      <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12 mt-2 mb-2">
        <div class="bg-white">
        <div class="p-3">        
        <div class="row">
        <div class="col-10">
        <h5 class="text-secondary">Fo.SGM.001 Lista de asistencia</h5>
        </div>
        <div class="col-2">
        <a class="float-end" onclick="btnListaAsistencia(104,2)" style="cursor: pointer;" data-toggle="tooltip" data-placement="left" title="Crear" >
        <img src="<?php echo RUTA_IMG_ICONOS."agregar.png"; ?>">
        </a>
        </div>
        </div>
        <div id="ListaAsistencia"></div>
        </div>
      </div>
    </div>

    <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12 mt-2 mb-2">
        <div class="bg-white">
        <div class="p-3">        
        <div class="row">
        <div class="col-10">
        <h5 class="text-secondary">Fo.SGM.004 Seguimiento de objetivos e indicadores </h5>
        </div>
        <div class="col-2">
        <a class="float-end" onclick="btnSeguridadIndicadores()" style="cursor: pointer;" data-toggle="tooltip" data-placement="left" title="Crear" >
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

    <div class="modal fade bd-example-modal-lg" id="myModal" data-backdrop="static">
    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
      <div class="modal-content border-0 rounded-0">
      <div class="modal-header rounded-0 head-modal">
      <h4 class="modal-title text-white">Ayuda</h4>
      <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
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
  <!---------- LIBRERIAS DEL DATATABLE ---------->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/pdfmake.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/vfs_fonts.js"></script>
  <script src="https://cdn.datatables.net/v/bs5/jszip-3.10.1/dt-2.0.3/b-3.0.1/b-colvis-3.0.1/b-html5-3.0.1/b-print-3.0.1/datatables.min.js"></script>
  </body>
  </html>
