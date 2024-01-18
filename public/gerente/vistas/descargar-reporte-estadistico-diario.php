<?php
require_once '../../../dompdf/autoload.inc.php';
include_once "../../../app/help.php";

use Dompdf\Dompdf;
$dompdf = new Dompdf();

$sql_reportecre = "SELECT * FROM re_reporte_cre_mes WHERE id_estacion = '".$Session_IDEstacion."' and mes = '".$_GET['idMes']."' and year = '".$_GET['idYear']."' ";
$result_reportecre = mysqli_query($con, $sql_reportecre);
$numero_reportecre = mysqli_num_rows($result_reportecre);

while($row_reportecre = mysqli_fetch_array($result_reportecre, MYSQLI_ASSOC)){
$idReporteCre = $row_reportecre['id'];
}

function Detalle($Producto,$idReporteCre,$con){

$sql_reportepro1 = "SELECT * FROM re_reporte_cre_producto WHERE id_re_mes = '".$idReporteCre."' and producto = '".$Producto."' ";
$result_reportepro1 = mysqli_query($con, $sql_reportepro1);
$numero_reportepro1 = mysqli_num_rows($result_reportepro1);
while($row_reportepro1 = mysqli_fetch_array($result_reportepro1, MYSQLI_ASSOC)){

$idPro1 = $row_reportepro1['id'];

$sql_pipas = "SELECT sum(volumen) AS volpro1 FROM re_reporte_cre_pipas WHERE id_re_producto = '".$idPro1."'  ";
$result_pipas = mysqli_query($con, $sql_pipas);
while($row_pipas = mysqli_fetch_array($result_pipas, MYSQLI_ASSOC)){
$tovolpro = $row_pipas['volpro1'];
}

$VolumenInicial = $VolumenInicial + $row_reportepro1['volumen_inicial'];
$VolumenVenta = $VolumenVenta + $row_reportepro1['volumen_venta'];
$VolumenFinal = $VolumenFinal + $row_reportepro1['volumen_final'];

$VolumenCompra = $VolumenCompra + $tovolpro;

}

$array = array('VolumenInicial' => $VolumenInicial,
				'VolumenVenta' => $VolumenVenta,
				'VolumenFinal' => $VolumenFinal,
				'VolumenCompra' => $VolumenCompra);

return $array;

}

$RutaLogo = "http://portal.admongas.com.mx/portal-sasisopa/imgs/logo/Logo.png";
$DataLogo = file_get_contents($RutaLogo);
$baseLogo = 'data:image/png;base64,' . base64_encode($DataLogo);

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


$contenid0 .= '<table class="table table-bordered" style="font-size: 1em">';
$contenid0 .= '<tbody>';
$contenid0 .= '<tr>';

$contenid0 .= '<td class="align-middle text-center">';
$contenid0 .= "<img src='".$baseLogo."' style='width: 130px;'>";
$contenid0 .= '</td>';
$contenid0 .= '<td colspan="2" class="align-middle text-center">';
$contenid0 .= '<b>Reporte Estadistico Diario</b>';
$contenid0 .= '</td>';
$contenid0 .= '<td class="align-middle text-center">';
$contenid0 .= '<b>Fo.ADMONGAS.005</b>';
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

//----------------------------------------------------------------------------------

$Producto1 = Detalle($Session_ProductoUno,$idReporteCre,$con);
$Producto2 = Detalle($Session_ProductoDos,$idReporteCre,$con);
$Producto3 = Detalle($Session_ProductoTres,$idReporteCre,$con);

$Merma1 = $Producto1['VolumenInicial'] + $Producto1['VolumenCompra'] - $Producto1['VolumenVenta'] - $Producto1['VolumenFinal'];

$Merma2 = $Producto2['VolumenInicial'] + $Producto2['VolumenCompra'] - $Producto2['VolumenVenta'] - $Producto2['VolumenFinal'];

$Merma3 = $Producto3['VolumenInicial'] + $Producto3['VolumenCompra'] - $Producto3['VolumenVenta'] - $Producto3['VolumenFinal'];

$contenid0 .= '<table class="table table-bordered" style="font-size: 1em;margin-top: 50px;">';
$contenid0 .= '<tbody>';

//------------------------------------------------
$contenid0 .= '<tr>';
$contenid0 .= '<td class="align-middle text-center">';
$contenid0 .= '<b>Producto</b>';
$contenid0 .= '</td>';
$contenid0 .= '<td class="align-middle text-center">';
$contenid0 .= '<b>Volumen (Lt) Inicial</b>';
$contenid0 .= '</td>';
$contenid0 .= '<td class="align-middle text-center">';
$contenid0 .= '<b>Volumen (Lt) de venta</b>';
$contenid0 .= '</td>';
$contenid0 .= '<td class="align-middle text-center">';
$contenid0 .= '<b>Volumen (Lt) Final</b>';
$contenid0 .= '</td>';
$contenid0 .= '<td class="align-middle text-center">';
$contenid0 .= '<b>Volumen (Lt) de Compra</b>';
$contenid0 .= '</td>';
$contenid0 .= '</tr>';

//----------------------------Producto 1
$contenid0 .= '<tr>';
$contenid0 .= '<td class="align-middle text-center" style="background-color: #74bc1f;color: white;">';
$contenid0 .= '<b>'.$Session_ProductoUno.'</b>';
$contenid0 .= '</td>';
$contenid0 .= '<td class="align-middle text-center">';
$contenid0 .= number_format($Producto1['VolumenInicial'],2);
$contenid0 .= '</td>';
$contenid0 .= '<td class="align-middle text-center">';
$contenid0 .= number_format($Producto1['VolumenVenta'],2);
$contenid0 .= '</td>';
$contenid0 .= '<td class="align-middle text-center">';
$contenid0 .= number_format($Producto1['VolumenFinal'],2);
$contenid0 .= '</td>';
$contenid0 .= '<td class="align-middle text-center">';
$contenid0 .= number_format($Producto1['VolumenCompra'],2);
$contenid0 .= '</td>';
$contenid0 .= '</tr>';


//----------------------------Producto 2
$contenid0 .= '<tr>';
$contenid0 .= '<td class="align-middle text-center" style="background-color: #e01883;color: white;">';
$contenid0 .= '<b>'.$Session_ProductoDos.'</b>';
$contenid0 .= '</td>';
$contenid0 .= '<td class="align-middle text-center">';
$contenid0 .= number_format($Producto2['VolumenInicial'],2);
$contenid0 .= '</td>';
$contenid0 .= '<td class="align-middle text-center">';
$contenid0 .= number_format($Producto2['VolumenVenta'],2);
$contenid0 .= '</td>';
$contenid0 .= '<td class="align-middle text-center">';
$contenid0 .= number_format($Producto2['VolumenFinal'],2);
$contenid0 .= '</td>';
$contenid0 .= '<td class="align-middle text-center">';
$contenid0 .= number_format($Producto2['VolumenCompra'],2);
$contenid0 .= '</td>';
$contenid0 .= '</tr>';

//----------------------------Producto 3
if ($Session_ProductoTres != "") {
$contenid0 .= '<tr>';
$contenid0 .= '<td class="align-middle text-center" style="background-color: #5c108c;color: white;">';
$contenid0 .= '<b>'.$Session_ProductoTres.'</b>';
$contenid0 .= '</td>';
$contenid0 .= '<td class="align-middle text-center">';
$contenid0 .= number_format($Producto3['VolumenInicial'],2);
$contenid0 .= '</td>';
$contenid0 .= '<td class="align-middle text-center">';
$contenid0 .= number_format($Producto3['VolumenVenta'],2);
$contenid0 .= '</td>';
$contenid0 .= '<td class="align-middle text-center">';
$contenid0 .= number_format($Producto3['VolumenFinal'],2);
$contenid0 .= '</td>';
$contenid0 .= '<td class="align-middle text-center">';
$contenid0 .= number_format($Producto3['VolumenCompra'],2);
$contenid0 .= '</td>';
$contenid0 .= '</tr>';
}


$contenid0 .= '</tbody>';
$contenid0 .= '</table>';

$contenid0 .= '<div style="font-size: 1.2em;margin-top: 30px;">Merma</div>';

$contenid0 .= '<table class="table table-bordered" style="font-size: 1em;margin-top: 30px;">';
$contenid0 .= '<tbody>';

$contenid0 .= '<tr>';
$contenid0 .= '<td class="align-middle text-center" style="background-color: #74bc1f;color: white;">';
$contenid0 .= '<b>'.$Session_ProductoUno.'</b>';
$contenid0 .= '</td>';
$contenid0 .= '<td class="align-middle text-center">'.number_format($Merma1,2).'</td>';
$contenid0 .= '</tr>';

$contenid0 .= '<tr>';
$contenid0 .= '<td class="align-middle text-center" style="background-color: #e01883;color: white;">';
$contenid0 .= '<b>'.$Session_ProductoDos.'</b>';
$contenid0 .= '</td>';
$contenid0 .= '<td class="align-middle text-center">'.number_format($Merma2,2).'</td>';
$contenid0 .= '</tr>';

if ($Session_ProductoTres != "") {
$contenid0 .= '<tr>';
$contenid0 .= '<td class="align-middle text-center" style="background-color: #5c108c;color: white;">';
$contenid0 .= '<b>'.$Session_ProductoTres.'</b>';
$contenid0 .= '</td>';
$contenid0 .= '<td class="align-middle text-center">'.number_format($Merma3,2).'</td>';
$contenid0 .= '</tr>';
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