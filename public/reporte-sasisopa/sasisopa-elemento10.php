<?php
require('../../app/help.php');

$FechaInicio = date('Y-m-d', $_GET['FechaInicio']);
$FechaTermino = date('Y-m-d', $_GET['FechaTermino']);

$Explode = explode("-", $FechaTermino);
$fecha_year = $Explode[0];

$sql_programa = "SELECT * FROM po_programa_anual_mantenimiento WHERE id_estacion = '".$Session_IDEstacion."' AND year = '".$fecha_year."' ";
$result_programa = mysqli_query($con, $sql_programa);
$numero_programa = mysqli_num_rows($result_programa);
while($row_programa = mysqli_fetch_array($result_programa, MYSQLI_ASSOC)){
$idYear = $row_programa['id'];
}

?>
<h4>10. CONTROL DE ACTIVIDADES Y PROCESOS</h4>

<table class="table table-bordered table-striped table-sm table-hover mt-2">
<tr>
<td>
      <h6>Fo.ADMONGAS.011 (Programa Anual de Mantenimiento) <?=$fecha_year;?></h6>
</td>
<td width="32"><a onclick="DescargarPAM(<?=$idYear;?>)" style="cursor: pointer;"><img src="<?php echo RUTA_IMG_ICONOS."pdf.png"; ?>"></a></td>
</tr>
</table>

<hr>