<?php
require('../../../app/help.php');
$idEstacion = $_GET['idEstacion'];

$sql = "SELECT * FROM tb_calibracion_tanques WHERE id_estacion = '".$idEstacion."' ";
$query = mysqli_query($con, $sql);
$numero = mysqli_num_rows($query);

?>

<table class="table table-bordered table-striped table-hover table-sm">
<thead>
<tr>
<th class="text-center">#</th>
<th class="">Fecha</th>
<th class="text-center" width="24"></th>
<th class="text-center" width="24"></th>
</tr>
</thead>
<tbody>
<?php 
if ($numero > 0) {
while($row = mysqli_fetch_array($query, MYSQLI_ASSOC)){
$id = $row['id'];

echo '<tr>
<td class="text-center align-middle">'.$row['id'].'</td>
<td class="align-middle">'.FormatoFecha($row['fecha']).'</td>
<td class="text-center align-middle p-2" style="cursor: pointer;" onclick="Editar('.$idEstacion.','.$row['id'].')">
<img src="'.RUTA_IMG_ICONOS.'editar.png"></td>
<td class="text-center align-middle p-2" style="cursor: pointer;" onclick="Eliminar('.$idEstacion.','.$row['id'].')">
<img src="'.RUTA_IMG_ICONOS.'eliminar.png"></td>
</tr>';

}
}else{
echo "<tr><td colspan='4' class='text-secondary text-center' >No se encontró información para mostrar.</td></tr>";	
}
?>	

</tbody>
</table>