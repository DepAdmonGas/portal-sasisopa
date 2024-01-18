<?php
require('app/help.php');

$sql_estaciones = "SELECT nombre FROM tb_estaciones WHERE id = '".$idEstacion."' ";
$result_estaciones = mysqli_query($con, $sql_estaciones);
$numero_estaciones = mysqli_num_rows($result_estaciones);
while($row_estaciones = mysqli_fetch_array($result_estaciones, MYSQLI_ASSOC)){
$estacion = $row_estaciones['nombre'];
}

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
  background: white;
  background: url('imgs/iconos/load-index-img.gif') 50% 50% no-repeat rgb(255,255,255);
  }

  .hovercolor:hover{
  background: rgba(0, 120, 238, .8) !important;
  }

  </style>
  <script type="text/javascript">
  $(document).ready(function(){
  $('[data-toggle="tooltip"]').tooltip();
  $(".LoaderPage").fadeOut("slow");
  ListaPersonalB('<?=$idEstacion;?>');
  ListaPersonalRDP('<?=$idEstacion;?>');
  ListaPersonalMPC('<?=$idEstacion;?>');

  });
  function regresarP(){
  window.location.href = '../administrador-sasisopa';
  }

  function ListaPersonalB(idEstacion){
  $('#ListaPersonalB').load('../public/administrador/vistas/lista-personal-bitacora.php?idEstacion=' + idEstacion);  
  }

  function BTNAcceso(idEstacion){
  $('#ModalAgregar').modal('show'); 
  $('#ContenidoModal').load('../public/administrador/vistas/modal-acceso-bitacora.php?idEstacion=' + idEstacion);

  }

  function BTNRecepcion(idEstacion){
  $('#ModalAgregar').modal('show'); 
  $('#ContenidoModal').load('../public/administrador/vistas/modal-acceso-recepcion.php?idEstacion=' + idEstacion);

  }

   function BTNMantenimiento(idEstacion){
  $('#ModalAgregar').modal('show'); 
  $('#ContenidoModal').load('../public/administrador/vistas/modal-acceso-mantenimiento.php?idEstacion=' + idEstacion);

  }
  //------------------------------------------------------------------------------------------------------------------

  function AccesoAplicacion(){
    var idUsuario = $('#idUsuario').val();

    if (idUsuario != "") {
    $('#idUsuario').css('border','');  

      var parametros = {
      "idUsuario": idUsuario
      };

  alertify.confirm('',
  function(){

  $.ajax({
   data:  parametros,
   url:   '../public/administrador/agregar/agregar-acceso-aplicacion.php',
   type:  'post',
   beforeSend: function() {

   },
   complete: function(){
   },
   success:  function (response) {
   ListaPersonalB('<?=$idEstacion;?>');
   $('#ModalAgregar').modal('hide'); 

   }
   });


  },
  function(){
  }).setHeader('Activar acceso').set({transition:'zoom',message: 'Desea activar el acceso al personal seleccionado',labels:{ok:'Aceptar', cancel: 'Cancelar'}}).show();

    }else{
    $('#idUsuario').css('border','2px solid #A52525');  
    }
  } 

  function EliminarPB(idUsuario){

     var parametros = {
      "idUsuario": idUsuario
      };

        alertify.confirm('',
  function(){

  $.ajax({
   data:  parametros,
   url:   '../public/administrador/eliminar/eliminar-acceso-aplicacion.php',
   type:  'post',
   beforeSend: function() {

   },
   complete: function(){
   },
   success:  function (response) {
   ListaPersonalB('<?=$idEstacion;?>');

   }
   });


  },
  function(){
  }).setHeader('Eliminar acceso').set({transition:'zoom',message: '¿Desea eliminar el acceso al personal seleccionado?',labels:{ok:'Aceptar', cancel: 'Cancelar'}}).show();

  }

  //------------------------------------------------------------------------------------------------------------------------

  function FirmaBitacora(idEstacion, categoria){
    var idUsuario = $('#idUsuario').val();

    if (idUsuario != "") {
    $('#idUsuario').css('border','');  

      var parametros = {
      "idEstacion" : idEstacion,
      "idUsuario" : idUsuario,
      "categoria" : categoria
      };

       alertify.confirm('',
  function(){

  $.ajax({
   data:  parametros,
   url:   '../public/administrador/agregar/agregar-acceso-trabajador.php',
   type:  'post',
   beforeSend: function() {

   },
   complete: function(){
   },
   success:  function (response) {
   ListaPersonalRDP('<?=$idEstacion;?>');
   ListaPersonalMPC('<?=$idEstacion;?>');
   $('#ModalAgregar').modal('hide'); 

   }
   });


  },
  function(){
  }).setHeader('Activar trabajadores autorizados)').set({transition:'zoom',message: 'Desea activar el acceso al trabajador seleccionado',labels:{ok:'Aceptar', cancel: 'Cancelar'}}).show();

    }else{
    $('#idUsuario').css('border','2px solid #A52525');  
    }
  }

  //-----------------------------------------------------------------------------------------------------------------------


  function ListaPersonalRDP(idEstacion){
    
    $('#ListaPersonalRDP').load('../public/administrador/vistas/lista-personal-autorizado.php?idEstacion=' + idEstacion + "&Categoria=RDP");  
  }

  
function ListaPersonalMPC(idEstacion){
  $('#ListaPersonalMPC').load('../public/administrador/vistas/lista-personal-autorizado.php?idEstacion=' + idEstacion + "&Categoria=MPC");  
  
}

function EliminarFirma(idFirma){

$('#ModalAgregar').modal('show'); 
  $('#ContenidoModal').load('../public/administrador/vistas/modal-detalle-trabajador.php?idFirma=' + idFirma);

} 

function EliminarAutorizacion(idFirma){

  var Comentarios = $('#Comentarios').val();

if (Comentarios != "") {
$('#Comentarios').css('border','');  

 var parametros = {
      "idFirma": idFirma,
      "Comentarios" : Comentarios
      };

alertify.confirm('',
  function(){

  $.ajax({
   data:  parametros,
   url:   '../public/administrador/eliminar/eliminar-firma-personal.php',
   type:  'post',
   beforeSend: function() {

   },
   complete: function(){
   },
   success:  function (response) {
   
   ListaPersonalRDP('<?=$idEstacion;?>');
   ListaPersonalMPC('<?=$idEstacion;?>');
   $('#ModalAgregar').modal('hide'); 

   }
   });


  },
  function(){
  }).setHeader('Eliminar acceso').set({transition:'zoom',message: '¿Desea eliminar el acceso al personal seleccionado?',labels:{ok:'Aceptar', cancel: 'Cancelar'}}).show();

}else{
$('#Comentarios').css('border','2px solid #A52525');  
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
    <div class="float-left"><h4><?=$estacion;?> (Configuración de Bitácoras) </h4></div>
    </div>
    <div class="card-body">

    <div class="text-center">
    <h4>Bitácora Dual De Operación:</h4>
    <h5>I.  Recepción y Descarga del Producto</h5>
    <h5>II. Mantenimiento Preventivo y Correctivo</h5>
    </div>

    <div class="row mt-4">
   
    <div class="col-12 col-md-4 mb-3">
      
      <div class="card">
        <h6 class="card-header">Personal con acceso a la aplicación <b>Bitácora AdmonGas</b></h6>
        <div class="card-body p-2">

        <div class="text-right pb-2" style="border-bottom: 1px solid #EDEDED;">
        <button type="button" class="btn btn-info btn-sm" style="border-radius: 0;font-size: .8em;" onclick="BTNAcceso(<?=$idEstacion;?>)">Agregar personal</button>
        </div>

        <div id="ListaPersonalB"></div>

         
        </div>
      </div>

      </div>

 
       <div class="col-12 col-md-4 mb-3">
      
      <div class="card">
        <h6 class="card-header">Recepción y Descarga del Producto <small>(Trabajadores autorizados)</small></h6>
        <div class="card-body p-2">

        <div class="text-right pb-2" style="border-bottom: 1px solid #EDEDED;">
        <button type="button" class="btn btn-info btn-sm" style="border-radius: 0;font-size: .8em;" onclick="BTNRecepcion(<?=$idEstacion;?>)">Agregar trabajador</button>
        </div>

        <div id="ListaPersonalRDP"></div>
         
        </div>
      </div>

      </div>

       <div class="col-12 col-md-4 mb-3">
      
      <div class="card">
        <h6 class="card-header">Mantenimiento Preventivo y Correctivo <small>(Trabajadores autorizados)</small></h6>
        <div class="card-body p-2">

        <div class="text-right pb-2" style="border-bottom: 1px solid #EDEDED;">
        <button type="button" class="btn btn-info btn-sm" style="border-radius: 0;font-size: .8em;" onclick="BTNMantenimiento(<?=$idEstacion;?>)">Agregar trabajador</button>
        </div>

        <div id="ListaPersonalMPC"></div>
         
        </div>
      </div>

      </div>
    </div>

 



    </div>
    </div>
    </div>
    </div>
    </div>

      <div class="modal fade bd-example-modal-lg" id="ModalAgregar" data-backdrop="static">
    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
      <div class="modal-content border-0 rounded-0" >
        <div id="ContenidoModal"></div>
      </div>
    </div>
    </div>


  <script src="<?php echo RUTA_JS ?>bootstrap.min.js"></script>
  </body>
  </html>
