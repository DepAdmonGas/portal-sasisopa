<?php
require('../../../app/help.php');

$id = $_POST['id'];

$sql_auditoria = "SELECT * FROM tb_auditoria_externa_asea WHERE id_auditoria= '".$id."' ORDER BY id desc ";
$result_auditoria = mysqli_query($con, $sql_auditoria);
$numero_auditoria = mysqli_num_rows($result_auditoria);
?>

<div class="mb-2" style="overflow-y: hidden;">
<table class="table table-bordered table-striped table-hover table-sm">
<thead>
<th class="text-center">#</th>
<th class="text-center">Fecha</th>
<th class="text-center">Comentario</th>
<th class="text-center"></th>
</thead>
<tbody>
<?php
if ($numero_auditoria > 0) {
while($row_auditoria = mysqli_fetch_array($result_auditoria, MYSQLI_ASSOC)){
$fechahora = explode(" ", $row_auditoria['fechacreacion']);

$id = $row_auditoria['id'];
echo "<tr>";
echo "<td class='text-center align-middle'>".$id."</td>";
echo "<td class='text-center align-middle'>".FormatoFecha($fechahora[0])."</td>";
echo "<td class='text-center align-middle'>".$row_auditoria['comentario']."</td>";
echo "<td class='text-center align-middle'><a target='_BLANK' href='".$row_auditoria['archivo']."'><img src='".RUTA_IMG_ICONOS."pdf.png'></a></td>";
echo "</tr>";
}
}else{
echo "<tr><td colspan='4' class='text-center'><small>No se encontró información para mostrar</small></td></tr>";	
}
?>	
</tbody>
</table>
</div>