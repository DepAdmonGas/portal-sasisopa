<?php
require('../../../../app/help.php');

$sql_usuarios = "SELECT * FROM tb_usuarios WHERE id_gas = '".$Session_IDEstacion."' and estatus = 0 ";
$result_usuarios = mysqli_query($con, $sql_usuarios);
$numero_usuarios = mysqli_num_rows($result_usuarios);

if ($numero_usuarios > 0) {
?>

<table class="table table-bordered table-striped table-hover table-sm mb-0 pb-0" style="font-size: .9em;">
<thead>
<tr>
  <th class="text-center align-middle">#</th>
  <th class="text-center align-middle">Nombre Usuario</th>
  <th class="text-center align-middle">Puesto</th>
  <th class="text-center align-middle">Telefono</th>
  <th class="text-center align-middle">Email</th>
  <th class="text-center align-middle">Grado de responsabilidad respecto al SGM</th>
  <th></th>
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
$respoabilidad_sgm = $row_usuarios['respoabilidad_sgm'];

if ($row_usuarios['estatus'] == 0) {
$estadoimg = "<img src='".RUTA_IMG_ICONOS."activo.png' style='cursor: pointer;'>";
}else if ($row_usuarios['estatus'] == 1) {
$estadoimg = "<img src='".RUTA_IMG_ICONOS."activo.png' style='cursor: pointer;'>";
}

$sql_puesto = "SELECT * FROM tb_puestos WHERE id = '$idpuesto' ";
$result_puesto = mysqli_query($con, $sql_puesto);
$numero_puesto = mysqli_num_rows($result_puesto);
while($row_puesto = mysqli_fetch_array($result_puesto, MYSQLI_ASSOC)){
$puesto = $row_puesto['tipo_puesto'];
}

echo "<tr>";
echo "<td class='text-center align-middle'>".$idusuario."</td>";
echo "<td>".$estadoimg." ".$nombreusuario."</td>";
echo "<td class='text-center align-middle'>".$puesto."</td>";
echo "<td class='text-center align-middle'>".$telefono."</td>";
echo "<td class='text-center align-middle'>".$email."</td>";
echo "<td class='text-center align-middle'>".$respoabilidad_sgm."</td>";


echo "<td class='text-center align-middle' width='30'><img src='".RUTA_IMG_ICONOS."edit-black-16.png' style='cursor: pointer;' onclick='EditarUsuario(".$idusuario.")'></td>";
echo "<td class='text-center align-middle' width='30'><img src='".RUTA_IMG_ICONOS."eliminar-red-16.png' style='cursor: pointer;' onclick='EliminarUsuario(".$idusuario.")'></td>";
echo "</tr>";
}
?>
</tbody>
</table>

<?php }else{
  echo "<div class='text-secondary text-center' >No se encontraron usuarios almacenados en la estación de servicio.</div>";
} ?>


