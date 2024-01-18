<?php
require('app/help.php');

$sql_sasisopa_ayuda = "SELECT * FROM pu_sasisopa_ayuda WHERE id_usuario = '".$Session_IDUsuarioBD."' and detalle = '12-seguridad-contratistas' and estado = 0 LIMIT 1";
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
  </style>
  <script type="text/javascript">
  $(document).ready(function(){
  $('[data-toggle="tooltip"]').tooltip();
  $(".LoaderPage").fadeOut("slow");
 <?php if ($numero_sasisopa_ayuda == 1) {echo "btnAyuda();";} ?>

 ContenidoLista();

  });

    function regresarP(){
   window.history.back();
  }

  function ContenidoLista(){


   $.ajax({
   url:   'public/sasisopa/buscar/buscar-lista-seguridad-contratistas.php',
   type:  'post',
   beforeSend: function() {
   },
   complete: function(){
   },
   success:  function (response) {
   $('#ContenidoLista').html(response);
   }
   });

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

function btnAgregar(){
$('#ModalAgregar').modal('show');
$('#DivCrear').load('public/sasisopa/vistas/modal-crear-requisicion.php');
}

function btnAgregarServicio(){

var Fecha = $('#Fecha').val();
var Descripcion = $('#Descripcion').val();
var Justificacion = $('#Justificacion').val();
var URL = "public/sasisopa/agregar/agregar-requisicion-obra-servicio.php";

if (Descripcion != "") {
$('#Descripcion').css('border',''); 
if (Justificacion != "") {
$('#Justificacion').css('border',''); 

 alertify.confirm('',
 function(){

 var parametros = {
    "Descripcion" : Descripcion,
    "Justificacion" : Justificacion,
    "Fecha" : Fecha
    };

    $.ajax({
    data:  parametros,
    url:   URL,
    type:  'post',
    beforeSend: function() {

    },
    complete: function(){
    },
    success:  function (response) {

     ContenidoLista();
    $('#ModalAgregar').modal('hide');
    
    }
    });


    },
    function(){

    }).setHeader('Mensaje').set({transition:'zoom',message: 'Desea crear la Requisición de obra o servicio',labels:{ok:'Aceptar', cancel: 'Cancelar'}}).show(); 

}else{
$('#Justificacion').css('border','2px solid #A52525');  
}
}else{
$('#Descripcion').css('border','2px solid #A52525');  
}

}

function Descargar(id){
window.location = "descargar-seguridad-contratistas/" + id;  
}

function ModalEditar(id){
$('#ModalDetalle').modal('show');
$('#DivDetalle').load('public/sasisopa/vistas/modal-editar-seguridad.php?id=' + id);
}

function btnEditarServicio(id){

var EditFecha = $('#EditFecha').val();
var EditDescripcion = $('#EditDescripcion').val();
var EditJustificacion = $('#EditJustificacion').val();
var URL = "public/sasisopa/actualizar/editar-requisicion-obra-servicio.php";

 alertify.confirm('',
 function(){

 var parametros = {
  "id" : id,
    "EditFecha" : EditFecha,
    "EditDescripcion" : EditDescripcion,
    "EditJustificacion" : EditJustificacion
    };

    $.ajax({
    data:  parametros,
    url:   URL,
    type:  'post',
    beforeSend: function() {

    },
    complete: function(){
    },
    success:  function (response) {

     ContenidoLista();
    $('#ModalDetalle').modal('hide');
    
    }
    });


    },
    function(){

    }).setHeader('Mensaje').set({transition:'zoom',message: 'Desea editar la Requisición de obra o servicio',labels:{ok:'Aceptar', cancel: 'Cancelar'}}).show(); 

}


function Eliminar(id){

 alertify.confirm('',
 function(){

  var parametros = {
      "id" : id
      };

  $.ajax({
   data:  parametros,
   url:   'public/sasisopa/eliminar/eliminar-seguridad-contratistas.php',
   type:  'post',
   beforeSend: function() {
   },
   complete: function(){
   },
   success:  function (response) {
    ContenidoLista();
   }
   });

    },
    function(){

    }).setHeader('Mensaje').set({transition:'zoom',message: 'Desea eliminar la Requisición de obra o servicio',labels:{ok:'Aceptar', cancel: 'Cancelar'}}).show(); 

}
//-------------------------------------------------------------------------------------

function ModalFormato(id){
$('#ModalDetalle').modal('show');
$('#DivDetalle').load('public/sasisopa/vistas/modal-seguridad-formato.php?id=' + id);  
}

function Formato14(id){

var Archivo = document.getElementById("Archivoformato14");
var File = Archivo.files[0];
var FilePath = Archivo.value;

var data = new FormData();
var url = 'public/sasisopa/agregar/agregar-formato14.php';
var ext = $("#Archivoformato14").val().split('.').pop();


if (FilePath != "") {
$('#Archivoformato14').css('border',''); 
if (ext == "PDF" || ext == "pdf") {
$('#result').html('');

  data.append('id', id);
  data.append('File', File);

  $.ajax({
  url: url,
  type: 'POST',
  contentType: false,
  data: data,
  processData: false,
  cache: false
  }).done(function(data){

  ContenidoLista();
  $('#ModalDetalle').modal('hide');
  alertify.success('Se agregó correctamente la información');


  });

}else{
$('#Archivoformato14').css('border','2px solid #A52525');  
$('#result').html('<small class="text-danger">Solo se aceptan formato PDF</small>'); 
}
}else{
$('#Archivoformato14').css('border','2px solid #A52525');  
}

}

//-------------------------------------------------------------------------------

function CartaResponsiva(id){

$('#ModalDetalle').modal('show');
$('#DivDetalle').load('public/sasisopa/vistas/modal-seguridad-carta-responsiva.php?id=' + id); 

}

function btnEditarCR(idCarta,id){

let Municipio = $('#Municipio').val();
let Estado = $('#Estado').val();
let Dia = $('#Dia').val();
let Mes = $('#Mes').val();
let Year = $('#Year').val();
let RepresentanteL = $('#RepresentanteL').val();
let RazonSocial = $('#RazonSocial').val();
let Domicilio = $('#Domicilio').val();
let ApoderadoL = $('#ApoderadoL').val();
let URL = "public/sasisopa/actualizar/editar-carta-responsiva.php";

 alertify.confirm('',
 function(){

 let parametros = {
    "id" : idCarta,
    "Municipio" : Municipio,
    "Estado" : Estado,
    "Dia" : Dia,
    "Mes": Mes,
    "Year": Year,
    "RepresentanteL": RepresentanteL,
    "RazonSocial": RazonSocial,
    "Domicilio": Domicilio,
    "ApoderadoL": ApoderadoL
    };

    $.ajax({
    data:  parametros,
    url:   URL,
    type:  'post',
    beforeSend: function() {

    },
    complete: function(){
    },
    success:  function (response) {

     ContenidoLista();
    $('#ModalDetalle').modal('hide');
    
    }
    });


    },
    function(){

    }).setHeader('Mensaje').set({transition:'zoom',message: '¿Desea guardar la carta responsiva?',labels:{ok:'Aceptar', cancel: 'Cancelar'}}).show();

}

function DescargarCR(id){
window.location = "descargar-carta-responsiva/" + id;
}

//------------------------------------------------------------------------------

function ModalFormato15(id){
$('#ModalDetalle').modal('show');
$('#DivDetalle').load('public/sasisopa/vistas/modal-seguridad-verificacion.php?id=' + id);
}


function btnGuardarLV(id){

let Fecha = $('#Fecha').val();
let Hora = $('#Hora').val();
let idSuperviso = $('#idSuperviso').val();
let URL = "public/sasisopa/agregar/agregar-lista-verificacion.php";

if ($('#Si1').is(':checked')) {
R1 = 1;
} else if ($('#No1').is(':checked')){
R1 = 0;
}

if ($('#Si2').is(':checked')) {
R2 = 1;
} else if ($('#No2').is(':checked')){
R2 = 0;
}

if ($('#Si3').is(':checked')) {
R3 = 1;
} else if ($('#No3').is(':checked')){
R3 = 0;
}

if ($('#Si4').is(':checked')) {
R4 = 1;
} else if ($('#No4').is(':checked')){
R4 = 0;
}

if ($('#Si5').is(':checked')) {
R5 = 1;
} else if ($('#No5').is(':checked')){
R5 = 0;
}

 alertify.confirm('',
 function(){

 let parametros = {
    "id" : id,
    "Fecha" : Fecha,
    "Hora" : Hora,
    "idSuperviso" : idSuperviso,
    "R1": R1,
    "R2": R2,
    "R3": R3,
    "R4": R4,
    "R5": R5
    };

    $.ajax({
    data:  parametros,
    url:   URL,
    type:  'post',
    beforeSend: function() {

    },
    complete: function(){
    },
    success:  function (response) {

     ContenidoLista();
    $('#ModalDetalle').modal('hide');
    
    }
    });


    },
    function(){

    }).setHeader('Mensaje').set({transition:'zoom',message: '¿Desea guardar Listas de verificación?',labels:{ok:'Aceptar', cancel: 'Cancelar'}}).show();

}

function DescargarLV(id){

window.location = "descargar-lista-verificacion/" + id;

}

//----------------------------------------------------------------------

function ModalAutorizacion(id){
$('#ModalDetalle').modal('show');
$('#DivDetalle').load('public/sasisopa/vistas/modal-seguridad-autorizacion-peligros.php?id=' + id); 
}

function EditARTP(e,dato,id){

let URL = "public/sasisopa/actualizar/editar-formato12.php";
let valor = e.value;

 let parametros = {
    "id" : id,
    "valor" : valor,
    "dato" : dato
    };

    $.ajax({
    data:  parametros,
    url:   URL,
    type:  'post',
    beforeSend: function() {

    },
    complete: function(){
    },
    success:  function (response) {

    
    }
    });

}

function TrabjoP(idProcedimientos){

let URL = "public/sasisopa/actualizar/editar-formato12.php";

if ($('#TRCDLSP' + idProcedimientos).is(':checked')) {
valor = 1;
} else{
valor = 0;
}

 let parametros = {
    "id" : idProcedimientos,
    "valor" : valor,
    "dato" : 14
    };

    $.ajax({
    data:  parametros,
    url:   URL,
    type:  'post',
    beforeSend: function() {

    },
    complete: function(){
    },
    success:  function (response) {

    
    }
    });

}

function btnGPersonal(dato,idFormato, id){

let URL = "public/sasisopa/actualizar/editar-formato12.php";

let NombreT = $('#NombreT').val();
let PuestoT = $('#PuestoT').val();
let NoSeguroT = $('#NoSeguroT').val();

if(dato == 1){
idPersonal = 0; 
}else {
idPersonal = $('#idPersonalEE').val();  
}

 let parametros = {
    "id" : idFormato,
    "valor" : idPersonal,
    "categoria" : dato,
    "dato" : 17,
    "NombreT" : NombreT,
    "PuestoT" : PuestoT,
    "NoSeguroT" : NoSeguroT
    };

    $.ajax({
    data:  parametros,
    url:   URL,
    type:  'post',
    beforeSend: function() {

    },
    complete: function(){
    },
    success:  function (response) {

    ModalAutorizacion(id);
    
    }
    });

}

function EliminarARTP(dato,id,idFormato){

let URL = "public/sasisopa/actualizar/editar-formato12.php";

 let parametros = {
    "id" : id,
    "valor" : 0,
    "dato" : dato
    };

    $.ajax({
    data:  parametros,
    url:   URL,
    type:  'post',
    beforeSend: function() {

    },
    complete: function(){
    },
    success:  function (response) {
  
    ModalAutorizacion(idFormato);
    
    }
    });

}

function btnEditarARTP(){

var Municipio = $('#Municipio').val();
var Estado = $('#Estado').val();
var Dia = $('#Dia').val();
var Mes = $('#Mes').val();
var Year = $('#Year').val();

var TAR = $('#TAR').val();
var DESC = $('#DESC').val();
var Area = $('#Area').val();
var FDI = $('#FDI').val();
var FDT = $('#FDT').val();
var HDI = $('#HDI').val();
var HDT = $('#HDT').val();

if (Municipio != "") {
$('#Municipio').css('border',''); 
if (Estado != "") {
$('#Estado').css('border',''); 
if (Dia != "") {
$('#Dia').css('border',''); 
if (Mes != "") {
$('#Mes').css('border',''); 
if (Year != "") {
$('#Year').css('border',''); 
if (TAR != "") {
$('#TAR').css('border',''); 
if (DESC != "") {
$('#DESC').css('border',''); 
if (Area != "") {
$('#Area').css('border',''); 
if (FDI != "") {
$('#FDI').css('border',''); 
if (FDT != "") {
$('#FDT').css('border',''); 
if (HDI != "") {
$('#HDI').css('border',''); 
if (HDT != "") {
$('#HDT').css('border',''); 

 alertify.confirm('',
 function(){

  ContenidoLista();
  $('#ModalDetalle').modal('hide');
  },
  function(){

  }).setHeader('Mensaje').set({transition:'zoom',message: '¿Desea guardar Autorizacion para realizar trabajos peligrosos',labels:{ok:'Aceptar', cancel: 'Cancelar'}}).show();

}else{
$('#HDT').css('border','2px solid #A52525');  
}
}else{
$('#HDI').css('border','2px solid #A52525');  
}
}else{
$('#FDT').css('border','2px solid #A52525');  
}
}else{
$('#FDI').css('border','2px solid #A52525');  
}
}else{
$('#Area').css('border','2px solid #A52525');  
}
}else{
$('#DESC').css('border','2px solid #A52525');  
}
}else{
$('#TAR').css('border','2px solid #A52525');  
}
}else{
$('#Year').css('border','2px solid #A52525');  
}
}else{
$('#Mes').css('border','2px solid #A52525');  
}
}else{
$('#Dia').css('border','2px solid #A52525');  
}
}else{
$('#Estado').css('border','2px solid #A52525');  
}
}else{
$('#Municipio').css('border','2px solid #A52525');  
}


}

function DescargarARTP(id){
window.location = "descargar-autorizacion-trabajos-peligrosos/" + id;
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
    <div class="float-left"><h4>12. SEGURIDAD DE CONTRATISTAS</h4></div>
    <div class="float-right" style="margin-top: 6px;margin-left: 10px;">
    <a onclick="btnAgregar()" style="cursor: pointer;" data-toggle="tooltip" data-placement="left" title="Agregar" >
    <img src="<?php echo RUTA_IMG_ICONOS."agregar.png"; ?>">
    </a>
    </div>
    <div class="float-right" style="margin-top: 6px;margin-left: 10px;">
    <a onclick="btnAyuda()" style="cursor: pointer;" data-toggle="tooltip" data-placement="left" title="Ayuda" >
    <img src="<?php echo RUTA_IMG_ICONOS."info.png"; ?>">
    </a>
    </div>
    </div>
    <div class="card-body">

    <div id="ContenidoLista"></div>

    </div>
    </div>
    </div>
    </div>
    </div>

  <div class="modal fade bd-example-modal-lg" id="ModalAyuda" data-backdrop="static">
    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
      <div class="modal-content" style="border-radius: 0px;border: 0px;">
        <div class="modal-header">
          <h4 class="modal-title">Bienvenido al elemento 12 SEGURIDAD DE CONTRATISTAS</h4>
        </div>
        <div class="modal-body">

          <p class="text-justify" style="font-size: 1.1em">
            Aquí vas a poder visualizar los formatos de registro que tendrás que realizar cada vez que se requiera alguna obra o servicio por un contratista, prestador de servicio o proveedor dentro de la estación.
          </p>
          <p class="text-justify" style="font-size: 1.1em">
            La política debe ser comunicada a todo el personal incluyendo clientes, prestadores de servicios y proveedores.
          </p>

          <hr>

          <label class="font-weight-bold" style="font-size: 1.1em">Como hacerlo:</label>
          <ul style="font-size: 1.1em">
            <li>Da clic en el icono de mas para generar el registro de una obra o servicio (contempla que el procedimiento para llevar acabo el presente registro se requiere de los siguientes pasos).
              <ol>
                <li>Requisición de obra o servicio</li>
                 <li>Autorización para realizar trabajos peligrosos (Solo si aplica)</li>
                 <li>Carta responsiva</li>
                 <li>Entrega de información al contratista</li>
                 <li>Listas de verificación</li>
              </ol>
            </li>
            <li>Los formatos que se encuentran en la parte superior derecha deberás  descargarlos, llenarlos, firmarlos, para posteriormente subirlos en el icono que corresponde.</li>
          </ul>

          <hr>

          <label class="font-weight-bold" style="font-size: 1.1em">Responsables:</label>
          <p class="text-justify" style="font-size: 1.1em">Recuerda que es responsabilidad del <label class="text-danger font-weight-bold">Representante Técnico</label> (RT), <label class="text-danger font-weight-bold">Gerente de la Estación</label> conocer y realizar los registros correspondientes de cada elemento del SA.</p>



        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-primary" style="border-radius: 0px;" onclick="btnFinAyuda()">Aceptar</button>
        </div>
      </div>
    </div>
    </div>

      <div class="modal fade bd-example-modal-lg" id="ModalAgregar" data-backdrop="static">
    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
      <div class="modal-content" style="border-radius: 0px;border: 0px;">
        <div class="modal-header">
          <h4 class="modal-title">Requisición de obra o servicio Fo. ADMONGAS.013</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
        </div>
        <div class="modal-body">

        <div id="DivCrear"></div>

       </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-primary" style="border-radius: 0px;" onclick="btnAgregarServicio()">Aceptar</button>
        </div>
      </div>
    </div>
    </div>

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
