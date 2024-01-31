<?php
require('../../../app/help.php');

$id = $_GET['id'];

$sql_resultado = "SELECT * FROM tb_evaluacion_desempeno WHERE id = '".$id."' ";
$result_resultado = mysqli_query($con, $sql_resultado);
$numero_resultado = mysqli_num_rows($result_resultado);
while($row_resultado = mysqli_fetch_array($result_resultado, MYSQLI_ASSOC)){
$explode = explode(' ', $row_resultado['fecha_hora']);  
$Fecha = $explode[0];
}
?>

  <div class="modal-header">
  <h4 class="modal-title">Editar Informe de Evaluación de Desempeño (IED)</h4>
  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
  <span aria-hidden="true">&times;</span>
  </button>
  </div>
  
  <div class="modal-body">

    <div class="mt-2">Fecha:</div>
    <input type="date" class="form-control rounded-0 mt-2" value="<?=$Fecha;?>" id="EditFecha">

    <div class="mt-2">Informe de Evaluación de Desempeño (IED) en formato PDF:</div>
    <input type="file" class="mt-2" id="EditArchivoPDF">

  </div>


  <div class="modal-footer">
  <button type="button" class="btn btn-primary" style="border-radius: 0px;" onclick="BtnEditar(<?=$id;?>)">Editar</button>
  </div>