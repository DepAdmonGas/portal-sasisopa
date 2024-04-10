<?php
require('../../../../app/help.php');
include_once "../../../../app/modelo/Asistencia.php";

$idReporte = $_GET['idReporte'];
$class_asistencia = new Asistencia();
$array_lista_asistencia_detalle = $class_asistencia->listaAsistenciaDetalle($idReporte);
$numero_capacitacion = mysqli_num_rows($array_lista_asistencia_detalle);

?>
<div style="overflow-y: hidden;">
<table class="table table-bordered table-sm">
<thead>	
<tr>
<th class="text-center align-middle">#</th>
<th class="text-center align-middle">Nombre</th>
<th class="text-center align-middle">Puesto</th>
<th class="text-center align-middle">Firma</th>
<th class="text-center align-middle"><img src='<?=RUTA_IMG_ICONOS;?>eliminar.png'></th>
</tr>
</thead>
<tbody>
<?php
$num = 1;
if ($numero_capacitacion > 0) {
while($row_capacitacion = mysqli_fetch_array($array_lista_asistencia_detalle, MYSQLI_ASSOC)){
$id = $row_capacitacion['id'];
$usuario = $row_capacitacion['usuario'];
$puesto = $row_capacitacion['puesto'];

$Firma = $class_asistencia->BuscarFirma($usuario);

echo "<tr>";
echo "<td class='text-center align-middle'>".$id."</td>";
echo "<td class=' align-middle'>".$usuario."</td>";
echo "<td class=' align-middle'>".$puesto."</td>";
echo "<td class='text-center align-middle'><img  width='60' src='".RUTA_IMG_FIRMA_PERSONAL.$Firma."'></td>";

echo "<td class='text-center align-middle' width='30'><img src='".RUTA_IMG_ICONOS."eliminar.png' style='cursor: pointer;' onclick='EliminarRegistro(".$idReporte.",".$id.")'></td>";

echo "</tr>";

$num = $num + 1;
}
}else{
echo "<td colspan='5' class='text-center text-secondary' style='font-size: .8em;'>No se encontró información para mostrar</td>";

}
?>	
</tbody>
</table>
</div>