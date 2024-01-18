<?php
require('../../../app/help.php');



function Requisitos($NivelGobierno,$con){

$sql = "SELECT * FROM rl_requisitos_legales_lista WHERE nivel_gobierno = '".$NivelGobierno."' AND estado = 1 ORDER BY mun_alc_est ASC ";
$result = mysqli_query($con, $sql);
$numero = mysqli_num_rows($result);

while($row = mysqli_fetch_array($result, MYSQLI_ASSOC)){

$id = $row['id'];

$Resultado .= "<tr>";
$Resultado .= "<td class='align-middle'>".$row['nivel_gobierno']."</td>";
$Resultado .= "<td class='align-middle'>".$row['mun_alc_est']."</td>";
$Resultado .= "<td class='align-middle'>".$row['dependencia']."</td>";
$Resultado .= "<td class='align-middle'>".$row['permiso']."</td>";
$Resultado .= "<td class='align-middle'>".Personal($row['id_usuario'],$con)."</td>";
$Resultado .= "<td class='text-center align-middle' width='20px' style='cursor: pointer;'><img src='".RUTA_IMG_ICONOS."edit-black-16.png' onclick='ModalEditarRL(".$id.")'></td>";
$Resultado .= "<td class='text-center align-middle' width='20px' style='cursor: pointer;'><img src='".RUTA_IMG_ICONOS."eliminar-red-16.png' onclick='EliminarRL(".$id.")'></td>";

$Resultado .= "</tr>";


}

return $Resultado;
}


function Personal($idusuario,$con){

$sql = "SELECT * FROM tb_usuarios WHERE id = '".$idusuario."' ";
$result = mysqli_query($con, $sql);
while($row = mysqli_fetch_array($result, MYSQLI_ASSOC)){
$nombre = $row['nombre'];
}
return $nombre;
}
?>

<div class="mb-2" style="overflow-y: hidden;">
<table class="table table-bordered table-striped table-sm table-hover mt-3 pb-0 mb-0" style="font-size: .85em">
	<thead>
		<tr>
			<th class="align-middle">Nivel de gobierno</th>
			<th class="align-middle">Municipio, Alcaldía y Estado</th>
			<th class="align-middle">Dependencias</th>
			<th class="align-middle">Permiso</th>
			<th class="align-middle">Responsable</th>
			<th class="align-middle text-center" width="20px"></th>
			<th class="align-middle text-center" width="20px"></th>
		</tr>
	</thead>
	<tbody>
		<?php 
		echo Requisitos('Municipal' ,$con);
		echo Requisitos('Estatal'   ,$con);
		echo Requisitos('Federal'   ,$con);
		echo Requisitos('Varios'    ,$con);
		?>
	</tbody>
</table>
</div>