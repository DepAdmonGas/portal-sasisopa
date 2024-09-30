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

  //----------------------------------------------------------------

  function ListaRevisionSGMPR(SGM){
  $('#ListaRevisionSGMPR').load('app/vistas/sgm/revision-sgm-procedimientos-registros/lista-revision-sgm-procedimiento-registro.php?SGM=' + SGM); 
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
    <div class="float-left"><h4>2. Control del documental del Sistema de Gestion de medición</h4></div>
        <div class="float-right" style="margin-top: 6px;margin-left: 10px;">
    <a onclick="btnAyuda()" style="cursor: pointer;" data-toggle="tooltip" data-placement="left" title="Ayuda" >
    <img src="<?php echo RUTA_IMG_ICONOS."info.png"; ?>">
    </a> 
    </div>
    </div>
   
    <div class="card-body">

            <div class="row">
        <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12 mt-2 mb-2">
            <div class="border">
            <div class="p-3">        
            <div class="row">
            <div class="col-10">
            <h5>Fo.SGM.001 Lista de asistencia</h5>
            </div>
            <div class="col-2">
            <a class="float-right" onclick="btnListaAsistencia(102,2)" style="cursor: pointer;" data-toggle="tooltip" data-placement="left" title="Crear" >
            <img src="<?php echo RUTA_IMG_ICONOS."agregar.png"; ?>">
            </a>
            </div>
            </div>
            <div id="ListaAsistencia"></div>
            </div>
          </div>
        </div>


        <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12 mt-2 mb-2">
          <div class="border">
            <div class="p-3">
            <div class="row">
            <div class="col-10">
              <h5>Fo.SGM.002 Revisión del SGM, procedimientos y registros</h5>
            </div>
            <div class="col-2">
            <a class="float-right"onclick="btnRevisionSGMPR(102)" style="cursor: pointer;" data-toggle="tooltip" data-placement="left" title="Crear" >
            <img src="<?php echo RUTA_IMG_ICONOS."agregar.png"; ?>">
            </a>
            </div>
          </div> 
            <div id="ListaRevisionSGMPR"></div>
            </div>
          </div>
        </div>
      </div>

       <div class="row">
        <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12 mt-2 mb-2">
          <div class="border">
          <div class="p-3">        
          <h5>Fo. SGM.003 Control documental del SGM</h5>
          <div class="text-right mt-3 mb-3"><button class="btn btn-sm btn-info rounded-0" onclick="descargar()">Descargar</button></div>

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
      <th class="text-center bg-light" colspan="6">'.$titulo.'</th>
      </tr>
      <tr>
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
        <p><b>Bienvenido al elemento 2 Control del documental del Sistema de Gestión de medición</b>, este elemento esta correlacionado con el elemento 1 por lo que adicional solo deberás revisar de manera anual los procedimientos y registros con el propósito de mantenerlos aprobados, actualizados y protegidos; considerando su distribución, acceso, control de cambios lo anterior dejando el registro en el formato 003. </p>
        </div>
      </div>
    </div>
  </div>

 
  <script src="<?php echo RUTA_JS ?>bootstrap.min.js"></script>
  </body>
  </html>
