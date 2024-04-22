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

<div class="mb-2" style="overflow-y: hidden;">
<table class="table table-bordered table-striped table-hover table-sm" style="font-size: .9em;">
<thead>
<tr>
  <th class="text-center">#</th>
  <th class="text-center">Nombre Usuario</th>
  <th class="text-center">Puesto</th>
  <th class="text-center">Telefono</th>
  <th class="text-center">Email</th>
  <th class="text-center">Cumplimiento</th>
  <th class="text-center"><img src="<?=RUTA_IMG_ICONOS;?>pdf-16.png"></th>
  <th class="text-center"><img src="<?=RUTA_IMG_ICONOS;?>ojo-black-16.png"></th>
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

echo "<td class='text-center align-middle' width='30'><img src='".RUTA_IMG_ICONOS."pdf-16.png' style='cursor: pointer;' data-toggle='tooltip' data-placement='left' title='Ficha del usuario' onclick='FichaPersonal(".$idusuario.")'></td>";

echo "<td class='text-center align-middle' width='30'><img src='".RUTA_IMG_ICONOS."ojo-black-16.png' style='cursor: pointer;' data-toggle='tooltip' data-placement='left' title='Ver ficha del usuario' onclick='VerFicha(".$idusuario.")'></td>";
echo "</tr>";
}
?>
</tbody>
</table>
</div>
<?php }else{
  echo "<div class='text-secondary text-center' >No se encontraron usuarios almacenados en la estación de servicio.</div>";
} ?>

