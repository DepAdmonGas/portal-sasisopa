<?php
require('app/help.php');
?> 
<html lang="es">
  <head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
  <title>SGM</title>
  <meta name="description" content="">
  <meta name="viewport" content="width=device-width initial-scale=1.0">
  <link rel="shortcut icon" href="<?=RUTA_IMG_ICONOS?>/icono-web.png">
  <link rel="apple-touch-icon" href="<?=RUTA_IMG_ICONOS?>/icono-web.png">
  <link rel="stylesheet" href="<?=RUTA_CSS?>alertify.css">
  <link rel="stylesheet" href="<?=RUTA_CSS?>themes/default.rtl.css">
  <link href="<?=RUTA_CSS ?>bootstrap.css" rel="stylesheet" />
  <link rel="stylesheet" href="<?=RUTA_CSS?>componentes.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.0/umd/popper.min.js"></script>
  <script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.13.2/jquery-ui.min.js"></script>
  <script type="text/javascript" src="<?=RUTA_JS?>alertify.js"></script>
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
  </style>
  <script type="text/javascript">
  $(document).ready(function(){
  $('[data-toggle="tooltip"]').tooltip();
  $(".LoaderPage").fadeOut("slow");

  ListaResponsable();

  });

  function regresarP(){
  window.history.back();
  }

  function btnAyuda(){
  $('#myModal').modal('show');
  }

  function ListaPersonal(){
  window.location = "lista-personal-sgm";
  }

  function modalResponsable(){
   $('#modalPrincipal').modal('show'); 
   $('#ContenidoModal').load('app/vistas/sgm/punto6/modal-designacion-responsable.php');
  }

  function ListaResponsable(){
 $('#ListaResponsable').load('app/vistas/sgm/punto6/lista-responsable.php');
  }

  function GuardarResponsable(){

  let Fecha = $('#Fecha').val();
  let UsuarioRISGM = $('#UsuarioRISGM').val();
  let UsuarioAISGM = $('#UsuarioAISGM').val();

  if (Fecha != "") {
  $('#Fecha').css('border','');
  if (UsuarioRISGM != "") {
  $('#UsuarioRISGM').css('border','');
  if (UsuarioAISGM != "") {
  $('#UsuarioAISGM').css('border','');

    var parametrosUsuario = {
      "Fecha" : Fecha,
      "UsuarioRISGM" : UsuarioRISGM,
      "UsuarioAISGM" : UsuarioAISGM
      };

     $.ajax({
     data:  parametrosUsuario,
     url:   'app/vistas/sgm/punto6/agregar-responsable-sgm.php',
     type:  'post',
     beforeSend: function() {
     },
     complete: function(){
     },
     success:  function (response) {

      ListaResponsable()
      $('#modalPrincipal').modal('hide'); 

     }
     });
  
  }else{
  $('#UsuarioAISGM').css('border','2px solid #A52525'); 
  }  
  }else{
  $('#UsuarioRISGM').css('border','2px solid #A52525'); 
  }
  }else{
  $('#Fecha').css('border','2px solid #A52525'); 
  }

  }

  function EliminarResponsable(id){

    var parametros = {
    "id" : id
    };


  alertify.confirm('',
  function(){


 $.ajax({
     data:  parametros,
     url:   'app/vistas/sgm/punto6/eliminar-responsable-sgm.php',
     type:  'post',
     beforeSend: function() {
     },
     complete: function(){
    
     },
     success:  function (response) {

    if (response == 1) {
    ListaResponsable()
    }else{
    alertify.error('Error al eliminar')
    }

     }
     });
    
  },
  function(){
  }).setHeader('Lista de asistencia').set({transition:'zoom',message: '¿Desea eliminar la Designación de responsable SGM?',labels:{ok:'Aceptar', cancel: 'Cancelar'}}).show();

  }

  function DescargarResponsable(id){
    window.location = "descargar-responsable-sgm/" + id;
  }

  function CapacitacionInterna(){
    window.location = "capacitacion-interna-sgm";
  }
  function CapacitacionExterna(){
    window.location = "capacitacion-externa-sgm";
  }
  function CapacitacionInduccion(){
    window.location = "capacitacion-induccion-sgm";
  }

  function InventarioEquipos(){
    window.location = "inventario-equipo-sgm";
  }

  function EvaluacionProveedoresServicios(){
    window.location = "evaluacion-proveedor-servicio-sgm";
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
    <div class="float-left"><h4>6. Gestion de los Recursos</h4></div>
    <div class="float-right" style="margin-top: 6px;margin-left: 10px;">
    <a onclick="btnAyuda()" style="cursor: pointer;" data-toggle="tooltip" data-placement="left" title="Ayuda" >
    <img src="<?php echo RUTA_IMG_ICONOS."info.png"; ?>">
    </a> 
    </div>
    </div>
   
    <div class="card-body">

          <h5>1. Gestión de personal, funciones y roles</h5>

          <div class="row">

            <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12 mt-2 mb-2">
            <div class="border">
            <div class="p-3">   
            
            <div class="row">
            <div class="col-11">
            <h5>Fo.SGM.007 Designación de responsable SGM</h5>
            </div>
            <div class="col-1">
            <a class="float-right" onclick="modalResponsable()" style="cursor: pointer;" data-toggle="tooltip" data-placement="left" title="Crear" >
            <img src="<?php echo RUTA_IMG_ICONOS."agregar.png"; ?>">
            </a>
            </div>
            </div>

            <div id="ListaResponsable"></div>
            </div>
            </div>
            </div>

            <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12 mt-2 mb-2">
            <div class="border">
            <div class="p-3">   
            <h5>Fo.SGM.008 Lista de personal </h5>
            <div class="text-right">
              <button class="btn btn-primary mt-2" onclick="ListaPersonal()">Ver personal</button>
            </div>
            </div>
            </div>
            </div>

        </div>

        <hr>

          <h5>2. Capacitación del personal</h5>

          <div class="row">

            <div class="col-xl-3 col-lg-3 col-md-12 col-sm-12 mt-2 mb-2">
              <div class="rounded-sm bg-primary text-center text-white border p-3" style="cursor: pointer;" onclick="CapacitacionInterna()">
                <h5>Programa Capacitacion Interna</h5>
              </div>
            </div>

            <div class="col-xl-3 col-lg-3 col-md-12 col-sm-12 mt-2 mb-2">
              <div class="rounded-sm bg-primary text-center text-white border p-3" style="cursor: pointer;" onclick="CapacitacionExterna()">
              <h5>Programa Capacitacion Externa</h5>
              </div>
            </div>

            <div class="col-xl-3 col-lg-3 col-md-12 col-sm-12 mt-2 mb-2">
              <div class="rounded-sm bg-primary text-center text-white border p-3" style="cursor: pointer;" onclick="CapacitacionInduccion()">
              <h5>Capacitación de inducción</h5>
              </div>
            </div>

        </div>

        <hr>
        

        <div class="row">
            <div class="col-xl-3 col-lg-3 col-md-12 col-sm-12 mt-2 mb-2">

              <h5>3. Gestión de equipos</h5>

              <div class="rounded-sm bg-primary text-center text-white border p-3" style="cursor: pointer;" onclick="InventarioEquipos()">
                <h5>Inventario de equipo</h5>
              </div>
            </div>

            <div class="col-xl-3 col-lg-3 col-md-12 col-sm-12 mt-2 mb-2">

              <h5>4.  Evaluación de proveedores y servicios</h5>

              <div class="rounded-sm bg-primary text-center text-white border p-3" style="cursor: pointer;" onclick="EvaluacionProveedoresServicios()">
                <h5>Orden de servicio y Evaluación de proveedores</h5>
              </div>
            </div>
        </div>

    </div>

    </div>
    </div>
    </div>
    </div>

    <div class="modal fade bd-example-modal-lg" id="myModal" data-backdrop="static">
    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
      <div class="modal-content border-0 rounded-0">
      <div class="modal-header">
      <h4 class="modal-title">Ayuda</h4>
      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
      <span aria-hidden="true">&times;</span>
      </button>
      </div>
        <div class="modal-body">
        <p>Bienvenido al elemento <b>6. GESTION DE LOS RECURSOS</b></p>

        <p><b>1. Gestión de personal, funciones y roles</b></p>

        <p>El representante legal deberá asignar al responsable de la implementación del SGM (asi como a su auxiliar de apoyo) mediante el formato 007, en caso de rotación o cambio de funciones y responsabilidades la designación del nuevo responsable deberá volverse a realizar el formato.</p>
        <p>Mantén actualizada la lista del personal que labora en la empresa mediante el formato 008</p>
        <hr>

        <p><b>2. Capacitación del personal</b></p>
        <p>De manera anual verifica el programa de capacitación interna y externa de acuerdo al procedimiento con el formato 009, verifica los puestos estén capacitados conforme a lo establecido en el procedimiento.</p>
        <p>Recuerda que cada que haya personal nuevo en las instalaciones deberá tomar la capacitación de inducción, por lo que cada que agregues a un nuevo colaborador en el formato 008 en automático le saldrán los cursos que debe tomar como inducción en el formato 010. 
        </p>
        <hr>

        <p><b>3. Gestión de equipos</b></p>
        <p>Realiza y mantén actualizado el inventario de equipos de medición para cumplir los requisitos metrológicos, esta actividad la debes registrar en el formato 011 que a continuación se desplega. Entre los equipos que debes de registrar te dejo como dato los siguientes:</p>

        <ul>            
          <li>Tanques de almacenamiento </li>
          <li>Sondas de nivel y temperatura </li>
          <li>Dispensarios </li>
          <li>Jarras patrón </li>
          <li>Sistema de control de inventarios </li>
          <li>Cinta petrolera</li> 
          <li>Termómetro </li>
          <li>Cronómetros, entre otros</li>
        </ul>
        
        </div>
      </div>
    </div>
  </div>

    <div class="modal fade bd-example-modal-lg" id="modalPrincipal" >
    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
      <div class="modal-content" style="border-radius: 0px;border: 0px;">
        <div id="ContenidoModal"></div>
      </div>
    </div>
    </div>
 
  <script src="<?php echo RUTA_JS ?>bootstrap.min.js"></script>
  </body>
  </html>

