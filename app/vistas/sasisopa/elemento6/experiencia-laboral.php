<?php
require('../../../../app/help.php');
$idUsuario = $_GET['idUsuario'];
?> 
<div class="row">
<div class="col-12" style="font-size: 1.4em;">
4. Experiencia laboral
</div>
<div class="col-10">
<div class="mt-2 ml-3" style="font-size: 1.2em;">
4.1 En otras empresas
</div>
</div>
<div class="col-2 mt-2">
  <a class="float-right" onclick="ModalEL()" style="cursor: pointer;" data-toggle="tooltip" data-placement="right" title="Agregar"><img src="<?php echo RUTA_IMG_ICONOS."agregar.png"; ?>">
</a>
</div>
</div>

<div style="overflow-y: hidden;">
<table class="table table-bordered table-striped table-sm" style="margin-top: 10px;font-size: 1.2em;">
  <tbody style="font-size: .9em;">
  <?php
  $sql_e_laboral = "SELECT * FROM tb_usuarios_experiencia_laboral WHERE id_usuario = '".$idUsuario."' ";
  $result_e_laboral = mysqli_query($con, $sql_e_laboral);
  $numero_e_laboral = mysqli_num_rows($result_e_laboral);
  if ($numero_e_laboral > 0) {
  while($row_laboral = mysqli_fetch_array($result_e_laboral, MYSQLI_ASSOC)){
  $idEL = $row_laboral['id'];
  echo "<tr>";
  echo "<td>".$row_laboral['detalle']."</td>";
  echo "<td class='align-middle text-center' width='20px'><img src='".RUTA_IMG_ICONOS."eliminar-red-16.png' style='cursor: pointer;' data-toggle='tooltip' data-placement='right' title='Eliminar' onclick='EliminarEL($idEL,$idUsuario)'></td>";
  echo "</tr>";
  }
  }else{
  echo "<tr><td colspan='' class='text-center text-secondary'>No se encontro información de experiencia laboral en otras empresas</td></tr>";
  }
  ?>
  </tbody>
</table>
</div>




