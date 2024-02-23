<?php
require_once 'dompdf/autoload.inc.php';
include_once "app/help.php";

use Dompdf\Dompdf;
$dompdf = new Dompdf();

$RutaLogo = SERVIDOR."imgs/logo/Logo.png";
    $DataLogo = file_get_contents($RutaLogo);
    $baseLogo = 'data:image/;base64,' . base64_encode($DataLogo);

$contenid0 .= "<!DOCTYPE html>";
$contenid0 .= "<html>";
$contenid0 .= "<head>";
$contenid0 .= "<title>Fichas de personal</title>";
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
hr {
    margin: 1rem 0;
    color: inherit;
    background-color: #565656;
    border: 0;
    opacity: 0.80;
  }
</style>';

$contenid0 .= '</head>';
$contenid0 .= '<body>';


$contenid0 .= '<div>';

$contenid0 .= '<table class="table table-bordered" style="font-size: .8em">';
$contenid0 .= '<tbody>';
$contenid0 .= '<tr>';

$contenid0 .= '<td class="align-middle text-center">';
$contenid0 .= "<img src='".$baseLogo."' style='width: 130px;'>";
$contenid0 .= '</td>';
$contenid0 .= '<td colspan="2" class="align-middle text-center">';
$contenid0 .= '<b>Fichas de personal</b>';
$contenid0 .= '</td>';
$contenid0 .= '<td class="align-middle text-center">';
$contenid0 .= '<b>Fo.ADMONGAS.008</b>';
$contenid0 .= '</td>';

$contenid0 .= '</tr>';
//------------------------------------------------------------------
$contenid0 .= '<tr>';
$contenid0 .= '<td class="align-middle text-center">';
$contenid0 .= 'Realizado por:<br> Nelly Estrada Garcia';
$contenid0 .= '</td>';
$contenid0 .= '<td class="align-middle text-center">';
$contenid0 .= 'Revisado por:<br> Eduardo Galicia Flores';
$contenid0 .= '</td>';
$contenid0 .= '<td class="align-middle text-center">';
$contenid0 .= 'Autorizado por:<br> '.$Session_ApoderadoLegal.'';
$contenid0 .= '</td>';
$contenid0 .= '<td class="align-middle text-center">';
$contenid0 .= 'Fecha de aprobacion:<br>  01/10/2018';
$contenid0 .= '</td>';
$contenid0 .= '</tr>';
            
$contenid0 .= '</tbody>';
$contenid0 .= '</table>';
//-----------------------------------------------------------------

$sql_usuarios = "SELECT * FROM tb_usuarios WHERE id_gas = '".$Session_IDEstacion."' AND estatus = 0 ";
$result_usuarios = mysqli_query($con, $sql_usuarios);
$numero_usuarios = mysqli_num_rows($result_usuarios);

while($row_usuarios = mysqli_fetch_array($result_usuarios, MYSQLI_ASSOC)){
$GET_idUsuario = $row_usuarios['id'];
$nombres = $row_usuarios['nombre'];
$fecha_nacimiento = $row_usuarios['fecha_nacimiento'];
$estado_civil = $row_usuarios['estado_civil'];
$segurosocial = $row_usuarios['seguro_social'];
$domicilio = $row_usuarios['domicilio'];
$telefono = $row_usuarios['telefono'];
$email = $row_usuarios['email'];
$usuario = $row_usuarios['usuario'];
$password = $row_usuarios['password'];
$idpuesto = $row_usuarios['id_puesto'];

$sql_puesto = "SELECT * FROM us_puesto WHERE id = '".$idpuesto."' ";
$result_puesto = mysqli_query($con, $sql_puesto);
$numero_puesto = mysqli_num_rows($result_puesto);
while($row_puesto = mysqli_fetch_array($result_puesto, MYSQLI_ASSOC)){
$puesto = $row_puesto['puesto'];
}


//--------------------------------------------------------------------------------------------------------
$contenid0 .= '<div style="margin-top: 10px;margin-bottom: 10px;font-size: .9em"><b>1. Datos personales:</b></div>';

$contenid0 .= '<div style="border-bottom: .9px solid #E6E6E6;padding-bottom: 5px;font-size: .8em">'.$nombres.'</div>';
$contenid0 .= '<div style="color: #A4A4A4;font-size: .8em">Nombre completo:</div>';

$contenid0 .= '<div style="border-bottom: .9px solid #E6E6E6;padding-bottom: 5px;margin-top: 7px;font-size: .8em">'.$domicilio.'</div>';
$contenid0 .= '<div style="color: #A4A4A4;font-size: .8em">Domicilio( Calle, Numero, Colonia, Municipio, Estado, C.P.):</div>';

$contenid0 .= '<table style="width: 100%;margin-top: 7px;font-size: .8em">';
$contenid0 .= '<tbody>';

$contenid0 .= '<tr>';
$contenid0 .= '<td class="align-middle"><div style="border-bottom: .9px solid #E6E6E6;padding-bottom: 5px;">'.FormatoFecha($fecha_nacimiento).'</div></td>';
$contenid0 .= '<td class="align-middle"><div style="border-bottom: .9px solid #E6E6E6;padding-bottom: 5px;">'.$estado_civil.'</div></td>';
$contenid0 .= '</tr>';
$contenid0 .= '<tr>';
$contenid0 .= '<td class="align-middle" style="color: #A4A4A4;">Fecha de nacimiento:</td>';
$contenid0 .= '<td class="align-middle" style="color: #A4A4A4;">Estado civil:</td>';
$contenid0 .= '</tr>';

$contenid0 .= '<tr>';
$contenid0 .= '<td class="align-middle"><div style="border-bottom: .9px solid #E6E6E6;padding-bottom: 5px;">'.$segurosocial.'</div></td>';
$contenid0 .= '<td class="align-middle"><div style="border-bottom: .9px solid #E6E6E6;padding-bottom: 5px;">'.$telefono.'</div></td>';
$contenid0 .= '</tr>';
$contenid0 .= '<tr>';
$contenid0 .= '<td class="align-middle" style="color: #A4A4A4;">No. De seguro social:</td>';
$contenid0 .= '<td class="align-middle" style="color: #A4A4A4;">Telefono:</td>';
$contenid0 .= '</tr>';
$contenid0 .= '</tbody>';
$contenid0 .= '</table>';
//----------------------------------------------------------------------------------------------------------------------------
//---------------------------------------------------------------------------------------------------------------------------
$contenid0 .= '<div style="margin-top: 10px;margin-bottom: 10px;font-size: .9em"><b>2. Datos de familiares</b></div>';

$contenid0 .= '<table class="table table-bordered" style="font-size: .8em">';
$contenid0 .= '<tbody>';

$contenid0 .= '<tr>
<td><b>Nombre:</b></td>
<td><b>Parentesco:</b></td>
<td><b>Dirección:</b></td>
<td><b>Teléfono:</b></td>
</tr>';

  $sql_d_familiares = "SELECT * FROM tb_usuarios_familiares WHERE id_usuario = '".$GET_idUsuario."' ";
  $result_d_familiares = mysqli_query($con, $sql_d_familiares);
  $numero_d_familiares = mysqli_num_rows($result_d_familiares);
  if ($numero_d_familiares > 0) {
    while($row_familiares = mysqli_fetch_array($result_d_familiares, MYSQLI_ASSOC)){
    $idDP = $row_familiares['id'];
    $contenid0 .= "<tr>";
    $contenid0 .= "<td>".$row_familiares['nombrecompleto']."</td>";
    $contenid0 .= "<td>".$row_familiares['parentesco']."</td>";
    $contenid0 .= "<td>".$row_familiares['domicilio']."</td>";
    $contenid0 .= "<td>".$row_familiares['telefono']."</td>";
    $contenid0 .= "</tr>";
    }
  }else{
    $contenid0 .= "<tr><td colspan='4' class='text-center text-secondary'>No se encontraron datos familiares</td></tr>";
  }

$contenid0 .= '</tbody>';
$contenid0 .= '</table>';
//---------------------------------------------------------------------------------------------------------------------------
//---------------------------------------------------------------------------------------------------------------------------
$contenid0 .= '<div style="margin-top: 10px;margin-bottom: 10px;font-size: .9em"><b>3. Formación académica</b></div>';

$contenid0 .= '<table class="table table-bordered" style="font-size: .8em">';
$contenid0 .= '<tbody>';

$contenid0 .= '<tr>
    <td><b>Nivel:</b></td>
    <td><b>Institución:</b></td>
  </tr>';

  $sql_f_academica = "SELECT * FROM tb_usuarios_formacion_academica WHERE id_usuario = '".$GET_idUsuario."' ";
  $result_f_academica = mysqli_query($con, $sql_f_academica);
  $numero_f_academica = mysqli_num_rows($result_f_academica);
  if ($numero_f_academica > 0) {
  while($row_academica = mysqli_fetch_array($result_f_academica, MYSQLI_ASSOC)){
  $idFA = $row_academica['id'];
  $contenid0 .= "<tr>";
  $contenid0 .= "<td>".$row_academica['nivel']."</td>";
  $contenid0 .= "<td>".$row_academica['detalle']."</td>";
  $contenid0 .= "</tr>";
  }
  }else{
    $contenid0 .= "<tr><td colspan='2' class='text-center text-secondary'>No se encontraron información académica</td></tr>";
  }

$contenid0 .= '</tbody>';
$contenid0 .= '</table>';

//---------------------------------------------------------------------------------------------------------------------------
//---------------------------------------------------------------------------------------------------------------------------
$contenid0 .= '<div style="margin-top: 10px;margin-bottom: 10px;font-size: .9em"><b>4. Experiencia laboral</b></div>';
$contenid0 .= '<div style="margin-top: 10px;margin-bottom: 10px;font-size: .9em"><b>4.1 En otras empresas </b></div>';

$contenid0 .= '<table class="table table-bordered" style="font-size: .8em">';
$contenid0 .= '<tbody>';

  $sql_e_laboral = "SELECT * FROM tb_usuarios_experiencia_laboral WHERE id_usuario = '".$GET_idUsuario."' ";
  $result_e_laboral = mysqli_query($con, $sql_e_laboral);
  $numero_e_laboral = mysqli_num_rows($result_e_laboral);
  if ($numero_e_laboral > 0) {
  $num = 1;
  while($row_laboral = mysqli_fetch_array($result_e_laboral, MYSQLI_ASSOC)){
  $idEL = $row_laboral['id'];
  $contenid0 .= "<tr>";
  $contenid0 .= "<td>".$num."</td>";
  $contenid0 .= "<td>".$row_laboral['detalle']."</td>";
  $contenid0 .= "</tr>";

  $num ++;
  }
  }else{
  $contenid0 .= "<tr><td colspan='' class='text-center text-secondary'>No se encontro información de experiencia laboral en otras empresas</td></tr>";
  }

$contenid0 .= '</tbody>';
$contenid0 .= '</table>';

//----------------------------------------------------------------------------------------------------------------------------
//----------------------------------------------------------------------------------------------------------------------------
$contenid0 .= '<div style="margin-top: 10px;margin-bottom: 10px;font-size: .9em"><b>4.2 En la empresa </b></div>';

$contenid0 .= '<table class="table table-bordered" style="font-size: .8em">';
$contenid0 .= '<tbody>';

$contenid0 .= '  <tr>
    <td class="align-middle" rowspan="2"><b>Razón social</b></td>
    <td class="align-middle" rowspan="2"><b>Puesto</b></td>
    <td colspan="2" class="text-center"><b>Periodo</b></td>
  </tr>
<tr>
    <td class="text-center"><b>Inicio</b></td>
    <td class="text-center"><b>Termino</b></td>
  </tr>';

  $sql_e_grupo = "SELECT * FROM tb_usuarios_experiencia_empresa_grupo WHERE id_usuario = '".$GET_idUsuario."' ";
  $result_e_grupo = mysqli_query($con, $sql_e_grupo);
  $numero_e_grupo = mysqli_num_rows($result_e_grupo);
  if ($numero_e_grupo > 0) {
  while($row_grupo = mysqli_fetch_array($result_e_grupo, MYSQLI_ASSOC)){
  $idEE = $row_grupo['id'];
  $contenid0 .= "<tr>";
  $contenid0 .= "<td class=''>".$row_grupo['razon_social']."</td>";
  $contenid0 .= "<td class=''>".$row_grupo['puesto']."</td>";
  $contenid0 .= "<td class='text-center'>".FormatoFecha($row_grupo['periodo_inicio'])."</td>";
  $contenid0 .= "<td class='text-center'>".FormatoFecha($row_grupo['periodo_fin'])."</td>";
  $contenid0 .= "</tr>";
  }
  }else{
    $contenid0 .= "<tr><td colspan='4' class='text-center text-secondary'>No se encontro información de experiencia laboral en esta empresa</td></tr>";
  }

$contenid0 .= '</tbody>';
$contenid0 .= '</table>';

//----------------------------------------------------------------------------------------------------------------------------
//---------------------------------------------------------------------------------------------------------------------------

$contenid0 .= '<hr>';

}
$contenid0 .= '</div>';

$contenid0 .= '</body>';
$contenid0 .= '</html>';


$dompdf->loadHtml($contenid0);
// Colocamos als propiedades de la hoja
$dompdf->setPaper("A4", "portrait");
// Escribimos el html en el PDF
$dompdf->render();
$dompdf->get_canvas()->page_text(750, 570, "Pagina: {PAGE_NUM} de {PAGE_COUNT}", $font, 8, array(0,0,0));
// Ponemos el PDF en el browser
$dompdf->stream('Reporte completo de Fichas de personal.pdf',["Attachment" => true]);
//------------------
mysqli_close($con);
//------------------