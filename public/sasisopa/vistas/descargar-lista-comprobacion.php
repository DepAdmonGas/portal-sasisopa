<?php
require_once 'dompdf/autoload.inc.php';
include_once "app/help.php";

use Dompdf\Dompdf;
$dompdf = new Dompdf();

$sql = "SELECT * FROM tb_politica_lista_comprobacion WHERE id = '".$GET_idRegistro."' ";
$result = mysqli_query($con, $sql);
$numero = mysqli_num_rows($result);
while($row = mysqli_fetch_array($result, MYSQLI_ASSOC)){
$fecha = $row['fecha'];
$asistentes = $row['asistentes'];
$comentarios = $row['comentarios'];
}

$sql_lista = "SELECT * FROM tb_politica_lista_comprobacion_detalle WHERE id_lista_comprobacion = '".$GET_idRegistro."' ";
$result_lista = mysqli_query($con, $sql_lista);
$numero_lista = mysqli_num_rows($result_lista);


    $contenid0 .= "<!DOCTYPE html>";
    $contenid0 .= "<html>";
    $contenid0 .= "<head>";
    $contenid0 .= "<title>Lista de comprobación</title>";
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
$contenid0 .= '<b>Lista de comprobación</b>';
$contenid0 .= '</td>';
$contenid0 .= '<td class="align-middle text-center">';
$contenid0 .= '<b>Fo.ADMONGAS.001</b>';
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
$contenid0 .= 'Fecha de aprobacion:<br>  01-oct-18';
$contenid0 .= '</td>';
$contenid0 .= '</tr>';
            

$contenid0 .= '</tbody>';
$contenid0 .= '</table>';
//-----------------------------------------------------------------
$contenid0 .= '<div class="text-center mt-3 mb-3"><b>Política del SASISOPA</b></div>';

$contenid0 .= '<div class="mt-3 mb-3"><b>Fecha:</b> '.FormatoFecha($fecha).'</div>';

$contenid0 .= '<table class="table table-bordered">';

$contenid0 .= '<tbody>';
$contenid0 .= '<tr>';
$contenid0 .= '<td class="align-middle text-center">';
$contenid0 .= '<b>Política del SASISOPA</b>';
$contenid0 .= '</td>';
$contenid0 .= '<td class="align-middle text-center"><b>Si</b></td>';
$contenid0 .= '<td class="align-middle text-center"><b>En Parte</b></td>';
$contenid0 .= '<td class="align-middle text-center"><b>No</b></td>';
$contenid0 .= '</tr>';

while($row_lista = mysqli_fetch_array($result_lista, MYSQLI_ASSOC)){
$criterio = $row_lista['criterio'];
$resultado = $row_lista['resultado'];

if($resultado == "Si"){
$si = "X";
}else{
$si = ""; 
}

if($resultado == "En Parte"){
$enparte = "X";
}else{
$enparte = ""; 
}

if($resultado == "No"){
$no = "X";
}else{
$no = ""; 
}

$contenid0 .= '<tr>';
$contenid0 .= '<td class="align-middle">'.$criterio.'</td>';
$contenid0 .= '<td class="align-middle text-center">'.$si.'</td>';
$contenid0 .= '<td class="align-middle text-center">'.$enparte.'</td>';
$contenid0 .= '<td class="align-middle text-center">'.$no.'</td>';
$contenid0 .= '</tr>';

}

$contenid0 .= '</tbody>';
$contenid0 .= '</table>';

$contenid0 .= '<div class="mt-3 border p-3">
<div><b>Asistentes:</b></div>
'.$asistentes.'
</div>';

$contenid0 .= '<div class="mt-3 border p-3">
<div><b>Comentarios:</b></div>
'.$comentarios.'
</div>';


//-----------------------------------------------------------------
$contenid0 .= '</div>';

$contenid0 .= '</body>';
$contenid0 .= '</html>';


$dompdf->loadHtml($contenid0);
// Colocamos als propiedades de la hoja
$dompdf->setPaper("A4", "portrait");
// Escribimos el html en el PDF
$dompdf->render();
$dompdf->get_canvas()->page_text(750, 570, "Pagina: {PAGE_NUM} de {PAGE_COUNT}", $font, 8, array(0,0,0));
// Ponemos el PDF en el browser
$dompdf->stream('Lista de comprobación.pdf',["Attachment" => true]);
//------------------
mysqli_close($con);
//------------------