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
  });

  function regresarP(){
  window.history.back();
  }

  function ModalDetalle(id){
  $('#ModalDetalle').modal('show');
  $('#DivDetelle').load('public/sasisopa/vistas/modal-detalle-bitacora-mantenimiento-correctivo.php?idMantenimiento=' + id);

  }
  function DescargarReporte(tipo){
window.location = "reporte-bitacora-mantenimiento/" + tipo; 
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
    <div class="float-left"><h4>Mantenimiento Predictivo</h4></div>

    <div class="float-right">
<a class="ml-2" onclick="DescargarReporte('Predictivo')" style="cursor: pointer;" data-toggle="tooltip" data-placement="left" title="Decargar PDF" >
<img src="<?php echo RUTA_IMG_ICONOS."archivo.png"; ?>">
</a>
</div>

    </div>
    <div class="card-body">

<?php

function NombreEquipo($idequipo, $con){
  $sql_equipo = "SELECT * FROM po_mantenimiento_lista WHERE id = '".$idequipo."' ";
  $result_equipo = mysqli_query($con, $sql_equipo);
  $numero_equipo = mysqli_num_rows($result_equipo);
  while($row_equipo = mysqli_fetch_array($result_equipo, MYSQLI_ASSOC)){
  $detalle = $row_equipo['detalle'];
  } 
  return $detalle;
    }

    function FormatFolio($Folio){
        $NumString = strlen($Folio);    
        if($NumString == 1){
        $resultado = "00".$Folio;    
        }else if($NumString == 2){
        $resultado = "0".$Folio;    
        }else if($NumString == 3){
        $resultado = $Folio;    
        }
        return $resultado;    
        }

$sql_mantenimiento = "SELECT * FROM bi_mantenimientos WHERE id_estacion = '".$Session_IDEstacion."' AND categoria_mantenimiento = 'Predictivo' AND estado = 1 ORDER BY id desc";
$result_mantenimiento = mysqli_query($con, $sql_mantenimiento);
$numero_mantenimiento = mysqli_num_rows($result_mantenimiento);

if ($numero_mantenimiento > 0) {

echo '<div class="row">';
while($row_mantenimiento = mysqli_fetch_array($result_mantenimiento, MYSQLI_ASSOC)){

$id = $row_mantenimiento['id'];
$folio = FormatFolio($row_mantenimiento['folio']);

$idactividad = $row_mantenimiento['id_actividad'];

$fechainicio = FormatoFecha($row_mantenimiento['fechainicio']);
$horainicio = date("g:i a",strtotime($row_mantenimiento['horainicio']));

$fechatermino = FormatoFecha($row_mantenimiento['fechatermino']);
$horatermino = date("g:i a",strtotime($row_mantenimiento['horaintermino']));

$descripcion = $row_mantenimiento['descripcion'];
$area = $row_mantenimiento['area'];
$epp = $row_mantenimiento['epp'];
$tipo = $row_mantenimiento['tipo'];

if ($idactividad == "") {
$actividad = $row_mantenimiento['actividad'];
}else{
$actividad = NombreEquipo($idactividad, $con);
}

echo '<div class="col-3">';
echo '<div class="border shadow-sm p-2 c-pointer" onclick="ModalDetalle('.$id.')">';
echo '<div class="text-right mb-1">Folio: <b>'.$folio.'</b></div>';
echo '<div class="border-bottom"></div>';
echo '<div class="text-center font-weight-bold mt-1" style="font-size: 1.2em;">'.$actividad.'</div>';
echo '<div class="border-bottom mt-2"></div>';
echo '<div class="text-right mb-1"><small>'.$fechainicio.', '.$horainicio.'</small></div>';
echo '</div>';
echo '</div>';
}
echo '</div>';
}else{
echo '<div class="alert alert-secondary" role="alert">
  No se encontró información para mostrar
</div>';
}

?>
  
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