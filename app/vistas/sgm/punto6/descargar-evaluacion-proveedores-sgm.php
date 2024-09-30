<?php
require_once 'dompdf/autoload.inc.php';
include_once "app/help.php";


$sql = "SELECT * FROM sgm_orden_servicio WHERE id = '".$GET_idRegistro."' ";
$result = mysqli_query($con, $sql);
$numero = mysqli_num_rows($result);
$row = mysqli_fetch_array($result, MYSQLI_ASSOC);
$descripcion = $row['descripcion'];
$realizadopor = usuario($row['realizadopor'],$con);

$sql_eva = "SELECT * FROM sgm_evaluacion_proveedores WHERE id_orden_servicio = '".$GET_idRegistro."' ";
$result_eva = mysqli_query($con, $sql_eva);
$numero_eva = mysqli_num_rows($result_eva);
$row_eva = mysqli_fetch_array($result_eva, MYSQLI_ASSOC);
$id = $row_eva['id'];
$fecha = $row_eva['fecha'];
$hora_inicio = $row_eva['hora_inicio'];
$hora_termino = $row_eva['hora_termino'];
$nombre_proveedor = $row_eva['nombre_proveedor'];
$no_acreditacion = $row_eva['no_acreditacion'];
$observaciones = $row_eva['observaciones'];
$id_personal_evaluacion = $row_eva['id_personal_evaluacion'];

$respuesta_1 = $row_eva['respuesta_1'];
$respuesta_2 = $row_eva['respuesta_2'];
$respuesta_3 = $row_eva['respuesta_3'];
$respuesta_4 = $row_eva['respuesta_4'];
$respuesta_5 = $row_eva['respuesta_5'];
 
$usuario = usuario($id_personal_evaluacion,$con);

function usuario($usuario,$con){
  $sql = "SELECT tb_usuarios.nombre,
  tb_puestos.tipo_puesto
  FROM tb_usuarios
  INNER JOIN tb_puestos
  ON tb_usuarios.id_puesto = tb_puestos.id WHERE tb_usuarios.id = '".$usuario."' ";
    $result = mysqli_query($con, $sql);
    $numero = mysqli_num_rows($result);
    $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
    $Nombre = $row['nombre'];
    $puesto = $row['tipo_puesto'];
  
    $array = array('nombre' => $Nombre, 'puesto' => $puesto);
    return $array;
    }


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
  font-size: .90rem;
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
      $contenid0 .= '<b>Evaluación de proveedores</b>';
      $contenid0 .= '</td>';
      $contenid0 .= '<td class="align-middle text-center">';
      $contenid0 .= '<b>Fecha de autorización: 01-01-2024</b>';
      $contenid0 .= '</td>';
      $contenid0 .= '</tr>';
      //------------------------------------------------------------------
      $contenid0 .= '<tr>';
      $contenid0 .= '<td class="align-middle text-center">';
      $contenid0 .= 'Fo.SGM.013';
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

     $contenid0 .= '<table class="table">
            <tbody>
                <tr>
                    <td><b>Trabajo realizado o producto adquirido:</b></td>
                    <td>'.$descripcion.'</td>
                </tr>
                <tr>
                    <td><b>Fecha de ejecución del servicio:</b></td>
                    <td>'.FormatoFecha($fecha).'</td>
                </tr>
                <tr>
                    <td><b>Hora de inicio del servicio:</b></td>
                    <td>'.$hora_inicio.'</td>
                </tr>
                <tr>
                    <td><b>Hora de culminación del servicio:</b></td>
                    <td>'.$hora_termino.'</td>
                </tr>
                <tr>
                    <td><b>Nombre del proveedor o prestador de servicio:</b></td>
                    <td>'.$nombre_proveedor.'</td>
                </tr>
                <tr>
                    <td><b>No de acreditación o aprobación:</b></td>
                    <td>'.$no_acreditacion.'</td>
                </tr>
            </tbody>
        </table>';

       $respuesta1 = ($respuesta_1 == 1)? 'SI' : 'NO';
       $respuesta2 = ($respuesta_2 == 1)? 'SI' : 'NO';
       $respuesta3 = ($respuesta_3 == 1)? 'SI' : 'NO';
       $respuesta4 = ($respuesta_4 == 1)? 'SI' : 'NO';
       $respuesta5 = ($respuesta_5 == 1)? 'SI' : 'NO';

       $suma_respuesta = $respuesta_1 + $respuesta_2 + $respuesta_3 + $respuesta_4 + $respuesta_5;
       $resultado = ($suma_respuesta / 5) * 100;

    $contenid0 .= '<table class="table table-bordered table-sm mt-4">
        <thead>
            <tr>
                <th>No</th>
                <th>Aspecto a evaluar </th>
                <th>Respuesta</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>1</td>
                <td>El trabajo fue ejecutado conforme a lo solicitado</td>
                <td class="text-center align-middle">'.$respuesta1.'</td>
            </tr>
            <tr>
                <td>2</td>
                <td>Se verifico que el proveedor contara con procedimientos para ejecutar los trabajos </td>
                <td class="text-center align-middle">'.$respuesta2.'</td>
            </tr>
            <tr>
                <td>3</td>
                <td>Mientras el personal se mantuvo en las instalaciones ocupo EPP </td>
                <td class="text-center align-middle">'.$respuesta3.'</td>
            </tr>
            <tr>
                <td>4</td>
                <td>Los trabajos ejecutados tomaron en cuenta los procedimientos de seguridad </td>
                <td class="text-center align-middle">'.$respuesta4.'</td>
            </tr>
            <tr>
                <td>5</td>
                <td>Al culminar el trabajo se encuentra a entera satisfacción</td>
                <td class="text-center align-middle">'.$respuesta5.'</td>
            </tr>
            <tr>
                <td colspan="2" style="text-align: right;"><b>Resultado: </b></td>
                <td class="text-center align-middle"><b>'.number_format($resultado,0).' %</b></td>
            </tr>
        </tbody>
    </table>';
    
    $contenid0 .= '<div class="mt-2">
        <b>Observaciones:</b>        
        <div class="mt-2 p-3 border">'.$observaciones.'</div>
    </div> 
    <div class="mt-2">
        
        <table class="table mt-3">
            <tr>
                <td><b>Nombre de quien realiza la evaluación:</b></td>
                <td>'.$usuario['nombre'].'</td>
            </tr>
            <tr>
                <td><b>Puesto:</b></td>
                <td>'.$usuario['puesto'].'</td>
            </tr>
        </table>
    </div>';

//-----------------------------------------------------------------
$contenid0 .= '</div>';

$contenid0 .= '</body>';
$contenid0 .= '</html>';


$dompdf->loadHtml($contenid0);
$dompdf->setPaper("A4", "portrait");
$dompdf->render();
$canvas = $dompdf->get_canvas();
$canvas->page_text(750, 570, "Página: {PAGE_NUM} de {PAGE_COUNT}", null, 8, array(0, 0, 0));
$dompdf->stream('Evaluación de proveedores.pdf');
//------------------
mysqli_close($con);
//------------------