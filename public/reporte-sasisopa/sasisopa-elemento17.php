<?php
require('../../app/help.php');

$FechaInicio = date('Y-m-d', $_GET['FechaInicio']);
$FechaTermino = date('Y-m-d', $_GET['FechaTermino']);

$Explode = explode("-", $FechaTermino);
$fecha_year = $Explode[0];

$sql_resultado = "SELECT * FROM tb_revision_resultados WHERE id_estacion = '".$Session_IDEstacion."' AND fecha_hora BETWEEN '".$FechaInicio."' AND '".$FechaTermino."' ORDER BY fecha_hora desc";
$result_resultado = mysqli_query($con, $sql_resultado);
$numero_resultado = mysqli_num_rows($result_resultado);


?>
<h4>17. REVISIÓN DE RESULTADOS</h4>

<table class="table table-bordered table-striped table-sm table-hover mt-2">
<tr>
<td>
      <h6>Resumen de revisión de resultados <?=$fecha_year;?></h6>
</td>
<td width="32"><a onclick="DescargarRRR(<?=$fecha_year;?>)" style="cursor: pointer;"><img src="<?php echo RUTA_IMG_ICONOS."pdf.png"; ?>"></a></td>
</tr>
</table>

<h6>Informe de revisión de resultados</h6>
<table class="table table-bordered table-striped table-sm table-hover mt-2">
	<thead>
		<tr>
			<th class="align-middle text-center">#</th>
			<th class="align-middle text-center">Fecha</th>
			<th class="align-middle text-center">Nombre completo</th>
			<th class="align-middle text-center" width="20px"></th>
		</tr>
	</thead>
	<tbody>
	<?php 
	if ($numero_resultado > 0) {
		while($row_resultado = mysqli_fetch_array($result_resultado, MYSQLI_ASSOC)){
		
		$id = $row_resultado['id'];
		$explode = explode(" ", $row_resultado['fecha_hora']);

		$sql_usuario = "SELECT nombre FROM tb_usuarios WHERE id = '".$row_resultado['id_usuario']."' ";
$result_usuario = mysqli_query($con, $sql_usuario);
while($row_usuario = mysqli_fetch_array($result_usuario, MYSQLI_ASSOC)){
$nomencargado = $row_usuario['nombre'];
}

$imgPDF = "<a target='_blank' href='../../".$row_resultado['archivo']."' ><img src='".RUTA_IMG_ICONOS."pdf-16.png'></a>";

		echo "<tr>";
		echo "<td class='text-center'>".$row_resultado['id']."</td>";
		echo "<td class='text-center'><b>".FormatoFecha($explode[0])."</b></td>";
		echo "<td class='text-center'>".$nomencargado."</td>";
		echo "<td class='text-center align-middle' width='20px'>".$imgPDF."</td>";
		echo "</tr>";
		
		}
	}else{
	echo "<tr><td colspan='6' class='text-center'><small>No se encontró información para mostrar</small></td></tr>";
	}
	?>
	</tbody>
</table>
<hr>