<?php
require('../../app/help.php');

$FechaInicio = date('Y-m-d', $_GET['FechaInicio']);
$FechaTermino = date('Y-m-d', $_GET['FechaTermino']);

$Explode1 = explode("-", $FechaInicio);
$YI = $Explode1[0];

$Explode2 = explode("-", $FechaTermino);
$YF = $Explode2[0];

$sql_auditoria = "SELECT * FROM tb_auditoria_interna WHERE id_estacion= '".$Session_IDEstacion."' AND fechacreacion BETWEEN '".$FechaInicio."' AND '".$FechaTermino."' ORDER BY id desc ";
$result_auditoria = mysqli_query($con, $sql_auditoria);
$numero_auditoria = mysqli_num_rows($result_auditoria);

function formatos($id, $formato, $con){
$sql_archivo = "SELECT * FROM tb_auditoria_interna_formato WHERE id_auditoria = '".$id."' AND formato = '".$formato."' ORDER BY id asc ";
$result_archivo = mysqli_query($con, $sql_archivo);
$numero_archivo = mysqli_num_rows($result_archivo);
while($row_archivo = mysqli_fetch_array($result_archivo, MYSQLI_ASSOC)){
$archivo = $row_archivo['archivo'];
}
return $archivo;
}

$sql2 = "SELECT * FROM tb_auditoria_externa WHERE id_estacion= '".$Session_IDEstacion."' AND fechacreacion BETWEEN '".$FechaInicio."' AND '".$FechaTermino."' ORDER BY id desc ";
$result2 = mysqli_query($con, $sql2);
$numero2 = mysqli_num_rows($result2);


function formatosAE($id, $formato, $con){

$sql_archivo = "SELECT * FROM tb_auditoria_externa_formato WHERE id_auditoria = '".$id."' AND formato = '".$formato."' ORDER BY id asc ";
$result_archivo = mysqli_query($con, $sql_archivo);
$numero_archivo = mysqli_num_rows($result_archivo);
while($row_archivo = mysqli_fetch_array($result_archivo, MYSQLI_ASSOC)){
$archivo = $row_archivo['archivo'];
}
return $archivo;
}
?>
<h4>15. AUDITORÍAS</h4>
<table class="table table-bordered table-striped table-sm mb-0 pb-0" style="font-size: .9em;">
<tbody>
<tr>
<td><h6>Formato Programa de auditorias (Internas y externas)</h6></td>
<td class="text-center align-middle" width="30"><img src="<?=RUTA_IMG_ICONOS;?>pdf.png" style="cursor: pointer;" onclick="DescargarProgramaAuditoria(<?=$YI;?>,<?=$YF;?>)"></td>
</tr>
</tbody>
</table>

<h6 class="mt-2">Auditoria interna</h6>
<table class="table table-bordered table-striped table-hover table-sm">
<thead>
<th class="text-center">#</th>
<th class="text-center">Fecha</th>
<th class="text-center">Auditor</th>
<th class="text-center">Fo.ADMONGAS.024 <small>(INFORME DE AUDITORÍA)</small></th>
<th class="text-center">Fo.ADMONGAS.025 <small>(PLAN DE ATENCIÓN DE HALLAZGOS)</small></th>
</thead>
<tbody>
<?php
if ($numero_auditoria > 0) {
while($row_auditoria = mysqli_fetch_array($result_auditoria, MYSQLI_ASSOC)){
$id = $row_auditoria['id'];
$fechahora = explode(" ", $row_auditoria['fechacreacion']);

$formato024 = formatos($id, 'formato024', $con);
$formato025 = formatos($id, 'formato025', $con);

if ($formato024 != "") {
$F024 = "<a target='_BLANK' href='../../".$formato024."'><img src='".RUTA_IMG_ICONOS."pdf.png'></a>";	
}else{
$F024 = "<img src='".RUTA_IMG_ICONOS."sin-archivo.png'>";	
}

if ($formato025 != "") {
$F025 = "<a target='_BLANK' href='../../".$formato025."'><img src='".RUTA_IMG_ICONOS."pdf.png'></a>";	
}else{
$F025 = "<img src='".RUTA_IMG_ICONOS."sin-archivo.png'>";	
}
 
echo "<tr>";
echo "<td class='text-center align-middle' id='td1".$id."'>".$id."</td>";
echo "<td class='text-center align-middle' id='td2".$id."'>".FormatoFecha($fechahora[0])."</td>";
echo "<td class='text-center align-middle' id='td3".$id."'>".$row_auditoria['auditor']."</td>";
echo "<td class='text-center align-middle' id='td6".$id."'>".$F024."</td>";
echo "<td class='text-center align-middle' id='td9".$id."'>".$F025."</td>";
echo "</tr>";

}
}else{
echo "<tr><td colspan='10' class='text-center'><small>No se encontró información para mostrar</small></td></tr>";	
}
?>
</tbody>
</table>
<h6 class="mt-2">Auditoria externa</h6>

<table class="table table-bordered table-striped table-hover table-sm">
<thead>
<th class="text-center">#</th>
<th class="text-center">Fecha</th>
<th class="text-center">Prestador de servicio</th>
<th class="text-center">Fo.ADMONGAS.024 <small>(INFORME DE AUDITORÍA)</small></th>
<th class="text-center">Fo.ADMONGAS.025 <small>(PLAN DE ATENCIÓN DE HALLAZGOS)</small></th>
<th class="text-center">ASEA</th>
</thead>
<tbody>
<?php
if ($numero2 > 0) {
while($row2 = mysqli_fetch_array($result2, MYSQLI_ASSOC)){
$id2 = $row2['id'];
$fechahora = explode(" ", $row2['fechacreacion']);

$formato0242 = formatosAE($id2, 'formato024', $con);
$formato0252 = formatosAE($id2, 'formato025', $con);

if ($formato0242 != "") {
$F0242 = "<a target='_BLANK' href='../../".$formato0242."'><img src='".RUTA_IMG_ICONOS."pdf.png'></a>";	
}else{
$F0242 = "<img src='".RUTA_IMG_ICONOS."sin-archivo.png'>";	
}

if ($formato0252 != "") {
$F0252 = "<a target='_BLANK' href='../../".$formato0252."'><img src='".RUTA_IMG_ICONOS."pdf.png'></a>";	
}else{
$F0252 = "<img src='".RUTA_IMG_ICONOS."sin-archivo.png'>";	
}

echo "<tr>";
echo "<td class='text-center align-middle' >".$id."</td>";
echo "<td class='text-center align-middle' >".FormatoFecha($fechahora[0])."</td>";
echo "<td class='text-center align-middle' >".$row2['prestador_servicio']."</td>";
echo "<td class='text-center align-middle' >".$F0242."</td>";
echo "<td class='text-center align-middle' >".$F0252."</td>";
echo "<td class='text-center align-middle' ><a class='c-pointer' onclick='ModalAsea(".$id2.")'><img src='".RUTA_IMG_ICONOS."asea.png'></a></td>";
echo "</tr>";

}
}else{
echo "<tr><td colspan='10' class='text-center'><small>No se encontró información para mostrar</small></td></tr>";	
}
?>
</tbody>
</table>
<hr>