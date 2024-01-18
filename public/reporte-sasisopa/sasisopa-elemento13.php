<?php
require('../../app/help.php');

$FechaInicio = date('Y-m-d', $_GET['FechaInicio']);
$FechaTermino = date('Y-m-d', $_GET['FechaTermino']);

$sql_programa = "SELECT * FROM tb_programa_anual_simulacros WHERE id_estacion = '".$Session_IDEstacion."' AND fecha BETWEEN '".$FechaInicio."' AND '".$FechaTermino."' ORDER BY fecha DESC ";
$result_programa = mysqli_query($con, $sql_programa);
$numero_programa = mysqli_num_rows($result_programa);

function PersonalA($id, $con){
$sql_personal = "SELECT * FROM tb_programa_anual_simulacros_personal WHERE id_programa = '".$id."' ";
$result_personal = mysqli_query($con, $sql_personal);
$numero_personal = mysqli_num_rows($result_personal);
return $numero_personal;
}

function Resumen($id, $con){
$sql_resumen = "SELECT resumen FROM tb_programa_anual_simulacros_resumen WHERE id_programa = '".$id."' ";
$result_resumen = mysqli_query($con, $sql_resumen);
$numero_resumen = mysqli_num_rows($result_resumen);
while($row = mysqli_fetch_array($result_resumen, MYSQLI_ASSOC)){
$numero_resumen = $row['resumen'];
}
return $numero_resumen;
}

function Evaluacion($id, $con){
$sql_evaluacion = "SELECT * FROM tb_programa_anual_simulacros_evaluacion WHERE id_programa = '".$id."' order by fechacreacion desc LIMIT 1";
$result_evaluacion = mysqli_query($con, $sql_evaluacion);
$numero_evaluacion = mysqli_num_rows($result_evaluacion);
while($row_evaluacion = mysqli_fetch_array($result_evaluacion, MYSQLI_ASSOC)){
$img_evaluacion = $row_evaluacion['archivo'];
}
return $img_evaluacion;
}
?>
<h4>13. PREPARACIÓN Y RESPUESTA A EMERGENCIAS</h4>

<table class="table table-bordered table-striped table-sm mb-0 pb-0" style="font-size: .9em;">
<tbody>
<tr>
<td><h6>Programa anual de simulacros</h6></td>
<td class="text-center align-middle" width="30">
<a href="../../public/reporte-sasisopa/descargar-programa-simulacro-pdf.php?FechaInicio=<?=$_GET['FechaInicio'];?>&FechaTermino=<?=$_GET['FechaTermino'];?>">
<img src="<?=RUTA_IMG_ICONOS;?>pdf.png" style="cursor: pointer;">
</a>
</td>
</tr>
</tbody>
</table>

<table class="table table-bordered table-striped table-hover table-sm mt-3">
<thead>
<th class="text-center align-middle">Nombre del simulacro</th>
<th class="text-center align-middle">Periodicidad</th>
<th class="text-center align-middle">Fecha</th>
<th class="text-center align-middle"><span class="badge badge-primary">1</span> Personal que asiste</th>
<th class="text-center align-middler"><span class="badge badge-primary">2</span> Resumen</th>
<th class="text-center align-middle"><span class="badge badge-primary">3</span> Evaluación (Fo.ADMONGAS.016a)</th>
</thead>	
<tbody>
<?php
if ($numero_programa > 0) {
while($row_programa = mysqli_fetch_array($result_programa, MYSQLI_ASSOC)){
$id = $row_programa['id'];

$personal = PersonalA($id, $con);

if ($personal == 0) {
$PersonalA = "No se encontró personal";
}else{
$PersonalA = $personal." personas";
}

$Resumen = Resumen($id, $con);


$Evaluacion = Evaluacion($id, $con);

if ($Evaluacion == "") {
$imgPDF = "<img src='".RUTA_IMG_ICONOS."sin-archivo.png'>";
}else{
$imgPDF = "<a target='_blank' href='../../".$Evaluacion."' ><img src='".RUTA_IMG_ICONOS."archivo.png'></a>";
}

 

echo "<tr>";
echo "<td class='align-middle text-center'>".$row_programa['nombre_simulacro']."</td>";
echo "<td class='text-center align-middle'>".$row_programa['periodicidad']."</td>";
echo "<td class='align-middle text-center'>".FormatoFecha($row_programa['fecha'])."</td>";
echo "<td class='text-center align-middle'>".$PersonalA."</td>";
echo "<td class='text-center align-middle' >".$Resumen."</td>";
echo "<td class='text-center align-middle' style='cursor: pointer;' >".$imgPDF."</td>";
echo "</tr>";

}
}else{
echo "<tr><td colspan='12' class='text-center'><small>No se encontró información para mostrar</small></td></tr>";	
}
?>	
</tbody>
</table>

<hr>