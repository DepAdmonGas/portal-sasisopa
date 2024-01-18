<?php
require_once 'dompdf/autoload.inc.php';
include_once "app/help.php";

$Year = $GET_Year;

function Meta($idEstacion,$idObjeto,$con){

$sql_medicion = "SELECT * FROM tb_medicion_indicadores WHERE id_estacion = '".$idEstacion."' AND objeto = '".$idObjeto."' ORDER BY id DESC LIMIT 1 ";
$result_medicion = mysqli_query($con, $sql_medicion);
$numero_medicion = mysqli_num_rows($result_medicion);
while($row_medicion = mysqli_fetch_array($result_medicion, MYSQLI_ASSOC)){
$meta = $row_medicion['meta'];
}
return $meta;
}

function ResultadoImplementacion($Session_IDEstacion,$Year,$con){
$sql_implementacion = "SELECT * FROM tb_implementacionsa WHERE id_estacion = '".$Session_IDEstacion."' AND YEAR(fecha) = '".$Year."' ";
$result_implementacion = mysqli_query($con, $sql_implementacion);
$numero_implementacion = mysqli_num_rows($result_implementacion);

if ($numero_implementacion > 0) {
while($row_implementacion = mysqli_fetch_array($result_implementacion, MYSQLI_ASSOC)){
$calificacion = $calificacion + $row_implementacion['puntos'];
}
$Resultado = $calificacion / $numero_implementacion;
if($Resultado >= 60  && $Resultado <= 100){
$title = "<b class='text-success'>".$Resultado."% Excelente</b>";                
}else if($Resultado >= 0 && $Resultado <= 59){
$title = "<b class='text-warning'>".$Resultado."% Regular</b>";               
}
}else{
$title = "<b>S/I</b>"; 
}
return $title;
}


function Ventas($Session_IDEstacion,$mes,$year,$con){

$sql_reporte = "SELECT id FROM re_reporte_cre_mes WHERE id_estacion = '".$Session_IDEstacion."' AND mes = '".$mes."' AND year = '".$year."' ";
$result_reporte = mysqli_query($con, $sql_reporte);
$numero_reporte = mysqli_num_rows($result_reporte);
while($row_reporte = mysqli_fetch_array($result_reporte, MYSQLI_ASSOC)){
$idReporte = $row_reporte['id'];
}
$ventas = 0;
$sql_reporte_mes = "SELECT volumen_venta FROM re_reporte_cre_producto WHERE id_re_mes = '".$idReporte."'  ";
$result_reporte_mes = mysqli_query($con, $sql_reporte_mes);
$numero_reporte_mes = mysqli_num_rows($result_reporte_mes);
while($row_reporte_mes = mysqli_fetch_array($result_reporte_mes, MYSQLI_ASSOC)){

$ventas = $ventas + $row_reporte_mes['volumen_venta'];
}


return $ventas;
}

function ResultadoCapacitacion($Session_IDEstacion,$Year,$Semestre,$con){
if($Semestre == 1){
$Rango = 'AND (MONTH(fecha_programada) >= 1 AND MONTH(fecha_programada) <= 6)';
}else if($Semestre == 2){
$Rango = 'AND (MONTH(fecha_programada) >= 7 AND MONTH(fecha_programada) <= 12)';  
}

$sql_usuarios = "SELECT id FROM tb_usuarios WHERE id_gas = '".$Session_IDEstacion."'  ";
$result_usuarios = mysqli_query($con, $sql_usuarios);
$numero_usuarios = mysqli_num_rows($result_usuarios);
while($row_usuarios = mysqli_fetch_array($result_usuarios, MYSQLI_ASSOC)){
$idUsuario = $row_usuarios['id'];


$sql_detalle = "SELECT * FROM tb_cursos_calendario WHERE id_personal = '".$idUsuario."' AND YEAR(fecha_programada) = '".$Year."' $Rango  GROUP BY fecha_programada   ";
$result_detalle = mysqli_query($con, $sql_detalle);
$numero_detalle = mysqli_num_rows($result_detalle);

$SumD = $SumD + $numero_detalle;
while($row_detalle = mysqli_fetch_array($result_detalle, MYSQLI_ASSOC)){
$Total = $Total + $row_detalle['resultado'];

}

}

if($SumD == 0){
$title = "<b class='text-warning'>S/I</b>";
}else{
$Porcentaje = $Total / $SumD;
$calificacion = number_format($Porcentaje,2);

if( $calificacion >= 60  && $calificacion <= 100){
$title = "<b class='text-success'>".$calificacion."% Excelente</b>";
                    
}else if($calificacion >= 0 && $calificacion <= 59){
$title = "<b class='text-warning'>".$calificacion."% Regular</b>";
                    
}

}
  return $title;
}

function ResultadoSatisfaccion($Session_IDEstacion,$Year,$Semestre,$con){

if($Semestre == 1){
$Rango = 'AND (MONTH(fechacreacion) >= 1 AND MONTH(fechacreacion) <= 6)';
}else if($Semestre == 2){
$Rango = 'AND (MONTH(fechacreacion) >= 7 AND MONTH(fechacreacion) <= 12)';  
}

$sql_encuesta = "SELECT * FROM tb_encuentas_estacion WHERE id_estacion = '".$Session_IDEstacion."' AND YEAR(fechacreacion) = '".$Year."' $Rango ORDER BY fechacreacion DESC LIMIT 1 ";
$result_encuesta = mysqli_query($con, $sql_encuesta);
$numero_encuesta = mysqli_num_rows($result_encuesta);
while($row_encuesta = mysqli_fetch_array($result_encuesta, MYSQLI_ASSOC)){

$IdReporte = $row_encuesta['id'];

$sql_encuesta = "SELECT id FROM tb_encuentas_estacion_cliente WHERE id_cuentas_estacion = '".$IdReporte."' ";
$result_encuesta = mysqli_query($con, $sql_encuesta);
$numero_encuesta = mysqli_num_rows($result_encuesta);
while($row_encuesta = mysqli_fetch_array($result_encuesta, MYSQLI_ASSOC)){

$IdCliente = $row_encuesta['id'];

$sql_encuestaP = "SELECT resultado FROM tb_encuentas_estacion_cliente_preguntas WHERE id_cliente = '".$IdCliente."' ORDER BY resultado desc";
$result_encuestaP = mysqli_query($con, $sql_encuestaP);
$numero_encuestaP = mysqli_num_rows($result_encuestaP);
while($row_encuestaP = mysqli_fetch_array($result_encuestaP, MYSQLI_ASSOC)){


if($row_encuestaP['resultado'] == 4){
$resultado4 = $resultado4 + 1;
}else if($row_encuestaP['resultado'] == 3){
$resultado3 = $resultado3 + 1;
}else if($row_encuestaP['resultado'] == 2){
$resultado2 = $resultado2 + 1;
}else if($row_encuestaP['resultado'] == 1){
$resultado1 = $resultado1 + 1;
}

} 
}

} 

if ($resultado1 == 0) {
$resultado1 = 0;
}else{
$resultado1 = $resultado1;
}

if ($resultado2 == 0) {
$resultado2 = 0;
}else{
$resultado2 = $resultado2;
}

if ($resultado3 == 0) {
$resultado3 = 0;
}else{
$resultado3 = $resultado3;
}

if ($resultado4 == 0) {
$resultado4 = 0;
}else{
$resultado4 = $resultado4;
}

$resultado = "
<div class='text-danger'>Mala: <b>".$resultado1."</b></div>
<div class='text-warning'>Regular: <b>".$resultado2."</b></div>
<div class='text-info'>Buena: <b>".$resultado3."</b></div>
<div class='text-success'>Excelente: <b>".$resultado4."</b></div>
";

return $resultado;

}

function ResultadoIncidentes($Session_IDEstacion,$Year,$Semestre,$con){

if($Semestre == 1){
$Rango = 'AND (MONTH(fecha) >= 1 AND MONTH(fecha) <= 6)';
}else if($Semestre == 2){
$Rango = 'AND (MONTH(fecha) >= 7 AND MONTH(fecha) <= 12)';  
}

  $sql_inv = "SELECT * FROM tb_investigacion_incidente_accidente WHERE id_estacion= '".$Session_IDEstacion."' AND YEAR(fechacreacion) = '".$Year."' $Rango ORDER BY id desc ";
$result_inv = mysqli_query($con, $sql_inv);
$numero_inv = mysqli_num_rows($result_inv);

if ($numero_inv == 0) {
$title = "<b class='text-success'>100% Excelente</b>";
}else{
$totalRe = 0;
while($row_inv = mysqli_fetch_array($result_inv, MYSQLI_ASSOC)){
$id = $row_inv['id'];
$formato026 = formatos($id, $con);
$Grupo = Grupo($id, $con);

$Total = $formato026 + $Grupo;

if ($Total >= 2) {
$suma = 1;
}else{
$suma = 0;
}

$totalRe = $totalRe + $suma;

}

if ($totalRe == 0) {
$title = "<b class='text-warning'>50% Regular</b>";
}else{

$calificacion = $totalRe / $numero_inv  * 100;

if( $calificacion >= 60  && $calificacion <= 100){
$title = "<b class='text-success'>".$calificacion."% Excelente</b>";
                    
}else if($calificacion >= 0 && $calificacion <= 59){
$title = "<b class='text-warning'>".$calificacion."% Regular</b>";
                    
}

}

}

return $title;
}

function formatos($id, $con){

$sql_archivo = "SELECT * FROM tb_investigacion_incidente_accidente_formato WHERE id_investigacion = '".$id."' ORDER BY id asc ";
$result_archivo = mysqli_query($con, $sql_archivo);
$numero_archivo = mysqli_num_rows($result_archivo);
return $numero_archivo;
}

function Grupo($id, $con){

$sql_inv = "SELECT * FROM tb_investigacion_incidente_accidente_grupo WHERE id_investigacion= '".$id."' ORDER BY id desc ";
$result_inv = mysqli_query($con, $sql_inv);
$numero_inv = mysqli_num_rows($result_inv);

return $numero_inv;
}

    function TC($a,$b){

    if($b == 0){
    $Return = "<b class='text-warning'>S/I</b>";
    }else{
    $Resul = ($a - $b) / $b * 100;
      $TC = 100 + ($Resul);
      $Porcentaje = number_format($TC,2);

      if( $Porcentaje >= 80  ){
      $Return = "<b class='text-success'>".$Porcentaje."% Excelente</b>";                 
      }else if($Porcentaje >= 0 && $Porcentaje <= 79){
      $Return = "<b class='text-warning'>".$Porcentaje."% Regular</b>";
      }
    }
      return $Return;
      }

      $YearAnt = $Year - 1;

      $DicAnt = Ventas($Session_IDEstacion,12,$YearAnt,$con);
      $Ene = Ventas($Session_IDEstacion,1,$Year,$con);
      $Feb = Ventas($Session_IDEstacion,2,$Year,$con);
      $Mar = Ventas($Session_IDEstacion,3,$Year,$con);
      $Abr = Ventas($Session_IDEstacion,4,$Year,$con);
      $May = Ventas($Session_IDEstacion,5,$Year,$con);
      $Jun = Ventas($Session_IDEstacion,6,$Year,$con);
      $Jul = Ventas($Session_IDEstacion,7,$Year,$con);
      $Ago = Ventas($Session_IDEstacion,8,$Year,$con);
      $Sep = Ventas($Session_IDEstacion,9,$Year,$con);
      $Oct = Ventas($Session_IDEstacion,10,$Year,$con);
      $Nov = Ventas($Session_IDEstacion,11,$Year,$con);
      $Dic = Ventas($Session_IDEstacion,12,$Year,$con);

      $TC1 = TC($Ene,$DicAnt);
      $TC2 = TC($Feb,$Ene);
      $TC3 = TC($Mar,$Feb);
      $TC4 = TC($Abr,$Mar);
      $TC5 = TC($May,$Abr);
      $TC6 = TC($Jun,$May);
      $TC7 = TC($Jul,$Jun);
      $TC8 = TC($Ago,$Jul);
      $TC9 = TC($Sep,$Ago);
      $TC10 = TC($Oct,$Sep);
      $TC11 = TC($Nov,$Oct);
      $TC12 = TC($Dic,$Nov);

use Dompdf\Dompdf;
$dompdf = new Dompdf();

    $contenid0 .= "<!DOCTYPE html>";
    $contenid0 .= "<html>";
    $contenid0 .= "<head>";
    $contenid0 .= "<title>REVISIÓN DE RESULTADOS</title>";
    $contenid0 .= '<style type="text/css">
@page {margin: 1cm 0.5cm; font-family: Arial, Helvetica, sans-serif;}
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

hr {
  margin-top: 1rem;
  margin-bottom: 1rem;
  border: 0;
  border-top: 1px solid rgba(0, 0, 0, 0.1);
}
.border {
  border: 1px solid #dee2e6 !important;
}
.p-2 {
  padding: 0.5rem !important;
}
.bg-light {
  background-color: #f8f9fa !important;
}
.text-danger {
  color: #dc3545 !important;
}
.text-success {
  color: #28a745 !important;
}
.text-warning {
  color: #ffc107 !important;
}

.border-0 {
  border: 0 !important;
}
</style>';
$contenid0 .= '</head>';
$contenid0 .= '<body>';
$contenid0 .= '<div>';

$contenid0 .= '<div style="text-align: center;font-family: Arial, Helvetica, sans-serif;font-size: 1.2em;">Resumen del Año: '.$Year.'</div>';
$contenid0 .= "<div style='text-align: center;font-family: Arial, Helvetica, sans-serif;'><b>".$Session_Permisocre."</b></div>";
$contenid0 .= "<div style='text-align: center;font-family: Arial, Helvetica, sans-serif;'>".$Session_Razonsocial."</div>";
$contenid0 .= "<div style='text-align: center;font-family: Arial, Helvetica, sans-serif;'><small>".$Session_Direccion."</small></div>";

$contenid0 .= '<table class="table table-bordered table-sm pb-0 mb-0" style="font-size: .9em;margin-top: 50px;">';
$contenid0 .= '<tbody>';
$contenid0 .= '<tr>';
$contenid0 .= '<td class="align-middle text-center"><b>Objeto</b></td>';
$contenid0 .= '<td class="align-middle">Implementación del SA</td>';
$contenid0 .= '<td class="align-middle text-center"><b>Indicador</b></td>';
$contenid0 .= '<td class="align-middle">No. Total de elementos implementados VS No. de elementos del SA</td>';
$contenid0 .= '</tr>';
$contenid0 .= '<tr>';
$contenid0 .= '<td class="align-middle text-center"><b>Meta</b></td>';
$contenid0 .= '<td class="align-middle">'.Meta($Session_IDEstacion,1,$con).'</td>';
$contenid0 .= '<td class="align-middle text-center"><b>Frecuencia de medición</b></td>';
$contenid0 .= '<td class="align-middle">ANUAL</td>';
$contenid0 .= '</tr>';
$contenid0 .= '<tr>';
$contenid0 .= '<td colspan="4">';
$contenid0 .= '<div class="mt-1"><b>Resultado:</b> '.ResultadoImplementacion($Session_IDEstacion,$Year,$con).'</div>';
$contenid0 .= '</td>';
$contenid0 .= '</tr>';
$contenid0 .= '</tbody>';
$contenid0 .= '</table>';

$contenid0 .= '<hr>';

$contenid0 .= '<div class="border p-2">';

$contenid0 .= '<table class="table table-bordered table-sm pb-0 mb-0" style="font-size: .9em;">';
$contenid0 .= '<tbody>';
$contenid0 .= '<tr>';
$contenid0 .= '<td class="align-middle text-center"><b>Objeto</b></td>';
$contenid0 .= '<td class="align-middle">Ventas</td>';
$contenid0 .= '<td class="align-middle text-center"><b>Indicador</b></td>';
$contenid0 .= '<td class="align-middle">Venta del mes inmediato anterior VS venta del mes actual</td>';
$contenid0 .= '</tr>';
$contenid0 .= '<tr>';
$contenid0 .= '<td class="align-middle text-center"><b>Meta</b></td>';
$contenid0 .= '<td class="align-middle">'.Meta($Session_IDEstacion,2,$con).'</td>';
$contenid0 .= '<td class="align-middle text-center"><b>Frecuencia de medición</b></td>';
$contenid0 .= '<td class="align-middle">Mensual</td>';
$contenid0 .= '</tr>';
$contenid0 .= '</tbody>';
$contenid0 .= '</table>';

$contenid0 .= '<div style="font-size: .9em;"><b>Resultado:</b></div>'; 

$contenid0 .= '<table class="table table-sm table-bordered" style="font-size: .8em;">';
$contenid0 .= '<thead>';
$contenid0 .= '<tr>';
$contenid0 .= '<th class="align-middle text-center bg-light">Dic '.$YearAnt.'</th>';
$contenid0 .= '<th class="align-middle text-center bg-light">Ene '.$Year.'</th>';
$contenid0 .= '<th class="align-middle text-center">Ene '.$Year.'</th>';
$contenid0 .= '<th class="align-middle text-center">Feb '.$Year.'</th>';
$contenid0 .= '<th class="align-middle text-center bg-light">Feb '.$Year.'</th>';
$contenid0 .= '<th class="align-middle text-center bg-light">Mar '.$Year.'</th>';
$contenid0 .= '<th class="align-middle text-center">Mar '.$Year.'</th>';
$contenid0 .= '<th class="align-middle text-center">Abr '.$Year.'</th>';
$contenid0 .= '<th class="align-middle text-center bg-light">Abr '.$Year.'</th>';
$contenid0 .= '<th class="align-middle text-center bg-light">May '.$Year.'</th>';
$contenid0 .= '<th class="align-middle text-center">May '.$Year.'</th>';
$contenid0 .= '<th class="align-middle text-center">Jun '.$Year.'</th>';
$contenid0 .= '</tr>';
$contenid0 .= '</thead>';
$contenid0 .= '<tbody>';
$contenid0 .= '<tr>';
$contenid0 .= '<td class="align-middle text-center bg-light">'.number_format($DicAnt,2).'</td>';
$contenid0 .= '<td class="align-middle text-center bg-light">'.number_format($Ene,2).'</td>';
$contenid0 .= '<td class="align-middle text-center">'.number_format($Ene,2).'</td>';
$contenid0 .= '<td class="align-middle text-center">'.number_format($Feb,2).'</td>';
$contenid0 .= '<td class="align-middle text-center bg-light">'.number_format($Feb,2).'</td>';
$contenid0 .= '<td class="align-middle text-center bg-light">'.number_format($Mar,2).'</td>';
$contenid0 .= '<td class="align-middle text-center">'.number_format($Mar,2).'</td>';
$contenid0 .= '<td class="align-middle text-center">'.number_format($Abr,2).'</td>';
$contenid0 .= '<td class="align-middle text-center bg-light">'.number_format($Abr,2).'</td>';
$contenid0 .= '<td class="align-middle text-center bg-light">'.number_format($May,2).'</td>';
$contenid0 .= '<td class="align-middle text-center">'.number_format($May,2).'</td>';
$contenid0 .= '<td class="align-middle text-center">'.number_format($Jun,2).'</td>';
$contenid0 .= '</tr>';
$contenid0 .= '<tr>';
$contenid0 .= '<td colspan="2" class="align-middle text-center bg-light">'.$TC1.'</td>';
$contenid0 .= '<td colspan="2" class="align-middle text-center">'.$TC2.'</td>';
$contenid0 .= '<td colspan="2" class="align-middle text-center bg-light">'.$TC3.'</td>';
$contenid0 .= '<td colspan="2" class="align-middle text-center">'.$TC4.'</td>';
$contenid0 .= '<td colspan="2" class="align-middle text-center bg-light">'.$TC5.'</td>';
$contenid0 .= '<td colspan="2" class="align-middle text-center">'.$TC6.'</td>';
$contenid0 .= '</tr>';
$contenid0 .= '</tbody>';
$contenid0 .= '</table>';

$contenid0 .= '<table class="table table-sm table-bordered" style="font-size: .8em;">';
$contenid0 .= '<thead>';
$contenid0 .= '<tr>';
$contenid0 .= '<th class="align-middle text-center bg-light">Jun '.$Year.'</th>';
$contenid0 .= '<th class="align-middle text-center bg-light">Jul '.$Year.'</th>';
$contenid0 .= '<th class="align-middle text-center">Jul '.$Year.'</th>';
$contenid0 .= '<th class="align-middle text-center">Ago '.$Year.'</th>';
$contenid0 .= '<th class="align-middle text-center bg-light">Ago '.$Year.'</th>';
$contenid0 .= '<th class="align-middle text-center bg-light">Sep '.$Year.'</th>';
$contenid0 .= '<th class="align-middle text-center">Sep '.$Year.'</th>';
$contenid0 .= '<th class="align-middle text-center">Oct '.$Year.'</th>';
$contenid0 .= '<th class="align-middle text-center bg-light">Oct '.$Year.'</th>';
$contenid0 .= '<th class="align-middle text-center bg-light">Nov '.$Year.'</th>';
$contenid0 .= '<th class="align-middle text-center">Nov '.$Year.'</th>';
$contenid0 .= '<th class="align-middle text-center">Dic '.$Year.'</th>';
$contenid0 .= '</tr>';
$contenid0 .= '</thead>';
$contenid0 .= '<tbody>';
$contenid0 .= '<tr>';
$contenid0 .= '<td class="align-middle text-center bg-light">'.number_format($Jun,2).'</td>';
$contenid0 .= '<td class="align-middle text-center bg-light">'.number_format($Jul,2).'</td>';
$contenid0 .= '<td class="align-middle text-center">'.number_format($Jul,2).'</td>';
$contenid0 .= '<td class="align-middle text-center">'.number_format($Ago,2).'</td>';
$contenid0 .= '<td class="align-middle text-center bg-light">'.number_format($Ago,2).'</td>';
$contenid0 .= '<td class="align-middle text-center bg-light">'.number_format($Sep,2).'</td>';
$contenid0 .= '<td class="align-middle text-center">'.number_format($Sep,2).'</td>';
$contenid0 .= '<td class="align-middle text-center">'.number_format($Oct,2).'</td>';
$contenid0 .= '<td class="align-middle text-center bg-light">'.number_format($Oct,2).'</td>';
$contenid0 .= '<td class="align-middle text-center bg-light">'.number_format($Nov,2).'</td>';
$contenid0 .= '<td class="align-middle text-center">'.number_format($Nov,2).'</td>';
$contenid0 .= '<td class="align-middle text-center">'.number_format($Dic,2).'</td>';
$contenid0 .= '</tr>';
$contenid0 .= '<tr>';
$contenid0 .= '<td colspan="2" class="align-middle text-center bg-light">'.$TC7.'</td>';
$contenid0 .= '<td colspan="2" class="align-middle text-center">'.$TC8.'</td>';
$contenid0 .= '<td colspan="2" class="align-middle text-center bg-light">'.$TC9.'</td>';
$contenid0 .= '<td colspan="2" class="align-middle text-center">'.$TC10.'</td>';
$contenid0 .= '<td colspan="2" class="align-middle text-center bg-light">'.$TC11.'</td>';
$contenid0 .= '<td colspan="2" class="align-middle text-center">'.$TC12.'</td>';
$contenid0 .= '</tr>';
$contenid0 .= '</tbody>';
$contenid0 .= '</table>';

$contenid0 .= '</div>';

$contenid0 .= '<hr>';

$contenid0 .= '<table class="table table-bordered table-sm pb-0 mb-0" style="font-size: .9em;">';
$contenid0 .= '<tbody>';
$contenid0 .= '<tr>';
$contenid0 .= '<td class="align-middle text-center"><b>Objeto</b></td>';
$contenid0 .= '<td class="align-middle">Capacitación</td>';
$contenid0 .= '<td class="align-middle text-center"><b>Indicador</b></td>';
$contenid0 .= '<td class="align-middle">No. de personal capacitado vs No. de personal de la estación</td>';
$contenid0 .= '</tr>';
$contenid0 .= '<tr>';
$contenid0 .= '<td class="align-middle text-center"><b>Meta</b></td>';
$contenid0 .= '<td class="align-middle">'.Meta($Session_IDEstacion,3,$con).'</td>';
$contenid0 .= '<td class="align-middle text-center"><b>Frecuencia de medición</b></td>';
$contenid0 .= '<td class="align-middle">Semestral</td>';
$contenid0 .= '</tr>';
$contenid0 .= '<tr>';
$contenid0 .= '<td colspan="4">';

$contenid0 .= '<div><b>Resultado:</b></div>';

$contenid0 .= '<table class="border-0" style="width: 100%;">
<tr class="border-0">
<td class="border-0">Primer semestre:<br>'.ResultadoCapacitacion($Session_IDEstacion,$Year,1,$con).'</td>
<td class="border-0">Segundo semestre:<br>'.ResultadoCapacitacion($Session_IDEstacion,$Year,2,$con).'</td>
</tr>
</table>';


$contenid0 .= '</td>';
$contenid0 .= '</tr>';
$contenid0 .= '</tbody>';
$contenid0 .= '</table>';

$contenid0 .= '<hr>';

$contenid0 .= '<table class="table table-bordered table-sm pb-0 mb-0" style="font-size: .9em;">';
$contenid0 .= '<tbody>';
$contenid0 .= '<tr>';
$contenid0 .= '<td class="align-middle text-center"><b>Objeto</b></td>';
$contenid0 .= '<td class="align-middle">Satisfacción del cliente</td>';
$contenid0 .= '<td class="align-middle text-center"><b>Indicador</b></td>';
$contenid0 .= '<td class="align-middle">Media del total de clientes con experiencia: Mala, Buena y Excelente</td>';
$contenid0 .= '</tr>';
$contenid0 .= '<tr>';
$contenid0 .= '<td class="align-middle text-center"><b>Meta</b></td>';
$contenid0 .= '<td class="align-middle">'.Meta($Session_IDEstacion,4,$con).'</td>';
$contenid0 .= '<td class="align-middle text-center"><b>Frecuencia de medición</b></td>';
$contenid0 .= '<td class="align-middle">Semestral</td>';
$contenid0 .= '</tr>';
$contenid0 .= '<tr>';
$contenid0 .= '<td colspan="4">';

$contenid0 .= '<div><b>Resultado:</b></div>';

$contenid0 .= '<table class="border-0" style="width: 100%;">
<tr class="border-0">
<td class="border-0">Primer semestre:<br>'.ResultadoSatisfaccion($Session_IDEstacion,$Year,1,$con).'</td>
<td class="border-0">Segundo semestre:<br>'.ResultadoSatisfaccion($Session_IDEstacion,$Year,2,$con).'</td>
</tr>
</table>';

$contenid0 .= '</td>';
$contenid0 .= '</tr>';
$contenid0 .= '</tbody>';
$contenid0 .= '</table>';

$contenid0 .= '<hr>';

$contenid0 .= '<table class="table table-bordered table-sm c-pointer pb-0 mb-0" style="font-size: .9em;">';
$contenid0 .= '<tbody>';
$contenid0 .= '<tr>';
$contenid0 .= '<td class="align-middle text-center"><b>Objeto</b></td>';
$contenid0 .= '<td class="align-middle">Incidentes y accidentes</td>';
$contenid0 .= '<td class="align-middle text-center"><b>Indicador</b></td>';
$contenid0 .= '<td class="align-middle">No total de accidentes e incidentes ocurridos VS número total de accidentes e incidentes atendidos</td>';
$contenid0 .= '</tr>';
$contenid0 .= '<tr>';
$contenid0 .= '<td class="align-middle text-center"><b>Meta</b></td>';
$contenid0 .= '<td class="align-middle">'.Meta($Session_IDEstacion,5,$con).'</td>';
$contenid0 .= '<td class="align-middle text-center"><b>Frecuencia de medición</b></td>';
$contenid0 .= '<td class="align-middle">Semestral</td>';
$contenid0 .= '</tr>';
$contenid0 .= '<tr>';
$contenid0 .= '<td colspan="4">';

$contenid0 .= '<div><b>Resultado:</b></div>';

$contenid0 .= '<table class="border-0" style="width: 100%;">
<tr class="border-0">
<td class="border-0">Primer semestre:<br>'.ResultadoIncidentes($Session_IDEstacion,$Year,1,$con).'</td>
<td class="border-0">Segundo semestre:<br>'.ResultadoIncidentes($Session_IDEstacion,$Year,2,$con).'</td>
</tr>
</table>';

$contenid0 .= '</td>';
$contenid0 .= '</tr>';
$contenid0 .= '</tbody>';
$contenid0 .= '</table>';

$contenid0 .= '</div>';
$contenid0 .= '</body>';
$contenid0 .= '</html>';


$dompdf->loadHtml($contenid0);
$dompdf->setPaper("A4", "landscape");
$dompdf->render();
$dompdf->get_canvas()->page_text(775, 565, "Pagina: {PAGE_NUM} de {PAGE_COUNT}", $font, 8, array(0,0,0));
$dompdf->stream('REVISIÓN DE RESULTADOS.pdf');

//------------------
mysqli_close($con);
//------------------
?>


