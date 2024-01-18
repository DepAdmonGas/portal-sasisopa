<?php
require_once 'dompdf/autoload.inc.php';
include_once "app/help.php";

use Dompdf\Dompdf;
$dompdf = new Dompdf();


    $contenid0 .= "<!DOCTYPE html>";
    $contenid0 .= "<html>";
    $contenid0 .= "<head>";
    $contenid0 .= "<title>Identificación y evaluación de Riesgos y Peligros para registrar el análisis.</title>";
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
  padding: 0.1rem;
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
  background-color: #007bff !important;
}

.text-right {
  text-align: right !important;
}

.text-white {
  color: #fff !important;
}

.bg-secondary {
  background-color: #6c757d !important;
}

.table-success,
.table-success > th,
.table-success > td {
  background-color: #c3e6cb;
}
.table-danger,
.table-danger > th,
.table-danger > td {
  background-color: #f5c6cb;
}
.table-secondary,
.table-secondary > th,
.table-secondary > td {
  background-color: #d6d8db;
}
.table-warning,
.table-warning > th,
.table-warning > td {
  background-color: #ffeeba;
}
</style>';

$contenid0 .= '</head>';
$contenid0 .= '<body';


    $RutaLogo = SERVIDOR."imgs/logo/Logo.png";
    $DataLogo = file_get_contents($RutaLogo);
    $baseLogo = 'data:image/;base64,' . base64_encode($DataLogo);

$contenid0 .= '<div>';

$contenid0 .= '<table class="table table-bordered" style="font-size: .9em;">';
$contenid0 .= '<tbody>';
$contenid0 .= '<tr>';

$contenid0 .= '<td class="align-middle text-center">';
$contenid0 .= '<img src="'.$baseLogo.'" style="width: 150px;">';
$contenid0 .= '</td>';
$contenid0 .= '<td colspan="2" class="align-middle text-center">';
$contenid0 .= '<b>Identificación y evaluación de Riesgos y Peligros para registrar el análisis.</b>';
$contenid0 .= '</td>';
$contenid0 .= '<td class="align-middle text-center">';
$contenid0 .= '<b>Fo.ADMONGAS.003</b>';
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
$contenid0 .= 'Fecha de aprobacion:<br>  01-oct-18';
$contenid0 .= '</td>';
$contenid0 .= '</tr>';
            

$contenid0 .= '</tbody>';
$contenid0 .= '</table>';
//-----------------------------------------------------------------

$contenid0 .= '<table class="table table-sm table-bordered text-center" style="font-size: .6em;">
    <tbody>
        <tr>
            <td class="align-middle text-center p-0" rowspan="2"><b>Id</b></td>
            <td class="align-middle text-center" rowspan="2"><b>PROCESO</b></td>
            <td class="align-middle text-center" rowspan="2"><b>TAREA</b></td>
            <td class="align-middle text-center" rowspan="2"><b>PELIGRO</b></td>
            <td class="align-middle text-center" rowspan="2"><b>RIESGO</b></td>
            <td class="align-middle text-center" rowspan="2"><b>CONSECUENCIAS</b></td>
            <td class="align-middle text-center" colspan="5"><b>PROBABILIDAD</b></td>
            <td class="align-middle text-center" rowspan="2"><b>ÍNDICE<br>DE<br>SEVERIDAD</b></td>
            <td class="align-middle text-center" rowspan="2"><b>RIE<br>SGO</b></td>
            <td class="align-middle text-center" rowspan="2"><b>T<br>I<br>P<br>O</b></td>
            <td class="align-middle text-center" rowspan="2"><b>¿Riesgo<br>Signif<br>icativo?</b></td>
        </tr>
        <tr>
            <td class="align-middle text-center"><b>Índice de personas expuestas (A)</b></td>
            <td class="align-middle text-center"><b>Índice de procedimientos existentes (B)</b></td>
            <td class="align-middle text-center"><b>Índice de capacitación (C)</b></td>
            <td class="align-middle text-center"><b>Índice de exposición al riesgo (D)</b></td>
            <td class="align-middle text-center"><b>PROBAB<br>ILIDAD</b></td></td>
        </tr>
        <tr>
            <td class="align-middle text-center">1</td>
            <td class="align-middle text-center">Despacho de combustible</td>
            <td class="align-middle text-center">Colocación de la manguera en el vehÍculo</td>
            <td class="align-middle text-center">Mala colocación de la manguera</td>
            <td class="align-middle text-center">Desprendimiento de la manguera</td>
            <td class="align-middle text-center">Derrame de combustible y posible incendio en caso de una fuente de ignición</td>
            <td class="align-middle text-center">1</td>
            <td class="align-middle text-center">1</td>
            <td class="align-middle text-center">1</td>
            <td class="align-middle text-center">3</td>
            <td class="align-middle text-center table-warning">6</td>
            <td class="align-middle text-center">1</td>
            <td class="align-middle text-center table-warning font-weight-bold">6</td>
            <td class="align-middle text-center table-secondary">Tolerable</td>
            <td class="align-middle text-center table-success">NO</td>
        </tr>
        <tr>
            <td class="align-middle text-center">2</td>
            <td class="align-middle text-center">Despacho de combustible</td>
            <td class="align-middle text-center">Colocación de la manguera en el vehÍculo</td>
            <td class="align-middle text-center">Movimiento del vehÍculo</td>
            <td class="align-middle text-center">Desprendimiento de la manguera</td>
            <td class="align-middle text-center">Derrame de combustible y posible incendio en caso de una fuente de ignición</td>
            <td class="align-middle text-center">1</td>
            <td class="align-middle text-center">1</td>
            <td class="align-middle text-center">1</td>
            <td class="align-middle text-center">3</td>
            <td class="align-middle text-center table-warning">6</td>
            <td class="align-middle text-center">2</td>
            <td class="align-middle text-center table-warning font-weight-bold">12</td>
            <td class="align-middle text-center table-secondary">Moderado</td>
            <td class="align-middle text-center table-danger">SI</td>
        </tr>
        <tr>
            <td class="align-middle text-center">3</td>
            <td class="align-middle text-center">Despacho de combustible</td>
            <td class="align-middle text-center">Despacho de combustible</td>
            <td class="align-middle text-center">Condiciones climáticas</td>
            <td class="align-middle text-center">Exposición prolongada</td>
            <td class="align-middle text-center">Daños a la salud</td>
            <td class="align-middle text-center">1</td>
            <td class="align-middle text-center">2</td>
            <td class="align-middle text-center">2</td>
            <td class="align-middle text-center">3</td>
            <td class="align-middle text-center table-warning">8</td>
            <td class="align-middle text-center">1</td>
            <td class="align-middle text-center table-warning font-weight-bold">8</td>
            <td class="align-middle text-center table-secondary">Tolerable</td>
            <td class="align-middle text-center table-success">NO</td>
        </tr>
        <tr>
            <td class="align-middle text-center" >4</td>
            <td class="align-middle text-center">Despacho de combustible</td>
            <td class="align-middle text-center">Colocación de la manguera en el vehÍculo</td>
            <td class="align-middle text-center">Movimiento del vehÍculo</td>
            <td class="align-middle text-center">Colisión con otro vehÍculo</td>
            <td class="align-middle text-center">Lesiones a personas</td>
            <td class="align-middle text-center">1</td>
            <td class="align-middle text-center">2</td>
            <td class="align-middle text-center">1</td>
            <td class="align-middle text-center">1</td>
            <td class="align-middle text-center table-warning">5</td>
            <td class="align-middle text-center">2</td>
            <td class="align-middle text-center table-warning font-weight-bold">10</td>
            <td class="align-middle text-center table-secondary">Moderado</td>
            <td class="align-middle text-center table-danger">SI</td>
        </tr>
        <tr>
            <td class="align-middle text-center">5</td>
            <td class="align-middle text-center">Despacho de combustible</td>
            <td class="align-middle text-center">Despacho a bidones</td>
            <td class="align-middle text-center">Sobrellenado del bidón</td>
            <td class="align-middle text-center">Derrame de combustible</td>
            <td class="align-middle text-center">Incendio en el área</td>
            <td class="align-middle text-center">1</td>
            <td class="align-middle text-center">3</td>
            <td class="align-middle text-center">2</td>
            <td class="align-middle text-center">2</td>
            <td class="align-middle text-center table-warning">8</td>
            <td class="align-middle text-center">2</td>
            <td class="align-middle text-center table-warning font-weight-bold">16</td>
            <td class="align-middle text-center table-secondary">Moderado</td>
            <td class="align-middle text-center table-danger">SI</td>
        </tr>
        <tr>
            <td class="align-middle text-center" >6</td>
            <td class="align-middle text-center">Despacho de combustible</td>
            <td class="align-middle text-center">Colocación de la manguera en el vehÍculo</td>
            <td class="align-middle text-center">Movimiento del vehÍculo</td>
            <td class="align-middle text-center">Atropellamiento de una persona</td>
            <td class="align-middle text-center">Lesiones a personas</td>
            <td class="align-middle text-center">1</td>
            <td class="align-middle text-center">2</td>
            <td class="align-middle text-center">1</td>
            <td class="align-middle text-center">3</td>
            <td class="align-middle text-center table-warning">7</td>
            <td class="align-middle text-center">2</td>
            <td class="align-middle text-center table-warning font-weight-bold">14</td>
            <td class="align-middle text-center table-secondary">Moderado</td>
            <td class="align-middle text-center table-danger">SI</td>
        </tr>
        <tr>
            <td class="align-middle text-center" >7</td>
            <td class="align-middle text-center">Despacho de combustible</td>
            <td class="align-middle text-center">Colocación de la manguera en el vehÍculo</td>
            <td class="align-middle text-center">Movimiento del vehÍculo</td>
            <td class="align-middle text-center">Colisión con las instalaciones</td>
            <td class="align-middle text-center">Incidentes materiales</td>
            <td class="align-middle text-center">1</td>
            <td class="align-middle text-center">2</td>
            <td class="align-middle text-center">1</td>
            <td class="align-middle text-center">1</td>
            <td class="align-middle text-center table-warning">5</td>
            <td class="align-middle text-center">1</td>
            <td class="align-middle text-center table-warning font-weight-bold">5</td>
            <td class="align-middle text-center table-secondary">Tolerable</td>
            <td class="align-middle text-center table-success">NO</td>
        </tr>
        <tr>
            <td class="align-middle text-center">8</td>
            <td class="align-middle text-center">Despacho de combustible</td>
            <td class="align-middle text-center">Colocación de la manguera en el vehÍculo</td>
            <td class="align-middle text-center">Equipos en mal estado (mangueras, pistola de suministro, conexiones, sistema de recuperación de gases etc.)</td>
            <td class="align-middle text-center">Fuga de combustible</td>
            <td class="align-middle text-center">Derrame de combustible y posible incendio en caso de una fuente de ignición</td>
            <td class="align-middle text-center">1</td>
            <td class="align-middle text-center">1</td>
            <td class="align-middle text-center">1</td>
            <td class="align-middle text-center">1</td>
            <td class="align-middle text-center table-warning">4</td>
            <td class="align-middle text-center">2</td>
            <td class="align-middle text-center table-warning font-weight-bold">8</td>
            <td class="align-middle text-center table-secondary">Tolerable</td>
            <td class="align-middle text-center table-success">NO</td>
        </tr>
        <tr>
            <td class="align-middle text-center" >9</td>
            <td class="align-middle text-center">Despacho de combustible</td>
            <td class="align-middle text-center">Colocación de la manguera en el vehÍculo</td>
            <td class="align-middle text-center">Equipos de suministro en mal estado</td>
            <td class="align-middle text-center">Contacto con combustibles o sustancias quÍmicas</td>
            <td class="align-middle text-center">Daños a la salud</td>
            <td class="align-middle text-center">1</td>
            <td class="align-middle text-center">1</td>
            <td class="align-middle text-center">1</td>
            <td class="align-middle text-center">1</td>
            <td class="align-middle text-center table-warning">4</td>
            <td class="align-middle text-center">1</td>
            <td class="align-middle text-center table-warning font-weight-bold">4</td>
            <td class="align-middle text-center table-secondary">Trivial</td>
            <td class="align-middle text-center table-success">NO</td>
        </tr>
        <tr>
            <td class="align-middle text-center" >10</td>
            <td class="align-middle text-center">Despacho de combustible</td>
            <td class="align-middle text-center">Colocación de la manguera en el vehÍculo</td>
            <td class="align-middle text-center">vehÍculos de gran tonelaje</td>
            <td class="align-middle text-center">Exposición al ruido</td>
            <td class="align-middle text-center">Daños a la salud</td>
            <td class="align-middle text-center">1</td>
            <td class="align-middle text-center">3</td>
            <td class="align-middle text-center">2</td>
            <td class="align-middle text-center">2</td>
            <td class="align-middle text-center table-warning">8</td>
            <td class="align-middle text-center">1</td>
            <td class="align-middle text-center table-warning font-weight-bold">8</td>
            <td class="align-middle text-center table-secondary">Tolerable</td>
            <td class="align-middle text-center table-success">NO</td>
        </tr>
        <tr>
            <td class="align-middle text-center" >11</td>
            <td class="align-middle text-center">Descarga del auto tanque</td>
            <td class="align-middle text-center">Conexión de manguera al tanque fijo</td>
            <td class="align-middle text-center">Mala colocación de la manguera</td>
            <td class="align-middle text-center">Desprendimiento de la manguera</td>
            <td class="align-middle text-center">Derrame mayor de combustible</td>
            <td class="align-middle text-center">1</td>
            <td class="align-middle text-center">1</td>
            <td class="align-middle text-center">1</td>
            <td class="align-middle text-center">2</td>
            <td class="align-middle text-center table-warning">5</td>
            <td class="align-middle text-center">3</td>
            <td class="align-middle text-center table-warning font-weight-bold">15</td>
            <td class="align-middle text-center table-secondary">Moderado</td>
            <td class="align-middle text-center table-danger">SI</td>
        </tr>
        <tr>
            <td class="align-middle text-center">12</td>
            <td class="align-middle text-center">Mantenimiento de instalaciones</td>
            <td class="align-middle text-center">Limpieza en drenajes, registros y trampa de combustibles</td>
            <td class="align-middle text-center">Acumulación de combustibles</td>
            <td class="align-middle text-center">Contacto con combustibles o sustancias quÍmicas</td>
            <td class="align-middle text-center">Daños a la salud</td>
            <td class="align-middle text-center">1</td>
            <td class="align-middle text-center">1</td>
            <td class="align-middle text-center">1</td>
            <td class="align-middle text-center">2</td>
            <td class="align-middle text-center table-warning">5</td>
            <td class="align-middle text-center">1</td>
            <td class="align-middle text-center table-warning font-weight-bold">5</td>
            <td class="align-middle text-center table-secondary">Tolerable</td>
            <td class="align-middle text-center table-success">NO</td>
        </tr>
        <tr>
            <td class="align-middle text-center" >13</td>
            <td class="align-middle text-center">Mantenimiento de instalaciones</td>
            <td class="align-middle text-center">Prueba de hermeticidad a tanques y tuberÍas</td>
            <td class="align-middle text-center">Falta de purgado de tanques</td>
            <td class="align-middle text-center">Acumulación de vapores</td>
            <td class="align-middle text-center">posible incendio en caso de una fuente de ignición</td>
            <td class="align-middle text-center">1</td>
            <td class="align-middle text-center">1</td>
            <td class="align-middle text-center">1</td>
            <td class="align-middle text-center">1</td>
            <td class="align-middle text-center table-warning">4</td>
            <td class="align-middle text-center">2</td>
            <td class="align-middle text-center table-warning font-weight-bold">8</td>
            <td class="align-middle text-center table-secondary">Tolerable</td>
            <td class="align-middle text-center table-success">NO</td>
        </tr>
        <tr>
            <td class="align-middle text-center">14</td>
            <td class="align-middle text-center">Mantenimiento de instalaciones</td>
            <td class="align-middle text-center">Revisar la calibración de medidores mediante la jarra patrón</td>
            <td class="align-middle text-center">Derrame de combustible</td>
            <td class="align-middle text-center">Contacto con combustibles o sustancias quÍmicas</td>
            <td class="align-middle text-center">Daños a la salud</td>
            <td class="align-middle text-center">1</td>
            <td class="align-middle text-center">1</td>
            <td class="align-middle text-center">1</td>
            <td class="align-middle text-center">2</td>
            <td class="align-middle text-center table-warning">5</td>
            <td class="align-middle text-center">1</td>
            <td class="align-middle text-center table-warning font-weight-bold">5</td>
            <td class="align-middle text-center table-secondary">Tolerable</td>
            <td class="align-middle text-center table-success">NO</td>
        </tr>
        <tr>
            <td class="align-middle text-center">15</td>
            <td class="align-middle text-center">Mantenimiento de instalaciones</td>
            <td class="align-middle text-center">Pintar la fachada</td>
            <td class="align-middle text-center">Mala colocación de barandillas, barras intermedias y plintos</td>
            <td class="align-middle text-center">CaÍda</td>
            <td class="align-middle text-center">Lesiones a personas</td>
            <td class="align-middle text-center">1</td>
            <td class="align-middle text-center">1</td>
            <td class="align-middle text-center">1</td>
            <td class="align-middle text-center">1</td>
            <td class="align-middle text-center table-warning">4</td>
            <td class="align-middle text-center">2</td>
            <td class="align-middle text-center table-warning font-weight-bold">8</td>
            <td class="align-middle text-center table-secondary">Tolerable</td>
            <td class="align-middle text-center table-success">NO</td>
        </tr>
        <tr>
            <td class="align-middle text-center">16</td>
            <td class="align-middle text-center">Mantenimiento de instalaciones</td>
            <td class="align-middle text-center">Cambio de lámparas o focos</td>
            <td class="align-middle text-center">Mala colocación de la escalera</td>
            <td class="align-middle text-center">CaÍda</td>
            <td class="align-middle text-center">Lesiones a personas</td>
            <td class="align-middle text-center">1</td>
            <td class="align-middle text-center">1</td>
            <td class="align-middle text-center">1</td>
            <td class="align-middle text-center">1</td>
            <td class="align-middle text-center table-warning">4</td>
            <td class="align-middle text-center">2</td>
            <td class="align-middle text-center table-warning font-weight-bold">8</td>
            <td class="align-middle text-center table-secondary">Tolerable</td>
            <td class="align-middle text-center table-success">NO</td>
        </tr>
        <tr>
            <td class="align-middle text-center" >17</td>
            <td class="align-middle text-center">Mantenimiento de instalaciones</td>
            <td class="align-middle text-center">Revisión de instalaciones eléctricas</td>
            <td class="align-middle text-center">Falta de des energización de equipos</td>
            <td class="align-middle text-center">Generación de carga electricidad estática</td>
            <td class="align-middle text-center">Lesiones a personas</td>
            <td class="align-middle text-center">1</td>
            <td class="align-middle text-center">1</td>
            <td class="align-middle text-center">1</td>
            <td class="align-middle text-center">2</td>
            <td class="align-middle text-center table-warning">5</td>
            <td class="align-middle text-center">1</td>
            <td class="align-middle text-center table-warning font-weight-bold">5</td>
            <td class="align-middle text-center table-secondary">Tolerable</td>
            <td class="align-middle text-center table-success">NO</td>
        </tr>
        <tr>
            <td class="align-middle text-center">18</td>
            <td class="align-middle text-center">Mantenimiento de instalaciones</td>
            <td class="align-middle text-center">Pintado delimitación de áreas de despacho, patios, oficinas</td>
            <td class="align-middle text-center">Falta de acordonamiento del área</td>
            <td class="align-middle text-center">Atropellamiento de una persona</td>
            <td class="align-middle text-center">Lesiones a personas</td>
            <td class="align-middle text-center">1</td>
            <td class="align-middle text-center">2</td>
            <td class="align-middle text-center">1</td>
            <td class="align-middle text-center">1</td>
            <td class="align-middle text-center table-warning">5</td>
            <td class="align-middle text-center">2</td>
            <td class="align-middle text-center table-warning font-weight-bold">10</td>
            <td class="align-middle text-center table-secondary">Moderado</td>
            <td class="align-middle text-center table-danger">SI</td>
        </tr>
        <tr>
            <td class="align-middle text-center">19</td>
            <td class="align-middle text-center">Mantenimiento de instalaciones</td>
            <td class="align-middle text-center">Colocación de publicidad</td>
            <td class="align-middle text-center">Escalera mal colocada</td>
            <td class="align-middle text-center">CaÍda</td>
            <td class="align-middle text-center">Lesiones a personas</td>
            <td class="align-middle text-center">1</td>
            <td class="align-middle text-center">2</td>
            <td class="align-middle text-center">1</td>
            <td class="align-middle text-center">2</td>
            <td class="align-middle text-center table-warning">6</td>
            <td class="align-middle text-center">1</td>
            <td class="align-middle text-center table-warning font-weight-bold">6</td>
            <td class="align-middle text-center table-secondary">Tolerable</td>
            <td class="align-middle text-center table-success">NO</td>
        </tr>
        <tr>
            <td class="align-middle text-center">20</td>
            <td class="align-middle text-center">Limpieza</td>
            <td class="align-middle text-center">Limpieza y orden en el lugar de trabajo</td>
            <td class="align-middle text-center">Suelo mojado</td>
            <td class="align-middle text-center">CaÍdas, resbalones</td>
            <td class="align-middle text-center">Lesiones a personas</td>
            <td class="align-middle text-center">1</td>
            <td class="align-middle text-center">1</td>
            <td class="align-middle text-center">1</td>
            <td class="align-middle text-center">3</td>
            <td class="align-middle text-center table-warning">6</td>
            <td class="align-middle text-center">1</td>
            <td class="align-middle text-center table-warning font-weight-bold">6</td>
            <td class="align-middle text-center table-secondary">Tolerable</td>
            <td class="align-middle text-center table-success">NO</td>
        </tr>
        <tr>
            <td class="align-middle text-center">21</td>
            <td class="align-middle text-center">Limpieza</td>
            <td class="align-middle text-center">Limpieza y orden en el lugar de trabajo</td>
            <td class="align-middle text-center">Acumulación en suelo de vertidos de aceites, carburantes, lÍquidos de frenos y similares</td>
            <td class="align-middle text-center">CaÍdas, tropiezos</td>
            <td class="align-middle text-center">Lesiones a personas</td>
            <td class="align-middle text-center">1</td>
            <td class="align-middle text-center">1</td>
            <td class="align-middle text-center">1</td>
            <td class="align-middle text-center">3</td>
            <td class="align-middle text-center table-warning">6</td>
            <td class="align-middle text-center">1</td>
            <td class="align-middle text-center table-warning font-weight-bold">6</td>
            <td class="align-middle text-center table-secondary">Tolerable</td>
            <td class="align-middle text-center table-success">NO</td>
        </tr>
        <tr>
            <td class="align-middle text-center" >22</td>
            <td class="align-middle text-center">Limpieza</td>
            <td class="align-middle text-center">Limpieza y orden en el lugar de trabajo</td>
            <td class="align-middle text-center">Obstáculos, objetos abandonados o mal situados</td>
            <td class="align-middle text-center">CaÍdas, tropiezos</td>
            <td class="align-middle text-center">Lesiones a personas</td>
            <td class="align-middle text-center">1</td>
            <td class="align-middle text-center">1</td>
            <td class="align-middle text-center">1</td>
            <td class="align-middle text-center">3</td>
            <td class="align-middle text-center table-warning">6</td>
            <td class="align-middle text-center">1</td>
            <td class="align-middle text-center table-warning font-weight-bold">6</td>
            <td class="align-middle text-center table-secondary">Tolerable</td>
            <td class="align-middle text-center table-success">NO</td>
        </tr>
        <tr>
            <td class="align-middle text-center">23</td>
            <td class="align-middle text-center">Limpieza</td>
            <td class="align-middle text-center">Medición del volumen de los tanques de almacenamiento</td>
            <td class="align-middle text-center">Presencia de vapores de combustibles</td>
            <td class="align-middle text-center">Contacto con vapores de combustibles</td>
            <td class="align-middle text-center">Intoxicación</td>
            <td class="align-middle text-center">1</td>
            <td class="align-middle text-center">1</td>
            <td class="align-middle text-center">1</td>
            <td class="align-middle text-center">2</td>
            <td class="align-middle text-center table-warning">5</td>
            <td class="align-middle text-center">1</td>
            <td class="align-middle text-center table-warning font-weight-bold">5</td>
            <td class="align-middle text-center table-secondary">Tolerable</td>
            <td class="align-middle text-center table-success">NO</td>
        </tr>
        <tr>
            <td class="align-middle text-center" >24</td>
            <td class="align-middle text-center">Limpieza</td>
            <td class="align-middle text-center">Limpieza de tanques de almacenamiento</td>
            <td class="align-middle text-center">Presencia de combustibles en el tanque</td>
            <td class="align-middle text-center">Contacto con vapores de combustibles</td>
            <td class="align-middle text-center">Intoxicación</td>
            <td class="align-middle text-center">1</td>
            <td class="align-middle text-center">1</td>
            <td class="align-middle text-center">1</td>
            <td class="align-middle text-center">2</td>
            <td class="align-middle text-center table-warning">5</td>
            <td class="align-middle text-center">1</td>
            <td class="align-middle text-center table-warning font-weight-bold">5</td>
            <td class="align-middle text-center table-secondary">Tolerable</td>
            <td class="align-middle text-center table-success">NO</td>
        </tr>
    </tbody>
</table>';

//-----------------------------------------------------------------
$contenid0 .= '</div>';

$contenid0 .= '</body>';
$contenid0 .= '</html>';


$dompdf->loadHtml($contenid0);
// Colocamos als propiedades de la hoja
$dompdf->setPaper("A4", "landscape");
// Escribimos el html en el PDF
$dompdf->render();
$dompdf->get_canvas()->page_text(775, 570, "Pagina: {PAGE_NUM} de {PAGE_COUNT}", $font, 8, array(0,0,0));
// Ponemos el PDF en el browser
$dompdf->stream('Identificación y evaluación de Riesgos y Peligros para registrar el análisis..pdf',["Attachment" => true]);
//------------------
mysqli_close($con);
//------------------