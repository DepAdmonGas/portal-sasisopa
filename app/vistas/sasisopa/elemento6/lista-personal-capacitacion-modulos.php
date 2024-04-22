<?php
require('../../../../app/help.php');
include_once "../../../../app/modelo/Cursos.php";
$class_cursos = new Cursos();

$idModulo = $_GET['idModulo'];
$idTema   = $_GET['idTema'];

$tituloTema = $class_cursos->tituloTema($idTema);

$sql_usuarios = "SELECT * FROM tb_usuarios WHERE id_gas = '".$Session_IDEstacion."' and id_puesto <> 1 and estatus = 0 ";
$result_usuarios = mysqli_query($con, $sql_usuarios);
$numero_usuarios = mysqli_num_rows($result_usuarios);

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


$FechaProgramada = $class_cursos->FechaProgramada($idusuario,$idTema,$fecha_year);

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


if ($row_usuarios['estatus'] == 0) {
$estadoimg = "<img src='".RUTA_IMG_ICONOS."activo.png' style='cursor: pointer;' data-toggle='tooltip' data-placement='right' title='Usuario activo'>";
}else if ($row_usuarios['estatus'] == 1) {
$estadoimg = "<img src='".RUTA_IMG_ICONOS."noactivo.png' style='cursor: pointer;' data-toggle='tooltip' data-placement='right' title='Usuario cancelado'>";
}

$sql_puesto = "SELECT tipo_puesto FROM tb_puestos WHERE id = '$idpuesto' ";
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
echo "<td class='text-center align-middle' width='30'><img src='".RUTA_IMG_ICONOS."tiempo.png' style='cursor: pointer;' data-toggle='tooltip' data-placement='left' title='Programar Fecha' onclick='ProgramarFecha(".$idModulo.",".$idTema.",".$idusuario.")'></td>";
echo "<td class='text-center align-middle' width='30'><img width='16' src='".RUTA_IMG_ICONOS."contenido.png' style='cursor: pointer;' data-toggle='tooltip' data-placement='left' title='Fechas Programadas' onclick='ListaFechas(".$idModulo.",".$idTema.",".$idusuario.")'></td>";
echo "</tr>";
}
?>
</tbody>
</table>
</div>
<?php }else{
  echo "<div class='text-secondary text-center' >No se encontró información para mostrar.</div>";
} ?>

