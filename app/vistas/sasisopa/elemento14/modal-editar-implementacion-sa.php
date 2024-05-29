<?php
require('../../../../app/help.php');

$idDetalle = $_GET['idDetalle'];

$sql = "SELECT fecha FROM tb_implementacionsa WHERE id = '".$idDetalle."' ";
$result = mysqli_query($con, $sql);
$numero = mysqli_num_rows($result);
$row = mysqli_fetch_array($result, MYSQLI_ASSOC);
$explode = explode(' ', $row['fecha']);
?>

  <div class="modal-header">
  <h4 class="modal-title">Editar Implementación</h4>
  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
  <span aria-hidden="true">&times;</span>
  </button>
  </div>
  
  <div class="modal-body">


  <h6>Fecha:</h6>
  <input type="date" class="form-control rounded-0" value="<?=$explode[0];?>" id="Fecha">
  </div>


  <div class="modal-footer">
  <button type="button" class="btn btn-primary" style="border-radius: 0px;" onclick="BtnEditar(<?=$idDetalle;?>)">Editar</button>
  </div>