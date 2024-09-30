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

  ListaOrdenServicio();

  });

  function btnAyuda(){
  $('#myModal').modal('show');
  }


  function regresarP(){
  window.history.back();
  }

  function ListaOrdenServicio(){
    $('#ListaOrdenServicio').load('app/vistas/sgm/punto6/lista-orden-servicio.php');
  }

  function modalAgregarOrden(idRegistro,folio){
  $('#modalPrincipal').modal('show');  
  $('#modalContenido').load('app/vistas/sgm/punto6/modal-agregar-orden-servicio.php?idRegistro=' + idRegistro + '&folio=' + folio);
  }

  function GuardarOrden(idRegistro,folio){

    let descripcion = $('#descripcion').val();
    let justificacion = $('#justificacion').val();

    var parametros = {
    "idRegistro" : idRegistro,
    "folio" : folio,
    "descripcion" : descripcion,
    "justificacion" : justificacion
    };

  if (descripcion != "") {
  $('#descripcion').css('border','');
  if (justificacion != "") {
  $('#justificacion').css('border',''); 

     $.ajax({
     data:  parametros,
     url:   'app/vistas/sgm/punto6/agregar-orden-servicio.php',
     type:  'post',
     beforeSend: function() {
     },
     complete: function(){
    
     },
     success:  function (response) {

      ListaOrdenServicio();
      $('#modalPrincipal').modal('hide'); 

     }
     });

  }else{
  $('#justificacion').css('border','2px solid #A52525'); 
  }
  }else{
  $('#descripcion').css('border','2px solid #A52525'); 
  }

  }

  function DetalleOrden(idRegistro){

  $('#modalPrincipal').modal('show');  
  $('#modalContenido').load('app/vistas/sgm/punto6/modal-detalle-orden-servicio.php?idRegistro=' + idRegistro);

  }

  function DescargarOrden(id){
    window.location = "descargar-orden-servicio-sgm/" + id;
  }

  function ModalEditarEvaluacion(idRegistro){
  $('#modalPrincipal').modal('show');  
  $('#modalContenido').load('app/vistas/sgm/punto6/modal-agregar-evaluacion-proveedores.php?idRegistro=' + idRegistro);
  }

  function EditarEvaluacion(e,id,cate){

    var parametros = {
    "id" : id,
    "valor" : e.value,
    "cate" : cate
    };

   $.ajax({
     data:  parametros,
     url:   'app/vistas/sgm/punto6/editar-evaluacion-proveedor.php',
     type:  'post',
     beforeSend: function() {
     },
     complete: function(){
    
     },
     success:  function (response) {


     }
     });

  }


  function GuardarEvaluacion(e,id,cate){

    var parametros = {
    "id" : id,
    "valor" : e,
    "cate" : cate
    };

   $.ajax({
     data:  parametros,
     url:   'app/vistas/sgm/punto6/editar-evaluacion-proveedor.php',
     type:  'post',
     beforeSend: function() {
     },
     complete: function(){

      ListaOrdenServicio();
      $('#modalPrincipal').modal('hide');
    
     },
     success:  function (response) {


     }
     });

  }

  function DetalleEvaluacion(idRegistro){
  $('#modalPrincipal').modal('show');  
  $('#modalContenido').load('app/vistas/sgm/punto6/modal-detalle-evaluacion-proveedores.php?idRegistro=' + idRegistro);
  }

  function DescargarEvaluacion(id){
    window.location = "descargar-evaluacion-proveedores-sgm/" + id;
  }

  function Eliminar(id_servicio){

      var parametros = {
    "id_servicio" : id_servicio
    };


  alertify.confirm('',
  function(){


 $.ajax({
     data:  parametros,
     url:   'app/vistas/sgm/punto6/eliminar-orden-servicio.php',
     type:  'post',
     beforeSend: function() {
     },
     complete: function(){
    
     },
     success:  function (response) {

    if (response == 1) {
    ListaOrdenServicio()
    }else{
    alertify.error('Error al eliminar')
    }

     }
     });
    
  },
  function(){
  }).setHeader('Lista de asistencia').set({transition:'zoom',message: '¿Desea eliminar la información selecionada?',labels:{ok:'Aceptar', cancel: 'Cancelar'}}).show();

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
    <div class="float-left"><h4>Orden de servicio y Evaluación de proveedores</h4></div>

    <div class="float-right">

    <a class="mr-2" onclick="modalAgregarOrden(0,0)" style="cursor: pointer;" data-toggle="tooltip" data-placement="left" title="Agregar" >
    <img src="<?php echo RUTA_IMG_ICONOS."agregar.png"; ?>">
    </a> 

    <a onclick="btnAyuda()" style="cursor: pointer;" data-toggle="tooltip" data-placement="left" title="Ayuda" >
    <img src="<?php echo RUTA_IMG_ICONOS."info.png"; ?>">
    </a> 

    </div>
    </div>
   
    <div class="card-body">

      <div id="ListaOrdenServicio"></div>

    </div>
    </div>
    </div>
    </div>
    </div>

    <div class="modal fade bd-example-modal-lg" id="modalPrincipal" data-backdrop="static">
    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
    <div class="modal-content" style="border-radius: 0px;border: 0px;">
    <div id="modalContenido"></div>
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

        <p>Los proveedores juegan un papel sumamente importante en los procesos el SGM y en la confirmación metrológica, por lo que es nuestra función y responsabilidad verificar que los trabajos sean ejecutados conforme a lo contratado.</p>
        <p>Para dar cumplimiento a este punto siempre que asista un proveedor o prestador de servicios a realizar una actividad a la estación recuerda llenar previamente el formato 012 Orden de servicio.</p>
        <p>Una vez que asista el proveedor a ejecutar el servicio realiza el registro 013 Evaluación de proveedores. Recuerda que una vez que hayas hecho la evaluación el sistema sumará el porcentaje de cumplimiento, en caso de quedar por debajo del 80% no podrá realizar otro servicio y se deberá buscar un nuevo proveedor.</p>
        
      </div>
      </div>
    </div>
  </div>
 
  <script src="<?php echo RUTA_JS ?>bootstrap.min.js"></script>
  </body>
  </html>

