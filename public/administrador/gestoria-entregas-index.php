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
  background: white;
  background: url('imgs/iconos/load-index-img.gif') 50% 50% no-repeat rgb(255,255,255);
  }
  .grayscale {
    filter: opacity(50%); 
  }
  </style>
  <script type="text/javascript">
  $(document).ready(function($){
  $(".LoaderPage").fadeOut("slow");
  ListaEntregas();
  });

  function regresarP(){
   window.history.back();
  }

  function ListaEntregas(){
    $('#ListaEntregas').load('public/administrador/vistas/lista-entregas.php');    
    }

  function ModalNuevo(){
    $('#ModalDetalle').modal('show');    
    $('#ContenidoModal').load('public/administrador/vistas/modal-agregar-entregas.php');
    }

    function Agregar(){
    let idEstacion = $('#idEstacion').val();
    let Destinatario = $('#Destinatario').val();

  if (idEstacion != "") {
  $('.selectize-input').css('border','');

  var parametros = {
    "idEstacion" : idEstacion,
    "Destinatario" : Destinatario
    };

    $.ajax({
    data:  parametros,
    url:   'public/administrador/agregar/agregar-entregas.php',
    type:  'post',
    beforeSend: function() {
    },
    complete: function(){
    },
    success:  function (response) {

    if(response != 0){
    window.location.href = 'gestoria-entregas-editar/' + response;
    }else{

    }

    }
    });

  }else{
  $('.selectize-input').css('border','2px solid #A52525');
  }
  }

  function Editar(id){
  window.location.href = 'gestoria-entregas-editar/' + id; 
  }

  function Eliminar(id){
  
  alertify.confirm('',
 function(){

  var parametros = {
      "id" : id
      };

  $.ajax({
   data:  parametros,
   url:   'public/administrador/eliminar/eliminar-entregas.php',
   type:  'post',
   beforeSend: function() {
   },
   complete: function(){
   },
   success:  function (response) {
    ListaEntregas()
   }
   });

    },
    function(){

    }).setHeader('Mensaje').set({transition:'zoom',message: 'Desea eliminar la entrega',labels:{ok:'Aceptar', cancel: 'Cancelar'}}).show(); 
  }

  function Descargar(id){
    window.location.href = 'gestoria-entregas-descargar/' + id;
  }

  function ModalBuscar(){
    $('#ModalDetalle').modal('show');    
    $('#ContenidoModal').load('public/administrador/vistas/modal-buscar-entregas.php');  
    }

function Buscar(){
    let BuEstacion = $('#BuEstacion').val(); 

      if (BuEstacion != "") {
  $('.BuEstacion').css('border','');

  var parametros = {
    "idEstacion" : BuEstacion
    };

    $.ajax({
   data:  parametros,
   url:   'public/administrador/vistas/lista-entregas-buscar.php',
   type:  'get',
   beforeSend: function() {
   },
   complete: function(){
   },
   success:  function (response) {
    $('#ListaEntregas').html(response); 
   }
   });

    $('#ModalDetalle').modal('hide'); 

  }else{
  $('.BuEstacion').css('border','2px solid #A52525');
  }
    }

  </script>
  </head>
  <body>

  <div class="LoaderPage"></div>
  <div class="fixed-top navbar-admin">
  <?php require('public/componentes/header.menu.php'); ?>
  </div>
  <div id="DivPrincipal">
  <div class="divcontenedor">
  <div class="divbody">
  <div class="magir-top-principal">

    <div class="magir-top-principal">

    <div class="row no-gutters">
    <div class="col-12">
    <div class="card adm-card" style="border: 0;">

    <div class="adm-car-title">
        <div class="float-left" style="padding-right: 20px;margin-top: 5px;">
        <a onclick="regresarP()" style="cursor: pointer;" data-toggle="tooltip" data-placement="right" title="Regresar"><img src="<?php echo RUTA_IMG_ICONOS."regresar.png"; ?>"></a>
        </div>
    <div class="float-left"><h4>Entregas</h4></div>

    <div class="float-right">
    <img src="<?php echo RUTA_IMG_ICONOS."agregar.png";?>" onclick="ModalNuevo()">
    </div>

    <?php if($Session_IDUsuarioBD == 60){ ?><?php } ?>
    <div class="float-right mr-2">
    <img src="<?php echo RUTA_IMG_ICONOS."buscar-icono.png";?>" onclick="ModalBuscar()">
    </div>

    </div>

    <div class="card-body">
    <div id="ListaEntregas"></div>
    </div>

    </div>
    </div>
    </div>

    </div>

</div>
</div>
</div>
</div>

  <div class="modal fade bd-example-modal-lg" id="ModalDetalle" >
  <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
  <div class="modal-content" style="border-radius: 0px;border: 0px;">
  <div id="ContenidoModal"></div>
  </div>
  </div>
  </div>

<script src="<?php echo RUTA_JS ?>bootstrap.min.js"></script>
</body>
</html>
