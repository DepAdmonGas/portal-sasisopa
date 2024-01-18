<?php
require('../../../app/help.php');

$id = $_POST['id'];

$sql_inv = "SELECT * FROM tb_investigacion_incidente_accidente_grupo WHERE id_investigacion= '".$id."' ORDER BY id desc ";
$result_inv = mysqli_query($con, $sql_inv);
$numero_inv = mysqli_num_rows($result_inv);


?>

<div class="mb-2" style="overflow-y: hidden;">
<table class="table table-bordered table-striped table-hover table-sm">
<thead>
<th class="text-center">#</th>
<th class="text-center">Nombre</th>
<th class="text-center">Puesto</th>
<th class="text-center">Especialidad</th>
</thead>
<tbody>
<?php
if ($numero_inv > 0) {
while($row_inv = mysqli_fetch_array($result_inv, MYSQLI_ASSOC)){
echo "<tr>";
echo "<td class='text-center'>".$row_inv['id']."</td>";
echo "<td class='text-center'>".$row_inv['nombre']."</td>";
echo "<td class='text-center'>".$row_inv['puesto']."</td>";
echo "<td class='text-center'>".$row_inv['especialidad']."</td>";
echo "</tr>";
}
}else{
echo "<tr><td colspan='4' class='text-center'><small>No se encontró información para mostrar</small></td></tr>";	
}
?>
</tbody>
</table>
</div>