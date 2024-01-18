<?php
require('../../../app/help.php');

$idUsuario = $_GET['idUsuario'];

$sql_estaciones = "SELECT * FROM tb_estaciones WHERE numlista <= 8";
$result_estaciones = mysqli_query($con, $sql_estaciones);
$numero_estacion = mysqli_num_rows($result_estaciones);

$sqlUsuario = "SELECT * FROM tb_usuarios WHERE id = '".$idUsuario."' ";
$resultUsuario = mysqli_query($con, $sqlUsuario);
$numeroUsuario = mysqli_num_rows($resultUsuario);
while($rowUsuario = mysqli_fetch_array($resultUsuario, MYSQLI_ASSOC)){ 
$idUsuario = $rowUsuario['id'];
$NombreUsuario = $rowUsuario['nombre'];
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


echo '<h5>'.$NombreUsuario.'</h5>';

while($row_estaciones = mysqli_fetch_array($result_estaciones, MYSQLI_ASSOC)){

$Estacion = $row_estaciones['id'];


echo '<div class="mb-2" style="overflow-y: hidden;">';

echo '<table class="table table-bordered table-sm">';
echo '<thead>';
echo '<tr><th class="text-center p-2 bg-light" colspan="9">'.$row_estaciones['nombre'].'</th></tr>';
echo '</thead>';
echo '<tbody>';
echo '<tr class="bg-primary text-white font-weight-bold">';
echo '<td class="text-center">Nivel de gobierno</td>';
echo '<td class="text-center">Dependencia</td>';
echo '<td class="text-center">Permiso</td>';
echo '<td class="text-center">Vigencia</td>';
echo '<td class="text-center">Fecha emisión</td>';
echo '<td class="text-center">Fecha vencimiento</td>';
echo '<td class="text-center">Acuse</td>';
echo '<td class="text-center">Requisito legal</td>';
echo '<td class="text-center"></td>';
echo '</tr>';

$sql = "SELECT 
rl_requisitos_legales_calendario.id,
rl_requisitos_legales_calendario.id_requisito_legal,
rl_requisitos_legales_calendario.vigencia,
rl_requisitos_legales_lista.nivel_gobierno,
rl_requisitos_legales_lista.dependencia,
rl_requisitos_legales_lista.permiso,
rl_requisitos_legales_lista.id_usuario
FROM rl_requisitos_legales_calendario 
INNER JOIN rl_requisitos_legales_lista 
ON rl_requisitos_legales_calendario.id_requisito_legal = rl_requisitos_legales_lista.id
WHERE rl_requisitos_legales_calendario.id_estacion = '".$Estacion."' AND rl_requisitos_legales_lista.id_usuario = '".$idUsuario."' ORDER BY rl_requisitos_legales_lista.nivel_gobierno ASC
";
$result = mysqli_query($con, $sql);
$numero = mysqli_num_rows($result);
while($row = mysqli_fetch_array($result, MYSQLI_ASSOC)){

$idre = $row['id'];
$UltimaA = UltimaAct($idre,$con);

if ($UltimaA['acusepdf'] == "") {
  $imgPDFA = "<img src='".RUTA_IMG_ICONOS."img-no.png'>";
  }else{
  $imgPDFA = "<a target='_blank' href='".$UltimaA['acusepdf']."' ><img src='".RUTA_IMG_ICONOS."pdf-16.png'></a>";
  }

  if ($UltimaA['requisitolegalpdf'] == "") {
  $imgPDFRL = "<img src='".RUTA_IMG_ICONOS."img-no.png'>";
  }else{
  $imgPDFRL = "<a target='_blank' href='".$UltimaA['requisitolegalpdf']."' ><img src='".RUTA_IMG_ICONOS."pdf-16.png'></a>";
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

echo '<tr class="'.$fondotr.' table-tr">
<td>'.$row['nivel_gobierno'].'</td>
<td>'.$row['dependencia'].'</td>
<td>'.$row['permiso'].'</td>
<td>'.$row['vigencia'].'</td>
<td>'.$fechaEmision.'</td>
<td>'.$fechaVencimiento.'</td>
<td class="text-center align-middle">'.$imgPDFA.'</td>
<td class="text-center align-middle">'.$imgPDFRL.'</td>
<td class="text-center align-middle"><img src="'.RUTA_IMG_ICONOS.'lista.png" style="cursor: pointer;" onclick="listaReq('.$idre.','.$idUsuario.','.$Estacion.')"></td>
</tr>';

}

echo '</tbody>';
echo '</table>';
echo '</div>';

}