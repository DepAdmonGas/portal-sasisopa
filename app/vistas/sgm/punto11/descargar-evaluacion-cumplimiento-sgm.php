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

$sql = "SELECT * FROM sgm_cumplimiento_objetivos_revision WHERE id = '".$GET_idRegistro."' ";
$result = mysqli_query($con, $sql);
$numero = mysqli_num_rows($result);
$row = mysqli_fetch_array($result, MYSQLI_ASSOC);

$fecha = $row['fecha'];
$hora = $row['hora'];
$lugar = $row['lugar'];
$responsable = $row['responsable'];
$realizadopor = usuario($row['realizadopor'],$con);

use Dompdf\Dompdf;
$dompdf = new Dompdf();
    
    $contenid0 = "";
    $contenid0 .= "<!DOCTYPE html>";
    $contenid0 .= "<html>";
    $contenid0 .= "<head>";
    $contenid0 .= "<title>Cumplimiento de objetivos y revisión por la dirección </title>";
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
      $contenid0 .= '<b>Cumplimiento de objetivos y revisión por la dirección </b>';
      $contenid0 .= '</td>';
      $contenid0 .= '<td class="align-middle text-center">';
      $contenid0 .= '<b>Fecha de autorización: 01-01-2024</b>';
      $contenid0 .= '</td>';
      $contenid0 .= '</tr>';
      //------------------------------------------------------------------
      $contenid0 .= '<tr>';
      $contenid0 .= '<td class="align-middle text-center">';
      $contenid0 .= 'Fo.SGM.021';
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

    $contenid0 .= '<table class="table table-sm table-bordered">
    <tr>
    <td><b>Fecha:</b></td>
    <td class="">'.FormatoFecha($fecha).'</td>
    </tr>
    <tr>
    <td><b>Hora:</b></td>
    <td class="">'.$hora.'</td>
    </tr>
    <tr>
    <td><b>Lugar:</b></td>
    <td class="">'.$lugar.'</td>
    </tr>
    <tr>
    <td><b>Responsable de la medición:</b></td>
    <td class="">'.$responsable.'</td>
    </tr>
    </table>';

            $sql = "SELECT * FROM sgm_cumplimiento_objetivos_revision_detalle WHERE id_cumplimiento = '".$GET_idRegistro."' ";
        $result = mysqli_query($con, $sql);
        $numero = mysqli_num_rows($result);
        while($row = mysqli_fetch_array($result, MYSQLI_ASSOC)){

            if($row['categoria'] == 'Indicador: Satisfacción del cliente'){
            $meta = 'Meta: disminuir 30% de reclamaciones contra el año inmediato anterior ';
            }else{
            $meta = 'Meta: 100%';
            }

            $contenid0 .= '<table class="table table-sm table-bordered">
            <tbody>
            <tr class="bg-secondary text-white">
            <td colspan="3"><b>'.$row['categoria'].'</b></td>
            </tr>
            <tr>
            <td class="align-middle"><b>'.$meta.'</b></td>
            <td class="align-middle"><b>Resultado</b></td>
            <td class="align-middle">'.$row['resultado1'].'</td>
            </tr>
            <tr>
            <td class="align-middle"><b>Comentarios y observaciones:</b></td>
            <td colspan="2" class="align-middle">'.$row['resultado2'].'</td>
            </tr>

            <tr>
            <td colspan="3"><b>Acciones a tomar para mejorar o mantener el resultado:</b></td>
            </tr>
            <tr>
            <td colspan="3" class="">'.$row['resultado3'].'</td>
            </tr>

            <tr>
            <td colspan="3"><b>Responsable de realizar las acciones a tomar para mejorar o mantener los resultados:</b></td>
            </tr>
            <tr>
            <td colspan="3" class="">'.$row['resultado4'].'</td>
            </tr>

            <tr>
            <td colspan="3"><b>Recursos necesarios para ejecutar las acciones a tomar para mejorar o mantener los resultados:</b></td>
            </tr>
            <tr>
            <td colspan="3" class="">'.$row['resultado5'].'</td>
            </tr>

            </tbody>
            </table>';
        }

          $contenid0 .= '<table class="table table-sm table-bordered mt-1">
          <tbody>
            <tr class="bg-secondary text-white">
              <td colspan="2" class="text-center"><b>Asistentes</b></td>
            </tr>';

            $sql_as = "SELECT * FROM sgm_cumplimiento_objetivos_revision_asistentes WHERE id_cumplimiento = '".$GET_idRegistro."' ";
            $result_as = mysqli_query($con, $sql_as);
            $numero_as = mysqli_num_rows($result_as);
            while($row_as = mysqli_fetch_array($result_as, MYSQLI_ASSOC)){

              $asistente = usuario($row_as['id_usuario'],$con);

              $RutaFirma = RUTA_IMG_FIRMA_PERSONAL.$asistente['firma'];
              $DataFirma = file_get_contents($RutaFirma);
              $baseFirma = 'data:image/;base64,' . base64_encode($DataFirma);

             $contenid0 .= '<tr>
              <td class="align-middle">'.$asistente['nombre'].'</td>
              <td class="align-middle text-center"><img src="'.$baseFirma.'" style="width: 100px;"></td>
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
$dompdf->stream('Cumplimiento de objetivos y revisión por la dirección.pdf');
//------------------
mysqli_close($con);
//------------------