<?php
require('app/help.php');

$sql = "SELECT * FROM sgm_politica WHERE id_estacion = '".$Session_IDEstacion."' ORDER BY id DESC LIMIT 1 ";
$result = mysqli_query($con, $sql);
$numero = mysqli_num_rows($result);
if($numero > 0){
$row = mysqli_fetch_array($result, MYSQLI_ASSOC);
$politica = $row['contenido'];
$fecha = $row['fecha'];
}else{
  $politica = "";
  $fecha = "";  
}

?> 
<html lang="es">
  <head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
  <title>SGM</title>
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
  <script type="text/javascript" src="<?php echo RUTA_JS ?>signature_pad.js"></script>
   <script type="text/javascript" src="<?php echo RUTA_JS ?>jquery.min.js"></script>
  <link href="https://fonts.googleapis.com/css?family=Montserrat" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.7.0/animate.min.css">
  <link href="https://cdn.jsdelivr.net/npm/quill@2.0.2/dist/quill.snow.css" rel="stylesheet" />
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


  });

  function regresarP(){
  window.history.back();
  }

  function editarPolitica(){
    let fecha =  $('#fecha').val();
    let contenido = quill.container.firstChild.innerHTML;

    let parametros = {
      "fecha" : fecha,
     "contenido" : contenido
    };

    if (fecha != "") {
      $('#fecha').css('border','');
      if (contenido != "<p><br></p>") {
        $('#editor').css('border','');

      alertify.confirm('',
      function(){


          $.ajax({
         data:  parametros,
         url:   'app/vistas/sgm/punto3/agregar-politica-sgm.php',
         type:  'post',
         beforeSend: function() {
         },
         complete: function(){
        
         },
         success:  function (response) {

        regresarP()

         }
         });
        
      },
      function(){
      }).setHeader('Lista de asistencia').set({transition:'zoom',message: '¿Desea actualizar la politica del SGM?',labels:{ok:'Aceptar', cancel: 'Cancelar'}}).show();

      }else{
    $('#editor').css('border','2px solid #A52525');   
    }
    }else{
    $('#fecha').css('border','2px solid #A52525');   
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
    <div class="float-left"><h4>Editar Politica</h4></div>
    </div>
   
    <div class="card-body">

      <h6>*Fecha:</h6>
      <input class="form-control rounded-0" style="width: 15%;margin-bottom: 15px;" type="date" id="fecha" value="<?=$fecha;?>">

     <div style="height: 300px;font-size: 1em;" id="editor"><?=$politica;?></div>

     <div class="text-right mt-3">
      <button type="button" class="btn btn-primary rounded-0" onclick="editarPolitica()" >Guardar Politica</button>
      </div>

    </div>

    </div>
    </div>
    </div>
    </div>
  </body>

  <script src="<?php echo RUTA_JS ?>bootstrap.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/quill@2.0.2/dist/quill.js"></script>
  <script>
  const quill = new Quill('#editor', {
    modules: { toolbar: true },
    theme: 'snow'
  });
 </script>
  </html>
