<?php
require_once 'dompdf/autoload.inc.php';
include_once "app/help.php";

use Dompdf\Dompdf;
$dompdf = new Dompdf();


    $contenid0 .= "<!DOCTYPE html>";
    $contenid0 .= "<html>";
    $contenid0 .= "<head>";
    $contenid0 .= "<title>Identificación y evaluación de Aspectos e Impactos Ambientales.</title>";
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
$contenid0 .= '<b>Identificación y evaluación de Aspectos e Impactos Ambientales.</b>';
$contenid0 .= '</td>';
$contenid0 .= '<td class="align-middle text-center">';
$contenid0 .= '<b>Fo.ADMONGAS.002</b>';
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

$contenid0 .= '<table class="table table-sm table-bordered text-center" style="font-size: .7em;">
    <tbody>
      <thead>
        <tr>
            <th colspan="10" class="align-middle text-center table-success">ETAPA: OPERACIÓN Y MANTENIMIENTO</th>
        </tr>
        <tr>
            <th class="align-middle">Id</th>
            <th class="align-middle">Proceso o Actividad</th>
            <th class="align-middle">Tipo</th>
            <th class="align-middle">Entradas</th>
            <th class="align-middle">Salidas</th>
            <th class="align-middle">Impacto ambiental</th>
            <th class="align-middle">Naturaleza</th>
            <th class="align-middle">Importancia</th>
            <th class="align-middle">Magnitud</th>
            <th class="align-middle">Resultado</th>
        </tr>
        </thead>
  
        <tr>
            <td class="align-middle">1</td>
            <td class="align-middle">Despacho de combustible al público</td>
            <td class="align-middle">Rutinaria</td>
            <td class="align-middle">Combustible</td>
            <td class="align-middle">Emisiones fugitivas de VOC´s</td>
            <td class="align-middle">Aire</td>
            <td class="align-middle">-1</td>
            <td class="align-middle">2</td>
            <td class="align-middle">9</td>
            <td class="align-middle">-18</td>
        </tr>
        <tr>
            <td class="align-middle">2</td>
            <td class="align-middle">Despacho de combustible al público</td>
            <td class="align-middle">Rutinaria</td>
            <td class="align-middle">Energía</td>
            <td class="align-middle">Ruido</td>
            <td class="align-middle">Aire</td>
            <td class="align-middle">-1</td>
            <td class="align-middle">1</td>
            <td class="align-middle">2</td>
            <td class="align-middle">-2</td>
        </tr>
        <tr>
            <td class="align-middle">3</td>
            <td class="align-middle">Despacho de combustible al público</td>
            <td class="align-middle">Rutinaria</td>
            <td class="align-middle">Energía</td>
            <td class="align-middle">Vibraciones</td>
            <td class="align-middle">Salud</td>
            <td class="align-middle">-1</td>
            <td class="align-middle">2</td>
            <td class="align-middle">1</td>
            <td class="align-middle">-2</td>
        </tr>
        <tr>
            <td class="align-middle">4</td>
            <td class="align-middle">Despacho de combustible al público</td>
            <td class="align-middle">Rutinaria</td>
            <td class="align-middle">Sustancias químicas (anticongelante, lubricantes)</td>
            <td class="align-middle">Derrames por gote </td>
            <td class="align-middle">suelo</td>
            <td class="align-middle">-1</td>
            <td class="align-middle">3</td>
            <td class="align-middle">2</td>
            <td class="align-middle">-6</td>
        </tr>
        <tr>
            <td class="align-middle">5</td>
            <td class="align-middle">Despacho de combustible al público</td>
            <td class="align-middle">Rutinaria</td>
            <td class="align-middle">Combustibl </td>
            <td class="align-middle">Derrames por goteo</td>
            <td class="align-middle">Suelo y Aire</td>
            <td class="align-middle">-1</td>
            <td class="align-middle">4</td>
            <td class="align-middle">3</td>
            <td class="align-middle">-12</td>
        </tr>
        <tr>
            <td class="align-middle">6</td>
            <td class="align-middle">Despacho de combustible al público</td>
            <td class="align-middle">Rutinaria</td>
            <td class="align-middle">Papel y otros</td>
            <td class="align-middle">Residuos no peligrosos</td>
            <td class="align-middle">Suelo</td>
            <td class="align-middle">-1</td>
            <td class="align-middle">2</td>
            <td class="align-middle">2</td>
            <td class="align-middle">-4</td>
        </tr>
        <tr>
            <td class="align-middle">7</td>
            <td class="align-middle">Despacho de combustible al público</td>
            <td class="align-middle">Rutinaria</td>
            <td class="align-middle">Trapo</td>
            <td class="align-middle">Residuos peligrosos</td>
            <td class="align-middle">Suelo</td>
            <td class="align-middle">-1</td>
            <td class="align-middle">4</td>
            <td class="align-middle">4</td>
            <td class="align-middle">-16</td>
        </tr>
        <tr>
            <td class="align-middle">8</td>
            <td class="align-middle">Despacho de combustible al público</td>
            <td class="align-middle">Rutinaria</td>
            <td class="align-middle">Agua</td>
            <td class="align-middle">Agua residual (Lavado parabrisas-servicio)</td>
            <td class="align-middle">Agua</td>
            <td class="align-middle">-1</td>
            <td class="align-middle">4</td>
            <td class="align-middle">2</td>
            <td class="align-middle">-8</td>
        </tr>
        <tr>
            <td class="align-middle">9</td>
            <td class="align-middle">Despacho de combustible al público</td>
            <td class="align-middle">Emergencia</td>
            <td class="align-middle">Combustible</td>
            <td class="align-middle">Derrames al suelo - fuga</td>
            <td class="align-middle">Suelo y Aire</td>
            <td class="align-middle">-1</td>
            <td class="align-middle">6</td>
            <td class="align-middle">6</td>
            <td class="align-middle">-36</td>
        </tr>
        <tr>
            <td class="align-middle">10</td>
            <td class="align-middle">Descarga de combustible a tanques de almacenamiento</td>
            <td class="align-middle">No rutinaria</td>
            <td class="align-middle">Combustible</td>
            <td class="align-middle">Emisiones fugitivas de VOC´s</td>
            <td class="align-middle">Aire</td>
            <td class="align-middle">-1</td>
            <td class="align-middle">5</td>
            <td class="align-middle">5</td>
            <td class="align-middle">-25</td>
        </tr>
        <tr>
            <td class="align-middle">11</td>
            <td class="align-middle">Descarga de combustible a tanques de almacenamiento</td>
            <td class="align-middle">No rutinaria</td>
            <td class="align-middle">Trapos</td>
            <td class="align-middle">Residuos peligrosos</td>
            <td class="align-middle">Suelo</td>
            <td class="align-middle">-1</td>
            <td class="align-middle">4</td>
            <td class="align-middle">4</td>
            <td class="align-middle">-16</td>
        </tr>
        <tr>
            <td class="align-middle">12</td>
            <td class="align-middle">Descarga de combustible a tanques de almacenamiento</td>
            <td class="align-middle">No rutinaria</td>
            <td class="align-middle">Papel</td>
            <td class="align-middle">Residuos no peligrosos</td>
            <td class="align-middle">Suelo</td>
            <td class="align-middle">-1</td>
            <td class="align-middle">2</td>
            <td class="align-middle">2</td>
            <td class="align-middle">-4</td>
        </tr>
        <tr>
            <td class="align-middle">13</td>
            <td class="align-middle">Descarga de combustible a tanques de almacenamiento</td>
            <td class="align-middle">Emergencia</td>
            <td class="align-middle">Combustible</td>
            <td class="align-middle">Derrames al suelo - fuga</td>
            <td class="align-middle">Suelo y Aire</td>
            <td class="align-middle">-1</td>
            <td class="align-middle">6</td>
            <td class="align-middle">7</td>
            <td class="align-middle">-42</td>
        </tr>
        <tr>
            <td class="align-middle">14</td>
            <td class="align-middle">Almacenamiento de combustibles</td>
            <td class="align-middle">Rutinaria</td>
            <td class="align-middle">Combustible</td>
            <td class="align-middle">Emisiones fugitivas de VOC´s</td>
            <td class="align-middle">Aire</td>
            <td class="align-middle">-1</td>
            <td class="align-middle">4</td>
            <td class="align-middle">5</td>
            <td class="align-middle">-20</td>
        </tr>
        <tr>
            <td class="align-middle">15</td>
            <td class="align-middle">Almacenamiento de combustibles</td>
            <td class="align-middle">Emergencia</td>
            <td class="align-middle">Combustible</td>
            <td class="align-middle">Derrames al suelo - fuga</td>
            <td class="align-middle">Suelo</td>
            <td class="align-middle">-1</td>
            <td class="align-middle">5</td>
            <td class="align-middle">7</td>
            <td class="align-middle">-35</td>
        </tr>
        <tr>
            <td class="align-middle">16</td>
            <td class="align-middle">Limpieza en área de descarga</td>
            <td class="align-middle">No rutinaria</td>
            <td class="align-middle">Agua</td>
            <td class="align-middle">Agua residual (mezclada con combustibles)</td>
            <td class="align-middle">Agua</td>
            <td class="align-middle">-1</td>
            <td class="align-middle">4</td>
            <td class="align-middle">5</td>
            <td class="align-middle">-20</td>
        </tr>
        <tr>
            <td class="align-middle">17</td>
            <td class="align-middle">Limpieza en el área de despacho de combustible al publico</td>
            <td class="align-middle">Rutinaria</td>
            <td class="align-middle">Agua</td>
            <td class="align-middle">Agua residual (mezclada con combustibles)</td>
            <td class="align-middle">Agua</td>
            <td class="align-middle">-1</td>
            <td class="align-middle">4</td>
            <td class="align-middle">5</td>
            <td class="align-middle">-20</td>
        </tr>
        <tr>
            <td class="align-middle">18</td>
            <td class="align-middle">Limpieza en el área de despacho de combustible al publico</td>
            <td class="align-middle">Rutinaria</td>
            <td class="align-middle">Trapos</td>
            <td class="align-middle">Residuos peligrosos</td>
            <td class="align-middle">Suelo</td>
            <td class="align-middle">-1</td>
            <td class="align-middle">4</td>
            <td class="align-middle">4</td>
            <td class="align-middle">-16</td>
        </tr>
        <tr>
            <td class="align-middle">19</td>
            <td class="align-middle">Limpieza de trampas de combustible</td>
            <td class="align-middle">No rutinaria</td>
            <td class="align-middle">Agua</td>
            <td class="align-middle">Agua residual (mezclada con combustibles)</td>
            <td class="align-middle">Agua</td>
            <td class="align-middle">-1</td>
            <td class="align-middle">4</td>
            <td class="align-middle">6</td>
            <td class="align-middle">-24</td>
        </tr>
        <tr>
            <td class="align-middle">20</td>
            <td class="align-middle">Limpieza en tanques de almacenamiento</td>
            <td class="align-middle">No rutinaria</td>
            <td class="align-middle">Agua</td>
            <td class="align-middle">Agua residual (mezclada con combustibles)</td>
            <td class="align-middle">Agua</td>
            <td class="align-middle">-1</td>
            <td class="align-middle">4</td>
            <td class="align-middle">4</td>
            <td class="align-middle">-16</td>
        </tr>
        <tr>
            <td class="align-middle">21</td>
            <td class="align-middle">Limpieza en oficinas y tienda</td>
            <td class="align-middle">Rutinaria</td>
            <td class="align-middle">Agua</td>
            <td class="align-middle">Agua residual (mezclada con jabón)</td>
            <td class="align-middle">Agua</td>
            <td class="align-middle">-1</td>
            <td class="align-middle">2</td>
            <td class="align-middle">2</td>
            <td class="align-middle">-4</td>
        </tr>
        <tr>
            <td class="align-middle">22</td>
            <td class="align-middle">Limpieza en oficinas y tienda</td>
            <td class="align-middle">Rutinaria</td>
            <td class="align-middle">Trapos</td>
            <td class="align-middle">Residuos no peligrosos</td>
            <td class="align-middle">Suelo</td>
            <td class="align-middle">-1</td>
            <td class="align-middle">3</td>
            <td class="align-middle">3</td>
            <td class="align-middle">-9</td>
        </tr>
        <tr>
            <td class="align-middle">23</td>
            <td class="align-middle">Limpieza en oficinas y tienda</td>
            <td class="align-middle">Rutinaria</td>
            <td class="align-middle">Papel</td>
            <td class="align-middle">Residuos no peligrosos</td>
            <td class="align-middle">Suelo</td>
            <td class="align-middle">-1</td>
            <td class="align-middle">2</td>
            <td class="align-middle">2</td>
            <td class="align-middle">-4</td>
        </tr>
        <tr>
            <td class="align-middle">24</td>
            <td class="align-middle">Mantenimiento de dispensarios</td>
            <td class="align-middle">No rutinaria</td>
            <td class="align-middle">Trapos</td>
            <td class="align-middle">Residuos peligrosos</td>
            <td class="align-middle">Suelo</td>
            <td class="align-middle">-1</td>
            <td class="align-middle">3</td>
            <td class="align-middle">3</td>
            <td class="align-middle">-9</td>
        </tr>
        <tr>
            <td class="align-middle">25</td>
            <td class="align-middle">Mantenimiento de tanques de almacenamiento</td>
            <td class="align-middle">No rutinaria</td>
            <td class="align-middle">Trapos</td>
            <td class="align-middle">Residuos peligrosos</td>
            <td class="align-middle">Suelo</td>
            <td class="align-middle">-1</td>
            <td class="align-middle">3</td>
            <td class="align-middle">3</td>
            <td class="align-middle">-9</td>
        </tr>
        <tr>
            <td class="align-middle">26</td>
            <td class="align-middle">Venta de productos</td>
            <td class="align-middle">Rutinaria</td>
            <td class="align-middle">Envases de producto (aceites, anticongelantes, aditivos)</td>
            <td class="align-middle">Residuos peligroso </td>
            <td class="align-middle">Suelo</td>
            <td class="align-middle">-1</td>
            <td class="align-middle">4</td>
            <td class="align-middle">4</td>
            <td class="align-middle">-16</td>
        </tr>
        <tr>
            <td class="align-middle">27</td>
            <td class="align-middle">Operación de la tienda</td>
            <td class="align-middle">Rutinaria</td>
            <td class="align-middle">Papel, plástico, cartón</td>
            <td class="align-middle">Residuos no peligrosos</td>
            <td class="align-middle">Suelo</td>
            <td class="align-middle">-1</td>
            <td class="align-middle">2</td>
            <td class="align-middle">2</td>
            <td class="align-middle">-4</td>
        </tr>
        <tr>
            <td class="align-middle">28</td>
            <td class="align-middle">Pintado de instalaciones</td>
            <td class="align-middle">No rutinaria</td>
            <td class="align-middle">Trapos</td>
            <td class="align-middle">Residuos peligrosos</td>
            <td class="align-middle">Suelo</td>
            <td class="align-middle">-1</td>
            <td class="align-middle">3</td>
            <td class="align-middle">3</td>
            <td class="align-middle">-9</td>
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
$dompdf->get_canvas()->page_text(760, 570, "Pagina: {PAGE_NUM} de {PAGE_COUNT}", $font, 8, array(0,0,0));
// Ponemos el PDF en el browser
$dompdf->stream('Identificación y evaluación de Aspectos e Impactos Ambientales.pdf',["Attachment" => true]);
//------------------
mysqli_close($con);
//------------------