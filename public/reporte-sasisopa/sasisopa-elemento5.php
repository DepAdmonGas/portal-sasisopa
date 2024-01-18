<?php
require('../../app/help.php');

$FechaInicio = date('Y-m-d', $_GET['FechaInicio']);
$FechaTermino = date('Y-m-d', $_GET['FechaTermino']);

?>
<h4>5. FUNCIONES, RESPONSABILIDADES Y AUTORIDAD</h4>
<?php 

$sql2 = "SELECT * FROM tb_lista_asistencia WHERE id_estacion = '".$Session_IDEstacion."' AND punto_sasisopa = 5 AND fecha BETWEEN '".$FechaInicio."' AND '".$FechaTermino."' ";
$result2 = mysqli_query($con, $sql2);
$numero2 = mysqli_num_rows($result2);

echo '<div class="mb-1">';
echo '<a href="'.RUTA_IMG_ORGANIGRAMA.$Session_Organigrama.'" download>Descargar Organigrama</a>';
echo '</div>';

echo '<h6>Fo.ADMONGAS.010 (Registro de la atención y el seguimiento a la comunicación interna y externa.)</h6>';

echo '<table class="table table-bordered table-striped table-sm pb-0 mb-0" style="font-size: .9em;">
<thead> 
<tr>
<th class="text-center align-middle">#</th>
<th class="text-center align-middle">Fecha</th>
<th class="text-center align-middle">Hora</th>
<th class="text-center align-middle"></th>
</tr>
</thead>
<tbody>';

$num1 = 1;
if ($numero2 > 0) {
while($row2 = mysqli_fetch_array($result2, MYSQLI_ASSOC)){
$id1 = $row2['id'];
$estado = $row2['estado'];

echo "<tr>
<td class='text-center'>".$num1."</td>
<td class='text-center'>".FormatoFecha($row2['fecha'])."</td>
<td class='text-center'>".date('g:i a', strtotime($row2['hora']))."</td>
<td class='text-center align-middle' width='30'><img src='".RUTA_IMG_ICONOS."pdf.png' style='cursor: pointer;' onclick='DescargarAsistencia(".$id1.")'></td>
</tr>";

$num1 = $num1 + 1;
}
}else{
echo "<td colspan='8' class='text-center text-secondary' style='font-size: .8em;'>No se encontró información para mostrar</td>";

}
 
echo '</tbody></table>';


?>
<hr>