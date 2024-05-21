<?php
require('../../../../app/help.php');
include_once "../../../../app/modelo/ControlActividadProceso.php";
$class_control_actividad_proceso = new ControlActividadProceso();
?>
<script type="text/javascript">
$(document).ready(function(){
  $('[data-toggle="tooltip"]').tooltip();
  });
</script>
<?php
$year = date("Y");
$mes = date("m");

$sql_recepcion = "SELECT * FROM tb_recepcion_descargar WHERE id_estacion = '".$Session_IDEstacion."' 
AND YEAR(fecha) = '".$year."' AND MONTH (fecha) = '".$mes."' ORDER BY fecha DESC, hora_llegada DESC ";
$result_recepcion = mysqli_query($con, $sql_recepcion);
$numero_recepcion = mysqli_num_rows($result_recepcion);


if ($numero_recepcion > 0) {
?>
<div class="mb-2 text-right pb-2">

<a class="ml-2" onclick="downloada('app/vistas/sasisopa/elemento10/descargar-reporte-recepcion-descarga-producto.php?selyear=<?=$year?>&selmes=<?=$mes?>')" style="cursor: pointer;" data-toggle="tooltip" data-placement="left" title="Descargar PDF" >
<img src="<?php echo RUTA_IMG_ICONOS."archivo.png"; ?>">
</a>

</div>
<?php
echo "<div class='row'>";
while($row_recepcion = mysqli_fetch_array($result_recepcion, MYSQLI_ASSOC)){

        $id = $row_recepcion['id'];
        $folio = $class_control_actividad_proceso->FormatFolio($row_recepcion['folio']);
        $fecha = FormatoFecha($row_recepcion['fecha']);
        $horallegada = date("g:i a",strtotime($row_recepcion['hora_llegada']));
        $horasalida = date("g:i a",strtotime($row_recepcion['hora_salida']));
        $nofactura = $row_recepcion['no_factura'];
        $litroscompra = $row_recepcion['litros_compra'];
        $producto = $row_recepcion['producto'];
        
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

echo "<div class='col-3 mb-2'>";
echo "<div class='border p-2 $estadoColor c-pointer' onclick='DetalleRecepcion($id)'>";
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

<div class="border-bottom mt-1 mb-1"></div>

<div class="text-right text-secondary"><small><?=$fecha;?>, <?=$horallegada." a ".$horasalida;?></small></div>

<?php
echo "</div>";
echo "</div>";

}
echo "</div>";

}else{

echo "<div class='text-center mt-4 mb-4'><small>No se encontró información para mostrar</small></div>";

}

//------------------
mysqli_close($con);
//------------------

?>

