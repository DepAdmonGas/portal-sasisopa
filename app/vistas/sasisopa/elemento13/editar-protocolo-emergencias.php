<?php
require('../../../../app/help.php');
$idProtocolo = $_GET['id'];

$sql_protocolo = "SELECT fechacreacion, archivo FROM tb_protocolo_emergencias WHERE id = '".$idProtocolo."'";
$result_protocolo = mysqli_query($con, $sql_protocolo);
$numero_protocolo = mysqli_num_rows($result_protocolo);
$row_protocolo = mysqli_fetch_array($result_protocolo, MYSQLI_ASSOC);
$fechacreacion = $row_protocolo['fechacreacion'];
$imgPDF = "<a target='_blank' href='".$row_protocolo['archivo']."' ><img src='".RUTA_IMG_ICONOS."pdf-16.png'></a>";
?>
<div class="modal-header rounded-0 head-modal">
<h4 class="modal-title text-white">Agregar protocolo de respuesta a emergencias</h4>
<button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
</div>
<div class="modal-body">

<div class="mb-2"><small class="text-secondary">* Fecha elaboración :</small></div>
<input type="date" class="form-control rounded-0" id="EditFechaProtocolo" value="<?=$fechacreacion;?>">

<div class="mb-2 mt-2"><small class="text-secondary">* Protocolo formato PDF:</small></div>

<table class="table table-bordered table-striped table-hover table-sm mt-2">
<thead>
<th class="text-center align-middle"><?=$imgPDF;?></th>
<th><input type="file" id="EditFileProtocolo"></th>
</thead>	
<tbody>
</tbody>
</table>


<div id="result"></div>
<hr>
<div class="text-end">
<button type="button" class="btn btn-primary rounded-0" onclick="BTNEditarProtocolo('<?=$idProtocolo;?>')">Editar</button>
</div>

</div>