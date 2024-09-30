<?php
require('../../../../app/help.php');

$year = $_GET['year'];

function contenidoTabla($id_estacion,$year,$con){

date_default_timezone_set('America/Mexico_City');
$fecha_del_dia = date("Y-m-d");
$contenido = '';

$sql = "SELECT 
sgm_programa_anual_calibracion_verificacion.id,
sgm_programa_anual_calibracion_verificacion.fecha,
sgm_programa_anual_calibracion_verificacion.estado,
sgm_patrones_instrumentos.nombre,
sgm_patrones_instrumentos.periodicidad,
sgm_patrones_instrumentos.categoria
FROM sgm_programa_anual_calibracion_verificacion
INNER JOIN sgm_patrones_instrumentos 
ON sgm_programa_anual_calibracion_verificacion.id_equipo = sgm_patrones_instrumentos.id 
WHERE sgm_programa_anual_calibracion_verificacion.id_estacion = '".$id_estacion."' AND sgm_patrones_instrumentos.categoria <> 'Equipo sometido a verificación' AND sgm_programa_anual_calibracion_verificacion.fecha <= '".$fecha_del_dia."' ORDER BY sgm_programa_anual_calibracion_verificacion.fecha DESC";
$result = mysqli_query($con, $sql);
$numero = mysqli_num_rows($result);

if ($numero > 0) {
while($row = mysqli_fetch_array($result, MYSQLI_ASSOC)){

if($row['estado'] == 0){
$trColor = 'table-warning';
$Editar = '<img src="'.RUTA_IMG_ICONOS.'editar.png" style="cursor: pointer;" onclick="Editar('.$row['id'].')">';
$Detalle = '<img class="grayscale" src="'.RUTA_IMG_ICONOS.'ojo.png">';
$pdf = '<img class="grayscale" src="'.RUTA_IMG_ICONOS.'pdf.png">';
}else if($row['estado'] == 1){
$trColor = 'table-success';
$Editar = '<img class="grayscale" src="'.RUTA_IMG_ICONOS.'editar.png" onclick="Editar('.$row['id'].')">';
$Detalle = '<img src="'.RUTA_IMG_ICONOS.'ojo.png" style="cursor: pointer;" onclick="Detalle('.$row['id'].')">';
$pdf = '<img src="'.RUTA_IMG_ICONOS.'pdf.png" style="cursor: pointer;" onclick="Descargar('.$row['id'].')">';
}

$contenido .= '<tr class="'.$trColor.'">
<td>'.$row['nombre'].'</td>
<td>'.$row['periodicidad'].'</td>
<td>'.FormatoFecha($row['fecha']).'</td>
<td class="text-center align-middle" width="30">'.$Editar.'</td>
<td class="text-center align-middle" width="30">'.$Detalle.'</td>
<td class="text-center align-middle" width="30">'.$pdf.'</td>
</tr>';

}
}else{
$contenido .= '<td colspan="3" class="text-center text-secondary" style="font-size: .8em;"">No se encontró información para mostrar</td>';
}

return $contenido;
}
?>

<table class="table table-bordered table-sm mb-0 pb-0 mt-2">
<thead>
<tr class="bg-primary text-white">
<th>Equipo a calibrar</th>
<th>Periodicidad</th>
<th>Fechas programadas</th>
<th></th>
<th></th>
<th></th>
</tr>
</thead>
<tbody>
<?php 

echo contenidoTabla($Session_IDEstacion,$year,$con);

?>
</tbody>
</table>