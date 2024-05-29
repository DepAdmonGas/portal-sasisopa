<?php
require_once 'dompdf/autoload.inc.php';
include_once "app/help.php";

function Calibracion($IDEstacion,$equipo,$fecha,$estado,$con){
    $Cotenido = "";
$explode = explode('-', $fecha);
$Year = $explode[0];
$Mes = $explode[1];

if($equipo == 'Dispensario'){

$sql = "SELECT * FROM tb_dispensarios WHERE id_estacion = '".$IDEstacion."' ";
$result = mysqli_query($con, $sql);
$numero = mysqli_num_rows($result);
while($row = mysqli_fetch_array($result, MYSQLI_ASSOC)){

$Ene = YearCol($Year, intval($Mes), 1,$estado,$estado);
$Feb = YearCol($Year, intval($Mes), 2,$estado,$estado);
$Mar = YearCol($Year, intval($Mes), 3,$estado,$estado);
$Abr = YearCol($Year, intval($Mes), 4,$estado,$estado);
$May = YearCol($Year, intval($Mes), 5,$estado,$estado);
$Jun = YearCol($Year, intval($Mes), 6,$estado,$estado);
$Jul = YearCol($Year, intval($Mes), 7,$estado,$estado);
$Ago = YearCol($Year, intval($Mes), 8,$estado,$estado);
$Sep = YearCol($Year, intval($Mes), 9,$estado,$estado);
$Oct = YearCol($Year, intval($Mes), 10,$estado,$estado);
$Nov = YearCol($Year, intval($Mes), 11,$estado,$estado);
$Dic = YearCol($Year, intval($Mes), 12,$estado,$estado);

$Cotenido .= '<tr>';
$Cotenido .= '<td class="align-middle text-center">'.$row['no_dispensario'].'</td>';
$Cotenido .= '<td class="align-middle">Dispensario ('.$row['marca'].', '.$row['modelo'].')</td>';
$Cotenido .= '<td class="align-middle text-center">Semestral</td>';
$Cotenido .= '<td class="align-middle text-center '.$Ene['Col'].'">'.$Ene['Year'].'</td>';
$Cotenido .= '<td class="align-middle text-center '.$Feb['Col'].'">'.$Feb['Year'].'</td>';
$Cotenido .= '<td class="align-middle text-center '.$Mar['Col'].'">'.$Mar['Year'].'</td>';
$Cotenido .= '<td class="align-middle text-center '.$Abr['Col'].'">'.$Abr['Year'].'</td>';
$Cotenido .= '<td class="align-middle text-center '.$May['Col'].'">'.$May['Year'].'</td>';
$Cotenido .= '<td class="align-middle text-center '.$Jun['Col'].'">'.$Jun['Year'].'</td>';
$Cotenido .= '<td class="align-middle text-center '.$Jul['Col'].'">'.$Jul['Year'].'</td>';
$Cotenido .= '<td class="align-middle text-center '.$Ago['Col'].'">'.$Ago['Year'].'</td>';
$Cotenido .= '<td class="align-middle text-center '.$Sep['Col'].'">'.$Sep['Year'].'</td>';
$Cotenido .= '<td class="align-middle text-center '.$Oct['Col'].'">'.$Oct['Year'].'</td>';
$Cotenido .= '<td class="align-middle text-center '.$Nov['Col'].'">'.$Nov['Year'].'</td>';
$Cotenido .= '<td class="align-middle text-center '.$Dic['Col'].'">'.$Dic['Year'].'</td>';
$Cotenido .= '</tr>';

}

}else if($equipo == 'Jarra patron'){

$i = 1;
$sql = "SELECT * FROM tb_jarra_patron WHERE id_estacion = '".$IDEstacion."' ";
$result = mysqli_query($con, $sql);
$numero = mysqli_num_rows($result);
while($row = mysqli_fetch_array($result, MYSQLI_ASSOC)){

$Ene = YearCol($Year, intval($Mes), 1,$estado);
$Feb = YearCol($Year, intval($Mes), 2,$estado);
$Mar = YearCol($Year, intval($Mes), 3,$estado);
$Abr = YearCol($Year, intval($Mes), 4,$estado);
$May = YearCol($Year, intval($Mes), 5,$estado);
$Jun = YearCol($Year, intval($Mes), 6,$estado);
$Jul = YearCol($Year, intval($Mes), 7,$estado);
$Ago = YearCol($Year, intval($Mes), 8,$estado);
$Sep = YearCol($Year, intval($Mes), 9,$estado);
$Oct = YearCol($Year, intval($Mes), 10,$estado);
$Nov = YearCol($Year, intval($Mes), 11,$estado);
$Dic = YearCol($Year, intval($Mes), 12,$estado);

$Cotenido .= '<tr>';
$Cotenido .= '<td class="align-middle text-center">'.$i.'</td>';
$Cotenido .= '<td class="align-middle">Jarra patron ('.$row['marca'].', '.$row['no_serie'].')</td>';
$Cotenido .= '<td class="align-middle text-center">Anual</td>';
$Cotenido .= '<td class="align-middle text-center '.$Ene['Col'].'">'.$Ene['Year'].'</td>';
$Cotenido .= '<td class="align-middle text-center '.$Feb['Col'].'">'.$Feb['Year'].'</td>';
$Cotenido .= '<td class="align-middle text-center '.$Mar['Col'].'">'.$Mar['Year'].'</td>';
$Cotenido .= '<td class="align-middle text-center '.$Abr['Col'].'">'.$Abr['Year'].'</td>';
$Cotenido .= '<td class="align-middle text-center '.$May['Col'].'">'.$May['Year'].'</td>';
$Cotenido .= '<td class="align-middle text-center '.$Jun['Col'].'">'.$Jun['Year'].'</td>';
$Cotenido .= '<td class="align-middle text-center '.$Jul['Col'].'">'.$Jul['Year'].'</td>';
$Cotenido .= '<td class="align-middle text-center '.$Ago['Col'].'">'.$Ago['Year'].'</td>';
$Cotenido .= '<td class="align-middle text-center '.$Sep['Col'].'">'.$Sep['Year'].'</td>';
$Cotenido .= '<td class="align-middle text-center '.$Oct['Col'].'">'.$Oct['Year'].'</td>';
$Cotenido .= '<td class="align-middle text-center '.$Nov['Col'].'">'.$Nov['Year'].'</td>';
$Cotenido .= '<td class="align-middle text-center '.$Dic['Col'].'">'.$Dic['Year'].'</td>';
$Cotenido .= '</tr>';

$i++;
}
}else if($equipo == 'Sondas de medición'){

$i = 1;
$sql = "SELECT * FROM tb_sondas_medicion WHERE id_estacion = '".$IDEstacion."' ";
$result = mysqli_query($con, $sql);
$numero = mysqli_num_rows($result);
while($row = mysqli_fetch_array($result, MYSQLI_ASSOC)){

$Ene = YearCol($Year, intval($Mes), 1,$estado);
$Feb = YearCol($Year, intval($Mes), 2,$estado);
$Mar = YearCol($Year, intval($Mes), 3,$estado);
$Abr = YearCol($Year, intval($Mes), 4,$estado);
$May = YearCol($Year, intval($Mes), 5,$estado);
$Jun = YearCol($Year, intval($Mes), 6,$estado);
$Jul = YearCol($Year, intval($Mes), 7,$estado);
$Ago = YearCol($Year, intval($Mes), 8,$estado);
$Sep = YearCol($Year, intval($Mes), 9,$estado);
$Oct = YearCol($Year, intval($Mes), 10,$estado);
$Nov = YearCol($Year, intval($Mes), 11,$estado);
$Dic = YearCol($Year, intval($Mes), 12,$estado);

$Cotenido .= '<tr>';
$Cotenido .= '<td class="align-middle text-center">'.$row['no_sonda'].'</td>';
$Cotenido .= '<td class="align-middle">Sondas de medición ('.$row['marca'].', '.$row['modelo'].')</td>';
$Cotenido .= '<td class="align-middle text-center">2 años</td>';
$Cotenido .= '<td class="align-middle text-center '.$Ene['Col'].'">'.$Ene['Year'].'</td>';
$Cotenido .= '<td class="align-middle text-center '.$Feb['Col'].'">'.$Feb['Year'].'</td>';
$Cotenido .= '<td class="align-middle text-center '.$Mar['Col'].'">'.$Mar['Year'].'</td>';
$Cotenido .= '<td class="align-middle text-center '.$Abr['Col'].'">'.$Abr['Year'].'</td>';
$Cotenido .= '<td class="align-middle text-center '.$May['Col'].'">'.$May['Year'].'</td>';
$Cotenido .= '<td class="align-middle text-center '.$Jun['Col'].'">'.$Jun['Year'].'</td>';
$Cotenido .= '<td class="align-middle text-center '.$Jul['Col'].'">'.$Jul['Year'].'</td>';
$Cotenido .= '<td class="align-middle text-center '.$Ago['Col'].'">'.$Ago['Year'].'</td>';
$Cotenido .= '<td class="align-middle text-center '.$Sep['Col'].'">'.$Sep['Year'].'</td>';
$Cotenido .= '<td class="align-middle text-center '.$Oct['Col'].'">'.$Oct['Year'].'</td>';
$Cotenido .= '<td class="align-middle text-center '.$Nov['Col'].'">'.$Nov['Year'].'</td>';
$Cotenido .= '<td class="align-middle text-center '.$Dic['Col'].'">'.$Dic['Year'].'</td>';
$Cotenido .= '</tr>';

$i++;
}

}else if($equipo == 'Tanques de almacenamiento'){
$i = 1;
$sql = "SELECT * FROM tb_tanque_almacenamiento WHERE id_estacion = '".$IDEstacion."' ";
$result = mysqli_query($con, $sql);
$numero = mysqli_num_rows($result);
while($row = mysqli_fetch_array($result, MYSQLI_ASSOC)){

$Ene = YearCol($Year, intval($Mes), 1,$estado);
$Feb = YearCol($Year, intval($Mes), 2,$estado);
$Mar = YearCol($Year, intval($Mes), 3,$estado);
$Abr = YearCol($Year, intval($Mes), 4,$estado);
$May = YearCol($Year, intval($Mes), 5,$estado);
$Jun = YearCol($Year, intval($Mes), 6,$estado);
$Jul = YearCol($Year, intval($Mes), 7,$estado);
$Ago = YearCol($Year, intval($Mes), 8,$estado);
$Sep = YearCol($Year, intval($Mes), 9,$estado);
$Oct = YearCol($Year, intval($Mes), 10,$estado);
$Nov = YearCol($Year, intval($Mes), 11,$estado);
$Dic = YearCol($Year, intval($Mes), 12,$estado);

$Cotenido .= '<tr>';
$Cotenido .= '<td class="align-middle text-center">'.$row['no_tanque'].'</td>';
$Cotenido .= '<td class="align-middle">Tanques de almacenamiento ('.$row['capacidad'].', '.$row['producto'].')</td>';
$Cotenido .= '<td class="align-middle text-center">10 años</td>';
$Cotenido .= '<td class="align-middle text-center '.$Ene['Col'].'">'.$Ene['Year'].'</td>';
$Cotenido .= '<td class="align-middle text-center '.$Feb['Col'].'">'.$Feb['Year'].'</td>';
$Cotenido .= '<td class="align-middle text-center '.$Mar['Col'].'">'.$Mar['Year'].'</td>';
$Cotenido .= '<td class="align-middle text-center '.$Abr['Col'].'">'.$Abr['Year'].'</td>';
$Cotenido .= '<td class="align-middle text-center '.$May['Col'].'">'.$May['Year'].'</td>';
$Cotenido .= '<td class="align-middle text-center '.$Jun['Col'].'">'.$Jun['Year'].'</td>';
$Cotenido .= '<td class="align-middle text-center '.$Jul['Col'].'">'.$Jul['Year'].'</td>';
$Cotenido .= '<td class="align-middle text-center '.$Ago['Col'].'">'.$Ago['Year'].'</td>';
$Cotenido .= '<td class="align-middle text-center '.$Sep['Col'].'">'.$Sep['Year'].'</td>';
$Cotenido .= '<td class="align-middle text-center '.$Oct['Col'].'">'.$Oct['Year'].'</td>';
$Cotenido .= '<td class="align-middle text-center '.$Nov['Col'].'">'.$Nov['Year'].'</td>';
$Cotenido .= '<td class="align-middle text-center '.$Dic['Col'].'">'.$Dic['Year'].'</td>';
$Cotenido .= '</tr>';

$i++;
}

}
return $Cotenido;
}

function YearCol($Year, $Mes, $MesCom,$estado){
        
        if($estado == 0){
        $Color = 'table-warning';
        }else{
        $Color = 'table-success';    
        }

        if($Mes == $MesCom){
        $YearR = $Year;
        $ColR = $Color;
        }else{
        $YearR = '';
        $ColR = ''; 
        }

        $array = array('Year' => $YearR, 'Col' => $ColR );
        return $array;
}

use Dompdf\Dompdf;
$dompdf = new Dompdf();

    $contenid0 = "";
    $contenid0 .= "<!DOCTYPE html>";
    $contenid0 .= "<html>";
    $contenid0 .= "<head>";
    $contenid0 .= "<title>Calendario de calibraciones</title>";
    $contenid0 .= '<style type="text/css">
@page {margin: 0.5cm 0.5cm; font-family: Arial, Helvetica, sans-serif;}
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
.table-warning,
.table-warning > th,
.table-warning > td {
  background-color: #ffeeba;
}
.table-success,
.table-success > th,
.table-success > td {
  background-color: #c3e6cb;
}
</style>';

$contenid0 .= '</head>';
$contenid0 .= '<body';

$contenid0 .= '<div>';

//-----------------------------------------------------------------

$RutaLogo = SERVIDOR."imgs/logo/Logo.png";
$DataLogo = file_get_contents($RutaLogo);
$baseLogo = 'data:image/;base64,' . base64_encode($DataLogo);

$contenid0 .= '<table class="table table-bordered table-sm mt-2 mb-1" style="font-size: .9em;">
      <tr>
      <td class="text-center align-middle"><img class="text-center" src="'.$baseLogo.'" style="width: 150px;"></td>
      <td colspan="2" class="text-center align-middle"><b>Calendario de calibraciones </b></td>
      <td class="text-center align-middle">Fo.ADMONGAS.020</td>
      </tr>
      <tr>
      <td class="text-center align-middle">Realizado por: Nelly Estrada Garcia </td>
      <td class="text-center align-middle">Revisado por: Eduardo Galicia Flores </td>
      <td class="text-center align-middle">Autorizado por: '.$Session_ApoderadoLegal.' </td>
      <td class="text-center align-middle">Fecha de autorizacion 01/10/2018</td>
      </tr>
      </table>';

$contenid0 .= '<table class="table table-bordered table-sm mt-2 mb-2" style="font-size: .8em;">
        <thead>
          <tr>
            <th class="text-center align-middle" width="100px">Número de identificación</th>
            <th class="text-center align-middle" width="220px">Nombre del equipo (marca y modelo)</th>
            <th class="text-center align-middle">Frecuencia de la calibración</th>
            <th class="text-center align-middle">Ene</th>
            <th class="text-center align-middle">Feb</th>
            <th class="text-center align-middle">Mar</th>
            <th class="text-center align-middle">Abr</th>
            <th class="text-center align-middle">May</th>
            <th class="text-center align-middle">Jun</th>
            <th class="text-center align-middle">Jul</th>
            <th class="text-center align-middle">Ago</th>
            <th class="text-center align-middle">Sep</th>
            <th class="text-center align-middle">Oct</th>
            <th class="text-center align-middle">Nov</th>
            <th class="text-center align-middle">Dic</th>
          </tr>
        </thead>
        <tbody>';

        $sql_lista = "SELECT * FROM tb_calibracion_equipos WHERE id_estacion = '".$Session_IDEstacion."' AND categoria = 1 ORDER BY fecha DESC ";
        $result_lista = mysqli_query($con, $sql_lista);
        $numero_lista = mysqli_num_rows($result_lista);
        while($row_lista = mysqli_fetch_array($result_lista, MYSQLI_ASSOC)){

        $contenid0 .= Calibracion($Session_IDEstacion,$row_lista['equipo'],$row_lista['fecha'],$row_lista['estado'],$con);

        }


$contenid0 .= '</tbody></table>';

//-----------------------------------------------------------------

$contenid0 .= '</div>';
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
$dompdf->stream('Calendario de calibraciones.pdf',["Attachment" => true]);

//-----------------
mysqli_close($con);
//-----------------