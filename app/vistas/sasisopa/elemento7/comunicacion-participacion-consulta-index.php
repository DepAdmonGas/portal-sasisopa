<?php
require('app/help.php');
include_once "app/modelo/Ayuda.php";

$class_ayuda = new Ayuda();
$array_ayuda = $class_ayuda->sasisopaAyuda($Session_IDUsuarioBD,'7-comunicacion-participacion-consulta');
$id_ayuda = $array_ayuda['id'];
$estado = $array_ayuda['estado'];

?>
<!DOCTYPE html>
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
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.7.0/animate.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css">
  <link rel="stylesheet" href="<?=RUTA_CSS?>bootstrap-select.css">

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
  ListaRegistroComunicacion();
  ListaQuejasS();

  $('#dirigidoa').selectpicker();
  
  });

  function regresarP(){
  window.history.back();
  }

  function btnAyuda(){
  $('#myModalComunicacion').modal('show');
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
   $('#myModalComunicacion').modal('hide');  
   }
   });  

  }else{
  $('#myModalComunicacion').modal('hide'); 
  }
  }

   function ListaRegistroComunicacion(){
    let targets = [7];
   $('#DivListaComunicacion').load('app/vistas/sasisopa/elemento7/lista-comunicacion.php?Year=0', function() {
  $('#table-comunicacion-participacion-consulta').DataTable({
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

    function btnNuevo(){
    $('#myModalNuevo').modal('show');
    }

    function tipoCom(valor){
        var select = valor.value;

        if (select == "") {
        $('#dirigidoa').prop('disabled', true);  
        $('#dirigidoa').selectpicker('refresh');

        $('#seguimientocomunicacion').prop('disabled', true); 
        $('#seguimientocomunicacion').css('background','#FAFAFA');
        $('#seguimientocomunicacion').css('color','#C7C7C7'); 
        }else if (select == "Interna") {

        $('#dirigidoa').prop('disabled', false);  
        $('#dirigidoa').selectpicker('refresh');
        $('#borderdirigidoa').css('background','white');

        }else if(select == "Externa"){
        $('#dirigidoa').prop('disabled', true);  
        $('#dirigidoa').selectpicker('refresh');

        $('#seguimientocomunicacion').prop('disabled', false); 
        $('#seguimientocomunicacion').css('background','white');
        $('#seguimientocomunicacion').css('color','black');
        }
    }

    function btnAgregar(){
    
    var temacomunicar = $("#temacomunicar").val();
    var detalle = $("#detalle").val();
    var tipocomunicacion = $("#tipocomunicacion").val();
    var materialcomunicar = $("#materialcomunicar").val();
    var dirigidoa = $("#dirigidoa").val();
    var seguimientocomunicacion = $("#seguimientocomunicacion").val();
    var siguinete = 0;


    var parametros = {
    "accion" : "agregar-comunicacion",
    "temacomunicar" : temacomunicar,
    "detalle" : detalle,
    "tipocomunicacion" : tipocomunicacion,
    "materialcomunicar" : materialcomunicar,
    "dirigidoa" : dirigidoa,
    "seguimientocomunicacion" : seguimientocomunicacion
    };

    if (temacomunicar != "") {
    $('#temacomunicar').css('border','');
    if (tipocomunicacion != "") {
    $('#tipocomunicacion').css('border','');
    if (materialcomunicar != "") {
    $('#materialcomunicar').css('border','');

    if (tipocomunicacion == "Interna") {

    if (dirigidoa != "") {
    $('#borderdirigidoa').css('border',''); 

    var siguinete = 1;

    }else{
    $('#borderdirigidoa').css('border','2px solid #A52525');
    }

    }else if (tipocomunicacion == "Externa") {

    if (seguimientocomunicacion != "Selecciona") {
    $('#seguimientocomunicacion').css('border',''); 

    var siguinete = 1;

    }else{
    $('#seguimientocomunicacion').css('border','2px solid #A52525');
    }

    }

    if (siguinete == 1) {

    alertify.confirm('',
    function(){

    $.ajax({
    data:  parametros,
    url:   'app/controlador/ComunicacionParticipacionConsultaControlador.php',
    type:  'post',
    beforeSend: function() {
    },
    complete: function(){
    },
    success:  function (response) {

    $("#temacomunicar").val('');
    $("#detalle").val('');
    $("#tipocomunicacion").val('');
    $("#materialcomunicar").val('');
    $("#dirigidoa").val('');
    $("#seguimientocomunicacion").val('');
    $('#myModalNuevo').modal('hide');

    ListaRegistroComunicacion();
    alertify.message('El registro de la atención fue creado correctamente');

    }
    });

    },
        function(){
        }).setHeader('Agregar seguimiento').set({transition:'zoom',message: 'Desea agregar el siguiente a la comunicación interna y externa.',labels:{ok:'Aceptar', cancel: 'Cancelar'}}).show();

    }

    }else{
    $('#materialcomunicar').css('border','2px solid #A52525');
    }
    }else{
    $('#tipocomunicacion').css('border','2px solid #A52525');
    }
    }else{
    $('#temacomunicar').css('border','2px solid #A52525');
    }

}

function BtnDetalle(id){
$('#myModalDetalle').modal('show');
$('#DivDetalle').load('app/vistas/sasisopa/elemento7/detalle-comunicacion.php?idcomunicado='+id);  
}

    function ModalEvidencia(id){
    $('#myModalDetalle').modal('show');
    $('#DivDetalle').load('app/vistas/sasisopa/elemento7/evidencia-comunicacion.php?idcomunicado='+id);  
    }

    function AgregarEvidencia(id){

    var EvidenciasM = document.getElementById("FileEvidencia");
    var FileEvidencia = EvidenciasM.files[0];
    var PathProtocolo = EvidenciasM.value;
    var ext = $("#FileEvidencia").val().split('.').pop();

    var data = new FormData();
    var url = 'app/controlador/ComunicacionParticipacionConsultaControlador.php';

    if (PathProtocolo != "") {
    $('#FileEvidencia').css('border','');
    if (ext == "JPG" || ext == "jpg" || ext == "jpeg" || ext == "PNG" || ext == "png") {

    $('#result').html('');

    data.append('accion', 'agregar-evidencia-comunicacion');
    data.append('id', id);
    data.append('FileEvidencia', FileEvidencia);

    $(".LoaderPage").show();

    $.ajax({
    url: url,
    type: 'POST',
    contentType: false,
    data: data,
    processData: false,
    cache: false,
    }).done(function(data){

      if(data){
        $(".LoaderPage").hide();
        alertify.message('Evidencia agregada');
        ModalEvidencia(id)
      }else{
        $(".LoaderPage").hide();
        alertify.error('Evidencia no agregada');
      }
    

    });

    }else{
    $('#result').html('<small class="text-danger">Solo se aceptan formato JPG y PNG</small>');
    }
    }else{
    $('#FileEvidencia').css('border','2px solid #A52525');
    }

    }

    function EliminarE(idcomunicado,idevidencia){

    alertify.confirm('',
    function(){

    var parametros = {
    "accion" : "eliminar-evidencia-comunicacion",
    "id" : idevidencia
    };

    $.ajax({
     data:  parametros,
     url:   'app/controlador/ComunicacionParticipacionConsultaControlador.php',
     type:  'post',
     beforeSend: function() {
     },
     complete: function(){
    
     },
     success:  function (response) {

    if (response) {
     ModalEvidencia(idcomunicado)
    }else{
    alertify.error('Error al eliminar')
    }

     }
     });

    },
    function(){
    }).setHeader('Eliminar').set({transition:'zoom',message: '¿Desea eliminar la siguiente información?',labels:{ok:'Aceptar', cancel: 'Cancelar'}}).show();
    }

    function DescargarAsistencia(id){
    window.location = "descargar-lista-asistencia/" + id;   
    }

    function Descargar(Year,idEstacion,id){

    if(Year == 0){
    var ResultYear = "X";
    }else{
    var ResultYear = Year;
    }

    if(idEstacion == 0){
    var ResultidEstacion = "X";
    }else{
    var ResultidEstacion = idEstacion;
    }

    if(id == 0){
    var Resultid = "X";
    }else{
    var Resultid = id + "";
    }

    window.location = "descargar-comunicacion-participacion-consulta/" + ResultYear + "/" + ResultidEstacion + "/" + Resultid;
    }

    function Editar(id){
    $('#ModalEditar').modal('show');
    $('#DivContenido').load('app/vistas/sasisopa/elemento7/modal-editar-comunicacion-participacion-consulta.php?idReporte=' + id);
    }

    function btnEditar(id){

    let Editfecha = $("#Editfecha").val();
    let Edittemacomunicar = $("#Edittemacomunicar").val();
    let Editdetalle = $("#Editdetalle").val();
    let Edittipocomunicacion = $("#Edittipocomunicacion").val();
    let Editmaterialcomunicar = $("#Editmaterialcomunicar").val();
    let Editdirigidoa = $("#Editdirigidoa").val();
    let Editseguimientocomunicacion = $("#Editseguimientocomunicacion").val();
    var siguinete = 0;


      var parametros = {
        "accion" : "editar-comunicacion",
        "id" : id,
        "Editfecha" : Editfecha,
        "Edittemacomunicar" : Edittemacomunicar,
        "Editdetalle" : Editdetalle,
        "Edittipocomunicacion" : Edittipocomunicacion,
        "Editmaterialcomunicar" : Editmaterialcomunicar,
        "Editdirigidoa" : Editdirigidoa,
        "Editseguimientocomunicacion" : Editseguimientocomunicacion
        };

    if (Edittemacomunicar != "") {
    $('#Edittemacomunicar').css('border','');
    if (Edittipocomunicacion != "") {
    $('#Edittipocomunicacion').css('border','');
    if (Editmaterialcomunicar != "") {
    $('#Editmaterialcomunicar').css('border','');

    if (Edittipocomunicacion == "Interna") {

    if (dirigidoa != "") {
    $('#borderdirigidoa').css('border',''); 

    var siguinete = 1;

    }else{
    $('#borderdirigidoa').css('border','2px solid #A52525');
    }

    }else if (Edittipocomunicacion == "Externa") {

    if (seguimientocomunicacion != "Selecciona") {
    $('#seguimientocomunicacion').css('border',''); 

    var siguinete = 1;

    }else{
    $('#seguimientocomunicacion').css('border','2px solid #A52525');
    }

    }

    if (siguinete == 1) {

    alertify.confirm('',
    function(){

    $.ajax({
    data:  parametros,
    url:   'app/controlador/ComunicacionParticipacionConsultaControlador.php',
    type:  'post',
    beforeSend: function() {
    },
    complete: function(){
    },
    success:  function (response) {

    ListaRegistroComunicacion();
    alertify.message('El registro de la atención fue editado correctamente');
    $('#ModalEditar').modal('hide');

    }
    });

    },
        function(){
        }).setHeader('Editar seguimiento').set({transition:'zoom',message: 'Desea editar el siguiente a la comunicación interna y externa.',labels:{ok:'Aceptar', cancel: 'Cancelar'}}).show();

    }

    }else{
    $('#Editmaterialcomunicar').css('border','2px solid #A52525');
    }
    }else{
    $('#Edittipocomunicacion').css('border','2px solid #A52525');
    }
    }else{
    $('#Edittemacomunicar').css('border','2px solid #A52525');
    }

    } 

    function Eliminar(id){

alertify.confirm('',
function(){

var parametros = {
    "accion" : "eliminar-comunicacion",
    "id" : id
    };

 $.ajax({
     data:  parametros,
     url:   'app/controlador/ComunicacionParticipacionConsultaControlador.php',
     type:  'post',
     beforeSend: function() {
     },
     complete: function(){
    
     },
     success:  function (response) {

    if (response == 1) {
     ListaRegistroComunicacion();
    }else{
    alertify.error('Error al eliminar')
    }

     }
     });

},
    function(){
    }).setHeader('Eliminar').set({transition:'zoom',message: '¿Desea eliminar la siguiente información?',labels:{ok:'Aceptar', cancel: 'Cancelar'}}).show();

}

function DescargarCompleto(Year,idEstacion,id){

if(Year == 0){
var ResultYear = "X";
}else{
var ResultYear = Year;
}

if(idEstacion == 0){
var ResultidEstacion = "X";
}else{
var ResultidEstacion = idEstacion;
}

if(id == 0){
var Resultid = "X";
}else{
var Resultid = id + "";
}

window.location = "descargar-comunicacion-participacion-consulta-reporte/" + ResultYear + "/" + ResultidEstacion + "/" + Resultid;

}

function ModalBuscar(){
$('#ModalBuscar').modal('show');
}

function btnBuscar(idEstacion){

let BuscarYear = $('#BuscarYear').val();

if (BuscarYear != "") {
$('#BuscarYear').css('border','');

$('#DivListaComunicacion').load('app/vistas/sasisopa/elemento7/lista-comunicacion.php?Year=' + BuscarYear);
$('#ModalBuscar').modal('hide');

}else{
$('#BuscarYear').css('border','2px solid #A52525');
}

}

function ListaQuejasS(){    
  let targets = [2];
  $('#DivListaQuejasS').load('app/vistas/sasisopa/elemento7/lista-quejas-sugerencias.php', function() {
  $('#table-quejas-sugerencias').DataTable({
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

function btnQuejasS(){
$('#ModalQS').modal('show');
}

function btnAgregarQS(){

var QSFecha = $('#QSFecha').val();
var QSNombre = $('#QSNombre').val();
var QSMotivosCausas = $('#QSMotivosCausas').val();
var QSNombreDirigido = $('#QSNombreDirigido').val();
var QSContacto = $('#QSContacto').val();
var QSNombrePuesto = $('#QSNombrePuesto').val();
var QSEfectosConsecuencias = $('#QSEfectosConsecuencias').val();
var QSSolucion = $('#QSSolucion').val();
var QSPlazo = $('#QSPlazo').val();
var QSConfirmacion = $('#QSConfirmacion').val();

if (QSFecha != "") {
$('#QSFecha').css('border','');
if (QSNombre != "") {
$('#QSNombre').css('border','');
if (QSMotivosCausas != "") {
$('#QSMotivosCausas').css('border','');
if (QSNombreDirigido != "") {
$('#QSNombreDirigido').css('border','');
if (QSContacto != "") {
$('#QSContacto').css('border','');

     var parametros = {
      "accion" : "agregar-queja-sugerencia",
        "QSFecha" : QSFecha,
        "QSNombre" : QSNombre,
        "QSMotivosCausas" : QSMotivosCausas,
        "QSNombreDirigido" : QSNombreDirigido,
        "QSContacto" : QSContacto,
        "QSNombrePuesto" : QSNombrePuesto,
        "QSEfectosConsecuencias" : QSEfectosConsecuencias,
        "QSSolucion" : QSSolucion,
        "QSPlazo" : QSPlazo,
        "QSConfirmacion" : QSConfirmacion
        };

  alertify.confirm('',
function(){

 $.ajax({
   data:  parametros,
   url:   'app/controlador/ComunicacionParticipacionConsultaControlador.php',
   type:  'post',
   beforeSend: function() {
  },
   complete: function(){
   },
   success:  function (response) {

  $("#QSFecha").val('');
  $("#QSNombre").val('');
  $("#QSMotivosCausas").val('');
  $("#QSNombreDirigido").val('');
  $("#QSContacto").val('');
  $("#QSNombrePuesto").val('');
  $("#QSEfectosConsecuencias").val('');
  $("#QSSolucion").val('');
  $("#QSPlazo").val('');
  $("#QSConfirmacion").val('');

  ListaQuejasS();
  $('#ModalQS').modal('hide');

   }
   });

 },
    function(){
    }).setHeader('Agregar quejas y sugerencias').set({transition:'zoom',message: '¿Desea agregar la siguiente queja o sugerencia?',labels:{ok:'Aceptar', cancel: 'Cancelar'}}).show();

}else{
$('#QSContacto').css('border','2px solid #A52525');
}
}else{
$('#QSNombreDirigido').css('border','2px solid #A52525');
}
}else{
$('#QSMotivosCausas').css('border','2px solid #A52525');
}
}else{
$('#QSNombre').css('border','2px solid #A52525');
}
}else{
$('#QSFecha').css('border','2px solid #A52525');
}

}

function DescargarQS(id){
window.location = "descargar-quejas-sugerencias/" + id;
}

function EliminarQS(id){

alertify.confirm('',
function(){

var parametros = {
    "accion" : "eliminar-quejas-sugerencias",
    "id" : id
    };

 $.ajax({
     data:  parametros,
     url:   'app/controlador/ComunicacionParticipacionConsultaControlador.php',
     type:  'post',
     beforeSend: function() {
     },
     complete: function(){
    
     },
     success:  function (response) {

    if (response) {
    ListaQuejasS();
    }else{
    alertify.error('Error al eliminar')
    }

     }
     });

},
    function(){
    }).setHeader('Eliminar').set({transition:'zoom',message: '¿Desea eliminar la siguiente información?',labels:{ok:'Aceptar', cancel: 'Cancelar'}}).show();

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
      <li aria-current="page" class="breadcrumb-item active">7. COMUNICACIÓN, PARTICIPACIÓN Y CONSULTA</li>
      </ol>
      </div>
      <!-- Fin -->

      <h3>7. COMUNICACIÓN, PARTICIPACIÓN Y CONSULTA</h3>

    <div class="bg-white mt-3 p-3">
    <div id="DivListaComunicacion"></div>
    </div>

    <div class="row mt-3">
       <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12">
          <div class="p-3 bg-white">   
          <div class="row">
          <div class="col-10">
          <h5 class="text-primary">Quejas y sugerencias</h5>
          </div>
          <div class="col-2 text-end">
          <a onclick="btnQuejasS()" style="cursor: pointer;" data-toggle="tooltip" data-placement="left" title="Crear" >
          <img src="<?php echo RUTA_IMG_ICONOS."agregar.png"; ?>">
          </a>
          </div>
          </div>
          <div id="DivListaQuejasS"></div>
          </div>            
        </div>
      </div>

    </div>

  <div class="modal fade bd-example-modal-lg" id="myModalComunicacion" data-backdrop="static">
    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
      <div class="modal-content" style="border-radius: 0px;border: 0px;">
        <div class="modal-header rounded-0 head-modal">
          <h4 class="modal-title text-white">Bienvenido al elemento 7. COMUNICACIÓN, PARTICIPACIÓN Y CONSULTA, del Sistema de Administración</h4>
        </div>
        <div class="modal-body">

          <p class="text-justify" style="font-size: 1.1em">
            Aquí vas a encontrar el formato para el registro y seguimiento de la comunicación interna y externa de la empresa.</b>.
          </p>
          <hr>
          <label class="font-weight-bold" style="font-size: 1.1em">Que se comunica:</label>
          <ul style="font-size: 1.1em">
          <li>Implementación del Sistema de Administración</li>
          <li>Política, objetivos y Metas</li>
          <li>Cumplimiento de requisitos legales</li>
          <li>Actos y condiciones inseguras</li>
          <li>Situaciones de emergencia</li>
          <li>Respuesta a quejas</li>
          </ul>

          <hr>
          <label class="font-weight-bold" style="font-size: 1.1em">Como hacerlo:</label>
          <ul style="font-size: 1.1em">
          <li>Atreves del correo electrónico</li>
          <li>Vía telefónica</li>
          <li>Distribución de minutas y actas de reuniones</li>
          <li>Tableros, carteles, trípticos</li>
          <li>Portal AdmonGas</li>
          </ul>
          <hr>

          <label class="font-weight-bold" style="font-size: 1.1em">Responsables:</label>
          <p class="text-justify" style="font-size: 1.1em">Recuerda que es responsabilidad del <a class="text-danger font-weight-bold">Representante Técnico</a> (RT), <a class="text-danger font-weight-bold">Gerente de la Estación</a>, hacer los registros del seguimiento a quejas y sugerencias de los clientes (Comunicación Externa), así como también registrar la comunicación interna que no se halla ejecutado a través del portal.
          </p>
          <p>
            <label class="text-danger font-weight-bold">¡Importante!</label><br>
            Las quejas son una oportunidad para afianzar nuestra relación con el cliente, se sentirá atendido, escuchado y como parte valiosa que aporta información de la empresa, por lo que, si aún no cuentas con un <b>buzón de quejas y sugerencias</b>, es momento de hacerlo.
          </p>
          <p class="text-secondary" style="font-size: .9em;">*El buzón debe ser colocado en una parte visible de la estación y debe de contar en todo momento con papel y pluma, recuerda revisar el contenido una vez al mes y dar seguimiento.</p>



        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-primary" style="border-radius: 0px;" onclick="btnFinAyuda(<?=$id_ayuda;?>,<?=$estado;?>)">Aceptar</button>
        </div>
      </div>
    </div>
    </div>

     <div class="modal fade bd-example-modal-lg" id="myModalNuevo" data-backdrop="static">
    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
      <div class="modal-content" style="border-radius: 0px;border: 0px;">
        <div class="modal-header rounded-0 head-modal">
          <h5 class="modal-title text-white">Registro de la atención y el seguimiento a la comunicación interna y externa.</h5>
          <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">

         
          <div class="form-group">
         <label for="temacomunicar" class="text-secondary" >Tema a comunicar:</label>
         <input type="text" class="form-control" name="" id="temacomunicar" style="border-radius: 0px;" placeholder="Agregar tema a comunicar">
         </div>

         <div class="form-group">
         <label for="detalle" class="text-secondary">Detalle:</label>
         <textarea class="form-control" id="detalle" placeholder="Agregar Detalle" rows="6" style="border-radius: 0px;"></textarea>
         </div>

          <div class="form-group">
          <label for="tipocomunicacion" class="text-secondary">Tipo de comunicación: </label>
          <select class="form-control" id="tipocomunicacion" onchange="tipoCom(this)" style="border-radius: 0px;">
            <option value="">Selecciona</option>
            <option value="Interna">Interna</option>
            <option value="Externa">Externa</option>
          </select>
        </div>

          <div class="form-group">
          <label for="materialcomunicar" class="text-secondary">Material utilizado para la comunicación: </label>
          <select class="form-control" id="materialcomunicar" style="border-radius: 0px;">
            <option value="">Selecciona</option>
            <option value="Correo electrónico">Correo electrónico</option>
            <option value="Vía telefónica">Vía telefónica</option>
            <option value="Minutas y actas de reuniones">Minutas y actas de reuniones</option>
            <option value="Tableros, carteles, trípticos">Tableros, carteles, trípticos</option>
            <option value="Portal AdmonGas">Portal AdmonGas</option>
          </select>
        </div>

         <div class="row">
      
      <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12 mb-2"> 
      <label for="dirigidoa" class="text-secondary">Dirigido a: </label>
      <div id="borderdirigidoa" style="border: 1px solid #DFDFDF;">
      <select class="selectpicker" id="dirigidoa" data-width="100%" multiple title="Selecciona" disabled>
       <?php
           $sql_puesto = "SELECT * FROM tb_puestos WHERE estatus = 0";
          $result_puesto = mysqli_query($con, $sql_puesto);
          $numero_puesto = mysqli_num_rows($result_puesto);
          while($row_puesto = mysqli_fetch_array($result_puesto, MYSQLI_ASSOC)){
            echo "<option value='".$row_puesto['id']."'>".$row_puesto['tipo_puesto']."</option>";
          }
            ?>
      </select>
      </div>
          </div>
      
      <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12 mb-2"> 
           <label for="seguimientocomunicacion" class="text-secondary" >Seguimiento de la comunicación:</label>
            <select class="form-control" id="seguimientocomunicacion" style="border-radius: 0px;border: 1px solid #DFDFDF;background: #FAFAFA;font-size: 1em;color: #C7C7C7;" disabled>
            <option value="">Selecciona</option>
            <option value="Correo electrónico">Correo electrónico</option>
            <option value="Vía telefónica">Vía telefónica</option>
          </select>
          </div>
         </div>



        </div>
        <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" style="border-radius: 0px;">Cancelar</button>
        <button type="button" class="btn btn-primary" style="border-radius: 0px;" onclick="btnAgregar()">Crear</button>
        </div>
      </div>
    </div>
    </div>

    <!---------------------------------------------------------------------------------------------------->

    <div class="modal fade bd-example-modal-lg" id="ModalQS" data-backdrop="static">
    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
      <div class="modal-content" style="border-radius: 0px;border: 0px;">
        <div class="modal-header rounded-0 head-modal">
          <h5 class="modal-title text-white">Quejas y sugerencias</h5>
          <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">

          <b>1. Datos para ser llenados por el cliente</b>
         
          <div class="form-group">
         <label for="temacomunicar" class="text-secondary" >Fecha:</label>
         <input type="date" class="form-control" name="" id="QSFecha" style="border-radius: 0px;">
         </div>

         <div class="form-group">
         <label for="temacomunicar" class="text-secondary" >Nombre:</label>
         <input type="text" class="form-control" name="" id="QSNombre" style="border-radius: 0px;">
         </div>

         <div class="form-group">
         <label for="temacomunicar" class="text-secondary" >Exposición de los motivos y del hecho causante: </label>
         <textarea id="QSMotivosCausas" class="form-control" style="border-radius: 0px;"></textarea>
         </div>

         <div class="form-group">
         <label for="temacomunicar" class="text-secondary" >Nombre de a quien va dirigida la queja:</label>
         <input type="text" class="form-control" name="" id="QSNombreDirigido" style="border-radius: 0px;">
         </div>

          <div class="form-group">
         <label for="temacomunicar" class="text-secondary" >Datos de contacto:</label>
         <input type="text" class="form-control" name="" id="QSContacto" style="border-radius: 0px;">
         </div>

         <hr>

         <b>2. Datos a ser llenados por quien atiende la queja</b>

         <div class="form-group">
         <label for="temacomunicar" class="text-secondary" >Nombre y puesto de quien atiende la queja:</label>
         <input type="text" class="form-control" name="" id="QSNombrePuesto" style="border-radius: 0px;">
         </div>

         <div class="form-group">
         <label for="temacomunicar" class="text-secondary" >Efectos o consecuencias de la queja:</label>
         <textarea id="QSEfectosConsecuencias" class="form-control" style="border-radius: 0px;"></textarea>
         </div>

         <div class="form-group">
         <label for="temacomunicar" class="text-secondary" >Solución propuesta y adoptada:</label>
         <textarea id="QSSolucion" class="form-control" style="border-radius: 0px;"></textarea>
         </div>

         <div class="form-group">
         <label for="temacomunicar" class="text-secondary" >Plazo para llevarla a cabo:</label>
         <input type="text" class="form-control" name="" id="QSPlazo" style="border-radius: 0px;">
         </div>

         <div class="form-group">
         <label for="temacomunicar" class="text-secondary" >Confirmación de la resolución: </label>
         <input type="text" class="form-control" name="" id="QSConfirmacion" style="border-radius: 0px;">
         </div>


        </div>
        <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" style="border-radius: 0px;">Cancelar</button>
        <button type="button" class="btn btn-primary" style="border-radius: 0px;" onclick="btnAgregarQS()">Crear</button>
        </div>
      </div>
    </div>
    </div>

       <!---------------------------------------------------------------------------------------------------->

    <div class="modal fade bd-example-modal-lg" id="ModalBuscar" data-backdrop="static">
    <div class="modal-dialog modal-sm modal-dialog-centered" role="document">
      <div class="modal-content" style="border-radius: 0px;border: 0px;">
        <div class="modal-header rounded-0 head-modal">
          <h5 class="modal-title text-white">Buscar</h5>
          <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">


        <div class="form-group">
         <label class="text-secondary" >Agregar Año: </label>
         <input type="text" class="form-control" name="" id="BuscarYear" style="border-radius: 0px;">
         </div>


        </div>
        <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" style="border-radius: 0px;">Cancelar</button>
        <button type="button" class="btn btn-primary" style="border-radius: 0px;" onclick="btnBuscar(<?=$Session_IDEstacion;?>)">Buscar</button>
        </div>
      </div>
    </div>
    </div>

    <div class="modal fade bd-example-modal-lg" id="ModalEditar" data-backdrop="static">
    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
    <div class="modal-content" style="border-radius: 0px;border: 0px;">
    <div id="DivContenido"></div>

    </div>
    </div>
    </div>

    <div class="modal fade bd-example-modal-lg" id="myModalDetalle" data-backdrop="static">
    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
    <div class="modal-content" style="border-radius: 0px;border: 0px;">
    <div id="DivDetalle"></div> 
    </div>
    </div>
    </div> 
  
    <script src="<?=RUTA_JS?>bootstrap.min.js"></script>
    <script src="<?=RUTA_JS?>bootstrap-select.min.js"></script>
    <!---------- LIBRERIAS DEL DATATABLE ---------->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/pdfmake.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/vfs_fonts.js"></script>
  <script src="https://cdn.datatables.net/v/bs5/jszip-3.10.1/dt-2.0.3/b-3.0.1/b-colvis-3.0.1/b-html5-3.0.1/b-print-3.0.1/datatables.min.js"></script>
  </body>
  </html>
