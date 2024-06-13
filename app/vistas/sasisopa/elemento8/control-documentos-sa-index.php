<?php
require('app/help.php');
?>
<html lang="es">
  <head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
  <title>SASISOPA</title>
  <meta name="description" content="">
  <meta name="viewport" content="width=device-width initial-scale=1.0">
  <link rel="shortcut icon" href="<?php echo RUTA_IMG_ICONOS ?>/icono-web.png">
  <link rel="apple-touch-icon" href="<?php echo RUTA_IMG_ICONOS ?>/icono-web.png">
  <link rel="stylesheet" href="<?php echo RUTA_CSS ?>alertify.css">
  <link rel="stylesheet" href="<?php echo RUTA_CSS ?>themes/default.rtl.css">
  <link href="<?php echo RUTA_CSS ?>bootstrap.css" rel="stylesheet" />
  <link rel="stylesheet" href="<?php echo RUTA_CSS ?>componentes.css">
  <link rel="stylesheet" href="<?php echo RUTA_CSS ?>bootstrap-select.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.0/umd/popper.min.js"></script>
  <script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
  <script type="text/javascript" src="<?php echo RUTA_JS ?>alertify.js"></script>
  <link href="https://fonts.googleapis.com/css?family=Montserrat" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.7.0/animate.min.css">
  <style media="screen">
  .LoaderPage {
  position: fixed;
  left: 0px;
  top: 0px;
  width: 100%;
  height: 100%;
  z-index: 9999;
  background: url('imgs/iconos/load-img.gif') 50% 50% no-repeat rgb(249,249,249);
}
  </style>
  <script type="text/javascript">
  $(document).ready(function(){
  $('[data-toggle="tooltip"]').tooltip();
  $(".LoaderPage").fadeOut("slow");
  });
  function regresarP(){
   window.history.back();
  }

  function Descargar(){
  window.location = "descargar-control-documentos-sa";  
  }
  
  </script>
  </head>
  <body>
 
    <div class="LoaderPage"></div>
    <div class="fixed-top navbar-admin">
    <?php require('public/componentes/header.menu.php'); ?>
    </div>

    <div class="magir-top-principal p-3">

    <div class="row">
      <div class="col-12"></div>
    </div>
    <div class="float-left" style="padding-right: 20px;margin-top: 5px;">
    <a onclick="regresarP()" style="cursor: pointer;" data-toggle="tooltip" data-placement="right" title="Regresar"><img src="<?php echo RUTA_IMG_ICONOS."regresar.png"; ?>"></a>
    </div>
    <div class="float-left"><h4>Control y documentos del Sistema de Administración</h4></div>
    
    <div class="mt-5 bg-white p-3">
    <div class="text-right mb-2"><a onclick="Descargar()"><img src="<?php echo RUTA_IMG_ICONOS."pdf.png"; ?>"></a></div>

<div style="overflow-y: hidden;">
  <table class="table table-sm table-bordered pb-0 mb-0">
  <thead>
  <tr>
    <th class="align-middle">Elemento del Sistema de Administración </th>
    <th class="align-middle">Código de control</th>
    <th class="align-middle">Nombre del documento o registro </th>
    <th class="text-center align-middle" width="100px">Consulta Editable </th>
  </tr>
  </thead>
  <tbody>

    <tr>
      <td class="align-middle">1 POLÍTICA</td>
      <td class="align-middle">Fo.ADMONGAS.001</td>
      <td class="align-middle">Formato de Revisión de la política del SA</td>
      <td class="text-center align-middle"><a href="<?=RUTA_ARCHIVOS_ADMONGAS."Fo.ADMONGAS.001.xlsx";?>" download><img src="<?php echo RUTA_IMG_ICONOS."excel.png"; ?>"></a></td> 
    </tr>
    <tr>
      <td class="align-middle" rowspan="3">2 IDENTIFICACIÓN DE PELIGROS Y ASPECTOS AMBIENTALES, ANÁLISIS DE RIESGO Y EVALUACIÓN DE IMPACTOS AMBIENTALES</td>
      <td class="align-middle">DLES/SA/005</td>
      <td class="align-middle">Análisis de Riesgo del Sector Hidrocarburos</td>
      <td class="text-center align-middle"><a href="<?=SERVIDOR;?>2-analisis-riesgo-evaluacion-impactos-ambientales"><img src="<?php echo RUTA_IMG_ICONOS."mejorespracticas.png"; ?>"></a></td> 
    </tr>
    <tr>
      <td class="align-middle">Fo.ADMONGAS.002</td>
      <td class="align-middle">Identificación y evaluación de Aspectos e Impactos Ambientales.</td>
      <td class="text-center align-middle"><a href="<?=RUTA_ARCHIVOS_ADMONGAS."Fo.ADMONGAS.002.xlsx";?>" download><img src="<?php echo RUTA_IMG_ICONOS."excel.png"; ?>"></td>
    </tr>
    <tr>
      <td class="align-middle">Fo.ADMONGAS.003</td>
      <td class="align-middle">Identificación y evaluación de Riesgos y Peligros</td>
      <td class="text-center align-middle"><a href="<?=RUTA_ARCHIVOS_ADMONGAS."Fo.ADMONGAS.003.xlsx";?>" download><img src="<?php echo RUTA_IMG_ICONOS."excel.png"; ?>"></td>
    </tr>
    <tr>
      <td class="align-middle">3 REQUISITOS LEGALES</td>
      <td class="align-middle">Fo.ADMONGAS.004</td>
      <td class="align-middle">Calendario Anual de renovación de Requisitos legales</td>
      <td class="text-center align-middle"><a href="<?=RUTA_ARCHIVOS_ADMONGAS."Fo.ADMONGAS.004.xlsx";?>" download><img src="<?php echo RUTA_IMG_ICONOS."excel.png"; ?>"></td>
    </tr>
     <tr>
      <td class="align-middle" rowspan="3">4 OBJETIVOS, METAS E INDICADORES</td>
      <td class="align-middle">Fo.ADMONGAS.005</td>
      <td class="align-middle">Reporte Estadístico Diario</td>
      <td class="text-center align-middle"><a href="<?=RUTA_ARCHIVOS_ADMONGAS."Fo.ADMONGAS.005.xlsx";?>" download><img src="<?php echo RUTA_IMG_ICONOS."excel.png"; ?>"></td>
    </tr>
    <tr>
      <td class="align-middle">Fo.ADMONGAS.006</td>
      <td class="align-middle">Seguimiento de objetivos y metas</td>
      <td class="text-center align-middle"><a href="<?=RUTA_ARCHIVOS_ADMONGAS."Fo.ADMONGAS.006.xlsx";?>" download><img src="<?php echo RUTA_IMG_ICONOS."excel.png"; ?>"></td>
    </tr>
    <tr>
      <td class="align-middle">Fo.ADMONGAS.007</td>
      <td class="align-middle">Seguimiento y reporte de indicadores</td>
      <td class="text-center align-middle"><a href="<?=RUTA_ARCHIVOS_ADMONGAS."Fo.ADMONGAS.007.xlsx";?>" download><img src="<?php echo RUTA_IMG_ICONOS."excel.png"; ?>"></td>
    </tr>

    <tr>
      <td class="align-middle">5. FUNCIONES, RESPONSABILIDADES Y AUTORIDAD</td>
      <td class="align-middle"></td>
      <td class="align-middle"></td>
      <td class="text-center align-middle"></td>
    </tr>

    <tr>
      <td class="align-middle" rowspan="2">6 COMPETENCIA DEL PERSONAL, CAPACITACIÓN Y ENTRENAMIENTO</td>
      <td class="align-middle">Fo.ADMONGAS.008</td>
      <td class="align-middle">Fichas de personal</td>
      <td class="text-center align-middle"><a href="<?=RUTA_ARCHIVOS_ADMONGAS."Fo.ADMONGAS.008.xlsx";?>" download><img src="<?php echo RUTA_IMG_ICONOS."excel.png"; ?>"></td>
    </tr>
    <tr>
      <td class="align-middle">FO.ADMONGAS.009</td>
      <td class="align-middle">Registros de la implementación del programa de Capacitación. </td>
      <td class="text-center align-middle"><a href="<?=RUTA_ARCHIVOS_ADMONGAS."Fo.ADMONGAS.009.xlsx";?>" download><img src="<?php echo RUTA_IMG_ICONOS."excel.png"; ?>"></td>
    </tr>
    <tr>
      <td class="align-middle">7 COMUNICACIÓN, PARTICIPACIÓN Y CONSULTA</td>
      <td class="align-middle">Fo.ADMONGAS.010</td>
      <td class="align-middle">Bitácoras con el registro de la atención y el seguimiento a la comunicación interna y externa.</td>
      <td class="text-center align-middle"><a href="<?=RUTA_ARCHIVOS_ADMONGAS."Fo.ADMONGAS.010.xlsx";?>" download><img src="<?php echo RUTA_IMG_ICONOS."excel.png"; ?>"></td>
    </tr>
     <tr>
      <td class="align-middle" rowspan="4">10 CONTROL DE ACTIVIDADES Y PROCESOS</td>
      <td class="align-middle">DLES.ADMONGAS.001</td>
      <td class="align-middle">Procedimientos de operación, seguridad y mantenimiento</td>
      <td class="text-center align-middle"><a target="_blabk" href="archivos/procedimientos/DLES.ADMONGAS.001.pdf"><img src="<?php echo RUTA_IMG_ICONOS."pdf.png"; ?>"></a></td>
    </tr>
    <tr>
      <td class="align-middle">DLES.ADMONGAS.002</td>
      <td class="align-middle">Bitácora de mantenimiento preventivo y correctivo</td>
      <td class="text-center align-middle"><a href="<?=SERVIDOR;?>mantenimiento-preventivo-correctivo"><img src="<?php echo RUTA_IMG_ICONOS."mejorespracticas.png"; ?>"></a></td>
    </tr>          
    <tr>
      <td class="align-middle">DLES.ADMONGAS.003 </td>
      <td class="align-middle">Bitácora de operación </td>
      <td class="text-center align-middle"><a href="<?=SERVIDOR;?>recepcion-descargar-producto"><img src="<?php echo RUTA_IMG_ICONOS."mejorespracticas.png"; ?>"></a></td>
    </tr>
    <tr>
      <td class="align-middle">Fo.ADMONGAS.011</td>
      <td class="align-middle">Programa anual de mantenimiento</td>
      <td class="text-center align-middle"><a href="<?=RUTA_ARCHIVOS_ADMONGAS."Fo.ADMONGAS.0011.xlsx";?>" download><img src="<?php echo RUTA_IMG_ICONOS."excel.png"; ?>"></td>
    </tr>
    <tr>
      <td class="align-middle" rowspan="3">11 INTEGRIDAD MECÁNICA Y ASEGURAMIENTO DE LA CALIDAD</td>
      <td class="align-middle">DLES.ADMONGAS.001</td>
      <td class="align-middle">Procedimientos de operación, seguridad y mantenimiento</td>
      <td class="text-center align-middle"><a target="_blabk" href="archivos/procedimientos/DLES.ADMONGAS.001.pdf"><img src="<?php echo RUTA_IMG_ICONOS."pdf.png"; ?>"></a></td>
    </tr>
    <tr>
      <td class="align-middle">DLES.ADMONGAS.002</td>
      <td class="align-middle">Bitácora de mantenimiento preventivo y correctivo</td>
      <td class="text-center align-middle"><a href="<?=SERVIDOR;?>mantenimiento-preventivo-correctivo"><img src="<?php echo RUTA_IMG_ICONOS."mejorespracticas.png"; ?>"></a></td>
    </tr>
    <tr>
      <td class="align-middle">Fo.ADMONGAS.011</td>
      <td class="align-middle">Programa anual de mantenimiento</td>
      <td class="text-center align-middle"><a href="<?=RUTA_ARCHIVOS_ADMONGAS."Fo.ADMONGAS.0011.xlsx";?>" download><img src="<?php echo RUTA_IMG_ICONOS."excel.png"; ?>"></td>
    </tr>
    <tr>
      <td class="align-middle" rowspan="5">12 SEGURIDAD DE CONTRATISTAS</td>
      <td class="align-middle">DLES.ADMONGAS.001</td>
      <td class="align-middle">Procedimientos de operación, seguridad y mantenimiento </td>
      <td class="text-center align-middle"><a target="_blabk" href="archivos/procedimientos/DLES.ADMONGAS.001.pdf"><img src="<?php echo RUTA_IMG_ICONOS."pdf.png"; ?>"></a></td>
    </tr>
    <tr>
      <td class="align-middle">Fo.ADMONGAS.012</td>
      <td class="align-middle">Autorización para realizar trabajos peligrosos</td>
      <td class="text-center align-middle"><a href="<?=RUTA_ARCHIVOS_ADMONGAS."Fo.ADMONGAS.012.xlsx";?>" download><img src="<?php echo RUTA_IMG_ICONOS."excel.png"; ?>"></td>
    </tr>
    <tr>
      <td class="align-middle">Fo.ADMONGAS.013</td>
      <td class="align-middle">Formato para requisición de obra o servicio.</td>
      <td class="text-center align-middle"><a href="<?=RUTA_ARCHIVOS_ADMONGAS."Fo.ADMONGAS.013.xlsx";?>" download><img src="<?php echo RUTA_IMG_ICONOS."excel.png"; ?>"></td>
    </tr>
    <tr>
      <td class="align-middle">FO.ADMONGAS.014</td>
      <td class="align-middle">Formato para entrega de información al contratista.</td>
      <td class="text-center align-middle"><a href="<?=RUTA_ARCHIVOS_ADMONGAS."Fo.ADMONGAS.014.xlsx";?>" download><img src="<?php echo RUTA_IMG_ICONOS."excel.png"; ?>"></td>
    </tr>
    <tr>
      <td class="align-middle">Fo.ADMONGAS.015</td>
      <td class="align-middle">Listas de verificación.</td>
      <td class="text-center align-middle"><a href="<?=RUTA_ARCHIVOS_ADMONGAS."Fo.ADMONGAS.015.xlsx";?>" download><img src="<?php echo RUTA_IMG_ICONOS."excel.png"; ?>"></td>
    </tr>
    <tr>
      <td class="align-middle" rowspan="3">13 PREPARACIÓN Y RESPUESTA A EMERGENCIAS</td>
      <td class="align-middle">DLES/SA/004</td>
      <td class="align-middle">Protocolo de Respuesta Emergencias</td>
      <td class="text-center align-middle"><a href="<?=SERVIDOR;?>13-preparacion-emergencias"><img src="<?php echo RUTA_IMG_ICONOS."mejorespracticas.png"; ?>"></td>
    </tr>
    
    <tr>
      <td class="align-middle">Fo.ADMONGAS.016</td>
      <td class="align-middle">Programa anual de simulacros</td>
      <td class="text-center align-middle"><a href="<?=RUTA_ARCHIVOS_ADMONGAS."Fo.ADMONGAS.016.xlsx";?>" download><img src="<?php echo RUTA_IMG_ICONOS."excel.png"; ?>"></td>
    </tr>
    <tr>
      <td class="align-middle">Fo.ADMONGAS.16ª</td>
      <td class="align-middle">Evaluación de simulacros</td>
      <td class="text-center align-middle"><a href="<?=RUTA_ARCHIVOS_ADMONGAS."Fo.ADMONGAS.016a.doc";?>" download><img src="<?php echo RUTA_IMG_ICONOS."word.png"; ?>"></td>
    </tr>
    <tr>
      <td class="align-middle" rowspan="7">14 MONITOREO, VERIFICACIÓN Y EVALUACIÓN</td>
      <td class="align-middle">Fo.ADMONGAS.017</td>
      <td class="align-middle">Programa de implementación del Sistema de administración </td>
      <td class="text-center align-middle"><a href="<?=RUTA_ARCHIVOS_ADMONGAS."Fo.ADMONGAS.017.xlsx";?>" download><img src="<?php echo RUTA_IMG_ICONOS."excel.png"; ?>"></td>
    </tr>
    <tr>
      <td class="align-middle">Fo.ADMONGAS.019</td>
      <td class="align-middle">Relación de equipos sometidos a calibración </td>
      <td class="text-center align-middle"><a href="<?=RUTA_ARCHIVOS_ADMONGAS."Fo.ADMONGAS.019.xlsx";?>" download><img src="<?php echo RUTA_IMG_ICONOS."excel.png"; ?>"></td>
    </tr>
    <tr>
      <td class="align-middle">Fo.ADMONGAS.020</td>
      <td class="align-middle">Calendario de calibraciones</td>
      <td class="text-center align-middle"><a href="<?=RUTA_ARCHIVOS_ADMONGAS."Fo.ADMONGAS.20.xlsx";?>" download><img src="<?php echo RUTA_IMG_ICONOS."excel.png"; ?>"></td>
    </tr>
    <tr>
      <td class="align-middle">DLES.ADMONGAS.002</td>
      <td class="align-middle">Bitácora de mantenimiento preventivo, correctivo y calibración de equipos</td>
      <td class="text-center align-middle"></td>
    </tr>
    <tr>
      <td class="align-middle">Fo.ADMONGAS.021</td>
      <td class="align-middle">Matriz de evaluación del cumplimiento legal.</td>
      <td class="text-center align-middle"><a href="<?=RUTA_ARCHIVOS_ADMONGAS."Fo.ADMONGAS.021.xlsx";?>" download><img src="<?php echo RUTA_IMG_ICONOS."excel.png"; ?>"></td>
    </tr>
    <tr>
      <td class="align-middle">Fo.ADMONGAS.022</td>
      <td class="align-middle">Informe de Resultados de la evaluación del cumplimiento de requisitos legales y otros aplicables al Proyecto.</td>
      <td class="text-center align-middle"><a href="<?=RUTA_ARCHIVOS_ADMONGAS."Fo.ADMONGAS.022.docx";?>" download><img src="<?php echo RUTA_IMG_ICONOS."word.png"; ?>"></td>
    </tr>
    <tr>
      <td class="align-middle">Fo.ADMONGAS.018 </td>
      <td class="align-middle">Programa de Atención de Hallazgos (acciones preventivas y correctivas)</td>
      <td class="text-center align-middle"><a href="<?=RUTA_ARCHIVOS_ADMONGAS."Fo.ADMONGAS.018.xlsx";?>" download><img src="<?php echo RUTA_IMG_ICONOS."excel.png"; ?>"></td>
    </tr>
     <tr>
      <td class="align-middle" rowspan="3">15 AUDITORÍAS</td>
      <td class="align-middle">Fo.ADMONGAS.023</td>
      <td class="align-middle">Programa Anual de Auditorías (Auditorías internas y, en su caso, la Auditoría Externa).</td>
      <td class="text-center align-middle"><a href="<?=RUTA_ARCHIVOS_ADMONGAS."Fo.ADMONGAS.023.xlsx";?>" download><img src="<?php echo RUTA_IMG_ICONOS."excel.png"; ?>"></td>
    </tr>
    <tr>
      <td class="align-middle">Fo.ADMONGAS.024</td>
      <td class="align-middle">El informe de Auditoría</td>
      <td class="text-center align-middle"><a href="<?=RUTA_ARCHIVOS_ADMONGAS."Fo.ADMONGAS.024.doc";?>" download><img src="<?php echo RUTA_IMG_ICONOS."word.png"; ?>"></td>
    </tr>
    <tr>
      <td class="align-middle">Fo.ADMONGAS.025</td>
      <td class="align-middle">Plan de atención de hallazgos </td>
      <td class="text-center align-middle"><a href="<?=RUTA_ARCHIVOS_ADMONGAS."Fo.ADMONGAS.025.docx";?>" download><img src="<?php echo RUTA_IMG_ICONOS."word.png"; ?>"></td>
    </tr>
    <tr>
      <td class="align-middle">16 INVESTIGACIÓN DE INCIDENTES Y ACCIDENTES</td>
      <td class="align-middle">Fo.ADMONGAS.026</td>
      <td class="align-middle">Informe detallado de la Investigación de Causa Raíz de los Eventos tipo 1 </td>
      <td class="text-center align-middle"><a href="<?=RUTA_ARCHIVOS_ADMONGAS."Fo.ADMONGAS.026.docx";?>" download><img src="<?php echo RUTA_IMG_ICONOS."word.png"; ?>"></td>
    </tr>
    <tr>
      <td class="align-middle">17 REVISIÓN DE RESULTADOS</td>
      <td class="align-middle">FO.ADMONGAS.027</td>
      <td class="align-middle">Informe de revisión de resultados emitido por la alta dirección, bajo el FO.ADMONGAS.027</td>
      <td class="text-center align-middle"><a href="<?=RUTA_ARCHIVOS_ADMONGAS."Fo.ADMONGAS.027.docx";?>" download><img src="<?php echo RUTA_IMG_ICONOS."word.png"; ?>"></td>
    </tr>
     <tr>
      <td class="align-middle" rowspan="2">18 INFORMES DE DESEMPEÑO</td>
      <td class="align-middle">Fo.ADMONGAS.028</td>
      <td class="align-middle">IED. Mientras la agencia no emita un formato para este apartado se utilizara provisionalmente</td>
      <td class="text-center align-middle"><a href="<?=RUTA_ARCHIVOS_ADMONGAS."Fo.ADMONGAS.028.docx";?>" download><img src="<?php echo RUTA_IMG_ICONOS."word.png"; ?>"></td>
    </tr>
     <tr>
      <td class="align-middle">Fo.ADMONGAS.029 </td>
      <td class="align-middle">Bitácoras de las visitas de control de la implementación de los procedimientos técnicos y administrativos especificados en las DACG SASISOPA Expendio al Público.</td>
      <td class="text-center align-middle"><a href="<?=RUTA_ARCHIVOS_ADMONGAS."Fo.ADMONGAS.029.xlsx";?>" download><img src="<?php echo RUTA_IMG_ICONOS."excel.png"; ?>"></td>
    </tr>

  </tbody> 
</table>

</div>
    </div>

    </div>

  <script src="<?php echo RUTA_JS ?>bootstrap.min.js"></script>
  </body>
  </html>
