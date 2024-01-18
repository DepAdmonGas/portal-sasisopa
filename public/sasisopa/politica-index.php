<?php
require('app/help.php');

$sql_sasisopa_ayuda = "SELECT * FROM pu_sasisopa_ayuda WHERE id_usuario = '".$Session_IDUsuarioBD."' and detalle = '1-politica' and estado = 0 LIMIT 1";
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
  </style>
  <script type="text/javascript">
  $(document).ready(function(){
  $('[data-toggle="tooltip"]').tooltip();
  $(".LoaderPage").fadeOut("slow");
 <?php if ($numero_sasisopa_ayuda == 1) {echo "btnAyuda();";} ?>

  ListaComprobacion();
  ListaAsistencia(1);
  });

  function regresarP(){
   window.history.back();
  }

  function ActualizarP(){
window.location.href = '';
  }

  function btnAyuda(){
  $('#myModalPolitica').modal('show');
  }

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
      "idEstacion" : <?=$Session_IDEstacion; ?>,
      "politica" : politica,
      "mision" : mision,
      "vision" : vision
    };

alertify.confirm('',
function(){

$.ajax({
 data:  parametros,
 url:   'public/sasisopa/actualizar/actualizar-politica.php',
 type:  'post',
 beforeSend: function() {
 },
 complete: function(){
 },
 success:  function (response) {

 alertify.message('La Política fue actualizada correctamente');
 window.setTimeout("ActualizarP()",1000);
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
   $('#myModalPolitica').modal('hide');
   }
   });

  }else{
  $('#myModalPolitica').modal('hide');
  }

}

function btnDescargar(id){
window.location = "descargar-politica/" + id; 
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
 url:   'public/sasisopa/agregar/agregar-lista-comprobacion.php',
 type:  'post',
 beforeSend: function() {
 },
 complete: function(){
 },
 success:  function (response) {

if(response == 1){
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

function ListaComprobacion(){
$('#DivListaComprobacion').load('public/sasisopa/vistas/politica-lista-comprobacion.php');  
}

function EliminarRegistro(id){

var parametros = {
"id" : id
};

alertify.confirm('',
function(){

$.ajax({
 data:  parametros,
 url:   'public/sasisopa/eliminar/eliminar-lista-comprobacion.php',
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

  

  function btnAsistencia(){

  var parametros = {
   "PuntoSasisopa" : 1
   };

   $.ajax({
   data:  parametros,
   url:   'public/sasisopa/agregar/agregar-lista-asistencia.php',
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

function ListaAsistencia(idSasisopa){
$('#DivListaAsistencia').load('public/sasisopa/vistas/lista-asistencia.php?idSasisopa=' + idSasisopa); 
} 
function EditarAsistencia(id){
window.location = "lista-asistencia/" + id; 
}

function EliminarAsistencia(id){

  var parametros = {
    "id" : id
    };

 $.ajax({
     data:  parametros,
     url:   'public/sasisopa/eliminar/eliminar-lista-asistencia.php',
     type:  'post',
     beforeSend: function() {
     },
     complete: function(){
    
     },
     success:  function (response) {

    if (response == 1) {
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

function EditarRegistro(id){
$('#ModalDetalle').modal('show');
$('#DivDetalle').load('public/sasisopa/vistas/modal-editar-lista-comprobacion.php?id=' + id);
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
 url:   'public/sasisopa/agregar/editar-lista-comprobacion.php',
 type:  'post',
 beforeSend: function() {
 },
 complete: function(){
 },
 success:  function (response) {

if(response == 1){
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

  </script>
  </head>
  <body>

    <div class="LoaderPage"></div>
    <div class="fixed-top navbar-admin">
    <?php require('public/componentes/header.menu.php'); ?>
    </div>

    <div class="magir-top-principal">

<div class="row no-gutters">

<div class="col-12 col-sm-12">
<div class="card adm-card" style="border: 0;">
<div class="adm-car-title">

<div class="float-left" style="padding-right: 20px;margin-top: 5px;">
      <a onclick="regresarP()" style="cursor: pointer;" data-toggle="tooltip" data-placement="right" title="Regresar"><img src="<?php echo RUTA_IMG_ICONOS."regresar.png"; ?>"></a>
      </div>
    <div class="float-left"><h4>1. POLÍTICA</h4></div>
    <div class="float-right" style="margin-top: 6px;margin-left: 10px;">
    <a onclick="btnAyuda()" style="cursor: pointer;" data-toggle="tooltip" data-placement="left" title="Ayuda" >
    <img src="<?php echo RUTA_IMG_ICONOS."info.png"; ?>">
    </a>
    </div>
    <div class="float-right" style="margin-top: 6px;">

    <a class="mr-2" onclick="btnDescargar(<?=$Session_IDEstacion;?>)" style="cursor: pointer;" data-toggle="tooltip" data-placement="left" title="Descargar 1. Politica" >
    <img src="<?php echo RUTA_IMG_ICONOS."pdf.png"; ?>">
    </a>

    <a onclick="btnEditar()" style="cursor: pointer;" data-toggle="tooltip" data-placement="left" title="Editar 1. Politica" >
    <img src="<?php echo RUTA_IMG_ICONOS."editar.png"; ?>">
    </a>
    </div>
      </div>

<div class="card-body">

<div class="row">

    <div class="col-xl-4 col-lg-4 col-md-12 col-sm-12 mt-2 mb-2">

      <div class="card" style="border-radius: 0px;">
      <div class="card-title" style="padding-left: 20px;padding-right: 20px;padding-top: 10px;padding-bottom: 0px;margin-bottom: 0px;">
      <div class="float-left"><h5>Politica:</h5></div>
      </div>
      <div class="card-body text-justify" style="padding-left: 20px;padding-right: 20px;padding-top: 10px;padding-bottom: 10px;">
      <p style="font-size: 1.1em;"><?=$Session_Politica;?></p>
      </div>
      </div>

    </div>

    
    <div class="col-xl-4 col-lg-4 col-md-12 col-sm-12 mt-2 mb-2">

      <div class="card" style="border-radius: 0px;">
      <div class="card-title" style="padding-left: 20px;padding-right: 20px;padding-top: 10px;padding-bottom: 0px;margin-bottom: 0px;">
      <div class="float-left"><h5>Misión:</h5></div>
      </div>
      <div class="card-body" style="padding-left: 20px;padding-right: 20px;padding-top: 10px;padding-bottom: 10px;">
      <p style="font-size: 1.1em;"><?=$Session_Mision;?></p>
      </div>
      </div>

    </div>

    <div class="col-xl-4 col-lg-4 col-md-12 col-sm-12 mt-2 mb-2">

      <div class="card" style="border-radius: 0px;">
      <div class="card-title" style="padding-left: 20px;padding-right: 20px;padding-top: 10px;padding-bottom: 0px;margin-bottom: 0px;">
      <div class="float-left"><h5>Visión:</h5></div>
      </div>
      
      <div class="card-body" style="padding-left: 20px;padding-right: 20px;padding-top: 10px;padding-bottom: 10px;">
       <p style="font-size: 1.1em;"><?=$Session_Vision;?></p>
      </div>
      </div>

      </div>
    </div>


      <hr>

      <div class="row">
         
      <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12 mt-2 mb-2">
            
            <div class="border">
            <div class="p-3">
            
            <div class="row">
  
            <div class="col-10">
              <h5>Fo.ADMONGAS.001 (Lista de comprobación)</h5>
            </div>

            <div class="col-2">

            <a class="float-right" onclick="btnLista()" style="cursor: pointer;" data-toggle="tooltip" data-placement="left" title="Crear" >
           
            <img src="<?php echo RUTA_IMG_ICONOS."agregar.png"; ?>">
            </a>

            </div>
            
            </div>
 
        <div id="DivListaComprobacion"></div>

          </div>
            
          </div>
      </div>



        <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12 mt-2 mb-2">
          
 
          <div class="border">
            <div class="p-3">
            
 
            <div class="row">

            <div class="col-10">
              <h5>Fo.ADMONGAS.010 (Registro de la atención y el seguimiento a la comunicación interna y externa.)</h5>
            </div>

            <div class="col-2">
           
            <a class="float-right" onclick="btnAsistencia()" style="cursor: pointer;" data-toggle="tooltip" data-placement="left" title="Crear" >
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
    </div>
    </div>
    </div>
    </div>

  <div class="modal fade bd-example-modal-lg" id="myModalPolitica" data-backdrop="static">
    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
      <div class="modal-content" style="border-radius: 0px;border: 0px;">
        <div class="modal-header">
          <h4 class="modal-title">Bienvenido al elemento 1. POLITICA, del Sistema de Administración</h4>
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
          <button type="button" class="btn btn-primary" style="border-radius: 0px;" onclick="btnFinAyuda()">Aceptar</button>
        </div>
      </div>
    </div>
    </div>

<div class="modal fade bd-example-modal-lg" id="myModalEditarPolitica" >
<div class="modal-dialog modal-lg modal-dialog-centered" role="document">
<div class="modal-content" style="border-radius: 0px;border: 0px;">
 <div class="modal-header">
   <h4 class="modal-title">Editar 1. POLITICA</h4>
     <button type="button" class="close" data-dismiss="modal" aria-label="Close">
   <span aria-hidden="true">&times;</span>
 </button>
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
 <div class="modal-header">
   <h4 class="modal-title">Lista de comprobación</h4>
     <button type="button" class="close" data-dismiss="modal" aria-label="Close">
   <span aria-hidden="true">&times;</span>
 </button>
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


  <script src="<?php echo RUTA_JS ?>bootstrap.min.js"></script>
  </body>
  </html>
