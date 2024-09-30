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
  <link rel="stylesheet" href="<?=RUTA_CSS?>bootstrap-select.css">
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

  ListaNormatividadAplicable();
  ListaAsistencia(105);

  });

  function regresarP(){
  window.history.back();
  }

  function btnAyuda(){
  $('#myModal').modal('show');
  }

  function ListaAsistencia(idSasisopa){
  $('#ListaAsistencia').load('app/vistas/sasisopa/asistencia/lista-asistencia.php?idSasisopa=' + idSasisopa); 
  }

  function btnListaAsistencia(elemento,herramienta){
  var parametros = {
   "accion" : "agregar-lista-asistencia",
   "PuntoSasisopa" : elemento,
   "herramienta" : herramienta
   };

    $.ajax({
    data:  parametros,
   url:   'app/controlador/AsistenciaControlador.php',
   type:  'post',
   beforeSend: function() {
   },
   complete: function(){
   },
   success:  function (response) {

    if(response != 0){
     window.location = "lista-asistencia/" + response;
    }else{
     alertify.error('Error al crear registro'); 
    }

   
   }
   });
  }

function EditarAsistencia(id){
window.location = "lista-asistencia/" + id; 
}

  function DescargarAsistencia(id){
  window.location = "descargar-lista-asistencia-sgm/" + id;   
  }

  function EliminarAsistencia(id){

  var parametros = {
    "accion" : "eliminar-lista-asistencia",
    "id" : id
    };


  alertify.confirm('',
  function(){


 $.ajax({
     data:  parametros,
     url:   'app/controlador/AsistenciaControlador.php',
     type:  'post',
     beforeSend: function() {
     },
     complete: function(){
    
     },
     success:  function (response) {

    if (response == 1) {
    ListaAsistencia(101)
    }else{
    alertify.error('Error al eliminar')
    }

     }
     });
    
  },
  function(){
  }).setHeader('Lista de asistencia').set({transition:'zoom',message: '¿Desea eliminar la lista de asistencia de la estación?',labels:{ok:'Aceptar', cancel: 'Cancelar'}}).show();
  }
  //------------------------------------------------------------------------

  function RequisitosLegales(){
   window.location = "requisitos-legales-sgm"; 
  }

  function deescargarRL(){
  window.location = "descargar-requisitos-legal-sgm";  
  }

  function PracticasEstandares(){
   window.location = "9-mejores-practicas-estandares";   
  }

  function ListaNormatividadAplicable(){
  $('#ListaNormatividad').load('app/vistas/sgm/punto5/lista-inventario-normatividad-aplicable.php');
  }

  function modalNormatividad(){
  $('#modalNormatividad').modal('show');  
  }

  function btnGuardar(){

  var Norma = $('#Norma').val();
  var FechaPublicacion = $('#FechaPublicacion').val();
  var FechaAplicacion  = $('#FechaAplicacion').val();
  var EquipoProcedimiento = $('#EquipoProcedimiento').val();
  var Link = $('#Link').val();

  if(Norma != ""){
  $('#Norma').css('border','');
  if(FechaPublicacion != ""){
  $('#FechaPublicacion').css('border','');

  var parametros = {
  "Norma" : Norma,
  "FechaPublicacion" : FechaPublicacion,
  "FechaAplicacion" : FechaAplicacion,
  "EquipoProcedimiento" : EquipoProcedimiento,
  "Link" : Link
  };

  alertify.confirm('',
function(){

$.ajax({
 data:  parametros,
 url:   'app/vistas/sgm/punto5/agregar-normatividad-aplicable-mediciones.php',
 type:  'post',
 beforeSend: function() {
 },
 complete: function(){
 },
 success:  function (response) {

if(response == 1){

ListaNormatividadAplicable();
$('#Norma').val("");
$('#FechaPublicacion').val("");
$('#FechaAplicacion').val("");
$('#EquipoProcedimiento').val("");
$('#Link').val("");
$('#modalNormatividad').modal('hide'); 

}else{
 alertify.error('Error al crear el registro'); 
}


 }
 });

},
function(){
}).setHeader('Mensaje').set({transition:'zoom',message: '¿Desea agregar la siguiente información?',labels:{ok:'Aceptar', cancel: 'Cancelar'}}).show();


  }else{
  $('#FechaPublicacion').css('border','2px solid #A52525');
  }
  }else{
  $('#Norma').css('border','2px solid #A52525');
  }

  }
  
    function eliminar(id){

    alertify.confirm('',
    function(){

  var parametros = {
  "id" : id
  };

    $.ajax({
     data:  parametros,
     url:   'app/vistas/sgm/punto5/eliminar-normatividad-aplicable-mediciones.php',
     type:  'post',
     beforeSend: function() {
     },
     complete: function(){
     },
     success:  function (response) {

    if(response == 1){
    ListaNormatividadAplicable();
    }else{
     alertify.error('Error al eliminar el registro'); 
    }

     }
     });

    },
    function(){
    }).setHeader('Mensaje').set({transition:'zoom',message: '¿Desea eliminar la siguiente información?',labels:{ok:'Aceptar', cancel: 'Cancelar'}}).show();

  }

  function descargarInventario(){
     window.location = "descargar-inventario-normatividad-aplicable";  
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
    <div class="float-left"><h4>5. Normatividad aplicable a mediciones</h4></div>
        <div class="float-right" style="margin-top: 6px;margin-left: 10px;">
    <a onclick="btnAyuda()" style="cursor: pointer;" data-toggle="tooltip" data-placement="left" title="Ayuda" >
    <img src="<?php echo RUTA_IMG_ICONOS."info.png"; ?>">
    </a> 
    </div>
    </div>
   
    <div class="card-body">

        <div class="row">

        <div class="col-xl-7 col-lg-7 col-md-12 col-sm-12 mt-2 mb-2">
            <div class="border">
            <div class="p-3">   
            
            <div class="mt-2 text-right">
            <button onclick="PracticasEstandares()" class="btn btn-sm btn-primary ml-2">Mejores Prácticas y Estándares</button>
            </div>

            <div class="row mt-3">
            <div class="col-10">
            <h5>Fo.SGM.005 Inventario de Normatividad Aplicable</h5>
            </div>
            <div class="col-2">
            <a class="float-right" onclick="modalNormatividad()" style="cursor: pointer;" data-toggle="tooltip" data-placement="left" title="Crear" >
            <img src="<?php echo RUTA_IMG_ICONOS."agregar.png"; ?>">
            </a>

            <a class="float-right mr-2" onclick="descargarInventario()" style="cursor: pointer;"><img src="<?php echo RUTA_IMG_ICONOS."pdf.png"; ?>"></a>
            </div>
            </div>

            <div id="ListaNormatividad"></div>
            </div>
          </div>
        </div>

        <div class="col-xl-5 col-lg-5 col-md-12 col-sm-12 mt-2 mb-2">
            <div class="border">
            <div class="p-3">        
              <h5>Fo.SGM.006 Requisitos legales del SGM</h5>

              <div class="text-right">
              <img onclick="deescargarRL()" src="<?=RUTA_IMG_ICONOS;?>pdf.png">
              <button onclick="RequisitosLegales()" class="btn btn-sm btn-primary ml-2">Requisitos Legales SASISOPA</button>
              </div>

            </div>
          </div>

          <div class="border mt-3">
            <div class="p-3">        
            <div class="row">
            <div class="col-10">
            <h5>Fo.SGM.001 Lista de asistencia</h5>
            </div>
            <div class="col-2">
            <a class="float-right" onclick="btnListaAsistencia(105,2)" style="cursor: pointer;" data-toggle="tooltip" data-placement="left" title="Crear" >
            <img src="<?php echo RUTA_IMG_ICONOS."agregar.png"; ?>">
            </a>
            </div>
            </div>
            <div id="ListaAsistencia"></div>
            </div>
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
        <p><b>Bienvenido al elemento 5. Normatividad aplicable a mediciones</b>, en este elemento de manera anual deveras verificar si la legislación en materia de Mediciones se ha actualizado o han surgido nuevas normas o disposiciones a cumplir, dicha información tienes que registrarla en el formato 005
          En el formato 006 de manera anual verifica que los requisitos legales a los que estas sujeto en Materia de Gestión de Medición, se encuentren vigentes.</p>
          <p>Por ultimo no olvides que una vez que realices o complementes los registros debes dar a conocer a todo el personal la lista de normatividad a la que estamos sujetos y la lista de permisos con la que debemos contar, regístralo en el formato 001.
          </p>
        </div>
      </div>
    </div>
  </div>

  <div class="modal fade bd-example-modal-lg" id="modalNormatividad" data-backdrop="static">
    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
      <div class="modal-content border-0 rounded-0">
      <div class="modal-header">
      <h4 class="modal-title">Operación y Mantenimiento</h4>
      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
      <span aria-hidden="true">&times;</span>
      </button>
      </div>
        <div class="modal-body">

        <b>Norma, acuerdo o disposición:</b>
        <textarea class="form-control rounded-0 mt-2 mb-2" id="Norma"></textarea>

        <b>Fecha de publicación:</b>
        <input type="date" class="form-control rounded-0 mt-2 mb-2" id="FechaPublicacion">


        <b>Fecha de aplicación :</b>
        <input type="date" class="form-control rounded-0 mt-2 mb-2" id="FechaAplicacion">

        <b>Equipo o procedimiento de medición al que aplica :</b>
        <textarea class="form-control rounded-0 mt-2 mb-2" id="EquipoProcedimiento"></textarea>

        <b>Link:</b>
        <textarea class="form-control rounded-0 mt-2 mb-2" id="Link"></textarea>

        </div>
        <div class="modal-footer">
      <button type="button" class="btn btn-primary" style="border-radius: 0px;" onclick="btnGuardar()">Guardar</button>
      </div>
      </div>
    </div>
  </div>
 
  <script src="<?php echo RUTA_JS ?>bootstrap.min.js"></script>
  </body>
  </html>

