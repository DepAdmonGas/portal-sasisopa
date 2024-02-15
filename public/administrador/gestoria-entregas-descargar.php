<?php
require_once 'dompdf/autoload.inc.php';
include_once "app/help.php";


use Dompdf\Dompdf;
$dompdf = new Dompdf();

    $contenid0 .= "<!DOCTYPE html>";
    $contenid0 .= "<html>";
    $contenid0 .= "<head>";
    $contenid0 .= "<title>Formato entregas</title>";
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
  font-size: .9em;
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
.p-2 {
  padding: 0.5rem !important;
}

.mb-3,
.my-3 {
  margin-bottom: 1rem !important;
}
.text-right {
    text-align: right !important;
  }
</style>';

function Estacion($razonsocial, $con){
    $sql = "SELECT permisocre,razonsocial,direccioncompleta FROM tb_estaciones WHERE razonsocial = '".$razonsocial."'";
    $result = mysqli_query($con, $sql);
    $numero = mysqli_num_rows($result);
    while($row = mysqli_fetch_array($result, MYSQLI_ASSOC)){
    $razonsocial = $row['razonsocial'];
    $direccion = $row['direccioncompleta'];
    }
     $return = array('razonsocial' => $razonsocial, 'direccion' => $direccion);
    return $return;
    }

$sql = "SELECT * FROM tb_entregas WHERE id = '".$GET_ID."' ";
$result = mysqli_query($con, $sql);
$numero = mysqli_num_rows($result);
while($row = mysqli_fetch_array($result, MYSQLI_ASSOC)){
$razonsocial = $row['estacion'];
$Estacion = Estacion($razonsocial, $con);
$direccion = $Estacion['direccion'];
$destinatario = $row['destinatario'];
$fecha = $row['fecha'];
$estatus = $row['estatus'];
}

$sqlED = "SELECT * FROM tb_entregas_finalizar WHERE id_entrega = '".$GET_ID."' ";
$resultED = mysqli_query($con, $sqlED);
$numeroED = mysqli_num_rows($resultED);
if($numeroED > 0){
while($rowED = mysqli_fetch_array($resultED, MYSQLI_ASSOC)){
$explode = explode(' ',$rowED['fecha']);
$FechaE = FormatoFecha($explode[0]);
$HoraE = date("g:i a",strtotime($explode[1]));
$nombre = $rowED['nombre'];

}
}else{
  $FechaE = '';
  $HoraE = '';
  $nombre  = '';
}

$sqlLista = "SELECT * FROM tb_entregas_documentos WHERE id_entrega = '".$GET_ID."' ";
$resultLista = mysqli_query($con, $sqlLista);
$numeroLista = mysqli_num_rows($resultLista);

function Documentos($idEntrega, $con){
    $sql = "SELECT id_entrega, id_estacion FROM tb_entregas_documentos WHERE id_entrega = '".$idEntrega."' GROUP BY id_estacion";
    $result = mysqli_query($con, $sql);
    $numero = mysqli_num_rows($result);
    return $numero;
    }

$Documento = Documentos($GET_ID, $con);

$contenid0 .= '</head>';
$contenid0 .= '<body';

$RutaLogo = RUTA_IMG_LOGOS.'Logo.png';
$DataLogo = file_get_contents($RutaLogo);
$baseLogo = 'data:image/;base64,' . base64_encode($DataLogo);

$contenid0 .= '<div>';

$contenid0 .= '<img src="'.$baseLogo.'" style="width: 150px;">';

$contenid0 .= '<div class="text-right mt-4">Huixquilucan, Estado de México a '.FormatoFecha($fecha).'</div>';
$contenid0 .= '<div class="text-right"><b>Asunto:</b> Entrega de documentos</div>';

$contenid0 .= '<div class="mt-4"></div>';
$contenid0 .= '<div><b>'.$destinatario.'</b></div>';
$contenid0 .= '<div>'.$razonsocial.'</div>';
$contenid0 .= '<div>'.$direccion.'</div>';

$contenid0 .= '<div class="mt-4">P r e s e n t e.</div>';
$contenid0 .= '<div class="mt-4">Se hace entrega de la siguiente documentación:</div>';


$contenid0 .= '<table class="table table-bordered table-striped table-hover table-sm mt-4">';
$contenid0 .= '<thead>';
$contenid0 .= '<tr>';
$contenid0 .= '<th class="text-center align-middle">No.</th>';
if($Documento > 1){
$contenid0 .= '<th class="text-center align-middle">Razón Social</th>';
}
$contenid0 .= '<th class="text-center align-middle">Nombre del documento</th>  
  <th class="text-center align-middle">Fecha del oficio</th>
  <th class="text-center align-middle">Original y/o copia</th>
</tr>
</thead>
<tbody>';

$num = 1;
while($rowLista = mysqli_fetch_array($resultLista, MYSQLI_ASSOC)){

$id = $rowLista['id'];

if($rowLista['id_estacion'] != 0){
$Estacion = Estacion($rowLista['id_estacion'], $con);
$RazonSocial = $Estacion['razonsocial'];
}

$contenid0 .= '<tr>';
$contenid0 .= '<td class="text-center align-middle"><b>'.$num.'</b></td>';
if($Documento > 1){
$contenid0 .= '<td class="text-center align-middle">'.$RazonSocial.'</td>';
}
$contenid0 .= '<td class="text-center align-middle">'.$rowLista['documento'].'</td>';
$contenid0 .= '<td class="text-center align-middle">'.FormatoFecha($rowLista['fecha']).'</td>';
$contenid0 .= '<td class="text-center align-middle">'.$rowLista['detalle'].'</td>';
$contenid0 .= '</tr>';

$num++;
}

$contenid0 .= '</tbody> 
</table>';

$contenid0 .= '<div class="mt-4"><b>Nota: Es importante mencionar que estos documentos deben estar bien archivados en la estación de servicio.</b></div>';

$contenid0 .= '<div style="margin-top: 30px;">Recibido</div>';
$contenid0 .= '<div style="margin-top: 0px;"><b>Nombre:</b> '.$nombre.'</div>';
$contenid0 .= '<div style="margin-top: 0px;"><b>Fecha:</b> '.$FechaE.' '.$HoraE.'</div>';

$contenid0 .= '</div>';
$contenid0 .= '</body>';
$contenid0 .= '</html>';


$dompdf->loadHtml($contenid0);
// Colocamos als propiedades de la hoja
$dompdf->setPaper("A4", "portrait");
// Escribimos el html en el PDF
$dompdf->render();
// Ponemos el PDF en el browser
$dompdf->stream('Formato entregas.pdf',["Attachment" => true]);
//------------------
mysqli_close($con);
//------------------