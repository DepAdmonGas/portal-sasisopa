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
    $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
    $Nombre = $row['nombre'];
    $puesto = $row['tipo_puesto'];
    $firma = $row['firma'];
  
    $array = array('nombre' => $Nombre, 'puesto' => $puesto, 'firma' => $firma);
    return $array;
    }


$sql = "SELECT * FROM sgm_bitacora_calibracion_equipo WHERE id_programa = '".$GET_idRegistro."' ";
$result = mysqli_query($con, $sql);
$numero = mysqli_num_rows($result);
$row = mysqli_fetch_array($result, MYSQLI_ASSOC);
$id_bitacora = $row['id'];
$fecha = $row['fecha'];
$hora = $row['hora'];
$nombreequipo = $row['nombre_equipo'];
$marca = $row['marca'];
$capacidad = $row['capacidad'];
$almacena = $row['almacena'];
$nombre_laboratorio = $row['nombre_laboratorio'];
$no_acreditacion = $row['no_acreditacion'];
$metodo_calibracion = $row['metodo_calibracion'];
$nombre_patron = $row['nombre_patron'];
$marca_modelo_serie = $row['marca_modelo_serie'];
$resolucion = $row['resolucion'];
$incertidumbre = $row['incertidumbre'];
$vigencia_certificado = $row['vigencia_certificado'];
$realizadopor = usuario($row['realizadopor'],$con);

use Dompdf\Dompdf;
$dompdf = new Dompdf();

    $contenid0 = "";
    $contenid0 .= "<!DOCTYPE html>";
    $contenid0 .= "<html>";
    $contenid0 .= "<head>";
    $contenid0 .= "<title>Bitácora la para la calibración de equipos</title>";
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
  font-size: .90rem;
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

.table-secondary,
.table-secondary > th,
.table-secondary > td {
  background-color: #d6d8db;
}
.bg-secondary {
  background-color: #6c757d !important;
}
.text-white {
  color: #fff !important;
}
.bg-light {
  background-color: #f3f3f3 !important;
}
.p-3 {
  padding: 1rem !important;
}
</style>';

$contenid0 .= '</head>';
$contenid0 .= '<body>';

$contenid0 .= '<div>';

      $contenid0 .= '<table class="table table-bordered">';
      $contenid0 .= '<tbody>';
      $contenid0 .= '<tr>';
      $contenid0 .= '<td class="align-middle text-center" rowspan="2">';
      $contenid0 .= $Session_Razonsocial;
      $contenid0 .= '</td>';
      $contenid0 .= '<td class="align-middle text-center" rowspan="2">';
      $contenid0 .= '<b>Bitácora la para la calibración de equipos</b>';
      $contenid0 .= '</td>';
      $contenid0 .= '<td class="align-middle text-center">';
      $contenid0 .= '<b>Fecha de autorización: 01-01-2024</b>';
      $contenid0 .= '</td>';
      $contenid0 .= '</tr>';
      //------------------------------------------------------------------
      $contenid0 .= '<tr>';
      $contenid0 .= '<td class="align-middle text-center">';
      $contenid0 .= 'Fo.SGM.017';
      $contenid0 .= '</td>';
      $contenid0 .= '</tr>';
      //------------------------------------------------------------------
      $contenid0 .= '<tr>';
      $contenid0 .= '<td class="align-middle text-center">';
      $contenid0 .= 'Realizado por: '.$realizadopor['nombre'];
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

  $contenid0 .= '<table class="table table-bordered table-sm">
        <tbody>
          <tr>
            <td class="align-middle"><b>Fecha:</b></td>
            <td class="">'.FormatoFecha($fecha).'</td>
          </tr>
          <tr>
            <td class="align-middle"><b>Hora:</b></td>
            <td class="">'.$hora.'</td>
          </tr>
          <tr>
            <td class="align-middle"><b>Nombre del equipo a calibrar:</b></td>
            <td class="align-middle">'.$nombreequipo.'</td>
          </tr>
          <tr>
            <td class="align-middle"><b>Marca:</b></td>
            <td class="">'.$marca.'</td>
          </tr>
          <tr>
            <td class="align-middle"><b>Capacidad:</b></td>
            <td class="">'.$capacidad.'</td>
          </tr>
          <tr>
            <td class="align-middle"><b>Producto que almacena:</b></td>
            <td class="align-middle">'.$almacena.'</td>
          </tr>
          <tr>
            <td class="align-middle"><b>Nombre del laboratorio o unidad de verificación encargada de la calibración:</b></td>
            <td class="">'.$nombre_laboratorio.'</td>
          </tr>
          <tr>
            <td class="align-middle"><b>No de acreditación o aprobación:</b></td>
            <td class="">'.$no_acreditacion.'</td>
          </tr>
          <tr>
            <td class="align-middle"><b>Método utilizado para la calibración:</b></td>
            <td class="">'.$metodo_calibracion.'</td>
          </tr>
        </tbody>
      </table>';

      $contenid0 .= '<div style="margin-bottom: 10px;"><b>Descripción de patrones utilizados</b></div>';

      $contenid0 .= '<table class="table table-bordered table-sm">
        <tbody>
          <tr>
            <td class="align-middle"><b>Nombre del patrón</b></td>
            <td class="">'.$nombre_patron.'</td>
          </tr>
          <tr>
            <td class="align-middle"><b>Marca y modelo y serie</b></td>
            <td class="">'.$marca_modelo_serie.'</td>
          </tr>
          <tr>
            <td class="align-middle"><b>Resolución</b></td>
            <td class="">'.$resolucion.'</td>
          </tr>
          <tr>
            <td class="align-middle"><b>Incertidumbre</b></td>
            <td class="">'.$incertidumbre.'</td>
          </tr>
          <tr>
            <td class="align-middle"><b>Vigencia de su certificado de calibración</b></td>
            <td class="">'.$vigencia_certificado.'</td>
          </tr>
        </tbody>
      </table>';

      $contenid0 .= '<table class="table table-bordered table-sm">
        <thead>
        <tr>
          <th>Equipo o Instrumento</th>
          <th>Identificacion</th>
          <th>Resultado</th>
        </tr>
        </thead>
        <tbody>';


          $sql_equipo = "SELECT
          sgm_bitacora_calibracion_equipo_detalle.id,
          sgm_bitacora_calibracion_equipo_detalle.id_equipo,
          sgm_bitacora_calibracion_equipo_detalle.resultado,
          sgm_inventario_equipo.nombre,
          sgm_inventario_equipo.identificacion
          FROM sgm_bitacora_calibracion_equipo_detalle 
          INNER JOIN sgm_inventario_equipo 
          ON sgm_bitacora_calibracion_equipo_detalle.id_equipo = sgm_inventario_equipo.id
           WHERE sgm_bitacora_calibracion_equipo_detalle.id_programa = '".$GET_idRegistro."' ";
          $result_equipo = mysqli_query($con, $sql_equipo);
          $numero_equipo = mysqli_num_rows($result_equipo);
          while($row_equipo = mysqli_fetch_array($result_equipo, MYSQLI_ASSOC)){

          $contenid0 .= '<tr>
          <td>'.$row_equipo['nombre'].'</td>
          <td>'.$row_equipo['identificacion'].'</td>
          <td>'.$row_equipo['resultado'].'</td>
          </tr>';

          }

    $contenid0 .= '</tbody>
      </table>';

//-----------------------------------------------------------------
$contenid0 .= '</div>';

$contenid0 .= '</body>';
$contenid0 .= '</html>';


$dompdf->loadHtml($contenid0);
$dompdf->setPaper("A4", "portrait");
$dompdf->render();
$dompdf->stream('Bitácora la para la calibración de equipos.pdf');
//------------------
mysqli_close($con);
//------------------