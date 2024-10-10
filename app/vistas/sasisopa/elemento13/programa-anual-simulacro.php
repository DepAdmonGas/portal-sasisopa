<?php
require('../../../../app/help.php');

$id = $_GET['id'];

$sql_programa = "SELECT * FROM tb_programa_anual_simulacros WHERE id = '".$id."' ";
$result_programa = mysqli_query($con, $sql_programa);
$numero_programa = mysqli_num_rows($result_programa);
if($numero_programa > 0){
    $row_programa = mysqli_fetch_array($result_programa, MYSQLI_ASSOC);
    $Simulacro = $row_programa['nombre_simulacro'];
    $Fecha = $row_programa['fecha'];
}else{
    $Simulacro = "";
    $Fecha = "";
}
?>
<div class="modal-header rounded-0 head-modal">
<h4 class="modal-title text-white">Crear programa anual de simulacros</h4>
<button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
</div>
<div class="modal-body">

<div class="mb-2"><small class="text-secondary">* Nombre del simulacro:</small></div>
<textarea class="form-control rounded-0" id="NombreSimulacro"><?=$Simulacro;?></textarea>


<div class="mb-2 mt-2"><small class="text-secondary">Periodicidad :</small></div>
<input type="text" class="form-control rounded-0" id="Periodicidad" value="Trimestral" disabled>

<div class="mb-2 mt-2"><small class="text-secondary">Fecha :</small></div>
<input type="date" class="form-control rounded-0" id="Fecha" value="<?=$Fecha;?>">

<hr>

<div class="text-end">
<button type="button" class="btn btn-primary rounded-0" onclick="BtnAgregarPrograma(<?=$id;?>)">Agregar</button>
</div>

</div>