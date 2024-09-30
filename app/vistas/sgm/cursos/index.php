<?php
require('app/help.php');

?>
<html lang="es">
  <head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
  <title>GestoLine</title>
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
  background: url('imgs/iconos/load-index-img.gif') 50% 50% no-repeat rgb(255,255,255);
  }

  .icon {
    width: 40px;
    height: 40px;
    background-color: #eee;
    border-radius: 15px;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 20px
}
  .bg-icon{
background-color: #eee;
}
.color-disabled {
  color: #215d98;
}

.card-menuB {
border-bottom: 3px solid #5d84c3; 
border-top: 0;
border-right: 0;
border-left: 0;
padding: 8px;
}
  </style>
  <script type="text/javascript">
  $(document).ready(function($){
  $(".LoaderPage").fadeOut("slow");

  listaCursos();
  listaPendientes();

  }); 

    function regresarP(){
  window.history.back();
  }

function listaCursos(){
  $('#DivListaCursos').load('app/vistas/sgm/cursos/lista-cursos.php');    
  }

  function listaPendientes(){
  $('#DivListaCursosPersonal').load('app/vistas/sgm/cursos/lista-temas-pendientes.php');    
  }

  function detalleModulo(idModulo){
  window.location.href = "cursos-temas/" + idModulo;  
  }

  function IniciarTema(id){
  window.location.href = "cursos-temas-iniciar/" + id; 

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

  <div class="float-left"><h4>CURSOS</h4></div>
  </div>
  <div class="card-body">

  <!---------- VISUALIZACION DE CURSOS (VISTA) ---------->  
  <div id="DivListaCursos" class="cardAG"></div>

  <div id="DivListaCursosPersonal" class="cardAG"></div>

  </div>
  </div>
  </div>
  </div>

  </div>


  <script src="<?php echo RUTA_JS ?>bootstrap.min.js"></script>
  </body>
  </html>
