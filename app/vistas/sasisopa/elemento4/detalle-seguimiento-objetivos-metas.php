<?php 
require('../../../../app/help.php');

?>
        <div class="modal-header rounded-0 head-modal">
          <h4 class="modal-title text-white">Detalle seguimiento de objetivos y metas</h4>
          <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">

      <table class="table table-bordered table-sm table-hover">
      <thead> 
      <tr class="bg-primary text-white">
      <th class="text-center align-middle">Fecha</th>
      <th class="text-center align-middle">Objetivo o meta</th>
      <th class="text-center align-middle">Nivel de cumplimiento</th>
      <th class="text-center align-middle">Medidas de acción para dar cumplimiento</th>
      <th class="text-center align-middle">fecha de aplicación</th>
      </tr>
      </thead>
      <tbody>

      <?php 

      $sql = "SELECT fecha,
      objetivo_meta,
      nivel_cumplimiento,
      medidas,
      fecha_aplicacion FROM tb_seguimiento_objetivos_metas_detalle WHERE id_seguimiento = '".$_GET['idSeguimiento']."' ";
      $result = mysqli_query($con, $sql);
      $numero = mysqli_num_rows($result);
      while($row = mysqli_fetch_array($result, MYSQLI_ASSOC)){

      echo '<tr>
          <td class="text-center align-middle" >'.FormatoFecha($row['fecha']).'</td>
          <td class="text-center align-middle" >'.$row['objetivo_meta'].'</td>
          <td class="text-center align-middle" >'.$row['nivel_cumplimiento'].'</td>
          <td class="text-center align-middle" >'.$row['medidas'].'</td>
          <td class="text-center align-middle" >'.FormatoFecha($row['fecha_aplicacion']).'</td>
          </tr>
          ';


      }
      ?>

      </tbody>
      </table>

      <div class="text-right">
      <button type="button" class="btn btn-info text-white" onclick="EditarDSOM(<?=$_GET['idSeguimiento'];?>)">Editar</button>
        <button type="button" class="btn btn-danger" onclick="EliminarObjetivo(1,<?=$_GET['idSeguimiento'];?>)">Eliminar</button>
      </div>

      </div>