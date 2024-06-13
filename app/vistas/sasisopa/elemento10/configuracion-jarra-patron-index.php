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
  background: white;
  background: url('imgs/iconos/load-index-img.gif') 50% 50% no-repeat rgb(255,255,255);
  }
  .hovercolor:hover{
  background: rgba(0, 120, 238, .8) !important;
  }
  .cont-puntos{
    border-bottom: 3px solid #3399cc;
    box-shadow: 1px 1px 5px #EDEDED;
  }
  .titulo-punto{
    font-size: 1.25em;
  }
  </style>
  <script type="text/javascript">
  $(document).ready(function(){
  $('[data-toggle="tooltip"]').tooltip();
  $(".LoaderPage").fadeOut("slow");
  ListaJarra();
  });

  function regresarP(id){
  window.history.back();
  }

  function ListaJarra(){
  $('#ListaJarra').load('app/vistas/sasisopa/elemento10/lista-jarra-patron.php');
  }
  function btnAagregar(){
  $('#Modal').modal('show');
  }
  function btnGuardar(){
    let Marca = $('#Marca').val();
    let NoSerie = $('#NoSerie').val();
    let Capacidad = $('#Capacidad').val();
    let Material = $('#Material').val();

    if (Marca != "") {
    $('#Marca').css('border','');
    if (NoSerie != "") {
    $('#NoSerie').css('border','');
    if (Capacidad != "") {
    $('#Capacidad').css('border','');

    var parametros = {
        "accion" : "agregar-jarra-patron",
        "Marca" : Marca,
        "NoSerie" : NoSerie,
        "Capacidad" : Capacidad,
        "Material" : Material
        };

    alertify.confirm('',
    function(){

    $.ajax({
    data:  parametros,
    url:   'app/controlador/ControlActividadProcesoControlador.php',
    type:  'post',
    beforeSend: function() {
    },
    complete: function(){
    },
    success:  function (response) {

    if(response == 1){
    ListaJarra();
    $('#Marca').val('');
    $('#NoSerie').val('');
    $('#Capacidad').val('');
    $('#Material').val('');
    $('#Modal').modal('hide');
    }
    }
    });

    },
    function(){
    }).setHeader('Jarra').set({transition:'zoom',message: 'Desea agregar la jarra patron a la lista',labels:{ok:'Aceptar', cancel: 'Cancelar'}}).show();

    }else{
    $('#Capacidad').css('border','2px solid #A52525');
    }
    }else{
    $('#NoSerie').css('border','2px solid #A52525');
    }
    }else{
    $('#Marca').css('border','2px solid #A52525');
    }
  }
  function Eliminar(id){
    var parametros = {
    "accion" : "eliminar-jarra-patron",
    "idJarra" : id
    };

    alertify.confirm('',
    function(){

    $.ajax({
    data:  parametros,
    url:   'app/controlador/ControlActividadProcesoControlador.php',
    type:  'post',
    beforeSend: function() {
    },
    complete: function(){
    },
    success:  function (response) {

    if(response == 1){
    ListaJarra();
    }

    }
    });

    },
    function(){
    }).setHeader('Jarra').set({transition:'zoom',message: 'Desea eliminar la jarra patron de la lista',labels:{ok:'Aceptar', cancel: 'Cancelar'}}).show();
  }
  function Editar(id){
  $('#ModalEditar').modal('show');
  $('#DivEditar').load('app/vistas/sasisopa/elemento10/modal-editar-jarra-patron.php?idJarra=' + id);
  }  
  function BtnEditar(id){
    let EditMarca = $('#EditMarca').val();
    let EditNoSerie = $('#EditNoSerie').val();
    let EditCapacidad = $('#EditCapacidad').val();
    let EditMaterial = $('#EditMaterial').val();

    if (EditMarca != "") {
    if (EditNoSerie != "") {
    if (EditCapacidad != "") {
        
            var parametros = {
            "accion" : "editar-jarra-patron",
            "idJarra" : id,
            "EditMarca" : EditMarca,
            "EditNoSerie" : EditNoSerie,
            "EditCapacidad" : EditCapacidad,
            "EditMaterial" : EditMaterial
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
            ListaJarra();
            $('#ModalEditar').modal('hide');    
        
            }
            });

    }else{
    $('#EditCapacidad').css('border','2px solid #A52525');   
    }
    }else{
    $('#EditNoSerie').css('border','2px solid #A52525');   
    }
    }else{
    $('#EditMarca').css('border','2px solid #A52525');   
    }

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
    <div class="float-left"><h4>Configuración de Jarra patron</h4></div>
    <div class="float-right" style="margin-top: 6px;margin-left: 10px;">
    <a onclick="btnAagregar()" style="cursor: pointer;" data-toggle="tooltip" data-placement="left" title="Agregar" >
    <img src="<?php echo RUTA_IMG_ICONOS."agregar.png"; ?>">
    </a>
    </div>
    <div class="mt-5 p-3 bg-white">
    <div id="ListaJarra"></div>
    </div>
    </div>

<div class="modal fade bd-example-modal-lg" id="Modal" >
<div class="modal-dialog modal-lg modal-dialog-centered" role="document">
<div class="modal-content" style="border-radius: 0px;border: 0px;">

 <div class="modal-header">
   <h4 class="modal-title">Agregar Jarra patron</h4>
     <button type="button" class="close" data-dismiss="modal" aria-label="Close">
   <span aria-hidden="true">&times;</span>
 </button>
 </div>
 <div class="modal-body">

  <div class="row">

    
    <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 mt-2 mb-2 ">
      <small>* Marca:</small>
      <input type="text" class="form-control rounded-0 mt-2" id="Marca">
    </div>

    <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 mt-2 mb-2 ">
      <small>* No. Serie:</small>
      <input type="text" class="form-control rounded-0 mt-2" id="NoSerie">
    </div>

     <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 mt-2 mb-2 ">
      <small>* Capacidad:</small>
      <input type="text" class="form-control rounded-0 mt-2" id="Capacidad">
    </div>

    <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 mt-2 mb-2 ">
      <small>* Material de fabricación:</small>
      <input type="text" class="form-control rounded-0 mt-2" id="Material">
    </div>

  </div>

</div>
 
 <div class="modal-footer">
<button type="button" class="btn btn-primary rounded-0" onclick="btnGuardar()">Guardar</button>
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
