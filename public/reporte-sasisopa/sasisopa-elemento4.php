<?php
require('../../app/help.php');

$FechaInicio = date('Y-m-d', $_GET['FechaInicio']);
$FechaTermino = date('Y-m-d', $_GET['FechaTermino']);

$sql1 = "SELECT * FROM tb_seguimiento_reporte_indicador WHERE id_estacion = '".$Session_IDEstacion."' AND fecha BETWEEN '".$FechaInicio."' AND '".$FechaTermino."' ORDER BY fecha DESC ";
$result1 = mysqli_query($con, $sql1);
$numero1 = mysqli_num_rows($result1);


?>
<h4>4. OBJETIVOS, METAS E INDICADORES</h4>

<div class="row">
	<div class="col-6">
	<table class="table table-bordered table-striped table-sm"> 
		<tr>
			<td><h6>Seguimiento de objetivos y metas</h6></td>
			<td width="32"><a href="../../public/reporte-sasisopa/seguimiento-objetivos-mestas-pdf.php?FechaInicio=<?=$_GET['FechaInicio'];?>&FechaTermino=<?=$_GET['FechaTermino'];?>" data-toggle="tooltip" data-placement="left" title="Descargar" >
	<img src="<?php echo RUTA_IMG_ICONOS."pdf.png"; ?>">
	</a></td>
		</tr>
	</table>

	</div>
	<div class="col-6">
	<h6>Seguimiento y reporte de indicadores <a class="float-right" href="../../public/reporte-sasisopa/seguimiento-reporte-indicadores-pdf.php?FechaInicio=<?=$_GET['FechaInicio'];?>&FechaTermino=<?=$_GET['FechaTermino'];?>" data-toggle="tooltip" data-placement="left" title="Descargar" >
	<img src="<?php echo RUTA_IMG_ICONOS."pdf.png"; ?>">
	</a></h6>

	<table class="table table-bordered table-striped table-sm">
	<thead>	
	<tr>
	<th class="text-center align-middle">#</th>
	<th class="text-center align-middle">Fecha</th>
	</tr>
	</thead>
	<tbody>
	<?php
	$num = 1;
	if ($numero1 > 0) {
	while($row1 = mysqli_fetch_array($result1, MYSQLI_ASSOC)){
	$id1 = $row1['id'];

	echo "<tr>";
	echo "<td class='text-center'>".$num."</td>";
	echo "<td class='text-center'>".FormatoFecha($row1['fecha'])."</td>";
	echo "</tr>";

	$num = $num + 1;
	}
	}else{
	echo "<td colspan='8' class='text-center text-secondary' style='font-size: .8em;'>No se encontró información para mostrar</td>";

	}
	?>	
	</tbody>
	</table>
	</div>
</div>



<hr>