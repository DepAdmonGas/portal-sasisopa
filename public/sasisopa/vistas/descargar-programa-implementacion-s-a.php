<?php
require_once 'dompdf/autoload.inc.php';
include_once "app/help.php";

  function Semanas($Fecha, $Semanas){
  return date("d-m-Y",strtotime($Fecha."+ $Semanas week")); 
  }

  function Dias($Fecha, $Dias){
  return date("d-m-Y",strtotime($Fecha."+ $Dias days")); 
  }

  function Year($Fecha, $Year){
  return date("d-m-Y",strtotime($Fecha."+ $Year year")); 
  }

  function DiasMenos($Fecha,$Dias){
  return date("d-m-Y",strtotime($Fecha."- $Dias days"));  
  }

  function SemanasMenos($Fecha,$Semanas){
  return date("d-m-Y",strtotime($Fecha."- $Semanas week")); 
  }

  $FechaInicio = $Session_Autorizacion;
  $SS1 = Semanas($FechaInicio, 2);
  $SD1 = Dias($SS1,1);
  $SS3 = Semanas($SD1, 3);
  $SD3 = Dias($SS3,1);
  $SS7 = Semanas($SD3, 4);
  $SD7 = Dias($SS7,1);
  $SS9 = Semanas($SD7, 8);
  $SD9 = Dias($SS9,1);  
  $SS10 = Semanas($SD9, 2);
  $SD10 = Dias($SS10,1);  
  $SS11 = Semanas($SD10, 2);
  $SD11 = Dias($SS11,1);  
  $SS18 = Semanas($SD11, 2);
  $SD18 = Dias($SS18,1);  
  $SS19 = Semanas($SD18, 2);
  $SD19 = Dias($SS19,1);  
  $SS20 = Semanas($SD19, 3);
  $SD20 = Dias($SS20,1);
  $SS28 = Semanas($SD20, 3);
  $SD28 = Dias($SS28,1);
  $SS29 = Semanas($SD20, 1);
  $SS30 = Semanas($SD20, 2);
  $SS31 = Semanas($SD28, 3);
  $SD31 = Dias($SS31,1);  
  $SS33 = Semanas($SD31, 3);
  $SD33 = Dias($SS33,1);  
  $SS35 = Semanas($SD33, 4);
  $SD35 = Dias($SS35,1);  
  $SS37 = Semanas($SD35, 4);
  $SD37 = Dias($SS37,1);  
  $SS39 = Semanas($SD37, 2);
  $SD39 = Dias($SS39,1);  
  $SS40 = Semanas($SD39, 2);
  $FIAnual = Year($FechaInicio, 1);
  $FF43 = DiasMenos($FIAnual,1);
  $FI43 = SemanasMenos($FF43,8);

use Dompdf\Dompdf;
$dompdf = new Dompdf();

    $contenid0 .= "<!DOCTYPE html>";
    $contenid0 .= "<html>";
    $contenid0 .= "<head>";
    $contenid0 .= "<title>Programa de implementación del Sistema de Administración</title>";
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

article, aside, dialog, figcaption, figure, footer, header, hgroup, main, nav, section {
  display: block;
}
body {
  margin: 0;
  font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, "Helvetica Neue", Arial, sans-serif, "Apple Color Emoji", "Segoe UI Emoji", "Segoe UI Symbol";
  font-size: 1rem;
  font-weight: 400;
  line-height: 1.5;
  color: #212529;
  text-align: left;
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
table {
  border-collapse: collapse;
}
.table {
  width: 100%;
  max-width: 100%;
  margin-bottom: 1rem;
  background-color: transparent;
}

.table th,
.table td {
  padding: 0.75rem;
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
  padding: 0.3rem;
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
  padding: 0.3rem;
}
.align-middle {
  vertical-align: middle !important;
}
small {
  font-size: 80%;
}
.table-active,
.table-active > th,
.table-active > td {
  background-color: rgba(0, 0, 0, 0.075);
}

.table thead th {
  vertical-align: bottom;
  border-bottom: 2px solid #dee2e6;
}

.table tbody + tbody {
  border-top: 2px solid #dee2e6;
}

.bg-light {
  background-color: #f8f9fa !important;
}

.bg-dark {
  background-color: #343a40 !important;
}

.text-white {
  color: #fff !important;
}
</style>';
$contenid0 .= "</head>";
$contenid0 .= "<body>";


$contenid0 .= '<table class="table table-sm table-bordered">
  <tr>
  <td class="align-middle">'.$Session_Razonsocial.' '.$Session_Permisocre.'</td>
  <td class="align-middle"><b>Programa de implementación del Sistema de Administración</b></td>
  <td class="align-middle">Fecha de aprobacion 04-Marzo-21</td>
  <td class="align-middle">Fo.ADMONGAS.017</td>
  </tr>
  <tr>
  <td class="align-middle">Realizado por: Nelly Garcia Estrada</td>
  <td class="align-middle">Revisado por: Eduardo Galicia Flores </td>
  <td class="align-middle" colspan="2">Aprobado por: '.$Session_ApoderadoLegal.'</td>
  </tr>
  </table>';

  $contenid0 .= '<table class="table table-sm table-bordered" style="font-size: .8em;">';
  $contenid0 .= '<thead>
  <tr>
  <th class="align-middle text-white bg-dark" width="20px">No</th>
  <th class="align-middle text-white bg-dark">Actividad</th>
  <th class="align-middle text-white bg-dark" width="60px">Semanas</th>
  <th class="align-middle text-white bg-dark" width="85px">Periodicidad</th>
  <th class="align-middle text-white bg-dark" width="90px">Fecha de Inicio</th>
  <th class="align-middle text-white bg-dark" width="90px">Fecha de Termino</th>
  </tr>
  </thead>';
  $contenid0 .= '<tbody>';
  $contenid0 .= '<tr>
  <td colspan="6" class="text-center bg-light"><b>I. Politica</b></td>
  </tr>';
  //--------1
  $contenid0 .= '<tr>
  <td class="align-middle text-center">1</td>
  <td class="align-middle">Revision de politica del Sistema de Administracion</td>
  <td class="align-middle text-center">2</td>
  <td class="align-middle text-center">Anual</td>
  <td class="align-middle text-center">'.$FechaInicio.'</td>
  <td class="align-middle text-center">'.$SS1.'</td>
  </tr>';
  //--------2
  $contenid0 .= '<tr>
  <td class="align-middle text-center">2</td>
  <td class="align-middle">Difusion de politica</td>
  <td class="align-middle text-center">12</td>
  <td class="align-middle text-center">Mensual</td>
  <td class="align-middle text-center" colspan="2">Primer semana de cada mes </td>
  </tr>';

  $contenid0 .= '<tr>
  <td colspan="6" class="text-center bg-light"><b>II. Identificación de peligros y aspectos ambientales, análisis de riesgo y evaluación de impactos ambientales.</b></td>
  </tr>';

  //--------3
  $contenid0 .= '<tr>
  <td class="align-middle text-center">3</td>
  <td class="align-middle">Listado de peligros y aspectos ambientales.</td>
  <td class="align-middle text-center">3</td>
  <td class="align-middle text-center">Anual</td>
  <td class="align-middle text-center">'.$SD1.'</td>
  <td class="align-middle text-center">'.$SS3.'</td>
  </tr>';
  //--------4
  $contenid0 .= '<tr>
  <td class="align-middle text-center">4</td>
  <td class="align-middle">El resultado del análisis de riesgo.</td>
  <td class="align-middle text-center">3</td>
  <td class="align-middle text-center">Anual</td>
  <td class="align-middle text-center">'.$SD1.'</td>
  <td class="align-middle text-center">'.$SS3.'</td>
  </tr>';
  //--------5
  $contenid0 .= '<tr>
  <td class="align-middle text-center">5</td>
  <td class="align-middle">El resultado de la evaluación de Aspectos Ambientales.</td>
  <td class="align-middle text-center">3</td>
  <td class="align-middle text-center">Anual</td>
  <td class="align-middle text-center">'.$SD1.'</td>
  <td class="align-middle text-center">'.$SS3.'</td>
  </tr>';
  //--------6
  $contenid0 .= '<tr>
  <td class="align-middle text-center">6</td>
  <td class="align-middle">El listado de los riesgos y los aspectos ambientales significativos a controlar.</td>
  <td class="align-middle text-center">3</td>
  <td class="align-middle text-center">Anual</td>
  <td class="align-middle text-center">'.$SD1.'</td>
  <td class="align-middle text-center">'.$SS3.'</td>
  </tr>';

  $contenid0 .= '<tr>
  <td colspan="6" class="text-center bg-light"><b>III. Requisitos legales.</b></td>
  </tr>';

  //--------7
  $contenid0 .= '<tr>
  <td class="align-middle text-center">7</td>
  <td class="align-middle">El listado de los requisitos legales vigentes y otros requisitos aplicables a los procesos y actividades del regulado.</td>
  <td class="align-middle text-center">4</td>
  <td class="align-middle text-center">Anual</td>
  <td class="align-middle text-center">'.$SD3.'</td>
  <td class="align-middle text-center">'.$SS7.'</td>
  </tr>';
  //--------8
  $contenid0 .= '<tr>
  <td class="align-middle text-center">8</td>
  <td class="align-middle">El listado de los requisitos legales vigentes de los permisos, autorizaciones, licencias y otros trámites.</td>
  <td class="align-middle text-center">4</td>
  <td class="align-middle text-center">Anual</td>
  <td class="align-middle text-center">'.$SD3.'</td>
  <td class="align-middle text-center">'.$SS7.'</td>
  </tr>';

  $contenid0 .= '<tr>
  <td colspan="6" class="text-center bg-light"><b>IV. Objetivos, metas, indicadores</b></td>
  </tr>';

  //--------9
  $contenid0 .= '<tr>
  <td class="align-middle text-center">9</td>
  <td class="align-middle">El listado de los requisitos legales vigentes de los permisos, autorizaciones, licencias y otros trámites.</td>
  <td class="align-middle text-center">8</td>
  <td class="align-middle text-center">Anual</td>
  <td class="align-middle text-center">'.$SD7.'</td>
  <td class="align-middle text-center">'.$SS9.'</td>
  </tr>';

  $contenid0 .= '<tr>
  <td colspan="6" class="text-center bg-light"><b>V. Funciones, responsabilidades y autoridad.</b></td>
  </tr>';

  //--------10
  $contenid0 .= '<tr>
  <td class="align-middle text-center">10</td>
  <td class="align-middle">La designación documentada del Representante Técnico ante la Agencia.</td>
  <td class="align-middle text-center">2</td>
  <td class="align-middle text-center">Anual</td>
  <td class="align-middle text-center">'.$SD9.'</td>
  <td class="align-middle text-center">'.$SS10.'</td>
  </tr>';

  $contenid0 .= '<tr>
  <td colspan="6" class="text-center bg-light"><b>VI. Competencia del personal, capacitación y entrenamiento.</b></td>
  </tr>';

  //--------11
  $contenid0 .= '<tr>
  <td class="align-middle text-center">11</td>
  <td class="align-middle">Perfiles de puesto</td>
  <td class="align-middle text-center">2</td>
  <td class="align-middle text-center">Anual</td>
  <td class="align-middle text-center">'.$SD10.'</td>
  <td class="align-middle text-center">'.$SS11.'</td>
  </tr>';
  //--------12
  $contenid0 .= '<tr>
  <td class="align-middle text-center">12</td>
  <td class="align-middle">Programas anuales para el desarrollo de la competencia incluida la capacitación inicial para personal de nuevo ingreso</td>
  <td class="align-middle text-center">2</td>
  <td class="align-middle text-center">Anual</td>
  <td class="align-middle text-center">'.$SD10.'</td>
  <td class="align-middle text-center">'.$SS11.'</td>
  </tr>';
  //--------13
  $contenid0 .= '<tr>
  <td class="align-middle text-center">13</td>
  <td class="align-middle">Programas anuales para el desarrollo de la competencia incluida la capacitación para operar y mantener equipos nuevos</td>
  <td class="align-middle text-center">2</td>
  <td class="align-middle text-center">Anual</td>
  <td class="align-middle text-center">'.$SD10.'</td>
  <td class="align-middle text-center">'.$SS11.'</td>
  </tr>';
  //--------14
  $contenid0 .= '<tr>
  <td class="align-middle text-center">14</td>
  <td class="align-middle">Programas anuales para el desarrollo de la competencia incluida la capacitación de actualización para el personal al menos cada 3 años o de acuerdo a la actualización por cambios en las instrucciones de trabajo o tecnología, procedimientos o normatividad</td>
  <td class="align-middle text-center">2</td>
  <td class="align-middle text-center">Anual</td>
  <td class="align-middle text-center">'.$SD10.'</td>
  <td class="align-middle text-center">'.$SS11.'</td>
  </tr>';
  //--------15
  $contenid0 .= '<tr>
  <td class="align-middle text-center">15</td>
  <td class="align-middle">Programas anuales para el desarrollo de la competencia incluida la capacitación para contratistas, subcontratistas, prestadores de servicios y proveedores</td>
  <td class="align-middle text-center">2</td>
  <td class="align-middle text-center">Anual</td>
  <td class="align-middle text-center">'.$SD10.'</td>
  <td class="align-middle text-center">'.$SS11.'</td>
  </tr>';
  //--------16
  $contenid0 .= '<tr>
  <td class="align-middle text-center">16</td>
  <td class="align-middle">Registros de competencia (inducción, capacitación, entrenamiento y reentrenamientos) del personal propio, contratistas, subcontratistas, prestadores de servicio y proveedores</td>
  <td class="align-middle text-center">2</td>
  <td class="align-middle text-center">Anual</td>
  <td class="align-middle text-center">'.$SD10.'</td>
  <td class="align-middle text-center">'.$SS11.'</td>
  </tr>';

  $contenid0 .= '<tr>
  <td colspan="6" class="text-center bg-light"><b>VII. Comunicación, participación y consulta.</b></td>
  </tr>';

  //--------17
  $contenid0 .= '<tr>
  <td class="align-middle text-center">17</td>
  <td class="align-middle">Formatos para la distribución y control de las comunicaciones</td>
  <td class="align-middle text-center">1</td>
  <td class="align-middle text-center">Mensual</td>
  <td class="align-middle text-center" colspan="2">Primer semana de cada mes</td>
  </tr>';

  $contenid0 .= '<tr>
  <td colspan="6" class="text-center bg-light"><b>VIII. Control de documentos y registros.</b></td>
  </tr>';

  //--------18
  $contenid0 .= '<tr>
  <td class="align-middle text-center">18</td>
  <td class="align-middle">Listado de la información documentada del Sistema de Administración.</td>
  <td class="align-middle text-center">2</td>
  <td class="align-middle text-center">Anual</td>
  <td class="align-middle text-center">'.$SD11.'</td>
  <td class="align-middle text-center">'.$SS18.'</td>
  </tr>';

  $contenid0 .= '<tr>
  <td colspan="6" class="text-center bg-light"><b>IX. Mejores prácticas y estándares.</b></td>
  </tr>';

  //--------19
  $contenid0 .= '<tr>
  <td class="align-middle text-center">19</td>
  <td class="align-middle">El listado de la normatividad, códigos, estándares o prácticas de ingeniería que se utilizarán y aplicarán en las etapas de desarrollo, así como en la inspección de las instalaciones, equipos y procesos del Proyecto</td>
  <td class="align-middle text-center">2</td>
  <td class="align-middle text-center">Anual</td>
  <td class="align-middle text-center">'.$SD18.'</td>
  <td class="align-middle text-center">'.$SS19.'</td>
  </tr>';

  $contenid0 .= '<tr>
  <td colspan="6" class="text-center bg-light"><b>X. Control de actividades y procesos.</b></td>
  </tr>';

  //--------20
  $contenid0 .= '<tr>
  <td class="align-middle text-center">20</td>
  <td class="align-middle">La descripción de todos los criterios y controles de operación para aplicar en las diferentes Etapas de Desarrollo del Proyecto, atendiendo al menos Actividades de la etapa de operación y mantenimiento considerando: Pruebas y puesta en marcha de instalaciones y equipos;</td>
  <td class="align-middle text-center">3</td>
  <td class="align-middle text-center">Anual</td>
  <td class="align-middle text-center">'.$SD19.'</td>
  <td class="align-middle text-center">'.$SS20.'</td>
  </tr>';
  //--------21
  $contenid0 .= '<tr>
  <td class="align-middle text-center">21</td>
  <td class="align-middle">La descripción de todos los criterios y controles de operación para aplicar en las diferentes Etapas de Desarrollo del Proyecto, atendiendo al menos Actividades de la etapa de operación y mantenimiento considerando: Uso de maquinaria, equipo, manejo de combustibles y sustancias químicas;</td>
  <td class="align-middle text-center">3</td>
  <td class="align-middle text-center">Anual</td>
  <td class="align-middle text-center">'.$SD19.'</td>
  <td class="align-middle text-center">'.$SS20.'</td>
  </tr>';
  //--------22
  $contenid0 .= '<tr>
  <td class="align-middle text-center">22</td>
  <td class="align-middle">La descripción de todos los criterios y controles de operación para aplicar en las diferentes Etapas de Desarrollo del Proyecto, atendiendo al menos Actividades de la etapa de operación y mantenimiento considerando: Protección de suelo y cuerpos de agua, descarga de agua residual, emisión de ruido, emisión de gases a la atmósfera y manejo de residuos</td>
  <td class="align-middle text-center">3</td>
  <td class="align-middle text-center">Anual</td>
  <td class="align-middle text-center">'.$SD19.'</td>
  <td class="align-middle text-center">'.$SS20.'</td>
  </tr>';
  //--------23
  $contenid0 .= '<tr>
  <td class="align-middle text-center">23</td>
  <td class="align-middle">La descripción de todos los criterios y controles de operación para aplicar en las diferentes Etapas de Desarrollo del Proyecto, atendiendo al menos Actividades de la etapa de operación y mantenimiento considerando: Expendio al público de Gas Natural, Distribución y Expendio al público de Gas Licuado de Petróleo y de Petrolíferos</td>
  <td class="align-middle text-center">3</td>
  <td class="align-middle text-center">Anual</td>
  <td class="align-middle text-center">'.$SD19.'</td>
  <td class="align-middle text-center">'.$SS20.'</td>
  </tr>';
  //--------24
  $contenid0 .= '<tr>
  <td class="align-middle text-center">24</td>
  <td class="align-middle">La descripción de todos los criterios y controles de operación para aplicar en las diferentes Etapas de Desarrollo del Proyecto, atendiendo al menos Actividades de la etapa de operación y mantenimiento considerando: Acceso y circulación de auto-tanques y vehículos de reparto</td>
  <td class="align-middle text-center">3</td>
  <td class="align-middle text-center">Anual</td>
  <td class="align-middle text-center">'.$SD19.'</td>
  <td class="align-middle text-center">'.$SS20.'</td>
  </tr>';
  //--------25
  $contenid0 .= '<tr>
  <td class="align-middle text-center">25</td>
  <td class="align-middle">La descripción de todos los criterios y controles de operación para aplicar en las diferentes Etapas de Desarrollo del Proyecto, atendiendo al menos Actividades de la etapa de operación y mantenimiento considerando: Manejo de recipientes transportables (cilindros) de Gas L.P</td>
  <td class="align-middle text-center">3</td>
  <td class="align-middle text-center">Anual</td>
  <td class="align-middle text-center">'.$SD19.'</td>
  <td class="align-middle text-center">'.$SS20.'</td>
  </tr>';
  //--------26
  $contenid0 .= '<tr>
  <td class="align-middle text-center">26</td>
  <td class="align-middle">La descripción de todos los criterios y controles de operación para aplicar en las diferentes Etapas de Desarrollo del Proyecto, atendiendo al menos Actividades de la etapa de operación y mantenimiento considerando: Administración de cambios de tecnología</td>
  <td class="align-middle text-center">3</td>
  <td class="align-middle text-center">Anual</td>
  <td class="align-middle text-center">'.$SD19.'</td>
  <td class="align-middle text-center">'.$SS20.'</td>
  </tr>';
  //--------27
  $contenid0 .= '<tr>
  <td class="align-middle text-center">27</td>
  <td class="align-middle">La descripción de todos los criterios y controles de operación para aplicar en las diferentes Etapas de Desarrollo del Proyecto, atendiendo al menos Actividades de la etapa de operación y mantenimiento considerando: Administración de cambios de personal</td>
  <td class="align-middle text-center">3</td>
  <td class="align-middle text-center">Anual</td>
  <td class="align-middle text-center">'.$SD19.'</td>
  <td class="align-middle text-center">'.$SS20.'</td>
  </tr>';

  $contenid0 .= '<tr>
  <td colspan="6" class="text-center bg-light"><b>XI. Integridad mecánica y aseguramiento de la calidad.</b></td>
  </tr>';

  //--------28
  $contenid0 .= '<tr>
  <td class="align-middle text-center">28</td>
  <td class="align-middle">Los programas de mantenimiento predictivo, preventivo, calibración, certificación, verificación, inspeccione y pruebas de equipos críticos.</td>
  <td class="align-middle text-center">3</td>
  <td class="align-middle text-center">Anual</td>
  <td class="align-middle text-center">'.$SD20.'</td>
  <td class="align-middle text-center">'.$SS28.'</td>
  </tr>';
  //--------29
  $contenid0 .= '<tr>
  <td class="align-middle text-center">29</td>
  <td class="align-middle">Carta responsiva firmada por el Represente Legal, en donde asume la responsabilidad por la administración del riesgo y de los impactos al ambiente que se deriven de las actividades de contratistas, prestadores de servicio y proveedores.</td>
  <td class="align-middle text-center">1</td>
  <td class="align-middle text-center">Anual</td>
  <td class="align-middle text-center">'.$SD20.'</td>
  <td class="align-middle text-center">'.$SS29.'</td>
  </tr>';
  //--------30
  $contenid0 .= '<tr>
  <td class="align-middle text-center">30</td>
  <td class="align-middle">Requisitos en materia de Seguridad Industrial, Seguridad Operativa y de Protección al Medio Ambiente a los que deben sujetarse los contratistas, subcontratistas, prestadores de servicio y proveedores</td>
  <td class="align-middle text-center">2</td>
  <td class="align-middle text-center">Anual</td>
  <td class="align-middle text-center">'.$SD20.'</td>
  <td class="align-middle text-center">'.$SS30.'</td>
  </tr>';

  $contenid0 .= '<tr>
  <td colspan="6" class="text-center bg-light"><b>XII. Seguridad de contratistas.</b></td>
  </tr>';

  //--------31
  $contenid0 .= '<tr>
  <td class="align-middle text-center">31</td>
  <td class="align-middle">Carta responsiva firmada por el Represente Legal, en donde asume la responsabilidad por la administración del riesgo y de los impactos al ambiente que se deriven de las actividades de contratistas, prestadores de servicio y proveedores.</td>
  <td class="align-middle text-center">3</td>
  <td class="align-middle text-center">Anual</td>
  <td class="align-middle text-center">'.$SD28.'</td>
  <td class="align-middle text-center">'.$SS31.'</td>
  </tr>';
   //--------32
  $contenid0 .= '<tr>
  <td class="align-middle text-center">32</td>
  <td class="align-middle">Requisitos en materia de Seguridad Industrial, Seguridad Operativa y de Protección al Medio Ambiente a los que deben sujetarse los contratistas, subcontratistas, prestadores de servicio y proveedores</td>
  <td class="align-middle text-center">3</td>
  <td class="align-middle text-center">Anual</td>
  <td class="align-middle text-center">'.$SD28.'</td>
  <td class="align-middle text-center">'.$SS31.'</td>
  </tr>';

  $contenid0 .= '<tr>
  <td colspan="6" class="text-center bg-light"><b>XIII. Preparación y respuesta a emergencias.</b></td>
  </tr>';

   //--------33
  $contenid0 .= '<tr>
  <td class="align-middle text-center">33</td>
  <td class="align-middle">El listado de situaciones potenciales de emergencia identificadas para todas las instalaciones y sitios donde se desarrollen las actividades de expendio al público</td>
  <td class="align-middle text-center">3</td>
  <td class="align-middle text-center">Anual</td>
  <td class="align-middle text-center">'.$SD31.'</td>
  <td class="align-middle text-center">'.$SS33.'</td>
  </tr>';
   //--------34
  $contenid0 .= '<tr>
  <td class="align-middle text-center">34</td>
  <td class="align-middle">Los planes de atención y respuesta a emergencias y programa de simulacros</td>
  <td class="align-middle text-center">3</td>
  <td class="align-middle text-center">Anual</td>
  <td class="align-middle text-center">'.$SD31.'</td>
  <td class="align-middle text-center">'.$SS33.'</td>
  </tr>';

  $contenid0 .= '<tr>
  <td colspan="6" class="text-center bg-light"><b>XIV. Monitoreo, verificación y evaluación.</b></td>
  </tr>';

  //--------35
  $contenid0 .= '<tr>
  <td class="align-middle text-center">35</td>
  <td class="align-middle">Programa de monitoreo y medición de parámetros de desempeño</td>
  <td class="align-middle text-center">4</td>
  <td class="align-middle text-center">Anual</td>
  <td class="align-middle text-center">'.$SD33.'</td>
  <td class="align-middle text-center">'.$SS35.'</td>
  </tr>';
  //--------36
  $contenid0 .= '<tr>
  <td class="align-middle text-center">36</td>
  <td class="align-middle">Resultados de calibración y mantenimiento de equipos empleados en monitoreo del Sistema de Administración</td>
  <td class="align-middle text-center">4</td>
  <td class="align-middle text-center">Anual</td>
  <td class="align-middle text-center">'.$SD33.'</td>
  <td class="align-middle text-center">'.$SS35.'</td>
  </tr>';

  $contenid0 .= '<tr>
  <td colspan="6" class="text-center bg-light"><b>XV. Auditorias.</b></td>
  </tr>';

  //--------37
  $contenid0 .= '<tr>
  <td class="align-middle text-center">37</td>
  <td class="align-middle">El programa de auditorías, internas y externas, del Sistema a aplicar en el año en curso</td>
  <td class="align-middle text-center">4</td>
  <td class="align-middle text-center">Anual</td>
  <td class="align-middle text-center">'.$SD35.'</td>
  <td class="align-middle text-center">'.$SS37.'</td>
  </tr>';
  //--------38
  $contenid0 .= '<tr>
  <td class="align-middle text-center">38</td>
  <td class="align-middle">Los criterios de competencia para la calificación, entrenamiento y selección de auditores internos</td>
  <td class="align-middle text-center">4</td>
  <td class="align-middle text-center">Anual</td>
  <td class="align-middle text-center">'.$SD35.'</td>
  <td class="align-middle text-center">'.$SS37.'</td>
  </tr>';

  $contenid0 .= '<tr>
  <td colspan="6" class="text-center bg-light"><b>XVI. Investigación de incidentes y accidentes.</b></td>
  </tr>';

   //--------39
  $contenid0 .= '<tr>
  <td class="align-middle text-center">39</td>
  <td class="align-middle">La metodología utilizada para la investigación y análisis de incidentes y accidentes que considera lo establecido en las Disposiciones aplicables.</td>
  <td class="align-middle text-center">2</td>
  <td class="align-middle text-center">Anual</td>
  <td class="align-middle text-center">'.$SD37.'</td>
  <td class="align-middle text-center">'.$SS39.'</td>
  </tr>';

  $contenid0 .= '<tr>
  <td colspan="6" class="text-center bg-light"><b>XVII. Revision de resultados. </b></td>
  </tr>';

   //--------40
  $contenid0 .= '<tr>
  <td class="align-middle text-center">40</td>
  <td class="align-middle">Elaborar el Informe de resultados de la implementación del Sistema de Administración</td>
  <td class="align-middle text-center">2</td>
  <td class="align-middle text-center">Anual</td>
  <td class="align-middle text-center">'.$SD39.'</td>
  <td class="align-middle text-center">'.$SS40.'</td>
  </tr>';
   //--------41
  $contenid0 .= '<tr>
  <td class="align-middle text-center">41</td>
  <td class="align-middle">Elaborar del Plan de acciones correctivas y de mejora, que se deriven del informe de resultados</td>
  <td class="align-middle text-center">2</td>
  <td class="align-middle text-center">Anual</td>
  <td class="align-middle text-center">'.$SD39.'</td>
  <td class="align-middle text-center">'.$SS40.'</td>
  </tr>';
   //--------42
  $contenid0 .= '<tr>
  <td class="align-middle text-center">42</td>
  <td class="align-middle">Comunicar las  acciones correctivas y de mejora,que se realizaron</td>
  <td class="align-middle text-center">2</td>
  <td class="align-middle text-center">Anual</td>
  <td class="align-middle text-center">'.$SD39.'</td>
  <td class="align-middle text-center">'.$SS40.'</td>
  </tr>';

  $contenid0 .= '<tr>
  <td colspan="6" class="text-center bg-light"><b>XVIII. Informes de desempeño.</b></td>
  </tr>';

   //--------43
  $contenid0 .= '<tr>
  <td class="align-middle text-center">43</td>
  <td class="align-middle">Los indicadores de evaluación del desempeño del Sistema de Administración</td>
  <td class="align-middle text-center">8</td>
  <td class="align-middle text-center">Anual</td>
  <td class="align-middle text-center">'.$FI43.'</td>
  <td class="align-middle text-center">'.$FF43.'</td>
  </tr>';

  $contenid0 .= '</tbody></table>';

$RutaFirmaF1 = RUTA_IMG_FIRMA_PERSONAL.'Nelly-13062023.PNG';
$DataFirmaF1 = file_get_contents($RutaFirmaF1);
$baseFirmaF1 = 'data:image/;base64,' . base64_encode($DataFirmaF1);

$RutaFirmaF2 = RUTA_IMG_FIRMA_PERSONAL.'Lalo-13062023.PNG';
$DataFirmaF2 = file_get_contents($RutaFirmaF2);
$baseFirmaF2 = 'data:image/;base64,' . base64_encode($DataFirmaF2);

$RutaFirmaAL = RUTA_IMG_FIRMA_PERSONAL.$Session_ApoderadoLegalFirma;
$DataFirmaAL = file_get_contents($RutaFirmaAL);
$baseFirmaAL = 'data:image/;base64,' . base64_encode($DataFirmaAL);

  $contenid0 .= '<table class="table table-sm table-bordered" style="font-size: .9m;">
  <tr>
  <td colspan="3" class="text-center"><b>Firmas de conformidad</b></td>
  </tr>
  <tr>
  <td class="text-center">Nelly Estrada</td>
  <td class="text-center">Eduardo Galicia Flores</td>
  <td class="text-center">Tomas Tarno Quinzaños</td>
  </tr>
  <tr>
  <td class="text-center"><img src="'.$baseFirmaF1.'" style="width: 120px;"></td>
  <td class="text-center"><img src="'.$baseFirmaF2.'" style="width: 120px;"></td>
  <td class="text-center"><img src="'.$baseFirmaAL.'" style="width: 120px;"></td>
  </tr>
  </table>';

$contenid0 .= "</body>";
$contenid0 .= "</html>";


$dompdf->loadHtml($contenid0);
$dompdf->setPaper("A4", "landscape");
$dompdf->render();
$dompdf->get_canvas()->page_text(750, 570, "Pagina: {PAGE_NUM} de {PAGE_COUNT}", $font, 8, array(0,0,0));
$dompdf->stream('Programa de implementación del Sistema de Administración.pdf');

//------------------
mysqli_close($con);
//------------------
?>


