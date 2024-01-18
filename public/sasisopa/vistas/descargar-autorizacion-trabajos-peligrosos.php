<?php
require_once 'dompdf/autoload.inc.php';
include_once "app/help.php";

function Personal($idpersonal,$con){

$sql = "SELECT * FROM tb_usuarios WHERE id = '".$idpersonal."' ";
$result = mysqli_query($con, $sql);
$numero = mysqli_num_rows($result);
while($row = mysqli_fetch_array($result, MYSQLI_ASSOC)){
$nombre = $row['nombre'];
$puesto = Puesto($row['id_puesto'],$con);
$segurosocial = $row['seguro_social'];
}

$array = array('nombre' => $nombre, 'puesto' => $puesto, 'segurosocial' => $segurosocial);

return $array;
}

function Puesto($idpuesto,$con){
$sql = "SELECT tipo_puesto FROM tb_puestos WHERE id = '".$idpuesto."' ";
$result = mysqli_query($con, $sql);
$numero = mysqli_num_rows($result);
while($row = mysqli_fetch_array($result, MYSQLI_ASSOC)){
$tipoPuesto = $row['tipo_puesto'];
}

return $tipoPuesto;
}

use Dompdf\Dompdf;
$dompdf = new Dompdf();

    $contenid0 .= "<!DOCTYPE html>";
    $contenid0 .= "<html>";
    $contenid0 .= "<head>";
    $contenid0 .= "<title>Autorizacion para realizar trabajos peligrosos</title>";
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

body {
  margin: 0;
  font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, "Helvetica Neue", Arial, sans-serif, "Apple Color Emoji", "Segoe UI Emoji", "Segoe UI Symbol";
  font-size: 1rem;
  font-weight: 400;
  line-height: 1.5;
  color: #212529;
  background-color: #fff;
  font-size: .9em;
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

.mb-2,
.my-2 {
  margin-bottom: 0.5rem !important;
}

table {
  border-collapse: collapse;
}
.table {
  width: 100%;
  max-width: 100%;
  margin-bottom: 10px;
  background-color: transparent;
}

.table th,
.table td {
  padding: 0.30rem;
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
  padding: 0.2rem;
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
  padding: 0.2rem;
}
.align-middle {
  vertical-align: middle !important;
}

.border {
  border: 1px solid #dee2e6 !important;
}

.mt-3,
.my-3 {
  margin-top: 1rem !important;
}

.p-3 {
  padding: 1rem !important;
}
.p-2 {
  padding: 0.5rem !important;
}

.mb-3,
.my-3 {
  margin-bottom: 1rem !important;
}

.badge {
  display: inline-block;
  padding: 0.25em 0.4em;
  font-size: 75%;
  font-weight: 700;
  line-height: 1;
  text-align: center;
  white-space: nowrap;
  vertical-align: baseline;
  border-radius: 0.25rem;
}

.bg-primary {
  background-color: #007bff !important;
}

.text-right {
  text-align: right !important;
}

.mt-2,
.my-2 {
  margin-top: 0.5rem !important;
}
</style>';

$contenid0 .= '</head>';
$contenid0 .= '<body';



    $RutaLogo = SERVIDOR."imgs/logo/Logo.png";
    $DataLogo = file_get_contents($RutaLogo);
    $baseLogo = 'data:image/;base64,' . base64_encode($DataLogo);


    $RutaX = RUTA_IMG_ICONOS."img-no.png";
    $DataX = file_get_contents($RutaX);
    $baseX = 'data:image/;base64,' . base64_encode($DataX);

$contenid0 .= '<div>';

$contenid0 .= '<table class="table table-bordered">';
$contenid0 .= '<tbody>';
$contenid0 .= '<tr>';

$contenid0 .= '<td class="align-middle text-center">';
$contenid0 .= '<img src="'.$baseLogo.'" style="width: 150px;">';
$contenid0 .= '</td>';
$contenid0 .= '<td colspan="2" class="align-middle text-center">';
$contenid0 .= '<b> Autorizacion para realizar trabajos peligrosos</b>';
$contenid0 .= '</td>';
$contenid0 .= '<td class="align-middle text-center">';
$contenid0 .= '<b>Fo.ADMONGAS.0012</b>';
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
$contenid0 .= 'Fecha de autorizacion 01/10/2018';
$contenid0 .= '</td>';
$contenid0 .= '</tr>';            
$contenid0 .= '</tbody>';
$contenid0 .= '</table>';

//---------------------------------------------------------------

$sqlCR = "SELECT * FROM tb_requisicion_obra_formato_12 WHERE id = '".$GET_ID."' ";
$resultCR = mysqli_query($con, $sqlCR);
while($rowCR = mysqli_fetch_array($resultCR, MYSQLI_ASSOC)){
$idFormato = $rowCR['id'];
$dia = $rowCR['dia'];
$mes = $rowCR['mes'];
$year = $rowCR['year'];
$municipio = $rowCR['municipio'];
$estado = $rowCR['estado'];

$trabajorealizar = $rowCR['trabajo_realizar'];
$descripcion = $rowCR['descripcion'];
$area = $rowCR['area'];

$fechainicio = $rowCR['fecha_inicio'];
$fechatermino = $rowCR['fecha_termino'];
$horainicio = $rowCR['hora_inicio'];
$horatermino = $rowCR['hora_termino'];
$prestadorservicio = $rowCR['prestador_servicio'];

if($rowCR['cprtp'] == 1){
$cprtp1 = 'SI';
}else if($rowCR['cprtp'] == 0){
$cprtp1 = 'NO';
}

if($rowCR['cteppc'] == 1){
$cteppc2 = 'SI';
}else if($rowCR['cteppc'] == 0){
$cteppc2 = 'NO';
}

$mombreEmpresa = $rowCR['nombre_empresa'];
$nombreResponsable = $rowCR['nombre_responsable'];

}

$contenid0 .= '<div class="text-right">'.$municipio.', '.$estado.' a '.$dia.' de '.$mes.' de '.$year.'</div>';
$contenid0 .= '<div style="margin-top: 10px;"><b>A quien corresponda</b></div>';
$contenid0 .= '<div style="margin-top: 5px;">
<b>Trabajo a realizar:</b>
<div class="mt-2 border p-2">'.$trabajorealizar.'</div>
</div>';

$contenid0 .= '<div style="margin-top: 5px;">
<b>Descripcion:</b>
<div class="mt-2 border p-2">'.$descripcion.'</div>
</div>';

$contenid0 .= '<div style="margin-top: 5px;">
<b>Área:</b>
<div class="mt-2 border p-2">'.$area.'</div>
</div>';

$contenid0 .= '<table class="mt-3" style="width: 100%;">
<tbody>
<tr>
<td><b>Fecha de inicio:</b></td><td>'.FormatoFecha($fechainicio).'</td>
<td><b>Fecha de término:</b></td><td>'.FormatoFecha($fechatermino).'</td></tr>
<tr>
<td><b>Hora de Inicio:</b></td><td>'.date("g:i a",strtotime($horainicio)).'</td>
<td><b>Hora de Termino:</b></td><td>'.date("g:i a",strtotime($horatermino)).'</td></tr>
</tbody>
</table>';

$contenid0 .= '<div style="margin-top: 10px;">
<b>El trabajo a realizar contempla alguno de los siguientes procedimientos:</b>
</div>';
 
$contenid0 .= '<table class="table table-bordered table-sm mt-2">
<tbody>';

$sqlR = "SELECT * FROM tb_requisicion_obra_formato_12_procedimiento WHERE id_requisicion = '".$idFormato."'";
$resultR = mysqli_query($con, $sqlR);
$numeroR = mysqli_num_rows($resultR);
while($rowR = mysqli_fetch_array($resultR, MYSQLI_ASSOC)){
$idProcedimientos = $rowR['id'];

if($rowR['valor'] == 1){
$Check = '<img src="'.$baseX.'" />';
}else{
$Check = '';  
}
$contenid0 .= '<tr>
<td>'.$rowR['detalle'].'</td>
<td class="text-center">'.$Check.'</td>
</tr>';
}

$contenid0 .= '</tbody>
</table>';

$contenid0 .= '<div style="margin-top: 5px;">
<b>Nombre del prestador de servicios:</b>
<div class="mt-2 border p-2">'.$prestadorservicio.'</div>
</div>';

$contenid0 .= '<table class="mt-3" style="width: 100%;">
<tbody>
<tr>
<td>Cuenta con capacitación para realizar trabajos peligrosos:</td>
<td>'.$cprtp1.'</td>
</tr>
<tr>
<td>Cuenta con todo el Equipo de Protección Personal correspondiente (EPP)</td>
<td>'.$cteppc2.'</td>
</tr>
</tbody>
</table>';

$contenid0 .= '<div class="text-center"><small>*De no contar con capacitación, bajo ninguna circunstancia realizara los trabajos</small></div>';


$sqlDTAS = "SELECT * FROM tb_requisicion_obra_formato_12_trabajador_encargado WHERE id_requisicion = '".$idFormato."' AND categoria = 1 ";
$resultDTAS = mysqli_query($con, $sqlDTAS);
$numeroDTAS = mysqli_num_rows($resultDTAS);

if ($numeroDTAS > 0) {

$contenid0 .= '<div><b>Datos de los trabajadores que acuden al servicio:</b></div>';

$contenid0 .= '<table class="table table-bordered table-sm mt-2">
<thead>
  <tr>
    <th>Nombre</th>
    <th>Puesto</th>
    <th>No. De Seguro</th>
  </tr>
</thead>
<tbody>';

while($rowDTAS = mysqli_fetch_array($resultDTAS, MYSQLI_ASSOC)){
$Personal = Personal($rowDTAS['id_personal'],$con);
$contenid0 .= '<tr>
<td>'.$Personal['nombre'].'</td>
<td>'.$Personal['puesto'].'</td>
<td>'.$Personal['segurosocial'].'</td>
</tr>';
}
$contenid0 .= '
</tbody>
</table>';

}


$sqlEESS = "SELECT * FROM tb_requisicion_obra_formato_12_trabajador_encargado WHERE id_requisicion = '".$idFormato."' AND categoria = 2 ";
$resultEESS = mysqli_query($con, $sqlEESS);
$numeroEESS = mysqli_num_rows($resultEESS);

if ($numeroEESS > 0) {

$contenid0 .= '<div><b>Encargado de la estación de servicio de darle seguimiento al servicio:</b></div>';

$contenid0 .= '<table class="table table-bordered table-sm mt-2">
<thead>
  <tr>
    <th>Nombre</th>
    <th>Puesto</th>
    <th>No. De Seguro</th>
  </tr>
</thead>
<tbody>';

while($rowEESS = mysqli_fetch_array($resultEESS, MYSQLI_ASSOC)){
$PersonalES = Personal($rowEESS['id_personal'],$con);
$contenid0 .= '<tr>
<td>'.$PersonalES['nombre'].'</td>
<td>'.$PersonalES['puesto'].'</td>
<td>'.$PersonalES['segurosocial'].'</td>
</tr>';
}
$contenid0 .= '</tbody>
</table>';

}

if($mombreEmpresa != ""){
$contenid0 .= '<div style="margin-top: 5px;">
<b>Nombre empresa:</b>
<div class="mt-2 border p-2">'.$mombreEmpresa.'</div>
</div>';
}

if($nombreResponsable != ""){
$contenid0 .= '<div style="margin-top: 5px;">
<b>Nombre del responsable:</b>
<div class="mt-2 border p-2">'.$nombreResponsable.'</div>
</div>';

$contenid0 .= '<div class="mt-2 text-center"><small>Nota: Si el personal es externo deberá presentar su procedimiento para realizar la actividad</small></div>';

}

$contenid0 .= '</div>';
$contenid0 .= '</body>';
$contenid0 .= '</html>';


$dompdf->loadHtml($contenid0);
// Colocamos als propiedades de la hoja
$dompdf->setPaper("A4", "portrait");
// Escribimos el html en el PDF
$dompdf->render();
// Ponemos el PDF en el browser
$dompdf->stream('Autorizacion para realizar trabajos peligrosos.pdf',["Attachment" => true]);
//------------------
mysqli_close($con);
//------------------