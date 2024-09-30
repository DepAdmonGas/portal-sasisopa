<?php
require('../../../../app/help.php');

$sql_capacitacion = "SELECT * FROM tb_politica_lista_comprobacion WHERE id_estacion = '".$Session_IDEstacion."' ORDER BY fecha DESC ";
$result_capacitacion = mysqli_query($con, $sql_capacitacion);
$numero_capacitacion = mysqli_num_rows($result_capacitacion);

?>

<table id="table_comprobacion" class="table table-sm table-bordered table-striped table-hover">
<thead>	
<tr class="bg-primary text-white">
<th class="text-center align-middle">#</th>
<th class="text-center align-middle">Fecha</th>
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
echo "<td class='text-center fw-bold'>".$num."</td>";
echo "<td class='text-center'>".FormatoFecha($row_capacitacion['fecha'])."</td>";
echo '<td class="text-center align-middle" width="20px" style="cursor: pointer;">
  <div class="dropdown dropstart">
  <a class="btn btn-sm btn-icon-only text-dropdown-light" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
  <i class="fas fa-ellipsis-v"></i>
  </a>
  <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">
    <a class="dropdown-item" onclick="EditarRegistro('.$id.')"><i class="fa-regular fa-pen-to-square"></i> Editar</a>
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
