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
  opacity: .6;
  background: url('imgs/iconos/load-img.gif') 50% 50% no-repeat rgb(249,249,249);
}
  </style>
  <script type="text/javascript">
  $(document).ready(function(){
  $('[data-toggle="tooltip"]').tooltip();
  $(".LoaderPage").fadeOut("slow");

  ListaMantenimiento();
  });

  function regresarP(){
  window.history.back();
  }

  function ListaMantenimiento(){
  $('#DivContenido').load('app/vistas/sasisopa/elemento10/lista-mantenimiento-correctivo.php');    
  }

  function DetalleMantenimiento(id){
  $('#ModalDetalle').modal('show');
  $('#DivDetelle').load('app/vistas/sasisopa/elemento10/modal-detalle-mantenimiento-correctivo.php?idMantenimiento=' + id);
  }

  function DescargarReporte(){

window.location = "reporte-mantenimiento-correctivo";
$(".LoaderPage").show();

var hasFocus=false;
var loaded = false;

window.onfocus = function() { 
    if (loaded) $(".LoaderPage").hide();
    hasFocus = true;
};

window.onblur = function() {
    if (hasFocus) $(".LoaderPage").hide();
    loaded = true;
};

  }

  function EditarMantenimiento(idM){
  $('#ModalDetalle').modal('show');
  $('#DivDetelle').load('app/vistas/sasisopa/elemento10/modal-editar-mantenimiento-correctivo.php?idMantenimiento=' + idM);
  }

  function ActualizarM(idM){

    var EquipoArea = $('#EquipoArea').val();
    var DeHallazgo = $('#DeHallazgo').val();
    var DeMantenimiento = $('#DeMantenimiento').val();
    var Herramienta = $('#Herramienta').val();

    var parametros = {
    "accion" : "actualizar-mantenimiento-correctivo",
    "idmantenimiento" : idM,
    "EquipoArea" : EquipoArea,
    "DeHallazgo" : DeHallazgo,
    "DeMantenimiento" : DeMantenimiento,
    "Herramienta" : Herramienta
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
    alertify.success('Se actualizo correctamente el mantenimiento');
    DetalleMantenimiento(idM);
    }
    });

    }

    function Evidencias(idM){
    $('#ModalDetalle').modal('show');
    $('#DivDetelle').load('public/sasisopa/vistas/modal-evidencias-mantenimiento-correctivo.php?idMantenimiento=' + idM);
    }

    function AgregarE(idM){

var EvidenciasM = document.getElementById("FileEvidencia");
var FileEvidencia = EvidenciasM.files[0];
var PathProtocolo = EvidenciasM.value;
var ext = $("#FileEvidencia").val().split('.').pop();

var data = new FormData();
var url = 'app/controlador/ControlActividadProcesoControlador.php';

if (PathProtocolo != "") {
$('#FileEvidencia').css('border','');
if (ext == "JPG" || ext == "jpg" || ext == "PNG" || ext == "png") {

$('#result').html('');

data.append('accion', 'agregar-evidencia-mantenimiento-correctivo');
data.append('idMantenimiento', idM);
data.append('FileEvidencia', FileEvidencia);

$.ajax({
url: url,
type: 'POST',
contentType: false,
data: data,
processData: false,
cache: false,
}).done(function(data){

alertify.message('Evidencia agregada');
Evidencias(idM);

});

}else{
$('#result').html('<small class="text-danger">Solo se aceptan formato JPG y PNG</small>'); 
}  
}else{
$('#FileEvidencia').css('border','2px solid #A52525');
}

}

function EliminarE(id,idM){

var parametros = {
"accion" : "eliminar-evidencia-mantenimiento-correctivo",
"idevidencia" : id
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
alertify.success('Se elimino evidencia');
Evidencias(idM);
}
});

}

function ModalBuscar(){
   $('#ModalDetalle').modal('show');
   $('#DivDetelle').load('app/vistas/sasisopa/elemento10/modal-buscar-mantenimiento-correctivo.php');
  }

  function btnBuscar(){

$(".LoaderPage").show();

var selyear = $('#selyear').val();
var selmes = $('#selmes').val();

var parametros = {
"selyear" : selyear,
"selmes" : selmes
};

$.ajax({
 data:  parametros,
 url:   'app/vistas/sasisopa/elemento10/reporte-mantenimiento-correctivo.php',
 type:  'post',
 beforeSend: function() {

 },
 complete: function(){
  $('#ModalDetalle').modal('hide');
  $(".LoaderPage").hide();
 },
 success:  function (response) {

 $('#DivContenido').html(response); 

 }
 });

}

function DescargarReporteYM(Year, Mes){

window.location = "reporte-mantenimiento-correctivo/" + Year + "/" + Mes;
$(".LoaderPage").show();

var hasFocus=false;
var loaded = false;

window.onfocus = function() { 
    if (loaded) $(".LoaderPage").hide();
    hasFocus = true;
};

window.onblur = function() {
    if (hasFocus) $(".LoaderPage").hide();
    loaded = true;
};

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
    <div class="float-left"><h4>Mantenimiento Preventivo y Correctivo</h4></div>
    <div class="float-right" style="margin-top: 6px;margin-left: 10px;">
    <a onclick="ModalBuscar()" style="cursor: pointer;" data-toggle="tooltip" data-placement="left" title="Buscar" >
    <img src="<?php echo RUTA_IMG_ICONOS."buscar-icono.png"; ?>">
    </a>
    </div>
    <div class="mt-5 p-3 bg-white">
    <?php
    //-----------------------------------------------------------------------------
    //--- Agregar campo nombre, agregar el nombre de quien firma en po_mantenimiento_correctivo_firma, eliminar id_usuario
    //--- Eliminar despues de realizar el Query

    /*function NombreUsuario($idUsuario, $con){
    $sql_usuario = "SELECT nombre FROM tb_usuarios WHERE id = '".$idUsuario."' ";
    $result_usuario = mysqli_query($con, $sql_usuario);
    while($row_usuario = mysqli_fetch_array($result_usuario, MYSQLI_ASSOC)){
    $nomencargado = $row_usuario['nombre'];
    }
    return $nomencargado;
    }
    $sql_mpc = "SELECT * FROM po_mantenimiento_correctivo_firma ";
    $query_mpc = mysqli_query($con, $sql_mpc);
    while($row_mpc = mysqli_fetch_array($query_mpc, MYSQLI_ASSOC)){
    $id = $row_mpc['id'];
    $idUsuario = $row_mpc['id_usuario'];
    $NombreUsuario = NombreUsuario($row_mpc['id_usuario'], $con);
    $sql = "UPDATE po_mantenimiento_correctivo_firma SET
    nombre = '".$NombreUsuario."'
    WHERE id = '".$id."' ";
    mysqli_query($con, $sql);
    }
    */
    ?>
    <div id="DivContenido"></div>
    </div>

    </div>

  <div class="modal fade bd-example-modal-lg" id="ModalDetalle" >
  <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
  <div class="modal-content" style="border-radius: 0px;border: 0px;">
  <div id="DivDetelle"></div>

  </div>
  </div>
  </div>

  <script src="<?php echo RUTA_JS ?>bootstrap.min.js"></script>
  </body>
  </html>
