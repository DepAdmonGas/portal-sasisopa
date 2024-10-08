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
  background: url('imgs/iconos/load-img.gif') 50% 50% no-repeat rgb(249,249,249);
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
    <?php require('app/vistas/componentes/navbar-perfil.php'); ?>
    </div>

    <div class="magir-top-principal p-3">

    <!-- Inicio -->
    <div aria-label="breadcrumb" style="padding-left: 0; margin-bottom: 0;">
    <ol class="breadcrumb breadcrumb-caret">
    <li class="breadcrumb-item text-primary c-pointer" onclick="regresarP()"><i class="fa-solid fa-house"></i> SGM</li>
    <li aria-current="page" class="breadcrumb-item active">3. Responsabilidades de la direccion</li>
    </ol>
    </div>
    <!-- Fin -->
    <h3>Editar Politica</h3>

    <div class="bg-white mt-3 p-3">

     <h6>*Fecha:</h6>
     <input class="form-control rounded-0" style="width: 15%;margin-bottom: 15px;" type="date" id="fecha" value="<?=$fecha;?>">
     <div style="height: 300px;font-size: 1em;" id="editor"><?=$politica;?></div>
     <div class="text-end mt-3">
     <button type="button" class="btn btn-primary rounded-0" onclick="editarPolitica()" >Guardar Politica</button>
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
