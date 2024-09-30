<?php
require('../../../../app/help.php');
include_once "../../../../app/modelo/Asistencia.php";

$class_asistencia = new Asistencia();
$idSasisopa = $_GET['idSasisopa'];
$lista_asistencia = $class_asistencia->listaAsistencia($Session_IDEstacion,$idSasisopa);
$numero_asistencia = mysqli_num_rows($lista_asistencia);

?>
<table id="lista-asistencia" class="table table-striped table-sm table-bordered table-hover">
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
if ($numero_asistencia > 0) {
while($row = mysqli_fetch_array($lista_asistencia, MYSQLI_ASSOC)){
$id = $row['id'];
$estado = $row['estado'];

if($estado == 1){
$bgTable = "";
}else{
$bgTable = 'style="background-color: #fbf8ce"';
}

echo "<tr $bgTable>";
echo "<td class='text-center fw-bold'>".$num."</td>";
echo "<td class='text-center'>".FormatoFecha($row['fecha'])."</td>";
echo "<td class='text-center'>".date('g:i a', strtotime($row['hora']))."</td>";

echo '<td class="text-center align-middle" width="20px" style="cursor: pointer;">
  <div class="dropdown dropstart">
  <a class="btn btn-sm btn-icon-only text-dropdown-light" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
  <i class="fas fa-ellipsis-v"></i>
  </a>
  <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">
    <a class="dropdown-item" onclick="EditarAsistencia('.$id.')"><i class="fa-regular fa-pen-to-square"></i> Editar</a>
    <a class="dropdown-item" onclick="DescargarAsistencia('.$id.')"><i class="fa-regular fa-file-pdf"></i> Descargar PDF</a>
    <a class="dropdown-item" onclick="EliminarAsistencia('.$id.')"><i class="fa-regular fa-trash-can"></i> Eliminar</a>
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