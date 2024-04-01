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
  <link rel="shortcut icon" href="<?=RUTA_IMG_ICONOS ?>/icono-web.png">
  <link rel="apple-touch-icon" href="<?=RUTA_IMG_ICONOS ?>/icono-web.png">
  <link rel="stylesheet" href="<?=RUTA_CSS2?>alertify.css">
  <link rel="stylesheet" href="<?=RUTA_CSS2?>themes/default.rtl.css">
  <link href="<?=RUTA_CSS2;?>bootstrap.min.css" rel="stylesheet" />
  <link href="<?=RUTA_CSS2;?>navbar-utilities.min.css" rel="stylesheet" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css">
  <script src="<?=RUTA_JS2?>size-window.js"></script>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.0/umd/popper.min.js"></script>
  <script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
  <script type="text/javascript" src="<?=RUTA_JS2?>alertify.js"></script>

  <link href="https://fonts.googleapis.com/css?family=Montserrat" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.7.0/animate.min.css">

  <style media="screen">
  
  .car-admin{
  border: 1px solid #eeeeee;box-shadow: 1px 1px 5px #EDEDED;border-bottom: 3px solid #3399cc;border-radius: 0;
  }
 
  </style>
 
  <script type="text/javascript">
  $(document).ready(function(){
  sizeWindow(); 
  $('[data-toggle="tooltip"]').tooltip();
  $(".LoaderPage").fadeOut("slow");

  });

  function Estacion(idEstacion,page){
  sizeWindow(); 
  $(".LoaderPage").show();
  $('#ContenidoPrincipal').load('public/administrador/vistas/lista-apertura-dispensario.php?idEstacion=' + idEstacion + '&page=' + page);
  }
 
  function Modal(idEstacion){
    $('#Modal').modal('show');
    $('#DivModal').load('public/administrador/vistas/modal-apertura-dispensario.php?idEstacion=' + idEstacion);
  }
  
  function Enviar(idEstacion){

  var Dispensario = $('#Dispensario').val();

  var Archivo = document.getElementById("file");
  var File = Archivo.files[0];
  var FilePath = Archivo.value;

  var data = new FormData();
  var url = 'public/administrador/agregar/agregar-apertura-dispensario.php';

  data.append('idEstacion', idEstacion);
  data.append('Dispensario', Dispensario);
  data.append('File', File);

  if (Dispensario != "") {
  $('#Dispensario').css('border',''); 

    $(".LoaderPage").show();

    $.ajax({
    url: url,
    type: 'POST',
    contentType: false,
    data: data,
    processData: false,
    cache: false
    }).done(function(data){

    $('#Modal').modal('hide');
    Estacion(idEstacion,1);

    });

  }else{
  $('#Dispensario').css('border','2px solid #A52525');  
  }

  }
  </script>
  </head>
  
  <body>

  <div class="LoaderPage"></div>
 
 <div class="wrapper">
 
<!---------- SIDE BAR (LEFT) ---------->  
  <nav id="sidebar">
  
  <div class="sidebar-header text-center">
  <img class="" src="<?=RUTA_IMG_LOGOS."Logo.png";?>" style="width: 100%;">
  </div>

  <ul class="list-unstyled components">
   
    <li>
    <a class="pointer" href="<?=PORTAL_HOME?>">
    <i class="fa-solid fa-house" aria-hidden="true" style="padding-right: 10px;"></i>Portal
    </a>
    </li>

    <li>
    <a class="pointer" onclick="history.back()">
    <i class="fas fa-arrow-left" aria-hidden="true" style="padding-right: 10px;"></i>Regresar
    </a>
    </li>


    <?php
    $sql_listaestacion = "SELECT id, nombre, numlista FROM tb_estaciones WHERE numlista <= 8 ORDER BY numlista ASC";
    $result_listaestacion = mysqli_query($con, $sql_listaestacion);
    while($row_listaestacion = mysqli_fetch_array($result_listaestacion, MYSQLI_ASSOC)){
    $id = $row_listaestacion['id'];
    $estacion = $row_listaestacion['nombre'];

    echo '<li>
    <a class="pointer" onclick="Estacion('.$id.',1)">
    <i class="fa-solid fa-gas-pump" aria-hidden="true" style="padding-right: 10px;"></i>
    '.$estacion.'
    </a>
    </li>';
    }

    ?> 
  </ul>
   
  </nav>


  <!---------- DIV - CONTENIDO ----------> 
  <div id="content">
  <!---------- NAV BAR - PRINCIPAL (TOP) ---------->  
  <?php include_once "public/navbar/navbar-principal.php";?>

  <!---------- CONTENIDO PAGINA WEB----------> 
  <div class="contendAG">
  <div class="row">  
  
  <div class="col-12">
  <div id="ContenidoPrincipal" class="cardAG"></div>
  </div> 


  </div>
  </div>
  </div>
 
  </div>

  <!---------- MODAL - APERTURA DE DISPENSARIOS ----------> 

<div class="modal fade" id="Modal" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog" style="margin-top: 83px;">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Apertura dispensario</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>

      <div id="DivModal"></div>

    </div>
  </div>
</div>



  <!---------- FUNCIONES - NAVBAR ---------->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/malihu-custom-scrollbar-plugin/3.1.5/jquery.mCustomScrollbar.concat.min.js"></script>
  <script src="<?=RUTA_JS2?>navbar-functions.js"></script>

  
  <script src="<?=RUTA_JS2?>bootstrap.min.js"></script>
  </body>
  </html>
 