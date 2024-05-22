<?php
require_once 'dompdf/autoload.inc.php';
include_once "app/help.php";


use Dompdf\Dompdf;
$dompdf = new Dompdf();

    $contenid0 = "";
    $contenid0 .= "<!DOCTYPE html>";
    $contenid0 .= "<html>";
    $contenid0 .= "<head>";
    $contenid0 .= "<title>Carta responsiva</title>";
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
</style>';

$contenid0 .= '</head>';
$contenid0 .= '<body';



    $RutaLogo = SERVIDOR."imgs/logo/Logo.png";
    $DataLogo = file_get_contents($RutaLogo);
    $baseLogo = 'data:image/;base64,' . base64_encode($DataLogo);


$contenid0 .= '<div>';

$contenid0 .= '<div class="text-center"><img src="'.$baseLogo.'" style="width: 250px;"></div>';

$sqlCR = "SELECT * FROM tb_requisicion_obra_carta_responsiva WHERE id = '".$GET_ID."' ";
$resultCR = mysqli_query($con, $sqlCR);
$rowCR = mysqli_fetch_array($resultCR, MYSQLI_ASSOC);
$dia = $rowCR['dia'];
$mes = $rowCR['mes'];
$year = $rowCR['year'];
$municipio = $rowCR['municipio'];
$estado = $rowCR['estado'];
$representante = $rowCR['representante_legal'];
$razonsocial = $rowCR['razon_social'];
$domicilio = $rowCR['domicilio'];
$apoderado = $rowCR['apoderado_legal'];
$firma = $rowCR['firma'];

$RutaFirma = RUTA_IMG_FIRMA_PERSONAL.$firma;
$DataFirma = file_get_contents($RutaFirma);
$baseFirma = 'data:image/;base64,' . base64_encode($DataFirma);

$contenid0 .= '<div class="text-right mt-3">'.$municipio.' '.$estado.', a '.$dia.' de '.nombremes($mes).' del '.$year.'</div>';
$contenid0 .= '<div class="text-right"><b>Asunto:</b> Carta responsiva</div>';
$contenid0 .= '<div style="margin-top: 50px"><b>A QUIEN CORRESPONDA.</b></div>';

$contenid0 .= '<div class="mt-3">Por este conducto le mando un cordial saludo, a su vez, '.$representante.', representante legal de '.$razonsocial.'.</div>';

$contenid0 .= '<div class="mt-2">Con domicilio en, '.$domicilio.'.</div>';

$contenid0 .= '<div class="mt-3">Doy mi responsivo total de los daños o perjuicios de riegos y aspectos ambientales presentados durante las actividades u operaciones derivadas de los contratistas, subcontratistas, prestadores de servicio y personal interno que labore dentro de la estación de servicio antes mencionada.</div>';

$contenid0 .= '<div class="mt-2">Por último, ratifico mi voluntad a efecto de cubrir con todas las obligaciones a cubrir.</div>';
$contenid0 .= '<div class="mt-2">Sirva la presente para todos los fines legales a que haya lugar.</div>';

$contenid0 .= '<div class="text-center" style="margin-top: 150px"><img src="'.$baseFirma.'" style="width: 120px;"></div>';
$contenid0 .= '<div class="text-center">'.$apoderado.'</div>';
$contenid0 .= '<div class="text-center"><b>Apoderado legal</b></div>';
$contenid0 .= '<div class="text-center">'.$razonsocial.'</div>';


$contenid0 .= '</div>';

$contenid0 .= '</body>';
$contenid0 .= '</html>';


$dompdf->loadHtml($contenid0);
// Colocamos als propiedades de la hoja
$dompdf->setPaper("A4", "portrait");
// Escribimos el html en el PDF
$dompdf->render();
// Ponemos el PDF en el browser
$dompdf->stream('Carta responsiva.pdf');
//------------------
mysqli_close($con);
//------------------