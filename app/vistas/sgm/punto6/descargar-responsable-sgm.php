<?php
require_once 'dompdf/autoload.inc.php';
include_once "app/help.php";

function responsable($id,$con){
$sql = "SELECT nombre, firma FROM tb_usuarios WHERE id = '".$id."' ";
$result = mysqli_query($con, $sql);
$numero = mysqli_num_rows($result);
$row = mysqli_fetch_array($result, MYSQLI_ASSOC);
$nombre = $row['nombre'];
$firma = $row['firma'];

$array = array('nombre' => $nombre, 'firma' => $firma);

return $array;
}

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
$numero = mysqli_num_rows($result);
$row = mysqli_fetch_array($result, MYSQLI_ASSOC);
$realizadopor = $row['nombre'];

$sql_responsable = "SELECT
sgm_responsable.id,
sgm_responsable.id_estacion,
sgm_responsable.fecha,
sgm_responsable.responsable,
sgm_responsable.auxiliar,
tb_estaciones.razonsocial,
tb_estaciones.direccioncompleta,
tb_estaciones.di_estado,
tb_estaciones.di_municipio,
tb_estaciones.apoderado_legal,
tb_estaciones.firma
FROM sgm_responsable 
INNER JOIN tb_estaciones 
ON sgm_responsable.id_estacion = tb_estaciones.id WHERE sgm_responsable.id = '".$GET_idRegistro."' ";
$result_responsable = mysqli_query($con, $sql_responsable);
$numero_responsable = mysqli_num_rows($result_responsable);
$row_responsable = mysqli_fetch_array($result_responsable, MYSQLI_ASSOC);
$fecha = FormatoFecha($row_responsable['fecha']);

$responsable = responsable($row_responsable['responsable'],$con);
$auxiliar = responsable($row_responsable['auxiliar'],$con);

use Dompdf\Dompdf;
$dompdf = new Dompdf();

    $contenid0 = "";
    $contenid0 .= "<!DOCTYPE html>";
    $contenid0 .= "<html>";
    $contenid0 .= "<head>";
    $contenid0 .= "<title>Comunicación interna</title>";
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
.text-right {
  text-align: right !important;
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

.p-2 {
  padding: 0.5rem !important;
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
      $contenid0 .= '<b>Designación de responsable SGM</b>';
      $contenid0 .= '</td>';
      $contenid0 .= '<td class="align-middle text-center">';
      $contenid0 .= '<b>Fecha de autorización: 01-01-2024</b>';
      $contenid0 .= '</td>';
      $contenid0 .= '</tr>';
      //------------------------------------------------------------------
      $contenid0 .= '<tr>';
      $contenid0 .= '<td class="align-middle text-center">';
      $contenid0 .= 'Fo.SGM.007';
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

$contenid0 .= '<div class="text-right"><p>'.$row_responsable['di_municipio'].', '.$row_responsable['di_estado'].' a '.$fecha.'</p></div>';

$contenid0 .= '<p>A QUIEN CORRESPONDA</br>
              COMISIÓN REGULADORA DE ENERGÍA</br>
              PRESENTE:</p>';

$contenid0 .= '<p><b>'.$row_responsable['apoderado_legal'].'</b> en carácter de representante legal de la estacion <b>'.$row_responsable['razonsocial'].'</b> con ubicación en <b>'.$row_responsable['direccioncompleta'].'</b></p>';

  $contenid0 .= '<p>Sírvase la presente para designar la persona que será el responsable de la implementación y adecuada operación del Sistema de Gestión de Mediciones, así como al personal especializado que auxiliará en dichas tareas. </p>
  <p>Quienes tienen las siguientes responsabilidades, (entre otras):</p>';

  $contenid0 .= '<ol>
   <li>Asegurar que las actividades del SGM se apeguen a los procedimientos correspondientes.</li>
   <li>Elaborar los reportes e información sobre el SGM requerida por la Comisión o por la Empresa especializada que los solicite como parte de una visita de verificación.</li>
   <li>Conservar la documentación relativa al SGM para su consulta por la Comisión cuando ésta lo requiera o para consulta de otros Permisionarios, o usuarios del sistema de almacenamiento permisionado por un periodo mínimo de 10 años.</li>
   <li>Generar, organizar, implementar cambios, difundir, almacenar y dar trazabilidad a toda la información derivada de la operación del SGM.</li>
   </ol>
   
   <p>La designación del grupo de personas se realizó por así convenir a mi representada, eligiendo personal relacionado directamente con la operación de la empresa.</p>
';

  $RutaFirmaR = RUTA_IMG_FIRMA_PERSONAL.$responsable['firma'];
  $DataFirmaR = file_get_contents($RutaFirmaR);
  $baseFirmaR = 'data:image/;base64,' . base64_encode($DataFirmaR);

  $RutaFirmaA = RUTA_IMG_FIRMA_PERSONAL.$auxiliar['firma'];
  $DataFirmaA = file_get_contents($RutaFirmaA);
  $baseFirmaA = 'data:image/;base64,' . base64_encode($DataFirmaA);

  $RutaFirmaApoderado = RUTA_IMG_FIRMA_PERSONAL.$Session_ApoderadoLegalFirma;
  $DataFirmaApoderado = file_get_contents($RutaFirmaApoderado);
  $baseFirmaApoderado = 'data:image/;base64,' . base64_encode($DataFirmaApoderado);

$contenid0 .= '<table style="width: 100%;margin-top: 40px;">
  <tr>
    <td class="text-center">
    <b>Nombre y firma de conformidad del responsable de implementacion del Sistema de Gestión de Medición</b>
    <div class="p-1"><img src="'.$baseFirmaR.'" style="width: 120px;"></div>
    <div>'.$responsable['nombre'].'</div>
    </td>

    <td class="text-center">
    <b>Personal especializado que auxiliará en las tareas de implementacion del Sistema de Gestión de Medición</b>
    <div class="p-1"><img src="'.$baseFirmaA.'" style="width: 120px;"></div>
    <div>'.$auxiliar['nombre'].'</div>
    </td>
  </tr>
</table>';

$contenid0 .= '<table style="width: 100%;margin-top: 40px;">
  <tr>
    <td class="text-center">
    <b>Representante legal</b>
    <div class="p-1"><img src="'.$baseFirmaApoderado.'" style="width: 120px;"></div>
    <div>'.$Session_ApoderadoLegal.'</div>
    </td>
  </tr>
</table>';


//-----------------------------------------------------------------
$contenid0 .= '</div>';

$contenid0 .= '</body>';
$contenid0 .= '</html>';

$dompdf->loadHtml($contenid0);
$dompdf->setPaper("A4", "portrait");
$dompdf->render();
$dompdf->stream('Designación de responsable SGM.pdf');
//------------------
mysqli_close($con);
//------------------