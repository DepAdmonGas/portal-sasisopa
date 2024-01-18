<?php
require('../../../app/help.php');
$idPrograma = $_GET['idPrograma'];
?>
<div class="modal-header">
<h4 class="modal-title">Evaluación</h4>
<button type="button" class="close" data-dismiss="modal" aria-label="Close">
<span aria-hidden="true">&times;</span>
</div>
<div class="modal-body">

<div class="mb-2"><small class="text-secondary">* Adjunta la (EVALUACIÓN DE SIMULACRO) Fo.ADMONGAS.16a:</small></div>
<input type="file" name="" id="Evaluacion">
<div id="result"></div>
<hr>

<div class="text-right">
<button type="button" class="btn btn-primary rounded-0" onclick="BtnAgregarEvaluacion(<?=$idPrograma;?>)">Guardar</button>
</div>

</div>