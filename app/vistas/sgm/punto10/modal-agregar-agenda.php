<?php
require('../../../../app/help.php');
 
?>
     <div class="modal-header">
       <h4 class="modal-title">V. AGENDA.</h4>
         <button type="button" class="close" data-dismiss="modal" aria-label="Close">
       <span aria-hidden="true">&times;</span>
     </button>
     </div>
     <div class="modal-body">

    <div class="row">
        <div class="col-6">
            <b>Hora inicio:</b>
            <input type="time" class="form-control rounded-0" id="agenda1">
        </div>
        <div class="col-6">
            <b>Hora termino:</b>
            <input type="time" class="form-control rounded-0" id="agenda2">
        </div>
    </div>

    <div class="mt-2"><b>Proceso:</b></div>
    <textarea class="form-control rounded-0" id="agenda3"></textarea>

    <div class="mt-2"><b>Elemento del sistema de gestión de medición:</b></div>
    <textarea class="form-control rounded-0" id="agenda4"></textarea>

    <div class="mt-2"><b>Nombre y rol del auditor:</b></div>
    <textarea class="form-control rounded-0" id="agenda5"></textarea>

    <div class="mt-2"><b>Guía:</b></div>
    <textarea class="form-control rounded-0" id="agenda6"></textarea>
    

    </div>
    <div class="modal-footer">
	<button type="button" class="btn btn-primary rounded-0" onclick="GuardarAgenda(<?=$_GET['id'];?>)">Guardar</button>
	</div>

     	 	 	 	 
