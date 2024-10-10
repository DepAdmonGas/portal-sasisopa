<?php
require('app/help.php');

$sql = "SELECT * FROM sgm_politica WHERE id_estacion = '".$Session_IDEstacion."' ORDER BY id DESC LIMIT 1 ";
$result = mysqli_query($con, $sql);
$numero = mysqli_num_rows($result);
if($numero > 0){
$row = mysqli_fetch_array($result, MYSQLI_ASSOC);
$politica = $row['contenido'];
$fecha = $row['fecha'];
}else{
  $politica = "";
  $fecha = "";  
}

 $sql_capacitacion = "SELECT * FROM sgm_politica WHERE id_estacion = '".$Session_IDEstacion."' ORDER BY id DESC ";
 $result_capacitacion = mysqli_query($con, $sql_capacitacion);
 $numero_capacitacion = mysqli_num_rows($result_capacitacion);
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

  ListaAsistencia(103);
  ListaRevisionSGMPR(103);

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

  //----------------------------------------------------------------

  function ListaRevisionSGMPR(SGM){
    let targets = [1,2,3];
  $('#ListaRevisionSGMPR').load('app/vistas/sgm/revision-sgm-procedimientos-registros/lista-revision-sgm-procedimiento-registro.php?SGM=' + SGM, function() {
  $('#table-procedimientos-registros').DataTable({
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

  function btnRevisionSGMPR(SGM){

var parametros = {
"PuntoSGM" : SGM
};

 $.ajax({
 data:  parametros,
url:   'app/vistas/sgm/revision-sgm-procedimientos-registros/agregar-revision-sgm-procedimiento-registro.php',
type:  'post',
beforeSend: function() {
},
complete: function(){
},
success:  function (response) {

  if(response != 0){
  window.location = "revision-sgm-procedimiento-registro/" + response;
 }else{
  alertify.error('Error al crear registro'); 
 }


}
});

}

function EditarRevision(id){
    window.location = "revision-sgm-procedimiento-registro/" + id; 
  }

  function DescargarRevision(id){
    window.location = "descargar-revision-sgm-procedimiento-registro/" + id; 
  }

  function EliminarRevision(id){
    var parametros = {
    "id" : id
    };


  alertify.confirm('',
  function(){


 $.ajax({
     data:  parametros,
     url:   'app/vistas/sgm/revision-sgm-procedimientos-registros/eliminar-revision-sgm.php',
     type:  'post',
     beforeSend: function() {
     },
     complete: function(){
    
     },
     success:  function (response) {

    if (response == 1) {
    ListaRevisionSGMPR(101)
    }else{
    alertify.error('Error al eliminar')
    }

     }
     });
    
  },
  function(){
  }).setHeader('Lista de asistencia').set({transition:'zoom',message: '¿Desea eliminar la resisión del SGM de la estación?',labels:{ok:'Aceptar', cancel: 'Cancelar'}}).show();
  }

  function editarPolitica(){
  window.location = "editar-politica-sgm"; 
  }

  function detallePolitica(id){
 $('#politica').load('app/vistas/sgm/punto3/detalle-politica.php?id=' + id); 
  }

  function Eliminar(id){

      var parametros = {
    "id" : id
    };


  alertify.confirm('',
  function(){


 $.ajax({
     data:  parametros,
     url:   'app/vistas/sgm/punto3/eliminar-politica.php',
     type:  'post',
     beforeSend: function() {
     },
     complete: function(){
    
     },
     success:  function (response) {

    if (response == 1) {
    location.reload();
    }else{
    alertify.error('Error al eliminar')
    }

     }
     });
    
  },
  function(){
  }).setHeader('Lista de asistencia').set({transition:'zoom',message: '¿Desea eliminar el registro de politica?',labels:{ok:'Aceptar', cancel: 'Cancelar'}}).show();

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
    <li aria-current="page" class="breadcrumb-item active">3. Responsabilidades de la direccion</li>
    </ol>
    </div>
    <!-- Fin -->

    <h3>3. Responsabilidades de la direccion</h3>

    <div class="mt-3">

    <div class="bg-white p-3">
    <div class="float-end">
    <button type="button" class="btn btn-primary rounded-0" onclick="editarPolitica()" >Editar Politica</button>
    </div>
    <h4 class="text-secondary">POLITICA</h4>

        <div class="row mt-3">
        <div class="col-4">
        
        <table class="table table-bordered table-striped table-sm pb-0 mb-0 table-hover" style="font-size: .95em;">
        <thead> 
        <tr class="bg-primary text-white">
        <th class="text-center align-middle">#</th>
        <th class="text-center align-middle">Fecha</th>
        <th class="text-center align-middle" width="32"><i class="fa-regular fa-trash-can"></i></th>
        </tr>
        </thead>
        <tbody>
        <?php
        $num = 1;
        if ($numero_capacitacion > 0) {
        while($row_capacitacion = mysqli_fetch_array($result_capacitacion, MYSQLI_ASSOC)){
        $id = $row_capacitacion['id'];

        echo "<tr onclick='detallePolitica(".$id.")'>";
        echo "<td class='text-center'>".$num."</td>";
        echo "<td class='text-center'>".FormatoFecha($row_capacitacion['fecha'])."</td>";
        echo "<td class='text-center align-middle'><a onclick='Eliminar(".$id.")'><i class='fa-regular fa-trash-can'></i></a></td>";
        echo "</tr>";

        $num = $num + 1;
        }
        }else{
        echo "<td colspan='6' class='text-center text-secondary' style='font-size: .8em;'>No se encontró información para mostrar</td>";

        }
        ?>  
        </tbody>
        </table>
        </div>
        <div class="col-8">

          <?php 
          if($politica != ""){
          ?>

          <div id="politica">
            <div>Fecha: <?=FormatoFecha($fecha);?></div>
            <div class="mt-2"><?=$politica;?></div>
          </div>              

          <div class="row">
            <div class="col-2">
              <div class="text-center p-2">
                <img width="90%" src="<?=RUTA_IMG_FIRMA_PERSONAL.$Session_ApoderadoLegalFirma;?>">
              </div>
              <div class="border-top">
              <div class="text-center"><b><?=$Session_ApoderadoLegal;?></b></div>
              <div class="text-center"><b>Representante Legal</b></div>
              </div>
            </div>
          </div>

        <?php } ?>
         
        </div>
      </div>
      </div>

      <div class="mt-4">
      <div class="row">
        <div class="col-xl-6 col-lg-6 col-md-12">

      <div class="bg-white">
        <div class="p-3">        
        <div class="row">
        <div class="col-10">
        <h5 class="text-secondary">Fo.SGM.001 Lista de asistencia</h5>
        </div>
        <div class="col-2">
        <a class="float-end" onclick="btnListaAsistencia(103,2)" style="cursor: pointer;" data-toggle="tooltip" data-placement="left" title="Crear" >
        <img src="<?php echo RUTA_IMG_ICONOS."agregar.png"; ?>">
        </a>
        </div>
        </div>
        <div id="ListaAsistencia"></div>
        </div>
      </div>        
      
    </div>
    <div class="col-xl-6 col-lg-6 col-md-12">
        <div class="bg-white">
        <div class="p-3">
        <div class="row">
        <div class="col-10">
          <h5 class="text-secondary">Fo.SGM.002 Revisión del SGM, procedimientos y registros</h5>
        </div>
        <div class="col-2">
        <a class="float-end"onclick="btnRevisionSGMPR(103)" style="cursor: pointer;" data-toggle="tooltip" data-placement="left" title="Crear" >
        <img src="<?php echo RUTA_IMG_ICONOS."agregar.png"; ?>">
        </a>
        </div>
      </div> 
        <div id="ListaRevisionSGMPR"></div>
        </div>
      </div>
    </div>
      </div>
      </div>

    </div>  
    </div>
  </body>


    <div class="modal fade bd-example-modal-lg" id="myModal" data-backdrop="static">
    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
      <div class="modal-content border-0 rounded-0">
      <div class="modal-header rounded-0 head-modal">
      <h4 class="modal-title text-white">Ayuda</h4>
      <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
        <div class="modal-body">
        <p><b>Bienvenido al elemento 3 Responsabilidades de la dirección</b>, este elemento esta correlacionado con el elemento 1 y 2 por lo que adicional solo deberás revisar de manera mensual deberás dar a conocer la política a los colaboradores, clientes, proveedores y de manera anual verificar que la política cumpla con los requerimientos de la estación de servicio, ambas actividades deberán registrarse bajo el formato 001.</p>
        </div>
      </div>
    </div>
  </div>

  <script src="<?php echo RUTA_JS ?>bootstrap.min.js"></script>
  <!---------- LIBRERIAS DEL DATATABLE ---------->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/pdfmake.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/vfs_fonts.js"></script>
  <script src="https://cdn.datatables.net/v/bs5/jszip-3.10.1/dt-2.0.3/b-3.0.1/b-colvis-3.0.1/b-html5-3.0.1/b-print-3.0.1/datatables.min.js"></script>
  </html>
