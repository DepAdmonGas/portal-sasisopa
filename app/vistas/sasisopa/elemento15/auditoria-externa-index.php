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

.div-hover:hover{
  opacity: .9;
}

a:link, a:hover
{
text-decoration:none !important;
}
  </style>
  <script type="text/javascript">
  $(document).ready(function(){
  $('[data-toggle="tooltip"]').tooltip();
  $(".LoaderPage").fadeOut("slow");

  ListaAuditoria();
  });
  function regresarP(){
  window.history.back();
  }

  function ListaAuditoria(){

     $.ajax({
     url:   'app/vistas/sasisopa/elemento15/buscar-lista-auditoria-externa.php',
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
    $('#ModalAgregar').modal('show');
    }

    function BTNCrear(){

var PrestadorS = $('#PrestadorS').val();

if (PrestadorS != "") {
$('#PrestadorS').css('border',''); 

var parametros = {
    "accion" : "agregar-auditoria-externa",
    "PrestadorS" : PrestadorS
  };

     $.ajax({
     data:  parametros,
     url:   'app/controlador/AuditoriaControlador.php',
     type:  'post',
     beforeSend: function() {
     },
     complete: function(){
     },
     success:  function (response) {
     ListaAuditoria();
     $('#ModalAgregar').modal('hide');
     }
     });

}else{
$('#PrestadorS').css('border','2px solid #A52525');  
}

}

function Modal024(id){
$('#ModalDetalle').modal('show');

var parametros = {
    "id" : id
  };

$.ajax({
data:  parametros,
url:   'app/vistas/sasisopa/elemento15/buscar-informe-auditoria.php',
type:  'post',
beforeSend: function() {
},
complete: function(){
},
success:  function (response) {
$('#ContenidoDetalle').html(response);
}
});

}

function BTNArchivoIA(id){

  var ArchivoPdf = document.getElementById("ArchivoPdf");
  var ArchivoPdf_file = ArchivoPdf.files[0];
  var ArchivoPdf_filePath = ArchivoPdf.value;
  var ext = $("#ArchivoPdf").val().split('.').pop();

  var data = new FormData();
  var url = 'app/controlador/AuditoriaControlador.php';

if (ArchivoPdf_filePath != "") {
$('#ArchivoPdf').css('border','');
if (ext == "PDF" || ext == "pdf") {
$('#ResultIA').html('');
$('#ArchivoPdf').css('border','');

data.append('accion', 'agregar-archivo-formato24');
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

$('#td6' + id).html('<a target="_BLANK" href="'+data+'"><img src="<?=RUTA_IMG_ICONOS;?>pdf.png"></a>');
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

function Modal025(id){
$('#ModalDetalle').modal('show');

var parametros = {
    "id" : id
  };

$.ajax({
data:  parametros,
url:   'app/vistas/sasisopa/elemento15/buscar-plan-atencion-hallazgos.php',
type:  'post',
beforeSend: function() {
},
complete: function(){
},
success:  function (response) {
$('#ContenidoDetalle').html(response);
}
});

}

function BTNArchivoPAH(id){

 var ArchivoPdf = document.getElementById("ArchivoPdf");
  var ArchivoPdf_file = ArchivoPdf.files[0];
  var ArchivoPdf_filePath = ArchivoPdf.value;
  var ext = $("#ArchivoPdf").val().split('.').pop();

  var data = new FormData();
  var url = 'app/controlador/AuditoriaControlador.php';

if (ArchivoPdf_filePath != "") {
$('#ArchivoPdf').css('border','');
if (ext == "PDF" || ext == "pdf") {
$('#ResultIA').html('');
$('#ArchivoPdf').css('border','');

data.append('accion', 'agregar-archivo-formato25');
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

$('#td9' + id).html('<a target="_BLANK" href="'+data+'"><img src="<?=RUTA_IMG_ICONOS;?>pdf.png"></a>');
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

function Asea(id){
$('#ModalDetalle').modal('show');

var parametros = {
    "id" : id
  };

$.ajax({
data:  parametros,
url:   'app/vistas/sasisopa/elemento15/buscar-detalle-asea.php',
type:  'post',
beforeSend: function() {
},
complete: function(){
},
success:  function (response) {

$('#ContenidoDetalle').html(response);
ListaAsea(id);
}
});
}

function ListaAsea(id){

var parametros = {
    "id" : id
  };

$.ajax({
data:  parametros,
url:   'app/vistas/sasisopa/elemento15/buscar-lista-asea.php',
type:  'post',
beforeSend: function() {
},
complete: function(){
},
success:  function (response) {

$('#ContenidoAsea').html(response);

}
});

}

function BTNASEA(id){

var parametros = {
"id" : id
};

$.ajax({
data:  parametros,
url:   'app/vistas/sasisopa/elemento15/buscar-formulario-asea.php',
type:  'post',
beforeSend: function() {
},
complete: function(){
},
success:  function (response) {

$('#ContenidoAsea').html(response);

}
});

}

function BTNArchivoASEA(id){

var ArchivoPdf = document.getElementById("ArchivoPdf");
var ArchivoPdf_file = ArchivoPdf.files[0];
var ArchivoPdf_filePath = ArchivoPdf.value;
var ext = $("#ArchivoPdf").val().split('.').pop();

var Comentario = $('#Comentario').val();

var data = new FormData();
var url = 'app/controlador/AuditoriaControlador.php';

if (ArchivoPdf_filePath != "") {
$('#ArchivoPdf').css('border','');
if (ext == "PDF" || ext == "pdf") {
$('#ResultIA').html('');
$('#ArchivoPdf').css('border','');
if (Comentario != "") {

data.append('accion', 'agregar-archivo-asea');
data.append('idDocumento', id);
data.append('ArchivoPdf_file', ArchivoPdf_file);
data.append('Comentario', Comentario);

$.ajax({
url: url,
type: 'POST',
contentType: false,
data: data,
processData: false,
cache: false
}).done(function(data){

ListaAsea(id);

});

}else{
$('#Comentario').css('border','2px solid #A52525');  
}
}else{
$('#ResultIA').html('<small class="text-danger">Solo se aceptan formato PDF</small>');
$('#ArchivoPdf').css('border','2px solid #A52525');  
}
}else{
$('#ArchivoPdf').css('border','2px solid #A52525');  
}

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
    <div class="float-left"><h4>AUDITORIA EXTERNA</h4></div>
    <div class="float-right" style="margin-top: 6px;margin-left: 10px;">
    <a onclick="ModalAgregar()" style="cursor: pointer;" data-toggle="tooltip" data-placement="left" title="Agregar" >
    <img src="<?php echo RUTA_IMG_ICONOS."agregar.png"; ?>">
    </a>
    </div>

    <div class="bg-white mt-5 p-3">
    <div id="DivContenido"></div>
    </div>

    </div>

    <div class="modal fade bd-example-modal-lg" id="ModalAgregar" >
<div class="modal-dialog modal-lg modal-dialog-centered" role="document">
<div class="modal-content" style="border-radius: 0px;border: 0px;">
 <div class="modal-header">
   <h4 class="modal-title">Crear auditoria externas</h4>
     <button type="button" class="close" data-dismiss="modal" aria-label="Close">
   <span aria-hidden="true">&times;</span>
 </button>
 </div>
 <div class="modal-body">

<div class="mb-2"><small class="text-secondary">* Nombre del prestador de servicio:</small></div>
<input class="form-control input-style rounded-0" type="text" id="PrestadorS">

<hr>
 
<small>* Descarga los siguientes formatos y carga cada uno al Sistema</small>

 

<div class="row justify-content-md-center row-cols-md-4 mt-3">
 
<div class="col-xl-4 col-lg-4 col-md-6 col-sm-12 mt-2 mb-2 div-hover"> 

<a href="<?=RUTA_ARCHIVOS_ADMONGAS."Fo.ADMONGAS.024.doc";?>" download>
<div class="bg-light text-center p-2 c-pointer">
<div ><img src="<?php echo RUTA_IMG_ICONOS."word.png"; ?>"></div>
<div class="pt-2 font-weight-bold text-dark">Fo.ADMONGAS.024</div>
</div>
</a>
</div>



<div class="col-xl-4 col-lg-4 col-md-6 col-sm-12 mt-2 mb-2 div-hover"> 
<a href="<?=RUTA_ARCHIVOS_ADMONGAS."Fo.ADMONGAS.025.docx";?>" download>
<div class="bg-light text-center p-2 c-pointer">
<div ><img src="<?php echo RUTA_IMG_ICONOS."word.png"; ?>"></div>
<div class="pt-2 font-weight-bold text-dark">Fo.ADMONGAS.025</div>
</div>
</a>
</div>

</div>


</div>
<div class="modal-footer">
<button type="button" class="btn btn-primary" style="border-radius: 0px;" onclick="BTNCrear()">Crear nueva</button>
</div>
</div>
</div>
</div>

 <div class="modal fade bd-example-modal-lg" id="ModalDetalle" >
<div class="modal-dialog modal-lg modal-dialog-centered" role="document">
<div class="modal-content" style="border-radius: 0px;border: 0px;">

<div id="ContenidoDetalle"></div>

</div>
</div>
</div>

  <script src="<?php echo RUTA_JS ?>bootstrap.min.js"></script>
  </body>
  </html>
