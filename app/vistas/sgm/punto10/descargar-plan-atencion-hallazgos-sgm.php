<?php
require_once 'dompdf/autoload.inc.php';
include_once "app/help.php";

function usuario($usuario,$con){
  $sql = "SELECT tb_usuarios.nombre,
  tb_usuarios.firma, 
  tb_puestos.tipo_puesto
  FROM tb_usuarios
  INNER JOIN tb_puestos
  ON tb_usuarios.id_puesto = tb_puestos.id WHERE tb_usuarios.id = '".$usuario."' ";
    $result = mysqli_query($con, $sql);
    $numero = mysqli_num_rows($result);
    if($numero >= 1){
    $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
    $Nombre = $row['nombre'];
    $puesto = $row['tipo_puesto'];
    $firma = $row['firma'];
    }else{
    $Nombre = '';
    $puesto = '';
    $firma = '';
    }
    $array = array('nombre' => $Nombre, 'puesto' => $puesto, 'firma' => $firma);
    return $array;
    }

$sql = "SELECT * FROM sgm_plan_atencion_hallazgos WHERE id_auditoria = '".$GET_idRegistro."' ";
$result = mysqli_query($con, $sql);
$numero = mysqli_num_rows($result);
$row = mysqli_fetch_array($result, MYSQLI_ASSOC);
$id = $row['id'];
$fecha = ($row['fecha'] == '0000-00-00') ?  'S/I' : FormatoFecha($row['fecha']);
$sitio_area = $row['sitio_area'];

$responsable = $row['responsable'];
$nom_responsable = usuario($row['responsable'],$con);

$hallazgo = $row['hallazgo'];
$analisis_causa = $row['analisis_causa'];
$acciones_hallazgos = $row['acciones_hallazgos'];
$fecha_complimiento = $row['fecha_complimiento'];
$recursos_implementacion = $row['recursos_implementacion'];
$fecha_atencion_hallazgos = $row['fecha_atencion_hallazgos'];

$responsable_sgm = $row['responsable_sgm']; 
$nom_responsable_sgm = usuario($row['responsable_sgm'],$con);

$realizadopor = usuario($row['realizadopor'],$con);

use Dompdf\Dompdf;
$dompdf = new Dompdf();
    
    $contenid0 = "";
    $contenid0 .= "<!DOCTYPE html>";
    $contenid0 .= "<html>";
    $contenid0 .= "<head>";
    $contenid0 .= "<title>Plan de atencion de Hallazgos</title>";
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

.bg-secondary {
  background-color: #6c757d !important;
}

.text-white {
  color: #fff !important;
}

.m-0 {
  margin: 0 !important;
}

.p-0 {
  padding: 0 !important;
}

.bg-light {
  background-color: #f8f9fa !important;
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
      $contenid0 .= '<b>Plan de atencion de Hallazgos</b>';
      $contenid0 .= '</td>';
      $contenid0 .= '<td class="align-middle text-center">';
      $contenid0 .= '<b>Fecha de autorización: 01-01-2024</b>';
      $contenid0 .= '</td>';
      $contenid0 .= '</tr>';
      //------------------------------------------------------------------
      $contenid0 .= '<tr>';
      $contenid0 .= '<td class="align-middle text-center">';
      $contenid0 .= 'Fo.SGM.020';
      $contenid0 .= '</td>';
      $contenid0 .= '</tr>';
      //------------------------------------------------------------------
      $contenid0 .= '<tr>';
      $contenid0 .= '<td class="align-middle text-center">';
      $contenid0 .= 'Realizado por: '.$realizadopor['nombre'];
      $contenid0 .= '</td>';
      $contenid0 .= '<td class="align-middle text-center">';
      $contenid0 .= 'Revisado por:<br> Eduardo Galicia Flores ';
      $contenid0 .= '</td>';
      $contenid0 .= '<td class="align-middle text-center">';
      $contenid0 .= 'Autorizado por:<br> '.$Session_ApoderadoLegal.'';
      $contenid0 .= '</td>';
      $contenid0 .= '</tr>';
      $contenid0 .= '</tbody>';
      $contenid0 .= '</table>';
//-----------------------------------------------------------------

    $contenid0 .= '<table class="table table-bordered table-sm">
        <tbody>
          <tr class="bg-secondary text-white">
            <td colspan="3"><b>I.  DATOS GENERALES DEL PERMISIONARIO</b></td>
          </tr>
          <tr>
            <td class="bg-light">NOMBRE, DENOMINACIÓN O RAZÓN SOCIAL:</td>
            <td class="bg-light">PERMISO CRE:</td>
            <td class="bg-light">FECHA DEL INFORME DE AUDITORÍA (Reporte de hallazgos de auditorias):</td>
          </tr>
          <tr>
            <td class="bg-light">'.$Session_Razonsocial.'</td>
            <td class="bg-light">'.$Session_Permisocre.'</td>
            <td class="">'.$fecha.'</td>
          </tr>
          <tr>
            <td colspan="2" class="bg-light">SITIO/ÁREA:</td>
            <td class="bg-light">RESPONSABLE</td>
          </tr>
          <tr>
            <td class="" colspan="2">'.$sitio_area.'</td>
            <td class="">'.$nom_responsable['nombre'].'</td>
          </tr>

          <tr class="bg-secondary text-white">
            <td colspan="3"><b>II.  HALLAZGO: (DESCRIPCIÓN/EVIDENCIA/CRITERIO)</b></td>
          </tr>
          <tr>
            <td colspan="3" class="">'.$hallazgo.'</td>
          </tr>

          <tr class="bg-secondary text-white">
            <td colspan="3"><b>III. ANÁLISIS DE LA CAUSA RAÍZ</b></td>
          </tr>
          <tr>
             <td colspan="3" class="">'.$analisis_causa.'</td>
          </tr>

          <tr class="bg-secondary text-white">
            <td colspan="3"><b>IV. ACCIONES PARA LA ATENCIÓN DE LOS HALLAZGOS NO CONFORMES</b></td>
          </tr>
          <tr>
            <td colspan="3" class="">'.$acciones_hallazgos.'</td>
          </tr>

          <tr>
            <td colspan="2" class="bg-secondary text-white align-middle">
            <b>V. NOMBRE DE LOS RESPONSABLES DEL CUMPLIMIENTO DE LAS ACCIONES</b>
            </td>
            <td class="p-0 m-0">';

            $sql_pc = "SELECT * FROM sgm_plan_atencion_hallazgos_responsables WHERE id_plan = '".$GET_idRegistro."' ";
            $result_pc = mysqli_query($con, $sql_pc);
            $numero_pc = mysqli_num_rows($result_pc);

            $contenid0 .= '<table class="table table-bordered table-sm m-0">';
            while($row_pc = mysqli_fetch_array($result_pc, MYSQLI_ASSOC)){

            $nombre = usuario($row_pc['id_responsable'],$con);

            $contenid0 .= '<tr>
            <td><small>'.$nombre['nombre'].'</small></td>
            </tr>';
            }
            $contenid0 .= '</table>';
            
            $contenid0 .= '</td>
          </tr>

          <tr class="bg-secondary text-white">
            <td colspan="3"><b>VI. FECHAS COMPROMISO PARA EL CUMPLIMIENTO DE LA IMPLEMENTACIÓN DE ACCIONES</b></td>
          </tr>
          <tr>
            <td colspan="3" class="">'.$fecha_complimiento.'</td>
          </tr>

          <tr class="bg-secondary text-white">
            <td colspan="3"><b>VII. RECURSOS ASIGNADOS PARA LA IMPLEMENTACIÓN DE ACCIONES</b></td>
          </tr>
          <tr>
            <td colspan="3" class="">'.$recursos_implementacion.'</td>
          </tr>

        </tbody>
      </table>';

      $RutaFirma = RUTA_IMG_FIRMA_PERSONAL.$nom_responsable_sgm['firma'];
      $DataFirma = file_get_contents($RutaFirma);
      $baseFirma = 'data:image/;base64,' . base64_encode($DataFirma);

      $contenid0 .= '<table class="table table-bordered table-sm">
        <tbody>
          <tr>
            <td class="bg-light">FECHA DEL PLAN DE ATENCIÓN DE HALLAZGOS.:</td>
            <td class="">'.FormatoFecha($fecha_atencion_hallazgos).'</td>
          </tr>
          <tr>
            <td class="bg-light align-middle">RESPONSABLE DEL SGM:</td>
            <td class="text-center align-middle">
            <div><img src="'.$baseFirma.'" style="width: 100px;"></div>
            '.$nom_responsable_sgm['nombre'].'
            </td>
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
$dompdf->stream('Plan de atencion de Hallazgos.pdf');
//------------------
mysqli_close($con);
//------------------