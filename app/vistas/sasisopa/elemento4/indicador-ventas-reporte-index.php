<?php
require('app/help.php');
include_once "app/modelo/ObjetivosMetasIndicadores.php";
$class_objetivos_metas_indicadores = new ObjetivosMetasIndicadores();

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
    <div class="float-left"><h4>REPORTE DE VENTAS <?=$selyear;?></h4></div>
    <div class="float-right" style="margin-top: 6px;margin-left: 10px;">

    <a class="mr-2" onclick="btnBuscar()" style="cursor: pointer;" data-toggle="tooltip" data-placement="left" title="Buscar" >
    <img src="<?php echo RUTA_IMG_ICONOS."lupa.png"; ?>">
    </a>

    </div>
    </div>
    <div class="card-body">

    <div id="columnchart_material" ></div>


    <div class="row mt-3">
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



    <div class="modal fade bd-example-modal-lg" id="ModalBuscar" >
    <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
      <div class="modal-content" style="border-radius: 0px;border: 0px;">
        <div class="modal-header">
          <h4 class="modal-title">BUSCAR REPORTE</h4>
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
