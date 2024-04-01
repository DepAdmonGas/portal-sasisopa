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

$pagina = $_GET['page'];
$registro_por_pagina = 200;
$start_pagina = ($pagina-1)*$registro_por_pagina;
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

$sql = "SELECT * FROM tb_dispensarios_apertura WHERE id_estacion = '".$idEstacion."' ORDER BY fecha DESC, hora DESC, dispensario DESC LIMIT $start_pagina , $registro_por_pagina";
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

<?php
function TotalConte($idEstacion,$con){
	$sql_rs = "SELECT id FROM tb_dispensarios_apertura WHERE id_estacion = '".$idEstacion."'";
	$result_rs = mysqli_query($con, $sql_rs);
	$numero = mysqli_num_rows($result_rs);
	return $numero;
	}

$TotalConte = TotalConte($idEstacion,$con);
$TotalPaginas = ceil($TotalConte/$registro_por_pagina);
$adjacents  = 1;

echo paginate($pagina, $TotalPaginas, $adjacents,$idEstacion);

function paginate($page, $tpages, $adjacents,$idEstacion) {
	$prevlabel = "Anterior";
	$nextlabel = "Siguiente";
	$out = '<ul class="pagination justify-content-end pagination-sm rounded-0 mt-2">';

	// previous label

	if($page==1) {
	$out.= "<li class='page-item disabled rounded-0'><a class='page-link rounded-0'>$prevlabel</a></li>";
	} else if($page==2) {
	$out.= "<li class='page-item rounded-0'><a class='page-link rounded-0' href='javascript:void(0);' onclick='Estacion($idEstacion,1)'>$prevlabel</a></li>";
	}else {
	$out.= "<li><a class='page-link rounded-0' href='javascript:void(0);' onclick='Estacion($idEstacion,".($page-1).")'>$prevlabel</a></li>";
	}

	// first label
	if($page>($adjacents+1)) {
	$out.= "<li class='page-item rounded-0'><a class='page-link rounded-0' href='javascript:void(0);' onclick='Estacion($idEstacion,1)'>1</a></li>";
	}
	// interval
	if($page>($adjacents+2)) {
	$out.= "<li class='page-item rounded-0'><a class='page-link rounded-0'>...</a></li>";
	}

	// pages

	$pmin = ($page>$adjacents) ? ($page-$adjacents) : 1;
	$pmax = ($page<($tpages-$adjacents)) ? ($page+$adjacents) : $tpages;
	for($i=$pmin; $i<=$pmax; $i++) {
	if($i==$page) {
	$out.= "<li class='page-item rounded-0 active'><a class='page-link rounded-0'>$i</a></li>";
	}else if($i==1) {
	$out.= "<li class='page-item rounded-0'><a class='page-link rounded-0' href='javascript:void(0);' onclick='Estacion($idEstacion,1)'>$i</a></li>";
	}else {
	$out.= "<li class='page-item rounded-0'><a class='page-link rounded-0' href='javascript:void(0);' onclick='Estacion($idEstacion,".$i.")'>$i</a></li>";
	}
	}
	// interval
	if($page<($tpages-$adjacents-1)) {
	$out.= "<li class='page-item rounded-0'><a class='page-link rounded-0'>...</a></li>";
	}
	// last
	if($page<($tpages-$adjacents)) {
	$out.= "<li class='page-item rounded-0'><a class='page-link rounded-0' href='javascript:void(0);' onclick='Estacion($idEstacion,$tpages)'>$tpages</a></li>";
	}
	// next
	if($page<$tpages) {
	$out.= "<li class='page-item rounded-0'><a class='page-link rounded-0' href='javascript:void(0);' onclick='Estacion($idEstacion,".($page+1).")'>$nextlabel</a></li>";
	}else {
	$out.= "<li class='page-item rounded-0 disabled'><a class='page-link rounded-0'>$nextlabel</a></li>";
	}

	$out.= "</ul>";
	return $out;
}
?>

</div>

<script type="text/javascript">
	$(".LoaderPage").hide();
</script>