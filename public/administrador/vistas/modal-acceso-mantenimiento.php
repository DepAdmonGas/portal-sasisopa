<?php
require('../../../app/help.php');

$idEstacion = $_GET['idEstacion'];

$sql_personal = "SELECT * FROM tb_usuarios WHERE id_gas = '".$idEstacion."' AND estatus = 0 ";
$result_personal = mysqli_query($con, $sql_personal);
$numero_personal = mysqli_num_rows($result_personal);

function Puesto($idPuesto, $con){
$sql_puesto = "SELECT tipo_puesto FROM tb_puestos WHERE id = '$idPuesto' ";
$result_puesto = mysqli_query($con, $sql_puesto);
$numero_puesto = mysqli_num_rows($result_puesto);
while($row_puesto = mysqli_fetch_array($result_puesto, MYSQLI_ASSOC)){
$puesto = $row_puesto['tipo_puesto'];
}

return $puesto;
}

?>
<div class="modal-header">
	<h4 class="modal-title">Agregar trabajador autorizado para el Mantenimiento Preventivo y Correctivo</h4>
		<button type="button" class="close" data-dismiss="modal" aria-label="Close">
		<span aria-hidden="true">&times;</span>
		</button>
</div>

<div class="modal-body"> 

<select class="form-control rounded-0" id="idUsuario">
<option value="">Selecciona el usuario</option>
<?php
while($row_personal = mysqli_fetch_array($result_personal, MYSQLI_ASSOC)){
echo "<option value='".$row_personal['id']."'>".$row_personal['nombre']." (".Puesto($row_personal['id_puesto'],$con).")</option>";
}
?>
</select>

</div>

<div class="modal-footer">
<button type="button" class="btn btn-secondary rounded-0" data-dismiss="modal">Cancelar</button>
<button type="button" class="btn btn-primary rounded-0" onclick="FirmaBitacora(<?=$idEstacion;?>, 'MPC')">Guardar</button>
</div>
