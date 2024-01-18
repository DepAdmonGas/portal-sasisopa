<?php
require('../../app/help.php');

$FechaInicio = date('Y-m-d', $_GET['FechaInicio']);
$FechaTermino = date('Y-m-d', $_GET['FechaTermino']);

$explode = explode("-", $FechaTermino);
$Year = $explode[0];

?>
<h4>7. COMUNICACIÓN, PARTICIPACIÓN Y CONSULTA</h4>
<?php 
$sql1 = "SELECT * FROM se_comunicacion_i_e WHERE id_estacion = '".$Session_IDEstacion."' AND fecha BETWEEN '".$FechaInicio."' AND '".$FechaTermino."' ORDER BY fecha desc";
$result1 = mysqli_query($con, $sql1);
$numero1 = mysqli_num_rows($result1);

$sql2 = "SELECT * FROM se_quejas_sugerencias WHERE id_estacion = '".$Session_IDEstacion."' AND fecha BETWEEN '".$FechaInicio."' AND '".$FechaTermino."' ORDER BY fecha desc ";
$result2 = mysqli_query($con, $sql2);
$numero2 = mysqli_num_rows($result2);

echo '<div class="row">';
echo '<div class="col-9">';
?>
<h6>Registro de la atención y el seguimiento a la comunicación interna y externa. <a class="float-right" href="../../public/reporte-sasisopa/descargar-comunicacion-participacion-consulta-pdf.php?FechaInicio=<?=$_GET['FechaInicio'];?>&FechaTermino=<?=$_GET['FechaTermino'];?>" data-toggle="tooltip" data-placement="left" title="Descargar" >
	<img src="<?php echo RUTA_IMG_ICONOS."pdf.png"; ?>">
	</a>
</h6>
<?php
echo '<table class="table table-bordered table-striped table-sm mb-0 pb-0" style="font-size: .9em;">
<thead> 
<tr class="table-primary">
<th class="text-center align-middle">No.</th>
<th class="text-center align-middle">Fecha</th>
<th class="text-center align-middle">Tema a comunicar</th>
<th class="text-center align-middle">Encargado de la comunicación</th>
<th class="text-center align-middle">Tipo de comunicación</th>
<th class="text-center align-middle">Material utilizado para la comunicación</th>
<th class="text-center align-middle">Seguimiento de la comunicación</th>
<th class="text-center align-middle"></th>
</tr>
</thead>
<tbody>';
if ($numero1 > 0) {
while($row1 = mysqli_fetch_array($result1, MYSQLI_ASSOC)){


$sql_usuario = "SELECT nombre FROM tb_usuarios WHERE id = '".$row1['encargado_comunicacion']."' ";
$result_usuario = mysqli_query($con, $sql_usuario);
while($row_usuario = mysqli_fetch_array($result_usuario, MYSQLI_ASSOC)){
$nomencargado = $row_usuario['nombre'];
}

echo "<tr>
<td class='text-center align-middle'>".$row1['no_comunicacion']."</td>
<td class='text-center align-middle'>".FormatoFecha($row1['fecha'])."</td>
<td class='text-center align-middle'>".substr($row1['tema'],0,60)."</td>
<td class='text-center align-middle'>".$nomencargado."</td>
<td class='text-center align-middle'>".$row1['tipo_comunicacion']."</td>
<td class='text-center align-middle'>".$row1['material']."</td>
<td class='text-center align-middle'>".$row1['seguimiento']."</td>
<td class='text-center align-middle' width='30'><img src='".RUTA_IMG_ICONOS."pdf.png' style='cursor: pointer;' onclick='DescargarComunicacionParticipacion(".$Year.",0,".$row1['id'].")'></td>
</tr>";
}
}else{
echo "<td colspan='8' class='text-center text-secondary' style='font-size: .8em;'>No se encontro comunicacion interna o externa</td>";
}
echo '</tbody></table>';

echo '</div>';
//------------------------------------------
echo '<div class="col-3">';
echo '<h6>Quejas y sugerencias</h6>';

echo '<table class="table table-bordered table-striped table-sm pb-0 mb-0" style="font-size: .9em;">
<thead> 
<tr>
<th class="text-center align-middle">#</th>
<th class="text-center align-middle">Fecha</th>
<th class="text-center align-middle"></th>
</tr>
</thead>
<tbody>';
$num = 1;
if ($numero2 > 0) {
while($row2 = mysqli_fetch_array($result2, MYSQLI_ASSOC)){
$id2 = $row2['id'];

echo "<tr>
<td class='text-center'>".$num."</td>
<td class='text-center'>".FormatoFecha($row2['fecha'])."</td>
<td class='text-center align-middle' width='30'><img src='".RUTA_IMG_ICONOS."pdf.png' style='cursor: pointer;' onclick='DescargarQS(".$id2.")'></td>
</tr>";

$num = $num + 1;
}
}else{
echo "<td colspan='3' class='text-center text-secondary' style='font-size: .8em;'>No se encontró información para mostrar</td>";
}
echo '</tbody></table>';

echo '</div>';
echo '</div>';

?>
<hr>