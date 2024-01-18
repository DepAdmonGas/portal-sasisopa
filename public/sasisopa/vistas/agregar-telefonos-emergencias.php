<?php
require('../../../app/help.php');
?>
<div class="modal-header">
<h4 class="modal-title">Nuevo teléfonos de emergencia</h4>
<button type="button" class="close" data-dismiss="modal" aria-label="Close">
<span aria-hidden="true">&times;</span>
</div>
<div class="modal-body">

<div class="mb-2"><small class="text-secondary">* Servicio de emergencias:</small></div>
<textarea class="form-control rounded-0" id="Titulo"></textarea>


<div class="mb-2 mt-2"><small class="text-secondary">* Teléfono:</small></div>
<input type="text" class="form-control rounded-0" id="Telefono" >

<hr>

<div class="text-right">
	<button type="button" class="btn btn-secondary rounded-0" onclick="BtnCancelar()">Cancelar</button>
<button type="button" class="btn btn-primary rounded-0" onclick="BtnAgregarTelefono()">Agregar</button>
</div>

</div>