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
  <link href="<?php echo RUTA_CSS ?>bootstrap.css" rel="stylesheet" />
  <link rel="stylesheet" href="<?php echo RUTA_CSS ?>componentes.css">
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
  background: url('imgs/iconos/load-img.gif') 50% 50% no-repeat rgb(249,249,249);
}
  </style>
  <script type="text/javascript">
  $(document).ready(function(){
  $('[data-toggle="tooltip"]').tooltip();
  $(".LoaderPage").fadeOut("slow");

  ListaDetectorHumo();
  });

  function regresarP(){
  window.history.back();
  }

  function ListaDetectorHumo(){
  $('#DivContenido').load('app/vistas/sasisopa/elemento10/lista-detector-humo.php');
  }

  function ModalCrear(){
  $('#ModalCrear').modal('show');
  }

  function BtnAgregar(){

var NoDetector    =  $('#NoDetector').val();
var Ubicacion     =  $('#Ubicacion').val();

if (NoDetector != "") {
if (Ubicacion != "") {

        var parametros = {
      "accion" : "agregar-detector-humo",
        "NoDetector" : NoDetector,
        "Ubicacion" : Ubicacion
        };

        $.ajax({
        data:  parametros,
        url:   'app/controlador/ControlActividadProcesoControlador.php',
        type:  'post',
        beforeSend: function() {
        },
        complete: function(){
        },
        success:  function (response) {
        ListaDetectorHumo();
        $('#ModalCrear').modal('hide');    
        LimpiarCampos();    
        }
        });

}else{
$('#Ubicacion').css('border','2px solid #A52525');   
}
}else{
$('#NoDetector').css('border','2px solid #A52525');   
}
}

function LimpiarCampos(){
    $('#NoDetector').val('');
    $('#Ubicacion').val('');
  }

 
function Eliminar(id){

alertify.confirm('',
function(){

var parametros = {
"accion": "eliminar-detector-humo",
"id" : id
};

$.ajax({
data:  parametros,
url:   'app/controlador/ControlActividadProcesoControlador.php',
type:  'post',
beforeSend: function() {
},
complete: function(){
},
success:  function (response) {
    ListaDetectorHumo();
}
});


},
function(){
}).setHeader('Mensaje').set({transition:'zoom',message: 'Desea eliminar el detector de humo ',labels:{ok:'Aceptar', cancel: 'Cancelar'}}).show();

}

   </script>
  </head>
  <body>

    <div class="LoaderPage"></div>
    <div class="fixed-top navbar-admin">
    <?php require('public/componentes/header.menu.php'); ?>
    </div>

    <div class="magir-top-principal p-3">

    <div class="float-left" style="padding-right: 20px;margin-top: 5px;">
    <a onclick="regresarP()" style="cursor: pointer;" data-toggle="tooltip" data-placement="right" title="Regresar"><img src="<?php echo RUTA_IMG_ICONOS."regresar.png"; ?>"></a>
    </div>   
    <!-- TITULO / ENCABEZADO -->
    <div class="float-left">
    <h4>Configuración Detectores de Humo</h4>
    </div>
    <div class="float-right" style="margin-top: 6px;">
    <a onclick="ModalCrear()" style="cursor: pointer;" data-toggle="tooltip" data-placement="left" title="Agregar" >
    <img src="<?php echo RUTA_IMG_ICONOS."agregar.png"; ?>">
    </a>
    </div>
    <div class="mt-5 bg-white p-3">

    <div id="DivContenido"></div>

    </div>
    </div>

  <div class="modal fade bd-example-modal-lg" id="ModalCrear" >
  <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
  <div class="modal-content" style="border-radius: 0px;border: 0px;">
  <div class="modal-header">
  <h4 class="modal-title">Agregar Detector de Humo</h4>
  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
  <span aria-hidden="true">&times;</span>
  </button>
  </div>
  <div class="modal-body">

  <div class="row">

  <div class="col-12 mb-3">
  <label for="tipocomunicacion" class="text-secondary">No. Detector:</label>
  <input type="number" min="1" class="form-control rounded-0" id="NoDetector">
  </div>


  <div class="col-12 mb-3">
  <label for="tipocomunicacion" class="text-secondary">Ubicación: </label>
  <textarea rows="3" class="form-control rounded-0 " id="Ubicacion"></textarea>
  </div>

  </div>
  </div>

  <div class="modal-footer">
  <button type="button" class="btn btn-primary" style="border-radius: 0px;" onclick="BtnAgregar()">Agregar</button>
  </div>
  </div>
  </div>
  </div>

  <div class="modal fade bd-example-modal-lg" id="ModalEditar" >
  <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
  <div class="modal-content" style="border-radius: 0px;border: 0px;">
  <div id="DivEditar"></div>
  </div>
  </div>
  </div>

  <script src="<?php echo RUTA_JS ?>bootstrap.min.js"></script>
  </body>
  </html>
