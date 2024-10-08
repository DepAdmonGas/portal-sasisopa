<?php
require('../../../app/help.php');


$sql_comunicado = "SELECT * FROM co_comunicados WHERE id = '".$_GET['idcomunicado']."' ";
$result_comunicado = mysqli_query($con, $sql_comunicado);
$numero_comunicado = mysqli_num_rows($result_comunicado);
while($row_comunicado = mysqli_fetch_array($result_comunicado, MYSQLI_ASSOC)){

$temac = $row_comunicado['tema'];
$detalle = $row_comunicado['detalle'];
$fecha = $row_comunicado['fecha'];
$dirigidoa = $row_comunicado['dirigidoa'];
$archivo = $row_comunicado['archivo'];
if ($archivo != "") {
$img_archivo = "<a href='".$archivo."' download style='cursor:pointer;' data-toggle='tooltip' data-placement='right' title='Descargar archivo'><img src='".RUTA_IMG_ICONOS."pdf.png'></a>";
}else{
$img_archivo = "";
}

}
?>
<div class="modal-header rounded-0 head-modal">
  <h4 class="modal-title text-white"><?=$temac;?></h4>
  <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
  </div>

<div class="modal-body">

<div class="row">
<div class="col-6">
<div style="border: 1px solid #F7F7F7;padding: 10px;">
<div class="fw-bold" style="font-size: .9em;">Fecha:</div>	
<?=FormatoFecha($fecha);?>
</div>
</div>
<div class="col-6">
<div style="border: 1px solid #F7F7F7;padding: 10px;">
<div class="fw-bold" style="font-size: .9em;">Dirigido a:</div>
<?php 
$separacadena = explode(",", $dirigidoa);
for ($i=0; $i < count($separacadena) ; $i++) { 
$sql_puestos = "SELECT tipo_puesto FROM tb_puestos WHERE id = '".$separacadena[$i]."' ";
$result_puestos = mysqli_query($con, $sql_puestos);
while($row_puestos = mysqli_fetch_array($result_puestos, MYSQLI_ASSOC)){
$puesto = $row_puestos['tipo_puesto'];
?>
<span style="font-size: .8em;"><?=$puesto;?></span>
<?php
}
}
?>
</div>
</div>
</div>
<hr>
<div class="row">
<div class="col-11"><label class="fw-bold" style="font-size: .9em;">Detalle:</label></div>
<div class="col-1 text-center"><?=$img_archivo;?></div>
</div>
<div class="mt-2" style="border: 1px solid #F7F7F7;padding: 10px;font-size: 1.1em;">
<?=$detalle;?>
</div>
</div>