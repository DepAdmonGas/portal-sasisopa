<?php
require('app/help.php');
include_once "app/modelo/PreparacionEmergencias.php";
include_once "app/modelo/Ayuda.php";

$class_preparacion_emergencias = new PreparacionEmergencias();
$class_ayuda = new Ayuda();

$array_ayuda = $class_ayuda->sasisopaAyuda($Session_IDUsuarioBD,'13-preparacion-emergencias');
$class_preparacion_emergencias->validaTelefonos($Session_IDEstacion);
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
  <link rel="shortcut icon" href="<?php echo RUTA_IMG_ICONOS ?>/icono-web.png">
  <link rel="apple-touch-icon" href="<?php echo RUTA_IMG_ICONOS ?>/icono-web.png">
  <link rel="stylesheet" href="<?php echo RUTA_CSS ?>alertify.css">
  <link rel="stylesheet" href="<?php echo RUTA_CSS ?>themes/default.rtl.css">
  <link href="<?php echo RUTA_CSS ?>bootstrap.css" rel="stylesheet" />
  <link rel="stylesheet" href="<?php echo RUTA_CSS ?>componentes.css">
  <link rel="stylesheet" href="<?php echo RUTA_CSS ?>bootstrap-select.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.0/umd/popper.min.js"></script>
  <script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
  <script type="text/javascript" src="<?php echo RUTA_JS ?>alertify.js"></script>
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
  background: url('imgs/iconos/load-img.gif') 50% 50% no-repeat rgb(249,249,249);
}
  </style>
  <script type="text/javascript">
  $(document).ready(function(){
  $('[data-toggle="tooltip"]').tooltip();
  $(".LoaderPage").fadeOut("slow");
  <?php if ($id_ayuda != 0) {echo "btnAyuda();";} ?>
    DetalleProtocolo();
    ProgramaAnual();
    });

function regresarP(){
window.history.back();
}

function btnAyuda(){
$('#myModalPolitica').modal('show');
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
   $('#myModalPolitica').modal('hide');
   }
   });

  }else{
  $('#myModalPolitica').modal('hide');
  }

}

function DetalleProtocolo(){
$('#DocumentoProtocolo').load('app/vistas/sasisopa/elemento13/protocolo-emergencias.php');  
}

function ModalAgregarProtocolo(){
$('#ModalContenido').modal('show');
$('#DivContenido').load('app/vistas/sasisopa/elemento13/agregar-protocolo-emergencias.php'); 
}

function BTNAgregarProtocolo(){

var FechaProtocolo = $('#FechaProtocolo').val();
var Protocolo = document.getElementById("FileProtocolo");
var FileProtocolo = Protocolo.files[0];
var PathProtocolo = Protocolo.value;
var ext = $("#FileProtocolo").val().split('.').pop();

var data = new FormData();
var url = 'app/controlador/PreparacionEmergenciasControlador.php';

if (FechaProtocolo != "") {
$('#FechaProtocolo').css('border','');
if (ext == "PDF" || ext == "pdf") {
$('#result').html('');

data.append('accion', 'agregar-protocolo-emergencias');
data.append('FechaProtocolo', FechaProtocolo);
data.append('FileProtocolo', FileProtocolo);

  $.ajax({
  url: url,
  type: 'POST',
  contentType: false,
  data: data,
  processData: false,
  cache: false,
  }).done(function(data){

  alertify.message('Protocolo de respuesta a emergencias actualizado');
  DetalleProtocolo();
  $('#ModalContenido').modal('hide');

  });

}else{
$('#result').html('<small class="text-danger">Solo se aceptan formato PDF</small>'); 
}
}else{
$('#FechaProtocolo').css('border','2px solid #A52525');
}

}

function editarprotocolo(id){
$('#ModalContenido').modal('show');
$('#DivContenido').load('app/vistas/sasisopa/elemento13/editar-protocolo-emergencias.php?id=' + id); 
}

function BTNEditarProtocolo(id){

var EditFechaProtocolo = $('#EditFechaProtocolo').val();
var Protocolo = document.getElementById("EditFileProtocolo");
var EditFileProtocolo = Protocolo.files[0];
var PathProtocolo = Protocolo.value;
var ext = $("#EditFileProtocolo").val().split('.').pop();

var data = new FormData();
var url = 'app/controlador/PreparacionEmergenciasControlador.php';

if (EditFechaProtocolo != "") {
$('#EditFechaProtocolo').css('border','');

$('#result').html('');

data.append('accion', 'editar-protocolo-emergencias');
data.append('id', id);
data.append('EditFechaProtocolo', EditFechaProtocolo);
data.append('EditFileProtocolo', EditFileProtocolo);

  $.ajax({
  url: url,
  type: 'POST',
  contentType: false,
  data: data,
  processData: false,
  cache: false,
  }).done(function(data){

  alertify.message('Protocolo de respuesta a emergencias actualizado');
  DetalleProtocolo();
  $('#ModalContenido').modal('hide');

  });


}else{
$('#EditFechaProtocolo').css('border','2px solid #A52525');
}

}

function anexos(id){
$('#ModalContenido').modal('show');
ListaAnexos(id);
}

function ListaAnexos(id){
$('#DivContenido').load('app/vistas/sasisopa/elemento13/modal-anexos.php?idProtocolo=' + id); 
}

function AgegarAnexo(id){
var NombreAnexo = $('#NombreAnexo').val();
var Anexo = document.getElementById("Anexo");
var FileAnexo = Anexo.files[0];
var PathAnexo = Anexo.value;
var data = new FormData();
var url = 'app/controlador/PreparacionEmergenciasControlador.php';

var ext = $("#Anexo").val().split('.').pop();

if (NombreAnexo != "") {
$('#NombreAnexo').css('border','');
if (ext == "PDF" || ext == "pdf") {

data.append('accion', 'agregar-anexo');
data.append('idProtocolo', id);
data.append('NombreAnexo', NombreAnexo);
data.append('FileAnexo', FileAnexo);

$.ajax({
  url: url,
  type: 'POST',
  contentType: false,
  data: data,
  processData: false,
  cache: false,
  }).done(function(data){

alertify.message('Se agrego un nuevo anexo al protocolo seleccionado');
$('#Anexo').val('');
ListaAnexos(id);
  });

}else{
$('#resultAnexo').html('<small class="text-danger">Solo se aceptan formato PDF</small>'); 
}
 }else{
  $('#NombreAnexo').css('border','2px solid #A52525');
 }
}

function eliminaranexo(idprotocolo,id){
alertify.confirm('',
function(){

var parametros = {
    "accion" : "eliminar-anexo",
    "id" : id
    };

$.ajax({
 data:  parametros,
 url:   'app/controlador/PreparacionEmergenciasControlador.php',
 type:  'post',
 beforeSend: function() {
 },
 complete: function(){
 },
 success:  function (response) {

 alertify.message('El anexo fue eliminado');
 ListaAnexos(idprotocolo)
 }
 });

},
function(){
}).setHeader('Eliminar').set({transition:'zoom',message: 'Desea eliminar el anexo seleccionado',labels:{ok:'Aceptar', cancel: 'Cancelar'}}).show();
}

function eliminarprotocolo(id){
alertify.confirm('',
function(){

var parametros = {
    "accion" : "eliminar-protocolo-respuesta-emergencias",
    "id" : id
    };

$.ajax({
 data:  parametros,
 url:   'app/controlador/PreparacionEmergenciasControlador.php',
 type:  'post',
 beforeSend: function() {
 },
 complete: function(){
 },
 success:  function (response) {

 alertify.message('El protocolo fue eliminado');
 DetalleProtocolo();
 }
 });

},
function(){
}).setHeader('Eliminar').set({transition:'zoom',message: 'Desea eliminar el protocolo seleccionado',labels:{ok:'Aceptar', cancel: 'Cancelar'}}).show();
}
//--------------------------------------------------------------------------
function ModalTelefonos(){
$('#ModalContenido').modal('show');
ListaTelefonos();
}

function BtnCancelar(){
ListaTelefonos();
}

function ListaTelefonos(){
$('#DivContenido').load('app/vistas/sasisopa/elemento13/lista-telefonos-emergencias.php');
}

function BtnNewTelefono(){
$('#DivContenido').load('app/vistas/sasisopa/elemento13/agregar-telefonos-emergencias.php');  
}

function BtnAgregarTelefono(){

var Titulo = $('#Titulo').val();
var Telefono = $('#Telefono').val();

if (Titulo != "") {
$('#Titulo').css('border','');
if (Telefono != "") {
$('#Telefono').css('border','');

var parametros = {
"accion" : "agregar-telefono-emergencias",
"Titulo" : Titulo,
"Telefono" : Telefono
};

    $.ajax({
     data:  parametros,
     url:   'app/controlador/PreparacionEmergenciasControlador.php',
     type:  'post',
     beforeSend: function() {
     },
     complete: function(){
     },
     success:  function (response) {
     alertify.message('Telefono de emergencia agregado');
      ListaTelefonos();
     }
     });

}else{
$('#Telefono').css('border','2px solid #A52525');
}
}else{
$('#Titulo').css('border','2px solid #A52525');
}

}

function editartelefono(id){
$('#DivContenido').load('app/vistas/sasisopa/elemento13/editar-telefonos-emergencias.php?id=' + id);
}
 
function BtnActTelefono(id){

var EditTitulo = $('#EditTitulo').val();
var EditTelefono = $('#EditTelefono').val();

if (EditTitulo != "") {
$('#EditTitulo').css('border','');
if (EditTelefono != "") {
$('#EditTelefono').css('border','');

var parametros = {
  "accion" : "editar-telefono-emergencias",
    "EditTitulo" : EditTitulo,
    "EditTelefono" : EditTelefono,
    "idTelefono" : id
    };

        $.ajax({
     data:  parametros,
     url:   'app/controlador/PreparacionEmergenciasControlador.php',
     type:  'post',
     beforeSend: function() {
     },
     complete: function(){
     },
     success:  function (response) {
    alertify.message('Telefono de emergencia actualizado');
      ListaTelefonos();
     }
     });

}else{
$('#EditTelefono').css('border','2px solid #A52525');
}
}else{
$('#EditTitulo').css('border','2px solid #A52525');
}

}

function eliminartelefono(id){

alertify.confirm('',
function(){

var parametros = {
  "accion" : "eliminar-telefono-emergencias",
    "idTelefono" : id
    };

$.ajax({
 data:  parametros,
 url:   'app/controlador/PreparacionEmergenciasControlador.php',
 type:  'post',
 beforeSend: function() {
 },
 complete: function(){
 },
 success:  function (response) {

 alertify.message('El telefono fue eliminado');
 ListaTelefonos();
 }
 });

},
function(){
}).setHeader('Eliminar teléfono').set({transition:'zoom',message: 'Desea eliminar el teléfono seleccionado',labels:{ok:'Aceptar', cancel: 'Cancelar'}}).show();

}
//------------------------------------------------------------------------------------

function ProgramaAnual(){
$('#ProgramaAnual').load('app/vistas/sasisopa/elemento13/programa-anual.php');    
}

function ModalPrograma(id){
$('#ModalContenido').modal('show');
$('#DivContenido').load('app/vistas/sasisopa/elemento13/programa-anual-simulacro.php?id=' + id);   
}

function BtnAgregarPrograma(id){

var NombreSimulacro = $('#NombreSimulacro').val();
var Periodicidad = $('#Periodicidad').val();
var Fecha = $('#Fecha').val();

if (NombreSimulacro != "") {
$('#NombreSimulacro').css('border','');
if (Fecha != "") {
$('#Fecha').css('border','');

var parametros = {
  "accion" : "agregar-programa-anual-simulacro",
"id" : id,
"NombreSimulacro" : NombreSimulacro,
"Periodicidad" : Periodicidad,
"Fecha" : Fecha
};

    $.ajax({
     data:  parametros,
     url:   'app/controlador/PreparacionEmergenciasControlador.php',
     type:  'post',
     beforeSend: function() {
     },
     complete: function(){
     },
     success:  function (response) {
     alertify.message('Programa anual de simulacros agregado');     
     $('#ModalContenido').modal('hide');
     ProgramaAnual();
     }
     });

}else{
$('#Fecha').css('border','2px solid #A52525');
}
}else{
$('#NombreSimulacro').css('border','2px solid #A52525');
}

}

function ModalPersonal(id){
$('#ModalContenido').modal('show');
ListaPersonal(id);
}

function ListaPersonal(id){
$('#DivContenido').load('app/vistas/sasisopa/elemento13/lista-personal-programa.php?idPrograma=' + id);
}

function BtnAgregarPersonal(id){

var NombrePersonal = $('#NombrePersonal').val();

if (NombrePersonal != "") {
$('#borderNombrePersonal').css('border','');


var parametros = {
"accion" : "agregar-personal-simulacro",
"NombrePersonal" : NombrePersonal,
"id_programa" : id
};

    $.ajax({
     data:  parametros,
     url:   'app/controlador/PreparacionEmergenciasControlador.php',
     type:  'post',
     beforeSend: function() {
     },
     complete: function(){
     },
     success:  function (response) {
     alertify.message('Personal agregado');   
     ListaPersonal(id);  
     ProgramaAnual();
     }
     });

}else{
$('#borderNombrePersonal').css('border','2px solid #A52525');
}

}

function eliminarpersonal(idPrograma, idPersonal){
alertify.confirm('',
function(){

var parametros = {
  "accion" : "eliminar-personal-simulacro",
    "idPersonal" : idPersonal
    };

$.ajax({
 data:  parametros,
 url:   'app/controlador/PreparacionEmergenciasControlador.php',
 type:  'post',
 beforeSend: function() {
 },
 complete: function(){
 },
 success:  function (response) {

 alertify.message('Personal eliminado');
 ListaPersonal(idPrograma);  
  ProgramaAnual();
 }
 });

},
function(){
}).setHeader('Eliminar personal').set({transition:'zoom',message: 'Desea eliminar el personal seleccionado',labels:{ok:'Aceptar', cancel: 'Cancelar'}}).show();
}

function ModalResumen(id){
$('#ModalContenido').modal('show');
$('#DivContenido').load('app/vistas/sasisopa/elemento13/resumen-programa-anual.php?idPrograma=' + id);
}

function BtnAgregarResumen(id){

var Resumen = $('#Resumen').val();

if (Resumen != "") {
$('#Resumen').css('border','');


var parametros = {
"accion" : "agregar-resumen-simulacro",
"Resumen" : Resumen,
"idPrograma" : id
};

    $.ajax({
     data:  parametros,
     url:   'app/controlador/PreparacionEmergenciasControlador.php',
     type:  'post',
     beforeSend: function() {
     },
     complete: function(){
     },
     success:  function (response) {
     alertify.message('Resumen actualizado');   
     ProgramaAnual();
     }
     });


}else{
$('#Resumen').css('border','2px solid #A52525');
}

}

function ModalArchivo(id){
$('#ModalContenido').modal('show');
$('#DivContenido').load('app/vistas/sasisopa/elemento13/archivo-programa-simulacro.php?idPrograma=' + id);
}

function BtnAgregarEvaluacion(id){

var Archivo = document.getElementById("Evaluacion");
var FileEvaluacion = Archivo.files[0];
var PathEvaluacion = Archivo.value;
var ext = $("#Evaluacion").val().split('.').pop();

var data = new FormData();
var url = 'app/controlador/PreparacionEmergenciasControlador.php';

if (ext == "PDF" || ext == "pdf") {
$('#result').html('');

data.append('accion', 'agregar-evaluacion-simulacro');
data.append('idPrograma', id);
data.append('FileEvaluacion', FileEvaluacion);

  $.ajax({
  url: url,
  type: 'POST',
  contentType: false,
  data: data,
  processData: false,
  cache: false,
  }).done(function(data){

alertify.message('Se agrego correctamente la evaluación del programa anual de emergencias ');
 ProgramaAnual();
$('#ModalContenido').modal('hide');

  });

}else{
$('#result').html('<small class="text-danger">Solo se aceptan formato PDF</small>'); 
}

}

function EliminarPAS(id){
alertify.confirm('',
function(){

var parametros = {
  "accion" : "eliminar-programa-anual-simulacros",
    "id" : id
    };

$.ajax({
 data:  parametros,
 url:   'app/controlador/PreparacionEmergenciasControlador.php',
 type:  'post',
 beforeSend: function() {
 },
 complete: function(){
 },
 success:  function (response) {
  ProgramaAnual()
 }
 });

},
function(){
}).setHeader('Eliminar programa anual').set({transition:'zoom',message: '¿Desea eliminar el programa anual de simulacros?',labels:{ok:'Aceptar', cancel: 'Cancelar'}}).show();
}

function BuscarReporte(){
$('#ModalContenido').modal('show');
$('#DivContenido').load('app/vistas/sasisopa/elemento13/buscar-programa-simulacro.php');
}

function BtnBuscar(){
let BuscarYear = $('#BuscarYear').val(); 

if (BuscarYear != "") {
$('#BuscarYear').css('border','');

window.location = "descargar-simulacros/" + BuscarYear; 
$('#ModalContenido').modal('hide');

}else{
$('#BuscarYear').css('border','2px solid #A52525');
}
}

  </script>
  </head>
  <body>

    <div class="LoaderPage"></div>
    <div class="fixed-top navbar-admin">
    <?php require('public/componentes/header.menu.php'); ?>
    </div>

    <div class="magir-top-principal p-3">
    <div class="row">
    <div class="col-12">
    <div class="float-left" style="padding-right: 20px;margin-top: 5px;">
    <a onclick="regresarP()" style="cursor: pointer;" data-toggle="tooltip" data-placement="right" title="Regresar"><img src="<?php echo RUTA_IMG_ICONOS."regresar.png"; ?>"></a>
    </div>
    <div class="float-left"><h4>13. PREPARACIÓN Y RESPUESTA A EMERGENCIAS</h4></div>
    <div class="float-right" style="margin-top: 6px;margin-left: 10px;">
    <a onclick="btnAyuda()" style="cursor: pointer;" data-toggle="tooltip" data-placement="left" title="Ayuda" >
    <img src="<?php echo RUTA_IMG_ICONOS."info.png"; ?>">
    </a>
    </div>
    </div>
    </div>

    <div class="row mt-2">

    <div class="col-xl-5 col-lg-5 col-md-5 col-sm-12 mt-2 mb-2"> 
    <div class="card border-0 rounded-0" >
    <div class="card-body" style="font-size: 1.3em;">
    <div class="row">
      <div class="text-secondary col-10">
      Protocolo de respuesta a emergencias
      </div>
      <div class="col-2">
      <a class="float-right" onclick="ModalAgregarProtocolo()" style="cursor: pointer;" data-toggle="tooltip" data-placement="left" title="Agregar" >
      <img width="20px" src="<?php echo RUTA_IMG_ICONOS."subir.png"; ?>">
      </a>
      </div>
    </div>
    <div id="DocumentoProtocolo"></div>
    </div>
    </div>
    </div>

    <div class="col-xl-5 col-lg-5 col-md-5 col-sm-12 mt-2 mb-2"> 
      <div class="card border-0 rounded-0">
      <div class="card-body" style="font-size: 1.3em;">
      <div class="text-secondary">Teléfonos de emergencias</div>
      <div class="text-right" style="margin-top: 10px;"><button type="button" class="btn btn-primary btn-sm" style="border-radius: 0px;" onclick="ModalTelefonos()" >Ver teléfonos</button></div>
      </div>
    </div>
    </div>

    </div>

    <div class="bg-white p-3">
    <div id="ProgramaAnual"></div>
    </div>

    </div>

  <div class="modal fade bd-example-modal-lg" id="myModalPolitica" data-backdrop="static">
    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
      <div class="modal-content" style="border-radius: 0px;border: 0px;">
        <div class="modal-header">
          <h4 class="modal-title">Bienvenido al elemento 13. PREPARACIÓN Y RESPUESTA A EMERGENCIAS, del Sistema de Administración</h4>
        </div>
        <div class="modal-body">

          <p class="text-justify" style="font-size: 1.1em">
           En este apartado podrás subir, descargar y/o consultar los protocolos de respuesta a emergencias que complementan a los cursos impartidos por el consultor de protección civil. Así como también realizar el registro de los simulacros que se lleven a cabo en la estación de servicio.
          </p>
         
          <hr>

          <label class="font-weight-bold" style="font-size: 1.1em">Como hacerlo:</label>
          <ul style="font-size: 1.1em">
            <li>Da clic en el botón de PRE para consultar y/o descargar los protocolos de respuesta emergencias de tu estación (en caso de no contar con ellos sube el archivo en formato PDF para próximas consultas).</li>
            <li>Planifica tu simulacro con el personal involucrado en las brigadas de atención a emergencias.Deveras designar a personal capacitado que fungirá como evaluador del simulacro que se esta llevando a cabo (Imprimir formato Fo.ADMONGAS.016a).</li>
            <li>Da clic en el botón agregar para realizar el registro del simulacro y llena los campos se solicitan.</li>
          </ul>

          <hr>

          <label class="font-weight-bold" style="font-size: 1.1em">Responsables:</label>
          <p class="text-justify" style="font-size: 1.1em">Recuerda que es responsabilidad del <label class="text-danger font-weight-bold">Representante Técnico</label> (RT) y <label class="text-danger font-weight-bold">Gerente de la Estación</label> y de quienes conformen las Brigadas de atención a emergencias coordinar los simulacros en fechas y tiempos establecidos.</p>



        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-primary" style="border-radius: 0px;" onclick="btnFinAyuda(<?=$id_ayuda;?>,<?=$estado;?>)">Aceptar</button>
        </div>
      </div>
    </div>
    </div>

    <div class="modal fade bd-example-modal-lg" id="ModalContenido" data-backdrop="static">
    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
    <div class="modal-content" style="border-radius: 0px;border: 0px;">
    <div id="DivContenido"></div>

    </div>
    </div>
    </div>

  <script src="<?php echo RUTA_JS ?>bootstrap.min.js"></script>
  <script src="<?php echo RUTA_JS ?>bootstrap-select.js"></script>
  </body>
  </html>
<?php
//------------------
mysqli_close($con);
//------------------
?>