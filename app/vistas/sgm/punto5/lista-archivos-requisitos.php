<?php
require('../../../../app/help.php');

$NGobierno = $_GET['NGobierno'];

if ($NGobierno == "municipal") {
    $title = "Municipal";
    }else if ($NGobierno == "estatal") {
    $title = "Estatal"; 
    }else if ($NGobierno == "federal") {
    $title = "Federal";
    }else if ($NGobierno == "varios") {
    $title = "Varios";
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

function DetalleRL($idrequisitol,$con){

$sql = "SELECT * FROM rl_requisitos_legales_lista WHERE id = '".$idrequisitol."' LIMIT 1 ";
$result = mysqli_query($con, $sql);
$numero = mysqli_num_rows($result);
while($row = mysqli_fetch_array($result, MYSQLI_ASSOC)){
$dependencia = $row['dependencia'];
$permiso = $row['permiso']; 
}

$array = array(
"dependencia" => $dependencia,
"permiso" => $permiso,
);

return $array;
}

$vigencia = "";
$TotalCmp = 0;
$sql_programa_c = "SELECT * FROM rl_requisitos_legales_calendario WHERE id_estacion = '".$Session_IDEstacion."' AND categoria = 1 AND estado = 1";
$result_programa_c = mysqli_query($con, $sql_programa_c);
$numero_programa_c = mysqli_num_rows($result_programa_c);

if ($numero_programa_c != 0) {
?>
<table class="table table-bordered table-sm" id="table-requisitos-legales">
  <thead>
  <tr class="bg-primary text-white">
    <th class="text-center align-middle">Dependencia</th>
    <th class="text-center align-middle">Permiso</th>
    <th class="text-center align-middle">Vigencia</th>
    <th class="text-center align-middle">Fecha emisión</th>
    <th class="text-center align-middle">Fecha vencimiento</th>
    <th class="text-center align-middle">Acuse</th>
    <th class="text-center align-middle">Requisito Legal</th>
    <th class="text-center align-middle">% Cumplimiento</th>
    <th class="text-center align-middle">Renovación</th>
    <th class="text-center align-middle"><i class="fas fa-ellipsis-v"></i></th>
     
  </tr>
  </thead>
  <tbody>
  <?php
  while($row_programa_c = mysqli_fetch_array($result_programa_c, MYSQLI_ASSOC)){

$idrequisitol = $row_programa_c['id_requisito_legal'];
$idre = $row_programa_c['id'];
$enero = $row_programa_c['enero'];
$febrero = $row_programa_c['febrero'];
$marzo = $row_programa_c['marzo'];
$abril = $row_programa_c['abril'];
$mayo = $row_programa_c['mayo'];
$junio = $row_programa_c['junio'];
$julio = $row_programa_c['julio'];
$agosto = $row_programa_c['agosto'];
$septiembre = $row_programa_c['septiembre'];
$octubre = $row_programa_c['octubre'];
$noviembre = $row_programa_c['noviembre'];
$diciembre = $row_programa_c['diciembre'];

if($row_programa_c['id_requisito_legal'] == 0){
$dependencia = 'S/I';
$requisitol = $row_programa_c['requisito_legal'];
}else{
$DetalleRL = DetalleRL($idrequisitol,$con);
$dependencia = $DetalleRL['dependencia'];
$requisitol = $DetalleRL['permiso'];
}

if ($enero == 1) {
$Colenero = "Enero,";
}else{
$Colenero = ""; 
}

if ($febrero == 1) {
$Colfebrero = "Febrero,";
}else{
$Colfebrero = ""; 
}

if ($marzo == 1) {
$Colmarzo = "Marzo,";
}else{
$Colmarzo = ""; 
}

if ($abril == 1) {
$Colabril = "Abril,";
}else{
$Colabril = ""; 
}

if ($mayo == 1) {
$Colmayo = "Mayo,";
}else{
$Colmayo = ""; 
}

if ($junio == 1) {
$Coljunio = "Junio,";
}else{
$Coljunio = ""; 
}

if ($julio == 1) {
$Coljulio = "Julio,";
}else{
$Coljulio = ""; 
}

if ($agosto == 1) {
$Colagosto = "Agosto,";
}else{
$Colagosto = ""; 
}

if ($septiembre == 1) {
$Colseptiembre = "Septiembre,";
}else{
$Colseptiembre = ""; 
}

if ($octubre == 1) {
$Coloctubre = "Octubre,";
}else{
$Coloctubre = ""; 
}

if ($noviembre == 1) {
$Colnoviembre = "Noviembre,";
}else{
$Colnoviembre = ""; 
}

if ($diciembre == 1) {
$Coldiciembre = "Diciembre,";
}else{
$Coldiciembre = ""; 
}

$UltimaA = UltimaAct($idre,$con);

$ArrayRenovacion = $Colenero.$Colfebrero.$Colmarzo.$Colabril.$Colmayo.$Coljunio.$Coljulio.$Colagosto.$Colseptiembre.$Coloctubre.$Colnoviembre.$Coldiciembre;

if($ArrayRenovacion == ""){
$Renovacion = "S/I";
}else{
$Renovacion = trim($ArrayRenovacion, ',');
}

  if ($UltimaA['acusepdf'] == "") {
  $imgPDFA = "<img src='".RUTA_IMG_ICONOS."img-no.png'>";
  }else{
  $ext_acuse = pathinfo($UltimaA['acusepdf'], PATHINFO_EXTENSION);

  if($ext_acuse == 'pdf'){
    $imgPDFA = "<a target='_blank' href='".$UltimaA['acusepdf']."' ><img src='".RUTA_IMG_ICONOS."pdf-16.png'></a>";
  }else{
   $imgPDFA = "<a target='_blank' href='".$UltimaA['acusepdf']."' ><img width='16px' src='".RUTA_IMG_ICONOS."descargar.png'></a>"; 
  }

  
  }

  if ($UltimaA['requisitolegalpdf'] == "") {
  $imgPDFRL = "<img src='".RUTA_IMG_ICONOS."img-no.png'>";
  }else{

    $ext_requisito = pathinfo($UltimaA['requisitolegalpdf'], PATHINFO_EXTENSION);
    if($ext_requisito == 'pdf'){
    $imgPDFRL = "<a target='_blank' href='".$UltimaA['requisitolegalpdf']."' ><img src='".RUTA_IMG_ICONOS."pdf-16.png'></a>";
    }else{
    $imgPDFRL = "<a target='_blank' href='".$UltimaA['requisitolegalpdf']."' ><img width='16px' src='".RUTA_IMG_ICONOS."descargar.png'></a>";
    }

  }

  if($vigencia == 'Cuando se realice cambio' || $vigencia == 'Permanente'){
  $fondotr = ''; 
  }else{

  if($UltimaA['fechavencimiento'] == "0000-00-00" || $UltimaA['fechavencimiento'] == "S/I"){
  $fondotr = '';
  }else{
  $FechaNot = date("Y-m-d",strtotime($UltimaA['fechavencimiento']."-30 days"));
  $timestamp1 = strtotime($FechaNot);
  $timestamp2 = strtotime($fecha_del_dia);
  if($timestamp1 <= $timestamp2){
  $fondotr = 'table-warning';
  }else{
  $fondotr = ''; 
  }
  }

  } 

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

  echo "<tr class='".$fondotr." table-tr'>";
  echo "<td class='text-center align-middle'><b>".$dependencia."</b></td>";
  echo "<td class='text-center align-middle'><b>".$requisitol."</b></td>";
  echo "<td class='text-center align-middle'>".$row_programa_c['vigencia']."</td>";
  echo "<td class='text-center align-middle' id='td4-".$idre."'>".$fechaEmision."</td>";
  echo "<td class='text-center align-middle' id='td5-".$idre."'>".$fechaVencimiento."</td>";
  echo "<td class='text-center align-middle' id='td6-".$idre."'>".$imgPDFA."</td>";
  echo "<td class='text-center align-middle' id='td7-".$idre."'>".$imgPDFRL."</td>";
  echo "<td class='text-center align-middle'><b>".$UltimaA['cumplimiento']."</b></td>";
  echo "<td class='text-center align-middle'><small>".$Renovacion."</small></td>";
  
  echo '<td class="text-center align-middle" width="20px" style="cursor: pointer;">
  <div class="dropdown">
  <a class="btn btn-sm btn-icon-only text-dropdown-light" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
  <i class="fas fa-ellipsis-v"></i>
  </a>
  <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">
    <a class="dropdown-item" onclick="Detalle('.$idre.')"><i class="fa-regular fa-eye"></i> Detalle</a>
    <a class="dropdown-item" onclick="editar('.$idre.',\''.$title.'\')"><i class="fa-regular fa-pen-to-square"></i> Editar</a>
    <a class="dropdown-item" onclick="listaReq('.$idre.')"><i class="fa-regular fa-file-lines"></i> Historial</a>
    <a class="dropdown-item" onclick="EliminarRL('.$idre.')"><i class="fa-regular fa-trash-can"></i> Eliminar</a>
  </div>
  </div>
  </td>';

  echo "</tr>";

  $TotalCmp = $TotalCmp + $UltimaA['toCumpli'];
  }
  ?>
</tbody>
</table>

<?php
$Sicumple = $TotalCmp / $numero_programa_c;
$NoCumple = 100 - $Sicumple;
?>

<div style="padding: 10px;margin-top: 20px;border: 1px solid #EFEFEF;">
<label class="text-secondary" style="font-size: .8em">% de cumplimiento por nivel de gobierno</label>
<div class="progress" style='font-size: .9em;height: 20px;'>
<div class="progress-bar progress-bar-striped bg-success" role="progressbar" style="width: <?=$Sicumple;?>%" aria-valuenow="<?=$Sicumple;?>" aria-valuemin="0" aria-valuemax="100" >Cumple <?=round($Sicumple);?> %</div>
<div class="progress-bar progress-bar-striped bg-danger" role="progressbar" style="width: <?=$NoCumple;?>%" aria-valuenow="<?=$NoCumple;?>" aria-valuemin="0" aria-valuemax="100">No cumple <?=round($NoCumple);?> %</div>
</div>
</div>

<?php 
}
?>
