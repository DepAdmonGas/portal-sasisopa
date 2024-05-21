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
$selyear = $_POST['selyear'];
$selmes = $_POST['selmes'];

$year = date("Y");
$mes = date("m");

$sql_recepcion = "SELECT * FROM tb_recepcion_descargar WHERE id_estacion = '".$Session_IDEstacion."' 
AND YEAR(fecha) = '".$selyear."' AND MONTH (fecha) = '".$selmes."' ORDER BY fecha DESC, hora_llegada DESC ";

$result_recepcion = mysqli_query($con, $sql_recepcion);
$numero_recepcion = mysqli_num_rows($result_recepcion);

if ($numero_recepcion > 0) {
?>

<div class="row">
<div class="col-3">
<h5><?=nombremes($selmes);?> <?=$selyear;?></h5>
</div>
<div class="col-9">
<div class="text-right">


<a class="ml-2" onclick="downloada('app/vistas/sasisopa/elemento10/descargar-reporte-recepcion-descarga-producto.php?selyear=<?=$selyear?>&selmes=<?=$selmes?>')" style="cursor: pointer;" data-toggle="tooltip" data-placement="left" title="Descargar PDF" >
<img src="<?php echo RUTA_IMG_ICONOS."archivo.png"; ?>">
</a>

<a class="ml-2" onclick="ListaRecepcion()" id="Toltip" style="cursor: pointer;" data-toggle="tooltip" data-placement="left" title="Regresar" >
<img src="<?php echo RUTA_IMG_ICONOS."eliminar.png"; ?>">
</a>
</div>
</div>
</div>

<div class="mt-2" style="overflow-y: hidden;">
<table class="table table-bordered table-sm">
	<thead>
		<tr>
			<th class="align-middle text-center">Folio</th>
			<th class="align-middle text-center">Fecha</th>
			<th class="align-middle text-center" width="100px">Hora llegada</th>
            <th class="align-middle text-center" width="100px">Hora salida</th>
            <th class="align-middle text-center">Vehículo (Placas)</th>
            <th class="align-middle text-center">Operador</th>
			<th class="align-middle text-center">No. Factura</th>
			<th class="align-middle text-center">Litros de compra</th>
			<th class="align-middle text-center">Producto</th>
			<th class="align-middle text-center">Observaciones</th>
			<th class="align-middle text-center">Persona que recibe</th>
			<th class="align-middle text-center">Persona que superviso</th>
		</tr>		
	</thead>
	<tbody>
	<?php
		while($row_recepcion = mysqli_fetch_array($result_recepcion, MYSQLI_ASSOC)){

        $id = $row_recepcion['id'];
        $folio = $class_control_actividad_proceso->FormatFolio($row_recepcion['folio']);
        $explode = explode("-",$row_recepcion['fecha']);
        $fecha = $explode[2]."/".$explode[1]."/".$explode[0];
        $horallegada = date("g:i a",strtotime($row_recepcion['hora_llegada']));
        $horasalida = date("g:i a",strtotime($row_recepcion['hora_salida']));
        $placa = $row_recepcion['placa'];
        $operador = $row_recepcion['operador'];
        $nofactura = $row_recepcion['no_factura'];
        $litroscompra = $row_recepcion['litros_compra'];
        $producto = $row_recepcion['producto'];
        
        $observaciones = $row_recepcion['observaciones'];
        $estado = $row_recepcion['estado'];

        if ($producto == "G PREMIUM") {
            $colorP = "#BB1616";        
        }else if ($producto == "G SUPER") {
            $colorP = "#16BB43";        
        }else if ($producto == "G DIESEL") {
            $colorP = "#212121";        
        }

        if ($estado == 0) {
            $ColorTR = "#FFE8E8";
        }else{
            $ColorTR = "";
        }
      

        $FPR = $class_control_actividad_proceso->recepcionDescargaFirma($id,'FPR','50px');
        $FPS = $class_control_actividad_proceso->recepcionDescargaFirma($id,'FPS','50px');

echo "<tr>";
echo "<td class='align-middle text-center' style='background:$ColorTR;'><b>".$folio."</b></td>";
echo "<td class='align-middle text-center' style='background:$ColorTR;'>".$fecha."</td>";
echo "<td class='align-middle text-center' style='background:$ColorTR;'>".$horallegada."</td>";
echo "<td class='align-middle text-center' style='background:$ColorTR;'>".$horasalida."</td>";
echo "<td class='align-middle text-center' style='background:$ColorTR;'>".$placa."</td>";
echo "<td class='align-middle text-center' style='background:$ColorTR;'>".$operador."</td>";
echo "<td class='align-middle text-center' style='background:$ColorTR;'><b>".$nofactura."</b></td>";
echo "<td class='align-middle text-center' style='background:$ColorTR;'><b>".number_format($litroscompra,2)."</b></td>";
echo "<td class='align-middle text-center' style='background:$ColorTR;color:$colorP;'><b>".$producto."</b></td>";
echo "<td class='align-middle text-center' style='background:$ColorTR;'>".$observaciones."</td>";
echo "<td class='align-middle text-center'>".$FPR['firma']."<div><small>".$FPR['nombre']."</small></div></td>";
echo "<td class='align-middle text-center'>".$FPS['firma']."<div><small>".$FPS['nombre']."</small></div></td>";
echo "</tr>";
}
	?>	
	</tbody>
</table>
</div>
<?php
}else{

echo "<div class='text-center mt-4 mb-4'><small>No se encontró información para mostrar</small></div>";

echo "<div class='text-center mt-4 mb-4'><button type='button' class='btn btn-primary rounded-0 btn-sm' onclick='ListaRecepcion()'>Regresar</button></div>";


}

//------------------
mysqli_close($con);
//------------------
?>