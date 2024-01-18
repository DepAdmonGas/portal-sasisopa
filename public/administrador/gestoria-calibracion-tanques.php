<?php
require('app/help.php');

$sql_estaciones = "SELECT nombre FROM tb_estaciones WHERE id = '".$idEstacion."' ";
$result_estaciones = mysqli_query($con, $sql_estaciones);
$numero_estaciones = mysqli_num_rows($result_estaciones);
while($row_estaciones = mysqli_fetch_array($result_estaciones, MYSQLI_ASSOC)){
$estacion = $row_estaciones['nombre'];
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
  background: white;
  background: url('../imgs/iconos/load-img.gif') 50% 50% no-repeat rgb(255,255,255);
  }

  .hovercolor:hover{
  background: rgba(0, 120, 238, .8) !important;
  }
  </style>
  <script type="text/javascript">
  $(document).ready(function(){
  $('[data-toggle="tooltip"]').tooltip();
  $(".LoaderPage").fadeOut("slow");

  Lista(<?=$idEstacion;?>);
  
  });
  function regresarP(){
  window.history.back();
  }

  function Lista(idEstacion){
  $('#DivLista').load('../public/administrador/vistas/lista-calibracion-tanques.php?idEstacion=' + idEstacion);
  }

  function Crear(idEstacion){
  
  var parametros = {
  "idEstacion" : idEstacion
  };

  $.ajax({
  data:  parametros,
  url:   '../public/administrador/agregar/agregar-calibracion-tanque.php',
  type:  'post',
  beforeSend: function() {
  $(".LoaderPage").show();
  },
  complete: function(){
  },
  success:  function (response) {

  window.location.href = '../gestoria-calibracion-tanques/' + idEstacion + '/' + response;
  
  }
  });
  }

  function Editar(idEstacion,idReporte){
  window.location.href = '../gestoria-calibracion-tanques/' + idEstacion + '/' + idReporte;
  }

  function Eliminar(idEstacion,id){

       var parametros = {
        "id" : id
        };

  alertify.confirm('',
    function(){

        $.ajax({
        data:  parametros,
        url:   '../public/administrador/eliminar/eliminar-calibracion-tanques.php',
        type:  'post',
        beforeSend: function() {
        },
        complete: function(){

        },
        success:  function (response) {

          if(response == 1){
          Lista(idEstacion)
          }else{
          alertify.error('Error al eliminar');    
          }

    }
     });

    },
    function(){
    }).setHeader('Documento').set({transition:'zoom',message: '¿Desea eliminar la siguiente calibración?',labels:{ok:'Aceptar', cancel: 'Cancelar'}}).show();
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
    <div class="float-left"><h4><?=$estacion;?> (Calibración de tanques) </h4></div>

    <div class="float-right" style="margin-top: 5px;">
    <a onclick="Crear(<?=$idEstacion;?>)" style="cursor: pointer;" data-toggle="tooltip" data-placement="right" title="Nuevo"><img src="<?php echo RUTA_IMG_ICONOS."agregar.png"; ?>"></a>
     </div>
    </div>

    <div class="card-body">

  <div id="DivLista"></div>

    </div>
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
