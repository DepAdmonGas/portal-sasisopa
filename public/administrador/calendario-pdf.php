<?php
require_once '../../dompdf/autoload.inc.php';
include_once "../../app/help.php";

$idEstacion = $_GET['idEstacion'];

function DetalleRL($idrequisitol,$con){

$sql = "SELECT * FROM rl_requisitos_legales_lista WHERE id = '".$idrequisitol."' LIMIT 1 ";
$result = mysqli_query($con, $sql);
$numero = mysqli_num_rows($result);
$row = mysqli_fetch_array($result, MYSQLI_ASSOC);
$dependencia = $row['dependencia'];
$permiso = $row['permiso']; 
$array = array(
"dependencia" => $dependencia,
"permiso" => $permiso,
);
return $array;
}

function FechaCorta($fechaFormato){
  $formato_fecha = explode("-",$fechaFormato);
  $resultado = $formato_fecha[2].".".nombremes($formato_fecha[1]).".".$formato_fecha[0];
  return $resultado;
}

function UltimaAct($idre,$con){

$sql_matriz = "SELECT * FROM rl_requisitos_legales_matriz WHERE idcalendario = '".$idre."' ORDER BY id desc LIMIT 1";
$result_matriz = mysqli_query($con, $sql_matriz);
$numero_matriz = mysqli_num_rows($result_matriz);
if($numero_matriz > 0){
while($row_matriz = mysqli_fetch_array($result_matriz, MYSQLI_ASSOC)){


if($row_matriz['fecha_emision'] == "0000-00-00"){
$fechaemision = ""; 
}else{
$fechaemision = FechaCorta($row_matriz['fecha_emision']);
}

if($row_matriz['fecha_vencimiento'] == "0000-00-00"){
$fechavencimiento = ""; 
}else{
$fechavencimiento = FechaCorta($row_matriz['fecha_vencimiento']);
}

$acusepdf = $row_matriz['acusepdf'];
$requisitolegalpdf = $row_matriz['requisitolegalpdf'];
}
}else{
$fechaemision = "";
$fechavencimiento = ""; 
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


function NivelGobierno($NGobierno,$IDEstacion,$con){
$contenid0 = "";
$sql_programa_c = "SELECT 
rl_requisitos_legales_calendario.id,
rl_requisitos_legales_calendario.id_estacion,
rl_requisitos_legales_calendario.id_requisito_legal,
rl_requisitos_legales_calendario.nivel_gobierno,
rl_requisitos_legales_calendario.requisito_legal,
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
ON rl_requisitos_legales_calendario.id_requisito_legal = rl_requisitos_legales_lista.id WHERE 
rl_requisitos_legales_calendario.id_estacion = '".$IDEstacion."' AND 
rl_requisitos_legales_calendario.nivel_gobierno = '".$NGobierno."' AND 
rl_requisitos_legales_calendario.estado = 1 ORDER BY rl_requisitos_legales_lista.dependencia ASC ";
$result_programa_c = mysqli_query($con, $sql_programa_c);
$numero_programa_c = mysqli_num_rows($result_programa_c);

$contenid0 .= '<tr>';
$contenid0 .= '<td colspan="6" style="padding: 0px;margin: 0px;"><div class="text-center table-info"><b>Nivel de Gobierno '.$NGobierno.'</b></div></td>';
$contenid0 .= '</tr>';

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

$dependencia = $row_programa_c['dependencia'];
$requisitol = $row_programa_c['permiso'];

$UltimaA = UltimaAct($idre,$con);

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

$vigencia = $row_programa_c['vigencia'];
$fechaemision = $UltimaA['fechaemision'];
$fechavencimiento = $UltimaA['fechavencimiento'];

$Renovacion = $Colenero.$Colfebrero.$Colmarzo.$Colabril.$Colmayo.$Coljunio.$Coljulio.$Colagosto.$Colseptiembre.$Coloctubre.$Colnoviembre.$Coldiciembre;
$Renovacion = trim($Renovacion, ',');

$contenid0 .= '<tr class="text-center" style="font-size: .75em;">';
$contenid0 .= '<td>'.$dependencia.'</td>';
$contenid0 .= '<td><b>'.$requisitol.'</b></td>';
$contenid0 .= '<td>'.$vigencia.'</td>';
$contenid0 .= '<td>'.$fechaemision.'</td>';
$contenid0 .= '<td>'.$fechavencimiento.'</td>';
$contenid0 .= '<td>'.$Renovacion.'</td>';
$contenid0 .= '</tr>';
}

return $contenid0;
}

use Dompdf\Dompdf;
$dompdf = new Dompdf();
    
    $contenid0 = "";
    $contenid0 .= "<!DOCTYPE html>";
    $contenid0 .= "<html>";
    $contenid0 .= "<head>";
    $contenid0 .= "<title>Reporte de Requisitos Legales</title>";
    $contenid0 .= '<style type="text/css">
@page {margin: 0px;}

body {
  font-family: Arial, Helvetica, sans-serif;
}

.text-center {
  text-align: center !important;
}
.p-1 {
  padding: 0.25rem !important;
}
.mt-1 {
  margin-top: 0.25rem !important;
}
.mt-3 {
  margin-top: 1rem !important;
}
.mt-4 {
  margin-top: 1.5rem !important;
}
table {
  border-collapse: collapse;
}
.table {
  width: 100%;
  max-width: 100%;
  margin-bottom: 1rem;
  background-color: transparent;
}

.table th,
.table td {
  padding: 0.75rem;
  vertical-align: top;
  border-top: 1px solid #dee2e6;
}

.table thead th {
  vertical-align: bottom;
  border-bottom: 2px solid #dee2e6;
}

.table tbody + tbody {
  border-top: 2px solid #dee2e6;
}

.table .table {
  background-color: #fff;
}

.table-sm th,
.table-sm td {
  padding: 0.3rem;
}

.table-bordered {
  border: 1px solid #dee2e6;
}

.table-bordered th,
.table-bordered td {
  border: 1px solid #dee2e6;
}

.table-bordered thead th,
.table-bordered thead td {
  border-bottom-width: 2px;
}
.table-bordered {
  border: 1px solid #dee2e6;
}

.table-bordered th,
.table-bordered td {
  border: 1px solid #dee2e6;
}

.table-bordered thead th,
.table-bordered thead td {
  border-bottom-width: 2px;
}
.table-sm th,
.table-sm td {
  padding: 0.3rem;
}
.align-middle {
  vertical-align: middle !important;
}
small {
  font-size: 80%;
}
.table-active,
.table-active > th,
.table-active > td {
  background-color: rgba(0, 0, 0, 0.075);
}

.table thead th {
  vertical-align: bottom;
  border-bottom: 2px solid #dee2e6;
}

.table tbody + tbody {
  border-top: 2px solid #dee2e6;
}

img {
  vertical-align: middle;
  border-style: none;
}

.table-info{
  font-size: .9em;
  background-color: #5e9cf1;
  color: white;
  padding: 7px;
}

.tb-titulo{font-size: .9em;color: #3C3C3C;}
</style>';
$contenid0 .= "</head>";
$contenid0 .= "<body>";

//-----------------------------------------------------------------

$contenid0 .= "<table class='table-bordered table-sm' width='100%'>";

$contenid0 .= "<tr class='table-active'>";
$contenid0 .= "<td class='text-center align-middle tb-titulo'><b>Dependencia</b></td>";
$contenid0 .= "<td class='text-center align-middle tb-titulo'><b>Permiso</b></td>";
$contenid0 .= "<td class='text-center align-middle tb-titulo'><b>Vigencia</b></td>";
$contenid0 .= "<td class='text-center align-middle tb-titulo'><b>Fecha emisión</b></td>";
$contenid0 .= "<td class='text-center align-middle tb-titulo'><b>Fecha vencimiento</b></td>";
$contenid0 .= "<td class='text-center align-middle tb-titulo'><b>Renovación</b></td>";
$contenid0 .= "</tr>";

$contenid0 .= NivelGobierno('Municipal',$idEstacion,$con);
$contenid0 .= NivelGobierno('Estatal',$idEstacion,$con);
$contenid0 .= NivelGobierno('Federal',$idEstacion,$con);
$contenid0 .= NivelGobierno('Varios',$idEstacion,$con);

$contenid0 .= "</table>";

$contenid0 .= "</body>";
$contenid0 .= "</html>";


$dompdf->loadHtml($contenid0);
//$dompdf->setPaper("A4", "landscape");
$dompdf->set_paper(array(0, 0, 800, 1500), 'portrait');
$dompdf->render();
$dompdf->stream('Calendario.pdf');

//------------------
mysqli_close($con);
//------------------
?>


