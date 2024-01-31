<?php
require('app/help.php');

$sql_sasisopa_ayuda = "SELECT * FROM pu_sasisopa_ayuda WHERE id_usuario = '".$Session_IDUsuarioBD."' and detalle = '4-objetivos-metas-indicadores' and estado = 0 LIMIT 1";
$result_sasisopa_ayuda = mysqli_query($con, $sql_sasisopa_ayuda);
$numero_sasisopa_ayuda = mysqli_num_rows($result_sasisopa_ayuda);

if ($numero_sasisopa_ayuda == 1) {
while($row_ayuda = mysqli_fetch_array($result_sasisopa_ayuda, MYSQLI_ASSOC)){
$idAyuda = $row_ayuda['id'];
}
}else{
$idAyuda = 0;
}
 
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
  <link rel="stylesheet" href="<?php echo RUTA_CSS ?>componentes.css">
  <link href="<?php echo RUTA_CSS ?>bootstrap.css" rel="stylesheet" />
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

.card-hover:hover{
  background: rgba(247, 247, 247, .9);
  transition: all 1s ease;
}
  </style>
  <script type="text/javascript">
  $(document).ready(function(){
  $('[data-toggle="tooltip"]').tooltip();
  $(".LoaderPage").fadeOut("slow");
  <?php if ($numero_sasisopa_ayuda == 1) {echo "btnAyuda();";} ?>

  SeguimientoObjetivosMetas();
  SeguimientoReporteIndicador();

  });
  function regresarP(){
    window.history.back();
  }
 
  function BtnCapacitacionPersonal(){
  window.location.href = '4-objetivos-metas-indicadores/capacitacion-personal'; 
  }
  function BtnVentas(){
  window.location.href = '4-objetivos-metas-indicadores/indicador-ventas';
  }
 
  function BtnExpCliente(){
  window.location.href = '4-objetivos-metas-indicadores/experiencia-cliente';
  }

  function btnAyuda(){
  $('#ModalAyuda').modal('show');
  }

function btnFinAyuda(){
var puntosSasisopa = <?=$numero_sasisopa_ayuda;?>;
 var parametros = {
        "idAyuda" : <?=$idAyuda; ?>
      };
  if (puntosSasisopa != 0) {
   $.ajax({
   data:  parametros,
   url:   'public/sasisopa/actualizar/actualizar-ayuda.php',
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

  function ModalSOM(){
    $('#ModalSOM').modal('show'); 
  }

  function ModalSRI(){
  $('#ModalSRI').modal('show'); 
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
 url:   'public/sasisopa/agregar/agregar-seguimiento-objetivos-metas.php',
 type:  'post',
 beforeSend: function() {
 },
 complete: function(){
 },
 success:  function (response) {

if(response == 1){

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

  function SeguimientoObjetivosMetas(){
   $('#ContenidoSOM').load('public/sasisopa/vistas/seguimiento-objetivos-metas.php');  
  }

  function ModalDSOM(id){
  $('#ModalDetalle').modal('show'); 
  $('#DivDetalle').load('public/sasisopa/vistas/detalle-seguimiento-objetivos-metas.php?idSeguimiento=' + id);  
  }

  //----------------------------------------------

  function SeguimientoReporteIndicador(){    
  $('#ContenidoSRI').load('public/sasisopa/vistas/seguimiento-reporte-indicadores.php');  
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
 url:   'public/sasisopa/agregar/agregar-seguimiento-reporte-indicador.php',
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

function EliminarObjetivo(seccion,id){

var parametros = {
"seccion" : seccion,
"id" : id
};

alertify.confirm('',
function(){

  $.ajax({
 data:  parametros,
 url:   'public/sasisopa/eliminar/eliminar-objetivos-metas-indicadores.php',
 type:  'post',
 beforeSend: function() {
 },
 complete: function(){
 },
 success:  function (response) {

if(response == 1){

SeguimientoObjetivosMetas()
SeguimientoReporteIndicador()

}else{
 alertify.error('Error al eliminar el registro'); 
}

 }
 });

},
function(){
}).setHeader('Mensaje').set({transition:'zoom',message: 'Desea eliminar la información',labels:{ok:'Aceptar', cancel: 'Cancelar'}}).show();
}

function ModalDSRI(id){
$('#ModalDetalle').modal('show'); 
$('#DivDetalle').load('public/sasisopa/vistas/detalle-seguimiento-reporte-indicadores.php?idSeguimiento=' + id);  
}
//------------------------------------------------------------

function ModalEditSRI(id){
  $('#ModalDetalle').modal('show'); 
  $('#DivDetalle').load('public/sasisopa/vistas/modal-seguimiento-reporte-indicadores.php?idSeguimiento=' + id);  
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
  url:   'public/sasisopa/actualizar/editar-seguimiento-reporte-indicador.php',
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
//-------------------------------------------------

function EditarDSOM(id){
$('#DivDetalle').load('public/sasisopa/vistas/modal-seguimiento-objetivos-metas.php?idSeguimiento=' + id); 
}

function BtnEditSOM(val,opcion,id){
  
let detalle = val.value;

let parametros = {
  "idSeguimiento" : id,
  "opcion" : opcion,
  "detalle" : detalle
  };

  $.ajax({
  data:  parametros,
  url:   'public/sasisopa/actualizar/editar-seguimiento-objetivo-metas.php',
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
$('#DivDetalle').load('public/sasisopa/vistas/detalle-seguimiento-objetivos-metas.php?idSeguimiento=' + id); 

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
   

    <!-- TITULO / ENCABEZADO -->
    <div class="float-left"><h4>4. OBJETIVOS, METAS E INDICADORES</h4>
    </div>

    <div class="float-right" style="margin-top: 6px;margin-left: 10px;">
    <a onclick="btnAyuda()" style="cursor: pointer;" data-toggle="tooltip" data-placement="left" title="Ayuda" >
    <img src="<?php echo RUTA_IMG_ICONOS."info.png"; ?>">
    </a>
    </div>
    </div>
    

    <div class="card-body">

    <div class="row">
    
    <!-- CARD OBJETIVO -->
     <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12 mt-2 mb-2"> 
    <div class="card" style="border-radius: 0px;">
      <div class="card-body">
      <h4 class="card-title">OBJETIVO</h4>
      <hr>

      <p style="font-size: 1.3em;">Brindar a nuestros clientes una experiencia inigualable al cargar combustible o recibir alguno de
              nuestros servicios en cualquiera de nuestras sucursales del grupo Admongas.
      </p>

      </div>
    </div>
    </div>


    <!-- CARD METAS -->
    <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12 mt-2 mb-2"> 

    <div class="card" style="border-radius: 0px;">
      <div class="card-body">
      <h4 class="card-title">METAS</h4>
      <hr>

      <ul style="font-size: 1.2em;">
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


    <!-- CARD INDICADORES -->
    <div class="row" style="margin-top: 20px;">
    <div class="col-12 mb-2">

    <div class="card" style="border-radius: 0px;">
    <div class="card-body">
    <h4 class="card-title">INDICADORES</h4>
    <hr>

    <div class="row">
         
      <!-- Card - Capacitacion del Personal -->
      <div class="col-xl-4 col-lg-4 col-md-4 col-sm-12 mt-2 mb-2"> 

        <div class="card card-hover" onclick="BtnCapacitacionPersonal()" style="border-radius: 0px;border-bottom: 2px solid #088AD9;cursor: pointer;">
        <div class="card-body">
          <div class="text-center" style="padding: 10px;"><img src="<?php echo RUTA_IMG_ICONOS."presentacion.png"; ?>"></div>
          <div class="text-center font-weight-bold" style="font-size: 1.2em;">Capacitación del personal</div>
          </div>
          </div>

      </div>


      <!-- Card - Experiencia cliente -->
      <div class="col-xl-4 col-lg-4 col-md-4 col-sm-12 mt-2 mb-2"> 

        <div class="card card-hover" onclick="BtnExpCliente()" style="border-radius: 0px;border-bottom: 2px solid #088AD9;cursor: pointer;">
         <div class="card-body">
          <div class="text-center" style="padding: 10px;"><img src="<?php echo RUTA_IMG_ICONOS."presentacion.png"; ?>"></div>
          <div class="text-center font-weight-bold" style="font-size: 1.2em;">Experiencia del cliente</div>
          </div>
           </div>

      </div>


      <!-- Card - Ventas -->
      <div class="col-xl-4 col-lg-4 col-md-4 col-sm-12 mt-2 mb-2"> 

        <div class="card card-hover" onclick="BtnVentas()" style="border-radius: 0px;border-bottom: 2px solid #088AD9;cursor: pointer;">
        <div class="card-body">
          <div class="text-center" style="padding: 10px;"><img src="<?php echo RUTA_IMG_ICONOS."presentacion.png"; ?>"></div>
        <div class="text-center font-weight-bold" style="font-size: 1.2em;">Ventas</div>
        </div>
           </div>

      </div>
         

    </div>
    </div>
    </div>
    </div>
    </div>

    <hr>

    <div class="row mt-3">

      <!-- TABLA SEGUIMIENTO DE OBJETIVOS Y METAS -->
      
      <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12 mt-2 mb-3"> 

      <div class="border">
        <div class="p-3">

        <div class="row">
        
        <div class="col-8">
        <h5>Seguimiento de objetivos y metas</h5>
        </div>

        <div class="col-4">
        <a class="float-right" href="public/sasisopa/vistas/seguimiento-objetivos-mestas-pdf.php" data-toggle="tooltip" data-placement="left" title="Descargar" >
        <img src="<?php echo RUTA_IMG_ICONOS."pdf.png"; ?>">
        </a>

        <a class="float-right mr-2" onclick="ModalSOM()" style="cursor: pointer;" data-toggle="tooltip" data-placement="left" title="Agregar" >
          <img src="<?php echo RUTA_IMG_ICONOS."agregar.png"; ?>">
          </a>
        </div>

        </div>
        <hr>
    
        <div id="ContenidoSOM"></div> 
        </div>
        </div>

    </div>




      <!-- TABLA SEGUIMIENTO DE OBJETIVOS Y METAS -->
      <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12 mt-2 mb-3"> 
        

      <div class="border">
      <div class="p-3">
      <div class="row">
          
        <div class="col-8">
        <h5>Seguimiento y reporte de indicadores</h5>
        </div>
          

        <div class="col-4">
          <a class="float-right" href="public/sasisopa/vistas/seguimiento-reporte-indicadores-pdf.php" data-toggle="tooltip" data-placement="left" title="Descargar" >
          <img src="<?php echo RUTA_IMG_ICONOS."pdf.png"; ?>">
          </a>

          <a class="float-right mr-2" onclick="ModalSRI()" style="cursor: pointer;" data-toggle="tooltip" data-placement="left" title="Agregar" >
          <img src="<?php echo RUTA_IMG_ICONOS."agregar.png"; ?>">
          </a>
        </div>
        </div>
        
          <hr>

          <div id="ContenidoSRI"></div>


        </div>
        </div>
      
      </div>

    
    </div>

    
    </div>

    </div>
    </div>
    </div>
    </div>
    </div>

  <div class="modal fade bd-example-modal-lg" id="ModalAyuda" data-backdrop="static">
    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
      <div class="modal-content" style="border-radius: 0px;border: 0px;">
        <div class="modal-header">
          <h4 class="modal-title">Bienvenido al elemento 4. OBJETIVOS, METAS E INDICADORES, del Sistema de Administración</h4>
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
          <button type="button" class="btn btn-primary" style="border-radius: 0px;" onclick="btnFinAyuda()">Aceptar</button>
        </div>
      </div>
    </div>
    </div>

    <!------------------------------->

    <div class="modal fade bd-example-modal-lg" id="ModalSRI" data-backdrop="static">
<div class="modal-dialog modal-lg modal-dialog-centered" role="document">
<div class="modal-content" style="border-radius: 0px;border: 0px;">
 <div class="modal-header">
   <h4 class="modal-title">Seguimiento y reporte de indicadores</h4>
     <button type="button" class="close" data-dismiss="modal" aria-label="Close">
   <span aria-hidden="true">&times;</span>
 </button>
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
 <div class="modal-header">
   
   <h4 class="modal-title">Seguimiento de objetivos y metas</h4>
     
     <button type="button" class="close" data-dismiss="modal" aria-label="Close">
   <span aria-hidden="true">&times;</span>

 </button>
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
  </body>
  </html>
