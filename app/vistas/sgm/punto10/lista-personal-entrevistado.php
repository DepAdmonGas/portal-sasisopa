<?php
require('../../../../app/help.php');


?>
      <table class="table table-sm table-bordered mb-0">
        <tbody>
          <tr>
          <td colspan="4" class="bg-secondary text-white text-center">PERSONAL ENTREVISTADO</td>
          </tr>
          <tr class="bg-light">
            <td>NOMBRE</td>
            <td>PUESTO</td>
            <td>ÁREA DE ADSCRIPCIÓN</td>
            <td width="32"></td>
          </tr>
          <?php 

      $sql = "SELECT * FROM sgm_hallazgo_auditoria_entrevistador WHERE id_hallazgo = '".$_GET['id']."' ";
		  $result = mysqli_query($con, $sql);
		  $numero = mysqli_num_rows($result);

      if ($numero > 0) {
			while($row = mysqli_fetch_array($result, MYSQLI_ASSOC)){
			echo '<tr>
			<td class="align-middle">'.$row['nombre'].'</td>
			<td class="align-middle">'.$row['puesto'].'</td>
			<td class="align-middle">'.$row['area_descripcion'].'</td>
			<td class="text-center align-middle"><img src="'.RUTA_IMG_ICONOS.'eliminar.png" style="cursor: pointer;" onclick="EliminarEntrevistador(0,'.$_GET['id'].','.$row['id'].',14)"></td>
			</tr>';
			}
      }else{
      echo "<td colspan='4' class='text-center text-secondary' style='font-size: .8em;'>No se encontró información para mostrar</td>";
      }

          ?>

        </tbody>
      </table>