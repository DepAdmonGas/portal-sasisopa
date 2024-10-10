<?php
require('../../../../app/help.php');
$idPrograma = $_GET['idPrograma'];
?>
<div class="modal-header rounded-0 head-modal">
<h4 class="modal-title text-white">Evaluación</h4>
<button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
</div>
<div class="modal-body">

<div class="mb-2"><small class="text-secondary">* Adjunta la (EVALUACIÓN DE SIMULACRO) Fo.ADMONGAS.16a:</small></div>
<input type="file" name="" id="Evaluacion">
<div id="result"></div>
<hr>

<div class="text-end">
<button type="button" class="btn btn-primary rounded-0" onclick="BtnAgregarEvaluacion(<?=$idPrograma;?>)">Guardar</button>
</div>

</div>