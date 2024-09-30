<?php
require('app/help.php');
include_once "app/modelo/Ayuda.php";

$class_ayuda = new Ayuda();
$array_ayuda = $class_ayuda->sasisopaAyuda($Session_IDUsuarioBD,'5-funciones-responsabilidades-autoridad');
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
  <link rel="stylesheet" href="<?=RUTA_CSS?>componentes.css">
  <link rel="stylesheet" href="<?=RUTA_CSS?>bootstrap-select.css">
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
  background: url('imgs/iconos/load-img.gif') 50% 50% no-repeat rgb(249,249,249);
  }
  </style>
  <script type="text/javascript">
  $(document).ready(function(){
  $('[data-toggle="tooltip"]').tooltip();
  $(".LoaderPage").fadeOut("slow");
  <?php if ($id_ayuda != 0) {echo "btnAyuda();";} ?>

  ListaAsistencia(5);
  ListaRepresentanteT();

  });

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

    if(response){
   $('#ModalAyuda').modal('hide');
    }

   }
   });

  }else{
  $('#ModalAyuda').modal('hide');
  }
  }

    function Rete(){
    $('#ModalReTe').modal('show');
    }
    function Gerente(){
    $('#ModalGerente').modal('show');  
    }
    function JefePiso(){
    $('#ModalJefePiso').modal('show'); 
    }
    function Facturista(){
    $('#ModalFacturista').modal('show');  
    }
    function Despachador(){
    $('#ModalDespachador').modal('show');   
    }
    function AuxiliarAdmi(){
    $('#ModalAuxiliar').modal('show');   
    }
    function Mantenimiento(){
    $('#ModalMantenimiento').modal('show');
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

    function EditarAsistencia(id){
window.location = "lista-asistencia/" + id; 
}

function btnAsistencia(){
var parametros = {
  "accion" : "agregar-lista-asistencia",
 "PuntoSasisopa" : 5
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

 function EliminarAsistencia(id){

var parametros = {
  "accion" : "eliminar-lista-asistencia",
  "id" : id
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

  if (response) {
  ListaAsistencia(5)
  }else{
  alertify.error('Error al eliminar')
  }

   }
   });
}

    function DescargarAsistencia(id){
  window.location = "descargar-lista-asistencia/" + id;   
  }

  function ListaRepresentanteT(){  
    let targets = [1,2,3];
  $('#DivListaRT').load('app/vistas/sasisopa/elemento5/lista-representante-tecnico.php', function() {
  $('#tabla-formato-asignacion-representante-tecnico').DataTable({
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

  function btnRepresentanteT(){
    $('#ModalRT').modal('show');
    }

    function btnGuardar(){

var NombreRT = $('#NombreRT').val();
var FechaAsignacion = $('#FechaAsignacion').val();
var PDF = document.getElementById("PDF");
var PDF_file = PDF.files[0];
var PDF_filePath = PDF.value;

var data = new FormData();
var url = 'app/controlador/FuncionesResponsabilidadAutoridadControlador.php';
var ext = $("#PDF").val().split('.').pop();

if (NombreRT != "") {
$('#NombreRT').css('border',''); 
if (FechaAsignacion != "") {
$('#FechaAsignacion').css('border',''); 
if (ext == "PDF" || ext == "pdf") {
$('#Resultado').html('');
$('#ManualPDF').css('border','');  

  data.append('accion', 'agregar-representante-tecnico');
  data.append('NombreRT', NombreRT);
  data.append('FechaAsignacion', FechaAsignacion);
  data.append('PDF_file', PDF_file);

$.ajax({
  url: url,
  type: 'POST',
  contentType: false,
  data: data,
  processData: false,
  cache: false
  }).done(function(data){

    if(data){
    $('#NombreRT').val('');
    $('#FechaAsignacion').val('');
    $('#PDF').val('');
    ListaRepresentanteT();
    $('#ModalRT').modal('hide');
    }

  });

}else{
$('#Resultado').html('<small class="text-danger">Solo se aceptan formato PDF</small>');
$('#PDF').css('border','2px solid #A52525');    
}
}else{
$('#FechaAsignacion').css('border','2px solid #A52525');  
}
}else{
$('#NombreRT').css('border','2px solid #A52525');  
}

}
 
function EliminarRT(id){

    var parametros = {
    "accion" : "eliminar-representante-tecnico",
    "id" : id
    };

    alertify.confirm('',
    function(){
    $.ajax({
   data:  parametros,
   url:   'app/controlador/FuncionesResponsabilidadAutoridadControlador.php',
   type:  'post',
   beforeSend: function() {
   },
   complete: function(){
  
   },
   success:  function (response) {

  if (response == 1) {
  ListaRepresentanteT();
  }else{
  alertify.error('Error al eliminar')
  }

   }
   });
    },
    function(){
    }).setHeader('Representante técnico').set({transition:'zoom',message: '¿Desea eliminar el formato de asignación de representante técnico?',labels:{ok:'Aceptar', cancel: 'Cancelar'}}).show();

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
        <li aria-current="page" class="breadcrumb-item active">5. FUNCIONES, RESPONSABILIDADES Y AUTORIDAD</li>
        </ol>
        </div>
        <!-- Fin -->

        <h3>5. FUNCIONES, RESPONSABILIDADES Y AUTORIDAD</h3>

    <div class="text-center mt-3">
    <?php if ($Session_Organigrama != "") {
    ?>
    <div class="row">
    <div class="col-12 col-md-10">
    <img src="<?=RUTA_IMG_ORGANIGRAMA.$Session_Organigrama;?>" style="width: 100%;"> 
    </div>
    <div class="col-12 col-md-2">
    
    <div class="card rounded-0">
    <h5 class="card-header">Responsabilidades</h5>
    <div class="card-body p-2">
    
    <button type="button" style="width: 100%;" class="btn btn-primary rounded-0 btn-sm mt-1" onclick="Rete()">Representante Técnico</button>
    <button type="button" style="width: 100%;" class="btn btn-primary rounded-0 btn-sm mt-1" onclick="Gerente()">Gerente</button>
    <button type="button" style="width: 100%;" class="btn btn-primary rounded-0 btn-sm mt-1" onclick="JefePiso()">Jefe de Piso</button>
    <button type="button" style="width: 100%;" class="btn btn-primary rounded-0 btn-sm mt-1" onclick="Facturista()">Facturista</button>
    <button type="button" style="width: 100%;" class="btn btn-primary rounded-0 btn-sm mt-1" onclick="Despachador()">Despachador</button>
    <button type="button" style="width: 100%;" class="btn btn-primary rounded-0 btn-sm mt-1" onclick="AuxiliarAdmi()">Auxiliar administrativo</button>
    <button type="button" style="width: 100%;" class="btn btn-primary rounded-0 btn-sm mt-1" onclick="Mantenimiento()">Mantenimiento</button>
      
    </div>
    </div>

      </div>
      </div>
      <?php
      }else{
        echo "<div class='border p-4'><small>No se encontró el organigrama para mostrar, póngase en contacto con su administrador</small></div>";
      } ?>

      </div>

      <div class="row mt-2">          
          <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12 mt-2">
          
          <div class="bg-white p-3">          
            <div class="row">
            <div class="col-11">
            <h5 class="text-primary">Fo.ADMONGAS.010 (Registro de la atención y el seguimiento a la comunicación interna y externa.)</h5>
            </div>
            <div class="col-xl-1 col-lg-1 col-md-1 col-sm-1 text-end">
            <a class="c-pointer" onclick="btnAsistencia()">
            <img src="<?php echo RUTA_IMG_ICONOS."agregar.png"; ?>">
            </a>
            </div>
            </div>
            <div id="DivListaAsistencia"></div>
          </div>

        </div>

          <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12 mt-2">
          
          <div class="bg-white p-3">
            <div class="row">            
            <div class="col-xl-11 col-lg-11 col-md-11 col-sm-11">
              <h5 class="text-primary">Formato de asignación de representante técnico</h5>
            </div>
            <div class="col-xl-1 col-lg-1 col-md-1 col-sm-1 text-end">
            <a class="c-pointer" onclick="btnRepresentanteT()">
            <img src="<?php echo RUTA_IMG_ICONOS."agregar.png"; ?>">
            </a>
            </div>
            </div>
            <div id="DivListaRT"></div>
            </div>
          </div>
      </div>

    </div>

    <div class="modal fade bd-example-modal-lg" id="ModalReTe" data-backdrop="static">
    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
      <div class="modal-content" style="border-radius: 0px;border: 0px;">
        <div class="modal-header rounded-0 head-modal">
          <h4 class="modal-title text-white">Representante Técnico</h4>
          <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">

          <table class="table table-bordered table-striped table-sm">
            <thead style="font-size: 1.2em">
              <tr>
                <th colspan="3" class="text-center table-warning" >Funciones Responsabilidades y autoridad del RT</th>
              </tr>              
              <tr class="table-primary">
                <th class="text-center">Autoridad</th>
                <th class="text-center">Funciones</th>
                <th class="text-center">Responsabilidades</th>
              </tr>
            </thead>
            <tbody style="font-size: 1.1em">
              <tr>
                <td rowspan="5" class="text-center align-middle">Alta</td>
                <td class="text-center">Asegurar que el SA es conforme con los requisitos establecidos en los lineamientos y demás normativa aplicable.</td>
                <td rowspan="5" class="text-center align-middle">Organizar y
                coordinar las
                actividades que se
                desprendan de
                asuntos
                relacionados con el
                SA</td>
              </tr>
              <tr>
                <td class="text-center">Informar a la alta dirección del Regulado acerca del desempeño del SA.</td>
              </tr>
              <tr>
                <td class="text-center">Proponer la adopción de medidas para aplicar las mejores prácticas nacionales e internacionales en la implementación del SA.</td>
              </tr>
              <tr>
                <td class="text-center">Coordinar y apoyar al resto de las áreas en la definición e implementación de las acciones necesarias para subsanar los incumplimientos de los requisitos del SA.
                </td>
              </tr>
              <tr>
                <td class="text-center">Informar a la Agencia de cualquier situación crítica relativa al proyecto que pudiera poner en riesgo la SISOPA.</td>
              </tr>
            </tbody>
          </table>

  
        </div>
      </div>
    </div>
    </div>

     <div class="modal fade bd-example-modal-lg" id="ModalGerente" data-backdrop="static">
    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
      <div class="modal-content" style="border-radius: 0px;border: 0px;">
        <div class="modal-header rounded-0 head-modal">
          <h4 class="modal-title text-white">Gerente</h4>
          <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">

          <table class="table table-bordered table-striped table-sm">
            <thead style="font-size: 1.2em">
              <tr>
                <th colspan="3" class="text-center table-warning" >Funciones y responsabilidades del personal</th>
              </tr>              
              <tr class="table-primary">
                <th class="text-center">Autoridad</th>
                <th class="text-center">Funciones</th>
                <th class="text-center">Responsabilidades</th>
              </tr>
            </thead>
            <tbody style="font-size: 1.1em">
              <tr>
                <td class="text-center align-middle">Media-Alta</td>
                <td class="text-center">Revisar y opinar sobre el SA a
implementar, Informar y compartir puntos
de vista sobre el desempeño del SA,
colaborar activamente para el éxito de la
implementación del SA, proponer
opciones para el seguimiento al
cumplimiento al SA, Coordina las acciones
necesarias para el cumplimiento de
hallazgos </td>
                <td class="text-center align-middle">Organizar y
                Informar al RT
cualquier situación
referente al SA</td>
              </tr>              
            </tbody>
          </table>

  
        </div>
      </div>
    </div>
    </div>

    <div class="modal fade bd-example-modal-lg" id="ModalJefePiso" data-backdrop="static">
    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
      <div class="modal-content" style="border-radius: 0px;border: 0px;">
        <div class="modal-header rounded-0 head-modal">
          <h4 class="modal-title text-white">Jefe de Piso</h4>
          <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">

          <table class="table table-bordered table-striped table-sm">
            <thead style="font-size: 1.2em">
              <tr>
                <th colspan="3" class="text-center table-warning" >Funciones y responsabilidades del personal</th>
              </tr>              
              <tr class="table-primary">
                <th class="text-center">Autoridad</th>
                <th class="text-center">Funciones</th>
                <th class="text-center">Responsabilidades</th>
              </tr>
            </thead>
            <tbody style="font-size: 1.1em">
              <tr>
                <td class="text-center align-middle">Media</td>
                <td class="text-center">Revisar el SA, integrarse activamente a la
implementación del SA, transmitir
información a área de despacho</td>
                <td class="text-center align-middle">Informar al gerente
cualquier situación
referente al SA</td>
              </tr>              
            </tbody>
          </table>

  
        </div>
      </div>
    </div>
    </div>

    <div class="modal fade bd-example-modal-lg" id="ModalFacturista" data-backdrop="static">
    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
      <div class="modal-content" style="border-radius: 0px;border: 0px;">
        <div class="modal-header rounded-0 head-modal">
          <h4 class="modal-title text-white">Facturista</h4>
          <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">

          <table class="table table-bordered table-striped table-sm">
            <thead style="font-size: 1.2em">
              <tr>
                <th colspan="3" class="text-center table-warning" >Funciones y responsabilidades del personal</th>
              </tr>              
              <tr class="table-primary">
                <th class="text-center">Autoridad</th>
                <th class="text-center">Funciones</th>
                <th class="text-center">Responsabilidades</th>
              </tr>
            </thead>
            <tbody style="font-size: 1.1em">
              <tr>
                <td class="text-center align-middle">Media</td>
                <td class="text-center">Revisar el SA, integrarse activamente a la
implementación del SA, transmitir
información a área de despacho</td>
                <td class="text-center align-middle">Informar al gerente
cualquier situación
referente al SA</td>
              </tr>              
            </tbody>
          </table>

  
        </div>
      </div>
    </div>
    </div>

     <div class="modal fade bd-example-modal-lg" id="ModalDespachador" data-backdrop="static">
    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
      <div class="modal-content" style="border-radius: 0px;border: 0px;">
        <div class="modal-header rounded-0 head-modal">
          <h4 class="modal-title text-white">Despachador</h4>
          <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">

          <table class="table table-bordered table-striped table-sm">
            <thead style="font-size: 1.2em">
              <tr>
                <th colspan="3" class="text-center table-warning" >Funciones y responsabilidades del personal</th>
              </tr>              
              <tr class="table-primary">
                <th class="text-center">Autoridad</th>
                <th class="text-center">Funciones</th>
                <th class="text-center">Responsabilidades</th>
              </tr>
            </thead>
            <tbody style="font-size: 1.1em">
              <tr>
                <td class="text-center align-middle">Baja</td>
                <td class="text-center">Estar informado sobre el SA, participar
activamente el capacitaciones
</td>
                <td class="text-center align-middle">Informar al gerente
cualquier situación
referente al SA</td>
              </tr>              
            </tbody>
          </table>

  
        </div>
      </div>
    </div>
    </div>

     <div class="modal fade bd-example-modal-lg" id="ModalAuxiliar" data-backdrop="static">
    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
      <div class="modal-content" style="border-radius: 0px;border: 0px;">
        <div class="modal-header rounded-0 head-modal">
          <h4 class="modal-title text-white">Auxiliar administrativo</h4>
          <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">

          <table class="table table-bordered table-striped table-sm">
            <thead style="font-size: 1.2em">
              <tr>
                <th colspan="3" class="text-center table-warning" >Funciones y responsabilidades del personal</th>
              </tr>              
              <tr class="table-primary">
                <th class="text-center">Autoridad</th>
                <th class="text-center">Funciones</th>
                <th class="text-center">Responsabilidades</th>
              </tr>
            </thead>
            <tbody style="font-size: 1.1em">
              <tr>
                <td class="text-center align-middle">Baja</td>
                <td class="text-center">Estar informado sobre el SA, participar
activamente las capacitaciones
</td>
                <td class="text-center align-middle">Informar al gerente
cualquier situación
referente al SA</td>
              </tr>              
            </tbody>
          </table>

  
        </div>
      </div>
    </div>
    </div>

      <div class="modal fade bd-example-modal-lg" id="ModalMantenimiento" data-backdrop="static">
    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
      <div class="modal-content" style="border-radius: 0px;border: 0px;">
        <div class="modal-header rounded-0 head-modal">
          <h4 class="modal-title text-white">Mantenimiento</h4>
          <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">

          <table class="table table-bordered table-striped table-sm">
            <thead style="font-size: 1.2em">
              <tr>
                <th colspan="3" class="text-center table-warning" >Funciones y responsabilidades del personal</th>
              </tr>              
              <tr class="table-primary">
                <th class="text-center">Autoridad</th>
                <th class="text-center">Funciones</th>
                <th class="text-center">Responsabilidades</th>
              </tr>
            </thead>
            <tbody style="font-size: 1.1em">
              <tr>
                <td class="text-center align-middle">Media</td>
                <td class="text-center">Participar de manera activa en la
implementación del SA, opinar y compartir
puntos de vista, proponer opciones de
cumplimiento de hallazgos
</td>
                <td class="text-center align-middle">Informar al gerente
y al RT cualquier
situación referente
al SA</td>
              </tr>              
            </tbody>
          </table>

  
        </div>
      </div>
    </div>
    </div>

    <div class="modal fade bd-example-modal-lg" id="ModalAyuda" data-backdrop="static">
    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
      <div class="modal-content" style="border-radius: 0px;border: 0px;">
        <div class="modal-header rounded-0 head-modal">
          <h4 class="modal-title text-white">Bienvenido al elemento 5 FUNCIONES, RESPONSABILIDADES Y AUTORIDAD, del Sistema de Administración</h4>
        </div>
        <div class="modal-body">

          <p class="text-justify" style="font-size: 1.1em">
            Aquí vas a poder consultar la estructura orgánica de la empresa, así como las funciones, responsabilidades y autoridad de cada puesto sobre el sistema de Administración.
          </p>
          
          <hr>

          <label class="font-weight-bold" style="font-size: 1.1em">Como hacerlo:</label>
          <ul style="font-size: 1.1em">
            <li>Dar clic sobre el puesto para conocer las funciones, responsabilidades y autoridad</li>
          </ul>

          <hr>

          <label class="font-weight-bold" style="font-size: 1.1em">Responsables:</label>
          <p class="text-justify" style="font-size: 1.1em">Recuerda que es responsabilidad del <span class="text-danger font-weight-bold">Representante Técnico (RT)</span>, <span class="text-danger font-weight-bold">Gerente de la Estación</span>, el dar a conocer a cada uno de los puestos sus funciones, responsabilidades dentro del Sistema de Administración. </p>


        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-primary" style="border-radius: 0px;" onclick="btnFinAyuda(<?=$id_ayuda;?>,<?=$estado;?>)">Aceptar</button>
        </div>
      </div>
    </div>
    </div>

      <div class="modal fade bd-example-modal-lg" id="ModalRT" data-backdrop="static">
    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
      <div class="modal-content" style="border-radius: 0px;border: 0px;">
        <div class="modal-header rounded-0 head-modal">
          <h4 class="modal-title text-white">Agregar formato de asignación de representante técnico</h4>
          <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">

         <div class="row">
          <div class="col-12 col-md-6">
          <div class="mb-2"><small class="text-secondary">* Nombre del representante técnico:</small></div>
          <input class="form-control input-style rounded-0" type="text" id="NombreRT">        
          </div>
          <div class="col-12 col-md-6">
          <div class="mb-2"><small class="text-secondary">* Fecha de asignación:</small></div>
          <input class="form-control input-style rounded-0" type="date" id="FechaAsignacion">        
          </div>
         </div>


         <div class="mb-2 mt-2"><small class="text-secondary">* PDF:</small></div>
         <input type="file" id="PDF">
         <div id="Resultado"></div>

        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-primary" style="border-radius: 0px;" onclick="btnGuardar()">Aceptar</button>
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
