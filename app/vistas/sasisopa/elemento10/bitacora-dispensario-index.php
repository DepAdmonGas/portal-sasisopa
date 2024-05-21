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
  background: url('imgs/iconos/load-img.gif') 50% 50% no-repeat rgb(255,255,255);
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
  ListaDispensario(1);
  });

  function regresarP(id){
  window.history.back();
  }

  function ListaDispensario(page){
  $('#ListaDispensario').load('app/vistas/sasisopa/elemento10/lista-bitacora-dispensarios.php?page=' + page);
  }
  function btnAagregar(){
  $('#Modal').modal('show');
  }
  function Categoria(e){
  $('#idDetalleCategoria').load('app/vistas/sasisopa/elemento10/categoria-bitacora-dispensario.php?Categoria=' + e.value);
  }

  function btnGuardar(categoria){

var Fecha = $('#Fecha').val();
var HoraInicio = $('#HoraInicio').val();
var HoraTermino = $('#HoraTermino').val();
var Dispensario = $('#Dispensario').val();
var Lado = $('#Lado').val();
var Producto = $('#Producto').val();
var Detalle = $('#Detalle').val();


if (Fecha != "") {
$('#Fecha').css('border','');
if (HoraInicio != "") {
$('#HoraInicio').css('border','');
if (Dispensario != "") {
$('#Dispensario').css('border','');


var parametros = {
    "accion" : "agregar-dispensario-bitacora",
      "categoria" : categoria,
      "Fecha" : Fecha,
      "HoraInicio" : HoraInicio,
      "HoraTermino" : HoraTermino,
      "Dispensario" : Dispensario,
      "Lado" : Lado,
      "Producto" : Producto,
      "Detalle" : Detalle
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

ListaDispensario(1)
$('#Categoria').val('');
$('#Fecha').val('');
$('#HoraInicio').val('');
$('#HoraTermino').val('');
$('#Lado').val('');
$('#Producto').val('');
$('#Detalle').val('');
$('#Dispensario').val('');


$('#Modal').modal('hide');
}

 }
 });

},
function(){
}).setHeader('Dispensario').set({transition:'zoom',message: 'Desea agregar el siguiente registro',labels:{ok:'Aceptar', cancel: 'Cancelar'}}).show();

}else{
$('#Dispensario').css('border','2px solid #A52525');
}
}else{
$('#HoraInicio').css('border','2px solid #A52525');
}
}else{
$('#Fecha').css('border','2px solid #A52525');
}

}

function btnGuardarCP(categoria){

var Fecha = $('#Fecha').val();
var HoraInicio = $('#HoraInicio').val();
var HoraTermino = $('#HoraTermino').val();
var Producto = $('#Producto').val();
var Detalle = $('#Detalle').val();

if (Fecha != "") {
$('#Fecha').css('border','');
if (HoraInicio != "") {
$('#HoraInicio').css('border','');
if (Producto != "") {
$('#Producto').css('border','');
if (Detalle != "") {
$('#Detalle').css('border','');


var parametros = {
    "accion" : "agregar-dispensario-bitacora",
      "categoria" : categoria,
      "Fecha" : Fecha,
      "HoraInicio" : HoraInicio,
      "HoraTermino" : HoraTermino,
      "Producto" : Producto,
      "Detalle" : Detalle,
      "Dispensario" : "",
      "Lado" : "",
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
console.log(response)
if(response == 1){

ListaDispensario(1)
$('#Categoria').val('');
$('#Fecha').val('');
$('#HoraInicio').val('');
$('#HoraTermino').val('');
$('#Producto').val('');
$('#Detalle').val('');

$('#Modal').modal('hide');
}

 }
 });

},
function(){
}).setHeader('Dispensario').set({transition:'zoom',message: 'Desea agregar el siguiente registro',labels:{ok:'Aceptar', cancel: 'Cancelar'}}).show();

}else{
$('#Detalle').css('border','2px solid #A52525');
}
}else{
$('#Producto').css('border','2px solid #A52525');
}
}else{
$('#HoraInicio').css('border','2px solid #A52525');
}
}else{
$('#Fecha').css('border','2px solid #A52525');
}

}

function Eliminar(id){
var parametros = {
    "accion" : "editar-dispensario-bitacora",
    "id" : id
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
ListaDispensario(1);
}

 }
 });

},
function(){
}).setHeader('Dispensario').set({transition:'zoom',message: 'Desea eliminar el registro seleccionado',labels:{ok:'Aceptar', cancel: 'Cancelar'}}).show();  
}

function btnModalBuscar(){
$('#ModalBuscar').modal('show'); 
}

function detalle(id){
$('#ModalDetalle').modal('show');
$('#ContenidoModal').load('app/vistas/sasisopa/elemento10/detalle-bitacora-dispensarios.php?id=' + id);
}

function Buscaryear(){
    var year = document.getElementById("selyear").value;
    if (year != "") {
      document.getElementById("selmes").disabled = false;
    }else{
      document.getElementById("selmes").disabled = true;
      document.getElementById("selmes").value = "";
    }
  }

  function btnBuscar(){
    var selyear = $('#selyear').val();
    var selmes = $('#selmes').val();  
    if (selyear != "") {
    $('#ListaDispensario').load('app/vistas/sasisopa/elemento10/lista-buscar-bitacora-dispensarios.php?selyear=' + selyear + '&selmes=' + selmes);
    $('#ModalBuscar').modal('hide'); 
    }else{
    $('#selyear').css('border','2px solid #A52525');
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
   <div class="float-left"><h4>Bitácora de registro de eventos PROFECO</h4></div>

    <div class="float-right" style="margin-top: 6px;margin-left: 10px;">

    <a download href="app/vistas/sasisopa/elemento10/reporte-excel-bitacora-dispensario.php" style="cursor: pointer;" data-toggle="tooltip" data-placement="left" title="Excel" >
    <img src="<?php echo RUTA_IMG_ICONOS."excel.png"; ?>">
    </a>

    <a onclick="btnModalBuscar()" style="cursor: pointer;" data-toggle="tooltip" data-placement="left" title="Buscar" >
    <img src="<?php echo RUTA_IMG_ICONOS."buscar-icono.png"; ?>">
    </a>

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
  <h4 class="modal-title">Agregar registro</h4>
  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
  <span aria-hidden="true">&times;</span>
  </button>
  </div>
  <div class="modal-body">

  <small>* Motivo</small>
  <select class="form-control rounded-0 mt-2" id="Categoria" onchange="Categoria(this)">
    <option></option>
    <option value="1">Ajuste</option>
    <option value="2">Cambio de precio</option>
    <option value="3">Apertura en puerta</option>
    <option value="4">Acceso al modo de programación</option>
    <option value="5">Cambio de fecha y hora</option>
    <option value="6">Actualización del o los programas de computo</option>
    <option value="7">Mantenimiento General</option>    
  </select>

  <div id="idDetalleCategoria"></div>

  </div>
  </div>
  </div>
  </div>

  <div class="modal fade bd-example-modal-lg" id="ModalDetalle" >
  <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
  <div class="modal-content" style="border-radius: 0px;border: 0px;">

  <div id="ContenidoModal"></div>

  </div>
  </div>
  </div>

    <div class="modal fade bd-example-modal-lg" id="ModalBuscar" data-backdrop="static">
    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
      <div class="modal-content" style="border-radius: 0px;border: 0px;">
        <div class="modal-header">
          <h4 class="modal-title">Buscar</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
        </div>
        <div class="modal-body">

          <div class="border p-3">

          <div class="mb-1"><small class="text-secondary">Año:</small></div>
          <select class="form-control rounded-0 mb-1" id="selyear" onchange="Buscaryear()">
            <option value="">Selecciona</option>
            <?php
            $inicio = 2019;
            $fin = date("Y");
            for ($i=$inicio; $i <= $fin; $i++) {               
              echo "<option>".$i."</option>";
            }
            ?>
          </select>           

          <div class="mb-1"><small class="text-secondary">Mes:</small></div>
          <div id="SelMes">
          <select class="form-control rounded-0 mb-1" id="selmes" disabled>
            <option value="0">Selecciona</option>
            <option value="1">Enero</option>
            <option value="2">Febrero</option>
            <option value="3">Marzo</option>
            <option value="4">Abril</option>
            <option value="5">Mayo</option>
            <option value="6">Junio</option>
            <option value="7">Julio</option>
            <option value="8">Agosto</option>
            <option value="9">Septiembre</option>
            <option value="10">Octubre</option>
            <option value="11">Noviembre</option>
            <option value="12">Diciembre</option>
          </select>
          </div>

          </div>


        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-primary" style="border-radius: 0px;" onclick="btnBuscar()">Buscar</button>
        </div>
      </div>
    </div>
    </div>

  <script src="<?php echo RUTA_JS ?>bootstrap.min.js"></script>
  </body>
  </html>
