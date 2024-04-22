<?php
require('../../../../app/help.php');
include_once "../../../../app/modelo/Cursos.php";

$class_cursos = new Cursos();

$Year = $_GET['Year'];

echo '<div style="overflow-y: hidden;">';
echo '<div class="pb-4"><div class="float-left"><h5>Año: '.$Year.'</h5></div>';
echo '</div>';

$sql_modulos_cursos = "SELECT * FROM tb_cursos_modulos ORDER BY num_modulo ASC"; 
$result_modulos_cursos = mysqli_query($con, $sql_modulos_cursos);
$numero_modulos_cursos  = mysqli_num_rows($result_modulos_cursos);
while($row_modulos_cursos = mysqli_fetch_array($result_modulos_cursos, MYSQLI_ASSOC)){

echo '<div class="bg-info p-2 text-white mt-2"><h6>'.$row_modulos_cursos['num_modulo'].'. '.$row_modulos_cursos['titulo'].'</h6></div>';
echo '<div class="text-right mt-2">Programa de Capacitacion y
adiestramiento 
<a style="cursor: pointer;" href="app/vistas/sasisopa/elemento6/descargar-capacitacion-interna.php?Year='.$Year.'&idModulo='.$row_modulos_cursos['id'].'"><img src="'.RUTA_IMG_ICONOS.'pdf.png"></a></div></div>';
echo '<div class="text-right mt-2">Reconocimientos personal
<a style="cursor: pointer;" onclick="ReconocimientosPersonal('.$Year.','.$row_modulos_cursos['id'].')" ><img src="'.RUTA_IMG_ICONOS.'pdf.png"></a></div></div>';

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
  <th class="text-center"></th>
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


$FechaProgramada = $class_cursos->FechaProgramada($idusuario,$row['id'],$Year);

$idCalendario = $FechaProgramada['idCalendario'];
$estadoModulo = $FechaProgramada['estado'];
$puntos      =  $FechaProgramada['resultado'];

if ($estadoModulo == 1) {
$calificacion = $puntos;

if($calificacion >= 90 && $calificacion <= 100){
$title = "<b class='text-success'>".$calificacion."% Excelente</b>";
$Reconocimiento = '<a style="cursor: pointer;" onclick="Reconocimiento('.$idCalendario.')"><img src="'.RUTA_IMG_ICONOS.'pdf.png"></a>';
}else if($calificacion >= 80 && $calificacion <= 89){
$title = "<b class='text-primary'>".$calificacion."% Bueno</b>";
$Reconocimiento = '<a style="cursor: pointer;" onclick="Reconocimiento('.$idCalendario.')"><img src="'.RUTA_IMG_ICONOS.'pdf.png"></a>';
}else if($calificacion >= 60 && $calificacion <= 79){
$title = "<b class='text-warning'>".$calificacion."% Regular</b>";
$Reconocimiento = '<a style="cursor: pointer;" onclick="Reconocimiento('.$idCalendario.')"><img src="'.RUTA_IMG_ICONOS.'pdf.png"></a>';
}else{
$title = "<b class='text-danger'>".$calificacion."% Malo</b>";
$Reconocimiento = '';
}

}else{
$title = "<b>S/I</b>";
$Reconocimiento = '';
}



$sql_puesto = "SELECT tipo_puesto FROM tb_puestos WHERE id = '$idpuesto' ";
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
echo '<td class="text-center">'.$Reconocimiento.'</td>';
echo "</tr>";
}

echo '</tbody>
</table>';

}

}

echo '</div>';
?>
