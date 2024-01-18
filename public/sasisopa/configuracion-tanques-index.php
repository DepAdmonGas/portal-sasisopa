<?php
require('app/help.php');

$sql_estaciones = "SELECT nombre, razonsocial FROM tb_estaciones WHERE id = '".$Session_IDEstacion."' ";
$result_estaciones = mysqli_query($con, $sql_estaciones);
$numero_estaciones = mysqli_num_rows($result_estaciones);
while($row_estaciones = mysqli_fetch_array($result_estaciones, MYSQLI_ASSOC)){
$estacion = $row_estaciones['nombre'];
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
  ListaTanques();
  });

  function regresarP(id){
  window.history.back();
  }

  function ListaTanques(){
  $('#ListaTanques').load('public/sasisopa/vistas/lista-tanques.php');
  }

  function btnAagregar(){
  $('#Modal').modal('show');
  }

  function btnGuardar(){

let NoTanque = $('#NoTanque').val();
let Capacidad = $('#Capacidad').val();
let Producto = $('#Producto').val();

if (NoTanque != "") {
$('#NoTanque').css('border','');
if (Capacidad != "") {
$('#Capacidad').css('border','');
if (Producto != "") {
$('#Producto').css('border','');

var parametros = {
      "idEstacion" : <?=$Session_IDEstacion; ?>,
      "NoTanque" : NoTanque,
       "Capacidad" : Capacidad,
       "Producto" : Producto
    };

    alertify.confirm('',
function(){

$.ajax({
 data:  parametros,
 url:   'public/sasisopa/agregar/agregar-tanque-almacenamiento.php',
 type:  'post',
 beforeSend: function() {
 },
 complete: function(){
 },
 success:  function (response) {

if(response == 1){

ListaTanques();

$('#NoTanque').val('');
$('#Capacidad').val('');
$('#Producto').val('');
$('#Modal').modal('hide');
}

 }
 });

},
function(){
}).setHeader('Tanque').set({transition:'zoom',message: 'Desea agregar el tanque a la lista',labels:{ok:'Aceptar', cancel: 'Cancelar'}}).show();

}else{
$('#Producto').css('border','2px solid #A52525');
}
}else{
$('#Capacidad').css('border','2px solid #A52525');
}
}else{
$('#NoTanque').css('border','2px solid #A52525');
}

  }

  function Eliminar(id){

var parametros = {
      "idTanque" : id
    };

alertify.confirm('',
function(){

$.ajax({
 data:  parametros,
 url:   'public/sasisopa/eliminar/eliminar-tanque-almacenamiento.php',
 type:  'post',
 beforeSend: function() {
 },
 complete: function(){
 },
 success:  function (response) {

if(response == 1){

ListaTanques();

}

 }
 });

},
function(){
}).setHeader('Tanque').set({transition:'zoom',message: 'Desea eliminar el tanque de la lista',labels:{ok:'Aceptar', cancel: 'Cancelar'}}).show();
  }

  function Editar(id){
  $('#ModalEditar').modal('show');
  $('#DivEditar').load('public/sasisopa/vistas/modal-editar-tanque-almacenamiento.php?idTanque=' + id);
  }

  function BtnEditar(id){

  var EditNoTanque    =  $('#EditNoTanque').val();
  var EditCapacidad     =  $('#EditCapacidad').val();
  var EditProducto  =  $('#EditProducto').val();

  if (EditNoTanque != "") {
  if (EditCapacidad != "") {
  if (EditProducto != "") {
      
          var parametros = {
          "idTanque" : id,
          "EditNoTanque" : EditNoTanque,
          "EditCapacidad" : EditCapacidad,
          "EditProducto" : EditProducto
          };

          $.ajax({
          data:  parametros,
          url:   'public/sasisopa/actualizar/editar-tanque-almacenamiento.php',
          type:  'post',
          beforeSend: function() {
          },
          complete: function(){
          },
          success:  function (response) {
          ListaTanques();
          $('#ModalEditar').modal('hide');    
    
          }
          });

  }else{
  $('#EditProducto').css('border','2px solid #A52525');   
  }
  }else{
  $('#EditCapacidad').css('border','2px solid #A52525');   
  }
  }else{
  $('#EditNoTanque').css('border','2px solid #A52525');   
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
    <div class="col-12">
    <div class="card adm-card" style="border: 0;">
    <div class="adm-car-title">
      <div class="float-left" style="padding-right: 20px;margin-top: 5px;">
      <a onclick="regresarP()" style="cursor: pointer;" data-toggle="tooltip" data-placement="right" title="Regresar"><img src="<?php echo RUTA_IMG_ICONOS."regresar.png"; ?>"></a>
      </div>
   <div class="float-left"><h4>Configuración de Tanques de almacenamiento</h4></div>

       <div class="float-right" style="margin-top: 6px;margin-left: 10px;">
    <a onclick="btnAagregar()" style="cursor: pointer;" data-toggle="tooltip" data-placement="left" title="Agregar" >
    <img src="<?php echo RUTA_IMG_ICONOS."agregar.png"; ?>">
    </a>
    </div>
    </div>
    <div class="card-body">

    <div id="ListaTanques"></div>

    </div>
    </div>
    </div>
    </div>
    </div>

<div class="modal fade bd-example-modal-lg" id="Modal" >
<div class="modal-dialog modal-lg modal-dialog-centered" role="document">
<div class="modal-content" style="border-radius: 0px;border: 0px;">

 <div class="modal-header">
   <h4 class="modal-title">Agregar Tanque de almacenamiento</h4>
     <button type="button" class="close" data-dismiss="modal" aria-label="Close">
   <span aria-hidden="true">&times;</span>
 </button>
 </div>
 <div class="modal-body">

  <div class="row">

    
    <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 mt-2 mb-2 ">
      <small>* No. Tanque</small>
      <input type="number" class="form-control rounded-0 mt-2" id="NoTanque" min="1">
    </div>

    <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 mt-2 mb-2 ">
      <small>* Capacidad</small>
      <input type="text" class="form-control rounded-0 mt-2" id="Capacidad">
    </div>

     <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 mt-2 mb-2 ">
      <small>* Producto</small>
      <select class="form-control rounded-0 mt-2" id="Producto">
        <option></option>
        <option>G SUPER</option>
        <option>G PREMIUM</option>
        <option>G DIESEL</option>
      </select>
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
