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
  background: white;
  background: url('imgs/iconos/load-index-img.gif') 50% 50% no-repeat rgb(255,255,255);
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
  ListaSondas();
  });

  function regresarP(id){
  window.history.back();
  }

  function ListaSondas(){
  $('#ListaSondas').load('app/vistas/sasisopa/elemento10/lista-sondas.php');
  }

  function btnAagregar(){
  $('#Modal').modal('show');
  }

  function btnGuardar(){

let NoSonda = $('#NoSonda').val();
let Marca = $('#Marca').val();
let Modelo = $('#Modelo').val();
let Ubicacion = $('#Ubicacion').val();

if (NoSonda != "") {
$('#NoSonda').css('border','');
if (Marca != "") {
$('#Marca').css('border','');
if (Modelo != "") {
$('#Modelo').css('border','');

var parametros = {
     "accion" : "agregar-sonda-medicion",
      "NoSonda" : NoSonda,
       "Marca" : Marca,
       "Modelo" : Modelo,
       "Ubicacion" : Ubicacion
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

if(response == 1){

ListaSondas();

$('#NoSonda').val('');
$('#Marca').val('');
$('#Modelo').val('');
$('#Ubicacion').val();
$('#Modal').modal('hide');
}

}
});

},
function(){
}).setHeader('Sonda').set({transition:'zoom',message: 'Desea agregar la sonda a la lista',labels:{ok:'Aceptar', cancel: 'Cancelar'}}).show();

}else{
$('#Modelo').css('border','2px solid #A52525');
}
}else{
$('#Marca').css('border','2px solid #A52525');
}
}else{
$('#NoSonda').css('border','2px solid #A52525');
}

}

function Eliminar(id){

var parametros = {
"accion" : "eliminar-sonda-medicion",
"idSonda" : id
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

if(response == 1){

ListaSondas();

}

 }
 });

},
function(){
}).setHeader('Tanque').set({transition:'zoom',message: 'Desea eliminar el tanque de la lista',labels:{ok:'Aceptar', cancel: 'Cancelar'}}).show();
  }

  function Editar(id){
  $('#ModalEditar').modal('show');
  $('#DivEditar').load('app/vistas/sasisopa/elemento10/modal-editar-sonda-medicion.php?idSonda=' + id);
  }


  function BtnEditar(id){

let EditNoSonda = $('#EditNoSonda').val();
let EditMarca = $('#EditMarca').val();
let EditModelo = $('#EditModelo').val();
let EditUbicacion = $('#EditUbicacion').val();

  if (EditNoSonda != "") {
  if (EditMarca != "") {
  if (EditModelo != "") {
      
          var parametros = {
          "accion" : "editar-sonda-medicion",
          "idSonda" : id,
          "EditNoSonda" : EditNoSonda,
          "EditMarca" : EditMarca,
          "EditModelo" : EditModelo,
          "EditUbicacion" : EditUbicacion
          };

          $.ajax({
          data:  parametros,
          url:   'app/controlador/ControlActividadProcesoControlador.php',
          type:  'post',
          beforeSend: function() {
          },
          complete: function(){
          },
          success:  function (response) {
          ListaSondas();
          $('#ModalEditar').modal('hide');    
    
          }
          });


  }else{
  $('#EditModelo').css('border','2px solid #A52525');   
  }
  }else{
  $('#EditMarca').css('border','2px solid #A52525');   
  }
  }else{
  $('#EditNoSonda').css('border','2px solid #A52525');   
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
    <div class="float-left"><h4>Sondas de medición</h4></div>
    <div class="float-right" style="margin-top: 6px;margin-left: 10px;">
    <a onclick="btnAagregar()" style="cursor: pointer;" data-toggle="tooltip" data-placement="left" title="Agregar" >
    <img src="<?php echo RUTA_IMG_ICONOS."agregar.png"; ?>">
    </a>
    </div>
    <div class="mt-5 p-3 bg-white">
    <div id="ListaSondas"></div>
    </div>

    </div>

<div class="modal fade bd-example-modal-lg" id="Modal" >
<div class="modal-dialog modal-lg modal-dialog-centered" role="document">
<div class="modal-content" style="border-radius: 0px;border: 0px;">

 <div class="modal-header">
   <h4 class="modal-title">Agregar Sondas de medición</h4>
     <button type="button" class="close" data-dismiss="modal" aria-label="Close">
   <span aria-hidden="true">&times;</span>
 </button>
 </div>
 <div class="modal-body">

  <div class="row">

    
    <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 mt-2 mb-2 ">
      <small>* No. Sonda</small>
      <input type="number" class="form-control rounded-0 mt-2" id="NoSonda" min="1">
    </div>

    <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 mt-2 mb-2 ">
      <small>* Marca</small>
      <input type="text" class="form-control rounded-0 mt-2" id="Marca">
    </div>

     <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 mt-2 mb-2 ">
      <small>* Modelo</small>
      <input type="text" class="form-control rounded-0 mt-2" id="Modelo">
    </div>

    <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 mt-2 mb-2 ">
      <small>* Ubicación</small>
      <input type="text" class="form-control rounded-0 mt-2" id="Ubicacion">
    </div>

  </div>

</div>
 
 <div class="modal-footer">
<button type="button" class="btn btn-primary rounded-0" onclick="btnGuardar()">Guardar</button>
</div>
</div>
</div>
</div>

  <div class="modal fade bd-example-modal-lg" id="ModalEditar" >
  <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
  <div class="modal-content" style="border-radius: 0px;border: 0px;">
  <div id="DivEditar"></div>
  </div>
  </div>
  </div>

  <script src="<?php echo RUTA_JS ?>bootstrap.min.js"></script>
  </body>
  </html>
