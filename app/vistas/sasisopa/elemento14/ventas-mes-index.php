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
  background: url('../imgs/iconos/load-img.gif') 50% 50% no-repeat rgb(249,249,249);
}
 .car-admin{
    border: 1px solid #eeeeee;box-shadow: 1px 1px 5px #EDEDED;border-bottom: 3px solid #3399cc;border-radius: 0;
    font-size: 1.1em;
  }
  .titulo-punto{
    font-size: 1.2em;
  }

    .modal-xg {
    max-width: 80% !important;
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

  function ListaMensual(Year){
  $('#ContenidoLista').load('../app/vistas/sasisopa/elemento14/lista-mensual-ventas.php?Year=' + Year);   

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
    <div class="float-left"><h4>Ventas del mes</h4></div>
    <div class="float-right" style="margin-top: 6px;margin-left: 10px;">
    </div>
      </div>
    <div class="card-body">

        <div class="row">
        <?php
        $sql_years = "SELECT year FROM re_reporte_cre_mes WHERE id_estacion = '".$Session_IDEstacion."' GROUP BY year ORDER BY year desc";
    $result_years = mysqli_query($con, $sql_years);
    $numero_years = mysqli_num_rows($result_years);

    while($row_years = mysqli_fetch_array($result_years, MYSQLI_ASSOC)){
    $year = $row_years['year'];
    echo "

    <div class='col-xl-3 col-lg-3 col-md-3 col-6 mt-1 mb-2'>
    <div class='border p-2 text-center c-pointer bg-info' onclick='ListaMensual(".$year.")'>
    <div><small class='text-white'>Vental del año</small></div>
    <div class='text-white'><h5>".$year."</h5></div>
    </div>
    </div>";
    }
        ?>

    </div>

    <hr>
  
    <div id="ContenidoLista"></div>
  
    </div>
    </div>
    </div>
    </div>
    </div>

  
  <script src="<?php echo RUTA_JS ?>bootstrap.min.js"></script>
  </body>
  </html>
