<?php
require('../../../../app/help.php');

?>
<script type="text/javascript">
$(document).ready(function(){

});
</script>
 <div class="modal-header">
   <h4 class="modal-title">Crear investigación de incidentes y accidentes</h4>
     <button type="button" class="close" data-dismiss="modal" aria-label="Close">
   <span aria-hidden="true">&times;</span>
 </button>
 </div>
 <div class="modal-body">

<div class="mb-2"><small class="text-secondary">* Fecha:</small></div> 
<input type="date" class="form-control rounded-0" id="Fecha">

<div class="mb-2 mt-2"><small class="text-secondary">* Descripción de evento:</small></div>
<textarea class="form-control rounded-0" id="Descripcion"></textarea>

<div class="mb-2 mt-2"><small class="text-secondary">* Tipo de evento:</small></div>
<select class="form-control rounded-0" onchange="TipoEvento(this)" id="TipoEvento">
<option value="">Selecciona</option>
<option value="1">Tipo 1</option>
<option value="2">Tipo 2</option>
<option value="3">Tipo 3</option>
</select>

<div id="DescripcionTipo"></div>
<div id="MuertesCheck"></div>
<div id="TercerAutorizado"></div>
<div id="EventoDetalle"></div>

</div>
<div class="modal-footer">
<button type="button" class="btn btn-primary" style="border-radius: 0px;" onclick="BTNCrear()">Crear nueva</button>
</div>