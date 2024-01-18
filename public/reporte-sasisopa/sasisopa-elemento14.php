<?php
require('../../app/help.php');

$FechaInicio = date('Y-m-d', $_GET['FechaInicio']);
$FechaTermino = date('Y-m-d', $_GET['FechaTermino']);

$Explode = explode("-", $FechaTermino);
$fecha_year = $Explode[0];

$sql_resultado = "SELECT * FROM tb_informe_revision_resultados WHERE id_estacion = '".$Session_IDEstacion."' AND fecha BETWEEN '".$FechaInicio."' AND '".$FechaTermino."' ORDER BY fecha desc";
$result_resultado = mysqli_query($con, $sql_resultado);
$numero_resultado = mysqli_num_rows($result_resultado);

$sql = "SELECT * FROM tb_atencion_hallazgos WHERE id_estacion = '".$Session_IDEstacion."' AND fecha_auditoria BETWEEN '".$FechaInicio."' AND '".$FechaTermino."' ORDER BY id DESC ";
$result = mysqli_query($con, $sql);
$numero = mysqli_num_rows($result);


function Evidencias($id, $con){

$sqlAH = "SELECT * FROM tb_atencion_hallazgos_evidencia WHERE id_atencion = '".$id."'";
$resultAH = mysqli_query($con, $sqlAH);
$numeroAH = mysqli_num_rows($resultAH);
while($rowAH = mysqli_fetch_array($resultAH, MYSQLI_ASSOC)){

$Result .= "<div><a href='".RUTA_ARCHIVOS."atencion-hallazgos/".$rowAH['archivo']."' download><small>".$rowAH['archivo']."</small></a></div>";
}

return $Result;
}
?>
<h4>14. MONITOREO, VERIFICACIÓN Y EVALUACIÓN</h4>

<table class="table table-bordered table-striped table-sm table-hover mt-2">
<tr>
<td>
      <h6>Resumen de revisión de resultados <?=$fecha_year;?></h6>
</td>
<td width="32"><a onclick="DescargarRRR(<?=$fecha_year;?>)" style="cursor: pointer;"><img src="<?php echo RUTA_IMG_ICONOS."pdf.png"; ?>"></a></td>
</tr>
</table>

<table class="table table-bordered table-striped table-sm table-hover mt-2">
<tr>
<td>
      <h6>Programa de implementación del Sistema de Administración</h6>
</td>
<td width="32"><a onclick="DescargarPI()" style="cursor: pointer;"><img src="<?php echo RUTA_IMG_ICONOS."pdf.png"; ?>"></a></td>
</tr>
</table>

<h5>Calibración, Verificación y mantenimiento de equipos</h5>

<table class="table table-bordered table-striped table-sm table-hover mt-2">
<tr>
<td>
<h6>Equipos sometidos a calibración</h6>
</td>
<td width="32"><a onclick="DescargarESC()" style="cursor: pointer;"><img src="<?php echo RUTA_IMG_ICONOS."pdf.png"; ?>"></a></td>
</tr>
<tr>
<td>
<h6>Calendario de calibraciones</h6>
</td>
<td width="32"><a href="../../public/reporte-sasisopa/descargar-calendario-calibracion-pdf.php?Year=<?=$fecha_year;?>" style="cursor: pointer;"><img src="<?php echo RUTA_IMG_ICONOS."pdf.png"; ?>"></a></td>
</tr>
</table>

<h5>Evaluación y cumplimiento de requisitos legales</h5>

<table class="table table-bordered table-striped table-sm table-hover mt-2">
<tr>
<td>
<h6>Matriz de evaluación del cumplimiento legal</h6>
</td>
<td width="32"><a href="../../public/reporte-sasisopa/descargar-evaluacion-cumplimiento-legal-pdf.php?FechaInicio=<?=$_GET['FechaInicio'];?>&FechaTermino=<?=$_GET['FechaTermino'];?>" style="cursor: pointer;"><img src="<?php echo RUTA_IMG_ICONOS."pdf.png"; ?>"></a></td>
</tr>
</table>

<h5>Informe de revisión de resultados</h5>
<table class="table table-bordered table-striped table-sm table-hover mt-2">
	<thead>
		<tr>
			<th class="align-middle text-center">#</th>
			<th class="align-middle text-center">Fecha</th>
			<th class="align-middle text-center" width="20px"></th>
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
		echo "</tr>";

		$i++;
		
	}
	}else{
	echo "<tr><td colspan='5' class='text-center'><small>No se encontró información para mostrar</small></td></tr>";
	}
	?>
	</tbody>
</table>

<h5>Administración de hallazgos derivados del monitoreo del sistema de administración</h5>

<table class="table table-bordered table-striped table-sm">
<thead>	
<tr>
<th class="text-center align-middle">#</th>
<th class="text-center align-middle">Fecha de la auditoria</th>
<th class="text-center align-middle">No de control de la auditoria</th>
<th class="text-center align-middle">Tipo de auditoria</th>
<th class="text-center align-middle"></th>
</tr>
</thead>
<tbody>
<?php 
if ($numero > 0) {
while($row = mysqli_fetch_array($result, MYSQLI_ASSOC)){

$id = $row['id'];
$fechaauditoria = $row['fecha_auditoria'];
$nocontrol = $row['no_control'];
$tipoauditoria = $row['tipo_auditoria'];

echo "<tr>";
echo '<td class="text-center align-middle"><b>'.$row['folio'].'</b></td>
<td class="text-center align-middle">'.FormatoFecha($fechaauditoria).'</td>
<td class="text-center align-middle">'.$nocontrol.'</td>
<td class="text-center align-middle">'.$tipoauditoria.'</td>
<td class="text-center align-middle" width="30"><img src="'.RUTA_IMG_ICONOS.'pdf.png" onclick="Descargar('.$id.')"></td>';
echo "</tr>";
}
}else{
echo "<td colspan='7' class='text-center text-secondary' style='font-size: .8em;'>No se encontró información para mostrar</td>";
}
?>
</tbody>
</table>
<hr>