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
  ListaPersonalRDP();
  ListaPersonalMPC();
  });

  function regresarP(){
  window.history.back();
  }


function ListaPersonalRDP(){
    
    $('#ListaPersonalRDP').load('public/sasisopa/vistas/lista-personal-autorizado.php?Categoria=RDP');  
  }

  
function ListaPersonalMPC(){
  $('#ListaPersonalMPC').load('public/sasisopa/vistas/lista-personal-autorizado.php?Categoria=MPC');  
  
}

//------------------------------------------------
function BTNRecepcion(){
  $('#ModalAgregar').modal('show'); 
  $('#ContenidoModal').load('public/sasisopa/vistas/modal-acceso-recepcion.php');

  }

   function BTNMantenimiento(){
  $('#ModalAgregar').modal('show'); 
  $('#ContenidoModal').load('public/sasisopa/vistas/modal-acceso-mantenimiento.php');

  }

 //------------------------------------------------------------------------------------------------------------------------

  function FirmaBitacora(categoria){
    var idUsuario = $('#idUsuario').val();

    if (idUsuario != "") {
    $('#idUsuario').css('border','');  

      var parametros = {
      "idUsuario" : idUsuario,
      "categoria" : categoria
      };

       alertify.confirm('',
  function(){

  $.ajax({
   data:  parametros,
   url:   'public/sasisopa/agregar/agregar-acceso-trabajador.php',
   type:  'post',
   beforeSend: function() {

   },
   complete: function(){
   },
   success:  function (response) {
   ListaPersonalRDP();
   ListaPersonalMPC();
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


function DetalleFirma(idFirma){

  $('#ModalAgregar').modal('show'); 
  $('#ContenidoModal').load('public/sasisopa/vistas/modal-detalle-personal-autorizado.php?idFirma=' + idFirma);

   
}

function BTNEliminarA(idFirma){

  var Comentario = $('#Comentario').val();

  if (Comentario != "") {
    $('#Comentario').css('border',''); 

var parametros = {
      "idFirma": idFirma,
      "Comentario" : Comentario
      };

        alertify.confirm('',
  function(){

  $.ajax({
   data:  parametros,
   url:   'public/sasisopa/eliminar/eliminar-firma-personal.php',
   type:  'post',
   beforeSend: function() {

   },
   complete: function(){
   },
   success:  function (response) {
   
   ListaPersonalRDP();
   ListaPersonalMPC();
   $('#ModalAgregar').modal('hide'); 

   }
   });


  },
  function(){
  }).setHeader('Eliminar acceso').set({transition:'zoom',message: 'Desea eliminar el acceso al personal seleccionado',labels:{ok:'Aceptar', cancel: 'Cancelar'}}).show();

  }else{
    $('#Comentario').css('border','2px solid #A52525'); 
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
      <h4>Configuración de bitácoras</h4>
    </div>

    <div class="float-right" style="margin-top: 6px;margin-left: 10px;">
 
    </div>
    </div>
    <div class="card-body">


  <div class="text-center">
    <h4>Bitácora Dual De Operación:</h4>
    <h5>I.  Recepción y Descarga del Producto</h5>
    <h5>II. Mantenimiento Preventivo y Correctivo</h5>
    </div>

    
    <div class="row justify-content-md-center row-cols-md-4 mt-4">
       
       <!-- CARD - RECUPERACION Y DESCARGA -->
      <div class="col-xl-4 col-lg-4 col-md-6 col-sm-12 mt-2 mb-2 "> 

      <div class="card">
        <h6 class="card-header">Recepción y Descarga del Producto <small>(Trabajadores autorizados)</small></h6>
        <div class="card-body p-2">

        <div class="text-right pb-2" style="border-bottom: 1px solid #EDEDED;">
        <button type="button" class="btn btn-info btn-sm mt-2 mb-2" style="border-radius: 0;font-size: .8em;" onclick="BTNRecepcion()">Agregar trabajador</button>
        </div>

        <div id="ListaPersonalRDP"></div>
         
        </div>
      </div>

      </div>

      
       <!-- CARD - MANTENIMIENTO -->
      <div class="col-xl-4 col-lg-4 col-md-6 col-sm-12 mt-2 mb-2 "> 
      <div class="card">
        <h6 class="card-header">Mantenimiento Preventivo y Correctivo <small>(Trabajadores autorizados)</small></h6>
        <div class="card-body p-2">

        <div class="text-right pb-2" style="border-bottom: 1px solid #EDEDED;">
        <button type="button" class="btn btn-info btn-sm mt-2 mb-2" style="border-radius: 0;font-size: .8em;" onclick="BTNMantenimiento()">Agregar trabajador</button>
        </div>

        <div id="ListaPersonalMPC"></div>
         
        </div>
      </div>

      </div>


      <?php if ($Session_IDEstacion == 1 || $Session_IDEstacion == 2) { ?>
      <?php }else{ ?>
      
      <div class="col-xl-8 col-lg-8 col-md-12 col-sm-12 mt-2 mb-2 "> 
      
      <div class="card">
        <h6 class="card-header">Aplicación Android</h6>
        <div class="card-body p-2">
      
      <div class="text-center mt-2">
      <h6>Descarga el manual de Instalación

      <a target="_blank" href="<?=RUTA_ARCHIVOS.'Bitacora/Manual Bitacora V.1.0.1.pdf';?>"><img src="<?php echo RUTA_IMG_ICONOS."pdf.png"; ?>"></a>
       </h6>  

     </div>

      <div class="text-center"><img width="200px" src="<?php echo RUTA_IMG."QR/CodigoQRV.1.0.1.png"; ?>"></div>
      <div class="text-center"><small>V.1.0.1</small></div>
      <hr>

      <div class="text-center"><b>Características de nueva actualización</b></div>


        <div class="p-3">
        <div><small class="font-weight-bold text-secondary">Geolocalización</small></div>

        <ul>
          <li><small>Se mejora la obtención de coordenadas del dispositivo móvil</small></li>
          <li><small>Configuración inicial de ubicación con las coordenadas de Estación de Servicio</small></li>
        </ul>
        
        <div><small class="font-weight-bold text-secondary">Mantenimiento Preventivo</small></div>
        <ul>
          <li><small>Funcionalidad para seleccionar el personal que realiza el mantenimiento puede ser interno y externo</small></li>
          <li><small>Si el mantenimiento es realizado por un externo se tiene que agregar el nombre a la firma</small></li>
          <li><small>Al finalizar el mantenimiento se puede agregar evidencia fotográfica</small></li>
          <li><small>En caso de error se puede cancelar el mantenimiento y el mismo se creará con un folio diferente</small></li>
          <li><small>Se actualiza el contenido de los mantenimientos</small></li>
          <li><small>Se actualiza el buscador de reportes</small></li>
          <li><small>El diseño de los reportes en formato PDF se mejoran</small></li>
        </ul>
        <div><small class="font-weight-bold text-secondary">Mantenimiento Correctivo</small></div>  
        <ul>
          <li><small>Funcionalidad para seleccionar el personal que realiza el mantenimiento puede ser interno y externo</small></li>
          <li><small>Si el mantenimiento es realizado por un externo se tiene que agregar el nombre a la firma</small></li>
          <li><small>Al finalizar el mantenimiento se puede agregar evidencia fotográfica</small></li>
          <li><small>Se agrega un buscador de reportes</small></li>
          <li><small>El diseño de los reportes en formato PDF se mejoran</small></li>
        </ul>     

     

         
        </div>

        </div>
      </div>

      </div>
      <?php } ?>


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
