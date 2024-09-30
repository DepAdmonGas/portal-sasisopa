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
  <script src="https://cdnjs.cloudflare.com/ajax/libs/selectize.js/0.12.6/js/standalone/selectize.min.js" ></script>
  <link rel="stylesheet" href="<?php echo RUTA_CSS ?>selectize.css">
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

   ListaRequisitos();

  });

  function regresarP(){
  window.history.back();
  }

function ListaRequisitos(){
  $('#DivContenido').load('app/vistas/sgm/punto5/lista-archivos-requisitos.php?NGobierno=federal&sistema=SGM');   
  } 

  function ModalNuevo(NG){
    $('#ModalConfiguracion').modal('show');
    $('#DivConfiguracion').load('app/vistas/sasisopa/elemento3/modal-agregar-requisito-legal.php?NG=' + NG);
    }

    function AgregarRL(){

var acusePDF       = $('#acusePDF').val();
var requisitoPDF   = $('#requisitoPDF').val();
var requisitolegal = $('#requisitolegal').val();
var vigencia       = $('#vigencia').val();
var fechaemision   = $('#fechaemision').val();
var vencimiento    = $('#vencimiento').val();


var data = new FormData();
var url = 'app/controlador/RequisitoLegalControlador.php';

acusePDF = document.getElementById("acusePDF");
acusePDF_file = acusePDF.files[0];
acusePDF_filePath = acusePDF.value;

requisitoPDF = document.getElementById("requisitoPDF");
requisitoPDF_file = requisitoPDF.files[0];
requisitoPDF_filePath = requisitoPDF.value;
  
  var ene = 0;
  var feb = 0;
  var mar = 0;
  var abr = 0;
  var may = 0;
  var jun = 0;
  var jul = 0;
  var ago = 0;
  var sep = 0;
  var oct = 0;
  var nov = 0;
  var dic = 0;

  if($('#ene').prop('checked')) {
  ene = 1;
  }else{
  ene = 0;
  }

  if($('#feb').prop('checked')) {
  feb = 1;
  }else{
  feb = 0;
  }

  if($('#mar').prop('checked')) {
  mar = 1;
  }else{
  mar = 0;
  }

  if($('#abr').prop('checked')) {
  abr = 1;
  }else{
  abr = 0;
  }

  if($('#may').prop('checked')) {
  may = 1;
  }else{
  may = 0;
  }

  if($('#jun').prop('checked')) {
  jun = 1;
  }else{
  jun = 0;
  }

  if($('#jul').prop('checked')) {
  jul = 1;
  }else{
  jul = 0;
  }

  if($('#ago').prop('checked')) {
  ago = 1;
  }else{
  ago = 0;
  }

  if($('#sep').prop('checked')) {
  sep = 1;
  }else{
  sep = 0;
  }

  if($('#oct').prop('checked')) {
  oct = 1;
  }else{
  oct = 0;
  }

  if($('#nov').prop('checked')) {
  nov = 1;
  }else{
  nov = 0;
  }

  if($('#dic').prop('checked')) {
  dic = 1;
  }else{
  dic = 0;
  }

  if (requisitolegal != "") {
  $('.selectize-input').css('border','');
  if (vigencia != "") {
  $('#vigencia').css('border','');
  if (fechaemision != "") {
  $('#fechaemision').css('border','');

  data.append('accion', 'agregar-detalle-requisito-legal');
  data.append('requisitolegal', requisitolegal);
  data.append('vigencia', vigencia);
  data.append('fechaemision', fechaemision);
  data.append('acusePDF_file', acusePDF_file);
  data.append('requisitoPDF_file', requisitoPDF_file);
  data.append('vencimiento', vencimiento);

  data.append('ene', ene);
  data.append('feb', feb);
  data.append('mar', mar);
  data.append('abr', abr);
  data.append('may', may);
  data.append('jun', jun);
  data.append('jul', jul);
  data.append('ago', ago);
  data.append('sep', sep);
  data.append('oct', oct);
  data.append('nov', nov);
  data.append('dic', dic);
  data.append('categoria', 1);

    $.ajax({
    url: url,
    type: 'POST',
    contentType: false,
    data: data,
    processData: false,
    cache: false
    }).done(function(data){

    if(data == 1){
    ListaRequisitos();
    $('#ModalConfiguracion').modal('hide');
    }else{
    alertify.error('Error al crear el requisito legal'); 
    }
  
    });

  }else{
  $('#fechaemision').css('border','2px solid #A52525');
  }
  }else{
  $('#vigencia').css('border','2px solid #A52525');
  }
  }else{
  $('.selectize-input').css('border','2px solid #A52525');
  }

  }

  function Vencimiento(){

var vigencia = $('#vigencia').val();
var fechaemision = $('#fechaemision').val();

if (vigencia != "") {
$('#vigencia').css('border',''); 

var parametros = {
'vigencia': vigencia,
'fechaemision' : fechaemision
};

  $.ajax({
   data:  parametros,
   url:   'app/vistas/sasisopa/elemento3/calcular-fecha-vencimiento.php',
   type:  'post',
   beforeSend: function() {
   },
   complete: function(){
   },
   success:  function (response) {

$('#fechavencimiento').html(response)   


    }
    });

}else{
$('#vigencia').css('border','2px solid #A52525');  
$('#fechaemision').val('');
}

}

function editar(id,NGobierno){
$('#ModalConfiguracion').modal('show');
$('#DivConfiguracion').load('app/vistas/sasisopa/elemento3/modal-editar-requisito-legal.php?id=' + id + '&idestacion=<?=$Session_IDEstacion;?>&NG=' + NGobierno);
}

function EditarRL(id){

var requisitolegal = $('#requisitolegal').val();
var vigencia       = $('#vigencia').val();

  var ene = 0;
  var feb = 0;
  var mar = 0;
  var abr = 0;
  var may = 0;
  var jun = 0;
  var jul = 0;
  var ago = 0;
  var sep = 0;
  var oct = 0;
  var nov = 0;
  var dic = 0;

  if($('#ene').prop('checked')) {
  ene = 1;
  }else{
  ene = 0;
  }

  if($('#feb').prop('checked')) {
  feb = 1;
  }else{
  feb = 0;
  }

  if($('#mar').prop('checked')) {
  mar = 1;
  }else{
  mar = 0;
  }

  if($('#abr').prop('checked')) {
  abr = 1;
  }else{
  abr = 0;
  }

  if($('#may').prop('checked')) {
  may = 1;
  }else{
  may = 0;
  }

  if($('#jun').prop('checked')) {
  jun = 1;
  }else{
  jun = 0;
  }

  if($('#jul').prop('checked')) {
  jul = 1;
  }else{
  jul = 0;
  }

  if($('#ago').prop('checked')) {
  ago = 1;
  }else{
  ago = 0;
  }

  if($('#sep').prop('checked')) {
  sep = 1;
  }else{
  sep = 0;
  }

  if($('#oct').prop('checked')) {
  oct = 1;
  }else{
  oct = 0;
  }

  if($('#nov').prop('checked')) {
  nov = 1;
  }else{
  nov = 0;
  }

  if($('#dic').prop('checked')) {
  dic = 1;
  }else{
  dic = 0;
  }

  if (requisitolegal != "") {
  $('.selectize-input').css('border','');
  if (vigencia != "") {
  $('#vigencia').css('border','');


  var parametros = {
  'accion' : "editar-detalle-requisito-legal",
  'id': id,
  'requisitolegal': requisitolegal,
  'vigencia' : vigencia,
  'ene' : ene,
  'feb' : feb,
  'mar' : mar,
  'abr' : abr,
  'may' : may,
  'jun' : jun,
  'jul' : jul,
  'ago' : ago,
  'sep' : sep,
  'oct' : oct,
  'nov' : nov,
  'dic' : dic
};

  $.ajax({
   data:  parametros,
   url:   'app/controlador/RequisitoLegalControlador.php',
   type:  'post',
   beforeSend: function() {
   },
   complete: function(){
   },
   success:  function (response) {

    if(response == 1){
    ListaRequisitos();
    $('#ModalConfiguracion').modal('hide');
    }else{
    alertify.error('Error al editar el requisito legal'); 
    }
    
    }
    });

  }else{
  $('#vigencia').css('border','2px solid #A52525');
  }
  }else{
  $('.selectize-input').css('border','2px solid #A52525');
  }

}

//-----------------------------------------------
function listaReq(id){
$('#ModalConfiguracion').modal('show');
$('#DivConfiguracion').load('app/vistas/sasisopa/elemento3/modal-historial-requisito-legal.php?id=' + id ); 
}

function NuevoRequisito(id){
$('#DivConfiguracion').load('app/vistas/sasisopa/elemento3/modal-historial-requisito-legal-nuevo.php?id=' + id );  
}

function CancelarAgregar(id){
$('#DivConfiguracion').load('app/vistas/sasisopa/elemento3/modal-historial-requisito-legal.php?id=' + id )
}

function AgregarRequisito(id){

var FechaEmision = $('#fechaemision').val();
var vencimiento =  $('#vencimiento').val();
var acusePDFE = document.getElementById("acusePDFN");
var acusePDFEFile = acusePDFE.files[0];
var acusePDFEFilePath = acusePDFE.value;

var requisitoPDFE = document.getElementById("requisitoPDFN");
var requisitoPDFEEFile = requisitoPDFE.files[0];
var requisitoPDFEEFilePath = requisitoPDFE.value;

var data = new FormData();
var url = 'app/controlador/RequisitoLegalControlador.php';

Dependencia = sessionStorage.getItem('Dependencia');

if (FechaEmision != "") {
$('#fechaemision').css('border',''); 

  data.append('accion', "agregar-requisito-legal-historial");
  data.append('idre', id);
  data.append('FechaEmision', FechaEmision);
  data.append('acusepdf', acusePDFEFile);
  data.append('requisitopdf', requisitoPDFEEFile);
  data.append('vencimiento', vencimiento);

  $.ajax({
  url: url,
  type: 'POST',
  contentType: false,
  data: data,
  processData: false,
  cache: false
  }).done(function(data){

    if(data){
        ListaRequisitos();
        listaReq(id);
    }else{
        alertify.error('Error al agregar el requisito legal');  
    }
  

  });


}else{
$('#fechaemision').css('border','2px solid #A52525');  
}

}
function editararchivo(id, idmatriz){
$('#DivConfiguracion').load('app/vistas/sasisopa/elemento3/modal-editar-requisito-legal-historial.php?id=' + id + '&idmatriz=' + idmatriz ); 
}

function EditarRequisito(id, idmatriz){

var acusePDFED = document.getElementById("acusePDFED");
var acusePDFEFile = acusePDFED.files[0];
var acusePDFEFilePath = acusePDFED.value;

var requisitoPDFED = document.getElementById("requisitoPDFED");
var requisitoPDFEEFile = requisitoPDFED.files[0];
var requisitoPDFEEFilePath = requisitoPDFED.value;  
var fechavencimiento = $('#fechavencimiento').val();

Dependencia = sessionStorage.getItem('Dependencia');

var data = new FormData();
var url = 'app/controlador/RequisitoLegalControlador.php';
  
  data.append('accion', "editar-requisito-legal-historial");
  data.append('idmatriz', idmatriz);
  data.append('acusepdf', acusePDFEFile);
  data.append('requisitopdf', requisitoPDFEEFile);
  data.append('fechavencimiento', fechavencimiento);
  data.append('fechaemision', '');

  $.ajax({
  url: url,
  type: 'POST',
  contentType: false,
  data: data,
  processData: false,
  cache: false
  }).done(function(data){

if (data) {
listaReq(id);
ListaRequisitos();
}else{
$('#respuesta').html('<div class="text-center"><small class="text-danger">Adjunte el acuse o requisito legal en formato PDF.</small></div>');  
}
  
});

}
//----------------------------------------------------------------------------------

function Detalle(id){

$('#ModalConfiguracion').modal('show');
$('#DivConfiguracion').load('app/vistas/sasisopa/elemento3/modal-detalle-requisito-legal.php?id=' + id );
 
}

function EliminarArchivo(idre,idmatriz){

alertify.confirm('',
function(){

 var parametros = {
  'accion': "eliminar-detalle-requisito-legal",
  'idre': idre,
  'idmatriz': idmatriz
};

  $.ajax({
   data:  parametros,
   url:   'app/controlador/RequisitoLegalControlador.php',
   type:  'post',
   beforeSend: function() {
   },
   complete: function(){
   },
   success:  function (response) {

    if(response == 1){
      ListaRequisitos();
      listaReq(idre)
    }else{
    alertify.error('Error al eliminar el requisito legal'); 
    }
    
    }
    });

   },
function(){
}).setHeader('Mensaje').set({transition:'zoom',message: 'Desea eliminar el archivo seleccionado',labels:{ok:'Aceptar', cancel: 'Cancelar'}}).show();

}

function EliminarRL(idre){

alertify.confirm('',
function(){


 var parametros = {
  'accion' : "eliminar-requisito-legal",
  'idre': idre
};

  $.ajax({
   data:  parametros,
   url:   'app/controlador/RequisitoLegalControlador.php',
   type:  'post',
   beforeSend: function() {
   },
   complete: function(){
   },
   success:  function (response) {

    if(response == 1){
      ListaRequisitos();
    }else{
    alertify.error('Error al eliminar el requisito legal'); 
    }
    
    }
    });

  },
function(){
}).setHeader('Mensaje').set({transition:'zoom',message: 'Desea eliminar el permiso seleccionado',labels:{ok:'Aceptar', cancel: 'Cancelar'}}).show();
 
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
    <div class="float-left"><h4>Requisitos Legales</h4></div>
    <div class="float-right" style="margin-top: 6px;margin-left: 10px;">
    <a onclick="ModalNuevo('Federal')" style="cursor: pointer;" data-toggle="tooltip" data-placement="right" title="Agregar"><img src="<?php echo RUTA_IMG_ICONOS."agregar.png"; ?>"></a>
    </div>
    </div>
   
    <div class="card-body">

    <div id="DivContenido"></div>

    </div>
    </div>
    </div>
    </div>
    </div>

 

  <div class="modal fade bd-example-modal-lg" id="ModalConfiguracion" data-backdrop="static">
    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
      <div class="modal-content border-0 rounded-0">
      <div id="DivConfiguracion"></div>
      </div>
    </div>
  </div>
 
  <script src="<?php echo RUTA_JS ?>bootstrap.min.js"></script>
  </body>
  </html>

