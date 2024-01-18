<?php 
require ('../../../app/help.php');

$idEstacion = $_GET['idEstacion'];
$Dia = $_GET['fecha'];
$CalenDate = date("Y-m-d",$Dia);

$sql = "SELECT * FROM tb_calendario_actividades WHERE id_estacion  = '".$idEstacion."' AND fecha_inicio = '".$CalenDate."' ";
$result = mysqli_query($con, $sql);
$numero = mysqli_num_rows($result);

function Actividad($idActividad,$con){
$sql = "SELECT formato, actividad FROM sa_sasisopa_actividades WHERE id = '".$idActividad."' ";
$result = mysqli_query($con, $sql);
$numero = mysqli_num_rows($result);
while($row = mysqli_fetch_array($result, MYSQLI_ASSOC)){
$formato = $row['formato'];	
$actividad = $row['actividad'];	
}

$array = array('formato' => $formato, 'actividad' => $actividad);
return $array;
}
?>

<div class="card rounded-0">
<div class="card-body">
<h5><?=FormatoFecha($CalenDate);?></h5>
<?php 

if ($numero > 0) {
echo '<ul class="list-group mt-3 rounded-0">';
while($row = mysqli_fetch_array($result, MYSQLI_ASSOC)){
$id = $row['id'];

$Actividad = Actividad($row['id_actividad'],$con);

echo ' <li class="list-group-item list-group-item-action fs-5 fw-light" onclick="DetalleActividad('.$id.')">
<b>00'.$row['folio'].'</b> '.$Actividad['formato'].' '.$Actividad['actividad'].'</li>';
}
echo '</ul>';
}else{
echo '<div class="alert alert-secondary mt-4" role="alert">
  No se encontraron actividades 
</div>';	
}


?>


</div>
</div>