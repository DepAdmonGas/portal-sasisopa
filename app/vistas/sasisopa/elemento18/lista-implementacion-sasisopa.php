<?php
require('../../../../app/help.php');

$sql_resultado = "SELECT
tb_implementacion_sasisopa.id,
tb_implementacion_sasisopa.id_estacion,
tb_implementacion_sasisopa.id_usuario,
tb_implementacion_sasisopa.fecha_hora,
tb_usuarios.nombre
FROM tb_implementacion_sasisopa 
INNER JOIN tb_usuarios
ON tb_implementacion_sasisopa.id_usuario = tb_usuarios.id 
WHERE tb_implementacion_sasisopa.id_estacion = '".$Session_IDEstacion."' ORDER BY tb_implementacion_sasisopa.fecha_hora desc";
$result_resultado = mysqli_query($con, $sql_resultado);
$numero_resultado = mysqli_num_rows($result_resultado);

?>
<table class="table table-bordered table-striped table-sm table-hover mt-3">
	<thead>
		<tr>
			<th class="align-middle text-center">#</th>
			<th class="align-middle text-center">Fecha</th>
			<th class="align-middle text-center">Nombre completo</th>
			<th class="align-middle text-center" width="20px"><img src="<?=RUTA_IMG_ICONOS;?>edit-black-16.png"></th>
			<th class="align-middle text-center" width="20px"><img width="16px" src="<?=RUTA_IMG_ICONOS;?>pdf.png"></th>
			<th class="align-middle text-center" width="20px"><img src="<?=RUTA_IMG_ICONOS;?>ojo-black-16.png"></th>
			<th class="align-middle text-center" width="20px"><img src="<?=RUTA_IMG_ICONOS;?>eliminar-red-16.png"></th>
		</tr>
	</thead>
	<tbody>
	<?php 
	$i = 1;
	if ($numero_resultado > 0) {
		while($row_resultado = mysqli_fetch_array($result_resultado, MYSQLI_ASSOC)){
		
		$id = $row_resultado['id'];
		$explode = explode(" ", $row_resultado['fecha_hora']);

		$nomencargado = $row_resultado['nombre'];

		echo "<tr>";
		echo "<td class='text-center'><b>".$i."</b></td>";
		echo "<td class='text-center'><b>".FormatoFecha($explode[0])."</b></td>";
		echo "<td class='text-center'>".$nomencargado."</td>";
		echo "<td class='text-center align-middle' width='20px' style='cursor: pointer;'><img src='".RUTA_IMG_ICONOS."edit-black-16.png' onclick='EditarImplementacion(".$id.")'></td>";

		echo "<td class='text-center align-middle' width='20px' style='cursor: pointer;'><img src='".RUTA_IMG_ICONOS."pdf.png' width='20px' onclick='DescargarIS(".$id.")'></td>";

		echo "<td class='text-center align-middle' width='20px' style='cursor: pointer;'><img src='".RUTA_IMG_ICONOS."ojo-black-16.png' onclick='VerImplementacion(".$id.")'></td>";
		echo "<td class='text-center align-middle' width='20px' style='cursor: pointer;'><img src='".RUTA_IMG_ICONOS."eliminar-red-16.png' onclick='EliminarImplementacion(".$id.")'></td>";
		echo "</tr>";
		
		$i++;

		}
	}else{
	echo "<tr><td colspan='7' class='text-center'><small>No se encontró información para mostrar</small></td></tr>";
	}
	?>
	</tbody>
</table>