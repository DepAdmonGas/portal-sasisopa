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

  function contenidoTabla($id_programa,$cate,$con){
$contenido = '';
$sql = "SELECT
sgm_bitacora_verificacion_resultado.id,
sgm_bitacora_verificacion_resultado.id_lista,
sgm_bitacora_verificacion_resultado.resultado,
sgm_bitacora_verificacion_lista.pregunta
FROM sgm_bitacora_verificacion_resultado 
INNER JOIN sgm_bitacora_verificacion_lista 
ON sgm_bitacora_verificacion_resultado.id_lista = sgm_bitacora_verificacion_lista.id WHERE sgm_bitacora_verificacion_resultado.id_programa = '".$id_programa."' AND sgm_bitacora_verificacion_lista.categoria = '".$cate."' ";
$result = mysqli_query($con, $sql);
$numero = mysqli_num_rows($result);


$contenido .= '<tbody>';
$contenido .= '<tr class="bg-secondary text-white">
<td class="align-middle"><b>'.$cate.'</b></td> 
<td class="align-middle text-center"><b>Resultado</b></td></tr>';
while($row = mysqli_fetch_array($result, MYSQLI_ASSOC)){
$contenido .= '<tr>
<td class="align-middle">'.$row['pregunta'].'</td>
<td class="align-middle" >'.$row['resultado'].'</td>
</tr>';
}
$contenido .= '</tbody>';

return $contenido;
}

$sql_bitacora = "SELECT * FROM sgm_bitacora_verificacion_sensores WHERE id_programa = '".$GET_idRegistro."' ";
$result_bitacora = mysqli_query($con, $sql_bitacora);
$numero_bitacora = mysqli_num_rows($result_bitacora);
$row_bitacora = mysqli_fetch_array($result_bitacora, MYSQLI_ASSOC);
  
  $id = $row_bitacora['id'];
  $fecha = ($row['fecha'] == '0000-00-00') ?  'S/I' : FormatoFecha($row['fecha']);
  $hora = $row_bitacora['hora'];
  $no_tanque = $row_bitacora['no_tanque'];
  $marca = $row_bitacora['marca'];
  $capacidad = $row_bitacora['capacidad'];
  $producto = $row_bitacora['producto'];
  $interno_externo = $row_bitacora['interno_externo'];
  $verificacion_movimiento = $row_bitacora['verificacion_movimiento'];
  $metodo_nivel = $row_bitacora['metodo_nivel'];
  $realizadopor = usuario($row_bitacora['realizadopor'],$con);


use Dompdf\Dompdf;
$dompdf = new Dompdf();

    $contenid0 = "";
    $contenid0 .= "<!DOCTYPE html>";
    $contenid0 .= "<html>";
    $contenid0 .= "<head>";
    $contenid0 .= "<title>Bitácora para la verificación de equipos de medicion</title>";
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
  font-size: .73rem;
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
$contenid0 .= '<body';

$contenid0 .= '<div>';

$contenid0 .= '<table class="table table-bordered">';
$contenid0 .= '<tbody>';
$contenid0 .= '<tr>';
$contenid0 .= '<td class="align-middle text-center" rowspan="2">';
$contenid0 .= $Session_Razonsocial;
$contenid0 .= '</td>';
$contenid0 .= '<td class="align-middle text-center" rowspan="2">';
$contenid0 .= '<b>Bitácora para la verificación de equipos de medicion </b>';
$contenid0 .= '</td>';
$contenid0 .= '<td class="align-middle text-center">';
$contenid0 .= '<b>Fecha de autorización: 01-01-2024</b>';
$contenid0 .= '</td>';
$contenid0 .= '</tr>';
//------------------------------------------------------------------
$contenid0 .= '<tr>';
$contenid0 .= '<td class="align-middle text-center">';
$contenid0 .= 'Fo.SGM.016';
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
          <tr>
            <td class="align-middle"><b>Fecha:</b></td>
            <td class="align-middle">'.$fecha.'</td>
          </tr>
          <tr>
            <td class="align-middle"><b>Hora:</b></td>
            <td class="align-middle">'.$hora.'</td>
          </tr>
          <tr class="bg-secondary text-white">
            <td><b>Verificacion de sensores de nivel y temperatura</b></td>
            <td><b>Resultado</b></td>
          </tr>
          <tr>
            <td class="align-middle"><b>No de tanque:</b></td>
            <td class="align-middle">'.$no_tanque.'</td>
          </tr>
          <tr>
            <td class="align-middle"><b>Marca:</b></td>
            <td class="align-middle">'.$marca.'</td>
          </tr>
          <tr>
            <td class="align-middle"><b>Capacidad:</b></td>
            <td class="align-middle">'.$capacidad.'</td>
          </tr>
          <tr>
            <td class="align-middle"><b>Producto que almacena:</b></td>
            <td class="align-middle">'.$producto.'</td>
          </tr>
          <tr>
            <td class="align-middle"><b>La verificación es realizada por personal Interno o Externo, ( en caso de ser externo colocar nombre de la empresa y datos relevantes):</b></td>
          <td class="align-middle">
              '.$interno_externo.'
          </tr>
          <tr>
            <td class="align-middle"><b>Al momento de iniciar la calibración se asegura que el producto se encuentre sin movimiento:</b></td>
            <td class="align-middle">'.$verificacion_movimiento.'</td>
          </tr>
          <tr>
            <td class="align-middle"><b>Método para determinar el nivel liquido dentro del tanque (Inmersión o medida seca):</b></td>
            <td class="align-middle">'.$metodo_nivel.'</td>
          </tr>
        </tbody>
      </table>';


    $contenid0 .= '<table class="table table-bordered table-sm">';


    $contenid0 .= contenidoTabla($GET_idRegistro,'1. Aspecto a verificar en los patrones de referencia',$con);
    $contenid0 .= contenidoTabla($GET_idRegistro,'2. Sistema de nivel automático (tirilla del Sistema de Control de Inventarios)',$con);
    $contenid0 .= contenidoTabla($GET_idRegistro,'3. Medición de la cinta petrolera (en mm) y termómetro (en °C)',$con);
    $contenid0 .= contenidoTabla($GET_idRegistro,'4. Resultado: Diferencia entre ambas mediciones',$con);

    $contenid0 .= '</table>';

    $contenid0 .= '<div class="bg-light p-3">
      "<b>Nota 1:</b> Referente al nivel puede existir una variación de +/- 3 mm, sin embargo, para aplicaciones fiscales o de transferencia de custodia, los equipos deben cumplir con un EMP de Â± 4 mm, en todo el intervalo de medición.<br>
    <b>Nota 2:</b> referente a la temperatura puede existir una variación igual o menor de 0.5 °C"   
    </div>';

//-----------------------------------------------------------------
$contenid0 .= '</div>';

$contenid0 .= '</body>';
$contenid0 .= '</html>';


$dompdf->loadHtml($contenid0);
$dompdf->setPaper("A4", "portrait");
$dompdf->render();
$dompdf->stream('Bitácora para la verificación de equipos de medicion.pdf');
//------------------
mysqli_close($con);
//------------------