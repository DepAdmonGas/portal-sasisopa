<?php
require('../../../../app/help.php');

$sql_telefono = "SELECT * FROM tb_telefonos_emergencias WHERE id_estacion = '".$Session_IDEstacion."' AND prioridad = 0";
$result_telefono = mysqli_query($con, $sql_telefono);
$numero_telefono = mysqli_num_rows($result_telefono);

$sql_telefono1 = "SELECT * FROM tb_telefonos_emergencias WHERE id_estacion = '".$Session_IDEstacion."' AND prioridad = 1";
$result_telefono1 = mysqli_query($con, $sql_telefono1);
$numero_telefono1 = mysqli_num_rows($result_telefono1)

?> 
<div class="modal-header rounded-0 head-modal">
<h4 class="modal-title text-white">Teléfonos de emergencias</h4>
<button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
</div>
<div class="modal-body">

<div class="text-end mb-2">
<button type="button" class="btn btn-success btn-sm rounded-0" onclick="BtnNewTelefono()">Nuevo teléfono</button>
<hr>
</div>

<div class="row mt-2">
<?php
while($row_telefono1 = mysqli_fetch_array($result_telefono1, MYSQLI_ASSOC)){
$id = $row_telefono1['id'];

if ($row_telefono1['telefono'] == "") {
$telefono = "S/T";
}else{
$telefono = $row_telefono1['telefono'];
}


echo "<div class='col-xl-4 col-lg-4 col-md-12 col-sm-12 mb-3'>
<div class='border border-danger p-2'>
<div class='text-end'><img src='".RUTA_IMG_ICONOS."edit-black-16.png' style='cursor: pointer;' onclick='editartelefono(".$id.")'></div>
<div class='text-center font-weight-bold'>".$row_telefono1['titulo']."</div>
<div class='text-center'>".$telefono."</div>
</div>
</div>";	
}
?>
</div>

<table class="table table-bordered table-striped table-hover table-sm mt-2">
<thead>
<tr class="bg-primary text-white">
<th>Servicio de emergencia</th>
<th class="text-center">Teléfono</th>
<th class="align-middle" width="20px"><i class="fa-regular fa-pen-to-square"></i></th>
<th class="align-middle" width="20px"><i class="fa-regular fa-trash-can"></i></th>
</tr>
</thead>	
<tbody>
<?php
if ($numero_telefono > 0) {
while($row_telefono = mysqli_fetch_array($result_telefono, MYSQLI_ASSOC)){
$id = $row_telefono['id'];
if ($row_telefono['telefono'] == "") {
$telefono = "S/T";
}else{
$telefono = $row_telefono['telefono'];
}

echo "<tr>";
echo "<td>".$row_telefono['titulo']."</td>";
echo "<td class='text-center'>".$telefono."</td>";
echo "<td class='text-center align-middle' width='20px' style='cursor: pointer;'><a onclick='editartelefono(".$id.")'><i class='fa-regular fa-pen-to-square'></i></i></a></td>";
echo "<td class='text-center align-middle' width='20px' style='cursor: pointer;'><a onclick='eliminartelefono(".$id.")'><i class='fa-regular fa-trash-can'></i></a></td>";


echo "</tr>";
}
}else{
echo "<tr><td colspan='4' class='text-center'><small>No se encontró información para mostrar</small></td></tr>";	
}
?>
</tbody>
</table>

</div>