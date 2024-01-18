<?php
require('app/help.php');

$sql_estaciones = "SELECT nombre FROM tb_estaciones WHERE id = '".$idEstacion."' ";
$result_estaciones = mysqli_query($con, $sql_estaciones);
$numero_estaciones = mysqli_num_rows($result_estaciones);
while($row_estaciones = mysqli_fetch_array($result_estaciones, MYSQLI_ASSOC)){
$estacion = $row_estaciones['nombre'];
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

  .hovercolor:hover{
  background: rgba(0, 120, 238, .8) !important;
  }
  </style>
  <script type="text/javascript">
  $(document).ready(function(){
  $('[data-toggle="tooltip"]').tooltip();
  $(".LoaderPage").fadeOut("slow");

  ListaAnalisis(<?=$idEstacion;?>);
  
  });
  function regresarP(){
  window.history.back();
  }

  function ListaAnalisis(idEstacion){
    $('#DivListaAnalisis').load('../public/administrador/vistas/lista-analisis-riesgo.php?idEstacion=' + idEstacion); 
  }

  function ModalNuevo(idEstacion){
  $('#Modal').modal('show');
  $('#DivModal').load('../public/administrador/vistas/modal-nuevo-analisis-riesgo.php?idEstacion=' + idEstacion); 
  } 

  function BtnGuardar(idEstacion){

  var Fecha = $('#Fecha').val();
  var Descripcion = $('#Descripcion').val();
  var Documento = $('#Documento').val();

  var data = new FormData();
  var url = "../public/administrador/agregar/agregar-analisis-riesgo.php";

  var Documento = document.getElementById("Documento");
  var Documento_File = Documento.files[0];
  var Documento_Path = Documento.value;
  var Documento_pdf = Documento_Path.split('.').pop();

  if(Fecha != ""){
  $('#Fecha').css('border','');
  if(Descripcion != ""){
  $('#Descripcion').css('border','');
  if (Documento_Path != "") {
  $('#Documento').css('border','');
  if (Documento_pdf == "pdf") {
  $('#Documento').css('border','');
  $('#DivResultadoPDF').html('');

  data.append('idEstacion', idEstacion);
  data.append('Fecha', Fecha);
  data.append('Descripcion', Descripcion);
  data.append('Documento_File', Documento_File);

  $.ajax({
  url: url,
  type: 'POST',
  contentType: false,
  data: data,
  processData: false,
  cache: false
  }).done(function(data){

    if(data == 1){

    ListaAnalisis(idEstacion)
    $('#Modal').modal('hide'); 

    }else{
    alertify.error('Error al crear el registro');
    }

  });

  }else{
  $('#Documento').css('border','2px solid #A52525');
  $('#DivResultadoPDF').html('<label class="text-danger">Solo acepta formato PDF</label>');
  }
  }else{
  $('#Documento').css('border','2px solid #A52525');
  }
  }else{
  $('#Descripcion').css('border','2px solid #A52525');  
  }
  }else{
  $('#Fecha').css('border','2px solid #A52525');  
  }

  }

  function ModalAnexos(idEstacion,id){
  $('#Modal').modal('show');
  $('#DivModal').load('../public/administrador/vistas/modal-anexos-analisis-riesgo.php?idEstacion=' + idEstacion + '&id=' + id); 
  }
 

  function BtnAnexo(idEstacion,id){

  var data = new FormData();
  var url = "../public/administrador/agregar/agregar-anexo-analisis-riesgo.php";

  var Descripcion = $('#Descripcion').val();

  var Anexo = document.getElementById("Anexo");
  var Anexo_File = Anexo.files[0];
  var Anexo_Path = Anexo.value;
  var Anexo_pdf = Anexo_Path.split('.').pop();

  if (Anexo_Path != "") {
  $('#Anexo').css('border','');
  if (Anexo_Path != "") {
  $('#Anexo').css('border','');
  $('#DivAnexoPDF').html('');

  data.append('idEstacion', idEstacion);
  data.append('id', id);
  data.append('Descripcion', Descripcion);
  data.append('Anexo_File', Anexo_File);

  $.ajax({
  url: url,
  type: 'POST',
  contentType: false,
  data: data,
  processData: false,
  cache: false
  }).done(function(data){

    if(data == 1){

    $('#DivModal').load('../public/administrador/vistas/modal-anexos-analisis-riesgo.php?idEstacion=' + idEstacion + '&id=' + id); 


    }else{
    alertify.error('Error al crear el registro');
    }

  });

  }else{
  $('#Anexo').css('border','2px solid #A52525');
  $('#DivAnexoPDF').html('<label class="text-danger">Solo acepta formato PDF</label>');
  }
  }else{
  $('#Anexo').css('border','2px solid #A52525');
  }

  }

    function EliminarAR(idEstacion,id){

     var parametros = {
    "id" : id
    };


alertify.confirm('',
function(){

   $.ajax({
     data:  parametros,
     url:   '../public/administrador/eliminar/eliminar-analisis-riesgo.php',
     type:  'post',
     beforeSend: function() {
     },
     complete: function(){
     
     },
     success:  function (response) {
       ListaAnalisis(idEstacion);
     }
});

},
function(){
}).setHeader('Mensaje').set({transition:'zoom',message: '¿Desea eliminar la información del analisis de riesgo?',labels:{ok:'Aceptar', cancel: 'Cancelar'}}).show();
}





  function EliminarAAR(idEstacion,idrequisito,idanexo){

     var parametros = {
    "idanexo" : idanexo
    };


alertify.confirm('',
function(){

   $.ajax({
     data:  parametros,
     url:   '../public/administrador/eliminar/eliminar-anexo-analisis-riesgo.php',
     type:  'post',
     beforeSend: function() {
     },
     complete: function(){
     },
     success:  function (response) {

      if(response == 1){

        $('#DivModal').load('../public/administrador/vistas/modal-anexos-analisis-riesgo.php?idEstacion=' + idEstacion + '&id=' + idrequisito);
      }else{
      alertify.error('Error al eliminar el registro');
      }

     }
});

},
function(){
}).setHeader('Mensaje').set({transition:'zoom',message: '¿Desea eliminar el siguiente anexo del analisis de riesgo?',labels:{ok:'Aceptar', cancel: 'Cancelar'}}).show();
}

  function EditarAR(idEstacion,id){
  $('#Modal').modal('show');
  $('#DivModal').load('../public/administrador/vistas/modal-editar-analisis-riesgo.php?idEstacion=' + idEstacion + '&id=' + id); 
  }

  function BtnEditar(idEstacion,id){
     var Fecha = $('#Fecha').val();
  var Descripcion = $('#Descripcion').val();
  var Documento = $('#Documento').val();

  var data = new FormData();
  var url = "../public/administrador/editar/editar-analisis-riesgo.php";

  var Documento = document.getElementById("Documento");
  var Documento_File = Documento.files[0];
  var Documento_Path = Documento.value;
  var Documento_pdf = Documento_Path.split('.').pop();

  if(Fecha != ""){
  $('#Fecha').css('border','');
  if(Descripcion != ""){
  $('#Descripcion').css('border','');
 

  data.append('idEstacion', idEstacion);
  data.append('id', id);
  data.append('Fecha', Fecha);
  data.append('Descripcion', Descripcion);
  data.append('Documento_File', Documento_File);

  $.ajax({
  url: url,
  type: 'POST',
  contentType: false,
  data: data,
  processData: false,
  cache: false
  }).done(function(data){

    if(data == 1){

    ListaAnalisis(idEstacion)
    $('#Modal').modal('hide'); 

    }else{
    alertify.error('Error al crear el registro');
    }

  });

  }else{
  $('#Descripcion').css('border','2px solid #A52525');  
  }
  }else{
  $('#Fecha').css('border','2px solid #A52525');  
  }
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
    <div class="float-left"><h4><?=$estacion;?> (Análisis de riesgo) </h4></div>

    <div class="float-right" style="margin-top: 5px;">
    <a onclick="ModalNuevo(<?=$idEstacion;?>)" style="cursor: pointer;" data-toggle="tooltip" data-placement="right" title="Nuevo"><img src="<?php echo RUTA_IMG_ICONOS."agregar.png"; ?>"></a>
     </div>
    </div>

    <div class="card-body">

  <div id="DivListaAnalisis"></div>

    </div>
    </div>
    </div>
    </div>
    </div>

    <div class="modal fade bd-example-modal-lg" id="Modal" data-backdrop="static">
    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
      <div class="modal-content" style="border-radius: 0px;border: 0px;">

        <div id="DivModal"></div>

      </div>
    </div>
    </div>


  <script src="<?php echo RUTA_JS ?>bootstrap.min.js"></script>
  </body>
  </html>
