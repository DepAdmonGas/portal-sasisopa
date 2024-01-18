<?php 
require('app/help.php');

?> 
 
<!DOCTYPE html>
<html lang="es">
  
  <head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
  <title>Portal AdmonGas</title>
  <meta name="description" content="">
  <meta name="viewport" content="width=device-width initial-scale=1.0">
  <link rel="shortcut icon" href="<?=RUTA_IMG_ICONOS?>/icono-web.ico">
  <link rel="apple-touch-icon" href="<?=RUTA_IMG_ICONOS?>/icono-web.ico">
  <link rel="stylesheet" href="<?=RUTA_CSS2 ?>alertify.css">
  <link rel="stylesheet" href="<?=RUTA_CSS2 ?>themes/default.rtl.css">
  <link href="<?=RUTA_CSS2;?>bootstrap.min.css" rel="stylesheet" />
  <link href="<?=RUTA_CSS2;?>navbar-general.min.css" rel="stylesheet" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
  <script type="text/javascript" src="<?=RUTA_JS2?>alertify.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.0/umd/popper.min.js"></script>
  <script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
  <script type="text/javascript" src="<?=RUTA_JS2 ?>alertify.js"></script>
  <link href="https://fonts.googleapis.com/css?family=Montserrat" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.7.0/animate.min.css">

  </head>
 
  <script type="text/javascript">
  $(document).ready(function($){
  $(".LoaderPage").fadeOut("slow");
 
  DatosUsuario();
  DatosPersonales();
  DatosFamiliares();
  FormacionAcademica();
  ExperienciaLaboral();
  ExperienciaEmpresa();
  });


  //---------- LISTADO DE ACTIVIDADES DEL PERSONAL ----------//
    function DatosUsuario(){
  $('#DivDatosUsuario').load('public/perfil/vistas/datos-usuario.php');  
  }


  function DatosPersonales(){
  $('#DivDatosPersonales').load('public/perfil/vistas/datos-personales.php');  
  }

  function DatosFamiliares(){
  $('#DivDatosFamiliares').load('public/perfil/vistas/datos-familiares.php');  
  }

  function FormacionAcademica(){
  $('#DivFormacionAcademica').load('public/perfil/vistas/formacion-academica.php');  
  }

  function ExperienciaLaboral(){
  $('#DivEsperenciaLaboral').load('public/perfil/vistas/experiencia-laboral.php');  
  }

  function ExperienciaEmpresa(){
  $('#DivExperenciaEmpresa').load('public/perfil/vistas/experiencia-empresa.php');  
  }

  </script>
 

  <body>

  <div class="LoaderPage"></div>

  <!---------- CONTENIDO DE PAGINA WEB ----------> 
  <div id="content">

  <!---------- NAV BAR (TOP) ---------->  
    <?php include_once "public/navbar/navbar-perfil.php";?>

  <div class="contendAG">     
  <div class="col-12 mb-2">

  <!---------- VISUALIZACION DE PERFIL DE USUARIO (VISTA) ---------->  
    <div id="DivDatosUsuario" class="cardAG mb-3"></div>
  <div id="DivDatosPersonales" class="cardAG mb-3"></div>
  <div id="DivDatosFamiliares" class="cardAG mb-3"></div>
  <div id="DivFormacionAcademica" class="cardAG mb-3"></div>
  <div id="DivEsperenciaLaboral" class="cardAG mb-3"></div>
  <div id="DivExperenciaEmpresa" class="cardAG mb-3"></div>

  </div>  

  </div>
  </div>
 
  <!---------- FUNCIONES - NAVBAR ---------->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/malihu-custom-scrollbar-plugin/3.1.5/jquery.mCustomScrollbar.concat.min.js"></script>
  

  <script src="<?=RUTA_JS2 ?>bootstrap.min.js"></script>

 
  </body>
  </html>

