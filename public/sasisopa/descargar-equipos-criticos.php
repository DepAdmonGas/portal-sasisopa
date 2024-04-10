<?php
require_once 'dompdf/autoload.inc.php';
include_once "app/help.php";

use Dompdf\Dompdf;
// Inicializamos dompdf
$dompdf = new Dompdf();

$contenid0 .= '<head>';
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
</style>';
$contenid0 .= '</head>';
$contenid0 .= '<body>';


$RutaLogo = RUTA_IMG_LOGOS."Logo.png";
$DataLogo = file_get_contents($RutaLogo);
$baseLogo = 'data:image/png;base64,' . base64_encode($DataLogo);


$contenid0 .= '<div class="text-center"><img src="'.$baseLogo.'" style="width: 300px"></div>';
$contenid0 .= '<div class="text-center mt-3"><b>Lista de equipos críticos</b></div>';
$contenid0 .= '<div class="text-center mt-1"><b>'.$Session_Permisocre.'</b></div>';
$contenid0 .= '<div class="text-center mt-1">'.$Session_Razonsocial.'</div>';
$contenid0 .= '<div class="text-center mt-1"><small>'.$Session_Direccion.'</small></div>';
$contenid0 .= '<div class="text-center mt-1"><small>'.$Session_ApoderadoLegal.'</small></div>';


$sql_equipo = "SELECT * FROM tb_equipo_critico WHERE id_estacion = '".$Session_IDEstacion."' AND estado = 1 ORDER BY id_equipo desc";
$result_equipo = mysqli_query($con, $sql_equipo);
$numero_equipo = mysqli_num_rows($result_equipo);

$contenid0 .= '<table class="table table-bordered table-striped table-hover table-sm mt-3" style="font-size:.9em;">
<thead>
<tr>
<th class="text-center">#</th>  
<th>Nombre equipo</th>
<th>Marca y Modelo</th>
<th>Función</th>
<th>Fecha de instalación</th>
<th>Tiempo de vida</th>
</tr>
</thead>
<tbody>';

if ($numero_equipo > 0) {
while($row_equipo = mysqli_fetch_array($result_equipo, MYSQLI_ASSOC)){
$id = $row_equipo['id'];
$idequipo = $row_equipo['id_equipo'];
$nombreequipo = $row_equipo['nombre_equipo'];
$marcamodelo = $row_equipo['marca_modelo'];
$funciones = $row_equipo['funciones'];
$fechainstalacion = $row_equipo['fecha_instalacion'];
$tiempovida = $row_equipo['tiempo_vida'];
$manual = $row_equipo['manual'];

$contenid0 .= '<tr>
<td class="align-middle text-center">'.$idequipo.'</td>
<td class="align-middle">'.$nombreequipo.'</td>
<td class="align-middle">'.$marcamodelo.'</td>
<td class="align-middle">'.$funciones.'</td>
<td class="align-middle">'.FormatoFecha($fechainstalacion).'</td>
<td class="align-middle">'.$tiempovida.' años</td>
</tr>';

}
}else{
$contenid0 .= "<tr><td colspan='8' class='text-center'><small>No se encontró información para mostrar</small></td></tr>";  
}
 
$contenid0 .= '</tbody></table>';


$contenid0 .= '</body>';

$dompdf->loadHtml($contenid0);
$dompdf->setPaper("A4", "landscape");
$dompdf->render();
$canvas = $dompdf->get_canvas();
$canvas->page_text(768, 570, "Página: {PAGE_NUM} de {PAGE_COUNT}", null, 7, array(0, 0, 0));

$dompdf->stream('Lista de equipos críticos.pdf');

//------------------
mysqli_close($con);
//------------------
?>
