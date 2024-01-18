<?php
require('../../../app/help.php');
?>
<div class="modal-header">
<h4 class="modal-title">Descargar simulacros</h4>
<button type="button" class="close" data-dismiss="modal" aria-label="Close">
<span aria-hidden="true">&times;</span>
</div>
<div class="modal-body">

<div class="mb-2"><small class="text-secondary">* Agregar año:</small></div>
<input type="number" class="form-control rounded-0" id="BuscarYear">
<div id="result"></div>
<hr>

<div class="text-right">
<button type="button" class="btn btn-primary rounded-0" onclick="BtnBuscar()">Buscar</button>
</div>

</div>