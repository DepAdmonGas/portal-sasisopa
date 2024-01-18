<?php
require('../../../app/help.php');

	function NombreEquipo($idequipo, $con){
	$sql_equipo = "SELECT * FROM po_mantenimiento_lista WHERE id = '".$idequipo."' ";
	$result_equipo = mysqli_query($con, $sql_equipo);
	$numero_equipo = mysqli_num_rows($result_equipo);
	while($row_equipo = mysqli_fetch_array($result_equipo, MYSQLI_ASSOC)){
	$detalle = $row_equipo['detalle'];
	}	
	return $detalle;
	}

    function FormatFolio($Folio){
    $NumString = strlen($Folio);    
    if($NumString == 1){
    $resultado = "00".$Folio;    
    }else if($NumString == 2){
    $resultado = "0".$Folio;    
    }else if($NumString == 3){
    $resultado = $Folio;    
    }
    return $resultado;    
    }

$sql_extintores = "SELECT * FROM po_extintores_estacion WHERE id_estacion = '".$Session_IDEstacion."' ORDER BY no_extintor desc";
$result_extintores = mysqli_query($con, $sql_extintores);
$numero_extintores = mysqli_num_rows($result_extintores);

$sql_mantenimiento = "SELECT * FROM po_mantenimiento_verificar WHERE id_estacion = '".$Session_IDEstacion."' AND 
(fechacreacion = '".$fecha_del_dia."' OR estado = 0) ";
$result_mantenimiento = mysqli_query($con, $sql_mantenimiento);
$numero_mantenimiento = mysqli_num_rows($result_mantenimiento);

if ($numero_extintores > 0) {
if ($numero_mantenimiento > 0) {

echo "<div class='row'>";
while($row_mantenimiento = mysqli_fetch_array($result_mantenimiento, MYSQLI_ASSOC)){
$id = $row_mantenimiento['id'];
$idequipo = $row_mantenimiento['id_equipo'];
$fecha = FormatoFecha($row_mantenimiento['fechacreacion']);
$hora = date("h:i a",strtotime($row_mantenimiento['horacreacion']));
$estado = $row_mantenimiento['estado'];
$NombreEquipo = NombreEquipo($idequipo, $con);
$folio = FormatFolio($row_mantenimiento['folio']);

if ($estado == 0) {
$estadoM = "Pendiente";
$txtColor = "text-warning";
}else if ($estado == 1){
$estadoM = "Finalizado";
$txtColor = "text-success";
}else if ($estado == 2){
$estadoM = "Cancelado";
$txtColor = "text-danger";
}


echo "<div class='col-xl-3 col-lg-3 col-md-6 col-sm-12 mt-2 mb-2'>";
echo "<div class='shadow-sm border p-2 c-pointer hover-div' onclick='DetalleMantenimiento($id)'>";
?>

<table class="border-bottom" width="100%">
	<tr>
		<td class="text-left"><b>Folio: <?=$folio;?></b></td>
		<td class="font-weight-bold text-right <?=$txtColor;?>"><?=$estadoM?></td>
	</tr>
</table>

<div class="text-center mb-3 mt-3"><b><?=$NombreEquipo?></b></div>
<div class="text-right text-secondary border-top pt-2"><small><?=$fecha;?>, <?=$hora;?></small></div>
<?php
echo "</div>";
echo "</div>";

}
echo "</div>";
}else{

echo "<div class='text-center mt-4 mb-4'><small>No se encontró información para mostrar</small></div>";

}
}else{
	echo "<div class='text-center mt-4 mb-4'>
	<div><small>No se encontraron extintores disponibles en tu lista.</small></div>
	<button type='button' class='btn btn-primary rounded-0 mt-4' onclick='ConfiguracionExtintores()'>Configuración de Extintores</button>
	</div>";
}

//------------------
mysqli_close($con);
//------------------

?>

