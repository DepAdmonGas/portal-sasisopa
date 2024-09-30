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


use Dompdf\Dompdf;
$dompdf = new Dompdf();

    $contenid0 = "";
    $contenid0 .= "<!DOCTYPE html>";
    $contenid0 .= "<html>";
    $contenid0 .= "<head>";
    $contenid0 .= "<title>Lista de personal</title>";
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
  font-size: .75rem;
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
      $contenid0 .= '<b>Lista de personal</b>';
      $contenid0 .= '</td>';
      $contenid0 .= '<td class="align-middle text-center">';
      $contenid0 .= '<b>Fecha de autorización: 01-01-2024</b>';
      $contenid0 .= '</td>';
      $contenid0 .= '</tr>';
      //------------------------------------------------------------------
      $contenid0 .= '<tr>';
      $contenid0 .= '<td class="align-middle text-center">';
      $contenid0 .= 'Fo.SGM.008';
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

      $contenid0 .= '<table class="table table-sm table-bordered">';
      $contenid0 .= '<thead>
      <tr>
        <th class="align-middle">No</th>
        <th class="align-middle">Nombre</th>
        <th class="align-middle">Estatus</th>
        <th class="align-middle">Fecha de Ingreso</th>
        <th class="align-middle">Puesto</th>
        <th class="align-middle">Grado de responsabilidad respecto al SGM</th>
      </tr>
      </thead>';
      $contenid0 .= '<tbody>';

      $sql_usuarios = "SELECT * FROM tb_usuarios WHERE id_gas = '".$Session_IDEstacion."' and estatus = 0 ";
      $result_usuarios = mysqli_query($con, $sql_usuarios);
      $numero_usuarios = mysqli_num_rows($result_usuarios);

      while($row_usuarios = mysqli_fetch_array($result_usuarios, MYSQLI_ASSOC)){
      $idusuario = $row_usuarios['id'];
      $nombreusuario = $row_usuarios['nombre'];
      $telefono = $row_usuarios['telefono'];
      $email = $row_usuarios['email'];
      $usuario = $row_usuarios['usuario'];
      $idpuesto = $row_usuarios['id_puesto'];
      $respoabilidad_sgm = $row_usuarios['respoabilidad_sgm'];


      $sql_puesto = "SELECT * FROM tb_puestos WHERE id = '$idpuesto' ";
      $result_puesto = mysqli_query($con, $sql_puesto);
      $numero_puesto = mysqli_num_rows($result_puesto);
      while($row_puesto = mysqli_fetch_array($result_puesto, MYSQLI_ASSOC)){
      $puesto = $row_puesto['tipo_puesto'];
      }

      $sql = "SELECT * FROM tb_usuarios_experiencia_empresa_grupo WHERE id_usuario = '$idusuario' ORDER BY periodo_inicio DESC LIMIT 1 ";
      $result = mysqli_query($con, $sql);
      $numero = mysqli_num_rows($result);
      if($numero > 0){
      while($row = mysqli_fetch_array($result, MYSQLI_ASSOC)){
      $fechainicio = FormatoFecha($row['periodo_inicio']);
      }
      }else{
        $fechainicio = "";
      }

      $contenid0 .= "<tr>";
      $contenid0 .= "<td class='text-center align-middle'>".$idusuario."</td>";
      $contenid0 .= "<td class='text-center align-middle'>".$nombreusuario."</td>";
      $contenid0 .= "<td class='text-center align-middle'>Activo</td>";
      $contenid0 .= "<td class='text-center align-middle'>".$fechainicio."</td>";
      $contenid0 .= "<td class='text-center align-middle'>".$puesto."</td>";
      $contenid0 .= "<td class='text-center align-middle'>".$respoabilidad_sgm."</td>";
      $contenid0 .= "</tr>";
      }


      $contenid0 .= '</tbody>';
      $contenid0 .= '</table>';

//-----------------------------------------------------------------
$contenid0 .= '</div>';

$contenid0 .= '</body>';
$contenid0 .= '</html>';


$dompdf->loadHtml($contenid0);
$dompdf->setPaper("A4", "portrait");
$dompdf->render();
$dompdf->stream('Lista de personal.pdf');
//------------------
mysqli_close($con);
//------------------