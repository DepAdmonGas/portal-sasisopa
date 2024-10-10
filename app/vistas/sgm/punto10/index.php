<?php
require('app/help.php');

function validaAuditoria($id_estacion,$year,$con){

$sql = "SELECT * FROM sgm_auditoria WHERE id_estacion = '".$id_estacion."' AND year = '".$year."' ";
$result = mysqli_query($con, $sql);
$numero = mysqli_num_rows($result);
if ($numero == 0) {

  $sql_insert = "INSERT INTO sgm_auditoria (
  id_estacion,
  year,
  estado
  )
  VALUES (
  '".$id_estacion."',
  '".$year."',
  0
  )";
  mysqli_query($con, $sql_insert);

}

}
validaAuditoria($Session_IDEstacion,$fecha_year,$con);
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

 ListaAuditoria();
 ListaAsistencia(110);

  });

  function regresarP(){
  window.history.back();
  }

  function btnAyuda(){
  $('#myModal').modal('show');
  }

  function ListaAuditoria(){
    $('#ListaAuditoria').load('app/vistas/sgm/punto10/lista-auditoria.php');
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
    ListaAsistencia(110)
    }else{
    alertify.error('Error al eliminar')
    }

     }
     });
    
  },
  function(){
  }).setHeader('Lista de asistencia').set({transition:'zoom',message: '¿Desea eliminar la lista de asistencia de la estación?',labels:{ok:'Aceptar', cancel: 'Cancelar'}}).show();
  }

  //----------------------------------------------------------------------------------

  function Editar(id,formato){

    if(formato == 18){
      PlanAuditoria(id)
    }else if(formato == 19){
      ReporteHallazgos(id)
    }else if(formato == 20){
      PlanAtencion(id)
    }

  }

  function PlanAuditoria(id){
  window.location = "plan-auditoria-sgm/" + id; 
  }
  function ReporteHallazgos(id){
  window.location = "reporte-hallazgos-auditoria-sgm/" + id;
  }
  function PlanAtencion(id){
  window.location = "plan-atencion-hallazgos-sgm/" + id;
  }

  function Descargar(id,formato){

    if(formato == 18){
      EditarPlanAuditoria(id)
    }else if(formato == 19){
      EditarReporteHallazgos(id)
    }else if(formato == 20){
      EditarPlanAtencion(id)
    }

  }

  function EditarPlanAuditoria(id){
  window.location = "descargar-plan-auditoria-sgm/" + id; 
  }
  function EditarReporteHallazgos(id){
  window.location = "descargar-reporte-hallazgos-auditoria-sgm/" + id;
  }
  function EditarPlanAtencion(id){
  window.location = "descargar-plan-atencion-hallazgos-sgm/" + id;
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
      <li aria-current="page" class="breadcrumb-item active">10. Auditorias, Internas, externas y Atención de hallazgos</li>
      </ol>
      </div>
      <!-- Fin -->

      <h3>10. Auditorias, Internas, externas y Atención de hallazgos</h3>

      <div class="bg-white mt-3 p-3">
      <div id="ListaAuditoria"></div>
      </div>

      <div class="mt-3">
      <div class="row">
      <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12 mt-2 mb-2">
          <div class="bg-white">
          <div class="p-3">        
          <div class="row">
          <div class="col-10">
          <h5 class="text-secondary">Fo.SGM.001 Lista de asistencia</h5>
          </div>
          <div class="col-2">
          <a class="float-end" onclick="btnListaAsistencia(110,2)" style="cursor: pointer;" data-toggle="tooltip" data-placement="left" title="Crear" >
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
        <p>Una vez cumplido el primer año de implementación de tu SGM se te activara el presente elemento para que de manera anual se realice la auditoria interna o externa. Recuerda realizar el registro mediante los formatos 017, 018, 019, 001</p>
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

