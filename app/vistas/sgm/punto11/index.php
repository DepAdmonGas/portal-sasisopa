<?php
require('app/help.php');

function validaRegistro($id_estacion,$year,$con){

$sql_personal = "SELECT
sgm_autorizado.id_usuario,
sgm_autorizado.estado,
tb_usuarios.id_gas
FROM sgm_autorizado 
INNER JOIN tb_usuarios 
ON sgm_autorizado.id_usuario = tb_usuarios.id WHERE tb_usuarios.id_gas = '".$id_estacion."' AND sgm_autorizado.estado = 1 LIMIT 1";
$result_personal = mysqli_query($con, $sql_personal);
$numero_personal = mysqli_num_rows($result_personal);
if ($numero_personal > 0) {
$row_personal = mysqli_fetch_array($result_personal, MYSQLI_ASSOC);
$realizadopor = $row_personal['id_usuario'];
}else{
$realizadopor = 0;
}


$sql = "SELECT * FROM sgm_cumplimiento_objetivos_revision WHERE id_estacion = '".$id_estacion."' AND year = '".$year."' ";
$result = mysqli_query($con, $sql);
$numero = mysqli_num_rows($result);
if ($numero == 0) {

  $sql_insert = "INSERT INTO sgm_cumplimiento_objetivos_revision (
  id_estacion,
  year,
  fecha,
  hora,
  lugar,
  responsable,
  realizadopor,
  estado
  )
  VALUES (
  '".$id_estacion."',
  '".$year."',
  '',
  '',
  '',
  '',
  '".$realizadopor."',
  0
  )";
  mysqli_query($con, $sql_insert);

}
}

validaRegistro($Session_IDEstacion,$fecha_year,$con);

?> 
<html lang="es">
  <head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
  <title>SGM</title>
  <meta name="description" content="">
  <meta name="viewport" content="width=device-width initial-scale=1.0">
  <link rel="shortcut icon" href="<?=RUTA_IMG_ICONOS?>/icono-web.png">
  <link rel="apple-touch-icon" href="<?=RUTA_IMG_ICONOS?>/icono-web.png">
  <link rel="stylesheet" href="<?=RUTA_CSS?>alertify.css">
  <link rel="stylesheet" href="<?=RUTA_CSS?>themes/default.rtl.css">
  <link href="<?=RUTA_CSS ?>bootstrap.css" rel="stylesheet" />
  <link rel="stylesheet" href="<?=RUTA_CSS?>componentes.css">
  <link rel="stylesheet" href="<?=RUTA_CSS?>bootstrap-select.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.0/umd/popper.min.js"></script>
  <script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.13.2/jquery-ui.min.js"></script>
  <script type="text/javascript" src="<?=RUTA_JS?>alertify.js"></script>
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
  background: white;
  background: url('imgs/iconos/load-index-img.gif') 50% 50% no-repeat rgb(255,255,255);
  }
  </style>
  <script type="text/javascript">
  $(document).ready(function(){
  $('[data-toggle="tooltip"]').tooltip();
  $(".LoaderPage").fadeOut("slow");

  ListaEvaluacionCumplimiento();

  });

  function regresarP(){
  window.history.back();
  }

  function btnAyuda(){
  $('#myModal').modal('show');
  }

  function ListaEvaluacionCumplimiento(){
    $('#ListaEvaluacionCumplimiento').load('app/vistas/sgm/punto11/lista-evaluacion-cumplimiento.php');
  }

  function modalEditar(id){
  $('#modalEditar').modal('show');  
  $('#modalContenido').load('app/vistas/sgm/punto11/modal-editar-evaluacion-cumplimiento.php?id=' + id);    
  }

  function Editar(e,id,cate){

     var parametros = {
    "id" : id,
    "valor" : e.value,
    "cate" : cate
    };

   $.ajax({
     data:  parametros,
     url:   'app/vistas/sgm/punto11/editar-evaluacion-cumplimiento.php',
     type:  'post',
     beforeSend: function() {
     },
     complete: function(){
    
     },
     success:  function (response) {

     }
     });

  }

  function agregarAsistente(e,id,cate){

  var parametros = {
    "id" : id,
    "valor" : e.value,
    "cate" : cate
    };

   $.ajax({
     data:  parametros,
     url:   'app/vistas/sgm/punto11/editar-evaluacion-cumplimiento.php',
     type:  'post',
     beforeSend: function() {
     },
     complete: function(){
    
     },
     success:  function (response) {

      modalEditar(id)

     }
     });

  }

  function EliminarAsistente(e,id_asistente,cate){

    var parametros = {
    "id" : id_asistente,
    "valor" : 0,
    "cate" : cate
    };

   $.ajax({
     data:  parametros,
     url:   'app/vistas/sgm/punto11/editar-evaluacion-cumplimiento.php',
     type:  'post',
     beforeSend: function() {
     },
     complete: function(){
    
     },
     success:  function (response) {

      modalEditar(e)

     }
     });

  }

  function Finalizar(e,id,cate){

  alertify.confirm('',
  function(){

    var parametros = {
    "id" : id,
    "valor" : e,
    "cate" : cate
    };

   $.ajax({
     data:  parametros,
     url:   'app/vistas/sgm/punto11/editar-evaluacion-cumplimiento.php',
     type:  'post',
     beforeSend: function() {
     },
     complete: function(){
    
     },
     success:  function (response) {
      $('#modalEditar').modal('hide');  
      ListaEvaluacionCumplimiento();
     }
     });

 },
  function(){
  }).setHeader('Lista de asistencia').set({transition:'zoom',message: '¿Finalizar Cumplimiento de objetivos y revisión por la dirección?',labels:{ok:'Aceptar', cancel: 'Cancelar'}}).show();

  }

  function Descargar(id){
    window.location = "descargar-evaluacion-cumplimiento-sgm/" + id;
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
    <div class="float-left"><h4>11. Evaluación del cumplimiento de Objetivos y revisión por la Dirección</h4></div>
            <div class="float-right" style="margin-top: 6px;margin-left: 10px;">
    <a onclick="btnAyuda()" style="cursor: pointer;" data-toggle="tooltip" data-placement="left" title="Ayuda" >
    <img src="<?php echo RUTA_IMG_ICONOS."info.png"; ?>">
    </a> 
    </div>
    </div>
   
    <div class="card-body">

      <div id="ListaEvaluacionCumplimiento"></div>

    </div>
    </div>
    </div>
    </div>
    </div>

    <div class="modal fade bd-example-modal-lg" id="myModal" >
    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
      <div class="modal-content" style="border-radius: 0px;border: 0px;">
        <div class="modal-header">
          <h4 class="modal-title">Ayuda</h4>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
        </div>
        <div class="modal-body">

          <p>Bienvenido al elemento <b>11. EVALUACIÓN DEL CUMPLIMIENTO DE OBJETIVOS Y REVISIÓN POR LA DIRECCIÓN</b> una vez al año a partir del inicio de la implementación de Tu Sistema de Gestión de Medición realiza el registro del formato 021, donde deveras colocar los resultados de los indicadores establecidos en el elemento 4</p>

          <ol>
            <li>Implementación del SGM </li>
            <li>Calibración de equipos</li>
            <li>Satisfacción del cliente</li>
          </ol>
  
        <p>Derivado de los resultados obtenidos deberás identificar oportunidades de mejora, proponer junto con tu equipo acciones a tomar para mejorar los resultados y establecer los recursos necesarios para poder cumplir las metas. Haz de conocimiento al representante legal para que autorice las acciones y los recursos para la implementación</p> 
        <p>No olvides hacer de conocimiento a todo el personal y registrarlo en el formato 001</p>

      
        </div>
       </div>
    </div>
    </div>

    <div class="modal fade bd-example-modal-lg" id="modalEditar" data-backdrop="static">
    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
    <div class="modal-content" style="border-radius: 0px;border: 0px;">
    <div id="modalContenido"></div>
    </div>
    </div>
    </div>
 
  <script src="<?php echo RUTA_JS ?>bootstrap.min.js"></script>
  </body>
  </html>