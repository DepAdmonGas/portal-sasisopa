<?php
require('../../../app/help.php');
$idReporte = $_GET['idReporte'];
$sql_capacitacion = "SELECT * FROM tb_lista_asistencia_detalle WHERE id_lista_asistencia = '".$idReporte."' ";
$result_capacitacion = mysqli_query($con, $sql_capacitacion);
$numero_capacitacion = mysqli_num_rows($result_capacitacion);


function BuscarFirma($usuario,$con){

$sql = "SELECT firma FROM tb_usuarios WHERE nombre = '".$usuario."' ORDER BY id DESC LIMIT 1 ";
$result = mysqli_query($con, $sql);
$numero = mysqli_num_rows($result);
while($row = mysqli_fetch_array($result, MYSQLI_ASSOC)){ 
$Firma = $row['firma'];
}
return $Firma;
}
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
while($row_capacitacion = mysqli_fetch_array($result_capacitacion, MYSQLI_ASSOC)){
$id = $row_capacitacion['id'];
$usuario = $row_capacitacion['usuario'];
$puesto = $row_capacitacion['puesto'];

$Firma = BuscarFirma($usuario,$con);

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