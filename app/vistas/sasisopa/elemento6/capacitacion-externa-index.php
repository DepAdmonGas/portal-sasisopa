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
  background: url('imgs/iconos/load-img.gif') 50% 50% no-repeat rgb(249,249,249);
}
 
#Trabajadores{
  display: none;
}
  </style>
  <script type="text/javascript">
  $(document).ready(function(){
  $('[data-toggle="tooltip"]').tooltip();
  $(".LoaderPage").fadeOut("slow");
  ListaCursos();

  });
  function regresarP(){
  window.history.back();
  }

  function ListaCursos(){    
  $('#ListaCursos').load('app/vistas/sasisopa/elemento6/lista-capacitacion-externa.php');
  }

  function btnModal(){
  $('#ModalCapacitacion').modal('show');
  $('#Contenidomodal').load('app/vistas/sasisopa/elemento6/formulario-agregar-capacitacion-externa.php');
  }

  function btnAgregar(){

var Curso = $('#Curso').val();
var FechaCurso = $('#FechaCurso').val();
var Duracion = $('#Duracion').val();
var DuracionDetalle = $('#DuracionDetalle').val();
var Instructor = $('#Instructor').val();

if (Curso != "") {
$('#Curso').css('border',''); 
if (FechaCurso != "") {
$('#FechaCurso').css('border',''); 

var parametros = {
        "accion" : "agregar-capacitacion-externa",
        "Curso" : Curso,
        "FechaCurso" : FechaCurso,
        "Duracion" : Duracion,
        "DuracionDetalle" : DuracionDetalle,
        "Instructor" : Instructor
    };

$.ajax({
data:  parametros,
url:   'app/controlador/CapacitacionControlador.php',
type:  'post',
beforeSend: function() {
},
complete: function(){
},
success:  function (response) {
$('#ModalCapacitacion').modal('hide');
alertify.success('Se agrego el curso correctamente ');
ListaCursos();
}
});

}else{
$('#FechaCurso').css('border','2px solid #A52525');  
}
}else{
$('#Curso').css('border','2px solid #A52525');  
}

}

function Editar(id){
$('#ModalCapacitacion').modal('show');
 $('#Contenidomodal').load('app/vistas/sasisopa/elemento6/formulario-editar-capacitacion-externa.php?idCapacitacion=' + id);

}

function btnEditar(id){
var Curso = $('#Curso').val();
var FechaCurso = $('#FechaCurso').val();
var Duracion = $('#Duracion').val();
var DuracionDetalle = $('#DuracionDetalle').val();
var Instructor = $('#Instructor').val();
var FechaCursoReal = $('#FechaCursoReal').val();


if (Curso != "") {
$('#Curso').css('border',''); 
if (FechaCurso != "") {
$('#FechaCurso').css('border',''); 

var parametros = {
        "accion" : "editar-capacitacion-externa",
        "idCurso" : id,
        "Curso" : Curso,
        "FechaCurso" : FechaCurso,
        "Duracion" : Duracion,
        "DuracionDetalle" : DuracionDetalle,
        "Instructor" : Instructor,
        "FechaCursoReal" : FechaCursoReal
      };

   $.ajax({
   data:  parametros,
   url:   'app/controlador/CapacitacionControlador.php',
   type:  'post',
   beforeSend: function() {
   },
   complete: function(){
   },
   success:  function (response) {
   $('#ModalCapacitacion').modal('hide');
   alertify.success('Se edito el curso correctamente ');
   ListaCursos();
   }
   });

}else{
$('#FechaCurso').css('border','2px solid #A52525');  
}
}else{
$('#Curso').css('border','2px solid #A52525');  
}
}

function Personal(id){
$('#ModalCapacitacion').modal('show'); 
$('#Contenidomodal').load('app/vistas/sasisopa/elemento6/lista-personal-capacitacion-externa.php?idCapacitacion=' + id);
}

function AgregarPersonal(idCapacitacion){

var IdPersonal = $('#IdPersonal').val();

if (IdPersonal != "") {
$('#IdPersonal').css('border',''); 

alertify.confirm('',
  function(){

    var parametros = {
        "accion" : "agregar-personal-capacitacion-externa",
        "idCapacitacion" : idCapacitacion,
        "IdPersonal" : IdPersonal
      };

   $.ajax({
   data:  parametros,
   url:   'app/controlador/CapacitacionControlador.php',
   type:  'post',
   beforeSend: function() {
   },
   complete: function(){
   },
   success:  function (response) {

   alertify.success('Se agrego el trabajador correctamente ');
   $('#Contenidomodal').load('app/vistas/sasisopa/elemento6/lista-personal-capacitacion-externa.php?idCapacitacion=' + idCapacitacion);

   }
   });

  },
  function(){
  }).setHeader('Agregar personal').set({transition:'zoom',message: 'Desea agregar al trabajador seleccionado',labels:{ok:'Aceptar', cancel: 'Cancelar'}}).show();



}else{
$('#IdPersonal').css('border','2px solid #A52525');  
}

}

function EliminarPersonal(id, idCapacitacion){

alertify.confirm('',
  function(){

    var parametros = {
      "accion" : "eliminar-personal-capacitacion-externa",
        "id" : id
      };

   $.ajax({
   data:  parametros,
   url:   'app/controlador/CapacitacionControlador.php',
   type:  'post',
   beforeSend: function() {
   },
   complete: function(){
   },
   success:  function (response) {
   alertify.success('Se elimino el trabajador correctamente ');
  $('#Contenidomodal').load('app/vistas/sasisopa/elemento6/lista-personal-capacitacion-externa.php?idCapacitacion=' + idCapacitacion);
   }
   });

  },
  function(){
  }).setHeader('Eliminar personal').set({transition:'zoom',message: 'Desea eliminar el trabajador seleccionado',labels:{ok:'Aceptar', cancel: 'Cancelar'}}).show();

}

function EliminarRegistro(id){

alertify.confirm('',
  function(){

    var parametros = {
        "accion" : "eliminar-capacitacion-externa",
        "id" : id
      };

   $.ajax({
   data:  parametros,
   url:   'app/controlador/CapacitacionControlador.php',
   type:  'post',
   beforeSend: function() {
   },
   complete: function(){
   },
   success:  function (response) {
    ListaCursos();
   }
   });

  },
  function(){
  }).setHeader('Mensaje').set({transition:'zoom',message: '¿Desea eliminar la información?',labels:{ok:'Aceptar', cancel: 'Cancelar'}}).show();

}

function DescargarRegistro(id){
window.location = "descargar-capacitacion-externa/" + id; 
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
    <div class="float-left"><h4>CAPACITACIÓN EXTERNA</h4></div>
    <div class="float-right" style="margin-top: 6px;margin-left: 10px;">
    <a onclick="btnModal()" style="cursor: pointer;" data-toggle="tooltip" data-placement="left" title="Agregar" >
    <img src="<?php echo RUTA_IMG_ICONOS."agregar.png"; ?>">
    </a>
    </div>
      </div>
    <div class="card-body">

<div class="mb-3" style="overflow-y: hidden;">
<table class="table table-bordered table-sm">
<tr>
<td class="text-center align-middle"><img class="text-center" src="<?php echo RUTA_IMG_LOGOS."Logo.png";?>" style="width: 200px;"></td>
<td colspan="2" class="text-center align-middle"><b>Programa de Capacitacion y adiestramiento </b></td>
<td class="text-center align-middle">Fo.ADMONGAS.009</td>
</tr>
<tr>
<td class="text-center align-middle">Realizado por: Nelly Estrada Garcia </td>
<td class="text-center align-middle">Revisado por: Eduardo Galicia Flores </td>
<td class="text-center align-middle">Autorizado por: Tomas Tarno Quinzaños </td>
<td class="text-center align-middle">Fecha de autorizacion 01/10/2018</td>
</tr>
</table>
</div>


<div id="ListaCursos"></div>


    </div>
    </div>
    </div>
    </div>
    </div>


    <div class="modal fade bd-example-modal-lg" id="ModalCapacitacion" >
<div class="modal-dialog modal-lg modal-dialog-centered" role="document">
<div class="modal-content" style="border-radius: 0px;border: 0px;">
<div id="Contenidomodal"></div>

</div>
</div>
</div>


  <script src="<?php echo RUTA_JS ?>bootstrap.min.js"></script>
  </body>
  </html>
