<?php
require('../../../../app/help.php');

?>

  <div class="modal-header">
  <h4 class="modal-title">Agregar calibración de equipos</h4>
  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
  <span aria-hidden="true">&times;</span>
  </button>
  </div>
  
  <div class="modal-body">

  <div class="text-secondary">Equipo:</div>
  <select class="form-control rounded-0 mt-2" id="Equipo">
    <option></option>
    <option>Tanques de almacenamiento</option>
    <option>Sondas de medición</option>
    <option>Dispensario</option>
    <option>Jarra patron</option>
  </select>

  </div>

  <div class="modal-footer">
  <button type="button" class="btn btn-primary" style="border-radius: 0px;" onclick="BtnAgregar()">Agregar</button>
  </div>