<?php
set_time_limit(32000);
ini_set('max_execution_time', 32000);

require_once '../../../../dompdf/autoload.inc.php';
include_once "../../../../app/help.php";
include_once "../../../../app/modelo/Cursos.php";

$class_cursos = new Cursos();

$Year = $_GET['Year'];
$idModulo = $_GET['idModulo'];

use Dompdf\Dompdf;
$dompdf = new Dompdf();

    $contenid0 = "";
    $contenid0 .= "<!DOCTYPE html>";
    $contenid0 .= "<html>";
    $contenid0 .= "<head>";
    $contenid0 .= "<title>Capacitación externa</title>";
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

.mt-2,
.my-2 {
  margin-top: 0.5rem !important;
}

.bg-primary {
  background-color: #007bff !important;
}
h5, .h5 {
  font-size: 1.20rem;
}
h6, .h6 {
  font-size: 0.9rem;
}
.bg-info {
  background-color: #17a2b8 !important;
}
.bg-light {
  background-color: #f8f9fa !important;
}
.p-2 {
  padding: 0.5rem !important;
}
.text-success {
  color: #28a745 !important;
}
.text-primary {
  color: #007bff !important;
}
.text-warning {
  color: #ffc107 !important;
}
.text-danger {
  color: #dc3545 !important;
}

.text-white {
  color: #fff !important;
}
</style>';

$contenid0 .= '</head>';
$contenid0 .= '<body';

$contenid0 .= '<div>';
$RutaLogo = SERVIDOR."imgs/logo/Logo.png";
$DataLogo = file_get_contents($RutaLogo);
$baseLogo = 'data:image/;base64,' . base64_encode($DataLogo);


$contenid0 .= '<table class="table table-bordered">';
$contenid0 .= '<tbody>';
$contenid0 .= '<tr>';

$contenid0 .= '<td class="align-middle text-center">';
$contenid0 .= '<img src="'.$baseLogo.'" style="width: 150px;">';
$contenid0 .= '</td>';
$contenid0 .= '<td colspan="2" class="align-middle text-center">';
$contenid0 .= '<b>Programa de Capacitacion y adiestramiento</b>';
$contenid0 .= '</td>';
$contenid0 .= '<td class="align-middle text-center">';
$contenid0 .= '<b>Fo.ADMONGAS.009</b>';
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
$contenid0 .= 'Fecha de autorizacion 01/10/2018';
$contenid0 .= '</td>';
$contenid0 .= '</tr>';            
$contenid0 .= '</tbody>';
$contenid0 .= '</table>';

$sql_modulos_cursos = "SELECT num_modulo, titulo, id FROM tb_cursos_modulos WHERE id = '".$idModulo."' ORDER BY num_modulo ASC"; 
$result_modulos_cursos = mysqli_query($con, $sql_modulos_cursos);
$numero_modulos_cursos  = mysqli_num_rows($result_modulos_cursos);
while($row_modulos_cursos = mysqli_fetch_array($result_modulos_cursos, MYSQLI_ASSOC)){

$contenid0 .= '<div class="bg-info text-white" style="padding: 5px;margin-top: 7px;"><b>'.$row_modulos_cursos['num_modulo'].'. '.$row_modulos_cursos['titulo'].'</b></div>';

$sql = "SELECT id, num_tema, titulo FROM tb_cursos_temas WHERE id_modulo = '".$row_modulos_cursos['id']."' ORDER BY num_tema ASC"; 
$result = mysqli_query($con, $sql);
$numero  = mysqli_num_rows($result);
while($row = mysqli_fetch_array($result, MYSQLI_ASSOC)){

$contenid0 .= '<div class="bg-light" style="padding: 5px;margin-top: 7px;margin-bottom: 7px;"><b>'.$row['num_tema'].'. '.$row['titulo'].'</b></div>';

$contenid0 .= '<table class="table table-bordered table-striped table-hover table-sm" style="font-size: .70em;">
<thead>
<tr>
  <th class="text-center">No</th>
  <th class="text-center">Nombre Usuario</th>
  <th class="text-center">Puesto</th>
  <th class="text-center">Fecha Programada</th>
  <th class="text-center">Resultado</th>
</tr>
</thead>
<tbody>';

$sql_usuarios = "SELECT id, nombre, usuario, id_puesto FROM tb_usuarios WHERE id_gas = '".$Session_IDEstacion."' and id_puesto <> 1 and estatus = 0 ";
$result_usuarios = mysqli_query($con, $sql_usuarios);
$numero_usuarios = mysqli_num_rows($result_usuarios);
$num = 1;
while($row_usuarios = mysqli_fetch_array($result_usuarios, MYSQLI_ASSOC)){
$idusuario = $row_usuarios['id'];
$nombreusuario = $row_usuarios['nombre'];
$usuario = $row_usuarios['usuario'];
$idpuesto = $row_usuarios['id_puesto'];


$FechaProgramada = $class_cursos->FechaProgramada($idusuario,$row['id'],$Year);

$estadoModulo = $FechaProgramada['estado'];
$puntos      =  $FechaProgramada['resultado'];

if ($estadoModulo == 1) {
$calificacion = $puntos;

if($calificacion >= 90 && $calificacion <= 100){
$title = "<b class='text-success'>".$calificacion."% Excelente</b>";
}else if($calificacion >= 80 && $calificacion <= 89){
$title = "<b class='text-primary'>".$calificacion."% Bueno</b>";
}else if($calificacion >= 60 && $calificacion <= 79){
$title = "<b class='text-warning'>".$calificacion."% Regular</b>";
}else{
$title = "<b class='text-danger'>".$calificacion."% Malo</b>";
}

}else{
$title = "<b>Pendiente</b>";
}



$sql_puesto = "SELECT tipo_puesto FROM tb_puestos WHERE id = '$idpuesto' ";
$result_puesto = mysqli_query($con, $sql_puesto);
$numero_puesto = mysqli_num_rows($result_puesto);
while($row_puesto = mysqli_fetch_array($result_puesto, MYSQLI_ASSOC)){
$puesto = $row_puesto['tipo_puesto'];
}

$contenid0 .= "<tr>";
$contenid0 .= "<td class='text-center'>".$num."</td>";
$contenid0 .= "<td>".$nombreusuario."</td>";
$contenid0 .= "<td class='text-center'>".$puesto."</td>";
$contenid0 .= "<td class='text-center'>".$FechaProgramada['fechaprogramada']."</td>";
$contenid0 .= "<td class='text-center'>".$title."</td>";
$contenid0 .= "</tr>";

$num++;
}

$contenid0 .= '</tbody>
</table>';

}

}
$contenid0 .= '</div>';

$contenid0 .= '</body>';
$contenid0 .= '</html>';


$dompdf->loadHtml($contenid0);
// Colocamos als propiedades de la hoja
$dompdf->setPaper("A4", "portrait");
// Escribimos el html en el PDF
$dompdf->render();
//$dompdf->get_canvas()->page_text(750, 570, "Pagina: {PAGE_NUM} de {PAGE_COUNT}", $font, 8, array(0,0,0));
// Ponemos el PDF en el browser
$dompdf->stream('Capacitación interna.pdf');
