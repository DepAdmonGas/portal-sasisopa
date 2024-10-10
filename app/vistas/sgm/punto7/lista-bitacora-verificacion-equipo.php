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
WHERE sgm_programa_anual_calibracion_verificacion.id_estacion = '".$id_estacion."' AND sgm_patrones_instrumentos.categoria = 'Equipo sometido a verificación' AND sgm_programa_anual_calibracion_verificacion.fecha <= '".$fecha_del_dia."' ORDER BY sgm_programa_anual_calibracion_verificacion.fecha DESC";
$result = mysqli_query($con, $sql);
$numero = mysqli_num_rows($result);

if ($numero > 0) {
while($row = mysqli_fetch_array($result, MYSQLI_ASSOC)){

if($row['nombre'] == 'Sensor de nivel y temperatura'){
if($row['estado'] == 0){

$trColor = 'style="background-color: #fbf8ce"';
$Editar = '<a class="dropdown-item" onclick="Editar('.$row['id'].')"><i class="fa-regular fa-pen-to-square"></i> Editar</a>';
$Detalle = '<a class="dropdown-item disabled"><i class="fa-regular fa-eye"></i> Detalle</a>';
$Descargar = '<a class="dropdown-item disabled"><i class="fa-regular fa-file-pdf"></i> Descargar PDF</a>';

}else if($row['estado'] == 1){
$trColor = 'style="background-color: #cffbce"';
$Editar = '<a class="dropdown-item" onclick="Editar('.$row['id'].')"><i class="fa-regular fa-pen-to-square"></i> Editar</a>';
$Detalle = '<a class="dropdown-item" onclick="Detalle('.$row['id'].')"><i class="fa-regular fa-eye"></i> Detalle</a>';
$Descargar = '<a class="dropdown-item" onclick="Descargar('.$row['id'].')"><i class="fa-regular fa-file-pdf"></i> Descargar PDF</a>';
}

}else{

$trColor = 'style="background-color: #fefefe"';
$Editar = '<a class="dropdown-item disabled"><i class="fa-regular fa-pen-to-square"></i> Editar</a>';
$Detalle = '<a class="dropdown-item disabled"><i class="fa-regular fa-eye"></i> Detalle</a>';
$Descargar = '<a class="dropdown-item disabled"><i class="fa-regular fa-file-pdf"></i> Descargar PDF</a>';

}

$contenido .= '<tr '.$trColor.'>
<td>'.$row['nombre'].'</td>
<td>'.$row['periodicidad'].'</td>
<td>'.FormatoFecha($row['fecha']).'</td>';

$contenido .= '<td class="text-center align-middle" width="20px" style="cursor: pointer;">
  <div class="dropdown dropstart">
  <a class="btn btn-sm btn-icon-only text-dropdown-light" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
  <i class="fas fa-ellipsis-v"></i>
  </a>
  <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">
  '.$Editar.'
  '.$Detalle.'
  '.$Descargar.'
  </div>
  </div>
  </td>';

  $contenido .= '</tr>';

}
}else{
$contenido .= '<td colspan="3" class="text-center text-secondary" style="font-size: .8em;"">No se encontró información para mostrar</td>';
}

return $contenido;
}
?>

<table class="table table-bordered table-sm" id="bitacora-verificacion-equipos-medicion">
<thead>
<tr class="bg-primary text-white">
<th>Equipo a calibrar</th>
<th>Periodicidad</th>
<th>Fechas programadas</th>
<th class="text-center align-middle" width="35px"><i class="fas fa-ellipsis-v"></i></th>
</tr>
</thead>
<tbody>
<?php 

echo contenidoTabla($Session_IDEstacion,$year,$con);

?>
</tbody>
</table>