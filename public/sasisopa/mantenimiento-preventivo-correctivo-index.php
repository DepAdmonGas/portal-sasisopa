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
  opacity: .6;
  background: url('imgs/iconos/load-img.gif') 50% 50% no-repeat rgb(249,249,249);
}

.hover-div:hover{
  background-color: rgba(248,248,248,0.6);
  -moz-box-shadow: 0 10px 8px -5px #F2F2F2;
  box-shadow: 0 10px 8px -5px #F2F2F2;
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
  $('#Toltip').tooltip('hide')
  $('#DivContenido').load('public/sasisopa/vistas/lista-mantenimiento.php');
  }

  function ConfiguracionExtintores(){
  window.location.href = "configuracion-extintores";
  }

  function DetalleMantenimiento(id){
  $('#ModalDetalle').modal('show');
  $('#DivDetelle').load('public/sasisopa/vistas/modal-detalle-mantenimiento.php?idMantenimiento=' + id);
  }

  function ModalBuscar(){
   $('#ModalDetalle').modal('show');
   $('#DivDetelle').load('public/sasisopa/vistas/modal-buscar-mantenimiento.php');
  }

   function BuscarYear(){
    var year = document.getElementById("selyear").value;

    if (year != "") {
      document.getElementById("selmes").disabled = false;
    }else{
      document.getElementById("selmes").disabled = true;
      document.getElementById("selmes").value = "";
    }

  }

  function BuscarEquipo(){
    var Selectequipo = document.getElementById("Selectequipo").value;

    if (Selectequipo != "") {
      $('#Selectequipo').css('border','');
       $('#selyear').css('border','');
    }
  }

  function btnBuscar(){

  var Selectequipo = $('#Selectequipo').val();
  var selyear = $('#selyear').val();
  var selmes = $('#selmes').val();

  if (Selectequipo != "" || selyear != "") {

    $('#Selectequipo').css('border','');
    $('#selyear').css('border','');


    if (Selectequipo != "" ){

      if (Selectequipo != "" && selyear != ""){
          RealizaBusqueda();
      }else{
        $('#selyear').css('border','2px solid #A52525');
      }

    }else if (selyear != "") {

      if (selyear != "" && selmes != "") {
           RealizaBusqueda();
      }else{
         $('#selmes').css('border','2px solid #A52525');
      }

    }



  }else{
    $('#Selectequipo').css('border','2px solid #A52525');
    $('#selyear').css('border','2px solid #A52525');
  }

  }

  function RealizaBusqueda(){
 $(".LoaderPage").show();
    var Selectequipo = $('#Selectequipo').val();
  var selyear = $('#selyear').val();
  var selmes = $('#selmes').val();

    var parametros = {
    "Selectequipo" : Selectequipo,
    "selyear" : selyear,
    "selmes" : selmes
    };

    $.ajax({
     data:  parametros,
     url:   'public/sasisopa/vistas/reporte-mantenimiento-preventivo.php',
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

  function MantenimientoCorrectivo(){
    window.location.href = "mantenimiento-correctivo";
  }
 
  function DescargarReporte(Selectequipo,selyear,selmes){

    if (Selectequipo == "") {
    Selectequipo = "X";
  }else{
    Selectequipo = Selectequipo;
  }

  if (selyear == "") {
    selyear = "X";
  }else{
    selyear = selyear;
  }

  if (selmes == "") {
    selmes = "X";
  }else{
    selmes = selmes;
  }

  window.location = "reporte-mantenimiento-preventivo/" + Selectequipo + "/" + selyear + "/" + selmes;

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

  function Evidencias(idM){
    $('#ModalDetalle').modal('show');
  $('#DivDetelle').load('public/sasisopa/vistas/modal-evidencias-mantenimiento-preventivo.php?idMantenimiento=' + idM);
  }


  function AgregarE(idM){

  var EvidenciasM = document.getElementById("FileEvidencia");
  var FileEvidencia = EvidenciasM.files[0];
  var PathProtocolo = EvidenciasM.value;
  var ext = $("#FileEvidencia").val().split('.').pop();

  var data = new FormData();
  var url = 'public/sasisopa/agregar/agregar-evidencias-mantenimiento-preventivo.php';

  if (PathProtocolo != "") {
  $('#FileEvidencia').css('border','');
  if (ext == "JPG" || ext == "jpg" || ext == "PNG" || ext == "png") {

$('#result').html('');

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
    "idevidencia" : id
    };

    $.ajax({
   data:  parametros,
   url:   'public/sasisopa/eliminar/eliminar-evidencia-mantenimiento-preventivo.php',
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
    

    <!-- TITULO / ENCABEZADO -->
    <div class="float-left">
      <h4>Mantenimiento Preventivo y Correctivo</h4>
    </div>

    <div class="float-right" style="margin-top: 6px;margin-left: 10px;">
    <a onclick="ModalBuscar()" style="cursor: pointer;" data-toggle="tooltip" data-placement="left" title="Buscar" >
    <img src="<?php echo RUTA_IMG_ICONOS."buscar-icono.png"; ?>">
    </a>
    </div>

    </div>
    <div class="card-body">

<!-- BOTONES / CONFIG. & MTTO -->

<div class="text-right">
<button type="button" class="btn btn-primary btn-sm rounded-0 mt-2 mb-1" onclick="ConfiguracionExtintores()">Configuración de Extintores</button>

<button type="button" class="btn btn-primary btn-sm rounded-0  mt-1 ml-2" onclick="MantenimientoCorrectivo()">Mantenimiento Correctivo</button>

</div>
<hr>

<?php
/*
$FechaEnero = "2023/09/04";
$DateEnero = date("Y-m-d", strtotime($FechaEnero));
$ClassMantenimiento->MantenimientoCalendario(6, $DateEnero, '08:00:00', $con);
*/

/*
//-------------- ENERO ------------------------------------------------------
for ($enero = 1; $enero <= 31; $enero++) {
$FechaEnero = "2020/01/".$enero;
$DateEnero = date("Y-m-d", strtotime($FechaEnero));
$ClassMantenimiento->MantenimientoDia(1, $DateEnero, '08:00:00', $con);
$ClassMantenimiento->MantenimientoCalendario(1, $DateEnero, '08:00:00', $con);
}
//----------------------------------------------------------------------------

//-------------- FEBRERO ------------------------------------------------------
for ($febrero = 1; $febrero <= 29; $febrero++) {
$FechaFebrero = "2020/02/".$febrero;
$DateFebrero = date("Y-m-d", strtotime($FechaFebrero));
$ClassMantenimiento->MantenimientoDia(1, $DateFebrero, '08:00:00', $con);
$ClassMantenimiento->MantenimientoCalendario(1, $DateFebrero, '08:00:00', $con);
}
//----------------------------------------------------------------------------

//-------------- MARZO ------------------------------------------------------
for ($marzo = 1; $marzo <= 31; $marzo++) {
$FechaMarzo = "2020/03/".$marzo;
$DateMarzo = date("Y-m-d", strtotime($FechaMarzo));
$ClassMantenimiento->MantenimientoDia(1, $DateMarzo, '08:00:00', $con);
$ClassMantenimiento->MantenimientoCalendario(1, $DateMarzo, '08:00:00', $con);
}
//----------------------------------------------------------------------------

//-------------- ABRIL ------------------------------------------------------
for ($abril = 1; $abril <= 30; $abril++) {
$FechaAbril = "2020/04/".$abril;
$DateAbril = date("Y-m-d", strtotime($FechaAbril));
$ClassMantenimiento->MantenimientoDia(1, $DateAbril, '08:00:00', $con);
$ClassMantenimiento->MantenimientoCalendario(1, $DateAbril, '08:00:00', $con);
}
//----------------------------------------------------------------------------

//-------------- MAYO ------------------------------------------------------
for ($mayo = 1; $mayo <= 31; $mayo++) {
$FechaMayo = "2020/05/".$mayo;
$DateMayo = date("Y-m-d", strtotime($FechaMayo));
$ClassMantenimiento->MantenimientoDia(1, $DateMayo, '08:00:00', $con);
$ClassMantenimiento->MantenimientoCalendario(1, $DateMayo, '08:00:00', $con);
}
//----------------------------------------------------------------------------

//-------------- JUNIO ------------------------------------------------------
for ($junio = 1; $junio <= 30; $junio++) {
$FechaJunio = "2020/06/".$junio;
$DateJunio = date("Y-m-d", strtotime($FechaJunio));
$ClassMantenimiento->MantenimientoDia(1, $DateJunio, '08:00:00', $con);
$ClassMantenimiento->MantenimientoCalendario(1, $DateJunio, '08:00:00', $con);
}
//----------------------------------------------------------------------------

//-------------- JULIO ------------------------------------------------------
for ($julio = 1; $julio <= 15; $julio++) {
$FechaJulio = "2020/07/".$julio;
$DateJulio = date("Y-m-d", strtotime($FechaJulio));
$ClassMantenimiento->MantenimientoDia(1, $DateJulio, '08:00:00', $con);
$ClassMantenimiento->MantenimientoCalendario(1, $DateJulio, '08:00:00', $con);
}
//----------------------------------------------------------------------------
*/

?>

  <div id="DivContenido"></div>

  </div>
  </div>
  </div>
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
