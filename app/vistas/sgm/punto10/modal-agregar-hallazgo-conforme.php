<?php
require('../../../../app/help.php');
 
?>
     <div class="modal-header rounded-0 head-modal">
       <h4 class="modal-title text-white">III. DOCUMENTACIÓN DE LOS HALLAZGOS NO CONFORMES</h4>
       <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
     </div>
     <div class="modal-body">

    <div class="mt-2"><b>Descripción del hallazgo:</b></div>
    <textarea class="form-control rounded-0" id="dato1"></textarea>

    <div class="mt-2"><b>Evidencia</b></div>
    <textarea class="form-control rounded-0" id="dato2"></textarea>

    <div class="mt-2"><b>Criterio</b></div>
    <textarea class="form-control rounded-0" id="dato3"></textarea>

    </div>
    <div class="modal-footer">
	<button type="button" class="btn btn-primary rounded-0" onclick="GuardarHallazgoConforme(<?=$_GET['id'];?>)">Guardar</button>
	</di