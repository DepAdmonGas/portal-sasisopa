<?php 
require('../../../app/help.php');

$idEstacion = $_GET['idEstacion'];

$sql_listaestacion = "SELECT nombre FROM tb_estaciones WHERE id = '".$idEstacion."' ";
$result_listaestacion = mysqli_query($con, $sql_listaestacion);
while($row_listaestacion = mysqli_fetch_array($result_listaestacion, MYSQLI_ASSOC)){
$estacion = $row_listaestacion['nombre'];
}

function Dispensario($dispensario, $con){

$sql = "SELECT no_dispensario FROM tb_dispensarios WHERE id = '".$dispensario."' ";
$result = mysqli_query($con, $sql);
while($row = mysqli_fetch_array($result, MYSQLI_ASSOC)){
$dispensario = $row['no_dispensario'];

}

return $dispensario;
}
?>




<div class="border-0 p-3"> 

<div class="row">
<div class="col-10">
<h5> Apertura de dispensarios - <?=$estacion;?> </h5>
</div>


<div class="col-2">

<img class="float-end pointer" src="<?=RUTA_IMG_ICONOS;?>agregar.png" onclick="Modal(<?=$idEstacion;?>)">

</div>
</div>

<hr> 

<div class="table-responsive">
<table class="table table-sm table-bordered pb-0 mb-0 mt-1" style="font-size: .8em;">
  <thead class="table-bg">
	<tr>
		<th>Dispensario</th>
		<th>Motivo</th>
		<th>Producto</th>
		<th>Lado</th>
		<th>Fecha</th>
		<th>Hora</th>
		<th>Detalle</th>
	</tr>	
</thead>
<tbody>
<?php 

$sql = "SELECT * FROM tb_dispensarios_apertura WHERE id_estacion = '".$idEstacion."' ORDER BY fecha DESC, hora DESC, dispensario DESC";
$result = mysqli_query($con, $sql);
$numero = mysqli_num_rows($result);

	if ($numero > 0) {
	while($row = mysqli_fetch_array($result, MYSQLI_ASSOC)){

	$id = $row['id'];
	$Dispensario = Dispensario($row['dispensario'], $con);

	echo '<tr>';
	echo '<td>'.$Dispensario.'</td>
		  <td><b>'.$row['clave'].'</b> ('.$row['motivo'].')</td>
		  <td>'.$row['producto'].'</td>
		  <td>'.$row['lado'].'</td>
		  <td>'.$row['fecha'].'</td>
		  <td>'.$row['hora'].'</td>
		  <td>'.$row['detalle'].'</td>';
	echo '</tr>';
	}
	}else{
   echo "<tr><td colspan='9' class='text-center'><small>No se encontró información para mostrar</small></td></tr>";
	}

?>
</tbody>
</table>
</div>

</div>

<script type="text/javascript">
	$(".LoaderPage").hide();
</script>