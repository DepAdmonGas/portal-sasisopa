<?php
require('../../../../app/help.php');

$idExtintor = $_GET['idExtintor'];

$sql_extintores = "SELECT * FROM po_extintores_estacion WHERE id = '".$idExtintor."' ";
$result_extintores = mysqli_query($con, $sql_extintores);
$numero_extintores = mysqli_num_rows($result_extintores);
while($row_extintores = mysqli_fetch_array($result_extintores, MYSQLI_ASSOC)){
$noextintor = $row_extintores['no_extintor'];
$ubicacion = $row_extintores['ubicacion'];
$ultimarecarga = $row_extintores['ultima_recarga'];
$tipoextintor = $row_extintores['tipo_extintor'];
$pesokg = $row_extintores['peso_kg'];
}
?>

  <div class="modal-header">
  <h4 class="modal-title">Editar Extintor</h4>
  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
  <span aria-hidden="true">&times;</span>
  </button>
  </div>
  
  <div class="modal-body">
  <div class="row">

  <div class="col-12 mb-3">
    <label for="tipocomunicacion" class="text-secondary">No. De extintor: </label>
    <input type="number" min="1" class="form-control rounded-0" id="EditNoExtintor" value="<?=$noextintor;?>">
  </div>

  <div class="col-12 mb-3">
    <label for="tipocomunicacion" class="text-secondary">Ubicación: </label>
    <textarea rows="3" class="form-control rounded-0" id="EditUbicacion"><?=$ubicacion;?></textarea>
  </div>

  <div class="col-12 mb-3">
    <label for="tipocomunicacion" class="text-secondary">Fecha de ultima recarga: </label>
    <input type="date" class="form-control rounded-0" id="EditFechaRecarga" value="<?=$ultimarecarga;?>">
  </div>
  

  <div class="col-12 mb-3">
    <label for="tipocomunicacion" class="text-secondary">Tipo de Extintor: </label>
    <input type="text" class="form-control rounded-0 mb-1" id="EditTipoExtintor" value="<?=$tipoextintor;?>">
  </div>
  

  <div class="col-12 mb-2">
    <label for="tipocomunicacion" class="text-secondary">Peso Kg: </label>
    <input type="text" class="form-control rounded-0" id="EditPeso" value="<?=$pesokg;?>">
  </div>
  

  </div>
  </div>


  <div class="modal-footer">
  <button type="button" class="btn btn-primary" style="border-radius: 0px;" onclick="BtnEditar(<?=$idExtintor;?>)">Editar</button>
  </div>