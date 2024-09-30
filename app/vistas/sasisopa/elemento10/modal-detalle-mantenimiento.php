<?php
require('../../../../app/help.php');
include_once "../../../../app/modelo/ControlActividadProceso.php";
$class_control_actividad_proceso = new ControlActividadProceso();
$idMantenimiento = $_GET['idMantenimiento'];


    function ToSublista($idequipo,$con){
    $sql_detalle = "SELECT id FROM po_mantenimiento_detalle WHERE id_lista = '".$idequipo."' GROUP BY id_sublista ";
	$result_detalle = mysqli_query($con, $sql_detalle);
	$numero_detalle = mysqli_num_rows($result_detalle);
	return $numero_detalle;
    }

    function NombreVerificar($iddetalle, $con){
    $sql_detalle = "SELECT detalle FROM po_mantenimiento_detalle WHERE id = '".$iddetalle."' ";
	$result_detalle = mysqli_query($con, $sql_detalle);
	$numero_detalle = mysqli_num_rows($result_detalle);
	while($row_detalle = mysqli_fetch_array($result_detalle, MYSQLI_ASSOC)){
	$detalle = $row_detalle['detalle'];
	}
	return $detalle;
    }

    function ResultadoVerificacion($idMantenimiento,$idDetalle,$con){

    		$sql_detalle = "SELECT resultado FROM po_mantenimiento_verificar_detalle WHERE id_verificar = '".$idMantenimiento."' AND id_detalle = '".$idDetalle."' ";
			$result_detalle = mysqli_query($con, $sql_detalle);
			$numero_detalle = mysqli_num_rows($result_detalle);			
			while($row_detalle = mysqli_fetch_array($result_detalle, MYSQLI_ASSOC)){
		
			if ($row_detalle['resultado'] == "") {
			$TxtResultado = "X";
			}else{
			$TxtResultado = $row_detalle['resultado'];
			}			
			} 
			return $TxtResultado;
    }

    function DetalleSublista($idMantenimiento,$idequipo,$con){
        $resultado = "";
	    $sql_detalle = "SELECT id_lista,id_sublista FROM po_mantenimiento_detalle WHERE id_lista = '".$idequipo."' GROUP BY id_sublista ";
		$result_detalle = mysqli_query($con, $sql_detalle);
		$numero_detalle = mysqli_num_rows($result_detalle);
		while($row_detalle = mysqli_fetch_array($result_detalle, MYSQLI_ASSOC)){

		$idsublista = $row_detalle['id_sublista'];

		$sql_nomSub = "SELECT detalle FROM po_mantenimiento_sub_lista WHERE id = '".$idsublista."' ";
		$result_nomSub = mysqli_query($con, $sql_nomSub);
		$numero_nomSub = mysqli_num_rows($result_nomSub);
		while($row_nomSub = mysqli_fetch_array($result_nomSub, MYSQLI_ASSOC)){
    
   		$resultado .= "<tr>";
		$resultado .= "<td class='align-middle text-center font-weight-bold' colspan='2'>".$row_nomSub['detalle']."</td>";
		$resultado .= "</tr>";

		$sql_DM = "SELECT id, detalle FROM po_mantenimiento_detalle WHERE id_lista = '".$idequipo."' AND id_sublista = '".$idsublista."' ";
        $result_DM = mysqli_query($con, $sql_DM);
        $numero_DM = mysqli_num_rows($result_DM);
        while($row_DM = mysqli_fetch_array($result_DM, MYSQLI_ASSOC)){

        $resultado .= "<tr>";
        $resultado .= "<td class='align-middle'>".$row_DM['detalle']."</td>";
        $resultado .= "<td class='align-middle text-center font-weight-bold'>".ResultadoVerificacion($idMantenimiento,$row_DM['id'],$con)."</td>";
        $resultado .= "</tr>";

        }
   		}
		}

		return $resultado;
    }

    function DetalleVerificar($idMantenimiento,$idequipo,$con){

    	$ruta = "http://portal.admongas.com.mx/bitacora-api-app/app/Mantenimiento/ImagenTirilla/";

    	if ($idequipo != 20) {  

    	$ToSublista = ToSublista($idequipo,$con);
        $resultado = "";
    	$resultado .= "
			<div class='overflow-y: hidden;'>
    	<table class='table table-sm table-bordered mt-2'>";
    	if ($ToSublista == 1) {
    		$sql_detalle = "SELECT * FROM po_mantenimiento_verificar_detalle WHERE id_verificar = '".$idMantenimiento."' ";
			$result_detalle = mysqli_query($con, $sql_detalle);
			$numero_detalle = mysqli_num_rows($result_detalle);			
			while($row_detalle = mysqli_fetch_array($result_detalle, MYSQLI_ASSOC)){
			$NombreVerificar = NombreVerificar($row_detalle['id_detalle'], $con);
			if ($row_detalle['resultado'] == "") {
			$TxtResultado = "X";
			}else{
			$TxtResultado = $row_detalle['resultado'];
			}
			$resultado .= "<tr>";
			$resultado .= "<td class='align-middle'>".$NombreVerificar."</td>";
			$resultado .= "<td class='align-middle text-center font-weight-bold'>".$TxtResultado."</td>";
			$resultado .= "</tr>";
			}    	
    	}else if ($ToSublista >= 2) {
    		$resultado .= DetalleSublista($idMantenimiento,$idequipo,$con);
    	}

	    	$resultado .= "</table>";
	    	$resultado .= "</div>";

	    if($idequipo == 45){

	        $resultado .= "<div class='overflow-y: hidden;'>";
	    	$resultado .= "<table class='table table-sm table-bordered mt-2'>";
	    	$resultado .= "<tr>";
	    	$resultado .= "<th class='align-middle text-center'>Fecha</th>";
	    	$resultado .= "<th class='align-middle text-center'>Hora inicio</th>";
	    	$resultado .= "<th class='align-middle text-center'>Hora termino</th>";
	    	$resultado .= "<th class='align-middle text-center'>Tanque</th>";
	    	$resultado .= "<th class='align-middle text-center'>Producto</th>";
	    	$resultado .= "<th class='align-middle text-center'>Resultado</th>";
	    	$resultado .= "</tr>";
	    	$sql_detalle = "SELECT * FROM po_mantenimiento_prueba_hermeticidad WHERE id_verificar = '".$idMantenimiento."' ";
			$result_detalle = mysqli_query($con, $sql_detalle);
			$numero_detalle = mysqli_num_rows($result_detalle);			
			while($row_detalle = mysqli_fetch_array($result_detalle, MYSQLI_ASSOC)){

			 $Tanque = Tanque($row_detalle['id_tanque'],$con);

			$resultado .= "<tr>";
			$resultado .= "<td class='align-middle'>".$row_detalle['fecha']."</td>";
			$resultado .= "<td class='align-middle'>".$row_detalle['hora_inicio']."</td>";
			$resultado .= "<td class='align-middle'>".$row_detalle['hora_termino']."</td>";
			$resultado .= "<td class='align-middle text-center'>".$Tanque['notanque']."</td>";
			$resultado .= "<td class='align-middle'>".$Tanque['producto']."</td>";
			$resultado .= "<td class='align-middle'>".$row_detalle['resultado']."</td>";
			$resultado .= "</tr>";

			}
	    	$resultado .= "</table>";
	    	$resultado .= "</div>";

	    }

		if($idequipo == 48){

	        $resultado .= "<div class='overflow-y: hidden;'>";
	    	$resultado .= "<table class='table table-sm table-bordered mt-2'>";
	    	$resultado .= "<tr>";
	    	$resultado .= "<th class='align-middle text-center'>Número</th>";
	    	$resultado .= "<th class='align-middle text-center'>Ubicación</th>";
	    	$resultado .= "<th class='align-middle text-center'>Revisión</th>";
	    	$resultado .= "<th class='align-middle text-center'>Resultado</th>";
	    	$resultado .= "</tr>";
	    	$sql_detalle = "SELECT * FROM po_mantenimiento_detector_humo WHERE id_verificar = '".$idMantenimiento."' ";
			$result_detalle = mysqli_query($con, $sql_detalle);
			$numero_detalle = mysqli_num_rows($result_detalle);			
			while($row_detalle = mysqli_fetch_array($result_detalle, MYSQLI_ASSOC)){
			$detector = DetectorHumo($row_detalle['id_detector'],$con);
			$resultado .= "<tr>";
			$resultado .= "<td class='align-middle text-center'>".$detector['nodetector']."</td>";
			$resultado .= "<td class='align-middle'>".$detector['ubicacion']."</td>";
			$resultado .= "<td class='align-middle'>".$row_detalle['revision']."</td>";
			$resultado .= "<td class='align-middle text-center'>".$row_detalle['resultado']."</td>";
			$resultado .= "</tr>";

			}
	    	$resultado .= "</table>";
	    	$resultado .= "</div>";
	    	}

	    }else{

	    	$resultado .= "<div class='overflow-y: hidden;'>";
	    	$resultado .= "<table class='table table-sm table-bordered mt-2'>";
	    	$resultado .= "<tr>";
	    	$resultado .= "<th class='align-middle text-center'>No. De extintor</th>";
	    	$resultado .= "<th class='align-middle text-center'>Manómetro</th>";
	    	$resultado .= "<th class='align-middle text-center'>Boquilla de descarga</th>";
	    	$resultado .= "<th class='align-middle text-center'>Manguera</th>";
	    	$resultado .= "<th class='align-middle text-center'>Funcionalidad</th>";
	    	$resultado .= "<th class='align-middle text-center'>Observaciones</th>";
	    	$resultado .= "</tr>";
	    	$sql_detalle = "SELECT * FROM po_extintores_estacion_detalle WHERE id_verificar = '".$idMantenimiento."' ";
			$result_detalle = mysqli_query($con, $sql_detalle);
			$numero_detalle = mysqli_num_rows($result_detalle);			
			while($row_detalle = mysqli_fetch_array($result_detalle, MYSQLI_ASSOC)){

			$resultado .= "<tr>";
			$resultado .= "<td class='align-middle text-center'>".NoExtintor($row_detalle['id_extintor'],$con)."</td>";
			$resultado .= "<td class='align-middle'>".$row_detalle['manometro']."</td>";
			$resultado .= "<td class='align-middle'>".$row_detalle['boquilla_descarga']."</td>";
			$resultado .= "<td class='align-middle'>".$row_detalle['manguera']."</td>";
			$resultado .= "<td class='align-middle'>".$row_detalle['funcionalidad']."</td>";
			$resultado .= "<td class='align-middle'>".$row_detalle['observaciones']."</td>";
			$resultado .= "</tr>";

			}
	    	$resultado .= "</table>";
	    	$resultado .= "</div>";

	    }
	    	return $resultado;
	    
    }

    function NoExtintor($idextintor,$con){

    	$sql_detalle = "SELECT id, no_extintor FROM po_extintores_estacion WHERE id = '".$idextintor."' ";
			$result_detalle = mysqli_query($con, $sql_detalle);
			$numero_detalle = mysqli_num_rows($result_detalle);			
			while($row_detalle = mysqli_fetch_array($result_detalle, MYSQLI_ASSOC)){
			$no_extintor = $row_detalle['no_extintor'];
			}

			return $no_extintor;

    }

    function Tanque($idTanque,$con){

    $sql_detalle = "SELECT no_tanque, producto FROM tb_tanque_almacenamiento WHERE id = '".$idTanque."' ";
	$result_detalle = mysqli_query($con, $sql_detalle);
	$numero_detalle = mysqli_num_rows($result_detalle);			
	while($row_detalle = mysqli_fetch_array($result_detalle, MYSQLI_ASSOC)){
	$notanque = $row_detalle['no_tanque'];
	$producto = $row_detalle['producto'];
	}

	$array = array('notanque' => $notanque, 'producto' => $producto);
	return $array;

    }

	function DetectorHumo($idDetector,$con){

		$sql_detalle = "SELECT no_detector, ubicacion FROM tb_detector_humo WHERE id = '".$idDetector."' ";
		$result_detalle = mysqli_query($con, $sql_detalle);
		$numero_detalle = mysqli_num_rows($result_detalle);			
		$row_detalle = mysqli_fetch_array($result_detalle, MYSQLI_ASSOC);
		$nodetector = $row_detalle['no_detector'];
		$ubicacion = $row_detalle['ubicacion'];

		$array = array('nodetector' => $nodetector, 'ubicacion' => $ubicacion);
		return $array;

	}

    //--------------------------------------------------------------------------------------------

    function DetalleFinalizado($idMantenimiento,$con){

	$ruta = "http://portal.admongas.com.mx/bitacora-api-app/app/Mantenimiento/ImagenFirma/";
	$NombreRecibe = "";
	$FPR = "";
	$NombreResponsable = "";
	$FPS = "";
    $resultado = "";
	
    	$sql_detalle = "SELECT * FROM po_mantenimiento_verificar_fechafin WHERE id_verificar = '".$idMantenimiento."'";
		$result_detalle = mysqli_query($con, $sql_detalle);
		$numero_detalle = mysqli_num_rows($result_detalle);
		while($row_detalle = mysqli_fetch_array($result_detalle, MYSQLI_ASSOC)){

			$fecha = FormatoFecha($row_detalle['fechafin']);
            $hora = date("g:i a",strtotime($row_detalle['horafin']));

			if ($row_detalle['observaciones'] == "") {
	        $observaciones = "No se encontró alguna observación";
	        }else{
	        $observaciones = $row_detalle['observaciones'];	
	        }

			$resultado .= '<div class="border p-2 mt-2">
			<div class="border-bottom mb-2 font-weight-bold">Fecha y hora de termino:</div>
				'.$fecha.' '.$hora.'
				<div class="border-bottom mb-2 font-weight-bold">Observaciones:</div>
				'.$observaciones.'
				</div>';			
		}

        $sql_imagen1 = "SELECT nombre,imagen_firma FROM po_mantenimiento_verificar_firma WHERE id_verificar = '".$idMantenimiento."'  AND tipo_firma = 'FPR' ";
        $result_imagen1 = mysqli_query($con, $sql_imagen1);
        $numero_imagen1 = mysqli_num_rows($result_imagen1);
        while($row_imagen1 = mysqli_fetch_array($result_imagen1, MYSQLI_ASSOC)){
        $NombreRecibe = $row_imagen1['nombre'];
        $FPR = $row_imagen1['imagen_firma'];
        }

        $sql_imagen2 = "SELECT nombre,imagen_firma FROM po_mantenimiento_verificar_firma WHERE id_verificar = '".$idMantenimiento."'  AND tipo_firma = 'FPS' ";
        $result_imagen2 = mysqli_query($con, $sql_imagen2);
        $numero_imagen2 = mysqli_num_rows($result_imagen2);
        while($row_imagen2 = mysqli_fetch_array($result_imagen2, MYSQLI_ASSOC)){
        $NombreResponsable = $row_imagen2['nombre'];
        $FPS = $row_imagen2['imagen_firma'];
        }

	$resultado .= '<div class="row mt-2">
	<div class="col-6">
		<div class="border p-2">
			<div class="border-bottom mb-2 font-weight-bold">Firma de persona que realiza</div>
			<img width="100%" src="'.$ruta.$FPR.'">
            <div class="border-top text-center"><small>'.$NombreRecibe.'</small></div>
		</div>
	</div>
	<div class="col-6">
		<div class="border p-2">
			<div class="border-bottom mb-2 font-weight-bold">Firma de persona que superviso</div>
			<img width="100%" src="'.$ruta.$FPS.'">
            <div class="border-top text-center"><small>'.$NombreResponsable.'</small></div>
		</div>		
	</div>
</div>';

		return $resultado;

    }

//----------------------------------------------------------------------
$sql_mantenimiento = "SELECT
po_mantenimiento_verificar.id,
po_mantenimiento_verificar.folio,
po_mantenimiento_verificar.id_equipo,
po_mantenimiento_verificar.fechacreacion,
po_mantenimiento_verificar.horacreacion,
po_mantenimiento_verificar.estado,
po_mantenimiento_lista.detalle
FROM po_mantenimiento_verificar 
INNER JOIN po_mantenimiento_lista
ON po_mantenimiento_verificar.id_equipo = po_mantenimiento_lista.id WHERE po_mantenimiento_verificar.id = '".$idMantenimiento."' ";
$result_mantenimiento = mysqli_query($con, $sql_mantenimiento);
$numero_mantenimiento = mysqli_num_rows($result_mantenimiento);
$row_mantenimiento = mysqli_fetch_array($result_mantenimiento, MYSQLI_ASSOC);
$id = $row_mantenimiento['id'];
$idequipo = $row_mantenimiento['id_equipo'];
$fecha = FormatoFecha($row_mantenimiento['fechacreacion']);
$hora = date("g:i a",strtotime($row_mantenimiento['horacreacion']));
$estado = $row_mantenimiento['estado'];
$NombreEquipo = $row_mantenimiento['detalle'];
$folio = $class_control_actividad_proceso->FormatFolio($row_mantenimiento['folio']);

if ($estado == 0) {
$estadoM = "Pendiente";
$txtColor = "text-warning";
$DetalleFinalizado = "";
}else if ($estado == 1){
$estadoM = "Finalizado";
$txtColor = "text-success";
$DetalleFinalizado = DetalleFinalizado($idMantenimiento,$con);
}
?>
  <div class="modal-header">
  <h4 class="modal-title"><?=$NombreEquipo;?></h4>
  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
  <span aria-hidden="true">&times;</span>
  </button>
  </div>
  
  <div class="modal-body">

	<table class="border-bottom" width="100%">
	<tr>
		<td class="text-left p-1"><b>Folio: <?=$folio;?></b></td>
		<td class="font-weight-bold text-right p-1 <?=$txtColor;?>"><?=$estadoM?></td>
	</tr>
	</table>

	<div class="text-right text-secondary border-top pt-2 p-2"><small><?=$fecha;?>, <?=$hora;?></small></div>
	<div><?=DetalleVerificar($idMantenimiento,$idequipo,$con);?></div>
	<div><?=$DetalleFinalizado;?></div>
	
	<hr>
	
  <div class="text-right mb-2">
  <button type="button" class="btn btn-info rounded-0 btn-sm" onclick="Evidencias(<?=$idMantenimiento;?>)">Evidencias</button>
  </div>


  </div>