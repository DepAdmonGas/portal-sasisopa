<?php
require_once 'dompdf/autoload.inc.php';
include_once "app/help.php";

use Dompdf\Dompdf;
$dompdf = new Dompdf();


    $contenid0 .= "<!DOCTYPE html>";
    $contenid0 .= "<html>";
    $contenid0 .= "<head>";
    $contenid0 .= "<title>Equipos sometidos a calibración</title>";
    $contenid0 .= '<style type="text/css">
@page {margin: 0.5cm 1cm; font-family: Arial, Helvetica, sans-serif;}
*,
*::before,
*::after {
  box-sizing: border-box;
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

.mb-3,
.my-3 {
  margin-bottom: 1rem !important;
}
h5, .h5 {
  font-size: 1.25rem;
}
.text-center {
  text-align: center !important;
}
.bg-light {
  background-color: #f8f9fa !important;
}
</style>';

$contenid0 .= '</head>';
$contenid0 .= '<body';

$contenid0 .= '<div>';
//-----------------------------------------------------------------
function TanquesAlmacenamiento($IDEstacion,$con){
$sql = "SELECT * FROM tb_tanque_almacenamiento WHERE id_estacion = '".$IDEstacion."' ";
$result = mysqli_query($con, $sql);
$numero = mysqli_num_rows($result);
if ($numero > 0) {
while($row = mysqli_fetch_array($result, MYSQLI_ASSOC)){
$Contenido .= "<tr>";
$Contenido .= "<td class='text-center align-middle'>".$row['no_tanque']."</td>";
$Contenido .= "<td class='text-center align-middle'>".$row['capacidad'].", ".$row['producto']."</td>";
$Contenido .= "<td class='text-center align-middle'>Tanques</td>";
$Contenido .= "<td class='text-center align-middle'>10 años</td>";
$Contenido .= "</tr>";
}
}
return $Contenido;
}

function SondasMedicion($IDEstacion,$con){
$sql = "SELECT * FROM tb_sondas_medicion WHERE id_estacion = '".$IDEstacion."' ";
$result = mysqli_query($con, $sql);
$numero = mysqli_num_rows($result);
if ($numero > 0) {
while($row = mysqli_fetch_array($result, MYSQLI_ASSOC)){
$Contenido .= "<tr>";
$Contenido .= "<td class='text-center align-middle'>".$row['no_sonda']."</td>";
$Contenido .= "<td class='text-center align-middle'>".$row['marca'].", ".$row['modelo']."</td>";
$Contenido .= "<td class='text-center align-middle'>Sondas de medición</td>";
$Contenido .= "<td class='text-center align-middle'>2 años</td>";
$Contenido .= "</tr>";
}
}
return $Contenido;
}

function Dispensario($IDEstacion,$con){
$sql = "SELECT * FROM tb_dispensarios WHERE id_estacion = '".$IDEstacion."' ";
$result = mysqli_query($con, $sql);
$numero = mysqli_num_rows($result);
if ($numero > 0) {
while($row = mysqli_fetch_array($result, MYSQLI_ASSOC)){
$Contenido .= "<tr>";
$Contenido .= "<td class='text-center align-middle'>".$row['no_dispensario']."</td>";
$Contenido .= "<td class='text-center align-middle'>".$row['marca'].", ".$row['modelo']."</td>";
$Contenido .= "<td class='text-center align-middle'>Dispensario</td>";
$Contenido .= "<td class='text-center align-middle'>Semestral</td>";
$Contenido .= "</tr>";
}
}
return $Contenido;
}

function JarraPatron($IDEstacion,$con){

$i = 1;
$sql = "SELECT * FROM tb_jarra_patron WHERE id_estacion = '".$IDEstacion."' ";
$result = mysqli_query($con, $sql);
$numero = mysqli_num_rows($result);
if ($numero > 0) {
while($row = mysqli_fetch_array($result, MYSQLI_ASSOC)){
$Contenido .= "<tr>";
$Contenido .= "<td class='text-center align-middle'>".$i."</td>";
$Contenido .= "<td class='text-center align-middle'>".$row['marca'].", ".$row['no_serie']."</td>";
$Contenido .= "<td class='text-center align-middle'>Jarra patron</td>";
$Contenido .= "<td class='text-center align-middle'>Anual</td>";
$Contenido .= "</tr>";

$i++;
}
}
return $Contenido;
}

    $RutaLogo = SERVIDOR."imgs/logo/Logo.png";
    $DataLogo = file_get_contents($RutaLogo);
    $baseLogo = 'data:image/;base64,' . base64_encode($DataLogo);

$contenid0 .= '<table class="table table-bordered table-sm mt-2 mb-1" style="font-size: .9em;">
      <tr>
      <td class="text-center align-middle"><img class="text-center" src="'.$baseLogo.'" style="width: 150px;"></td>
      <td colspan="2" class="text-center align-middle"><b>Equipos sometidos a calibración</b></td>
      <td class="text-center align-middle">Fo.ADMONGAS.019</td>
      </tr>
      <tr>
      <td class="text-center align-middle">Realizado por: Nelly Estrada Garcia </td>
      <td class="text-center align-middle">Revisado por: Eduardo Galicia Flores </td>
      <td class="text-center align-middle">Autorizado por: '.$Session_ApoderadoLegal.' </td>
      <td class="text-center align-middle">Fecha de autorizacion 01/10/2018</td>
      </tr>
      </table>';

$contenid0 .= '<table class="table table-bordered table-sm" style="font-size: .9em;">';
$contenid0 .= '<thead>';
$contenid0 .= '<tr>';
$contenid0 .= '<th class="text-center align-middle">Número de identificación</th>';
$contenid0 .= '<th class="text-center align-middle">Nombre del equipo (marca y modelo)</th>';
$contenid0 .= '<th class="text-center align-middle">Descripcion del equipo</th>';
$contenid0 .= '<th class="text-center align-middle">Frecuencia de la calibración</th>';
$contenid0 .= '</tr>';
$contenid0 .= '</thead>';
$contenid0 .= '<tbody>';
$contenid0 .= TanquesAlmacenamiento($Session_IDEstacion,$con);
$contenid0 .= SondasMedicion($Session_IDEstacion,$con);
$contenid0 .= Dispensario($Session_IDEstacion,$con);
$contenid0 .= JarraPatron($Session_IDEstacion,$con);
$contenid0 .= '</tbody>';
$contenid0 .= '</table>';
//-----------------------------------------------------------------

$contenid0 .= '</div>';
$contenid0 .= '</body>';
$contenid0 .= '</html>';

$dompdf->loadHtml($contenid0);
// Colocamos als propiedades de la hoja
$dompdf->setPaper("A4", "portrait");
// Escribimos el html en el PDF
$dompdf->render();
$canvas = $dompdf->get_canvas();
$canvas->page_text(525, 810, "Página: {PAGE_NUM} de {PAGE_COUNT}", null, 7, array(0, 0, 0));
// Ponemos el PDF en el browser
$dompdf->stream('Equipos sometidos a calibración.pdf',["Attachment" => true]);

//------------------
mysqli_close($con);
//------------------