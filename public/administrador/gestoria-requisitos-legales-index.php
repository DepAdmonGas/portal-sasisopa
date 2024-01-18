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
  background: white;
  background: url('imgs/iconos/load-index-img.gif') 50% 50% no-repeat rgb(255,255,255);
  }
  </style>
  <script type="text/javascript">
  $(document).ready(function(){
  $('[data-toggle="tooltip"]').tooltip();
  $(".LoaderPage").fadeOut("slow");

    ListaDependencias();
  ListaMuAlEs();
  ListaNivelGob();
  ListaRequisitos();

  });
  function regresarP(){
   window.history.back();
  }

  function ListaDependencias(){
  $('#DivListaDependencias').load('../public/administrador/vistas/lista-configuracion-dependencias.php');
  }
  function ListaMuAlEs(){
  $('#DivListaMuAlEs').load('../public/administrador/vistas/lista-configuracion-munalcest.php');
  }

  function ListaNivelGob(){
  $('#DivListaNivelGo').load('../public/administrador/vistas/lista-configuracion-nivel-gobierno.php');    
  } 

  function ListaRequisitos(){
  $('#DivListaRequisitos').load('../public/administrador/vistas/lista-configuracion-requisitos-legales.php');    
  }
  //-----------------------------------------------------------------------------------------------------
  function DetalleMantenimiento(){
  $('#ModalConfiguracion').modal('show');
  $('#DivConfiguracion').load('../public/administrador/vistas/modal-nivel-gobierno.php');
  }
 
  function AgregarNG(){

  var Detalle =  $('#Detalle').val();

  if (Detalle != "") {
  $('#Detalle').css('border',''); 

  var parametros = {
  "Detalle" : Detalle
  };

  $.ajax({
  data:  parametros,
  url:   '../public/administrador/agregar/agregar-nivel-gobierno.php',
  type:  'post',
  beforeSend: function() {
  },
  complete: function(){
  },
  success:  function (response) {
  ListaNivelGob();
  $('#ModalConfiguracion').modal('hide');
  }
  });

  }else{
  $('#Detalle').css('border','2px solid #A52525');   
  }

  }

  function EliminarNG(id){

  var parametros = {
  "id" : id
  };

   alertify.confirm('',
 function(){ 

  $.ajax({
  data:  parametros,
  url:   '../public/administrador/eliminar/eliminar-nivel-gobierno.php',
  type:  'post',
  beforeSend: function() {
  },
  complete: function(){
  },
  success:  function (response) {

  if (response == 1){
  ListaNivelGob();  
  }else{
  alertify.error('Error al eliminar');  
  }
  
  }
  });

    },
 function(){

 }).setHeader('Mensaje').set({transition:'zoom',message: '¿Desea eliminar la información seleccionada?',labels:{ok:'Aceptar', cancel: 'Cancelar'}}).show();

  }
  //-----------------------------------------------------------------------------------------------------

  function DetalleMuAlEs(){
  $('#ModalConfiguracion').modal('show');
  $('#DivConfiguracion').load('../public/administrador/vistas/modal-municipio-alcaldia-estado.php');
  }

  function AgregarMAE(){

  var Detalle =  $('#Detalle').val();

  if (Detalle != "") {
  $('#Detalle').css('border',''); 

  var parametros = {
  "Detalle" : Detalle
  };

  $.ajax({
  data:  parametros,
  url:   '../public/administrador/agregar/agregar-municipio-alcaldia-estado.php',
  type:  'post',
  beforeSend: function() {
  },
  complete: function(){
  },
  success:  function (response) {
  ListaMuAlEs();
  $('#ModalConfiguracion').modal('hide');
  }
  });

  }else{
  $('#Detalle').css('border','2px solid #A52525');   
  }

  }

    function EliminarMAE(id){

  var parametros = {
  "id" : id
  };

 alertify.confirm('',
 function(){

  $.ajax({
  data:  parametros,
  url:   '../public/administrador/eliminar/eliminar-municipio-alcaldia-estado.php',
  type:  'post',
  beforeSend: function() {
  },
  complete: function(){
  },
  success:  function (response) {

  if (response == 1){
  ListaMuAlEs();  
  }else{
  alertify.error('Error al eliminar');  
  }
  
  }
  });

  },
 function(){

 }).setHeader('Mensaje').set({transition:'zoom',message: 'Desea eliminar la información seleccionada',labels:{ok:'Aceptar', cancel: 'Cancelar'}}).show();

  }

  //----------------------------------------------------------------------------------------------

  function DetalleDependencias(){
  $('#ModalConfiguracion').modal('show');
  $('#DivConfiguracion').load('../public/administrador/vistas/modal-dependencias.php'); 
  }

  function AgregarD(){
   var Detalle =  $('#Detalle').val();

  if (Detalle != "") {
  $('#Detalle').css('border',''); 

  var parametros = {
  "Detalle" : Detalle
  };

  $.ajax({
  data:  parametros,
  url:   '../public/administrador/agregar/agregar-dependencias.php',
  type:  'post',
  beforeSend: function() {
  },
  complete: function(){
  },
  success:  function (response) {
  ListaDependencias();
  $('#ModalConfiguracion').modal('hide');
  }
  });

  }else{
  $('#Detalle').css('border','2px solid #A52525');   
  } 
  }

  function EliminarD(id){
  var parametros = {
  "id" : id
  };

   alertify.confirm('',
 function(){

  $.ajax({
  data:  parametros,
  url:   '../public/administrador/eliminar/eliminar-dependencias.php',
  type:  'post',
  beforeSend: function() {
  },
  complete: function(){
  },
  success:  function (response) {

  if (response == 1){
  ListaDependencias();  
  }else{
  alertify.error('Error al eliminar');  
  }
  
  }
  });

    },
 function(){

 }).setHeader('Mensaje').set({transition:'zoom',message: 'Desea eliminar la información seleccionada',labels:{ok:'Aceptar', cancel: 'Cancelar'}}).show();

  }
  //---------------------------------------------------------------------------------------

  function DetalleRL(){
  $('#ModalConfiguracion').modal('show');
  $('#DivConfiguracion').load('../public/administrador/vistas/modal-requisito-legal.php'); 
  }

  function AgregarRL(){

var NivelG = $('#NivelG').val();
var MuAlEs = $('#MuAlEs').val();
var Dependencia = $('#Dependencia').val();
var Permiso = $('#Permiso').val();
var Fundamento = $('#Fundamento').val();

  var parametros = {
  "NivelG" : NivelG,
  "MuAlEs" : MuAlEs,
  "Dependencia" : Dependencia,
  "Permiso" : Permiso,
  "Fundamento" : Fundamento
  };

  $.ajax({
  data:  parametros,
  url:   '../public/administrador/agregar/agregar-requisitos-legales.php',
  type:  'post',
  beforeSend: function() {
  },
  complete: function(){
  },
  success:  function (response) {
  ListaRequisitos();
  $('#ModalConfiguracion').modal('hide');
  }
  });

  }

  function EliminarRL(id){
   var parametros = {
  "id" : id
  };

 alertify.confirm('',
 function(){

  $.ajax({
  data:  parametros,
  url:   '../public/administrador/eliminar/eliminar-requisitos-legales.php',
  type:  'post',
  beforeSend: function() {
  },
  complete: function(){
  },
  success:  function (response) {

  if (response == 1){
  ListaRequisitos();  
  }else{
  alertify.error('Error al eliminar');  
  }
  
  }
  }); 

   },
 function(){

 }).setHeader('Mensaje').set({transition:'zoom',message: 'Desea eliminar la información seleccionada',labels:{ok:'Aceptar', cancel: 'Cancelar'}}).show();

  }
  //---------------------------------------------------------------------------------------------------

  function ModalEditarRL(idRequisito){

  $('#ModalConfiguracion').modal('show');
  $('#DivConfiguracion').load('../public/administrador/vistas/modal-editar-personal-requisito-legal.php?idRequisito=' + idRequisito); 

   }

   function EditarPersonalRL(idRequisito){

    var NivelG = $('#NivelG').val();
    var MuAlEs = $('#MuAlEs').val();
    var Dependencia = $('#Dependencia').val();
    var Permiso = $('#Permiso').val();
    var IdPersonal = $('#IdPersonal').val();

      var parametros = {
      "idRequisito" : idRequisito,
      "NivelG" : NivelG,
      "MuAlEs" : MuAlEs,
      "Dependencia" : Dependencia,
      "Permiso" : Permiso,
      "IdPersonal" : IdPersonal
      };

  alertify.confirm('',
 function(){

  $.ajax({
  data:  parametros,
  url:   '../public/administrador/editar/editar-personal-requisitos-legales.php',
  type:  'post',
  beforeSend: function() {
  },
  complete: function(){
  },
  success:  function (response) {

  if (response == 1){
  $('#DivConfiguracion').load('../public/administrador/vistas/modal-editar-personal-requisito-legal.php?idRequisito=' + idRequisito); 
  ListaRequisitos();
  }else{
  alertify.error('Error al editar');  
  }
  
  }
  }); 

   },
 function(){

 }).setHeader('Mensaje').set({transition:'zoom',message: 'Desea editar la información seleccionada',labels:{ok:'Aceptar', cancel: 'Cancelar'}}).show();

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
    <div class="float-left"><h4>CONFIGURACIÓN REQUISITOS LEGALES</h4></div>
    </div>
    <div class="card-body">

        <div class="row">

<div class="col-xl-4 col-lg-4 col-md-4 col-sm-12 mb-2 "> 

            <div class="border p-2 mb-3">
            <div class="p-2 border-bottom">

            <div class="row">

            <div class="col-10">
              <h5>Nivel de gobierno</h5>
            </div>

            <div class="col-2">
              <button type="button" class="btn btn-primary btn-sm rounded-0 float-right" onclick="DetalleMantenimiento()">+</button>
            </div>

            </div>
            </div>
            <div id="DivListaNivelGo"></div>
            </div>




            <div class="border p-2 mb-3">
            <div class="p-2 border-bottom">
            
            <div class="row">

            <div class="col-9">
              <h5>Municipio, Alcaldía y Estado </h5>
            </div>

            <div class="col-3">
              <button type="button" class="btn btn-primary btn-sm rounded-0 float-right" onclick="DetalleMuAlEs()">+</button>

            </div>

          </div>

            </div>

            <div id="DivListaMuAlEs"></div>
            </div>

            <div class="border p-2 mb-3">
            <div class="p-2 border-bottom">
           
            <div class="row">
            <div class="col-10">
              <h5>Dependencias</h5>
            </div>

             <div class="col-2">
              <button type="button" class="btn btn-primary btn-sm rounded-0 float-right" onclick="DetalleDependencias()">+</button>
            </div>

          </div>

            </div>
            <div id="DivListaDependencias"></div>
            </div>

      </div>



<div class="col-xl-8 col-lg-8 col-md-8 col-sm-12 mb-2"> 
          
            <div class="border p-2">
            <div class="p-2 border-bottom">
            

            <div class="row">
            <div class="col-10">
              <h5>Requisitos Legales</h5>
            </div>


            <div class="col-2">
              <button type="button" class="btn btn-primary btn-sm rounded-0 float-right" onclick="DetalleRL()">+</button>
            </div>

          </div>

            </div>
            <div id="DivListaRequisitos"></div>
            </div>

</div>

    </div>

    </div>
    </div>
    </div>
    </div>
    </div>

    </div>
    </div>
    </div>
    </div>
    </div>

  <div class="modal fade bd-example-modal-lg" id="ModalConfiguracion" >
  <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
  <div class="modal-content" style="border-radius: 0px;border: 0px;">
  <div id="DivConfiguracion"></div>
  </div>
  </div>
  </div>


  <script src="<?php echo RUTA_JS ?>bootstrap.min.js"></script>
  </body>
  </html>
