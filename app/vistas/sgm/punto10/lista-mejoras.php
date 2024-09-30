<?php
require('../../../../app/help.php');
?>
    <table class="table table-bordered table-sm">
      <tbody>
        <tr>
          <td colspan="5" class="bg-secondary text-white"><b>IV.  OPORTUNIDADES DE MEJORA/OBSERVACIONES</b></td>
        </tr>
        <tr class="bg-light">
          <td>No.</td>
          <td>DESCRIPCIÓN</td>
          <td width="32"></td>
        </tr>
      <?php 
      $i = 1;
      $sql = "SELECT * FROM sgm_hallazgo_auditoria_mejora WHERE id_hallazgo = '".$_GET['id']."' ";
      $result = mysqli_query($con, $sql);
      $numero = mysqli_num_rows($result);
      if ($numero > 0) {
      while($row = mysqli_fetch_array($result, MYSQLI_ASSOC)){
      echo '<tr>
      <td class="align-middle">'.$i.'</td>
      <td class="align-middle">'.$row['descripcion'].'</td>
      <td class="text-center align-middle"><img src="'.RUTA_IMG_ICONOS.'eliminar.png" style="cursor: pointer;" onclick="EliminarMejora(0,'.$_GET['id'].','.$row['id'].',18)"></td>
      </tr>';

      $i++;
      }
    }else{
      echo "<td colspan='5' class='text-center text-secondary' style='font-size: .8em;'>No se encontró información para mostrar</td>";
    }

    ?>
      </tbody>      
    </table>

