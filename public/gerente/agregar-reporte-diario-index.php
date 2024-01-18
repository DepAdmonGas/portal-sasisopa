<?php
require('app/help.php');

$idReporteCre = $GET_idReporte;

$sql_mes = "SELECT mes, year FROM re_reporte_cre_mes WHERE id = '".$idReporteCre."' ";
$result_mes = mysqli_query($con, $sql_mes);
$numero_mes = mysqli_num_rows($result_mes);
while($row_mes = mysqli_fetch_array($result_mes, MYSQLI_ASSOC)){
$mes = $row_mes['mes'];
$year = $row_mes['year'];
}

$dia = date("d", mktime(0,0,0, $mes+1, 0, $year));


if (strlen($mes) == 1) {
$dia_mes = "0".$mes;
}else{
$dia_mes = $mes;  
}

$dia_min = $year."-".$dia_mes."-01";
$dia_max = $year."-".$dia_mes."-".$dia;
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

  <script type="text/javascript">
  $(document).ready(function(){
  $('[data-toggle="tooltip"]').tooltip();
  });

  function regresarP(){
  window.history.back()
  }

  function BTNFinalizar(){


  $('#Fecha').css('border','');
  var Fecha = $('#Fecha').val();

  <?php if ($Session_ProductoUno != "") { ?>
  $('#Po1_VoI').css('border','0px');
  var Po1_VoI = $('#Po1_VoI').val();

  $('#Po1_VoV').css('border','0px');
  var Po1_VoV = $('#Po1_VoV').val();

  $('#Po1_VoF').css('border','0px');
  var Po1_VoF = $('#Po1_VoF').val();

if (Fecha != "") {
if (Po1_VoI != "") {
if (Po1_VoV != "") {
if (Po1_VoF != "") {

<?php if ($Session_ProductoDos != "") { ?>
  $('#Po2_VoI').css('border','0px');
  var Po2_VoI = $('#Po2_VoI').val();

  $('#Po2_VoV').css('border','0px');
  var Po2_VoV = $('#Po2_VoV').val();

  $('#Po2_VoF').css('border','0px');
  var Po2_VoF = $('#Po2_VoF').val();

  if (Po2_VoI != "") {
  if (Po2_VoV != "") {
  if (Po2_VoF != "") {

<?php if ($Session_ProductoTres != "") { ?>
  $('#Po3_VoI').css('border','0px');
  var Po3_VoI = $('#Po3_VoI').val();

  $('#Po3_VoV').css('border','0px');
  var Po3_VoV = $('#Po3_VoV').val();

  $('#Po3_VoF').css('border','0px');
  var Po3_VoF = $('#Po3_VoF').val();

  if (Po3_VoI != "") {
  if (Po3_VoV != "") {
  if (Po3_VoF != "") {

    var Po1_Pi1_VC = $('#Po1_Pi1_VC').val();
    var Po1_Pi1_PL = $('#Po1_Pi1_PL').val();
    var Po1_Pi1_CF = $('#Po1_Pi1_CF').val();
    var Po1_Pi1_NF = $('#Po1_Pi1_NF').val();
    var Po1_Pi2_VC = $('#Po1_Pi2_VC').val();
    var Po1_Pi2_PL = $('#Po1_Pi2_PL').val();
    var Po1_Pi2_CF = $('#Po1_Pi2_CF').val();
    var Po1_Pi2_NF = $('#Po1_Pi2_NF').val();
    var Po1_Pi3_VC = $('#Po1_Pi3_VC').val();
    var Po1_Pi3_PL = $('#Po1_Pi3_PL').val();
    var Po1_Pi3_cF = $('#Po1_Pi3_cF').val();
    var Po1_Pi3_NF = $('#Po1_Pi3_NF').val();
    var Po2_Pi1_VC = $('#Po2_Pi1_VC').val();
    var Po2_Pi1_PL = $('#Po2_Pi1_PL').val();
    var Po2_Pi1_CF = $('#Po2_Pi1_CF').val();
    var Po2_Pi1_NF = $('#Po2_Pi1_NF').val();
    var Po2_Pi2_VC = $('#Po2_Pi2_VC').val();
    var Po2_Pi2_PL = $('#Po2_Pi2_PL').val();
    var Po2_Pi2_CF = $('#Po2_Pi2_CF').val();
    var Po2_Pi2_NF = $('#Po2_Pi2_NF').val();
    var Po2_Pi3_VC = $('#Po2_Pi3_VC').val();
    var Po2_Pi3_PL = $('#Po2_Pi3_PL').val();
    var Po2_Pi3_CF = $('#Po2_Pi3_CF').val();
    var Po2_Pi3_NF = $('#Po2_Pi3_NF').val();
    var Po3_Pi1_VC = $('#Po3_Pi1_VC').val();
    var Po3_Pi1_PL = $('#Po3_Pi1_PL').val();
    var Po3_Pi1_CF = $('#Po3_Pi1_CF').val();
    var Po3_Pi1_NF = $('#Po3_Pi1_NF').val();
    var Po3_Pi2_VC = $('#Po3_Pi2_VC').val();
    var Po3_Pi2_PL = $('#Po3_Pi2_PL').val();
    var Po3_Pi2_CF = $('#Po3_Pi2_CF').val();
    var Po3_Pi2_NF = $('#Po3_Pi2_NF').val();
    var Po3_Pi3_VC = $('#Po3_Pi3_VC').val();
    var Po3_Pi3_PL = $('#Po3_Pi3_PL').val();
    var Po3_Pi3_CF = $('#Po3_Pi3_CF').val();
    var Po3_Pi3_NF = $('#Po3_Pi3_NF').val();

    var Po1_Pi1_NRSC = $('#Po1_Pi1_NRSC').val();
    var Po1_Pi2_NRSC = $('#Po1_Pi2_NRSC').val();
    var Po1_Pi3_NRSC = $('#Po1_Pi3_NRSC').val();
    var Po2_Pi1_NRSC = $('#Po2_Pi1_NRSC').val();
    var Po2_Pi2_NRSC = $('#Po2_Pi2_NRSC').val();
    var Po2_Pi3_NRSC = $('#Po2_Pi3_NRSC').val();
    var Po3_Pi1_NRSC = $('#Po3_Pi1_NRSC').val();
    var Po3_Pi2_NRSC = $('#Po3_Pi2_NRSC').val();
    var Po3_Pi3_NRSC = $('#Po3_Pi3_NRSC').val();

    var Po1_Pi1_IT = $('#Po1_Pi1_IT').val();
    var Po1_Pi2_IT = $('#Po1_Pi2_IT').val();
    var Po1_Pi3_IT = $('#Po1_Pi3_IT').val();
    var Po2_Pi1_IT = $('#Po2_Pi1_IT').val();
    var Po2_Pi2_IT = $('#Po2_Pi2_IT').val();
    var Po2_Pi3_IT = $('#Po2_Pi3_IT').val();
    var Po3_Pi1_IT = $('#Po3_Pi1_IT').val();
    var Po3_Pi2_IT = $('#Po3_Pi2_IT').val();
    var Po3_Pi3_IT = $('#Po3_Pi3_IT').val();

    var parametros = {
      "IdReporte": <?=$idReporteCre;?>,
      "Fecha": Fecha,
      "Po1_VoI": Po1_VoI,
      "Po1_VoV": Po1_VoV,
      "Po1_VoF": Po1_VoF,
      "Po2_VoI": Po2_VoI,
      "Po2_VoV": Po2_VoV,
      "Po2_VoF": Po2_VoF,
      "Po3_VoI": Po3_VoI,
      "Po3_VoV": Po3_VoV,
      "Po3_VoF": Po3_VoF,
      "Po1_Pi1_VC": Po1_Pi1_VC,
      "Po1_Pi1_PL": Po1_Pi1_PL,
      "Po1_Pi1_CF": Po1_Pi1_CF,
      "Po1_Pi1_NF": Po1_Pi1_NF,
      "Po1_Pi2_VC": Po1_Pi2_VC,
      "Po1_Pi2_PL": Po1_Pi2_PL,
      "Po1_Pi2_CF": Po1_Pi2_CF,
      "Po1_Pi2_NF": Po1_Pi2_NF,
      "Po1_Pi3_VC": Po1_Pi3_VC,
      "Po1_Pi3_PL": Po1_Pi3_PL,
      "Po1_Pi3_cF": Po1_Pi3_cF,
      "Po1_Pi3_NF": Po1_Pi3_NF,
      "Po2_Pi1_VC": Po2_Pi1_VC,
      "Po2_Pi1_PL": Po2_Pi1_PL,
      "Po2_Pi1_CF": Po2_Pi1_CF,
      "Po2_Pi1_NF": Po2_Pi1_NF,
      "Po2_Pi2_VC": Po2_Pi2_VC,
      "Po2_Pi2_PL": Po2_Pi2_PL,
      "Po2_Pi2_CF": Po2_Pi2_CF,
      "Po2_Pi2_NF": Po2_Pi2_NF,
      "Po2_Pi3_VC": Po2_Pi3_VC,
      "Po2_Pi3_PL": Po2_Pi3_PL,
      "Po2_Pi3_CF": Po2_Pi3_CF,
      "Po2_Pi3_NF": Po2_Pi3_NF,
      "Po3_Pi1_VC": Po3_Pi1_VC,
      "Po3_Pi1_PL": Po3_Pi1_PL,
      "Po3_Pi1_CF": Po3_Pi1_CF,
      "Po3_Pi1_NF": Po3_Pi1_NF,
      "Po3_Pi2_VC": Po3_Pi2_VC,
      "Po3_Pi2_PL": Po3_Pi2_PL,
      "Po3_Pi2_CF": Po3_Pi2_CF,
      "Po3_Pi2_NF": Po3_Pi2_NF,
      "Po3_Pi3_VC": Po3_Pi3_VC,
      "Po3_Pi3_PL": Po3_Pi3_PL,
      "Po3_Pi3_CF": Po3_Pi3_CF,
      "Po3_Pi3_NF": Po3_Pi3_NF,
      "Po1_Pi1_NRSC" : Po1_Pi1_NRSC,
      "Po1_Pi2_NRSC" : Po1_Pi2_NRSC,
      "Po1_Pi3_NRSC" : Po1_Pi3_NRSC,
      "Po2_Pi1_NRSC" : Po2_Pi1_NRSC,
      "Po2_Pi2_NRSC" : Po2_Pi2_NRSC,
      "Po2_Pi3_NRSC" : Po2_Pi3_NRSC,
      "Po3_Pi1_NRSC" : Po3_Pi1_NRSC,
      "Po3_Pi2_NRSC" : Po3_Pi2_NRSC,
      "Po3_Pi3_NRSC" : Po3_Pi3_NRSC,
      "Po1_Pi1_IT" : Po1_Pi1_IT,
      "Po1_Pi2_IT" : Po1_Pi2_IT,
      "Po1_Pi3_IT" : Po1_Pi3_IT,
      "Po2_Pi1_IT" : Po2_Pi1_IT,
      "Po2_Pi2_IT" : Po2_Pi2_IT,
      "Po2_Pi3_IT" : Po2_Pi3_IT,
      "Po3_Pi1_IT" : Po3_Pi1_IT,
      "Po3_Pi2_IT" : Po3_Pi2_IT,
      "Po3_Pi3_IT" : Po3_Pi3_IT
    };

    alertify.confirm('',
    function(){

    $.ajax({
     data:  parametros,
     url:   '../public/gerente/agregar/agregar-reporte-cre.php',
     type:  'post',
     beforeSend: function() {

     },
     complete: function(){


     },
     success:  function (response) {

       if (response == 0) {

      $('#Fecha').css('border','2px solid #A52525');
      $('#resultfecha').html('<div class="text-center text-danger" style="padding: 10px;font-size: .8em;">Seleccione una fecha disponible</div>');

      }else if (response == 1) {
        alertify.message('El reporte estadístico fue creado correctamente');
        window.setTimeout("regresarP()",1000);
      }


     }
     });

    },
    function(){
    }).setHeader('Agregar Reporte').set({transition:'zoom',message: 'Desea agregar la siguiente información de la estación',labels:{ok:'Aceptar', cancel: 'Cancelar'}}).show();


  }else{
  $('#Po3_VoF').css('border','2px solid #A52525');
  }
  }else{
  $('#Po3_VoV').css('border','2px solid #A52525');
  }
  }else{
  $('#Po3_VoI').css('border','2px solid #A52525');
  }

<?php
}else{
?>
var Po1_Pi1_VC = $('#Po1_Pi1_VC').val();
var Po1_Pi1_PL = $('#Po1_Pi1_PL').val();
var Po1_Pi1_CF = $('#Po1_Pi1_CF').val();
var Po1_Pi1_NF = $('#Po1_Pi1_NF').val();
var Po1_Pi2_VC = $('#Po1_Pi2_VC').val();
var Po1_Pi2_PL = $('#Po1_Pi2_PL').val();
var Po1_Pi2_CF = $('#Po1_Pi2_CF').val();
var Po1_Pi2_NF = $('#Po1_Pi2_NF').val();
var Po1_Pi3_VC = $('#Po1_Pi3_VC').val();
var Po1_Pi3_PL = $('#Po1_Pi3_PL').val();
var Po1_Pi3_cF = $('#Po1_Pi3_cF').val();
var Po1_Pi3_NF = $('#Po1_Pi3_NF').val();
var Po2_Pi1_VC = $('#Po2_Pi1_VC').val();
var Po2_Pi1_PL = $('#Po2_Pi1_PL').val();
var Po2_Pi1_CF = $('#Po2_Pi1_CF').val();
var Po2_Pi1_NF = $('#Po2_Pi1_NF').val();
var Po2_Pi2_VC = $('#Po2_Pi2_VC').val();
var Po2_Pi2_PL = $('#Po2_Pi2_PL').val();
var Po2_Pi2_CF = $('#Po2_Pi2_CF').val();
var Po2_Pi2_NF = $('#Po2_Pi2_NF').val();
var Po2_Pi3_VC = $('#Po2_Pi3_VC').val();
var Po2_Pi3_PL = $('#Po2_Pi3_PL').val();
var Po2_Pi3_CF = $('#Po2_Pi3_CF').val();
var Po2_Pi3_NF = $('#Po2_Pi3_NF').val();

    var Po1_Pi1_NRSC = $('#Po1_Pi1_NRSC').val();
    var Po1_Pi2_NRSC = $('#Po1_Pi2_NRSC').val();
    var Po1_Pi3_NRSC = $('#Po1_Pi3_NRSC').val();
    var Po2_Pi1_NRSC = $('#Po2_Pi1_NRSC').val();
    var Po2_Pi2_NRSC = $('#Po2_Pi2_NRSC').val();
    var Po2_Pi3_NRSC = $('#Po2_Pi3_NRSC').val();

var Po1_Pi1_IT = $('#Po1_Pi1_IT').val();
var Po1_Pi2_IT = $('#Po1_Pi2_IT').val();
var Po1_Pi3_IT = $('#Po1_Pi3_IT').val();

var Po2_Pi1_IT = $('#Po2_Pi1_IT').val();
var Po2_Pi2_IT = $('#Po2_Pi2_IT').val();
var Po2_Pi3_IT = $('#Po2_Pi3_IT').val();

var parametros = {
  "IdReporte": <?=$idReporteCre;?>,
  "Fecha": Fecha,
  "Po1_VoI": Po1_VoI,
  "Po1_VoV": Po1_VoV,
  "Po1_VoF": Po1_VoF,
  "Po2_VoI": Po2_VoI,
  "Po2_VoV": Po2_VoV,
  "Po2_VoF": Po2_VoF,
  "Po1_Pi1_VC": Po1_Pi1_VC,
  "Po1_Pi1_PL": Po1_Pi1_PL,
  "Po1_Pi1_CF": Po1_Pi1_CF,
  "Po1_Pi1_NF": Po1_Pi1_NF,
  "Po1_Pi2_VC": Po1_Pi2_VC,
  "Po1_Pi2_PL": Po1_Pi2_PL,
  "Po1_Pi2_CF": Po1_Pi2_CF,
  "Po1_Pi2_NF": Po1_Pi2_NF,
  "Po1_Pi3_VC": Po1_Pi3_VC,
  "Po1_Pi3_PL": Po1_Pi3_PL,
  "Po1_Pi3_cF": Po1_Pi3_cF,
  "Po1_Pi3_NF": Po1_Pi3_NF,
  "Po2_Pi1_VC": Po2_Pi1_VC,
  "Po2_Pi1_PL": Po2_Pi1_PL,
  "Po2_Pi1_CF": Po2_Pi1_CF,
  "Po2_Pi1_NF": Po2_Pi1_NF,
  "Po2_Pi2_VC": Po2_Pi2_VC,
  "Po2_Pi2_PL": Po2_Pi2_PL,
  "Po2_Pi2_CF": Po2_Pi2_CF,
  "Po2_Pi2_NF": Po2_Pi2_NF,
  "Po2_Pi3_VC": Po2_Pi3_VC,
  "Po2_Pi3_PL": Po2_Pi3_PL,
  "Po2_Pi3_CF": Po2_Pi3_CF,
  "Po2_Pi3_NF": Po2_Pi3_NF,

  "Po1_Pi1_NRSC" : Po1_Pi1_NRSC,
  "Po1_Pi2_NRSC" : Po1_Pi2_NRSC,
  "Po1_Pi3_NRSC" : Po1_Pi3_NRSC,
  "Po2_Pi1_NRSC" : Po2_Pi1_NRSC,
  "Po2_Pi2_NRSC" : Po2_Pi2_NRSC,
  "Po2_Pi3_NRSC" : Po2_Pi3_NRSC,

  "Po1_Pi1_IT" : Po1_Pi1_IT,
  "Po1_Pi2_IT" : Po1_Pi2_IT,
  "Po1_Pi3_IT" : Po1_Pi3_IT,
  "Po2_Pi1_IT" : Po2_Pi1_IT,
  "Po2_Pi2_IT" : Po2_Pi2_IT,
  "Po2_Pi3_IT" : Po2_Pi3_IT
};

alertify.confirm('',
function(){

$.ajax({
 data:  parametros,
 url:   '../public/gerente/agregar/agregar-reporte-cre.php',
 type:  'post',
 beforeSend: function() {

 },
 complete: function(){


 },
 success:  function (response) {
   if (response == 0) {

  $('#Fecha').css('border','2px solid #A52525');
  $('#resultfecha').html('<div class="text-center text-danger" style="padding: 10px;font-size: .8em;">Seleccione una fecha disponible</div>');

  }else if (response == 1) {
    alertify.message('El reporte estadístico fue creado correctamente');
    window.setTimeout("regresarP()",1000);
  }
 }
 });

},
function(){
}).setHeader('Agregar Reporte').set({transition:'zoom',message: 'Desea agregar la siguiente información de la estación',labels:{ok:'Aceptar', cancel: 'Cancelar'}}).show();


<?php
}
?>

  }else{
  $('#Po2_VoF').css('border','2px solid #A52525');
  }
  }else{
  $('#Po2_VoV').css('border','2px solid #A52525');
  }
  }else{
  $('#Po2_VoI').css('border','2px solid #A52525');
  }

<?php } ?>

}else{
$('#Po1_VoF').css('border','2px solid #A52525');
}
}else{
$('#Po1_VoV').css('border','2px solid #A52525');
}
}else{
$('#Po1_VoI').css('border','2px solid #A52525');
}
}else{
$('#Fecha').css('border','2px solid #A52525');
}

<?php } ?>

  }

  function Importe(valor,a,b){    

  var Compra = $('#Po' + a + '_Pi' + b + '_VC').val();
  var Litros = valor.value / Compra;
    
  $('#Po' + a + '_Pi' + b + '_PL').val(financial(Litros));

  }

  function VolumenCompra(valor,a,b){

  var Importe = $('#Po' + a + '_Pi' + b + '_IT').val();
  var Litros = Importe / valor.value;
    
  $('#Po' + a + '_Pi' + b + '_PL').val(financial(Litros));

  }

function financial(x) {
  return Number.parseFloat(x).toFixed(2);
}
  </script>
  </head>
  <body>
    
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
    <div class="float-left"><h4>AGREGAR REPORTE ESTADÍSTICO DE LA CRE</h4></div>
    <div class="float-right">
    <button type="button" class="btn btn-primary" style="border-radius: 0px;border:0px;" onclick="BTNFinalizar()">Guardar Cambios</button>
    </div>
    </div>
   
 
    <div class="card-body">

      <div class="col-xl-2 col-lg-2 col-md-3 col-12 ">
      <div class="p-1">
      
      <div class="row">

      <div class="input-group" style="font-size: .9em;border-radius: 0;">
      
      <div class="input-group-prepend" >
      <span class="input-group-text" style="font-size: .9em;border-radius: 0;">Fecha:</span>
      </div>
      
      <input type="date" class="form-control " id="Fecha" min="<?=$dia_min;?>" max="<?=$dia_max;?>"  style="font-size: .9em;border-radius: 0;">
      </div>

      </div>

      </div>
      </div>

      
      <div id="resultfecha"></div> 

      <hr>

      <!-- - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -  -->
      
    <!-- PRODUCTO G-SUPER -->
      <?php
      if ($Session_ProductoUno != "") {
      ?>
     
    <div class="border mb-3">
    <div class="p-3">
      <div class="" style="font-size: 1.2em;">
      <label style="border-bottom: 2px solid #59c784;">Producto: <b><?=$Session_ProductoUno;?></b></label>
      </div>

      <div class="row">
        
      <div class="col-xl-5 col-lg-5 col-md-12 col-sm-12">
          
        <div class="text-muted mt-2 mb-2" style="font-size: .8em;padding-top: 5px;padding-bottom: 5px;">
          <b>* 1.</b> Agregar el volumen inicial, final y ventas en (Lt).
        </div>


      <div style="overflow-y: hidden;">
        <table class="table table-bordered table-sm">
          <tr>
          <th class="text-center text-secondary">Volumen (Lt) Inicial</th>
          <th class="text-center text-secondary">Volumen (Lt) de venta</th>
          <th colspan="2" class="text-center text-secondary">Volumen (Lt) Final</th>
          </tr>
          <tr>
            <td style="padding: 0;"><input type="number" id="Po1_VoI" min="0" step="any" class="form-control" placeholder="Volumen (Lt) Inicial" style="border-radius: 0px;border:0px;border-bottom: 2px solid #d1d1d1;"></td>
            <td style="padding: 0;"><input type="number" id="Po1_VoV" min="0" step="any" class="form-control" placeholder="Volumen (Lt) de venta" style="border-radius: 0px;border:0px;border-bottom: 2px solid #d1d1d1;"></td>
            <td colspan="2" style="padding: 0;"><input type="number" id="Po1_VoF" min="0" step="any" class="form-control" placeholder="Volumen (Lt) Final" style="border-radius: 0px;border:0px;border-bottom: 2px solid #d1d1d1;"></td>
          </tr>
        </table>
 
      </div>
        </div>


    <div class="col-xl-7 col-lg-7 col-md-12 col-sm-12">
          <div class="text-muted mt-2 mb-2" style="font-size: .8em;padding-top: 5px;padding-bottom: 5px;">
          <b>* 2.</b> Agregar el volumen de las compras de pipas.
          </div>

     <div class="mb-2" style="overflow-y: hidden;">
        <table class="table table-bordered table-sm">
          <tr>
            <td class="text-center text-secondary font-weight-bold align-middle">Volumen (Lt) de Compra</td>
            <td class="text-center text-secondary font-weight-bold align-middle">Precio ($) por litro de producto</td>
            <td class="text-center text-secondary font-weight-bold align-middle">Costo ($) del flete mas IVA</td>
            <td class="text-center text-secondary font-weight-bold align-middle">No. De factura</td>
            <td class="text-center text-secondary font-weight-bold align-middle">Nombre o Razón Social del Transportista</td>
            <td class="text-center text-secondary font-weight-bold align-middle">Importe</td>
          </tr>
          <tr>
          <td style="padding: 0;">
          <div class="input-group">
          <div class="input-group-prepend">
          <span class="input-group-text" style="border-radius: 0px;border:0px;font-size: .9em;">Pipa 1</span>
          </div>
          <input type="number" id="Po1_Pi1_VC" min="0" step="any" class="form-control" style="border-radius: 0px;border:0px;" onkeyup="VolumenCompra(this,1,1)">
          </div>
          </td>
          <td style="padding: 0;"><input type="number" id="Po1_Pi1_PL" min="0" step="any" class="form-control" style="border-radius: 0px;border:0px;" disabled></td>
          <td style="padding: 0;"><input type="number" id="Po1_Pi1_CF" min="0" step="any" class="form-control" placeholder="" style="border-radius: 0px;border:0px;"></td>
          <td style="padding: 0;"><input type="text"   id="Po1_Pi1_NF" class="form-control" placeholder="" style="border-radius: 0px;border:0px;"></td>
          <td style="padding: 0;"><input type="text"   id="Po1_Pi1_NRSC" class="form-control" placeholder="" style="border-radius: 0px;border:0px;"></td>
          <td style="padding: 0;"><input type="number" id="Po1_Pi1_IT" min="0" step="any" class="form-control" placeholder="" style="border-radius: 0px;border:0px;" onkeyup="Importe(this,1,1)"></td>
          </tr>

          <tr>
          <td style="padding: 0;">
          <div class="input-group">
          <div class="input-group-prepend">
          <span class="input-group-text" style="border-radius: 0px;border:0px;font-size: .9em;">Pipa 2</span>
          </div>
          <input type="number" id="Po1_Pi2_VC" min="0" step="any" class="form-control" style="border-radius: 0px;border:0px;" onkeyup="VolumenCompra(this,1,2)">
          </div>
          </td>
          <td style="padding: 0;"><input type="number" id="Po1_Pi2_PL" min="0" step="any" class="form-control" placeholder="" style="border-radius: 0px;border:0px;" disabled></td>
          <td style="padding: 0;"><input type="number" id="Po1_Pi2_CF" min="0" step="any" class="form-control" placeholder="" style="border-radius: 0px;border:0px;"></td>
          <td style="padding: 0;"><input type="text" id="Po1_Pi2_NF" class="form-control" placeholder="" style="border-radius: 0px;border:0px;"></td>
          <td style="padding: 0;"><input type="text"  id="Po1_Pi2_NRSC" class="form-control" placeholder="" style="border-radius: 0px;border:0px;"></td>
          <td style="padding: 0;"><input type="number" id="Po1_Pi2_IT" min="0" step="any" class="form-control" placeholder="" style="border-radius: 0px;border:0px;" onkeyup="Importe(this,1,2)"></td>
          </tr>

          <tr>
          <td style="padding: 0;">
          <div class="input-group">
          <div class="input-group-prepend">
          <span class="input-group-text" style="border-radius: 0px;border:0px;font-size: .9em;">Pipa 3</span>
          </div>
          <input type="number" id="Po1_Pi3_VC" min="0" step="any" class="form-control" style="border-radius: 0px;border:0px;" onkeyup="VolumenCompra(this,1,3)">
          </div>
          </td>
          <td style="padding: 0;"><input type="number" id="Po1_Pi3_PL" min="0" step="any" class="form-control" placeholder="" style="border-radius: 0px;border:0px;" disabled></td>
          <td style="padding: 0;"><input type="number" id="Po1_Pi3_cF" min="0" step="any" class="form-control" placeholder="" style="border-radius: 0px;border:0px;"></td>
          <td style="padding: 0;"><input type="text" id="Po1_Pi3_NF" class="form-control" placeholder="" style="border-radius: 0px;border:0px;"></td>
          <td style="padding: 0;"><input type="text"  id="Po1_Pi3_NRSC" class="form-control" placeholder="" style="border-radius: 0px;border:0px;"></td>
          <td style="padding: 0;"><input type="number" id="Po1_Pi3_IT" min="0" step="any" class="form-control" placeholder="" style="border-radius: 0px;border:0px;" onkeyup="Importe(this,1,3)"></td>
          </tr>

        </table>
      </div>

 
        </div>

      </div>

    </div>
     </div>
 
      <?php
      }
      ?>

      <!-- - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -  -->
      <?php
      if ($Session_ProductoDos != "") {
      ?>

      <!-- PRODUCTO G-PREMUIM -->
    <div class="border mb-3">
    <div class="p-3">

      <div style="font-size: 1.2em;">
      <label style="border-bottom: 2px solid #c75959;">Producto: <b><?=$Session_ProductoDos;?></b></label>
      </div>


      <div class="row">
        
      <!-- TABLA - AGREGAR VOLUMEN INICIAL, FINAL Y VENTAS-->
    <div class="col-xl-5 col-lg-5 col-md-12 col-sm-12">
          <div class="text-muted mt-2 mb-2" style="font-size: .8em;padding-top: 5px;padding-bottom: 5px;">
          <b>* 1.</b> Agregar el volumen inicial, final y ventas en (Lt).
        </div>

      <!-- TABLA - AQUI-->
      <div class="mb-2" style="overflow-y: hidden;">
        <table class="table table-bordered table-sm">
          <tr>
          <th class="text-center text-secondary">Volumen (Lt) Inicial</th>
          <th class="text-center text-secondary">Volumen (Lt) de venta</th>
          <th class="text-center text-secondary" colspan="2">Volumen (Lt) Final</th>
          </tr>
          <tr>
            <td style="padding: 0;"><input type="number" id="Po2_VoI" min="0" step="any" class="form-control" placeholder="Volumen (Lt) Inicial" style="border-radius: 0px;border:0px;border-bottom: 2px solid #d1d1d1;"></td>
            <td style="padding: 0;"><input type="number" id="Po2_VoV" min="0" step="any" class="form-control" placeholder="Volumen (Lt) de venta" style="border-radius: 0px;border:0px;border-bottom: 2px solid #d1d1d1;"></td>
            <td colspan="2" style="padding: 0;"><input type="number" id="Po2_VoF" min="0" step="any" class="form-control" placeholder="Volumen (Lt) Final" style="border-radius: 0px;border:0px;border-bottom: 2px solid #d1d1d1;"></td>
          </tr>
      </table>
    </div>

        </div>


      <!-- TABLA - AGREGAR VOLUMEN COMPRAS DE PIPAS-->
    <div class="col-xl-7 col-lg-7 col-md-12 col-sm-12">
          <div class="text-muted mt-2 mb-2" style="font-size: .8em;padding-top: 5px;padding-bottom: 5px;">
          <b>* 2.</b> Agregar el volumen de las compras de pipas.
          </div>


      <!-- TABLA - AQUI-->
        <div class="mb-2" style="overflow-y: hidden;">
        <table class="table table-bordered table-sm">
          <tr>
            <td class="text-center text-secondary font-weight-bold align-middle">Volumen (Lt) de Compra</td>
            <td class="text-center text-secondary font-weight-bold align-middle">Precio ($) por litro de producto</td>
            <td class="text-center text-secondary font-weight-bold align-middle">Costo ($) del flete mas IVA</td>
            <td class="text-center text-secondary font-weight-bold align-middle">No. De factura</td>
            <td class="text-center text-secondary font-weight-bold align-middle" class="text-center text-secondary">Nombre o Razón Social del Transportista</td>
            <td class="text-center text-secondary font-weight-bold align-middle">Importe</td>
          </tr>
          <tr>
          <td style="padding: 0;">
          <div class="input-group">
          <div class="input-group-prepend">
          <span class="input-group-text" style="border-radius: 0px;border:0px;font-size: .9em;">Pipa 1</span>
          </div>
          <input type="number" id="Po2_Pi1_VC" min="0" step="any" class="form-control" style="border-radius: 0px;border:0px;" onkeyup="VolumenCompra(this,2,1)">
          </div>
          </td>
          <td style="padding: 0;"><input type="number" id="Po2_Pi1_PL" min="0" step="any" class="form-control" placeholder="" style="border-radius: 0px;border:0px;" disabled></td>
          <td style="padding: 0;"><input type="number" id="Po2_Pi1_CF" min="0" step="any" class="form-control" placeholder="" style="border-radius: 0px;border:0px;"></td>
          <td style="padding: 0;"><input type="text" id="Po2_Pi1_NF" class="form-control" placeholder="" style="border-radius: 0px;border:0px;"></td>
          <td style="padding: 0;"><input type="text"  id="Po2_Pi1_NRSC" class="form-control" placeholder="" style="border-radius: 0px;border:0px;"></td>
          <td style="padding: 0;"><input type="number"  id="Po2_Pi1_IT" min="0" step="any" class="form-control" placeholder="" style="border-radius: 0px;border:0px;" onkeyup="Importe(this,2,1)"></td>
          </tr>

          <tr>
          <td style="padding: 0;">
          <div class="input-group">
          <div class="input-group-prepend">
          <span class="input-group-text" style="border-radius: 0px;border:0px;font-size: .9em;">Pipa 2</span>
          </div>
          <input type="number" id="Po2_Pi2_VC" min="0" step="any" class="form-control" style="border-radius: 0px;border:0px;" onkeyup="VolumenCompra(this,2,2)">
          </div>
          </td>
          <td style="padding: 0;"><input type="number" id="Po2_Pi2_PL" min="0" step="any" class="form-control" placeholder="" style="border-radius: 0px;border:0px;" disabled></td>
          <td style="padding: 0;"><input type="number" id="Po2_Pi2_CF" min="0" step="any" class="form-control" placeholder="" style="border-radius: 0px;border:0px;"></td>
          <td style="padding: 0;"><input type="text" id="Po2_Pi2_NF" class="form-control" placeholder="" style="border-radius: 0px;border:0px;"></td>
          <td style="padding: 0;"><input type="text"  id="Po2_Pi2_NRSC" class="form-control" placeholder="" style="border-radius: 0px;border:0px;"></td>
          <td style="padding: 0;"><input type="number"  id="Po2_Pi2_IT" min="0" step="any" class="form-control" placeholder="" style="border-radius: 0px;border:0px;" onkeyup="Importe(this,2,2)"></td>
          </tr>

          <tr>
          <td style="padding: 0;">
          <div class="input-group">
          <div class="input-group-prepend">
          <span class="input-group-text" style="border-radius: 0px;border:0px;font-size: .9em;">Pipa 3</span>
          </div>
          <input type="number" id="Po2_Pi3_VC" min="0" step="any" class="form-control" style="border-radius: 0px;border:0px;" onkeyup="VolumenCompra(this,2,3)">
          </div>
          </td>
          <td style="padding: 0;"><input type="number" id="Po2_Pi3_PL" min="0" step="any" class="form-control" placeholder="" style="border-radius: 0px;border:0px;" disabled></td>
          <td style="padding: 0;"><input type="number" id="Po2_Pi3_CF" min="0" step="any" class="form-control" placeholder="" style="border-radius: 0px;border:0px;"></td>
          <td style="padding: 0;"><input type="text" id="Po2_Pi3_NF" class="form-control" placeholder="" style="border-radius: 0px;border:0px;"></td>
          <td style="padding: 0;"><input type="text"  id="Po2_Pi3_NRSC" class="form-control" placeholder="" style="border-radius: 0px;border:0px;"></td>
          <td style="padding: 0;"><input type="number"  id="Po2_Pi3_IT" min="0" step="any" class="form-control" placeholder="" style="border-radius: 0px;border:0px;" onkeyup="Importe(this,2,3)"></td>
          </tr>

        </table>
      </div>
        </div>
      </div>
      </div>
    </div>

      <?php
      }
      ?>

      <!-- - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - - -  -->
      <!-- PRODUCTO G-DIESEL -->

      <?php
      if ($Session_ProductoTres != "") {
      ?>
      
    <div class="border mb-3">
    <div class="p-3">
      <div class="" style="font-size: 1.2em;">
      <label style="border-bottom: 2px solid #4f4f4f;">Producto: <b><?=$Session_ProductoTres;?></b></label>
      </div>

      <div class="row">
        
      <!-- PRODUCTO G-PREMUIM -->
    <div class="col-xl-5 col-lg-5 col-md-12 col-sm-12">
      
      <!-- TABLA - AGREGAR VOLUMEN INICIAL, FINAL Y VENTAS-->
      <div class="text-muted" style="font-size: .8em;padding-top: 5px;padding-bottom: 5px;">
          <b>* 1.</b> Agregar el volumen inicial, final y ventas en (Lt).
        </div>
      

      <!-- TABLA - AQUI-->
        <div class="mb-2" style="overflow-y: hidden;"> 
        <table class="table table-bordered table-sm">
          <tr>
          <th class="text-center text-secondary">Volumen (Lt) Inicial</th>
          <th class="text-center text-secondary">Volumen (Lt) de venta</th>
          <th colspan="2" class="text-center text-secondary">Volumen (Lt) Final</th>
          </tr>
          <tr>
            <td style="padding: 0;"><input type="number" id="Po3_VoI" min="0" step="any" class="form-control" placeholder="Volumen (Lt) Inicial" style="border-radius: 0px;border:0px;border-bottom: 2px solid #d1d1d1;"></td>
            <td style="padding: 0;"><input type="number" id="Po3_VoV" min="0" step="any" class="form-control" placeholder="Volumen (Lt) de venta" style="border-radius: 0px;border:0px;border-bottom: 2px solid #d1d1d1;"></td>
            <td colspan="2" style="padding: 0;"><input type="number" id="Po3_VoF" min="0" step="any" class="form-control" placeholder="Volumen (Lt) Final" style="border-radius: 0px;border:0px;border-bottom: 2px solid #d1d1d1;"></td>
          </tr>
        </table>
      </div>

      </div>


      <!-- TABLA - AGREGAR VOLUMEN COMPRAS DE PIPAS-->
    <div class="col-xl-7 col-lg-7 col-md-12 col-sm-12">
      <div class="text-muted" style="font-size: .8em;padding-top: 5px;padding-bottom: 5px;">
          <b>* 2.</b> Agregar el volumen de las compras de pipas.
          </div>
       
      <!-- TABLA - AQUI-->
       <div class="mb-2" style="overflow-y: hidden;">
        <table class="table table-bordered table-sm">
          <tr>
            <td class="text-center text-secondary font-weight-bold align-middle align-middle">Volumen (Lt) de Compra</td>
            <td class="text-center text-secondary font-weight-bold align-middle align-middle">Precio ($) por litro de producto</td>
            <td class="text-center text-secondary font-weight-bold align-middle align-middle">Costo ($) del flete mas IVA</td>
            <td class="text-center text-secondary font-weight-bold align-middle align-middle">No. De factura</td>
            <td class="text-center text-secondary font-weight-bold align-middle align-middle" class="text-center text-secondary">Nombre o Razón Social del Transportista</td>
            <td class="text-center text-secondary font-weight-bold align-middle">Importe</td>
          </tr>
          <tr>
          <td style="padding: 0;">
          <div class="input-group">
          <div class="input-group-prepend">
          <span class="input-group-text" style="border-radius: 0px;border:0px;font-size: .9em;">Pipa 1</span>
          </div>
          <input type="number" id="Po3_Pi1_VC" min="0" step="any" class="form-control" style="border-radius: 0px;border:0px;" onkeyup="VolumenCompra(this,3,1)">
          </div>
          </td>
          <td style="padding: 0;"><input type="number" id="Po3_Pi1_PL" min="0" step="any" class="form-control" placeholder="" style="border-radius: 0px;border:0px;" disabled></td>
          <td style="padding: 0;"><input type="number" id="Po3_Pi1_CF" min="0" step="any" class="form-control" placeholder="" style="border-radius: 0px;border:0px;"></td>
          <td style="padding: 0;"><input type="text" id="Po3_Pi1_NF" class="form-control" placeholder="" style="border-radius: 0px;border:0px;"></td>
          <td style="padding: 0;"><input type="text"  id="Po3_Pi1_NRSC" class="form-control" placeholder="" style="border-radius: 0px;border:0px;"></td>
          <td style="padding: 0;"><input type="number" id="Po3_Pi1_IT" min="0" step="any" class="form-control" placeholder="" style="border-radius: 0px;border:0px;" onkeyup="Importe(this,3,1)"></td>
          </tr>

          <tr>
          <td style="padding: 0;">
          <div class="input-group">
          <div class="input-group-prepend">
          <span class="input-group-text" style="border-radius: 0px;border:0px;font-size: .9em;">Pipa 2</span>
          </div>
          <input type="number" id="Po3_Pi2_VC" min="0" step="any" class="form-control" style="border-radius: 0px;border:0px;" onkeyup="VolumenCompra(this,3,2)">
          </div>
          </td>
          <td style="padding: 0;"><input type="number" id="Po3_Pi2_PL" min="0" step="any" class="form-control" placeholder="" style="border-radius: 0px;border:0px;" disabled></td>
          <td style="padding: 0;"><input type="number" id="Po3_Pi2_CF" min="0" step="any" class="form-control" placeholder="" style="border-radius: 0px;border:0px;"></td>
          <td style="padding: 0;"><input type="text" id="Po3_Pi2_NF" class="form-control" placeholder="" style="border-radius: 0px;border:0px;"></td>
          <td style="padding: 0;"><input type="text" id="Po3_Pi2_NRSC" class="form-control" placeholder="" style="border-radius: 0px;border:0px;"></td>
          <td style="padding: 0;"><input type="number" id="Po3_Pi2_IT" min="0" step="any" class="form-control" placeholder="" style="border-radius: 0px;border:0px;" onkeyup="Importe(this,3,2)"></td>
          </tr>

          <tr>
          <td style="padding: 0;">
          <div class="input-group">
          <div class="input-group-prepend">
          <span class="input-group-text" style="border-radius: 0px;border:0px;font-size: .9em;">Pipa 3</span>
          </div>
          <input type="number" id="Po3_Pi3_VC" min="0" step="any" class="form-control" style="border-radius: 0px;border:0px;" onkeyup="VolumenCompra(this,3,3)">
          </div>
          </td>
          <td style="padding: 0;"><input type="number" id="Po3_Pi3_PL" min="0" step="any" class="form-control" placeholder="" style="border-radius: 0px;border:0px;" disabled></td>
          <td style="padding: 0;"><input type="number" id="Po3_Pi3_CF" min="0" step="any" class="form-control" placeholder="" style="border-radius: 0px;border:0px;"></td>
          <td style="padding: 0;"><input type="text" id="Po3_Pi3_NF" class="form-control" placeholder="" style="border-radius: 0px;border:0px;"></td>
          <td style="padding: 0;"><input type="text"  id="Po3_Pi3_NRSC" class="form-control" placeholder="" style="border-radius: 0px;border:0px;"></td>
          <td style="padding: 0;"><input type="number" id="Po3_Pi3_IT" min="0" step="any" class="form-control" placeholder="" style="border-radius: 0px;border:0px;" onkeyup="Importe(this,3,3)"></td>
          </tr>

        </table>
      </div>

        </div>
      </div>
    </div>
  </div>

      <?php
      }
      ?>

    </div>
    </div>
    </div>
    </div>
    </div>


  <script src="<?php echo RUTA_JS ?>bootstrap.min.js"></script>
  </body>
  </html>
