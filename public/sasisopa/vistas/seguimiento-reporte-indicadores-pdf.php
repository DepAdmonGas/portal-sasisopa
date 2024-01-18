<?php
require_once '../../../dompdf/autoload.inc.php';
include_once "../../../app/help.php";

use Dompdf\Dompdf;
$dompdf = new Dompdf();

$contenid0 .= "<!DOCTYPE html>";
$contenid0 .= "<html>";
$contenid0 .= "<head>";
$contenid0 .= "<title>Reporte Estadistico Diario</title>";
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
$contenid0 .= '<body>';

$RutaLogo = SERVIDOR."imgs/logo/Logo.png";
$DataLogo = file_get_contents($RutaLogo);
$baseLogo = 'data:image/png;base64,' . base64_encode($DataLogo);

$contenid0 .= '<table class="table table-bordered" style="font-size: .9em">';
$contenid0 .= '<tbody>';
$contenid0 .= '<tr>';

$contenid0 .= '<td class="align-middle text-center">';
$contenid0 .= "<img src='".$baseLogo."' style='width: 130px;'>";
$contenid0 .= '</td>';
$contenid0 .= '<td colspan="2" class="align-middle text-center">';
$contenid0 .= '<b>Seguimiento y reporte de indicadores</b>';
$contenid0 .= '</td>';
$contenid0 .= '<td class="align-middle text-center">';
$contenid0 .= '<b>Fo.ADMONGAS.007</b>';
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
$contenid0 .= 'Fecha de aprobacion:<br>  01/10/2018';
$contenid0 .= '</td>';
$contenid0 .= '</tr>';
            
$contenid0 .= '</tbody>';
$contenid0 .= '</table>';

//--------------------------------------------------------------------

$contenid0 .= '<table class="table table-bordered" style="font-size: .9em">';
$contenid0 .= '<thead>';
$contenid0 .= '<tr>
<th class="align-middle">Fecha</th>
<th class="align-middle">Capacitación</th>
<th class="align-middle">Experiencia del cliente</th>
<th class="align-middle">Ventas</th>
<th class="align-middle">Medidas correctivas</th>
<th class="align-middle">Fecha de aplicación</th>
</tr>';
$contenid0 .= '</thead>';
$contenid0 .= '<tbody>';

$sql = "SELECT * FROM tb_seguimiento_reporte_indicador WHERE id_estacion = '".$Session_IDEstacion."' ";
$result = mysqli_query($con, $sql);
$numero = mysqli_num_rows($result);
while($row = mysqli_fetch_array($result, MYSQLI_ASSOC)){

$fecha = $row['fecha'];
$capacitacion = $row['capacitacion'];
$expcliente = $row['exp_cliente'];
$ventas = $row['ventas'];
$medidascorrectivas = $row['medidas_correctivas'];
$fechaaplicacion = $row['fecha_aplicacion'];

$contenid0 .= '<tr>
<td class="align-middle">'.FormatoFecha($fecha).'</td>
<td class="align-middle">'.$capacitacion.'</td>
<td class="align-middle">'.$expcliente.'</td>
<td class="align-middle">'.$ventas.'</td>
<td class="align-middle">'.$medidascorrectivas.'</td>
<td class="align-middle">'.FormatoFecha($fechaaplicacion).'</td>
</tr>';

}

$contenid0 .= '</tbody>';
$contenid0 .= '</table>';


$contenid0 .= '</body>';
$contenid0 .= '</html>';

$dompdf->loadHtml($contenid0);
// Colocamos als propiedades de la hoja
$dompdf->setPaper("A4", "portrait");
// Escribimos el html en el PDF
$dompdf->render();
$dompdf->get_canvas()->page_text(750, 570, "Pagina: {PAGE_NUM} de {PAGE_COUNT}", $font, 8, array(0,0,0));
// Ponemos el PDF en el browser
$dompdf->stream('Reporte Estadistico Diario.pdf',["Attachment" => true]);
//------------------
mysqli_close($con);
//------------------