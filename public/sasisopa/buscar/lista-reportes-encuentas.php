<?php
require('../../../app/help.php');

$IdEstacion = $_POST['IdEstacion'];

$sql_encuesta = "SELECT * FROM tb_encuentas_estacion WHERE id_estacion = '".$IdEstacion."' and estado = 1 ORDER BY id asc";
$result_encuesta = mysqli_query($con, $sql_encuesta);
$numero_encuesta = mysqli_num_rows($result_encuesta);

function Encuestados($IdReporte, $con){

$sql_encuesta = "SELECT * FROM tb_encuentas_estacion_cliente WHERE id_cuentas_estacion = '".$IdReporte."'";
$result_encuesta = mysqli_query($con, $sql_encuesta);
$numero_encuesta = mysqli_num_rows($result_encuesta);

return $numero_encuesta;
}

function Total($IdReporte, $con){

$sql_encuesta = "SELECT id FROM tb_encuentas_estacion_cliente WHERE id_cuentas_estacion = '".$IdReporte."' ";
$result_encuesta = mysqli_query($con, $sql_encuesta);
$numero_encuesta = mysqli_num_rows($result_encuesta);
while($row_encuesta = mysqli_fetch_array($result_encuesta, MYSQLI_ASSOC)){

$IdCliente = $row_encuesta['id'];

$sql_encuestaP = "SELECT resultado FROM tb_encuentas_estacion_cliente_preguntas WHERE id_cliente = '".$IdCliente."' ORDER BY resultado desc";
$result_encuestaP = mysqli_query($con, $sql_encuestaP);
$numero_encuestaP = mysqli_num_rows($result_encuestaP);
while($row_encuestaP = mysqli_fetch_array($result_encuestaP, MYSQLI_ASSOC)){

if($row_encuestaP['resultado'] == 4){
$resultado4 = $resultado4 + 1;
}else if($row_encuestaP['resultado'] == 3){
$resultado3 = $resultado3 + 1;
}else if($row_encuestaP['resultado'] == 2){
$resultado2 = $resultado2 + 1;
}else if($row_encuestaP['resultado'] == 1){
$resultado1 = $resultado1 + 1;
}

} 
}

$ResultArray = array(
"resultado1" => $resultado1,
"resultado2" => $resultado2,
"resultado3" => $resultado3,
"resultado4" => $resultado4,
);

return $ResultArray;

}
?>

<div class="mb-2" style="overflow-y: hidden;">
<table class="table table-bordered table-striped table-sm" style="font-size: .95em">
<thead>	
<tr>
<th colspan="3"></th>	
<th class="text-center align-middle" colspan="2" style="color: #0099F0">Excelente</th>
<th class="text-center align-middle" colspan="2" style="color: #1EAD4E">Bueno</th>
<th class="text-center align-middle" colspan="2" style="color: #F3C000">Regular</th>
<th class="text-center align-middle" colspan="2" style="color: #E70606">Malo</th>
<th class="text-center align-middle"></th>
<th class="text-center align-middle"></th>
</tr>
<tr>
<th class="text-center align-middle">#</th>
<th class="align-middle">Fecha</th>
<th class="align-middle">Encuestados</th>
<th class="text-center align-middle">Resultado</th>
<th class="text-center align-middle">%</th>
<th class="text-center align-middle">Resultado</th>
<th class="text-center align-middle">%</th>
<th class="text-center align-middle">Resultado</th>
<th class="text-center align-middle">%</th>
<th class="text-center align-middle">Resultado</th>
<th class="text-center align-middle">%</th>
<th class="text-center align-middle"><img src='<?=RUTA_IMG_ICONOS;?>edit-black-16.png'></th>
<th class="text-center align-middle"><img src='<?=RUTA_IMG_ICONOS;?>eliminar-red-16.png'></th>
</tr>	
</thead>
<tbody>
<?php
if ($numero_encuesta > 0) {
	$num = 1;
while($row_encuesta = mysqli_fetch_array($result_encuesta, MYSQLI_ASSOC)){

	$IdReporte = $row_encuesta['id'];
	$date = $row_encuesta['fechacreacion'];
	$explode = explode(" ", $date);
	$fecha = $explode[0];
	$hora = $explode[1];

$Encuestados = Encuestados($IdReporte, $con);
$Total = Total($IdReporte,$con);

$totalResultado = $Total['resultado4'] + $Total['resultado3'] + $Total['resultado2'] + $Total['resultado1'];

$porcentaje4 = ($Total['resultado4'] / $totalResultado) * 100;
$porcentaje3 = ($Total['resultado3'] / $totalResultado) * 100;
$porcentaje2 = ($Total['resultado2'] / $totalResultado) * 100;
$porcentaje1 = ($Total['resultado1'] / $totalResultado) * 100;

echo '<tr>';
echo '<td class="text-center align-middle" onclick="BtnReporte('.$IdReporte.')">'.$num.'</td>';
echo '<td class="align-middle" onclick="BtnReporte('.$IdReporte.')">'.FormatoFecha($fecha).'</td>';
echo '<td class="align-middle" onclick="BtnReporte('.$IdReporte.')"><b>'.$Encuestados.'</b> <small>Encuestados</small></td>';
echo '<td class="text-center align-middle" style="color: #0099F0" onclick="BtnReporte('.$IdReporte.')"><b>'.$Total['resultado4'].'</b></td>';
echo '<td class="text-center align-middle" style="color: #0099F0" onclick="BtnReporte('.$IdReporte.')">'.round($porcentaje4,2).' %</td>';
echo '<td class="text-center align-middle" style="color: #1EAD4E" onclick="BtnReporte('.$IdReporte.')"><b>'.$Total['resultado3'].'</b></td>';
echo '<td class="text-center align-middle" style="color: #1EAD4E" onclick="BtnReporte('.$IdReporte.')">'.round($porcentaje3,2).' %</td>';
echo '<td class="text-center align-middle" style="color: #F3C000" onclick="BtnReporte('.$IdReporte.')"><b>'.$Total['resultado2'].'</b></td>';
echo '<td class="text-center align-middle" style="color: #F3C000" onclick="BtnReporte('.$IdReporte.')">'.round($porcentaje2,2).' %</td>';
echo '<td class="text-center align-middle" style="color: #E70606" onclick="BtnReporte('.$IdReporte.')"><b>'.$Total['resultado1'].'</b></td>';
echo '<td class="text-center align-middle" style="color: #E70606" onclick="BtnReporte('.$IdReporte.')">'.round($porcentaje1,2).' %</td>';
echo '<td class="text-center align-middle" onclick="BtnEditar('.$IdReporte.')"><img src="'.RUTA_IMG_ICONOS.'edit-black-16.png"></td>';
echo '<td class="text-center align-middle" onclick="Eliminar('.$IdReporte.')"><img src="'.RUTA_IMG_ICONOS.'eliminar-red-16.png"></td>';
echo '</tr>';

$num++;
}
}else{
echo '<tr><td colspan="13" class="text-center text-secondary">No se encontraro información</td></tr>';
}
?>
</tbody>
</table>
</div>
