<?php
include_once "app/help.php";
include_once "app/modelo/ControlActividadProceso.php";
require_once 'dompdf/autoload.inc.php';

$class_control_actividad_proceso = new ControlActividadProceso();

$sql_estaciones = "SELECT apoderado_legal, razonsocial FROM tb_estaciones WHERE id = '".$GET_idEstacion."' ";
$result_estaciones = mysqli_query($con, $sql_estaciones);
$numero_estaciones = mysqli_num_rows($result_estaciones);
$row_estaciones = mysqli_fetch_array($result_estaciones, MYSQLI_ASSOC);
$apoderado_legal = $row_estaciones['apoderado_legal'];
$razonsocial = $row_estaciones['razonsocial'];

use Dompdf\Dompdf;
$dompdf = new Dompdf();

    $contenid0 = "";
    $contenid0 .= "<!DOCTYPE html>";
    $contenid0 .= "<html>";
    $contenid0 .= "<head>";
    $contenid0 .= "<title>Programa Anual de Mantenimiento</title>";
    $contenid0 .= '<style type="text/css">
@page {margin: 0.6cm 0.6cm; font-family: Arial, Helvetica, sans-serif;}
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
$contenid0 .= '<table class="table table-bordered" style="font-size: .8em;">';
$contenid0 .= '<tbody>';
$contenid0 .= '<tr>';
$contenid0 .= '<td colspan="4">Razón Social: '.$razonsocial.'</td>';
$contenid0 .= '</tr>';
$contenid0 .= '<tr>';

$contenid0 .= '<td class="align-middle text-center">';
$contenid0 .= '<img src="'.$baseLogo.'" style="width: 150px;">';
$contenid0 .= '</td>';
$contenid0 .= '<td colspan="2" class="align-middle text-center">';
$contenid0 .= '<b>Programa Anual de Mantenimiento</b>';
$contenid0 .= '</td>';
$contenid0 .= '<td class="align-middle text-center">';
$contenid0 .= '<b>Fo.ADMONGAS.011</b>';
$contenid0 .= '</td>';

$contenid0 .= '</tr>';
//------------------------------------------------------------------
$contenid0 .= '<tr>';
$contenid0 .= '<td class="align-middle text-center">';
$contenid0 .= 'Elaborado por: Nelly Estrada Garcia/Francisco Ibarra Alcántara ';
$contenid0 .= '</td>';
$contenid0 .= '<td class="align-middle text-center">';
$contenid0 .= 'Revisado por:<br> Eduardo Galicia Flores';
$contenid0 .= '</td>';
$contenid0 .= '<td class="align-middle text-center">';
$contenid0 .= 'Aprobado por:<br> '.$apoderado_legal .'';
$contenid0 .= '</td>';
$contenid0 .= '<td class="align-middle text-center">';
$contenid0 .= 'Fecha de autorizacion 01/10/2018';
$contenid0 .= '</td>';
$contenid0 .= '</tr>';            
$contenid0 .= '</tbody>';
$contenid0 .= '</table>';

//---------------------------------------------------------------

$contenid0 .= '<table class="table table-bordered" style="font-size: .6em;">';
$contenid0 .= '<tbody>';

$contenid0 .= '
<tr>
<th class="align-middle text-center" width="200px">Equipo o instalación</th>
<th class="align-middle text-center" width="70px">Periodicidad</th>
<th class="align-middle text-center">Enero</th>
<th class="align-middle text-center">Febrero</th>
<th class="align-middle text-center">Marzo</th>
<th class="align-middle text-center">Abril</th>
<th class="align-middle text-center">Mayo</th>
<th class="align-middle text-center">Junio</th>
<th class="align-middle text-center">Julio</th>
<th class="align-middle text-center">Agosto</th>
<th class="align-middle text-center">Septiembre</th>
<th class="align-middle text-center">Octubre</th>
<th class="align-middle text-center">Noviembre</th>
<th class="align-middle text-center">Diciembre</th>
</tr>';

$sql_mantenimiento_lista = "SELECT po_mantenimiento_lista.id, po_mantenimiento_lista.detalle, po_mantenimiento_lista.periodicidad, 
po_programa_anual_mantenimiento_detalle.id AS idreporte, po_programa_anual_mantenimiento_detalle.id_programa_fecha, po_programa_anual_mantenimiento_detalle.enero,po_programa_anual_mantenimiento_detalle.febrero,po_programa_anual_mantenimiento_detalle.marzo,po_programa_anual_mantenimiento_detalle.abril,po_programa_anual_mantenimiento_detalle.mayo,po_programa_anual_mantenimiento_detalle.junio,po_programa_anual_mantenimiento_detalle.julio,po_programa_anual_mantenimiento_detalle.agosto,po_programa_anual_mantenimiento_detalle.septiembre,po_programa_anual_mantenimiento_detalle.octubre,po_programa_anual_mantenimiento_detalle.noviembre,po_programa_anual_mantenimiento_detalle.diciembre
FROM po_mantenimiento_lista
INNER JOIN po_programa_anual_mantenimiento_detalle
ON po_mantenimiento_lista.id = po_programa_anual_mantenimiento_detalle.id_mantenimiento WHERE po_programa_anual_mantenimiento_detalle.id_programa_fecha = '".$GET_idRegistro."' ORDER BY po_mantenimiento_lista.id asc ";
        $result_mantenimiento_lista = mysqli_query($con, $sql_mantenimiento_lista);
        $numero_mantenimiento_lista = mysqli_num_rows($result_mantenimiento_lista);                
while($row_mantenimiento_lista = mysqli_fetch_array($result_mantenimiento_lista, MYSQLI_ASSOC)){

$txt_enero = $class_control_actividad_proceso->txtFecha($row_mantenimiento_lista['enero']);
$txt_febrero = $class_control_actividad_proceso->txtFecha($row_mantenimiento_lista['febrero']);
$txt_marzo = $class_control_actividad_proceso->txtFecha($row_mantenimiento_lista['marzo']);
$txt_abril = $class_control_actividad_proceso->txtFecha($row_mantenimiento_lista['abril']);
$txt_mayo = $class_control_actividad_proceso->txtFecha($row_mantenimiento_lista['mayo']);
$txt_junio = $class_control_actividad_proceso->txtFecha($row_mantenimiento_lista['junio']);
$txt_julio = $class_control_actividad_proceso->txtFecha($row_mantenimiento_lista['julio']);
$txt_agosto = $class_control_actividad_proceso->txtFecha($row_mantenimiento_lista['agosto']);
$txt_septiembre = $class_control_actividad_proceso->txtFecha($row_mantenimiento_lista['septiembre']);
$txt_octubre = $class_control_actividad_proceso->txtFecha($row_mantenimiento_lista['octubre']);
$txt_noviembre = $class_control_actividad_proceso->txtFecha($row_mantenimiento_lista['noviembre']);
$txt_diciembre = $class_control_actividad_proceso->txtFecha($row_mantenimiento_lista['diciembre']);

$contenid0 .= '<tr>
<td class="align-middle">'.$row_mantenimiento_lista['detalle'].'</td>
<td class="align-middle text-center">'.$row_mantenimiento_lista['periodicidad'].'</td>
<td class="align-middle text-center">'.$txt_enero.'</td>
<td class="align-middle text-center">'.$txt_febrero.'</td>
<td class="align-middle text-center">'.$txt_marzo.'</td>
<td class="align-middle text-center">'.$txt_abril.'</td>
<td class="align-middle text-center">'.$txt_mayo.'</td>
<td class="align-middle text-center">'.$txt_junio.'</td>
<td class="align-middle text-center">'.$txt_julio.'</td>
<td class="align-middle text-center">'.$txt_agosto.'</td>
<td class="align-middle text-center">'.$txt_septiembre.'</td>
<td class="align-middle text-center">'.$txt_octubre.'</td>
<td class="align-middle text-center">'.$txt_noviembre.'</td>
<td class="align-middle text-center">'.$txt_diciembre.'</td>
</tr>';

}
$contenid0 .= '</tbody>';
$contenid0 .= '</table>';


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
$dompdf->stream('Programa Anual de Mantenimiento.pdf',["Attachment" => true]);
//------------------
mysqli_close($con);
//------------------