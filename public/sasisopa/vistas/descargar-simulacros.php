<?php
require_once 'dompdf/autoload.inc.php';
include_once "app/help.php";

function NomUsuario($id, $con){

$sql_lista = "SELECT * FROM tb_usuarios WHERE id = '".$id."' ";
$result_lista = mysqli_query($con, $sql_lista);
$numero_lista = mysqli_num_rows($result_lista);
while($row_lista = mysqli_fetch_array($result_lista, MYSQLI_ASSOC)){
$nombre = $row_lista['nombre']; 
}
return $nombre;
}


use Dompdf\Dompdf;
$dompdf = new Dompdf();

    $contenid0 .= "<!DOCTYPE html>";
    $contenid0 .= "<html>";
    $contenid0 .= "<head>";
    $contenid0 .= "<title>Programa anual de simulacros</title>";
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
.text-right {
  text-align: right !important;
}
hr {
  margin-top: 1rem;
  margin-bottom: 1rem;
  border: 0;
  border-top: 1px solid rgba(0, 0, 0, 0.1);
}
</style>';

$contenid0 .= '</head>';
$contenid0 .= '<body';



    $RutaLogo = RUTA_IMG_LOGOS."Logo.png";
    $DataLogo = file_get_contents($RutaLogo);
    $baseLogo = 'data:image/;base64,' . base64_encode($DataLogo);


$contenid0 .= '<div>';

$contenid0 .= '<table class="table table-bordered" style="font-size: .9em;">';
$contenid0 .= '<tbody>';
$contenid0 .= '<tr>';

$contenid0 .= '<td class="align-middle text-center">';
$contenid0 .= '<img src="'.$baseLogo.'" style="width: 150px;">';
$contenid0 .= '</td>';
$contenid0 .= '<td colspan="2" class="align-middle text-center">';
$contenid0 .= '<b>Programa anual de simulacros</b>';
$contenid0 .= '</td>';
$contenid0 .= '<td class="align-middle text-center">';
$contenid0 .= '<b>Fo.ADMONGAS.016</b>';
$contenid0 .= '</td>';

$contenid0 .= '</tr>';
//------------------------------------------------------------------
$contenid0 .= '<tr>';
$contenid0 .= '<td class="align-middle text-center">';
$contenid0 .= 'Realizado por: Nelly Estrada Garcia';
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

$sql = "SELECT * FROM tb_programa_anual_simulacros WHERE id_estacion = '".$Session_IDEstacion."' AND YEAR(fecha) = '".$GET_Year."' ORDER BY fecha ASC ";
$result = mysqli_query($con, $sql);
$numero = mysqli_num_rows($result);
while($row = mysqli_fetch_array($result, MYSQLI_ASSOC)){

$idPrograma = $row['id'];

$contenid0 .= '<table class="table table-bordered" style="font-size: .9em;">';
$contenid0 .= '<tbody>';
$contenid0 .= '<tr>
<td class="align-middle text-center"><b>Nombre del simulacro</b></td>
<td class="align-middle text-center"><b>Periodicidad</b></td>
<td class="align-middle text-center"><b>Fecha</b></td>
</tr>';

$contenid0 .= '<tr>
<td class="align-middle text-center">'.$row['nombre_simulacro'].'</td>
<td class="align-middle text-center">'.$row['periodicidad'].'</td>
<td class="align-middle text-center">'.FormatoFecha($row['fecha']).'</td>
</tr>';

$contenid0 .= '</tbody>';
$contenid0 .= '</table>';


$contenid0 .= '<table class="table table-bordered" style="font-size: .9em;">';
$contenid0 .= '<tbody>';
$contenid0 .= '<tr>
<td class="align-middle text-center"><b>Personal que asiste
</b></td>
</tr>';

$sql_programa = "SELECT * FROM tb_programa_anual_simulacros_personal WHERE id_programa = '".$idPrograma."' ";
$result_programa = mysqli_query($con, $sql_programa);
$numero_programa = mysqli_num_rows($result_programa);
while($row_programa = mysqli_fetch_array($result_programa, MYSQLI_ASSOC)){
$contenid0 .= '<tr><td>'.$row_programa['nombre'].'</td></tr>';
}


$contenid0 .= '</tbody>';
$contenid0 .= '</table>';

$sql_resumen = "SELECT * FROM tb_programa_anual_simulacros_resumen WHERE id_programa = '".$idPrograma."' ";
$result_resumen = mysqli_query($con, $sql_resumen);
$numero_resumen = mysqli_num_rows($result_resumen);
while($row_resumen = mysqli_fetch_array($result_resumen, MYSQLI_ASSOC)){
$contenid0 .= '<div class="border" style="padding: 15px;font-size: .9em;"><b>Resumen</b><div>'.$row_resumen['resumen'].'</div></div>';
}

$contenid0 .= '<hr>';
}

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
$dompdf->stream('Programa anual de simulacros.pdf',["Attachment" => true]);
//------------------
mysqli_close($con);
//------------------