<?php
require('app/help.php');

$IdReporte = $idReporte;
$sql_encuesta = "SELECT * FROM tb_encuentas_estacion WHERE id = '".$idReporte."' ";
$result_encuesta = mysqli_query($con, $sql_encuesta);
$numero_encuesta = mysqli_num_rows($result_encuesta);
$row_encuesta = mysqli_fetch_array($result_encuesta, MYSQLI_ASSOC);

  $date = $row_encuesta['fechacreacion'];
  $explode = explode(" ", $date);
  $fecha = $explode[0];
  $hora = $explode[1];


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
  <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
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
  background: url('../../imgs/iconos/load-img.gif') 50% 50% no-repeat rgb(249,249,249);
}

.card-hover:hover{
  background: rgba(247, 247, 247, .9);
  transition: all 1s ease;
  cursor: pointer;
}
  </style>
  <script type="text/javascript">
  $(document).ready(function(){
  $('[data-toggle="tooltip"]').tooltip();
  $(".LoaderPage").fadeOut("slow");
  BuscarEncuestados();
  });
  function regresarP(){
  window.history.back(); 
  }
  
  function BuscarEncuestados(){

   var parametros = {
      "IdReporte" : <?=$IdReporte;?>
      };
  
   $.ajax({
     data:  parametros,
     url:   '../../app/vistas/sasisopa/elemento4/lista-cliente-encuentas.php',
     type:  'post',
     beforeSend: function() {
     },
     complete: function(){
     },
     success:  function (response) {
     $('#DivResultado').html(response);
     }
     });

  
}

function Detalle(id){
  $('#ModalDetalle').modal('show');
  DetalleEncuestado(id);
  }

  function DetalleEncuestado(id){
   var parametros = {
      "IdCliente" : id
      };  
   $.ajax({
    data:  parametros,
     url:   '../../app/vistas/sasisopa/elemento4/detalle-cliente-encuentas.php',
     type:  'post',
     beforeSend: function() {
     },
     complete: function(){
     },
     success:  function (response) {
     $('#DivContenidoModal').html(response);
     }
     });
 
  }
 
google.charts.load("current", {packages:["corechart"]});
google.charts.setOnLoadCallback(drawChart2);

      function drawChart2() {

         var jsonData = $.ajax({
          url: "../../app/vistas/sasisopa/elemento4/buscar-reporte-experiencia-principal.php?id=<?=$idReporte;?>",
          dataType:"json",
          async: false
          }).responseText;

        var data = new google.visualization.DataTable(jsonData);

        var options = {
         
            colors: ['#0099F0', '#1EAD4E', '#F3C000', '#E70606']
        };


        var chart = new google.visualization.PieChart(document.getElementById('donutchart'));
        chart.draw(data,options);
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
    <div class="float-left"><h4>Reporte <?=FormatoFecha($fecha);?></h4></div>
    </div>
    <div class="card-body">

      <div class="row">
        <div class="col-9">

        <div class="card">
        <div class="card-body text-center">
          <div class="p-3 font-weight-bold" style="font-size: 1.2em;">Satisfacción del cliente</div>
        <div id="donutchart" style="height: 550px;"></div>
        </div>
        </div>        
        </div>
        <div class="col-3">

        <div style="overflow-y: scroll;height: 650px;">
        <div id="DivResultado"></div> 
        </div>

        </div>
      </div>

      <hr>

    
    <div class="row">
          <?php

              $sql_encuesta = "SELECT id FROM tb_encuestas WHERE estado = 1 LIMIT 1";
              $result_encuesta = mysqli_query($con, $sql_encuesta);
              while($row_encuesta = mysqli_fetch_array($result_encuesta, MYSQLI_ASSOC)){
              $Id = $row_encuesta['id'];

              $sql_cuestionario = "SELECT id,num_pregunta,pregunta FROM tb_encuentas_cuestionario ORDER BY num_pregunta";
              $result_cuestionario = mysqli_query($con, $sql_cuestionario);
              $numero_cuestionario = mysqli_num_rows($result_cuestionario);
              while($row_cuestionario = mysqli_fetch_array($result_cuestionario, MYSQLI_ASSOC)){
              $IdCuestionario = $row_cuestionario['id'];
              $numPregunta = $row_cuestionario['num_pregunta'];
              $pregunta = $row_cuestionario['pregunta'];
              ?>

              <div class="col-4">
              <div class="card">

                <div class="p-3 font-weight-bold"><?=$numPregunta.".- ".$pregunta;?></div>

              <script type="text/javascript">

            google.charts.load("current", {packages:["corechart"]});
            google.charts.setOnLoadCallback(drawChartP);

            function drawChartP() {

          var jsonData = $.ajax({
          url: "../../app/vistas/sasisopa/elemento4/buscar-reporte-experiencia-preguntas.php?id=<?=$idReporte;?>&pre=<?=$IdCuestionario;?>",
          dataType:"json",
          async: false
          }).responseText;

          var data = new google.visualization.DataTable(jsonData);

           var options = {
         
            colors: ['#0099F0', '#1EAD4E', '#F3C000', '#E70606']
        };

            var chart = new google.visualization.PieChart(document.getElementById('charReporteP<?=$IdCuestionario;?>'));
            chart.draw(data, options);
            }
              </script>

              <div id="charReporteP<?=$IdCuestionario;?>" style="height: 300px;width: 90%;"></div>

              </div>
              </div>
              <?php  
              }
              }

              ?>  
              </div>   


       
    </div>

    </div>
    </div>
    </div>
    </div>
    </div>

    <script src="<?php echo RUTA_JS ?>bootstrap.min.js"></script>
  </body>
  </html>
