<?php
require('../../../../app/help.php');
include_once "../../../../app/modelo/ControlActividadProceso.php";

$class_control_actividad_proceso = new ControlActividadProceso();
?>
<script type="text/javascript">
$(document).ready(function(){
  $('[data-toggle="tooltip"]').tooltip();
  });
</script>
<?php

$selyear = $_POST['selyear'];
$selmes = $_POST['selmes'];

if ($selmes != "") {
$BuscarMes = " AND MONTH(fechacreacion) = ".$selmes;
$mes = $selmes;
}else{
$BuscarMes = "";
$mes = 0;
}

$year = date("Y");
$mes = date("m");

$sql_mantenimiento = "SELECT * FROM po_mantenimiento_correctivo WHERE id_estacion = '".$Session_IDEstacion."' AND YEAR(fechacreacion) = '".$selyear."' $BuscarMes ORDER BY id desc";
$result_mantenimiento = mysqli_query($con, $sql_mantenimiento);
$numero_mantenimiento = mysqli_num_rows($result_mantenimiento);
?>

<div class="text-right mb-2">
<?php
if ($numero_mantenimiento > 0) {
?>
<a class="ml-2" onclick="DescargarReporteYM(<?=$selyear;?>,<?=$selmes;?>)" style="cursor: pointer;" data-toggle="tooltip" data-placement="left" title="Decargar PDF" >
<img src="<?php echo RUTA_IMG_ICONOS."archivo.png"; ?>">
</a>
<?php
}
?>
<a class="ml-3" onclick="ListaMantenimiento()" id="Toltip" style="cursor: pointer;" data-toggle="tooltip" data-placement="left" title="Regresar" >
<img src="<?php echo RUTA_IMG_ICONOS."eliminar.png"; ?>">
</a>

</div>

<?php
if ($numero_mantenimiento > 0) {
echo "<div class='row'>";
while($row_mantenimiento = mysqli_fetch_array($result_mantenimiento, MYSQLI_ASSOC)){
$id = $row_mantenimiento['id'];
$folio = $class_control_actividad_proceso->FormatFolio($row_mantenimiento['folio']);
$fecha = FormatoFecha($row_mantenimiento['fechacreacion']);
$hora = date("g:i a",strtotime($row_mantenimiento['horacreacion']));

$NombreEquipo = $row_mantenimiento['nombre_equipo'];


echo "<div class='col-3 mb-2'>";
echo "<div class='shadow-sm border p-2 c-pointer hover-div' onclick='DetalleMantenimiento($id)'>";

?>

<table class="border-bottom" width="100%">
	<tr>
		<td class="text-left"><b>Folio: <?=$folio;?></b></td>
		<td class="font-weight-bold text-right <?=$txtColor;?>"></td>
	</tr>
</table>


<div class="text-center mb-3 mt-3"><b><?=$NombreEquipo?></b></div>

<div class="text-right text-secondary border-top pt-2"><small><?=$fecha;?>, <?=$hora;?></small></div>
<?php

echo "</div>";
echo "</div>";

}
echo "<div>";
}else{
echo "<div class='text-center mt-4 mb-4'><small>No se encontró información para mostrar</small></div>";	
}
?>