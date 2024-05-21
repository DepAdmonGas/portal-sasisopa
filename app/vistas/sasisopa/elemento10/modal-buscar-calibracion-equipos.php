<?php
require('../../../../app/help.php');

?>

  <div class="modal-header">
  <h4 class="modal-title">Buscar calibración de equipos</h4>
  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
  <span aria-hidden="true">&times;</span>
  </button>
  </div>
  
  <div class="modal-body">

  <div class="text-secondary">Año:</div>
  <input type="number" class="form-control rounded-0" id="Year">

  </div>

  <div class="modal-footer">
  <button type="button" class="btn btn-primary" style="border-radius: 0px;" onclick="BtnBuscar()">Buscar</button>
  </div>