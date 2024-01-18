<?php
require('../../../app/help.php');

$Year = $_GET['Year'];

function Ventas($Session_IDEstacion,$mes,$year,$con){

$sql_reporte = "SELECT id FROM re_reporte_cre_mes WHERE id_estacion = '".$Session_IDEstacion."' AND mes = '".$mes."' AND year = '".$year."' ";
$result_reporte = mysqli_query($con, $sql_reporte);
$numero_reporte = mysqli_num_rows($result_reporte);
while($row_reporte = mysqli_fetch_array($result_reporte, MYSQLI_ASSOC)){
$idReporte = $row_reporte['id'];
}
$ventas = 0;
$sql_reporte_mes = "SELECT volumen_venta FROM re_reporte_cre_producto WHERE id_re_mes = '".$idReporte."'  ";
$result_reporte_mes = mysqli_query($con, $sql_reporte_mes);
$numero_reporte_mes = mysqli_num_rows($result_reporte_mes);
while($row_reporte_mes = mysqli_fetch_array($result_reporte_mes, MYSQLI_ASSOC)){

$ventas = $ventas + $row_reporte_mes['volumen_venta'];
}


return $ventas;
}

?>

<div class="mb-2" style="overflow-y: hidden;">
<table class="table table-bordered table-sm mt-3" style="font-size: .9em;">
<thead>
<th>Mes</th>
<th class="text-right">Ventas</th>
<th>Mes anterior</th>
<th class="text-right">ventas</th>
<th class="text-right">Resultado</th>
</thead>
<tbody>
<?php
$Promedio = 0;
$totalyear = 0;
for ($i=1; $i <= 12; $i++) { 

$RMA = $i-1;

if ($RMA == 0) {
$mesAnte = 12;
$YearAnte = $Year - 1;
}else{
$mesAnte = $RMA;	
$YearAnte = $Year;
}

$MesActual = Ventas($Session_IDEstacion,$i,$Year,$con);
$MesAnte = Ventas($Session_IDEstacion,$mesAnte,$YearAnte,$con);

if ($MesActual == 0 || $MesAnte == 0) {
$Promedio = 0;
}else{
$Promedio = $MesAnte / $MesActual * 100;
}



echo "<tr>";
echo "<td class='bg-light'>".nombremes($i)." del ".$Year."</td>";
echo "<td class='table-info text-right'><b>".number_format($MesActual,2)."</b></td>";
echo "<td class='bg-light'>".nombremes($mesAnte)." del ".$YearAnte."</td>";
echo "<td class='table-warning text-right'><b>".number_format($MesAnte,2)."</b></td>";
echo "<td class='table-warning text-right'><b>".number_format($Promedio)."%</b></td>";
echo "</tr>";

}
?>

</tbody>
</table>
</div>
<?php
//------------------
mysqli_close($con);
//------------------
?>