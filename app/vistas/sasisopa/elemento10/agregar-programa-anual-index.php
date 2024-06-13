<?php
require('app/help.php');
include_once "app/modelo/ControlActividadProceso.php";

$class_control_actividad_proceso = new ControlActividadProceso();
$ProgramaYear = $class_control_actividad_proceso->yearProgramaAnual($idReporte);

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
  <script src="<?php echo RUTA_JS ?>printThis.js"></script>
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
  Programaanual();
  });

  function regresarP(){
  window.history.back();   
  }

  function Programaanual(){
   $('#DivProgramanual').html("<img src='<?php echo RUTA_IMG_ICONOS; ?>load-img.gif' style='width: 40px;display:block;margin:auto;' />");
   $('#DivProgramanual').load('../app/vistas/sasisopa/elemento10/lista-programa-anual-mantenimiento.php?idReporte=<?=$idReporte;?>');
   }

  function BtnAgregar(){
  $('#ModalAgregar').modal('show');
  AgregarModal();
  }

  function AgregarModal(){
  $('#ModalContenido').html("<img src='<?php echo RUTA_IMG_ICONOS; ?>load-img.gif' style='width: 40px;display:block;margin:auto;' />");
  $('#ModalContenido').load('../app/vistas/sasisopa/elemento10/modal-agregar-mantenimiento.php?idReporte=<?=$idReporte;?>&Year=<?=$ProgramaYear;?>');
  }

  function SelectEquipo(id){

  var idselect = id.value;

  if (idselect == 43) {

    $("#Periodicidad").prop('disabled', false);
    $("#UltimaFecha").prop('disabled', false);
  }else{
  
    $("#Periodicidad").prop('disabled', true);

  var parametros = {
  "accion" : "buscar-periodicidad",
  "idselect" : idselect
  };

  $.ajax({
    data:  parametros,
    url:   '../app/controlador/ControlActividadProcesoControlador.php',
    type:  'post',
    beforeSend: function() {
    },
    complete: function(){
    },
    success:  function (response) {
    $("#Periodicidad").val(response);
    }
    });

  $("#UltimaFecha").prop('disabled', false);
  }
  }

  function BtnAgregarPrograma(){

var Selectequipo = $('#Selectequipo').val();
var Periodicidad = $('#Periodicidad').val();
var UltimaFecha = $('#UltimaFecha').val();

  if (Selectequipo != "") {
  $('#Selectequipo').css('border',''); 
  if (Periodicidad != "") {
  $('#Periodicidad').css('border','')
  if (UltimaFecha != "") {
  $('#UltimaFecha').css('border',''); 

  var parametros = {
      "accion" : "agregar-equipo-instalacion",
          "idreporte" : <?=$idReporte;?>,
          "id" : Selectequipo,
          "fecha" : UltimaFecha,
          "select" : Periodicidad

        };

     $.ajax({
     data:  parametros,
     url:   '../app/controlador/ControlActividadProcesoControlador.php',
     type:  'post',
     beforeSend: function() {
     },
     complete: function(){
     },
     success:  function (response) {
    alertify.message('Se agrego correctamente el mantenimiento');
    Programaanual();
    $('#ModalAgregar').modal('hide');
     }
     });

  }else{
  $('#UltimaFecha').css('border','2px solid #A52525'); 
  }    
  }else{
  $('#Periodicidad').css('border','2px solid #A52525'); 
  }    
  }else{
  $('#Selectequipo').css('border','2px solid #A52525'); 
  }    

  }

  function EliminarM(id){

  var parametros = {
    "accion" : "eliminar-equipo-instalacion",
    "id" : id
  };

  alertify.confirm('',
  function(){

  $.ajax({
  data:  parametros,
  url:   '../app/controlador/ControlActividadProcesoControlador.php',
  type:  'post',
  beforeSend: function() {

  },
  complete: function(){


  },
  success:  function (response) {

    alertify.message('Se eliminó correctamente el mantenimiento');
    Programaanual();

  }
  });

  },
  function(){
  }).setHeader('Mensaje').set({transition:'zoom',message: 'Desea editar el programa anual de mantenimiento',labels:{ok:'Aceptar', cancel: 'Cancelar'}}).show();

  }

  function EditarM(id){
  $('#ModalEditar').modal('show');
  EditarModal(id);
  }

  function EditarModal(id){
   $('#ModalEditarContenido').load('../app/vistas/sasisopa/elemento10/modal-editar-mantenimiento.php?idReporte=' + id);  
  }

  function BtnEditarPrograma(id){

var Enero = $('#Enero').val();
var Febrero = $('#Febrero').val();
var Marzo = $('#Marzo').val();
var Abril = $('#Abril').val();
var Mayo = $('#Mayo').val();
var Junio = $('#Junio').val();
var Julio = $('#Julio').val();
var Agosto = $('#Agosto').val();
var Septiembre = $('#Septiembre').val();
var Octubre = $('#Octubre').val();
var Noviembre = $('#Noviembre').val();
var Diciembre = $('#Diciembre').val();

  var parametros = {
  "accion" : "editar-equipo-instalacion",
  "id" : id,
  "Enero" : Enero,
  "Febrero" : Febrero,
  "Marzo" : Marzo,
  "Abril" : Abril,
  "Mayo" : Mayo,
  "Junio" : Junio,
  "Julio" : Julio,
  "Agosto" : Agosto,
  "Septiembre" : Septiembre,
  "Octubre" : Octubre,
  "Noviembre" : Noviembre,
  "Diciembre" : Diciembre
  };

  alertify.confirm('',
    function(){

    $.ajax({
     data:  parametros,
     url:   '../app/controlador/ControlActividadProcesoControlador.php',
     type:  'post',
     beforeSend: function() {

     },
     complete: function(){

     },
     success:  function (response) {

      alertify.message('Se edito correctamente el mantenimiento');
      Programaanual();
      $('#ModalEditar').modal('hide');

     }
     });

    },
    function(){
    }).setHeader('Mensaje').set({transition:'zoom',message: 'Desea editar el programa anual de mantenimiento',labels:{ok:'Aceptar', cancel: 'Cancelar'}}).show();

  }

  function Descargar(id){
  window.location = "../descargar-programa-anual-mantenimiento/" + id;  
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
    <div class="float-left"><h4>Programa Anual de Mantenimiento <?=$ProgramaYear;?></h4></div>
    <div class="float-right" style="margin-top: 6px;margin-left: 10px;">
    <a class="ml-2" onclick="Descargar(<?=$idReporte;?>)" style="cursor: pointer;" data-toggle="tooltip" data-placement="left" title="Descargar" >
    <img src="<?php echo RUTA_IMG_ICONOS."pdf.png"; ?>">
    </a>
    <a class="ml-2" onclick="BtnAgregar()" style="cursor: pointer;" data-toggle="tooltip" data-placement="left" title="Agregar" >
    <img src="<?php echo RUTA_IMG_ICONOS."agregar.png"; ?>">
    </a>
    </div>
    <div class="bg-white mt-5 p-3">
    <div id="DivProgramanual"></div>
    </div>

    </div>

    <div class="modal fade bd-example-modal-lg" id="ModalAgregar" data-backdrop="static">
    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
      <div class="modal-content" style="border-radius: 0px;border: 0px;">
        <div class="modal-header">
          <h4 class="modal-title">Agregar equipo o instalación</h4>
           <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
        </div>
        <div class="modal-body">

          <div id="ModalContenido"></div>
      
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" style="border-radius: 0px;" data-dismiss="modal">Cancelar</button>
          <button type="button" class="btn btn-primary" style="border-radius: 0px;" onclick="BtnAgregarPrograma()">Aceptar</button>
        </div>
      </div>
    </div>
    </div>

    <div class="modal fade bd-example-modal-lg" id="ModalEditar" data-backdrop="static">
    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
      <div class="modal-content" style="border-radius: 0px;border: 0px;">
      <div id="ModalEditarContenido"></div>    
      </div>
    </div>
    </div>

  
  <script src="<?php echo RUTA_JS ?>bootstrap.min.js"></script>
  </body>
  </html>
