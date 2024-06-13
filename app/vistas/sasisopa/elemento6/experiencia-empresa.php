<?php
require('../../../../app/help.php');
$idUsuario = $_GET['idUsuario'];
?>
<div class="row">
<div class="col-10">
<div class="mt-2 ml-3" style="font-size: 1.2em;">
4.2 En la empresa
</div>
</div>
<div class="col-2 mt-2">
<a class="float-right" onclick="ModalEE()" style="cursor: pointer;" data-toggle="tooltip" data-placement="right" title="Agregar"><img src="<?php echo RUTA_IMG_ICONOS."agregar.png"; ?>">
</a>
</div>
</div>

<div class="mb-2" style="overflow-y: hidden;">
<table class="table table-bordered table-striped table-sm" style="margin-top: 10px;font-size: 1.2em;">
  <thead>
  <tr>
    <th class="text-center align-middle" rowspan="2">Razón social</th>
    <th class="text-center align-middle" rowspan="2">Puesto</th>
    <th colspan="4" class="text-center">Periodo</th>
  </tr>
<tr>
    <th class="text-center">Inicio</th>
    <th class="text-center" colspan="3">Termino</th>
  </tr>
  </thead>
  <tbody style="font-size: .9em;">
  <?php
  $sql_e_grupo = "SELECT id,periodo_fin,periodo_fin,razon_social,puesto,periodo_inicio FROM tb_usuarios_experiencia_empresa_grupo WHERE id_usuario = '".$idUsuario."' ";
  $result_e_grupo = mysqli_query($con, $sql_e_grupo);
  $numero_e_grupo = mysqli_num_rows($result_e_grupo);
  if ($numero_e_grupo > 0) {
  while($row_grupo = mysqli_fetch_array($result_e_grupo, MYSQLI_ASSOC)){
  $idEE = $row_grupo['id'];

  if($row_grupo['periodo_fin'] == '0000-00-00'){
  $PeriodoFin = 'S/I';
  }else{
  $PeriodoFin = FormatoFecha($row_grupo['periodo_fin']);
  }

  echo "<tr>";
  echo "<td class='text-center'>".$row_grupo['razon_social']."</td>";
  echo "<td class='text-center'>".$row_grupo['puesto']."</td>";
  echo "<td class='text-center'>".FormatoFecha($row_grupo['periodo_inicio'])."</td>";
  echo "<td class='text-center'>".$PeriodoFin."</td>";
  echo "<td class='align-middle text-center' width='20px'><img src='".RUTA_IMG_ICONOS."edit-black-16.png' style='cursor: pointer;' data-toggle='tooltip' data-placement='right' title='Editar' onclick='ModalEditarEE(".$idUsuario.",".$idEE.")'></td>";
    echo "<td class='align-middle text-center' width='20px'><img src='".RUTA_IMG_ICONOS."eliminar-red-16.png' style='cursor: pointer;' data-toggle='tooltip' data-placement='right' title='Eliminar' onclick='EliminarEE($idEE,$idUsuario)'></td>";
  echo "</tr>";
  }
  }else{
    echo "<tr><td colspan='4' class='text-center text-secondary'>No se encontro información de experiencia laboral en esta empresa</td></tr>";
  }
  ?>
  </tbody>
</table>

</div>
