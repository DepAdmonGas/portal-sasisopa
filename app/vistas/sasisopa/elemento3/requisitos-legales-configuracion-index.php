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
  <link rel="shortcut icon" href="<?=RUTA_IMG_ICONOS?>/icono-web.png">
  <link rel="apple-touch-icon" href="<?=RUTA_IMG_ICONOS?>/icono-web.png">
  <link rel="stylesheet" href="<?=RUTA_CSS?>alertify.css">
  <link rel="stylesheet" href="<?=RUTA_CSS?>themes/default.rtl.css">
  <link rel="stylesheet" href="<?=RUTA_CSS ?>bootstrap.css" />
  <link rel="stylesheet" href="<?=RUTA_CSS?>componentes.css">
  <link rel="stylesheet" href="<?=RUTA_CSS?>bootstrap-select.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.7.0/animate.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/2.9.2/umd/popper.min.js"></script>
  <script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.13.2/jquery-ui.min.js"></script>
  <script type="text/javascript" src="<?=RUTA_JS?>alertify.js"></script>
  <link href="https://fonts.googleapis.com/css?family=Montserrat" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.7.0/animate.min.css">
  <link href="https://cdn.datatables.net/v/bs5/jszip-3.10.1/dt-2.0.3/b-3.0.1/b-colvis-3.0.1/b-html5-3.0.1/b-print-3.0.1/datatables.min.css" rel="stylesheet">
  <script src="https://cdnjs.cloudflare.com/ajax/libs/selectize.js/0.12.6/js/standalone/selectize.min.js" ></script>
  <link rel="stylesheet" href="<?php echo RUTA_CSS ?>selectize.css">
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
  .car-admin{
    border: 1px solid #eeeeee;box-shadow: 1px 1px 5px #EDEDED;border-bottom: 3px solid #3399cc;border-radius: 0;
  }
  .card-hover:hover{
    background: rgba(239, 239, 239, .3);
  }
  </style>
  <script type="text/javascript">
  $(document).ready(function(){
  $('[data-toggle="tooltip"]').tooltip();
  $(".LoaderPage").fadeOut("slow");

  RequisitosConfiguracion();
  });

  function regresarP(){
   window.history.back();
  }

  function RequisitosConfiguracion(){
  $('#RequisitosConfiguracion').load('app/vistas/sasisopa/elemento3/requisitos-legales-configuracion.php');
  } 

  function ModalPermiso(NG){
  $('#ModalConfiguracion').modal('show');
  $('#DivConfiguracion').load('app/vistas/sasisopa/elemento3/modal-agregar-requisito-legal-configuracion.php?NG=' + NG);
  }

  function AgregarRL(NG,MA){
  var Dependencia = $('#Dependencia').val();
  var Permiso = $('#Permiso').val();
  var Fundamento = $('#Fundamento').val();

  if (Permiso != "") {
  $('#Permiso').css('border','');
  if (Fundamento != "") {
  $('#Fundamento').css('border','');

alertify.confirm('',
function(){

 var parametros = {
  'accion' : 'agregar-requisito-legal-configuracion',
  'NG': NG,
  'MA': MA,
  'Dependencia': Dependencia,
  'Permiso' : Permiso,
  'Fundamento' : Fundamento
};

  $.ajax({
   data:  parametros,
   url:   'app/controlador/RequisitoLegalControlador.php',
   type:  'post',
   beforeSend: function() {
   },
   complete: function(){
   },
   success:  function (response) {

    if(response){
    RequisitosConfiguracion();
    $('#ModalConfiguracion').modal('hide');
    }else{
    alertify.error('Error al agregar el requisito legal'); 
    }
    
    }
    });

   },
function(){
}).setHeader('Mensaje').set({transition:'zoom',message: 'Desea agregar el siguiente requisito legal',labels:{ok:'Aceptar', cancel: 'Cancelar'}}).show();

  }else{
  $('#Fundamento').css('border','2px solid #A52525');
  }
  }else{
  $('#Permiso').css('border','2px solid #A52525');
  }

  }


  function EliminarRL(id){

alertify.confirm('',
function(){

   var parametros = {
    "accion" : "eliminar-requisito-legal-configuracion",
    "id" : id
  };

  $.ajax({
  data:  parametros,
  url:   'app/controlador/RequisitoLegalControlador.php',
  type:  'post',
  beforeSend: function() {
  },
  complete: function(){
  },
  success:  function (response) {

  if (response){
  RequisitosConfiguracion(); 
  }else{
  alertify.error('Error al eliminar');  
  }
  
  }
  });

   },
function(){
}).setHeader('Mensaje').set({transition:'zoom',message: 'Desea eliminar el siguiente requisito legal',labels:{ok:'Aceptar', cancel: 'Cancelar'}}).show();

 
  }

  </script>
  </head>
  <body>

    <div class="LoaderPage"></div>
    <div class="fixed-top navbar-admin">
    <?php require('app/vistas/componentes/navbar-perfil.php'); ?>
    </div>

    <!-- TITULO / ENCABEZADO -->
    <div class="magir-top-principal p-3">

    <!-- Inicio -->
    <div aria-label="breadcrumb" style="padding-left: 0; margin-bottom: 0;">
    <ol class="breadcrumb breadcrumb-caret">
    <li class="breadcrumb-item text-primary c-pointer" onclick="window.history.go(-2);"><i class="fa-solid fa-house"></i> SASISOPA</li>
    <li aria-current="page" class="breadcrumb-item c-pointer" onclick="regresarP()">3. REQUISITOS LEGALES</li>
    <li aria-current="page" class="breadcrumb-item active">REQUISITOS LEGALES CONFIGURACIÓN</li>
    </ol>
    </div>
    <!-- Fin -->

    <h3>REQUISITOS LEGALES CONFIGURACIÓN</h3>

    <div class="mt-2">
    <div id="RequisitosConfiguracion"></div>
    </div>
    </div>

  <div class="modal fade bd-example-modal-lg" id="ModalConfiguracion" >
  <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
  <div class="modal-content" style="border-radius: 0px;border: 0px;">
  <div id="DivConfiguracion"></div>
  </div>
  </div>
  </div>

  <script src="<?php echo RUTA_JS ?>bootstrap.min.js"></script>
  </body>
  </html>
