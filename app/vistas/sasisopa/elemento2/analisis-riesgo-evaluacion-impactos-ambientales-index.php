<?php
require('app/help.php');
include_once "app/modelo/Ayuda.php";

$class_ayuda = new Ayuda();
$array_ayuda = $class_ayuda->sasisopaAyuda($Session_IDUsuarioBD,'2-analisis-riesgo-evaluacion-impactos-ambientales');

$id_ayuda = $array_ayuda['id'];
$estado = $array_ayuda['estado'];

?>

<html lang="es">
  <head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
  <title>SASISOPA</title>
  <meta name="description" content="">
  <meta name="viewport" content="width=device-width initial-scale=1.0">
  <link rel="shortcut icon" href="<?=RUTA_IMG_ICONOS?>/icono-web.png">
  <link rel="apple-touch-icon" href="<?=RUTA_IMG_ICONOS?>/icono-web.png">
  <link rel="stylesheet" href="<?=RUTA_CSS?>alertify.css">
  <link rel="stylesheet" href="<?=RUTA_CSS?>themes/default.rtl.css">
  <link rel="stylesheet" href="<?=RUTA_CSS ?>bootstrap.css" />
  <link rel="stylesheet" href="<?=RUTA_CSS?>componentes.css?v=1.0.1">
  <link rel="stylesheet" href="<?=RUTA_CSS?>bootstrap-select.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.7.0/animate.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/2.9.2/umd/popper.min.js"></script>
  <script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.13.2/jquery-ui.min.js"></script>
  <script type="text/javascript" src="<?=RUTA_JS?>alertify.js"></script>
  <link href="https://fonts.googleapis.com/css?family=Montserrat" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.7.0/animate.min.css">
  <link href="https://cdn.datatables.net/v/bs5/jszip-3.10.1/dt-2.0.3/b-3.0.1/b-colvis-3.0.1/b-html5-3.0.1/b-print-3.0.1/datatables.min.css" rel="stylesheet">
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
  <?php if ($id_ayuda != 0) {echo "btnAyuda();";} ?>

  ListaAnalisis();
  ListaAsistencia(2);

  });
 
  function ListaAnalisis(){
    let targets = [1,2,3,4];
    $('#DivListaAnalisis').load('app/vistas/sasisopa/elemento2/lista-analisis-riesgo.php', function() {
    $('#lista-analisis-riesgo').DataTable({
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

  function regresarP(){
   window.history.back();
  }

  function btnAyuda(){
  $('#ModalAyuda').modal('show');
  }

    function btnFinAyuda(idayuda, estado){
    
        var parametros = {
        "accion" : "actualizar-ayuda",
        "idayuda" : idayuda
        };

        if (idayuda != 0 && estado == 0) {

        $.ajax({
        data:  parametros,
        url:   'app/controlador/AyudaControlador.php',
        type:  'post',
        beforeSend: function() {
        },
        complete: function(){
        },
        success:  function (response) {

        $('#ModalAyuda').modal('hide');
        }
        });

        }else{
        $('#ModalAyuda').modal('hide');
        }
    
    }

    function Formato2(){
    window.location = "descargar-formato-2";  
    }
    function Formato3(){
    window.location = "descargar-formato-3";
    }

    function ModalAnexos(id){
    $('#Modal').modal('show');
    $('#DivModal').load('app/vistas/sasisopa/elemento2/modal-anexos-analisis-riesgo.php?id=' + id);   
    }

    function ListaAsistencia(idSasisopa){
    let targets = [1,2,3];
    $('#DivListaAsistencia').load('app/vistas/sasisopa/asistencia/lista-asistencia.php?idSasisopa=' + idSasisopa, function() {
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

    function btnAsistencia(){
    var parametros = {
    "accion" : "agregar-lista-asistencia",
    "PuntoSasisopa" : 2
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
    ListaAsistencia(2)
    }else{
    alertify.error('Error al eliminar')
    }

     }
     });
},
function(){
}).setHeader('Lista de asistencia').set({transition:'zoom',message: '¿Desea eliminar la comunicación interna de la estación?',labels:{ok:'Aceptar', cancel: 'Cancelar'}}).show();
}

function DescargarAsistencia(id){
window.location = "descargar-lista-asistencia/" + id;   
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
      <li class="breadcrumb-item text-primary c-pointer" onclick="regresarP()"><i class="fa-solid fa-house"></i> SASISOPA</li>
      <li aria-current="page" class="breadcrumb-item active">2. IDENTIFICACIÓN DE PELIGROS Y ASPECTOS AMBIENTALES, ANÁLISIS DE RIESGO Y EVALUACIÓN DE IMPACTOS AMBIENTALES</li>
      </ol>
      </div>
      <!-- Fin -->

      <h3>2. IDENTIFICACIÓN DE PELIGROS Y ASPECTOS AMBIENTALES, ANÁLISIS DE RIESGO Y EVALUACIÓN DE IMPACTOS AMBIENTALES</h3>

    <div class="row mt-2">
      <div class="col-xl-3 col-lg-3 col-md-12 col-sm-12 mt-3">
      <div class="p-3 bg-white">
        <h5>Identificación y evaluación de Aspectos e Impactos Ambientales.</h5>
        <div class="text-right mt-3"><button type="button" class="btn btn-primary" style="border-radius: 0px;" onclick="Formato2()">Descargar</button></div>
      </div>
      </div>  

      <div class="col-xl-3 col-lg-3 col-md-12 col-sm-12 mt-2">
      <div class="p-3 bg-white">
        <h5>Identificación y evaluación de Riesgos y Peligros para registrar el análisis.</h5>
        <div class="text-right mt-3"><button type="button" class="btn btn-primary" style="border-radius: 0px;" onclick="Formato3()">Descargar</button></div>
      </div>
      </div>  
      </div>

      <div class="row mt-3">
      <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12 mt-2 mb-2">
      <div class="bg-white p-3">
      <h5 class="text-primary">Análisis de Riesgo del Sector Hidrocarburos (ARSH)</h5>
      <div class="mt-3" id="DivListaAnalisis"></div>
      </div>
      </div>

      <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12 mt-2 mb-2">
      <div class="bg-white p-3">
      <div class="row">
      <div class="col-11">
      <h5 class="text-primary">Fo.ADMONGAS.010 (Registro de la atención y el seguimiento a la comunicación interna y externa.)</h5>
      </div>
      <div class="col-1 text-end">
      <a onclick="btnAsistencia()" style="cursor: pointer;" data-toggle="tooltip" data-placement="left" title="Crear" >
      <img src="<?php echo RUTA_IMG_ICONOS."agregar.png"; ?>">
      </a>
      </div>
      </div>
      <div id="DivListaAsistencia"></div>
      </div>
      </div>

      </div>


    </div>

    <div class="modal fade bd-example-modal-lg" id="ModalAyuda" data-backdrop="static">
    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
      <div class="modal-content" style="border-radius: 0px;border: 0px;">
        <div class="modal-header rounded-0 head-modal">
          <h4 class="modal-title text-white">Bienvenido al elemento 2. IDENTIFICACIÓN DE PELIGROS Y ASPECTOS AMBIENTALES, ANÁLISIS DE RIESGO Y EVALUACIÓN DE IMPACTOS AMBIENTALES, del Sistema de Administración</h4>
        </div>
        <div class="modal-body">

          <p class="text-justify" style="font-size: 1.1em">
           En este apartado podrás consultar las matrices para la identificación de aspectos e impactos ambientales así como la de Riesgos y peligros dela estación de servicio.
          </p>

          <hr>

          <label class="font-weight-bold" style="font-size: 1.1em">Como hacerlo:</label>
          <ul style="font-size: 1.1em">
            <li>Da clic en recuadro Identificación y evaluación de Aspectos e Impactos Ambientales para visualizar la matriz </li>
            <li>Da clic en el recuadro Identificación y evaluación de Riesgos y Peligros para registrar el análisis para visualizar la matriz</li>
          </ul>

          <hr>

          <label class="font-weight-bold" style="font-size: 1.1em">Responsables:</label>
          <p class="text-justify" style="font-size: 1.1em">Recuerda que es responsabilidad del <label class="text-danger font-weight-bold">Representante Técnico</label> (RT), <label class="text-danger font-weight-bold">Gerente de la Estación</label> dar a conocer los aspectos ambientales significativos a todo el personal de la estación de servicio puede ser mediante trípticos, capacitaciones o enviando comunicados mediante el elemento numero 7. COMUNICACIÓN, PARTICIPACIÓN Y CONSULTA.</p>

          <small>Nota:<br>
          Recuerda que para aquellos riesgos y peligros significativos se deben generar e implementar medidas de mitigación.
          </small>



        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-primary" style="border-radius: 0px;" onclick="btnFinAyuda(<?=$id_ayuda;?>,<?=$estado;?>)">Aceptar</button>
        </div>
      </div>
    </div>
    </div>

    <div class="modal fade bd-example-modal-lg" id="Modal" data-backdrop="static">
    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
      <div class="modal-content rounded-0 border-0">
      <div id="DivModal"></div>
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
