<?php
require_once 'dompdf/autoload.inc.php';
include_once "app/help.php";

function txtFecha($fecha){
if($fecha == "0000-00-00"){
$resultado == "";
}else{
$formato_fecha = explode("-",$fecha);
$resultado = "<b>".$formato_fecha[2]."</b>.".substr(nombremes($formato_fecha[1]),0,3).".".substr($formato_fecha[0],-2,2);
}
return $resultado;
}

function ColorTD($fecha){
$fecha_del_dia = date("Y-m-d");

if($fecha == "0000-00-00"){
$resultado = "table-secondary";
}else{

$nuevafecha = strtotime ( '-3 day' , strtotime ($fecha)) ;
$nuevafecha = date ( 'Y-m-d' , $nuevafecha);

if ($fecha_del_dia == $fecha) 
{
$resultado = "table-danger";
}
else if ($fecha_del_dia > $fecha) 
{
$resultado = "table-success";  
}
else if ($fecha_del_dia >= $nuevafecha) 
{
$resultado = "table-warning";  
}else{
  $resultado = "table-active";
}


}

return $resultado;  
}

function txtColor($fecha){
$fecha_del_dia = date("Y-m-d");

$nuevafecha = strtotime ( '-3 day' , strtotime ($fecha)) ;
$nuevafecha = date ( 'Y-m-d' , $nuevafecha);

if ($fecha_del_dia == $fecha) 
{
$resultado = "text-danger";
}
else if ($fecha_del_dia > $fecha) 
{
$resultado = "text-secondary";
}
else if ($fecha_del_dia >= $nuevafecha) 
{
$resultado = "text-danger";  
}else{
  $resultado = "text-black";
}

return $resultado;  
}

use Dompdf\Dompdf;
$dompdf = new Dompdf();

    $contenid0 .= "<!DOCTYPE html>";
    $contenid0 .= "<html>";
    $contenid0 .= "<head>";
    $contenid0 .= "<title>Programa Anual de Mantenimiento</title>";
    $contenid0 .= '<style type="text/css">
@page {margin: 0.5cm 0.5cm; font-family: Arial, Helvetica, sans-serif;}
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



    $RutaLogo = "http://portal.admongas.com.mx/portal-sasisopa/imgs/logo/Logo.png";
    $DataLogo = file_get_contents($RutaLogo);
    $baseLogo = 'data:image/;base64,' . base64_encode($DataLogo);


$contenid0 .= '<div>';

$contenid0 .= '<table class="table table-bordered" style="font-size: .8em;">';
$contenid0 .= '<tbody>';
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
$contenid0 .= 'Aprobado por:<br> '.$Session_ApoderadoLegal.'';
$contenid0 .= '</td>';
$contenid0 .= '<td class="align-middle text-center">';
$contenid0 .= 'Fecha de autorizacion 01/10/2018';
$contenid0 .= '</td>';
$contenid0 .= '</tr>';            
$contenid0 .= '</tbody>';
$contenid0 .= '</table>';

//---------------------------------------------------------------

$contenid0 .= '<table class="table table-bordered" style="font-size: .7em;">';
$contenid0 .= '<tbody>';

$contenid0 .= '
<tr>
<th class="align-middle text-center">Equipo o instalación</th>
<th class="align-middle text-center">Periodicidad</th>
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

$txt_enero = txtFecha($row_mantenimiento_lista['enero']);
$txt_febrero = txtFecha($row_mantenimiento_lista['febrero']);
$txt_marzo = txtFecha($row_mantenimiento_lista['marzo']);
$txt_abril = txtFecha($row_mantenimiento_lista['abril']);
$txt_mayo = txtFecha($row_mantenimiento_lista['mayo']);
$txt_junio = txtFecha($row_mantenimiento_lista['junio']);
$txt_julio = txtFecha($row_mantenimiento_lista['julio']);
$txt_agosto = txtFecha($row_mantenimiento_lista['agosto']);
$txt_septiembre = txtFecha($row_mantenimiento_lista['septiembre']);
$txt_octubre = txtFecha($row_mantenimiento_lista['octubre']);
$txt_noviembre = txtFecha($row_mantenimiento_lista['noviembre']);
$txt_diciembre = txtFecha($row_mantenimiento_lista['diciembre']);

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
$dompdf->get_canvas()->page_text(750, 570, "Pagina: {PAGE_NUM} de {PAGE_COUNT}", $font, 8, array(0,0,0));
// Ponemos el PDF en el browser
$dompdf->stream('Programa Anual de Mantenimiento.pdf',["Attachment" => true]);
//------------------
mysqli_close($con);
//------------------