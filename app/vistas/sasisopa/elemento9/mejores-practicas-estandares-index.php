<?php
require('app/help.php');
include_once "app/modelo/Ayuda.php";

$class_ayuda = new Ayuda();
$array_ayuda = $class_ayuda->sasisopaAyuda($Session_IDUsuarioBD,'9-mejores-practicas-estandares');
$id_ayuda = $array_ayuda['id'];
$estado = $array_ayuda['estado'];

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
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.7.0/animate.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/2.9.2/umd/popper.min.js"></script>
  <script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.13.2/jquery-ui.min.js"></script>
  <script type="text/javascript" src="<?=RUTA_JS?>alertify.js"></script>
  <link href="https://fonts.googleapis.com/css?family=Montserrat" rel="stylesheet">
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
  <?php if ($id_ayuda != 0) {echo "btnAyuda();";} ?>

  ListaDisenoConstruccion();
  ListaOperacionMantenimiento();

  });
  function regresarP(){
    window.history.back();
  }

  function btnAyuda(){
  $('#ModalMejoresPracticas').modal('show');
  }

  function btnFinAyuda(idayuda, estado){

    var parametros = {
      "accion" : "actualizar-ayuda",
      "idayuda" : idayuda
    };

    if (idayuda != 0 && estado == 0) {
   $.ajax({
   data:  parametros,
   url:   'app/controlador/AyudaControlador.php',
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

  function ListaDisenoConstruccion(){
  $('#ListaDisenoConstruccion').load('app/vistas/sasisopa/elemento9/lista-diseno-construccion.php');
  }

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
  "accion" : "agregar-diseno-construccion",
  "Codigo" : Codigo,
  "Area" : Area
  };

  alertify.confirm('',
    function(){

    $.ajax({
    data:  parametros,
    url:   'app/controlador/MejoresPracticasEstandaresControlador.php',
    type:  'post',
    beforeSend: function() {
    },
    complete: function(){
    },
    success:  function (response) {

    if(response){

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
    "accion" : "eliminar-diseno-construccion",
    "id" : id
    };

    $.ajax({
    data:  parametros,
    url:   'app/controlador/MejoresPracticasEstandaresControlador.php',
    type:  'post',
    beforeSend: function() {
    },
    complete: function(){
    },
    success:  function (response) {

    if(response){
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

function DescargarDC(){
  window.location = "descargar-diseno-construccion";   
  }

  function ListaOperacionMantenimiento(){
  $('#ListaOperacionMantenimiento').load('app/vistas/sasisopa/elemento9/lista-operacion-mantenimiento.php');
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
"accion" : "agregar-operacion-mantenimiento",
"Fecha" : Fecha,
"Norma" : Norma,
"Nombre" : Nombre,
"Link" : Link
};

alertify.confirm('',
function(){

$.ajax({
data:  parametros,
url:   'app/controlador/MejoresPracticasEstandaresControlador.php',
type:  'post',
beforeSend: function() {
},
complete: function(){
},
success:  function (response) {

if(response){

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
"accion" : "eliminar-operacion-mantenimiento",
"id" : id
};

$.ajax({
 data:  parametros,
 url:   'app/controlador/MejoresPracticasEstandaresControlador.php',
 type:  'post',
 beforeSend: function() {
 },
 complete: function(){
 },
 success:  function (response) {

if(response){
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

  function DescargarOM(){
  window.location = "descargar-operacion-mantenimiento";  
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
  <li onclick="btnAyuda()"><a class="dropdown-item c-pointer"> <i class="fa-regular fa-circle-question"></i> Ayuda</a></li>
  </ul>
  </div>
  </div>
  <!-- Fin -->

  <!-- Inicio -->
  <div aria-label="breadcrumb" style="padding-left: 0; margin-bottom: 0;">
  <ol class="breadcrumb breadcrumb-caret">
  <li class="breadcrumb-item text-primary c-pointer" onclick="regresarP()"><i class="fa-solid fa-house"></i> SASISOPA</li>
  <li aria-current="page" class="breadcrumb-item active">9. MEJORES PRÁCTICAS Y ESTÁNDARES</li>
  </ol>
  </div>
  <!-- Fin -->

  <h3>9. MEJORES PRÁCTICAS Y ESTÁNDARES</h3>

    <div class="row mt-3">        

      <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12 mt-2 mb-2">            
            <div class="bg-white p-3">          
            <div class="row">  
            <div class="col-10">
              <h5 class="text-primary">Diseño y construcción</h5>
            </div>
            <div class="col-2">
             <a class="float-end" onclick="btnDisenoConstruccion()" style="cursor: pointer;" data-toggle="tooltip" data-placement="left" title="Crear" >
            <img src="<?php echo RUTA_IMG_ICONOS."agregar.png"; ?>">
            </a>
            <a class="float-end mr-2" onclick="DescargarDC()" style="cursor: pointer;" data-toggle="tooltip" data-placement="left" title="Crear" >           
            <img src="<?php echo RUTA_IMG_ICONOS."pdf.png"; ?>">
            </a>
            </div>            
            </div>
            <div class="mt-1" id="ListaDisenoConstruccion"></div>          
          </div>
      </div>

        <div class="col-xl-6 col-lg-6 col-md-12 col-sm-12 mt-2 mb-2">
            <div class="bg-white p-3">
            <div class="row">
            <div class="col-10">
              <h5 class="text-primary">Operación y Mantenimiento</h5>
            </div>
            <div class="col-2">
            <a class="float-end" onclick="btnOperacionMantenimiento()" style="cursor: pointer;" data-toggle="tooltip" data-placement="left" title="Crear" >
            <img src="<?php echo RUTA_IMG_ICONOS."agregar.png"; ?>">
            </a>
            <a class="float-end mr-2" onclick="DescargarOM()" style="cursor: pointer;" data-toggle="tooltip" data-placement="left" title="Descargar" >           
            <img src="<?php echo RUTA_IMG_ICONOS."pdf.png"; ?>">
            </a>
            </div>         
            </div> 
          <div class="mt-1" id="ListaOperacionMantenimiento"></div>          
          </div>
        </div>

      </div>
    </div>

      <div class="modal fade bd-example-modal-lg" id="ModalMejoresPracticas" data-backdrop="static">
    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
      <div class="modal-content" style="border-radius: 0px;border: 0px;">
        <div class="modal-header rounded-0 head-modal">
          <h4 class="modal-title text-white">Bienvenido al elemento 9 MEJORES PRÁCTICAS Y ESTÁNDARES</h4>
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
          <button type="button" class="btn btn-primary" style="border-radius: 0px;" onclick="btnFinAyuda(<?=$id_ayuda;?>,<?=$estado;?>)">Aceptar</button>
        </div>
      </div>
    </div>
    </div>

    <div class="modal fade bd-example-modal-lg" id="myModal" data-backdrop="static">
<div class="modal-dialog modal-lg modal-dialog-centered" role="document">
<div class="modal-content" style="border-radius: 0px;border: 0px;">
 <div class="modal-header rounded-0 head-modal">
   <h4 class="modal-title text-white">Operación y Mantenimiento</h4>
   <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
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
 <div class="modal-header rounded-0 head-modal">
   <h4 class="modal-title text-white">Diseño y construcción</h4>
   <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
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
