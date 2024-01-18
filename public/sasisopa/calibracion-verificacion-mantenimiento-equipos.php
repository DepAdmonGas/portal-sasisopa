<?php
require('app/help.php');

function TanquesAlmacenamiento($IDEstacion,$con){
$sql = "SELECT * FROM tb_tanque_almacenamiento WHERE id_estacion = '".$IDEstacion."' ";
$result = mysqli_query($con, $sql);
$numero = mysqli_num_rows($result);
if ($numero > 0) {
while($row = mysqli_fetch_array($result, MYSQLI_ASSOC)){
$Contenido .= "<tr>";
$Contenido .= "<td class='text-center align-middle'>".$row['no_tanque']."</td>";
$Contenido .= "<td class='text-center align-middle'>".$row['capacidad'].", ".$row['producto']."</td>";
$Contenido .= "<td class='text-center align-middle'>Tanques de almacenamiento</td>";
$Contenido .= "<td class='text-center align-middle'>10 años</td>";
$Contenido .= "</tr>";
}
}
return $Contenido;
}

function SondasMedicion($IDEstacion,$con){
$sql = "SELECT * FROM tb_sondas_medicion WHERE id_estacion = '".$IDEstacion."' ";
$result = mysqli_query($con, $sql);
$numero = mysqli_num_rows($result);
if ($numero > 0) {
while($row = mysqli_fetch_array($result, MYSQLI_ASSOC)){
$Contenido .= "<tr>";
$Contenido .= "<td class='text-center align-middle'>".$row['no_sonda']."</td>";
$Contenido .= "<td class='text-center align-middle'>".$row['marca'].", ".$row['modelo']."</td>";
$Contenido .= "<td class='text-center align-middle'>Sondas de medición</td>";
$Contenido .= "<td class='text-center align-middle'>2 años</td>";
$Contenido .= "</tr>";
}
}
return $Contenido;
}

function Dispensario($IDEstacion,$con){
$sql = "SELECT * FROM tb_dispensarios WHERE id_estacion = '".$IDEstacion."' ";
$result = mysqli_query($con, $sql);
$numero = mysqli_num_rows($result);
if ($numero > 0) {
while($row = mysqli_fetch_array($result, MYSQLI_ASSOC)){
$Contenido .= "<tr>";
$Contenido .= "<td class='text-center align-middle'>".$row['no_dispensario']."</td>";
$Contenido .= "<td class='text-center align-middle'>".$row['marca'].", ".$row['modelo']."</td>";
$Contenido .= "<td class='text-center align-middle'>Dispensario</td>";
$Contenido .= "<td class='text-center align-middle'>Semestral</td>";
$Contenido .= "</tr>";
}
}
return $Contenido;
}

function JarraPatron($IDEstacion,$con){

$i = 1;
$sql = "SELECT * FROM tb_jarra_patron WHERE id_estacion = '".$IDEstacion."' ";
$result = mysqli_query($con, $sql);
$numero = mysqli_num_rows($result);
if ($numero > 0) {
while($row = mysqli_fetch_array($result, MYSQLI_ASSOC)){
$Contenido .= "<tr>";
$Contenido .= "<td class='text-center align-middle'>".$i."</td>";
$Contenido .= "<td class='text-center align-middle'>".$row['marca'].", ".$row['no_serie']."</td>";
$Contenido .= "<td class='text-center align-middle'>Jarra patron</td>";
$Contenido .= "<td class='text-center align-middle'>Anual</td>";
$Contenido .= "</tr>";

$i++;
}
}
return $Contenido;
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
  CalendarioCalibraciones();
  });

  function regresarP(){
  window.history.back();
  }

  function CalendarioCalibraciones(){
  $('#CalendarioCalibraciones').load('public/sasisopa/vistas/calendario-calibraciones.php');
  }

  function Bitacora(){
  window.location.href = 'bitacora-calibracion-equipos';
  }

  function DescargarESC(){
  window.location.href = 'descargar-equipos-sometidos-calibracion';
  }

  function Adjuntar(id){
  $('#Modal').modal('show');
  $('#DivModal').load('public/sasisopa/vistas/modal-agregar-resultados-calibracion.php?ID=' + id);
  }

  function AgregarR(id){

  var data = new FormData();
  var url = "public/sasisopa/agregar/agregar-resultados-calibracion.php";

  var Archivo = document.getElementById("Archivo");
  var file = Archivo.files[0];
  var filePath = Archivo.value;
  var valpdf = filePath.split('.').pop();

  if (filePath != "") {
  $('#Archivo').css('border','');
  if (valpdf == "pdf") {
  $('#Archivo').css('border','');
  $('#DivResultadoPDF').html('');

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

  CalendarioCalibraciones();
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

  function DescargarCalendario(){
  window.location.href = 'descargar-calendario-calibracion'; 
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
    
    <div class="float-left">
      <h4>Calibración, Verificación y mantenimiento de equipos</h4>
    </div>

    </div>
    <div class="card-body">

    <div class="row">
    <div class="col-3">
      <div class="border p-3">
      <h5>Bitácora calibración de equipos</h5>
      <div class="text-right mt-3">
      <button type="button" class="btn btn-primary" style="border-radius: 0px;" onclick="Bitacora()">Ver detalle</button>
      </div>
      </div>
    </div>
    </div>

    <div class="row">
      <div class="col-5">

      <div class="text-right" style="margin-top: 6px;">
    <a onclick="DescargarESC()" style="cursor: pointer;" data-toggle="tooltip" data-placement="left" title="Descargar" >
    <img src="<?php echo RUTA_IMG_ICONOS."pdf.png"; ?>">
    </a>
    </div>

      <table class="table table-bordered table-sm mt-2 mb-1" style="font-size: .9em;">
      <tr>
      <td class="text-center align-middle"><img class="text-center" src="<?php echo RUTA_IMG_LOGOS."Logo.png";?>" style="width: 150px;"></td>
      <td colspan="2" class="text-center align-middle"><b>Equipos sometidos a calibración</b></td>
      <td class="text-center align-middle">Fo.ADMONGAS.019</td>
      </tr>
      <tr>
      <td class="text-center align-middle">Realizado por: Nelly Estrada Garcia </td>
      <td class="text-center align-middle">Revisado por: Eduardo Galicia Flores </td>
      <td class="text-center align-middle">Autorizado por: <?=$Session_ApoderadoLegal;?> </td>
      <td class="text-center align-middle">Fecha de autorizacion 01/10/2018</td>
      </tr>
      </table>

      <table class="table table-bordered table-sm" style="font-size: .9em;">
        <thead>
          <tr>
            <th class="text-center align-middle">Número de identificación</th>
            <th class="text-center align-middle">Nombre del equipo (marca y modelo)</th>
            <th class="text-center align-middle">Descripcion del equipo</th>
            <th class="text-center align-middle">Frecuencia de la calibración</th>
          </tr>
        </thead>
        <tbody>
        <?php 
        echo TanquesAlmacenamiento($Session_IDEstacion,$con);
        echo SondasMedicion($Session_IDEstacion,$con);
        echo Dispensario($Session_IDEstacion,$con);
        echo JarraPatron($Session_IDEstacion,$con);
        ?>
        </tbody>
      </table>
      </div>

      <div class="col-7">
      <div id="CalendarioCalibraciones"></div>   
      </div>   

      </div>


    </div>
    </div>
    </div>
    </div>
    </div>


  <div class="modal fade bd-example-modal-lg" id="Modal" >
  <div class="modal-dialog modal-dialog-centered" role="document">
  <div class="modal-content" style="border-radius: 0px;border: 0px;">
  <div id="DivModal"></div>
  </div>
  </div>
  </div>

  <script src="<?php echo RUTA_JS ?>bootstrap.min.js"></script>
  </body>
  </html>
