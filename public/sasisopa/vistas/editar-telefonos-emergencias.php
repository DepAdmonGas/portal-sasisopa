<?php
require('../../../app/help.php');

$idTelefono = $_GET['id'];

$sql_telefono = "SELECT * FROM tb_telefonos_emergencias WHERE id = '".$idTelefono."' ";
$result_telefono = mysqli_query($con, $sql_telefono);
$numero_telefono = mysqli_num_rows($result_telefono);
while($row_telefono = mysqli_fetch_array($result_telefono, MYSQLI_ASSOC)){
$titulo = $row_telefono['titulo'];
$telefono = $row_telefono['telefono'];
}

?>
<div class="modal-header">
<h4 class="modal-title">Editar teléfono de emergencia</h4>
<button type="button" class="close" data-dismiss="modal" aria-label="Close">
<span aria-hidden="true">&times;</span>
</div>
<div class="modal-body">

<div class="mb-2"><small class="text-secondary">* Servicio de emergencias:</small></div>
<textarea class="form-control rounded-0" id="EditTitulo"><?=$titulo;?></textarea>


<div class="mb-2 mt-2"><small class="text-secondary">* Teléfono:</small></div>
<input type="text" class="form-control rounded-0" id="EditTelefono" value="<?=$telefono;?>">

<hr>

<div class="text-right">
	<button type="button" class="btn btn-secondary rounded-0" onclick="BtnCancelar()">Cancelar</button>
<button type="button" class="btn btn-primary rounded-0" onclick="BtnActTelefono(<?=$idTelefono;?>)">Actualizar</button>
</div>

</div>