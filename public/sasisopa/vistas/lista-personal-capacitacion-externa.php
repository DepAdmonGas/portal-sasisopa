<?php
require('../../../app/help.php');

$idCapacitacion = $_GET['idCapacitacion'];

$sql_capacitacion = "SELECT * FROM tb_capacitacion_externa_personal WHERE id_capacitacion = '".$idCapacitacion."' ";
$result_capacitacion = mysqli_query($con, $sql_capacitacion);
$numero_capacitacion = mysqli_num_rows($result_capacitacion);

function NombreCompleto($idempleado, $con)
{
$sql_capacitacion = "SELECT nombre FROM tb_usuarios WHERE id = '".$idempleado."' ";
$result_capacitacion = mysqli_query($con, $sql_capacitacion);
$numero_capacitacion = mysqli_num_rows($result_capacitacion);
while($row_capacitacion = mysqli_fetch_array($result_capacitacion, MYSQLI_ASSOC)){
$nombre = $row_capacitacion['nombre'];
}
return $nombre;
} 

?>
<script type="text/javascript">
$(document).ready(function(){
muestra_oculta('Trabajadores')
  });
	;
</script>
<div class="modal-header">
   <h4 class="modal-title">TRABAJADORES</h4>
     <button type="button" class="close" data-dismiss="modal" aria-label="Close">
   <span aria-hidden="true">&times;</span>
 </button>
 </div>
 <div class="modal-body">


 	<div class="text-right mb-3">
 	<button type="button" class="btn btn-primary btn-sm" style="border-radius: 0px;" onClick="muestra_oculta('Trabajadores')">Agregar trabajador</button>
 	</div>

 	<div id="Trabajadores" class="border p-2 mb-2">
 	
 	<div class="mt-2 mb-2"><small class="text-secondary">Selecciona el trabajador:</small>
 	</div>

	 <div class="row">
	<div class="col-12 mb-2">
	<select class="form-control rounded-0" id="IdPersonal">
	<option value="">Selecciona</option>
	<?php
	$sql_usuarios = "SELECT * FROM tb_usuarios WHERE id_gas = '".$Session_IDEstacion."' AND estatus = 0 ";
	$result_usuarios = mysqli_query($con, $sql_usuarios);
	$numero_usuarios = mysqli_num_rows($result_usuarios);
	while($row_usuarios = mysqli_fetch_array($result_usuarios, MYSQLI_ASSOC)){
	$nombre = $row_usuarios['nombre'];
	echo "<option value='".$row_usuarios['id']."'>".$nombre."</option>";
	}
	?>
	</select>
	</div>

	<div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 mb-2 text-right">
	<button type="button" class="btn btn-success " style="border-radius: 0px;" onClick="AgregarPersonal(<?=$idCapacitacion;?>)">Agregar trabajador</button>
	</div>
 	</div>

</div>

<div class="mb-2" style="overflow-y: hidden;">
<table class="table table-bordered table-striped table-sm">
<thead>	
<tr class="table-primary">
<th class="text-center align-middle">#</th>
<th class="text-center align-middle">Personal</th>
<th class="text-center align-middle"></th>
</tr>
</thead>
<tbody>
<?php
$num = 1;
if ($numero_capacitacion > 0) {
while($row_capacitacion = mysqli_fetch_array($result_capacitacion, MYSQLI_ASSOC)){
$id = $row_capacitacion['id'];
$idempleado = $row_capacitacion['id_empleado'];
$NombreCompleto = NombreCompleto($idempleado, $con);

echo "<tr>";
echo "<td class='text-center'>".$num."</td>";
echo "<td class=''>".$NombreCompleto."</td>";
echo "<td class='text-center align-middle' width='30'><img src='".RUTA_IMG_ICONOS."eliminar-red-16.png' style='cursor: pointer;' onclick='EliminarPersonal(".$id.",".$idCapacitacion.")'></td>";
echo "</tr>";

$num = $num + 1;
}
}else{
echo "<td colspan='3' class='text-center text-secondary' style='font-size: .8em;'>No se encontró información para mostrar</td>";

}
?>	
</tbody>
</table>
</div>

 </div>



