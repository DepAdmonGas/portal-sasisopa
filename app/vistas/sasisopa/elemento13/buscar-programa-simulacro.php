<?php
require('../../../../app/help.php');
?>
<div class="modal-header rounded-0 head-modal">
<h4 class="modal-title text-white">Descargar simulacros</h4>
<button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
</div>
<div class="modal-body">

<div class="mb-2"><small class="text-secondary">* Agregar año:</small></div>
<input type="number" class="form-control rounded-0" id="BuscarYear">
<div id="result"></div>
<hr>

<div class="text-end">
<button type="button" class="btn btn-primary rounded-0" onclick="BtnBuscar()">Buscar</button>
</div>

</div>