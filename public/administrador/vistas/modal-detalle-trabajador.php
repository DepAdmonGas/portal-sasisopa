<?php
require('../../../app/help.php');
$idFirma = $_GET['idFirma'];

$sql_usuarios = "SELECT tb_usuarios.id, tb_usuarios.nombre, tb_usuarios.id_puesto, tb_usuarios.id_gas, tb_usuarios_firma_bitacora.id AS idFirma, tb_usuarios_firma_bitacora.categoria, tb_usuarios_firma_bitacora.fechainicio, tb_usuarios_firma_bitacora.fechatermino, tb_usuarios_firma_bitacora.comentario, tb_usuarios_firma_bitacora.estado
FROM tb_usuarios_firma_bitacora
INNER JOIN tb_usuarios on tb_usuarios.id = tb_usuarios_firma_bitacora.id_usuario
 WHERE tb_usuarios_firma_bitacora.id = '".$idFirma."' ";
$result_usuarios = mysqli_query($con, $sql_usuarios);
$numero_usuarios = mysqli_num_rows($result_usuarios);

while($row_usuarios = mysqli_fetch_array($result_usuarios, MYSQLI_ASSOC)){

$idusuario = $row_usuarios['id'];
$nombreusuario = $row_usuarios['nombre'];
$idpuesto = $row_usuarios['id_puesto'];
$comentario = $row_usuarios['comentario'];
$estado = $row_usuarios['estado'];
$categoria = $row_usuarios['categoria'];

$fecha = explode(" ", $row_usuarios['fechainicio']);
$fechaTermino = explode(" ", $row_usuarios['fechatermino']);

$sql_puesto = "SELECT * FROM tb_puestos WHERE id = '$idpuesto' ";
$result_puesto = mysqli_query($con, $sql_puesto);
$numero_puesto = mysqli_num_rows($result_puesto);
while($row_puesto = mysqli_fetch_array($result_puesto, MYSQLI_ASSOC)){
$puesto = $row_puesto['tipo_puesto'];
}

}
?>

<div class="modal-header">
	<h4 class="modal-title">Detalle trabajador autorizado</h4>
		<button type="button" class="close" data-dismiss="modal" aria-label="Close">
		<span aria-hidden="true">&times;</span>
		</button>
</div>

<div class="modal-body"> 

<?php 

if ($categoria == "RDP") {
echo "<label style='font-size: 1.2em;'><b>Recepción y Descarga del Producto</b></label>";
}else if ($categoria == "MPC") {
echo "<label style='font-size: 1.2em;'><b>Mantenimiento Preventivo y Correctivo</b></label>";
}

?>

<div class="row">

	<div class="col-xl-2 col-lg-2 col-md-2 col-12 mb-2">


		<div><small class="text-secondary">ID</small></div>
		<label style="font-size: 1.2em;"><?=$idusuario;?></label>

	</div>

	<div class="col-xl-4 col-lg-4 col-md-4 col-12 mb-2">

		<div><small class="text-secondary">Puesto</small></div>
		<label style="font-size: 1.2em;"><?=$puesto;?></label>

	</div>

	<div class="col-xl-6 col-lg-6 col-md-6 col-12 mb-2">

		<div><small class="text-secondary">Trabajador autorizado</small></div>
		<label style="font-size: 1.2em;"><?=$nombreusuario;?></label>

	</div>


</div>

<hr>


<div class="row">

	<div class="col-xl-12 col-lg-12 col-md-12 col-12">
		<div>
			<small class="text-secondary">
			Fecha alta
		</small>
	</div>

		<label style="font-size: 1.2em;"><?=FormatoFecha($fecha[0]);?></label>
	</div>
</div>

<hr>

<?php
if ($estado == 1) {
?>

<label style="font-size: 1.2em;" class="text-info text-center">Eliminar autorización del trabajador</label>

<div><small class="text-secondary">* Comentario:</small></div>

<textarea class="form-control rounded-0 mt-2" id="Comentarios"></textarea>


<hr>

<div class="text-right mt-2">
<button type="button" class="btn btn-primary rounded-0" onclick="EliminarAutorizacion(<?=$idFirma;?>)">Eliminar</button>
</div>

<?php
}else{
?>
<label style="font-size: 1.2em;" class="text-info">Trabajador eliminado</label>
<div class="row">
	<div class="col-8">
	<div><small class="text-secondary">Comentario:</small></div>
	<div class="border p-2 mt-2">
		<?=$comentario;?>
	</div>
	</div>
	<div class="col-xl-4 col-lg-4 col-md-12 col-sm-12 mt-2 mb-2">

		<div><small class="text-secondary">Fecha baja:</small></div>
		<label style="font-size: 1.2em;"><?=FormatoFecha($fechaTermino[0]);?></label>

	</div>


<div class="row">

<?php	
}
?>


</div>

