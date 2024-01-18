<?php
require('../../../app/help.php');


$sql_comunicado = "SELECT * FROM se_comunicacion_i_e WHERE id = '".$_GET['idcomunicado']."' ";
$result_comunicado = mysqli_query($con, $sql_comunicado);
$numero_comunicado = mysqli_num_rows($result_comunicado);
while($row_comunicado = mysqli_fetch_array($result_comunicado, MYSQLI_ASSOC)){

$temac = $row_comunicado['tema'];
$detalleComu = $row_comunicado['detalle'];
$fecha = $row_comunicado['fecha'];
$dirigidoa = $row_comunicado['dirigidoa'];

if ($row_comunicado['archivo'] != "") {
$img_archivo = "<a href='".$archivo."' download style='cursor:pointer;' data-toggle='tooltip' data-placement='right' title='Descargar archivo'><img src='".RUTA_IMG_ICONOS."documento.png'></a>";
}else{
$img_archivo = "";
}

$sql_usuario = "SELECT nombre FROM tb_usuarios WHERE id = '".$row_comunicado['encargado_comunicacion']."' ";
$result_usuario = mysqli_query($con, $sql_usuario);
while($row_usuario = mysqli_fetch_array($result_usuario, MYSQLI_ASSOC)){
$nomencargado = $row_usuario['nombre']." ".$row_usuario['apellido_p']." ".$row_usuario['apellido_m'];
}

$tipocomunicacion = $row_comunicado['tipo_comunicacion'];
$material = $row_comunicado['material'];
$seguimiento = $row_comunicado['seguimiento'];
$url = $row_comunicado['url'];
$asistencia = $row_comunicado['asistencia'];

} 
?>
<script type="text/javascript">
$(document).ready(function(){
  $('[data-toggle="tooltip"]').tooltip();
  });
</script>

 
<div class="modal-header">

<h5 class="modal-title"><?=$temac;?></h5>
<button type="button" class="close" data-dismiss="modal" aria-label="Close">
<span aria-hidden="true">&times;</span>
</button>
</div>

<div class="modal-body">

<div class="row" style="margin-bottom: 5px;">

<div class="col-xl-6 col-lg-6 col-md-12 col-sm-12 mt-2 mb-2 "> 
<div style="border: 1px solid #F7F7F7;padding: 10px;">
<div class="text-secondary" style="font-size: .9em;">Encargado de la comunicación:</div>	
<b><?=$nomencargado;?></b>
</div>
</div>


<div class="col-xl-6 col-lg-6 col-md-12 col-sm-12 mt-2 mb-2 "> 
<div style="border: 1px solid #F7F7F7;padding: 10px;">
<div class="text-secondary" style="font-size: .9em;">Fecha:</div>	
<b><?=FormatoFecha($fecha);?></b>
</div>
</div>

</div>

<div class="row" >

<div class="col-xl-6 col-lg-6 col-md-12 col-sm-12 mt-2 mb-2 "> 
<div style="border: 1px solid #F7F7F7;padding: 10px;">
<div class="text-secondary" style="font-size: .9em;">Tipo de comunicación:</div>
<?=$tipocomunicacion;?>
</div>
</div>

<div class="col-xl-6 col-lg-6 col-md-12 col-sm-12 mt-2 mb-2 "> 
<div style="border: 1px solid #F7F7F7;padding: 10px;">
<div class="text-secondary" style="font-size: .9em;">Material utilizado para la comunicación:</div>
<?=$material;?>
</div>
</div>


</div>

<div class="row" style="margin-bottom: 5px;">
<div class="col-xl-6 col-lg-6 col-md-12 col-sm-12 mt-2 mb-2 "> 
<div style="border: 1px solid #F7F7F7;padding: 10px;">
<div class="text-secondary" style="font-size: .9em;">Seguimiento de la comunicación:</div>
<?=$seguimiento;?>
</div>
</div>

<div class="col-xl-6 col-lg-6 col-md-12 col-sm-12 mt-2 mb-2 "> 
<div style="border: 1px solid #F7F7F7;padding: 10px;">
<div class="text-secondary" style="font-size: .9em;">Dirigido a:</div>
<?php 
$separacadena = explode(",", $dirigidoa);
for ($i=0; $i < count($separacadena) ; $i++) { 
$sql_puestos = "SELECT tipo_puesto FROM tb_puestos WHERE id = '".$separacadena[$i]."' ";
$result_puestos = mysqli_query($con, $sql_puestos);
while($row_puestos = mysqli_fetch_array($result_puestos, MYSQLI_ASSOC)){
$puesto = $row_puestos['tipo_puesto'];
?>
<span class="badge badge-pill badge-primary" style="font-size: .8em;"><?=$puesto;?></span>
<?php
}
}
?>
</div>
</div>

</div>

<?php
if ($url != "") {

$separaCadena = explode("-", $url);

$idestacion = $separaCadena[1];
$idcomunicado = $separaCadena[2];

$sql_comunicado_D = "SELECT * FROM co_comunicados WHERE id_estacion = '".$idestacion."' and id_comunicado = '".$idcomunicado."' ";
$result_comunicado_D = mysqli_query($con, $sql_comunicado_D);
$numero_comunicado_D = mysqli_num_rows($result_comunicado_D);

while($row_comunicado_D = mysqli_fetch_array($result_comunicado_D, MYSQLI_ASSOC)){
$detalle = $row_comunicado_D['detalle'];
$archivo = $row_comunicado_D['archivo'];
if ($archivo != "") {
$img_archivo = "<a href='".$archivo."' download style='cursor:pointer;' data-toggle='tooltip' data-placement='right' title='Descargar archivo'><img src='".RUTA_IMG_ICONOS."documento.png'></a>";
}else{
$img_archivo = "";
}


}
}

if ($detalleComu != "") {
?>
<hr>
<div class="row">

<div class="col-11 mb-2 "> 
<label class="text-secondary" style="font-size: .9em;">Detalle:</label></div>
<div class="col-1 text-center"><?=$img_archivo;?></div>
</div>
<div style="border: 1px solid #F7F7F7;padding: 10px;font-size: 1.1em;">
<?=$detalleComu;?>
</div>
<?php
}
?>

<?php 

if($asistencia != 0){

echo '<hr>';
echo '<div><label class="text-secondary" style="font-size: .9em;">Fo.ADMONGAS.009 (Comunicación interna)</label></div>';
echo $img_archivo = "<a onclick='DescargarAsistencia(".$asistencia.")' style='cursor:pointer;' data-toggle='tooltip' data-placement='right' title='Descargar archivo'><img src='".RUTA_IMG_ICONOS."documento.png'></a>";

}

?>
</div>