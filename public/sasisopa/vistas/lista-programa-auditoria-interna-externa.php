<?php
require('../../../app/help.php');

 $FechaInicio = $_GET['FechaInicio'];
 $FechaTermino = $_GET['FechaTermino'];

 $Explode1 = explode("-", $FechaInicio);
 $Explode2 = explode("-", $FechaTermino);

$sql = "SELECT * FROM tb_programa_auditorias WHERE id_estacion = '".$Session_IDEstacion."' AND YEAR(fecha) >= '".$Explode1[0]."' AND YEAR(fecha) <= '".$Explode2[0]."' ORDER BY fecha ASC ";
$result = mysqli_query($con, $sql);
$numero = mysqli_num_rows($result);

?>

<div class="text-right mb-2">
<img src="<?php echo RUTA_IMG_ICONOS."lupa.png"; ?>" onclick="btnModal()">
<img src="<?php echo RUTA_IMG_ICONOS."pdf.png"; ?>" onclick="btnDescargar(<?=$Explode1[0];?>,<?=$Explode2[0];?>)">
</div>

<table class="table table-bordered table-sm" style="">
<thead>
<tr>
<th class="text-center align-middle">Tipo de auditoria</th>
<th class="text-center align-middle">Responsable</th>
<th class="text-center align-middle">Periodicidad</th>

<?php
for ($i = $Explode1[0]; $i <= $Explode2[0]; $i++) {
echo '<td class="text-center align-middle"><b>'.$i.'</b></td>';
$TR = $TR + 1;
}

?>

</tr>
</thead>
<tbody>
<?php  

while($row = mysqli_fetch_array($result, MYSQLI_ASSOC)){
echo "<tr>";
echo '<td>'.$row['tipo_auditoria'].'</td>';
echo '<td>'.$row['responsable'].'</td>';
echo '<td>'.$row['periodicidad'].'</td>';

$ExplodeF = explode("-", $row['fecha']);
for ($mes = $Explode1[0]; $mes <= $Explode2[0]; $mes++) {

if($row['tipo_auditoria'] == 'Interna'){

if($ExplodeF[0] == $mes){
$Color = 'table-primary';
$Titulo = nombremes($ExplodeF[1]);
}else{
$Color = ''; 
$Titulo = '';
}

}else if($row['tipo_auditoria'] == 'Externa'){

if($ExplodeF[0] == $mes){
$Color = 'table-success';
$Titulo = nombremes($ExplodeF[1]);
}else{
$Color = ''; 
$Titulo = '';
}

}

echo '<td class="text-center align-middle '.$Color.'">'.$Titulo.'</td>';

}

echo "</tr>";  
}

?>
</tbody>
</table>
