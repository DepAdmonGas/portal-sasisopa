<?php
require('app/help.php');

$sql_sasisopa_ayuda = "SELECT * FROM pu_sasisopa_ayuda WHERE id_usuario = '".$Session_IDUsuarioBD."' and detalle = '16-investigacion-incidentes-accidentes' and estado = 0 LIMIT 1";
$result_sasisopa_ayuda = mysqli_query($con, $sql_sasisopa_ayuda);
$numero_sasisopa_ayuda = mysqli_num_rows($result_sasisopa_ayuda);

if ($numero_sasisopa_ayuda == 1) {
while($row_ayuda = mysqli_fetch_array($result_sasisopa_ayuda, MYSQLI_ASSOC)){
$idAyuda = $row_ayuda['id'];
}
}else{
$idAyuda = 0;
}
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
 <?php if ($numero_sasisopa_ayuda == 1) {echo "btnAyuda();";} ?>
 ListaInvestigacion();
 ListaInvestigacionNO();
  });
  function regresarP(){
  window.history.back();
  }

  function btnAyuda(){
  $('#Modalinvestigacion').modal('show');
  }


function btnFinAyuda(){

var puntosSasisopa = <?=$numero_sasisopa_ayuda;?>;

 var parametros = {
        "idAyuda" : <?=$idAyuda; ?>
      };

  if (puntosSasisopa != 0) {

   $.ajax({
   data:  parametros,
   url:   'public/sasisopa/actualizar/actualizar-ayuda.php',
   type:  'post',
   beforeSend: function() {
   },
   complete: function(){
   },
   success:  function (response) {
   $('#Modalinvestigacion').modal('hide');
   }
   });

  }else{
  $('#Modalinvestigacion').modal('hide');
  }

}
//-----------------------------------------------------------------
function ListaInvestigacion(){

   $.ajax({
     url:   'public/sasisopa/buscar/buscar-lista-incidentes-accidentes.php',
     type:  'post',
     beforeSend: function() {
     },
     complete: function(){
     },
     success:  function (response) {

     $('#DivContenido').html(response);

     }
     });
}

function ModalAgregar(){
$('#ModalDetalle').modal('show'); 


   $.ajax({
     url:   'public/sasisopa/buscar/buscar-formulario-incidentes-accidentes.php',
     type:  'post',
     beforeSend: function() {
     },
     complete: function(){ 
     },
     success:  function (response) {

     $('#DivModalDetalle').html(response);

     }
     });


}

function TipoEvento(tipo){
var tipo = tipo.value;

if (tipo == "") {
$('#DescripcionTipo').html('');
$('#MuertesCheck').html('');
$('#TercerAutorizado').html('');
$('#EventoDetalle').html('');
}else if(tipo == 1){

$('#DescripcionTipo').html('<div class="p-2 mt-3"><table class="table table-sm">'+
'<tr>'+
'<td class="bg-success text-center text-white font-weight-bold">Evento Tipo 1</td>'+
'</tr>'+
'<tr>'+
'<td class="table-success">'+
'<ol type="a">'+
'<li>Lesiones del personal que '+
' requieran incapacidad '+
' médica causadas en el '+
' ejercicio o con motivo de las '+
' actividades que realiza en el '+
' Sector Hidrocarburos.</li>'+
'<li>Daños a las instalaciones, '+
' sin interrupción de '+
' operaciones de las '+
' Actividades del Sector '+
' Hidrocarburos.</li> '+
'<li>Fallas o errores en la '+
' operación de equipos en las '+
' que se involucren Equipos de Fuerza.'+
'</li>'+
'</ol>'+
'</td>'+
'</tr>'+
'</table></div>');

$('#MuertesCheck').html('');
ConteCheck();

$('#EventoDetalle').html('');

}else if(tipo == 2){
$('#DescripcionTipo').html('<div class="p-2 mt-3"><table class="table table-sm">'+
'<tr>'+
'<td class="bg-success text-center text-white font-weight-bold">Evento Tipo 2</td>'+
'</tr>'+
'<tr>'+
'<td class="table-success">'+
'<ol type="a">'+
'<li>Muerte de una o más personas dentro de las instalaciones del Regulado.</li>'+
'<li>Simultáneamente, daños a las instalaciones e interrupción de operaciones de las Actividades del Sector '+
' Hidrocarburos.</li>'+
'<li>Exista la liberación al Ambiente de una sustancia o material peligroso dentro de los '+
' límites de la Instalación del Regulado'+
'</li>'+
'</ol>'+
'</td>'+
'</tr></table></div>');  

ConteMuertesCheck();


$('#EventoDetalle').html('');
ConteCheck();

}else if(tipo == 3){
$('#DescripcionTipo').html('<div class="p-2 mt-3"><table class="table table-sm">'+
'<tr>'+
'<td class="bg-danger text-center text-white font-weight-bold">Evento Tipo 3</td>'+
'</tr>'+
'<tr>'+
'<td class="table-danger">'+
'<ol type="a">'+
'<li>Simultáneamente, una o más muertes de personal, daño a las instalaciones e interrupción de '+
' operaciones de las actividades del Sector Hidrocarburos.</li>'+
'<li>Simultáneamente, lesiones al personal, daño a las instalaciones e interrupción de operaciones de las'+
' actividades del Sector Hidrocarburos.</li>'+
'<li>Simultáneamente, evacuación de personal, daños a las instalaciones e interrupción de operaciones de las actividades del '+
' Sector Hidrocarburos.</li>'+
'<li>Muertes o lesionados de la Población.</li>'+
'<li>Se requiera la evacuación de la Población, y</li>'+
'<li>Exista la liberación al Ambiente de una sustancia o material peligroso que rebase los límites de'+
' las instalaciones del Regulado.</li>'+
'</ol>'+
'</td>'+
'</tr></table></div>');  
$('#MuertesCheck').html('');
$('#TercerAutorizado').html('');
ConteTercerA();
}

}

function ConteCheck(){

$('#TercerAutorizado').html('<div class="form-check">'+
'<input type="checkbox" class="form-check-input" id="checkTercerA" onclick="BTNCheck()">'+
'<label class="form-check-label" onclick="BTNCheck()">Contratar tercer autorizado</label>'+
'</div>'); 
}

function BTNCheck(){
var TipoEvento  =  $('#TipoEvento').val();

if (TipoEvento == 2) {

if( $('#checkTercerA').prop("checked") == true ) {
$("#checkMuertes").attr("disabled", true);
ConteTercerA();
}else{
$("#checkMuertes").attr("disabled", false);
$("#checkMuertes").attr("checked", true);
$('#EventoDetalle').html('');

}

}else{
if( $('#checkTercerA').prop("checked") == true ) {
ConteTercerA();
}else{
$('#EventoDetalle').html('');
}
}

}

function ConteMuertesCheck(){

$('#MuertesCheck').html('<div class="form-check">'+
'<input type="checkbox" class="form-check-input" id="checkMuertes" onclick="BTNMuertesCheck()">'+
'<label class="form-check-label" onclick="BTNMuertesCheck()">Hubo muertes de personal</label>'+
'</div>');

}

function BTNMuertesCheck(){
var TipoEvento  =  $('#TipoEvento').val();

if (TipoEvento == 2) {

if( $('#checkMuertes').prop("checked") == true ) {


if( $('#checkTercerA').prop("checked") == false ) {
$("#checkTercerA").attr("checked", true); 

}

$("#checkTercerA").attr("disabled", true);
ConteTercerA();
}else{
$("#checkTercerA").attr("checked", false); 
$("#checkTercerA").attr("disabled", false);
$('#EventoDetalle').html('');
}

}else{

if( $('#checkMuertes').prop("checked") == true ) {
ConteTercerA();
}else{
$('#EventoDetalle').html('');
}

}

}

function ConteTercerA(){

$('#EventoDetalle').html('<div class="mb-2 mt-2"><small class="text-secondary">* Nombre del tercer autorizado:</small></div>'+
'<input class="form-control input-style rounded-0" type="text" id="NombreTA">'+
'<div class="mb-2 mt-2"><small class="text-secondary">* Numero de autorización:</small></div>'+
'<input class="form-control input-style rounded-0" type="text" id="NumeroA">'+
'<div class="mb-2 mt-2"><small class="text-secondary">* Nombre del líder de la investigación:</small></div>'+
'<input class="form-control input-style rounded-0" type="text" id="NombreLI">'); 

}
//--------------------------------------------------------------------------------

function BTNCrear(){

var Fecha =  $('#Fecha').val();
var Descripcion =  $('#Descripcion').val();
var TipoEvento  =  $('#TipoEvento').val();

if (Fecha != "") {
$('#Fecha').css('border','');
if (Descripcion != "") {
$('#Descripcion').css('border','');
if (TipoEvento != "") {
$('#TipoEvento').css('border','');

if (TipoEvento == 1) {
EventoTipo1();
}else if (TipoEvento == 2) {
EventoTipo2();
}else if (TipoEvento == 3) {
EventoTipo3();
}

}else{
$('#TipoEvento').css('border','2px solid #A52525');
}
}else{
$('#Descripcion').css('border','2px solid #A52525');
}
}else{
$('#Fecha').css('border','2px solid #A52525');
}

}

function EventoTipo1(){

if( $('#checkTercerA').prop("checked") == true ) {

var Fecha =  $('#Fecha').val();
var Descripcion =  $('#Descripcion').val();
var TipoEvento  =  $('#TipoEvento').val();
var NombreTA = $('#NombreTA').val();
var NumeroA = $('#NumeroA').val();
var NombreLI = $('#NombreLI').val();

if (NombreTA != "") {
$('#NombreTA').css('border','');
if (NumeroA != "") {
$('#NumeroA').css('border','');
if (NombreLI != "") {
$('#NombreLI').css('border','');

var parametros = {
"Fecha" : Fecha,
"Descripcion"  :  Descripcion,
"TipoEvento"   :  TipoEvento,
"NombreTA" : NombreTA,
"NumeroA" : NumeroA,
"NombreLI" : NombreLI,
"TercerA" : 1,
"TipoAdd" : 2
};

     $.ajax({
     data:  parametros,
     url:   'public/sasisopa/agregar/agregar-incedentes-accidentes.php',
     type:  'post',
     beforeSend: function() {
     },
     complete: function(){
     },
     success:  function (response) {
     ListaInvestigacion();
     $('#ModalDetalle').modal('hide'); 
     }
     });

}else{
$('#NombreLI').css('border','2px solid #A52525');
}
}else{
$('#NumeroA').css('border','2px solid #A52525');
}
}else{
$('#NombreTA').css('border','2px solid #A52525');
}

}else{

GuardarEventoTipo1();

}

}

function GuardarEventoTipo1(){

var Fecha =  $('#Fecha').val();
var Descripcion =  $('#Descripcion').val();
var TipoEvento  =  $('#TipoEvento').val(); 

var parametros = {
"Fecha" : Fecha,
"Descripcion"  :  Descripcion,
"TipoEvento"   :  TipoEvento,
"TipoAdd" : 1
};

     $.ajax({
     data:  parametros,
     url:   'public/sasisopa/agregar/agregar-incedentes-accidentes.php',
     type:  'post',
     beforeSend: function() {
     },
     complete: function(){
     },
     success:  function (response) {
    ListaInvestigacion();
     $('#ModalDetalle').modal('hide'); 
     }
     });

}

//------------------- EVENTO TIPO 2 Forma 1

function EventoTipo2(){

var muertes = 0;
var tercera = 0;
if ($('#checkMuertes').prop("checked") == true || $('#checkTercerA').prop("checked") == true) {

if ($('#checkMuertes').prop("checked") == true && $('#checkTercerA').prop("checked") == true) {
muertes = 1;
tercera = 1;
}else if ($('#checkTercerA').prop("checked") == true && $('#checkMuertes').prop("checked") == false){
muertes = 0;
tercera = 1;
}

var Fecha =  $('#Fecha').val();
var Descripcion =  $('#Descripcion').val();
var TipoEvento  =  $('#TipoEvento').val();
var NombreTA = $('#NombreTA').val();
var NumeroA = $('#NumeroA').val();
var NombreLI = $('#NombreLI').val();

if (NombreTA != "") {
$('#NombreTA').css('border','');
if (NumeroA != "") {
$('#NumeroA').css('border','');
if (NombreLI != "") {
$('#NombreLI').css('border','');

var parametros = {
"Fecha" : Fecha,
"Descripcion"  :  Descripcion,
"TipoEvento"   :  TipoEvento,
"NombreTA" : NombreTA,
"NumeroA" : NumeroA,
"NombreLI" : NombreLI,
"Muertes" : muertes,
"TercerA" : tercera,
"TipoAdd" : 3
};

     $.ajax({
     data:  parametros,
     url:   'public/sasisopa/agregar/agregar-incedentes-accidentes.php',
     type:  'post',
     beforeSend: function() {
     },
     complete: function(){
     },
     success:  function (response) {
     ListaInvestigacion();
     $('#ModalDetalle').modal('hide'); 
     }
     });

}else{
$('#NombreLI').css('border','2px solid #A52525');
}
}else{
$('#NumeroA').css('border','2px solid #A52525');
}
}else{
$('#NombreTA').css('border','2px solid #A52525');
}

}else{

GuardarEventoTipo1();

}

}

function EventoTipo3(){
var Fecha =  $('#Fecha').val();
var Descripcion =  $('#Descripcion').val();
var TipoEvento  =  $('#TipoEvento').val();
var NombreTA = $('#NombreTA').val();
var NumeroA = $('#NumeroA').val();
var NombreLI = $('#NombreLI').val();

if (NombreTA != "") {
$('#NombreTA').css('border','');
if (NumeroA != "") {
$('#NumeroA').css('border','');
if (NombreLI != "") {
$('#NombreLI').css('border','');

var parametros = {
"Fecha" : Fecha,
"Descripcion"  :  Descripcion,
"TipoEvento"   :  TipoEvento,
"NombreTA" : NombreTA,
"NumeroA" : NumeroA,
"NombreLI" : NombreLI,
"Muertes" : 1,
"TercerA" : 1,
"TipoAdd" : 3
};

     $.ajax({
     data:  parametros,
     url:   'public/sasisopa/agregar/agregar-incedentes-accidentes.php',
     type:  'post',
     beforeSend: function() {
     },
     complete: function(){
     },
     success:  function (response) {
     ListaInvestigacion();
     $('#ModalDetalle').modal('hide'); 
     }
     });

}else{
$('#NombreLI').css('border','2px solid #A52525');
}
}else{
$('#NumeroA').css('border','2px solid #A52525');
}
}else{
$('#NombreTA').css('border','2px solid #A52525');
} 
}

//----------------------------------------------------------------------------
function GrupoInterdiciplinario(id){
$('#ModalDetalle').modal('show');

var parametros = {
"id"  :  id
};

$.ajax({
     data:  parametros,
     url:   'public/sasisopa/buscar/buscar-formulario-lista-grupo.php',
     type:  'post',
     beforeSend: function() {
     },
     complete: function(){
     },
     success:  function (response) {

     $('#DivModalDetalle').html(response);
ListaGrupoI(id);
     }
     });

}

function ListaGrupoI(id){

var parametros = {
    "id" : id
  };

$.ajax({
data:  parametros,
url:   'public/sasisopa/buscar/buscar-lista-grupo-inter.php',
type:  'post',
beforeSend: function() {
},
complete: function(){
},
success:  function (response) {

$('#ConteListaGrupo').html(response);

}
});


}

function FormularioGrupoInter(id){


var parametros = {
    "id" : id
  };

$.ajax({
data:  parametros,
url:   'public/sasisopa/buscar/buscar-formulario-agregar-grupo.php',
type:  'post',
beforeSend: function() {
},
complete: function(){
},
success:  function (response) {

$('#ConteListaGrupo').html(response);

}
});

}

function BTNAgregarGrupo(id){

var NombreG = $('#NombreG').val();
var PuestoG = $('#PuestoG').val();
var EspecialidadG = $('#EspecialidadG').val();

if (NombreG != "") {
$('#NombreG').css('border','');
if (PuestoG != "") {
$('#PuestoG').css('border','');
if (EspecialidadG != "") {
$('#EspecialidadG').css('border','');


var parametros = {
    "id" : id,
    "NombreG" : NombreG,
    "PuestoG" : PuestoG,
    "EspecialidadG" : EspecialidadG
  };

$.ajax({
data:  parametros,
url:   'public/sasisopa/agregar/agregar-grupo-interdiciplinario.php',
type:  'post',
beforeSend: function() {
},
complete: function(){
},
success:  function (response) {

$('#td7' + id).html('<img src="<?=RUTA_IMG_ICONOS?>correcto-16.png">');
ListaGrupoI(id);

}
});



}else{
$('#EspecialidadG').css('border','2px solid #A52525');
}
}else{
$('#PuestoG').css('border','2px solid #A52525');
}
}else{
$('#NombreG').css('border','2px solid #A52525');
}

}

function Modal026(id){

$('#ModalDetalle').modal('show');

var parametros = {
"id"  :  id
};

$.ajax({
     data:  parametros,
     url:   'public/sasisopa/buscar/buscar-formulario-informe.php',
     type:  'post',
     beforeSend: function() {
     },
     complete: function(){
     },
     success:  function (response) {
$('#DivModalDetalle').html(response);
     }
     });

}

function BTNArchivoID(id){

 var ArchivoPdf = document.getElementById("ArchivoPdf");
  var ArchivoPdf_file = ArchivoPdf.files[0];
  var ArchivoPdf_filePath = ArchivoPdf.value;
  var ext = $("#ArchivoPdf").val().split('.').pop();

  var data = new FormData();
  var url = 'public/sasisopa/agregar/agregar-archivo-formato26.php';

if (ArchivoPdf_filePath != "") {
$('#ArchivoPdf').css('border','');
if (ext == "PDF" || ext == "pdf") {
$('#ResultIA').html('');
$('#ArchivoPdf').css('border','');

data.append('idDocumento', id);
data.append('ArchivoPdf_file', ArchivoPdf_file);

  $.ajax({
  url: url,
  type: 'POST',
  contentType: false,
  data: data,
  processData: false,
  cache: false
  }).done(function(data){

$('#td11' + id).html('<a target="_BLANK" href="'+data+'"><img src="<?=RUTA_IMG_ICONOS;?>pdf.png"></a>');
$('#ModalDetalle').modal('hide');

});

}else{
$('#ResultIA').html('<small class="text-danger">Solo se aceptan formato PDF</small>');
$('#ArchivoPdf').css('border','2px solid #A52525');  
}
}else{
$('#ArchivoPdf').css('border','2px solid #A52525');  
}

}
//----------------------------------------------------------------------------------------------
function ModalTercerA(id){
$('#ModalDetalle').modal('show');  

DatosFTA(id);

}

function DatosFTA(id){

var parametros = {
"id"  :  id
};

$.ajax({
     data:  parametros,
     url:   'public/sasisopa/buscar/buscar-formulario-tercerautorizado.php',
     type:  'post',
     beforeSend: function() {
     },
     complete: function(){
     },
     success:  function (response) {
$('#DivModalDetalle').html(response);
     }
     });
}

function BTNArchivoTA(id, idta){

 var ArchivoPdf = document.getElementById("ArchivoPdf");
  var ArchivoPdf_file = ArchivoPdf.files[0];
  var ArchivoPdf_filePath = ArchivoPdf.value;
  var ext = $("#ArchivoPdf").val().split('.').pop();

  var data = new FormData();
  var url = 'public/sasisopa/actualizar/actualizar-archivo-ta.php';

if (ArchivoPdf_filePath != "") {
$('#ArchivoPdf').css('border','');
if (ext == "PDF" || ext == "pdf") {
$('#ResultIA').html('');
$('#ArchivoPdf').css('border','');

data.append('idDocumento', id);
data.append('idta', idta);
data.append('ArchivoPdf_file', ArchivoPdf_file);

  $.ajax({
  url: url,
  type: 'POST',
  contentType: false,
  data: data,
  processData: false,
  cache: false
  }).done(function(data){

DatosFTA(id);

});

}else{
$('#ResultIA').html('<small class="text-danger">Solo se aceptan formato PDF</small>');
$('#ArchivoPdf').css('border','2px solid #A52525');  
}
}else{
$('#ArchivoPdf').css('border','2px solid #A52525');  
}

}
//--------------------------------------------------------------

function Descargar(){
window.location = "descargar-investigacion-incidentes-accidentes";
}

function Eliminar(id){

 var parametros = {
  "id" : id
  };

  alertify.confirm('',
function(){

  $.ajax({
  data:  parametros,
  url:   'public/sasisopa/eliminar/eliminar-investigacion-incidentes-accidentes.php',
  type:  'post',
  beforeSend: function() {
  },
  complete: function(){
  },
  success:  function (response) {
 
     ListaInvestigacion();

  }
  });

  },
function(){
}).setHeader('Mensaje').set({transition:'zoom',message: 'Desea eliminar la información seleccionada',labels:{ok:'Aceptar', cancel: 'Cancelar'}}).show();

}


//--------------------------------------------------------------

function ListaInvestigacionNO(){
$('#ListaInvestigacionNO').load('public/sasisopa/vistas/lista-sin-accidentes-fecha.php');

}

function ModalSAF(){
$('#ModalDetalle').modal('show');
$('#DivModalDetalle').load('public/sasisopa/vistas/modal-sin-accidentes-fecha.php?Id=0');
ListaInvestigacionNO();
}

function btnGuardarSAF(id){
let Fecha = $('#Fecha').val();

 var parametros = {
  "id" : id,
  "Fecha" : Fecha
  };

  $.ajax({
  data:  parametros,
  url:   'public/sasisopa/actualizar/actualizar-investigacion-incidentes-accidentes-no.php',
  type:  'post',
  beforeSend: function() {
  },
  complete: function(){
  },
  success:  function (response) {
  
  $('#ModalDetalle').modal('hide');
  ListaInvestigacionNO();

  }
  });

}

function DescargarIIAN(id){
window.location = "descargar-investigacion-sin-incidentes-accidentes/" + id; 
}

function EditarIIAN(id){
$('#ModalDetalle').modal('show');
$('#DivModalDetalle').load('public/sasisopa/vistas/modal-sin-accidentes-fecha.php?Id=' + id);
}
function EliminarIIAN(id){
 var parametros = {
  "id" : id
  };

  alertify.confirm('',
function(){

  $.ajax({
  data:  parametros,
  url:   'public/sasisopa/eliminar/eliminar-investigacion-sin-incidentes-accidentes.php',
  type:  'post',
  beforeSend: function() {
  },
  complete: function(){
  },
  success:  function (response) {
 
 ListaInvestigacionNO();

  }
  });

  },
function(){
}).setHeader('Mensaje').set({transition:'zoom',message: 'Desea eliminar la información seleccionada',labels:{ok:'Aceptar', cancel: 'Cancelar'}}).show();
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
    <div class="float-left"><h4>16. INVESTIGACIÓN DE INCIDENTES Y ACCIDENTES</h4></div>
    <div class="float-right" style="margin-top: 6px;margin-left: 10px;">
    <a onclick="btnAyuda()" style="cursor: pointer;" data-toggle="tooltip" data-placement="left" title="Ayuda" >
    <img src="<?php echo RUTA_IMG_ICONOS."info.png"; ?>">
    </a>

    <a class="ml-2" onclick="ModalAgregar()" style="cursor: pointer;" data-toggle="tooltip" data-placement="left" title="Agregar" >
    <img src="<?php echo RUTA_IMG_ICONOS."agregar.png"; ?>">
    </a>
    </div>
      </div>
    <div class="card-body">
    
    <div class="text-right mb-2">
      <a class="ml-2" onclick="Descargar()" style="cursor: pointer;">
    <img src="<?php echo RUTA_IMG_ICONOS."pdf.png"; ?>">
    </a>
    </div>
    <div id="DivContenido"></div>

    <hr>

    <div class="row">
    <div class="col-11"><h5>Sin accidentes a la fecha</h5></div>
    <div class="col-1 text-right">
    <a class="ml-2" onclick="ModalSAF()" style="cursor: pointer;">
    <img src="<?php echo RUTA_IMG_ICONOS."agregar.png"; ?>">
    </a>
    </div>
    </div>

    <div id="ListaInvestigacionNO"></div>
    
  
    </div>
    </div>
    </div>
    </div>
    </div>

  <div class="modal fade bd-example-modal-lg" id="Modalinvestigacion" data-backdrop="static">
    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
      <div class="modal-content" style="border-radius: 0px;border: 0px;">
        <div class="modal-header">
          <h4 class="modal-title">Bienvenido al elemento 16. INVESTIGACIÓN DE INCIDENTES Y ACCIDENTES, del Sistema de Administración</h4>
        </div>
        <div class="modal-body">

          <p class="text-justify" style="font-size: 1.1em">
            En este apartado podrás registrar los accidentes ocurridos dentro de la estación de servicio.
          </p>

          <hr>

          <label class="font-weight-bold" style="font-size: 1.1em">Como hacerlo:</label>
          <ul style="font-size: 1.1em">
            <li>Da clic en el botón <img width="16" src="<?php echo RUTA_IMG_ICONOS."agregar.png"; ?>"> para agregar un nuevo registro sobre algún incidente o accidente ocurrido.</small></li>
            <li>La investigación e informe de los eventos tipo 1 y 2 (Excepto cuando exista muerte de una o mas personas dentro de las instalaciones) puede realizarse por personal interno especializado utilizando un procedimiento para identificar la causa raíz de los accidentes, sin embargo también se podrá contratar un tercer autorizado ante la ASEA.</li>
            <li>Cuando el evento es tipo 2 (Existe muerte de una o mas personas dentro de las instalaciones)  y tipo 3 se deberá contratar aun tercer autorizado para realizar la investigación causa raíz.</li>
          </ul>

          <hr>

          <label class="font-weight-bold" style="font-size: 1.1em">Responsables:</label>
          <p class="text-justify" style="font-size: 1.1em">Recuerda que es responsabilidad del <label class="text-danger font-weight-bold">Representante Técnico</label> (RT), <label class="text-danger font-weight-bold">Gerente de la Estación</label>, <label class="text-danger font-weight-bold">Representante Legal</label> y departamento de mantenimiento realizar la investigación causa raíz así como el informe detallado.</p>

          <small>
          <div>Nota:</div>
          <div class="pt-1 pb-1">No olvides los siguientes conceptos:</div>
          <b>Accidente:</b> Evento que ocasiona afectaciones al personal, a la Población, a los bienes propiedad de la Nación, a los equipos e instalaciones, a los sistemas y/o procesos operativos y al medio ambiente.<br>
          <b>Incidente:</b> Evento o combinación de eventos inesperados no deseados que alteran el funcionamiento normal de las Instalaciones, del proceso o de la industria; acompañado o no de afectación al Ambiente, a las Instalaciones, a la Población y/o al personal del Regulado, así como al personal de contratistas, subcontratistas, proveedores y prestadores de servicios.

          </small>

        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-primary" style="border-radius: 0px;" onclick="btnFinAyuda()">Aceptar</button>
        </div>
      </div>
    </div>
    </div>


<div class="modal fade bd-example-modal-lg" id="ModalDetalle" >
<div class="modal-dialog modal-lg modal-dialog-centered" role="document">
<div class="modal-content" style="border-radius: 0px;border: 0px;">

<div id="DivModalDetalle"></div>

</div>
</div>
</div>


  <script src="<?php echo RUTA_JS ?>bootstrap.min.js"></script>
  </body>
  </html>
