<?php
require('../../../app/help.php');

if ($Session_EstadoUsuario == 0) {
 echo
 "
 <script type='text/javascript'>
 $('#ConfigAgregarUsuario').modal('show');
 </script>
 ";
}

$sql_usuarios = "SELECT * FROM tb_usuarios WHERE id_gas = '".$Session_IDEstacion."' and id_puesto <> 1 and estatus = 0 ";
$result_usuarios = mysqli_query($con, $sql_usuarios);
$numero_usuarios = mysqli_num_rows($result_usuarios);

function Porcentaje($idusuario, $con){

$total = 0;
$totalpuntos = 9;

$sql_usuarios = "SELECT * FROM tb_usuarios WHERE id = '".$idusuario."' ";
$result_usuarios = mysqli_query($con, $sql_usuarios);
$numero_usuarios = mysqli_num_rows($result_usuarios); 
while($row_usuarios = mysqli_fetch_array($result_usuarios, MYSQLI_ASSOC)){

$email = $row_usuarios['email'];
$telefono = $row_usuarios['telefono'];
$fecha_nacimiento = $row_usuarios['fecha_nacimiento'];
$estado_civil = $row_usuarios['estado_civil'];
$seguro_social = $row_usuarios['seguro_social'];
$domicilio = $row_usuarios['domicilio'];

if ($email != "") {
$total = $total + 1;
}else{
$total = $total + 0;
}

if ($telefono != "") {
$total = $total + 1;
}else{
$total = $total + 0;
}

if ($fecha_nacimiento != "0000-00-00") {
$total = $total + 1;
}else{
$total = $total + 0;
}

if ($estado_civil != "") {
$total = $total + 1;
}else{
$total = $total + 0;
}

if ($seguro_social != "") {
$total = $total + 1;
}else{
$total = $total + 0;
}

if ($domicilio != "") {
$total = $total + 1;
}else{
$total = $total + 0;
}


}

$sql_usuarios_f = "SELECT * FROM tb_usuarios_familiares WHERE id_usuario = '".$idusuario."' ";
$result_usuarios_f = mysqli_query($con, $sql_usuarios_f);
$numero_usuarios_f = mysqli_num_rows($result_usuarios_f); 

if ($numero_usuarios_f >= 1) {
$total = $total + 1;
}else{
$total = $total + 0;  
}

$sql_usuarios_fa = "SELECT * FROM tb_usuarios_formacion_academica WHERE id_usuario = '".$idusuario."' ";
$result_usuarios_fa = mysqli_query($con, $sql_usuarios_fa);
$numero_usuarios_fa = mysqli_num_rows($result_usuarios_fa); 

if ($numero_usuarios_fa >= 1) {
$total = $total + 1;
}else{
$total = $total + 0;  
}

$sql_usuarios_el = "SELECT * FROM tb_usuarios_experiencia_laboral WHERE id_usuario = '".$idusuario."' ";
$result_usuarios_el = mysqli_query($con, $sql_usuarios_el);
$numero_usuarios_el = mysqli_num_rows($result_usuarios_el); 

if ($numero_usuarios_el >= 1) {
$total = $total + 1;
}else{
$total = $total + 0;  
}

$porcentaje   =  $totalpuntos * 10;
$resultado = $total;   

$puntosTotal =  ($resultado / $porcentaje) * 100;
$Promedio = $puntosTotal * 10;

return $Promedio;
}
?>
<script type="text/javascript">
$(document).ready(function(){
$('[data-toggle="tooltip"]').tooltip();
});

function VerFicha(idUsuario){
window.location.href = "ficha-personal/"+idUsuario;
}

</script>
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
  <th class="text-center">Cumplimiento</th>
  <th></th>
  <th></th>
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

$porcentaje = Porcentaje($idusuario, $con);
$formatporcentaje = number_format($porcentaje, 2, '.', '');

if ($formatporcentaje >= "80") {
$textStyle = "text-success";
}else if($formatporcentaje <= "80" && $formatporcentaje >= "60"){
$textStyle = "text-warning";
}else if($formatporcentaje <= "60" && $formatporcentaje >= "0"){
$textStyle = "text-danger";
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
echo "<td class='text-center align-middle font-weight-bold ".$textStyle."'>".$formatporcentaje."%</td>";

echo "<td class='text-center align-middle' width='30'><img src='".RUTA_IMG_ICONOS."pdf-16.png' style='cursor: pointer;' data-toggle='tooltip' data-placement='left' title='Ficha del usuario' onclick='FichaPersonal(".$idusuario.")'></td>";

echo "<td class='text-center align-middle' width='30'><img src='".RUTA_IMG_ICONOS."ojo-black-16.png' style='cursor: pointer;' data-toggle='tooltip' data-placement='left' title='Ver ficha del usuario' onclick='VerFicha(".$idusuario.")'></td>";
echo "</tr>";
}
?>
</tbody>
</table>
</div>
<?php }else{
  echo "<div class='text-secondary text-center' >No se encontraron usuarios almacenados en la estación de servicio.</div>";
} ?>

