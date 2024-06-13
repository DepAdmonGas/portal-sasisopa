<?php
require('../../../../app/help.php');

$sql_extintores = "SELECT * FROM po_extintores_estacion WHERE id_estacion = '".$Session_IDEstacion."' AND estado = 1 ORDER BY no_extintor desc";
$result_extintores = mysqli_query($con, $sql_extintores);
$numero_extintores = mysqli_num_rows($result_extintores);

?>

<div style="overflow-y: hidden;">

<table class="table table-bordered table-striped table-sm table-hover pb-0 mb-0">
	<thead>
		<tr>
			<th class="align-middle text-center">No. De extintor </th>
			<th class="align-middle text-center">Ubicación</th>
			<th class="align-middle text-center">Fecha de ultima recarga</th>
			<th class="align-middle text-center">Tipo de Extintor</th>
			<th class="align-middle text-center">Peso Kg</th>
			<th class="align-middle text-center" width="20px"><img src="<?=RUTA_IMG_ICONOS;?>edit-black-16.png"></th>
			<th class="align-middle text-center" width="20px"><img src="<?=RUTA_IMG_ICONOS;?>eliminar-red-16.png"></th>
		</tr>
	</thead>
	<tbody>
		<?php 
	if ($numero_extintores > 0) {
		while($row_extintores = mysqli_fetch_array($result_extintores, MYSQLI_ASSOC)){

			$id = $row_extintores['id'];
			$explode = explode(" ", $row_extintores['ultima_recarga']);

			echo "<tr>";
			echo "<td class='text-center align-middle'>".$row_extintores['no_extintor']."</td>";
			echo "<td class='text-center align-middle'>".$row_extintores['ubicacion']."</td>";
			echo "<td class='text-center align-middle'><b>".FormatoFecha($explode[0])."</b></td>";
			echo "<td class='text-center align-middle'>".$row_extintores['tipo_extintor']."</td>";
			echo "<td class='text-center align-middle'>".$row_extintores['peso_kg']."</td>";
			echo "<td class='text-center align-middle' width='20px' style='cursor: pointer;'><img src='".RUTA_IMG_ICONOS."edit-black-16.png' onclick='EditarExtintor(".$id.")'></td>";
			echo "<td class='text-center align-middle' width='20px' style='cursor: pointer;'><img src='".RUTA_IMG_ICONOS."eliminar-red-16.png' onclick='EliminarExtintor(".$id.")'></td>";
			echo "</tr>";

		}
	}else{
   echo "<tr><td colspan='7' class='text-center'><small>No se encontró información para mostrar</small></td></tr>";
	}
		?>
	</tbody>
</table>
</div>
