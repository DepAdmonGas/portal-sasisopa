<?php
require('app/help.php');

$sql_asistencia = "SELECT * FROM tb_politica_lista_asistencia WHERE id = '".$GET_idRegistro."' ";
$result_asistencia = mysqli_query($con, $sql_asistencia);
$numero_asistencia = mysqli_num_rows($result_asistencia);

while($row_asistencia = mysqli_fetch_array($result_asistencia, MYSQLI_ASSOC)){
$fecha = $row_asistencia['fecha'];

$lugar = $row_asistencia['lugar'];
$tema = $row_asistencia['tema'];
$finalidad = $row_asistencia['finalidad'];
$encargado = $row_asistencia['encargado'];
$estado = $row_asistencia['estado'];

if($row_asistencia['hora'] == "00:00:00"){
$hora = $hora_del_dia;
}else{
$hora = $row_asistencia['hora'];  
}
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
  <script type="text/javascript" src="<?php echo RUTA_JS ?>signature_pad.js"></script>
   <script type="text/javascript" src="<?php echo RUTA_JS ?>jquery.min.js"></script>
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

  ListaAsistencia(<?=$GET_idRegistro;?>)

  });

  function regresarP(){
   window.history.back();
  }
function btnGuardar(idRegistro,estado){

var Fecha = $('#Fecha').val();
var Hora = $('#Hora').val();
var Lugar = $('#Lugar').val();
var NomEncargado = $('#NomEncargado').val();
var Tema = $('#Tema').val();
var Finalidad = $('#Finalidad').val();


if(Fecha != ""){
$('#Fecha').css('border','');
if(Hora != ""){
$('#Hora').css('border','');
if(Lugar != ""){
$('#Lugar').css('border','');
if(NomEncargado != ""){
$('#NomEncargado').css('border','');
if(Tema != ""){
$('#Tema').css('border','');
if(Finalidad != ""){
$('#Finalidad').css('border','');

var parametros = {
"idRegistro" : idRegistro,
"Fecha" : Fecha,
"Hora" : Hora,
"Lugar" : Lugar,
"NomEncargado" : NomEncargado,
"Tema" : Tema,
"Finalidad" : Finalidad,
"Estado" : estado
};

alertify.confirm('',
function(){

$.ajax({
 data:  parametros,
 url:   '../public/sasisopa/actualizar/actualizar-politica-asistencia.php',
 type:  'post',
 beforeSend: function() {
 },
 complete: function(){
 },
 success:  function (response) {

if(response == 1){
alertify.message('Lista de asistencia fue creada correctamente');
window.history.back();

}else{
 alertify.error('Error al crear el registro'); 
}


 }
 });

},
function(){
}).setHeader('Lista de asistencia').set({transition:'zoom',message: 'Desea crear lista de asistencia',labels:{ok:'Aceptar', cancel: 'Cancelar'}}).show();

}else{
$('#Finalidad').css('border','2px solid #A52525');
}
}else{
$('#Tema').css('border','2px solid #A52525');
}
}else{
$('#NomEncargado').css('border','2px solid #A52525');
}
}else{
$('#Lugar').css('border','2px solid #A52525');
}
}else{
$('#Hora').css('border','2px solid #A52525');
}
}else{
$('#Fecha').css('border','2px solid #A52525');
}

  }

  function btnGuardarFirma(idRegistro){

  var PersonalFirma = $('#PersonalFirma').val();
  var ctx = document.getElementById("canvas");
  var image = ctx.toDataURL();
  document.getElementById('base64').value = image;

  var base64 = $('#base64').val();


  if(PersonalFirma != ""){
  $('#PersonalFirma').css('border',''); 
  
   var parametros = {
    "base64" : base64,
    "idRegistro" : idRegistro,
    "PersonalFirma" : PersonalFirma
    };

      $.ajax({
     data:  parametros,
     url:   '../public/sasisopa/agregar/agregar-politica-asistencia-firma.php',
     type:  'post',
     beforeSend: function() {
     },
     complete: function(){
    
     },
     success:  function (response) {

    if (response == 1) {
    $('#PersonalFirma').val('');
    resizeCanvas()
    ListaAsistencia(idRegistro)
    }else{
    alertify.error('Error al agregar')
    }

     }
     });


  }else{
   $('#PersonalFirma').css('border','2px solid #A52525'); 
  }

  }

  function ListaAsistencia(id){
$('#DivListaAsistencia').load('../public/sasisopa/vistas/politica-lista-asistencia-firma.php?idReporte=' + id); 
}

function EliminarRegistro(idRegistro,id){

  var parametros = {
    "id" : id
    };

 $.ajax({
     data:  parametros,
     url:   '../public/sasisopa/eliminar/eliminar-politica-asistencia-firma.php',
     type:  'post',
     beforeSend: function() {
     },
     complete: function(){
    
     },
     success:  function (response) {

    if (response == 1) {
    ListaAsistencia(idRegistro)
    }else{
    alertify.error('Error al eliminar')
    }

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
    <div class="float-left"><h4>Fo.ADMONGAS.002 (Lista de asistencia)</h4></div>

      </div>
    <div class="card-body">

      

      <div class="row">
        <div class="col-12 col-md-5 border-right">


        <div class="row">
        <div class="col-12 col-sm-6">
        <div class="form-group">
        <label for="temacomunicar" class="text-secondary" >Fecha:</label>
        <input type="date" class="form-control rounded-0" value="<?=$fecha;?>" id="Fecha">
        </div>
        </div>
        <div class="col-12 col-sm-6">
        <div class="form-group">
        <label for="temacomunicar" class="text-secondary" >Hora:</label>
        <input type="time" class="form-control rounded-0" value="<?=$hora;?>" id="Hora">
        </div>
        </div>
        <div class="col-12 col-sm-6">
        <div class="form-group">
        <label for="temacomunicar" class="text-secondary" >Lugar:</label>
        <input type="text" class="form-control rounded-0" value="<?=$lugar;?>" id="Lugar">
        </div>
        </div>

      <div class="col-12 col-sm-6">
      <div class="form-group">
      <label for="temacomunicar" class="text-secondary" >Nombre del encargado de la comunicación:</label>
      <select class="form-control rounded-0" id="NomEncargado">
      <?php if($encargado == ""){echo '<option value="">Selecciona el encargado</option>';}else{echo "<option value='".$encargado."'>".$encargado."</option>";} ?>
        <?php
        $sql_personal = "SELECT * FROM tb_usuarios WHERE id_gas = '".$Session_IDEstacion."' AND id_puesto = 6 AND estatus = 0 ";
        $result_personal = mysqli_query($con, $sql_personal);
        $numero_personal = mysqli_num_rows($result_personal);
        while($row_personal = mysqli_fetch_array($result_personal, MYSQLI_ASSOC)){

        if($encargado != $row_personal['nombre']){
        echo "<option value='".$row_personal['nombre']."'>".$row_personal['nombre']."</option>";
        }
        }
        ?> 
      </select>
      </div>
      </div>

      <div class="col-12 col-sm-6">
      <div class="form-group">
      <label for="temacomunicar" class="text-secondary" >Tema a comunicar:</label>
      <textarea class="form-control rounded-0" id="Tema"><?=$tema;?></textarea>
      </div>
      </div>
      <div class="col-12 col-sm-6">
      <div class="form-group">
      <label for="temacomunicar" class="text-secondary" >Finalidad de la comunicación:</label>
      <textarea class="form-control rounded-0" id="Finalidad"><?=$finalidad;?></textarea>
      </div>
      </div>


        </div>
          
        </div>
        <div class="col-12 col-md-7">

        <div class="row">
        <div class="col-12 col-md-4 border-right">
       <select class="form-control rounded-0" id="PersonalFirma">
       <option value="">Selecciona el personal</option>
        <?php
        $sql_lista = "SELECT * FROM tb_usuarios WHERE id_gas = '".$Session_IDEstacion."' AND  estatus = 0 ";
        $result_lista = mysqli_query($con, $sql_lista);
        $numero_lista = mysqli_num_rows($result_lista);
        while($row_lista = mysqli_fetch_array($result_lista, MYSQLI_ASSOC)){
        echo "<option value='".$row_lista['id']."'>".$row_lista['nombre']."</option>";
        }
        ?> 
      </select>
    <div class="font-weight-light mt-1">Dibuja la firma de la persona:</div>
    <div id="signature-pad" class="signature-pad mt-2" >
    <div>
    <canvas style="width: 100%; height: 200px; border: 1px black solid; " id="canvas"></canvas>
    </div>
    </div>

    <input type="hidden" name="base64" value="" id="base64">

          <div class="text-right mt-1">
      <button type="button" class="btn btn-sm btn-Light rounded-0" onclick="resizeCanvas()">Limpiar</button>
      <button type="button" class="btn btn-sm btn-Primary rounded-0" onclick="btnGuardarFirma(<?=$GET_idRegistro;?>)">Agregar</button>
      </div>

            </div>
            <div class="col-12 col-md-8">
              <div id="DivListaAsistencia"></div>
            </div>
          </div>

        </div>
      </div>

      <hr>

      <div class="text-right">
      <button type="button" class="btn btn-success rounded-0" onclick="btnGuardar(<?=$GET_idRegistro;?>,<?=$estado;?>)">Guardar cambios</button>
      </div>


    </div>
    </div>
    </div>
    </div>
    </div>


<script type="text/javascript">

var wrapper = document.getElementById("signature-pad");

var canvas = wrapper.querySelector("canvas");
var signaturePad = new SignaturePad(canvas, {
  backgroundColor: 'rgb(255, 255, 255)'
});

function resizeCanvas() {

  var ratio =  Math.max(window.devicePixelRatio || 1, 1);

  canvas.width = canvas.offsetWidth * ratio;
  canvas.height = canvas.offsetHeight * ratio;
  canvas.getContext("2d").scale(ratio, ratio);

  signaturePad.clear();
}

window.onresize = resizeCanvas;
resizeCanvas();
 
</script>

  <script src="<?php echo RUTA_JS ?>bootstrap.min.js"></script>


  </body>
  </html>
