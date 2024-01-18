<?php
require_once 'dompdf/autoload.inc.php';
include_once "app/help.php";

function Personal($IdUsuario,$con){

$sql = "SELECT nombre, firma FROM tb_usuarios WHERE id = '".$IdUsuario."'";
$result = mysqli_query($con, $sql);
$numero = mysqli_num_rows($result);
while($row = mysqli_fetch_array($result, MYSQLI_ASSOC)){
$nombre = $row['nombre'];
$firma = $row['firma'];
}

$RutaFirma = RUTA_IMG_FIRMA_PERSONAL.$firma;
$DataFirma = file_get_contents($RutaFirma);
$baseFirma = 'data:image/;base64,' . base64_encode($DataFirma);

$array = array('nombre' => $nombre, 'firma' => $baseFirma);
return $array;

}

function Dispensario($iddispensario, $con){
$sql = "SELECT * FROM tb_dispensarios WHERE id = '".$iddispensario."' ";
$result = mysqli_query($con, $sql);
$numero = mysqli_num_rows($result);
while($row = mysqli_fetch_array($result, MYSQLI_ASSOC)){

$nodispensario = $row['no_dispensario'];
$marca = $row['marca'];
$modelo = $row['modelo'];
$serie = $row['serie'];
}

$array = array('nodispensario' => $nodispensario, 'marca' => $marca, 'modelo' => $modelo, 'serie' => $serie);

return $array;
}

function Jarra($idjarra, $con){
$sql = "SELECT * FROM tb_jarra_patron WHERE id = '".$idjarra."' ";
$result = mysqli_query($con, $sql);
$numero = mysqli_num_rows($result);
while($row = mysqli_fetch_array($result, MYSQLI_ASSOC)){

$marca = $row['marca'];
$serie = $row['no_serie'];
$capacidad = $row['capacidad'];
}

$array = array('marca' => $marca, 'serie' => $serie, 'capacidad' => $capacidad);

return $array;
}

function Sondas($idsonda, $con){
$sql = "SELECT * FROM tb_sondas_medicion WHERE id = '".$idsonda."' ";
$result = mysqli_query($con, $sql);
$numero = mysqli_num_rows($result);
while($row = mysqli_fetch_array($result, MYSQLI_ASSOC)){

$nosonda = $row['no_sonda'];
$marca = $row['marca'];
$modelo = $row['modelo'];

}

$array = array('nosonda' => $nosonda, 'marca' => $marca, 'modelo' => $modelo);

return $array;
}

function Tanque($idsonda, $con){
$sql = "SELECT * FROM tb_tanque_almacenamiento WHERE id = '".$idsonda."' ";
$result = mysqli_query($con, $sql);
$numero = mysqli_num_rows($result);
while($row = mysqli_fetch_array($result, MYSQLI_ASSOC)){

$notanque = $row['no_tanque'];
$capacidad = $row['capacidad'];
$producto = $row['producto'];

}

$array = array('notanque' => $notanque, 'capacidad' => $capacidad, 'producto' => $producto);

return $array;
}

function Detalle($ID,$categoria,$con){
$sql = "SELECT * FROM tb_calibracion_equipos_detalle WHERE id_calibracion = '".$ID."' AND categoria = '".$categoria."' ";
$result = mysqli_query($con, $sql);
$numero = mysqli_num_rows($result);
while($row = mysqli_fetch_array($result, MYSQLI_ASSOC)){
$resultado = $row['resultado'];
}

return $resultado;
}

function DetalleDispensario($id,$con){

$sql = "SELECT
tb_calibracion_equipos.id_usuario,
tb_calibracion_equipos.folio,
tb_calibracion_equipos.fecha,
tb_calibracion_equipos.hora,
tb_calibracion_equipos.observaciones,
tb_calibracion_equipos.responsable_verificacion,
tb_calibracion_equipos_dispensario.id AS idCaliDis,
tb_calibracion_equipos_dispensario.id_dispensario,
tb_calibracion_equipos_dispensario.resultado1,
tb_calibracion_equipos_dispensario.resultado2,
tb_calibracion_equipos_dispensario.resultado3,
tb_calibracion_equipos_dispensario.resultado4
FROM tb_calibracion_equipos 
INNER JOIN tb_calibracion_equipos_dispensario
ON tb_calibracion_equipos.id = tb_calibracion_equipos_dispensario.id_calibracion 
WHERE tb_calibracion_equipos.id = '".$id."' ";
$result = mysqli_query($con, $sql);
$numero = mysqli_num_rows($result);
while($row = mysqli_fetch_array($result, MYSQLI_ASSOC)){

$Dispensario = Dispensario($row['id_dispensario'], $con);
$Personal = Personal($row['id_usuario'],$con);

  $UV = Detalle($id,'Unidad de verificacion',$con);
  $NA = Detalle($id,'No. de acreditacion',$con);

$Contenido .= '<tr>';
$Contenido .= '<td class="text-center align-middle">'.FormatoFecha($row['fecha']).'</td>';
$Contenido .= '<td class="text-center align-middle">'.date("g:i a",strtotime($row['hora'])).'</td>';
$Contenido .= '<td class="text-center align-middle"><b>Dispensario ('.$Dispensario['marca'].', '.$Dispensario['modelo'].')</b></td>';
$Contenido .= '<td>

<div>Unidad de verificacion: <b>'.$UV.'</b></div>
<div>No. de acreditacion: <b>'.$NA.'</b></div>
<div>¿Cumple con el error maximo tolerado?: <b>'.$row['resultado1'].'</b></div>
<div>¿Cumple con la repetibilidad?: <b>'.$row['resultado2'].'</b></div>
<div>Folio del holograma: <b>'.$row['resultado3'].'</b></div>
<div>Distintivo empresarial: <b>'.$row['resultado4'].'</b></div>

</td>';
$Contenido .= '<td class="text-center align-middle">'.$row['observaciones'].'</td>';
$Contenido .= '<td class="text-center align-middle">'.$row['responsable_verificacion'].'</td>';
$Contenido .= '<td class="text-center align-middle">
<div class="text-center"><img src="'.$Personal['firma'].'" style="width: 70px;"></div>
'.$Personal['nombre'].'</td>';
$Contenido .= '</tr>';

} 
 
return $Contenido;
}

function DetalleJarra($id,$con){

$sql = "SELECT
tb_calibracion_equipos.id_usuario,
tb_calibracion_equipos.folio,
tb_calibracion_equipos.fecha,
tb_calibracion_equipos.hora,
tb_calibracion_equipos.observaciones,
tb_calibracion_equipos.responsable_verificacion,
tb_calibracion_equipos_jarra.id AS idCaliJarra,
tb_calibracion_equipos_jarra.id_jarra,
tb_calibracion_equipos_jarra.resultado1
FROM tb_calibracion_equipos 
INNER JOIN tb_calibracion_equipos_jarra
ON tb_calibracion_equipos.id = tb_calibracion_equipos_jarra.id_calibracion 
WHERE tb_calibracion_equipos.id = '".$id."' ";
$result = mysqli_query($con, $sql);
$numero = mysqli_num_rows($result);
while($row = mysqli_fetch_array($result, MYSQLI_ASSOC)){

$Jarra = Jarra($row['id_jarra'], $con);
$Personal = Personal($row['id_usuario'],$con);


  $TA = Detalle($id,'Temperatura ambiente', $con);
  $PA = Detalle($id,'Presión atmosférica', $con);
  $H = Detalle($id,'Humedad', $con);
  $LUC = Detalle($id,'Liquido usado en la calibración', $con);
  $TL = Detalle($id,'Temperatura del líquido', $con);
  $LC = Detalle($id,'Laboratorio de calibración', $con);
  $NA = Detalle($id,'No. de acreditación', $con);
  $MC = Detalle($id,'Método de calibración', $con);

$Contenido .= '<tr>';
$Contenido .= '<td class="text-center align-middle">'.FormatoFecha($row['fecha']).'</td>';
$Contenido .= '<td class="text-center align-middle">'.date("g:i a",strtotime($row['hora'])).'</td>';
$Contenido .= '<td class="text-center align-middle"><b>Jarra patron ('.$Jarra['marca'].', '.$Jarra['serie'].')</b></td>';
$Contenido .= '<td>

<div>Temperatura ambiente: <b>'.$TA.'</b></div>
<div>Presión atmosférica: <b>'.$PA.'</b></div>
<div>Humedad: <b>'.$H.'</b></div>
<div>Liquido usado en la calibración: <b>'.$LUC.'</b></div>
<div>Temperatura del líquido: <b>'.$TL.'</b></div>
<div>Laboratorio de calibración: <b>'.$LC.'</b></div>
<div>No. de acreditación: <b>'.$NA.'</b></div>
<div>Método de calibración: <b>'.$LC.'</b></div>
<div>Incertidumbre de calibración: <b>'.$row['resultado1'].'</b></div>

</td>';
$Contenido .= '<td class="text-center align-middle">'.$row['observaciones'].'</td>';
$Contenido .= '<td class="text-center align-middle">'.$row['responsable_verificacion'].'</td>';
$Contenido .= '<td class="text-center align-middle">
<div class="text-center"><img src="'.$Personal['firma'].'" style="width: 70px;"></div>
'.$Personal['nombre'].'</td>';
$Contenido .= '</tr>';

} 
 
return $Contenido;

}

function DetalleTanque($id,$con){
$sql = "SELECT
tb_calibracion_equipos.id_usuario,
tb_calibracion_equipos.folio,
tb_calibracion_equipos.fecha,
tb_calibracion_equipos.hora,
tb_calibracion_equipos.observaciones,
tb_calibracion_equipos.responsable_verificacion,
tb_calibracion_equipos_tanques.id AS idCaliTan,
tb_calibracion_equipos_tanques.id_tanque,
tb_calibracion_equipos_tanques.resultado1,
tb_calibracion_equipos_tanques.resultado2
FROM tb_calibracion_equipos 
INNER JOIN tb_calibracion_equipos_tanques
ON tb_calibracion_equipos.id = tb_calibracion_equipos_tanques.id_calibracion 
WHERE tb_calibracion_equipos.id = '".$id."' ";
$result = mysqli_query($con, $sql);
$numero = mysqli_num_rows($result);
while($row = mysqli_fetch_array($result, MYSQLI_ASSOC)){

$Tanque = Tanque($row['id_tanque'], $con);
$Personal = Personal($row['id_usuario'],$con);

  $UV = Detalle($id,'Unidad de verificación', $con);
  $NA = Detalle($id,'No. de acreditación', $con);
  $MUC = Detalle($id,'Método usado para la calibración', $con);

$Contenido .= '<tr>';
$Contenido .= '<td class="text-center align-middle">'.FormatoFecha($row['fecha']).'</td>';
$Contenido .= '<td class="text-center align-middle">'.date("g:i a",strtotime($row['hora'])).'</td>';
$Contenido .= '<td class="text-center align-middle"><b>Tanques de almacenamiento ('.$Tanque['notanque'].', '.$Tanque['capacidad'].', '.$Tanque['producto'].')</b></td>';
$Contenido .= '<td>

<div>Unidad de verificación: <b>'.$UV.'</b></div>
<div>No. de acreditación: <b>'.$NA.'</b></div>
<div>Método usado para la calibración: <b>'.$MUC.'</b></div>
<div>Incertidumbre de calibración: <b>'.$row['resultado1'].'</b></div>
<div>Cumple con los límites establecidos: <b>'.$row['resultado2'].'</b></div>

</td>';
$Contenido .= '<td class="text-center align-middle">'.$row['observaciones'].'</td>';
$Contenido .= '<td class="text-center align-middle">'.$row['responsable_verificacion'].'</td>';
$Contenido .= '<td class="text-center align-middle">
<div class="text-center"><img src="'.$Personal['firma'].'" style="width: 70px;"></div>
'.$Personal['nombre'].'</td>';
$Contenido .= '</tr>';

} 
 
return $Contenido;
}

function DetalleSonda($id,$con){

$sql = "SELECT
tb_calibracion_equipos.id_usuario,
tb_calibracion_equipos.folio,
tb_calibracion_equipos.fecha,
tb_calibracion_equipos.hora,
tb_calibracion_equipos.observaciones,
tb_calibracion_equipos.responsable_verificacion,
tb_calibracion_equipos_sonda.id AS idCaliJarr,
tb_calibracion_equipos_sonda.id_sonda,
tb_calibracion_equipos_sonda.resultado1
FROM tb_calibracion_equipos 
INNER JOIN tb_calibracion_equipos_sonda
ON tb_calibracion_equipos.id = tb_calibracion_equipos_sonda.id_calibracion 
WHERE tb_calibracion_equipos.id = '".$id."' ";
$result = mysqli_query($con, $sql);
$numero = mysqli_num_rows($result);
while($row = mysqli_fetch_array($result, MYSQLI_ASSOC)){

$Sondas = Sondas($row['id_sonda'], $con);
$Personal = Personal($row['id_usuario'],$con);

  $UV = Detalle($id,'Unidad de verificación', $con);
  $NA = Detalle($id,'No. de acreditación', $con);
  $MUC = Detalle($id,'Método usado para la calibración', $con);

$Contenido .= '<tr>';
$Contenido .= '<td class="text-center align-middle">'.FormatoFecha($row['fecha']).'</td>';
$Contenido .= '<td class="text-center align-middle">'.date("g:i a",strtotime($row['hora'])).'</td>';
$Contenido .= '<td class="text-center align-middle"><b>Sondas de medición ('.$Sondas['nosonda'].', '.$Sondas['marca'].', '.$Sondas['modelo'].')</b></td>';
$Contenido .= '<td>

<div>Unidad de verificación: <b>'.$UV.'</b></div>
<div>No. de acreditación: <b>'.$NA.'</b></div>
<div>Método usado para la calibración: <b>'.$MUC.'</b></div>
<div>Incertidumbre de calibración: <b>'.$row['resultado1'].'</b></div>

</td>';
$Contenido .= '<td class="text-center align-middle">'.$row['observaciones'].'</td>';
$Contenido .= '<td class="text-center align-middle">'.$row['responsable_verificacion'].'</td>';
$Contenido .= '<td class="text-center align-middle">
<div class="text-center"><img src="'.$Personal['firma'].'" style="width: 70px;"></div>
'.$Personal['nombre'].'</td>';
$Contenido .= '</tr>';

} 
 
return $Contenido;

}

use Dompdf\Dompdf;
$dompdf = new Dompdf();


    $contenid0 .= "<!DOCTYPE html>";
    $contenid0 .= "<html>";
    $contenid0 .= "<head>";
    $contenid0 .= "<title>Bitácora calibración de equipos</title>";
    $contenid0 .= '<style type="text/css">
@page {margin: 0.5cm 0.5cm; font-family: Arial, Helvetica, sans-serif;}
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
.table-warning,
.table-warning > th,
.table-warning > td {
  background-color: #ffeeba;
}
</style>';

$contenid0 .= '</head>';
$contenid0 .= '<body';

$contenid0 .= '<div>';

//-----------------------------------------------------------------

$RutaLogo = SERVIDOR."imgs/logo/Logo.png";
$DataLogo = file_get_contents($RutaLogo);
$baseLogo = 'data:image/;base64,' . base64_encode($DataLogo);


$contenid0 .= '<div class="text-center" style="margin-top: 200px;"><img src="'.$baseLogo.'" style="width: 300px"></div>';
$contenid0 .= '<div class="text-center mt-3"><b>Bitácora calibración de equipos</b></div>';
$contenid0 .= '<div class="text-center mt-1"><b>'.$Session_Permisocre.'</b></div>';
$contenid0 .= '<div class="text-center mt-1">'.$Session_Razonsocial.'</div>';
$contenid0 .= '<div class="text-center mt-1"><small>'.$Session_Direccion.'</small></div>';
$contenid0 .= '<div class="text-center mt-1"><small>Código: DLES/SA/002</small></div>';
$contenid0 .= '<div style="page-break-before: always;"> </div>';


    $contenid0 .= '<table class="table table-sm table-bordered" style="font-size: .8em;">';
      $contenid0 .= '<head>';
        $contenid0 .= '<tr>';
          $contenid0 .= '<th class="text-center align-middle">Fecha</th>';
          $contenid0 .= '<th class="text-center align-middle">Hora</th>';
          $contenid0 .= '<th class="text-center align-middle">Equipo a calibrar</th>';
          $contenid0 .= '<th class="text-center align-middle" width="180">Verificar</th>';
          $contenid0 .= '<th class="text-center align-middle">Observaciones</th>';
          $contenid0 .= '<th class="text-center align-middle">Responsable de la verificación</th>';
          $contenid0 .= '<th class="text-center align-middle">Firma de quien supervisa la actividad</th>';
        $contenid0 .= '</tr>';
      $contenid0 .= '</head>';
      $contenid0 .= '<tbody>';

      $sql = "SELECT * FROM tb_calibracion_equipos WHERE id_estacion = '".$Session_IDEstacion."' AND YEAR(fecha) = '".$GET_YEAR."' AND estado = 1 ORDER BY fecha DESC ";
      $result = mysqli_query($con, $sql);
      $numero = mysqli_num_rows($result);
      while($row = mysqli_fetch_array($result, MYSQLI_ASSOC)){

      if($row['equipo'] == "Dispensario"){
      $contenid0 .= DetalleDispensario($row['id'],$con);  
      }

      if($row['equipo']  == "Jarra patron"){
      $contenid0 .= DetalleJarra($row['id'],$con);  
      }

      if($row['equipo']  ==  "Tanques de almacenamiento"){
      $contenid0 .= DetalleTanque($row['id'],$con);
      }
      

      if($row['equipo']  ==  "Sondas de medición"){
      $contenid0 .= DetalleSonda($row['id'],$con);
      }


      }

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
$dompdf->get_canvas()->page_text(515, 820, "Pagina: {PAGE_NUM} de {PAGE_COUNT}", $font, 8, array(0,0,0));
// Ponemos el PDF en el browser
$dompdf->stream('Bitácora calibración de equipos.pdf',["Attachment" => true]);

//-----------------
mysqli_close($con);
//-----------------