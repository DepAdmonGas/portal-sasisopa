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
  <link rel="shortcut icon" href="<?=RUTA_IMG_ICONOS ?>/icono-web.png">
  <link rel="apple-touch-icon" href="<?=RUTA_IMG_ICONOS ?>/icono-web.png">
  <link rel="stylesheet" href="<?=RUTA_CSS2?>alertify.css">
  <link rel="stylesheet" href="<?=RUTA_CSS2?>themes/default.rtl.css">

  <link href="<?=RUTA_CSS2?>bootstrap.min.css" rel="stylesheet" />
  <link href="<?=RUTA_CSS2?>navbar-utilities.min.css" rel="stylesheet" />

  <script src="<?=RUTA_JS2?>size-window.js"></script>

  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css">

  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.0/umd/popper.min.js"></script>
  <script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
  <script type="text/javascript" src="<?=RUTA_JS2?>alertify.js"></script>

  <link href="https://fonts.googleapis.com/css?family=Montserrat" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.7.0/animate.min.css">




  <script type="text/javascript">
  $(document).ready(function(){
  $('[data-toggle="tooltip"]').tooltip();
  $(".LoaderPage").fadeOut("slow");

  Detalle();
  });
 
  function Detalle(){
    $('#DivDetalle').load('public/administrador/vistas/detalle-administrador.php');
  }

function rootnoticias(){
  window.location.href = 'administrador-noticias';
}

  function BTNRequisitos(id){
  window.location.href = 'gestoria-requisitos-legales/'+id;
  }

  function BTNReporteCre(id){
  window.location.href = 'gestoria-reporte-estadistico-cre/'+id;
  }

  function BTNBitacoras(id){
  window.location.href = 'gestoria-bitacoras-configuracion/'+id;
  }

function BTNMantenimiento(id){

  window.location.href = 'gestoria-programa-mantenimiento/'+id;

}

function BTNnom(id){
  window.location.href = 'gestoria-nom-035/'+id;
}

function BTNcambioprecio(id){
window.location.href = 'cambio-precio/'+id;
}

function BTNAnalisis(id){
window.location.href = 'gestoria-analisis-riesgo/'+id;
}

function rootrequisitos(){
window.location.href = 'gestoria-requisitos-legales/';  
}

function SASISOPA(id){
$('#ModalSasisopa').modal('show'); 
  $('#DivSasisopa').load('public/administrador/vistas/modal-consulta-sasisopa.php?idEstacion=' + id); 
} 

 
function GuardarSasisopa(id){

    var data = new FormData();
    var url = 'public/administrador/agregar/agregar-sasisopa.php';
    var version = $('#version').val();

    documento = document.getElementById("documento");
    documento_file = documento.files[0];
    documento_filePath = documento.value;

  if(version != ""){
  $('#version').css('border','');
  if(documento_filePath != ""){
  $('#documento').css('border','');

    data.append('idEstacion', id);
    data.append('version', version);
    data.append('documento_file', documento_file);

    $(".LoaderPage").show();

    $.ajax({
    url: url,
    type: 'POST',
    contentType: false,
    data: data,
    processData: false,
    cache: false
    }).done(function(data){

    if(data == 1){
    $(".LoaderPage").hide();
    $('#DivSasisopa').load('public/administrador/vistas/modal-consulta-sasisopa.php?idEstacion=' + id);
     
     }else{
      $(".LoaderPage").hide();
      alertify.error('Error al agregar'); 
     }
     

    }); 

  }else{
  $('#documento').css('border','2px solid #A52525'); 
  }
  }else{
  $('#version').css('border','2px solid #A52525'); 
  }

}

function Eliminar(id,idEstacion){

var parametros = {
  "id" : id
  };

 alertify.confirm('',
 function(){

  $.ajax({
  data:  parametros,
  url:   'public/administrador/eliminar/eliminar-sasisopa.php',
  type:  'post',
  beforeSend: function() {
  $(".LoaderPage").show();
  },
  complete: function(){
  },
  success:  function (response) {

  if (response == 1){
  $(".LoaderPage").hide();
  $('#DivSasisopa').load('public/administrador/vistas/modal-consulta-sasisopa.php?idEstacion=' + idEstacion); 
  }else{
  $(".LoaderPage").hide();
  alertify.error('Error al eliminar');  
  }
  
  }
  });

  },
 function(){

 }).setHeader('Mensaje').set({transition:'zoom',message: '¿Desea eliminar la información seleccionada?',labels:{ok:'Aceptar', cancel: 'Cancelar'}}).show();

}

function rootpermisos(){
 window.location.href = 'gestoria-permisos';  
}

function rootfirmaapoderado(){
window.location.href = 'gestoria-firma-apoderado';  
}

function BTNCalibracion(id){
window.location.href = 'gestoria-calibracion-tanques/'+id;
}

  </script>
  </head>
  
  <body>

    <div class="LoaderPage"></div>

  <div class="wrapper">
  
  <nav id="sidebar">
  <div class="sidebar-header text-center">
  <img class="" src="<?=RUTA_IMG_LOGOS."Logo.png";?>" style="width: 100%;">
  </div>

  <ul class="list-unstyled components">

  <li >
  <a class="pointer" href="<?=PORTAL_HOME?>">
  <i class="fa-solid fa-house" aria-hidden="true" style="padding-right: 10px;"></i>Portal
  </a>
  </li>

    <?php if($Session_IDUsuarioBD == 60){ ?>
  <li>
  <a class="pointer" onclick="rootrequisitos()">
   <i class="fa-solid fa-file" aria-hidden="true" style="padding-right: 10px;"></i>Requisitos Legales
  </a>
  </li>
  <?php } ?>

  <?php if($Session_IDUsuarioBD == 60){ ?>
  <li>
  <a class="pointer" onclick="rootfirmaapoderado()">
   <i class="fa-solid fa-pen-nib" aria-hidden="true" style="padding-right: 10px;"></i>Firma apoderado
  </a>
  </li>
  <?php } ?>

  <li>
  <a class="pointer" onclick="rootpermisos()">
  <i class="fa-solid fa-file" aria-hidden="true" style="padding-right: 10px;"></i>Mis permisos
  </a>
  </li>

  <?php if($Session_IDUsuarioBD == 60){ ?>
  <li>
  <a class="pointer" onclick="rootnoticias()">
  <i class="fa-solid fa-newspaper" aria-hidden="true" style="padding-right: 10px;"></i>Noticias
  </a>
  </li>
  <?php } ?>  
  </ul>

  </nav>

  
  <!---------- DIV - CONTENIDO ----------> 
  <div id="content">
  <!---------- NAV BAR - PRINCIPAL (TOP) ---------->  
  <?php include_once "public/navbar/navbar-principal.php";?>
  <!---------- CONTENIDO PAGINA WEB----------> 
  <div class="contendAG">
  <div class="row">  

  <div class="col-12 mb-3">
  <div id="DivDetalle" class="cardAG"></div>

  </div>


  </div>
  </div>

  </div>

  </div>





  <div class="modal fade bd-example-modal-md" id="ModalSasisopa" data-backdrop="static">
  <div class="modal-dialog modal-md modal-dialog-centered" >
  <div class="modal-content">
  <div class="modal-header">
    <h5 class="modal-title">CONSULTA TU SASISOPA</h5>
    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
  </div>

  <div class="modal-body">

  <div id="DivSasisopa"></div>

  </div>
  </div> 
  </div>
  </div>

  <!---------- FUNCIONES - NAVBAR ---------->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/malihu-custom-scrollbar-plugin/3.1.5/jquery.mCustomScrollbar.concat.min.js"></script>
  <script src="<?=RUTA_JS2?>navbar-functions.js"></script>

  <script src="<?=RUTA_JS2?>bootstrap.min.js"></script>

  </body>
  </html>
