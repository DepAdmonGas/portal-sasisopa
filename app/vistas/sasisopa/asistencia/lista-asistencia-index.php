<?php
require('app/help.php');
include_once "app/modelo/Asistencia.php";

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
  <link href="<?php echo RUTA_CSS ?>bootstrap.css" rel="stylesheet" />
  <link rel="stylesheet" href="<?php echo RUTA_CSS ?>componentes.css">
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

  DivSelPersonal(<?=$GET_idRegistro;?>)
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
  "accion" : "actualizar-lista-asistencia",
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
 url:   '../app/controlador/AsistenciaControlador.php',
 type:  'post',
 beforeSend: function() {
 },
 complete: function(){
 },
 success:  function (response) {

  console.log(response)

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

  if(PersonalFirma != ""){
  $('#PersonalFirma').css('border',''); 
  
   var parametros = {
    "accion" : "agregar-lista-asistencia-firma",
    "idRegistro" : idRegistro,
    "PersonalFirma" : PersonalFirma
    };

      $.ajax({
     data:  parametros,
     url:   '../app/controlador/AsistenciaControlador.php',
     type:  'post',
     beforeSend: function() {
     },
     complete: function(){
    
     },
     success:  function (response) {

    if (response) {
    $('#PersonalFirma').val('');
    DivSelPersonal(idRegistro)
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

function EliminarRegistro(idRegistro,id){

  var parametros = {
    "accion" : "eliminar-lista-asistencia-firma",
    "id" : id
    };

 $.ajax({
     data:  parametros,
     url:   '../app/controlador/AsistenciaControlador.php',
     type:  'post',
     beforeSend: function() {
     },
     complete: function(){
    
     },
     success:  function (response) {

    if (response == 1) {
    ListaAsistencia(idRegistro)
    DivSelPersonal(idRegistro)
    }else{
    alertify.error('Error al eliminar')
    }

     }
     });
 
}

function DivSelPersonal(id){
$('#DivSelPersonal').load('../app/vistas/sasisopa/asistencia/select-asistencia-personal.php?idReporte=' + id); 
}

function ListaAsistencia(id){
$('#DivListaAsistencia').load('../app/vistas/sasisopa/asistencia/lista-asistencia-firma.php?idReporte=' + id); 
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
    <div class="float-left"><h4>Fo.ADMONGAS.010 (Registro de la atención y el seguimiento a la comunicación interna y externa.)</h4></div>

    <div class="row no-gutters mt-5 bg-white">
    <?php  
    
    $class_asistencia = new Asistencia();
    $array_lista_asistencia = $class_asistencia->detalleAsistencia($GET_idRegistro);

    $fecha = $array_lista_asistencia['fecha'];
    $lugar = $array_lista_asistencia['lugar'];
    $tema = $array_lista_asistencia['tema'];
    $finalidad = $array_lista_asistencia['finalidad'];
    $encargado = $array_lista_asistencia['encargado'];
    $estado = $array_lista_asistencia['estado'];

    if($array_lista_asistencia['hora'] == "00:00:00"){
    $hora = $hora_del_dia;
    }else{
    $hora = $array_lista_asistencia['hora'];
    }

    ?>
       
      <!-- Elemento 1-->
      <div class="col-xl-5 col-lg-5 col-md-12 col-sm-12 border-right p-3">      

      <div class="row">
      
      <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12">
      <div class="form-group">
      <label for="temacomunicar" class="text-secondary" >Fecha:</label>
        <input type="date" class="form-control rounded-0" value="<?=$fecha;?>" id="Fecha">
        </div>
        </div>


      <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12">
        <div class="form-group">
        <label for="temacomunicar" class="text-secondary" >Hora:</label>
        <input type="time" class="form-control rounded-0" value="<?=$hora;?>" id="Hora">
        </div>
        </div>


      <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12">
        <div class="form-group">
        <label for="temacomunicar" class="text-secondary" >Lugar:</label>
        <input type="text" class="form-control rounded-0" value="<?=$lugar;?>" id="Lugar">
        </div>
        </div>


      <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12">
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
 

      <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12">
      <div class="form-group">
      <label for="temacomunicar" class="text-secondary" >Tema a comunicar:</label>
      <textarea class="form-control rounded-0" id="Tema"><?=$tema;?></textarea>
      </div>
      </div>

      <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12">
      <div class="form-group">
      <label for="temacomunicar" class="text-secondary" >Finalidad de la comunicación:</label>
      <textarea class="form-control rounded-0" id="Finalidad"><?=$finalidad;?></textarea>
      </div>
      </div>
      </div>
          
      </div>

    
    <!-- Elemento 2-->

    <div class="col-xl-7 col-lg-7 col-md-12 col-sm-12 p-3"> 
    <div class="row">  

    <div class="col-xl-4 col-lg-4 col-md-12 col-sm-12 mb-1 border-right"> 
    <div id="DivSelPersonal"></div>
    <div class="text-right mt-2 mb-3">
    <button type="button" class="btn btn-sm btn-Primary rounded-0" onclick="btnGuardarFirma(<?=$GET_idRegistro;?>)">Agregar</button>
    </div>
    </div>         

    <div class="col-xl-8 col-lg-8 col-md-12 col-sm-12 mt-2 "> 

    <div style="height: 30em;overflow-x: hidden;overflow-y: scroll;">
    <div id="DivListaAsistencia"></div>
    </div>
    </div>
    </div>

    </div>
    </div>

    <div class="text-right mt-3">
    <button type="button" class="btn btn-success rounded-0" onclick="btnGuardar(<?=$GET_idRegistro;?>,<?=$estado;?>)">Guardar cambios</button>
    </div>

    </div>


  <script src="<?php echo RUTA_JS ?>bootstrap.min.js"></script>


  </body>
  </html>
