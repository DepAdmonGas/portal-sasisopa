<?php
require('../../../app/help.php');

$selyear = date("Y");
$selmes = date("m");

$sql_lista = "SELECT 
tb_dispensarios_apertura_bitacora.id,
tb_dispensarios.id_estacion, 
tb_dispensarios.no_dispensario,
tb_dispensarios.marca,
tb_dispensarios.modelo,
tb_dispensarios.serie,
tb_dispensarios_apertura_bitacora.fecha,
tb_dispensarios_apertura_bitacora.hora_inicio,
tb_dispensarios_apertura_bitacora.hora_termino,
tb_dispensarios_apertura_bitacora.lado,
tb_dispensarios_apertura_bitacora.producto,
tb_dispensarios_apertura_bitacora.clave,
tb_dispensarios_apertura_bitacora.motivo,
tb_usuarios.nombre,
tb_dispensarios_apertura_bitacora.detalle
FROM tb_dispensarios_apertura_bitacora 
INNER JOIN tb_dispensarios 
ON tb_dispensarios_apertura_bitacora.id_dispensario = tb_dispensarios.id 
INNER JOIN tb_usuarios
ON tb_dispensarios_apertura_bitacora.responsable = tb_usuarios.id
WHERE tb_dispensarios.id_estacion = '".$Session_IDEstacion."' ORDER BY tb_dispensarios_apertura_bitacora.fecha desc , tb_dispensarios_apertura_bitacora.hora_inicio desc LIMIT 1000";
$result_lista = mysqli_query($con, $sql_lista);
$numero_lista = mysqli_num_rows($result_lista);
?>

<div class="mb-2" style="overflow-y: hidden;">
<table class="table table-bordered table-striped table-sm">
<thead>	
<tr>
<th class="text-center align-middle">Fecha</th>
<th class="text-center align-middle">Hora inicio</th>
<th class="text-center align-middle">Hora termino</th>
<th class="text-center align-middle">Dispensario</th>
<th class="text-center align-middle">Marca</th>
<th class="text-center align-middle">Modelo</th>
<th class="text-center align-middle">Serie</th>
<th class="text-center align-middle">Lado</th>
<th class="text-center align-middle">Producto</th>
<th class="text-center align-middle">Motivo</th>
<th class="text-center align-middle">Responsable</th>
<th class="text-center align-middle">Detalle</th>
<th class="text-center align-middle"></th>
</tr>
</thead>
<tbody>
<?php
$num = 1;
if ($numero_lista > 0) {
while($row_lista = mysqli_fetch_array($result_lista, MYSQLI_ASSOC)){
$id = $row_lista['id'];

if($row_lista['hora_termino'] == '00:00:00'){
$HoraTermino = 'S/I';
}else{
$HoraTermino = date('h:i a', strtotime($row_lista['hora_termino']));
}

echo '<tr>';
echo '<td class="text-center align-middle" onclick="detalle('.$id.')">'.FormatoFecha($row_lista['fecha']).'</td>';
echo '<td class="text-center align-middle" onclick="detalle('.$id.')">'.date('h:i a', strtotime($row_lista['hora_inicio'])).'</td>';
echo '<td class="text-center align-middle" onclick="detalle('.$id.')">'.$HoraTermino.'</td>';
echo '<td class="text-center align-middle" onclick="detalle('.$id.')">'.$row_lista['no_dispensario'].'</td>';
echo '<td class="text-center align-middle" onclick="detalle('.$id.')">'.$row_lista['marca'].'</td>';
echo '<td class="text-center align-middle" onclick="detalle('.$id.')">'.$row_lista['modelo'].'</td>';
echo '<td class="text-center align-middle" onclick="detalle('.$id.')">'.$row_lista['serie'].'</td>';
echo '<td class="text-center align-middle" onclick="detalle('.$id.')">'.$row_lista['lado'].'</td>';
echo '<td class="text-center align-middle" onclick="detalle('.$id.')">'.$row_lista['producto'].'</td>';
echo '<td class="text-center align-middle" onclick="detalle('.$id.')"><b>'.$row_lista['clave'].'</b> ('.$row_lista['motivo'].')</td>';
echo '<td class="text-center align-middle" onclick="detalle('.$id.')">'.$row_lista['nombre'].'</td>';
echo '<td class="text-center align-middle" onclick="detalle('.$id.')">'.$row_lista['detalle'].'</td>';
echo "<td class='text-center align-middle'width='20px' style='cursor: pointer;'><img src='".RUTA_IMG_ICONOS."eliminar.png' onclick='Eliminar(".$id.")'></td>";
echo '</tr>';

}
}else{
echo "<tr><td colspan='13' class='text-center text-secondary' style='font-size: .8em;'>No se encontró información para mostrar</td></tr>";
}
?>
</tbody>
</table>
</div>