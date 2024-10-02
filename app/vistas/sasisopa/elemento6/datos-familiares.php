<?php
require('../../../../app/help.php');
$idUsuario = $_GET['idUsuario'];
?>
<div class="mt-3">
<div class="row">
<div class="col-10">
<div style="font-size: 1.4em;">
2. Datos de familiares
</div>
</div>
<div class="col-2 text-end">
  <a onclick="AgregarDatos()" style="cursor: pointer;">
  <img src="<?php echo RUTA_IMG_ICONOS."agregar.png"; ?>">
</a>
</div>
</div>

<div style="overflow-y: hidden;">
<table class="table table-bordered table-striped table-sm" style="font-size: 1.2em;">
  <thead>
  <tr>
    <th class="text-center">Nombre:</th>
    <th class="text-center">Parentesco:</th>
    <th class="text-center">Dirección:</th>
    <th class="text-center" colspan="2">Teléfono:</th>
  </tr>
  </thead>
  <tbody style="font-size: .9em;">
  <?php
  $sql_d_familiares = "SELECT id,nombrecompleto,parentesco,domicilio,telefono FROM tb_usuarios_familiares WHERE id_usuario = '".$idUsuario."' ";
  $result_d_familiares = mysqli_query($con, $sql_d_familiares);
  $numero_d_familiares = mysqli_num_rows($result_d_familiares);
  if ($numero_d_familiares > 0) {
    while($row_familiares = mysqli_fetch_array($result_d_familiares, MYSQLI_ASSOC)){
    $idDP = $row_familiares['id'];
    echo "<tr>";
    echo "<td>".$row_familiares['nombrecompleto']."</td>";
    echo "<td>".$row_familiares['parentesco']."</td>";
    echo "<td>".$row_familiares['domicilio']."</td>";
    echo "<td>".$row_familiares['telefono']."</td>";
    echo "<td class='align-middle text-center' width='20px'><img src='".RUTA_IMG_ICONOS."eliminar-red-16.png' style='cursor: pointer;' data-toggle='tooltip' data-placement='right' title='Eliminar' onclick='EliminarDP($idDP,$idUsuario)'></td>";
    echo "</tr>";
    }
  }else{
    echo "<tr><td colspan='4' class='text-center text-secondary'>No se encontraron datos familiares</td></tr>";
  }

  ?>
  </tbody>
</table>
</div>
</div>
