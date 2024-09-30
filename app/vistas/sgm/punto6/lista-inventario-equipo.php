<?php
require('../../../../app/help.php');

$sql = "SELECT * FROM sgm_inventario_equipo WHERE id_estacion = '".$Session_IDEstacion."' AND estado < 2 ORDER BY nombre DESC ";
$result = mysqli_query($con, $sql);
$numero = mysqli_num_rows($result);
?>

<table class="table table-bordered table-striped table-hover table-sm mb-0 pb-0">
<thead>
<tr>
  <th class="text-center align-middle">#</th>
  <th class="text-center align-middle">Nombre del equipo de medición</th>
  <th class="text-center align-middle">Identificación</th>
  <th class="text-center align-middle">Función que desempeña dentro de la ES</th>
  <th class="text-center align-middle">Fecha de instalación</th>
  <th class="text-center align-middle">Manuales, garantías  o información </th>
  <th class="text-center align-middle" width="32px"></th>
  <th class="text-center align-middle" width="32px"></th>
</tr>
</thead>
<tbody>
<?php
$num = 1;
if ($numero > 0) {
while($row = mysqli_fetch_array($result, MYSQLI_ASSOC)){

	if($row['fecha_instalacion'] == '0000-00-00'){
		$fecha = 'S/I';
	}else{
		$fecha = FormatoFecha($row['fecha_instalacion']);
	}

	if($row['estado'] == 0){
		$tr_color = 'table-warning';
	}else if($row['estado'] == 1){
		$tr_color = '';
	}

echo "<tr class='".$tr_color."'>";
echo "<td class='text-center align-middle'>".$num."</td>";
echo "<td class='text-center align-middle'>".$row['nombre']."</td>";
echo "<td class='text-center align-middle'>".$row['identificacion']."</td>";
echo "<td class='text-center align-middle'>".$row['funcion']."</td>";
echo "<td class='text-center align-middle'>".$fecha."</td>";

echo "<td class='text-center align-middle' width='30'><img src='".RUTA_IMG_ICONOS."documento.png' style='cursor: pointer;' onclick='ManualEquipo(".$row['id'].")'></td>";

echo "<td class='text-center align-middle' width='30'><img src='".RUTA_IMG_ICONOS."editar.png' style='cursor: pointer;' onclick='modalEditarEquipo(".$row['id'].")'></td>";
echo "<td class='text-center align-middle' width='30'><img src='".RUTA_IMG_ICONOS."eliminar.png' style='cursor: pointer;' onclick='EliminarEquipo(".$row['id'].")'></td>";
echo "</tr>";
$num++;
}
}else{
echo "<td colspan='8' class='text-center text-secondary' style='font-size: .8em;'>No se encontró información para mostrar</td>";
}
?>
</tbody>
</table>


