<?php
require_once 'dompdf/autoload.inc.php';
include_once "app/help.php";

$sql = "SELECT
sgm_autorizado.id,
sgm_autorizado.id_usuario,
tb_usuarios.nombre,
tb_usuarios.id_gas
FROM sgm_autorizado 
INNER JOIN tb_usuarios 
ON sgm_autorizado.id_usuario = tb_usuarios.id WHERE 
tb_usuarios.id_gas = '".$Session_IDEstacion."' AND sgm_autorizado.estado = 1 LIMIT 1 ";
$result = mysqli_query($con, $sql);
$row = mysqli_fetch_array($result, MYSQLI_ASSOC);
$realizadopor = $row['nombre'];

function Manual($idEquipo,$con){

    $return = "";
    $sql_manual = "SELECT * FROM sgm_inventario_equipo_manual WHERE id_equipo = '".$idEquipo."' ";
    $result_manual = mysqli_query($con, $sql_manual);
    $numero_manual = mysqli_num_rows($result_manual);
    $num = 1;

    while($row_manual = mysqli_fetch_array($result_manual, MYSQLI_ASSOC)){
    $return .= '<a style="font-size: .7em;" href="'.RUTA_ARCHIVOS.'manuales/'.$row_manual['archivo'].'">'.$row_manual['archivo'].'</a> ';
    $num++;
    }

    return $return;
}

use Dompdf\Dompdf;
$dompdf = new Dompdf();
    
    $contenid0 = "";
    $contenid0 .= "<!DOCTYPE html>";
    $contenid0 .= "<html>";
    $contenid0 .= "<head>";
    $contenid0 .= "<title>Inventario de equipo</title>";
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
  font-size: .8rem;
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
      $contenid0 .= '<b>Inventario de equipo</b>';
      $contenid0 .= '</td>';
      $contenid0 .= '<td class="align-middle text-center">';
      $contenid0 .= '<b>Fecha de autorización: 01-01-2024</b>';
      $contenid0 .= '</td>';
      $contenid0 .= '</tr>';
      //------------------------------------------------------------------
      $contenid0 .= '<tr>';
      $contenid0 .= '<td class="align-middle text-center">';
      $contenid0 .= 'Fo.SGM.011';
      $contenid0 .= '</td>';
      $contenid0 .= '</tr>';
      //------------------------------------------------------------------
      $contenid0 .= '<tr>';
      $contenid0 .= '<td class="align-middle text-center">';
      $contenid0 .= 'Realizado por: '.$realizadopor;
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

$sql_lista = "SELECT * FROM sgm_inventario_equipo WHERE id_estacion = '".$Session_IDEstacion."' AND estado < 2 ORDER BY nombre DESC ";
$result_lista = mysqli_query($con, $sql_lista);
$numero_lista = mysqli_num_rows($result_lista);
$numero_lista = mysqli_num_rows($result_lista);

$contenid0 .= '<table class="table table-bordered table-striped table-hover table-sm mb-0 pb-0">
<thead>
<tr>
  <th class="text-center align-middle">#</th>
  <th class="text-center align-middle">Nombre del equipo de medición</th>
  <th class="text-center align-middle">Identificación</th>
  <th class="text-center align-middle">Función que desempeña dentro de la ES</th>
  <th class="text-center align-middle">Fecha de instalación</th>
  <th class="text-center align-middle">Manuales, garantías  o información documental del equipo</th>
</tr>
</thead>
<tbody>';

$num = 1;
if ($numero_lista > 0) {
while($row_lista = mysqli_fetch_array($result_lista, MYSQLI_ASSOC)){

  if($row_lista['fecha_instalacion'] == '0000-00-00'){
    $fecha = '';
  }else{
    $fecha = FormatoFecha($row_lista['fecha_instalacion']);
  }

 $manual = Manual($row_lista['id'],$con);

$contenid0 .= "<tr>";
$contenid0 .= "<td class='text-center align-middle'>".$num."</td>";
$contenid0 .= "<td class='text-center align-middle'>".$row_lista['nombre']."</td>";
$contenid0 .= "<td class='text-center align-middle'>".$row_lista['identificacion']."</td>";
$contenid0 .= "<td class='text-center align-middle'>".$row_lista['funcion']."</td>";
$contenid0 .= "<td class='text-center align-middle'>".$fecha."</td>";

$contenid0 .= "<td class='text-center align-middle'>".$manual."</td>";

$contenid0 .= "</tr>";
$num++;
}
}else{
$contenid0 .= "<td colspan='8' class='text-center text-secondary' style='font-size: .8em;'>No se encontró información para mostrar</td>";
}

$contenid0 .= '</tbody>
</table>';

//-----------------------------------------------------------------
$contenid0 .= '</div>';

$contenid0 .= '</body>';
$contenid0 .= '</html>';

$dompdf->loadHtml($contenid0);
$dompdf->setPaper("A4", "landscape");
$dompdf->render();
$canvas = $dompdf->get_canvas();
$canvas->page_text(770, 570, "Página: {PAGE_NUM} de {PAGE_COUNT}", null, 8, array(0, 0, 0));
$dompdf->stream('Inventario de equipo.pdf');
//------------------
mysqli_close($con);
//------------------