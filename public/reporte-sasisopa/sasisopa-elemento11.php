<?php
require('../../app/help.php');

$FechaInicio = date('Y-m-d', $_GET['FechaInicio']);
$FechaTermino = date('Y-m-d', $_GET['FechaTermino']);

$explode = explode("-", $FechaTermino);
$Year = $explode[0];

$sql_programa = "SELECT * FROM po_programa_anual_mantenimiento WHERE id_estacion = '".$Session_IDEstacion."' AND year = '".$Year."' ";
$result_programa = mysqli_query($con, $sql_programa);
$numero_programa = mysqli_num_rows($result_programa);
while($row_programa = mysqli_fetch_array($result_programa, MYSQLI_ASSOC)){
$idYear = $row_programa['id'];
}

?>
<h4>11. INTEGRIDAD MECÁNICA Y ASEGURAMIENTO DE LA CALIDAD</h4>
<?php 

echo '<table class="table table-bordered table-striped table-sm mb-0 pb-0" style="font-size: .9em;">
<tbody>
<tr>
<td><h6>Fo.ADMONGAS.011 (Programa Anual de Mantenimiento)</h6></td>
<td class="text-center align-middle" width="30"><img src="'.RUTA_IMG_ICONOS.'pdf.png" style="cursor: pointer;" onclick="DescargarPAM('.$idYear.')"></td>
</tr>
<tr>
<td><h6>Lista de equipos críticos</h6></td>
<td class="text-center align-middle" width="30"><img src="'.RUTA_IMG_ICONOS.'pdf.png" style="cursor: pointer;" onclick="DescargarEquipoCritico()"></td>
</tr>
</tbody>
</table>';

?>
<hr>