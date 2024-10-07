<?php
require('../../../../app/help.php');

$idPrograma = $_GET['idPrograma'];

$sql_resumen = "SELECT resumen FROM tb_programa_anual_simulacros_resumen WHERE id_programa = '".$idPrograma."' ";
$result_resumen = mysqli_query($con, $sql_resumen);
$numero_resumen = mysqli_num_rows($result_resumen);
if($numero_resumen > 0){
$row_resumen = mysqli_fetch_array($result_resumen, MYSQLI_ASSOC);
$resumen = $row_resumen['resumen'];
}else{
$resumen = "";    
}

if ($resumen == "") {
$txtBtn = "Agregar";
}else{
$txtBtn = "Actualizar";
}
?>
<div class="modal-header rounded-0 head-modal">
<h4 class="modal-title text-white">Resumen</h4>
<button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
</div>
<div class="modal-body">

<div class="mb-2"><small class="text-secondary">* Resumen del programa anual de simulacros:</small></div>
<textarea class="form-control rounded-0" id="Resumen">
<?=$resumen;?>
</textarea>

<hr>

<div class="text-right">
<button type="button" class="btn btn-primary rounded-0" onclick="BtnAgregarResumen(<?=$idPrograma;?>)"><?=$txtBtn;?></button>
</div>

</div>