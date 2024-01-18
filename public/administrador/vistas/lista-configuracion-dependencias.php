<?php
require('../../../app/help.php');

$sql = "SELECT * FROM rl_requisitos_legales_dependencias WHERE (id_estacion = '".$Session_IDEstacion."' OR id_estacion = 0) AND estado = 1 ORDER BY dependencia ASC ";
$result = mysqli_query($con, $sql);
$numero = mysqli_num_rows($result);

?>

<div class="mb-2" style="overflow-y: hidden;">
<table class="table table-bordered table-striped table-sm table-hover mt-3 pb-0 mb-0" style="font-size: .85em">
	<thead>
		<tr>
			<th class="align-middle">Dependencia</th>
			<th class="align-middle text-center" width="20px"></th>
		</tr>
	</thead>
	<tbody>
		<?php 
	if ($numero > 0) {
		while($row = mysqli_fetch_array($result, MYSQLI_ASSOC)){
			$id = $row['id'];

			echo "<tr>";
			echo "<td class='align-middle'>".$row['dependencia']."</td>";

			echo "<td class='text-center align-middle' width='20px' style='cursor: pointer;'><img src='".RUTA_IMG_ICONOS."eliminar-red-16.png' onclick='EliminarD(".$id.")'></td>";
			echo "</tr>";

		}
	}else{
   echo "<tr><td colspan='7' class='text-center'><small>No se encontró información para mostrar</small></td></tr>";
	}
		?>
	</tbody>
</table>
</div>