<?php
require('app/help.php');
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
  $(document).ready(function($){
  $(".LoaderPage").fadeOut("slow");

  Permisos(<?=$Session_IDUsuarioBD;?>);
  });

  function regresarP(){
   window.history.back();
  }
 
  function Permisos(idUsuario){
$('#ListaPermisos').load('public/administrador/vistas/lista-permisos.php?idUsuario=' + idUsuario);

  }

  function listaReq(id, idUsuario, Estacion){
  $('#ModalConfiguracion').modal('show');
  $('#DivConfiguracion').load('public/administrador/vistas/modal-historial-requisito-legal-administrador.php?id=' + id + '&idUsuario=' + idUsuario + '&Estacion=' + Estacion); 
  }

  function EliminarArchivo(idre,idmatriz, idUsuario, Estacion){

alertify.confirm('',
function(){

 var parametros = {
  'idre': idre,
  'idmatriz': idmatriz
};

  $.ajax({
   data:  parametros,
   url:   'public/sasisopa/eliminar/eliminar-detalle-requisito-legal.php',
   type:  'post',
   beforeSend: function() {
   },
   complete: function(){
   },
   success:  function (response) {

    if(response == 1){
      Permisos(idUsuario);
      listaReq(idre,idUsuario, Estacion);
    }else{
    alertify.error('Error al eliminar el requisito legal'); 
    }
    
    }
    });

   },
function(){
}).setHeader('Mensaje').set({transition:'zoom',message: 'Desea eliminar el archivo seleccionado',labels:{ok:'Aceptar', cancel: 'Cancelar'}}).show();

}

function editararchivo(id, idmatriz, idUsuario){
$('#DivConfiguracion').load('public/administrador/vistas/modal-editar-requisito-legal-historial.php?id=' + id + '&idmatriz=' + idmatriz + '&idUsuario=' + idUsuario); 
}

function CancelarAgregar(id, idUsuario,Estacion){
$('#DivConfiguracion').load('public/administrador/vistas/modal-historial-requisito-legal-administrador.php?id=' + id + '&idUsuario=' + idUsuario + '&Estacion=' + Estacion); 
}

function EditarRequisito(id, idmatriz, idUsuario, Estacion){

var acusePDFED = document.getElementById("acusePDFED");
var acusePDFEFile = acusePDFED.files[0];
var acusePDFEFilePath = acusePDFED.value;

var requisitoPDFED = document.getElementById("requisitoPDFED");
var requisitoPDFEEFile = requisitoPDFED.files[0];
var requisitoPDFEEFilePath = requisitoPDFED.value;  

var fechavencimiento = $('#fechavencimiento').val();

var data = new FormData();
var url = 'public/sasisopa/actualizar/editar-requisito-legal-historial.php';

  data.append('idmatriz', idmatriz);
  data.append('acusepdf', acusePDFEFile);
  data.append('requisitopdf', requisitoPDFEEFile);
  data.append('fechavencimiento', fechavencimiento);

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
listaReq(id,idUsuario, Estacion);
Permisos(idUsuario);
}else{
$('#respuesta').html('<div class="text-center"><small class="text-danger">Adjunte el acuse o requisito legal en formato PDF.</small></div>');  
}
  

});


}

function NuevoRequisito(id, idUsuario, Estacion){
$('#DivConfiguracion').load('public/administrador/vistas/modal-historial-requisito-legal-nuevo-administrador.php?id=' + id + '&idUsuario=' + idUsuario + '&Estacion=' + Estacion); 
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
   url:   'public/administrador/vistas/calcular-fecha-vencimiento.php',
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

function AgregarRequisito(id, idUsuario, Estacion){

var FechaEmision = $('#fechaemision').val();
var vencimiento  = $('#vencimiento').val();
var acusePDFE = document.getElementById("acusePDFN");
var acusePDFEFile = acusePDFE.files[0];
var acusePDFEFilePath = acusePDFE.value;

var requisitoPDFE = document.getElementById("requisitoPDFN");
var requisitoPDFEEFile = requisitoPDFE.files[0];
var requisitoPDFEEFilePath = requisitoPDFE.value;

var data = new FormData();
var url = 'public/sasisopa/agregar/agrgar-requisito-legal-historial.php';

if (FechaEmision != "") {
$('#FechaEmision').css('border',''); 

  data.append('idre', id);
  data.append('idEstacion', Estacion);
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

  listaReq(id,idUsuario, Estacion);
  Permisos(idUsuario);

  });

}else{
$('#FechaEmision').css('border','2px solid #A52525');  
}

}

function Buscar(){
$('#ModalBuscar').modal('show');
}

function BuscarPersonal(){
var idPersonal = $('#idPersonal').val();
Permisos(idPersonal);
$('#ModalBuscar').modal('hide');
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
<div class="float-left"><h4>Permisos</h4></div>
<?php if($Session_IDUsuarioBD == 60){ ?>
<div class="float-right">
  <img src="<?php echo RUTA_IMG_ICONOS."buscar-icono.png";?>" onclick="Buscar()">
</div>
<?php } ?>
</div>

<div class="card-body">

<div id="ListaPermisos"></div>

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

  <div class="modal fade bd-example-modal-lg" id="ModalBuscar" >
  <div class="modal-dialog modal-dialog-centered" role="document">
  <div class="modal-content" style="border-radius: 0px;border: 0px;">
    <div class="modal-header">
  <h4 class="modal-title">Buscar</h4>
  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
  <span aria-hidden="true">&times;</span>
  </button>
  </div>
  <div class="modal-body">

    <select class="form-control" id="idPersonal">
      <option></option>
    <?php 
    $sqlPersonal = "SELECT * FROM tb_usuarios WHERE id_puesto = 5 AND estatus = 0";
    $resultPersonal = mysqli_query($con, $sqlPersonal);
    while($rowPersonal = mysqli_fetch_array($resultPersonal, MYSQLI_ASSOC)){
    echo '<option value="'.$rowPersonal['id'].'">'.$rowPersonal['nombre'].'</option>';
    }
    ?>
    </select>  

  <div class="text-right mt-3">
  <button type="button" class="btn btn-primary rounded-0" onclick="BuscarPersonal()">Buscar</button>
  </div>

  </div>
  </div>
  </div>
  </div>

<script src="<?php echo RUTA_JS ?>bootstrap.min.js"></script>
</body>
</html>
