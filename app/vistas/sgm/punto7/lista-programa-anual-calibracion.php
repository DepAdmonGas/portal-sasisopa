<?php
require('../../../../app/help.php');

$year = $_GET['year'];
$formato = $_GET['formato'];

function detalleEquipo($id, $con){

$sql = "SELECT * FROM sgm_inventario_equipo WHERE id = '".$id."' ";
$result = mysqli_query($con, $sql);
$numero = mysqli_num_rows($result);
$row = mysqli_fetch_array($result, MYSQLI_ASSOC);
return $row['identificacion'];
}

function contenidoTabla($id_estacion,$year,$categoria,$con){

$contenido = '';

$sql = "SELECT 
sgm_programa_anual_calibracion_verificacion.id,
sgm_programa_anual_calibracion_verificacion.fecha,
sgm_programa_anual_calibracion_verificacion.id_verificar,
sgm_patrones_instrumentos.nombre,
sgm_patrones_instrumentos.periodicidad,
sgm_patrones_instrumentos.categoria
FROM sgm_programa_anual_calibracion_verificacion
INNER JOIN sgm_patrones_instrumentos 
ON sgm_programa_anual_calibracion_verificacion.id_equipo = sgm_patrones_instrumentos.id 
WHERE sgm_programa_anual_calibracion_verificacion.id_estacion = '".$id_estacion."' AND YEAR(fecha) = '".$year."' AND sgm_patrones_instrumentos.categoria = '".$categoria."' ORDER BY sgm_programa_anual_calibracion_verificacion.fecha ASC";
$result = mysqli_query($con, $sql);
$numero = mysqli_num_rows($result);

$contenido .= '<tr class="table-secondary">
<td><b>'.$categoria.'</b></td>
<td><b>Periodicidad</b></td>
<td><b>Fechas programadas</b></td>';
$contenido .= '<td></td>';
$contenido .= '</tr>';

if ($numero > 0) {
$detalle_equipo = '';
while($row = mysqli_fetch_array($result, MYSQLI_ASSOC)){

if($row['id_verificar'] != 0){
$detalle_equipo = ' '.detalleEquipo($row['id_verificar'], $con);
}

$contenido .= '<tr>
<td>'.$row['nombre'].$detalle_equipo.'</td>
<td>'.$row['periodicidad'].'</td>
<td>'.FormatoFecha($row['fecha']).'</td>
<td class="text-center align-middle" width="30"><img src="'.RUTA_IMG_ICONOS.'eliminar.png"  style="cursor: pointer;" onclick="Eliminar('.$row['id'].','.$year.')"></td>
</tr>';

}
}else{
$contenido .= '<td colspan="4" class="text-center text-secondary" style="font-size: .8em;"">No se encontró información para mostrar</td>';
}


return $contenido;
}
?>

    <div class="text-end">
    <a class="me-1" onclick="DescargarProgramaAnual(<?=$year;?>,<?=$formato;?>)" style="cursor: pointer;"><img src="<?php echo RUTA_IMG_ICONOS."pdf.png"; ?>"></a> 
    </div>

<table class="table table-bordered table-sm mb-0 pb-0 mt-2">
<tbody>
<?php 
if($formato == 14){

echo contenidoTabla($Session_IDEstacion,$year,'Instrumentos de medida',$con);
echo contenidoTabla($Session_IDEstacion,$year,'Patrones de medida',$con);

}else if($formato == 15){

echo contenidoTabla($Session_IDEstacion,$year,'Equipo sometido a verificación',$con);

}

?>
</tbody>
</table>