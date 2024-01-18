<?php
require('../../../app/help.php');
 
$idFirma = $_GET['idFirma'];

$sql_usuarios = "SELECT tb_usuarios.id, tb_usuarios.nombre, tb_usuarios.id_puesto, tb_usuarios.id_gas, tb_usuarios_firma_bitacora.id AS idFirma, tb_usuarios_firma_bitacora.categoria, tb_usuarios_firma_bitacora.fechainicio, tb_usuarios_firma_bitacora.fechatermino, tb_usuarios_firma_bitacora.comentario, tb_usuarios_firma_bitacora.estado
FROM tb_usuarios_firma_bitacora
INNER JOIN tb_usuarios on tb_usuarios.id = tb_usuarios_firma_bitacora.id_usuario WHERE tb_usuarios_firma_bitacora.id = '".$idFirma."' ";
$result_usuarios = mysqli_query($con, $sql_usuarios);
$numero_usuarios = mysqli_num_rows($result_usuarios);

while($row_usuarios = mysqli_fetch_array($result_usuarios, MYSQLI_ASSOC)){
$idFirma = $row_usuarios['idFirma'];
$idusuario = $row_usuarios['id'];
$nombreusuario = $row_usuarios['nombre'];
$idpuesto = $row_usuarios['id_puesto'];
$estado = $row_usuarios['estado'];


$fechainicio = explode(" ", $row_usuarios['fechainicio']);
$fechabaja = explode(" ", $row_usuarios['fechatermino']);


$sql_puesto = "SELECT * FROM tb_puestos WHERE id = '$idpuesto' ";
$result_puesto = mysqli_query($con, $sql_puesto);
$numero_puesto = mysqli_num_rows($result_puesto);
while($row_puesto = mysqli_fetch_array($result_puesto, MYSQLI_ASSOC)){
$puesto = $row_puesto['tipo_puesto'];
}

if ($estado == 0) {
$TxtFechaBaja = FormatoFecha($fechabaja[0]);

$EstadoPermiso = "<div><small>Estado: </small></div><div style='font-size: 1.2em'><b>Eliminado</b></div>";

if ($row_usuarios['comentario'] != "") {
$comentario = $row_usuarios['comentario'];
}else{
$comentario = "No se encontro comentario.";	
}

$EliminarCoemtario = "<div>
<small>Comentario:</small></div>
					<div class='p-2 border mt-2' style='font-size: 1.2em'>".$comentario."</div>";

}else{
$TxtFechaBaja = "S/I";

$EstadoPermiso = "<div>
<small>Estado: </small>
</div>

<div style='font-size: 1.2em'>
<b>Activo</b>
</div>";

$EliminarCoemtario = "<div class='mb-2' style='font-size: 1.2em;text-align: center;'><b>Eliminar autorización del trabajador</b></div>
<hr>
<div><small>* Comentario: </small></div>
<textarea class='form-control rounded-0 mt-2' id='Comentario'></textarea>
<hr>
<div class='text-right'>
<button type='button' class='btn btn-primary mt-2' style='border-radius: 0;' onclick='BTNEliminarA($idFirma)'>Eliminar</button>
</div>";


}




}
?>

<div class="modal-header">
	<h4 class="modal-title">Detalle personal autorizado</h4>
		<button type="button" class="close" data-dismiss="modal" aria-label="Close">
		<span aria-hidden="true">&times;</span>
		</button>
</div>

<div class="modal-body"> 

<div class="row text-center">

	<div class="col-xl-2 col-lg-2 col-md-2 col-12 mb-3">
		<div><small>ID:</small></div>
		<div style="font-size: 1.2em"><?=$idusuario;?></div>
	</div>

	<div class="col-xl-4 col-lg-4 col-md-4 col-12 mb-3">
		<div><small>Puesto:</small></div>
		<div style="font-size: 1.2em"><?=$puesto;?></div>
	</div>

	<div class="col-xl-6 col-lg-6 col-md-6 col-12 mb-3">
		<div><small>Personal autorizado:</small></div>
		<div style="font-size: 1.2em"><?=$nombreusuario;?></div>
	</div>

</div>

<hr>
 
<div class="row text-center">
	
	<div class="col-xl-4 col-lg-4 col-md-12 col-12 mb-3">
	<div><small>Fecha de alta:</small></div>
	<div style="font-size: 1.2em"><?=FormatoFecha($fechainicio[0]);?></div>
	</div>

	<div class="col-xl-4 col-lg-4 col-md-6 col-12 mb-3">
	<div><small>Fecha de baja:</small></div>
	<div style="font-size: 1.2em"><?=$TxtFechaBaja;?></div>
	</div>

	<div class="col-xl-4 col-lg-4 col-md-6 col-12 mb-3">
	<?=$EstadoPermiso;?>
	</div>
	
</div>

<hr>

<?=$EliminarCoemtario;?>

</div>
