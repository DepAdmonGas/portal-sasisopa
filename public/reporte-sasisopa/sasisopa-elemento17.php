<?php
require('../../app/help.php');

$FechaInicio = date('Y-m-d', $_GET['FechaInicio']);
$FechaTermino = date('Y-m-d', $_GET['FechaTermino']);

$Explode = explode("-", $FechaTermino);
$fecha_year = $Explode[0];

$sql_resultado = "SELECT * FROM tb_revision_resultados WHERE id_estacion = '".$Session_IDEstacion."' AND fecha_hora BETWEEN '".$FechaInicio."' AND '".$FechaTermino."' ORDER BY fecha_hora desc";
$result_resultado = mysqli_query($con, $sql_resultado);
$numero_resultado = mysqli_num_rows($result_resultado);
//--------------------------------------------------------

function Meta($idEstacion,$idObjeto,$con){

$sql_medicion = "SELECT * FROM tb_medicion_indicadores WHERE id_estacion = '".$idEstacion."' AND objeto = '".$idObjeto."' ORDER BY id DESC LIMIT 1 ";
$result_medicion = mysqli_query($con, $sql_medicion);
$numero_medicion = mysqli_num_rows($result_medicion);
while($row_medicion = mysqli_fetch_array($result_medicion, MYSQLI_ASSOC)){
$meta = $row_medicion['meta'];
}
return $meta;
}

function ResultadoImplementacion($Session_IDEstacion,$Year,$con){
$sql_implementacion = "SELECT * FROM tb_implementacionsa WHERE id_estacion = '".$Session_IDEstacion."' AND YEAR(fecha) = '".$Year."' ";
$result_implementacion = mysqli_query($con, $sql_implementacion);
$numero_implementacion = mysqli_num_rows($result_implementacion);

if ($numero_implementacion > 0) {
while($row_implementacion = mysqli_fetch_array($result_implementacion, MYSQLI_ASSOC)){
$calificacion = $calificacion + $row_implementacion['puntos'];
}
$Resultado = $calificacion / $numero_implementacion;
if($Resultado >= 60  && $Resultado <= 100){
$title = "<b class='text-success'>".$Resultado."% Excelente</b>";                
}else if($Resultado >= 0 && $Resultado <= 59){
$title = "<b class='text-warning'>".$Resultado."% Regular</b>";               
}
}else{
$title = "<b>S/I</b>"; 
}
return $title;
}


function Ventas($Session_IDEstacion,$mes,$year,$con){

$sql_reporte = "SELECT id FROM re_reporte_cre_mes WHERE id_estacion = '".$Session_IDEstacion."' AND mes = '".$mes."' AND year = '".$year."' ";
$result_reporte = mysqli_query($con, $sql_reporte);
$numero_reporte = mysqli_num_rows($result_reporte);
while($row_reporte = mysqli_fetch_array($result_reporte, MYSQLI_ASSOC)){
$idReporte = $row_reporte['id'];
}
$ventas = 0;
$sql_reporte_mes = "SELECT volumen_venta FROM re_reporte_cre_producto WHERE id_re_mes = '".$idReporte."'  ";
$result_reporte_mes = mysqli_query($con, $sql_reporte_mes);
$numero_reporte_mes = mysqli_num_rows($result_reporte_mes);
while($row_reporte_mes = mysqli_fetch_array($result_reporte_mes, MYSQLI_ASSOC)){

$ventas = $ventas + $row_reporte_mes['volumen_venta'];
}

return $ventas;
}
?>
<h4>17. REVISIÓN DE RESULTADOS</h4>

<?php 
function TC($a,$b){
      $Resul = ($a - $b) / $b * 100;
      $TC = 100 + ($Resul);
      $Porcentaje = number_format($TC,2);

      if( $Porcentaje >= 80  ){
      $Return = "<b class='text-success'>".$Porcentaje."% Excelente</b>";                 
      }else if($Porcentaje >= 0 && $Porcentaje <= 79){
      $Return = "<b class='text-warning'>".$Porcentaje."% Regular</b>";
      }

      return $Return;
      }

      $YearAnt = $fecha_year - 1;

      $DicAnt = Ventas($Session_IDEstacion,12,$YearAnt,$con);
      $Ene = Ventas($Session_IDEstacion,1,$fecha_year,$con);
      $Feb = Ventas($Session_IDEstacion,2,$fecha_year,$con);
      $Mar = Ventas($Session_IDEstacion,3,$fecha_year,$con);
      $Abr = Ventas($Session_IDEstacion,4,$fecha_year,$con);
      $May = Ventas($Session_IDEstacion,5,$fecha_year,$con);
      $Jun = Ventas($Session_IDEstacion,6,$fecha_year,$con);
      $Jul = Ventas($Session_IDEstacion,7,$fecha_year,$con);
      $Ago = Ventas($Session_IDEstacion,8,$fecha_year,$con);
      $Sep = Ventas($Session_IDEstacion,9,$fecha_year,$con);
      $Oct = Ventas($Session_IDEstacion,10,$fecha_year,$con);
      $Nov = Ventas($Session_IDEstacion,11,$fecha_year,$con);
      $Dic = Ventas($Session_IDEstacion,12,$fecha_year,$con);

      $TC1 = TC($Ene,$DicAnt);
      $TC2 = TC($Feb,$Ene);
      $TC3 = TC($Mar,$Feb);
      $TC4 = TC($Abr,$Mar);
      $TC5 = TC($May,$Abr);
      $TC6 = TC($Jun,$May);
      $TC7 = TC($Jul,$Jun);
      $TC8 = TC($Ago,$Jul);
      $TC9 = TC($Sep,$Ago);
      $TC10 = TC($Oct,$Sep);
      $TC11 = TC($Nov,$Oct);
      $TC12 = TC($Dic,$Nov);

?>

<table class="table table-bordered table-striped table-sm table-hover mt-2">
<tr>
<td>
      <h6>Resumen de revisión de resultados <?=$fecha_year;?></h6>
</td>
<td width="32"><a onclick="DescargarRRR(<?=$fecha_year;?>)" style="cursor: pointer;"><img src="<?php echo RUTA_IMG_ICONOS."pdf.png"; ?>"></a></td>
</tr>
</table>

<h6>Informe de revisión de resultados</h6>
<table class="table table-bordered table-striped table-sm table-hover mt-2">
	<thead>
		<tr>
			<th class="align-middle text-center">#</th>
			<th class="align-middle text-center">Fecha</th>
			<th class="align-middle text-center">Nombre completo</th>
			<th class="align-middle text-center" width="20px"></th>
		</tr>
	</thead>
	<tbody>
	<?php 
	if ($numero_resultado > 0) {
		while($row_resultado = mysqli_fetch_array($result_resultado, MYSQLI_ASSOC)){
		
		$id = $row_resultado['id'];
		$explode = explode(" ", $row_resultado['fecha_hora']);

		$sql_usuario = "SELECT nombre FROM tb_usuarios WHERE id = '".$row_resultado['id_usuario']."' ";
$result_usuario = mysqli_query($con, $sql_usuario);
while($row_usuario = mysqli_fetch_array($result_usuario, MYSQLI_ASSOC)){
$nomencargado = $row_usuario['nombre'];
}

$imgPDF = "<a target='_blank' href='../../".$row_resultado['archivo']."' ><img src='".RUTA_IMG_ICONOS."pdf-16.png'></a>";

		echo "<tr>";
		echo "<td class='text-center'>".$row_resultado['id']."</td>";
		echo "<td class='text-center'><b>".FormatoFecha($explode[0])."</b></td>";
		echo "<td class='text-center'>".$nomencargado."</td>";
		echo "<td class='text-center align-middle' width='20px'>".$imgPDF."</td>";
		echo "</tr>";
		
		}
	}else{
	echo "<tr><td colspan='6' class='text-center'><small>No se encontró información para mostrar</small></td></tr>";
	}
	?>
	</tbody>
</table>
<hr>