<?php
require('../../../../app/help.php');

$sql_extintores = "SELECT * FROM tb_tanque_almacenamiento WHERE id_estacion = '".$Session_IDEstacion."' ORDER BY no_tanque ASC ";
$result_extintores = mysqli_query($con, $sql_extintores);
$numero_extintores = mysqli_num_rows($result_extintores);

?>

<div class="mb-2" style="overflow-y: hidden;">

<table class="table table-bordered table-striped table-sm table-hover pb-0 mb-0">
	<thead>
		<tr>
			<th class="align-middle text-center">No. Tanque </th>
			<th class="align-middle text-center">Capacidad</th>
			<th class="align-middle text-center">Producto</th>
			<th class="align-middle text-center" width="20px"><img src="<?=RUTA_IMG_ICONOS;?>edit-black-16.png"></th>
			<th class="align-middle text-center" width="20px"><img src="<?=RUTA_IMG_ICONOS;?>eliminar-red-16.png"></th>
		</tr>
	</thead>
	<tbody>
		<?php 
	if ($numero_extintores > 0) {
		while($row_extintores = mysqli_fetch_array($result_extintores, MYSQLI_ASSOC)){

			$id = $row_extintores['id'];

			echo "<tr>";
			echo "<td class='text-center align-middle'>".$row_extintores['no_tanque']."</td>";
			echo "<td class='text-center align-middle'>".$row_extintores['capacidad']."</td>";
			echo "<td class='text-center align-middle'>".$row_extintores['producto']."</td>";
			echo "<td class='text-center align-middle' width='20px' style='cursor: pointer;'><img src='".RUTA_IMG_ICONOS."edit-black-16.png' onclick='Editar(".$id.")'></td>";
			echo "<td class='text-center align-middle' width='20px' style='cursor: pointer;'><img src='".RUTA_IMG_ICONOS."eliminar-red-16.png' onclick='Eliminar(".$id.")'></td>";
			echo "</tr>";

		}
	}else{
   echo "<tr><td colspan='7' class='text-center'><small>No se encontró información para mostrar</small></td></tr>";
	}
		?>
	</tbody>
</table>
</div>
