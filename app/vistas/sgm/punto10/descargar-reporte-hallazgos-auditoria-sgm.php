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
    if($numero >= 1){
    $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
    $Nombre = $row['nombre'];
    $puesto = $row['tipo_puesto'];
    $firma = $row['firma'];
    }else{
    $Nombre = '';
    $puesto = '';
    $firma = '';
    }
    $array = array('nombre' => $Nombre, 'puesto' => $puesto, 'firma' => $firma);
    return $array;
    }

$sql = "SELECT * FROM sgm_hallazgo_auditoria WHERE id_auditoria = '".$GET_idRegistro."' ";
$result = mysqli_query($con, $sql);
$numero = mysqli_num_rows($result);
$row = mysqli_fetch_array($result, MYSQLI_ASSOC);
$id = $row['id'];
$fecha = ($row['fecha'] == '0000-00-00') ?  'S/I' : FormatoFecha($row['fecha']);
$fecha_ubicacion = $row['fecha_ubicacion'];
$objetivo_auditoria = $row['objetivo_auditoria'];
$alcance_auditoria = $row['alcance_auditoria'];
$comentarios = $row['comentarios'];
$nota = $row['nota'];
$motivos = $row['motivos'];
$conclusiones = $row['conclusiones'];
$lugar_fecha = $row['lugar_fecha'];
$auditor_lider = $row['auditor_lider'];
$responsable_sgm = $row['responsable_sgm'];

$realizadopor = usuario($row['realizadopor'],$con);
$nom_auditor = usuario($auditor_lider,$con);
$nom_responsable = usuario($responsable_sgm, $con);


use Dompdf\Dompdf;
$dompdf = new Dompdf();
    
    $contenid0 = "";
    $contenid0 .= "<!DOCTYPE html>";
    $contenid0 .= "<html>";
    $contenid0 .= "<head>";
    $contenid0 .= "<title>Reporte e Hallazgos de Auditoria</title>";
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

.pb-0,
.py-0 {
  padding-bottom: 0 !important;
}
.mb-0,
.my-0 {
  margin-bottom: 0 !important;
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
$contenid0 .= '<b>Reporte e Hallazgos de Auditoria</b>';
$contenid0 .= '</td>';
$contenid0 .= '<td class="align-middle text-center">';
$contenid0 .= '<b>Fecha de autorización: 01-01-2024</b>';
$contenid0 .= '</td>';
$contenid0 .= '</tr>';
//------------------------------------------------------------------
$contenid0 .= '<tr>';
$contenid0 .= '<td class="align-middle text-center">';
$contenid0 .= 'Fo.SGM.019';
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

$contenid0 .= '<table class="table table-bordered table-sm pb-0 mb-0 ">
<tbody>
  <tr>
    <td colspan="3" class="bg-secondary text-white"><b>I. DATOS GENERALES DEL PERMISIONARIO</b></td>
  </tr>
  <tr>
    <td class="align-middle bg-light">NOMBRE, DENOMINACIÓN O RAZÓN SOCIAL:</td>
    <td class="align-middle bg-light">PERMISO CRE:</td>
    <td class="align-middle bg-light">FECHA DE ELABORACIÓN:</td>
  </tr>
  <tr>
    <td class="align-middle bg-light">'.$Session_Razonsocial.'</td>
    <td class="align-middle bg-light">'.$Session_Permisocre.'</td>
    <td class="align-middle">'.$fecha.'</td>
  </tr>

  <tr>
    <td class="align-middle bg-light">NOMBRES DEL RESPONSABLE DEL SGM:</td>
    <td colspan="2" class="p-0 m-0">';

    $sql_sgmr = "SELECT id_responsable FROM sgm_hallazgo_auditoria_responsable WHERE id_hallazgo = '".$id."' ";
    $result_sgmr = mysqli_query($con, $sql_sgmr);
    $numero_sgmr = mysqli_num_rows($result_sgmr);

    $contenid0 .= '<table class="table table-sm table-bordered p-0 m-0">';
    while($row_sgmr = mysqli_fetch_array($result_sgmr, MYSQLI_ASSOC)){

    $nombre_sgmr = usuario($row_sgmr['id_responsable'],$con);

    $contenid0 .= '<tr>
    <td><small>'.$nombre_sgmr['nombre'].'</small></td>
    </tr>';
    }
    $contenid0 .= '</table>';
      
    $contenid0 .= '</td>
      </tr>
      </tbody>
      </table>';

      $contenid0 .= '<table class="table table-sm table-bordered mb-0">
        <tbody>
        <tr>
          <td colspan="2" class="bg-secondary text-white"><b>I.  DATOS DE LA AUDITORÍA</b></td>
        </tr>
        <tr>
          <td class="bg-light">FECHA Y UBICACIÓN DE LA AUDITORÍA:</td>
          <td class="">'.$fecha_ubicacion.'</td>
        </tr>
        <tr>
          <td class="bg-light">OBJETIVO DE LA AUDITORÍA:</td>
          <td class="">'.$objetivo_auditoria.'</td>
        </tr>
        <tr>
          <td class="bg-light">ALCANCE DE LA AUDITORÍA:</td>
          <td class="">'.$alcance_auditoria.'</td>
        </tr>
        </tbody>
      </table>';

      $contenid0 .= '<table class="table table-sm table-bordered mb-0">
        <tbody>
          <tr>
          <td colspan="3" class="bg-secondary text-white text-center">PERSONAL ENTREVISTADO</td>
          </tr>
          <tr class="bg-light">
            <td>NOMBRE</td>
            <td>PUESTO</td>
            <td>ÁREA DE ADSCRIPCIÓN</td>
          </tr>';

      $sql_pe = "SELECT * FROM sgm_hallazgo_auditoria_entrevistador WHERE id_hallazgo = '".$id."' ";
      $result_pe = mysqli_query($con, $sql_pe);
      $numero_pe = mysqli_num_rows($result_pe);

      if ($numero_pe > 0) {
      while($row_pe = mysqli_fetch_array($result_pe, MYSQLI_ASSOC)){
      $contenid0 .= '<tr>
      <td class="align-middle">'.$row_pe['nombre'].'</td>
      <td class="align-middle">'.$row_pe['puesto'].'</td>
      <td class="align-middle">'.$row_pe['area_descripcion'].'</td>
      </tr>';
      }
      }else{
      $contenid0 .= "<td colspan='3' class='text-center text-secondary' style='font-size: .8em;'>No se encontró información para mostrar</td>";
      }

      $contenid0 .= '</tbody>
      </table>';

      $contenid0 .= '<table class="table table-sm table-bordered">
        <tbody>
          <tr>
          <td colspan="3" class="bg-secondary text-white text-center">EQUIPO AUDITOR</td>
          </tr>
          <tr class="bg-light">
            <td>NOMBRE</td>
            <td>ROL (AUDITOR LÍDER, AUDITOR EXPERTO TÉCNICO, AUDITOR ESPECIALISTA)</td>
          </tr>';

      $sql_al = "SELECT * FROM sgm_hallazgo_auditoria_auditor WHERE id_hallazgo = '".$id."' ";
      $result_al = mysqli_query($con, $sql_al);
      $numero_al = mysqli_num_rows($result_al);
      if ($numero_al > 0) {
      while($row_al = mysqli_fetch_array($result_al, MYSQLI_ASSOC)){
      $contenid0 .= '<tr>
      <td class="align-middle">'.$row_al['nombre'].'</td>
      <td class="align-middle">'.$row_al['rol'].'</td>
      </tr>';
      }
    }else{
      $contenid0 .= "<td colspan='3' class='text-center text-secondary' style='font-size: .8em;'>No se encontró información para mostrar</td>";
    }

   $contenid0 .= '</tbody>
      </table>';

   $contenid0 .= '<table class="table table-sm table-bordered mb-0">
      <tbody>
        <tr>
            <td colspan="3" class="bg-secondary text-white"><b>II.  RESULTADO DE LA AUDITORÍA</b></td>
          </tr>
          <tr>
            <td colspan="3" class="bg-light text-center">
              ¿Durante la auditoría se revisaron los siguientes elementos?<br>
              Marcar el resultado como C= Conforme, NC= No Conforme, OM= Oportunidad de Mejora
            </td>
          </tr>
          <tr class="bg-light">
            <td>No.</td>
            <td>CRITERIO:</td>
            <td>RESULTADO:</td>
          </tr>';
          $sql_sgme = "SELECT
          sgm_hallazgo_auditoria_resultado.id,
          sgm_hallazgo_auditoria_resultado.id_elemento,
          sgm_hallazgo_auditoria_resultado.resultado,
          sgm_elementos.no,
          sgm_elementos.criterio
          FROM sgm_hallazgo_auditoria_resultado 
          INNER JOIN sgm_elementos 
          ON sgm_hallazgo_auditoria_resultado.id_elemento = sgm_elementos.id
           WHERE sgm_hallazgo_auditoria_resultado.id_hallazgo = '".$id."' ";
          $result_sgme = mysqli_query($con, $sql_sgme);
          $numero_sgme = mysqli_num_rows($result_sgme);
          while($row_sgme = mysqli_fetch_array($result_sgme, MYSQLI_ASSOC)){

            if($row_sgme['resultado'] == 'C'){
              $resultado = 'C= Conforme';
            }else if($row_sgme['resultado'] == 'NC'){
              $resultado = 'NC= No Conforme';
            }else if($row_sgme['resultado'] == 'OM'){
              $resultado = 'OM= Oportunidad de Mejora';
            }

          $contenid0 .= '<tr>
          <td>'.$row_sgme['no'].'</td>
          <td>'.$row_sgme['criterio'].'</td>
          <td class="">'.$row_sgme['resultado'].'</td>
          </tr>';
          }
        
      $contenid0 .= '</tbody>
    </table>';

            $contenid0 .= '<table class="table table-bordered table-sm">
      <tbody>
        <tr>
          <td colspan="4" class="bg-secondary text-white"><b>III. DOCUMENTACIÓN DE LOS HALLAZGOS NO CONFORMES</b></td>
        </tr>
        <tr class="bg-light">
          <td>No.</td>
          <td>DESCRIPCIÓN DEL HALLAZGO</td>
          <td>EVIDENCIA</td>
          <td>CRITERIO</td>
        </tr>';

      $il = 1;
      $sql_dhc = "SELECT * FROM sgm_hallazgo_auditoria_conformes WHERE id_hallazgo = '".$id."' ";
      $result_dhc = mysqli_query($con, $sql_dhc);
      $numero_dhc = mysqli_num_rows($result_dhc);
      if ($numero_dhc > 0) {
      while($row_dhc = mysqli_fetch_array($result_dhc, MYSQLI_ASSOC)){
      $contenid0 .= '<tr>
      <td class="align-middle">'.$il.'</td>
      <td class="align-middle">'.$row_dhc['descripcion'].'</td>
      <td class="align-middle">'.$row_dhc['evidencia'].'</td>
      <td class="align-middle">'.$row_dhc['criterio'].'</td>
      </tr>';

      $il++;
      }
    }else{
      $contenid0 .= "<td colspan='4' class='text-center text-secondary' style='font-size: .8em;'>No se encontró información para mostrar</td>";
    }

   $contenid0 .= '</tbody>      
    </table>';

    $contenid0 .= '<table class="table table-bordered table-sm pb-0 mb-0">
      <tbody>
        <tr>
          <td colspan="2" class="bg-secondary text-white"><b>IV.  OPORTUNIDADES DE MEJORA/OBSERVACIONES</b></td>
        </tr>
        <tr class="bg-light">
          <td>No.</td>
          <td>DESCRIPCIÓN</td>
        </tr>';

      $ilp = 1;
      $sql = "SELECT * FROM sgm_hallazgo_auditoria_mejora WHERE id_hallazgo = '".$id."' ";
      $result = mysqli_query($con, $sql);
      $numero = mysqli_num_rows($result);
      if ($numero > 0) {
      while($row = mysqli_fetch_array($result, MYSQLI_ASSOC)){
      $contenid0 .= '<tr>
      <td class="align-middle">'.$ilp.'</td>
      <td class="align-middle">'.$row['descripcion'].'</td>
      </tr>';

      $ilp++;
      }
    }else{
      $contenid0 .= "<td colspan='2' class='text-center text-secondary' style='font-size: .8em;'>No se encontró información para mostrar</td>";
    }


   $contenid0 .= '</tbody>      
    </table>';

  $contenid0 .= '<table class="table table-bordered table-sm">
      <tbody>
        <tr>
          <td colspan="2" class="bg-secondary text-white"><b>V. COMENTARIOS</b></td>
        </tr>
        <tr><td colspan="2" class="">'.$comentarios.'</td></tr>
        <tr>
          <td colspan="2" class="bg-light">NOTA: EN CASO DE QUE DURANTE LA AUDITORÍA, EL EQUIPO AUDITOR DETECTE UNA SITUACIÓN DE RIESGO PARA LA SEGURIDAD INDUSTRIAL, SEGURIDAD OPERATIVA O PARA EL MEDIO AMBIENTE EN LAS INSTALACIONES DEL REGULADO, DEBERÁ REPORTARLA EN ESTA SECCIÓN.</td>
        </tr>
        <tr><td colspan="2" class="">'.$nota.'</td>
        </tr>
        <tr>
          <td colspan="2" class="bg-light">MOTIVOS DE FINALIZACIÓN DE AUDITORÍA ANTES DE TIEMPO (SI APLICA):</td>
        </tr>
        <tr><td colspan="2" class="">'.$motivos.'</td></tr>
        <tr>
          <td colspan="2" class="bg-secondary text-white"><b>VI.  CONCLUSIONES</b></td>
        </tr>
        <tr><td colspan="2" class="">'.$conclusiones.'</td></tr>
      </tbody>      
    </table>';

    $RutaFirmaAL = RUTA_IMG_FIRMA_PERSONAL.$nom_auditor['firma'];
    $DataFirmaAL = file_get_contents($RutaFirmaAL);
    $baseFirmaAL = 'data:image/;base64,' . base64_encode($DataFirmaAL);

    $RutaFirmaRSGM = RUTA_IMG_FIRMA_PERSONAL.$nom_responsable['firma'];
    $DataFirmaRSGM = file_get_contents($RutaFirmaRSGM);
    $baseFirmaRSGM = 'data:image/;base64,' . base64_encode($DataFirmaRSGM);

    $contenid0 .= '<table class="table table-sm table-bordered">
      <tbody>
        <tr class="bg-light">
          <td colspan="2">LUGAR Y FECHA:</td>
        </tr>
        <tr>
          <td colspan="2" class="">
           '.$lugar_fecha.'
          </td>
        </tr>
        <tr class="bg-light">
        <td class="text-center">AUDITOR LIDER</td>
        <td class="text-center">RESPONSABLE DEL SGM </td>
        </tr>

        <tr>
        <td class="text-center">
        <div><img src="'.$baseFirmaAL.'" style="width: 100px;"></div>
        <b>'.$nom_auditor['nombre'].'</b>
        <div class="mt-2"><small>NOMBRE COMPLETO Y FIRMA</small></div>
        </td>
        <td class="text-center">
        <div><img src="'.$baseFirmaRSGM.'" style="width: 100px;"></div>
        <b>'.$nom_responsable['nombre'].'</b>
        <div class="mt-2"><small>RECIBÍ DE CONFORMIDAD: NOMBRE COMPLETO Y FIRMA</small></div>
        </td>
        </tr>
      </tbody>
    </table>';

//-----------------------------------------------------------------
$contenid0 .= '</div>';

$contenid0 .= '</body>';
$contenid0 .= '</html>';


$dompdf->loadHtml($contenid0);
$dompdf->setPaper("A4", "portrait");
$dompdf->render();
$dompdf->stream('Reporte e Hallazgos de Auditoria.pdf');
//------------------
mysqli_close($con);
//------------------