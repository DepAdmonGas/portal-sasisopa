<?php
require('../../../app/help.php');

$idModulo = $_GET['idModulo'];
$idTema   = $_GET['idTema'];

$sql = "SELECT * FROM tb_cursos_temas  WHERE id = '".$idTema."' ";
$query = mysqli_query($con, $sql);
while($row_modulo = mysqli_fetch_array($query, MYSQLI_ASSOC)){
$tituloTema = $row_modulo['titulo'];
}

$sql_usuarios = "SELECT * FROM tb_usuarios WHERE id_gas = '".$Session_IDEstacion."' and id_puesto <> 1 and estatus = 0 ";
$result_usuarios = mysqli_query($con, $sql_usuarios);
$numero_usuarios = mysqli_num_rows($result_usuarios);


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

?>
<script type="text/javascript">
$(document).ready(function(){
$('[data-toggle="tooltip"]').tooltip();
});

</script>
<div class="text-center p-2"><h5><?=$tituloTema;?></h5></div>
<?php if ($numero_usuarios > 0) {
?>

<div class="mb-2" style="overflow-y: hidden;">
<table class="table table-bordered table-striped table-hover table-sm" style="font-size: .9em;">
<thead>
<tr>
  <th class="text-center">#</th>
  <th class="text-center">Nombre Usuario</th>
  <th class="text-center">Puesto</th>
  <th class="text-center">Telefono</th>
  <th class="text-center">Email</th>
  <th class="text-center">Fecha Programada</th>
  <th class="text-center">Resultado</th>
</tr>
</thead>
<tbody>
<?php
while($row_usuarios = mysqli_fetch_array($result_usuarios, MYSQLI_ASSOC)){
$idusuario = $row_usuarios['id'];
$nombreusuario = $row_usuarios['nombre'];
$telefono = $row_usuarios['telefono'];
$email = $row_usuarios['email'];
$usuario = $row_usuarios['usuario'];
$idpuesto = $row_usuarios['id_puesto'];


$FechaProgramada = FechaProgramada($idusuario,$idTema,$fecha_year,$con);

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


if ($row_usuarios['estado'] == 0) {
$estadoimg = "<img src='".RUTA_IMG_ICONOS."activo.png' style='cursor: pointer;' data-toggle='tooltip' data-placement='right' title='Usuario activo'>";
}else if ($row_usuarios['estado'] == 1) {
$estadoimg = "<img src='".RUTA_IMG_ICONOS."noactivo.png' style='cursor: pointer;' data-toggle='tooltip' data-placement='right' title='Usuario cancelado'>";
}

$sql_puesto = "SELECT * FROM tb_puestos WHERE id = '$idpuesto' ";
$result_puesto = mysqli_query($con, $sql_puesto);
$numero_puesto = mysqli_num_rows($result_puesto);
while($row_puesto = mysqli_fetch_array($result_puesto, MYSQLI_ASSOC)){
$puesto = $row_puesto['tipo_puesto'];
}

echo "<tr>";
echo "<td class='text-center'>".$idusuario."</td>";
echo "<td>".$estadoimg." ".$nombreusuario."</td>";
echo "<td class='text-center'>".$puesto."</td>";
echo "<td class='text-center'>".$telefono."</td>";
echo "<td class='text-center'>".$email."</td>";
echo "<td class='text-center'><b>".$FechaProgramada['fechaprogramada']."</b></td>";
echo "<td class='text-center'>".$title."</td>";
echo "<td class='text-center align-middle' width='30'><img src='".RUTA_IMG_ICONOS."tiempo.png' style='cursor: pointer;' data-toggle='tooltip' data-placement='left' title='Programar Fecha' onclick='ProgramarFecha(".$idTema.",".$idusuario.")'></td>";
echo "<td class='text-center align-middle' width='30'><img width='16' src='".RUTA_IMG_ICONOS."contenido.png' style='cursor: pointer;' data-toggle='tooltip' data-placement='left' title='Fechas Programadas' onclick='ListaFechas(".$idTema.",".$idusuario.")'></td>";
echo "</tr>";
}
?>
</tbody>
</table>
</div>
<?php }else{
  echo "<div class='text-secondary text-center' >No se encontró información para mostrar.</div>";
} ?>

