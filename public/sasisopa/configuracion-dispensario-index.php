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
    <link rel="stylesheet" href="<?php echo RUTA_CSS ?>themes/default.r tl.css">
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
  ListaDispensario();
  });

  function regresarP(id){
  window.history.back();
  }

  function ListaDispensario(){
  $('#ListaDispensario').load('public/sasisopa/vistas/lista-dispensarios.php');
  }

  function btnAagregar(){
    $('#Modal').modal('show');
  }

  function btnGuardar(){

var NoDispensario = $('#NoDispensario').val();
var Marca = $('#Marca').val();
var Modelo = $('#Modelo').val();
var Serie = $('#Serie').val();
var Producto1 = $('#Producto1').val();
var Producto2 = $('#Producto2').val();
var Producto3 = $('#Producto3').val();

if (Marca != "") {
$('#Marca').css('border','');
if (Modelo != "") {
$('#Modelo').css('border','');
if (Serie != "") {
$('#Serie').css('border','');

var parametros = {
      "idEstacion" : <?=$Session_IDEstacion; ?>,
      "NoDispensario" : NoDispensario,
       "Marca" : Marca,
       "Modelo" : Modelo,
       "Serie" : Serie,
       "Producto1" : Producto1,
       "Producto2" : Producto2,
       "Producto3" : Producto3
    };

    alertify.confirm('',
function(){

$.ajax({
 data:  parametros,
 url:   'public/sasisopa/agregar/agregar-dispensario.php',
 type:  'post',
 beforeSend: function() {
 },
 complete: function(){
 },
 success:  function (response) {

if(response == 1){

ListaDispensario();

$('#Marca').val('');
$('#Modelo').val('');
$('#Serie').val('');
$('#Producto1').val('');
$('#Producto2').val('');
$('#Producto3').val('');

$('#Modal').modal('hide');
}

 }
 });

},
function(){
}).setHeader('Dispensario').set({transition:'zoom',message: 'Desea agregar el dispensario a la lista',labels:{ok:'Aceptar', cancel: 'Cancelar'}}).show();

}else{
$('#Serie').css('border','2px solid #A52525');
}
}else{
$('#Modelo').css('border','2px solid #A52525');
}
}else{
$('#Marca').css('border','2px solid #A52525');
}

  }

  function eliminar(id){

var parametros = {
      "idDispensario" : id
    };

alertify.confirm('',
function(){

$.ajax({
 data:  parametros,
 url:   'public/sasisopa/eliminar/eliminar-dispensario.php',
 type:  'post',
 beforeSend: function() {
 },
 complete: function(){
 },
 success:  function (response) {

if(response == 1){

ListaDispensario();

}

 }
 });

},
function(){
}).setHeader('Dispensario').set({transition:'zoom',message: 'Desea eliminar el dispensario de la lista',labels:{ok:'Aceptar', cancel: 'Cancelar'}}).show();
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
   <div class="float-left"><h4>Configuración de Dispensarios</h4></div>

       <div class="float-right" style="margin-top: 6px;margin-left: 10px;">
    <a onclick="btnAagregar()" style="cursor: pointer;" data-toggle="tooltip" data-placement="left" title="Agregar" >
    <img src="<?php echo RUTA_IMG_ICONOS."agregar.png"; ?>">
    </a>
    </div>
    </div>
    <div class="card-body">

<div id="ListaDispensario"></div>

    </div>
    </div>
    </div>
    </div>
    </div>

<div class="modal fade bd-example-modal-lg" id="Modal" >
<div class="modal-dialog modal-lg modal-dialog-centered" role="document">
<div class="modal-content" style="border-radius: 0px;border: 0px;">

 <div class="modal-header">
   <h4 class="modal-title">Agregar Dispensario</h4>
     <button type="button" class="close" data-dismiss="modal" aria-label="Close">
   <span aria-hidden="true">&times;</span>
 </button>
 </div>
 <div class="modal-body">

  <div class="row">

    
    <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 mt-2 mb-2 ">
      <small>* No. Dispensario</small>
      <input type="number" class="form-control rounded-0 mt-2" id="NoDispensario" min="1">
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
      <small>* Serie</small>
      <input type="text" class="form-control rounded-0 mt-2" id="Serie">
    </div>
 
     <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12 mt-2 mb-2 ">
       <small class="font-weight-bold">Mangueras <?=$Session_ProductoUno;?></small>
      <input type="number" class="form-control rounded-0 mt-2" id="Producto1" min="1">
    </div>

     <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12 mt-2 mb-2 ">
       <small class="font-weight-bold">Mangueras <?=$Session_ProductoDos;?></small>
      <input type="number" class="form-control rounded-0 mt-2" id="Producto2" min="1">
    </div>

    <?php if($Session_ProductoTres != ""){ ?>

     <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12 mt-2 mb-2 ">
    <small class="font-weight-bold">Mangueras <?=$Session_ProductoTres;?></small>
      <input type="number" class="form-control rounded-0 mt-2" id="Producto3" min="1">
    </div>

    <?php } ?>

  </div>


</div>
 
 <div class="modal-footer">
<button type="button" class="btn btn-primary rounded-0" onclick="btnGuardar()">Guardar</button>
</div>
</div>
</div>
</div>

  <script src="<?php echo RUTA_JS ?>bootstrap.min.js"></script>
  </body>
  </html>
