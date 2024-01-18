<?php
require('../../../app/help.php');

$sql_extintores = "SELECT * FROM tb_jarra_patron WHERE id_estacion = '".$Session_IDEstacion."' ";
$result_extintores = mysqli_query($con, $sql_extintores);
$numero_extintores = mysqli_num_rows($result_extintores);

?>

<div class="mb-2" style="overflow-y: hidden;">

<table class="table table-bordered table-striped table-sm table-hover ">
	<thead>
		<tr>
			<th class="align-middle text-center">Marca</th>
			<th class="align-middle text-center">No de serie</th>
			<th class="align-middle text-center">Capacidad</th>
			<th class="align-middle text-center">Material de fabricación</th>
			<th class="align-middle text-center" width="20px"></th>
			<th class="align-middle text-center" width="20px"></th>
		</tr>
	</thead>
	<tbody>
		<?php 
	if ($numero_extintores > 0) {
		while($row_extintores = mysqli_fetch_array($result_extintores, MYSQLI_ASSOC)){

			$id = $row_extintores['id'];

			echo "<tr>";
			echo "<td class='text-center align-middle'>".$row_extintores['marca']."</td>";
			echo "<td class='text-center align-middle'>".$row_extintores['no_serie']."</td>";
			echo "<td class='text-center align-middle'>".$row_extintores['capacidad']."</td>";
			echo "<td class='text-center align-middle'>".$row_extintores['material']."</td>";
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
