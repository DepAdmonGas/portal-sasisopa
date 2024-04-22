<?php
require('../../../../app/help.php');
$idUsuario = $_GET['idUsuario'];
?>
<div class="border mt-3">
<div class="p-3">

<div class="row">

<div class="col-10">
<div style="font-size: 1.4em;">
3. Formación académica
</div>
</div>

<div class="col-2">
<a class="float-right" onclick="ModalFA()" style="cursor: pointer;" data-toggle="tooltip" data-placement="right" title="Agregar"><img src="<?php echo RUTA_IMG_ICONOS."agregar.png"; ?>"></a>
</div>

</div>

<hr>

<div class="mb-2" style="overflow-y: hidden;">
<table class="table table-bordered table-striped table-sm" style="margin-top: 10px;font-size: 1.2em;">
  <thead>
  <tr>
    <th class="text-center">Nivel:</th>
    <th class="text-center" colspan="2">Institución:</th>
  </tr>
  </thead>
  <tbody style="font-size: .9em;">
  <?php
  $sql_f_academica = "SELECT * FROM tb_usuarios_formacion_academica WHERE id_usuario = '".$idUsuario."' ";
  $result_f_academica = mysqli_query($con, $sql_f_academica);
  $numero_f_academica = mysqli_num_rows($result_f_academica);
  if ($numero_f_academica > 0) {
  while($row_academica = mysqli_fetch_array($result_f_academica, MYSQLI_ASSOC)){
  $idFA = $row_academica['id'];
  echo "<tr>";
  echo "<td>".$row_academica['nivel']."</td>";
  echo "<td>".$row_academica['detalle']."</td>";
  echo "<td class='align-middle text-center' width='20px'><img src='".RUTA_IMG_ICONOS."eliminar-red-16.png' style='cursor: pointer;' data-toggle='tooltip' data-placement='right' title='Eliminar' onclick='EliminarFA($idFA,$idUsuario)'></td>";
  echo "</tr>";
  }
  }else{
    echo "<tr><td colspan='4' class='text-center text-secondary'>No se encontraron información académica</td></tr>";
  }
  ?>
  </tbody>
</table>
</div>

</div>
</div>


