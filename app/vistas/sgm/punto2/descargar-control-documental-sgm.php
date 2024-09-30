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
$numero = mysqli_num_rows($result);
$row = mysqli_fetch_array($result, MYSQLI_ASSOC);
$realizadopor = $row['nombre'];

use Dompdf\Dompdf;
$dompdf = new Dompdf();

    $contenid0 = "";
    $contenid0 .= "<!DOCTYPE html>";
    $contenid0 .= "<html>";
    $contenid0 .= "<head>";
    $contenid0 .= "<title>Control documental del SGM</title>";
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

.table-secondary,
.table-secondary > th,
.table-secondary > td {
  background-color: #d6d8db;
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
      $contenid0 .= '<b>Control documental del SGM </b>';
      $contenid0 .= '</td>';
      $contenid0 .= '<td class="align-middle text-center">';
      $contenid0 .= '<b>Fecha de autorización: 01-01-2024</b>';
      $contenid0 .= '</td>';
      $contenid0 .= '</tr>';
      //------------------------------------------------------------------
      $contenid0 .= '<tr>';
      $contenid0 .= '<td class="align-middle text-center">';
      $contenid0 .= 'Fo.SGM.003';
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

      $contenid0 .= '<table class="table table-sm table-bordered">
      <tbody>
        <tr class="table-secondary text-white text-center">
            <td colspan="3"><b>Sistema de gestión de medición </b></td>
        </tr>
        <tr>
            <td class="align-middle"><b>Codificación</b></td>
            <td class="align-middle"><b>Nombre</b></td>
            <td class="align-middle"><b>Fecha de aprobación</b></td>
        </tr>
        <tr>
        <td>SGM.001</td>
        <td>Sistema de Gestión de Medición</td>
        <td>01/01/2024</td>
        </tr>
        </tbody>
        </table>';


      $contenid0 .= '<table class="table table-sm table-bordered">
    <tbody>
        <tr class="table-secondary text-white text-center">
            <td colspan="3"><b>Manual de procedimientos del Sistema de Gestión de Medición</b></td>
        </tr>
        <tr>
            <td class="align-middle"><b>Codificación</b></td>
            <td class="align-middle"><b>Nombre</b></td>
            <td class="align-middle"><b>Fecha de aprobación</b></td>
        </tr>
        <tr>
            <td>Po.SGM.001</td>
            <td>Estructura del sistema de Medición</td>
            <td>01/01/2024</td>
        </tr>
        <tr>
            <td>Po.SGM.002</td>
            <td>Control de Documental del SGM</td>
            <td>01/01/2024</td>
        </tr>
        <tr>
            <td>Po.SGM.003</td>
            <td>Responsabilidades de la Dirección</td>
            <td>01/01/2024</td>
        </tr>
        <tr>
            <td>Po.SGM.004</td>
            <td>Establecimiento de Objetivos enfocados al Cliente</td>
            <td>01/01/2024</td>
        </tr>
        <tr>
            <td>Po.SGM.005</td>
            <td>Gestión de recursos</td>
            <td>01/01/2024</td>
        </tr>
        <tr>
            <td>Po.SGM.006</td>
            <td>Normatividad aplicable a mediciones</td>
            <td></td>
        </tr>
        <tr>
            <td>Po.SGM.007</td>
            <td>Procesos de medición.</td>
            <td>01/01/2024</td>
        </tr>
        <tr>
            <td>Po.SGM.008</td>
            <td>Gestión de Riesgos que impactan en la medición.</td>
            <td>01/01/2024</td>
        </tr>
        <tr>
            <td>Po.SGM.009</td>
            <td>Establecimiento y Seguimiento Confirmación Metrológica</td>
            <td>01/01/2024</td>
        </tr>
        <tr>
            <td>Po.SGM.010</td>
            <td>Auditorias, Internas, externas y Atención de hallazgos</td>
            <td>01/01/2024</td>
        </tr>
        <tr>
            <td class="align-middle">Po.SGM.011</td>
            <td>Evaluación del cumplimiento de Objetivos y revisión por la Dirección.</td>
            <td class="align-middle">01/01/2024</td>
        </tr>
    </tbody>
</table>';

$contenid0 .= '<table class="table table-sm table-bordered">
    <tbody>
        <tr class="table-secondary text-white text-center">
            <td colspan="3"><b>Formatos del Sistema de Gestión de Medición</b></td>
        </tr>
        <tr>
            <td class="align-middle"><b>Codificación</b></td>
            <td class="align-middle"><b>Nombre</b></td>
            <td class="align-middle"><b>Fecha de aprobación</b></td>
        </tr>
        <tr>
            <td>Fo.SGM.001</td>
            <td>Lista de Asistencia</td>
            <td>01/01/2024</td>
        </tr>
        <tr>
            <td>Fo.SGM.002</td>
            <td>Revisión del SGM, formatos y registros</td>
            <td>01/01/2024</td>
        </tr>
        <tr>
            <td>Fo.SGM.003</td>
            <td>Control documental del SGM</td>
            <td>01/01/2024</td>
        </tr>
        <tr>
            <td>Fo.SGM.004</td>
            <td>Seguimiento de objetivos e indicadores</td>
            <td>01/01/2024</td>
        </tr>
        <tr>
            <td>Fo.SGM.005</td>
            <td>Inventario de normatividad aplicable</td>
            <td>01/01/2024</td>
        </tr>
        <tr>
            <td>Fo.SGM.006</td>
            <td>Requisitos legales del SGM</td>
            <td>01/01/2024</td>
        </tr>
        <tr>
            <td>Fo.SGM.007</td>
            <td>Designación de responsable SGM</td>
            <td>01/01/2024</td>
        </tr>
        <tr>
            <td>Fo.SGM.008</td>
            <td>Lista del personal</td>
            <td>01/01/2024</td>
        </tr>
        <tr>
            <td>Fo.SGM.009</td>
            <td>Programa de capacitación interna y externa</td>
            <td>01/01/2024</td>
        </tr>
        <tr>
            <td>Fo.SGM.010</td>
            <td>Capacitación de inducción</td>
            <td>01/01/2024</td>
        </tr>
        <tr>
            <td>Fo.SGM.011</td>
            <td>Inventario de equipo</td>
            <td>01/01/2024</td>
        </tr>
        <tr>
            <td>Fo.SGM.012</td>
            <td>Orden de servicio</td>
            <td>01/01/2024</td>
        </tr>
        <tr>
            <td>Fo.SGM.013</td>
            <td>Evaluación de proveedores</td>
            <td>01/01/2024</td>
        </tr>
        <tr>
            <td>Fo.SGM.014</td>
            <td>Programa anual de calibración de patrones e instrumentos de medida</td>
            <td>01/01/2024</td>
        </tr>
        <tr>
            <td>Fo.SGM.015</td>
            <td>Programa anual de verificación de equipos de medición</td>
            <td>01/01/2024</td>
        </tr>
        <tr>
            <td class="align-middle">Fo.SGM.016</td>
            <td>Bitácora para la verificación de los equipos de medicion</td>
            <td class="align-middle">01/01/2024</td>
        </tr>
        <tr>
            <td>Fo.SGM.017</td>
            <td>Bitácora para la calibración de equipos</td>
            <td>01/01/2024</td>
        </tr>
        <tr>
            <td>Fo.SGM.018</td>
            <td>Plan de auditoria</td>
            <td>01/01/2024</td>
        </tr>
        <tr>
            <td>Fo.SGM.019</td>
            <td>Reporte de Hallazgos de Auditoria</td>
            <td>01/01/2024</td>
        </tr>
        <tr>
            <td>Fo.SGM.020</td>
            <td>Plan de atención de Hallazgos</td>
            <td>01/01/2024</td>
        </tr>
        <tr>
            <td>Fo.SGM.021</td>
            <td>Cumplimiento de objetivos y revision por la alta direccion</td>
            <td>01/01/2024</td>
        </tr>
    </tbody>
</table>';

//-----------------------------------------------------------------
$contenid0 .= '</div>';

$contenid0 .= '</body>';
$contenid0 .= '</html>';


$dompdf->loadHtml($contenid0);
$dompdf->setPaper("A4", "portrait");
$dompdf->render();
$canvas = $dompdf->get_canvas();
$canvas->page_text(525, 810, "Página: {PAGE_NUM} de {PAGE_COUNT}", null, 7, array(0, 0, 0));
$dompdf->stream('Control documental del SGM.pdf');
//------------------
mysqli_close($con);
//------------------