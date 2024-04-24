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
    $contenid0 .= "<title>Control y documentos de Requisitos Legales</title>";
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

.p-2 {
    padding: .6rem !important;
  }
.p-3 {
  padding: 1rem !important;
}

.mb-3,
.my-3 {
  margin-bottom: 1rem !important;
}
.bg-primary {
  background-color: #007bff;
}
.text-white {
  color: #fff !important;
}
.bg-light {
  background-color: #f8f9fa !important;
}
.text-center{
    text-aling: center;
}
</style>';

$contenid0 .= '</head>';
$contenid0 .= '<body';

$contenid0 .= '<div class="p-2 bg-primary text-white text-center">Nivel de gobierno <b>Municipal</b></div>';
$contenid0 .= '<div style="font-size: .9em">'.$class_requisito_legal->RequisitosLegales($Session_IDEstacion,'municipal').'</div>';
$contenid0 .= '<div class="p-2 bg-primary text-white text-center">Nivel de gobierno <b>Federal</b></div>';
$contenid0 .= '<div style="font-size: .9em">'.$class_requisito_legal->RequisitosLegales($Session_IDEstacion,'federal').'</div>';
$contenid0 .= '<div class="p-2 bg-primary text-white text-center">Nivel de gobierno <b>Estatal</b></div>';
$contenid0 .= '<div style="font-size: .9em">'.$class_requisito_legal->RequisitosLegales($Session_IDEstacion,'estatal').'</div>';
$contenid0 .= '<div class="p-2 bg-primary text-white text-center">Nivel de gobierno <b>Varios</b></div>';
$contenid0 .= '<div style="font-size: .9em">'.$class_requisito_legal->RequisitosLegales($Session_IDEstacion,'varios').'</div>';


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
$dompdf->stream('Control y documentos de Requisitos Legales.pdf',["Attachment" => true]);
