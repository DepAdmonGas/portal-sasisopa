<?php
require('app/help.php');

$sql_sasisopa_ayuda = "SELECT * FROM pu_sasisopa_ayuda WHERE id_usuario = '".$Session_IDUsuarioBD."' and detalle = '2-analisis-riesgo-evaluacion-impactos-ambientales' and estado = 0 LIMIT 1";
$result_sasisopa_ayuda = mysqli_query($con, $sql_sasisopa_ayuda);
$numero_sasisopa_ayuda = mysqli_num_rows($result_sasisopa_ayuda);

if ($numero_sasisopa_ayuda == 1) {
while($row_ayuda = mysqli_fetch_array($result_sasisopa_ayuda, MYSQLI_ASSOC)){
$idAyuda = $row_ayuda['id'];
}
}else{
$idAyuda = 0;
}
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
  background: url('imgs/iconos/load-img.gif') 50% 50% no-repeat rgb(249,249,249);
}
  </style>
  <script type="text/javascript">
  $(document).ready(function(){
  $('[data-toggle="tooltip"]').tooltip();
  $(".LoaderPage").fadeOut("slow");
  <?php if ($numero_sasisopa_ayuda == 1) {echo "btnAyuda();";} ?>

  ListaAnalisis();
  ListaAsistencia(2);

  });
 
  function ListaAnalisis(){
    $('#DivListaAnalisis').load('public/sasisopa/vistas/lista-analisis-riesgo.php'); 
  }

  function regresarP(){
   window.history.back();
  }

  function btnAyuda(){
  $('#ModalAyuda').modal('show');
  }

    function btnFinAyuda(){

var puntosSasisopa = <?=$numero_sasisopa_ayuda;?>;

 var parametros = {
        "idAyuda" : <?=$idAyuda; ?>
      };

  if (puntosSasisopa != 0) {

   $.ajax({
   data:  parametros,
   url:   'public/sasisopa/actualizar/actualizar-ayuda.php',
   type:  'post',
   beforeSend: function() {
   },
   complete: function(){
   },
   success:  function (response) {
   $('#ModalAyuda').modal('hide');
   }
   });

  }else{
  $('#ModalAyuda').modal('hide');
  }
}

function ModalAnexos(id){
$('#Modal').modal('show');
  $('#DivModal').load('public/sasisopa/vistas/modal-anexos-analisis-riesgo.php?id=' + id); 
  
}

function ListaAsistencia(idSasisopa){
$('#DivListaAsistencia').load('public/sasisopa/vistas/lista-asistencia.php?idSasisopa=' + idSasisopa); 
}

  function btnAsistencia(){

  var parametros = {
   "PuntoSasisopa" : 2
   };

   $.ajax({
   data:  parametros,
   url:   'public/sasisopa/agregar/agregar-lista-asistencia.php',
   type:  'post',
   beforeSend: function() {
   },
   complete: function(){
   },
   success:  function (response) {

    if(response != 0){
      window.location = "lista-asistencia/" + response; 
    }else{
     alertify.error('Error al crear registro'); 
    }

  
   
   }
   });
  
   }

function EditarAsistencia(id){
window.location = "lista-asistencia/" + id; 
}

function EliminarAsistencia(id){

  var parametros = {
    "id" : id
    };

alertify.confirm('',
function(){
  $.ajax({
     data:  parametros,
     url:   'public/sasisopa/eliminar/eliminar-lista-asistencia.php',
     type:  'post',
     beforeSend: function() {
     },
     complete: function(){
    
     },
     success:  function (response) {

    if (response == 1) {
    ListaAsistencia(2)
    }else{
    alertify.error('Error al eliminar')
    }

     }
     });
},
function(){
}).setHeader('Lista de asistencia').set({transition:'zoom',message: '¿Desea eliminar la comunicación interna de la estación?',labels:{ok:'Aceptar', cancel: 'Cancelar'}}).show();
}

function DescargarAsistencia(id){
window.location = "descargar-lista-asistencia/" + id;   
}

function Formato2(){
window.location = "descargar-formato-2";  
}
function Formato3(){
window.location = "descargar-formato-3";
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

    <div class="float-left"><h4>2. IDENTIFICACIÓN DE PELIGROS Y ASPECTOS AMBIENTALES, ANÁLISIS DE RIESGO Y EVALUACIÓN DE IMPACTOS AMBIENTALES
    </h4>
    </div>

    <div class="float-right" style="margin-top: 6px;margin-left: 10px;">
    <a onclick="btnAyuda()" style="cursor: pointer;" data-toggle="tooltip" data-placement="left" title="Ayuda" >
    <img src="<?php echo RUTA_IMG_ICONOS."info.png"; ?>">
    </a>
    </div>

    </div>


    <div class="card-body">

      <div class="row">
      <div class="col-xl-3 col-lg-3 col-md-12 col-sm-12 mt-2 mb-2">
      <div class="border p-3">
        <h5>Identificación y evaluación de Aspectos e Impactos Ambientales.</h5>
        <div class="text-right mt-3"><button type="button" class="btn btn-primary" style="border-radius: 0px;" onclick="Formato2()">Descargar</button></div>
      </div>
      </div>  

      <div class="col-xl-3 col-lg-3 col-md-12 col-sm-12 mt-2 mb-2">
      <div class="border p-3">
        <h5>Identificación y evaluación de Riesgos y Peligros para registrar el análisis.</h5>
        <div class="text-right mt-3"><button type="button" class="btn btn-primary" style="border-radius: 0px;" onclick="Formato3()">Descargar</button></div>
      </div>
      </div>  
      </div>

      <h5 class="mt-3">Análisis de Riesgo del Sector Hidrocarburos (ARSH)</h5>

      <div class="mt-3" id="DivListaAnalisis"></div>

      <div class="row">
      <div class="col-xl-4 col-lg-4 col-md-12 col-sm-12 mt-2 mb-2">
      <div class="border">
      <div class="p-3">

        <div class="row">

            <div class="col-10">
            <h5>Fo.ADMONGAS.010 (Registro de la atención y el seguimiento a la comunicación interna y externa.)</h5>
            </div>
            
            <div class="col-2">
           
            <a class="float-right" onclick="btnAsistencia()" style="cursor: pointer;" data-toggle="tooltip" data-placement="left" title="Crear" >
            <img src="<?php echo RUTA_IMG_ICONOS."agregar.png"; ?>">
            </a>

            </div>
           </div>

          <div id="DivListaAsistencia"></div>

      </div>  
      </div>
      </div>
      </div>
 
    </div>
    </div>
    </div>
    </div>
    </div>

    <div class="modal fade bd-example-modal-lg" id="ModalAyuda" data-backdrop="static">
    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
      <div class="modal-content" style="border-radius: 0px;border: 0px;">
        <div class="modal-header">
          <h4 class="modal-title">Bienvenido al elemento 2. IDENTIFICACIÓN DE PELIGROS Y ASPECTOS AMBIENTALES, ANÁLISIS DE RIESGO Y EVALUACIÓN DE IMPACTOS AMBIENTALES, del Sistema de Administración</h4>
        </div>
        <div class="modal-body">

          <p class="text-justify" style="font-size: 1.1em">
           En este apartado podrás consultar las matrices para la identificación de aspectos e impactos ambientales así como la de Riesgos y peligros dela estación de servicio.
          </p>

          <hr>

          <label class="font-weight-bold" style="font-size: 1.1em">Como hacerlo:</label>
          <ul style="font-size: 1.1em">
            <li>Da clic en recuadro Identificación y evaluación de Aspectos e Impactos Ambientales para visualizar la matriz </li>
            <li>Da clic en el recuadro Identificación y evaluación de Riesgos y Peligros para registrar el análisis para visualizar la matriz</li>
          </ul>

          <hr>

          <label class="font-weight-bold" style="font-size: 1.1em">Responsables:</label>
          <p class="text-justify" style="font-size: 1.1em">Recuerda que es responsabilidad del <label class="text-danger font-weight-bold">Representante Técnico</label> (RT), <label class="text-danger font-weight-bold">Gerente de la Estación</label> dar a conocer los aspectos ambientales significativos a todo el personal de la estación de servicio puede ser mediante trípticos, capacitaciones o enviando comunicados mediante el elemento numero 7. COMUNICACIÓN, PARTICIPACIÓN Y CONSULTA.</p>

          <small>Nota:<br>
          Recuerda que para aquellos riesgos y peligros significativos se deben generar e implementar medidas de mitigación.
          </small>



        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-primary" style="border-radius: 0px;" onclick="btnFinAyuda()">Aceptar</button>
        </div>
      </div>
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
