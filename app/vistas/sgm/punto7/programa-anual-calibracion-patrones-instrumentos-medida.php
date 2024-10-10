<?php
require('app/help.php');
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
  <link rel="stylesheet" href="<?=RUTA_CSS ?>bootstrap.css" />
  <link rel="stylesheet" href="<?=RUTA_CSS?>componentes.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.7.0/animate.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/2.9.2/umd/popper.min.js"></script>
  <script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.13.2/jquery-ui.min.js"></script>
  <script type="text/javascript" src="<?=RUTA_JS?>alertify.js"></script>
  <link href="https://fonts.googleapis.com/css?family=Montserrat" rel="stylesheet">
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

  var year = new Date().getFullYear();
  ListaProgramaAnual(year,14);

  });

  function regresarP(){
  window.history.back();
  }

  function ListaProgramaAnual(year,formato){
  $('#ListaProgramaAnual').load('app/vistas/sgm/punto7/lista-programa-anual-calibracion.php?year=' + year + '&formato=' + formato);
  }

  function modalNuevo(year,formato){
    $('#modalPrincipal').modal('show');  
  $('#modalContenido').load('app/vistas/sgm/punto7/modal-agregar-programa-calibracion.php?year=' + year + '&formato=' + formato);
  }

  function Guardar(year,formato){

    let IdEquipo = $('#IdEquipo').val();
    let Fecha = $('#Fecha').val();

    if (IdEquipo != "") {
    $('#IdEquipo').css('border','');
    if (Fecha != "") {
    $('#Fecha').css('border','');

    var parametrosUsuario = {
      "IdEquipo" : IdEquipo,
      "Fecha" : Fecha
      };

    $.ajax({
     data:  parametrosUsuario,
     url:   'app/vistas/sgm/punto7/agregar-programa-calibracion.php',
     type:  'post',
     beforeSend: function() {
     },
     complete: function(){
     },
     success:  function (response) {

      if(response == 1){

        ListaProgramaAnual(year,formato);
        $('#modalPrincipal').modal('hide');

      }else{
        alertify.error('Error al agregar')
      }

     }
     });

    }else{
    $('#Fecha').css('border','2px solid #A52525'); 
    } 
    }else{
    $('#IdEquipo').css('border','2px solid #A52525'); 
    } 

  }

  function DescargarProgramaAnual(year,formato){

    window.location = "descargar-programa-anual-sgm/" + year + "/" + formato;

  }

  function modalBuscar(formato){
  $('#modalPrincipal').modal('show');  
  $('#modalContenido').load('app/vistas/sgm/punto7/modal-buscar-programa-calibracion.php?formato=' + formato);
  }

  function Buscar(formato){

    let Year = $('#Year').val();
    if (Year != "") {
    $('#Year').css('border','');

    $('#modalPrincipal').modal('hide');  
    ListaProgramaAnual(Year,formato);

    }else{
    $('#Year').css('border','2px solid #A52525'); 
    } 

  }

  </script>
  </head>
  <body>
    <div class="LoaderPage"></div>

    <div class="fixed-top navbar-admin">
    <?php require('app/vistas/componentes/navbar-perfil.php'); ?>
    </div>

    <div class="magir-top-principal p-3">

      <!-- Inicio -->
      <div class="float-end">
      <div class="dropdown dropdown-sm d-inline ms-2">
      <button type="button" class="btn dropdown-toggle btn-primary" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
      <i class="fa-solid fa-screwdriver-wrench"></i></span>
      </button>
      <ul class="dropdown-menu">
      <li onclick="modalNuevo(<?=$fecha_year;?>,14)"><a class="dropdown-item c-pointer"> <i class="fa-solid fa-plus"></i> Agregar</a></li>
      <li onclick="modalBuscar(14)"><a class="dropdown-item c-pointer"> <i class="fa-solid fa-magnifying-glass"></i> Buscar</a></li>
      </ul>
      </div>
      </div>
      <!-- Fin -->

      <!-- Inicio -->
      <div aria-label="breadcrumb" style="padding-left: 0; margin-bottom: 0;">
      <ol class="breadcrumb breadcrumb-caret">
      <li class="breadcrumb-item text-primary c-pointer" onclick="window.history.go(-2);"><i class="fa-solid fa-house"></i> SGM</li>
      <li aria-current="page" class="breadcrumb-item c-pointer" onclick="regresarP()">7. Procesos de medición</li>
      <li aria-current="page" class="breadcrumb-item active">Programa anual de calibración de patrones e instrumentos de medida</li>
      </ol>
      </div>
      <!-- Fin -->

      <h3>Programa anual de calibración de patrones e instrumentos de medida</h3>

      <div class="bg-white p-3 mt-3"><div id="ListaProgramaAnual"></div></div>
    </div>

    <div class="modal fade bd-example-modal-lg" id="modalPrincipal" data-backdrop="static">
    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
    <div class="modal-content" style="border-radius: 0px;border: 0px;">
    <div id="modalContenido"></div>
    </div>
    </div>
    </div>
 
  <script src="<?php echo RUTA_JS ?>bootstrap.min.js"></script>
  </body>
  </html>

