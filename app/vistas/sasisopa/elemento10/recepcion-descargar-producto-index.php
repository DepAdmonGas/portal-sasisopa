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
  opacity: .6;
  background: url('imgs/iconos/load-img.gif') 50% 50% no-repeat rgb(249,249,249);
}
  </style>
  <script type="text/javascript">
  $(document).ready(function(){
  $('[data-toggle="tooltip"]').tooltip();
  $(".LoaderPage").fadeOut("slow");
  ListaRecepcion();
  });

  function regresarP(){
  window.history.back();
  }

  function ListaRecepcion(){
  $('#Toltip').tooltip('hide')
  $('#DivContenido').load('app/vistas/sasisopa/elemento10/lista-recepcion-descarga-producto.php');  
  }

  function DetalleRecepcion(id){
  $('#ModalDetalle').modal('show'); 
  $('#DetalleRecepcion').load('app/vistas/sasisopa/elemento10/detalle-recepcion-descarga-producto.php?idRecepcion=' + id);   
  }

  function ModalBuscar(){
   $('#ModalBuscar').modal('show'); 
  }

  function Buscaryear(){
    var year = document.getElementById("selyear").value;

    if (year != "") {
      document.getElementById("selmes").disabled = false;

    }else{     
      document.getElementById("selmes").disabled = true;
      document.getElementById("selmes").value = "";
    }
   
  }

  function btnBuscar(){    
  var selyear = $('#selyear').val();
  var selmes = $('#selmes').val();

  if (selyear != "") {
  $('#selyear').css('border','');
  if (selmes != "") {
  $('#selmes').css('border','');

    FinBusqueda();

  }else{ $('#selmes').css('border','2px solid #A52525'); }
  }else{ $('#selyear').css('border','2px solid #A52525'); }

  }

  function FinBusqueda(){
  $(".LoaderPage").show();
  var selyear = $('#selyear').val();
  var selmes = $('#selmes').val();

     var parametros = {
    "selyear" : selyear,
    "selmes" : selmes
    };

    $.ajax({
     data:  parametros,
     url:   'app/vistas/sasisopa/elemento10/reporte-recepcion-descarga-producto.php',
     type:  'post',
     beforeSend: function() {

     },
     complete: function(){
      $('#ModalBuscar').modal('hide');
      $(".LoaderPage").hide();
     },
     success:  function (response) {

     $('#DivContenido').html(response); 

     }
     });
  }

  function downloada(url) {

$(".LoaderPage").show();

const a = document.createElement('a')
a.href = url
a.download = url.split('/').pop()
document.body.appendChild(a)
a.click()
document.body.removeChild(a)

var hasFocus=false;
var loaded = false;

window.onfocus = function() { 
  if (loaded) $(".LoaderPage").hide();
  hasFocus = true;
};

window.onblur = function() {
  if (hasFocus) $(".LoaderPage").hide();
  loaded = true;
};

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
    <h4>Recepción y Descarga del Producto</h4>
    </div>
    <div class="float-right" style="margin-top: 6px;margin-left: 10px;">
    <a onclick="ModalBuscar()" style="cursor: pointer;" data-toggle="tooltip" data-placement="left" title="Buscar" >
    <img src="<?php echo RUTA_IMG_ICONOS."buscar-icono.png"; ?>">
    </a>
    </div>
    <div class="mt-5 p-3 bg-white">
    <div id="DivContenido"></div>
    </div>

    </div>

    <div class="modal fade bd-example-modal-lg" id="ModalBuscar" data-backdrop="static">
    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
      <div class="modal-content" style="border-radius: 0px;border: 0px;">
        <div class="modal-header">
          <h4 class="modal-title">Buscar</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
        </div>
        <div class="modal-body">

          <div class="border p-3">

          <div class="mb-1"><small class="text-secondary">Año:</small></div>
          <select class="form-control rounded-0 mb-1" id="selyear" onchange="Buscaryear()">
            <option value="">Selecciona</option>
            <?php
            $inicio = 2020;
            $fin = date("Y");
            for ($i=$inicio; $i <= $fin; $i++) {               
              echo "<option>".$i."</option>";
            }
            ?>
          </select>           

          <div class="mb-1"><small class="text-secondary">Mes:</small></div>
          <div id="SelMes">
          <select class="form-control rounded-0 mb-1" id="selmes" disabled>
            <option value="">Selecciona</option>
            <option value="1">Enero</option>
            <option value="2">Febrero</option>
            <option value="3">Marzo</option>
            <option value="4">Abril</option>
            <option value="5">Mayo</option>
            <option value="6">Junio</option>
            <option value="7">Julio</option>
            <option value="8">Agosto</option>
            <option value="9">Septiembre</option>
            <option value="10">Octubre</option>
            <option value="11">Noviembre</option>
            <option value="12">Diciembre</option>
          </select>
          </div>

          </div>

        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-primary" style="border-radius: 0px;" onclick="btnBuscar()">Buscar</button>
        </div>
      </div>
    </div>
    </div>

        <div class="modal fade bd-example-modal-lg" id="ModalDetalle" data-backdrop="static">
    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
      <div class="modal-content" style="border-radius: 0px;border: 0px;">
        <div class="modal-header">
          <h4 class="modal-title">Detalle Recepción y Descarga del Producto</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
        </div>
        <div class="modal-body">

          <div id="DetalleRecepcion"></div>

        </div>
      </div>
    </div>
    </div>

  <script src="<?php echo RUTA_JS ?>bootstrap.min.js"></script>
  </body>
  </html>
