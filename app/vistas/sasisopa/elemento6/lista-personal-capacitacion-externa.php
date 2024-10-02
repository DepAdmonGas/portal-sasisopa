<?php
require('../../../../app/help.php');
include_once "../../../../app/modelo/Personal.php";
include_once "../../../../app/modelo/Capacitacion.php";

$class_personal = new Personal();
$class_capacitacion = new Capacitacion();

$idCapacitacion = $_GET['idCapacitacion'];

$sql_capacitacion = "SELECT * FROM tb_capacitacion_externa_personal WHERE id_capacitacion = '".$idCapacitacion."' ";
$result_capacitacion = mysqli_query($con, $sql_capacitacion);
$numero_capacitacion = mysqli_num_rows($result_capacitacion);


?>
<div class="modal-header rounded-0 head-modal">
   <h4 class="modal-title text-white">TRABAJADORES</h4>
   <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
 </div>
 <div class="modal-body">

 	<div class="mt-2 mb-2"><small class="text-secondary">Selecciona el trabajador:</small>
 	</div>

	 <div class="row">
	<div class="col-12 mb-2">
	<select class="form-control rounded-0" id="IdPersonal">
	<option value="">Selecciona</option>
	<?php
	$sql_usuarios = "SELECT id, nombre FROM tb_usuarios WHERE id_gas = '".$Session_IDEstacion."' AND estatus = 0 ";
	$result_usuarios = mysqli_query($con, $sql_usuarios);
	$numero_usuarios = mysqli_num_rows($result_usuarios);
	while($row_usuarios = mysqli_fetch_array($result_usuarios, MYSQLI_ASSOC)){
	$nombre = $row_usuarios['nombre'];
    echo $validar_personal = $class_capacitacion->validaPersonal($idCapacitacion,$row_usuarios['id']);
    if($validar_personal == 0){
    echo '<option value="'.$row_usuarios['id'].'">'.$nombre.'</option>';
    }
	}
	?>
	</select>
	</div>

	<div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 mb-2 text-right">
	<button type="button" class="btn btn-success " style="border-radius: 0px;" onClick="AgregarPersonal(<?=$idCapacitacion;?>)">Agregar trabajador</button>
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
$personal = $class_personal->buscarPersonal($idempleado);

echo "<tr>";
echo "<td class='text-center'>".$num."</td>";
echo "<td class=''>".$personal['nombre']."</td>";
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



