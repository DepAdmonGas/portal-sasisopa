<?php
require_once '../../dompdf/autoload.inc.php';
include_once "../../app/help.php";

$FechaInicio = date('Y-m-d', $_GET['FechaInicio']);
$FechaTermino = date('Y-m-d', $_GET['FechaTermino']);

use Dompdf\Dompdf;
$dompdf = new Dompdf();


    $contenid0 .= "<!DOCTYPE html>";
    $contenid0 .= "<html>";
    $contenid0 .= "<head>";
    $contenid0 .= "<title>Matriz de evaluación del cumplimiento legal</title>";
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

.p-3 {
  padding: 1rem !important;
}

.mb-3,
.my-3 {
  margin-bottom: 1rem !important;
}

.bg-primary {
  background-color: #007bff !important;
}

.text-right {
  text-align: right !important;
}

.text-white {
  color: #fff !important;
}

.bg-secondary {
  background-color: #6c757d !important;
}
</style>';

$contenid0 .= '</head>';
$contenid0 .= '<body';


    $RutaLogo = SERVIDOR."imgs/logo/Logo.png";
    $DataLogo = file_get_contents($RutaLogo);
    $baseLogo = 'data:image/;base64,' . base64_encode($DataLogo);

$contenid0 .= '<div>';

$contenid0 .= '<table class="table table-bordered">';
$contenid0 .= '<tbody>';
$contenid0 .= '<tr>';

$contenid0 .= '<td class="align-middle text-center">';
$contenid0 .= '<img src="'.$baseLogo.'" style="width: 150px;">';
$contenid0 .= '</td>';
$contenid0 .= '<td colspan="2" class="align-middle text-center">';
$contenid0 .= '<b>Matriz de evaluación del cumplimiento legal</b>';
$contenid0 .= '</td>';
$contenid0 .= '<td class="align-middle text-center">';
$contenid0 .= '<b>Fo.ADMONGAS.021</b>';
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
$contenid0 .= 'Fecha de aprobacion:<br>  01-oct-18';
$contenid0 .= '</td>';
$contenid0 .= '</tr>';
            

$contenid0 .= '</tbody>';
$contenid0 .= '</table>';
//-----------------------------------------------------------------

function NivelGobierno($NGobierno,$IDEstacion,$FechaInicio,$FechaTermino,$con){

    $TotalNG = TotalNG($NGobierno,$IDEstacion,$FechaInicio,$FechaTermino,$con);

    $RutaX = RUTA_IMG_ICONOS."correcto-24.png";
    $DataX = file_get_contents($RutaX);
    $baseX = 'data:image/;base64,' . base64_encode($DataX);

    $sql_programa_c = "SELECT * FROM rl_requisitos_legales_calendario WHERE id_estacion = '".$IDEstacion."' AND nivel_gobierno = '".$NGobierno."' AND estado = 1";
    $result_programa_c = mysqli_query($con, $sql_programa_c);
    $numero_programa_c = mysqli_num_rows($result_programa_c);
    $i = 1;
    while($row_programa_c = mysqli_fetch_array($result_programa_c, MYSQLI_ASSOC)){
    $idre = $row_programa_c['id'];
    $requisitol = $row_programa_c['requisito_legal'];

    if($i == 1){
    $Rowspan = '<td class="align-middle text-center" rowspan="'.$numero_programa_c.'">'.$NGobierno.'</td>';
    }else{
    $Rowspan = '';  
    }

    $UltimaA = UltimaAct($idre,$FechaInicio,$FechaTermino,$con);

    if($UltimaA['acusepdf'] == 1){
    $AcusePDF = '<img src="'.$baseX.'" />';
    }else{
    $AcusePDF = '';
    }

    if($UltimaA['requisitolegalpdf'] == 1){
    $RequisitoLPDF = '<img src="'.$baseX.'" />';
    }else{
    $RequisitoLPDF = '';
    }

    if($i == 1){
    $TotalC = '<td class="align-middle text-center" rowspan="'.$numero_programa_c.'"><b>'.$TotalNG.' %</b></td>';
    }else{
    $TotalC = '';  
    }


    $contenido .= '<tr>';
    $contenido .= '<td class="align-middle text-center">'.$NGobierno.'</td>';
    $contenido .= '<td class="align-middle text-center">'.$requisitol.'</td>';
    $contenido .= '<td class="align-middle text-center">'.$row_programa_c['vigencia'].'</td>';
    $contenido .= '<td class="align-middle text-center">'.$AcusePDF.'</td>';
    $contenido .= '<td class="align-middle text-center">'.$RequisitoLPDF.'</td>';
    $contenido .= '<td class="align-middle text-center">'.$UltimaA['cumplimiento'].'</td>';
    $contenido .= '</tr>';


    $i++;
    }

    $contenido .= '<tr><td colspan="6" class="bg-secondary text-white text-right"><div style="font-size: 1.2em;"><b>% de cumplimiento por nivel de gobierno '.$NGobierno.' '.$TotalNG.' %</b></div></td></tr>';

    return $contenido;

    }

    function TotalNG($NGobierno,$IDEstacion,$FechaInicio,$FechaTermino,$con){

    $sql_programa_c = "SELECT * FROM rl_requisitos_legales_calendario WHERE id_estacion = '".$IDEstacion."' AND nivel_gobierno = '".$NGobierno."' AND estado = 1";
    $result_programa_c = mysqli_query($con, $sql_programa_c);
    $numero_programa_c = mysqli_num_rows($result_programa_c);

    while($row_programa_c = mysqli_fetch_array($result_programa_c, MYSQLI_ASSOC)){
    $idre = $row_programa_c['id'];
    $requisitol = $row_programa_c['requisito_legal'];

    $UltimaA = UltimaAct($idre,$FechaInicio,$FechaTermino,$con);

    $Total = $Total + $UltimaA['toCumpli'];
    }

    $Result  = $Total / $numero_programa_c;

    return number_format($Result,0);

    }

function UltimaAct($idre,$FechaInicio,$FechaTermino,$con){

$sql_matriz = "SELECT * FROM rl_requisitos_legales_matriz WHERE idcalendario = '".$idre."' AND fecha_emision BETWEEN '".$FechaInicio."' AND '".$FechaTermino."' ORDER BY id desc LIMIT 1";
$result_matriz = mysqli_query($con, $sql_matriz);
$numero_matriz = mysqli_num_rows($result_matriz);
if($numero_matriz > 0){
while($row_matriz = mysqli_fetch_array($result_matriz, MYSQLI_ASSOC)){

if($row_matriz['acusepdf'] == ""){
$acusepdf = 0;
}else{
$acusepdf = 1;  
}

if($row_matriz['requisitolegalpdf'] == ""){
$requisitolegalpdf = 0;
}else{
$requisitolegalpdf = 1; 
}

}
}

if ($acusepdf == 0 && $requisitolegalpdf == 0) {
  $cumplimiento = "0 %";
  $toCumpli = 0;
  }else if ($acusepdf  == 1 && $requisitolegalpdf == 0) {
  $cumplimiento = "50 %";
  $toCumpli = 50;
  }else if($acusepdf == 0 && $requisitolegalpdf == 1){
  $cumplimiento = "100 %";
  $toCumpli = 100;
  }else if($acusepdf == 1 && $requisitolegalpdf == 1){
  $cumplimiento = "100 %";
  $toCumpli = 100;
  }

$array = array(
'acusepdf' => $acusepdf,
'requisitolegalpdf' => $requisitolegalpdf,
'cumplimiento' => $cumplimiento,
'toCumpli' => $toCumpli);

return $array;
}

    $contenid0 .= '<table class="table table-bordered table-sm" style="font-size: .8em;">';
      $contenid0 .= '<thead>';
        $contenid0 .= '<tr>';
          $contenid0 .= '<th class="align-middle text-center">Nivel de gobierno</th>';
          $contenid0 .= '<th class="align-middle text-center">Nombre del requisito legal</th>';
          $contenid0 .= '<th class="align-middle text-center">Vigencia</th>';
          $contenid0 .= '<th class="align-middle text-center">Acuse *Adjuntar</th>';
          $contenid0 .= '<th class="align-middle text-center">Requisito legal *Adjuntar</th>';
          $contenid0 .= '<th class="align-middle text-center">% de cumplimiento por requisito</th>';
        $contenid0 .= '</tr>';
      $contenid0 .= '</thead>';
      $contenid0 .= '<tbody>';


      $contenid0 .= NivelGobierno('Municipal',$Session_IDEstacion,$FechaInicio,$FechaTermino,$con);
      $contenid0 .= NivelGobierno('Estatal',$Session_IDEstacion,$FechaInicio,$FechaTermino,$con);
      $contenid0 .= NivelGobierno('Federal',$Session_IDEstacion,$FechaInicio,$FechaTermino,$con);
      $contenid0 .= NivelGobierno('Varios',$Session_IDEstacion,$FechaInicio,$FechaTermino,$con);

    $Total1 = TotalNG('Municipal',$Session_IDEstacion,$FechaInicio,$FechaTermino,$con);
    $Total2 = TotalNG('Estatal',$Session_IDEstacion,$FechaInicio,$FechaTermino,$con);
    $Total3 = TotalNG('Federal',$Session_IDEstacion,$FechaInicio,$FechaTermino,$con);
    $Total4 = TotalNG('Varios',$Session_IDEstacion,$FechaInicio,$FechaTermino,$con);

    $PorcentajeG = $Total1 + $Total2 + $Total3 + $Total4;
    $TPG = $PorcentajeG / 4;

    $contenid0 .= '<tr><td colspan="6" class="bg-primary text-center text-white" style="font-size: 1.5em;"><div><b>Porcentaje de cumplimiento general '.number_format($TPG,0).' %</b></div></td></tr>';

       
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
$dompdf->get_canvas()->page_text(750, 570, "Pagina: {PAGE_NUM} de {PAGE_COUNT}", $font, 8, array(0,0,0));
// Ponemos el PDF en el browser
$dompdf->stream('Matriz de evaluación del cumplimiento legal.pdf',["Attachment" => true]);
//------------------
mysqli_close($con);
//------------------