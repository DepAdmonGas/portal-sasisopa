<?php
require('../../../app/help.php');



$sql_resultado = "SELECT * FROM tb_evaluacion_desempeno WHERE id_estacion = '".$Session_IDEstacion."' ORDER BY fecha_hora desc";
$result_resultado = mysqli_query($con, $sql_resultado);
$numero_resultado = mysqli_num_rows($result_resultado);


?>
<div class="mt-2" style="overflow-y: hidden;">
<table class="table table-bordered table-striped table-sm table-hover mt-2">
	<thead>
		<tr>
			<th class="align-middle text-center">#</th>
			<th class="align-middle text-center">Fecha</th>
			<th class="align-middle text-center">Nombre completo</th>
			<th class="align-middle text-center" width="20px"></th>
			<th class="align-middle text-center" width="20px"></th>
			<th class="align-middle text-center" width="20px"></th>
		</tr>
	</thead>
	<tbody>
	<?php 
	$i = 1;
	if ($numero_resultado > 0) {
		while($row_resultado = mysqli_fetch_array($result_resultado, MYSQLI_ASSOC)){
		
		$id = $row_resultado['id'];
		$explode = explode(" ", $row_resultado['fecha_hora']);

		$sql_usuario = "SELECT nombre FROM tb_usuarios WHERE id = '".$row_resultado['id_usuario']."' ";
$result_usuario = mysqli_query($con, $sql_usuario);
while($row_usuario = mysqli_fetch_array($result_usuario, MYSQLI_ASSOC)){
$nomencargado = $row_usuario['nombre'];
}

if($row_resultado['archivo'] != ""){
	$imgPDF = "<a target='_blank' href='".$row_resultado['archivo']."' ><img src='".RUTA_IMG_ICONOS."pdf-16.png'></a>";
}else{
	$imgPDF = "<img src='".RUTA_IMG_ICONOS."eliminar-red-16.png'>";
}


		echo "<tr>";
		echo "<td class='text-center'><b>".$i."</b></td>";
		echo "<td class='text-center'><b>".FormatoFecha($explode[0])."</b></td>";
		echo "<td class='text-center'>".$nomencargado."</td>";
		echo "<td class='text-center align-middle' width='20px'>".$imgPDF."</td>";
		echo "<td class='text-center align-middle' width='20px' style='cursor: pointer;'><img src='".RUTA_IMG_ICONOS."edit-black-16.png' onclick='Editar(".$id.")'></td>";
				echo "<td class='text-center align-middle' width='20px' style='cursor: pointer;'><img src='".RUTA_IMG_ICONOS."eliminar-red-16.png' onclick='Eliminar(".$id.")'></td>";
		echo "</tr>";
		
		$i++;
		}
	}else{
	echo "<tr><td colspan='6' class='text-center'><small>No se encontró información para mostrar</small></td></tr>";
	}
	?>
	</tbody>
</table>
</div