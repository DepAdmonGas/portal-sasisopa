<?php
include_once "app/help.php";
require_once 'dompdf/autoload.inc.php';

$sql = "SELECT * FROM tb_lista_asistencia WHERE id = '".$GET_idRegistro."' ";
$result = mysqli_query($con, $sql);
$numero = mysqli_num_rows($result);
$row = mysqli_fetch_array($result, MYSQLI_ASSOC);
$fecha = $row['fecha'];
$hora = $row['hora'];
$lugar = $row['lugar'];
$tema = $row['tema'];
$finalidad = $row['finalidad'];
$encargado = $row['encargado'];
$realizadopor = realizadoPor($row['realizadopor'],$con);

function realizadoPor($usuario,$con){
  $sql = "SELECT nombre FROM tb_usuarios WHERE id = '".$usuario."' ";
  $result = mysqli_query($con, $sql);
  $numero = mysqli_num_rows($result);
  $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
  $Nombre = $row['nombre'];
  return $Nombre;
  }

  function BuscarFirma($usuario,$idEstacion,$con){

    $sql = "SELECT nombre, firma FROM tb_usuarios WHERE id_gas = '".$idEstacion."' ";
    $result = mysqli_query($con, $sql);
    $numero = mysqli_num_rows($result);
    while($row = mysqli_fetch_array($result, MYSQLI_ASSOC)){ 
    $Nombre = $row['nombre'];
  
    if(strcasecmp($usuario, $Nombre) === 0){
    $Firma =  $row['firma'];
    }
    }
    return $Firma;
    }

    $sql_comunicado = "SELECT * FROM se_comunicacion_i_e WHERE asistencia = '".$GET_idRegistro."'";
    $result_comunicado = mysqli_query($con, $sql_comunicado);
    $numero_comunicado = mysqli_num_rows($result_comunicado);
    if($numero_comunicado == 1){
    $row_comunicado = mysqli_fetch_array($result_comunicado, MYSQLI_ASSOC);
    $tipocomunicacion = $row_comunicado['tipo_comunicacion'];
    $material = $row_comunicado['material'];
    }else{
    $tipocomunicacion = "";
    $material = "";
    }

    $sql_lista = "SELECT * FROM tb_lista_asistencia_detalle WHERE id_lista_asistencia = '".$GET_idRegistro."' ";
    $result_lista = mysqli_query($con, $sql_lista);
    $numero_lista = mysqli_num_rows($result_lista);

use Dompdf\Dompdf;
$dompdf = new Dompdf();

    $contenid0 = "";
    $contenid0 .= "<!DOCTYPE html>";
    $contenid0 .= "<html>";
    $contenid0 .= "<head>";
    $contenid0 .= "<title>Comunicación interna</title>";
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
  font-size: .9rem;
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

.p-1 {
  padding: .5rem !important;
}
.mt-5{
  margin-top: 3rem !important;
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
      $contenid0 .= '<b>Lista de Asistencia</b>';
      $contenid0 .= '</td>';
      $contenid0 .= '<td class="align-middle text-center">';
      $contenid0 .= '<b>Fecha de autorización: 01-01-2024</b>';
      $contenid0 .= '</td>';
      $contenid0 .= '</tr>';
      //------------------------------------------------------------------
      $contenid0 .= '<tr>';
      $contenid0 .= '<td class="align-middle text-center">';
      $contenid0 .= 'Fo.SGM.001';
      $contenid0 .= '</td>';
      $contenid0 .= '</tr>';
      //------------------------------------------------------------------
      $contenid0 .= '<tr>';
      $contenid0 .= '<td class="align-middle text-center">';
      $contenid0 .= 'Realizado por: '.$realizadopor;
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

      $contenid0 .= '<table class="table table-bordered">';
      $contenid0 .= '<tbody>';

      $contenid0 .= '<tr>';
      $contenid0 .= '<td class="align-middle text-center">';
      $contenid0 .= 'Fecha: '.FormatoFecha($fecha);
      $contenid0 .= '</td>';
      $contenid0 .= '<td class="align-middle text-center">';
      $contenid0 .= 'Hora: '.date('g:i a', strtotime($hora));
      $contenid0 .= '</td>';
      $contenid0 .= '<td class="align-middle text-center">';
      $contenid0 .= 'Lugar: '.$lugar;
      $contenid0 .= '</td>';
      $contenid0 .= '</tr>';

      $contenid0 .= '<tr>';
      $contenid0 .= '<td class="align-middle" colspan="3">';
      $contenid0 .= '<b>Responsable de la comunicación:</b> '.$encargado;
      $contenid0 .= '</td>';
      $contenid0 .= '</tr>';

      $contenid0 .= '<tr>';
      $contenid0 .= '<td class="align-middle" colspan="3">';
      $contenid0 .= '<b>Tema a comunicar:</b> '.$tema;
      $contenid0 .= '</td>';
      $contenid0 .= '</tr>';

      $contenid0 .= '<tr>';
      $contenid0 .= '<td class="align-middle" colspan="3">';
      $contenid0 .= '<b>Finalidad de la comunicación:</b> '.$finalidad;
      $contenid0 .= '</td>';
      $contenid0 .= '</tr>';

      $contenid0 .= '<tr>';
      $contenid0 .= '<td class="align-middle" colspan="3">';
      $contenid0 .= '<b>Material utilizado para la comunicación:</b> '.$material;
      $contenid0 .= '</td>';
      $contenid0 .= '</tr>';

      $contenid0 .= '</tbody>';
      $contenid0 .= '</table>';

      $contenid0 .= '<table class="table table-bordered">';
      $contenid0 .= '<tbody>';
      $contenid0 .= '<tr>';
      $contenid0 .= '<td class="align-middle text-center"><b>Nombre</b></td> <td class="align-middle text-center"><b>Puesto</b></td> <td class="align-middle text-center"><b>Firma</b></td>';
      $contenid0 .= '</tr>';
      while($row_lista = mysqli_fetch_array($result_lista, MYSQLI_ASSOC)){

        $Firma = BuscarFirma($row_lista['usuario'],$Session_IDEstacion,$con);
        
        $RutaFirma = RUTA_IMG_FIRMA_PERSONAL.$Firma;
        $DataFirma = file_get_contents($RutaFirma);
        $baseFirma = 'data:image/;base64,' . base64_encode($DataFirma);

      $contenid0 .= '<tr>';
      $contenid0 .= '<td class="align-middle text-center">';
      $contenid0 .= $row_lista['usuario'];
      $contenid0 .= '</td>';

      $contenid0 .= '<td class="align-middle text-center">';
      $contenid0 .= $row_lista['puesto'];
      $contenid0 .= '</td>';

      $contenid0 .= '<td class="align-middle text-center">';
      $contenid0 .= '<img src="'.$baseFirma.'" style="width: 50px;">';
      $contenid0 .= '</td>';
      $contenid0 .= '</tr>';

      }
      $contenid0 .= '</tbody>';
      $contenid0 .= '</table>';

      $contenid0 .= '<div class=" text-center p-3"><b>Evidencia</b></div>';

      $sql = "SELECT * FROM tb_lista_asistencia_evidencia WHERE id_lista_asistencia = '".$GET_idRegistro."' ";
      $result = mysqli_query($con, $sql);
      $numero = mysqli_num_rows($result);
      while($row = mysqli_fetch_array($result, MYSQLI_ASSOC)){

        
        $RutaFirma = RUTA_ARCHIVOS.'evidencias/'.$row['evidencia'];
        $DataFirma = file_get_contents($RutaFirma);
        $baseFirma = 'data:image/;base64,' . base64_encode($DataFirma);

      $contenid0 .= '<img class="p-1 mt-5" src="'.$baseFirma.'" style="width: 340px;">';


      }

//-----------------------------------------------------------------
$contenid0 .= '</div>';
$contenid0 .= '</body>';
$contenid0 .= '</html>';

$dompdf->loadHtml($contenid0);
$dompdf->setPaper("A4", "portrait");
$dompdf->render();
$canvas = $dompdf->get_canvas();
$canvas->page_text(525, 810, "Página: {PAGE_NUM} de {PAGE_COUNT}", null, 7, array(0, 0, 0));
$dompdf->stream('Comunicación interna.pdf');
//------------------
mysqli_close($con);
//------------------