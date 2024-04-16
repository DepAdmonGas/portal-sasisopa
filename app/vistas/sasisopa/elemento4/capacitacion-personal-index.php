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
  <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
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

.card-hover:hover{
  background: rgba(247, 247, 247, .9);
  transition: all 1s ease;
  cursor: pointer;
}

  </style>
  <script type="text/javascript">
  $(document).ready(function(){
  $('[data-toggle="tooltip"]').tooltip();
  $(".LoaderPage").fadeOut("slow");

  CapacitacionPersonal(<?=$fecha_year;?>);
  });
  function regresarP(){
   window.history.back();
  }

  function CapacitacionPersonal(BuscarYear){
  $('#DivListaCapacitacion').load('../app/vistas/sasisopa/elemento4/lista-capacitacion-personal.php?Year=' + BuscarYear);  
  }

  function ModalBuscar(){
  $('#ModalBuscar').modal('show');
  }

  function btnBuscar(){

let BuscarYear = $('#BuscarYear').val();

if (BuscarYear != "") {
$('#BuscarYear').css('border','');

CapacitacionPersonal(BuscarYear)
$('#ModalBuscar').modal('hide');

}else{
$('#BuscarYear').css('border','2px solid #A52525');
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
    <div class="float-left"><h4>Capacitación del personal</h4></div>
    <div class="float-right" style="margin-top: 6px;margin-left: 10px;">
    <a onclick="ModalBuscar()" style="cursor: pointer;" data-toggle="tooltip" data-placement="left" title="Buscar" >
    <img src="<?php echo RUTA_IMG_ICONOS."buscar-icono.png"; ?>">
    </a>
    </div>
    
    </div>
  
    <div class="card-body">

     <div id="DivListaCapacitacion"></div>

    </div>
    </div>
    </div>
    </div>
    </div>

        <div class="modal fade bd-example-modal-lg" id="ModalBuscar" data-backdrop="static">
    <div class="modal-dialog modal-sm modal-dialog-centered" role="document">
      <div class="modal-content" style="border-radius: 0px;border: 0px;">
        <div class="modal-header">
          <h5 class="modal-title">Buscar</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
        </div>
        <div class="modal-body">

        <div class="form-group">
         <label class="text-secondary" >Agregar Año: </label>
         <input type="text" class="form-control" name="" id="BuscarYear" style="border-radius: 0px;">
         </div>
        </div>

        <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal" style="border-radius: 0px;">Cancelar</button>
        <button type="button" class="btn btn-primary" style="border-radius: 0px;" onclick="btnBuscar()">Buscar</button>
        </div>
      </div>
    </div>
    </div>

    <script src="<?php echo RUTA_JS ?>bootstrap.min.js"></script>
    </body>
    </html>
