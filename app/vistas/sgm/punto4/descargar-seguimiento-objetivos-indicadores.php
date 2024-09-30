<?php
require_once 'dompdf/autoload.inc.php';
include_once "app/help.php";



$sql = "SELECT * FROM sgm_seguimiento_objetivo_indicador WHERE id = '".$GET_idRegistro."' ";
$result = mysqli_query($con, $sql);
$numero = mysqli_num_rows($result);
$row = mysqli_fetch_array($result, MYSQLI_ASSOC);
$fecha = $row['fecha'];
$hora = $row['hora'];
$lugar = $row['lugar'];
$realizadopor = realizadoPor($row['realizadopor'],$con);

$explode_fecha = explode("-", $row['fecha']);
$year_fecha = $explode_fecha[0];

  function realizadoPor($usuario,$con){
  $sql = "SELECT nombre FROM tb_usuarios WHERE id = '".$usuario."' ";
  $result = mysqli_query($con, $sql);
  $numero = mysqli_num_rows($result);
  $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
  $Nombre = $row['nombre'];
  return $Nombre;
  }

  function seguimiento($idRegistro,$con){
  $contenido = '';
  $sql = "SELECT * FROM sgm_seguimiento_objetivo_indicador WHERE id  = '".$idRegistro."' ";
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

  function seguimiento_sgm($idRegistro,$con){

  $contenido = '';
  $sql_sgm = "SELECT * FROM sgm_seguimiento_implementacion_sgm WHERE id_seguimiento = '".$idRegistro."' ";
  $result_sgm = mysqli_query($con, $sql_sgm);
  $numero_sgm = mysqli_num_rows($result_sgm);
  $row_sgm = mysqli_fetch_array($result_sgm, MYSQLI_ASSOC);
  $S11 = $row_sgm['respuesta_uno'];
  $S12 = $row_sgm['respuesta_dos'];
  $S13 = $row_sgm['respuesta_tres'];
  $S14 = $row_sgm['respuesta_cuatro'];

  $contenido = '<table class="table table-sm table-bordered">
        <tr>
          <td class="bg-light" colspan="2"><b>Indicador: Implementacion del SGM</b></td>
        </tr>
        <tr>
          <td>Porcentaje de procedimientos implementados durante el año inmediato anterior</td>
          <td class="">'.$S11.'</td>
        </tr>
        <tr>
          <td>Porcentaje de procedimientos documentados durante el año inmediato anterior</td>
          <td class="">'.$S12.'</td>
        </tr>
        <tr>
          <td colspan="2">Comentarios y observacines:</td>
        </tr>
        <tr>
          <td class="p-1" colspan="2">'.$S13.'</td>
        </tr>
        <tr>
          <td colspan="2">En caso de no obtener resultados favorables, describa las acciones a tomar junto con los recursos que necesita con la finalidad de cambiar los resultados obtenidos para la siguiente evaluacion</td>
        </tr>
        <tr>
          <td class="p-1" colspan="2">'.$S14.'</td>
        </tr>
      </table>';

      return $contenido;
  }

  function seguimiento_ce($idRegistro,$year,$con){

  $contenido = '';
  $sql_ce = "SELECT * FROM sgm_seguimiento_calibracion_equipo WHERE id_seguimiento = '".$idRegistro."' ";
  $result_ce = mysqli_query($con, $sql_ce);
  $numero_ce = mysqli_num_rows($result_ce);
  $row_ce = mysqli_fetch_array($result_ce, MYSQLI_ASSOC);
  $S21 = $row_ce['respuesta_uno'];
  $S22 = $row_ce['respuesta_dos'];
  $S23 = $row_ce['respuesta_tres'];

  $contenido = '<table class="table table-sm table-bordered">
        <tr>
          <td class="bg-light" colspan="2"><b>Indicador: Calibracion de equipos</b></td>
        </tr>
        <tr>
          <td>Porcentaje de quipos calibrados durante el año '.$year.'</td>
          <td class="">'.$S21.'</td>
        </tr>
        <tr>
          <td colspan="2">Comentarios y observacines:</td>
        </tr>
        <tr>
          <td class="p-1" colspan="2">'.$S22.'</td>
        </tr>
        <tr>
          <td colspan="2">En caso de no obtener resultados favorables, describa las acciones a tomar junto con los recursos que necesita con la finalidad de cambiar los resultados obtenidos para la siguiente evaluacion</td>
        </tr>
        <tr>
          <td class="p-1" colspan="2">'.$S23.'</td>
        </tr>
      </table>';

      return $contenido;

  }

  function seguimiento_sc($idRegistro,$con){

  $contenido = '';
  $sql_sc = "SELECT * FROM sgm_seguimiento_satisfaccion_cliente WHERE id_seguimiento = '".$idRegistro."' ";
  $result_sc = mysqli_query($con, $sql_sc);
  $numero_sc = mysqli_num_rows($result_sc);
  $row_sc = mysqli_fetch_array($result_sc, MYSQLI_ASSOC);
  $S31 = $row_sc['respuesta_uno'];
  $S32 = $row_sc['respuesta_dos'];
  $S33 = $row_sc['respuesta_tres'];
  $S34 = $row_sc['respuesta_cuatro'];
  $S35 = $row_sc['respuesta_cinco'];

   $contenido = ' <table class="table table-sm table-bordered">
        <tr>
          <td class="bg-light" colspan="2"><b>Indicador: Satisfaccion del cliente</b></td>
        </tr>
        <tr>
          <td>Numero de quejas por parte de los clientes</td>
          <td class="">'.$S31.'</td>
        </tr>
        <tr>
          <td>Numero de quejas atendidas de manera satisfactoria </td>
          <td class="">'.$S32.'</td>
        </tr>
        <tr>
          <td class="align-middle">Si ya se cuenta con resultados del año inmediato anterior determinar el procentaje que representan las quejas del año inmediato anterior contra los resultados con los que cuenta la estacion de servicio </td>
           <td class="">'.$S33.'</td>
        </tr>
        <tr>
          <td colspan="2">Comentarios y observacines:</td>
        </tr>
        <tr>
          <td class="p-1" colspan="2">'.$S34.'</td>
        </tr>
        <tr>
          <td colspan="2">En caso de no obtener resultados favorables, describa las acciones a tomar junto con los recursos que necesita con la finalidad de cambiar los resultados obtenidos para la siguiente evaluacion </td>
        </tr>
        <tr>
          <td class="p-1" colspan="2">'.$S35.'</td>
        </tr>
      </table>';

  return $contenido;
  }

  function asistentes($idRegistro,$ruta_firma,$con){

  $contenido = '';
  $sql_capacitacion = "SELECT
  sgm_seguimiento_asistentes.id,
  sgm_seguimiento_asistentes.id_seguimiento,
  sgm_seguimiento_asistentes.id_usuario,
  tb_usuarios.nombre,
  tb_usuarios.firma
  FROM sgm_seguimiento_asistentes
  INNER JOIN tb_usuarios 
  ON sgm_seguimiento_asistentes.id_usuario = tb_usuarios.id
  WHERE sgm_seguimiento_asistentes.id_seguimiento  = '".$idRegistro."' ";
  $result_capacitacion = mysqli_query($con, $sql_capacitacion);
  $numero_capacitacion = mysqli_num_rows($result_capacitacion);

  $contenido .= '<table class="table table-bordered table-sm">
      <thead> 
      <tr>
      <th class="text-center align-middle">#</th>
      <th class="text-center align-middle">Nombre</th>
      <th class="text-center align-middle">Firma</th>
      </tr>
      </thead>
      <tbody>';

      $num = 1;
      if ($numero_capacitacion > 0) {
      while($row_capacitacion = mysqli_fetch_array($result_capacitacion, MYSQLI_ASSOC)){
      $id = $row_capacitacion['id'];
      $nombre = $row_capacitacion['nombre'];

      if($row_capacitacion['firma'] != ""){

          $type = pathinfo($row_capacitacion['firma'], PATHINFO_EXTENSION);  
          $Data = file_get_contents($ruta_firma.$row_capacitacion['firma']);
          $base = 'data:image/' . $type . ';base64,' . base64_encode($Data);

        $firma = '<td class="text-center align-middle"><img width="70px" src="'.$base.'" /></td>';
      }else{
        $firma = '<td class="text-center align-middle"></td>';
      }

      $contenido .= '<tr>';
      $contenido .= '<td class="align-middle text-center">'.$num.'</td>';
      $contenido .= '<td class="align-middle">'.$nombre.'</td>';
      $contenido .= $firma;

      $contenido .= '</tr>';

      $num = $num + 1;
      }
      }else{
      $contenido .= '<td colspan="5" class="text-center text-secondary" style="font-size: .8em;">No se encontró información para mostrar</td>';

      }

      $contenido .= '</tbody></table>';

      return $contenido;
  }

  use Dompdf\Dompdf;
$dompdf = new Dompdf();

    $contenid0 = "";
    $contenid0 .= "<!DOCTYPE html>";
    $contenid0 .= "<html>";
    $contenid0 .= "<head>";
    $contenid0 .= "<title>Seguimiento de objetivos e indicadores</title>";
    $contenid0 .= '<style type="text/css">
@page {margin: 0.5cm 0.5cm; font-family: Arial, Helvetica, sans-serif;}

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
      $contenid0 .= '<b>Seguimiento de objetivos e indicadores</b>';
      $contenid0 .= '</td>';
      $contenid0 .= '<td class="align-middle text-center">';
      $contenid0 .= '<b>Fecha de autorización: 01-01-2024</b>';
      $contenid0 .= '</td>';
      $contenid0 .= '</tr>';
      //------------------------------------------------------------------
      $contenid0 .= '<tr>';
      $contenid0 .= '<td class="align-middle text-center">';
      $contenid0 .= 'Fo.SGM.004';
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

      $contenid0 .= seguimiento($GET_idRegistro,$con);
      $contenid0 .= seguimiento_sgm($GET_idRegistro,$con);
      $contenid0 .= seguimiento_ce($GET_idRegistro,$year_fecha,$con);
      $contenid0 .= seguimiento_sc($GET_idRegistro,$con);
      $contenid0 .= asistentes($GET_idRegistro,RUTA_IMG_FIRMA_PERSONAL,$con);


//-----------------------------------------------------------------
$contenid0 .= '</div>';

$contenid0 .= '</body>';
$contenid0 .= '</html>';


$dompdf->loadHtml($contenid0);
$dompdf->setPaper("A4", "portrait");
$dompdf->render();
$canvas = $dompdf->get_canvas();
$canvas->page_text(525, 810, "Página: {PAGE_NUM} de {PAGE_COUNT}", null, 7, array(0, 0, 0));
$dompdf->stream('Seguimiento de objetivos e indicadores.pdf');
//------------------
mysqli_close($con);
//------------------