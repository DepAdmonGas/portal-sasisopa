<?php
require('../../../../app/help.php');
 
?>
     <div class="modal-header">
       <h4 class="modal-title">PERSONAL ENTREVISTADO</h4>
         <button type="button" class="close" data-dismiss="modal" aria-label="Close">
       <span aria-hidden="true">&times;</span>
     </button>
     </div>
     <div class="modal-body">

        <div class="mt-2"><b>Nombre:</b></div>
    <textarea class="form-control rounded-0" id="dato1"></textarea>

    <div class="mt-2"><b>Puesto:</b></div>
    <textarea class="form-control rounded-0" id="dato2"></textarea>

    <div class="mt-2"><b>Área de descripcion:</b></div>
    <textarea class="form-control rounded-0" id="dato3"></textarea>

    </div>
    <div class="modal-footer">
	<button type="button" class="btn btn-primary rounded-0" onclick="GuardarEntrvistador(<?=$_GET['id'];?>)">Guardar</button>
	</div>