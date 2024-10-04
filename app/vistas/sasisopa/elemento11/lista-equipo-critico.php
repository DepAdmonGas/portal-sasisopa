<?php
require('../../../../app/help.php');
?>
<table class="table table-bordered table-striped table-hover table-sm" style="font-size: .9em;" id="table-equipo-critico">
<thead>
<tr class="bg-primary text-white">
<th class="text-center">#</th>	
<th>Nombre equipo</th>
<th>Marca y Modelo</th>
<th>Función</th>
<th>Fecha de instalación</th>
<th>Tiempo de vida</th>
<th class="text-center align-middle" width="35px"><i class="fas fa-ellipsis-v"></i></th>
</tr>
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
<td class="text-center align-middle" width="20px" style="cursor: pointer;">
  <div class="dropdown dropstart">
  <a class="btn btn-sm btn-icon-only text-dropdown-light" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
  <i class="fas fa-ellipsis-v"></i>
  </a>
  <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">
    <a class="dropdown-item" target="_BLANK" href="<?=$manual;?>"><i class="fa-regular fa-file-pdf"></i> Descargar Manual</a>
    <a class="dropdown-item" onclick="ModalEliminar(<?=$id;?>)"><i class="fa-regular fa-trash-can"></i> Eliminar</a>
  </div>
  </div>
  </td>

</tr>
<?php
}
}
?>	
</tbody>
</table>