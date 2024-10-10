<?php
require('../../../../app/help.php');


$sql_capacitacion = "SELECT * FROM sgm_inventario_normatividad_aplicable WHERE (estado = '".$Session_IDEstacion."' OR estado = 0) ";
$result_capacitacion = mysqli_query($con, $sql_capacitacion);
$numero_capacitacion = mysqli_num_rows($result_capacitacion);

?>

<table class="table table-bordered table-striped table-sm" id="table-inventario-normatividad-aplicable">
<thead>	
<tr class="bg-primary text-white">
<th class="text-center align-middle">#</th>
<th class="text-center align-middle">Norma, acuerdo o disposición</th>
<th class="text-center align-middle">Fecha de publicación</th>
<th class="text-center align-middle">Fecha de aplicación</th>
<th class="text-center align-middle">Equipo o procedimiento de medición al que aplica</th>
<th class="text-center align-middle">Link</th>
<th class="text-center align-middle"><i class='fa-regular fa-trash-can'></i></th>
</tr>
</thead>
<tbody>
<?php
$i = 1;
if ($numero_capacitacion > 0) {
while($row_capacitacion = mysqli_fetch_array($result_capacitacion, MYSQLI_ASSOC)){
$id = $row_capacitacion['id'];

$fecha_aplicacion = ($row_capacitacion['fecha_aplicacion'] == '0000-00-00')? 'S/I': FormatoFecha($row_capacitacion['fecha_aplicacion']);

echo "<tr>";
echo "<td class='text-center align-middle'>".$i."</td>";
echo "<td class='text-center align-middle'>".$row_capacitacion['norma']."</td>";
echo "<td class='text-center align-middle'>".FormatoFecha($row_capacitacion['fecha_publicacion'])."</td>";
echo "<td class='text-center align-middle'>".$fecha_aplicacion."</td>";
echo "<td class='text-center align-middle'>".$row_capacitacion['equipo']."</td>";
echo "<td class='text-center align-middle'><small>".$row_capacitacion['link']."</small></td>";
echo "<td class='text-center align-middle'width='20px' style='cursor: pointer;'><a onclick='eliminar(".$id.")'><i class='fa-regular fa-trash-can'></i></a></td>";
echo "</tr>";

$i++;
}
}
?>	
</tbody>
</table>
