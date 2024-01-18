<?php
require('../../app/help.php');

$FechaInicio = date('Y-m-d', $_GET['FechaInicio']);
$FechaTermino = date('Y-m-d', $_GET['FechaTermino']);

?>
<h4>2. ANÁLISIS DE RIESGO Y EVALUACIÓN DE IMPACTOS AMBIENTALES</h4>
<?php 
$sql1 = "SELECT * FROM tb_analisis_riesgo WHERE id_estacion = '".$Session_IDEstacion."' AND fecha BETWEEN '".$FechaInicio."' AND '".$FechaTermino."' ORDER BY fecha DESC ";
$result1 = mysqli_query($con, $sql1);
$numero1 = mysqli_num_rows($result1);

$sql2 = "SELECT * FROM tb_lista_asistencia WHERE id_estacion = '".$Session_IDEstacion."' AND punto_sasisopa = 2 AND fecha BETWEEN '".$FechaInicio."' AND '".$FechaTermino."' ";
$result2 = mysqli_query($con, $sql2);
$numero2 = mysqli_num_rows($result2);

echo '<div class="row">';
echo '<div class="col-6">';

echo '<table class="table table-bordered table-striped table-sm mb-0 pb-0" style="font-size: .9em;">
<tbody>
<tr>
<td><h6>Identificación y evaluación de Aspectos e Impactos Ambientales.</h6></td>
<td class="text-center align-middle" width="30"><img src="'.RUTA_IMG_ICONOS.'pdf.png" style="cursor: pointer;" onclick="Formato2()"></td>
</tr>
</tbody>
</table>';

echo '<h6 class="mt-3">Análisis de Riesgo del Sector Hidrocarburos (ARSH)</h6>';

echo '<table class="table table-bordered table-striped table-hover table-sm pb-0 mb-0" style="font-size: .9em;">
<thead>
<tr>
  <th class="text-center">#</th>
  <th class="">Fecha</th>
  <th class="">Descripción</th>  
  <th width="32"><img src="'.RUTA_IMG_ICONOS.'pdf.png"></th>
  <th width="32">Anexos</th>
</tr>
</thead>
<tbody>';

$num1 = 1;
if ($numero1 > 0) {
while($row1 = mysqli_fetch_array($result1, MYSQLI_ASSOC)){

$id1 = $row1['id'];

echo '<tr>
<td class="text-center"><b>'.$num1.'</b></td>
<td>'.FormatoFecha($row1['fecha']).'</td>
<td>'.$row1['descripcion'].'</td>
<td class="text-center"><a style="cursor: pointer;" href="../../archivos/analisis-riesgo/'.$row1['documento'].'" download ><img src="'.RUTA_IMG_ICONOS.'pdf.png"></a></td>
<td class="text-center"><a onclick="ModalAnexos('.$id1.')" style="cursor: pointer;" ><img src="'.RUTA_IMG_ICONOS.'documento.png"></a></td>
</tr>';

$num1 = $num1 + 1;
}
}else{
echo "<tr><td colspan='6' class='text-secondary text-center' >No se encontró información para mostrar.</td></tr>";    
}

echo '</tbody></table>';

echo '</div>';
//---------------------------------------------
echo '<div class="col-6">';

echo '<table class="table table-bordered table-striped table-sm mb-0 pb-0" style="font-size: .9em;">
<tbody>
<tr>
<td><h6>Identificación y evaluación de Riesgos y Peligros para registrar el análisis.</h6></td>
<td class="text-center align-middle" width="30"><img src="'.RUTA_IMG_ICONOS.'pdf.png" style="cursor: pointer;" onclick="Formato3()"></td>
</tr>
</tbody>
</table>';

echo '<h6 class="mt-3">Fo.ADMONGAS.010 (Registro de la atención y el seguimiento a la comunicación interna y externa.)</h6>';

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

echo '</div>';
echo '</div>';

?>
<hr>