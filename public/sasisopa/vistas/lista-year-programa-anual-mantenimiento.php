<?php
require('../../../app/help.php');

$idEstacion = $_GET['idEstacion'];

$year = date("Y");

$sql_programa = "SELECT * FROM po_programa_anual_mantenimiento WHERE id_estacion = '".$idEstacion."' ";
$result_programa = mysqli_query($con, $sql_programa);
$numero_programa = mysqli_num_rows($result_programa);

if ($numero_programa > 0) {
?>
<div class="row">
<?php
while($row_programa = mysqli_fetch_array($result_programa, MYSQLI_ASSOC)){
$idreporte = $row_programa['id'];
$year = $row_programa['year'];
$estado = $row_programa['estado'];
?>

 
<!-- CARD - PROG. ANUAL MTTO (AÑO) -->
<div class="col-xl-3 col-lg-3 col-md-3 col-12 mt-2 mb-2 ">
<div class="card" style="border-radius: 0px;cursor: pointer" onclick="ProgramaNew(<?=$year;?>)">
<div class="card-body">
<div class="text-center" style="font-size: 1.7em;"><?=$year;?></div>
<div class="text-center"><small class="text-primary">Programa anual de mantenimiento</small></div>
</div>
</div>
</div>
 
<?php
}
?>
</div>

<?php
}else{
echo "<div class='text-center'>
<div class='pb-3'><small class='text-secondary'>Da clic en el siguiente botón para crear tu primer programa de mantenimiento del año en curso.</small></div>
<button type='button' class='btn btn-success btn-sm' onclick='ProgramaNew(".$year.")'>Crear nuevo programa de mantenimiento</button>
</div>";
}
?>