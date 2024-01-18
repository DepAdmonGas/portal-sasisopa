<?php
require('../../../app/help.php');

$sql = "SELECT * FROM tb_atencion_hallazgos WHERE id_estacion = '".$Session_IDEstacion."' ORDER BY id DESC ";
$result = mysqli_query($con, $sql);
$numero = mysqli_num_rows($result);


function Evidencias($id, $con){

$sqlAH = "SELECT * FROM tb_atencion_hallazgos_evidencia WHERE id_atencion = '".$id."'";
$resultAH = mysqli_query($con, $sqlAH);
$numeroAH = mysqli_num_rows($resultAH);
while($rowAH = mysqli_fetch_array($resultAH, MYSQLI_ASSOC)){

$Result .= "<div><a href='".RUTA_ARCHIVOS."atencion-hallazgos/".$rowAH['archivo']."' download><small>".$rowAH['archivo']."</small></a></div>";
}

return $Result;
}
?>

<table class="table table-bordered table-striped table-sm">
<thead>	
<tr>
<th class="text-center align-middle">#</th>
<th class="text-center align-middle">Fecha de la auditoria</th>
<th class="text-center align-middle">No de control de la auditoria</th>
<th class="text-center align-middle">Tipo de auditoria</th>
<th class="text-center align-middle"></th>
<th class="text-center align-middle"></th>
<th class="text-center align-middle"></th>
</tr>
</thead>
<tbody>
<?php 
if ($numero > 0) {
while($row = mysqli_fetch_array($result, MYSQLI_ASSOC)){

$id = $row['id'];
$fechaauditoria = $row['fecha_auditoria'];
$nocontrol = $row['no_control'];
$tipoauditoria = $row['tipo_auditoria'];

echo "<tr>";
echo '<td class="text-center align-middle"><b>'.$row['folio'].'</b></td>
<td class="text-center align-middle">'.FormatoFecha($fechaauditoria).'</td>
<td class="text-center align-middle">'.$nocontrol.'</td>
<td class="text-center align-middle">'.$tipoauditoria.'</td>
<td class="text-center align-middle" width="30"><img src="'.RUTA_IMG_ICONOS.'pdf.png" onclick="Descargar('.$id.')"></td>
<td class="text-center align-middle" width="30"><img src="'.RUTA_IMG_ICONOS.'editar.png" onclick="Editar('.$id.')"></td>
<td class="text-center align-middle" width="30"><img src="'.RUTA_IMG_ICONOS.'eliminar.png" onclick="Eliminar('.$id.')"></td>';
echo "</tr>";
}
}else{
echo "<td colspan='7' class='text-center text-secondary' style='font-size: .8em;'>No se encontró información para mostrar</td>";
}
?>
</tbody>
</table>
