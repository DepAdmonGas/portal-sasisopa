<?php
require('../../../../app/help.php');

$sql_lista = "SELECT * FROM tb_dispensarios WHERE id_estacion = '".$Session_IDEstacion."' AND estado = 1 ";
$result_lista = mysqli_query($con, $sql_lista);
$numero_lista = mysqli_num_rows($result_lista);

?>

 <div class="mb-2" style="overflow-y: hidden;">
<table class="table table-bordered table-striped table-sm">
<thead>	
<tr>
<th class="text-center align-middle">No Dispensario</th>
<th class="text-center align-middle">Marca</th>
<th class="text-center align-middle">Modelo</th>
<th class="text-center align-middle">Serie</th>
<th class="text-center align-middle">Mangueras <?=$Session_ProductoUno;?></th>
<th class="text-center align-middle">Mangueras <?=$Session_ProductoDos;?></th>
<th class="text-center align-middle">Mangueras <?=$Session_ProductoTres;?></th>
<th class="text-center align-middle" width="16px"><img src="<?=RUTA_IMG_ICONOS."eliminar-red-16.png"; ?>"></th>
</tr>
</thead>
<tbody>
<?php

if ($numero_lista > 0) {
while($row_lista = mysqli_fetch_array($result_lista, MYSQLI_ASSOC)){
$id = $row_lista['id'];
$num = $row_lista['no_dispensario'];
echo '<tr>';
echo '<td class="text-center align-middle">'.$num.'</td>';
echo '<td class="text-center align-middle">'.$row_lista['marca'].'</td>';
echo '<td class="text-center align-middle">'.$row_lista['modelo'].'</td>';
echo '<td class="text-center align-middle">'.$row_lista['serie'].'</td>';
echo '<td class="text-center align-middle">'.$row_lista['producto1'].'</td>';
echo '<td class="text-center align-middle">'.$row_lista['producto2'].'</td>';
echo '<td class="text-center align-middle">'.$row_lista['producto3'].'</td>';
echo '<td class="text-center align-middle" width="16px" onclick="eliminar('.$id.')"><img src="'.RUTA_IMG_ICONOS.'eliminar-red-16.png"></td>';
echo '</tr>';

}
}else{
echo "<td colspan='8' class='text-center text-secondary' style='font-size: .8em;'>No se encontró información para mostrar</td>";
}
?>
</tbody>
</table>
</div>