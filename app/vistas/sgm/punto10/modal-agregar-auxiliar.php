<?php
require('../../../../app/help.php');
 
?>
     <div class="modal-header">
       <h4 class="modal-title">III DATOS DEL EQUIPO AUXILIAR DEL AUDITOR</h4>
         <button type="button" class="close" data-dismiss="modal" aria-label="Close">
       <span aria-hidden="true">&times;</span>
     </button>
     </div>
     <div class="modal-body">

    <div class="mt-2"><b>Equipo auditor:</b></div>
    <select class="form-control rounded-0" id="auditor1">
        <option></option>
        <option>GUÍAS</option>
        <option>OBSERVADORES</option>
        <option>EXPERTO(S) TÉCNICO(S)</option>
    </select>

    <div class="mt-2"><b>Nombre:</b></div>
    <textarea class="form-control rounded-0" id="auditor2"></textarea>
    

    </div>
    <div class="modal-footer">
	<button type="button" class="btn btn-primary rounded-0" onclick="GuardarAuxiliar(<?=$_GET['id'];?>)">Guardar</button>
	</div>