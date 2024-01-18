<?php
require('../../../app/help.php');

$idEstacion = $_GET['idEstacion'];
$idYear = $_GET['idYear'];

$rep_year = date("Y");
$rep_mes = date("m");

function TotalVenta($Producto,$idEstacion,$idYear,$con){

$totalVenta = 0;

$sql_lista = "SELECT id FROM re_reporte_cre_mes WHERE id_estacion = '".$idEstacion."' and year = '".$idYear."' ORDER BY mes ASC";
$result_lista = mysqli_query($con, $sql_lista);
$numero_lista = mysqli_num_rows($result_lista);
while($row_lista = mysqli_fetch_array($result_lista, MYSQLI_ASSOC)){
$id = $row_lista['id'];

$sql_reporte = "SELECT * FROM re_reporte_cre_producto WHERE id_re_mes = '".$id."' AND producto = '".$Producto."' ";
$result_reporte = mysqli_query($con, $sql_reporte);
$numero_reporte = mysqli_num_rows($result_reporte);
while($row_reporte = mysqli_fetch_array($result_reporte, MYSQLI_ASSOC)){

$volumen_venta = $row_reporte['volumen_venta'];
$totalVenta = $totalVenta + $volumen_venta;
}

}

return number_format($totalVenta,2);
}
?>
 
    <div class="row">

 <div class="col-xl-1 col-lg-1 col-md-2 col-sm-12 mb-2 "> 

    <div class="p-3 mb-2 bg-secondary text-white text-center font-weight-bold"><?=$idYear;?></div>
    <?php

$sql_listames = "SELECT * FROM re_reporte_cre_mes WHERE id_estacion = '".$idEstacion."' and year = '".$idYear."' ORDER BY mes ASC";
$result_listames = mysqli_query($con, $sql_listames);
$numero_listames = mysqli_num_rows($result_listames);

while($row_listames = mysqli_fetch_array($result_listames, MYSQLI_ASSOC)){


if($rep_year != $idYear){

$background = "bg-primary";
$text_color = "text-white";
$cursor = "cursor: pointer";
$hover = "hovercolor";
$onclick = "listadiascre(".$row_listames['mes'].",".$row_listames['year'].")";

}else{

if ($row_listames['mes'] <= $rep_mes) {
$background = "bg-primary";
$text_color = "text-white";
$cursor = "cursor: pointer";
$hover = "hovercolor";
$onclick = "listadiascre(".$row_listames['mes'].",".$row_listames['year'].")";
}else{
$background = "bg-light";
$text_color = "text-secondary";
$cursor = "";
$hover = "";
$onclick = "";
}

}

echo "<div class='p-2 mb-2 $hover $background $text_color text-center' style='$cursor' onclick='$onclick'>".nombremes($row_listames['mes'])."</div>";
}
?>

    </div>


 <div class="col-xl-11 col-lg-11 col-md-10 col-sm-12 mb-2 "> 
    <div id="DivReporteEstadistico">

    <a class="btn btn-primary rounded-0 mt-3" href="descargar-reporte-cre/<?=$idEstacion;?>/<?=$idYear;?>" role="button">Descargar Facturas del año</a>
    <hr>

    <strong>Total, ventas anuales en litros</strong>
    <?php

$sql_estaciones = "SELECT producto_uno, producto_dos, producto_tres FROM tb_estaciones WHERE id = '".$idEstacion."' ";
$result_estaciones = mysqli_query($con, $sql_estaciones);
$numero_estaciones = mysqli_num_rows($result_estaciones);
while($row_estaciones = mysqli_fetch_array($result_estaciones, MYSQLI_ASSOC)){
$estacion = $row_estaciones['nombre'];
$ProductoUno  = $row_estaciones['producto_uno'];
$ProductoDos  = $row_estaciones['producto_dos'];
$ProductoTres = $row_estaciones['producto_tres'];
}
 

echo "<div class='row p-3'>";

if ($ProductoUno != "") {

echo "<div class='col-xl-4 col-lg-4 col-md-4 col-sm-12 mb-2' style='border: 1px solid #E0E0E0;border-bottom: 2px solid #0FC332;'>";
echo "<div class='p-2'><b>Total venta: ".TotalVenta($ProductoUno,$idEstacion,$idYear,$con)."</b></div>";
echo "</div>";
}

if ($ProductoDos != "") {
echo "<div class='col-xl-4 col-lg-4 col-md-4 col-sm-12 mb-2'  style='border: 1px solid #E0E0E0;border-bottom: 2px solid #C30F0F;'>";
echo "<div class='p-2'><b>Total venta: ".TotalVenta($ProductoDos,$idEstacion,$idYear,$con)."</b></div>";
echo "</div>";
}

if ($ProductoTres != "") {

echo "<div class='col-xl-4 col-lg-4 col-md-4 col-sm-12 mb-2'  style='border: 1px solid #E0E0E0;border-bottom: 2px solid #1F1F1F;'>";
echo "<div class='p-2'><b>Total venta: ".TotalVenta($ProductoTres,$idEstacion,$idYear,$con)."</b></div>";
echo "</div>";
}

echo "</div>";


    ?>
    </div>
    </div>
    </div>