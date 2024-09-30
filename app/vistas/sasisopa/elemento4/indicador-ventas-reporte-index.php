<?php
require('app/help.php');
include_once "app/modelo/Ayuda.php";
include_once "app/modelo/ObjetivosMetasIndicadores.php";

$class_ayuda = new Ayuda();
$class_objetivos_metas_indicadores = new ObjetivosMetasIndicadores();

$array_ayuda = $class_ayuda->sasisopaAyuda($Session_IDUsuarioBD,'indicadores-ventas');
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
  <link rel="stylesheet" href="<?=RUTA_CSS?>bootstrap-select.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.7.0/animate.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.3.0/css/all.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/2.9.2/umd/popper.min.js"></script>
  <script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.13.2/jquery-ui.min.js"></script>
  <script type="text/javascript" src="<?=RUTA_JS?>alertify.js"></script>
  <link href="https://fonts.googleapis.com/css?family=Montserrat" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/3.7.0/animate.min.css">
  <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
  
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
   url:   '../../app/controlador/AyudaControlador.php',
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
  
google.charts.load('current', {'packages':['bar']});
google.charts.setOnLoadCallback(drawChart);
       
    function drawChart() {
      var jsonData = $.ajax({
          url: "../../app/vistas/sasisopa/elemento4/buscar-ventas-reporte.php?Year=<?=$selyear;?>",
          dataType:"json",
          async: false
          }).responseText;
           
     var data = new google.visualization.DataTable(jsonData);

      var options = {
         
          bar: {groupWidth: "15%"},
          bars: 'vertical',
          vAxis: {format: 'decimal'},
          height: 400,
          colors: ['#78bd24', '#e01483', '#5e0f8e']
        };

        var chart = new google.charts.Bar(document.getElementById('columnchart_material'));

        chart.draw(data, google.charts.Bar.convertOptions(options));
    }
  

function btnBuscar(){
$('#ModalBuscar').modal('show');
}

function btnBuscarReporte(){

  var BuscarYear = $('#BuscarYear').val();

  if(BuscarYear != ""){
   window.location.href = "../indicador-ventas/" + BuscarYear;
  }else{
  $('#BuscarYear').css('border','2px solid #A52525');
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
    <div class="float-end">
    <div class="dropdown dropdown-sm d-inline ms-2">
    <button type="button" class="btn dropdown-toggle btn-primary" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
    <i class="fa-solid fa-screwdriver-wrench"></i></span>
    </button>
    <ul class="dropdown-menu">
    <li onclick="btnAyuda()"><a class="dropdown-item c-pointer"> <i class="fa-regular fa-circle-question"></i> Ayuda</a></li>
    <li onclick="btnBuscar()"><a class="dropdown-item c-pointer"> <i class="fa-solid fa-magnifying-glass"></i> Buscar</a></li>
    </ul>
    </div>
    </div>
    <!-- Fin -->

    <!-- Inicio -->
    <div aria-label="breadcrumb" style="padding-left: 0; margin-bottom: 0;">
    <ol class="breadcrumb breadcrumb-caret">
    <li class="breadcrumb-item text-primary c-pointer" onclick="window.history.go(-2);"><i class="fa-solid fa-house"></i> SASISOPA</li>
    <li aria-current="page" class="breadcrumb-item c-pointer" onclick="regresarP()">4. OBJETIVOS, METAS E INDICADORES</li>
    <li aria-current="page" class="breadcrumb-item active">INDICADORES DE VENTAS <?=date("Y");?></li>
    </ol>
    </div>
    <!-- Fin -->

    <h3>INDICADORES DE VENTAS <?=date("Y");?></h3>

    <div class="mt-3 bg-white p-3">
    <div id="columnchart_material" ></div>
    </div>

    <div class="bg-white mt-4 p-3">
    <div class="row">
    <?php
    $fecha_mes = 12;
    $fecha_year = $selyear;
    $TotalP1 = 0;
    $TotalP2 = 0;
    $TotalP3 = 0;

    for ($mes=1; $mes <= $fecha_mes; $mes++) {

    $BuscaVentas = $class_objetivos_metas_indicadores->BuscaVentas($mes,$fecha_year,$Session_ProductoUno,$Session_ProductoDos,$Session_ProductoTres,$Session_IDEstacion);

    echo '<div class="col-xl-4 col-lg-4 col-md-6 col-sm-12 mt-2 mb-2"> 

    <div class="m-1">
    <div class="border">
    <div class="bg-secondary p-2 text-white"><h5 class="text-center">'.nombremes($mes).'</h5></div>

    <table class="table table-bordered table-striped table-sm table-hover text-center pb-0 mb-0">
    <thead>
    <tr>
    <td class="text-white" style="background: #78bd24">'.$Session_ProductoUno.'</td>
    <td class="text-white" style="background: #e01483">'.$Session_ProductoDos.'</td>';

    if($Session_ProductoTres != ""){
    echo '<td class="text-white" style="background: #5e0f8e">'.$Session_ProductoTres.'</td>';
    }

    echo '</tr>
    </thead>

    <tbody> 
    <tr>
    <td>'.number_format($BuscaVentas['Producto1'],2).'</td>
    <td>'.number_format($BuscaVentas['Producto2'],2).'</td>';

    if($Session_ProductoTres != ""){
    echo '<td>'.number_format($BuscaVentas['Producto3'],2).'</td>';
    }

    echo '</tr>
    </tbody>
    </table>

    </div>
    </div>
    </div>';

    $TotalP1 = $TotalP1 + $BuscaVentas['Producto1'];
    $TotalP2 = $TotalP2 + $BuscaVentas['Producto2'];
    $TotalP3 = $TotalP3 + $BuscaVentas['Producto3'];

    }
    ?>
    </div>

    <div class="row">
    
    <div class="col-4"></div>
    <div class="col-4"></div>

    <div class="col-xl-4 col-lg-4 col-md-6 col-sm-12 mt-2 mb-2"> 

    <div class="m-1">
    <div class="border">

      <div class="bg-secondary p-2 text-white"><h5 class="text-center">Total Neto</h5></div>

        <table class="table table-bordered table-striped table-sm table-hover text-center pb-0 mb-0">
        <thead>
        <tr>
        <td class="text-white" style="background: #78bd24"><?=$Session_ProductoUno;?></td>
        <td class="text-white" style="background: #e01483"><?=$Session_ProductoDos;?></td>

        <?php 
        if($Session_ProductoTres != ""){
        echo '<td class="text-white" style="background: #5e0f8e">'.$Session_ProductoTres.'</td>';
        }
        ?>

        </tr>
        </thead>

        <tbody> 
        <tr>
        <td><b><?=number_format($TotalP1,2);?></b></td>
        <td><b><?=number_format($TotalP2,2);?></b></td>

        <?php
        if($Session_ProductoTres != ""){
        echo '<td><b>'.number_format($TotalP3,2).'</b></td>';
        }
        ?>

        </tr>
        </tbody>
        </table>

      </div>
      </div>
      </div>
      </div>
    </div>

    </div>

  
<?php

function BuscaVentas($i,$fecha_year,$Session_ProductoUno,$Session_ProductoDos,$Session_ProductoTres,$Session_IDEstacion,$con){
  $sql_reportecre = "SELECT id FROM re_reporte_cre_mes WHERE id_estacion = '".$Session_IDEstacion."' AND mes = '".$i."' AND year = '".$fecha_year."' ORDER BY mes asc ";
$result_reportecre = mysqli_query($con, $sql_reportecre);
while($row_reportecre = mysqli_fetch_array($result_reportecre, MYSQLI_ASSOC)){
$idReporte = $row_reportecre['id'];

$sql_producto1 = "SELECT sum(volumen_venta) AS totalProducto FROM re_reporte_cre_producto WHERE id_re_mes = '".$idReporte."' AND producto = '".$Session_ProductoUno."' LIMIT 1 ";
$result_producto1 = mysqli_query($con, $sql_producto1);
while($row_producto1 = mysqli_fetch_array($result_producto1, MYSQLI_ASSOC)){
$total1 = $row_producto1['totalProducto'];
}

$sql_producto2 = "SELECT sum(volumen_venta) AS totalProducto FROM re_reporte_cre_producto WHERE id_re_mes = '".$idReporte."' AND producto = '".$Session_ProductoDos."' LIMIT 1 ";
$result_producto2 = mysqli_query($con, $sql_producto2);
while($row_producto2 = mysqli_fetch_array($result_producto2, MYSQLI_ASSOC)){
$total2 = $row_producto2['totalProducto'];
}

$sql_producto3 = "SELECT sum(volumen_venta) AS totalProducto FROM re_reporte_cre_producto WHERE id_re_mes = '".$idReporte."' AND producto = '".$Session_ProductoTres."' LIMIT 1 ";
$result_producto3 = mysqli_query($con, $sql_producto3);
while($row_producto3 = mysqli_fetch_array($result_producto3, MYSQLI_ASSOC)){
$total3 = $row_producto3['totalProducto'];
} 

}

$array = array(
'Producto1' => $total1,
'Producto2' => $total2,
'Producto3' => $total3
);

return $array;

}
?>



<div class="modal fade bd-example-modal-lg" id="ModalAyuda" data-backdrop="static">
    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
      <div class="modal-content" style="border-radius: 0px;border: 0px;">
        <div class="modal-header rounded-0 head-modal">
          <h4 class="modal-title text-white">INDICADORES DE VENTAS</h4>
        </div>
        <div class="modal-body">

          <p class="text-justify" style="font-size: 1.1em">
            En este apartado puedes consultar tus ventas de cada uno de tus productos ya sea por mes o por año. Identifica los meses de mayor y menor venta. Esto nos ayudara a crear estrategias para aumentar los indicadores más bajos.
          </p>
          <p class="text-justify" style="font-size: 1.1em">
            Las gráficas que veras a continuación son el resultado del reporte estadístico diario que ingresas ante este portal.
          </p>
          
          <hr>

          
          <small class="font-weight-bold">Recuerda que los datos aquí reflejados son el resultado de lo que reportas diariamente, con la finalidad de obtener datos estadísticos verídicos es importante no omitir el reporte estadístico diario. </small>



        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-primary" style="border-radius: 0px;" onclick="btnFinAyuda(<?=$id_ayuda;?>,<?=$estado;?>)">Aceptar</button>
        </div>
      </div>
    </div>
    </div>

    <div class="modal fade bd-example-modal-lg" id="ModalBuscar" >
    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
      <div class="modal-content" style="border-radius: 0px;border: 0px;">
        <div class="modal-header rounded-0 head-modal">
          <h4 class="modal-title text-white">BUSCAR REPORTE</h4>
        </div>
        <div class="modal-body">

        <label class="text-secondary">* Año:</label>
        <select class="form-control rounded-0" id="BuscarYear">
          
        <option value="">Seleccione</option>
          <?php
          for($i = 2019; $i <= date("Y"); $i++){
          echo '<option value="'.$i.'">'.$i.'</option>';
          }
          ?>
        </select>

        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-primary" style="border-radius: 0px;" onclick="btnBuscarReporte()">Buscar</button>
        </div>
      </div>
    </div>
    </div>

  <script src="<?php echo RUTA_JS ?>bootstrap.min.js"></script>
  </body>
  </html>
