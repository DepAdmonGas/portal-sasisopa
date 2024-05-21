<?php
require('../../../../app/help.php');


$sql_personal = "SELECT tb_usuarios.id, tb_usuarios.nombre, tb_puestos.tipo_puesto
FROM tb_usuarios 
INNER JOIN tb_puestos ON tb_usuarios.id_puesto = tb_puestos.id 
WHERE tb_usuarios.id_gas = '".$Session_IDEstacion."' AND tb_usuarios.estatus = 0 ";
$result_personal = mysqli_query($con, $sql_personal);
$numero_personal = mysqli_num_rows($result_personal);

?>
<div class="modal-header">
<h4 class="modal-title">Agregar trabajador autorizado para la Recepción y Descarga del Producto</h4>
<button type="button" class="close" data-dismiss="modal" aria-label="Close">
<span aria-hidden="true">&times;</span>
</button>
</div>

<div class="modal-body">
<select class="form-control rounded-0" id="idUsuario">
<option value="">Selecciona el usuario</option>
<?php
while($row_personal = mysqli_fetch_array($result_personal, MYSQLI_ASSOC)){
echo "<option value='".$row_personal['id']."'>".$row_personal['nombre']." (".$row_personal['tipo_puesto'].")</option>";
}
?>
</select>
</div>

<div class="modal-footer">
<button type="button" class="btn btn-secondary rounded-0" data-dismiss="modal">Cancelar</button>
<button type="button" class="btn btn-primary rounded-0" onclick="FirmaBitacora('RDP')">Guardar</button>
</div>