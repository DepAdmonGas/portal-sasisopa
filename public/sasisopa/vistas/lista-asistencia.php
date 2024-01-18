<?php
require('../../../app/help.php');

$idSasisopa = $_GET['idSasisopa'];

$sql_capacitacion = "SELECT * FROM tb_lista_asistencia WHERE id_estacion = '".$Session_IDEstacion."' AND punto_sasisopa = '".$idSasisopa."' ";
$result_capacitacion = mysqli_query($con, $sql_capacitacion);
$numero_capacitacion = mysqli_num_rows($result_capacitacion);

?>
<div style="overflow-y: hidden;">
<table class="table table-bordered table-striped table-sm">
<thead>	
<tr>
<th class="text-center align-middle">#</th>
<th class="text-center align-middle">Fecha</th>
<th class="text-center align-middle">Hora</th>
<th class="text-center align-middle"></th>
<th class="text-center align-middle"></th>
</tr>
</thead>
<tbody>
<?php
$num = 1;
if ($numero_capacitacion > 0) {
while($row_capacitacion = mysqli_fetch_array($result_capacitacion, MYSQLI_ASSOC)){
$id = $row_capacitacion['id'];
$estado = $row_capacitacion['estado'];

if($estado == 1){
$trColor = "";
}else{
$trColor = "table-warning";
}

echo "<tr class='".$trColor."'>";
echo "<td class='text-center'>".$num."</td>";
echo "<td class='text-center'>".FormatoFecha($row_capacitacion['fecha'])."</td>";
echo "<td class='text-center'>".date('g:i a', strtotime($row_capacitacion['hora']))."</td>";

echo "<td class='text-center align-middle' width='30'><img src='".RUTA_IMG_ICONOS."editar.png' style='cursor: pointer;' onclick='EditarAsistencia(".$id.")'></td>";
echo "<td class='text-center align-middle' width='30'><img src='".RUTA_IMG_ICONOS."pdf.png' style='cursor: pointer;' onclick='DescargarAsistencia(".$id.")'></td>";
echo "<td class='text-center align-middle' width='30'><img src='".RUTA_IMG_ICONOS."eliminar.png' style='cursor: pointer;' onclick='EliminarAsistencia(".$id.")'></td>";

echo "</tr>";

$num = $num + 1;
}
}else{
echo "<td colspan='8' class='text-center text-secondary' style='font-size: .8em;'>No se encontró información para mostrar</td>";

}
?>	
</tbody>
</table>
</div>