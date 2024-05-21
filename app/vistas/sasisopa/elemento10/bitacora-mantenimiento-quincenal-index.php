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
  background: url('imgs/iconos/load-img.gif') 50% 50% no-repeat rgb(249,249,249);
  }
  .hover-div:hover{
  background-color: rgba(248,248,248,0.6);
  -moz-box-shadow: 0 10px 8px -5px #F2F2F2;
  box-shadow: 0 10px 8px -5px #F2F2F2;
  }
  </style>
  <script type="text/javascript">
  $(document).ready(function(){
  $('[data-toggle="tooltip"]').tooltip();
  $(".LoaderPage").fadeOut("slow");

  ListaMantenimiento();

  });

  function regresarP(){
  window.history.back();
  }

  function ModalAgregar(){
  $('#ModalDetalle').modal('show'); 
  $('#DivDetelle').load('app/vistas/sasisopa/elemento10/modal-crear-mantenimiento-quincenal.php');
  }

  function ListaMantenimiento(){
    $('#ContenidoMantenimiento').load('app/vistas/sasisopa/elemento10/lista-mantenimeinto-quincenal.php')
  }

  function CrearM(){
  var Fecha = $('#Fecha').val();

  var Formato1 = document.getElementById("Formato1");
  var Formato1_file = Formato1.files[0];
  var Formato1_filePath = Formato1.value;
  var Formato1_ext = $("#Formato1").val().split('.').pop();

  var Formato2 = document.getElementById("Formato2");
  var Formato2_file = Formato2.files[0];
  var Formato2_filePath = Formato2.value;
  var Formato2_ext = $("#Formato2").val().split('.').pop();

  var Formato3 = document.getElementById("Formato3");
  var Formato3_file = Formato3.files[0];
  var Formato3_filePath = Formato3.value;
  var Formato3_ext = $("#Formato3").val().split('.').pop();

  var Formato4 = document.getElementById("Formato4");
  var Formato4_file = Formato4.files[0];
  var Formato4_filePath = Formato4.value;
  var Formato4_ext = $("#Formato4").val().split('.').pop();

  var Formato5 = document.getElementById("Formato5");
  var Formato5_file = Formato5.files[0];
  var Formato5_filePath = Formato5.value;
  var Formato5_ext = $("#Formato5").val().split('.').pop();

  var Formato6 = document.getElementById("Formato6");
  var Formato6_file = Formato6.files[0];
  var Formato6_filePath = Formato6.value;
  var Formato6_ext = $("#Formato6").val().split('.').pop();

  var Formato7 = document.getElementById("Formato7");
  var Formato7_file = Formato7.files[0];
  var Formato7_filePath = Formato7.value;
  var Formato7_ext = $("#Formato7").val().split('.').pop();

  var data = new FormData();
  var url = 'app/controlador/ControlActividadProcesoControlador.php';

if (Fecha != "") {
$('#Fecha').css('border','');

data.append('accion', 'agregar-mantenimiento-quincenal');
data.append('Fecha', Fecha);
data.append('Formato1_file', Formato1_file);
data.append('Formato2_file', Formato2_file);
data.append('Formato3_file', Formato3_file);
data.append('Formato4_file', Formato4_file);
data.append('Formato5_file', Formato5_file);
data.append('Formato6_file', Formato6_file);
data.append('Formato7_file', Formato7_file);

  $.ajax({
  url: url,
  type: 'POST',
  contentType: false,
  data: data,
  processData: false,
  cache: false
  }).done(function(data){

ListaMantenimiento();
$('#ModalDetalle').modal('hide');

});

}else{
$('#Fecha').css('border','2px solid #A52525');  
}

}
function Eliminar(id){
  alertify.confirm('',
  function(){

      var parametros = {
      "accion" : "eliminar-bitacora-quincenal",
      "id" : id
      };

  $.ajax({
   data:  parametros,
   url:   'app/controlador/ControlActividadProcesoControlador.php',
   type:  'post',
   beforeSend: function() {

   },
   complete: function(){
   },
   success:  function (response) {
   ListaMantenimiento();
   }
   });
  },
  function(){
  }).setHeader('Mensaje').set({transition:'zoom',message: 'Desea eliminar la información seleccionada',labels:{ok:'Aceptar', cancel: 'Cancelar'}}).show();

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
    <div class="float-left"><h4>Mantenimiento Quincenal</h4></div>

<div class="float-right">
<a class="ml-2" onclick="ModalAgregar()" style="cursor: pointer;" data-toggle="tooltip" data-placement="left" title="Agregar mantenimiento" >
<img src="<?php echo RUTA_IMG_ICONOS."agregar.png"; ?>">
</a>
</div>

    </div>
    <div class="card-body">
<div class="p-2" style="background: #1a46bc;">
<div class="text-center text-white"><b><?=$Session_Permisocre;?></b></div>
<div class="text-center text-white"><b><?=$Session_Razonsocial;?></b></div>
<div class="text-center text-white"><b><?=$Session_Direccion;?></b></div>
<div class="text-center text-white"><b>NOM-005-ASEA-2016</b></div>
</div>
  

    <div id="ContenidoMantenimiento"></div>
    </div>
    </div>
    </div>
    </div>
    </div>


  <div class="modal fade bd-example-modal-lg" id="ModalDetalle" >
  <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
  <div class="modal-content" style="border-radius: 0px;border: 0px;">
  <div id="DivDetelle"></div>

  </div>
  </div>
  </div>

  <script src="<?php echo RUTA_JS ?>bootstrap.min.js"></script>
  </body>
  </html>