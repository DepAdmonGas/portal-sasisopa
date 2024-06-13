<?php
require('../../../../app/help.php');

$sql_resultado = "SELECT * FROM tb_informe_revision_resultados WHERE id_estacion = '".$Session_IDEstacion."' ORDER BY fecha desc";
$result_resultado = mysqli_query($con, $sql_resultado);
$numero_resultado = mysqli_num_rows($result_resultado);

?>
<div class="mt-2" style="overflow-y: hidden;">
<table class="table table-bordered table-striped table-sm table-hover mt-2 pb-0 mb-0">
	<thead>
		<tr>
			<th class="align-middle text-center">#</th>
			<th class="align-middle text-center">Fecha</th>
			<th class="align-middle text-center" width="20px"><img src="<?=RUTA_IMG_ICONOS;?>pdf.png"></th>
			<th class="align-middle text-center" width="20px"><img src="<?=RUTA_IMG_ICONOS;?>eliminar.png"></th>
		</tr>
	</thead>
	<tbody>
	<?php 
	$i = 1;
	if ($numero_resultado > 0) {
		while($row_resultado = mysqli_fetch_array($result_resultado, MYSQLI_ASSOC)){
		
		$id = $row_resultado['id'];
		echo "<tr>";
		echo "<td class='text-center'>".$i."</td>";
		echo "<td class='text-center'><b>".FormatoFecha($row_resultado['fecha'])."</b></td>";
		echo "<td class='text-center align-middle' width='20px' style='cursor: pointer;'><a href='".RUTA_ARCHIVOS."informe-revision-resultados/".$row_resultado['archivo']."' download><img src='".RUTA_IMG_ICONOS."pdf.png'></a></td>";
		echo "<td class='text-center align-middle' style='cursor: pointer;'><img src='".RUTA_IMG_ICONOS."eliminar.png' onclick='Eliminar(".$id.")'></td>";
		echo "</tr>";

		$i++;
		
	}
	}else{
	echo "<tr><td colspan='4' class='text-center'><small>No se encontró información para mostrar</small></td></tr>";
	}
	?>
	</tbody>
</table>
</div>