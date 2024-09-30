<?php
require('../../../../app/help.php');


?>
     <div class="modal-header">
       <h4 class="modal-title">Buscar</h4>
         <button type="button" class="close" data-dismiss="modal" aria-label="Close">
       <span aria-hidden="true">&times;</span>
     </button>
     </div>
     <div class="modal-body">

    <div class="mt-2">
    <b>Año:</b>
    <input type="number" class="form-control mt-2" id="Year">
    </div>


    </div>
    <div class="modal-footer">
	<button type="button" class="btn btn-primary rounded-0" onclick="Buscar(<?=$_GET['formato'];?>)">Buscar</button>
	</div>