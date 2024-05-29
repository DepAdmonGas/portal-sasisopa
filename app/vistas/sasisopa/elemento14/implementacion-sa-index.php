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
  <link rel="stylesheet" href="<?php echo RUTA_CSS ?>componentes.css">
  <link href="<?php echo RUTA_CSS ?>bootstrap.css" rel="stylesheet" />
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
 .car-admin{
    border: 1px solid #eeeeee;box-shadow: 1px 1px 5px #EDEDED;border-bottom: 3px solid #3399cc;border-radius: 0;
    font-size: 1.1em;
  }
  .titulo-punto{
    font-size: 1.2em;
  }

    .modal-xg {
    max-width: 80% !important;
}
  </style>
  <script type="text/javascript">
  $(document).ready(function(){
  $('[data-toggle="tooltip"]').tooltip();
  $(".LoaderPage").fadeOut("slow");

  ListaImplementacion();

  });
  function regresarP(){
   window.history.back();
  }

  function btnModal(){
  $('#myModal').modal('show');
  }

  function ListaImplementacion(){
  $('#ContenidoImplementacion').load('../app/vistas/sasisopa/elemento14/lista-implementacion-sa.php');   
  }

  function ModalDetalle(idDetalle){
  $('#ModalDetalle').modal('show');
  $('#ContenidoDetalle').load('../app/vistas/sasisopa/elemento14/lista-detalle-implementacion-sa.php?idDetalle=' + idDetalle);
  }

  function ModalEditar(idDetalle){
  $('#ModalDetalle').modal('show');
  $('#ContenidoDetalle').load('../app/vistas/sasisopa/elemento14/modal-editar-implementacion-sa.php?idDetalle=' + idDetalle);  
  }

  function btnGuardar(){

 $('#resultado').html('');

  var Titulo1 = $("#Titulo-1").html();
  var Titulo2 = $("#Titulo-2").html();
  var Titulo3 = $("#Titulo-3").html();
  var Titulo4 = $("#Titulo-4").html();
  var Titulo5 = $("#Titulo-5").html();
  var Titulo6 = $("#Titulo-6").html();
  var Titulo7 = $("#Titulo-7").html();
  var Titulo8 = $("#Titulo-8").html();
  var Titulo9 = $("#Titulo-9").html();
  var Titulo10 = $("#Titulo-10").html();
  var Titulo11 = $("#Titulo-11").html();
  var Titulo12 = $("#Titulo-12").html();
  var Titulo13 = $("#Titulo-13").html();
  var Titulo14 = $("#Titulo-14").html();
  var Titulo15 = $("#Titulo-15").html();
  var Titulo16 = $("#Titulo-16").html();
  var Titulo17 = $("#Titulo-17").html();
  var Titulo18 = $("#Titulo-18").html();
  var Titulo19 = $("#Titulo-19").html();
  var Titulo20 = $("#Titulo-20").html();
  var Titulo21 = $("#Titulo-21").html();
  var Titulo22 = $("#Titulo-22").html();
  var Titulo23 = $("#Titulo-23").html();
  var Titulo24 = $("#Titulo-24").html();
  var Titulo25 = $("#Titulo-25").html();
  var Titulo26 = $("#Titulo-26").html();
  var Titulo27 = $("#Titulo-27").html();
  var Titulo28 = $("#Titulo-28").html();
  var Titulo29 = $("#Titulo-29").html();
  var Titulo30 = $("#Titulo-30").html();
  var Titulo31 = $("#Titulo-31").html();
  var Titulo32 = $("#Titulo-32").html();
  var Titulo33 = $("#Titulo-33").html();
  var Titulo34 = $("#Titulo-34").html();
  var Titulo35 = $("#Titulo-35").html();
  var Titulo36 = $("#Titulo-36").html();

  var respuesta1 = $('input:radio[name=respuesta-1]:checked').val();    
  var respuesta2 = $('input:radio[name=respuesta-2]:checked').val();
  var respuesta3 = $('input:radio[name=respuesta-3]:checked').val();    
  var respuesta4 = $('input:radio[name=respuesta-4]:checked').val();
  var respuesta5 = $('input:radio[name=respuesta-5]:checked').val();
  var respuesta6 = $('input:radio[name=respuesta-6]:checked').val();
  var respuesta7 = $('input:radio[name=respuesta-7]:checked').val();
  var respuesta8 = $('input:radio[name=respuesta-8]:checked').val();
  var respuesta9 = $('input:radio[name=respuesta-9]:checked').val();
  var respuesta10 = $('input:radio[name=respuesta-10]:checked').val();
  var respuesta11 = $('input:radio[name=respuesta-11]:checked').val();
  var respuesta12 = $('input:radio[name=respuesta-12]:checked').val();
  var respuesta13 = $('input:radio[name=respuesta-13]:checked').val();
  var respuesta14 = $('input:radio[name=respuesta-14]:checked').val();
  var respuesta15 = $('input:radio[name=respuesta-15]:checked').val();
  var respuesta16 = $('input:radio[name=respuesta-16]:checked').val();
  var respuesta17 = $('input:radio[name=respuesta-17]:checked').val();
  var respuesta18 = $('input:radio[name=respuesta-18]:checked').val();
  var respuesta19 = $('input:radio[name=respuesta-19]:checked').val();
  var respuesta20 = $('input:radio[name=respuesta-20]:checked').val();
  var respuesta21 = $('input:radio[name=respuesta-21]:checked').val();
  var respuesta22 = $('input:radio[name=respuesta-22]:checked').val();
  var respuesta23 = $('input:radio[name=respuesta-23]:checked').val();
  var respuesta24 = $('input:radio[name=respuesta-24]:checked').val();
  var respuesta25 = $('input:radio[name=respuesta-25]:checked').val();
  var respuesta26 = $('input:radio[name=respuesta-26]:checked').val();
  var respuesta27 = $('input:radio[name=respuesta-27]:checked').val();
  var respuesta28 = $('input:radio[name=respuesta-28]:checked').val();
  var respuesta29 = $('input:radio[name=respuesta-29]:checked').val();
  var respuesta30 = $('input:radio[name=respuesta-30]:checked').val();
  var respuesta31 = $('input:radio[name=respuesta-31]:checked').val();
  var respuesta32 = $('input:radio[name=respuesta-32]:checked').val();
  var respuesta33 = $('input:radio[name=respuesta-33]:checked').val();
  var respuesta34 = $('input:radio[name=respuesta-34]:checked').val();
  var respuesta35 = $('input:radio[name=respuesta-35]:checked').val();
  var respuesta36 = $('input:radio[name=respuesta-36]:checked').val();

  if (respuesta1 != undefined) {
  $('.pregunta-1').css('border','');
  if (respuesta2 != undefined) {
  $('.pregunta-2').css('border','');
  if (respuesta3 != undefined) {
  $('.pregunta-3').css('border','');
  if (respuesta4 != undefined) {
  $('.pregunta-4').css('border','');
  if (respuesta5 != undefined) {
  $('.pregunta-5').css('border','');
  if (respuesta6 != undefined) {
  $('.pregunta-6').css('border','');
  if (respuesta7 != undefined) {
  $('.pregunta-7').css('border','');
  if (respuesta8 != undefined) {
  $('.pregunta-8').css('border','');
  if (respuesta9 != undefined) {
  $('.pregunta-9').css('border','');
  if (respuesta10 != undefined) {
  $('.pregunta-10').css('border','');
  if (respuesta11 != undefined) {
  $('.pregunta-11').css('border','');
  if (respuesta12 != undefined) {
  $('.pregunta-12').css('border','');
  if (respuesta13 != undefined) {
  $('.pregunta-13').css('border','');
  if (respuesta14 != undefined) {
  $('.pregunta-14').css('border','');
  if (respuesta15 != undefined) {
  $('.pregunta-15').css('border','');
  if (respuesta16 != undefined) {
  $('.pregunta-16').css('border','');
  if (respuesta17 != undefined) {
  $('.pregunta-17').css('border','');
  if (respuesta18 != undefined) {
  $('.pregunta-18').css('border','');
  if (respuesta19 != undefined) {
  $('.pregunta-19').css('border','');
  if (respuesta20 != undefined) {
  $('.pregunta-20').css('border','');
  if (respuesta21 != undefined) {
  $('.pregunta-21').css('border','');
  if (respuesta22 != undefined) {
  $('.pregunta-22').css('border','');
  if (respuesta23 != undefined) {
  $('.pregunta-23').css('border','');
  if (respuesta24 != undefined) {
  $('.pregunta-24').css('border','');
  if (respuesta25 != undefined) {
  $('.pregunta-25').css('border','');
  if (respuesta26 != undefined) {
  $('.pregunta-26').css('border','');
  if (respuesta27 != undefined) {
  $('.pregunta-27').css('border','');
  if (respuesta28 != undefined) {
  $('.pregunta-28').css('border','');
  if (respuesta29 != undefined) {
  $('.pregunta-29').css('border','');
  if (respuesta30 != undefined) {
  $('.pregunta-30').css('border','');
  if (respuesta31 != undefined) {
  $('.pregunta-31').css('border','');
  if (respuesta32 != undefined) {
  $('.pregunta-32').css('border','');
  if (respuesta33 != undefined) {
  $('.pregunta-33').css('border','');
  if (respuesta34 != undefined) {
  $('.pregunta-34').css('border','');
  if (respuesta35 != undefined) {
  $('.pregunta-35').css('border','');
  if (respuesta36 != undefined) {
  $('.pregunta-36').css('border','');

var parametros = {
      "accion" : "agregar-cuestionario-sasisopa",
      "Titulo1" : Titulo1,
      "Titulo2" : Titulo2,
      "Titulo3" : Titulo3,
      "Titulo4" : Titulo4,
      "Titulo5" : Titulo5,
      "Titulo6" : Titulo6,
      "Titulo7" : Titulo7,
      "Titulo8" : Titulo8,
      "Titulo9" : Titulo9,
      "Titulo10" : Titulo10,
      "Titulo11" : Titulo11,
      "Titulo12" : Titulo12,
      "Titulo13" : Titulo13,
      "Titulo14" : Titulo14,
      "Titulo15" : Titulo15,
      "Titulo16" : Titulo16,
      "Titulo17" : Titulo17,
      "Titulo18" : Titulo18,
      "Titulo19" : Titulo19,
      "Titulo20" : Titulo20,
      "Titulo21" : Titulo21,
      "Titulo22" : Titulo22,
      "Titulo23" : Titulo23,
      "Titulo24" : Titulo24,
      "Titulo25" : Titulo25,
      "Titulo26" : Titulo26,
      "Titulo27" : Titulo27,
      "Titulo28" : Titulo28,
      "Titulo29" : Titulo29,
      "Titulo30" : Titulo30,
      "Titulo31" : Titulo31,
      "Titulo32" : Titulo32,
      "Titulo33" : Titulo33,
      "Titulo34" : Titulo34,
      "Titulo35" : Titulo35,
      "Titulo36" : Titulo36,
      "respuesta1" : respuesta1,
      "respuesta2" : respuesta2,
      "respuesta3" : respuesta3,
      "respuesta4" : respuesta4,
      "respuesta5" : respuesta5,
      "respuesta6" : respuesta6,
      "respuesta7" : respuesta7,
      "respuesta8" : respuesta8,
      "respuesta9" : respuesta9,
      "respuesta10" : respuesta10,
      "respuesta11" : respuesta11,
      "respuesta12" : respuesta12,
      "respuesta13" : respuesta13,
      "respuesta14" : respuesta14,
      "respuesta15" : respuesta15,
      "respuesta16" : respuesta16,
      "respuesta17" : respuesta17,
      "respuesta18" : respuesta18,
      "respuesta19" : respuesta19,
      "respuesta20" : respuesta20,
      "respuesta21" : respuesta21,
      "respuesta22" : respuesta22,
      "respuesta23" : respuesta23,
      "respuesta24" : respuesta24,
      "respuesta25" : respuesta25,
      "respuesta26" : respuesta26,
      "respuesta27" : respuesta27,
      "respuesta28" : respuesta28,
      "respuesta29" : respuesta29,
      "respuesta30" : respuesta30,
      "respuesta31" : respuesta31,
      "respuesta32" : respuesta32,
      "respuesta33" : respuesta33,
      "respuesta34" : respuesta34,
      "respuesta35" : respuesta35,
      "respuesta36" : respuesta36      
      };

      $.ajax({
      data:  parametros,
      url:   '../app/controlador/MonitoreoVerificacionEvaluacionControlador.php',
      type:  'post',
      beforeSend: function() {
      
      },
      complete: function(){
      },
      success:  function (response) {

        console.log(response)
      
      ListaImplementacion();
      $('#myModal').modal('hide');
      alertify.success('Se guardo la información del cuestionario');

      }
      });

  }else{ $('.pregunta-36').css('border','2px solid #A52525'); Resultado();}
  }else{ $('.pregunta-35').css('border','2px solid #A52525'); Resultado();}
  }else{ $('.pregunta-34').css('border','2px solid #A52525'); Resultado();}
  }else{ $('.pregunta-33').css('border','2px solid #A52525'); Resultado();}
  }else{ $('.pregunta-32').css('border','2px solid #A52525'); Resultado();}
  }else{ $('.pregunta-31').css('border','2px solid #A52525'); Resultado();}
  }else{ $('.pregunta-30').css('border','2px solid #A52525'); Resultado();}
  }else{ $('.pregunta-29').css('border','2px solid #A52525'); Resultado();}
  }else{ $('.pregunta-28').css('border','2px solid #A52525'); Resultado();}
  }else{ $('.pregunta-27').css('border','2px solid #A52525'); Resultado();}
  }else{ $('.pregunta-26').css('border','2px solid #A52525'); Resultado();}
  }else{ $('.pregunta-25').css('border','2px solid #A52525'); Resultado();}
  }else{ $('.pregunta-24').css('border','2px solid #A52525'); Resultado();}
  }else{ $('.pregunta-23').css('border','2px solid #A52525'); Resultado();}
  }else{ $('.pregunta-22').css('border','2px solid #A52525'); Resultado();}
  }else{ $('.pregunta-21').css('border','2px solid #A52525'); Resultado();}
  }else{ $('.pregunta-20').css('border','2px solid #A52525'); Resultado();}
  }else{ $('.pregunta-19').css('border','2px solid #A52525'); Resultado();}
  }else{ $('.pregunta-18').css('border','2px solid #A52525'); Resultado();}
  }else{ $('.pregunta-17').css('border','2px solid #A52525'); Resultado();}
  }else{ $('.pregunta-16').css('border','2px solid #A52525'); Resultado();}
  }else{ $('.pregunta-15').css('border','2px solid #A52525'); Resultado();}
  }else{ $('.pregunta-14').css('border','2px solid #A52525'); Resultado();}
  }else{ $('.pregunta-13').css('border','2px solid #A52525'); Resultado();}
  }else{ $('.pregunta-12').css('border','2px solid #A52525'); Resultado();}
  }else{ $('.pregunta-11').css('border','2px solid #A52525'); Resultado();}
  }else{ $('.pregunta-10').css('border','2px solid #A52525'); Resultado();}
  }else{ $('.pregunta-9').css('border','2px solid #A52525'); Resultado();}
  }else{ $('.pregunta-8').css('border','2px solid #A52525'); Resultado();}
  }else{ $('.pregunta-7').css('border','2px solid #A52525'); Resultado();}
  }else{ $('.pregunta-6').css('border','2px solid #A52525'); Resultado();}
  }else{ $('.pregunta-5').css('border','2px solid #A52525'); Resultado();}
  }else{ $('.pregunta-4').css('border','2px solid #A52525'); Resultado();}
  }else{ $('.pregunta-3').css('border','2px solid #A52525'); Resultado();}
  }else{ $('.pregunta-2').css('border','2px solid #A52525'); Resultado();}
  }else{ $('.pregunta-1').css('border','2px solid #A52525'); Resultado();}

}

  function Resultado(){
  $('#resultado').html('<div class="mt-2"><div class="alert alert-danger" role="alert">No se puede completar el cuestionario revisa las preguntas</div></div>');
}


function BtnEditar(idDetalle){
let Fecha = $('#Fecha').val();

if (Fecha != "") {
$('#Fecha').css('border','');

var parametros = {
"accion" : "editar-implementacion-sa",
"idDetalle" : idDetalle,
"Fecha" : Fecha
};

      $.ajax({
      data:  parametros,
      url:   '../app/controlador/MonitoreoVerificacionEvaluacionControlador.php',
      type:  'post',
      beforeSend: function() {
      
      },
      complete: function(){
      },
      success:  function (response) {
      
      ListaImplementacion();
      $('#ModalDetalle').modal('hide');

      }
      });

}else{
$('#Fecha').css('border','2px solid #A52525');
}
}

  </script>
  </head>
  <body>

    <div class="LoaderPage"></div>
    <div class="fixed-top navbar-admin">
    <?php require('public/componentes/header.menu.php'); ?>
    </div>

    <div class="magir-top-principal">

    <div class="row no-gutters">
    <div class="col-12">
    <div class="card adm-card" style="border: 0;">
    <div class="adm-car-title">
      <div class="float-left" style="padding-right: 20px;margin-top: 5px;">
      <a onclick="regresarP()" style="cursor: pointer;" data-toggle="tooltip" data-placement="right" title="Regresar"><img src="<?php echo RUTA_IMG_ICONOS."regresar.png"; ?>"></a>
      </div>
    <div class="float-left"><h4>Implementación del SA</h4></div>
    <div class="float-right" style="margin-top: 6px;margin-left: 10px;">
    <a onclick="btnModal()" style="cursor: pointer;" data-toggle="tooltip" data-placement="left" title="Agregar" >
    <img src="<?php echo RUTA_IMG_ICONOS."agregar.png"; ?>">
    </a>
    </div>
      </div>
    <div class="card-body">
  
    <div id="ContenidoImplementacion"></div>
  
    </div>
    </div>
    </div>
    </div>
    </div>

  
<div class="modal fade bd-example-modal-lg" id="myModal" data-backdrop="static">
    <div class="modal-dialog modal-lg modal-dialog-centered" role="document" >

      <div class="modal-content" style="border-radius: 0px;border: 0px;">
        <div class="modal-header">
          <h4 class="modal-title">Implementación del SA</h4>
        </div>
        <div class="modal-body">

    <div class="text-center text-secondary font-weight-bold" style="font-size: 1.1em;">Lee detalladamente y contesta de manera honesta los siguientes cuestionamientos</div>

      <div class="row mt-3">
      
      <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 mb-3"> 
      <div class="p-3 car-admin">
      <div class="titulo-punto"><b class="text-success">1.</b> POLÍTICA</div>
      <hr>
      <!-- --- Pregunta numero 1 --- -->
      
      <div class="pregunta-1 p-2">
      <div id="Titulo-1" class="font-weight-bold">1. La empresa cuenta con una política documentada y autorizada por el Representante legal</div> 

      <div>
      <input type="radio" id="si-1" name="respuesta-1" value="1">
      <label for="si-1">Si</label>
      </div>

      <div>
      <input type="radio" id="no-1" name="respuesta-1" value="0">
      <label for="no-1">No</label>
      </div>
      </div>

      <!-- --- ----------------- --- -->
      <hr>
      <!-- --- Pregunta numero 2 --- -->
      <div class="pregunta-2 p-2">
      <div id="Titulo-2" class="font-weight-bold">2. La política fue comunicada a todo el personal interno, externo, clientes, prestadores de servicio etc</div> 

      <div>
      <input type="radio" id="si-2" name="respuesta-2" value="1">
      <label for="si-2">Si</label>
      </div>

      <div>
      <input type="radio" id="no-2" name="respuesta-2" value="0">
      <label for="no-2">No</label>
      </div>
      </div>
      <!-- --- ----------------- --- -->

      </div>
      </div>
      <!-- -- -- -- -- -- -- -- -- -- -- -- -->

      <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 mb-3"> 
      <div class="p-3 car-admin">
      <div class="titulo-punto"><b class="text-success">2.</b> ANÁLISIS DE RIESGO Y EVALUACIÓN DE IMPACTOS AMBIENTALES</div>
      <hr>
      <!-- --- Pregunta numero 3 --- -->
      <div class="pregunta-3 p-2">
      <div id="Titulo-3" class="font-weight-bold">3. Se tienen identificados los riesgos y peligros de la estación de servicio</div> 

      <div>
      <input type="radio" id="si-3" name="respuesta-3" value="1">
      <label for="si-3">Si</label>
      </div>

      <div>
      <input type="radio" id="no-3" name="respuesta-3" value="0">
      <label for="no-3">No</label>
      </div>
      </div>
      <!-- --- ----------------- --- -->
      <hr>
      <!-- --- Pregunta numero 4 --- -->
      <div class="pregunta-4 p-2">
      <div id="Titulo-4" class="font-weight-bold">4. Se tienen identificados los aspectos e impactos ambientales</div> 

      <div>
      <input type="radio" id="si-4" name="respuesta-4" value="1">
      <label for="si-4">Si</label>
      </div>

      <div>
      <input type="radio" id="no-4" name="respuesta-4" value="0">
      <label for="no-4">No</label>
      </div>
      </div>
      <!-- --- ----------------- --- -->

      </div>
      </div>
      <!-- -- -- -- -- -- -- -- -- -- -- -- -->

      <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 mb-3"> 
      <div class="p-3 car-admin">
      <div class="titulo-punto"><b class="text-success">3.</b> REQUISITOS LEGALES</div>
      <hr>
      <!-- --- Pregunta numero 5 --- -->
      <div class="pregunta-5 p-2">
      <div id="Titulo-5" class="font-weight-bold">5. Se cuenta con el listado de Requisitos legales aplicables a la empresa</div> 

      <div>
      <input type="radio" id="si-5" name="respuesta-5" value="1">
      <label for="si-5">Si</label>
      </div>

      <div>
      <input type="radio" id="no-5" name="respuesta-5" value="0">
      <label for="no-5">No</label>
      </div>
      </div>
      <!-- --- ----------------- --- -->
      <hr>
      <!-- --- Pregunta numero 6 --- -->
      <div class="pregunta-6 p-2">
      <div id="Titulo-6" class="font-weight-bold">6. Se cuenta y se tiene acceso a los requisitos legales de la empresa</div> 

      <div>
      <input type="radio" id="si-6" name="respuesta-6" value="1">
      <label for="si-6">Si</label>
      </div>

      <div>
      <input type="radio" id="no-6" name="respuesta-6" value="0">
      <label for="no-6">No</label>
      </div>
      </div>
      <!-- --- ----------------- --- -->

      </div>
      </div>
      <!-- -- -- -- -- -- -- -- -- -- -- -- -->

      <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 mb-3"> 
      <div class="p-3 car-admin">
      <div class="titulo-punto"><b class="text-success">4.</b> OBJETIVOS, METAS E INDICADORES</div>
      <hr>
      <!-- --- Pregunta numero 7 --- -->
      <div class="pregunta-7 p-2">
      <div id="Titulo-7" class="font-weight-bold">7. Se cuenta con objetivos, metas e indicadores claramente identificados</div> 

      <div>
      <input type="radio" id="si-7" name="respuesta-7" value="1">
      <label for="si-7">Si</label>
      </div>

      <div>
      <input type="radio" id="no-7" name="respuesta-7" value="0">
      <label for="no-7">No</label>
      </div>
      </div>
      <!-- --- ----------------- --- -->
      <hr>
      <!-- --- Pregunta numero 8 --- -->
      <div class="pregunta-8 p-2">
      <div id="Titulo-8" class="font-weight-bold">8. Se da seguimiento para la obtención de objetivos y metas</div> 

      <div>
      <input type="radio" id="si-8" name="respuesta-8" value="1">
      <label for="si-8">Si</label>
      </div>

      <div>
      <input type="radio" id="no-8" name="respuesta-8" value="0">
      <label for="no-8">No</label>
      </div>
      </div>
      <!-- --- ----------------- --- -->

      </div>
      </div>
      <!-- -- -- -- -- -- -- -- -- -- -- -- -->

      <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 mb-3"> 
      <div class="p-3 car-admin">
      <div class="titulo-punto"><b class="text-success">5.</b> FUNCIONES, RESPONSABILIDADES Y AUTORIDAD</div>
      <hr>
      <!-- --- Pregunta numero 9 --- -->
      <div class="pregunta-9 p-2">
      <div id="Titulo-9" class="font-weight-bold">9. Se conoce y tiene identificada la estructura orgánica de la empresa</div> 

      <div>
      <input type="radio" id="si-9" name="respuesta-9" value="1">
      <label for="si-9">Si</label>
      </div>

      <div>
      <input type="radio" id="no-9" name="respuesta-9" value="0">
      <label for="no-9">No</label>
      </div>
      </div>
      <!-- --- ----------------- --- -->
      <hr>
      <!-- --- Pregunta numero 10 --- -->
      <div class="pregunta-10 p-2">
      <div id="Titulo-10" class="font-weight-bold">10. Cada puesto conoce sus funciones y responsabilidades con respecto a la implementación del Sistema de Administración</div> 

      <div>
      <input type="radio" id="si-10" name="respuesta-10" value="1">
      <label for="si-10">Si</label>
      </div>

      <div>
      <input type="radio" id="no-10" name="respuesta-10" value="0">
      <label for="no-10">No</label>
      </div>
      </div>
      <!-- --- ----------------- --- -->

      </div>
      </div>
      <!-- -- -- -- -- -- -- -- -- -- -- -- -->

      <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 mb-3"> 
      <div class="p-3 car-admin">
      <div class="titulo-punto"><b class="text-success">6.</b> COMPETENCIA DEL PERSONAL, CAPACITACIÓN Y ENTRENAMIENTO</div>
      <hr>
      <!-- --- Pregunta numero 11 --- -->
      <div class="pregunta-11 p-2">
      <div id="Titulo-11" class="font-weight-bold">11. Se implementó de manera satisfactoria el programa de capacitación</div> 

      <div>
      <input type="radio" id="si-11" name="respuesta-11" value="1">
      <label for="si-11">Si</label>
      </div>

      <div>
      <input type="radio" id="no-11" name="respuesta-11" value="0">
      <label for="no-11">No</label>
      </div>
      </div>
      <!-- --- ----------------- --- -->
      <hr>
      <!-- --- Pregunta numero 12 --- -->
      <div class="pregunta-12 p-2">
      <div id="Titulo-12" class="font-weight-bold">12. Se capacito a todo el personal sobre aspectos básicos de la operación</div> 

      <div>
      <input type="radio" id="si-12" name="respuesta-12" value="1">
      <label for="si-12">Si</label>
      </div>

      <div>
      <input type="radio" id="no-12" name="respuesta-12" value="0">
      <label for="no-12">No</label>
      </div>
      </div>
      <!-- --- ----------------- --- -->

      </div>
      </div>
      <!-- -- -- -- -- -- -- -- -- -- -- -- -->

      <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 mb-3"> 
      <div class="p-3 car-admin">
      <div class="titulo-punto"><b class="text-success">7.</b> COMUNICACIÓN, PARTICIPACIÓN Y CONSULTA</div>
      <hr>
      <!-- --- Pregunta numero 13 --- -->
      <div class="pregunta-13 p-2">
      <div id="Titulo-13" class="font-weight-bold">13. Se implementó algún procedimiento interno para la comunicación.</div> 

      <div>
      <input type="radio" id="si-13" name="respuesta-13" value="1">
      <label for="si-13">Si</label>
      </div>

      <div>
      <input type="radio" id="no-13" name="respuesta-13" value="0">
      <label for="no-13">No</label>
      </div>
      </div>
      <!-- --- ----------------- --- -->
      <hr>
      <!-- --- Pregunta numero 14 --- -->
      <div class="pregunta-14 p-2">
      <div id="Titulo-14" class="font-weight-bold">14. Se implementó y dio seguimiento a la comunicación externa</div> 

      <div>
      <input type="radio" id="si-14" name="respuesta-14" value="1">
      <label for="si-14">Si</label>
      </div>

      <div>
      <input type="radio" id="no-14" name="respuesta-14" value="0">
      <label for="no-14">No</label>
      </div>
      </div>
      <!-- --- ----------------- --- -->

      </div>
      </div>
      <!-- -- -- -- -- -- -- -- -- -- -- -- -->

      <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 mb-3"> 
      <div class="p-3 car-admin">
      <div class="titulo-punto"><b class="text-success">8.</b> CONTROL DE DOCUMENTOS Y REGISTROS</div>
      <hr>
      <!-- --- Pregunta numero 15 --- -->
      <div class="pregunta-15 p-2">
      <div id="Titulo-15" class="font-weight-bold">15. Se cuenta con un control para la identificación de documentos y registros del SA</div> 

      <div>
      <input type="radio" id="si-15" name="respuesta-15" value="1">
      <label for="si-15">Si</label>
      </div>

      <div>
      <input type="radio" id="no-15" name="respuesta-15" value="0">
      <label for="no-15">No</label>
      </div>
      </div>
      <!-- --- ----------------- --- -->
      <hr>
      <!-- --- Pregunta numero 16 --- -->
      <div class="pregunta-16 p-2">
      <div id="Titulo-16" class="font-weight-bold">16. Se cuenta con un control para resguardar los documentos y registros del SA</div> 

      <div>
      <input type="radio" id="si-16" name="respuesta-16" value="1">
      <label for="si-16">Si</label>
      </div>

      <div>
      <input type="radio" id="no-16" name="respuesta-16" value="0">
      <label for="no-16">No</label>
      </div>
      </div>
      <!-- --- ----------------- --- -->

      </div>
      </div>
      <!-- -- -- -- -- -- -- -- -- -- -- -- -->

      <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 mb-3"> 
      <div class="p-3 car-admin">
      <div class="titulo-punto"><b class="text-success">9.</b> MEJORES PRÁCTICAS Y ESTÁNDARES</div>
      <hr>
      <!-- --- Pregunta numero 17 --- -->
      <div class="pregunta-17 p-2">
      <div id="Titulo-17" class="font-weight-bold">17. Identifica el listado de las mejores prácticas para el diseño y construcción</div> 

      <div>
      <input type="radio" id="si-17" name="respuesta-17" value="1">
      <label for="si-17">Si</label>
      </div>

      <div>
      <input type="radio" id="no-17" name="respuesta-17" value="0">
      <label for="no-17">No</label>
      </div>
      </div>
      <!-- --- ----------------- --- -->
      <hr>
      <!-- --- Pregunta numero 18 --- -->
      <div class="pregunta-18 p-2">
      <div id="Titulo-18" class="font-weight-bold">18. Identifica el listado de códigos y estándares para la etapa de operación y mantenimiento</div> 

      <div>
      <input type="radio" id="si-18" name="respuesta-18" value="1">
      <label for="si-18">Si</label>
      </div>

      <div>
      <input type="radio" id="no-18" name="respuesta-18" value="0">
      <label for="no-18">No</label>
      </div>
      </div>
      <!-- --- ----------------- --- -->

      </div>
      </div>
      <!-- -- -- -- -- -- -- -- -- -- -- -- -->

      <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 mb-3"> 
      <div class="p-3 car-admin">
      <div class="titulo-punto"><b class="text-success">10.</b> CONTROL DE ACTIVIDADES Y PROCESOS</div>
      <hr>
      <!-- --- Pregunta numero 19 --- -->
      <div class="pregunta-19 p-2">
      <div id="Titulo-19" class="font-weight-bold">19. Cuenta con procedimientos de seguridad, operación y mantenimiento</div> 

      <div>
      <input type="radio" id="si-19" name="respuesta-19" value="1">
      <label for="si-19">Si</label>
      </div>

      <div>
      <input type="radio" id="no-19" name="respuesta-19" value="0">
      <label for="no-19">No</label>
      </div>
      </div>
      <!-- --- ----------------- --- -->
      <hr>
      <!-- --- Pregunta numero 20 --- -->
      <div class="pregunta-20 p-2">
      <div id="Titulo-20" class="font-weight-bold">20. Las actividades de mantenimiento preventivo y correctivo se registran en bitácora de acuerdo al programa anual de mantenimiento</div> 

      <div>
      <input type="radio" id="si-20" name="respuesta-20" value="1">
      <label for="si-20">Si</label>
      </div>

      <div>
      <input type="radio" id="no-20" name="respuesta-20" value="0">
      <label for="no-20">No</label>
      </div>
      </div>
      <!-- --- ----------------- --- -->

      </div>
      </div>
      <!-- -- -- -- -- -- -- -- -- -- -- -- -->

      <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 mb-3"> 
      <div class="p-3 car-admin">
      <div class="titulo-punto"><b class="text-success">11.</b> INTEGRIDAD MECÁNICA Y ASEGURAMIENTO DE LA CALIDAD</div>
      <hr>
      <!-- --- Pregunta numero 21 --- -->
      <div class="pregunta-21 p-2">
      <div id="Titulo-21" class="font-weight-bold">21. Se cuenta con el listado de equipos críticos</div> 

      <div>
      <input type="radio" id="si-21" name="respuesta-21" value="1">
      <label for="si-21">Si</label>
      </div>

      <div>
      <input type="radio" id="no-21" name="respuesta-21" value="0">
      <label for="no-21">No</label>
      </div>
      </div>
      <!-- --- ----------------- --- -->
      <hr>
      <!-- --- Pregunta numero 20 --- -->
      <div class="pregunta-22 p-2">
      <div id="Titulo-22" class="font-weight-bold">22. Se conoce la razón del porque se le llama equipo critico</div> 

      <div>
      <input type="radio" id="si-22" name="respuesta-22" value="1">
      <label for="si-22">Si</label>
      </div>

      <div>
      <input type="radio" id="no-22" name="respuesta-22" value="0">
      <label for="no-22">No</label>
      </div>
      </div>
      <!-- --- ----------------- --- -->

      </div>
      </div>
      <!-- -- -- -- -- -- -- -- -- -- -- -- -->

      <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 mb-3"> 
      <div class="p-3 car-admin">
      <div class="titulo-punto"><b class="text-success">12.</b> SEGURIDAD DE CONTRATISTAS</div>
      <hr>
      <!-- --- Pregunta numero 23 --- -->
      <div class="pregunta-23 p-2">
      <div id="Titulo-23" class="font-weight-bold">23. Todos los trabajos catalogados como actividad altamente riesgosa fue autorizada previamente por el representante legal</div> 

      <div>
      <input type="radio" id="si-23" name="respuesta-23" value="1">
      <label for="si-23">Si</label>
      </div>

      <div>
      <input type="radio" id="no-23" name="respuesta-23" value="0">
      <label for="no-23">No</label>
      </div>
      </div>
      <!-- --- ----------------- --- -->
      <hr>
      <!-- --- Pregunta numero 24 --- -->
      <div class="pregunta-24 p-2">
      <div id="Titulo-24" class="font-weight-bold">24. A los trabajos de mantenimiento realizados por externos se realizan conforme a procedimiento y registros establecidos en el SA</div> 

      <div>
      <input type="radio" id="si-24" name="respuesta-24" value="1">
      <label for="si-24">Si</label>
      </div>

      <div>
      <input type="radio" id="no-24" name="respuesta-24" value="0">
      <label for="no-24">No</label>
      </div>
      </div>
      <!-- --- ----------------- --- -->

      </div>
      </div>
      <!-- -- -- -- -- -- -- -- -- -- -- -- -->

      <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 mb-3"> 
      <div class="p-3 car-admin">
      <div class="titulo-punto"><b class="text-success">13.</b> PREPARACIÓN Y RESPUESTA A EMERGENCIAS</div>
      <hr>
      <!-- --- Pregunta numero 25 --- -->
      <div class="pregunta-25 p-2">
      <div id="Titulo-25" class="font-weight-bold">25. Se conocen los procedimientos para atender emergencias</div> 

      <div>
      <input type="radio" id="si-25" name="respuesta-25" value="1">
      <label for="si-25">Si</label>
      </div>

      <div>
      <input type="radio" id="no-25" name="respuesta-25" value="0">
      <label for="no-25">No</label>
      </div>
      </div>
      <!-- --- ----------------- --- -->
      <hr>
      <!-- --- Pregunta numero 26 --- -->
      <div class="pregunta-26 p-2">
      <div id="Titulo-26" class="font-weight-bold">26. Los simulacros se realizaron y se evaluaron conforme al programa</div> 

      <div>
      <input type="radio" id="si-26" name="respuesta-26" value="1">
      <label for="si-26">Si</label>
      </div>

      <div>
      <input type="radio" id="no-26" name="respuesta-26" value="0">
      <label for="no-26">No</label>
      </div>
      </div>
      <!-- --- ----------------- --- -->

      </div>
      </div>
      <!-- -- -- -- -- -- -- -- -- -- -- -- -->

      <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 mb-3"> 
      <div class="p-3 car-admin">
      <div class="titulo-punto"><b class="text-success">14.</b> MONITOREO, VERIFICACIÓN Y EVALUACIÓN</div>
      <hr>
      <!-- --- Pregunta numero 27 --- -->
      <div class="pregunta-27 p-2">
      <div id="Titulo-27" class="font-weight-bold">27. Se cuenta con datos cualitativos y cuantitativos para identificar el cumplimiento de metas</div> 

      <div>
      <input type="radio" id="si-27" name="respuesta-27" value="1">
      <label for="si-27">Si</label>
      </div>

      <div>
      <input type="radio" id="no-27" name="respuesta-27" value="0">
      <label for="no-27">No</label>
      </div>
      </div>
      <!-- --- ----------------- --- -->
      <hr>
      <!-- --- Pregunta numero 28 --- -->
      <div class="pregunta-28 p-2">
      <div id="Titulo-28" class="font-weight-bold">28. Se propusieron actividades para la mejora continua</div> 

      <div>
      <input type="radio" id="si-28" name="respuesta-28" value="1">
      <label for="si-28">Si</label>
      </div>

      <div>
      <input type="radio" id="no-28" name="respuesta-28" value="0">
      <label for="no-28">No</label>
      </div>
      </div>
      <!-- --- ----------------- --- -->

      </div>
      </div>
      <!-- -- -- -- -- -- -- -- -- -- -- -- -->

      <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 mb-3"> 
      <div class="p-3 car-admin">
      <div class="titulo-punto"><b class="text-success">15.</b> AUDITORÍAS</div>
      <hr>
      <!-- --- Pregunta numero 29 --- -->
      <div class="pregunta-29 p-2">
      <div id="Titulo-29" class="font-weight-bold">29. Se realizan las auditorías internas conforme al programa</div> 

      <div>
      <input type="radio" id="si-29" name="respuesta-29" value="1">
      <label for="si-29">Si</label>
      </div>

      <div>
      <input type="radio" id="no-29" name="respuesta-29" value="0">
      <label for="no-29">No</label>
      </div>
      </div>
      <!-- --- ----------------- --- -->
      <hr>
      <!-- --- Pregunta numero 30 --- -->
      <div class="pregunta-30 p-2">
      <div id="Titulo-30" class="font-weight-bold">30. El personal interno atendió de manera satisfactoria la auditoria interna</div> 
      <div>
      <input type="radio" id="si-30" name="respuesta-30" value="1">
      <label for="si-30">Si</label>
      </div>

      <div>
      <input type="radio" id="no-30" name="respuesta-30" value="0">
      <label for="no-30">No</label>
      </div>
      </div>
      <!-- --- ----------------- --- -->

      </div>
      </div>
      <!-- -- -- -- -- -- -- -- -- -- -- -- -->

      <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 mb-3"> 
      <div class="p-3 car-admin">
      <div class="titulo-punto"><b class="text-success">16.</b> INVESTIGACIÓN DE INCIDENTES Y ACCIDENTES</div>
      <hr>
      <!-- --- Pregunta numero 31 --- -->
      <div class="pregunta-31 p-2">
      <div id="Titulo-31" class="font-weight-bold">31. Se conoce el cómo actuar para cada tipo de evento</div> 

      <div>
      <input type="radio" id="si-31" name="respuesta-31" value="1">
      <label for="si-31">Si</label>
      </div>

      <div>
      <input type="radio" id="no-31" name="respuesta-31" value="0">
      <label for="no-31">No</label>
      </div>
      </div>
      <!-- --- ----------------- --- -->
      <hr>
      <!-- --- Pregunta numero 32 --- -->
      <div class="pregunta-32 p-2">
      <div id="Titulo-32" class="font-weight-bold">32. Se realizó el registro de todos los accidentes ocurridos en el año inmediato anterior</div> 
      <div>
      <input type="radio" id="si-32" name="respuesta-32" value="1">
      <label for="si-32">Si</label>
      </div>

      <div>
      <input type="radio" id="no-32" name="respuesta-32" value="0">
      <label for="no-32">No</label>
      </div>
      </div>
      <!-- --- ----------------- --- -->

      </div>
      </div>
      <!-- -- -- -- -- -- -- -- -- -- -- -- -->

      <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 mb-3"> 
      <div class="p-3 car-admin">
      <div class="titulo-punto"><b class="text-success">17.</b> REVISIÓN DE RESULTADOS</div>
      <hr>
      <!-- --- Pregunta numero 33 --- -->
      <div class="pregunta-33 p-2">
      <div id="Titulo-33" class="font-weight-bold">33. Se conoce a detalle el ciclo de mejora continua</div> 

      <div>
      <input type="radio" id="si-33" name="respuesta-33" value="1">
      <label for="si-33">Si</label>
      </div>

      <div>
      <input type="radio" id="no-33" name="respuesta-33" value="0">
      <label for="no-33">No</label>
      </div>
      </div>
      <!-- --- ----------------- --- -->
      <hr>
      <!-- --- Pregunta numero 34 --- -->
      <div class="pregunta-34 p-2">
      <div id="Titulo-34" class="font-weight-bold">34. Se conoce y realizo el informe de revisión de resultados</div> 
      <div>
      <input type="radio" id="si-34" name="respuesta-34" value="1">
      <label for="si-34">Si</label>
      </div>

      <div>
      <input type="radio" id="no-34" name="respuesta-34" value="0">
      <label for="no-34">No</label>
      </div>
      </div>
      <!-- --- ----------------- --- -->

      </div>
      </div>

      <!-- -- -- -- -- -- -- -- -- -- -- -- -->

      <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 mb-3"> 
      <div class="p-3 car-admin">
      <div class="titulo-punto"><b class="text-success">18.</b> INFORMES DE DESEMPEÑO</div>
      <hr>
      <!-- --- Pregunta numero 35 --- -->
      <div class="pregunta-35 p-2">
      <div id="Titulo-35" class="font-weight-bold">35. Se comunicó a todo el personal los resultados de la evaluación de desempeño</div> 

      <div>
      <input type="radio" id="si-35" name="respuesta-35" value="1">
      <label for="si-35">Si</label>
      </div>

      <div>
      <input type="radio" id="no-35" name="respuesta-35" value="0">
      <label for="no-35">No</label>
      </div>
      </div>
      <!-- --- ----------------- --- -->
      <hr>
      <!-- --- Pregunta numero 36 --- -->
      <div class="pregunta-36 p-2">
      <div id="Titulo-36" class="font-weight-bold">36. Se entrega a la Agencia el informe de evaluación de desempeño del SA</div> 
      <div>
      <input type="radio" id="si-36" name="respuesta-36" value="1">
      <label for="si-36">Si</label>
      </div>

      <div>
      <input type="radio" id="no-36" name="respuesta-36" value="0">
      <label for="no-36">No</label>
      </div>
      </div>
      <!-- --- ----------------- --- -->

      </div>
      </div>





      </div>

      <div id="resultado"></div>



        </div>
        <div class="modal-footer">
           <button type="button" class="btn btn-secondary" style="border-radius: 0px;" data-dismiss="modal">Cancelar</button>
          <button type="button" class="btn btn-primary" style="border-radius: 0px;" onclick="btnGuardar()">Guardar</button>
        </div>
      </div>
    </div>
    </div>


<div class="modal fade bd-example-modal-lg" id="ModalDetalle" >
<div class="modal-dialog modal-lg modal-dialog-centered" role="document">
<div class="modal-content" style="border-radius: 0px;border: 0px;">
<div id="ContenidoDetalle"></div>
</div>
</div>
</div>



  <script src="<?php echo RUTA_JS ?>bootstrap.min.js"></script>
  </body>
  </html>
