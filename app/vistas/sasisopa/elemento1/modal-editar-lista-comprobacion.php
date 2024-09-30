<?php
require('../../../../app/help.php');
include_once "../../../../app/modelo/Politica.php";

$class_politica = new Politica();
$id = $_GET['id'];
$array_comprobacion = $class_politica->politicaListaComprobacion($id);
$politica_comprobacion_detalle = $class_politica->politicaListaComprobacionDetalle($id);
$numero_comprobacion = mysqli_num_rows($politica_comprobacion_detalle);

?>

  <div class="modal-header rounded-0 head-modal">
  <h4 class="modal-title text-white">Editar Lista de comprobación</h4>
  <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
  </div>
  
  <div class="modal-body">

<b>Fecha:</b>
<input type="date" class="form-control rounded-0 mt-2 mb-2" id="EditFecha" value="<?=$array_comprobacion['fecha'];?>">

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
    while($row = mysqli_fetch_array($politica_comprobacion_detalle, MYSQLI_ASSOC)){
    echo '<tr>
    <td class="align-middle">'.$row['criterio'].'</td>
    <td class="p-0 align-middle">
      <select class="form-control rounded-0 border-0" id="ER'.$num.'">
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
        <textarea class="form-control rounded-0 mt-2 mb-2" id="EditAsistentes"><?=$array_comprobacion['asistentes'];?></textarea>
      </td>
    </tr>

    <tr>
      <td colspan="2" class="p-2">
        <b>Comentarios:</b>
        <textarea class="form-control rounded-0 mt-2 mb-2" id="EditComentarios"><?=$array_comprobacion['comentarios'];?></textarea>
      </td>
    </tr>

  </tbody>
</table>
</div>

  </div>
  <div class="modal-footer">
  <button type="button" class="btn btn-primary" style="border-radius: 0px;" onclick="BtnEditar(<?=$id;?>)">Editar</button>
  </div>