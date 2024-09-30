<?php
require_once 'dompdf/autoload.inc.php';
include_once "app/help.php";

$sql = "SELECT
sgm_autorizado.id_usuario,
sgm_autorizado.estado,
tb_usuarios.id_gas
FROM sgm_autorizado 
INNER JOIN tb_usuarios 
ON sgm_autorizado.id_usuario = tb_usuarios.id WHERE tb_usuarios.id_gas = '".$Session_IDEstacion."' AND sgm_autorizado.estado = 1 LIMIT 1";
$result = mysqli_query($con, $sql);
$numero = mysqli_num_rows($result);
if ($numero > 0) {
$row = mysqli_fetch_array($result, MYSQLI_ASSOC);
$realizadopor = usuario($row['id_usuario'],$con);
}else{
$realizadopor = '';
}

function usuario($usuario,$con){
  $sql = "SELECT tb_usuarios.nombre, 
  tb_usuarios.firma, 
  tb_puestos.tipo_puesto
  FROM tb_usuarios
  INNER JOIN tb_puestos
  ON tb_usuarios.id_puesto = tb_puestos.id WHERE tb_usuarios.id = '".$usuario."' ";
  $result = mysqli_query($con, $sql);
  $numero = mysqli_num_rows($result);
  $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
  $Nombre = $row['nombre'];
  $puesto = $row['tipo_puesto'];
  $firma = $row['firma'];

  $array = array('nombre' => $Nombre, 'puesto' => $puesto, 'firma' => $firma);
  return $array;
  }

function Personal($id,$con){
$return = '';
$num = 1;
$sql = "SELECT * FROM sgm_programa_anual_capacitacion_externa_personal WHERE id_capacitacion  = '".$id."'";
$result = mysqli_query($con, $sql);
$numero = mysqli_num_rows($result);
while($row = mysqli_fetch_array($result, MYSQLI_ASSOC)){
if($numero == $num){
$sep = '';
}else{
$sep = ',';
}
$usuario = usuario($row['id_usuario'],$con);
$return .= '<small style="font-size: .6em;">'.$usuario['nombre'].'</small>'.$sep.' ';
$num++;
}
return $return;
}

function Evidencia($id,$con){
$return = '';
$num = 1;
$sql = "SELECT * FROM sgm_programa_anual_capacitacion_externa_evidencia WHERE id_capacitacion  = '".$id."'";
$result = mysqli_query($con, $sql);
$numero = mysqli_num_rows($result);
while($row = mysqli_fetch_array($result, MYSQLI_ASSOC)){
if($numero == $num){
$sep = '';
}else{
$sep = ',';
}

$return .= '<a style="font-size: .6em;" href="'.RUTA_ARCHIVOS.'sgm/'.$row['archivo'].'">'.$row['archivo'].'<a>'.$sep.' ';
$num++;
}
return $return;
}

$sql = "SELECT * FROM sgm_programa_anual_capacitacion_externa WHERE id_estacion = '".$Session_IDEstacion."' ORDER BY fecha_programada DESC";
$result = mysqli_query($con, $sql);
$numero = mysqli_num_rows($result);

use Dompdf\Dompdf;
$dompdf = new Dompdf();

    $contenid0 = "";
    $contenid0 .= "<!DOCTYPE html>";
    $contenid0 .= "<html>";
    $contenid0 .= "<head>";
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
  font-size: .80rem;
  font-weight: 400;
  line-height: 1.5;
  color: #212529;
  background-color: #fff;
}

.text-center {
  text-align: center !important;
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

h1, h2, h3, h4, h5, h6 {
  margin-top: 0;
  margin-bottom: 0.5rem;
}

h4, .h4 {
  font-size: 1.2rem;
}

hr {
  margin-top: 1rem;
  margin-bottom: 1rem;
  border: 0;
  border-top: 1px solid rgba(0, 0, 0, 0.1);
}

.mt-2,
.my-2 {
  margin-top: 0.5rem !important;
}

.text-info {
  color: #17a2b8 !important;
}

.border {
  border: 1px solid #dee2e6 !important;
}

.p-1 {
  padding: 0.25rem !important;
}
.p-3 {
  padding: 1rem !important;
}
.mb-2,
.my-2 {
  margin-bottom: 0.5rem !important;
}

.mt-3,
.my-3 {
  margin-top: 1rem !important;
}
</style>';

$contenid0 .= '</head>';
$contenid0 .= '<body';


$contenid0 .= '<div>';

      $contenid0 .= '<table class="table table-bordered">';
      $contenid0 .= '<tbody>';
      $contenid0 .= '<tr>';
      $contenid0 .= '<td class="align-middle text-center" rowspan="2">';
      $contenid0 .= $Session_Razonsocial;
      $contenid0 .= '</td>';
      $contenid0 .= '<td class="align-middle text-center" rowspan="2">';
      $contenid0 .= '<b>Programa anual de capacitacion interna y externa</b>';
      $contenid0 .= '</td>';
      $contenid0 .= '<td class="align-middle text-center">';
      $contenid0 .= '<b>Fecha de autorización: 01-01-2024</b>';
      $contenid0 .= '</td>';
      $contenid0 .= '</tr>';
      //------------------------------------------------------------------
      $contenid0 .= '<tr>';
      $contenid0 .= '<td class="align-middle text-center">';
      $contenid0 .= 'Fo.SGM.009';
      $contenid0 .= '</td>';
      $contenid0 .= '</tr>';
      //------------------------------------------------------------------
      $contenid0 .= '<tr>';
      $contenid0 .= '<td class="align-middle text-center">';
      $contenid0 .= 'Realizado por: '.$realizadopor['nombre'];
      $contenid0 .= '</td>';
      $contenid0 .= '<td class="align-middle text-center">';
      $contenid0 .= 'Revisado por:<br> Nelly Estrada Garcia ';
      $contenid0 .= '</td>';
      $contenid0 .= '<td class="align-middle text-center">';
      $contenid0 .= 'Autorizado por:<br> '.$Session_ApoderadoLegal.'';
      $contenid0 .= '</td>';
      $contenid0 .= '</tr>';
      $contenid0 .= '</tbody>';
      $contenid0 .= '</table>';
//-----------------------------------------------------------------

$contenid0 .= '<table class="table table-bordered table-striped table-hover table-sm mb-0 pb-0">
<thead>
<tr>
  <th class="text-center align-middle">No</th>
  <th class="text-center align-middle">Nombre del curso</th>
  <th class="text-center align-middle">Tipo de capacitacion</th>
  <th class="text-center align-middle">Fecha programada</th>
  <th class="text-center align-middle">Duracion</th>
  <th class="text-center align-middle">Instructor</th>
  <th class="text-center align-middle">Fecha real de la toma del curso</th>
  <th class="text-center align-middle" width="200px">Nombre de las personas que asistieron al curso</th>
  <th class="text-center align-middle" width="135px">Evidencia</th>
</tr>
</thead>
<tbody>';

$num = 1;
if ($numero > 0) {
while($row = mysqli_fetch_array($result, MYSQLI_ASSOC)){

  if($row['fecha_real'] != '0000-00-00'){
  $fecha_real = FormatoFecha($row['fecha_real']);
  }else{
  $fecha_real = 'S/I';
  }

$contenid0 .= "<tr>";
$contenid0 .= "<td class='text-center align-middle'>".$num."</td>";

$contenid0 .= "<td class='text-center align-middle'>".$row['nombre_curso']."</td>";
$contenid0 .= "<td class='text-center align-middle'>".$row['tipo_capacitacion']."</td>";
$contenid0 .= "<td class='text-center align-middle'>".FormatoFecha($row['fecha_programada'])."</td>";
$contenid0 .= "<td class='text-center align-middle'>".$row['duracion']."</td>";
$contenid0 .= "<td class='text-center align-middle'>".$row['instructor']."</td>";
$contenid0 .= "<td class='text-center align-middle'>".$fecha_real."</td>";
$contenid0 .= "<td class='text-center align-middle'>".Personal($row['id'],$con)."</td>";
$contenid0 .= "<td class='text-center align-middle'>".Evidencia($row['id'],$con)."</td>";
$contenid0 .= "</tr>";
$num++;
}
}else{
$contenid0 .= "<td colspan='9' class='text-center text-secondary' style='font-size: .8em;'>No se encontró información para mostrar</td>";
}

$contenid0 .= '</tbody></table>';

//-----------------------------------------------------------------
$contenid0 .= '</div>';

$contenid0 .= '</body>';
$contenid0 .= '</html>';

$dompdf->loadHtml($contenid0);
$dompdf->setPaper("A4", "landscape");
$dompdf->render();
$dompdf->stream('Programa anual de capacitacion interna y externa.pdf');
//------------------
mysqli_close($con);
//------------------