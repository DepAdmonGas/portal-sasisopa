<?php
require('../../../../app/help.php');

$sql_lista = "SELECT * FROM tb_detector_humo WHERE id_estacion = '".$Session_IDEstacion."' AND estado = 1 ";
$result_lista = mysqli_query($con, $sql_lista);
$numero_lista = mysqli_num_rows($result_lista);

?>

 <div style="overflow-y: hidden;">
<table class="table table-bordered table-striped table-sm pb-0 mb-0">
<thead>	
<tr>
<th class="text-center align-middle" width="200px">No. Detector</th>
<th class="text-center align-middle">Ubicación</th>
<th class="text-center align-middle" width="16px"><img src="<?=RUTA_IMG_ICONOS."eliminar-red-16.png"; ?>"></th>
</tr>
</thead>
<tbody>
<?php

if ($numero_lista > 0) {
while($row_lista = mysqli_fetch_array($result_lista, MYSQLI_ASSOC)){
$id = $row_lista['id'];
$num = $row_lista['no_detector'];
echo '<tr>';
echo '<td class="text-center align-middle">'.$num.'</td>';
echo '<td class="text-center align-middle">'.$row_lista['ubicacion'].'</td>';
echo '<td class="text-center align-middle" width="16px" onclick="Eliminar('.$id.')"><img src="'.RUTA_IMG_ICONOS.'eliminar-red-16.png"></td>';
echo '</tr>';

}
}else{
echo "<td colspan='3' class='text-center text-secondary' style='font-size: .8em;'>No se encontró información para mostrar</td>";
}
?>
</tbody>
</table>
</div>