<?php
require('app/help.php');

if ($NGobierno == "municipal") {
    $title = "Municipal";
    }else if ($NGobierno == "estatal") {
    $title = "Estatal";
    }else if ($NGobierno == "federal") {
    $title = "Federal";
    }else if ($NGobierno == "varios") {
    $title = "Varios";
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
  <link rel="stylesheet" href="<?php echo RUTA_CSS ?>bootstrap-select.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.0/umd/popper.min.js"></script>
  <script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
  <script type="text/javascript" src="<?php echo RUTA_JS ?>alertify.js"></script>
  <link href="https://fonts.googleapis.com/css?family=Montserrat" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.7.0/animate.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/selectize.js/0.12.6/js/standalone/selectize.min.js" ></script>
  <link rel="stylesheet" href="<?php echo RUTA_CSS ?>selectize.css">
  <style media="screen">
  .LoaderPage {
  position: fixed;
  left: 0px;
  top: 0px;
  width: 100%;
  height: 100%;
  z-index: 9999; 
  background: white;
  background: url('../imgs/iconos/load-index-img.gif') 50% 50% no-repeat rgb(255,255,255);
  }

  .table-tr:hover{
    background: #E3F3FF;
    z-index: 100;
  }
  </style>
  <script type="text/javascript">
  $(document).ready(function($){
  $(".LoaderPage").fadeOut("slow");

  sessionStorage.setItem('Dependencia', 'Todas');
  Dependencia = sessionStorage.getItem('Dependencia');

  ListaRequisitos('<?=$NGobierno;?>',Dependencia);

  });

  function regresarP(){
  sessionStorage.removeItem('Dependencia');
  window.history.back();
  }

function ListaRequisitos(NGobierno,Dependencia){

  var parametros = {
  'idEstacion': <?=$idEstacion;?>,
  'NGobierno': NGobierno,
  'Dependencia' : Dependencia
  };

  $.ajax({
   data:  parametros,
   url:   '../../public/administrador/vistas/lista-archivos-requisitos.php',
   type:  'get',
   beforeSend: function() {
   },
   complete: function(){
   },
   success:  function (response) {

    $('#DivContenido').html(response);

    }
    });
  
  }

  function ModalNuevo(idEstacion,NG){
  $('#ModalConfiguracion').modal('show');
  $('#DivConfiguracion').load('../../public/administrador/vistas/modal-agregar-requisito-legal.php?idEstacion=' + idEstacion + '&NG=' + NG);
  }

function AgregarRL(idEstacion){

var acusePDF       = $('#acusePDF').val();
var requisitoPDF   = $('#requisitoPDF').val();
var requisitolegal = $('#requisitolegal').val();
var vigencia       = $('#vigencia').val();
var fechaemision   = $('#fechaemision').val();
var vencimiento   = $('#vencimiento').val(); 


var data = new FormData();
var url = '../../public/administrador/agregar/agregar-detalle-requisito-legal.php';

acusePDF = document.getElementById("acusePDF");
acusePDF_file = acusePDF.files[0];
acusePDF_filePath = acusePDF.value;

requisitoPDF = document.getElementById("requisitoPDF");
requisitoPDF_file = requisitoPDF.files[0];
requisitoPDF_filePath = requisitoPDF.value;
  
  var ene = 0;
  var feb = 0;
  var mar = 0;
  var abr = 0;
  var may = 0;
  var jun = 0;
  var jul = 0;
  var ago = 0;
  var sep = 0;
  var oct = 0;
  var nov = 0;
  var dic = 0;

  if($('#ene').prop('checked')) {
  ene = 1;
  }else{
  ene = 0;
  }

  if($('#feb').prop('checked')) {
  feb = 1;
  }else{
  feb = 0;
  }

  if($('#mar').prop('checked')) {
  mar = 1;
  }else{
  mar = 0;
  }

  if($('#abr').prop('checked')) {
  abr = 1;
  }else{
  abr = 0;
  }

  if($('#may').prop('checked')) {
  may = 1;
  }else{
  may = 0;
  }

  if($('#jun').prop('checked')) {
  jun = 1;
  }else{
  jun = 0;
  }

  if($('#jul').prop('checked')) {
  jul = 1;
  }else{
  jul = 0;
  }

  if($('#ago').prop('checked')) {
  ago = 1;
  }else{
  ago = 0;
  }

  if($('#sep').prop('checked')) {
  sep = 1;
  }else{
  sep = 0;
  }

  if($('#oct').prop('checked')) {
  oct = 1;
  }else{
  oct = 0;
  }

  if($('#nov').prop('checked')) {
  nov = 1;
  }else{
  nov = 0;
  }

  if($('#dic').prop('checked')) {
  dic = 1;
  }else{
  dic = 0;
  }

  if (requisitolegal != "") {
  $('.selectize-input').css('border','');
  if (vigencia != "") {
  $('#vigencia').css('border','');
  if (fechaemision != "") {
  $('#fechaemision').css('border','');

  data.append('idEstacion', idEstacion);
  data.append('requisitolegal', requisitolegal);
  data.append('vigencia', vigencia);
  data.append('fechaemision', fechaemision);
  data.append('acusePDF_file', acusePDF_file);
  data.append('requisitoPDF_file', requisitoPDF_file);
  data.append('vencimiento', vencimiento);

  data.append('ene', ene);
  data.append('feb', feb);
  data.append('mar', mar);
  data.append('abr', abr);
  data.append('may', may);
  data.append('jun', jun);
  data.append('jul', jul);
  data.append('ago', ago);
  data.append('sep', sep);
  data.append('oct', oct);
  data.append('nov', nov);
  data.append('dic', dic);

    $.ajax({
    url: url,
    type: 'POST',
    contentType: false,
    data: data,
    processData: false,
    cache: false
    }).done(function(data){

    if(data == 1){

    ListaRequisitos('<?=$NGobierno;?>','Todas');

    $('#ModalConfiguracion').modal('hide');
    }else{
    alertify.error('Error al crear el requisito legal'); 
    }
  
    });

  }else{
  $('#fechaemision').css('border','2px solid #A52525');
  }
  }else{
  $('#vigencia').css('border','2px solid #A52525');
  }
  }else{
  $('.selectize-input').css('border','2px solid #A52525');
  }

  }

  function editar(id,NGobierno){

$('#ModalConfiguracion').modal('show');
$('#DivConfiguracion').load('../../public/administrador/vistas/modal-editar-requisito-legal.php?id=' + id + '&idestacion=<?=$idEstacion;?>&NG=' + NGobierno);
}

function EditarRL(id){

var requisitolegal = $('#requisitolegal').val();
var vigencia       = $('#vigencia').val();
var UnificarRL = $('#UnificarRL').val();

  var ene = 0;
  var feb = 0;
  var mar = 0;
  var abr = 0;
  var may = 0;
  var jun = 0;
  var jul = 0;
  var ago = 0;
  var sep = 0;
  var oct = 0;
  var nov = 0;
  var dic = 0;

  if($('#ene').prop('checked')) {
  ene = 1;
  }else{
  ene = 0;
  }

  if($('#feb').prop('checked')) {
  feb = 1;
  }else{
  feb = 0;
  }

  if($('#mar').prop('checked')) {
  mar = 1;
  }else{
  mar = 0;
  }

  if($('#abr').prop('checked')) {
  abr = 1;
  }else{
  abr = 0;
  }

  if($('#may').prop('checked')) {
  may = 1;
  }else{
  may = 0;
  }

  if($('#jun').prop('checked')) {
  jun = 1;
  }else{
  jun = 0;
  }

  if($('#jul').prop('checked')) {
  jul = 1;
  }else{
  jul = 0;
  }

  if($('#ago').prop('checked')) {
  ago = 1;
  }else{
  ago = 0;
  }

  if($('#sep').prop('checked')) {
  sep = 1;
  }else{
  sep = 0;
  }

  if($('#oct').prop('checked')) {
  oct = 1;
  }else{
  oct = 0;
  }

  if($('#nov').prop('checked')) {
  nov = 1;
  }else{
  nov = 0;
  }

  if($('#dic').prop('checked')) {
  dic = 1;
  }else{
  dic = 0;
  }

  if (requisitolegal != "") {
  $('.selectize-input').css('border','');
  if (vigencia != "") {
  $('#vigencia').css('border','');


  var parametros = {
  'id': id,
  'requisitolegal': requisitolegal,
  'vigencia' : vigencia,
  'UnificarRL' : UnificarRL,
  'ene' : ene,
  'feb' : feb,
  'mar' : mar,
  'abr' : abr,
  'may' : may,
  'jun' : jun,
  'jul' : jul,
  'ago' : ago,
  'sep' : sep,
  'oct' : oct,
  'nov' : nov,
  'dic' : dic
};

  $.ajax({
   data:  parametros,
   url:   '../../public/administrador/editar/editar-detalle-requisito-legal.php',
   type:  'post',
   beforeSend: function() {
   },
   complete: function(){
   },
   success:  function (response) {

    if(response == 1){
    Dependencia = sessionStorage.getItem('Dependencia');
    ListaRequisitos('<?=$NGobierno;?>',Dependencia);
    $('#ModalConfiguracion').modal('hide');
    }else if(response == 0){
    alertify.error('Error al editar el requisito legal'); 
    }else if(response == 2){
    alertify.error('Error al unificar requisito legal'); 
    }
    
    }
    });

  }else{
  $('#vigencia').css('border','2px solid #A52525');
  }
  }else{
  $('.selectize-input').css('border','2px solid #A52525');
  }

}

//-----------------------------------------------
function listaReq(id){
$('#ModalConfiguracion').modal('show');
$('#DivConfiguracion').load('../../public/administrador/vistas/modal-historial-requisito-legal.php?id=' + id ); 
}


function NuevoRequisito(id){
$('#DivConfiguracion').load('../../public/administrador/vistas/modal-historial-requisito-legal-nuevo.php?id=' + id ); 
}

function CancelarAgregar(id){
$('#DivConfiguracion').load('../../public/administrador/vistas/modal-historial-requisito-legal.php?id=' + id )
}

function AgregarRequisito(id){

var FechaEmision = $('#fechaemision').val();
var vencimiento  = $('#vencimiento').val();
var acusePDFE = document.getElementById("acusePDFN");
var acusePDFEFile = acusePDFE.files[0];
var acusePDFEFilePath = acusePDFE.value;

var requisitoPDFE = document.getElementById("requisitoPDFN");
var requisitoPDFEEFile = requisitoPDFE.files[0];
var requisitoPDFEEFilePath = requisitoPDFE.value;

var data = new FormData();
var url = '../../public/sasisopa/agregar/agrgar-requisito-legal-historial.php';

if (FechaEmision != "") {
$('#FechaEmision').css('border',''); 

  data.append('idre', id);
  data.append('idEstacion', <?=$idEstacion;?>);
  data.append('FechaEmision', FechaEmision);
  data.append('acusepdf', acusePDFEFile);
  data.append('requisitopdf', requisitoPDFEEFile);
  data.append('vencimiento', vencimiento);

  $.ajax({
  url: url,
  type: 'POST',
  contentType: false,
  data: data,
  processData: false,
  cache: false,
  dataType: 'JSON',
  }).done(function(data){

    var fechaemision = data[0].FechaEmision;
    var fechavencimiento = data[0].FechaVencimiento;
    var acusepdf = data[0].acusepdf;
    var requisitolegalpdf = data[0].requisitolegalpdf;

  $('#td4-' + id).html(fechaemision);  
  $('#td5-' + id).html(fechavencimiento); 
  $('#td6-' + id).html(acusepdf);  
  $('#td7-' + id).html(requisitolegalpdf);

  listaReq(id);
  Dependencia = sessionStorage.getItem('Dependencia');
  ListaRequisitos('<?=$NGobierno;?>',Dependencia);

  });


}else{
$('#FechaEmision').css('border','2px solid #A52525');  
}

}

function editararchivo(id, idmatriz){
$('#DivConfiguracion').load('../../public/sasisopa/vistas/modal-editar-requisito-legal-historial.php?id=' + id + '&idmatriz=' + idmatriz ); 
}

function EditarRequisito(id, idmatriz){

var acusePDFED = document.getElementById("acusePDFED");
var acusePDFEFile = acusePDFED.files[0];
var acusePDFEFilePath = acusePDFED.value;

var requisitoPDFED = document.getElementById("requisitoPDFED");
var requisitoPDFEEFile = requisitoPDFED.files[0];
var requisitoPDFEEFilePath = requisitoPDFED.value;  

var fechavencimiento = $('#fechavencimiento').val();
var fechaemision = $('#fechaemision').val();

var data = new FormData();
var url = '../../public/sasisopa/actualizar/editar-requisito-legal-historial.php';

  data.append('idmatriz', idmatriz);
  data.append('acusepdf', acusePDFEFile);
  data.append('requisitopdf', requisitoPDFEEFile);
  data.append('fechavencimiento', fechavencimiento);
  data.append('fechaemision', fechaemision);

  $.ajax({
  url: url,
  type: 'POST',
  contentType: false,
  data: data,
  processData: false,
  cache: false,
  dataType: 'JSON',
  }).done(function(data){

    var resultado = data[0].resultado;
    var acusepdf = data[0].acusepdf;
    var requisitolegalpdf = data[0].requisitolegalpdf;


    if (acusepdf != "") {
    $('#td6-' + id).html(acusepdf); 
    }

    if (requisitolegalpdf != "") {
    $('#td7-' + id).html(requisitolegalpdf);
    }

if (resultado == 1) {
listaReq(id);
Dependencia = sessionStorage.getItem('Dependencia');
ListaRequisitos('<?=$NGobierno;?>',Dependencia);
}else{
$('#respuesta').html('<div class="text-center"><small class="text-danger">Adjunte el acuse o requisito legal en formato PDF.</small></div>');  
}
  

});


}

//----------------------------------------------------------------------------------

function Detalle(id){

$('#ModalConfiguracion').modal('show');
$('#DivConfiguracion').load('../../public/administrador/vistas/modal-detalle-requisito-legal.php?id=' + id );

}

function EliminarArchivo(idre,idmatriz){

alertify.confirm('',
function(){

 var parametros = {
  'idre': idre,
  'idmatriz': idmatriz
};

  $.ajax({
   data:  parametros,
   url:   '../../public/sasisopa/eliminar/eliminar-detalle-requisito-legal.php',
   type:  'post',
   beforeSend: function() {
   },
   complete: function(){
   },
   success:  function (response) {

    if(response == 1){
      Dependencia = sessionStorage.getItem('Dependencia');
      ListaRequisitos('<?=$NGobierno;?>',Dependencia);
      listaReq(idre)
    }else{
    alertify.error('Error al eliminar el requisito legal'); 
    }
    
    }
    });

   },
function(){
}).setHeader('Mensaje').set({transition:'zoom',message: '¿Desea eliminar el archivo seleccionado?',labels:{ok:'Aceptar', cancel: 'Cancelar'}}).show();

}

function EliminarRL(idre){

alertify.confirm('',
function(){


 var parametros = {
  'idre': idre
};

  $.ajax({
   data:  parametros,
   url:   '../../public/administrador/eliminar/eliminar-requisito-legal.php',
   type:  'post',
   beforeSend: function() {
   },
   complete: function(){
   },
   success:  function (response) {


    if(response == 1){
      Dependencia = sessionStorage.getItem('Dependencia');
      ListaRequisitos('<?=$NGobierno;?>',Dependencia);
    }else{
    alertify.error('Error al eliminar el requisito legal'); 
    }
    
    }
    });


  },
function(){
}).setHeader('Mensaje').set({transition:'zoom',message: '¿Desea eliminar el permiso seleccionado?',labels:{ok:'Aceptar', cancel: 'Cancelar'}}).show();
 
}

function Vencimiento(){

var vigencia = $('#vigencia').val();
var fechaemision = $('#fechaemision').val();

if (vigencia != "") {
$('#vigencia').css('border',''); 

var parametros = {
'vigencia': vigencia,
'fechaemision' : fechaemision
};

  $.ajax({
   data:  parametros,
   url:   '../../public/administrador/vistas/calcular-fecha-vencimiento.php',
   type:  'post',
   beforeSend: function() {
   },
   complete: function(){
   },
   success:  function (response) {

$('#fechavencimiento').html(response)   


    }
    });

}else{
$('#vigencia').css('border','2px solid #A52525');  
$('#fechaemision').val('');
}

}

//-------------------------------------------------

function ModalBuscar(NG){

let idEstacion = <?=$idEstacion;?>;

$('#ModalConfiguracion').modal('show');
$('#DivConfiguracion').load('../../public/administrador/vistas/modal-buscar-requisito-legal.php?NG=' + NG + '&idEstacion=' + idEstacion);
}

function BuscarRL(NG){
let Dependencia = $('#Dependencia').val();
sessionStorage.setItem('Dependencia', Dependencia);
ListaRequisitos(NG,Dependencia);
$('#ModalConfiguracion').modal('hide');
}
  </script>
  </head>
  <body>

  <div class="LoaderPage"></div>
  <div class="fixed-top navbar-admin">
  <?php require('public/componentes/header.menu.php'); ?>
  </div>
  <div id="DivPrincipal">
  <div class="divcontenedor">
  <div class="divbody">
  <div class="magir-top-principal">

    <div class="magir-top-principal">

<div class="row no-gutters">
<div class="col-12">
<div class="card adm-card" style="border: 0;">
<div class="adm-car-title">
      <div class="float-left" style="padding-right: 20px;margin-top: 5px;">
      <a onclick="regresarP()" style="cursor: pointer;" data-toggle="tooltip" data-placement="right" title="Regresar"><img src="<?php echo RUTA_IMG_ICONOS."regresar.png"; ?>"></a>
      </div>
<div class="float-left"><h4><?=$title;?></h4></div>
    <div class="float-right" style="margin-top: 6px;margin-left: 10px;">
    <a class="mr-2" onclick="ModalBuscar('<?=$title;?>')" style="cursor: pointer;" data-toggle="tooltip" data-placement="right" title="Buscar"><img src="<?php echo RUTA_IMG_ICONOS."buscar-icono.png"; ?>"></a>
    <a onclick="ModalNuevo(<?=$idEstacion;?>,'<?=$title;?>')" style="cursor: pointer;" data-toggle="tooltip" data-placement="right" title="Agregar"><img src="<?php echo RUTA_IMG_ICONOS."agregar.png"; ?>"></a>
    </div>
</div>

<div class="card-body">

<?php

$sql_estacion = "SELECT * FROM tb_estaciones WHERE id = '".$idEstacion."' ";
$result_estacion = mysqli_query($con, $sql_estacion);
$numero_estacion = mysqli_num_rows($result_estacion);
while($row_estaciones = mysqli_fetch_array($result_estacion, MYSQLI_ASSOC)){
$permisocre = $row_estaciones['permisocre'];
$razonsocial = $row_estaciones['razonsocial'];
}
?>
<h6><?=$razonsocial;?></h6>

<div id="DivContenido"></div>

</div>

</div>
</div>
</div>
</div>

</div>
</div>
</div>
</div>

  <div class="modal fade bd-example-modal-lg" id="ModalConfiguracion" >
  <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
  <div class="modal-content" style="border-radius: 0px;border: 0px;">
  <div id="DivConfiguracion"></div>
  </div>
  </div>
  </div>

<script src="<?php echo RUTA_JS ?>bootstrap.min.js"></script>
</body>
</html>
