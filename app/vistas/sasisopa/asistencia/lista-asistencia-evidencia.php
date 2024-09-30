<?php
require('../../../../app/help.php');
$idReporte = $_GET['id'];
$sql_capacitacion = "SELECT * FROM tb_lista_asistencia_evidencia WHERE id_lista_asistencia = '".$idReporte."' ";
$result_capacitacion = mysqli_query($con, $sql_capacitacion);
$numero_capacitacion = mysqli_num_rows($result_capacitacion);

?>
<table class="table table-bordered table-sm">
<thead>	
<tr>
<th class="text-center align-middle">Fecha y Hora</th>
<th class="text-center align-middle">Evidencia</th>
<th class="text-center align-middle"></th>
</tr>
</thead>
<tbody>
<?php
$num = 1;
if ($numero_capacitacion > 0) {
while($row_capacitacion = mysqli_fetch_array($result_capacitacion, MYSQLI_ASSOC)){
$id = $row_capacitacion['id'];
$fecha_hora = $row_capacitacion['fecha_hora'];
$evidencia = $row_capacitacion['evidencia'];

echo "<tr>";
echo "<td class='text-center align-middle'>".$fecha_hora."</td>";
echo "<td class='text-center align-middle'><img  width='80' src='".RUTA_ARCHIVOS.'evidencias/'.$evidencia."'></td>";
echo "<td class='text-center align-middle' width='30'><img src='".RUTA_IMG_ICONOS."eliminar.png' style='cursor: pointer;' onclick='EliminarEvidencia(".$idReporte.",".$id.")'></td>";
echo "</tr>";

$num = $num + 1;
}
}else{
echo "<td colspan='5' class='text-center text-secondary' style='font-size: .8em;'>No se encontró información para mostrar</td>";

}
?>	
</tbody>
</table>