<?php
require('../../../app/help.php');
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

        function NombreUsuario($idUsuario, $con){
        $sql_usuario = "SELECT nombre FROM tb_usuarios WHERE id = '".$idUsuario."' ";
        $result_usuario = mysqli_query($con, $sql_usuario);
        while($row_usuario = mysqli_fetch_array($result_usuario, MYSQLI_ASSOC)){
        $nomencargado = $row_usuario['nombre'];
        }
        return $nomencargado;
        }

        function Firmas($id,$tipoFirma,$con){

        $ruta = "https://portal.admongas.com.mx/bitacora-api-app/app/Recepcion/ImagenFirma/";

        $sql = "SELECT id_usuario,imagen_firma FROM tb_recepcion_descargar_firma WHERE id_recepcion_descarga = '".$id."'  AND tipo_firma = '".$tipoFirma."' ";
        $result = mysqli_query($con, $sql);
        $numero = mysqli_num_rows($result);
        if($numero != 0){
        while($row = mysqli_fetch_array($result, MYSQLI_ASSOC)){
        $Nombre = NombreUsuario($row['id_usuario'], $con);
        
        if($row['imagen_firma'] == ""){
        $Firma = "";
        }else{
        $Firma = "<img width='70px' src='".$ruta.$row['imagen_firma']."' />";   
        }
        
        }

        $array = array('Nombre' => $Nombre, 'Firma' => $Firma);

        }else{
        $array = array('Nombre' => "", 'Firma' => "");
        }
        
        return $array;
        }

if ($numero_recepcion > 0) {
?>

<div class="row">
<div class="col-3">
<h5><?=nombremes($selmes);?> <?=$selyear;?></h5>
</div>
<div class="col-9">
<div class="text-right">


<a class="ml-2" onclick="downloada('public/sasisopa/descargar-reporte-recepcion-descarga-producto.php?selyear=<?=$selyear?>&selmes=<?=$selmes?>')" style="cursor: pointer;" data-toggle="tooltip" data-placement="left" title="Descargar PDF" >
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
        $folio = FormatFolio($row_recepcion['folio']);
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
        $sumacompra = $inventarioinicial + $litroscompra;
        $merma = $inventariofinal - $sumacompra;

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

        

$sql_imagen2 = "SELECT id_usuario,imagen_firma FROM tb_recepcion_descargar_firma WHERE id_recepcion_descarga = '".$id."'  AND tipo_firma = 'FPS' ";
$result_imagen2 = mysqli_query($con, $sql_imagen2);
$numero_imagen2 = mysqli_num_rows($result_imagen2);
while($row_imagen2 = mysqli_fetch_array($result_imagen2, MYSQLI_ASSOC)){
$NPS = NombreUsuario($row_imagen2['id_usuario'], $con);
$FPS = $row_imagen2['imagen_firma'];
}

$FirmaPR = Firmas($id,'FPR',$con);
$NPR = $FirmaPR['Nombre'];
$FPR = $FirmaPR['Firma'];

$FirmaPR = Firmas($id,'FPS',$con);
$NPS = $FirmaPR['Nombre'];
$FPS = $FirmaPR['Firma'];

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
echo "<td class='align-middle text-center'>".$FPR."<div><small>".$NPR."</small></div></td>";
echo "<td class='align-middle text-center'>".$FPS."<div><small>".$NPS."</small></div></td>";
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