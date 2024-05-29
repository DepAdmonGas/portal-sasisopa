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
  </style>
  <script type="text/javascript">
  $(document).ready(function(){
  $('[data-toggle="tooltip"]').tooltip();
  $(".LoaderPage").fadeOut("slow");

  ListaInforme();

  });

  function regresarP(){
   window.history.back();
  }

  function ListaInforme(){
  $('#ListaInforme').load('app/vistas/sasisopa/elemento14/lista-informe-revision-resultados.php');   
  }

  function btnModalIRR(){
  $('#ModalAgregar').modal('show');
  $('#ContenidoModal').load('app/vistas/sasisopa/elemento14/modal-informe-revision-resultados.php');
  }

  function btnGuardarIRR(){

  let Fecha = $('#Fecha').val();

  let Documento = document.getElementById("Documento");
  let File = Documento.files[0];
  let FilePath = Documento.value;

  var data = new FormData();
  var url = 'app/controlador/MonitoreoVerificacionEvaluacionControlador.php';
  var ext = $("#Documento").val().split('.').pop();

if (Fecha != "") {
$('#Fecha').css('border',''); 
if (FilePath != "") {
$('#Documento').css('border','');
if (ext == "PDF" || ext == "pdf") {
  
  data.append('accion', 'agregar-informe-revision-resultados');
  data.append('Fecha', Fecha);
  data.append('File', File);

  $.ajax({
  url: url,
  type: 'POST',
  contentType: false,
  data: data,
  processData: false,
  cache: false
  }).done(function(data){

  $('#ModalAgregar').modal('hide');
  ListaInforme();


  });

}else{
$('#Documento').css('border','2px solid #A52525');  
$('#result').html('<small class="text-danger">Solo se aceptan formato PDF</small>'); 
}
}else{
$('#Documento').css('border','2px solid #A52525'); 
}
}else{
$('#Fecha').css('border','2px solid #A52525');  
}

  }

  function Eliminar(id){

   alertify.confirm('',
 function(){

  var parametros = {
      "accion" : "eliminar-informe-revision-resultados",
      "id" : id
      };

  $.ajax({
   data:  parametros,
   url:   'app/controlador/MonitoreoVerificacionEvaluacionControlador.php',
   type:  'post',
   beforeSend: function() {
   },
   complete: function(){
   },
   success:  function (response) {
    ListaInforme();
   }
   });

    },
    function(){

    }).setHeader('Mensaje').set({transition:'zoom',message: 'Desea eliminar el Informe de revisión de resultados',labels:{ok:'Aceptar', cancel: 'Cancelar'}}).show(); 

  }

  function Descargar(){
  window.location = "descargar-evaluacion-cumplimiento-legal";   
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
    <div class="float-left"><h4>Evaluación y cumplimiento de requisitos legales</h4></div>
    </div>
    <div class="card-body">

    <div class="row">
    <div class="col-4">

      <div class="border p-3">
      <h5>Matriz de evaluación del cumplimiento legal</h5>
      <br>
      <div class="text-right">
      <button class="btn btn-primary" type="button" onclick="Descargar()">Descargar</button>
      </div>
      </div>

    </div>
    <div class="col-8">
      <div class="border p-3">

      <div class="row">
        <div class="col-10">
          <h5>Informe de revisión de resultados</h5>
        </div>
        <div class="col-2">
          
          <div class="text-right">
          <a href="<?=RUTA_ARCHIVOS_ADMONGAS."Fo.ADMONGAS.022.docx";?>" download style="cursor: pointer;">
          <img src="<?php echo RUTA_IMG_ICONOS."word.png"; ?>">
          </a>
          <a onclick="btnModalIRR()" style="cursor: pointer;">
          <img src="<?php echo RUTA_IMG_ICONOS."agregar.png"; ?>">
          </a>
          </div>

        </div>
      </div>

      <div id="ListaInforme"></div>      
      

      </div>
    </div>
    </div>


    </div>
    </div>
    </div>
    </div>
    </div>

    <div class="modal fade bd-example-modal-lg" id="ModalAgregar" data-backdrop="static">
    <div class="modal-dialog modal-dialog-centered" role="document">
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