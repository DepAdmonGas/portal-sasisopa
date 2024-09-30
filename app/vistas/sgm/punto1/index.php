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
  background: url('imgs/iconos/load-img.gif') 50% 50% no-repeat rgb(249,249,249);
  }
  </style>
  <script type="text/javascript">
  $(document).ready(function(){
  $('[data-toggle="tooltip"]').tooltip();
  $(".LoaderPage").fadeOut("slow");

  ListaAsistencia(101);
  ListaRevisionSGMPR(101);

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

  //----------------------------------------------------------------

  function ListaRevisionSGMPR(SGM){
  $('#ListaRevisionSGMPR').load('app/vistas/sgm/revision-sgm-procedimientos-registros/lista-revision-sgm-procedimiento-registro.php?SGM=' + SGM); 
  }

  function btnRevisionSGMPR(SGM){

   var parametros = {
   "PuntoSGM" : SGM
   };

    $.ajax({
    data:  parametros,
   url:   'app/vistas/sgm/revision-sgm-procedimientos-registros/agregar-revision-sgm-procedimiento-registro.php',
   type:  'post',
   beforeSend: function() {
   },
   complete: function(){
   },
   success:  function (response) {

     if(response != 0){
     window.location = "revision-sgm-procedimiento-registro/" + response;
    }else{
     alertify.error('Error al crear registro'); 
    }

   
   }
   });

  }

  function EditarRevision(id){
    window.location = "revision-sgm-procedimiento-registro/" + id; 
  }

  function DescargarRevision(id){
    window.location = "descargar-revision-sgm-procedimiento-registro/" + id; 
  }

  function EliminarRevision(id){
    var parametros = {
    "id" : id
    };


  alertify.confirm('',
  function(){


 $.ajax({
     data:  parametros,
     url:   'app/vistas/sgm/revision-sgm-procedimientos-registros/eliminar-revision-sgm.php',
     type:  'post',
     beforeSend: function() {
     },
     complete: function(){
    
     },
     success:  function (response) {

    if (response == 1) {
    ListaRevisionSGMPR(101)
    }else{
    alertify.error('Error al eliminar')
    }

     }
     });
    
  },
  function(){
  }).setHeader('Lista de asistencia').set({transition:'zoom',message: '¿Desea eliminar la resisión del SGM de la estación?',labels:{ok:'Aceptar', cancel: 'Cancelar'}}).show();
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
    <div class="float-left"><h4>1. Estructura del sistema de Medicion</h4></div>

    <div class="float-right" style="margin-top: 6px;margin-left: 10px;">
    <a onclick="btnAyuda()" style="cursor: pointer;" data-toggle="tooltip" data-placement="left" title="Ayuda" >
    <img src="<?php echo RUTA_IMG_ICONOS."info.png"; ?>">
    </a> 
    </div>

    </div>
   
    <div class="card-body">


      <div class="row">
        <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12 mt-2 mb-2">
            <div class="border">
            <div class="p-3">        
            <div class="row">
            <div class="col-10">
            <h5>Fo.SGM.001 Lista de asistencia</h5>
            </div>
            <div class="col-2">
            <a class="float-right" onclick="btnListaAsistencia(101,2)" style="cursor: pointer;" data-toggle="tooltip" data-placement="left" title="Crear" >
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
              <h5>Fo.SGM.002 Revisión del SGM, procedimientos y registros</h5>
            </div>
            <div class="col-2">
            <a class="float-right"onclick="btnRevisionSGMPR(101)" style="cursor: pointer;" data-toggle="tooltip" data-placement="left" title="Crear" >
            <img src="<?php echo RUTA_IMG_ICONOS."agregar.png"; ?>">
            </a>
            </div>
          </div> 
            <div id="ListaRevisionSGMPR"></div>
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
          <p><b>Bienvenido al elemento 1 Estructura del sistema de Medición</b>, en este elemento de manera anual deberás verificar que el SGM cumpla con la legislación vigente requisitando el formato 002 y dando a conocer al personal involucrado (con el formato 001) los cambios en caso de haberlos, de lo contrario solo informar que se realizó la revisión del SGM y cumple. </p>
        </div>
      </div>
    </div>
  </div>

    <script src="<?=RUTA_JS?>bootstrap.min.js"></script>
  </body>
  </html>
