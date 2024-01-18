<?php
require('../../../app/help.php');
?>
<div class="modal-header">
<h4 class="modal-title">Agregar protocolo de respuesta a emergencias</h4>
<button type="button" class="close" data-dismiss="modal" aria-label="Close">
<span aria-hidden="true">&times;</span>
</div>
<div class="modal-body">

<div class="mb-2"><small class="text-secondary">* Fecha elaboración :</small></div>
<input type="date" class="form-control rounded-0" id="FechaProtocolo">

<div class="mb-2 mt-2"><small class="text-secondary">* Protocolo formato PDF:</small></div>
<input type="file" id="FileProtocolo">

<div id="result"></div>
<hr>
<div class="text-right">
<button type="button" class="btn btn-primary rounded-0" onclick="BTNAgregarProtocolo()">Agregar</button>
</div>

</div>