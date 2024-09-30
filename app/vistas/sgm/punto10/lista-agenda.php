<?php
require('../../../../app/help.php');

$sql = "SELECT * FROM sgm_plan_auditoria_agenda WHERE id_plan = '".$_GET['id']."' ";
$result = mysqli_query($con, $sql);
$numero = mysqli_num_rows($result);

?>
<table class="table table-bordered table-striped table-hover table-sm">
<thead>
<tr class="bg-light">
  <th class="text-center align-middle">HORARIO</th>
  <th class="text-center align-middle">PROCESO</th>
  <th class="text-center align-middle">ELEMENTO DEL SISTEMA DE GESTION DE MEDICION</th>
  <th class="text-center align-middle">NOMBRE Y ROL DEL AUDITOR</th>
  <th class="text-center align-middle">GUÍA</th>
  <th class="text-center align-middle" width="32"></th>
</tr>
</thead>
<tbody>
<?php
$num = 1;
if ($numero > 0) {
while($row = mysqli_fetch_array($result, MYSQLI_ASSOC)){

echo '<tr>
<td class="text-center align-middle">De '.$row['hora_inicio'].' a '.$row['hora_termino'].'</td>
<td class="text-center align-middle">'.$row['proceso'].'</td>
<td class="text-center align-middle">'.$row['elemento_sistema'].'</td>
<td class="text-center align-middle">'.$row['nombre_rol'].'</td>
<td class="text-center align-middle">'.$row['guia'].'</td>
<td class="text-center align-middle"><img src="'.RUTA_IMG_ICONOS.'eliminar.png" style="cursor: pointer;" onclick="EliminarAgenda(0,'.$_GET['id'].','.$row['id'].',15)"></td>
</tr>';

$num++;
}
}else{
echo "<td colspan='9' class='text-center text-secondary' style='font-size: .8em;'>No se encontró información para mostrar</td>";
}
?>
</tbody>
</table>


