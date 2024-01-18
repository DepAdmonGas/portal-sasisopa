<?php
require_once 'dompdf/autoload.inc.php';
include_once "app/help.php";

use Dompdf\Dompdf;
$dompdf = new Dompdf();


    $contenid0 .= "<!DOCTYPE html>";
    $contenid0 .= "<html>";
    $contenid0 .= "<head>";
    $contenid0 .= "<title>INVESTIGACIÓN DE INCIDENTES Y ACCIDENTES</title>";
    $contenid0 .= '<style type="text/css">
@page {margin: 0.5cm 1cm; font-family: Arial, Helvetica, sans-serif;}
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
$contenid0 .= '<h5 class="text-center">INVESTIGACIÓN DE INCIDENTES Y ACCIDENTES</h5>';

$contenid0 .= '<table class="table table-sm table-bordered" style="font-size: .90rem">';
$contenid0 .= '<tr>';
$contenid0 .= '<td class="align-middle bg-light text-center"><b>#</b></td>';
$contenid0 .= '<td class="align-middle bg-light text-center"><b>Fecha</b></td>';
$contenid0 .= '<td class="align-middle bg-light text-center"><b>Nombre</b></th>';
$contenid0 .= '<td class="align-middle bg-light text-center"><b>Puesto</b></th>';
$contenid0 .= '<td class="align-middle bg-light text-center"><b>Descripción evento</b></th>';
$contenid0 .= '<td class="align-middle bg-light text-center"><b>Tipo evento</b></th>';
$contenid0 .= '<td class="align-middle bg-light text-center"><b>Muertes</b></th>';
$contenid0 .= '</tr>';
$contenid0 .= '<tbody>';

$sql_inv = "SELECT * FROM tb_investigacion_incidente_accidente WHERE id_estacion= '".$Session_IDEstacion."' ORDER BY id desc ";
$result_inv = mysqli_query($con, $sql_inv);
$numero_inv = mysqli_num_rows($result_inv);

function Usuario($id, $con){

$sql_usuarios = "SELECT 
tb_usuarios.id,
tb_usuarios.nombre,
tb_puestos.tipo_puesto
FROM tb_usuarios
INNER JOIN tb_puestos ON tb_usuarios.id_puesto = tb_puestos.id WHERE tb_usuarios.id = '".$id."' ";
$result_usuarios = mysqli_query($con, $sql_usuarios);
$numero_usuarios = mysqli_num_rows($result_usuarios);
while($row_usuarios = mysqli_fetch_array($result_usuarios, MYSQLI_ASSOC)){
$nombre = $row_usuarios['nombre'];
$puesto = $row_usuarios['tipo_puesto'];
}

$array = array("nombre" => $nombre, "puesto" => $puesto);

return $array;
}

$i = 1;
while($row = mysqli_fetch_array($result_inv, MYSQLI_ASSOC)){

$fechahora = explode(" ", $row['fechacreacion']);
$Usuario = Usuario($row['id_usuario'], $con);

if ($row['muertes'] == 0) {
$muertes = "NO";
}else{
$muertes = "SI";
}

$contenid0 .=  "<tr>";
$contenid0 .=  "<td class='text-center align-middle'>".$i."</td>";
$contenid0 .=  "<td class='text-center align-middle'>".FormatoFecha($fechahora[0])."</td>";
$contenid0 .=  "<td class='text-center align-middle'>".$Usuario['nombre']."</td>";
$contenid0 .=  "<td class='text-center align-middle'>".$Usuario['puesto']."</td>";
$contenid0 .=  "<td class='text-center align-middle'>".$row['descripcion']."</td>";
$contenid0 .=  "<td class='text-center align-middle'>".$row['tipo_evento']."</td>";
$contenid0 .=  "<td class='text-center align-middle'>".$muertes."</td>";
$contenid0 .=  "</tr>";

$i++;
}

$contenid0 .= '</tbody>';
$contenid0 .= '</table>';

//-----------------------------------------------------------------

$contenid0 .= '</div>';
$contenid0 .= '</body>';
$contenid0 .= '</html>';

$dompdf->loadHtml($contenid0);
// Colocamos als propiedades de la hoja
$dompdf->setPaper("A4", "portrait");
// Escribimos el html en el PDF
$dompdf->render();
$dompdf->get_canvas()->page_text(515, 820, "Pagina: {PAGE_NUM} de {PAGE_COUNT}", $font, 8, array(0,0,0));
// Ponemos el PDF en el browser
$dompdf->stream('INVESTIGACIÓN DE INCIDENTES Y ACCIDENTES.pdf',["Attachment" => true]);

//------------------
mysqli_close($con);
//------------------