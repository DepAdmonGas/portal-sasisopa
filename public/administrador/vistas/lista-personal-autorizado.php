<?php
require('../../../app/help.php');

$idEstacion = $_GET['idEstacion'];
$Categoria  = $_GET['Categoria'];

$sql_usuarios = "SELECT tb_usuarios.id, tb_usuarios.nombre, tb_usuarios.id_puesto, tb_usuarios.id_gas, tb_usuarios_firma_bitacora.id AS idFirma, tb_usuarios_firma_bitacora.categoria, tb_usuarios_firma_bitacora.fechainicio, tb_usuarios_firma_bitacora.estado
FROM tb_usuarios_firma_bitacora
INNER JOIN tb_usuarios on tb_usuarios.id = tb_usuarios_firma_bitacora.id_usuario
 WHERE id_gas = '".$idEstacion."' and categoria = '".$Categoria."' ORDER BY tb_usuarios_firma_bitacora.estado DESC ";
$result_usuarios = mysqli_query($con, $sql_usuarios);
$numero_usuarios = mysqli_num_rows($result_usuarios);

if ($numero_usuarios > 0) {
?>

<div style="overflow-y: hidden;">
<table class="table table-bordered table-striped table-hover table-sm" style="font-size: .9em;">
<thead>
<tr>
  <th class="text-center align-middle">#</th>
  <th class="text-center align-middle">Nombre Usuario</th>
  <th class="text-center align-middle">Fecha inicio</th>
  <th></th>
</tr>
</thead>
<tbody>
<?php
while($row_usuarios = mysqli_fetch_array($result_usuarios, MYSQLI_ASSOC)){
$idFirma = $row_usuarios['idFirma'];
$idusuario = $row_usuarios['id'];
$nombreusuario = $row_usuarios['nombre'];
$idpuesto = $row_usuarios['id_puesto'];
$estado = $row_usuarios['estado'];

$fecha = explode(" ", $row_usuarios['fechainicio']);

if ($estado == 0) {
$tablecolor = "table-danger";
}else {
$tablecolor = "";
}

$sql_puesto = "SELECT * FROM tb_puestos WHERE id = '$idpuesto' ";
$result_puesto = mysqli_query($con, $sql_puesto);
$numero_puesto = mysqli_num_rows($result_puesto);
while($row_puesto = mysqli_fetch_array($result_puesto, MYSQLI_ASSOC)){
$puesto = $row_puesto['tipo_puesto'];
}

echo "<tr class='".$tablecolor."'>";
echo "<td class='text-center align-middle'>".$idusuario."</td>";
echo "<td class='align-middle'>".$nombreusuario."</td>";
echo "<td class='text-center align-middle'>".FormatoFecha($fecha[0])."</td>";
echo "<td class='text-center align-middle' width='30'><img src='".RUTA_IMG_ICONOS."ojo-black-16.png' style='cursor: pointer;' data-toggle='tooltip' data-placement='left' title='Eliminar usuario' onclick='EliminarFirma(".$idFirma.")'></td>";
echo "</tr>";
}
?>
</tbody>
</table>

<?php
}else{
 echo "<div class='text-secondary text-center m-3' >No se encontraron usuarios almacenados.</div>";
}
?>

