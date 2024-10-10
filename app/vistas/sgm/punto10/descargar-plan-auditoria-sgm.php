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

  function ValidaUsuario($idReporte,$personal,$con){
$sql_lista = "SELECT * FROM sgm_plan_auditoria_responsable WHERE id_plan  = '".$idReporte."' AND id_responsable = '".$personal."' ";
$result_lista = mysqli_query($con, $sql_lista);
return $numero_lista = mysqli_num_rows($result_lista);
}

function auditor($id_plan,$cate,$con){
$return = '';

$sql = "SELECT * FROM sgm_plan_auditoria_auditor WHERE id_plan = '".$id_plan."' AND categoria = '".$cate."' ";
$result = mysqli_query($con, $sql);
$numero = mysqli_num_rows($result);

while($row = mysqli_fetch_array($result, MYSQLI_ASSOC)){

$return .= '<tr>
<td class="align-middle">'.$row['categoria'].'</td>
<td class="align-middle">'.$row['nombre'].'</td>
<td class="align-middle">'.$row['area_actividad'].'</td>
</tr>';

}

return $return;

}

function auxiliar($id_plan,$cate,$con){

$return = '';

$sql = "SELECT * FROM sgm_plan_auditoria_auditor WHERE id_plan = '".$id_plan."' AND categoria = '".$cate."' ";
$result = mysqli_query($con, $sql);
$numero = mysqli_num_rows($result);

$return .= '<table class="table table-bordered table-sm p-0 m-0">';
while($row = mysqli_fetch_array($result, MYSQLI_ASSOC)){
$return .= '<tr>
<td><small>'.$row['nombre'].'</small></td>
</tr>';
}
$return .= '</table>';

return $return;

}


  $sql = "SELECT * FROM sgm_plan_auditoria WHERE id_auditoria = '".$GET_idRegistro."' ";
$result = mysqli_query($con, $sql);
$numero = mysqli_num_rows($result);
$row = mysqli_fetch_array($result, MYSQLI_ASSOC);
$id = $row['id'];
$fecha = $row['fecha'];
$nom_director = $row['nom_director'];
$ubicacion_instalacion = $row['ubicacion_instalacion'];
$objetivo_auditoria = $row['objetivo_auditoria'];
$alcance_auditoria = $row['alcance_auditoria'];
$fecha_programada = $row['fecha_programada'];
$sitio = $row['sitio'];
$metodo_auditoria = $row['metodo_auditoria'];
$ajuste_plan = $row['ajuste_plan'];
$asignacion_recursos = $row['asignacion_recursos'];
$preparativos_logisticos = $row['preparativos_logisticos'];
$acciones = $row['acciones'];
$realizadopor = usuario($row['realizadopor'],$con);

use Dompdf\Dompdf;
$dompdf = new Dompdf();
    
    $contenid0 = "";
    $contenid0 = "";
    $contenid0 .= "<!DOCTYPE html>";
    $contenid0 .= "<html>";
    $contenid0 .= "<head>";
    $contenid0 .= "<title>Plan de Auditoria</title>";
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

.bg-secondary {
  background-color: #6c757d !important;
}

.text-white {
  color: #fff !important;
}

.m-0 {
  margin: 0 !important;
}

.p-0 {
  padding: 0 !important;
}

.bg-light {
  background-color: #f8f9fa !important;
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
      $contenid0 .= '<b>Plan de Auditoria</b>';
      $contenid0 .= '</td>';
      $contenid0 .= '<td class="align-middle text-center">';
      $contenid0 .= '<b>Fecha de autorización: 01-01-2024</b>';
      $contenid0 .= '</td>';
      $contenid0 .= '</tr>';
      //------------------------------------------------------------------
      $contenid0 .= '<tr>';
      $contenid0 .= '<td class="align-middle text-center">';
      $contenid0 .= 'Fo.SGM.018';
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

      $contenid0 .= '<table class="table table-bordered table-sm mb-0">
        <tbody>
          <tr class="bg-secondary text-white">
            <td colspan="3"><b>I. DATOS GENERALES DEL PERMISIONARIO</b></td>
          </tr>
          <tr>
            <td class="align-middle bg-light">NOMBRE, DENOMINACIÓN O RAZÓN SOCIAL:</td>
            <td class="align-middle bg-light">Permiso CRE:</td>
            <td class="align-middle bg-light">FECHA DE ELABORACIÓN:</td>
          </tr>
          <tr>
            <td class="align-middle bg-light">'.$Session_Razonsocial.'</td>
            <td class="align-middle bg-light">'.$Session_Permisocre.'</td>
            <td class="align-middle">'.FormatoFecha($fecha).'</td>
          </tr>
          <tr>
            <td class="align-middle bg-light">NOMBRE DEL DIRECTOR (ALTA DIRECCIÓN):</td>
            <td colspan="2" class="align-middle">'.$nom_director.'</td>
          </tr>

          <tr>
            <td class="align-middle bg-light">NOMBRE DEL(LOS) RESPONSABLE DEL SGM</td>
            <td colspan="2" class="p-0 m-0 align-middle">';
  
              $sql_ar = "SELECT * FROM sgm_plan_auditoria_responsable WHERE id_plan = '".$id."' ";
              $result_ar = mysqli_query($con, $sql_ar);
              $numero_ar = mysqli_num_rows($result_ar);

              $contenid0 .= '<table class="table table-sm table-bordered p-0 m-0">';
              while($row_ar = mysqli_fetch_array($result_ar, MYSQLI_ASSOC)){

              $nombre_ar = usuario($row_ar['id_responsable'],$con);

             $contenid0 .= '<tr>
              <td><small>'.$nombre_ar['nombre'].'</small></td>
              </tr>';
              }
             $contenid0 .= '</table>';
          $contenid0 .= '</td>
          </tr>

           <tr>
            <td class="align-middle bg-light">UBICACIÓN DE LA INSTALACIÓN</td>
            <td colspan="2" class="align-middle">'.$ubicacion_instalacion.'</td>
          </tr>
        </tbody>
      </table>';

      $contenid0 .= '<table class="table table-bordered table-sm p-0 m-0">
      <tbody>
          <tr class="bg-secondary text-white">
          <td colspan="3"><b>II. DATOS DEL AUDITOR</b></td>
          </tr>
          <tr class="bg-light">
          <td>EQUIPO AUDITOR</td>
          <td>NOMBRE:</td>
          <td>ÁREA/PROCESO/ACTIVIDAD QUE AUDITA:</td>
          </tr>';

          $contenid0 .= auditor($id,'AUDITOR LÍDER',$con);
          $contenid0 .= auditor($id,'AUDITOR',$con);

      $contenid0 .= '</tbody>
      </table>';

    $contenid0 .= '<table class="table table-bordered table-sm">
    <tbody>
    <tr class="bg-secondary text-white">
    <td colspan="3"><b>III DATOS DEL EQUIPO AUXILIAR DEL AUDITOR</b></td>
    </tr>
    <tr class="bg-light">
    <td>GUÍAS:</td>
    <td>OBSERVADORES:</td>
    <td>EXPERTO(S) TÉCNICO(S)</td>
    </tr>';
    $contenid0 .= '<tr>';
    $contenid0 .= '<td class="p-0 m-0">'.auxiliar($id,'GUÍAS',$con).'</td>';
    $contenid0 .= '<td class="p-0 m-0">'.auxiliar($id,'OBSERVADORES',$con).'</td>';
    $contenid0 .= '<td class="p-0 m-0">'.auxiliar($id,'EXPERTO(S) TÉCNICO(S)',$con).'</td>';
    $contenid0 .= '</tr>';
    $contenid0 .= '</tbody>
    </table>';

    $contenid0 .= '<table class="table table-sm table-bordered mb-0">
            <tbody>
           <tr class="bg-secondary text-white">
            <td colspan="3"><b>IV Auditoria</b></td>
          </tr>

          <tr>
            <td colspan="3" class="bg-light">OBJETIVOS DE LA AUDITORÍA.</td>
          </tr>
          <tr>
            <td colspan="3" class="">'.$objetivo_auditoria.'</td>
          </tr>

          <tr>
            <td colspan="3" class="bg-light">ALCANCE DE LA AUDITORÍA. </td>
          </tr>
          <tr>
            <td colspan="3" class="">'.$alcance_auditoria.'</td>
          </tr>

          <tr>
            <td colspan="3" class="bg-light">FECHA PROGRAMADA DE AUDITORIA</td>
          </tr>
          <tr>
            <td colspan="3" class="">'.FormatoFecha($fecha_programada).'</td>
          </tr>

          <tr>
            <td colspan="3" class="bg-light">SITIO</td>
          </tr>
          <tr>
            <td colspan="3" class="">'.$sitio.'</td>
          </tr>

          <tr>
            <td colspan="3" class="bg-light">MÉTODOS DE AUDITORÍA:</td>
          </tr>
          <tr>
            <td colspan="3" class="">'.$metodo_auditoria.'</td>
          </tr>

          <tr>
            <td colspan="3" class="bg-light">AJUSTES AL PLAN:</td>
          </tr>
           <tr>
            <td colspan="3" class="">'.$ajuste_plan.'</td>
          </tr>

          <tr>
            <td colspan="3" class="bg-light">ASIGNACIÓN DE RECURSOS APROPIADOS PARA LAS ÁREAS CRÍTICAS, CUANDO APLIQUE:</td>
          </tr>
           <tr>
            <td colspan="3" class="">'.$asignacion_recursos.'</textarea></td>
          </tr>

          <tr>
            <td colspan="3" class="bg-light">PREPARATIVOS LOGÍSTICOS Y DE COMUNICACIONES (Requisitos para el ingreso a las instalaciones, medidas de seguridad, números de emergencia, lugar de reunión de apertura, lugar de reunión de cierre, transporte y otros requerimientos del Equipo Auditor, como hospedaje, alimentos, entre otros):</td>
          </tr>
           <tr>
            <td colspan="3" class="">'.$preparativos_logisticos.'</td>
          </tr>

          <tr>
            <td colspan="3" class="bg-light">ACCIONES DE SEGUIMIENTO A PARTIR DE LA INFORMACIÓN GENERADA EN AUDITORÍAS PREVIAS.</td>
          </tr>
           <tr>
            <td colspan="3" class="">'.$acciones.'</td>
          </tr>

        </tbody>
      </table>';

$sql_agenda = "SELECT * FROM sgm_plan_auditoria_agenda WHERE id_plan = '".$id."' ";
$result_agenda = mysqli_query($con, $sql_agenda);
$numero_agenda = mysqli_num_rows($result_agenda);


$contenid0 .= '<table class="table table-sm table-bordered m-0 p-0">
        <tbody>
          <tr>
            <td colspan="4" class="bg-secondary text-white"><b>V. AGENDA.</b><br>
            <small>Nota: Elaborar una Agenda para cada sitio a ser auditado.</small>
            </td>
          </tr>
        </tbody>        
      </table>

    <table class="table table-bordered table-striped table-hover table-sm">
    <thead>
    <tr class="bg-light">
      <th class="text-center align-middle">HORARIO</th>
      <th class="text-center align-middle">PROCESO</th>
      <th class="text-center align-middle">ELEMENTO DEL SISTEMA DE GESTION DE MEDICION</th>
      <th class="text-center align-middle">NOMBRE Y ROL DEL AUDITOR</th>
      <th class="text-center align-middle">GUÍA</th>
    </tr>
    </thead>
    <tbody>';


if ($numero_agenda > 0) {
while($row_agenda = mysqli_fetch_array($result_agenda, MYSQLI_ASSOC)){

$contenid0 .= '<tr>
<td class="text-center align-middle">De '.$row_agenda['hora_inicio'].' a '.$row_agenda['hora_termino'].'</td>
<td class="text-center align-middle">'.$row_agenda['proceso'].'</td>
<td class="text-center align-middle">'.$row_agenda['elemento_sistema'].'</td>
<td class="text-center align-middle">'.$row_agenda['nombre_rol'].'</td>
<td class="text-center align-middle">'.$row_agenda['guia'].'</td>
</tr>';

}
}else{
$contenid0 .= "<td colspan='5' class='text-center text-secondary' style='font-size: .8em;'>No se encontró información para mostrar</td>";
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
$dompdf->stream('Plan de Auditoria.pdf');
//------------------
mysqli_close($con);
//------------------
