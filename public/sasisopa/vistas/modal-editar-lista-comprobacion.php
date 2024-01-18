<?php
require('../../../app/help.php');

$id = $_GET['id'];

$sql_capacitacion = "SELECT * FROM tb_politica_lista_comprobacion WHERE id = '".$id."' ";
$result_capacitacion = mysqli_query($con, $sql_capacitacion);
$numero_capacitacion = mysqli_num_rows($result_capacitacion);
while($row_capacitacion = mysqli_fetch_array($result_capacitacion, MYSQLI_ASSOC)){
$fecha = $row_capacitacion['fecha'];
$asistentes = $row_capacitacion['asistentes'];
$comentarios = $row_capacitacion['comentarios'];
}

$sql = "SELECT * FROM tb_politica_lista_comprobacion_detalle WHERE id_lista_comprobacion = '".$id."' ORDER BY id ASC ";
$result = mysqli_query($con, $sql);
$numero = mysqli_num_rows($result);
?>

  <div class="modal-header">
  <h4 class="modal-title">Editar Lista de comprobación</h4>
  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
  <span aria-hidden="true">&times;</span>
  </button>
  </div>
  
  <div class="modal-body">

    <b>Fecha:</b>
<input type="date" class="form-control rounded-0 mt-2 mb-2" id="EditFecha" value="<?=$fecha;?>">

<div class="mb-2" style="overflow-y: hidden;">
<table class="table table-bordered table-sm mt-3">
  <thead>
    <tr>
      <th class="text-center">Criterio</th>
      <th class="text-center">Resultado</th>
    </tr>
  </thead>
  <tbody>

    <?php 
    $num =  1;
    while($row = mysqli_fetch_array($result, MYSQLI_ASSOC)){
    echo '<tr>
    <td class="align-middle">'.$row['criterio'].'</td>
    <td class="p-0 align-middle">
      <select class="form-control rounded-0" id="ER'.$num.'">
          <option value="'.$row['resultado'].'">'.$row['resultado'].'</option>
          <option value="Si">Si</option>
          <option value="En Parte">En Parte</option>
          <option value="No">No</option>
      </select>
    </td>
    </tr>';

    $num++;
    } 
    ?>   

    <tr>
      
      <td colspan="2" class="p-2">
        <b>Asistentes:</b>
        <textarea class="form-control rounded-0 mt-2 mb-2" id="EditAsistentes"><?=$asistentes;?></textarea>
      </td>
    </tr>

    <tr>
      <td colspan="2" class="p-2">
        <b>Comentarios:</b>
        <textarea class="form-control rounded-0 mt-2 mb-2" id="EditComentarios"><?=$comentarios;?></textarea>
      </td>
    </tr>

  </tbody>
</table>
</div>

  </div>
  <div class="modal-footer">
  <button type="button" class="btn btn-primary" style="border-radius: 0px;" onclick="BtnEditar(<?=$id;?>)">Editar</button>
  </div>