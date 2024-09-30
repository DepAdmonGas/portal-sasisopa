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
  background: url('imgs/iconos/load-img.gif') 50% 50% no-repeat rgb(249,249,249);
}
  .card-hover:hover{
    background: rgba(239, 239, 239, .3);
  }
    .table-tr:hover{
    background: #E3F3FF;
  }
  </style>
  <script type="text/javascript">
  $(document).ready(function(){
  $('[data-toggle="tooltip"]').tooltip();
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

    let targets = [5,6,7,8,9];
    $('#DivContenido').load('../app/vistas/sasisopa/elemento3/lista-archivos-requisitos.php?NGobierno=' + NGobierno + '&Dependencia=' + Dependencia, function() {
    $('#lista-requisitos').DataTable({
      "language": {
      "url": "<?=RUTA_JS?>es-ES.json"
    },
    "stateSave": true,
      "lengthMenu": [20,30,40],
      "columnDefs": [
      { "orderable": false, "targets": targets },
      { "searchable": false, "targets": targets }
      ]
    });
    });
  
  }

function ModalNuevo(NG){
$('#ModalConfiguracion').modal('show');
$('#DivConfiguracion').load('../app/vistas/sasisopa/elemento3/modal-agregar-requisito-legal.php?NG=' + NG);
}

function AgregarRL(NGobierno){

var acusePDF       = $('#acusePDF').val();
var requisitoPDF   = $('#requisitoPDF').val();
var requisitolegal = $('#requisitolegal').val();
var vigencia       = $('#vigencia').val();
var fechaemision      = $('#fechaemision').val();
var vencimiento = $('#vencimiento').val(); 

var data = new FormData();
var url = '../app/controlador/RequisitoLegalControlador.php';

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


  data.append('accion', 'agregar-detalle-requisito-legal');
  data.append('requisitolegal', requisitolegal);
  data.append('vigencia', vigencia);
  data.append('fechaemision', fechaemision);
  data.append('vencimiento', vencimiento);
  data.append('acusePDF_file', acusePDF_file);
  data.append('requisitoPDF_file', requisitoPDF_file);

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
  data.append('categoria', 1);

    $.ajax({
    url: url,
    type: 'POST',
    contentType: false,
    data: data,
    processData: false,
    cache: false
    }).done(function(data){

    if(data){
    ListaRequisitos(NGobierno,'Todas');
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
$('#DivConfiguracion').load('../app/vistas/sasisopa/elemento3/modal-editar-requisito-legal.php?id=' + id + '&idestacion=<?=$Session_IDEstacion;?>&NG=' + NGobierno);
}

function EditarRL(id){

var requisitolegal = $('#requisitolegal').val();
var vigencia       = $('#vigencia').val();

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

Dependencia = sessionStorage.getItem('Dependencia');

  var parametros = {
  'accion' : "editar-detalle-requisito-legal",
  'id': id,
  'requisitolegal': requisitolegal,
  'vigencia' : vigencia,
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
   url:   '../app/controlador/RequisitoLegalControlador.php',
   type:  'post',
   beforeSend: function() {
   },
   complete: function(){
   },
   success:  function (response) {

    if(response == 1){
    ListaRequisitos('<?=$NGobierno;?>',Dependencia);
    $('#ModalConfiguracion').modal('hide');
    }else{
    alertify.error('Error al editar el requisito legal'); 
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
$('#DivConfiguracion').load('../app/vistas/sasisopa/elemento3/modal-historial-requisito-legal.php?id=' + id ); 
}


function NuevoRequisito(id){
$('#DivConfiguracion').load('../app/vistas/sasisopa/elemento3/modal-historial-requisito-legal-nuevo.php?id=' + id ); 
}

function CancelarAgregar(id){
$('#DivConfiguracion').load('../app/vistas/sasisopa/elemento3/modal-historial-requisito-legal.php?id=' + id )
}

function AgregarRequisito(id){

var FechaEmision = $('#fechaemision').val();
var vencimiento =  $('#vencimiento').val();
var acusePDFE = document.getElementById("acusePDFN");
var acusePDFEFile = acusePDFE.files[0];
var acusePDFEFilePath = acusePDFE.value;

var requisitoPDFE = document.getElementById("requisitoPDFN");
var requisitoPDFEEFile = requisitoPDFE.files[0];
var requisitoPDFEEFilePath = requisitoPDFE.value;

var data = new FormData();
var url = '../app/controlador/RequisitoLegalControlador.php';

Dependencia = sessionStorage.getItem('Dependencia');

if (FechaEmision != "") {
$('#fechaemision').css('border',''); 

  data.append('accion', "agregar-requisito-legal-historial");
  data.append('idre', id);
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
  cache: false
  }).done(function(data){

    if(data){
        ListaRequisitos('<?=$NGobierno;?>',Dependencia);
        listaReq(id);
    }else{
        alertify.error('Error al agregar el requisito legal');  
    }
  

  });


}else{
$('#fechaemision').css('border','2px solid #A52525');  
}

}

function editararchivo(id, idmatriz){
$('#DivConfiguracion').load('../app/vistas/sasisopa/elemento3/modal-editar-requisito-legal-historial.php?id=' + id + '&idmatriz=' + idmatriz ); 
}

function EditarRequisito(id, idmatriz){

var acusePDFED = document.getElementById("acusePDFED");
var acusePDFEFile = acusePDFED.files[0];
var acusePDFEFilePath = acusePDFED.value;

var requisitoPDFED = document.getElementById("requisitoPDFED");
var requisitoPDFEEFile = requisitoPDFED.files[0];
var requisitoPDFEEFilePath = requisitoPDFED.value;  
var fechavencimiento = $('#fechavencimiento').val();

Dependencia = sessionStorage.getItem('Dependencia');

var data = new FormData();
var url = '../app/controlador/RequisitoLegalControlador.php';
  
  data.append('accion', "editar-requisito-legal-historial");
  data.append('idmatriz', idmatriz);
  data.append('acusepdf', acusePDFEFile);
  data.append('requisitopdf', requisitoPDFEEFile);
  data.append('fechavencimiento', fechavencimiento);
  data.append('fechaemision', '');

  $.ajax({
  url: url,
  type: 'POST',
  contentType: false,
  data: data,
  processData: false,
  cache: false
  }).done(function(data){

if (data) {
listaReq(id);
ListaRequisitos('<?=$NGobierno;?>',Dependencia);
}else{
$('#respuesta').html('<div class="text-center"><small class="text-danger">Adjunte el acuse o requisito legal en formato PDF.</small></div>');  
}
  
});

}

//----------------------------------------------------------------------------------

function Detalle(id){

$('#ModalConfiguracion').modal('show');
$('#DivConfiguracion').load('../app/vistas/sasisopa/elemento3/modal-detalle-requisito-legal.php?id=' + id );

}

function EliminarArchivo(idre,idmatriz){

alertify.confirm('',
function(){

 var parametros = {
  'accion': "eliminar-detalle-requisito-legal",
  'idre': idre,
  'idmatriz': idmatriz
};

  $.ajax({
   data:  parametros,
   url:   '../app/controlador/RequisitoLegalControlador.php',
   type:  'post',
   beforeSend: function() {
   },
   complete: function(){
   },
   success:  function (response) {

    if(response){
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
}).setHeader('Mensaje').set({transition:'zoom',message: 'Desea eliminar el archivo seleccionado',labels:{ok:'Aceptar', cancel: 'Cancelar'}}).show();

}

function EliminarRL(idre,NGobierno){

alertify.confirm('',
function(){

Dependencia = sessionStorage.getItem('Dependencia');

 var parametros = {
    'accion' : "eliminar-requisito-legal",
  'idre': idre
};

  $.ajax({
   data:  parametros,
   url:   '../app/controlador/RequisitoLegalControlador.php',
   type:  'post',
   beforeSend: function() {
   },
   complete: function(){
   },
   success:  function (response) {

    if(response){
      ListaRequisitos(NGobierno,Dependencia);
    }else{
    alertify.error('Error al eliminar el requisito legal'); 
    }
    
    }
    });


  },
function(){
}).setHeader('Mensaje').set({transition:'zoom',message: 'Desea eliminar el permiso seleccionado',labels:{ok:'Aceptar', cancel: 'Cancelar'}}).show();
 
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
   url:   '../app/vistas/sasisopa/elemento3/calcular-fecha-vencimiento.php',
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
$('#ModalConfiguracion').modal('show');
$('#DivConfiguracion').load('../app/vistas/sasisopa/elemento3/modal-buscar-requisito-legal.php?NG=' + NG);
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
      <li onclick="ModalNuevo('<?=$title;?>')"><a class="dropdown-item c-pointer"> <i class="fa-regular fa-square-plus"></i> Agregar</a></li>
      <li onclick="ModalBuscar('<?=$title;?>')"><a class="dropdown-item c-pointer"> <i class="fa-solid fa-magnifying-glass"></i> Buscar</a></li>
      </ul>
      </div>
      </div>
      <!-- Fin -->

     <!-- Inicio -->
     <div aria-label="breadcrumb" style="padding-left: 0; margin-bottom: 0;">
    <ol class="breadcrumb breadcrumb-caret">
    <li class="breadcrumb-item text-primary c-pointer" onclick="window.history.go(-2);"><i class="fa-solid fa-house"></i> SASISOPA</li>
    <li aria-current="page" class="breadcrumb-item c-pointer" onclick="regresarP()">3. REQUISITOS LEGALES</li>
    <li aria-current="page" class="breadcrumb-item active"><?=$title;?></li>
    </ol>
    </div>
    <!-- Fin -->

   <h3><?=$title;?></h3>


    <div class="bg-white p-3 mt-3">
    <div id="DivContenido"></div> 
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
  <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/pdfmake.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/vfs_fonts.js"></script>
  <script src="https://cdn.datatables.net/v/bs5/jszip-3.10.1/dt-2.0.3/b-3.0.1/b-colvis-3.0.1/b-html5-3.0.1/b-print-3.0.1/datatables.min.js"></script>
  </body>
  </html>
