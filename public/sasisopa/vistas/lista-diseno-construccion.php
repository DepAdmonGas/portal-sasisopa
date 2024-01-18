<?php
require('../../../app/help.php');

$sql_capacitacion = "SELECT * FROM tb_diseno_construccion WHERE (estado = '".$Session_IDEstacion."' OR estado = 0) ";
$result_capacitacion = mysqli_query($con, $sql_capacitacion);
$numero_capacitacion = mysqli_num_rows($result_capacitacion);

?>

<div class="mb-2" style="overflow-y: hidden;">
<table class="table table-bordered table-striped table-sm">
<thead>	
<tr>
<th class="text-center align-middle">Código, estándar, normatividad o práctica de
ingeniería.</th>
<th class="text-center align-middle">Área, maquinaria, equipo o instalación a la que
aplica.</th>
<th></th>
</tr>
</thead>
<tbody>
<?php
if ($numero_capacitacion > 0) {
while($row_capacitacion = mysqli_fetch_array($result_capacitacion, MYSQLI_ASSOC)){
$id = $row_capacitacion['id'];

echo "<tr>";
echo "<td class='text-center align-middle'>".$row_capacitacion['valor1']."</td>";
echo "<td class='text-center align-middle'>".$row_capacitacion['valor2']."</td>";
echo "<td class='text-center align-middle'width='20px' style='cursor: pointer;'><img src='".RUTA_IMG_ICONOS."eliminar.png' onclick='eliminarDC(".$id.")'></td>";
echo "</tr>";

}
}else{
echo "<td colspan='8' class='text-center text-secondary' style='font-size: .8em;'>No se encontró información para mostrar</td>";

}
?>	
</tbody>
</table>
</div>