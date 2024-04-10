<?php
require('../../../../app/help.php');
include_once "../../../../app/modelo/Asistencia.php";

$class_asistencia = new Asistencia();
$idSasisopa = $_GET['idSasisopa'];
$lista_asistencia = $class_asistencia->listaAsistencia($Session_IDEstacion,$idSasisopa);
$numero_asistencia = mysqli_num_rows($lista_asistencia);

?>
<div style="overflow-y: hidden;">
<table class="table table-bordered table-striped table-sm">
<thead>	
<tr>
<th class="text-center align-middle">#</th>
<th class="text-center align-middle">Fecha</th>
<th class="text-center align-middle">Hora</th>
<th class="text-center align-middle"><img src="<?=RUTA_IMG_ICONOS;?>editar.png"></th>
<th class="text-center align-middle"><img src="<?=RUTA_IMG_ICONOS;?>pdf.png"></th>
<th class="text-center align-middle"><img src="<?=RUTA_IMG_ICONOS;?>eliminar.png"></th>
</tr>
</thead>
<tbody>
<?php
$num = 1;
if ($numero_asistencia > 0) {
while($row = mysqli_fetch_array($lista_asistencia, MYSQLI_ASSOC)){
$id = $row['id'];
$estado = $row['estado'];

if($estado == 1){
$trColor = "";
}else{
$trColor = "table-warning";
}

echo "<tr class='".$trColor."'>";
echo "<td class='text-center'>".$num."</td>";
echo "<td class='text-center'>".FormatoFecha($row['fecha'])."</td>";
echo "<td class='text-center'>".date('g:i a', strtotime($row['hora']))."</td>";

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