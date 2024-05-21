<?php
require('../../../../app/help.php');
include_once "../../../../app/modelo/ControlActividadProceso.php";
$class_control_actividad_proceso = new ControlActividadProceso();

        $idRecepcion = $_GET['idRecepcion'];        
        $sql_recepcion = "SELECT * FROM tb_recepcion_descargar WHERE id = '".$idRecepcion."' ";
        $result_recepcion = mysqli_query($con, $sql_recepcion);
        $numero_recepcion = mysqli_num_rows($result_recepcion);
       
        $row_recepcion = mysqli_fetch_array($result_recepcion, MYSQLI_ASSOC);
        $id = $row_recepcion['id'];
        $folio = $class_control_actividad_proceso->FormatFolio($row_recepcion['folio']);
        $fecha = FormatoFecha($row_recepcion['fecha']);
        $horallegada = date("g:i a",strtotime($row_recepcion['hora_llegada']));
        $horasalida = date("g:i a",strtotime($row_recepcion['hora_salida']));
        $tiempodescarga = $row_recepcion['tiempo_descarga'];
        $lineaTransporte = $row_recepcion['linea_transporte'];
        $noRemolque = $row_recepcion['no_remolque'];
        $Placa = $row_recepcion['placa'];
        $Operador = $row_recepcion['operador'];
        $nofactura = $row_recepcion['no_factura'];
        $litroscompra = $row_recepcion['litros_compra'];
        $producto = $row_recepcion['producto'];
        $sellonoserie = $row_recepcion['sello_noserie'];
        $manometro = $row_recepcion['manometro'];
        $temperatura = $row_recepcion['temperatura'];
        $observaciones = $row_recepcion['observaciones'];
        $estado = $row_recepcion['estado'];

        if ($estado == 1) {
        $txtEstado = "Activo";
        $txtColor = "text-secondary";
        $estadoColor = "";
        }else if ($estado == 0) {
        $txtEstado = "Cancelado";
        $txtColor = "text-danger";
        $estadoColor = "bg-light";
        }

        if ($producto == "G SUPER") {
        	$productoColor = "text-success";
        }else if ($producto == "G PREMIUM") {
        	$productoColor = "text-danger";
        }else if ($producto == "DIESEL") {
        	$productoColor = "text-dark";
        }

        if ($row_recepcion['observaciones'] == "") {
        $observaciones = "No se encontró alguna observación";
        }else{
        $observaciones = $row_recepcion['observaciones'];
        }

$FPR = $class_control_actividad_proceso->recepcionDescargaFirma($idRecepcion,'FPR','150px');
$FPS = $class_control_actividad_proceso->recepcionDescargaFirma($idRecepcion,'FPS','150px');
$Sello1 = $class_control_actividad_proceso->recepcionDescargaSellos($idRecepcion,'Se encuentran en buen estado');
$Sello2 = $class_control_actividad_proceso->recepcionDescargaSellos($idRecepcion,'Sin rastro de sustancias aceitosas');
$Sello3 = $class_control_actividad_proceso->recepcionDescargaSellos($idRecepcion,'Nivel del producto está a más de 1.5 cm (+/-0.3 cm)');
?>
<table class="border-bottom" width="100%">
	<tr>
		<td class="font-weight-bold <?=$txtColor;?>"><?=$txtEstado;?></td>
		<td class="text-right"><b>Folio: <?=$folio;?></b></td>
	</tr>
</table>
<table class="mt-1" width="100%">
	<tr>
		<td class="">Factura: <b><?=$nofactura;?></b></td>
		<td class="text-right">Producto: <b class="<?=$productoColor;?>"><?=$producto;?></b></td>
	</tr>
	<tr>
		<td>Litros compra:</td>
		<td class="text-right"><b><?=number_format($litroscompra,2);?></b></td>
	</tr>
</table>

<div class="border-bottom mt-2 mb-2"></div>

<table class="mt-1" width="100%">

<tr>
        <td class="">Tiempo descarga:</b></td>
        <td class="text-right"><?=$tiempodescarga;?></td>
    </tr>
    <tr>
        <td class="">Linea Transporte:</b></td>
        <td class="text-right"><?=$lineaTransporte;?></td>
    </tr>
    <tr>
        <td>No. de Remolque:</td>
        <td class="text-right"><?=$noRemolque;?></td>
    </tr>
    <tr>
        <td>Vehículo (Placa):</td>
        <td class="text-right"><?=$Placa;?></td>
    </tr>
    <tr>
        <td>Operador:</td>
        <td class="text-right"><?=$Operador;?></td>
    </tr>
</table>

<div class="border-bottom mt-2 mb-2"></div>
<div class="text-right text-secondary"><small><?=$fecha;?>, <?=$horallegada." a ".$horasalida;?></small></div>
<div class="border-bottom mt-2 mb-2"></div>

<div class="border p-2 mt-2">
<table class="mt-1" width="100%">
    <tr>
        <td class="font-weight-bold">No. Tanque:</td>
        <td class="font-weight-bold">Inventario Inicial</td>
        <td class="font-weight-bold">Inventario Final</td>
        <td class="font-weight-bold">Aditivacón</td>
    </tr>

    <?php 

    $TotalII = 0;
    $TotalIF = 0;
    
    $sql_tanque = "SELECT 
    tb_recepcion_descargar_tanque.id,
    tb_recepcion_descargar_tanque.idlista,
    tb_recepcion_descargar_tanque.inventario_inicial,
    tb_recepcion_descargar_tanque.inventario_final,
    tb_recepcion_descargar_tanque.aditivacion,
    tb_tanque_almacenamiento.no_tanque
    FROM tb_recepcion_descargar_tanque
    INNER JOIN tb_tanque_almacenamiento 
    ON tb_recepcion_descargar_tanque.id_tanque = tb_tanque_almacenamiento.id
    WHERE tb_recepcion_descargar_tanque.id_recepcion_descarga = '".$idRecepcion."' ORDER BY tb_recepcion_descargar_tanque.idlista DESC ";
    $result_tanque = mysqli_query($con, $sql_tanque);
    $numero_tanque = mysqli_num_rows($result_tanque);
    while($row_tanque = mysqli_fetch_array($result_tanque, MYSQLI_ASSOC)){

    echo '<tr>
    <td>'.$row_tanque['no_tanque'].'</td>
    <td>'.number_format($row_tanque['inventario_inicial'],2).'</td>
    <td>'.number_format($row_tanque['inventario_final'],2).'</td>
    <td>'.$row_tanque['aditivacion'].'</td>
    </tr>';
    
    $TotalII = $TotalII + $row_tanque['inventario_inicial'];
    $TotalIF = $TotalIF + $row_tanque['inventario_final'];
    }

    $sumacompra = $TotalII + $litroscompra;
    $Merma = $TotalIF - $sumacompra;
    
    ?>
    <tr>
    <td colspan="4" style="padding: 5px;text-align: right;">Merma: <b><?=number_format($Merma,2);?></b></td>
    </tr>
    </table>
    </div>

<div class="border p-2 mt-2">
<table class="mt-1" width="100%">
    <tr>
        <td class="font-weight-bold bg-light" colspan="2">Sellos</td>
    </tr>

    <tr>
        <td><?=$Sello1['verificar'];?></td>
        <td class="font-weight-bold"><?=$Sello1['resultado'];?></td>
    </tr>

    <tr>
        <td><?=$Sello2['verificar'];?></td>
        <td class="font-weight-bold"><?=$Sello2['resultado'];?></td>
    </tr>

    <tr>
        <td>No. Serie</td>
        <td class="font-weight-bold"><?=$sellonoserie;?></td>
    </tr>

    <tr>
        <td class="font-weight-bold bg-light" colspan="2">NICE</b></td>
    </tr>

    <tr>
        <td><?=$Sello3['verificar'];?></td>
        <td class="font-weight-bold"><?=$Sello3['resultado'];?></td>
    </tr>

    <tr>
        <td>Manómetro:</td>
        <td ><b><?=$manometro;?></b></td>
    </tr>
    <tr>
        <td>Temperatura:</td>
        <td><b><?=$temperatura;?></b></td>
    </tr>



</table>
</div>

<div class="border p-2 mt-2">
<div class="border-bottom mb-2 font-weight-bold">Observaciones:</div>
<?=$observaciones;?>
</div>

<div class="row mt-2">
	<div class="col-6">
		<div class="border p-2">
			<div class="border-bottom mb-2 font-weight-bold">Firma de persona que recibe:</div>
			<div class="text-center"><?=$FPR['firma'];?></div>
            <div class="text-center"><small><?=$FPR['nombre'];?></small></div>
		</div>

	</div>
	<div class="col-6">
		<div class="border p-2">
			<div class="border-bottom mb-2 font-weight-bold">Firma de persona que superviso</div>
			<div class="text-center"><?=$FPS['firma'];?></div>
            <div class="text-center"><small><?=$FPS['nombre'];?></small></div>
		</div>
	</div>
</div>
