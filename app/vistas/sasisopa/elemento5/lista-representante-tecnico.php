<?php
require('../../../../app/help.php');

$sql_capacitacion = "SELECT * FROM tb_representante_tecnico WHERE id_estacion = '".$Session_IDEstacion."' ";
$result_capacitacion = mysqli_query($con, $sql_capacitacion);
$numero_capacitacion = mysqli_num_rows($result_capacitacion);

?>
<table class="table table-bordered table-striped table-sm pb-0 mb-0" id="tabla-formato-asignacion-representante-tecnico">
<thead>	
<tr class="bg-primary text-white">
<th class="text-center align-middle">No</th>
<th class="text-center align-middle">Nombre del representante técnico </th>
<th class="text-center align-middle">Fecha de asignación</th>
<th class="text-center align-middle" width="35px"><i class="fas fa-ellipsis-v"></i></th>
</tr>
</thead>
<tbody>
<?php
$num = 1;
if ($numero_capacitacion > 0) {
while($row_capacitacion = mysqli_fetch_array($result_capacitacion, MYSQLI_ASSOC)){
$id = $row_capacitacion['id'];

echo "<tr>";
echo "<td class='text-center'>".$num."</td>";
echo "<td class='text-center'>".$row_capacitacion['nom_representante']."</td>";
echo "<td class='text-center'>".FormatoFecha($row_capacitacion['fecha'])."</td>";

echo '<td class="text-center align-middle" width="20px" style="cursor: pointer;">
  <div class="dropdown dropstart">
  <a class="btn btn-sm btn-icon-only text-dropdown-light" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
  <i class="fas fa-ellipsis-v"></i>
  </a>
  <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">
    <a class="dropdown-item" href="'.$row_capacitacion['archivo'].'" download><i class="fa-regular fa-file-pdf"></i> Descargar PDF</a>
    <a class="dropdown-item" onclick="EliminarRT('.$id.')"><i class="fa-regular fa-trash-can"></i> Eliminar</a>
  </div>
  </div>
  </td>';

echo "</tr>";

$num = $num + 1;
}
}
?>	
</tbody>
</table>
