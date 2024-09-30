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
  <link href="<?=RUTA_CSS ?>bootstrap.css" rel="stylesheet" />
  <link rel="stylesheet" href="<?=RUTA_CSS?>componentes.css">
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

  var year = new Date().getFullYear();
  ListaProgramaAnual(year,15);

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

   const btncompra = document.getElementById('btnGuardar');
   btncompra.disabled = true; 

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
        alertify.error('Error al eliminar')
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

  function Eliminar(id,year){

       var parametros = {
    "id" : id
    };


  alertify.confirm('',
  function(){


 $.ajax({
     data:  parametros,
     url:   'app/vistas/sgm/punto7/eliminar-programa-anual-verificacion.php',
     type:  'post',
     beforeSend: function() {
     },
     complete: function(){
    
     },
     success:  function (response) {

    if (response == 1) {
    ListaProgramaAnual(year,15);
    }else{
    alertify.error('Error al eliminar')
    }

     }
     });
    
  },
  function(){
  }).setHeader('Mensaje').set({transition:'zoom',message: '¿Desea eliminar la información seleccionada?',labels:{ok:'Aceptar', cancel: 'Cancelar'}}).show();

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
    <div class="float-left"><h4>Programa anual de verificación de equipos</h4></div>
    <div class="float-right">

     <a class="mr-2" onclick="modalBuscar(15)" style="cursor: pointer;" data-toggle="tooltip" data-placement="left" title="Buscar" >
    <img src="<?php echo RUTA_IMG_ICONOS."buscar-icono.png"; ?>">
    </a> 

    <a class="" onclick="modalNuevo(<?=$fecha_year;?>,15)" style="cursor: pointer;" data-toggle="tooltip" data-placement="left" title="Agregar" >
    <img src="<?php echo RUTA_IMG_ICONOS."agregar.png"; ?>">
    </a> 

    </div>
    </div>
   
    <div class="card-body">

      <div id="ListaProgramaAnual"></div>

    </div>
    
    </div>
    </div>
    </div>
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

