<?php
require('../../../../app/help.php');
?>
<div style="overflow-y: hidden;">
<table class="table table-bordered table-striped table-hover table-sm mt-3" style="font-size: .9em;">
<thead>
<th class="text-center">#</th>	
<th>Nombre equipo</th>
<th>Marca y Modelo</th>
<th>Función</th>
<th>Fecha de instalación</th>
<th>Tiempo de vida</th>
<th width="16">Manual</th>
<th width="16"><img src="<?=RUTA_IMG_ICONOS;?>eliminar-red-16.png"></th>
</thead>
<tbody>
<?php 
$sql_equipo = "SELECT * FROM tb_equipo_critico WHERE id_estacion = '".$Session_IDEstacion."' AND estado = 1 ORDER BY id_equipo desc";
$result_equipo = mysqli_query($con, $sql_equipo);
$numero_equipo = mysqli_num_rows($result_equipo);
if ($numero_equipo > 0) {
while($row_equipo = mysqli_fetch_array($result_equipo, MYSQLI_ASSOC)){
$id = $row_equipo['id'];
$idequipo = $row_equipo['id_equipo'];
$nombreequipo = $row_equipo['nombre_equipo'];
$marcamodelo = $row_equipo['marca_modelo'];
$funciones = $row_equipo['funciones'];
$fechainstalacion = $row_equipo['fecha_instalacion'];
$tiempovida = $row_equipo['tiempo_vida'];
$manual = $row_equipo['manual'];
?>
<tr>
<td class="align-middle text-center"><?=$idequipo;?></td>
<td class="align-middle"><?=$nombreequipo;?></td>
<td class="align-middle"><?=$marcamodelo;?></td>
<td class="align-middle"><?=$funciones;?></td>
<td class="align-middle"><?=FormatoFecha($fechainstalacion);?></td>
<td class="align-middle"><?=$tiempovida;?> años</td>
<td class="text-center align-middle"><a target="_BLANK" href="<?=$manual;?>"><img width="16px" src="<?=RUTA_IMG_ICONOS;?>pdf-16.png"></a></td>
<td class="text-center align-middle" width="16" style="cursor: pointer" onclick="ModalEliminar(<?=$id;?>)"><a><img src="<?=RUTA_IMG_ICONOS;?>eliminar-red-16.png"></a></td>
</tr>
<?php
}
}else{
echo "<tr><td colspan='8' class='text-center'><small>No se encontró información para mostrar</small></td></tr>";	
}
?>	
</tbody>
</table>
</div>