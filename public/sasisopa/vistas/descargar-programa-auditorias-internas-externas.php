<?php
require_once 'dompdf/autoload.inc.php';
include_once "app/help.php";


$sql = "SELECT * FROM tb_programa_auditorias WHERE id_estacion = '".$Session_IDEstacion."' AND YEAR(fecha) >= '".$FechaInicio."' AND YEAR(fecha) <= '".$FechaFin."' ORDER BY fecha ASC ";
$result = mysqli_query($con, $sql);
$numero = mysqli_num_rows($result);

use Dompdf\Dompdf;
$dompdf = new Dompdf();

    $contenid0 .= "<!DOCTYPE html>";
    $contenid0 .= "<html>";
    $contenid0 .= "<head>";
    $contenid0 .= "<title>Formato Programa de auditorias (Internas y externas)</title>";
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

.table-primary,
.table-primary > th,
.table-primary > td {
  background-color: #b8daff;
}

.table-success,
.table-success > th,
.table-success > td {
  background-color: #c3e6cb;
}
</style>';

$contenid0 .= '</head>';
$contenid0 .= '<body';



    $RutaLogo = SERVIDOR."imgs/logo/Logo.png";
    $DataLogo = file_get_contents($RutaLogo);
    $baseLogo = 'data:image/;base64,' . base64_encode($DataLogo);


$contenid0 .= '<div>';

$contenid0 .= '<table class="table table-bordered table-sm" style="font-size: .9em;">
<tr>
<td class="text-center align-middle"><img src="'.$baseLogo.'" style="width: 100px;"></td>
<td colspan="2" class="text-center align-middle"><b>Formato Programa de auditorias (Internas y externas) </b></td>
<td class="text-center align-middle">Fo.ADMONGAS.023</td>
</tr>
<tr>
<td class="text-center align-middle">Realizado por: Nelly Estrada Garcia </td>
<td class="text-center align-middle">Revisado por: Eduardo Galicia Flores </td>
<td class="text-center align-middle">Autorizado por: '.$Session_ApoderadoLegal.' </td>
<td class="text-center align-middle">Fecha de autorizacion 01-Oct-2018</td>
</tr>
</table>';

$contenid0 .= '<table class="table table-bordered table-sm">
<thead>
<tr>
<th class="text-center align-middle">Tipo de auditoria</th>
<th class="text-center align-middle">Responsable</th>
<th class="text-center align-middle">Periodicidad</th>';


for ($i = $FechaInicio; $i <= $FechaFin; $i++) {
$contenid0 .= '<th class="text-center align-middle">'.$i.'</th>';
}

$contenid0 .= '</tr>';
$contenid0 .= '</thead>';
$contenid0 .= '<tbody>';

while($row = mysqli_fetch_array($result, MYSQLI_ASSOC)){
  
$contenid0 .= '<tr>';
$contenid0 .= '<td>'.$row['tipo_auditoria'].'</td>';
$contenid0 .= '<td>'.$row['responsable'].'</td>';
$contenid0 .= '<td>'.$row['periodicidad'].'</td>';

$ExplodeF = explode("-", $row['fecha']);
for ($mes = $FechaInicio; $mes <= $FechaFin; $mes++) {

if($row['tipo_auditoria'] == 'Interna'){

if($ExplodeF[0] == $mes){
$Color = 'table-primary';
$Titulo = nombremes($ExplodeF[1]);
}else{
$Color = ''; 
$Titulo = '';
}

}else if($row['tipo_auditoria'] == 'Externa'){

if($ExplodeF[0] == $mes){
$Color = 'table-success';
$Titulo = nombremes($ExplodeF[1]);
}else{
$Color = ''; 
$Titulo = '';
}

}

$contenid0 .= '<td class="text-center align-middle '.$Color.'">'.$Titulo.'</td>';

}

$contenid0 .= '</tr>';  
}



$contenid0 .= '</tbody></table>';

$contenid0 .= '<div class="text-center" style="font-size: .8em;margin-top: 40px;">
<small>*Las auditorias al SA se realizaran por personal interno de la empresa, que puede ser el gerente de la estación de servicio, el Representante legal, el departamento de gestión, entre otras y las auditorias externas se realizaran por un tercer acreditado (cada dos años de acuerdo a las DACG expendio de petrolíferos) ante la Agencia de Seguridad Energía y Ambiente, tercer acreditado que tendrá que tener vigente su autorización ante la Agencia y el personal podrá elegir. </small>
</div>';

$contenid0 .= '</div>';

$contenid0 .= '</body>';
$contenid0 .= '</html>';


$dompdf->loadHtml($contenid0);
// Colocamos als propiedades de la hoja
$dompdf->setPaper("A4", "landscape");
// Escribimos el html en el PDF
$dompdf->render();
// Ponemos el PDF en el browser
$dompdf->stream('Formato Programa de auditorias (Internas y externas).pdf',["Attachment" => true]);
//------------------
mysqli_close($con);
//------------------