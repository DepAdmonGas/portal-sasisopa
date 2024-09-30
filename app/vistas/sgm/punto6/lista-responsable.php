<?php
require('../../../../app/help.php');

$sql = "SELECT * FROM sgm_responsable WHERE id_estacion = '".$Session_IDEstacion."' ORDER BY fecha DESC";
$result = mysqli_query($con, $sql);
$numero = mysqli_num_rows($result);
?>

<table class="table table-bordered table-striped table-hover table-sm mb-0 pb-0">
<thead>
<tr>
  <th class="text-center align-middle">#</th>
  <th class="text-center align-middle">Fecha</th>
  <th class="text-center align-middle"></th>
  <th class="text-center align-middle"></th>
</tr>
</thead>
<tbody>
<?php
$num = 1;
if ($numero > 0) {
while($row = mysqli_fetch_array($result, MYSQLI_ASSOC)){

echo "<tr>";
echo "<td class='text-center align-middle'>".$num."</td>";
echo "<td class='text-center align-middle'>".FormatoFecha($row['fecha'])."</td>";

echo "<td class='text-center align-middle' width='30'><img src='".RUTA_IMG_ICONOS."pdf.png' style='cursor: pointer;' onclick='DescargarResponsable(".$row['id'].")'></td>";

echo "<td class='text-center align-middle' width='30'><img src='".RUTA_IMG_ICONOS."eliminar.png' style='cursor: pointer;' onclick='EliminarResponsable(".$row['id'].")'></td>";
echo "</tr>";
$num++;
}
}else{
echo "<td colspan='4' class='text-center text-secondary' style='font-size: .8em;'>No se encontró información para mostrar</td>";
}
?>
</tbody>
</table>


