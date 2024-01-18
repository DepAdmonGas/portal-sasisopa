<?php
require('../../app/help.php');
$FechaInicio = date('Y-m-d', $_GET['FechaInicio']);
$FechaTermino = date('Y-m-d', $_GET['FechaTermino']);

function UltimaAct($idre,$vigencia,$FechaInicio,$FechaTermino,$con){

if($vigencia == '5 años' || $vigencia == '3 años' || $vigencia == 'Bianual' || $vigencia == 'Permanente' || $vigencia == 'Cuando se realice cambio'){

  if($vigencia == '5 años'){

    $FechaIinicioResta = date("Y-m-d",strtotime($FechaInicio."- 5 year"));
    $query = "AND fecha_emision BETWEEN '".$FechaIinicioResta."' AND '".$FechaTermino."'";

  }else if($vigencia == '3 años'){

    $FechaIinicioResta = date("Y-m-d",strtotime($FechaInicio."- 3 year"));
    $query = "AND fecha_emision BETWEEN '".$FechaIinicioResta."' AND '".$FechaTermino."'";

  }else if($vigencia == 'Bianual'){

    $FechaIinicioResta = date("Y-m-d",strtotime($FechaInicio."- 2 year"));
    $query = "AND fecha_emision BETWEEN '".$FechaIinicioResta."' AND '".$FechaTermino."'";

  }else if($vigencia == 'Permanente' || $vigencia == 'Cuando se realice cambio'){

    $query = "";

  }

$sql_matriz = "SELECT * FROM rl_requisitos_legales_matriz WHERE idcalendario = '".$idre."' $query ORDER BY id desc LIMIT 1";

}else{
$sql_matriz = "SELECT * FROM rl_requisitos_legales_matriz WHERE idcalendario = '".$idre."' AND fecha_emision BETWEEN '".$FechaInicio."' AND '".$FechaTermino."' ORDER BY id desc LIMIT 1";
}

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

function Detalle($NGobierno,$IDEstacion,$FechaInicio,$FechaTermino,$con){

$sql_programa_c = "SELECT
rl_requisitos_legales_calendario.id,
rl_requisitos_legales_calendario.id_estacion,
rl_requisitos_legales_calendario.id_requisito_legal,
rl_requisitos_legales_calendario.nivel_gobierno,
rl_requisitos_legales_calendario.vigencia,
rl_requisitos_legales_calendario.enero,
rl_requisitos_legales_calendario.febrero,
rl_requisitos_legales_calendario.marzo,
rl_requisitos_legales_calendario.abril,
rl_requisitos_legales_calendario.mayo,
rl_requisitos_legales_calendario.junio,
rl_requisitos_legales_calendario.julio,
rl_requisitos_legales_calendario.agosto,
rl_requisitos_legales_calendario.septiembre,
rl_requisitos_legales_calendario.octubre,
rl_requisitos_legales_calendario.noviembre,
rl_requisitos_legales_calendario.diciembre,
rl_requisitos_legales_calendario.estado,
rl_requisitos_legales_lista.dependencia,
rl_requisitos_legales_lista.permiso
FROM rl_requisitos_legales_calendario 
INNER JOIN rl_requisitos_legales_lista 
ON rl_requisitos_legales_calendario.id_requisito_legal = rl_requisitos_legales_lista.id 
WHERE rl_requisitos_legales_calendario.id_estacion = '".$IDEstacion."' AND 
rl_requisitos_legales_calendario.nivel_gobierno = '".$NGobierno."' AND 
rl_requisitos_legales_calendario.estado = 1
ORDER BY rl_requisitos_legales_calendario.id_requisito_legal ASC";
$result_programa_c = mysqli_query($con, $sql_programa_c);
$numero_programa_c = mysqli_num_rows($result_programa_c);

$Result .= '<table class="table table-bordered table-sm">
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
  </tr>
  </thead>
  <tbody>';

  if ($numero_programa_c != 0) {
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
	$vigencia = $row_programa_c['vigencia'];

	if($row_programa_c['id_requisito_legal'] == 0){
	$dependencia = 'S/I';
	$requisitol = $row_programa_c['requisito_legal'];
	}else{
	$DetalleRL = DetalleRL($idrequisitol,$con);
	$dependencia = $DetalleRL['dependencia'];
	$requisitol = $DetalleRL['permiso'];
	}

	$UltimaA = UltimaAct($idre,$vigencia,$FechaInicio,$FechaTermino,$con);

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

  if ($UltimaA['acusepdf'] == "") {
  $imgPDFA = "<img src='".RUTA_IMG_ICONOS."img-no.png'>";
  }else{
  $imgPDFA = "<a target='_blank' href='../../".$UltimaA['acusepdf']."' ><img src='".RUTA_IMG_ICONOS."pdf-16.png'></a>";
  }

  if ($UltimaA['requisitolegalpdf'] == "") {
  $imgPDFRL = "<img src='".RUTA_IMG_ICONOS."img-no.png'>";
  }else{
  $imgPDFRL = "<a target='_blank' href='../../".$UltimaA['requisitolegalpdf']."' ><img src='".RUTA_IMG_ICONOS."pdf-16.png'></a>";
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

$ArrayRenovacion = $Colenero.$Colfebrero.$Colmarzo.$Colabril.$Colmayo.$Coljunio.$Coljulio.$Colagosto.$Colseptiembre.$Coloctubre.$Colnoviembre.$Coldiciembre;

if($ArrayRenovacion == ""){
$Renovacion = "S/I";
}else{
$Renovacion = trim($ArrayRenovacion, ',');
}

  $Result .= "<tr class='".$fondotr." table-tr'>";
  $Result .= "<td class='text-center align-middle'><b>".$dependencia."</b></td>";
  $Result .= "<td class='text-center align-middle'><b>".$requisitol."</b></td>";
  $Result .= "<td class='text-center align-middle'>".$row_programa_c['vigencia']."</td>";
  $Result .= "<td class='text-center align-middle'>".$fechaEmision."</td>";
  $Result .= "<td class='text-center align-middle'>".$fechaVencimiento."</td>";
  $Result .= "<td class='text-center align-middle'>".$imgPDFA."</td>";
  $Result .= "<td class='text-center align-middle'>".$imgPDFRL."</td>";
  $Result .= "<td class='text-center align-middle'><b>".$UltimaA['cumplimiento']."</b></td>";
  $Result .= "<td class='text-center align-middle'><small>".$Renovacion."</small></td>";
  $Result .= "</tr>";

  $TotalCmp = $TotalCmp + $UltimaA['toCumpli'];

  }	
  }

$Result .= '</tbody>
   </table>';

$Sicumple = $TotalCmp / $numero_programa_c;
$NoCumple = 100 - $Sicumple;

$Result .= '<div style="padding: 10px;margin-top: 20px;border: 1px solid #EFEFEF;">
<label class="text-secondary" style="font-size: .8em">% de cumplimiento por nivel de gobierno</label>
<div class="progress" style="font-size: .9em;height: 20px;">
<div class="progress-bar progress-bar-striped bg-success" role="progressbar" style="width: '.$Sicumple.'%" aria-valuenow="'.$Sicumple.'" aria-valuemin="0" aria-valuemax="100" >Cumple '.round($Sicumple).' %</div>
<div class="progress-bar progress-bar-striped bg-danger" role="progressbar" style="width: '.$NoCumple.'%" aria-valuenow="'.$NoCumple.'" aria-valuemin="0" aria-valuemax="100">No cumple '.round($NoCumple).' %</div>
</div>
</div>';

return $Result;
}

$sql2 = "SELECT * FROM tb_lista_asistencia WHERE id_estacion = '".$Session_IDEstacion."' AND punto_sasisopa = 3 AND fecha BETWEEN '".$FechaInicio."' AND '".$FechaTermino."' ";
$result2 = mysqli_query($con, $sql2);
$numero2 = mysqli_num_rows($result2);

?>
<h4>3. REQUISITOS LEGALES</h4>
<?php
echo '<h5>Municipal</h5>';
echo Detalle('Municipal',$Session_IDEstacion,$FechaInicio,$FechaTermino,$con);
echo '<h5 class="mt-2">Estatal</h5>';
echo Detalle('Estatal',$Session_IDEstacion,$FechaInicio,$FechaTermino,$con);
echo '<h5 class="mt-2">Federal</h5>';
echo Detalle('Federal',$Session_IDEstacion,$FechaInicio,$FechaTermino,$con);
echo '<h5 class="mt-2">Varios</h5>';
echo Detalle('Varios',$Session_IDEstacion,$FechaInicio,$FechaTermino,$con);

echo '<div class="row">';
echo '<div class="col-6">';
echo '<table class="table table-bordered table-striped table-sm mt-3 mb-0 pb-0" style="font-size: .9em;">
<tbody>
<tr>
<td><h6>Calendario anual de renovacion de Requisitos Legales</h6></td>
<td class="text-center align-middle" width="30"><a href="../../public/reporte-sasisopa/descargarrequisitos-legales-pdf.php?FechaInicio='.$_GET['FechaInicio'].'&FechaTermino='.$_GET['FechaTermino'].'"><img src="'.RUTA_IMG_ICONOS.'pdf.png" style="cursor: pointer;"></a></td>
</tr>
</tbody>
</table>';
echo '</div>';
echo '<div class="col-6">

<h6>Fo.ADMONGAS.010 (Registro de la atención y el seguimiento a la comunicación interna y externa.)</h6>
<table class="table table-bordered table-striped table-sm pb-0 mb-0" style="font-size: .9em;">
<thead> 
<tr>
<th class="text-center align-middle">#</th>
<th class="text-center align-middle">Fecha</th>
<th class="text-center align-middle">Hora</th>
<th class="text-center align-middle"></th>
</tr>
</thead>
<tbody>';

$num1 = 1;
if ($numero2 > 0) {
while($row2 = mysqli_fetch_array($result2, MYSQLI_ASSOC)){
$id1 = $row2['id'];
$estado = $row2['estado'];

echo "<tr>
<td class='text-center'>".$num1."</td>
<td class='text-center'>".FormatoFecha($row2['fecha'])."</td>
<td class='text-center'>".date('g:i a', strtotime($row2['hora']))."</td>
<td class='text-center align-middle' width='30'><img src='".RUTA_IMG_ICONOS."pdf.png' style='cursor: pointer;' onclick='DescargarAsistencia(".$id1.")'></td>
</tr>";

$num1 = $num1 + 1;
}
}else{
echo "<td colspan='8' class='text-center text-secondary' style='font-size: .8em;'>No se encontró información para mostrar</td>";

}
 
echo '</tbody></table>';

echo '</div>';
echo '</div>';
?>
<hr>
