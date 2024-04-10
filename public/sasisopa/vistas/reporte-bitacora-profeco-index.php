<?php
require_once 'dompdf/autoload.inc.php';
include_once "app/help.php";

use Dompdf\Dompdf;
$dompdf = new Dompdf();

if($selmes == 'x'){
$Mes = '';
}else{
$Mes = 'AND MONTH(tb_dispensarios_apertura_bitacora.fecha) ='.$selmes;  
}

$sql_lista = "SELECT 
tb_dispensarios_apertura_bitacora.id,
tb_dispensarios.id_estacion, 
tb_dispensarios.no_dispensario,
tb_dispensarios.marca,
tb_dispensarios.modelo,
tb_dispensarios.serie,
tb_dispensarios_apertura_bitacora.fecha,
tb_dispensarios_apertura_bitacora.hora_inicio,
tb_dispensarios_apertura_bitacora.hora_termino,
tb_dispensarios_apertura_bitacora.lado,
tb_dispensarios_apertura_bitacora.producto,
tb_dispensarios_apertura_bitacora.clave,
tb_dispensarios_apertura_bitacora.motivo,
tb_usuarios.nombre,
tb_dispensarios_apertura_bitacora.detalle
FROM tb_dispensarios_apertura_bitacora 
INNER JOIN tb_dispensarios 
ON tb_dispensarios_apertura_bitacora.id_dispensario = tb_dispensarios.id 
INNER JOIN tb_usuarios
ON tb_dispensarios_apertura_bitacora.responsable = tb_usuarios.id
WHERE id_estacion = '".$Session_IDEstacion."' $Mes AND YEAR(tb_dispensarios_apertura_bitacora.fecha) = '".$selyear."' ORDER BY tb_dispensarios_apertura_bitacora.fecha desc , tb_dispensarios_apertura_bitacora.hora_inicio desc ";
$result_lista = mysqli_query($con, $sql_lista);
$numero_lista = mysqli_num_rows($result_lista);

    $contenid0 .= "<!DOCTYPE html>";
    $contenid0 .= "<html>";
    $contenid0 .= "<head>";
    $contenid0 .= "<title>BITÁCORA DE REGISTRO DE EVENTOS PROFECO</title>";
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

.table-danger,
.table-danger > th,
.table-danger > td {
  background-color: #f5c6cb;
}

</style>';
    $contenid0 .= "</head>";
    $contenid0 .= "<body";

    $RutaLogo = RUTA_IMG_LOGOS."Logo.png";
    $DataLogo = file_get_contents($RutaLogo);
    $baseLogo = 'data:image/' . $type . ';base64,' . base64_encode($DataLogo);

    $contenid0 .= '<div class="text-center"><img src="'.$baseLogo.'" style="width: 300px;">';
    $contenid0 .= '<div class="text-center mt-1"><b>BITÁCORA DE REGISTRO DE EVENTOS
PROFECO</b></div>';
    $contenid0 .= '<div class="text-center mt-1"><b> De acuerdo a la norma NOM-005-SCFI-2017 y NOM-185-SCFI-2017 </b></div>';
    $contenid0 .= '<div class="text-center mt-1"><b>'.$Session_Permisocre.'</b></div>';
    $contenid0 .= '<div class="text-center mt-1">'.$Session_Razonsocial.'</div>';
    $contenid0 .= '<div class="text-center mt-1"><small>'.$Session_Direccion.'</small></div>';

$contenid0 .= '<table class="table table-bordered table-sm" style="font-size: .5em;margin-top: 10px;">';
$contenid0 .= '<thead>';	
$contenid0 .= '<tr>';
$contenid0 .= '<th class="text-center align-middle">Fecha</th>';
$contenid0 .= '<th class="text-center align-middle">Hora</th>';
$contenid0 .= '<th class="text-center align-middle">Marca</th>';
$contenid0 .= '<th class="text-center align-middle">Modelo</th>';
$contenid0 .= '<th class="text-center align-middle">Serie</th>';
$contenid0 .= '<th class="text-center align-middle">Lado</th>';
$contenid0 .= '<th class="text-center align-middle">Producto</th>';
$contenid0 .= '<th class="text-center align-middle">Motivo</th>';
$contenid0 .= '<th class="text-center align-middle">Responsable</th>';
$contenid0 .= '<th class="text-center align-middle">Detalle</th>';
$contenid0 .= '</tr>';
$contenid0 .= '</thead>';
$contenid0 .= '<tbody>';
if ($numero_lista > 0) {
while($row_lista = mysqli_fetch_array($result_lista, MYSQLI_ASSOC)){

$contenid0 .= '<tr>';
$contenid0 .= '<td class="text-center align-middle">'.FormatoFecha($row_lista['fecha']).'</td>';
$contenid0 .= '<td class="text-center align-middle">'.date('h:i a', strtotime($row_lista['hora'])).'</td>';
$contenid0 .= '<td class="text-center align-middle">'.$row_lista['marca'].'</td>';
$contenid0 .= '<td class="text-center align-middle">'.$row_lista['modelo'].'</td>';
$contenid0 .= '<td class="text-center align-middle">'.$row_lista['serie'].'</td>';
$contenid0 .= '<td class="text-center align-middle">'.$row_lista['lado'].'</td>';
$contenid0 .= '<td class="text-center align-middle">'.$row_lista['producto'].'</td>';
$contenid0 .= '<td class="text-center align-middle">'.$row_lista['clave'].' ('.$row_lista['motivo'].')</td>';
$contenid0 .= '<td class="text-center align-middle">'.$row_lista['nombre'].'</td>';
$contenid0 .= '<td class="text-center align-middle">'.$row_lista['detalle'].'</td>';
$contenid0 .= '</tr>';

    }
}else{
$contenid0 .= "<tr><td colspan='12' class='text-center text-secondary' style='font-size: .8em;'>No se encontró información para mostrar</td></tr>";
}

$contenid0 .= '</tbody>';
$contenid0 .= '</table>';

	$contenid0 .= "</body>";
	$contenid0 .= "</html>";


$dompdf->loadHtml($contenid0);
// Colocamos als propiedades de la hoja
$dompdf->setPaper("A4", "landscape");
// Escribimos el html en el PDF
$dompdf->render();
$canvas = $dompdf->get_canvas();
$canvas->page_text(515, 810, "Pagina: {PAGE_NUM} de {PAGE_COUNT}", null, 8, array(0, 0, 0));
// Ponemos el PDF en el browser
$dompdf->stream('Reporte-Bitacora-PROFECO.pdf');
//------------------
mysqli_close($con);
//------------------