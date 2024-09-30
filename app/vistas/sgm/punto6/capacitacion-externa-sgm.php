<?php
require('app/help.php');
?> 
<html lang="es">
  <head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
  <title>SGM</title>
  <meta name="description" content="">
  <meta name="viewport" content="width=device-width initial-scale=1.0">
  <link rel="shortcut icon" href="<?=RUTA_IMG_ICONOS?>/icono-web.png">
  <link rel="apple-touch-icon" href="<?=RUTA_IMG_ICONOS?>/icono-web.png">
  <link rel="stylesheet" href="<?=RUTA_CSS?>alertify.css">
  <link rel="stylesheet" href="<?=RUTA_CSS?>themes/default.rtl.css">
  <link href="<?=RUTA_CSS ?>bootstrap.css" rel="stylesheet" />
  <link rel="stylesheet" href="<?=RUTA_CSS?>componentes.css">
  <link rel="stylesheet" href="<?=RUTA_CSS?>bootstrap-select.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.0/umd/popper.min.js"></script>
  <script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.13.2/jquery-ui.min.js"></script>
  <script type="text/javascript" src="<?=RUTA_JS?>alertify.js"></script>
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
  $(document).ready(function(){
  $('[data-toggle="tooltip"]').tooltip();
  $(".LoaderPage").fadeOut("slow");

  ListaCapacitacion()

  });

  function regresarP(){
  window.history.back();
  }

  function ListaCapacitacion(){
  $('#ListaCapacitacion').load('app/vistas/sgm/punto6/lista-programa-anual-capacitacion-externa.php');
  }

  function btnAyuda(){
  $('#myModal').modal('show');
  }

function modalAgregar(id){
  $('#modalPrincipal').modal('show');  
  $('#ContenidoModal').load('app/vistas/sgm/punto6/modal-agregar-programa-capacitacion-externa.php?id=' + id);
  }

function GuardarPrograma(id){

  let Nombrecurso = $('#Nombrecurso').val();
  let Fechaprogramada = $('#Fechaprogramada').val();
  let Duracion = $('#Duracion').val();
  let Instructor = $('#Instructor').val();
  let Fecharealprogramada = $('#Fecharealprogramada').val()

  if (Nombrecurso != "") {
  $('#Nombrecurso').css('border','');
  if (Fechaprogramada != "") {
  $('#Fechaprogramada').css('border','');
  if (Duracion != "") {
  $('#Duracion').css('border','');
  if (Instructor != "") {
  $('#Instructor').css('border','');

  var parametros = {
      "id" : id,
      "cate" : 2,
      "Capacitacion" : 'Externa',
      "Nombrecurso" : Nombrecurso,
      "Fechaprogramada" : Fechaprogramada,
      "Duracion" : Duracion,
      "Instructor" : Instructor,
      "Fecharealprogramada" : Fecharealprogramada
      };

     $.ajax({
     data:  parametros,
     url:   'app/vistas/sgm/punto6/agregar-programa-anual-capacitacion.php',
     type:  'post',
     beforeSend: function() {
     },
     complete: function(){
     },
     success:  function (response) {

       ListaCapacitacion()
       $('#modalPrincipal').modal('hide');  

     }
     });

  }else{
  $('#Instructor').css('border','2px solid #A52525'); 
  }
  }else{
  $('#Duracion').css('border','2px solid #A52525'); 
  }
  }else{
  $('#Fechaprogramada').css('border','2px solid #A52525'); 
  }
  }else{
  $('#Nombrecurso').css('border','2px solid #A52525'); 
  }


}

function AgregarPersonal(e,id,cate){

     var parametros = {
    "id" : id,
    "valor" : e.value,
    "cate" : cate
    };

   $.ajax({
     data:  parametros,
     url:   'app/vistas/sgm/punto6/editar-programa-anual-capacitacion.php',
     type:  'post',
     beforeSend: function() {
     },
     complete: function(){
    
     },
     success:  function (response) {
      modalAgregar(id)
      ListaCapacitacion()
     }
     });

  }

  function EliminarPersonal(e,id,id_personal,cate){

      var parametros = {
    "id" : id_personal,
    "valor" : e.value,
    "cate" : cate
    };

   $.ajax({
     data:  parametros,
     url:   'app/vistas/sgm/punto6/editar-programa-anual-capacitacion.php',
     type:  'post',
     beforeSend: function() {
     },
     complete: function(){
    
     },
     success:  function (response) {
      modalAgregar(id)
      ListaCapacitacion()
     }
     });

  }

  function GuardarEvidencia(id){

  var EvidenciasM = document.getElementById("FileEvidencia");
  var FileEvidencia = EvidenciasM.files[0];
  var PathEvidencia = EvidenciasM.value;
  var ext = $("#FileEvidencia").val().split('.').pop();

  var data = new FormData();
  var url = 'app/vistas/sgm/punto6/editar-programa-anual-capacitacion.php';

  if (PathEvidencia != "") {
  $('#FileEvidencia').css('border','');

  data.append('id', id);
  data.append('valor', FileEvidencia);
  data.append('cate', 3);

  $.ajax({
  url: url,
  type: 'POST',
  contentType: false,
  data: data,
  processData: false,
  cache: false,
  }).done(function(data){
  
  alertify.message('Evidencia agregada');
  modalAgregar(id)
  ListaCapacitacion()

  });

  }else{
  $('#FileEvidencia').css('border','2px solid #A52525');
  }

  }

function EliminarEvidencia(e,id,id_personal,cate){

    var parametros = {
    "id" : id_personal,
    "valor" : e.value,
    "cate" : cate
    };

   $.ajax({
     data:  parametros,
     url:   'app/vistas/sgm/punto6/editar-programa-anual-capacitacion.php',
     type:  'post',
     beforeSend: function() {
     },
     complete: function(){
    
     },
     success:  function (response) {
      modalAgregar(id)
      ListaCapacitacion()
     }
     });

  }

  function Eliminar(id,cate){

   var parametros = {
    "id" : id,
    "valor" : 0,
    "cate" : cate
    };

     alertify.confirm('',
  function(){

$.ajax({
     data:  parametros,
     url:   'app/vistas/sgm/punto6/editar-programa-anual-capacitacion.php',
     type:  'post',
     beforeSend: function() {
     },
     complete: function(){
    
     },
     success:  function (response) {
      ListaCapacitacion()
     }
     });

},
  function(){
  }).setHeader('Lista de asistencia').set({transition:'zoom',message: '¿Desea eliminar la información selecionada?',labels:{ok:'Aceptar', cancel: 'Cancelar'}}).show();

  }

  function btnDescargar(){
    window.location = "descargar-programa-anual-capacitacion-externa-sgm";
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
    <div class="float-left"><h4>Programa Capacitacion Externa</h4></div>
    <div class="float-right" style="margin-top: 6px;margin-left: 10px;">

    <a class="mr-2" onclick="btnDescargar()" style="cursor: pointer;" data-toggle="tooltip" data-placement="left" title="Descargar" >
    <img src="<?php echo RUTA_IMG_ICONOS."pdf.png"; ?>">
    </a> 

    <a class="mr-2" onclick="modalAgregar(0)" style="cursor: pointer;" data-toggle="tooltip" data-placement="left" title="Agregar" >
    <img src="<?php echo RUTA_IMG_ICONOS."agregar.png"; ?>">
    </a> 

    <a onclick="btnAyuda()" style="cursor: pointer;" data-toggle="tooltip" data-placement="left" title="Ayuda" >
    <img src="<?php echo RUTA_IMG_ICONOS."info.png"; ?>">
    </a> 
    </div>
    </div>
   
    <div class="card-body">

      <div id="ListaCapacitacion"></div>

    </div>

    </div>
    </div>
    </div>
    </div>

    <div class="modal fade bd-example-modal-lg" id="myModal" data-backdrop="static">
    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
      <div class="modal-content border-0 rounded-0">
      <div class="modal-header">
      <h4 class="modal-title">Ayuda</h4>
      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
      <span aria-hidden="true">&times;</span>
      </button>
      </div>
        <div class="modal-body">
        
        <p>Bienvenido al elemento <b>6. GESTION DE LOS RECURSOS</b></p>

        <p><b>Capacitación del personal</b></p>
        <p>De manera anual verifica el programa de capacitación interna y externa de acuerdo al procedimiento con el formato 009, verifica los puestos estén capacitados conforme a lo establecido en el procedimiento.</p>

        <p>Recuerda que cada que haya personal nuevo en las instalaciones deberá tomar la capacitación de inducción, por lo que cada que agregues a un nuevo colaborador en el formato 008 en automático le saldrán los cursos que debe tomar como inducción en el formato 010. </p>

        </div>
      </div>
    </div>
  </div>



    <div class="modal fade bd-example-modal-lg" id="modalPrincipal" >
    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
      <div class="modal-content" style="border-radius: 0px;border: 0px;">
        <div id="ContenidoModal"></div>
      </div>
    </div>
    </div>
 
  <script src="<?php echo RUTA_JS ?>bootstrap.min.js"></script>
  </body>
  </html>

