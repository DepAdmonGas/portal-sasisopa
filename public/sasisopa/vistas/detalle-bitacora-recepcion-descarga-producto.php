<?php
require('../../../app/help.php');

$idRecepcion = $_GET['idRecepcion'];
$ruta = "http://portal.admongas.com.mx/api-bitacora-fulles/app/Recepcion/ImagenFirma/";


$sql_recepcion = "SELECT * FROM bi_recepcion_descargar WHERE id = '".$idRecepcion."' ";
$result_recepcion = mysqli_query($con, $sql_recepcion);
$numero_recepcion = mysqli_num_rows($result_recepcion);

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

function DetalleTanque($idtanque, $con){
$sql_tanque = "SELECT * FROM tb_tanque_almacenamiento WHERE id = '".$idtanque."' ";
$result_tanque = mysqli_query($con, $sql_tanque);
$numero_tanque = mysqli_num_rows($result_tanque);
while($row_tanque = mysqli_fetch_array($result_tanque, MYSQLI_ASSOC)){

$tanque = $row_tanque['no_tanque'];
}

return $tanque;
}

       function NombreUsuario($idUsuario, $con){

        $sql_usuario = "SELECT nombre FROM tb_usuarios WHERE id = '".$idUsuario."' ";
        $result_usuario = mysqli_query($con, $sql_usuario);
        while($row_usuario = mysqli_fetch_array($result_usuario, MYSQLI_ASSOC)){
        $nomencargado = $row_usuario['nombre'];
        }

        return $nomencargado;

       }

while($row_recepcion = mysqli_fetch_array($result_recepcion, MYSQLI_ASSOC)){

        $id = $row_recepcion['id'];
        $folio = FormatFolio($row_recepcion['folio']);
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

        }

$sql_tanque1 = "SELECT * FROM bi_recepcion_descargar_tanque WHERE id_recepcion_descarga = '".$idRecepcion."' AND idlista = '1' ";
$result_tanque1 = mysqli_query($con, $sql_tanque1);
$numero_tanque1 = mysqli_num_rows($result_tanque1);
while($row_tanque1 = mysqli_fetch_array($result_tanque1, MYSQLI_ASSOC)){

$idtanque1 = DetalleTanque($row_tanque1['id_tanque'], $con);
$inventarioinicial1 = number_format($row_tanque1['inventario_inicial'],2);
$inventariofinal1 = number_format($row_tanque1['inventario_final'],2);
$aditivacion1 = $row_tanque1['aditivacion'];
}

$sql_tanque2 = "SELECT * FROM bi_recepcion_descargar_tanque WHERE id_recepcion_descarga = '".$idRecepcion."' AND idlista = '2' ";
$result_tanque2 = mysqli_query($con, $sql_tanque2);
$numero_tanque2 = mysqli_num_rows($result_tanque2);
while($row_tanque2 = mysqli_fetch_array($result_tanque2, MYSQLI_ASSOC)){

$idtanque2 = DetalleTanque($row_tanque2['id_tanque'], $con);
$inventarioinicial2 = number_format($row_tanque2['inventario_inicial'],2);
$inventariofinal2 = number_format($row_tanque2['inventario_final'],2);
$aditivacion2 = $row_tanque2['aditivacion'];
}

$sql_tanque3 = "SELECT * FROM bi_recepcion_descargar_tanque WHERE id_recepcion_descarga = '".$idRecepcion."' AND idlista = '3' ";
$result_tanque3 = mysqli_query($con, $sql_tanque3);
$numero_tanque3 = mysqli_num_rows($result_tanque3);
while($row_tanque3 = mysqli_fetch_array($result_tanque3, MYSQLI_ASSOC)){

$idtanque3 = DetalleTanque($row_tanque3['id_tanque'], $con);
$inventarioinicial3 = number_format($row_tanque3['inventario_inicial'],2);
$inventariofinal3 = number_format($row_tanque3['inventario_final'],2);
$aditivacion3 = $row_tanque3['aditivacion'];
}

$sql_tanque4 = "SELECT * FROM bi_recepcion_descargar_tanque WHERE id_recepcion_descarga = '".$idRecepcion."' AND idlista = '4' ";
$result_tanque4 = mysqli_query($con, $sql_tanque4);
$numero_tanque4 = mysqli_num_rows($result_tanque4);
while($row_tanque4 = mysqli_fetch_array($result_tanque4, MYSQLI_ASSOC)){

$idtanque4 = DetalleTanque($row_tanque4['id_tanque'], $con);
$inventarioinicial4 = number_format($row_tanque4['inventario_inicial'],2);
$inventariofinal4 = number_format($row_tanque4['inventario_final'],2);
$aditivacion4 = $row_tanque4['aditivacion'];
}

$sql_imagen1 = "SELECT id_usuario,imagen_firma FROM bi_recepcion_descargar_firma WHERE id_recepcion_descarga = '".$idRecepcion."'  AND tipo_firma = 'FPR' ";
$result_imagen1 = mysqli_query($con, $sql_imagen1);
$numero_imagen1 = mysqli_num_rows($result_imagen1);
while($row_imagen1 = mysqli_fetch_array($result_imagen1, MYSQLI_ASSOC)){

$NombreRecibe = NombreUsuario($row_imagen1['id_usuario'], $con);
$FPR = $row_imagen1['imagen_firma'];
}

$sql_imagen2 = "SELECT id_usuario,imagen_firma FROM bi_recepcion_descargar_firma WHERE id_recepcion_descarga = '".$idRecepcion."'  AND tipo_firma = 'FPS' ";
$result_imagen2 = mysqli_query($con, $sql_imagen2);
$numero_imagen2 = mysqli_num_rows($result_imagen2);
while($row_imagen2 = mysqli_fetch_array($result_imagen2, MYSQLI_ASSOC)){

$NombreResponsable = NombreUsuario($row_imagen2['id_usuario'], $con);
$FPS = $row_imagen2['imagen_firma'];
}

$sql_merma = "SELECT * FROM bi_recepcion_descargar_tanque WHERE id_recepcion_descarga = '".$idRecepcion."' ";
$result_merma = mysqli_query($con, $sql_merma);
$numero_merma = mysqli_num_rows($result_merma);
while($row_merma = mysqli_fetch_array($result_merma, MYSQLI_ASSOC)){
$TotalII = $TotalII + $row_merma['inventario_inicial'];
$TotalIF = $TotalIF + $row_merma['inventario_final'];
}

$sumacompra = $TotalII + $litroscompra;
$Merma = $TotalIF - $sumacompra;

//------------------------------------------------------------------------
$sql_verificar1 = "SELECT verificar, resultado FROM bi_recepcion_descargar_sellos WHERE id_recepcion_descarga = '".$idRecepcion."'  AND verificar = 'Se encuentran en buen estado' ";
$result_verificar1 = mysqli_query($con, $sql_verificar1);
$numero_verificar1 = mysqli_num_rows($result_verificar1);
while($row_verificar1 = mysqli_fetch_array($result_verificar1, MYSQLI_ASSOC)){

$verificar1 = $row_verificar1['verificar'];
$resultado1 = $row_verificar1['resultado'];
}

$sql_verificar2 = "SELECT verificar, resultado FROM bi_recepcion_descargar_sellos WHERE id_recepcion_descarga = '".$idRecepcion."'  AND verificar = 'Sin rastro de sustancias aceitosas' ";
$result_verificar2 = mysqli_query($con, $sql_verificar2);
$numero_verificar2 = mysqli_num_rows($result_verificar2);
while($row_verificar2 = mysqli_fetch_array($result_verificar2, MYSQLI_ASSOC)){

$verificar2 = $row_verificar2['verificar'];
$resultado2 = $row_verificar2['resultado'];
}

$sql_verificar3 = "SELECT verificar, resultado FROM bi_recepcion_descargar_sellos WHERE id_recepcion_descarga = '".$idRecepcion."'  AND verificar = 'Nivel del producto está a más de 1.5 cm (+/-0.3 cm)' ";
$result_verificar3 = mysqli_query($con, $sql_verificar3);
$numero_verificar3 = mysqli_num_rows($result_verificar3);
while($row_verificar3 = mysqli_fetch_array($result_verificar3, MYSQLI_ASSOC)){

$verificar3 = $row_verificar3['verificar'];
$resultado3 = $row_verificar3['resultado'];
}
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
<?php 
if ($idtanque1 == "" && $inventarioinicial1 == "" && $inventariofinal1 == "") {

}else{
?>
<div class="border p-2 mt-2">
<table class="mt-1" width="100%">
    <tr>
        <td class="font-weight-bold">No. Tanque:</td>
        <td class="font-weight-bold">Inventario Inicial</td>
        <td class="font-weight-bold">Inventario Final</td>
        <td class="font-weight-bold">Aditivacón</td>
    </tr>
    <tr>
        <td><?=$idtanque1;?></td>
        <td><?=$inventarioinicial1;?></td>
        <td><?=$inventariofinal1;?></td>
        <td><?=$aditivacion1;?></td>
    </tr>
<?php if ($idtanque2 != "" && $inventarioinicial2 != "" && $inventariofinal2 != "") { ?>
    <tr>
        <td><?=$idtanque2;?></td>
        <td><?=$inventarioinicial2;?></td>
        <td><?=$inventariofinal2;?></td>
        <td><?=$aditivacion2;?></td>
    </tr>
<?php  } ?>

<?php if ($idtanque3 != "" && $inventarioinicial3 != "" && $inventariofinal3 != "") { ?>
    <tr>
        <td><?=$idtanque3;?></td>
        <td><?=$inventarioinicial3;?></td>
        <td><?=$inventariofinal3;?></td>
        <td><?=$aditivacion3;?></td>
    </tr>
<?php  } ?>

<?php if ($idtanque4 != "" && $inventarioinicial4 != "" && $inventariofinal4 != "") { ?>
    <tr>
        <td><?=$idtanque4;?></td>
        <td><?=$inventarioinicial4;?></td>
        <td><?=$inventariofinal4;?></td>
        <td><?=$aditivacion4;?></td>
    </tr>
<?php  } ?>

 <tr>
        <td colspan="4" style="padding: 5px;text-align: right;">Merma: <b><?=number_format($Merma,2);?></b></td>
    </tr>


</table>
</div>
<?php
}
?>

<div class="border p-2 mt-2">
<table class="mt-1" width="100%">
    <tr>
        <td class="font-weight-bold bg-light" colspan="2">Sellos</td>
    </tr>

    <tr>
        <td><?=$verificar1;?></td>
        <td class="font-weight-bold"><?=$resultado1;?></td>
    </tr>

    <tr>
        <td><?=$verificar2;?></td>
        <td class="font-weight-bold"><?=$resultado2;?></td>
    </tr>

    <tr>
        <td>No. Serie</td>
        <td class="font-weight-bold"><?=$sellonoserie;?></td>
    </tr>

    <tr>
        <td class="font-weight-bold bg-light" colspan="2">NICE</b></td>
    </tr>

    <tr>
        <td><?=$verificar3;?></td>
        <td class="font-weight-bold"><?=$resultado3;?></td>
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
			<img width="100%" src="<?=$ruta.$FPR;?>">
            <div class="border-top text-center"><small><?=$NombreRecibe;?></small></div>
		</div>
	</div>
	<div class="col-6">
		<div class="border p-2">
			<div class="border-bottom mb-2 font-weight-bold">Firma de persona que superviso</div>
			<img width="100%" src="<?=$ruta.$FPS;?>">
            <div class="border-top text-center"><small><?=$NombreResponsable;?></small></div>
		</div>
	</div>
</div>
