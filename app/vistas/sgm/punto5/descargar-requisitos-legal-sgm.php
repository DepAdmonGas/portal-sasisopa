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

function UltimaAct($idre,$con){
  $sql_matriz = "SELECT * FROM rl_requisitos_legales_matriz WHERE idcalendario = '".$idre."' ORDER BY id desc LIMIT 1";
  $result_matriz = mysqli_query($con, $sql_matriz);
  $numero_matriz = mysqli_num_rows($result_matriz);
  if($numero_matriz > 0){
  while($row_matriz = mysqli_fetch_array($result_matriz, MYSQLI_ASSOC)){
  
  if($row_matriz['fecha_emision'] == "0000-00-00"){
  $fechaemision = "S/I"; 
  }else{
  $fechaemision = $row_matriz['fecha_emision'];
  }
  
  if($row_matriz['fecha_vencimiento'] == "0000-00-00"){
  $fechavencimiento = "S/I"; 
  }else{
  $fechavencimiento = $row_matriz['fecha_vencimiento'];
  }
  
  $acusepdf = $row_matriz['acusepdf'];
  $requisitolegalpdf = $row_matriz['requisitolegalpdf'];
  }
  }else{
  $fechaemision = "S/I";
  $fechavencimiento = "S/I"; 
  $acusepdf = "";
  $requisitolegalpdf = "";
  }
  
  if ($acusepdf == "" && $requisitolegalpdf == "") {
    $cumplimiento = "0 %";
    $toCumpli = 0;
    }else if ($acusepdf!= "" && $requisitolegalpdf == "") {
    $cumplimiento = "50 %";
    $toCumpli = 50;
    }else if($acusepdf == "" && $requisitolegalpdf != ""){
    $cumplimiento = "100 %";
    $toCumpli = 100;
    }else if($acusepdf != "" && $requisitolegalpdf != ""){
    $cumplimiento = "100 %";
    $toCumpli = 100;
    }
  
  $array = array('fechaemision' => $fechaemision,
  'fechavencimiento' => $fechavencimiento,
  'acusepdf' => $acusepdf,
  'requisitolegalpdf' => $requisitolegalpdf,
  'cumplimiento' => $cumplimiento,
  'toCumpli' => $toCumpli);
  
  return $array;
  }

  function RequisitosLegales($idEstacion,$NivelGobierno,$con){
    $contenido = "";

    $sql = "SELECT
    rl_requisitos_legales_calendario.id,
    rl_requisitos_legales_calendario.nivel_gobierno,
    rl_requisitos_legales_calendario.vigencia,
    rl_requisitos_legales_calendario.estado,
    rl_requisitos_legales_lista.id AS idr_ll,
    rl_requisitos_legales_lista.dependencia,
    rl_requisitos_legales_lista.permiso,
    rl_requisitos_legales_lista.fundamento
    FROM rl_requisitos_legales_calendario
    INNER JOIN 
    rl_requisitos_legales_lista ON 
    rl_requisitos_legales_calendario.id_requisito_legal = rl_requisitos_legales_lista.id
    WHERE rl_requisitos_legales_calendario.id_estacion = '".$idEstacion."' AND rl_requisitos_legales_calendario.categoria = 1 AND rl_requisitos_legales_calendario.estado = 1 ORDER BY rl_requisitos_legales_lista.id ASC";
    $result = mysqli_query($con, $sql);
    $numero = mysqli_num_rows($result);
    
    while($row = mysqli_fetch_array($result, MYSQLI_ASSOC)){
    
    $idre = $row['id'];
    $vigencia = $row['vigencia'];
    
      $UltimaA = UltimaAct($idre,$con);
    
      if($UltimaA['fechaemision'] == "S/I"){
      $fechaEmision = $UltimaA['fechaemision'];
      }else{
      $fechaEmision = FormatoFecha($UltimaA['fechaemision']);
      }
    
      if($UltimaA['fechavencimiento'] == "S/I"){
      $fechaVencimiento = $UltimaA['fechavencimiento'];
      }else{
      $fechaVencimiento = FormatoFecha($UltimaA['fechavencimiento']);
      }
    
    $contenido .= '<tr>
    <td class="align-middle">'.$row['idr_ll'].'</td>
    <td class="align-middle"><b>'.$row['permiso'].'</b></td>
    <td class="align-middle">'.$vigencia.'</td>
    <td class="align-middle">'.$fechaEmision.'</td>
    <td class="align-middle">'.$fechaVencimiento.'</td>
    <td class="align-middle">'.$row['fundamento'].'</td>
    </tr>';
    
    }

    return $contenido;
  }

use Dompdf\Dompdf;
$dompdf = new Dompdf();

    $contenid0 = "";
    $contenid0 .= "<!DOCTYPE html>";
    $contenid0 .= "<html>";
    $contenid0 .= "<head>";
    $contenid0 .= "<title>Requisitos legales del SGM</title>";
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
  font-size: .7rem;
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
      $contenid0 .= '<b>Requisitos legales del SGM</b>';
      $contenid0 .= '</td>';
      $contenid0 .= '<td class="align-middle text-center">';
      $contenid0 .= '<b>Fecha de autorización: 01-01-2024</b>';
      $contenid0 .= '</td>';
      $contenid0 .= '</tr>';
      //------------------------------------------------------------------
      $contenid0 .= '<tr>';
      $contenid0 .= '<td class="align-middle text-center">';
      $contenid0 .= 'Fo.SGM.006';
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

      $contenid0 .= '<table class="table table-sm table-bordered">';
      $contenid0 .= '<thead>
      <tr>
        <th class="align-middle">No</th>
        <th class="align-middle">Nombre del permiso</th>
        <th class="align-middle">Periodicidad</th>
        <th class="align-middle">Fecha de emisión</th>
        <th class="align-middle">Fecha de vencimiento</th>
        <th class="align-middle">Fundamento legal</th>
      </tr>
      </thead>';
      $contenid0 .= '<tbody>';


      $contenid0 .= RequisitosLegales($Session_IDEstacion,'federal',$con);

      $contenid0 .= '</tbody>';
      $contenid0 .= '</table>';

//-----------------------------------------------------------------
$contenid0 .= '</div>';

$contenid0 .= '</body>';
$contenid0 .= '</html>';

$dompdf->loadHtml($contenid0);
$dompdf->setPaper("A4", "landscape");
$dompdf->render();
$canvas = $dompdf->get_canvas();
$canvas->page_text(770, 570, "Página: {PAGE_NUM} de {PAGE_COUNT}", null, 8, array(0, 0, 0));
$dompdf->stream('Requisitos legales del SGM.pdf');
//------------------
mysqli_close($con);
//------------------