<?php
require('app/help.php');
?>
<!DOCTYPE html>
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

  ListaComunicados();
 
  });

  function ListaComunicados(){
  $('#DivComunicados').html("<img src='<?php echo RUTA_IMG_ICONOS; ?>load-img.gif' style='width: 40px;display:block;margin:auto;' />");
  $('#DivComunicados').load('public/gerente/vistas/lista-comunicados.php');  
  }

  function regresarP(){
   window.history.back();
  }
   function btnNuevo(){
  $('#myModalNuevo').modal('show');
 }
 
 function BtnAgregar() {

var temacomunicar = $("#temacomunicar").val();
var detalle = $("#detalle").val();
var dirigidoa = $("#dirigidoa").val();
var inputFileImage = document.getElementById("customFile");
var file = inputFileImage.files[0];
var data = new FormData();
var url = "public/gerente/agregar/agregar-comunicado.php";

data.append('customFile', file);
data.append('temacomunicar', temacomunicar);
data.append('detalle', detalle);
data.append('dirigidoa', dirigidoa);

if (temacomunicar != "") {
$('#temacomunicar').css('border','');
if (detalle != "") {
$('#detalle').css('border','');
if (dirigidoa != "") {
$('#borderdirigidoa').css('border','');

alertify.confirm('',
function(){

$.ajax({
url: url,
type: 'POST',
contentType: false,
data: data,
processData: false,
cache: false
}).done(function(data){
alertify.message('El comunicado fue creado correctamente');
$('#myModalNuevo').modal('hide');
ListaComunicados();
});
 },
    function(){
    }).setHeader('Crear comunicado').set({transition:'zoom',message: 'Desea crear el siguiente comunicado',labels:{ok:'Aceptar', cancel: 'Cancelar'}}).show();


}else{
$('#borderdirigidoa').css('border','2px solid #A52525');
}
}else{
$('#detalle').css('border','2px solid #A52525');
}
}else{
$('#temacomunicar').css('border','2px solid #A52525');
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

    <div class="float-left" style="padding-right: 20px;margin-top: 5px;">
    <a onclick="regresarP()" style="cursor: pointer;" data-toggle="tooltip" data-placement="right" title="Regresar"><img src="<?php echo RUTA_IMG_ICONOS."regresar.png"; ?>"></a>
    </div>
    <div class="float-left"><h4>COMUNICADOS</h4></div>
    <div class="float-right" style="margin-top: 6px;">
    <a onclick="btnNuevo()" style="cursor: pointer;" data-toggle="tooltip" data-placement="left" title="Nuevo" >
    <img src="<?php echo RUTA_IMG_ICONOS."agregar.png"; ?>">
    </a>
    </div>
    <div class="mt-5 p-3 bg-white">
    <div id="DivComunicados"></div>
    </div>

    </div>

     <div class="modal fade bd-example-modal-lg" id="myModalNuevo" data-backdrop="static">
    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
      <div class="modal-content" style="border-radius: 0px;border: 0px;">
        <div class="modal-header">
          <h5 class="modal-title">Crear comunicado</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
        </div>
        <div class="modal-body">

         <div class="form-group">
         <label for="temacomunicar" class="text-secondary" >Tema a comunicar:</label>
         <input type="text" class="form-control" name="" id="temacomunicar" style="border-radius: 0px;" placeholder="Agregar tema a comunicar">
         </div>

         <div class="form-group">
         <label for="detalle" class="text-secondary" >Detalle:</label>
         <textarea class="form-control" id="detalle" placeholder="Agregar detalle" style="border-radius: 0px;" rows="6"></textarea>
         </div>


      <div class="form-group">
      <label for="tipocomunicacion" class="text-secondary">Dirigido a: </label>
      <div id="borderdirigidoa">
      <select class="selectpicker" id="dirigidoa" multiple title="Selecciona" data-width="100%" >
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

      <label for="tipocomunicacion" class="text-secondary">Seleccionar archivo: </label>
      <input type="file" class="form-control" id="customFile" style="border-radius: 0px;font-size: .9em;">


        </div>
        <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal" style="border-radius: 0px;">Cancelar</button>
        <button type="button" class="btn btn-primary" style="border-radius: 0px;" onclick="BtnAgregar()">Crear comunicado</button>
        </div>
      </div>
    </div>
    </div> 

 <script src="<?php echo RUTA_JS ?>bootstrap.min.js"></script>
<script src="<?php echo RUTA_JS ?>bootstrap-select.js"></script>
  </body>
  </html>
