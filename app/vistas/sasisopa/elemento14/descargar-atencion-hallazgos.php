<?php
require_once 'dompdf/autoload.inc.php';
include_once "app/help.php";
include_once "app/modelo/MonitoreoVerificacionEvaluacion.php";
$class_monitoreo_evaluacion = new MonitoreoVerificacionEvaluacion();

use Dompdf\Dompdf;
$dompdf = new Dompdf();

    $contenid0 = "";
    $contenid0 .= "<!DOCTYPE html>";
    $contenid0 .= "<html>";
    $contenid0 .= "<head>";
    $contenid0 .= "<title>Atención de Hallazgos</title>";
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
$contenid0 .= '<b>Atención de Hallazgos</b>';
$contenid0 .= '</td>';
$contenid0 .= '<td class="align-middle text-center">';
$contenid0 .= '<b>Fo.ADMONGAS.018</b>';
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

$sql = "SELECT * FROM tb_atencion_hallazgos WHERE id = '".$GET_ID."' ";
$result = mysqli_query($con, $sql);
$numero = mysqli_num_rows($result);

$contenid0 .= '<table class="table table-bordered table-striped table-sm" style="font-size: .9em;">';
$contenid0 .= '<thead>'; 
$contenid0 .= '<tr>';
$contenid0 .= '<th class="text-center align-middle">#</th>';
$contenid0 .= '<th class="text-center align-middle">Fecha de la auditoria</th>';
$contenid0 .= '<th class="text-center align-middle">No de control de la auditoria</th>';
$contenid0 .= '<th class="text-center align-middle">Tipo de auditoria</th>';
$contenid0 .= '</tr>';
$contenid0 .= '</thead>';
$contenid0 .= '<tbody>';

if ($numero > 0) {
while($row = mysqli_fetch_array($result, MYSQLI_ASSOC)){

$id = $row['id'];
$fechaauditoria = $row['fecha_auditoria'];
$nocontrol = $row['no_control'];
$tipoauditoria = $row['tipo_auditoria'];

$contenid0 .= '<tr>';
$contenid0 .= '<td class="text-center align-middle"><b>'.$row['folio'].'</b></td>
<td class="text-center align-middle">'.FormatoFecha($fechaauditoria).'</td>
<td class="text-center align-middle">'.$nocontrol.'</td>
<td class="text-center align-middle">'.$tipoauditoria.'</td>';
$contenid0 .= '</tr>';
}
}else{
$contenid0 .= '<td colspan="11" class="text-center text-secondary" style="font-size: .8em;">No se encontró información para mostrar</td>';
}

$contenid0 .= '</tbody></table>';

$sqlH = "SELECT * FROM tb_atencion_hallazgos_detalle WHERE id_atencion = '".$GET_ID."' ORDER BY id_sasisopa ASC ";
$resultH = mysqli_query($con, $sqlH);
$numeroH = mysqli_num_rows($resultH);

$contenid0 .= '<table class="table table-bordered table-striped table-hover table-sm mt-3" style="font-size: .9em;">
<thead>
<tr>
  <th class="align-middle text-center">SASISOPA</th>
  <th class="align-middle text-center">Hallazgos</th>
  <th class="align-middle text-center">Acción preventiva por hallazgo</th>  
  <th class="align-middle text-center">Fecha de implementación</th>
  <th class="align-middle text-center">Evidencia</th>
  <th class="align-middle text-center">% de cumplimiento</th>
</tr>
</thead>
<tbody>';

if ($numeroH > 0) {
while($rowH = mysqli_fetch_array($resultH, MYSQLI_ASSOC)){

$idH = $rowH['id'];

$Evidencia = $class_monitoreo_evaluacion->evidencia($idH);
$Cumplimiento = $class_monitoreo_evaluacion->cumplimiento($idH);

$contenid0 .= '<tr>';
$contenid0 .= '<td class="align-middle text-center"><b>'.$class_monitoreo_evaluacion->sasisopa($rowH['id_sasisopa']).'</b></td>';
$contenid0 .= '<td class="align-middle text-center">'.$rowH['hallazgos'].'</td>';
$contenid0 .= '<td class="align-middle text-center">'.$rowH['accion'].'</td>';
$contenid0 .= '<td class="align-middle text-center">'.FormatoFecha($rowH['fecha_implementacion']).'</td>';
$contenid0 .= '<td class="align-middle text-center">'.$Evidencia.'</td>';
$contenid0 .= '<td class="align-middle text-center"><b>'.$Cumplimiento.'</b></td>';
$contenid0 .= '</tr>';

}
}else{
$contenid0 .= "<tr><td colspan='6' class='text-secondary text-center' >No se encontró información para mostrar.</td></tr>";    
}

$contenid0 .= '</tbody> 
</table>';

$contenid0 .= '</div>';
$contenid0 .= '</body>';
$contenid0 .= '</html>';


$dompdf->loadHtml($contenid0);
// Colocamos als propiedades de la hoja
$dompdf->setPaper("A4", "landscape");
// Escribimos el html en el PDF
$dompdf->render();
// Ponemos el PDF en el browser
$dompdf->stream('Atención de Hallazgos.pdf');
//------------------
mysqli_close($con);
//------------------