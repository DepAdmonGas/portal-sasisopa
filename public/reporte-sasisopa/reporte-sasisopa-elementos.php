<?php
require('app/help.php');

$ReporteFechaInicio = strtotime($FechaInicio);
$ReporteFechaTermino = strtotime($FechaTermino);

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
  background: url('../imgs/iconos/load-img.gif') 50% 50% no-repeat rgb(249,249,249);
  }
  </style>
  <script type="text/javascript">

  $(document).ready(function(){
  $('[data-toggle="tooltip"]').tooltip();
  $(".LoaderPage").fadeOut("slow");

  Elemto1(<?=$ReporteFechaInicio;?>,<?=$ReporteFechaTermino;?>);
  Elemto2(<?=$ReporteFechaInicio;?>,<?=$ReporteFechaTermino;?>);
  Elemto3(<?=$ReporteFechaInicio;?>,<?=$ReporteFechaTermino;?>);
  Elemto4(<?=$ReporteFechaInicio;?>,<?=$ReporteFechaTermino;?>);
  Elemto5(<?=$ReporteFechaInicio;?>,<?=$ReporteFechaTermino;?>);

  Elemto6(<?=$ReporteFechaInicio;?>,<?=$ReporteFechaTermino;?>);
  Elemto7(<?=$ReporteFechaInicio;?>,<?=$ReporteFechaTermino;?>);
  Elemto8(<?=$ReporteFechaInicio;?>,<?=$ReporteFechaTermino;?>);
  Elemto9(<?=$ReporteFechaInicio;?>,<?=$ReporteFechaTermino;?>);
  Elemto10(<?=$ReporteFechaInicio;?>,<?=$ReporteFechaTermino;?>);

  Elemto11(<?=$ReporteFechaInicio;?>,<?=$ReporteFechaTermino;?>);
  Elemto12(<?=$ReporteFechaInicio;?>,<?=$ReporteFechaTermino;?>);
  Elemto13(<?=$ReporteFechaInicio;?>,<?=$ReporteFechaTermino;?>);
  Elemto14(<?=$ReporteFechaInicio;?>,<?=$ReporteFechaTermino;?>);
  Elemto15(<?=$ReporteFechaInicio;?>,<?=$ReporteFechaTermino;?>);

  Elemto16(<?=$ReporteFechaInicio;?>,<?=$ReporteFechaTermino;?>);
  Elemto17(<?=$ReporteFechaInicio;?>,<?=$ReporteFechaTermino;?>);
  Elemto18(<?=$ReporteFechaInicio;?>,<?=$ReporteFechaTermino;?>);

  });

  function regresarP(){
  window.history.back();
  }

  //------1. POLÍTICA
  function Elemto1(FechaInicio,FechaTermino){$('#Elemento1').load('../../public/reporte-sasisopa/sasisopa-elemento1.php?FechaInicio=' + FechaInicio + '&FechaTermino=' + FechaTermino);
  }
  function DescargarPolitica(id){window.location = "../../descargar-politica/" + id;}
  function DescargarRegistro(id){window.location = "../../descargar-lista-comprobacion/" + id;}
  function DescargarAsistencia(id){window.location = "../../descargar-lista-asistencia/" + id;}
  //-----------------------
  
  //------2. ANÁLISIS DE RIESGO Y EVALUACIÓN DE IMPACTOS AMBIENTALES
  function Elemto2(FechaInicio,FechaTermino){$('#Elemento2').load('../../public/reporte-sasisopa/sasisopa-elemento2.php?FechaInicio=' + FechaInicio + '&FechaTermino=' + FechaTermino);}
  function ModalAnexos(id){$('#Modal').modal('show'); $('#DivModal').load('../../public/sasisopa/vistas/modal-anexos-analisis-riesgo.php?id=' + id);}
  function Formato2(){
  window.location = "../../descargar-formato-2";  
  }
  function Formato3(){
  window.location = "../../descargar-formato-3";
  }
  //-----------------------
  
  //------3. REQUISITOS LEGALES
  function Elemto3(FechaInicio,FechaTermino){
  $('#Elemento3').load('../../public/reporte-sasisopa/sasisopa-elemento3.php?FechaInicio=' + FechaInicio + '&FechaTermino=' + FechaTermino);  
  }
  //------------------------

  //------4. OBJETIVOS, METAS E INDICADORES
  function Elemto4(FechaInicio,FechaTermino){
  $('#Elemento4').load('../../public/reporte-sasisopa/sasisopa-elemento4.php?FechaInicio=' + FechaInicio + '&FechaTermino=' + FechaTermino); 
  }
  //------------------------ 

  //------5. FUNCIONES, RESPONSABILIDADES Y AUTORIDAD
  function Elemto5(FechaInicio,FechaTermino){
  $('#Elemento5').load('../../public/reporte-sasisopa/sasisopa-elemento5.php?FechaInicio=' + FechaInicio + '&FechaTermino=' + FechaTermino); 
  }
  //------------------------
  
  //------6. COMPETENCIA DEL PERSONAL, CAPACITACIÓN Y ENTRENAMIENTO
  function Elemto6(FechaInicio,FechaTermino){
  $('#Elemento6').load('../../public/reporte-sasisopa/sasisopa-elemento6.php?FechaInicio=' + FechaInicio + '&FechaTermino=' + FechaTermino); 
  }
  function DescargarProgramaCapacitacionExterna(id){
  window.location = "../../descargar-capacitacion-externa/" + id;
  }
  //------------------------

  //------7. COMUNICACIÓN, PARTICIPACIÓN Y CONSULTA
  function Elemto7(FechaInicio,FechaTermino){
  $('#Elemento7').load('../../public/reporte-sasisopa/sasisopa-elemento7.php?FechaInicio=' + FechaInicio + '&FechaTermino=' + FechaTermino); 
  }
  function DescargarComunicacionParticipacion(Year,idEstacion,id){    
    if(Year == 0){
    var ResultYear = "X";
    }else{
    var ResultYear = Year;
    }

    if(idEstacion == 0){
    var ResultidEstacion = "X";
    }else{
    var ResultidEstacion = idEstacion;
    }

    if(id == 0){
    var Resultid = "X";
    }else{
    var Resultid = id + "";
    }
        window.location = "../../descargar-comunicacion-participacion-consulta/" + ResultYear + "/" + ResultidEstacion + "/" + Resultid;}
  function DescargarQS(id){window.location = "../../descargar-quejas-sugerencias/" + id;}
  //------------------------

  //------8. CONTROL DE DOCUMENTOS Y REGISTROS
  function Elemto8(FechaInicio,FechaTermino){
  $('#Elemento8').load('../../public/reporte-sasisopa/sasisopa-elemento8.php?FechaInicio=' + FechaInicio + '&FechaTermino=' + FechaTermino); 
  }
  function btnDescargarCDRL(){window.location = "../../descargar-control-documentos-rl";}
  function DescargarCDSA(){window.location = "../../descargar-control-documentos-sa";}
  //------------------------

  //------9. MEJORES PRÁCTICAS Y ESTÁNDARES
  function Elemto9(FechaInicio,FechaTermino){
  $('#Elemento9').load('../../public/reporte-sasisopa/sasisopa-elemento9.php?FechaInicio=' + FechaInicio + '&FechaTermino=' + FechaTermino);  
  }
  function DescargarDC(){window.location = "../../descargar-diseno-construccion";}
  function DescargarOM(){window.location = "../../descargar-operacion-mantenimiento";}
  //------------------------

  //------10. CONTROL DE ACTIVIDADES Y PROCESOS
  function Elemto10(FechaInicio,FechaTermino){
  $('#Elemento10').load('../../public/reporte-sasisopa/sasisopa-elemento10.php?FechaInicio=' + FechaInicio + '&FechaTermino=' + FechaTermino);  
  }
  //------------------------

  //------11. INTEGRIDAD MECÁNICA Y ASEGURAMIENTO DE LA CALIDAD
  function Elemto11(FechaInicio,FechaTermino){
  $('#Elemento11').load('../../public/reporte-sasisopa/sasisopa-elemento11.php?FechaInicio=' + FechaInicio + '&FechaTermino=' + FechaTermino);  
  }
  function DescargarEquipoCritico(){window.location = "../../equipos-criticos";}
  function DescargarPAM(id){
  window.location = "../../descargar-programa-anual-mantenimiento/" + id;
  }
  //------------------------

  //------12. SEGURIDAD DE CONTRATISTAS
  function Elemto12(FechaInicio,FechaTermino){
  $('#Elemento12').load('../../public/reporte-sasisopa/sasisopa-elemento12.php?FechaInicio=' + FechaInicio + '&FechaTermino=' + FechaTermino);
  }
  function DescargarARTP(id){window.location = "../../descargar-autorizacion-trabajos-peligrosos/" + id;}
  function DescargarLV(id){window.location = "../../descargar-lista-verificacion/" + id;}
  function DescargarCR(id){window.location = "../../descargar-carta-responsiva/" + id;}
  function DescargarF13(id){window.location = "../../descargar-seguridad-contratistas/" + id;}
  //------------------------

  //------13. PREPARACIÓN Y RESPUESTA A EMERGENCIAS
  function Elemto13(FechaInicio,FechaTermino){
  $('#Elemento13').load('../../public/reporte-sasisopa/sasisopa-elemento13.php?FechaInicio=' + FechaInicio + '&FechaTermino=' + FechaTermino);
  }
  //------------------------

  //------14. MONITOREO, VERIFICACIÓN Y EVALUACIÓN
  function Elemto14(FechaInicio,FechaTermino){
  $('#Elemento14').load('../../public/reporte-sasisopa/sasisopa-elemento14.php?FechaInicio=' + FechaInicio + '&FechaTermino=' + FechaTermino);
  }
  function DescargarPI(){
  window.location = "../../descargar-programa-implementacion-s-a"; 
  }
    function DescargarESC(){
  window.location.href = '../../descargar-equipos-sometidos-calibracion';
  }
     function Descargar(id){
  window.location = "../../descargar-atencion-hallazgos/" + id; 
   }
  //------------------------

  //------15. AUDITORÍAS
  function Elemto15(FechaInicio,FechaTermino){
  $('#Elemento15').load('../../public/reporte-sasisopa/sasisopa-elemento15.php?FechaInicio=' + FechaInicio + '&FechaTermino=' + FechaTermino); 
  }
  function DescargarProgramaAuditoria(FechaInicio,FechaTermino){
    window.location = "../../descargar-programa-auditorias-internas-externas/" + FechaInicio + "/" + FechaTermino; 
  }
  function ModalAsea(id){
  $('#Modal').modal('show');

  var parametros = {
      "id" : id
    };

  $.ajax({
  data:  parametros,
  url:   '../../public/reporte-sasisopa/modal-lista-asea.php',
  type:  'post',
  beforeSend: function() {
  },
  complete: function(){
  },
  success:  function (response) {

  $('#DivModal').html(response);
  
  }
  });
  }
  //------------------------

  //------16. INVESTIGACIÓN DE INCIDENTES Y ACCIDENTES
  function Elemto16(FechaInicio,FechaTermino){
  $('#Elemento16').load('../../public/reporte-sasisopa/sasisopa-elemento16.php?FechaInicio=' + FechaInicio + '&FechaTermino=' + FechaTermino); 
  }
  function GrupoInterdiciplinario(id){
  $('#Modal').modal('show');

  var parametros = {
  "id"  :  id
  };

  $.ajax({
       data:  parametros,
       url:   '../../public/reporte-sasisopa/modal-lista-grupo.php',
       type:  'post',
       beforeSend: function() {
       },
       complete: function(){
       },
       success:  function (response) {

       $('#DivModal').html(response);
        
       }
       });

  }
  function ModalTercerA(id){
  $('#Modal').modal('show');  

    var parametros = {
  "id"  :  id
  };

  $.ajax({
       data:  parametros,
       url:   '../../public/reporte-sasisopa/modal-tercerautorizado.php',
       type:  'post',
       beforeSend: function() {
       },
       complete: function(){
       },
       success:  function (response) {
  $('#DivModal').html(response);
       }
       });
  }
  function DescargarIIAN(id){
  window.location = "../../descargar-investigacion-sin-incidentes-accidentes/" + id; 
  }
  //------------------------

  //------17. REVISIÓN DE RESULTADOS
  function Elemto17(FechaInicio,FechaTermino){
  $('#Elemento17').load('../../public/reporte-sasisopa/sasisopa-elemento17.php?FechaInicio=' + FechaInicio + '&FechaTermino=' + FechaTermino); 
  }
  function DescargarRRR(Year){
  window.location = "../../descargar-revision-resultados-detalle/" + Year; 
  }
  //------------------------

  //------18. INFORMES DE DESEMPEÑO
  function Elemto18(FechaInicio,FechaTermino){
  $('#Elemento18').load('../../public/reporte-sasisopa/sasisopa-elemento18.php?FechaInicio=' + FechaInicio + '&FechaTermino=' + FechaTermino); 
  }
  function DescargarIS(id){window.location = "../../descargar-registro-atencio-seguimiento-comunicacion-interna-externa/" + id;}
  //------------------------

  </script>
  </head>
  <body>

    <div class="LoaderPage"></div>
    <div class="fixed-top navbar-admin">
    <?php require('public/componentes/header.menu.php'); ?>
    </div>

    <div class="magir-top-principal p-3">

    <div class="float-left" style="padding-right: 20px;margin-top: 5px;">
    <a onclick="regresarP()" style="cursor: pointer;" data-toggle="tooltip" data-placement="right" title="Regresar"><img src="<?php echo RUTA_IMG_ICONOS."regresar.png"; ?>"></a>
    </div>
    <div class="float-left"><h4>REPORTE SASISOPA</h4></div>
    <div class="float-right" style="margin-top: 6px;margin-left: 10px;">
    <a onclick="btnAyuda()" style="cursor: pointer;" data-toggle="tooltip" data-placement="left" title="Ayuda" >
    <img src="<?php echo RUTA_IMG_ICONOS."info.png"; ?>">
    </a>
    </div>

    <div class="mt-5 p-3 bg-white">
    <div id="Elemento1"></div>
    <div id="Elemento2"></div>
    <div id="Elemento3"></div>
    <div id="Elemento4"></div>
    <div id="Elemento5"></div>
    <div id="Elemento6"></div>
    <div id="Elemento7"></div>
    <div id="Elemento8"></div>
    <div id="Elemento9"></div>
    <div id="Elemento10"></div>
    <div id="Elemento11"></div>
    <div id="Elemento12"></div>
    <div id="Elemento13"></div>
    <div id="Elemento14"></div>
    <div id="Elemento15"></div>
    <div id="Elemento16"></div>
    <div id="Elemento17"></div>
    <div id="Elemento18"></div>
    </div>

    </div>

    <div class="modal fade bd-example-modal-lg" id="Modal" data-backdrop="static">
    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
    <div class="modal-content" style="border-radius: 0px;border: 0px;">
    <div id="DivModal"></div>
    </div>
    </div>
    </div>

  <script src="<?php echo RUTA_JS ?>bootstrap.min.js"></script>
  </body>
  </html>

  <?php 
  //------------------
  mysqli_close($con);
  //------------------
  ?>
