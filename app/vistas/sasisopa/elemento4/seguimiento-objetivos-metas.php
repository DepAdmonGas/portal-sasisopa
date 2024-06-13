<?php
require('../../../../app/help.php');

$sql_capacitacion = "SELECT * FROM tb_seguimiento_objetivos_metas WHERE id_estacion = '".$Session_IDEstacion."' ORDER BY id DESC ";
$result_capacitacion = mysqli_query($con, $sql_capacitacion);
$numero_capacitacion = mysqli_num_rows($result_capacitacion);

if ($numero_capacitacion > 0) {
while($row_capacitacion = mysqli_fetch_array($result_capacitacion, MYSQLI_ASSOC)){
$id = $row_capacitacion['id'];
?>

<table class="table table-bordered table-sm table-hover pb-0 mb-0">
<thead>	
<tr>
<th class="text-center align-middle">Fecha</th>
<th class="text-center align-middle">Objetivo o meta</th>
<th class="text-center align-middle">Nivel de cumplimiento</th>
<th class="text-center align-middle">Medidas de acción para dar cumplimiento</th>
<th class="text-center align-middle">fecha de aplicación</th>
</tr>
</thead>
<tbody>

<?php 

$sql = "SELECT * FROM tb_seguimiento_objetivos_metas_detalle WHERE id_seguimiento = '".$id."' ";
$result = mysqli_query($con, $sql);
$numero = mysqli_num_rows($result);
while($row = mysqli_fetch_array($result, MYSQLI_ASSOC)){

echo '<tr onclick="ModalDSOM('.$id.')">
		<td class="text-center align-middle" >'.FormatoFecha($row['fecha']).'</td>
		<td class="text-center align-middle" >'.$row['objetivo_meta'].'</td>
		<td class="text-center align-middle" >'.$row['nivel_cumplimiento'].'</td>
		<td class="text-center align-middle" >'.$row['medidas'].'</td>
		<td class="text-center align-middle" >'.FormatoFecha($row['fecha_aplicacion']).'</td>
		</tr>
		';
}
?>
<tr><td class="bg-secondary" colspan="5"></td></tr>
</tbody>
</table>
<?php
}
}else{
echo "<div class='text-center text-secondary' style='font-size: .8em;'>No se encontró información para mostrar</div>";

}
?>	
