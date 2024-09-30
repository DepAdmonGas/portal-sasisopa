<?php
require('app/help.php');
include_once "app/modelo/Ayuda.php";

$class_ayuda = new Ayuda();
$array_ayuda = $class_ayuda->sasisopaAyuda($Session_IDUsuarioBD,'4-objetivos-metas-indicadores');
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

.card-hover:hover{
  background: rgba(247, 247, 247, .9);
  transition: all 1s ease;
}
  </style>
  <script type="text/javascript">
  $(document).ready(function(){
  $('[data-toggle="tooltip"]').tooltip();
  $(".LoaderPage").fadeOut("slow");
  <?php if ($id_ayuda != 0) {echo "btnAyuda();";} ?>

  SeguimientoObjetivosMetas();
  SeguimientoReporteIndicador();

  });
  function regresarP(){
    window.history.back();
  }
  //------------------------------
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
  //-------------------------------
 
  function BtnCapacitacionPersonal(){
  window.location.href = '4-objetivos-metas-indicadores/capacitacion-personal'; 
  }

  function BtnExpCliente(){
  window.location.href = '4-objetivos-metas-indicadores/experiencia-cliente';
  }

  function BtnVentas(){
  window.location.href = '4-objetivos-metas-indicadores/indicador-ventas';
  }
  //------------------------------------------------------------------------
  function SeguimientoObjetivosMetas(){
   $('#ContenidoSOM').load('app/vistas/sasisopa/elemento4/seguimiento-objetivos-metas.php');  
  }

  function ModalSOM(){
    $('#ModalSOM').modal('show'); 
  }

  function btnCrearSOM(){

var Dato1 = $('#Dato1').val();
var Dato2 = $('#Dato2').val();
var Dato3 = $('#Dato3').val();
var Dato4 = $('#Dato4').val();
var Dato5 = $('#Dato5').val();
var Dato6 = $('#Dato6').val();
var Dato7 = $('#Dato7').val();
var Dato8 = $('#Dato8').val();
var Dato9 = $('#Dato9').val();
var Dato10 = $('#Dato10').val();
var Dato11 = $('#Dato11').val();
var Dato12 = $('#Dato12').val();
var Dato13 = $('#Dato13').val();
var Dato14 = $('#Dato14').val();
var Dato15 = $('#Dato15').val();
var Dato16 = $('#Dato16').val();
var Dato17 = $('#Dato17').val();
var Dato18 = $('#Dato18').val();
var Dato19 = $('#Dato19').val();
var Dato20 = $('#Dato20').val();

var parametros = {
"accion" : "agregar-seguimiento-objetivos-metas",
"Dato1" : Dato1,
"Dato2" : Dato2,
"Dato3" : Dato3,
"Dato4" : Dato4,
"Dato5" : Dato5,
"Dato6" : Dato6,
"Dato7" : Dato7,
"Dato8" : Dato8,
"Dato9" : Dato9,
"Dato10" : Dato10,
"Dato11" : Dato11,
"Dato12" : Dato12,
"Dato13" : Dato13,
"Dato14" : Dato14,
"Dato15" : Dato15,
"Dato16" : Dato16,
"Dato17" : Dato17,
"Dato18" : Dato18,
"Dato19" : Dato19,
"Dato20" : Dato20
};

alertify.confirm('',
function(){

$.ajax({
data:  parametros,
url:   'app/controlador/ObjetivosMetasIndicadoresControlador.php',
type:  'post',
beforeSend: function() {
},
complete: function(){
},
success:  function (response) {

if(response){

$('#ModalSOM').modal('hide'); 
$('#Dato1').val('');
$('#Dato2').val('');
$('#Dato3').val('');
$('#Dato4').val('');
$('#Dato5').val('');
$('#Dato6').val('');
$('#Dato7').val('');
$('#Dato8').val('');
$('#Dato9').val('');
$('#Dato10').val('');
$('#Dato11').val('');
$('#Dato12').val('');
$('#Dato13').val('');
$('#Dato14').val('');
$('#Dato15').val('');
$('#Dato16').val('');
$('#Dato17').val('');
$('#Dato18').val('');
$('#Dato19').val('');
$('#Dato20').val('');

SeguimientoObjetivosMetas();

}else{
alertify.error('Error al crear el registro'); 
}


}
});

},
function(){
}).setHeader('Seguimiento de objetivos y metas').set({transition:'zoom',message: 'Desea agregar la siguiente información',labels:{ok:'Aceptar', cancel: 'Cancelar'}}).show();

}

function ModalDSOM(id){
  $('#ModalDetalle').modal('show'); 
  $('#DivDetalle').load('app/vistas/sasisopa/elemento4/detalle-seguimiento-objetivos-metas.php?idSeguimiento=' + id);  
  }

  function EditarDSOM(id){
$('#DivDetalle').load('app/vistas/sasisopa/elemento4/modal-seguimiento-objetivos-metas.php?idSeguimiento=' + id); 
}

function BtnEditSOM(val,opcion,id){
  
let detalle = val.value;

let parametros = {
  "accion" : "editar-seguimiento-objetivo-metas",
  "idSeguimiento" : id,
  "opcion" : opcion,
  "detalle" : detalle
  };

  $.ajax({
  data:  parametros,
  url:   'app/controlador/ObjetivosMetasIndicadoresControlador.php',
  type:  'post',
  beforeSend: function() {
  },
  complete: function(){
  },
  success:  function (response) {

  }
  });

}

function btnReturnSOM(id){
SeguimientoObjetivosMetas()
$('#DivDetalle').load('app/vistas/sasisopa/elemento4/detalle-seguimiento-objetivos-metas.php?idSeguimiento=' + id); 
}

function EliminarObjetivo(seccion,id){

var parametros = {
"accion" : "eliminar-objetivos-metas-indicadores",
"seccion" : seccion,
"id" : id
};

alertify.confirm('',
function(){

  $.ajax({
 data:  parametros,
 url:   'app/controlador/ObjetivosMetasIndicadoresControlador.php',
 type:  'post',
 beforeSend: function() {
 },
 complete: function(){
 },
 success:  function (response) {

if(response == 1){

SeguimientoObjetivosMetas()
SeguimientoReporteIndicador()

$('#ModalDetalle').modal('hide');

}else{
 alertify.error('Error al eliminar el registro'); 
}

 }
 });

},
function(){
}).setHeader('Mensaje').set({transition:'zoom',message: 'Desea eliminar la información',labels:{ok:'Aceptar', cancel: 'Cancelar'}}).show();
}
//--------------------------------------------------------
//-----------------------------------------------------

 function SeguimientoReporteIndicador(){    
  let targets = [1,2];
  $('#ContenidoSRI').load('app/vistas/sasisopa/elemento4/seguimiento-reporte-indicadores.php', function() {
  $('#tabla-seguimiento-reporte-indicadores').DataTable({
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

  function ModalSRI(){
  $('#ModalSRI').modal('show'); 
  }

  function btnCrearSRI(){
  var Fecha = $('#Fecha').val();
  var Capacitacion = $('#Capacitacion').val();
  var ExperienciaC = $('#ExperienciaC').val();
  var Ventas = $('#Ventas').val();
  var MedidasC = $('#MedidasC').val();
  var FechaAplicacion = $('#FechaAplicacion').val();

if(Fecha != ""){
$('#Fecha').css('border','');
if(Capacitacion != ""){
$('#Capacitacion').css('border','');
if(ExperienciaC != ""){
$('#ExperienciaC').css('border','');
if(Ventas != ""){
$('#Ventas').css('border','');
if(MedidasC != ""){
$('#MedidasC').css('border','');
if(FechaAplicacion != ""){
$('#FechaAplicacion').css('border','');

var parametros = {
"accion" : "agregar-seguimiento-reporte-indicador",
"Fecha" : Fecha,
"Capacitacion" : Capacitacion,
"ExperienciaC" : ExperienciaC,
"Ventas" : Ventas,
"MedidasC" : MedidasC,
"FechaAplicacion" : FechaAplicacion
};

alertify.confirm('',
function(){

$.ajax({
 data:  parametros,
 url:   'app/controlador/ObjetivosMetasIndicadoresControlador.php',
 type:  'post',
 beforeSend: function() {
 },
 complete: function(){
 },
 success:  function (response) {

if(response == 1){

SeguimientoReporteIndicador()

$('#ModalSRI').modal('hide'); 
$('#Fecha').val("");
$('#Capacitacion').val("");
$('#ExperienciaC').val("");
$('#Ventas').val("");
$('#MedidasC').val("");
$('#FechaAplicacion').val("");

}else{
 alertify.error('Error al crear el registro'); 
}


 }
 });

},
function(){
}).setHeader('Seguimiento y reporte de indicadores').set({transition:'zoom',message: 'Desea agregar la siguiente información',labels:{ok:'Aceptar', cancel: 'Cancelar'}}).show();


}else{
$('#FechaAplicacion').css('border','2px solid #A52525');
}
}else{
$('#MedidasC').css('border','2px solid #A52525');
}
}else{
$('#Ventas').css('border','2px solid #A52525');
}
}else{
$('#ExperienciaC').css('border','2px solid #A52525');
}
}else{
$('#Capacitacion').css('border','2px solid #A52525');
}
}else{
$('#Fecha').css('border','2px solid #A52525');
}

  }



function ModalDSRI(id){
$('#ModalDetalle').modal('show'); 
$('#DivDetalle').load('app/vistas/sasisopa/elemento4/detalle-seguimiento-reporte-indicadores.php?idSeguimiento=' + id);  
}
//------------------------------------------------------------

function ModalEditSRI(id){
  $('#ModalDetalle').modal('show'); 
  $('#DivDetalle').load('app/vistas/sasisopa/elemento4/modal-seguimiento-reporte-indicadores.php?idSeguimiento=' + id);  
}

function btnEditSRI(idSeguimiento){
  var EditFecha = $('#EditFecha').val();
  var EditCapacitacion = $('#EditCapacitacion').val();
  var EditExperienciaC = $('#EditExperienciaC').val();
  var EditVentas = $('#EditVentas').val();
  var EditMedidasC = $('#EditMedidasC').val();
  var EditFechaAplicacion = $('#EditFechaAplicacion').val();

  if(EditFecha != ""){
  $('#EditFecha').css('border','');
  if(EditCapacitacion != ""){
  $('#EditCapacitacion').css('border','');
  if(EditExperienciaC != ""){
  $('#EditExperienciaC').css('border','');
  if(EditVentas != ""){
  $('#EditVentas').css('border','');
  if(EditMedidasC != ""){
  $('#EditMedidasC').css('border','');
  if(EditFechaAplicacion != ""){
  $('#EditFechaAplicacion').css('border','');

  var parametros = {
  "accion" : "editar-seguimiento-reporte-indicador",
  "idSeguimiento" : idSeguimiento,
  "EditFecha" : EditFecha,
  "EditCapacitacion" : EditCapacitacion,
  "EditExperienciaC" : EditExperienciaC,
  "EditVentas" : EditVentas,
  "EditMedidasC" : EditMedidasC,
  "EditFechaAplicacion" : EditFechaAplicacion
  };

  alertify.confirm('',
  function(){

  $.ajax({
  data:  parametros,
  url:   'app/controlador/ObjetivosMetasIndicadoresControlador.php',
  type:  'post',
  beforeSend: function() {
  },
  complete: function(){
  },
  success:  function (response) {

  if(response == 1){

  SeguimientoReporteIndicador()

  $('#ModalDetalle').modal('hide'); 
  $('#EditFecha').val("");
  $('#EditCapacitacion').val("");
  $('#EditExperienciaC').val("");
  $('#EditVentas').val("");
  $('#EditMedidasC').val("");
  $('#EditFechaAplicacion').val("");

  }else{
  alertify.error('Error al crear el registro'); 
  }

  }
  });

  },
  function(){
  }).setHeader('Seguimiento y reporte de indicadores').set({transition:'zoom',message: 'Desea agregar la siguiente información',labels:{ok:'Aceptar', cancel: 'Cancelar'}}).show();


  }else{
  $('#EditFechaAplicacion').css('border','2px solid #A52525');
  }
  }else{
  $('#EditMedidasC').css('border','2px solid #A52525');
  }
  }else{
  $('#EditVentas').css('border','2px solid #A52525');
  }
  }else{
  $('#EditExperienciaC').css('border','2px solid #A52525');
  }
  }else{
  $('#EditCapacitacion').css('border','2px solid #A52525');
  }
  }else{
  $('#EditFecha').css('border','2px solid #A52525');
  }

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
    <li aria-current="page" class="breadcrumb-item active">4. OBJETIVOS, METAS E INDICADORES</li>
    </ol>
    </div>
    <!-- Fin -->

    <h3>4. OBJETIVOS, METAS E INDICADORES</h3>

    <div class="mt-3">
    <div class="row">
    
    <!-- CARD OBJETIVO -->
     <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12 mt-2 mb-2"> 
     <div class="card border-0 rounded-0">
      <div class="p-4">
      <h4 class="text-primary">OBJETIVO</h4>
      <p class="fw-light fs-5">Brindar a nuestros clientes una experiencia inigualable al cargar combustible o recibir alguno de
              nuestros servicios en cualquiera de nuestras sucursales del grupo Admongas.</p>
      </div>
      </div>
    </div>


    <!-- CARD METAS -->
    <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12 mt-2 mb-2"> 
    <div class="card border-0 rounded-0">
      <div class="p-4">
      <h4 class="text-primary">METAS</h4>
      
          <ul class="fw-light fs-5">
          <li>Asegurar el bienestar de nuestros empleados utilizando siempre los mejores estándares de calidad.</li>
          <li>Mantener en excelentes condiciones la estación de servicio contando con personal
          altamente capacitado tanto en operación como en mantenimiento.</li>
          <li>Atender peticiones de quejas y sugerencias por parte de los clientes. </li>
          <li>Cumplir con la legislación aplicable vigente.</li>
          </ul>

      </div>
      </div>
    </div>

    </div>
    </div>

    <h4 class="mt-3">INDICADORES</h4>

    <div class="row">
         
      <!-- Card - Capacitacion del Personal -->
      <div class="col-xl-3 col-lg-3 col-md-3 col-sm-12 mt-2 mb-2"> 

        <div class="card card-hover" onclick="BtnCapacitacionPersonal()" style="border-radius: 0px;border-bottom: 2px solid #088AD9;cursor: pointer;">
        <div class="card-body">
          <div class="text-center" style="padding: 10px;"><img src="<?php echo RUTA_IMG_ICONOS."presentacion.png"; ?>"></div>
          <div class="text-center fw-light fs-4">Capacitación del personal</div>
          </div>
          </div>

      </div>

      <!-- Card - Experiencia cliente -->
      <div class="col-xl-3 col-lg-3 col-md-3 col-sm-12 mt-2 mb-2"> 

        <div class="card card-hover" onclick="BtnExpCliente()" style="border-radius: 0px;border-bottom: 2px solid #088AD9;cursor: pointer;">
         <div class="card-body">
          <div class="text-center" style="padding: 10px;"><img src="<?php echo RUTA_IMG_ICONOS."presentacion.png"; ?>"></div>
          <div class="text-center fw-light fs-4">Experiencia del cliente</div>
          </div>
           </div>

      </div>

      <!-- Card - Ventas -->
      <div class="col-xl-3 col-lg-3 col-md-3 col-sm-12 mt-2 mb-2"> 

        <div class="card card-hover" onclick="BtnVentas()" style="border-radius: 0px;border-bottom: 2px solid #088AD9;cursor: pointer;">
        <div class="card-body">
          <div class="text-center" style="padding: 10px;"><img src="<?php echo RUTA_IMG_ICONOS."presentacion.png"; ?>"></div>
        <div class="text-center  fw-light fs-4">Ventas</div>
        </div>
           </div>

      </div>
       
    </div>


    <div class="row mt-3">

      <!-- TABLA SEGUIMIENTO DE OBJETIVOS Y METAS -->
      
      <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12 mt-2 mb-3"> 
        <div class="bg-white p-3">
        <div class="row">
        <div class="col-8">
        <h5 class="text-primary">Seguimiento de objetivos y metas</h5>
        </div>
        <div class="col-4">
        <a class="float-end" href="app/vistas/sasisopa/elemento4/seguimiento-objetivos-mestas-pdf.php" data-toggle="tooltip" data-placement="left" title="Descargar" >
        <img src="<?php echo RUTA_IMG_ICONOS."pdf.png"; ?>">
        </a>
        <a class="float-end me-2 c-cursor" onclick="ModalSOM()" style="cursor: pointer;" data-toggle="tooltip" data-placement="left" title="Agregar" >
          <img src="<?php echo RUTA_IMG_ICONOS."agregar.png"; ?>">
          </a>
        </div>
        </div>    
        <div id="ContenidoSOM"></div> 
        </div>
      </div>

      <!-- TABLA SEGUIMIENTO DE OBJETIVOS Y METAS -->
      <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12 mt-2 mb-3"> 
      <div class="bg-white p-3">
      <div class="row">   
        <div class="col-8">
        <h5 class="text-primary">Seguimiento y reporte de indicadores</h5>
        </div>
        <div class="col-4">         

          <a class="float-end" href="app/vistas/sasisopa/elemento4/seguimiento-reporte-indicadores-pdf.php" data-toggle="tooltip" data-placement="left" title="Descargar" >
            <img src="<?php echo RUTA_IMG_ICONOS."pdf.png"; ?>">
          </a>
          <a class="float-end me-2 c-cursor" onclick="ModalSRI()" >
            <img src="<?php echo RUTA_IMG_ICONOS."agregar.png"; ?>" data-toggle="tooltip" data-placement="left" title="Agregar">
          </a>

        </div>
        </div>
          <div id="ContenidoSRI"></div>
        </div>      
      </div>
    </div>
    </div>


  <div class="modal fade bd-example-modal-lg" id="ModalAyuda" data-backdrop="static">
    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
      <div class="modal-content" style="border-radius: 0px;border: 0px;">
        <div class="modal-header rounded-0 head-modal">
          <h4 class="modal-title text-white">Bienvenido al elemento 4. OBJETIVOS, METAS E INDICADORES, del Sistema de Administración</h4>
        </div>
        <div class="modal-body">

          <p class="text-justify" style="font-size: 1.1em">
            Aquí vas a poder consultar los objetivos y metas de la empresa, así como también visualizar las gráficas de los siguientes indicadores: Capacitación del personal, Experiencia del cliente y Ventas.
          </p>

          <hr>

          <label class="font-weight-bold" style="font-size: 1.1em">Como hacerlo:</label>
          <ul style="font-size: 1.1em">
            <li>Para evaluar la experiencia del cliente se tendrá que realizar cada 6 meses una encuesta de satisfacción (Dar clic en el botón PDF para descargarla e imprimirla)</li>
            <li>Se deberá coordinar para que en una semana se realicen el mayor número de encuestas a los clientes</li>
            <li>El resultado de cada una de las encuestas deberá ser vaciado en el apartado experiencia del cliente</li>
          </ul>

          <hr>

          <label class="font-weight-bold" style="font-size: 1.1em">Responsables:</label>
          <p class="text-justify" style="font-size: 1.1em">Recuerda que es responsabilidad del <label class="text-danger font-weight-bold">Representante Técnico</label> (RT), <label class="text-danger font-weight-bold">Gerente de la Estación</label>, <label class="text-danger font-weight-bold">Jefes de Piso</label> y <label class="text-danger font-weight-bold">Despachadores</label> obtener los resultados del indicador Experiencia del cliente, así como proponer medidas necesarias para el logro de objetivos, metas e indicadores..</p>

        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-primary" style="border-radius: 0px;" onclick="btnFinAyuda(<?=$id_ayuda;?>,<?=$estado;?>)">Aceptar</button>
        </div>
      </div>
    </div>
    </div>

    <!------------------------------->

    <div class="modal fade bd-example-modal-lg" id="ModalSRI" data-backdrop="static">
<div class="modal-dialog modal-lg modal-dialog-centered" role="document">
<div class="modal-content" style="border-radius: 0px;border: 0px;">
 <div class="modal-header rounded-0 head-modal">
   <h4 class="modal-title text-white">Seguimiento y reporte de indicadores</h4>
   <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
 </div>
 <div class="modal-body">


<div>Fecha:</div>
<input type="date" class="form-control rounded-0 mt-2" id="Fecha">

<div class="mt-2 mb-2">Capacitacion:</div>
<textarea class="form-control rounded-0 mt-2" id="Capacitacion"></textarea>

<div class="mt-2 mb-2">Experiencia del cliente:</div>
<textarea class="form-control rounded-0 mt-2" id="ExperienciaC"></textarea>

<div class="mt-2 mb-2">Ventas:</div>
<textarea class="form-control rounded-0 mt-2" id="Ventas"></textarea>

<div class="mt-2 mb-2">Medidas correctivas:</div>
<textarea class="form-control rounded-0 mt-2" id="MedidasC"></textarea>

<div class="mt-2 mb-2">Fecha de aplicación:</div>
<input type="date" class="form-control rounded-0 mt-1" id="FechaAplicacion">

 </div>
 <div class="modal-footer">
<button type="button" class="btn btn-primary" style="border-radius: 0px;" onclick="btnCrearSRI()">Guardar</button>
 </div>
</div>
</div>
</div>

<!----------------------->

<div class="modal fade bd-example-modal-lg" id="ModalSOM" data-backdrop="static">
<div class="modal-dialog modal-lg modal-dialog-centered" role="document">
<div class="modal-content" style="border-radius: 0px;border: 0px;">
 <div class="modal-header rounded-0 head-modal">   
   <h4 class="modal-title text-white">Seguimiento de objetivos y metas</h4>
   <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
 </div>

 <div class="modal-body">

  <div class="border p-2">    
    <h5>Satisfacción del cliente</h5>
    <hr>

    <div class="row mt-1">

      <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12"> 
        <div class="mb-2">Fecha:</div>
        <input type="date" class="form-control" id="Dato1">

        <div class="mt-2 mb-1">Medidas de acción para dar cumplimiento:</div>
        <textarea class="form-control" rows="1" id="Dato3"></textarea>
      </div>

      <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12"> 
        <div class="mb-1">Nivel de cumplimiento:</div>
        <input type="text" class="form-control" id="Dato2">

        <div class="mt-2 mb-1">Fecha de aplicación :</div>
        <input type="date" class="form-control" id="Dato4">
      </div>
    </div>

  </div>

    <div class="border p-2 mt-3">    
    <h5>Mantenimiento</h5>
    <hr>
    
    <div class="row mt-1">
      
       <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12"> 
        <div class="mb-1">Fecha:</div>
        <input type="date" class="form-control" id="Dato5">

        <div class="mt-2 mb-1">Medidas de acción para dar cumplimiento:</div>
        <textarea class="form-control" rows="1" id="Dato7"></textarea>
      </div>

       <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12"> 
        <div class="mb-1">Nivel de cumplimiento:</div>
        <input type="text" class="form-control" id="Dato6">

        <div class="mt-2 mb-1">fecha de aplicación :</div>
        <input type="date" class="form-control" id="Dato8">
      </div>
    </div>
  </div>

    <div class="border p-2 mt-3">    
    <h5>Capacitación</h5>
   
    <div class="row">

         <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12"> 
        <div class="mb-1">Fecha:</div>
        <input type="date" class="form-control" id="Dato9">

        <div class="mt-2 mb-1">Medidas de acción para dar cumplimiento:</div>
        <textarea class="form-control" rows="1" id="Dato11"></textarea>
      </div>


         <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12"> 
        <div class="mb-1">Nivel de cumplimiento:</div>
        <input type="text" class="form-control" id="Dato10">

        <div class="mt-2 mb-1">fecha de aplicación :</div>
        <input type="date" class="form-control" id="Dato12">
      </div>


    </div>
  </div>

      <div class="border p-2 mt-3">    
    <h5>Quejas y sugerencias</h5>
    <div class="row">


         <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12"> 
        <div class="mb-1">Fecha:</div>
        <input type="date" class="form-control" id="Dato13">

        <div class="mt-2 mb-1">Medidas de acción para dar cumplimiento:</div>
        <textarea class="form-control" rows="1" id="Dato15"></textarea>
      </div>


         <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12"> 
        <div class="mb-1">Nivel de cumplimiento:</div>
        <input type="text" class="form-control" id="Dato14">

        <div class="mt-2 mb-1">fecha de aplicación :</div>
        <input type="date" class="form-control" id="Dato16">
      </div>
    </div>
  </div>

    <div class="border p-2 mt-3">    
    <h5>Cumplimiento de legislación </h5>
    <div class="row">
      

         <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12"> 
        <div class="mb-1">Fecha:</div>
        <input type="date" class="form-control" id="Dato17">

        <div class="mt-2">Medidas de acción para dar cumplimiento:</div>
        <textarea class="form-control" rows="1" id="Dato19"></textarea>
      </div>

         <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12"> 
        <div class="mb-1">Nivel de cumplimiento:</div>
        <input type="text" class="form-control" id="Dato18">

        <div class="mt-2 mb-1">Fecha de aplicación :</div>
        <input type="date" class="form-control" id="Dato20">
      </div>
    </div>
  </div>


 </div>
 <div class="modal-footer">
<button type="button" class="btn btn-primary" style="border-radius: 0px;" onclick="btnCrearSOM()">Guardar</button>
 </div>
</div>
</div>
</div>

<!----------------------------------->

    <div class="modal fade bd-example-modal-lg" id="ModalDetalle" data-backdrop="static">
    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
      <div class="modal-content" style="border-radius: 0px;border: 0px;">

        <div id="DivDetalle"></div>

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
