<?php
require('../../../../app/help.php');


?>
    <table class="table table-bordered table-sm">
      <tbody>
        <tr>
          <td colspan="5" class="bg-secondary text-white"><b>III. DOCUMENTACIÓN DE LOS HALLAZGOS NO CONFORMES</b></td>
        </tr>
        <tr class="bg-light">
          <td>No.</td>
          <td>DESCRIPCIÓN DEL HALLAZGO</td>
          <td>EVIDENCIA</td>
          <td>CRITERIO</td>
          <td width="32"></td>
        </tr>
      <?php 
      $i = 1;
      $sql = "SELECT * FROM sgm_hallazgo_auditoria_conformes WHERE id_hallazgo = '".$_GET['id']."' ";
      $result = mysqli_query($con, $sql);
      $numero = mysqli_num_rows($result);
      if ($numero > 0) {
      while($row = mysqli_fetch_array($result, MYSQLI_ASSOC)){
      echo '<tr>
      <td class="align-middle">'.$i.'</td>
      <td class="align-middle">'.$row['descripcion'].'</td>
      <td class="align-middle">'.$row['evidencia'].'</td>
      <td class="align-middle">'.$row['criterio'].'</td>
      <td class="text-center align-middle"><img src="'.RUTA_IMG_ICONOS.'eliminar.png" style="cursor: pointer;" onclick="EliminarConformes(0,'.$_GET['id'].','.$row['id'].',17)"></td>
      </tr>';

      $i++;
      }
    }else{
      echo "<td colspan='5' class='text-center text-secondary' style='font-size: .8em;'>No se encontró información para mostrar</td>";
    }

          ?>
      </tbody>      
    </table>