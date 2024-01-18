<?php
require('../../app/help.php');

$FechaInicio = date('Y-m-d', $_GET['FechaInicio']);
$FechaTermino = date('Y-m-d', $_GET['FechaTermino']);

?>
<h4>18. INFORMES DE DESEMPEÑO</h4>
<?php 

$sql1 = "SELECT * FROM tb_evaluacion_desempeno WHERE id_estacion = '".$Session_IDEstacion."' AND fecha_hora BETWEEN '".$FechaInicio."' AND '".$FechaTermino."' ORDER BY fecha_hora DESC ";
$result1 = mysqli_query($con, $sql1);
$numero1 = mysqli_num_rows($result1);

$sql2 = "SELECT * FROM tb_implementacion_sasisopa WHERE id_estacion = '".$Session_IDEstacion."' AND fecha_hora BETWEEN '".$FechaInicio."' AND '".$FechaTermino."' ORDER BY fecha_hora DESC ";
$result2 = mysqli_query($con, $sql2);
$numero2 = mysqli_num_rows($result2);

echo '<div class="row">';
echo '<div class="col-6">';
echo '<h6>Informe de Evaluación de Desempeño (IED)</h6>';

echo '<table class="table table-bordered table-striped table-hover table-sm pb-0 mb-0" style="font-size: .9em;">
<thead>
<tr>
  <th class="text-center">#</th>
  <th class="">Fecha</th>
  <th class="">Nombre completo</th>  
  <th width="32"><img src="'.RUTA_IMG_ICONOS.'pdf.png"></th>
</tr>
</thead>
<tbody>';

$num1 = 1;
if ($numero1 > 0) {
while($row1 = mysqli_fetch_array($result1, MYSQLI_ASSOC)){

$id1 = $row1['id'];
$explode = explode(" ", $row1['fecha_hora']);

$sql_usuario = "SELECT nombre FROM tb_usuarios WHERE id = '".$row1['id_usuario']."' ";
$result_usuario = mysqli_query($con, $sql_usuario);
while($row_usuario = mysqli_fetch_array($result_usuario, MYSQLI_ASSOC)){
$nomencargado = $row_usuario['nombre'];
}

$imgPDF = "<a target='_blank' href='../../".$row1['archivo']."' ><img src='".RUTA_IMG_ICONOS."pdf.png'></a>";

echo '<tr>
<td class="text-center"><b>'.$num1.'</b></td>
<td>'.FormatoFecha($explode[0]).'</td>
<td>'.$nomencargado.'</td>
<td class="text-center">'.$imgPDF.'</td>
</tr>';

$num1 = $num1 + 1;
}
}else{
echo "<tr><td colspan='4' class='text-secondary text-center' >No se encontró información para mostrar.</td></tr>";    
}

echo '</tbody></table>';

echo '</div>';
//---------------------------------------------
echo '<div class="col-6">';
echo '<h6>Control de la implementación de los procedimientos del SASISOPA (Fo.ADMONGAS.029)</h6>';

echo '<table class="table table-bordered table-striped table-sm pb-0 mb-0" style="font-size: .9em;">
<thead> 
<tr>
<th class="text-center align-middle">#</th>
<th class="text-center align-middle">Fecha</th>
<th class="text-center align-middle">Nombre completo</th>
<th width="32"><img src="'.RUTA_IMG_ICONOS.'pdf.png"></th>
</tr>
</thead>
<tbody>';

$num2 = 1;
if ($numero2 > 0) {
while($row2 = mysqli_fetch_array($result2, MYSQLI_ASSOC)){

$id2 = $row2['id'];
$explode2 = explode(" ", $row2['fecha_hora']);

$sql_usuario = "SELECT nombre FROM tb_usuarios WHERE id = '".$row2['id_usuario']."' ";
$result_usuario = mysqli_query($con, $sql_usuario);
while($row_usuario = mysqli_fetch_array($result_usuario, MYSQLI_ASSOC)){
$nomencargado = $row_usuario['nombre'];
}

echo "<tr>
<td class='text-center'><b>".$num2."</b></td>
<td class='text-center'>".FormatoFecha($explode[0])."</td>
<td class='text-center'>".$nomencargado."</td>
<td class='text-center align-middle' width='30px' style='cursor: pointer;'><img src='".RUTA_IMG_ICONOS."pdf.png' width='20px' onclick='DescargarIS(".$id2.")'></td>
</tr>";

$num2 = $num2 + 1;
}
}else{
echo "<td colspan='4' class='text-center text-secondary' style='font-size: .8em;'>No se encontró información para mostrar</td>";

}
 
echo '</tbody></table>';

echo '</div>';
echo '</div>';

?>
<hr>