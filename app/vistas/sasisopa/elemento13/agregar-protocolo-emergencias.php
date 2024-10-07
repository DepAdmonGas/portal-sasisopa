<?php
require('../../../../app/help.php');
?>
<div class="modal-header rounded-0 head-modal">
<h4 class="modal-title text-white">Agregar protocolo de respuesta a emergencias</h4>
<button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
</div>
<div class="modal-body">

<div class="mb-2"><small class="text-secondary">* Fecha elaboración :</small></div>
<input type="date" class="form-control rounded-0" id="FechaProtocolo">

<div class="mb-2 mt-2"><small class="text-secondary">* Protocolo formato PDF:</small></div>
<input type="file" id="FileProtocolo">

<div id="result"></div>
<hr>
<div class="text-end">
<button type="button" class="btn btn-primary rounded-0" onclick="BTNAgregarProtocolo()">Agregar</button>
</div>

</div>