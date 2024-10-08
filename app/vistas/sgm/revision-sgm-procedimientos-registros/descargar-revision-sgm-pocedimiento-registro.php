<?php
require_once 'dompdf/autoload.inc.php';
include_once "app/help.php";

$sql = "SELECT * FROM sgm_revision_procedimiento_registro WHERE id = '".$GET_idRegistro."' ";
$result = mysqli_query($con, $sql);
$numero = mysqli_num_rows($result);
$row = mysqli_fetch_array($result, MYSQLI_ASSOC);
$fecha = $row['fecha'];
$hora = $row['hora'];
$lugar = $row['lugar'];
$realizadopor = realizadoPor($row['realizadopor'],$con);

  function realizadoPor($usuario,$con){
  $sql = "SELECT nombre FROM tb_usuarios WHERE id = '".$usuario."' ";
  $result = mysqli_query($con, $sql);
  $numero = mysqli_num_rows($result);
  $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
  $Nombre = $row['nombre'];
  return $Nombre;
  }

  function revision($idRegistro,$con){
  $contenido = '';
  $sql = "SELECT * FROM sgm_revision_procedimiento_registro WHERE id  = '".$idRegistro."' ";
  $result = mysqli_query($con, $sql);
  $numero = mysqli_num_rows($result);
  $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
  $id = $row['id'];
  $fecha = $row['fecha'];
  $hora = $row['hora'];
  $lugar = $row['lugar'];
  $hora_12 = date("h:i A", strtotime($hora));

  $contenido .= '<table class="table table-bordered table-sm">
  <tr>
  <td><b>Fecha:</b></td>
  <td><b>Hora:</b></td>
  <td><b>Lugar:</b></td>
  </tr>

  <tr>
  <td class="">'.FormatoFecha($fecha).'</td>
  <td class="">'.$hora_12.'</td>
  <td class="">'.$lugar.'</td>
  </tr>

  </table>';

  return $contenido; 
  }

  function detalleRevision($idRegistro,$categoria,$con){
$contenido = '';
$sql = "SELECT * FROM sgm_revision_procedimiento_registro_detalle WHERE id_revision  = '".$idRegistro."' AND categoria = '".$categoria."' ";
$result = mysqli_query($con, $sql);
$numero = mysqli_num_rows($result);
while($row = mysqli_fetch_array($result, MYSQLI_ASSOC)){
$id = $row['id'];
$contenido .= '<div class="mt-2"><h5>'.$row['pregunta'].'</h5></div>';
$contenido .= '<div class="border p-1">'.$row['respuesta'].'</div>';
}
return $contenido;
}

use Dompdf\Dompdf;
$dompdf = new Dompdf();

    $contenid0 = "";
    $contenid0 .= "<!DOCTYPE html>";
    $contenid0 .= "<html>";
    $contenid0 .= "<head>";
    $contenid0 .= "<title>Revisión del SGM, procedimientos y registros</title>";
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
  font-size: .9rem;
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
      $contenid0 .= '<b>Revisión del SGM, procedimientos y registros</b>';
      $contenid0 .= '</td>';
      $contenid0 .= '<td class="align-middle text-center">';
      $contenid0 .= '<b>Fecha de autorización: 01-01-2024</b>';
      $contenid0 .= '</td>';
      $contenid0 .= '</tr>';
      //------------------------------------------------------------------
      $contenid0 .= '<tr>';
      $contenid0 .= '<td class="align-middle text-center">';
      $contenid0 .= 'Fo.SGM.002';
      $contenid0 .= '</td>';
      $contenid0 .= '</tr>';
      //------------------------------------------------------------------
      $contenid0 .= '<tr>';
      $contenid0 .= '<td class="align-middle text-center">';
      $contenid0 .= 'Realizado por: '.$realizadopor;
      $contenid0 .= '</td>';
      $contenid0 .= '<td class="align-middle text-center">';
      $contenid0 .= 'Revisado por:<br> Eduardo Galicia Flores';
      $contenid0 .= '</td>';
      $contenid0 .= '<td class="align-middle text-center">';
      $contenid0 .= 'Autorizado por:<br> '.$Session_ApoderadoLegal.'';
      $contenid0 .= '</td>';
      $contenid0 .= '</tr>';
      $contenid0 .= '</tbody>';
      $contenid0 .= '</table>';
//-----------------------------------------------------------------

    $contenid0 .= revision($GET_idRegistro,$con);
    $contenid0 .= '<h4 class="text-info">SGM</h4>';
    $contenid0 .= detalleRevision($GET_idRegistro,'SGM',$con);
    $contenid0 .= '<hr>';
    $contenid0 .= '<h4 class="mt-2 text-info">Procedimientos</h4>';
    $contenid0 .= detalleRevision($GET_idRegistro,'Procedimientos',$con);
    $contenid0 .= '<hr>';
    $contenid0 .= '<h4 class="mt-2 text-info">Registros</h4>';
    $contenid0 .= detalleRevision($GET_idRegistro,'Registros',$con);


//-----------------------------------------------------------------
$contenid0 .= '</div>';

$contenid0 .= '</body>';
$contenid0 .= '</html>';

$dompdf->loadHtml($contenid0);
$dompdf->setPaper("A4", "portrait");
$dompdf->render();
$canvas = $dompdf->get_canvas();
$canvas->page_text(525, 810, "Página: {PAGE_NUM} de {PAGE_COUNT}", null, 7, array(0, 0, 0));
$dompdf->stream('Revisión del SGM, procedimientos y registros.pdf');
//------------------
mysqli_close($con);
//------------------