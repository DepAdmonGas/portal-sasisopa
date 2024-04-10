<?php
require_once 'dompdf/autoload.inc.php';
include_once "app/help.php";

use Dompdf\Dompdf;
// Inicializamos dompdf
$dompdf = new Dompdf();

$ruta = "http://portal.admongas.com.mx/bitacora-api-app/app/Mantenimiento/ImagenFirma/";
$year = date("Y");
$mes = date("m");

if ($SelYear == "" && $SelMes == "") {

$sql_mantenimiento = "SELECT * FROM po_mantenimiento_correctivo WHERE id_estacion = '".$Session_IDEstacion."' ORDER BY id desc";

}else{

if ($SelMes == 0) {

$sql_mantenimiento = "SELECT * FROM po_mantenimiento_correctivo WHERE id_estacion = '".$Session_IDEstacion."' AND YEAR(fechacreacion) = '".$SelYear."' ORDER BY id desc";

}else{
$sql_mantenimiento = "SELECT * FROM po_mantenimiento_correctivo WHERE id_estacion = '".$Session_IDEstacion."' AND YEAR(fechacreacion) = '".$SelYear."' AND MONTH(fechacreacion) = '".$SelMes."' ORDER BY id desc";
}

}

    function FormatFolio($Folio){

        $NumString = strlen($Folio);

        if($NumString == 1){

            $resultado = "00".$Folio;

        }else if($NumString == 2){

            $resultado = "0".$Folio;

        }else if($NumString == 3){

            $resultado = $Folio;

        }

        return $resultado;

       }

              function NombreUsuario($idUsuario, $con){

        $sql_usuario = "SELECT nombre FROM tb_usuarios WHERE id = '".$idUsuario."' ";
        $result_usuario = mysqli_query($con, $sql_usuario);
        while($row_usuario = mysqli_fetch_array($result_usuario, MYSQLI_ASSOC)){
        $nomencargado = $row_usuario['nombre'];
        }

        return $nomencargado;

       } 

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


$RutaLogo = "http://portal.admongas.com.mx/portal-sasisopa/imgs/logo/Logo.png";
$DataLogo = file_get_contents($RutaLogo);
$baseLogo = 'data:image/png;base64,' . base64_encode($DataLogo);


$contenid0 .= '<div class="text-center" style="margin-top: 200px;"><img src="'.$baseLogo.'" style="width: 300px"></div>';
$contenid0 .= '<div class="text-center mt-3"><b>Reporte Mantenimiento Correctivo</b></div>';
$contenid0 .= '<div class="text-center mt-1"><b>'.$Session_Permisocre.'</b></div>';
$contenid0 .= '<div class="text-center mt-1">'.$Session_Razonsocial.'</div>';
$contenid0 .= '<div class="text-center mt-1"><small>'.$Session_Direccion.'</small></div>';
$contenid0 .= '<div class="text-center mt-1"><small>Código: DLES/SA/002</small></div>';
$contenid0 .= '<div style="page-break-before: always;"> </div>';

$salto = 0;

$result_mantenimiento = mysqli_query($con, $sql_mantenimiento);
$numero_mantenimiento = mysqli_num_rows($result_mantenimiento);
while($row_mantenimiento = mysqli_fetch_array($result_mantenimiento, MYSQLI_ASSOC)){

$id = $row_mantenimiento['id'];
$folio = FormatFolio($row_mantenimiento['folio']);

$fecha = $row_mantenimiento['fechacreacion'];
$hora = date("g:i a",strtotime($row_mantenimiento['horacreacion']));
$equipo = $row_mantenimiento['nombre_equipo'];
$dhallazgo = $row_mantenimiento['descripcion_hallazgo'];
$dactividad = $row_mantenimiento['descripcion_actividad'];
$herramienta = $row_mantenimiento['herramienta'];

$sql_imagen1 = "SELECT nombre,imagen_firma FROM po_mantenimiento_correctivo_firma WHERE id_mantenimiento = '".$id."'  AND tipo_firma = 'FPR' ";
$result_imagen1 = mysqli_query($con, $sql_imagen1);
$numero_imagen1 = mysqli_num_rows($result_imagen1);
while($row_imagen1 = mysqli_fetch_array($result_imagen1, MYSQLI_ASSOC)){
$NombreRecibe = $row_imagen1['nombre'];
$FPR = $row_imagen1['imagen_firma'];
}

$sql_imagen2 = "SELECT nombre,imagen_firma FROM po_mantenimiento_correctivo_firma WHERE id_mantenimiento = '".$id."'  AND tipo_firma = 'FPS' ";
$result_imagen2 = mysqli_query($con, $sql_imagen2);
$numero_imagen2 = mysqli_num_rows($result_imagen2);
while($row_imagen2 = mysqli_fetch_array($result_imagen2, MYSQLI_ASSOC)){
$NombreSupervisa = $row_imagen2['nombre'];
$FPS = $row_imagen2['imagen_firma'];
}

$DataFPR = file_get_contents($ruta.$FPR);
$DataFPS = file_get_contents($ruta.$FPS);
$baseFPR = 'data:image/' . $type . ';base64,' . base64_encode($DataFPR);
$baseFPS = 'data:image/' . $type . ';base64,' . base64_encode($DataFPS);


$RutaLogoH = "http://portal.admongas.com.mx/portal-sasisopa/imgs/logo/Logo.png";
$DataLogoH = file_get_contents($RutaLogoH);
$baseLogoH = 'data:image/png;base64,' . base64_encode($DataLogoH);


$contenid0 .= '<div ><img src="'.$baseLogoH.'" style="width: 150px"></div>';
$contenid0 .= '<table class="table-bordered table-sm mt-3">';
$contenid0 .= '<thead>';
$contenid0 .= '<tr class="table-active" style="font-size: 1em;">';
$contenid0 .= '<th class="text-center align-middle">Folio</th>';
$contenid0 .= '<th class="text-center align-middle">Fecha</th>';
$contenid0 .= '<th class="text-center align-middle">Hora</th>';
$contenid0 .= '</tr>';
$contenid0 .= '</thead>';
$contenid0 .= '<tbody>';
$contenid0 .= '<tr style="font-size: 1em;">';
$contenid0 .= '<td class="text-center align-middle"><b>'.$folio.'</b></td>';
$contenid0 .= '<td class="text-center align-middle">'.FormatoFecha($fecha).'</td>';
$contenid0 .= '<td class="text-center align-middle">'.$hora.'</td>';
$contenid0 .= '</tr>';
$contenid0 .= '</tbody>';
$contenid0 .= '</table>';

$contenid0 .= '<table class="table table-bordered table-sm mt-3">';
$contenid0 .= '<tbody>';
$contenid0 .= '<tr class="table-active" style="font-size: 1em;">';
$contenid0 .= '<th class="text-center align-middle">Nombre del equipo o área donde se detecta la no conformidad</th>';
$contenid0 .= '<th class="text-center align-middle">Descripción breve del hallazgo detectado que requiere mantenimiento</th>';
$contenid0 .= '</tr>';
$contenid0 .= '<tr style="font-size: 1em;">';
$contenid0 .= '<td class="text-center align-middle">'.$equipo.'</td>';
$contenid0 .= '<td class="text-center align-middle">'.$dhallazgo.'</td>';
$contenid0 .= '</tr>';
$contenid0 .= '<tr class="table-active" style="font-size: 1em;">';
$contenid0 .= '<th class="text-center align-middle">Descripción de las actividades de mantenimiento</th>';
$contenid0 .= '<th class="text-center align-middle">Herramienta utilizada para el mantenimiento</th>';
$contenid0 .= '</tr>';
$contenid0 .= '<tr style="font-size: 1em;">';
$contenid0 .= '<td class="text-center align-middle">'.$dactividad.'</td>';
$contenid0 .= '<td class="text-center align-middle">'.$herramienta.'</td>';
$contenid0 .= '</tr>';
$contenid0 .= '</tbody>';
$contenid0 .= '</table>';

$contenid0 .= '<table class="table-bordered table-sm" style="margin-left: 710px;">';
$contenid0 .= '<thead>';
$contenid0 .= '<tr class="table-active" style="font-size: 1em;">';
$contenid0 .= '<td class="text-center align-middle">Persona que realizo</td>';
$contenid0 .= '<td class="text-center align-middle">Persona que superviso</td>';
$contenid0 .= '</tr>';
$contenid0 .= '</thead>';
$contenid0 .= '<tbody>';
$contenid0 .= '<tr>';
$contenid0 .= '<td class="text-center">';        
$contenid0 .= '<div><img width="90px" src="'.$baseFPR.'" /></div><div style="font-size: .6em;">'.$NombreRecibe.'</div>'; 
$contenid0 .= '</td>';
$contenid0 .= '<td class="text-center">';  
$contenid0 .= '<div><img width="90px" src="'.$baseFPS.'" /></div><div style="font-size: .6em;">'.$NombreSupervisa.'</div>';   
$contenid0 .= '</td>';
$contenid0 .= '</tr>';
$contenid0 .= '</tbody>';
$contenid0 .= '</table>';

$contenid0 .= '<div class="text-center p-0">';
$sql_evidencia = "SELECT * FROM po_mantenimiento_correctivo_evidencia WHERE id_mantenimiento = '".$id."' ";
$result_evidencia = mysqli_query($con, $sql_evidencia);
$numero_evidencia = mysqli_num_rows($result_evidencia);

if ($numero_evidencia != 0) {
$contenid0 .= '<div style="page-break-before: always;"> </div>';
}else{}

while($row_evidencia = mysqli_fetch_array($result_evidencia, MYSQLI_ASSOC)){
$url = $row_evidencia['url'];

$Evidencia = file_get_contents($url);
$baseEvidencia = 'data:image/' . $type . ';base64,' . base64_encode($Evidencia);

$contenid0 .= '<img class="mt-4" style="width: 335px;height: 335px;padding: 5px;" src="'.$baseEvidencia.'" />';

}
$contenid0 .= '</div>';


$salto = $salto + 1;
if ($numero_mantenimiento != $salto) {
$contenid0 .= '<div style="page-break-before: always;"> </div>';
}else{}

}

$contenid0 .= '</body>';

$dompdf->loadHtml($contenid0);
$dompdf->setPaper("A4", "landscape");
$dompdf->render();
$canvas = $dompdf->get_canvas();
$canvas->page_text(768, 570, "Página: {PAGE_NUM} de {PAGE_COUNT}", null, 7, array(0, 0, 0));

$dompdf->stream('Mantenimiento Correctivo.pdf');

//------------------
mysqli_close($con);
//------------------
?>
