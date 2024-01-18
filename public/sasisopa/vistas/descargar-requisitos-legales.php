<?php
require_once 'dompdf/autoload.inc.php';
include_once "app/help.php";

if ($NGobierno == "municipal") {
    $title = "Municipal";
    }else if ($NGobierno == "estatal") {
    $title = "Estatal";
    }else if ($NGobierno == "federal") {
    $title = "Federal";
    }else if ($NGobierno == "varios") {
    $title = "Varios";
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

function UltimaAct($idre,$con){

$sql_matriz = "SELECT * FROM rl_requisitos_legales_matriz WHERE idcalendario = '".$idre."' ORDER BY id desc LIMIT 1";
$result_matriz = mysqli_query($con, $sql_matriz);
$numero_matriz = mysqli_num_rows($result_matriz);
if($numero_matriz > 0){
while($row_matriz = mysqli_fetch_array($result_matriz, MYSQLI_ASSOC)){


if($row_matriz['fecha_emision'] == "0000-00-00"){
$fechaemision = "S/I"; 
}else{
$fechaemision = FormatoFecha($row_matriz['fecha_emision']);
}

if($row_matriz['fecha_vencimiento'] == "0000-00-00"){
$fechavencimiento = "S/I"; 
}else{
$fechavencimiento = FormatoFecha($row_matriz['fecha_vencimiento']);
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


function NivelGobierno($NGobierno,$IDEstacion,$con){

$sql_programa_c = "SELECT * FROM rl_requisitos_legales_calendario WHERE id_estacion = '".$IDEstacion."' AND nivel_gobierno = '".$NGobierno."' AND estado = 1";
$result_programa_c = mysqli_query($con, $sql_programa_c);
$numero_programa_c = mysqli_num_rows($result_programa_c);

$contenid0 .= '<tr>';
$contenid0 .= '<td class="text-center table-info" colspan="6"><b>Nivel de Gobierno '.$NGobierno.'</b></td>';
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

if($row_programa_c['id_requisito_legal'] == 0){
$dependencia = 'S/I';
$requisitol = $row_programa_c['requisito_legal'];
}else{
$DetalleRL = DetalleRL($idrequisitol,$con);
$dependencia = $DetalleRL['dependencia'];
$requisitol = $DetalleRL['permiso'];
}

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

$Renovacion = $Colenero.$Colfebrero.$Colmarzo.$Colabril.$Colmayo.$Coljunio.$Coljulio.$Colagosto.$Colseptiembre.$Coloctubre.$Colnoviembre.$Coldiciembre;
$Renovacion = trim($Renovacion, ',');

$contenid0 .= '<tr>';
$contenid0 .= '<td>'.$dependencia.'</td>';
$contenid0 .= '<td><b>'.$requisitol.'</b></td>';
$contenid0 .= '<td>'.$row_programa_c['vigencia'].'</td>';
$contenid0 .= '<td>'.$UltimaA['fechaemision'].'</td>';
$contenid0 .= '<td>'.$UltimaA['fechavencimiento'].'</td>';
$contenid0 .= '<td>'.$Renovacion.'</td>';
$contenid0 .= '</tr>';
}

return $contenid0;
}

use Dompdf\Dompdf;
$dompdf = new Dompdf();

    $contenid0 .= "<!DOCTYPE html>";
    $contenid0 .= "<html>";
    $contenid0 .= "<head>";
    $contenid0 .= "<title>Reporte de Requisitos Legales</title>";
    $contenid0 .= '<style type="text/css">
@page {margin: 0.5cm 1cm; font-family: Arial, Helvetica, sans-serif;}
*,
*::before,
*::after {
  box-sizing: border-box;
}

html {
  font-family: sans-serif;
  line-height: 1.15;
  -webkit-text-size-adjust: 100%;
  -ms-text-size-adjust: 100%;
  -ms-overflow-style: scrollbar;
  -webkit-tap-highlight-color: transparent;
}

@-ms-viewport {
  width: device-width;
}

article, aside, dialog, figcaption, figure, footer, header, hgroup, main, nav, section {
  display: block;
}
body {
  margin: 0;
  font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, "Helvetica Neue", Arial, sans-serif, "Apple Color Emoji", "Segoe UI Emoji", "Segoe UI Symbol";
  font-size: 1rem;
  font-weight: 400;
  line-height: 1.5;
  color: #212529;
  text-align: left;
  background-color: #fff;
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

.table-success,
.table-success > th,
.table-success > td {
  background-color: #c3e6cb;
}

.table-info,
.table-info > th,
.table-info > td {
  background-color: #bee5eb;
}
</style>';
$contenid0 .= "</head>";
$contenid0 .= "<body>";

$RutaLogo = SERVIDOR."imgs/logo/Logo.png";
$DataLogo = file_get_contents($RutaLogo);
$baseLogo = 'data:image/png;base64,' . base64_encode($DataLogo);

$contenid0 .= '<table class="table table-bordered" style="font-size: .8em;">';
$contenid0 .= '<tbody>';
$contenid0 .= '<tr>';

$contenid0 .= '<td class="align-middle text-center">';
$contenid0 .= '<img src="'.$baseLogo.'" style="width: 150px;">';
$contenid0 .= '</td>';
$contenid0 .= '<td colspan="2" class="align-middle text-center">';
$contenid0 .= '<b>Calendario anual de renovacion de Requisitos Legales</b>';
$contenid0 .= '</td>';
$contenid0 .= '<td class="align-middle text-center">';
$contenid0 .= '<b>Fo.ADMONGAS.004</b>';
$contenid0 .= '</td>';

$contenid0 .= '</tr>';
//------------------------------------------------------------------
$contenid0 .= '<tr>';
$contenid0 .= '<td class="align-middle text-center">';
$contenid0 .= 'Realizado por:<br> Nelly Estrada Garcia';
$contenid0 .= '</td>';
$contenid0 .= '<td class="align-middle text-center">';
$contenid0 .= 'Revisado por:<br> Eduardo Galicia Flores';
$contenid0 .= '</td>';
$contenid0 .= '<td class="align-middle text-center">';
$contenid0 .= 'Autorizado por:<br> '.$Session_ApoderadoLegal.'';
$contenid0 .= '</td>';
$contenid0 .= '<td class="align-middle text-center">';
$contenid0 .= 'Fecha de aprobacion:<br>  01-Oct-2018';
$contenid0 .= '</td>';
$contenid0 .= '</tr>';
            

$contenid0 .= '</tbody>';
$contenid0 .= '</table>';
//-----------------------------------------------------------------

$contenid0 .= "<table class='table-bordered table-sm mt-4' style='font-size: .7em;' width='100%'>";

$contenid0 .= "<tr class='table-active'>";
$contenid0 .= "<td class='text-center align-middle'><b>Dependencia</b></td>";
$contenid0 .= "<td class='text-center align-middle'><b>Permiso</b></td>";
$contenid0 .= "<td class='text-center align-middle'><b>Vigencia</b></td>";
$contenid0 .= "<td class='text-center align-middle'><b>Fecha emisión</b></td>";
$contenid0 .= "<td class='text-center align-middle'><b>Fecha vencimiento</b></td>";
$contenid0 .= "<td class='text-center align-middle'><b>Renovación</b></td>";
$contenid0 .= "</tr>";

$contenid0 .= NivelGobierno('Municipal',$Session_IDEstacion,$con);
$contenid0 .= NivelGobierno('Estatal',$Session_IDEstacion,$con);
$contenid0 .= NivelGobierno('Federal',$Session_IDEstacion,$con);
$contenid0 .= NivelGobierno('Varios',$Session_IDEstacion,$con);

$contenid0 .= "</table>";

$contenid0 .= "</body>";
$contenid0 .= "</html>";


$dompdf->loadHtml($contenid0);
$dompdf->setPaper("A4", "landscape");
$dompdf->render();
$dompdf->get_canvas()->page_text(750, 570, "Pagina: {PAGE_NUM} de {PAGE_COUNT}", $font, 8, array(0,0,0));
$dompdf->stream('RequisitosLegales.pdf');

//------------------
mysqli_close($con);
//------------------
?>


