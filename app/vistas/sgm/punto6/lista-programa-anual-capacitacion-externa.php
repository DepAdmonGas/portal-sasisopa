<?php
require('../../../../app/help.php');

function usuario($usuario,$con){
  $sql = "SELECT tb_usuarios.nombre, 
  tb_usuarios.firma, 
  tb_puestos.tipo_puesto
  FROM tb_usuarios
  INNER JOIN tb_puestos
  ON tb_usuarios.id_puesto = tb_puestos.id WHERE tb_usuarios.id = '".$usuario."' ";
  $result = mysqli_query($con, $sql);
  $numero = mysqli_num_rows($result);
  $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
  $Nombre = $row['nombre'];
  $puesto = $row['tipo_puesto'];
  $firma = $row['firma'];

  $array = array('nombre' => $Nombre, 'puesto' => $puesto, 'firma' => $firma);
  return $array;
  }

$sql = "SELECT * FROM sgm_programa_anual_capacitacion_externa WHERE id_estacion = '".$Session_IDEstacion."' ORDER BY fecha_programada DESC";
$result = mysqli_query($con, $sql);
$numero = mysqli_num_rows($result);

function Personal($id,$con){
$return = '';
$num = 1;
$sql = "SELECT * FROM sgm_programa_anual_capacitacion_externa_personal WHERE id_capacitacion  = '".$id."'";
$result = mysqli_query($con, $sql);
$numero = mysqli_num_rows($result);
while($row = mysqli_fetch_array($result, MYSQLI_ASSOC)){
if($numero == $num){
$sep = '';
}else{
$sep = ',';
}
$usuario = usuario($row['id_usuario'],$con);
$return .= '<small>'.$usuario['nombre'].'</small>'.$sep.' ';
$num++;
}
return $return;
}

function Evidencia($id,$con){
$return = '';
$num = 1;
$sql = "SELECT * FROM sgm_programa_anual_capacitacion_externa_evidencia WHERE id_capacitacion  = '".$id."'";
$result = mysqli_query($con, $sql);
$numero = mysqli_num_rows($result);
while($row = mysqli_fetch_array($result, MYSQLI_ASSOC)){
if($numero == $num){
$sep = '';
}else{
$sep = ',';
}

$return .= '<small><a target="BLANK" href="'.RUTA_ARCHIVOS.'sgm/'.$row['archivo'].'">'.$row['archivo'].'</small><a>'.$sep.' ';
$num++;
}
return $return;
}
?>

<table class="table table-bordered table-striped table-hover table-sm mb-0 pb-0">
<thead>
<tr>
  <th class="text-center align-middle">No</th>
  <th class="text-center align-middle">Nombre del curso</th>
  <th class="text-center align-middle">Tipo de capacitacion</th>
  <th class="text-center align-middle">Fecha programada</th>
  <th class="text-center align-middle">Duracion</th>
  <th class="text-center align-middle">Instructor</th>
  <th class="text-center align-middle">Fecha real de la toma del curso</th>
  <th class="text-center align-middle">Nombre de las personas que asistieron al curso</th>
  <th class="text-center align-middle">Evidencia</th>
  <th width="32"></th>
  <th width="32"></th>
</tr>
</thead>
<tbody>
<?php
$num = 1;
if ($numero > 0) {
while($row = mysqli_fetch_array($result, MYSQLI_ASSOC)){

	if($row['fecha_real'] != '0000-00-00'){
	$fecha_real = FormatoFecha($row['fecha_real']);
	}else{
	$fecha_real = 'S/I';
	}

echo "<tr>";
echo "<td class='text-center align-middle'>".$num."</td>";

echo "<td class='text-center align-middle'>".$row['nombre_curso']."</td>";
echo "<td class='text-center align-middle'>".$row['tipo_capacitacion']."</td>";
echo "<td class='text-center align-middle'>".FormatoFecha($row['fecha_programada'])."</td>";
echo "<td class='text-center align-middle'>".$row['duracion']."</td>";
echo "<td class='text-center align-middle'>".$row['instructor']."</td>";
echo "<td class='text-center align-middle'>".$fecha_real."</td>";
echo "<td class='text-center align-middle'>".Personal($row['id'],$con)."</td>";
echo "<td class='text-center align-middle'>".Evidencia($row['id'],$con)."</td>";

echo "<td class='text-center align-middle' width='30'><img src='".RUTA_IMG_ICONOS."editar.png' style='cursor: pointer;' data-toggle='tooltip' data-placement='left' title='Editar' onclick='modalAgregar(".$row['id'].")'></td>";

echo "<td class='text-center align-middle' width='30'><img src='".RUTA_IMG_ICONOS."eliminar.png' style='cursor: pointer;' data-toggle='tooltip' data-placement='left' title='Eliminar' onclick='Eliminar(".$row['id'].",5)'></td>";
echo "</tr>";
$num++;
}
}else{
echo "<td colspan='12' class='text-center text-secondary' style='font-size: .8em;'>No se encontró información para mostrar</td>";
}
?>
</tbody>
</table>