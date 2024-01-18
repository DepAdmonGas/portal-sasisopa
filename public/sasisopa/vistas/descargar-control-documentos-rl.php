<?php
require_once 'dompdf/autoload.inc.php';
include_once "app/help.php";

function RequisitosLegales($idEstacion,$NivelGobierno,$con){

if($NivelGobierno == 'municipal'){
$Detalle = 'Nivel de gobierno <b>Municipal</b>';
}else if($NivelGobierno == 'federal'){
$Detalle = 'Nivel de gobierno <b>Federal</b>';
}else if($NivelGobierno == 'estatal'){
$Detalle = 'Nivel de gobierno <b>Estatal</b>';
}else if($NivelGobierno == 'varios'){
$Detalle = 'Nivel de gobierno <b>Varios</b>';
}

$sql = "SELECT
rl_requisitos_legales_calendario.id,
rl_requisitos_legales_calendario.nivel_gobierno,
rl_requisitos_legales_calendario.vigencia,
rl_requisitos_legales_calendario.estado,
rl_requisitos_legales_lista.dependencia,
rl_requisitos_legales_lista.permiso,
rl_requisitos_legales_lista.fundamento
FROM rl_requisitos_legales_calendario
INNER JOIN 
rl_requisitos_legales_lista ON 
rl_requisitos_legales_calendario.id_requisito_legal = rl_requisitos_legales_lista.id
WHERE rl_requisitos_legales_calendario.id_estacion = '".$idEstacion."' AND rl_requisitos_legales_calendario.nivel_gobierno = '".$NivelGobierno."' AND rl_requisitos_legales_calendario.estado = 1 ORDER BY dependencia ASC";
$result = mysqli_query($con, $sql);
$numero = mysqli_num_rows($result);

$contenido .= '<table class="table table-bordered table-sm" style="font-size: .85em">';
$contenido .= '<tbody>';
$contenido .= '<tr class="bg-primary text-white" style="font-size: 1.3em">
<th class="align-middle" colspan="3">'.$Detalle.'</th>
</tr>';
$contenido .= '<tr class="bg-light">
<th class="align-middle">Dependencia</th>
<th class="align-middle">Permiso</th>
<th class="align-middle">Fundamento</th>
</tr>';
while($row = mysqli_fetch_array($result, MYSQLI_ASSOC)){

$idrequisitol = $row['id_requisito_legal'];
$idre = $row['id'];
$vigencia = $row['vigencia'];


$contenido .= '<tr>
<td class="align-middle"><b>'.$row['dependencia'].'</b></td>
<td class="align-middle"><b>'.$row['permiso'].'</b></td>
<td class="align-middle">'.$row['fundamento'].'</td>
</tr>';

}
$contenido .= '</tbody>';
$contenido .= '</table>';

return $contenido;
}

function RequisitoLegal($idRequisito,$con){

$sql = "SELECT permiso FROM rl_requisitos_legales_lista WHERE id = '".$idRequisito."'";
$result = mysqli_query($con, $sql);
$numero = mysqli_num_rows($result);
while($row = mysqli_fetch_array($result, MYSQLI_ASSOC)){
$permiso = $row['permiso'];
}

return $permiso;
}

function DetalleRL($idrequisitol,$con){
$sql = "SELECT * FROM rl_requisitos_legales_lista WHERE id = '".$idrequisitol."' LIMIT 1 ";
$result = mysqli_query($con, $sql);
$numero = mysqli_num_rows($result);
 while($row = mysqli_fetch_array($result, MYSQLI_ASSOC)){
$dependencia = $row['dependencia'];
$permiso = $row['permiso']; 
$fundamento = $row['fundamento']; 
}
$array = array(
"dependencia" => $dependencia,
"permiso" => $permiso,
"fundamento" => $fundamento,
);
return $array;
}

use Dompdf\Dompdf;
$dompdf = new Dompdf();

    $contenid0 .= "<!DOCTYPE html>";
    $contenid0 .= "<html>";
    $contenid0 .= "<head>";
    $contenid0 .= "<title>Control y documentos de Requisitos Legales</title>";
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
  font-size: 1rem;
  font-weight: 400;
  line-height: 1.5;
  color: #212529;
  background-color: #fff;
}

.text-center {
  text-align: center !important;
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
.bg-primary {
  background-color: #007bff;
}
.text-white {
  color: #fff !important;
}
.bg-light {
  background-color: #f8f9fa !important;
}
</style>';

$contenid0 .= '</head>';
$contenid0 .= '<body';


$contenid0 .= '<div class=""></div>';
$contenid0 .= RequisitosLegales($Session_IDEstacion,'municipal',$con);
$contenid0 .= '<div class=""></div>';
$contenid0 .= RequisitosLegales($Session_IDEstacion,'federal',$con);
$contenid0 .= '<div class=""></div>';
$contenid0 .= RequisitosLegales($Session_IDEstacion,'estatal',$con);
$contenid0 .= '<div class=""></div>';
$contenid0 .= RequisitosLegales($Session_IDEstacion,'varios',$con);


$contenid0 .= '</body>';
$contenid0 .= '</html>';


$dompdf->loadHtml($contenid0);
// Colocamos als propiedades de la hoja
$dompdf->setPaper("A4", "landscape");
// Escribimos el html en el PDF
$dompdf->render();
$dompdf->get_canvas()->page_text(750, 570, "Pagina: {PAGE_NUM} de {PAGE_COUNT}", $font, 8, array(0,0,0));
// Ponemos el PDF en el browser
$dompdf->stream('Control y documentos de Requisitos Legales.pdf',["Attachment" => true]);
//------------------
mysqli_close($con);
//------------------