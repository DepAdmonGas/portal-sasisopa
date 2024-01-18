<?php
require('app/help.php');

function ToRequisitos($id,$NGobierno,$con){
    $sql_programa_c = "SELECT * FROM rl_requisitos_legales_calendario
    WHERE id_estacion = '".$id."' AND nivel_gobierno = '".$NGobierno."' ";
    $result_programa_c = mysqli_query($con, $sql_programa_c);
    $numero_programa_c = mysqli_num_rows($result_programa_c);
    while($row_programa_c = mysqli_fetch_array($result_programa_c, MYSQLI_ASSOC)){
    $idCa = $row_programa_c['id'];  
    
    $sql_programa_m = "SELECT * FROM rl_requisitos_legales_matriz
    WHERE idcalendario = '".$idCa."' ORDER BY fecha_emision asc LIMIT 1 ";
    $result_programa_m = mysqli_query($con, $sql_programa_m);
    $numero_programa_m = mysqli_num_rows($result_programa_m);
    while($row_programa_m = mysqli_fetch_array($result_programa_m, MYSQLI_ASSOC)){
    
    if ($row_programa_m['acusepdf'] == "" && $row_programa_m['requisitolegalpdf'] == "") {
      $Refin = 0;
      $toCumpli = 0;
      }else if ($row_programa_m['acusepdf'] != "" && $row_programa_m['requisitolegalpdf'] == "") {
      $Refin = 0;
      $toCumpli = 50;
      }else if($row_programa_m['acusepdf'] == "" && $row_programa_m['requisitolegalpdf'] != ""){
      $Refin = 1;
      $toCumpli = 100;
      }else if($row_programa_m['acusepdf'] != "" && $row_programa_m['requisitolegalpdf'] != ""){
      $Refin = 1;
      $toCumpli = 100;
      }
    
      $ToReFin = $ToReFin + $Refin;
      $TotalCmp = $TotalCmp + $toCumpli;
    }
    }
    
    if ($ToReFin == "") {
    $ToReFin = 0;
    }else{
    $ToReFin = $ToReFin; 
    }

    $array = array("ToReFin" => $ToReFin, "ToRe" => $numero_programa_c);
    
    return $array;
    }

function ToPorcentaje($id,$NGobierno,$con){
    
    $sql_programa_c = "SELECT * FROM rl_requisitos_legales_calendario
    WHERE id_estacion = '".$id."' AND nivel_gobierno = '".$NGobierno."' ";
    $result_programa_c = mysqli_query($con, $sql_programa_c);
    $numero_programa_c = mysqli_num_rows($result_programa_c);
    while($row_programa_c = mysqli_fetch_array($result_programa_c, MYSQLI_ASSOC)){
    $idCa = $row_programa_c['id'];  
    
    $sql_programa_m = "SELECT * FROM rl_requisitos_legales_matriz
    WHERE idcalendario = '".$idCa."' ORDER BY fecha_emision desc LIMIT 1 ";
    $result_programa_m = mysqli_query($con, $sql_programa_m);
    $numero_programa_m = mysqli_num_rows($result_programa_m);
    while($row_programa_m = mysqli_fetch_array($result_programa_m, MYSQLI_ASSOC)){
    
    if ($row_programa_m['acusepdf'] == "" && $row_programa_m['requisitolegalpdf'] == "") {
      $Refin = 0;
      $toCumpli = 0;
      }else if ($row_programa_m['acusepdf'] != "" && $row_programa_m['requisitolegalpdf'] == "") {
      $Refin = 0;
      $toCumpli = 50;
      }else if($row_programa_m['acusepdf'] == "" && $row_programa_m['requisitolegalpdf'] != ""){
      $Refin = 1;
      $toCumpli = 100;
      }else if($row_programa_m['acusepdf'] != "" && $row_programa_m['requisitolegalpdf'] != ""){
      $Refin = 1;
      $toCumpli = 100;
      }
    
      $ToReFin = $ToReFin + $Refin;
      $TotalCmp = $TotalCmp + $toCumpli;
    }
    }
    
    if ($TotalCmp == "") {
    $TotalCmp = 0;
    }else{
    $TotalCmp = $TotalCmp; 
    }
    
    if ($TotalCmp == 0) {
    $Sicumple = 0;
    }else{
    $Sicumple = $TotalCmp / $numero_programa_c;
    }
    
    return $Sicumple;  
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
  background: white;
  background: url('../imgs/iconos/load-index-img.gif') 50% 50% no-repeat rgb(255,255,255);
  }
  </style>
  <script type="text/javascript">
  $(document).ready(function($){
  $(".LoaderPage").fadeOut("slow");
  });

  function regresarP(){
   window.history.back(); 
  }

  function BTNRequisito(NGobierno,idEstacion){
  window.location.href = '../gestoria-requisitos-legales/' + NGobierno + "/" + idEstacion; 
  }
  
  function DescargarRequisitos(idEstacion){
  window.location = "descargar-requisitos-legales/" + idEstacion;   
  }
  </script>
  </head>
  <body>

  <div class="LoaderPage"></div>
  <div class="fixed-top navbar-admin">
  <?php require('public/componentes/header.menu.php'); ?>
  </div>
  <div id="DivPrincipal">
  <div class="divcontenedor">
  <div class="divbody">
  <div class="magir-top-principal">

    <div class="magir-top-principal">

<div class="row no-gutters">
<div class="col-12">
<div class="card adm-card" style="border: 0;">
<div class="adm-car-title">
      <div class="float-left" style="padding-right: 20px;margin-top: 5px;">
      <a onclick="regresarP()" style="cursor: pointer;" data-toggle="tooltip" data-placement="right" title="Regresar"><img src="<?php echo RUTA_IMG_ICONOS."regresar.png"; ?>"></a>
      </div>
<div class="float-left"><h4>Requisistos Legales</h4></div>
<div class="float-right">
</div>
</div>

<div class="card-body">

<?php

$sql_estacion = "SELECT * FROM tb_estaciones WHERE id = '".$idEstacion."' ";
$result_estacion = mysqli_query($con, $sql_estacion);
$numero_estacion = mysqli_num_rows($result_estacion);
while($row_estaciones = mysqli_fetch_array($result_estacion, MYSQLI_ASSOC)){
$permisocre = $row_estaciones['permisocre'];
$razonsocial = $row_estaciones['razonsocial'];
}
?>
<h6><?=$razonsocial;?></h6>

<div class="row">

<!-- CARD MUNICIPAL -->
<div class="col-xl-3 col-lg-3 col-md-6 col-sm-12 mt-1 mb-3 ">
<div class="card car-admin card-hover" style="cursor: pointer" onclick="BTNRequisito('municipal',<?=$idEstacion;?>)">
<div class="card-body" style="margin-top: 20px;">
<div class="text-center text-secondary" style="font-size: 1.3em;">Municipal</div>
<?php
$ToPorMunicipal = ToPorcentaje($idEstacion,'Municipal',$con);
$ToReqMunicipal = ToRequisitos($idEstacion,'Municipal',$con);


echo "<div class='text-center text-primary font-weight-bold' style='font-size: 1.4em;margin-top: 20px;'>".round($ToPorMunicipal)." % </div>";

echo "<div class='text-right text-secondary' style='font-size: .8em;'>".$ToReqMunicipal['ToReFin']." de ".$ToReqMunicipal['ToRe']." Requisitos</div>";
?>
</div>
</div>

</div>

<!-- CARD ESTATAL -->
<div class="col-xl-3 col-lg-3 col-md-6 col-sm-12 mt-1 mb-3 ">
<div class="card car-admin card-hover" style="cursor: pointer" onclick="BTNRequisito('estatal',<?=$idEstacion;?>)">
<div class="card-body" style="margin-top: 20px;">
<div class="text-center text-secondary" style="font-size: 1.3em;">Estatal</div>
<?php
$ToPorEstatal = ToPorcentaje($idEstacion,'Estatal',$con);
$ToReqEstatal = ToRequisitos($idEstacion,'Estatal',$con);
echo "<div class='text-center text-primary font-weight-bold' style='font-size: 1.4em;margin-top: 20px;'>".round($ToPorEstatal)." % </div>";

echo "<div class='text-right text-secondary' style='font-size: .8em;'>".$ToReqEstatal['ToReFin']." de ".$ToReqEstatal['ToRe']." Requisitos</div>";
?>
</div>
</div>

</div>

<!-- CARD FEDERAL -->
<div class="col-xl-3 col-lg-3 col-md-6 col-sm-12 mt-1 mb-3 "> 
<div class="card car-admin card-hover" style="cursor: pointer" onclick="BTNRequisito('federal',<?=$idEstacion;?>)">
<div class="card-body" style="margin-top: 20px;">
<div class="text-center text-secondary" style="font-size: 1.3em;">Federal</div>
<?php
$ToPorFederal = ToPorcentaje($idEstacion,'Federal',$con);
$ToReqFederal = ToRequisitos($idEstacion,'Federal',$con);
echo "<div class='text-center text-primary font-weight-bold' style='font-size: 1.4em;margin-top: 20px;'>".round($ToPorFederal)." % </div>";

echo "<div class='text-right text-secondary' style='font-size: .8em;'>".$ToReqFederal['ToReFin']." de ".$ToReqFederal['ToRe']." Requisitos</div>";
?>
</div>
</div>
</div>


<!-- CARD VARIOS -->
<div class="col-xl-3 col-lg-3 col-md-6 col-sm-12 mt-1 mb-3 "> 
<div class="card car-admin card-hover" style="cursor: pointer" onclick="BTNRequisito('varios',<?=$idEstacion;?>)">
<div class="card-body" style="margin-top: 20px;">
<div class="text-center text-secondary" style="font-size: 1.3em;">Varios</div>
<?php
$ToPorVarios = ToPorcentaje($idEstacion,'Varios',$con);
$ToReqVarios = ToRequisitos($idEstacion,'Varios',$con);
echo "<div class='text-center text-primary font-weight-bold' style='font-size: 1.4em;margin-top: 20px;'>".round($ToPorVarios)." % </div>";

echo "<div class='text-right text-secondary' style='font-size: .8em;'>".$ToReqVarios['ToReFin']." de ".$ToReqVarios['ToRe']." Requisitos</div>";
?>
</div>
</div>
</div>

</div>

<?php

if($ToReqMunicipal['ToRe'] > 0){
$TM = 1; 
}else{
$TM = 0; 
}

if($ToReqEstatal['ToRe'] > 0){
$TE = 1; 
}else{
$TE = 0; 
}

if($ToReqFederal['ToRe'] > 0){
$TF = 1; 
}else{
$TF = 0; 
}

if($ToReqVarios['ToRe'] > 0){
$TV = 1; 
}else{
$TV = 0; 
}

$divP = $TM + $TE + $TF + $TV;

$ToPorcentaje = $ToPorMunicipal + $ToPorEstatal + $ToPorFederal + $ToPorVarios;

if($ToPorcentaje == 0 AND $divP == 0){
$Sicumple = 0;
$NoCumple = 100; 
}else{
$Sicumple = $ToPorcentaje / $divP;
$NoCumple = 100 - $Sicumple; 
}

?>
<div style="padding: 10px;margin-top: 20px;border: 1px solid #EFEFEF;">
<label class="text-secondary" style="font-size: .8em">Porcentaje de cumplimiento general</label>
<div class="progress" style='font-size: .9em;height: 20px;'>
<div class="progress-bar progress-bar-striped bg-success" role="progressbar" style="width: <?=$Sicumple;?>%" aria-valuenow="<?=$Sicumple;?>" aria-valuemin="0" aria-valuemax="100">Cumple <?=round($Sicumple);?> %</div>
<div class="progress-bar progress-bar-striped bg-danger" role="progressbar" style="width: <?=$NoCumple;?>%" aria-valuenow="<?=$NoCumple;?>" aria-valuemin="0" aria-valuemax="100">No cumple <?=round($NoCumple);?> %</div>
</div>
</div>

<hr>

<div class="text-secondary">Calendario anual de renovacion de Requisitos Legales <a onclick="DescargarRequisitos(<?=$idEstacion;?>)"><img src="<?php echo RUTA_IMG_ICONOS."pdf.png"; ?>"></a></div>

<div class="text-secondary mt-3">Calendario <a href="../public/administrador/calendario-pdf.php?idEstacion=<?=$idEstacion;?>" download><img src="<?php echo RUTA_IMG_ICONOS."pdf.png"; ?>"></a></div>



</div>

</div>
</div>
</div>
</div>

</div>
</div>
</div>
</div>

<script src="<?php echo RUTA_JS ?>bootstrap.min.js"></script>
</body>
</html>
