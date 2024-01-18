<?php
require('../../app/help.php');

$FechaInicio = date('Y-m-d', $_GET['FechaInicio']);
$FechaTermino = date('Y-m-d', $_GET['FechaTermino']);

?>
<h4>9. MEJORES PRÁCTICAS Y ESTÁNDARES</h4>
<?php 

echo '<table class="table table-bordered table-striped table-sm mb-0 pb-0" style="font-size: .9em;">
<tbody>
<tr>
<td><h6>Diseño y construcción</h6></td>
<td class="text-center align-middle" width="30"><img src="'.RUTA_IMG_ICONOS.'pdf.png" style="cursor: pointer;" onclick="DescargarDC()"></td>
</tr>
<tr>
<td><h6>Operación y Mantenimiento</h6></td>
<td class="text-center align-middle" width="30"><img src="'.RUTA_IMG_ICONOS.'pdf.png" style="cursor: pointer;" onclick="DescargarOM()"></td>
</tr>
</tbody>
</table>';

?>
<hr>