<?php
require('../../../../app/help.php');
include_once "../../../../app/modelo/MonitoreoVerificacionEvaluacion.php";
$class_monitoreo_evaluacion = new MonitoreoVerificacionEvaluacion();

$Year = $_GET['Year'];
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

$MesActual = $class_monitoreo_evaluacion->ventasMensual($Session_IDEstacion,$i,$Year);
$MesAnte = $class_monitoreo_evaluacion->ventasMensual($Session_IDEstacion,$mesAnte,$YearAnte);

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