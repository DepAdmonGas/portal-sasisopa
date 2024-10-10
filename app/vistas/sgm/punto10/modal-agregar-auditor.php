<?php
require('../../../../app/help.php');
 
?>
     <div class="modal-header rounded-0 head-modal">
       <h4 class="modal-title text-white">II. DATOS DEL AUDITOR</h4>
       <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
     </div>
     <div class="modal-body">

    <div class="mt-2"><b>Equipo auditor:</b></div>
    <select class="form-control rounded-0" id="auditor1">
        <option></option>
        <option>AUDITOR LÍDER</option>
        <option>AUDITOR</option>
    </select>

    <div class="mt-2"><b>Nombre:</b></div>
    <textarea class="form-control rounded-0" id="auditor2"></textarea>

    <div class="mt-2"><b>Área/proceso/actividad que audita:</b></div>
    <textarea class="form-control rounded-0" id="auditor3"></textarea>
    

    </div>
    <div class="modal-footer">
	<button type="button" class="btn btn-primary rounded-0" onclick="GuardarAuditor(<?=$_GET['id'];?>)">Guardar</button>
	</div>