<?php
require('../../../app/help.php');


$sql_precio = "SELECT * FROM tb_cambio_precio WHERE id_estacion = '".$_GET['idEstacion']."' ORDER BY id desc";
$result_precio = mysqli_query($con, $sql_precio);
$numero_precio = mysqli_num_rows($result_precio);


?>

<div class="mb-2" style="overflow-y: hidden;">
<table class="table table-bordered table-striped table-sm table-hover">
<thead>	
<tr>
<th class="text-center align-middle">#</th>
<th class="text-center align-middle">Creación</th>
<th class="text-center align-middle">Fecha</th>
<th class="text-center align-middle">Hora</th> 
<th class="text-center align-middle">G Super</th>
<th class="text-center align-middle">G Premium</th>
<th class="text-center align-middle">G Diesel</th>
<th class="text-center align-middle"></th>
</tr>
</thead>
<tbody style="font-size: .9em;">
<?php
if ($numero_precio > 0) {
while($row_precio = mysqli_fetch_array($result_precio, MYSQLI_ASSOC)){

	if ($row_precio['gdiesel'] == "") {
	$gdiesel = "";
	}else{
	$gdiesel = $row_precio['gdiesel'];
	}

	if ($row_precio['estado'] == 0) {
	$estado = "<img src='".RUTA_IMG_ICONOS."peligro-amarillo-16.png' title='Pendiente en actualizar' onclick='BtnActualizar(".$row_precio['id'].")'>";
	}else{
	$estado = "<img src='".RUTA_IMG_ICONOS."correcto-16.png' >";
	}

echo "<tr>"; 
echo "<td class='text-center font font-weight-bold'>".$row_precio['id']."</td>";
echo "<td class='text-center font font-weight-bold'>".$row_precio['fechacreacion']."</td>";
echo "<td class='text-center font font-weight-bold'>".$row_precio['fecha']."</td>";
echo "<td class='text-center font font-weight-bold'>".$row_precio['hora']."</td>";
echo "<td class='text-center font font-weight-bold text-success'>".$row_precio['gsuper']."</td>";
echo "<td class='text-center font font-weight-bold text-danger'>".$row_precio['gpremium']."</td>";
echo "<td class='text-center font font-weight-bold'>".$gdiesel."</td>";

echo "<td class='text-center font font-weight-bold align-middle' width='20px'>".$estado."</td>";

echo "</tr>";
}
?>
<?php	
}else{
echo "<td colspan='8' class='text-center text-secondary' style='font-size: .8em;'>No se encontró información</td>";
}
?>
</tbody>
</table>
</div>