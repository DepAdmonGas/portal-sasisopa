<?php
require('../../../../app/help.php');

$Categoria  = $_GET['Categoria'];

$sql_usuarios = "SELECT 
tb_usuarios.id, 
tb_usuarios.nombre, 
tb_usuarios.id_puesto, 
tb_usuarios.id_gas, 
tb_usuarios_firma_bitacora.id AS idFirma, 
tb_usuarios_firma_bitacora.categoria, 
tb_usuarios_firma_bitacora.estado,
tb_puestos.tipo_puesto
FROM tb_usuarios_firma_bitacora
INNER JOIN tb_usuarios on tb_usuarios.id = tb_usuarios_firma_bitacora.id_usuario 
INNER JOIN tb_puestos on tb_usuarios.id_puesto = tb_puestos.id
 WHERE id_gas = '".$Session_IDEstacion."' and categoria = '".$Categoria."' AND tb_usuarios_firma_bitacora.estado = 1 ";
$result_usuarios = mysqli_query($con, $sql_usuarios);
$numero_usuarios = mysqli_num_rows($result_usuarios);
if ($numero_usuarios > 0) {
?>
<div class="mb-2" style="overflow-y: hidden;">
<table class="table table-bordered table-striped table-hover table-sm pb-0 mb-0" style="font-size: .9em;">
<thead>
<tr>
  <th class="text-center align-middle">#</th>
  <th class="text-center align-middle">Nombre Usuario</th>
  <th class="text-center align-middle">Puesto</th>
  <th class="text-center align-middle">Estado</th>
  <th class="text-center align-middle"><img src="<?php echo RUTA_IMG_ICONOS."ojo-black-16.png"; ?>"></th>
</tr>
</thead>
<tbody>
<?php
while($row_usuarios = mysqli_fetch_array($result_usuarios, MYSQLI_ASSOC)){
$idFirma = $row_usuarios['idFirma'];
$idusuario = $row_usuarios['id'];
$nombreusuario = $row_usuarios['nombre'];
$idpuesto = $row_usuarios['id_puesto'];

if ($row_usuarios['estado'] == 1) {
$estado = "Activo";
}else{
$estado = "Eliminado";	
}

$puesto = $row_usuarios['tipo_puesto'];

echo "<tr>";
echo "<td class='text-center align-middle'>".$idusuario."</td>";
echo "<td>".$nombreusuario."</td>";
echo "<td class='text-center align-middle'>".$puesto."</td>";
echo "<td class='text-center align-middle'><b>".$estado."</b></td>";
echo "<td class='text-center align-middle' width='30'><img src='".RUTA_IMG_ICONOS."ojo-black-16.png' style='cursor: pointer;' data-toggle='tooltip' data-placement='left' title='Eliminar usuario' onclick='DetalleFirma(".$idFirma.")'></td>";
echo "</tr>";
}
?>
</tbody>
</table>
</div>
<?php
}else{
echo "<div class='text-secondary text-center m-3' >No se encontraron usuarios almacenados.</div>";
}
?>

