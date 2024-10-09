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
  background: url('imgs/iconos/load-index-img.gif') 50% 50% no-repeat rgb(255,255,255);
  }
  </style>
  <script type="text/javascript">
  $(document).ready(function(){
  $('[data-toggle="tooltip"]').tooltip();
  $(".LoaderPage").fadeOut("slow");

 ListaAsistencia(109);

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
    ListaAsistencia(109)
    }else{
    alertify.error('Error al eliminar')
    }

     }
     });
    
  },
  function(){
  }).setHeader('Lista de asistencia').set({transition:'zoom',message: '¿Desea eliminar la lista de asistencia de la estación?',labels:{ok:'Aceptar', cancel: 'Cancelar'}}).show();
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
      <li aria-current="page" class="breadcrumb-item active">9. Establecimiento y Seguimiento Confirmación Metrológica</li>
      </ol>
      </div>
      <!-- Fin -->

      <h3>9. Establecimiento y Seguimiento Confirmación Metrológica</h3>

      <div class="mt-3">

<div class="row">
<div class="col-xl-7 col-lg-7 col-md-12 col-sm-12 mt-2 mb-2">
  
<table class="table table-bordered table-striped">
  <thead class="bg-primary text-white">
    <tr>
      <th class="text-center aling-middle" colspan="5">ESPECIFICACIONES METROLÓGICAS </th>
    </tr>
    <tr>
      <th class="text-center aling-middle">Equipo</th>
      <th class="text-center aling-middle">Resolución</th>
      <th class="text-center aling-middle">Repetibilidad</th>
      <th class="text-center aling-middle">EMP</th>
      <th class="text-center aling-middle">Incertidumbre</th>
    </tr>
  </thead>
  <tbody>
    <tr>
      <td>Tablas de calibración de tanques</td>
      <td>1mm</td>
      <td>*</td>
      <td>±0.5%</td>
      <td>0.2%</td>
    </tr>
    <tr>
      <td>Sensor de nivel automático</td>
      <td>1 mm</td>
      <td>*</td>
      <td>± mm</td>
      <td>1.5 mm</td>
    </tr>
     <tr>
      <td>Sensores de temperatura</td>
      <td>0.1 °C</td>
      <td>0.05 °C </td>
      <td>± 0.5°C</td>
      <td>0.2 °C</td>
    </tr>
    <tr>
      <td>Medidor de densidad para el cálculo CTL o CPL</td>
      <td>0.5 kg/m3</td>
      <td>*</td>
      <td>± 3kg/m3</td>
      <td>1 kg/m3</td>
    </tr>
    <tr>
      <td>Volumen a condiciones base</td>
      <td>*</td>
      <td>*</td>
      <td>*</td>
      <td>0.5%</td>
    </tr>
     <tr>
      <td>Medida volumétrica mayor a 10 L </td>
      <td>10 Ml </td>
      <td>*</td>
      <td>*</td>
      <td>0.025%  </td>
    </tr>
    <tr>
      <td>Termómetro</td>
      <td>1 °C</td>
      <td>*</td>
      <td>*</td>
      <td>*</td>
    </tr>
    <tr>
      <td>Cronometro</td>
      <td>0.01 s</td>
      <td>*</td>
      <td>*</td>
      <td>*</td>
    </tr>
    <tr>
      <td>Cinta Metálica</td>
      <td>1 mm</td>
      <td>*</td>
      <td>±1.5 mm (nueva) o ±2 mm (en uso)</td>
      <td>*</td>
    </tr>
  </tbody>
</table>
 
</div>
<div class="col-xl-5 col-lg-5 col-md-12 col-sm-12 mt-2 mb-2">

    <div class="bg-white">
    <div class="p-3">        
    <div class="row">
    <div class="col-10">
    <h5 class="text-secondary">Fo.SGM.001 Lista de asistencia</h5>
    </div>
    <div class="col-2">
    <a class="float-end" onclick="btnListaAsistencia(109,2)" style="cursor: pointer;" data-toggle="tooltip" data-placement="left" title="Crear" >
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

    <div class="modal fade bd-example-modal-lg" id="myModal" >
    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
      <div class="modal-content" style="border-radius: 0px;border: 0px;">
        <div class="modal-header rounded-0 head-modal">
          <h4 class="modal-title text-white">Ayuda</h4>
          <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">

        <p><b>De acuerdo a la RES/811/2015 RESOLUCIÓN</b> por la que la Comisión Reguladora de Energía expide las disposiciones administrativas de carácter general en materia de medición aplicables a la actividad de almacenamiento de petróleo, petrolíferos y petroquímicos. Y la <b>NOM-005-SCFI-2011</b> Instrumentos de medición-Sistema para medición y despacho de gasolina y otros combustibles líquidos-Especificaciones, métodos de prueba y de verificación. Las especificaciones metrológicas para determinar que los equipos sometidos a verificación y calibración cumplen son las que se muestran en la tabla del presente elemento.</p>
        <p>Cada que realices una calibración o verificación de equipos de medición verifica que los resultados sean favorables, reúnete con tu equipo de trabajo y en caso de ser necesario proponer medidas correctivas en conjunto con el prestador servicios y el área de mantenimiento para lograr la confirmación metrológica, lo anterior asentado en el formato <b>001</b>
        </p>

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

