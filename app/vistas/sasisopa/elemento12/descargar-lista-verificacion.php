<?php
require_once 'dompdf/autoload.inc.php';
include_once "app/help.php";

$RutaX = "http://portal.admongas.com.mx/portal-sasisopa/imgs/iconos/img-no.png";
    $DataX = file_get_contents($RutaX);
    $baseX = 'data:image/;base64,' . base64_encode($DataX);

$sql = "SELECT * FROM tb_requisicion_obra_formato_15 WHERE id = '".$GET_ID."' ";
$result = mysqli_query($con, $sql);
$numero = mysqli_num_rows($result);
if ($numero > 0) {
$row = mysqli_fetch_array($result, MYSQLI_ASSOC);

$Fecha = $row['fecha_lv'];
$Hora = $row['hora_lv'];
$NomUsuario = NomUsuario($row['id_usuario'],$con);
$idUsuario = $NomUsuario['id'];
$Nombre = $NomUsuario['nombre'];
$Firma = $NomUsuario['firma'];

if($row['pregunta1'] == 1){
$R1 = '<img src="'.$baseX.'">';
}else{
$R1 = '';  
}

if($row['pregunta1'] == 0){
$R2 = '<img src="'.$baseX.'">';
}else{
$R2 = '';  
}

if($row['pregunta2'] == 1){
$R3 = '<img src="'.$baseX.'">';
}else{
$R3 = '';  
}

if($row['pregunta2'] == 0){
$R4 = '<img src="'.$baseX.'">';
}else{
$R4 = '';  
}

if($row['pregunta3'] == 1){
$R5 = '<img src="'.$baseX.'">';
}else{
$R5 = '';  
}

if($row['pregunta3'] == 0){
$R6 = '<img src="'.$baseX.'">';
}else{
$R6 = '';  
}

if($row['pregunta4'] == 1){
$R7 = '<img src="'.$baseX.'">';
}else{
$R7 = '';  
}

if($row['pregunta4'] == 0){
$R8 = '<img src="'.$baseX.'">';
}else{
$R8 = '';  
}

if($row['pregunta5'] == 1){
$R9 = '<img src="'.$baseX.'">';
}else{
$R9 = '';  
}

if($row['pregunta5'] == 0){
$R10 = '<img src="'.$baseX.'">';
}else{
$R10 = '';  
}

}

function NomUsuario($id, $con){

$sql_lista = "SELECT * FROM tb_usuarios WHERE id = '".$id."' ";
$result_lista = mysqli_query($con, $sql_lista);
$numero_lista = mysqli_num_rows($result_lista);
while($row_lista = mysqli_fetch_array($result_lista, MYSQLI_ASSOC)){
$id = $row_lista['id'];
$nombre = $row_lista['nombre'];
$firma = $row_lista['firma']; 
}
$arrayName = array('id' => $id, 'nombre'=> $nombre, 'firma'=> $firma);
return $arrayName;
}

use Dompdf\Dompdf;
$dompdf = new Dompdf();

    $contenid0 = "";
    $contenid0 .= "<!DOCTYPE html>";
    $contenid0 .= "<html>";
    $contenid0 .= "<head>";
    $contenid0 .= "<title>Listas de verificación</title>";
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

.mt-2,
.my-2 {
  margin-top: 0.5rem !important;
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

.p-3 {
  padding: 1rem !important;
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
.text-left {
  text-align: left !important;
}

.text-right {
  text-align: right !important;
}
</style>';

$contenid0 .= '</head>';
$contenid0 .= '<body';



    $RutaLogo = SERVIDOR."imgs/logo/Logo.png";
    $DataLogo = file_get_contents($RutaLogo);
    $baseLogo = 'data:image/;base64,' . base64_encode($DataLogo);


$contenid0 .= '<div>';

$contenid0 .= '<table class="table table-bordered">';
$contenid0 .= '<tbody>';
$contenid0 .= '<tr>';

$contenid0 .= '<td class="align-middle text-center">';
$contenid0 .= '<img src="'.$baseLogo.'" style="width: 150px;">';
$contenid0 .= '</td>';
$contenid0 .= '<td colspan="2" class="align-middle text-center">';
$contenid0 .= '<b>Listas de verificación</b>';
$contenid0 .= '</td>';
$contenid0 .= '<td class="align-middle text-center">';
$contenid0 .= '<b>Fo.ADMONGAS.015</b>';
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
$contenid0 .= 'Fecha de aprobación 01-oct-18';
$contenid0 .= '</td>';
$contenid0 .= '</tr>';            
$contenid0 .= '</tbody>';
$contenid0 .= '</table>';

$contenid0 .= '<table style="width: 100%;"><tr><td><b>Fecha:</b> '.FormatoFecha($Fecha).'</td><td><b>Hora:</b> '.date("g:i a",strtotime($Hora)).'</td></tr></table>';


$contenid0 .= '<table class="table table-bordered mt-3">';
$contenid0 .= '<tbody>';

$contenid0 .= '<tr>';
$contenid0 .= '<td></td>';
$contenid0 .= '<td class="align-middle text-center"><b>SI</b></td>';
$contenid0 .= '<td class="align-middle text-center"><b>NO</b></td>';
$contenid0 .= '</tr>';

$contenid0 .= '<tr>';
$contenid0 .= '<td>1. El trabajo fue completado conforme a lo solicitado</td>';
$contenid0 .= '<td class="align-middle text-center">'.$R1.'</td>';
$contenid0 .= '<td class="align-middle text-center">'.$R2.'</td>';
$contenid0 .= '</tr>';

$contenid0 .= '<tr>';
$contenid0 .= '<td>2. El trabajo se realizo conforme al procedimiento</td>';
$contenid0 .= '<td class="align-middle text-center">'.$R3.'</td>';
$contenid0 .= '<td class="align-middle text-center">'.$R4.'</td>';
$contenid0 .= '</tr>';

$contenid0 .= '<tr>';
$contenid0 .= '<td>3. En todo momento se utilizo el EPP</td>';
$contenid0 .= '<td class="align-middle text-center">'.$R5.'</td>';
$contenid0 .= '<td class="align-middle text-center">'.$R6.'</td>';
$contenid0 .= '</tr>';

$contenid0 .= '<tr>';
$contenid0 .= '<td>4. Los trabajadores tomaron en cuenta los procedimiento de seguridad</td>';
$contenid0 .= '<td class="align-middle text-center">'.$R7.'</td>';
$contenid0 .= '<td class="align-middle text-center">'.$R8.'</td>';
$contenid0 .= '</tr>';

$contenid0 .= '<tr>';
$contenid0 .= '<td>5. Ocurrió algún accidente durante el servicio realizado</td>';
$contenid0 .= '<td class="align-middle text-center">'.$R9.'</td>';
$contenid0 .= '<td class="align-middle text-center">'.$R10.'</td>';
$contenid0 .= '</tr>';  
$contenid0 .= '</tbody>';
$contenid0 .= '</table>';


    $RutaFirma = RUTA_IMG_FIRMA_PERSONAL.$Firma;
    $DataFirma = file_get_contents($RutaFirma);
    $baseFirma = 'data:image/;base64,' . base64_encode($DataFirma);


$contenid0 .= '<div class="text-center" style="margin-top: 100px;"><img width="140px" src="'.$baseFirma.'"></div>
<div class="text-center">'.$Nombre.'</div>
<div style="margin-left: 235px;"><div style="border-top: 1px solid #E0E0E0;width: 250px;"></div></div>
<div class="text-center">Nombre y firma (SUPERVISO)</div>';    


$contenid0 .= '</div>';

$contenid0 .= '</body>';
$contenid0 .= '</html>';


$dompdf->loadHtml($contenid0);
// Colocamos als propiedades de la hoja
$dompdf->setPaper("A4", "portrait");
// Escribimos el html en el PDF
$dompdf->render();
// Ponemos el PDF en el browser
$dompdf->stream('Listas de verificación.pdf');
//------------------
mysqli_close($con);
//------------------