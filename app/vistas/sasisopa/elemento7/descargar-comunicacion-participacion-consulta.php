<?php
require_once 'dompdf/autoload.inc.php';
include_once "app/help.php";


function Nombre($id, $con){
  $sql = "SELECT * FROM tb_usuarios WHERE id = '".$id."' ";
  $result = mysqli_query($con, $sql);
  $numero = mysqli_num_rows($result);
  while($row = mysqli_fetch_array($result, MYSQLI_ASSOC)){
  $nombre = $row['nombre'];
  } 
  return $nombre;
  }

use Dompdf\Dompdf;
$dompdf = new Dompdf();

    $contenid0 = "";
    $contenid0 .= "<!DOCTYPE html>";
    $contenid0 .= "<html>";
    $contenid0 .= "<head>";
    $contenid0 .= "<title>Comunicación, participación y consulta</title>";
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
.p-2 {
  padding: 0.5rem !important;
}
.mt-3 {
  margin-top: 2.5rem !important;
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
$contenid0 .= '<b>Registro de la atención y el seguimiento a la comunicación interna y externa.</b>';
$contenid0 .= '</td>';
$contenid0 .= '<td class="align-middle text-center">';
$contenid0 .= '<b>Fo.ADMONGAS.010</b>';
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

$contenid0 .= '<table class="table table-bordered" style="font-size: .80em;">';
$contenid0 .= '<tbody>';

$contenid0 .= '
<tr>
<th class="align-middle text-center">No.</th>
<th class="align-middle text-center">Fecha</th>
<th class="align-middle text-center">Tema a comunicar</th>
<th class="align-middle text-center">Encargado de la comunicación</th>
<th class="align-middle text-center">Tipo de comunicación</th>
<th class="align-middle text-center">Material utilizado para la comunicación</th>
<th class="align-middle text-center">Seguimiento de la comunicación</th>
</tr>';

if($GET_idYear == 'X' && $GET_idEstacion == 'X'){
$Query = " se_comunicacion_i_e.id = '".$GET_idRegistro."' ";
}else if($GET_idYear == 'X' && $GET_idRegistro == 'X'){
$Query = " se_comunicacion_i_e.id_estacion = '".$GET_idEstacion."' ORDER BY se_comunicacion_i_e.no_comunicacion desc ";
}else if($GET_idYear != 'X' && $GET_idEstacion != 'X'){
$Query = " se_comunicacion_i_e.id_estacion = '".$GET_idEstacion."' AND YEAR(se_comunicacion_i_e.fecha) = '".$GET_idYear."' ORDER BY se_comunicacion_i_e.no_comunicacion desc "; 
}else if($GET_idYear != 'X' && $GET_idRegistro != 'X'){
$Query = "se_comunicacion_i_e.id = '".$GET_idRegistro."' ";
}

$sql_comunicado = "SELECT 
se_comunicacion_i_e.id,
se_comunicacion_i_e.no_comunicacion,
se_comunicacion_i_e.fecha,
se_comunicacion_i_e.tema,
se_comunicacion_i_e.tipo_comunicacion,
se_comunicacion_i_e.material,
se_comunicacion_i_e.seguimiento,
se_comunicacion_i_e.asistencia,
tb_usuarios.nombre
FROM se_comunicacion_i_e 
INNER JOIN tb_usuarios 
ON se_comunicacion_i_e.encargado_comunicacion = tb_usuarios.id WHERE $Query";
$result_comunicado = mysqli_query($con, $sql_comunicado);
$numero_comunicado = mysqli_num_rows($result_comunicado);
while($row_comunicado = mysqli_fetch_array($result_comunicado, MYSQLI_ASSOC)){

$nomencargado = $row_comunicado['nombre'];

$contenid0 .= '<tr>
<td class="text-center align-middle">'.$row_comunicado['no_comunicacion'].'</td>
<td class="text-center align-middle">'.FormatoFecha($row_comunicado['fecha']).'</td>
<td class="text-center align-middle">'.$row_comunicado['tema'].'</td>
<td class="text-center align-middle">'.$nomencargado.'</td>
<td class="text-center align-middle">'.$row_comunicado['tipo_comunicacion'].'</td>
<td class="text-center align-middle">'.$row_comunicado['material'].'</td>
<td class="text-center align-middle">'.$row_comunicado['seguimiento'].'</td>
</tr>';

}

$contenid0 .= '</tbody>';
$contenid0 .= '</table>';

$sql = "SELECT * FROM se_comunicacion_evidencia WHERE id_comunicacion = '".$GET_idRegistro."' ";
$result = mysqli_query($con, $sql);
$numero = mysqli_num_rows($result);

if ($numero > 0) {
$contenid0 .= '<h4>Evidencias</h4>';
$contenid0 .= '<div class="mt-3">';
while($row = mysqli_fetch_array($result, MYSQLI_ASSOC)){
$RutaEvidencia.$row['id'] = SERVIDOR."archivos/evidencias/".$row['archivo'];
$DataEvidencia.$row['id'] = file_get_contents($RutaEvidencia.$row['id']);
$baseEvidencia.$row['id'] = 'data:image/;base64,' . base64_encode($DataEvidencia.$row['id']);
$contenid0 .= '<img class="p-2" src="'.$baseEvidencia.$row['id'].'" style="width: 35%">
';
}
$contenid0 .= '</div>';
}

$contenid0 .= '</body>';
$contenid0 .= '</html>';

$dompdf->loadHtml($contenid0);
// Colocamos als propiedades de la hoja
$dompdf->setPaper("A4", "landscape");
// Escribimos el html en el PDF
$dompdf->render();
$canvas = $dompdf->get_canvas();
$canvas->page_text(768, 570, "Página: {PAGE_NUM} de {PAGE_COUNT}", null, 7, array(0, 0, 0));

// Ponemos el PDF en el browser
$dompdf->stream('Comunicación, participación y consulta.pdf',["Attachment" => true]);

//-----------------
mysqli_close($con);
//-----------------