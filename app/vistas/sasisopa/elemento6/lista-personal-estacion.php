<?php
require('../../../../app/help.php');
include_once "../../../../app/modelo/Personal.php";

$class_personal = new Personal();

$sql_usuarios = "SELECT id,nombre,telefono,email,usuario,id_puesto,estatus FROM tb_usuarios WHERE id_gas = '".$Session_IDEstacion."' and id_puesto <> 1 and estatus = 0 ";
$result_usuarios = mysqli_query($con, $sql_usuarios);
$numero_usuarios = mysqli_num_rows($result_usuarios);

?>
<?php if ($numero_usuarios > 0) {
?>

<table class="table table-bordered table-striped table-hover table-sm pb-0 mb-0" id="tabla-perfil-personal">
<thead>
<tr class="bg-primary text-white">
  <th class="text-center">#</th>
  <th class="text-center">Nombre Usuario</th>
  <th class="text-center">Puesto</th>
  <th class="text-center">Telefono</th>
  <th class="text-center">Email</th>
  <th class="text-center">Cumplimiento</th>
  <th class="text-center align-middle" width="35px"><i class="fas fa-ellipsis-v"></i></th>
</tr>
</thead>
<tbody>
<?php
while($row_usuarios = mysqli_fetch_array($result_usuarios, MYSQLI_ASSOC)){
$idusuario = $row_usuarios['id'];
$nombreusuario = $row_usuarios['nombre'];
$telefono = $row_usuarios['telefono'];
$email = $row_usuarios['email'];
$usuario = $row_usuarios['usuario'];
$idpuesto = $row_usuarios['id_puesto'];
$estado = $row_usuarios['estatus'];

$porcentaje = $class_personal->porcentajeCumplimiento($idusuario);
$formatporcentaje = number_format($porcentaje, 2, '.', '');

if ($formatporcentaje >= "80") {
$textStyle = "text-success";
}else if($formatporcentaje <= "80" && $formatporcentaje >= "60"){
$textStyle = "text-warning";
}else if($formatporcentaje <= "60" && $formatporcentaje >= "0"){
$textStyle = "text-danger";
}

if ($estado == 0) {
$estadoimg = "<img src='".RUTA_IMG_ICONOS."activo.png' style='cursor: pointer;' data-toggle='tooltip' data-placement='right' title='Usuario activo'>";
}else if ($estado == 1) {
$estadoimg = "<img src='".RUTA_IMG_ICONOS."noactivo.png' style='cursor: pointer;' data-toggle='tooltip' data-placement='right' title='Usuario cancelado'>";
}

$sql_puesto = "SELECT * FROM tb_puestos WHERE id = '$idpuesto' ";
$result_puesto = mysqli_query($con, $sql_puesto);
$numero_puesto = mysqli_num_rows($result_puesto);
while($row_puesto = mysqli_fetch_array($result_puesto, MYSQLI_ASSOC)){
$puesto = $row_puesto['tipo_puesto'];
}

echo "<tr>";
echo "<td class='text-center'>".$idusuario."</td>";
echo "<td>".$estadoimg." ".$nombreusuario."</td>";
echo "<td class='text-center'>".$puesto."</td>";
echo "<td class='text-center'>".$telefono."</td>";
echo "<td class='text-center'>".$email."</td>";
echo "<td class='text-center align-middle font-weight-bold ".$textStyle."'>".$formatporcentaje."%</td>";
echo '<td class="text-center align-middle" width="20px" style="cursor: pointer;">
  <div class="dropdown dropstart">
  <a class="btn btn-sm btn-icon-only text-dropdown-light" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
  <i class="fas fa-ellipsis-v"></i>
  </a>
  <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">
    <a class="dropdown-item" onclick="VerFicha('.$idusuario.')"><i class="fa-regular fa-eye"></i> Ficha personal</a>
    <a class="dropdown-item" onclick="FichaPersonal('.$idusuario.')"><i class="fa-regular fa-file-pdf"></i> Descargar PDF</a>
  </div>
  </div>
  </td>';

echo "</tr>";
}
?>
</tbody>
</table>
<?php }?>

