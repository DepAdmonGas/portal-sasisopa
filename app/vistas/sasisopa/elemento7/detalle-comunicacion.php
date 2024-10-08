<?php
require('../../../../app/help.php');


$sql_comunicado = "SELECT 
se_comunicacion_i_e.id,
se_comunicacion_i_e.no_comunicacion,
se_comunicacion_i_e.fecha,
se_comunicacion_i_e.tema,
se_comunicacion_i_e.tipo_comunicacion,
se_comunicacion_i_e.material,
se_comunicacion_i_e.seguimiento,
se_comunicacion_i_e.asistencia,
se_comunicacion_i_e.detalle,
se_comunicacion_i_e.dirigidoa,
se_comunicacion_i_e.url,
tb_usuarios.nombre
FROM se_comunicacion_i_e 
INNER JOIN tb_usuarios 
ON se_comunicacion_i_e.encargado_comunicacion = tb_usuarios.id
WHERE se_comunicacion_i_e.id = '".$_GET['idcomunicado']."' ";
$result_comunicado = mysqli_query($con, $sql_comunicado);
$numero_comunicado = mysqli_num_rows($result_comunicado);
while($row_comunicado = mysqli_fetch_array($result_comunicado, MYSQLI_ASSOC)){

$temac = $row_comunicado['tema'];
$detalleComu = $row_comunicado['detalle'];
$fecha = $row_comunicado['fecha'];
$dirigidoa = $row_comunicado['dirigidoa'];

$nomencargado = $row_comunicado['nombre'];
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

 
<div class="modal-header rounded-0 head-modal">

<h5 class="modal-title text-white"><?=$temac;?></h5>
<button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
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
<span class="badge rounded-pill bg-primary" style="font-size: .8em;"><?=$puesto;?></span>
<?php
}
}
?>
</div>
</div>

</div>

<?php
$img_archivo = "";
if ($url != "") {

$separaCadena = explode("-", $url);

$idestacion = $separaCadena[1];
$idcomunicado = $separaCadena[2];

$sql_comunicado_D = "SELECT detalle,archivo FROM co_comunicados WHERE id_estacion = '".$idestacion."' and id_comunicado = '".$idcomunicado."' ";
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
echo '<div><label class="text-secondary" style="font-size: .9em;">Fo.ADMONGAS.010 (Comunicación interna)</label></div>';
echo $img_archivo = "<a onclick='DescargarAsistencia(".$asistencia.")' style='cursor:pointer;' data-toggle='tooltip' data-placement='right' title='Descargar archivo'><img src='".RUTA_IMG_ICONOS."documento.png'></a>";

}

?>
</div>