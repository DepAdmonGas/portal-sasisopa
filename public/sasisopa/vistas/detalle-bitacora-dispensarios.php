<?php
require('../../../app/help.php');

$sql_lista = "SELECT 
tb_dispensarios_apertura_bitacora.id,
tb_dispensarios.id_estacion, 
tb_dispensarios.marca,
tb_dispensarios.modelo,
tb_dispensarios.serie,
tb_dispensarios_apertura_bitacora.fecha,
tb_dispensarios_apertura_bitacora.hora_inicio,
tb_dispensarios_apertura_bitacora.hora_termino,
tb_dispensarios_apertura_bitacora.lado,
tb_dispensarios_apertura_bitacora.producto,
tb_dispensarios_apertura_bitacora.motivo,
tb_dispensarios_apertura_bitacora.detalle,
tb_usuarios.nombre
FROM tb_dispensarios_apertura_bitacora 
INNER JOIN tb_dispensarios 
ON tb_dispensarios_apertura_bitacora.id_dispensario = tb_dispensarios.id 
INNER JOIN tb_usuarios
ON tb_dispensarios_apertura_bitacora.responsable = tb_usuarios.id
WHERE tb_dispensarios_apertura_bitacora.id = '".$_GET['id']."' ";
$result_lista = mysqli_query($con, $sql_lista);
$numero_lista = mysqli_num_rows($result_lista);
while($row_lista = mysqli_fetch_array($result_lista, MYSQLI_ASSOC)){

$id = $row_lista['id'];
$fecha = $row_lista['fecha'];
$horainicio = $row_lista['hora_inicio'];
$horatermino = $row_lista['hora_termino'];
$lado = $row_lista['lado'];
$marca = $row_lista['marca'];
$modelo = $row_lista['modelo'];
$serie = $row_lista['serie'];
$producto = $row_lista['producto'];
$motivo = $row_lista['motivo'];
$nombre = $row_lista['nombre'];
$detalle = $row_lista['detalle'];

if($row_lista['hora_termino'] == '00:00:00'){
$HoraTermino = 'S/I';
}else{
$HoraTermino = date('h:i a', strtotime($row_lista['hora_termino']));
}

}

?>

<div class="modal-header">
<h4 class="modal-title"><?=$id;?></h4>
<button type="button" class="close" data-dismiss="modal" aria-label="Close">
<span aria-hidden="true">&times;</span>
</button>
</div>
<div class="modal-body">
<table class="table table-bordered table-sm pb-0 mb-0 mt-2">
<thead>	
<tr>
<th class="text-center align-middle bg-light">Fecha</th>
<th class="text-center align-middle bg-light">Hora inicio</th>
<th class="text-center align-middle bg-light">Hora termino</th>
<th class="text-center align-middle bg-light">Responsable</th>
</tr>
</thead>
<tbody>
<tr>
	<td class="text-center"><?=FormatoFecha($fecha);?></td>
	<td class="text-center"><?=date('h:i a', strtotime($horainicio));?></td>
	<td class="text-center"><?=$HoraTermino;?></td>
	<td class="text-center"><?=$nombre;?></td>
</tr>
</tbody>
</table>

<table class="table table-bordered table-sm pb-0 mb-0">
<thead>	
<tr>
<th class="text-center align-middle bg-light">Marca</th>
<th class="text-center align-middle bg-light">Modelo</th>
<th class="text-center align-middle bg-light">Serie</th>
<th class="text-center align-middle bg-light">Lado</th>
<th class="text-center align-middle bg-light">Producto</th>
</tr>
</thead>
<tbody>
<tr>
	<td class="text-center"><?=$marca;?></td>
	<td class="text-center"><?=$modelo;?></td>
	<td class="text-center"><?=$serie;?></td>
	<td class="text-center"><?=$lado;?></td>
	<td class="text-center"><?=$producto;?></td>
</tr>
</tbody>
</table>

<table class="table table-bordered table-sm pb-0 mb-0">
<thead>	
<tr>
<th class="align-middle bg-light">Motivo</th>
</tr>
</thead>
<tbody>
<tr>
	<td><?=$motivo;?></td>
</tr>
</tbody>
</table>

<table class="table table-bordered table-sm">
<thead>	
<tr>
<th class="align-middle bg-light">Detalle</th>
</tr>
</thead>
<tbody>
<tr>
	<td><?=$detalle;?></td>
</tr>
</tbody>
</table>

<?php

if($estado == 1){

echo '<div class="text-right"><button type="button" class="btn btn-danger bordered-0 rounded-0" onclick="BtbCancelar('.$_GET['id'].')">Cancelar</button></div>';

}

?>

</div>