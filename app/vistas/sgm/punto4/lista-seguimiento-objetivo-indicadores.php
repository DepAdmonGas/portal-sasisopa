<?php
require('../../../../app/help.php');

$sql_capacitacion = "SELECT * FROM sgm_seguimiento_objetivo_indicador WHERE id_estacion = '".$Session_IDEstacion."' ORDER BY id DESC ";
$result_capacitacion = mysqli_query($con, $sql_capacitacion);
$numero_capacitacion = mysqli_num_rows($result_capacitacion);

?>
<table class="table table-bordered table-striped table-sm" id="table-seguimiento-objetivo-indicadores">
<thead>	
<tr class="bg-primary text-white">
<th class="text-center align-middle">#</th>
<th class="text-center align-middle">Fecha</th>
<th class="text-center align-middle">Hora</th>
<th class="text-center align-middle" width="35px"><i class="fas fa-ellipsis-v"></i></th>
</tr>
</thead>
<tbody>
<?php
$num = 1;
if ($numero_capacitacion > 0) {
while($row_capacitacion = mysqli_fetch_array($result_capacitacion, MYSQLI_ASSOC)){
$id = $row_capacitacion['id'];
$estado = $row_capacitacion['estado'];

if($estado == 1){
$trColor = "";
}else{
$trColor = 'style="background-color: #fbf8ce"';
}

echo "<tr ".$trColor.">";
echo "<td class='text-center'>".$num."</td>";
echo "<td class='text-center'>".FormatoFecha($row_capacitacion['fecha'])."</td>";
echo "<td class='text-center'>".date('g:i a', strtotime($row_capacitacion['hora']))."</td>";

echo '<td class="text-center align-middle" width="20px" style="cursor: pointer;">
  <div class="dropdown dropstart">
  <a class="btn btn-sm btn-icon-only text-dropdown-light" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
  <i class="fas fa-ellipsis-v"></i>
  </a>
  <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">
    <a class="dropdown-item" onclick="EditarSeguimiento('.$id.')"><i class="fa-regular fa-pen-to-square"></i> Editar</a>
    <a class="dropdown-item" onclick="DescargarSeguimiento('.$id.')"><i class="fa-regular fa-file-pdf"></i> Descargar PDF</a>
    <a class="dropdown-item" onclick="EliminarSeguimiento('.$id.')"><i class="fa-regular fa-trash-can"></i> Eliminar</a>
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