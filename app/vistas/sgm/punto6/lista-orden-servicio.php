<?php
require('../../../../app/help.php');

$sql = "SELECT * FROM sgm_orden_servicio WHERE id_estacion = '".$Session_IDEstacion."' ";
$result = mysqli_query($con, $sql);
$numero = mysqli_num_rows($result);

function validaEvaluacion($idRegistro,$con){
$sql = "SELECT id,estado FROM sgm_evaluacion_proveedores WHERE id_orden_servicio = '".$idRegistro."' ";
$result = mysqli_query($con, $sql);
$numero = mysqli_num_rows($result);
if ($numero > 0) {
$row = mysqli_fetch_array($result, MYSQLI_ASSOC);
$return = $row['estado'];	
}else{
$return = 0;	
}
return $return;
}
?>

<table class="table table-bordered table-striped table-hover table-sm mb-0 pb-0">
<thead>
<tr>
  <th class="text-center align-middle">#</th>
  <th class="text-center align-middle">Fecha</th>
  <th class="text-center align-middle">Hora</th>
  <th class="text-center align-middle">Descripción detallada del servicio equipo que requiere</th>
  <th class="text-center align-middle" colspan="3">Fo.SGM.012 Orden de servicio</th>
  <th class="text-center align-middle" colspan="3">Fo.SGM.013 Evaluación de proveedores</th>
  <th class="text-center align-middle" width="32px"></th>
</tr>
</thead>
<tbody>
<?php
$num = 1;
if ($numero > 0) {
while($row = mysqli_fetch_array($result, MYSQLI_ASSOC)){

	if($row['fecha'] == '0000-00-00'){
		$fecha = '';
	}else{
		$fecha = FormatoFecha($row['fecha']);
	}

	$valida = validaEvaluacion($row['id'],$con);

	if($valida == 1){
		$detalle = "<img src='".RUTA_IMG_ICONOS."documento.png' style='cursor: pointer;' onclick='DetalleEvaluacion(".$row['id'].")'>";
		$pdf = "<img src='".RUTA_IMG_ICONOS."pdf.png' style='cursor: pointer;' onclick='DescargarEvaluacion(".$row['id'].")'>";
	}else if($valida == 0){
		$detalle = "<img src='".RUTA_IMG_ICONOS."img-no-24.png'>";
		$pdf = "<img src='".RUTA_IMG_ICONOS."img-no-24.png'>";
	}

echo "<tr>";
echo "<td class='text-center align-middle'>".$num."</td>";

echo "<td class='text-center align-middle'>".$fecha."</td>";
echo "<td class='text-center align-middle'>".$row['hora']."</td>";
echo "<td class='text-center align-middle'>".$row['descripcion']."</td>";

 
echo "<td class='text-center align-middle' width='70'><img src='".RUTA_IMG_ICONOS."editar.png' style='cursor: pointer;' onclick='modalAgregarOrden(".$row['id'].",".$row['folio'].")'></td>";
echo "<td class='text-center align-middle' width='70'><img src='".RUTA_IMG_ICONOS."documento.png' style='cursor: pointer;' onclick='DetalleOrden(".$row['id'].")'></td>";
echo "<td class='text-center align-middle' width='70'><img src='".RUTA_IMG_ICONOS."pdf.png' style='cursor: pointer;' onclick='DescargarOrden(".$row['id'].")'></td>";

echo "<td class='text-center align-middle' width='70'><img src='".RUTA_IMG_ICONOS."editar.png' style='cursor: pointer;' onclick='ModalEditarEvaluacion(".$row['id'].")'></td>";
echo "<td class='text-center align-middle' width='70'>".$detalle."</td>";
echo "<td class='text-center align-middle' width='70'>".$pdf."</td>";
echo "<td class='text-center align-middle' width='30'><img src='".RUTA_IMG_ICONOS."eliminar.png' style='cursor: pointer;' onclick='Eliminar(".$row['id'].")'></td>";
echo "</tr>";

$num++;
}
}else{
echo "<td colspan='11' class='text-center text-secondary' style='font-size: .8em;'>No se encontró información para mostrar</td>";
}
?>
</tbody>
</table>


