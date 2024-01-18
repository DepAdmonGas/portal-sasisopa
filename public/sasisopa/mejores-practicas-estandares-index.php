<?php
require('app/help.php');

$sql_sasisopa_ayuda = "SELECT * FROM pu_sasisopa_ayuda WHERE id_usuario = '".$Session_IDUsuarioBD."' and detalle = '9-mejores-practicas-estandares' and estado = 0 LIMIT 1";
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
  .titulo{
    font-size: 1.4em;
  }
  .list-edit{
   list-style:none;
  }
  .list-titulo{
    font-size: 1.3em;
  }
  .list-subtitulo{
    font-size: 1.2em;
  }
  .list-contenido{
     font-size: 1.1em; 
  }
  </style>
  <script type="text/javascript">
  $(document).ready(function(){
  $('[data-toggle="tooltip"]').tooltip();
  $(".LoaderPage").fadeOut("slow");
  <?php if ($numero_sasisopa_ayuda == 1) {echo "btnAyuda();";} ?>

  ListaDisenoConstruccion();
  ListaOperacionMantenimiento();

  });
  function regresarP(){
   window.history.back();
  }

  function ListaDisenoConstruccion(){
  $('#ListaDisenoConstruccion').load('public/sasisopa/vistas/lista-diseno-construccion.php');
  }

  function ListaOperacionMantenimiento(){
  $('#ListaOperacionMantenimiento').load('public/sasisopa/vistas/lista-operacion-mantenimiento.php');
  }


  function btnAyuda(){
  $('#ModalMejoresPracticas').modal('show');
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
   $('#ModalMejoresPracticas').modal('hide');
   }
   });

  }else{
  $('#ModalMejoresPracticas').modal('hide');
  }
  }

  function DescargarDC(){
  window.location = "descargar-diseno-construccion";   
  }

  function DescargarOM(){
  window.location = "descargar-operacion-mantenimiento";  
  }

  function btnOperacionMantenimiento(){
  $('#myModal').modal('show');  
  }

  function btnGuardarOM(){

  var Fecha = $('#Fecha').val();
  var Norma = $('#Norma').val();
  var Nombre  = $('#Nombre').val();
  var Link = $('#Link').val();

  if(Fecha != ""){
  $('#Fecha').css('border','');
  if(Norma != ""){
  $('#Norma').css('border','');
  if(Nombre != ""){
  $('#Nombre').css('border','');

  var parametros = {
  "Fecha" : Fecha,
  "Norma" : Norma,
  "Nombre" : Nombre,
  "Link" : Link
  };

  alertify.confirm('',
function(){

$.ajax({
 data:  parametros,
 url:   'public/sasisopa/agregar/agregar-operacion-mantenimiento.php',
 type:  'post',
 beforeSend: function() {
 },
 complete: function(){
 },
 success:  function (response) {

if(response == 1){

ListaOperacionMantenimiento();
$('#Fecha').val("");
$('#Norma').val("");
$('#Nombre').val("");
$('#Link').val("");
$('#myModal').modal('hide'); 

}else{
 alertify.error('Error al crear el registro'); 
}


 }
 });

},
function(){
}).setHeader('Mensaje').set({transition:'zoom',message: '¿Desea agregar la siguiente información?',labels:{ok:'Aceptar', cancel: 'Cancelar'}}).show();


  }else{
  $('#Nombre').css('border','2px solid #A52525');
  }
  }else{
  $('#Norma').css('border','2px solid #A52525');
  }
  }else{
  $('#Fecha').css('border','2px solid #A52525');
  }

  }

  function eliminar(id){

    alertify.confirm('',
    function(){

  var parametros = {
  "id" : id
  };

    $.ajax({
     data:  parametros,
     url:   'public/sasisopa/eliminar/eliminar-operacion-mantenimiento.php',
     type:  'post',
     beforeSend: function() {
     },
     complete: function(){
     },
     success:  function (response) {

    if(response == 1){
    ListaOperacionMantenimiento();
    }else{
     alertify.error('Error al eliminar el registro'); 
    }

     }
     });

    },
    function(){
    }).setHeader('Mensaje').set({transition:'zoom',message: '¿Desea eliminar la siguiente información?',labels:{ok:'Aceptar', cancel: 'Cancelar'}}).show();

  }
  /////--------------------------------------------------------

  function btnDisenoConstruccion(){
    $('#ModalDC').modal('show');
  }

  function btnGuardarDC(){

  var Codigo = $('#Codigo').val();
  var Area = $('#Area').val();
 
  if(Codigo != ""){
  $('#Codigo').css('border','');
  if(Area != ""){
  $('#Area').css('border','');
 

  var parametros = {
  "Codigo" : Codigo,
  "Area" : Area
  };

  alertify.confirm('',
function(){

$.ajax({
 data:  parametros,
 url:   'public/sasisopa/agregar/agregar-diseno-construccion.php',
 type:  'post',
 beforeSend: function() {
 },
 complete: function(){
 },
 success:  function (response) {

if(response == 1){

ListaDisenoConstruccion();
$('#Codigo').val("");
$('#Area').val("");
$('#ModalDC').modal('hide'); 

}else{
alertify.error('Error al crear el registro'); 
}

 }
 });

},
function(){
}).setHeader('Mensaje').set({transition:'zoom',message: '¿Desea agregar la siguiente información?',labels:{ok:'Aceptar', cancel: 'Cancelar'}}).show();


  }else{
  $('#Area').css('border','2px solid #A52525');
  }
  }else{
  $('#Codigo').css('border','2px solid #A52525');
  }
  }

   function eliminarDC(id){

    alertify.confirm('',
    function(){

  var parametros = {
  "id" : id
  };

    $.ajax({
     data:  parametros,
     url:   'public/sasisopa/eliminar/eliminar-diseno-construccion.php',
     type:  'post',
     beforeSend: function() {
     },
     complete: function(){
     },
     success:  function (response) {

    if(response == 1){
    ListaDisenoConstruccion();
    }else{
     alertify.error('Error al eliminar el registro'); 
    }

     }
     });

    },
    function(){
    }).setHeader('Mensaje').set({transition:'zoom',message: '¿Desea eliminar la siguiente información?',labels:{ok:'Aceptar', cancel: 'Cancelar'}}).show();

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
    <div class="float-left"><h4>9. MEJORES PRÁCTICAS Y ESTÁNDARES</h4></div>
    <div class="float-right" style="margin-top: 6px;margin-left: 10px;">
    <a onclick="btnAyuda()" style="cursor: pointer;" data-toggle="tooltip" data-placement="left" title="Ayuda" >
    <img src="<?php echo RUTA_IMG_ICONOS."info.png"; ?>">
    </a>
    </div>
      </div>
    <div class="card-body">

    
    <div class="row">        

      <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12 mt-2 mb-2">            
            <div class="border">
            <div class="p-2">
            
            <div class="row">
  
            <div class="col-10">
              <h5>Diseño y construcción</h5>
            </div>

            <div class="col-2">

             <a class="float-right" onclick="btnDisenoConstruccion()" style="cursor: pointer;" data-toggle="tooltip" data-placement="left" title="Crear" >
            <img src="<?php echo RUTA_IMG_ICONOS."agregar.png"; ?>">
            </a>
            <a class="float-right mr-2" onclick="DescargarDC()" style="cursor: pointer;" data-toggle="tooltip" data-placement="left" title="Crear" >           
            <img src="<?php echo RUTA_IMG_ICONOS."pdf.png"; ?>">
            </a>

            </div>
            
            </div>
            <div class="border-bottom"></div>   
            <div class="mt-3" id="ListaDisenoConstruccion"></div>
          </div>            
          </div>
      </div>



        <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12 mt-2 mb-2">
          
           <div class="border">
            <div class="p-2">
            
 
            <div class="row">

            <div class="col-10">
              <h5>Operación y Mantenimiento</h5>
            </div>

            <div class="col-2">
           
            <a class="float-right" onclick="btnOperacionMantenimiento()" style="cursor: pointer;" data-toggle="tooltip" data-placement="left" title="Crear" >
            <img src="<?php echo RUTA_IMG_ICONOS."agregar.png"; ?>">
            </a>

            <a class="float-right mr-2" onclick="DescargarOM()" style="cursor: pointer;" data-toggle="tooltip" data-placement="left" title="Descargar" >           
            <img src="<?php echo RUTA_IMG_ICONOS."pdf.png"; ?>">
            </a>
            </div>
         
            </div> 
          <div class="border-bottom"></div>
          <div class="mt-3" id="ListaOperacionMantenimiento"></div>

            </div>
            
          </div>
        </div>
      </div>


    </div>
    </div>
    </div>
    </div>
    </div>

      <div class="modal fade bd-example-modal-lg" id="ModalMejoresPracticas" data-backdrop="static">
    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
      <div class="modal-content" style="border-radius: 0px;border: 0px;">
        <div class="modal-header">
          <h4 class="modal-title">Bienvenido al elemento 9 MEJORES PRÁCTICAS Y ESTÁNDARES</h4>
        </div>
        <div class="modal-body">

          <p class="text-justify" style="font-size: 1.1em">
            Aquí vas a poder consultar la <b>NOM-005 ASEA 2016</b> para la etapa actual de tu estación de servicio
          </p>
          <p class="text-justify" style="font-size: 1.1em">
            La política debe ser comunicada a todo el personal incluyendo clientes, prestadores de servicios y proveedores.
          </p>

          <hr>

          <label class="font-weight-bold" style="font-size: 1.1em">Como hacerlo:</label>
          <ul style="font-size: 1.1em">
            <li>En extracto encontraras los artículos aplicables a la etapa actual de la estación</li>
            <li>Podrás descargar la Norma oficial mexicana completa dando clic en el enlace </li>
          </ul>

          <hr>

          <label class="font-weight-bold" style="font-size: 1.1em">Responsables:</label>
          <p class="text-justify" style="font-size: 1.1em">Recuerda que es responsabilidad del <label class="text-danger font-weight-bold">Representante Técnico</label> (RT), <label class="text-danger font-weight-bold">Gerente de la Estación</label> el conocer y poner en práctica lo establecido en la <b>NOM-005 ASEA 2016</b>, esto con la finalidad de llevar acabo las mejores prácticas.</p>


        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-primary" style="border-radius: 0px;" onclick="btnFinAyuda()">Aceptar</button>
        </div>
      </div>
    </div>
    </div>

    <div class="modal fade bd-example-modal-lg" id="myModal" data-backdrop="static">
<div class="modal-dialog modal-lg modal-dialog-centered" role="document">
<div class="modal-content" style="border-radius: 0px;border: 0px;">
 <div class="modal-header">
   <h4 class="modal-title">Operación y Mantenimiento</h4>
     <button type="button" class="close" data-dismiss="modal" aria-label="Close">
   <span aria-hidden="true">&times;</span>
 </button>
 </div>

<div class="modal-body">

<b>Fecha:</b>
<input type="date" class="form-control rounded-0 mt-2 mb-2" id="Fecha">

<b>Norma:</b>
<textarea class="form-control rounded-0 mt-2 mb-2" id="Norma"></textarea>
<b>Nombre:</b>
<textarea class="form-control rounded-0 mt-2 mb-2" id="Nombre"></textarea>
<b>Link:</b>
<textarea class="form-control rounded-0 mt-2 mb-2" id="Link"></textarea>

</div>
<div class="modal-footer">
<button type="button" class="btn btn-primary" style="border-radius: 0px;" onclick="btnGuardarOM()">Guardar</button>
</div>
</div>
</div>
</div>

    <div class="modal fade bd-example-modal-lg" id="ModalDC" data-backdrop="static">
<div class="modal-dialog modal-lg modal-dialog-centered" role="document">
<div class="modal-content" style="border-radius: 0px;border: 0px;">
 <div class="modal-header">
   <h4 class="modal-title">Diseño y construcción</h4>
     <button type="button" class="close" data-dismiss="modal" aria-label="Close">
   <span aria-hidden="true">&times;</span>
 </button>
 </div>

<div class="modal-body">

<b>Código, estándar, normatividad o práctica de ingeniería:</b>
<textarea class="form-control rounded-0 mt-2 mb-2" id="Codigo"></textarea>
<b>Área, maquinaria, equipo o instalación a la que aplica:</b>
<textarea class="form-control rounded-0 mt-2 mb-2" id="Area"></textarea>

</div>
<div class="modal-footer">
<button type="button" class="btn btn-primary" style="border-radius: 0px;" onclick="btnGuardarDC()">Guardar</button>
</div>
</div>
</div>
</div>

  <script src="<?php echo RUTA_JS ?>bootstrap.min.js"></script>
  </body>
  </html>
