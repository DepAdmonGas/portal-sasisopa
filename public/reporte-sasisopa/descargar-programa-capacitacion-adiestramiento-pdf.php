<?php
require_once '../../dompdf/autoload.inc.php';
include_once "../../app/help.php";

$FechaInicio = date('Y-m-d', $_GET['FechaInicio']);
$FechaTermino = date('Y-m-d', $_GET['FechaTermino']);

$sql_capacitacion = "SELECT * FROM tb_capacitacion_externa WHERE id_estacion = '".$Session_IDEstacion."' AND fecha_programada BETWEEN '".$FechaInicio."' AND '".$FechaTermino."' ";
$result_capacitacion = mysqli_query($con, $sql_capacitacion);
$numero_capacitacion = mysqli_num_rows($result_capacitacion);


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

    $contenid0 .= "<!DOCTYPE html>";
    $contenid0 .= "<html>";
    $contenid0 .= "<head>";
    $contenid0 .= "<title>Capacitación externa</title>";
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

</style>';

$contenid0 .= '</head>';
$contenid0 .= '<body';



$RutaLogo = SERVIDOR."imgs/logo/Logo.png";
$DataLogo = file_get_contents($RutaLogo);
$baseLogo = 'data:image/;base64,' . base64_encode($DataLogo);


    $RutaX = SERVIDOR."imgs/iconos/img-no.png";
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
$contenid0 .= '<b>Programa de Capacitacion y adiestramiento</b>';
$contenid0 .= '</td>';
$contenid0 .= '<td class="align-middle text-center">';
$contenid0 .= '<b>Fo.ADMONGAS.009</b>';
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

while($row_capacitacion = mysqli_fetch_array($result_capacitacion, MYSQLI_ASSOC)){
  
$contenid0 .= '<table class="table table-bordered" style="font-size: .9em;">';
$contenid0 .= '<tbody>';

$contenid0 .= '
<tr>
<th rowspan="2" class="align-middle text-center">No.</th>
<th rowspan="2" class="align-middle text-center">Nombre del trabajador</th>
<th rowspan="2" class="align-middle text-center">Nombre del Curso</th>
<th rowspan="2" class="align-middle text-center">Fecha Programada</th>
<th rowspan="2" class="align-middle text-center">Duración</th>
<th rowspan="2" class="align-middle text-center">Nombre del instructor</th>
<th colspan="2" class="align-middle text-center">Tipo de instructor</th>
</tr>
<tr>
<th class="align-middle text-center">Interno</th>
<th class="align-middle text-center">Externo</th>
</tr>';

$curso = $row_capacitacion['curso'];
$fechaProgramada = $row_capacitacion['fecha_programada'];
$duracion = $row_capacitacion['duracion'];
$duraciondetalle = $row_capacitacion['duraciondetalle'];
$instructor = $row_capacitacion['instructor'];

$sql = "SELECT * FROM tb_capacitacion_externa_personal WHERE id_capacitacion = '".$row_capacitacion['id']."'  ";
$result = mysqli_query($con, $sql);
$numero = mysqli_num_rows($result);

$i = 1;
while($row = mysqli_fetch_array($result, MYSQLI_ASSOC)){

$contenid0 .= '<tr>';
$contenid0 .= '<td class="align-middle text-center">'.$i.'</td>';
$contenid0 .= '<td class="align-middle">'.Nombre($row['id_empleado'],$con).'</td>';
$contenid0 .= '<td class="align-middle">'.$curso.'</td>';
$contenid0 .= '<td class="align-middle">'.FormatoFecha($fechaProgramada).'</td>';
$contenid0 .= '<td class="align-middle">'.$duracion.' '.$duraciondetalle.'</td>';
$contenid0 .= '<td class="align-middle">'.$instructor.'</td>';
$contenid0 .= '<td class="align-middle"></td>';
$contenid0 .= '<td class="align-middle text-center"><img src="'.$baseX.'"></td>';
$contenid0 .= '</tr>';

$i++;
}


$contenid0 .= '</tbody>';
$contenid0 .= '</table>';
}


$contenid0 .= '</body>';
$contenid0 .= '</html>';


$dompdf->loadHtml($contenid0);
// Colocamos als propiedades de la hoja
$dompdf->setPaper("A4", "landscape");
// Escribimos el html en el PDF
$dompdf->render();
$dompdf->get_canvas()->page_text(750, 570, "Pagina: {PAGE_NUM} de {PAGE_COUNT}", $font, 8, array(0,0,0));
// Ponemos el PDF en el browser
$dompdf->stream('Capacitación externa.pdf',["Attachment" => true]);
//------------------
mysqli_close($con);
//------------------