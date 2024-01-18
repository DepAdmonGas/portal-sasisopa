<?php
require('../../../app/help.php');

$Year = $_GET['Year'];

function FechaProgramada($idusuario,$idTema,$year,$con){

$sql_modulo = "SELECT * FROM tb_cursos_calendario WHERE id_personal = '".$idusuario."' AND id_tema = '".$idTema."' AND YEAR(fecha_programada) = '".$year."' ORDER BY fecha_programada ASC";
$query_modulo = mysqli_query($con, $sql_modulo);
$numero_modulos = mysqli_num_rows($query_modulo);
while($row_modulo = mysqli_fetch_array($query_modulo, MYSQLI_ASSOC)){
$fechaprogramada = $row_modulo['fecha_programada'];
$fechareal = $row_modulo['fecha_real'];
$resultado = $row_modulo['resultado'];
$estado = $row_modulo['estado'];
}

if ($numero_modulos != 0) {
if ($fechareal != "0000-00-00") {
$fechap = FormatoFecha($fechareal);
}else{
$fechap = FormatoFecha($fechaprogramada);
}
}else{
$fechap = "S/I";	
}


  $array = array(
    "fechaprogramada" => $fechap,   
    "resultado" => $resultado,
    "estado" => $estado
  );

  return $array;
}

echo '<div style="overflow-y: hidden;">';
echo '<div class="pb-4"><div class="float-left"><h5>Año: '.$Year.'</h5></div>';
echo '</div>';

$sql_modulos_cursos = "SELECT * FROM tb_cursos_modulos ORDER BY num_modulo ASC"; 
$result_modulos_cursos = mysqli_query($con, $sql_modulos_cursos);
$numero_modulos_cursos  = mysqli_num_rows($result_modulos_cursos);
while($row_modulos_cursos = mysqli_fetch_array($result_modulos_cursos, MYSQLI_ASSOC)){

echo '<div class="bg-info p-2 text-white mt-2"><h6>'.$row_modulos_cursos['num_modulo'].'. '.$row_modulos_cursos['titulo'].'</h6></div>';
echo '<div class="text-right mt-2">
<a style="cursor: pointer;" href="public/sasisopa/vistas/descargar-capacitacion-interna.php?Year='.$Year.'&idModulo='.$row_modulos_cursos['id'].'"><img src="'.RUTA_IMG_ICONOS.'pdf.png"></a></div></div>';

$sql = "SELECT * FROM tb_cursos_temas WHERE id_modulo = '".$row_modulos_cursos['num_modulo']."' ORDER BY num_tema ASC"; 
$result = mysqli_query($con, $sql);
$numero  = mysqli_num_rows($result);
while($row = mysqli_fetch_array($result, MYSQLI_ASSOC)){
echo '<div class="bg-light p-2 mt-2 mb-2"><h6>'.$row['num_tema'].'. '.$row['titulo'].'</h6></div>';

echo '<table class="table table-bordered table-striped table-hover table-sm" style="font-size: .9em;">
<thead>
<tr>
  <th class="text-center">Nombre Usuario</th>
  <th class="text-center">Puesto</th>
  <th class="text-center">Telefono</th>
  <th class="text-center">Email</th>
  <th class="text-center">Fecha Programada</th>
  <th class="text-center">Resultado</th>
</tr>
</thead>
<tbody>';

$sql_usuarios = "SELECT * FROM tb_usuarios WHERE id_gas = '".$Session_IDEstacion."' and id_puesto <> 1 and estatus = 0 ";
$result_usuarios = mysqli_query($con, $sql_usuarios);
$numero_usuarios = mysqli_num_rows($result_usuarios);

while($row_usuarios = mysqli_fetch_array($result_usuarios, MYSQLI_ASSOC)){
$idusuario = $row_usuarios['id'];
$nombreusuario = $row_usuarios['nombre'];
$telefono = $row_usuarios['telefono'];
$email = $row_usuarios['email'];
$usuario = $row_usuarios['usuario'];
$idpuesto = $row_usuarios['id_puesto'];


$FechaProgramada = FechaProgramada($idusuario,$row['id'],$Year,$con);

$estadoModulo = $FechaProgramada['estado'];
$puntos      =  $FechaProgramada['resultado'];

if ($estadoModulo == 1) {
$calificacion = $puntos;

if($calificacion >= 90 && $calificacion <= 100){
$title = "<b class='text-success'>".$calificacion."% Excelente</b>";
}else if($calificacion >= 80 && $calificacion <= 89){
$title = "<b class='text-primary'>".$calificacion."% Bueno</b>";
}else if($calificacion >= 60 && $calificacion <= 79){
$title = "<b class='text-warning'>".$calificacion."% Regular</b>";
}else{
$title = "<b class='text-danger'>".$calificacion."% Malo</b>";
}

}else{
$title = "<b>S/I</b>";
}



$sql_puesto = "SELECT * FROM tb_puestos WHERE id = '$idpuesto' ";
$result_puesto = mysqli_query($con, $sql_puesto);
$numero_puesto = mysqli_num_rows($result_puesto);
while($row_puesto = mysqli_fetch_array($result_puesto, MYSQLI_ASSOC)){
$puesto = $row_puesto['tipo_puesto'];
}

echo "<tr>";
echo "<td>".$nombreusuario."</td>";
echo "<td class='text-center'>".$puesto."</td>";
echo "<td class='text-center'>".$telefono."</td>";
echo "<td class='text-center'>".$email."</td>";
echo "<td class='text-center'><b>".$FechaProgramada['fechaprogramada']."</b></td>";
echo "<td class='text-center'>".$title."</td>";
echo "</tr>";
}

echo '</tbody>
</table>';

}

}

echo '</div>';
?>
