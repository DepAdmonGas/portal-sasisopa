<?php
require('../../../app/help.php');
$idINV = $_POST['id'];

$sql_inv = "SELECT * FROM tb_investigacion_incidente_accidente_tercerautorizado WHERE id_investigacion= '".$idINV."' ORDER BY id desc ";
$result_inv = mysqli_query($con, $sql_inv);
$numero_inv = mysqli_num_rows($result_inv);
while($row_inv = mysqli_fetch_array($result_inv, MYSQLI_ASSOC)){
$id = $row_inv['id'];
$nombre = $row_inv['nombre'];	
$numero = $row_inv['numero'];	
$lider = $row_inv['lider'];	
$fecha = $row_inv['fecha'];	
$archivo = $row_inv['archivo'];	
}

?>
 <div class="modal-header">
   <h4 class="modal-title">Tercer Autorizado</h4>
     <button type="button" class="close" data-dismiss="modal" aria-label="Close">
   <span aria-hidden="true">&times;</span>
 </button>
 </div>
 <div class="modal-body">

<div class="mb-3">
<small class="text-secondary">* Nombre del tercer autorizado:</small>
<div class="p-1 border-bottom"><?=$nombre;?></div>
</div>

<div class="mb-3">
<small class="text-secondary">* Numero de autorización:</small>
<div class="p-1 border-bottom"><?=$numero;?></div>
</div>

<div class="mb-3">
<small class="text-secondary">* Nombre del líder de la investigación:</small>
<div class="p-1 border-bottom"><?=$lider;?></div>
</div>

<div class="border p-3">

<div class="row">

<div class="col-12 col-xl-6 col-lg-6 col-md-12 col-sm-12">
<div class="mb-2"><small class="text-secondary">* Agregar informr final:</small></div>
<input type="file" id="ArchivoPdf">
<div id="ResultIA"></div>
</div>


<div class="col-12 col-xl-6 col-lg-6 col-md-12 col-sm-12">
<div class="text-right mt-3">
<button type="button" class="btn btn-primary btn-sm" style="border-radius: 0px;" onclick="BTNArchivoTA(<?=$idINV;?>,<?=$id;?>)">Agregar archivo</button>	
</div>
</div>
</div>


</div>

<div class="mt-3">
<small class="text-secondary">Informe final de la investigación causa raíz </small>
</div>

<table class="table table-bordered table-striped table-hover table-sm mt-3">
<thead>
<th class="text-center">#</th>
<th class="text-center">Fecha</th>
<th class="text-center"></th>
</thead>
<tbody>
<?php
if ($fecha != "" && $archivo != "") {
echo "<tr>";
echo "<td class='text-center'>".$id."</td>";
echo "<td class='text-center'>".FormatoFecha($fecha)."</td>";
echo "<td class='text-center'><a target='_BLANK' href='".$archivo."'><img src='".RUTA_IMG_ICONOS."pdf.png'></a></td>";
echo "</tr>";
}else{
echo "<tr><td colspan='13' class='text-center'><small>No se encontró información para mostrar</small></td></tr>";		
}
?>
</tbody>
</table>

</div>

