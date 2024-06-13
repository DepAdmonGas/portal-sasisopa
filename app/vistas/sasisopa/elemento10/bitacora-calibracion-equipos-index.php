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
  .hovercolor:hover{
  background: rgba(0, 120, 238, .8) !important;
  }

  .cont-puntos{
    border-bottom: 3px solid #3399cc;
    box-shadow: 1px 1px 5px #EDEDED;
  }

  .titulo-punto{
    font-size: 1.25em;
  }
  </style>
  <script type="text/javascript">
  $(document).ready(function(){
  $('[data-toggle="tooltip"]').tooltip();
  $(".LoaderPage").fadeOut("slow");
  ListaCalibracionEquipos();
  });

  function regresarP(){
  window.history.back();
  }

  function ListaCalibracionEquipos(){
  $('#ListaCalibracionEquipos').load('app/vistas/sasisopa/elemento10/lista-calibracion-equipos.php');
  }

  function ModalAgregar(){
  $('#Modal').modal('show');
  $('#ContenidoModal').load('app/vistas/sasisopa/elemento10/modal-agregar-calibracion-equipos.php');
  }

  function BtnAgregar(){
  let Equipo = $('#Equipo').val();

  if (Equipo != "") {
  $('#Equipo').css('border','');

  var parametros = {
      "accion" : "agregar-calibracion-equipos",
      "Equipo" : Equipo
    };

alertify.confirm('',
function(){

$.ajax({
 data:  parametros,
 url:   'app/controlador/ControlActividadProcesoControlador.php',
 type:  'post',
 beforeSend: function() {
 },
 complete: function(){
 },
 success:  function (response) {

  if(Equipo == 'Dispensario'){
  window.location.href = "bitacora-calibracion-equipos-dispensario/" + response;  
  }else if(Equipo == 'Jarra patron'){
  window.location.href = "bitacora-calibracion-equipos-jarra-patron/" + response;  
  }else if(Equipo == 'Sondas de medición'){
  window.location.href = "bitacora-calibracion-equipos-sonda/" + response;  
  }else if(Equipo == 'Tanques de almacenamiento'){
  window.location.href = "bitacora-calibracion-equipos-tanques-almacenamiento/" + response;  
  }
  
 }
 });

},
function(){
}).setHeader('Mensaje').set({transition:'zoom',message: 'Desea agregar la calibración',labels:{ok:'Aceptar', cancel: 'Cancelar'}}).show();

  }else{
  $('#Equipo').css('border','2px solid #A52525');
  }

  }

  function Editar(id,Equipo){
  if(Equipo == 'Dispensario'){
  window.location.href = "bitacora-calibracion-equipos-dispensario/" + id;  
  }else if(Equipo == 'Jarra patron'){
  window.location.href = "bitacora-calibracion-equipos-jarra-patron/" + id;  
  }else if(Equipo == 'Sondas de medición'){
  window.location.href = "bitacora-calibracion-equipos-sonda/" + id;  
  }else if(Equipo == 'Tanques de almacenamiento'){
  window.location.href = "bitacora-calibracion-equipos-tanques-almacenamiento/" + id;  
  }
  }

  function Detalle(id,Equipo){
  $('#Modal').modal('show');
  $('#ContenidoModal').load('app/vistas/sasisopa/elemento10/modal-detalle-calibracion-equipos.php?ID=' + id);
  }

  function Adjuntar(id){
  $('#Modal').modal('show');
  $('#ContenidoModal').load('app/vistas/sasisopa/elemento10/modal-agregar-resultados-calibracion.php?ID=' + id);
  }

  function AgregarR(id){

var data = new FormData();
var url = "app/controlador/ControlActividadProcesoControlador.php";

var Archivo = document.getElementById("Archivo");
var file = Archivo.files[0];
var filePath = Archivo.value;
var valpdf = filePath.split('.').pop();

if (filePath != "") {
$('#Archivo').css('border','');
if (valpdf == "pdf") {
$('#Archivo').css('border','');
$('#DivResultadoPDF').html('');

data.append('accion', 'agregar-resultados-calibracion');
data.append('id', id);
data.append('file', file);

$.ajax({
url: url,
type: 'POST',
contentType: false,
data: data,
processData: false,
cache: false
}).done(function(data){

ListaCalibracionEquipos()
Adjuntar(id)

});

}else{
$('#Archivo').css('border','2px solid #A52525');
$('#DivResultadoPDF').html('<label class="text-danger">Solo acepta formato PDF</label>');
}
}else{
$('#Archivo').css('border','2px solid #A52525');
}

}
  
  function ModalBuscar(){
  $('#Modal').modal('show');
  $('#ContenidoModal').load('app/vistas/sasisopa/elemento10/modal-buscar-calibracion-equipos.php');
  }

  function BtnBuscar(){
   let Year = $('#Year').val(); 
  if (Year != "") {
  $('#Year').css('border','');
  Descargar(Year)
  $('#Modal').modal('hide');
  }else{
  $('#Year').css('border','2px solid #A52525');
  }
  }

  function Descargar(Year){
  window.location.href = "descargar-bitacora-calibracion-equipos/" + Year;  
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
    <!-- TITULO / ENCABEZADO -->
    <div class="float-left">
    <h4>Bitácora calibración de equipos</h4>
    </div>
    <div class="float-right" style="margin-top: 6px;margin-left: 10px;">
    <a onclick="ModalAgregar()" style="cursor: pointer;" data-toggle="tooltip" data-placement="left" title="Agregar" >
    <img src="<?php echo RUTA_IMG_ICONOS."agregar.png"; ?>">
    </a>
    </div>
    <div class="float-right" style="margin-top: 6px;margin-left: 10px;">
    <a onclick="ModalBuscar()" style="cursor: pointer;" data-toggle="tooltip" data-placement="left" title="Buscar" >
    <img src="<?php echo RUTA_IMG_ICONOS."lupa.png"; ?>">
    </a>
    </div>

    <div class="mt-5 p-3 bg-white">
    <div id="ListaCalibracionEquipos"></div>
    </div>

    </div>

<div class="modal fade bd-example-modal-lg" id="Modal" >
<div class="modal-dialog modal-lg modal-dialog-centered" role="document">
<div class="modal-content" style="border-radius: 0px;border: 0px;">
<div id="ContenidoModal"></div>

</div>
</div>
</div>


  <script src="<?php echo RUTA_JS ?>bootstrap.min.js"></script>
  </body>
  </html>
