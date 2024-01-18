<?php
require('../../../app/help.php');

$sql_capacitacion = "SELECT * FROM tb_operacion_mantenimiento WHERE (estado = '".$Session_IDEstacion."' OR estado = 0) ";
$result_capacitacion = mysqli_query($con, $sql_capacitacion);
$numero_capacitacion = mysqli_num_rows($result_capacitacion);

?>

<div class="mb-2" style="overflow-y: hidden;">
<table class="table table-bordered table-striped table-sm">
<thead>	
<tr>
<th class="text-center align-middle">#</th>
<th class="text-center align-middle">Fecha</th>
<th class="text-center align-middle">Norma</th>
<th class="text-center align-middle">Nombre</th>
<th class="text-center align-middle">Link</th>
<th class="text-center align-middle"></th>
</tr>
</thead>
<tbody>
<?php
$i = 1;
if ($numero_capacitacion > 0) {
while($row_capacitacion = mysqli_fetch_array($result_capacitacion, MYSQLI_ASSOC)){
$id = $row_capacitacion['id'];

echo "<tr>";
echo "<td class='text-center align-middle'>".$i."</td>";
echo "<td class='text-center align-middle'>".FormatoFecha($row_capacitacion['fecha'])."</td>";
echo "<td class='text-center align-middle'>".$row_capacitacion['norma']."</td>";
echo "<td class='text-center align-middle'>".$row_capacitacion['nombre']."</td>";
echo "<td class='text-center align-middle'><small>".$row_capacitacion['link']."</small></td>";
echo "<td class='text-center align-middle'width='20px' style='cursor: pointer;'><img src='".RUTA_IMG_ICONOS."eliminar.png' onclick='eliminar(".$id.")'></td>";
echo "</tr>";

$i++;
}
}else{
echo "<td colspan='6' class='text-center text-secondary' style='font-size: .8em;'>No se encontró información para mostrar</td>";

}
?>	
</tbody>
</table>
</div>