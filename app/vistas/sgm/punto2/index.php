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

  ListaAsistencia(102);
  ListaRevisionSGMPR(102);

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

  function descargar(){
    window.location = "descargar-control-documental-sgm/"; 
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
      <li aria-current="page" class="breadcrumb-item active">2. Control del documental del Sistema de Gestion de medición</li>
      </ol>
      </div>
      <!-- Fin -->

      <h3>2. Control del documental del Sistema de Gestion de medición</h3>

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
            <a class="float-end" onclick="btnListaAsistencia(102,2)" style="cursor: pointer;" data-toggle="tooltip" data-placement="left" title="Crear" >
            <img src="<?php echo RUTA_IMG_ICONOS."agregar.png"; ?>">
            </a>
            </div>
            </div>
            <div id="ListaAsistencia"></div>
            </div>
          </div>
        </div>


        <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12 mt-2 mb-2">
          <div class="bg-white">
            <div class="p-3">
            <div class="row">
            <div class="col-10">
              <h5 class="text-secondary">Fo.SGM.002 Revisión del SGM, procedimientos y registros</h5>
            </div>
            <div class="col-2">
            <a class="float-end"onclick="btnRevisionSGMPR(102)" style="cursor: pointer;" data-toggle="tooltip" data-placement="left" title="Crear" >
            <img src="<?php echo RUTA_IMG_ICONOS."agregar.png"; ?>">
            </a>
            </div>
          </div> 
            <div id="ListaRevisionSGMPR"></div>
            </div>
          </div>
        </div>
      </div>

      <div class="bg-white mt-3">
          <div class="p-3">        
          <h5 class="text-secondary">Fo. SGM.003 Control documental del SGM</h5>
          <div class="text-end mt-1 mb-3"><button class="btn btn-sm btn-info text-white rounded-0" onclick="descargar()">Descargar</button></div>

      <?php 

      function validaDocumento($id,$idEstacion,$con){

      $sql_lista = "SELECT archivo FROM sgm_control_documental WHERE id_documento = '".$id."' AND id_estacion = '".$idEstacion."'  ORDER BY fecha DESC LIMIT 1";
        $result_lista = mysqli_query($con, $sql_lista);
        $numero_lista = mysqli_num_rows($result_lista);
        if($numero_lista > 0){
          $row_lista = mysqli_fetch_array($result_lista, MYSQLI_ASSOC);
          $array = array('total' => $numero_lista, 'archivo' => $row_lista['archivo']);
        }else{
          $array = array('total' => 0, 'archivo' => 0);
        }
        
        return $array;
      }


      function listaDocumentos($idEstacion,$seccion,$con){

      $contenido = '';

      if($seccion == 3){

      $sql = "SELECT * FROM sgm_documentos WHERE seccion = '".$seccion."' ";
      $result = mysqli_query($con, $sql);
      $numero = mysqli_num_rows($result);

      $contenido .= '<table class="table table-sm table-bordered table-hover">';
      $contenido .= '<tbody>';
      while($row = mysqli_fetch_array($result, MYSQLI_ASSOC)){

      $validaDocumento = validaDocumento($row['id'],$idEstacion,$con);

      $documento = ($validaDocumento['total'] == 0) ? '<img src="'.RUTA_IMG_ICONOS.'eliminar.png">' : '<a href="'.RUTA_ARCHIVOS_SGM.$validaDocumento['archivo'].'" download><img src="'.RUTA_IMG_ICONOS.'descargar.png"></a>';

      $contenido .= '<tr>
      <td>'.$row['nombre'].'</td>
      <td width="35">'.$documento.'</td>
      </tr>';
      }
      $contenido .= '</tbody>';
      $contenido .= '</table>';

      }else{

      $sql = "SELECT * FROM sgm_documentos WHERE seccion = '".$seccion."' ";
      $result = mysqli_query($con, $sql);
      $numero = mysqli_num_rows($result);

      $titulo = ($seccion == 1) ? 'Manual de procedimientos del Sistema de Gestión de Medición
      ' : 'Formatos del Sistema de Gestión de Medición';

      $contenido .= '<table class="table table-sm table-bordered table-hover">';
      $contenido .= '<thead>
      <tr>
      <th class="text-center bg-light p-2" colspan="6">'.$titulo.'</th>
      </tr>
      <tr class="bg-primary text-white">
      <th class="align-middle">#</th>
      <th class="align-middle">Codificación</th>
      <th class="align-middle">Nombre</th>
      <th class="align-middle">Fecha de aprobación</th>
      <th class="align-middle" width="35"><img src="'.RUTA_IMG_ICONOS.'descargar.png"></th>
      </tr>
      </thead>';
      $contenido .= '<tbody>';
      while($row = mysqli_fetch_array($result, MYSQLI_ASSOC)){

      $validaDocumento = validaDocumento($row['id'],$idEstacion,$con);

      $documento = ($validaDocumento['total'] == 0) ? '<img src="'.RUTA_IMG_ICONOS.'eliminar.png">' : '<a href="'.RUTA_ARCHIVOS_SGM.$validaDocumento['archivo'].'" download><img src="'.RUTA_IMG_ICONOS.'descargar.png"></a>';

      $contenido .= '<tr>
      <td class="align-middle"><b>'.$row['id'].'</b></td>
      <td class="align-middle">'.$row['codificacion'].'</td>
      <td class="align-middle">'.$row['nombre'].'</td>
      <td class="align-middle">'.FormatoFecha($row['fecha_aprobacion']).'</td>
      <td class="align-middle">'.$documento.'</td>
      </tr>';
      }
      $contenido .= '</tbody>';
      $contenido .= '</table>';

      }

      return $contenido;
      }

      echo listaDocumentos($Session_IDEstacion,3,$con);
      echo listaDocumentos($Session_IDEstacion,1,$con);
      echo listaDocumentos($Session_IDEstacion,2,$con);
      ?>

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
        <p><b>Bienvenido al elemento 2 Control del documental del Sistema de Gestión de medición</b>, este elemento esta correlacionado con el elemento 1 por lo que adicional solo deberás revisar de manera anual los procedimientos y registros con el propósito de mantenerlos aprobados, actualizados y protegidos; considerando su distribución, acceso, control de cambios lo anterior dejando el registro en el formato 003. </p>
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
