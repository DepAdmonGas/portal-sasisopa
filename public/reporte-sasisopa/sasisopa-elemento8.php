<?php
require('../../app/help.php');

$FechaInicio = date('Y-m-d', $_GET['FechaInicio']);
$FechaTermino = date('Y-m-d', $_GET['FechaTermino']);

?>
<h4>8. CONTROL DE DOCUMENTOS Y REGISTROS</h4>
<?php 


echo '<table class="table table-bordered table-striped table-sm mb-0 pb-0" style="font-size: .9em;">
<tbody>
<tr>
<td><h6>Control y documentos de Requisitos Legales</h6></td>
<td class="text-center align-middle" width="30"><img src="'.RUTA_IMG_ICONOS.'pdf.png" style="cursor: pointer;" onclick="btnDescargarCDRL()"></td>
</tr>
<tr>
<td><h6>Control y documentos del Sistema de Administración</h6></td>
<td class="text-center align-middle" width="30"><img src="'.RUTA_IMG_ICONOS.'pdf.png" style="cursor: pointer;" onclick="DescargarCDSA()"></td>
</tr>
</tbody>
</table>';


?>
<hr>