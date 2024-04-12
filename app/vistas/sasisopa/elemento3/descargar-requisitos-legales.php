<?php
include_once "app/help.php";
require_once 'dompdf/autoload.inc.php';
include_once "app/modelo/RequisitoLegal.php";
$class_requisito_legal = new RequisitoLegal();

use Dompdf\Dompdf;
$dompdf = new Dompdf();

    $contenid0 = "";
    $contenid0 .= "<!DOCTYPE html>";
    $contenid0 .= "<html>";
    $contenid0 .= "<head>";
    $contenid0 .= "<title>Reporte de Requisitos Legales</title>";
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

article, aside, dialog, figcaption, figure, footer, header, hgroup, main, nav, section {
  display: block;
}
body {
  margin: 0;
  font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, "Helvetica Neue", Arial, sans-serif, "Apple Color Emoji", "Segoe UI Emoji", "Segoe UI Symbol";
  font-size: 1rem;
  font-weight: 400;
  line-height: 1.5;
  color: #212529;
  text-align: left;
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
table {
  border-collapse: collapse;
}
.table {
  width: 100%;
  max-width: 100%;
  margin-bottom: 1rem;
  background-color: transparent;
}

.table th,
.table td {
  padding: 0.75rem;
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
  padding: 0.3rem;
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
  padding: 0.3rem;
}
.align-middle {
  vertical-align: middle !important;
}
small {
  font-size: 80%;
}
.table-active,
.table-active > th,
.table-active > td {
  background-color: rgba(0, 0, 0, 0.075);
}

.table thead th {
  vertical-align: bottom;
  border-bottom: 2px solid #dee2e6;
}

.table tbody + tbody {
  border-top: 2px solid #dee2e6;
}

img {
  vertical-align: middle;
  border-style: none;
}

.table-success,
.table-success > th,
.table-success > td {
  background-color: #c3e6cb;
}

.table-info,
.table-info > th,
.table-info > td {
  background-color: #bee5eb;
}
</style>';
$contenid0 .= "</head>";
$contenid0 .= "<body>";

$RutaLogo = SERVIDOR."imgs/logo/Logo.png";
$DataLogo = file_get_contents($RutaLogo);
$baseLogo = 'data:image/png;base64,' . base64_encode($DataLogo);

$contenid0 .= '<table class="table table-bordered" style="font-size: .8em;">';
$contenid0 .= '<tbody>';
$contenid0 .= '<tr>';

$contenid0 .= '<td class="align-middle text-center">';
$contenid0 .= '<img src="'.$baseLogo.'" style="width: 150px;">';
$contenid0 .= '</td>';
$contenid0 .= '<td colspan="2" class="align-middle text-center">';
$contenid0 .= '<b>Calendario anual de renovacion de Requisitos Legales</b>';
$contenid0 .= '</td>';
$contenid0 .= '<td class="align-middle text-center">';
$contenid0 .= '<b>Fo.ADMONGAS.004</b>';
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
$contenid0 .= 'Fecha de aprobacion:<br>  01-Oct-2018';
$contenid0 .= '</td>';
$contenid0 .= '</tr>';
            

$contenid0 .= '</tbody>';
$contenid0 .= '</table>';
//-----------------------------------------------------------------

$contenid0 .= "<table class='table-bordered table-sm mt-4' style='font-size: .7em;' width='100%'>";

$contenid0 .= "<tr class='table-active'>";
$contenid0 .= "<td class='text-center align-middle'><b>Dependencia</b></td>";
$contenid0 .= "<td class='text-center align-middle'><b>Permiso</b></td>";
$contenid0 .= "<td class='text-center align-middle'><b>Vigencia</b></td>";
$contenid0 .= "<td class='text-center align-middle'><b>Fecha emisión</b></td>";
$contenid0 .= "<td class='text-center align-middle'><b>Fecha vencimiento</b></td>";
$contenid0 .= "<td class='text-center align-middle'><b>Renovación</b></td>";
$contenid0 .= "</tr>";

$contenid0 .= $class_requisito_legal->NivelGobierno('Municipal',$Session_IDEstacion);
$contenid0 .= $class_requisito_legal->NivelGobierno('Estatal',$Session_IDEstacion,$con);
$contenid0 .= $class_requisito_legal->NivelGobierno('Federal',$Session_IDEstacion,$con);
$contenid0 .= $class_requisito_legal->NivelGobierno('Varios',$Session_IDEstacion,$con);

$contenid0 .= "</table>";

$contenid0 .= "</body>";
$contenid0 .= "</html>";

$dompdf->loadHtml($contenid0);
$dompdf->setPaper("A4", "landscape");
$dompdf->render();
$canvas = $dompdf->get_canvas();
$canvas->page_text(768, 570, "Página: {PAGE_NUM} de {PAGE_COUNT}", null, 7, array(0, 0, 0));
$dompdf->stream('RequisitosLegales.pdf');

?>


