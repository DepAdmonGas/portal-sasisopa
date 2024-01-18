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

  ListaExtintores();
  });

  function regresarP(){
  window.history.back();
  }
 
  function ModalCrear(){
  $('#ModalCrear').modal('show');
  }

  function ListaExtintores(){
  $('#DivContenido').load('public/sasisopa/vistas/lista-extintores.php');
  }

  function BtnAgregar(){

  var NoExtintor    =  $('#NoExtintor').val();
  var Ubicacion     =  $('#Ubicacion').val();
  var FechaRecarga  =  $('#FechaRecarga').val();
  var TipoExtintor  =  $('#TipoExtintor').val();
  var Peso          =  $('#Peso').val();

  if (NoExtintor != "") {
  if (Ubicacion != "") {
    if (FechaRecarga != "") {
      if (TipoExtintor != "") {
        if (Peso != "") {

          var parametros = {
          "NoExtintor" : NoExtintor,
          "Ubicacion" : Ubicacion,
          "FechaRecarga" : FechaRecarga,
          "TipoExtintor" : TipoExtintor,
          "Peso" : Peso

          };

          $.ajax({
          data:  parametros,
          url:   'public/sasisopa/agregar/agregar-extintor.php',
          type:  'post',
          beforeSend: function() {
          },
          complete: function(){
          },
          success:  function (response) {
          ListaExtintores();
          $('#ModalCrear').modal('hide');    
          LimpiarCampos();    
          }
          });



        }else{
        $('#Peso').css('border','2px solid #A52525');   
        }
      }else{
      $('#TipoExtintor').css('border','2px solid #A52525');   
      }
    }else{
    $('#FechaRecarga').css('border','2px solid #A52525');   
    }
  }else{
  $('#Ubicacion').css('border','2px solid #A52525');   
  }
  }else{
  $('#NoExtintor').css('border','2px solid #A52525');   
  }

  }

  function LimpiarCampos(){
    $('#NoExtintor').val('');
    $('#Ubicacion').val('');
    $('#FechaRecarga').val('');
    $('#TipoExtintor').val('');
    $('#Peso').val(''); 
  }

  function EditarExtintor(id){

  $('#ModalEditar').modal('show');
  $('#DivEditar').load('public/sasisopa/vistas/modal-editar-extintores.php?idExtintor=' + id);

  }
  function EliminarExtintor(id){

        alertify.confirm('',
    function(){

     var parametros = {
      "idExtintor" : id
      };

   $.ajax({
     data:  parametros,
     url:   'public/sasisopa/eliminar/eliminar-extintor.php',
     type:  'post',
     beforeSend: function() {
     },
     complete: function(){
     },
     success:  function (response) {
      ListaExtintores();
     }
     });


   },
    function(){
    }).setHeader('Mensaje').set({transition:'zoom',message: 'Desea eliminar el extintor ',labels:{ok:'Aceptar', cancel: 'Cancelar'}}).show();

  }

  function BtnEditar(id){

  var NoExtintor    =  $('#EditNoExtintor').val();
  var Ubicacion     =  $('#EditUbicacion').val();
  var FechaRecarga  =  $('#EditFechaRecarga').val();
  var TipoExtintor  =  $('#EditTipoExtintor').val();
  var Peso          =  $('#EditPeso').val();

  if (NoExtintor != "") {
  if (Ubicacion != "") {
    if (FechaRecarga != "") {
      if (TipoExtintor != "") {
        if (Peso != "") {

          var parametros = {
          "idExtintor" : id,
          "NoExtintor" : NoExtintor,
          "Ubicacion" : Ubicacion,
          "FechaRecarga" : FechaRecarga,
          "TipoExtintor" : TipoExtintor,
          "Peso" : Peso

          };

          $.ajax({
          data:  parametros,
          url:   'public/sasisopa/actualizar/editar-extintor.php',
          type:  'post',
          beforeSend: function() {
          },
          complete: function(){
          },
          success:  function (response) {
          ListaExtintores();
          $('#ModalEditar').modal('hide');    
    
          }
          });

        }else{
        $('#EditPeso').css('border','2px solid #A52525');   
        }
      }else{
      $('#EditTipoExtintor').css('border','2px solid #A52525');   
      }
    }else{
    $('#EditFechaRecarga').css('border','2px solid #A52525');   
    }
  }else{
  $('#EditUbicacion').css('border','2px solid #A52525');   
  }
  }else{
  $('#EditNoExtintor').css('border','2px solid #A52525');   
  }

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
    

    <!-- TITULO / ENCABEZADO -->
    <div class="float-left">
      <h4>Configuración de Extintores</h4>
    </div>

     <div class="float-right" style="margin-top: 6px;">
    <a onclick="ModalCrear()" style="cursor: pointer;" data-toggle="tooltip" data-placement="left" title="Agregar" >
    <img src="<?php echo RUTA_IMG_ICONOS."agregar.png"; ?>">
    </a>
    </div>
    </div>
    <div class="card-body">

<div class="alert alert-warning" role="alert">
 Agrega los extintores con los que cuenta la estación, esta información es fundamental para el mantenimiento mensual.
</div>

<hr>

    <div id="DivContenido"></div>


    </div>
    </div>
    </div>
    </div>
    </div>

  <div class="modal fade bd-example-modal-lg" id="ModalCrear" >
  <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
  <div class="modal-content" style="border-radius: 0px;border: 0px;">
  <div class="modal-header">
  <h4 class="modal-title">Agregar Extintor</h4>
  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
  <span aria-hidden="true">&times;</span>
  </button>
  </div>
  <div class="modal-body">

  <div class="row">

  <div class="col-12 mb-3">
  <label for="tipocomunicacion" class="text-secondary">No. De extintor:</label>
  <input type="number" min="1" class="form-control rounded-0" id="NoExtintor">
  </div>


  <div class="col-12 mb-3">
  <label for="tipocomunicacion" class="text-secondary">Ubicación: </label>
  <textarea rows="3" class="form-control rounded-0 " id="Ubicacion"></textarea>
  </div>


  <div class="col-12 mb-3">
  <label for="tipocomunicacion" class="text-secondary">Fecha de ultima recarga: </label>
  <input type="date" class="form-control rounded-0" id="FechaRecarga">
  </div>


  <div class="col-12 mb-3">
  <label for="tipocomunicacion" class="text-secondary">Tipo de Extintor: </label>
  <input type="text" class="form-control rounded-0" id="TipoExtintor">
  </div>


  <div class="col-12 mb-2">
  <label for="tipocomunicacion" class="text-secondary">Peso Kg: </label>
  <input type="text" class="form-control rounded-0" id="Peso"> 
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
