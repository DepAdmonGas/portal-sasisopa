<?php
require('app/help.php');

$GET_ID;

$sql = "SELECT * FROM tb_atencion_hallazgos WHERE id = '".$GET_ID."' ";
$result = mysqli_query($con, $sql);
$numero = mysqli_num_rows($result);
while($row = mysqli_fetch_array($result, MYSQLI_ASSOC)){
$fechaauditoria = $row['fecha_auditoria'];
$nocontrol = $row['no_control'];
$tipoauditoria = $row['tipo_auditoria'];
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
  background: url('imgs/iconos/load-img.gif') 50% 50% no-repeat rgb(249,249,249);
}
  </style>
  <script type="text/javascript">
  $(document).ready(function(){
  $('[data-toggle="tooltip"]').tooltip();
  $(".LoaderPage").fadeOut("slow");

  ListaHallazgos(<?=$GET_ID;?>);

  });

  function regresarP(){
   window.history.back();
  }

  function ListaHallazgos(id){
  $('#ListaHallazgos').load('../public/sasisopa/vistas/lista-hallazgos.php?id=' + id);
  }

  function btnAgregar(id, idHallazgo){
  $('#Modal').modal('show');
  $('#ContenidoModal').load('../public/sasisopa/vistas/modal-agregar-hallazgos.php?id=' + id + '&idHallazgo=' + idHallazgo);
  }

  function GuardarHallazgo(id,idHallazgo){

  let IdSasisopa = $('#IdSasisopa').val();
  let Hallazgos = $('#Hallazgos').val();
  let Accion = $('#Accion').val();
  let FechaI = $('#FechaI').val();

  if (IdSasisopa != "") {
  $('#IdSasisopa').css('border','');
  if (Hallazgos != "") {
  $('#Hallazgos').css('border','');
  if (Accion != "") {
  $('#Accion').css('border','');
  if (FechaI != "") {
  $('#FechaI').css('border','');

  var parametros = {
  "id" : id,
  "idHallazgo" : idHallazgo,
  "IdSasisopa" : IdSasisopa,
  "Hallazgos" : Hallazgos,
  "Accion" : Accion,
  "FechaI" : FechaI
  };

   $.ajax({
   data:  parametros,
   url:   '../public/sasisopa/agregar/agregar-hallazgos.php',
   type:  'post',
   beforeSend: function() {
   },
   complete: function(){
   },
   success:  function (response) {

  if(response == 1){
  $('#Modal').modal('hide');
  ListaHallazgos(id);
  }else if(response == 2){
  $('#IdSasisopa').css('border','2px solid #A52525');  
  $('#idResultado').html('El elemento seleccionado ya se agrego');
  }
   }
   });

  }else{
  $('#FechaI').css('border','2px solid #A52525');
  }
  }else{
  $('#Accion').css('border','2px solid #A52525');
  }
  }else{
  $('#Hallazgos').css('border','2px solid #A52525');
  }
  }else{
  $('#IdSasisopa').css('border','2px solid #A52525');
  }

  }

function EditarAH(e,dato,id){
   var parametros = {
        "id" : id,
        "valor" : e.value,
        "dato" : dato
      };

  $.ajax({
   data:  parametros,
   url:   '../public/sasisopa/actualizar/actualizar-atencion-hallazgos.php',
   type:  'post',
   beforeSend: function() {
   },
   complete: function(){
   },
   success:  function (response) {
   
   }
   });

  }

  function Eliminar(id,idHallazgo){

  var parametros = {
   "idHallazgo" : idHallazgo
   };

   alertify.confirm('',
    function(){

   $.ajax({
   data:  parametros,
   url:   '../public/sasisopa/eliminar/eliminar-hallazgos.php',
   type:  'post',
   beforeSend: function() {
   },
   complete: function(){
   },
   success:  function (response) {

   ListaHallazgos(id);

   }
   });


    },
    function(){
    }).setHeader('Mensaje').set({transition:'zoom',message: 'Desea eliminar la información seleccionada',labels:{ok:'Aceptar', cancel: 'Cancelar'}}).show();
 }


//------------------------------------------------------------------------------------------

function ModalEvidencia(idAtencion,idHallazgo){
$('#Modal').modal('show');
$('#ContenidoModal').load('../public/sasisopa/vistas/modal-agregar-evidencia-hallazgos.php?idAtencion=' + idAtencion + '&idHallazgo=' + idHallazgo);
}

  function Evidencia(idAtencion,idHallazgo){

  let Evidencia = document.getElementById("Evidencia");
  let File = Evidencia.files[0];
  let FilePath = Evidencia.value;

  var data = new FormData();
  var url = '../public/sasisopa/agregar/agregar-evidencia-atencion-hallazgos.php';

  if (FilePath != "") {

  data.append('idHallazgo', idHallazgo);
  data.append('File', File);

  $.ajax({
  url: url,
  type: 'POST',
  contentType: false,
  data: data,
  processData: false,
  cache: false
  }).done(function(data){

  $('#ContenidoModal').load('../public/sasisopa/vistas/modal-agregar-evidencia-hallazgos.php?idAtencion=' + idAtencion + '&idHallazgo=' + idHallazgo);

    ListaHallazgos(idAtencion);

  });

  }else{
  $('#Evidencia').css('border','2px solid #A52525'); 
  }

   }
//----------------------------------------------------------------------------------------

     function Guardar(id){
    ListaAtencionAllazgos();
    $('#ModalAgregar').modal('hide');
   }



   function EliminarEvidencia(idAtencion,idHallazgo,idEvidencia){

    var parametros = {
   "id" : idEvidencia,
   "categoria" : 2
   };

   $.ajax({
   data:  parametros,
   url:   '../public/sasisopa/eliminar/eliminar-atencion-hallazgos.php',
   type:  'post',
   beforeSend: function() {
   },
   complete: function(){
   },
   success:  function (response) {

   $('#ContenidoModal').load('../public/sasisopa/vistas/modal-agregar-evidencia-hallazgos.php?idAtencion=' + idAtencion + '&idHallazgo=' + idHallazgo);

    ListaHallazgos(idAtencion);

   }
   });

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
    <div class="float-left"><h4>Atención de Hallazgos</h4></div>
    </div>
    <div class="card-body">

<div class="row">
  <div class="col-4">
    <h6>Fecha de la auditoria:</h6>
    <input type="date" class="form-control rounded-0" value="<?=$fechaauditoria;?>" onchange="EditarAH(this,1,<?=$GET_ID;?>)">
  </div>

  <div class="col-4">
    <h6>No de control de la auditoria:</h6>
    <input type="text" class="form-control rounded-0" value="<?=$nocontrol;?>" onkeyup="EditarAH(this,2,<?=$GET_ID;?>)">
  </div>

  <div class="col-4">
    <h6>Tipo de auditoria:</h6>
    <input type="text" class="form-control rounded-0" value="<?=$tipoauditoria;?>" onkeyup="EditarAH(this,3,<?=$GET_ID;?>)">
  </div>

</div>

<hr>
    <div class="pb-4">
    <div class="float-left"><h5>Hallazgos</h5></div>
    <div class="float-right" style="margin-top: 6px;margin-left: 10px;">
    <a onclick="btnAgregar(<?=$GET_ID;?>,0)" style="cursor: pointer;" data-toggle="tooltip" >
    <img src="<?php echo RUTA_IMG_ICONOS."agregar.png"; ?>">
    </a>
    </div>
    </div>

    <div id="ListaHallazgos"></div>

    <div class="text-right">
<button type="button" class="btn btn-success" style="border-radius: 0px;" onclick="regresarP()">Guardar</button>
</div>

    </div>
    </div>
    </div>
    </div>
    </div>

    <div class="modal fade bd-example-modal-lg" id="Modal" data-backdrop="static">
    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
    <div class="modal-content" style="border-radius: 0px;border: 0px;">
    <div id="ContenidoModal"></div>
    </div>
    </div>
    </div>

  <script src="<?php echo RUTA_JS ?>bootstrap.min.js"></script>
  </body>
  </html>
<?php
//------------------
mysqli_close($con);
//------------------
?>