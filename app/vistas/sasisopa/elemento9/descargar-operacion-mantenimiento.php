<?php
require_once 'dompdf/autoload.inc.php';
include_once "app/help.php";

use Dompdf\Dompdf;
$dompdf = new Dompdf();

    $contenid0 = "";
    $contenid0 .= "<!DOCTYPE html>";
    $contenid0 .= "<html>";
    $contenid0 .= "<head>";
    $contenid0 .= "<title>Operación y Mantenimiento</title>";
    $contenid0 .= '<style type="text/css">
@page {margin: 0.5cm 1cm; font-family: Arial, Helvetica, sans-serif;}
*,
*::before,
*::after {
  box-sizing: border-box;
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
h5, .h5 {
  font-size: 1.25rem;
}
.text-center {
  text-align: center !important;
}
.bg-light {
  background-color: #f8f9fa !important;
}
</style>';

$contenid0 .= '</head>';
$contenid0 .= '<body';

$contenid0 .= '<div>';
$contenid0 .= '<h5 class="text-center">Operación y Mantenimiento</h5>';

$contenid0 .= '<table class="table table-sm table-bordered" style="font-size: .80rem">';
$contenid0 .= '<tr>';
$contenid0 .= '<td class="align-middle bg-light text-center" style="padding: 15px;"><b>#</b></td>';
$contenid0 .= '<td class="align-middle bg-light text-center"><b>Fecha</b></th>';
$contenid0 .= '<td class="align-middle bg-light text-center"><b>Norma</b></th>';
$contenid0 .= '<td class="align-middle bg-light text-center"><b>Nombre</b></th>';
$contenid0 .= '<td class="align-middle bg-light text-center"><b>Link</b></th>';
$contenid0 .= '</tr>';
$contenid0 .= '<tbody>';

$i = 1;

$sql = "SELECT * FROM tb_operacion_mantenimiento WHERE (estado = '".$Session_IDEstacion."' OR estado = 0) ";
$result = mysqli_query($con, $sql);
$numero = mysqli_num_rows($result);

while($row = mysqli_fetch_array($result, MYSQLI_ASSOC)){

$contenid0 .=  "<tr>"; 
$contenid0 .=  "<td class='text-center align-middle'>".$i."</td>";
$contenid0 .=  "<td class='text-center align-middle'>".FormatoFecha($row['fecha'])."</td>";
$contenid0 .=  "<td class='text-center align-middle'>".$row['norma']."</td>";
$contenid0 .=  "<td class='text-center align-middle'>".$row['nombre']."</td>";
$contenid0 .=  "<td class='text-center align-middle'>
<div><a style='width: 100%;height:20px;' href='".$row['link']."' target='_blank' >Link</a></div>
</td>";
$contenid0 .=  "</tr>";

$i++;
}

$contenid0 .= '</tbody>';
$contenid0 .= '</table>';

//-----------------------------------------------------------------

$contenid0 .= '</div>';
$contenid0 .= '</body>';
$contenid0 .= '</html>';

$dompdf->loadHtml($contenid0);
// Colocamos als propiedades de la hoja
$dompdf->setPaper("A4", "portrait");
// Escribimos el html en el PDF
$dompdf->render();
$canvas = $dompdf->get_canvas();
$canvas->page_text(525, 810, "Página: {PAGE_NUM} de {PAGE_COUNT}", null, 7, array(0, 0, 0));

// Ponemos el PDF en el browser
$dompdf->stream('Operación y Mantenimiento.pdf',["Attachment" => true]);

//------------------
mysqli_close($con);
//------------------