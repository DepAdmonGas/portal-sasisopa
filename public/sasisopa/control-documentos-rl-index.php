<?php
require('app/help.php');

function RequisitoLegal($idRequisito,$con){

$sql = "SELECT permiso FROM rl_requisitos_legales_lista WHERE id = '".$idRequisito."'";
$result = mysqli_query($con, $sql);
$numero = mysqli_num_rows($result);
while($row = mysqli_fetch_array($result, MYSQLI_ASSOC)){
$permiso = $row['permiso'];
}

return $permiso;
}

function DetalleRL($idrequisitol,$con){
$sql = "SELECT * FROM rl_requisitos_legales_lista WHERE id = '".$idrequisitol."' LIMIT 1 ";
$result = mysqli_query($con, $sql);
$numero = mysqli_num_rows($result);
 while($row = mysqli_fetch_array($result, MYSQLI_ASSOC)){
$dependencia = $row['dependencia'];
$permiso = $row['permiso']; 
$fundamento = $row['fundamento']; 
}
$array = array(
"dependencia" => $dependencia,
"permiso" => $permiso,
"fundamento" => $fundamento,
);
return $array;
}

function UltimaAct($idre,$con){
$sql_matriz = "SELECT * FROM rl_requisitos_legales_matriz WHERE idcalendario = '".$idre."' ORDER BY id desc LIMIT 1";
$result_matriz = mysqli_query($con, $sql_matriz);
$numero_matriz = mysqli_num_rows($result_matriz);
if($numero_matriz > 0){
while($row_matriz = mysqli_fetch_array($result_matriz, MYSQLI_ASSOC)){


if($row_matriz['fecha_emision'] == "0000-00-00"){
$fechaemision = "S/I"; 
}else{
$fechaemision = $row_matriz['fecha_emision'];
}

if($row_matriz['fecha_vencimiento'] == "0000-00-00"){
$fechavencimiento = "S/I"; 
}else{
$fechavencimiento = $row_matriz['fecha_vencimiento'];
}

$acusepdf = $row_matriz['acusepdf'];
$requisitolegalpdf = $row_matriz['requisitolegalpdf'];
}
}else{
$fechaemision = "S/I";
$fechavencimiento = "S/I"; 
$acusepdf = "";
$requisitolegalpdf = "";
}

if ($acusepdf == "" && $requisitolegalpdf == "") {
  $cumplimiento = "0 %";
  $toCumpli = 0;
  }else if ($acusepdf!= "" && $requisitolegalpdf == "") {
  $cumplimiento = "50 %";
  $toCumpli = 50;
  }else if($acusepdf == "" && $requisitolegalpdf != ""){
  $cumplimiento = "100 %";
  $toCumpli = 100;
  }else if($acusepdf != "" && $requisitolegalpdf != ""){
  $cumplimiento = "100 %";
  $toCumpli = 100;
  }

$array = array('fechaemision' => $fechaemision,
'fechavencimiento' => $fechavencimiento,
'acusepdf' => $acusepdf,
'requisitolegalpdf' => $requisitolegalpdf,
'cumplimiento' => $cumplimiento,
'toCumpli' => $toCumpli);

return $array;
}

function RequisitosLegales($idEstacion,$NivelGobierno,$con){

$sql = "SELECT
rl_requisitos_legales_calendario.id,
rl_requisitos_legales_calendario.nivel_gobierno,
rl_requisitos_legales_calendario.vigencia,
rl_requisitos_legales_calendario.estado,
rl_requisitos_legales_lista.dependencia,
rl_requisitos_legales_lista.permiso,
rl_requisitos_legales_lista.fundamento
FROM rl_requisitos_legales_calendario
INNER JOIN 
rl_requisitos_legales_lista ON 
rl_requisitos_legales_calendario.id_requisito_legal = rl_requisitos_legales_lista.id
WHERE rl_requisitos_legales_calendario.id_estacion = '".$idEstacion."' AND rl_requisitos_legales_calendario.nivel_gobierno = '".$NivelGobierno."' AND rl_requisitos_legales_calendario.estado = 1 ORDER BY dependencia ASC";
$result = mysqli_query($con, $sql);
$numero = mysqli_num_rows($result);

$contenido .= '<table class="table table-bordered table-sm">';
$contenido .= '<thead>';
$contenido .= '<tr class="bg-light">
<th class="align-middle">Dependencia</th>
<th class="align-middle">Permiso</th>
<th class="align-middle">Fundamento</th>
</tr>';
$contenido .= '</thead>';
$contenido .= '<tbody>';
while($row = mysqli_fetch_array($result, MYSQLI_ASSOC)){

$idrequisitol = $row['id_requisito_legal'];
$idre = $row['id'];
$vigencia = $row['vigencia'];

  $UltimaA = UltimaAct($idre,$con);

  if($UltimaA['fechaemision'] == "S/I"){
  $fechaEmision = $UltimaA['fechaemision'];
  }else{
  $fechaEmision = FormatoFecha($UltimaA['fechaemision']);
  }

  if($UltimaA['fechavencimiento'] == "S/I"){
  $fechaVencimiento = $UltimaA['fechavencimiento'];
  }else{
  $fechaVencimiento = FormatoFecha($UltimaA['fechavencimiento']);
  }

$contenido .= '<tr>
<td class="align-middle"><b>'.$row['dependencia'].'</b></td>
<td class="align-middle"><b>'.$row['permiso'].'</b></td>
<td class="align-middle">'.$row['fundamento'].'</td>
</tr>';

}
$contenido .= '</tbody>';
$contenido .= '</table>';

return $contenido;
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
  });
  function regresarP(){
   window.history.back();
  }

  function btnDescargar(){
  window.location = "descargar-control-documentos-rl";  
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
    <div class="float-left"><h4>Control y documentos de Requisitos Legales</h4></div>
    <div class="float-right" style="margin-top: 6px;margin-left: 10px;">

    <a onclick="btnDescargar()" style="cursor: pointer;" data-toggle="tooltip" data-placement="left" title="Descargar" >
    <img src="<?php echo RUTA_IMG_ICONOS."pdf.png"; ?>">
    </a>

    <a onclick="btnAyuda()" style="cursor: pointer;" data-toggle="tooltip" data-placement="left" title="Ayuda" >
    <img src="<?php echo RUTA_IMG_ICONOS."info.png"; ?>">
    </a>
    </div>
    </div>
    <div class="card-body">

      <div class="p-2 bg-primary text-white">Nivel de gobierno <b>Municipal</b></div>
      <?php echo RequisitosLegales($Session_IDEstacion,'municipal',$con); ?>
      <div class="p-2 bg-primary text-white">Nivel de gobierno <b>Federal</b></div>
      <?php echo RequisitosLegales($Session_IDEstacion,'federal',$con); ?>
      <div class="p-2 bg-primary text-white">Nivel de gobierno <b>Estatal</b></div>
      <?php echo RequisitosLegales($Session_IDEstacion,'estatal',$con); ?>
      <div class="p-2 bg-primary text-white">Nivel de gobierno <b>Varios</b></div>
      <?php echo RequisitosLegales($Session_IDEstacion,'varios',$con); ?>

    </div>
    </div>
    </div>

   
  <script src="<?php echo RUTA_JS ?>bootstrap.min.js"></script>
  </body>
  </html>
