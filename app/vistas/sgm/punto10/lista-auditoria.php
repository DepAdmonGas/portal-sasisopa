<?php
require('../../../../app/help.php');

$sql = "SELECT * FROM sgm_auditoria WHERE id_estacion = '".$Session_IDEstacion."' ";
$result = mysqli_query($con, $sql);
$numero = mysqli_num_rows($result);

function valida18($id,$con){
$sql_lista = "SELECT id FROM sgm_plan_auditoria WHERE id_auditoria = '".$id."' ";
$result_lista = mysqli_query($con, $sql_lista);
return $numero_lista = mysqli_num_rows($result_lista);
}

function valida19($id,$con){
$sql_lista = "SELECT id FROM sgm_hallazgo_auditoria WHERE id_auditoria = '".$id."' ";
$result_lista = mysqli_query($con, $sql_lista);
return $numero_lista = mysqli_num_rows($result_lista);
}

function valida20($id,$con){
$sql_lista = "SELECT id FROM sgm_plan_atencion_hallazgos WHERE id_auditoria = '".$id."' ";
$result_lista = mysqli_query($con, $sql_lista);
return $numero_lista = mysqli_num_rows($result_lista);
}
?>
<table class="table table-bordered table-striped table-hover table-sm">
<thead>
<tr>
  <th class="text-center align-middle">#</th>
  <th class="text-center align-middle">Año</th>
  <th class="text-center align-middle" colspan="2" width="300px">Fo.SGM.018 Plan de Auditoria</th>
  <th class="text-center align-middle" colspan="2" width="300px">Fo.SGM.019 Reporte e Hallazgos de Auditoria</th>
  <th class="text-center align-middle" colspan="2" width="300px">Fo.SGM.020 Plan de atencion de Hallazgos</th>
</tr>
</thead>
<tbody>
<?php
$num = 1;
if ($numero > 0) {
while($row = mysqli_fetch_array($result, MYSQLI_ASSOC)){

$valida18 = valida18($row['id'],$con);
if($valida18 == 1){
$pdf18 = '<img onclick="Descargar('.$row['id'].',18)" src="'.RUTA_IMG_ICONOS.'pdf.png" style="cursor: pointer;" >';
}else{
$pdf18 = '<img src="'.RUTA_IMG_ICONOS.'img-no-24.png" style="cursor: pointer;" >';
}

$valida19 = valida19($row['id'],$con);
if($valida19 == 1){
$pdf19 = '<img onclick="Descargar('.$row['id'].',19)" src="'.RUTA_IMG_ICONOS.'pdf.png" style="cursor: pointer;" >';
}else{
$pdf19 = '<img src="'.RUTA_IMG_ICONOS.'img-no-24.png" style="cursor: pointer;" >';
}

$valida20 = valida20($row['id'],$con);
if($valida20 == 1){
$pdf20 = '<img onclick="Descargar('.$row['id'].',20)" src="'.RUTA_IMG_ICONOS.'pdf.png" style="cursor: pointer;" >';
}else{
$pdf20 = '<img src="'.RUTA_IMG_ICONOS.'img-no-24.png" style="cursor: pointer;" >';
}

echo '<tr>
<td class="text-center align-middle">'.$num.'</td>
<td class="text-center align-middle">'.$row['year'].'</td>
<td width="150px" class="text-center align-middle" onclick="Editar('.$row['id'].',18)"><img src="'.RUTA_IMG_ICONOS.'editar.png" style="cursor: pointer;" ></td>
<td width="150px" class="text-center align-middle">'.$pdf18.'</td>

<td width="150px" class="text-center align-middle" onclick="Editar('.$row['id'].',19)"><img src="'.RUTA_IMG_ICONOS.'editar.png" style="cursor: pointer;" ></td>
<td width="150px" class="text-center align-middle">'.$pdf19.'</td>

<td width="150px" class="text-center align-middle" onclick="Editar('.$row['id'].',20)"><img src="'.RUTA_IMG_ICONOS.'editar.png" style="cursor: pointer;" ></td>
<td width="150px" class="text-center align-middle">'.$pdf20.'</td>
</tr>';

$num++;
}
}else{
echo "<td colspan='9' class='text-center text-secondary' style='font-size: .8em;'>No se encontró información para mostrar</td>";
}
?>
</tbody>
</table>


