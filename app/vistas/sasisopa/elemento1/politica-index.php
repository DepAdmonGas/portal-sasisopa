<?php
require('app/help.php');
include_once "app/modelo/Ayuda.php";

$class_ayuda = new Ayuda();
$array_ayuda = $class_ayuda->sasisopaAyuda($Session_IDUsuarioBD,'1-politica');
$id_ayuda = $array_ayuda['id'];
$estado = $array_ayuda['estado'];

?>
<html lang="es">
  <head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
  <title>SASISOPA</title>
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
  background: url('imgs/iconos/load-img.gif') 50% 50% no-repeat rgb(249,249,249);
  }
  </style>
  <script type="text/javascript">
  $(document).ready(function(){
  $('[data-toggle="tooltip"]').tooltip();
  $(".LoaderPage").fadeOut("slow");
 <?php if ($id_ayuda != 0) {echo "btnAyuda();";} ?>

  ListaComprobacion();
  ListaAsistencia(1);
  });

  function regresarP(){
  window.history.back();
  }

  function ActualizarP(){
  window.location.href = '';
  }

  //---------------------------------------
  //--------------- MODAL AYUDA -----------
  function btnAyuda(){
  $('#myModalPolitica').modal('show');
  }

  function btnFinAyuda(idayuda, estado){

  var parametros = {
        "accion" : "actualizar-ayuda",
        "idayuda" : idayuda
      };

      if (idayuda != 0 && estado == 0) {

    $.ajax({
    data:  parametros,
    url:   'app/controlador/AyudaControlador.php',
    type:  'post',
    beforeSend: function() {
    },
    complete: function(){
    },
    success:  function (response) {

      if(response){
        $('#myModalPolitica').modal('hide');
      }
    
    }
    });

  }else{
  $('#myModalPolitica').modal('hide');
  }

  }
  //---------------------------------------
  //---------------------------------------



  //----------- EDITAR POLITICA------------
  //---------------------------------------
  function btnEditar(){
  $('#myModalEditarPolitica').modal('show');
  }

  function btnActualizar(){

var politica = $('#politica').val();
var mision = $('#mision').val();
var vision = $('#vision').val();

if (politica != "") {
$('#politica').css('border','');
if (mision != "") {
$('#mision').css('border','');
if (vision != "") {
$('#vision').css('border','');

var parametros = {
      "accion" : 'actualizar-politica',
      "politica" : politica,
      "mision" : mision,
      "vision" : vision
    };

alertify.confirm('',
function(){

$.ajax({
 data:  parametros,
 url:   'app/controlador/PoliticaControlador.php',
 type:  'post',
 beforeSend: function() {
 },
 complete: function(){
 },
 success:  function (response) {

  if(response){
    ActualizarP();
    alertify.message('La Política fue actualizada correctamente');
  }else{
    alertify.error('La Política no fue actualizada');
  }
 
 
 }
 });

},
function(){
}).setHeader('Actualizar Política').set({transition:'zoom',message: 'Desea actualizar la política de la estación',labels:{ok:'Aceptar', cancel: 'Cancelar'}}).show();

}else{
$('#vision').css('border','2px solid #A52525');
}
}else{
$('#mision').css('border','2px solid #A52525');
}
}else{
$('#politica').css('border','2px solid #A52525');
}
}
//--------------------------------------------
//--------------------------------------------
//------- DESCARGAR POLITICA -----------------
//--------------------------------------------
function btnDescargar(id){
window.location = "descargar-politica/" + id; 
}
//--------------------------------------------
//--------------------------------------------

//----------------------- Fo.ADMONGAS.001 (Lista de comprobación)
//---------------------------------------------------------------
function ListaComprobacion(){
  let targets = [1,2];
$('#DivListaComprobacion').load('app/vistas/sasisopa/elemento1/politica-lista-comprobacion.php', function() {
  $('#table_comprobacion').DataTable({
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

function btnLista(){
$('#myModalListaComprobacion').modal('show');  
}

function btnCrearListaC(){
var Fecha = $('#Fecha').val();
var R1 = $('#R1').val();
var R2 = $('#R2').val();
var R3 = $('#R3').val();
var R4 = $('#R4').val();
var R5 = $('#R5').val();
var R6 = $('#R6').val();
var R7 = $('#R7').val();
var Asistentes = $('#Asistentes').val();
var Comentarios = $('#Comentarios').val();

if(Fecha != ""){
$('#Fecha').css('border','');
if(R1 != ""){
$('#R1').css('border','');
if(R2 != ""){
$('#R2').css('border','');
if(R3 != ""){
$('#R3').css('border','');
if(R4 != ""){
$('#R4').css('border','');
if(R5 != ""){
$('#R5').css('border','');
if(R6 != ""){
$('#R6').css('border','');
if(R7 != ""){
$('#R7').css('border','');

var parametros = {
"accion" : 'agregar-lista-comprobacion',
"Fecha" : Fecha,
"R1" : R1,
"R2" : R2,
"R3" : R3,
"R4" : R4,
"R5" : R5,
"R6" : R6,
"R7" : R7,
"Asistentes" : Asistentes,
"Comentarios" : Comentarios
};

alertify.confirm('',
function(){

$.ajax({
 data:  parametros,
 url:   'app/controlador/PoliticaControlador.php',
 type:  'post',
 beforeSend: function() {
 },
 complete: function(){
 },
 success:  function (response) {

if(response){
alertify.message('Lista de comprobación fue creada correctamente');

ListaComprobacion();
$('#Fecha').val("");
$('#R1').val("");
$('#R2').val("");
$('#R3').val("");
$('#R4').val("");
$('#R5').val("");
$('#R6').val("");
$('#R7').val("");
$('#Asistentes').val("");
$('#Comentarios').val("");
$('#myModalListaComprobacion').modal('hide'); 

}else{
 alertify.error('Error al crear el registro'); 
}

 }
 });

},
function(){
}).setHeader('Lista de comprobación').set({transition:'zoom',message: 'Desea crear Lista de comprobación de la estación',labels:{ok:'Aceptar', cancel: 'Cancelar'}}).show();

}else{
$('#R7').css('border','2px solid #A52525');
}
}else{
$('#R6').css('border','2px solid #A52525');
}
}else{
$('#R5').css('border','2px solid #A52525');
}
}else{
$('#R4').css('border','2px solid #A52525');
}
}else{
$('#R3').css('border','2px solid #A52525');
}
}else{
$('#R2').css('border','2px solid #A52525');
}
}else{
$('#R1').css('border','2px solid #A52525');
}
}else{
$('#Fecha').css('border','2px solid #A52525');
}
}

function EditarRegistro(id){
$('#ModalDetalle').modal('show');
$('#DivDetalle').load('app/vistas/sasisopa/elemento1/modal-editar-lista-comprobacion.php?id=' + id);
}

function BtnEditar(id){
var EditFecha = $('#EditFecha').val();
var ER1 = $('#ER1').val();
var ER2 = $('#ER2').val();
var ER3 = $('#ER3').val();
var ER4 = $('#ER4').val();
var ER5 = $('#ER5').val();
var ER6 = $('#ER6').val();
var ER7 = $('#ER7').val();
var EditAsistentes = $('#EditAsistentes').val();
var EditComentarios = $('#EditComentarios').val();

if(EditFecha != ""){
$('#EditFecha').css('border','');
if(ER1 != ""){
$('#ER1').css('border','');
if(ER2 != ""){
$('#ER2').css('border','');
if(ER3 != ""){
$('#ER3').css('border','');
if(ER4 != ""){
$('#ER4').css('border','');
if(ER5 != ""){
$('#ER5').css('border','');
if(ER6 != ""){
$('#ER6').css('border','');
if(ER7 != ""){
$('#ER7').css('border','');

var parametros = {
"accion" : "editar-lista-comprobacion",
"id" : id,
"EditFecha" : EditFecha,
"ER1" : ER1,
"ER2" : ER2,
"ER3" : ER3,
"ER4" : ER4,
"ER5" : ER5,
"ER6" : ER6,
"ER7" : ER7,
"EditAsistentes" : EditAsistentes,
"EditComentarios" : EditComentarios
};

alertify.confirm('',
function(){

$.ajax({
 data:  parametros,
 url:   'app/controlador/PoliticaControlador.php',
 type:  'post',
 beforeSend: function() {
 },
 complete: function(){
 },
 success:  function (response) {

if(response){
alertify.message('Lista de comprobación fue editada correctamente');

ListaComprobacion();
$('#EditFecha').val("");
$('#ER1').val("");
$('#ER2').val("");
$('#ER3').val("");
$('#ER4').val("");
$('#ER5').val("");
$('#ER6').val("");
$('#ER7').val("");
$('#EditAsistentes').val("");
$('#EditComentarios').val("");
$('#ModalDetalle').modal('hide'); 

}else{
 alertify.error('Error al editar el registro'); 
}

 }
 });

},
function(){
}).setHeader('Lista de comprobación').set({transition:'zoom',message: 'Desea editar la Lista de comprobación de la estación',labels:{ok:'Aceptar', cancel: 'Cancelar'}}).show();

}else{
$('#ER7').css('border','2px solid #A52525');
}
}else{
$('#ER6').css('border','2px solid #A52525');
}
}else{
$('#ER5').css('border','2px solid #A52525');
}
}else{
$('#ER4').css('border','2px solid #A52525');
}
}else{
$('#ER3').css('border','2px solid #A52525');
}
}else{
$('#ER2').css('border','2px solid #A52525');
}
}else{
$('#ER1').css('border','2px solid #A52525');
}
}else{
$('#EditFecha').css('border','2px solid #A52525');
}
}

function EliminarRegistro(id){

var parametros = {
  "accion" : "eliminar-lista-comprobacion",
"id" : id
};

alertify.confirm('',
function(){

$.ajax({
 data:  parametros,
 url:   'app/controlador/PoliticaControlador.php',
 type:  'post',
 beforeSend: function() {
 },
 complete: function(){
 },
 success:  function (response) {

if(response == 1){
alertify.message('Lista de comprobación eliminada');
ListaComprobacion();

}else{
 alertify.error('Error al eliminar el registro'); 
}
}
});

},
function(){
}).setHeader('Lista de comprobación').set({transition:'zoom',message: 'Desea crear Lista de comprobación de la estación',labels:{ok:'Aceptar', cancel: 'Cancelar'}}).show();
}

function DescargarRegistro(id){
window.location = "descargar-lista-comprobacion/" + id; 
}
//---------------------------------------------------------------
//---------------------------------------------------------------

//------------------------- LISTA ASISTENCIA --------------------
//---------------------------------------------------------------
function ListaAsistencia(idSasisopa){
  let targets = [1,2,3];
$('#DivListaAsistencia').load('app/vistas/sasisopa/asistencia/lista-asistencia.php?idSasisopa=' + idSasisopa, function() {
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

function EditarAsistencia(id){
window.location = "lista-asistencia/" + id; 
}

function btnAsistencia(){
var parametros = {
  "accion" : "agregar-lista-asistencia",
 "PuntoSasisopa" : 1
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

function EliminarAsistencia(id){

  var parametros = {
    "accion" : "eliminar-lista-asistencia",
    "id" : id
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

    if (response) {
    ListaAsistencia(1)
    }else{
    alertify.error('Error al eliminar')
    }

     }
     });
}

  function DescargarAsistencia(id){
  window.location = "descargar-lista-asistencia/" + id;   
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
  <li onclick="btnEditar()"><a class="dropdown-item c-pointer"> <i class="fa-regular fa-pen-to-square"></i> Editar 1. Politica</a></li>
  <li onclick="btnDescargar(<?=$Session_IDEstacion;?>)"><a class="dropdown-item c-pointer"> <i class="fa-regular fa-circle-down"></i> Descargar 1. Politica</a></li>
  </ul>
  </div>
  </div>
  <!-- Fin -->

  <!-- Inicio -->
  <div aria-label="breadcrumb" style="padding-left: 0; margin-bottom: 0;">
  <ol class="breadcrumb breadcrumb-caret">
  <li class="breadcrumb-item text-primary c-pointer" onclick="regresarP()"><i class="fa-solid fa-house"></i> SASISOPA</li>
  <li aria-current="page" class="breadcrumb-item active">1. POLÍTICA</li>
  </ol>
  </div>
  <!-- Fin -->

  <h3>1. POLÍTICA</h3>

    <div class="row mt-3">

    <div class="col-xl-4 col-lg-4 col-md-12 col-sm-12">
      <div class="card border-0 rounded-0">
      <div class="p-4">
      <h4 class="text-primary">Politica:</h4>
      <p class="fw-light fs-5"><?=$Session_Politica;?></p>
      </div>
      </div>
    </div>

    <div class="col-xl-4 col-lg-4 col-md-12 col-sm-12 mt-2 mb-2">
      <div class="card border-0 rounded-0">
      <div class="p-3">
      <h4 class="text-primary">Misión:</h4>
      <p class="fw-light fs-5"><?=$Session_Mision;?></p>
      </div>
      </div>
    </div>

    <div class="col-xl-4 col-lg-4 col-md-12 col-sm-12 mt-2 mb-2">
      <div class="card border-0 rounded-0">
      <div class="p-3">
      <h4 class="text-primary">Visión:</h4>
      <p class="fw-light fs-5"><?=$Session_Vision;?></p>
      </div>
      </div>
    </div>

    </div>

    <div class="row mt-4">
      <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12 mt-2">
      <div class="bg-white">
            <div class="p-3">
            
            <div class="row">  
            <div class="col-11">
            <h5 class="text-primary">Fo.ADMONGAS.001 (Lista de comprobación)</h5>
            </div>
            <div class="col-1 text-end">
            <a onclick="btnLista()" style="cursor: pointer;" data-toggle="tooltip" data-placement="left" title="Crear" >
            <img src="<?php echo RUTA_IMG_ICONOS."agregar.png"; ?>">
            </a>
            </div>           
            </div>

             <div id="DivListaComprobacion"></div>
          </div>
      </div>
      </div>

      <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12 mt-2">
           
          <div class="bg-white">
            <div class="p-3">  
            <div class="row">

            <div class="col-11">
            <h5 class="text-primary">Fo.ADMONGAS.010 (Registro de la atención y el seguimiento a la comunicación interna y externa.)</h5>
            </div>
            <div class="col-1 text-end">
            <a class="" onclick="btnAsistencia()" style="cursor: pointer;" data-toggle="tooltip" data-placement="left" title="Crear" >
            <img src="<?php echo RUTA_IMG_ICONOS."agregar.png"; ?>">
            </a>
            </div> 

            </div>
            <div id="DivListaAsistencia"></div>
            </div>            
          </div>

      </div>

    </div>

  </div>


  <div class="modal fade bd-example-modal-lg" id="myModalPolitica" data-backdrop="static">
    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
      <div class="modal-content" style="border-radius: 0px;border: 0px;">
        <div class="modal-header rounded-0 head-modal">
          <h4 class="modal-title text-white">Bienvenido al elemento 1. POLITICA, del Sistema de Administración</h4>
        </div>
        <div class="modal-body">

          <p class="text-justify" style="font-size: 1.1em">
            Aquí vas a encontrar la política de tu empresa acorde a los requisitos solicitados en las Disposiciones Administrativas de Carácter General <b>(DACG)</b>, Sistemas de Administración de Seguridad Industrial, Seguridad Operativa y Protección al Medio Ambiente <b>(SASISOPA)</b>.
          </p>
          <p class="text-justify" style="font-size: 1.1em">
            La política debe ser comunicada a todo el personal incluyendo clientes, prestadores de servicios y proveedores.
          </p>

          <hr>

          <label class="font-weight-bold" style="font-size: 1.1em">Como hacerlo:</label>
          <ul style="font-size: 1.1em">
            <li>Elegir un día a la semana para comunicar política en una plática de 5 minutos</li>
            <li>Imprimir y colocar en el tablón de anuncios de la estación</li>
            <li>Subirla a la página web (en caso de contar)</li>
            <li>Elaborar trípticos y distribuirlos entre los empleados</li>
          </ul>

          <hr>

          <label class="font-weight-bold" style="font-size: 1.1em">Responsables:</label>
          <p class="text-justify" style="font-size: 1.1em">Recuerda que es responsabilidad del <label class="text-danger font-weight-bold">Representante Técnico</label> (RT), <label class="text-danger font-weight-bold">Gerente de la Estación</label> y <label class="text-danger font-weight-bold">Jefes de Piso</label>, comunicar la política a todas las partes interesadas.</p>


        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-primary" style="border-radius: 0px;" onclick="btnFinAyuda(<?=$id_ayuda;?>,<?=$estado;?>)">Aceptar</button>
        </div>
      </div>
    </div>
    </div>

<div class="modal fade bd-example-modal-lg" id="myModalEditarPolitica" >
<div class="modal-dialog modal-lg modal-dialog-centered" role="document">
<div class="modal-content" style="border-radius: 0px;border: 0px;">
<div class="modal-header rounded-0 head-modal">
<h4 class="modal-title text-white">Editar 1. POLITICA</h4>
<button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
 </div>
 <div class="modal-body">

 <div class="form-group">
 <label for="politica" class="text-secondary">Política:</label>
 <textarea class="form-control" rows="6" id="politica" style="border-radius: 0px;"><?=$Session_Politica;?></textarea>
 </div>

 <div class="form-group">
 <label for="mision" class="text-secondary">Misión:</label>
 <textarea class="form-control" rows="5" id="mision" style="border-radius: 0px;"><?=$Session_Mision;?></textarea>
 </div>

 <div class="form-group">
 <label for="vision" class="text-secondary">Visión:</label>
 <textarea class="form-control" rows="5" id="vision" style="border-radius: 0px;"><?=$Session_Vision;?></textarea>
 </div>

 </div>
 <div class="modal-footer">
 <button type="button" class="btn btn-primary" style="border-radius: 0px;" onclick="btnActualizar()">Actualizar</button>
 </div>
</div>
</div>
</div>

<div class="modal fade bd-example-modal-lg" id="myModalListaComprobacion" data-backdrop="static">
<div class="modal-dialog modal-lg modal-dialog-centered" role="document">
<div class="modal-content" style="border-radius: 0px;border: 0px;">

<div class="modal-header rounded-0 head-modal">
<h4 class="modal-title text-white">Lista de comprobación</h4>
<button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
</div>

<div class="modal-body">

<b>Fecha:</b>
<input type="date" class="form-control rounded-0 mt-2 mb-2" id="Fecha">

<div class="mb-2" style="overflow-y: hidden;">
<table class="table table-bordered table-sm mt-3">
  <thead>
    <tr>
      <th class="text-center">Criterio</th>
      <th class="text-center">Resultado</th>
    </tr>
  </thead>
  <tbody>
    <tr>
      <td class="align-middle">La política es adecuada a la naturaleza magnitud y actividades del proyecto</td>
      <td class="p-0 align-middle">
        <select class="form-control rounded-0 " id="R1">
          <option value="">Selecciona</option>
          <option value="Si">Si</option>
          <option value="En Parte">En Parte</option>
          <option value="No">No</option>
        </select>
      </td>
    </tr>

    <tr>
      <td class="align-middle">La política incluye la seguridad operativa </td>
      <td class="p-0 align-middle">
        <select class="form-control rounded-0" id="R2">
          <option value="">Selecciona</option>
          <option value="Si">Si</option>
          <option value="En Parte">En Parte</option>
          <option value="No">No</option>
        </select>
      </td>
    </tr>

    <tr>
      <td class="align-middle">La política incluye la protección al medio ambiente </td>
      <td class="p-0 align-middle">
        <select class="form-control rounded-0" id="R3">
          <option value="">Selecciona</option>
          <option value="Si">Si</option>
          <option value="En Parte">En Parte</option>
          <option value="No">No</option>
        </select>
      </td>
    </tr>

    <tr>
      <td class="align-middle">Los trabajadores, la alta dirección, los clientes y los subcontratistas tienen conocimiento de la política </td>
      <td class="p-0 align-middle">
        <select class="form-control rounded-0" id="R4">
          <option value="">Selecciona</option>
          <option value="Si">Si</option>
          <option value="En Parte">En Parte</option>
          <option value="No">No</option>
        </select>
      </td>
    </tr>

      <tr>
      <td class="align-middle">La política se revisa periódicamente </td>
      <td class="p-0 align-middle">
        <select class="form-control rounded-0" id="R5">
          <option value="">Selecciona</option>
          <option value="Si">Si</option>
          <option value="En Parte">En Parte</option>
          <option value="No">No</option>
        </select>
      </td>
    </tr>

    <tr>
      <td class="align-middle">La política se compromete al control de los peligros e impactos ambientales </td>
      <td class="p-0 align-middle">
        <select class="form-control rounded-0" id="R6">
          <option value="">Selecciona</option>
          <option value="Si">Si</option>
          <option value="En Parte">En Parte</option>
          <option value="No">No</option>
        </select>
      </td>
    </tr>

        <tr>
      <td class="align-middle">La política considera la participación del personal </td>
      <td class="p-0 align-middle">
        <select class="form-control rounded-0" id="R7">
          <option value="">Selecciona</option>
          <option value="Si">Si</option>
          <option value="En Parte">En Parte</option>
          <option value="No">No</option>
        </select>
      </td>
    </tr>

    <tr>
      
      <td colspan="2" class="p-2">
        <b>Asistentes:</b>
        <textarea class="form-control rounded-0 mt-2 mb-2" id="Asistentes"></textarea>
      </td>
    </tr>

    <tr>
      <td colspan="2" class="p-2">
        <b>Comentarios:</b>
        <textarea class="form-control rounded-0 mt-2 mb-2" id="Comentarios"></textarea>
      </td>
    </tr>

  </tbody>
</table>
</div>

 </div>
 <div class="modal-footer">
   <button type="button" class="btn btn-primary" style="border-radius: 0px;" onclick="btnCrearListaC()">Guardar</button>
 </div>
</div>
</div>
</div>

    <div class="modal fade bd-example-modal-lg" id="ModalDetalle" data-backdrop="static">
    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
      <div class="modal-content" style="border-radius: 0px;border: 0px;">
      <div id="DivDetalle"></div>
      </div>
    </div>
    </div>

  <script src="<?=RUTA_JS?>bootstrap.min.js"></script>
    <!---------- LIBRERIAS DEL DATATABLE ---------->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/pdfmake.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/vfs_fonts.js"></script>
  <script src="https://cdn.datatables.net/v/bs5/jszip-3.10.1/dt-2.0.3/b-3.0.1/b-colvis-3.0.1/b-html5-3.0.1/b-print-3.0.1/datatables.min.js"></script>
  
  </body>
  </html>
