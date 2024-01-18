<?php
require('../../../app/help.php');

$idMantenimiento = $_GET['idMantenimiento'];
$FirmaImg = "http://portal.admongas.com.mx/api-bitacora-fulles/app/Mantenimiento/ImagenFirma/";
$actualpath = "http://portal.admongas.com.mx/api-bitacora-fulles/app/Mantenimiento/Evidencias/";

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

$sql_mantenimiento = "SELECT * FROM bi_mantenimientos WHERE id = '".$idMantenimiento."' ";
$result_mantenimiento = mysqli_query($con, $sql_mantenimiento);
$numero_mantenimiento = mysqli_num_rows($result_mantenimiento);
while($row_mantenimiento = mysqli_fetch_array($result_mantenimiento, MYSQLI_ASSOC)){

$folio = FormatFolio($row_mantenimiento['folio']);

$idactividad = $row_mantenimiento['id_actividad'];

$fechainicio = FormatoFecha($row_mantenimiento['fechainicio']);
$horainicio = date("g:i a",strtotime($row_mantenimiento['horainicio']));

$fechatermino = FormatoFecha($row_mantenimiento['fechatermino']);
$horatermino = date("g:i a",strtotime($row_mantenimiento['horatermino']));

$descripcion = $row_mantenimiento['descripcion'];
$area = $row_mantenimiento['area'];
$epp = $row_mantenimiento['epp'];
$tipo = $row_mantenimiento['tipo'];

if ($idactividad == "") {
$actividad = $row_mantenimiento['actividad'];
}else{
$actividad = NombreEquipo($idactividad, $con);
}

}

$sql_imagen1 = "SELECT nombre,imagen_firma FROM bi_mantenimientos_firma WHERE id_mantenimiento = '".$idMantenimiento."'  AND tipo_firma = 'FPR' ";
$result_imagen1 = mysqli_query($con, $sql_imagen1);
$numero_imagen1 = mysqli_num_rows($result_imagen1);
while($row_imagen1 = mysqli_fetch_array($result_imagen1, MYSQLI_ASSOC)){
$PR = $row_imagen1['nombre'];
$FPR = $FirmaImg.$row_imagen1['imagen_firma'];
}

$sql_imagen2 = "SELECT nombre,imagen_firma FROM bi_mantenimientos_firma WHERE id_mantenimiento = '".$idMantenimiento."'  AND tipo_firma = 'FPS' ";
$result_imagen2 = mysqli_query($con, $sql_imagen2);
$numero_imagen2 = mysqli_num_rows($result_imagen2);
while($row_imagen2 = mysqli_fetch_array($result_imagen2, MYSQLI_ASSOC)){
$PS = $row_imagen2['nombre'];
$FPS = $FirmaImg.$row_imagen2['imagen_firma'];
}

?>
  <div class="modal-header">
  <h4 class="modal-title">Folio: <?=$folio;?></h4>
  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
  <span aria-hidden="true">&times;</span>
  </button>
  </div>
  <div class="modal-body">
  <div class="text-center font-weight-bold" style="font-size: 1.2em;"><?=$actividad;?></div>

<div class="border-top mt-2 mb-2"></div>

<div class="row">
	<div class="col-6">
		<div class="font-weight-bold">Fecha y hora de inicio</div>
		<div class=""><?=$fechainicio.', '.$horainicio;?></div>
	</div>
	<div class="col-6">
		<div class="font-weight-bold">Fecha y hora de termino</div>
		<div class=""><?=$fechatermino.', '.$horatermino;?></div>
	</div>
</div>

<div class="border-top mt-2 mb-2"></div>
<?php
if ($idactividad != 20) {
?>

<div class="row">
	<div class="col-6">
		<div class="font-weight-bold">Descripción</div>
	<div class=""><?=$descripcion;?></div>
</div>

	<div class="col-3">
		<div class="font-weight-bold">Areá</div>
	<div class=""><?=$area;?></div>
</div>

	<div class="col-3">
		<div class="font-weight-bold">EPP</div>
	<div class=""><?=$epp;?></div>
</div>

</div>

<div class="border-top mt-2 mb-2"></div>
<div class="text-right"><small>Mantenimiento <?=$tipo;?></small></div>

<div class="row mt-2">
<div class="col-6">
<div class="border p-1">
<div class="border-bottom font-weight-bold">Firma de persona que realiza</div>
<img class="text-center" style="width: 80%;" src="<?=$FPR;?>">
<div class="text-center border-top"><small><?=$PR;?></small></div>
</div>
</div>
<div class="col-6">
<div class="border p-1">
<div class="border-bottom font-weight-bold">Firma de persona que superviso</div>
<img class="text-center" style="width: 80%;" src="<?=$FPS;?>">
<div class="text-center border-top"><small><?=$PS;?></small></div>
</div>
</div>
</div>
<?php
$sql_evidencias = "SELECT * FROM bi_mantenimientos_evidencia WHERE id_mantenimiento = '".$idMantenimiento."' ";
$result_evidencias = mysqli_query($con, $sql_evidencias);
$numero_evidencias = mysqli_num_rows($result_evidencias);

echo '<div class="border mt-2 p-1">';
echo '<div class="border-bottom font-weight-bold">Evidencias</div>';
if ($numero_evidencias > 0) {
echo '<div class="row no-gutters mt-2">';
    while($row_evidencias = mysqli_fetch_array($result_evidencias, MYSQLI_ASSOC)){

        $url = $actualpath.$row_evidencias['url'];
        $nombreimg = $row_evidencias['nombre'];

echo '<div class="col-3">'; 
echo '<div class="p-2"><img class="text-center" style="width: 100%;" src="'.$url.'"></div>';
echo '</div>';
    }

echo '</div>';
}else{
echo '<div class="text-center p-2"><small>No se encontraron evidencias</small></div>';
}

echo '</div>';
?>

<?php
}else{
echo '<div class="text-right"><small>Mantenimiento <?=$tipo;?></small></div>';	

function numeroExtintor($idextintor, $con)
{
$sql_extintores = "SELECT * FROM po_extintores_estacion WHERE id = '".$idextintor."' ";
$result_extintores = mysqli_query($con, $sql_extintores);
$numero_extintores = mysqli_num_rows($result_extintores);
 while($row_extintores = mysqli_fetch_array($result_extintores, MYSQLI_ASSOC)){
$resultado = $row_extintores['no_extintor'];
 }

 return $resultado;
}

$sql_extintores = "SELECT * FROM bi_mantenimientos_extintores WHERE id_verificar = '".$idMantenimiento."' ";
$result_extintores = mysqli_query($con, $sql_extintores);
$numero_extintores = mysqli_num_rows($result_extintores);

echo '<table class="table table-bordered table-striped table-sm table-hover mt-3">';
	echo '<thead>';
		echo '<tr>';
			echo '<th class="align-middle text-center">No. De extintor </th>';
			echo '<th class="align-middle text-center">Manometro</th>';
			echo '<th class="align-middle text-center">Boquilla Descarga</th>';
			echo '<th class="align-middle text-center">Manguera</th>';
			echo '<th class="align-middle text-center">Funcionalidad</th>';
			echo '<th class="align-middle text-center">Observaciones</th>';
		echo '</tr>';
	echo '</thead>';
	echo '<tbody>';

if ($numero_extintores > 0) {
    while($row_extintores = mysqli_fetch_array($result_extintores, MYSQLI_ASSOC)){

        $idextintor = $row_extintores['id_extintor'];
        $numeroExtintor = numeroExtintor($idextintor, $con);
        $manometro = $row_extintores['manometro'];
        $boquilladescarga = $row_extintores['boquilla_descarga'];
        $manguera = $row_extintores['manguera'];
        $funcionalidad = $row_extintores['funcionalidad'];
        $observaciones = $row_extintores['observaciones'];

echo '<tr>';
echo '<td class="text-center align-middle">'.$numeroExtintor.'</td>';
echo '<td class="text-center align-middle">'.$manometro.'</td>';
echo '<td class="text-center align-middle">'.$boquilladescarga.'</td>';
echo '<td class="text-center align-middle">'.$manguera.'</td>';
echo '<td class="text-center align-middle">'.$funcionalidad.'</td>';
echo '<td class="text-center align-middle">'.$observaciones.'</td>';
echo '</tr>';
    }

}else{

}
echo '</tbody>';
echo '</table>';
?>

<div class="row mt-2">
<div class="col-6">
<div class="border p-1">
<div class="border-bottom font-weight-bold">Firma de persona que realiza</div>
<img class="text-center" style="width: 80%;" src="<?=$FPR;?>">
<div class="text-center border-top"><small><?=$PR;?></small></div>
</div>
</div>
<div class="col-6">
<div class="border p-1">
<div class="border-bottom font-weight-bold">Firma de persona que superviso</div>
<img class="text-center" style="width: 80%;" src="<?=$FPS;?>">
<div class="text-center border-top"><small><?=$PS;?></small></div>
</div>
</div>
</div>

<?php
}
?>
</div>