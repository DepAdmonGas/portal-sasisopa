<?php
require('../../../app/help.php');

$sql_capacitacion = "SELECT * FROM tb_seguimiento_reporte_indicador WHERE id_estacion = '".$Session_IDEstacion."' ORDER BY fecha DESC ";
$result_capacitacion = mysqli_query($con, $sql_capacitacion);
$numero_capacitacion = mysqli_num_rows($result_capacitacion);

?>
<table class="table table-bordered table-striped table-sm">
<thead>	
<tr>
<th class="text-center align-middle">#</th>
<th class="text-center align-middle">Fecha</th>
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

echo "<tr>";
echo "<td class='text-center'>".$num."</td>";
echo "<td class='text-center'>".FormatoFecha($row_capacitacion['fecha'])."</td>";

echo "<td class='text-center align-middle' width='30'><img src='".RUTA_IMG_ICONOS."ojo.png' style='cursor: pointer;' onclick='ModalDSRI(".$id.")'></td>";
echo "<td class='text-center align-middle' width='30'><img src='".RUTA_IMG_ICONOS."editar.png' style='cursor: pointer;' onclick='ModalEditSRI(".$id.")'></td>";
echo "<td class='text-center align-middle' width='30'><img src='".RUTA_IMG_ICONOS."eliminar.png' style='cursor: pointer;' onclick='EliminarObjetivo(2,".$id.")'></td>";

echo "</tr>";

$num = $num + 1;
}
}else{
echo "<td colspan='8' class='text-center text-secondary' style='font-size: .8em;'>No se encontró información para mostrar</td>";

}
?>	
</tbody>
</table>