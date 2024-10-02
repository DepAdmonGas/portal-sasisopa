<?php
require('../../../../app/help.php');

$sql_capacitacion = "SELECT id,fecha_real,curso,fecha_programada,duracion,duraciondetalle,instructor FROM tb_capacitacion_externa WHERE id_estacion = '".$Session_IDEstacion."' ";
$result_capacitacion = mysqli_query($con, $sql_capacitacion);
$numero_capacitacion = mysqli_num_rows($result_capacitacion);

?>

<table class="table table-bordered table-striped table-sm" id="table-capacitacion-externa">
<thead>	
<tr class="bg-primary text-white">
<th class="text-center align-middle">#</th>
<th class="text-center align-middle">Curso</th>
<th class="text-center align-middle">Fecha programada</th>
<th class="text-center align-middle">Duración</th>
<th class="text-center align-middle">Instructor</th>
<th class="text-center align-middle">Fecha real</th>
<th class="text-center align-middle" width="35px"><i class="fas fa-ellipsis-v"></i></th>
</tr>
</thead>
<tbody>
<?php
$num = 1;
if ($numero_capacitacion > 0) {
while($row_capacitacion = mysqli_fetch_array($result_capacitacion, MYSQLI_ASSOC)){
$id = $row_capacitacion['id'];

if ($row_capacitacion['fecha_real'] == "0000-00-00") {
$fechareal = "<small class='text-danger'>Falta editar la fecha real del curso</small>";
}else{
$fechareal = FormatoFecha($row_capacitacion['fecha_real']);
}
echo "<tr>";
echo "<td class='text-center'>".$num."</td>";
echo "<td class='text-center'>".$row_capacitacion['curso']."</td>";
echo "<td class='text-center'>".FormatoFecha($row_capacitacion['fecha_programada'])."</td>";
echo "<td class='text-center'>".$row_capacitacion['duracion']." ".$row_capacitacion['duraciondetalle']."</td>";
echo "<td class='text-center'>".$row_capacitacion['instructor']."</td>";
echo "<td class='text-center'>".$fechareal."</td>";

echo '<td class="text-center align-middle" width="20px" style="cursor: pointer;">
  <div class="dropdown dropstart">
  <a class="btn btn-sm btn-icon-only text-dropdown-light" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
  <i class="fas fa-ellipsis-v"></i>
  </a>
  <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">
    <a class="dropdown-item" onclick="Editar('.$id.')"><i class="fa-regular fa-pen-to-square"></i> Editar</a>
    <a class="dropdown-item" onclick="Personal('.$id.')"><i class="fa-solid fa-users"></i> Trabajadores</a>
    <a class="dropdown-item" onclick="DescargarRegistro('.$id.')"><i class="fa-regular fa-file-pdf"></i> Descargar PDF</a>
    <a class="dropdown-item" onclick="EliminarRegistro('.$id.')"><i class="fa-regular fa-trash-can"></i> Eliminar</a>
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