<?php
require('../../app/help.php');

$FechaInicio = date('Y-m-d', $_GET['FechaInicio']);
$FechaTermino = date('Y-m-d', $_GET['FechaTermino']);

$sql_capacitacion = "SELECT * FROM tb_capacitacion_externa WHERE id_estacion = '".$Session_IDEstacion."' AND fecha_programada BETWEEN '".$FechaInicio."' AND '".$FechaTermino."' ";
$result_capacitacion = mysqli_query($con, $sql_capacitacion);
$numero_capacitacion = mysqli_num_rows($result_capacitacion);

?>
<h4>6. COMPETENCIA DEL PERSONAL, CAPACITACIÓN Y ENTRENAMIENTO</h4>
<?php 
echo '<div class="row">';
echo '<div class="col-6">';
echo '<table class="table table-bordered table-striped table-sm mb-0 pb-0" style="font-size: .9em;">
	<tbody>
	<tr>
	<td><h6>Fo.ADMONGAS.008 (Fichas de personal)</h6></td>
	<td class="text-center align-middle" width="30"><a href="../../public/reporte-sasisopa/descar-ficha-personal-pdf.php?FechaInicio='.$_GET['FechaInicio'].'&FechaTermino='.$_GET['FechaTermino'].'"><img src="'.RUTA_IMG_ICONOS.'pdf.png" style="cursor: pointer;"></a></td>
	</tr>
	</tbody>
	</table>';
echo '</div>';
echo '<div class="col-6">';
echo '<h6>Fo.ADMONGAS.009 (Programa de Capacitacion y adiestramiento)</h6>';
echo '<div class="text-right"><a href="../../public/reporte-sasisopa/descargar-programa-capacitacion-adiestramiento-pdf.php?FechaInicio='.$_GET['FechaInicio'].'&FechaTermino='.$_GET['FechaTermino'].'" data-toggle="tooltip" data-placement="left" title="Descargar" ><img src="'.RUTA_IMG_ICONOS.'pdf.png" style="cursor: pointer;"></a></div>';

echo '<table class="table table-bordered table-striped table-sm mt-2">
<thead>	
<tr class="table-primary">
<th class="text-center align-middle">#</th>
<th class="text-center align-middle">Curso</th>
<th class="text-center align-middle">Fecha programada</th>
<th class="text-center align-middle">Duración</th>
<th class="text-center align-middle">Instructor</th>
<th class="text-center align-middle">Fecha real</th>
<th class="text-center align-middle"></th>
</tr>
</thead>
<tbody>';
$num = 1;
if ($numero_capacitacion > 0) {
while($row_capacitacion = mysqli_fetch_array($result_capacitacion, MYSQLI_ASSOC)){
$id = $row_capacitacion['id'];

if ($row_capacitacion['fecha_real'] == "0000-00-00") {
$fechareal = "<small class='text-danger'>Falta editar la fecha real del curso</small>";
}else{
$fechareal = FormatoFecha($row_capacitacion['fecha_real']);
}
echo "<tr>";
echo "<td class='text-center'>".$num."</td>";
echo "<td class='text-center'>".$row_capacitacion['curso']."</td>";
echo "<td class='text-center'>".FormatoFecha($row_capacitacion['fecha_programada'])."</td>";
echo "<td class='text-center'>".$row_capacitacion['duracion']." ".$row_capacitacion['duraciondetalle']."</td>";
echo "<td class='text-center'>".$row_capacitacion['instructor']."</td>";
echo "<td class='text-center'>".$fechareal."</td>";
echo "<td class='text-center align-middle' width='30'><img width='16' src='".RUTA_IMG_ICONOS."pdf.png' style='cursor: pointer;' onclick='DescargarProgramaCapacitacionExterna(".$id.")'></td>";
echo "</tr>";

$num = $num + 1;
}
}else{
echo "<td colspan='10' class='text-center text-secondary' style='font-size: .8em;'>No se encontró información para mostrar</td>";

}
echo '</tbody></table>';
echo '</div>';
echo '</div>';
?>
<hr>