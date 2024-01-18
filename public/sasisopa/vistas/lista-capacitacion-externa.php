<?php
require('../../../app/help.php');

$sql_capacitacion = "SELECT * FROM tb_capacitacion_externa WHERE id_estacion = '".$Session_IDEstacion."' ";
$result_capacitacion = mysqli_query($con, $sql_capacitacion);
$numero_capacitacion = mysqli_num_rows($result_capacitacion);

?>

<div class="mb-2" style="overflow-y: hidden;">
<table class="table table-bordered table-striped table-sm">
<thead>	
<tr class="table-primary">
<th class="text-center align-middle">#</th>
<th class="text-center align-middle">Curso</th>
<th class="text-center align-middle">Fecha programada</th>
<th class="text-center align-middle">Duración</th>
<th class="text-center align-middle">Instructor</th>
<th class="text-center align-middle">Fecha real</th>
<th class="text-center align-middle"></th>
<th class="text-center align-middle"></th>
<th class="text-center align-middle"></th>
<th class="text-center align-middle"></th>
</tr>
</thead>
<tbody>
<?php
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
echo "<td class='text-center align-middle' width='30'><img src='".RUTA_IMG_ICONOS."edit-black-16.png' style='cursor: pointer;' onclick='Editar(".$id.")'></td>";
echo "<td class='text-center align-middle' width='30'><img width='16' src='".RUTA_IMG_ICONOS."funciones-responsabilidad.png' style='cursor: pointer;' onclick='Personal(".$id.")'></td>";
echo "<td class='text-center align-middle' width='30'><img width='16' src='".RUTA_IMG_ICONOS."pdf.png' style='cursor: pointer;' onclick='DescargarRegistro(".$id.")'></td>";
echo "<td class='text-center align-middle' width='30'><img width='16' src='".RUTA_IMG_ICONOS."eliminar.png' style='cursor: pointer;' onclick='EliminarRegistro(".$id.")'></td>";
echo "</tr>";

$num = $num + 1;
}
}else{
echo "<td colspan='10' class='text-center text-secondary' style='font-size: .8em;'>No se encontró información para mostrar</td>";

}
?>	
</tbody>
</table>
</div>