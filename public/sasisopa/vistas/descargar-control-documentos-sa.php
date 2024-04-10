<?php
require_once 'dompdf/autoload.inc.php';
include_once "app/help.php";

use Dompdf\Dompdf;
$dompdf = new Dompdf();


    $contenid0 .= "<!DOCTYPE html>";
    $contenid0 .= "<html>";
    $contenid0 .= "<head>";
    $contenid0 .= "<title>Control y documentos del Sistema de Administración
</title>";
    $contenid0 .= '<style type="text/css">
@page {margin: 0.7cm 0.7cm; font-family: Arial, Helvetica, sans-serif;}
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
</style>';

$contenid0 .= '</head>';
$contenid0 .= '<body';

$contenid0 .= '<div>';
$contenid0 .= '<h5 class="text-center">Control y documentos del Sistema de Administración</h5>';

$contenid0 .= '<table class="table table-sm table-bordered" style="font-size: .95rem">';
$contenid0 .= '<tr>';
$contenid0 .= '<td class="align-middle bg-light" style="padding: 15px;"><b>Elemento del Sistema de Administración</b></td>';
$contenid0 .= '<td class="align-middle bg-light"><b>Código de control</b></th>';
$contenid0 .= '<td class="align-middle bg-light"><b>Nombre del documento o registro</b></td>';
$contenid0 .= '</tr>';
$contenid0 .= '<tbody>';

$contenid0 .= '<tr>
<td class="align-middle">1 POLÍTICA</td>
<td class="align-middle">Fo.ADMONGAS.001</td>
<td class="align-middle">Formato de Revisión de la política del SA</td>
</tr>';
$contenid0 .= '<tr>
<td class="align-middle" rowspan="3">2 IDENTIFICACIÓN DE PELIGROS Y ASPECTOS AMBIENTALES, ANÁLISIS DE RIESGO Y EVALUACIÓN DE IMPACTOS AMBIENTALES</td>
<td class="align-middle">DLES/SA/005</td>
<td class="align-middle">Análisis de Riesgo del Sector Hidrocarburos</td>
</tr>';
$contenid0 .= '
<tr>
<td class="align-middle">Fo.ADMONGAS.002</td>
<td class="align-middle">Identificación y evaluación de Aspectos e Impactos Ambientales.</td>
</tr>
<tr>
<td class="align-middle">Fo.ADMONGAS.003</td>
<td class="align-middle">Identificación y evaluación de Riesgos y Peligros</td>
</tr>
<tr>
<td class="align-middle">3 REQUISITOS LEGALES</td>
<td class="align-middle">Fo.ADMONGAS.004</td>
<td class="align-middle">Calendario Anual de renovación de Requisitos legales</td>
</tr>';
$contenid0 .= '<tr>
<td class="align-middle" rowspan="3">4 OBJETIVOS, METAS E INDICADORES</td>
<td class="align-middle">Fo.ADMONGAS.005</td>
<td class="align-middle">Reporte Estadístico Diario</td>
</tr>
<tr>
<td class="align-middle">Fo.ADMONGAS.006</td>
<td class="align-middle">Seguimiento de objetivos y metas</td>
</tr>
<tr>
<td class="align-middle">Fo.ADMONGAS.007</td>
<td class="align-middle">Seguimiento y reporte de indicadores</td>
</tr>
<tr>
<td class="align-middle" rowspan="2">6 COMPETENCIA DEL PERSONAL, CAPACITACIÓN Y ENTRENAMIENTO</td>
<td class="align-middle">Fo.ADMONGAS.008</td>
<td class="align-middle">Fichas de personal</td>
</tr>
<tr>
<td class="align-middle">FO.ADMONGAS.009</td>
<td class="align-middle">Registros de la implementación del programa de Capacitación. </td>
</tr>
<tr>
<td class="align-middle">7 COMUNICACIÓN, PARTICIPACIÓN Y CONSULTA</td>
<td class="align-middle">Fo.ADMONGAS.010</td>
<td class="align-middle">Bitácoras con el registro de la atención y el seguimiento a la comunicación interna y externa.</td>
</tr>
<tr>
<td class="align-middle" rowspan="4">10 CONTROL DE ACTIVIDADES Y PROCESOS</td>
            <td class="align-middle">DLES.ADMONGAS.001</td>
            <td class="align-middle">Procedimientos de operación, seguridad y mantenimiento</td>
          </tr>
          <tr>
            <td class="align-middle">DLES.ADMONGAS.002</td>
            <td class="align-middle">Bitácora de mantenimiento preventivo y correctivo</td>
            </tr>          
          <tr>
            <td class="align-middle">DLES.ADMONGAS.003 </td>
            <td class="align-middle">Bitácora de operación </td>
            </tr>
          <tr>
            <td class="align-middle">Fo.ADMONGAS.011</td>
            <td class="align-middle">Programa anual de mantenimiento</td>
            </tr>
          <tr>
            <td class="align-middle" rowspan="3">11 INTEGRIDAD MECÁNICA Y ASEGURAMIENTO DE LA CALIDAD</td>
            <td class="align-middle">DLES.ADMONGAS.001</td>
            <td class="align-middle">Procedimientos de operación, seguridad y mantenimiento</td>
            </tr>
          <tr>
            <td class="align-middle">DLES.ADMONGAS.002</td>
            <td class="align-middle">Bitácora de mantenimiento preventivo y correctivo</td>
            </tr>
          <tr>
            <td class="align-middle">Fo.ADMONGAS.011</td>
            <td class="align-middle">Programa anual de mantenimiento</td>
            </tr>
          <tr>
            <td class="align-middle" rowspan="5">12 SEGURIDAD DE CONTRATISTAS</td>
            <td class="align-middle">DLES.ADMONGAS.001</td>
            <td class="align-middle">Procedimientos de operación, seguridad y mantenimiento </td>
            </tr>
          <tr>
            <td class="align-middle">Fo.ADMONGAS.012</td>
            <td class="align-middle">Autorización para realizar trabajos peligrosos</td>
            </tr>
          <tr>
            <td class="align-middle">Fo.ADMONGAS.013</td>
            <td class="align-middle">Formato para requisición de obra o servicio.</td>
            </tr>
          <tr>
            <td class="align-middle">FO.ADMONGAS.014</td>
            <td class="align-middle">Formato para entrega de información al contratista.</td>
            </tr>
          <tr>
            <td class="align-middle">Fo.ADMONGAS.015</td>
            <td class="align-middle">Listas de verificación.</td>
            </tr>
          <tr>
            <td class="align-middle" rowspan="3">13 PREPARACIÓN Y RESPUESTA A EMERGENCIAS</td>
            <td class="align-middle">DLES/SA/004</td>
            <td class="align-middle">Protocolo de Respuesta Emergencias</td>
            </tr>
          
          <tr>
            <td class="align-middle">Fo.ADMONGAS.016</td>
            <td class="align-middle">Programa anual de simulacros</td>
            </tr>
          <tr>
            <td class="align-middle">Fo.ADMONGAS.16ª</td>
            <td class="align-middle">Evaluación de simulacros</td>
            </tr>
          <tr>
            <td class="align-middle" rowspan="7">14 MONITOREO, VERIFICACIÓN Y EVALUACIÓN</td>
            <td class="align-middle">Fo.ADMONGAS.017</td>
            <td class="align-middle">Programa de implementación del Sistema de administración </td>
            </tr>
          <tr>
            <td class="align-middle">Fo.ADMONGAS.019</td>
            <td class="align-middle">Relación de equipos sometidos a calibración </td>
            </tr>
          <tr>
            <td class="align-middle">Fo.ADMONGAS.020</td>
            <td class="align-middle">Calendario de calibraciones</td>
            </tr>
          <tr>
            <td class="align-middle">DLES.ADMONGAS.002</td>
            <td class="align-middle">Bitácora con los resultados de la calibración y mantenimiento de equipos</td>
          </tr>
          <tr>
            <td class="align-middle">Fo.ADMONGAS.021</td>
            <td class="align-middle">Matriz de evaluación del cumplimiento legal.</td>
            </tr>
          <tr>
            <td class="align-middle">Fo.ADMONGAS.022</td>
            <td class="align-middle">Informe de Resultados de la evaluación del cumplimiento de requisitos legales y otros aplicables al Proyecto.</td>
            </tr>
          <tr>
            <td class="align-middle">Fo.ADMONGAS.018 </td>
            <td class="align-middle">Programa de Atención de Hallazgos (acciones preventivas y correctivas)</td>
            </tr>
           <tr>
            <td class="align-middle" rowspan="3">15 AUDITORÍAS</td>
            <td class="align-middle">Fo.ADMONGAS.023</td>
            <td class="align-middle">Programa Anual de Auditorías (Auditorías internas y, en su caso, la Auditoría Externa).</td>
            </tr>
          <tr>
            <td class="align-middle">Fo.ADMONGAS.024</td>
            <td class="align-middle">El informe de Auditoría</td>
            </tr>
          <tr>
            <td class="align-middle">Fo.ADMONGAS.025</td>
            <td class="align-middle">Plan de atención de hallazgos </td>
            </tr>
          <tr>
            <td class="align-middle">16 INVESTIGACIÓN DE INCIDENTES Y ACCIDENTES</td>
            <td class="align-middle">Fo.ADMONGAS.026</td>
            <td class="align-middle">Informe detallado de la Investigación de Causa Raíz de los Eventos tipo 1 </td>
            </tr>
          <tr>
            <td class="align-middle">17 REVISIÓN DE RESULTADOS</td>
            <td class="align-middle">FO.ADMONGAS.027</td>
            <td class="align-middle">Informe de revisión de resultados emitido por la alta dirección, bajo el FO.ADMONGAS.027</td>
            </tr>
           <tr>
            <td class="align-middle" rowspan="2">18 INFORMES DE DESEMPEÑO</td>
            <td class="align-middle">Fo.ADMONGAS.028</td>
            <td class="align-middle">IED. Mientras la agencia no emita un formato para este apartado se utilizara provisionalmente</td>
            </tr>
           <tr>
            <td class="align-middle">Fo.ADMONGAS.029 </td>
            <td class="align-middle">Bitácoras de las visitas de control de la implementación de los procedimientos técnicos y administrativos especificados en las DACG SASISOPA Expendio al Público.</td>
            </tr>';

$contenid0 .= '</tbody>';
$contenid0 .= '</table>';

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
$dompdf->stream('Control y documentos del Sistema de Administración.pdf',["Attachment" => true]);
//------------------
mysqli_close($con);
//------------------