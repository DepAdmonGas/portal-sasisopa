<?php
require('app/help.php');
include_once "app/modelo/Ayuda.php";
include_once "app/modelo/ObjetivosMetasIndicadores.php";

$class_ayuda = new Ayuda();

$array_ayuda = $class_ayuda->sasisopaAyuda($Session_IDUsuarioBD,'agregar-experiencia-cliente');
$id_ayuda = $array_ayuda['id'];
$estado = $array_ayuda['estado'];
$IdReporte = $idReporte;

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
  background: url('../../imgs/iconos/load-img.gif') 50% 50% no-repeat rgb(249,249,249);
}

.card-hover:hover{
  background: rgba(247, 247, 247, .9);
  transition: all 1s ease;
}
  </style>
  <script type="text/javascript">
  $(document).ready(function(){
  $('[data-toggle="tooltip"]').tooltip();
  $(".LoaderPage").fadeOut("slow");
  <?php if ($id_ayuda != 0) {echo "btnAyuda();";} ?>
  BuscarEncuestados(<?=$IdReporte;?>);
  });
  function regresarP(){
  window.history.back();
  }

  function btnAyuda(){
  $('#ModalAyuda').modal('show');
  }

  function btnFinAyuda(idayuda, estado){
      var parametros = {
        "accion" : "actualizar-ayuda",
        "idayuda" : idayuda
      };

    if (idayuda != 0 && estado == 0) {
   $.ajax({
   data:  parametros,
   url:   '../../app/controlador/AyudaControlador.php',
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

function BuscarEncuestados(IdReporte){

var parametros = {
   "IdReporte" : IdReporte
   };

$.ajax({
  data:  parametros,
  url:   '../../app/vistas/sasisopa/elemento4/lista-cliente-encuentas.php',
  type:  'post',
  beforeSend: function() {
  },
  complete: function(){
  },
  success:  function (response) {

  $('#DivResultado').html(response);
  }
  });

}

function Detalle(id){
  $('#ModalDetalle').modal('show');
  DetalleEncuestado(id);
  }

  function DetalleEncuestado(id){
   var parametros = {
      "IdCliente" : id
      };  
   $.ajax({
    data:  parametros,
     url:   '../../app/vistas/sasisopa/elemento4/detalle-cliente-encuentas.php',
     type:  'post',
     beforeSend: function() {
     },
     complete: function(){
     },
     success:  function (response) {
     $('#DivContenidoModal').html(response);
     }
     });
 
  }

  function BtnAgregar(numCuestionario,IdReporte){

var Nombre = $('#Nombre').val();
var ToRespuestas = 0;

if (Nombre != "") {

$('#Nombre').css('border','');

  for (var i = 1; i <= numCuestionario; i++) {
  var respuesta = "sel-" + i;
  var respuesta = $('#sel-' + i).val();


  if (respuesta != 0) {
  $('#sel-' + i).css('border','');
  ToRespuestas = ToRespuestas + 1;
  }else{
  $('#sel-' + i).css('border','2px solid #A52525');
  }

  }

  if (numCuestionario == ToRespuestas) {

 var parametrosUsuario = {
  "accion" : "agregar-usuario-encuestas",
  "IdReporte" : IdReporte,
  "Nombre" : Nombre
  };

 $.ajax({
 data:  parametrosUsuario,
 url:   '../../app/controlador/ObjetivosMetasIndicadoresControlador.php',
 type:  'post',
 beforeSend: function() {
 },
 complete: function(){
 },
 success:  function (response) {
 enviarRespuestas(numCuestionario,response);
 }
 });

}

}else{
$('#Nombre').css('border','2px solid #A52525');
}

}

function enviarRespuestas(numCuestionario,response){

for (var i = 1; i <= numCuestionario; i++) {
var idpregunta = "pre-" + i;
var idpregunta = $('#pre-' + i).text();

var respuesta = "sel-" + i;
var respuesta = $('#sel-' + i).val();

  var parametros = {
  "accion" : "agregar-usuario-encuestas-resultados",
  "idusuario" : response,
  "idpregunta" : idpregunta,
  "respuesta" : respuesta
  };

  $.ajax({
   data:  parametros,
   url:   '../../app/controlador/ObjetivosMetasIndicadoresControlador.php',
   type:  'post',
   beforeSend: function() {
   },
   complete: function(){
   },
   success:  function (response) {
   }
   });


$('#sel-' + i).val('0')
}

var Comentario = $('#Comentario').val();

if (Comentario != "") {

  var parametrosComentario = {
    "accion" : "agregar-usuario-encuestas-comentario",
    "idusuario" : response,
    "comentario" : Comentario
  };

  $.ajax({
   data:  parametrosComentario,
   url:   '../../app/controlador/ObjetivosMetasIndicadoresControlador.php',
   type:  'post',
   beforeSend: function() {
   },
   complete: function(){
   },
   success:  function (response) {

    }
   });

}


$('#Nombre').val('');
$('#Comentario').val('');
alertify.success('Se agrego correctamente el cuestionario');
window.location.href = ''; 

  }

  function BtnFinalizar(IdReporte){

var Fecha = $('#Fecha').val();

alertify.confirm('',
function(){

 var parametros = {
  "accion" : "actualizar-encuesta-estacion",
  "IdReporte" : IdReporte,
  "Fecha" : Fecha
  };

$.ajax({
 data:  parametros,
 url:   '../../app/controlador/ObjetivosMetasIndicadoresControlador.php',
 type:  'post',
 beforeSend: function() {
 },
 complete: function(){
 },
 success:  function (response) {

  regresarP()
 }
 });


},
function(){
}).setHeader('Mensaje').set({transition:'zoom',message: 'Desea finalizar con el agregado de las encuestas ',labels:{ok:'Aceptar', cancel: 'Cancelar'}}).show();

}
function btnEliminar(IdReporte){

alertify.confirm('',
function(){

var parametros = {
  "accion" : "eliminar-encuesta-estacion",
 "IdReporte" : IdReporte
 };

$.ajax({
data:  parametros,
url:   '../../app/controlador/ObjetivosMetasIndicadoresControlador.php',
type:  'post',
beforeSend: function() {
},
complete: function(){
},
success:  function (response) {

regresarP()
}
});


},
function(){
}).setHeader('Mensaje').set({transition:'zoom',message: 'Desea eliminar el reporte ',labels:{ok:'Aceptar', cancel: 'Cancelar'}}).show();

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
    

    <!-- TITULO / ENCABEZADO -->
    <div class="float-left">
      <h4>Agregar experiencia del cliente</h4>
    </div>

    <div class="float-right" style="margin-top: 6px;margin-left: 10px;">

    <a onclick="btnAyuda()" style="text-decoration: none;cursor: pointer;margin-right: 10px;" data-toggle="tooltip" data-placement="left" title="Ayuda" >
    <img src="<?php echo RUTA_IMG_ICONOS."info.png"; ?>">
    </a>

    <a onclick="btnEliminar(<?=$IdReporte;?>)" style="cursor: pointer;" data-toggle="tooltip" data-placement="left" title="Eliminar Reporte" >
    <img src="<?php echo RUTA_IMG_ICONOS."eliminar.png"; ?>">
    </a>
    </div>
    </div>
    <div class="card-body">

      <?php

      $sql_encuestas = "SELECT fechacreacion FROM tb_encuentas_estacion WHERE id = '".$IdReporte."' ";
      $result_encuestas = mysqli_query($con, $sql_encuestas);
      while($row_encuestas = mysqli_fetch_array($result_encuestas, MYSQLI_ASSOC)){
      $date = $row_encuestas['fechacreacion'];
      $Explode = explode(" ", $date);
      $fecha = $Explode[0];
      }

      echo "<div class='text-secondary' style='font-size: 1.1em;'>Fecha:</div>";

      echo '<div class="row">

      <div class="col-xl-4 col-lg-4 col-md-4 col-sm-12">  

      <input type="date" class="form-control rounded-0" value="'.$fecha.'" id="Fecha"></div>
      </div>'
      ?>
      <hr>

       <div class="row">
        
        <!-- TABLA - CUESTIONARIO -->
        <div class="col-xl-7 col-lg-7 col-md-12 col-sm-12 mt-2 mb-2">  

          <div class="p-3 mb-2 bg-light text-dark font-weight-bold">Encuesta</div>

          <label><small class="text-secondary">Nombre:</small></label>
          <input type="text" class="form-control rounded-0" id="Nombre">
          <div class="font-weight-bold mt-1 mb-1" style="padding-top: 5px;padding-bottom: 5px;">Cuestionario:</div>

          <table class="table table-sm table-bordered table-striped" style="font-size: 1.1em;">
            <thead>
            <tr>
              <th>#</th>
              <th>Pregunta</th>
              <th>Respuesta</th>
            </tr>
            </thead>
            <tbody>
              <?php

              $sql_encuesta = "SELECT id FROM tb_encuestas WHERE estado = 1 LIMIT 1";
              $result_encuesta = mysqli_query($con, $sql_encuesta);
              while($row_encuesta = mysqli_fetch_array($result_encuesta, MYSQLI_ASSOC)){
              $Id = $row_encuesta['id'];

              $sql_cuestionario = "SELECT * FROM tb_encuentas_cuestionario ORDER BY num_pregunta";
              $result_cuestionario = mysqli_query($con, $sql_cuestionario);
              $numero_cuestionario = mysqli_num_rows($result_cuestionario);
              while($row_cuestionario = mysqli_fetch_array($result_cuestionario, MYSQLI_ASSOC)){
              $IdCuestionario = $row_cuestionario['id'];
              $numPregunta = $row_cuestionario['num_pregunta'];

              echo "<tr>";
              echo "<td class='text-center'><div id='pre-$numPregunta'>".$numPregunta."</div></td>";
              echo "<td>".$row_cuestionario['pregunta']."</td>";
              echo "<td style='padding: 0px;'>
              <select id='sel-$numPregunta' class='' style='width: 100%;padding: 2px;'>
              <option value='0'>SELECIONA</option>
              <option value='4'>Excelente</option>
              <option value='3'>Bueno</option>
              <option value='2'>Regular</option>
              <option value='1'>Malo</option>
              </select></td>";
              echo "</tr>";

              }
              }

              ?>
            </tbody>
          </table>

          <textarea class="form-control rounded-0" id="Comentario" rows="3" placeholder="Comentario"></textarea>

          <button type="button" class="btn btn-info rounded-0 p-2 mb-3 mt-2" style="width: 100%;margin-top: 5px;" onclick="BtnAgregar(<?=$numero_cuestionario;?>,<?=$IdReporte;?>)">Agregar encuesta</button>

        </div>


        <!-- TABLA - CUESTIONARIO -->
        <div class="col-xl-5 col-lg-5 col-md-12 col-sm-12">    

          <div class="p-3 mb-2 bg-light text-dark font-weight-bold">Lista encuestados</div>

          <div style="overflow-y: scroll;height: 422px;">
          <div id="DivResultado"></div>
          </div>

          <button type="button" id="btnfin" class="btn btn-success rounded-0 mt-2 p-2" style="width: 100%;margin-top: 5px;" onclick="BtnFinalizar(<?=$IdReporte;?>)">Finalizar encuestas</button>

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
      <h4 class="modal-title">Agregar experiencia del cliente</h4>
      </div>
      <div class="modal-body">

      <p class="text-justify" style="font-size: 1.1em">
      En esta sección deberás vaciar la información de cada una de las encuestas. Recuerda que para obtener datos estadísticamente verídicos por ningún motivo se deberá falsificar la información.
      </p>

      <div class="modal-footer">
      <button type="button" class="btn btn-primary" style="border-radius: 0px;" onclick="btnFinAyuda(<?=$id_ayuda;?>,<?=$estado;?>)">Aceptar</button>
      </div>
      </div>
    </div>
    </div>

  <script src="<?php echo RUTA_JS ?>bootstrap.min.js"></script>
  </body>
  </html>
