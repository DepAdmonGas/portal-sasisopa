<?php
require('app/help.php');
include_once "app/modelo/Ayuda.php";

$class_ayuda = new Ayuda();
$array_ayuda = $class_ayuda->sasisopaAyuda($Session_IDUsuarioBD,'experiencia-del-cliente');
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
  <link rel="shortcut icon" href="<?php echo RUTA_IMG_ICONOS ?>/icono-web.png">
  <link rel="apple-touch-icon" href="<?php echo RUTA_IMG_ICONOS ?>/icono-web.png">
  <link rel="stylesheet" href="<?php echo RUTA_CSS ?>alertify.css">
  <link rel="stylesheet" href="<?php echo RUTA_CSS ?>themes/default.rtl.css">
  <link href="<?php echo RUTA_CSS ?>bootstrap.css" rel="stylesheet" />
  <link rel="stylesheet" href="<?php echo RUTA_CSS ?>componentes.css">
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
  background: url('../imgs/iconos/load-img.gif') 50% 50% no-repeat rgb(249,249,249);
}

.chart_wrap{
  position: relative;
  padding-bottom: 90%;
  height: 0;
  overflow: hidden;
}

.piechart{
  position: absolute;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
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
  <?php if ($id_ayuda != 0) {echo "btnAyuda();";} ?>
  BuscarReportes();
  });
  function regresarP(){
  window.history.back();
  }

  function btnAyuda(){
  $('#ModalAyuda').modal('show');
  }

  function btnFinAyuda(idayuda, estado){
    var parametros = {
        "accion" : "actualizar-ayuda",
        "idayuda" : idayuda
      };

      if (idayuda != 0 && estado == 0) {
    $.ajax({
    data:  parametros,
    url:   '../app/controlador/AyudaControlador.php',
    type:  'post',
    beforeSend: function() {
    },
    complete: function(){
    },
    success:  function (response) {
    $('#ModalAyuda').modal('hide');
    }
    });

    }else{
    $('#ModalAyuda').modal('hide');
    }
}

    function BuscarReportes(){
    $.ajax({
    url:   '../app/vistas/sasisopa/elemento4/lista-reportes-encuentas.php',
    type:  'post',
    beforeSend: function() {
    },
    complete: function(){
    },
    success:  function (response) {
    $('#DivContenido').html(response);
    }
    });
    }

    function btnNuEncuesta(){
   alertify.confirm('',
    function(){
  window.location.href = 'agregar-experiencia-cliente';
   },
    function(){
    }).setHeader('Mensaje').set({transition:'zoom',message: 'Desea crear un reporte de encuestas',labels:{ok:'Aceptar', cancel: 'Cancelar'}}).show();
  }

  function BtnReporte(reporte){
    window.location.href = 'detalle-experiencia-cliente/' + reporte;
  }

  function BtnEditar(IdReporte){
    window.location.href = 'editar-experiencia-cliente/' + IdReporte;
  }

  function Eliminar(IdReporte){

    alertify.confirm('',
    function(){

    var parametros = {
    "accion" : "eliminar-encuesta-estacion",
    "IdReporte" : IdReporte
    };

    $.ajax({
    data:  parametros,
    url:   '../app/controlador/ObjetivosMetasIndicadoresControlador.php',
    type:  'post',
    beforeSend: function() {
    },
    complete: function(){
    },
    success:  function (response) {

    BuscarReportes();
    drawChart2();
    }
    });

    },
    function(){
    }).setHeader('Mensaje').set({transition:'zoom',message: 'Desea eliminar el reporte ',labels:{ok:'Aceptar', cancel: 'Cancelar'}}).show();

    }

    google.charts.load("current", {packages:["corechart"]});
    google.charts.setOnLoadCallback(drawChart2);

      function drawChart2() {

         var jsonData = $.ajax({
          url: "../app/vistas/sasisopa/elemento4/buscar-reporte-experiencia-cliente.php",
          dataType:"json",
          async: false
          }).responseText;

        var data = new google.visualization.DataTable(jsonData);

        var options = {
        height: '450px',
        width: '100%',
        title: 'Satisfacción del cliente',
        colors: ['#0099F0', '#1EAD4E', '#F3C000', '#E70606'],
        };

        var chart = new google.visualization.PieChart(document.getElementById('donutchart'));

        chart.draw(data, options);
      }

//----------------------------------------------------------
//----------------------------------------------------------

  </script>
  </head>
  <body>

    <div class="LoaderPage"></div>
    <div class="fixed-top navbar-admin">
    <?php require('public/componentes/header.menu.php'); ?>
    </div>

    <div class="magir-top-principal p-3">

    <div class="float-left" style="padding-right: 20px;margin-top: 5px;">
    <a onclick="regresarP()" style="cursor: pointer;" data-toggle="tooltip" data-placement="right" title="Regresar"><img src="<?php echo RUTA_IMG_ICONOS."regresar.png"; ?>"></a>
    </div>
    <!-- TITULO / ENCABEZADO -->
    <div class="float-left">
    <h4>Experiencia del cliente</h4>
    </div>

    <div class="float-right" style="margin-top: 6px;margin-left: 10px;">
    <a onclick="btnAyuda()" style="cursor: pointer;" data-toggle="tooltip" data-placement="left" title="Ayuda" >
    <img src="<?php echo RUTA_IMG_ICONOS."info.png"; ?>">
    </a>
    <a style="text-decoration: none;cursor: pointer;margin-left: 10px;" download href="<?=RUTA_ARCHIVOS;?>encuestas/Formato encuestas.pdf" data-toggle="tooltip" data-placement="left" title="PDF" >
    <img src="<?php echo RUTA_IMG_ICONOS."pdf.png"; ?>">
    </a>
    <a onclick="btnNuEncuesta()" style="cursor: pointer;margin-left: 10px;" data-toggle="tooltip" data-placement="left" title="Agregar nueva encuesta" >
    <img src="<?php echo RUTA_IMG_ICONOS."agregar.png"; ?>">
    </a>
    </div>

    <div class="row mt-5">  
   <!-- TABLA - ENCUESTADOS -->
    <div class="col-xl-8 col-lg-8 col-md-12 col-sm-12 mt-2 mb-2"> 
      <div class="bg-white p-3">    
       <div id="DivContenido"></div>
      </div> 
    </div>
   <!-- GRAFICA - ENCUESTADOS -->
    <div class="col-xl-4 col-lg-4 col-md-12 col-sm-12 mt-2 mb-2">  
      <div class="chart_wrap">
      <div id="donutchart" class="piechart"></div>
      </div>
     </div>
     </div>

    </div>

    <div class="modal fade bd-example-modal-lg" id="ModalAyuda" data-backdrop="static">
    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
      <div class="modal-content" style="border-radius: 0px;border: 0px;">
        <div class="modal-header">
          <h4 class="modal-title">Experiencia del cliente</h4>
        </div>
        <div class="modal-body">

          <p class="text-justify" style="font-size: 1.1em">
            La satisfacción del cliente nos permite identificar que tan bien estamos logrando los objetivos de la empresa, así como también nos permite identificar áreas de oportunidad para mejorar.
          </p>
          <p class="text-justify" style="font-size: 1.1em">
            En la parte superior derecha con el icono <img width="16" src="<?php echo RUTA_IMG_ICONOS."pdf.png"; ?>"> <small>(PDF)</small> encontraras una encuesta de satisfacción del cliente, misma que deberás descargar, imprimir y otorgar a los despachadores para que a su vez se le dé la opción al cliente de llenar la encuesta de satisfacción.</br>
            La encuesta deberá realizarse <b>dos veces al año durante una semana en todos los turnos</b>, una vez terminadas las encuestas deberás dar clic en la parte superior derecha en el icono <img width="16" src="<?php echo RUTA_IMG_ICONOS."agregar.png"; ?>"> <small>(Agregar)</small> para agregar los resultados de las encuestas realizadas.

          </p>
          <hr>

          <div class="text-center mt-2">
          <small class="font-weight-bold text-success">AdmonGas siempre comprometidos con el medio ambiente.
          Utiliza hojas recicladas para imprimir tus encuestas.
          </small>
          <div class="text-center mt-2">
          <img src="<?php echo RUTA_IMG_ICONOS."reciclar-signo.png"; ?>">
          </div>

        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-primary" style="border-radius: 0px;" onclick="btnFinAyuda(<?=$id_ayuda;?>,<?=$estado;?>)">Aceptar</button>
        </div>
      </div>
    </div>
    </div>

    <script src="<?php echo RUTA_JS ?>bootstrap.min.js"></script>
    </body>
    </html>
