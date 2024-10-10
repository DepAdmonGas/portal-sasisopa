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
  <link rel="stylesheet" href="<?=RUTA_CSS ?>bootstrap.css" />
  <link rel="stylesheet" href="<?=RUTA_CSS?>componentes.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.7.0/animate.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/2.9.2/umd/popper.min.js"></script>
  <script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.13.2/jquery-ui.min.js"></script>
  <script type="text/javascript" src="<?=RUTA_JS?>alertify.js"></script>
  <link href="https://fonts.googleapis.com/css?family=Montserrat" rel="stylesheet">
  <link href="https://cdn.datatables.net/v/bs5/jszip-3.10.1/dt-2.0.3/b-3.0.1/b-colvis-3.0.1/b-html5-3.0.1/b-print-3.0.1/datatables.min.css" rel="stylesheet">
  <style media="screen">
  .LoaderPage {
  position: fixed;
  left: 0px;
  top: 0px; 
  width: 100%;
  height: 100%; 
  z-index: 9999;
  background: white;
  background: url('imgs/iconos/load-img.gif') 50% 50% no-repeat rgb(249,249,249);
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
    let targets = [1,2,3];
  $('#ListaAsistencia').load('app/vistas/sasisopa/asistencia/lista-asistencia.php?idSasisopa=' + idSasisopa, function() {
  $('#lista-asistencia').DataTable({
    "language": {
    "url": "<?=RUTA_JS?>es-ES.json"
  },
  "stateSave": true,
    "lengthMenu": [15,35,45],
    "columnDefs": [
    { "orderable": false, "targets": targets },
    { "searchable": false, "targets": targets }
    ]
  });
  });  
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
    ListaAsistencia(105)
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
    let targets = [6];
  $('#ListaNormatividad').load('app/vistas/sgm/punto5/lista-inventario-normatividad-aplicable.php', function() {
  $('#table-inventario-normatividad-aplicable').DataTable({
    "language": {
    "url": "<?=RUTA_JS?>es-ES.json"
  },
  "stateSave": true,
    "lengthMenu": [15,35,45],
    "columnDefs": [
    { "orderable": false, "targets": targets },
    { "searchable": false, "targets": targets }
    ]
  });
  });  
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
    <?php require('app/vistas/componentes/navbar-perfil.php'); ?>
    </div>

    <div class="magir-top-principal p-3">

      <!-- Inicio -->
      <div class="float-end">
      <div class="dropdown dropdown-sm d-inline ms-2">
      <button type="button" class="btn dropdown-toggle btn-primary" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
      <i class="fa-solid fa-screwdriver-wrench"></i></span>
      </button>
      <ul class="dropdown-menu">
      <li onclick="btnAyuda()"><a class="dropdown-item c-pointer"> <i class="fa-regular fa-circle-question"></i> Ayuda</a></li>
      </ul>
      </div>
      </div>
      <!-- Fin -->

      <!-- Inicio -->
      <div aria-label="breadcrumb" style="padding-left: 0; margin-bottom: 0;">
      <ol class="breadcrumb breadcrumb-caret">
      <li class="breadcrumb-item text-primary c-pointer" onclick="regresarP()"><i class="fa-solid fa-house"></i> SGM</li>
      <li aria-current="page" class="breadcrumb-item active">5. Normatividad aplicable a mediciones</li>
      </ol>
      </div>
      <!-- Fin -->

      <h3>5. Normatividad aplicable a mediciones</h3>

    <div class="mt-3">
    <div class="row">

    <div class="col-xl-7 col-lg-7 col-md-12 col-sm-12 mt-2 mb-2">
    <div class="bg-white">
    <div class="p-3">   
    
    <div class="mt-2 text-end">
    <button onclick="PracticasEstandares()" class="btn btn-sm btn-primary ml-2">Mejores Prácticas y Estándares</button>
    </div>

    <div class="row mt-3">
    <div class="col-10">
    <h5 class="text-secondary">Fo.SGM.005 Inventario de Normatividad Aplicable</h5>
    </div>
    <div class="col-2">
    <a class="float-end" onclick="modalNormatividad()" style="cursor: pointer;" data-toggle="tooltip" data-placement="left" title="Crear" >
    <img src="<?php echo RUTA_IMG_ICONOS."agregar.png"; ?>">
    </a>

    <a class="float-end me-2" onclick="descargarInventario()" style="cursor: pointer;"><img src="<?php echo RUTA_IMG_ICONOS."pdf.png"; ?>"></a>
    </div>
    </div>

    <div id="ListaNormatividad"></div>
    </div>
  </div>
</div>

<div class="col-xl-5 col-lg-5 col-md-12 col-sm-12 mt-2 mb-2">
    <div class="bg-white">
    <div class="p-3">        
      <h5 class="text-secondary">Fo.SGM.006 Requisitos legales del SGM</h5>

      <div class="text-end">
      <img onclick="deescargarRL()" src="<?=RUTA_IMG_ICONOS;?>pdf.png">
      <button onclick="RequisitosLegales()" class="btn btn-sm btn-primary ml-2">Requisitos Legales SASISOPA</button>
      </div>

    </div>
  </div>

  <div class="bg-white mt-3">
    <div class="p-3">        
    <div class="row">
    <div class="col-10">
    <h5 class="text-secondary">Fo.SGM.001 Lista de asistencia</h5>
    </div>
    <div class="col-2">
    <a class="float-end" onclick="btnListaAsistencia(105,2)" style="cursor: pointer;" data-toggle="tooltip" data-placement="left" title="Crear" >
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

 
    <div class="modal fade bd-example-modal-lg" id="myModal" data-backdrop="static">
    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
      <div class="modal-content border-0 rounded-0">
      <div class="modal-header rounded-0 head-modal">
      <h4 class="modal-title text-white">Ayuda</h4>
      <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
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
      <div class="modal-header  rounded-0 head-modal">
      <h4 class="modal-title text-white">Operación y Mantenimiento</h4>
      <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
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
  <!---------- LIBRERIAS DEL DATATABLE ---------->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/pdfmake.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/vfs_fonts.js"></script>
  <script src="https://cdn.datatables.net/v/bs5/jszip-3.10.1/dt-2.0.3/b-3.0.1/b-colvis-3.0.1/b-html5-3.0.1/b-print-3.0.1/datatables.min.js"></script>
  </body>
  </html>

