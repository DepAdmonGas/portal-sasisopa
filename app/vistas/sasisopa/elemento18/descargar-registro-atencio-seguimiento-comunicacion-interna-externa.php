<?php
require_once 'dompdf/autoload.inc.php';
include_once "app/help.php";

$sql_resultado = "SELECT * FROM tb_implementacion_sasisopa_procedimientos WHERE id_reporte = '".$GET_ID."' ";
$result_resultado = mysqli_query($con, $sql_resultado);
$numero_resultado = mysqli_num_rows($result_resultado);

use Dompdf\Dompdf;
$dompdf = new Dompdf();

    $contenid0 = "";
    $contenid0 .= "<!DOCTYPE html>";
    $contenid0 .= "<html>";
    $contenid0 .= "<head>";
    $contenid0 .= "<title>Registro de la atención y el seguimiento a la comunicación interna y externa</title>";
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
$contenid0 .= '<b>Control de la implementación de los procedimientos del SASISOPA.</b>';
$contenid0 .= '</td>';
$contenid0 .= '<td class="align-middle text-center">';
$contenid0 .= '<b>Fo.ADMONGAS.029</b>';
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

$contenid0 .= '<table class="table table-bordered table-sm" style="font-size: .9em;">
  <thead>
   <tr>
     <th class="text-center align-middle">Fecha de implementación</th>
     <th class="text-center align-middle">Nombre del procedimiento</th>
     <th class="text-center align-middle">Breve descripción de la implementación </th>
     <th class="text-center align-middle">Se dio a conocer la implementación
      <div><label class="border-right pr-3 pl-2">Si</label> <label class="pl-2 pr-2">No</label></div>
    </th>
    <th class="text-center align-middle">Puestos de personal enterados de la implementación</th>
    <th class="text-center align-middle">Observaciones</th>
   </tr>
   </thead>
   <tbody style="font-size: .9em">';

   
    while($row_resultado = mysqli_fetch_array($result_resultado, MYSQLI_ASSOC)){

      $id = $row_resultado['id'];

      $contenid0 .= "<tr>";
      $contenid0 .= "<td class='text-center align-middle'>".FormatoFecha($row_resultado['fecha_implementacion'])."</td>";
      $contenid0 .= "<td class='align-middle'><b>".$row_resultado['procedimiento']."</b></td>";
      $contenid0 .= "<td class='align-middle'>".$row_resultado['descripcion']."</td>";  
      $contenid0 .= "<td class='text-center align-middle'>".$row_resultado['informacion']."</td>";
      $contenid0 .= "<td class='align-middle'>";
      $cont = 1;

      $sql_ch = "SELECT * FROM tb_implementacion_sasisopa_procedimientos_puesto WHERE id_reporte = '".$id."'";
      $result_ch = mysqli_query($con, $sql_ch);
      $numero_ch = mysqli_num_rows($result_ch);

      while($row_ch = mysqli_fetch_array($result_ch, MYSQLI_ASSOC)){

      if($cont < $numero_ch ){
      $Sep = ', ';
      }else{
      $Sep = '';
      }

      $contenid0 .= "<span style='font-size: .7em;'>".$row_ch['puesto']."</span>".$Sep;

      $cont++;
      }
      $contenid0 .= "</td>";
      $contenid0 .= "<td class='align-middle'>".$row_resultado['observaciones']."</td>";
      $contenid0 .= "</tr>";

    }

$contenid0 .= '</tbody></table>';

$contenid0 .= "</body>";
$contenid0 .= "</html>";


$dompdf->loadHtml($contenid0);
$dompdf->setPaper("A4", "landscape");
$dompdf->render();
$canvas = $dompdf->get_canvas();
$canvas->page_text(768, 570, "Página: {PAGE_NUM} de {PAGE_COUNT}", null, 7, array(0, 0, 0));

$dompdf->stream('Control de la implementación de los procedimientos del SASISOPA.pdf');

//------------------
mysqli_close($con);
//------------------
?>


