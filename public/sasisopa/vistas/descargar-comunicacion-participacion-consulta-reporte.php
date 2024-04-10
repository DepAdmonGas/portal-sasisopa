<?php
require_once 'dompdf/autoload.inc.php';
include_once "app/help.php";

use Dompdf\Dompdf;
$dompdf = new Dompdf();

function BuscarFirma($usuario,$con){
$sql = "SELECT firma FROM tb_usuarios WHERE nombre = '".$usuario."' ORDER BY id DESC LIMIT 1 ";
$result = mysqli_query($con, $sql);
$numero = mysqli_num_rows($result);
while($row = mysqli_fetch_array($result, MYSQLI_ASSOC)){ 
$Firma = $row['firma'];
}
return $Firma;
}

    $RutaLogo = SERVIDOR."imgs/logo/Logo.png";
    $DataLogo = file_get_contents($RutaLogo);
    $baseLogo = 'data:image/;base64,' . base64_encode($DataLogo);


    $contenid0 .= "<!DOCTYPE html>";
    $contenid0 .= "<html>";
    $contenid0 .= "<head>";
    $contenid0 .= "<title>Registro de la atención y el seguimiento a la comunicación interna y externa.</title>";
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
  margin-bottom: 20px;
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
hr {
    margin: 1rem 0;
    color: inherit;
    background-color: #565656;
    border: 0;
    opacity: 0.80;
  }
</style>';

$contenid0 .= '</head>';
$contenid0 .= '<body';


$contenid0 .= '<div>';

$contenid0 .= '<table class="table table-bordered" style="font-size: .9em;">';
$contenid0 .= '<tbody>';
$contenid0 .= '<tr>';

$contenid0 .= '<td class="align-middle text-center">';
$contenid0 .= "<img src='".$baseLogo."' style='width: 150px;'>";
$contenid0 .= '</td>';
$contenid0 .= '<td colspan="2" class="align-middle text-center">';
$contenid0 .= '<b>Registro de la atención y el seguimiento a la comunicación interna y externa.</b>';
$contenid0 .= '</td>';
$contenid0 .= '<td class="align-middle text-center">';
$contenid0 .= '<b>Fo.ADMONGAS.010</b>';
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
$contenid0 .= 'Fecha de aprobacion:<br>  28-09-2020';
$contenid0 .= '</td>';
$contenid0 .= '</tr>';
            

$contenid0 .= '</tbody>';
$contenid0 .= '</table>';
//-----------------------------------------------------------------

if($GET_idYear == 'X' && $GET_idEstacion == 'X'){
    $Query = "id = '".$GET_idRegistro."' ";
    }else if($GET_idYear == 'X' && $GET_idRegistro == 'X'){
    $Query = "id_estacion = '".$GET_idEstacion."' ORDER BY no_comunicacion desc ";
    }else if($GET_idYear != 'X' && $GET_idEstacion != 'X'){
    $Query = " id_estacion = '".$GET_idEstacion."' AND YEAR(fecha) = '".$GET_idYear."' ORDER BY no_comunicacion desc "; 
    }else if($GET_idYear != 'X' && $GET_idRegistro != 'X'){
    $Query = "id = '".$GET_idRegistro."' ";
    }


$sql_comunicado = "SELECT * FROM se_comunicacion_i_e WHERE $Query ";
$result_comunicado = mysqli_query($con, $sql_comunicado);
$numero_comunicado = mysqli_num_rows($result_comunicado);
if($numero_comunicado  > 0){
while($row_comunicado = mysqli_fetch_array($result_comunicado, MYSQLI_ASSOC)){
$tipocomunicacion = $row_comunicado['tipo_comunicacion'];
$material = $row_comunicado['material'];
$seguimiento = $row_comunicado['seguimiento'];
$id = $row_comunicado['id'];
$asistencia = $row_comunicado['asistencia'];
$No = $row_comunicado['no_comunicacion'];
$fecha = $row_comunicado['fecha'];
$tema = $row_comunicado['tema'];

$sql_usuario = "SELECT nombre FROM tb_usuarios WHERE id = '".$row_comunicado['encargado_comunicacion']."' ";
$result_usuario = mysqli_query($con, $sql_usuario);
while($row_usuario = mysqli_fetch_array($result_usuario, MYSQLI_ASSOC)){
$nomencargado = $row_usuario['nombre'];
}

if($asistencia != 0){
$sql = "SELECT * FROM tb_lista_asistencia WHERE id = '".$asistencia."' ";
$result = mysqli_query($con, $sql);
$numero = mysqli_num_rows($result);
while($row = mysqli_fetch_array($result, MYSQLI_ASSOC)){
$hora = date('g:i a', strtotime($row['hora']));
$lugar = $row['lugar'];
$finalidad = $row['finalidad'];
}
}else{
    $hora = 'S/I';
    $lugar = 'S/I';
    $finalidad = 'S/I';
}

$contenid0 .= '<table class="table table-bordered" style="font-size: .9em;">';
$contenid0 .= '<tbody>';

$contenid0 .= '<tr>';
$contenid0 .= '<td class="align-middle text-center">';
$contenid0 .= 'No. '.$No;
$contenid0 .= '</td>';
$contenid0 .= '<td class="align-middle text-center">';
$contenid0 .= 'Fecha: '.FormatoFecha($fecha);
$contenid0 .= '</td>';
$contenid0 .= '<td class="align-middle text-center">';
$contenid0 .= 'Hora: '.$hora;
$contenid0 .= '</td>';
$contenid0 .= '<td class="align-middle text-center">';
$contenid0 .= 'Lugar: '.$lugar;
$contenid0 .= '</td>';
$contenid0 .= '</tr>';

$contenid0 .= '<tr>';
$contenid0 .= '<td class="align-middle" colspan="4">';
$contenid0 .= '<b>Tema a cominicar:</b> '.$tema;
$contenid0 .= '</td>';
$contenid0 .= '</tr>';

$contenid0 .= '<tr>';
$contenid0 .= '<td class="align-middle" colspan="4">';
$contenid0 .= '<b>Finalidad de la comunicación:</b> '.$finalidad;
$contenid0 .= '</td>';
$contenid0 .= '</tr>';

$contenid0 .= '<tr>';
$contenid0 .= '<td class="align-middle" colspan="4">';
$contenid0 .= '<b>Encargado de la comunicación:</b> '.$nomencargado;
$contenid0 .= '</td>';
$contenid0 .= '</tr>';

$contenid0 .= '<tr>';
$contenid0 .= '<td class="align-middle" colspan="4">';
$contenid0 .= '<b>Tipo de comunicación:</b> '.$tipocomunicacion;
$contenid0 .= '</td>';
$contenid0 .= '</tr>';

$contenid0 .= '<tr>';
$contenid0 .= '<td class="align-middle" colspan="4">';
$contenid0 .= '<b>Material utilizado para la comunicación:</b> '.$material;
$contenid0 .= '</td>';
$contenid0 .= '</tr>';

$contenid0 .= '<tr>';
$contenid0 .= '<td class="align-middle" colspan="4">';
$contenid0 .= '<b>Seguimiento de la comunicación:</b> '.$seguimiento;
$contenid0 .= '</td>';
$contenid0 .= '</tr>';


$contenid0 .= '</tbody>';
$contenid0 .= '</table>';

//----------------------------------------------------------------------------------------------------------
if($asistencia != 0){
$sql_lista = "SELECT * FROM tb_lista_asistencia_detalle WHERE id_lista_asistencia = '".$asistencia."' ";
$result_lista = mysqli_query($con, $sql_lista);
$numero_lista = mysqli_num_rows($result_lista);

$contenid0 .= '<table class="table table-bordered" style="font-size: .9em;">';
$contenid0 .= '<tbody>';
$contenid0 .= '<tr>';
$contenid0 .= '<td class="align-middle text-center"><b>Nombre</b></td> <td class="align-middle text-center"><b>Puesto</b></td> <td class="align-middle text-center"><b>Firma</b></td>';
$contenid0 .= '</tr>';
while($row_lista = mysqli_fetch_array($result_lista, MYSQLI_ASSOC)){

$Firma = BuscarFirma($row_lista['usuario'],$con);

  $RutaFirma = RUTA_IMG_FIRMA_PERSONAL.$Firma;
  $DataFirma = file_get_contents($RutaFirma);
  $baseFirma = 'data:image/png;base64,' . base64_encode($DataFirma);

$contenid0 .= '<tr>';
$contenid0 .= '<td class="align-middle text-center">';
$contenid0 .= $row_lista['usuario'];
$contenid0 .= '</td>';

$contenid0 .= '<td class="align-middle text-center">';
$contenid0 .= $row_lista['puesto'];
$contenid0 .= '</td>';

$contenid0 .= '<td class="align-middle text-center">';
$contenid0 .= '<img src="'.$baseFirma.'" style="width: 50px;">';
$contenid0 .= '</td>';
$contenid0 .= '</tr>';

}
$contenid0 .= '</tbody>';
$contenid0 .= '</table>';
}

$contenid0 .= '<div style="margin-top: 10px;margin-bottom: 10px;"> <hr> </div>';

}
}
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
$dompdf->stream('Registro de la atención y el seguimiento a la comunicación interna y externa.pdf');
//------------------
mysqli_close($con);
//------------------