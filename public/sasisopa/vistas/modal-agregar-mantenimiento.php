<?php
require('../../../app/help.php');

$idReporte = $_GET['idReporte'];
$Year = $_GET['Year'];

function Comprobar($idReporte,$id,$con){
$sql_mantenimiento = "SELECT * FROM po_programa_anual_mantenimiento_detalle WHERE id_programa_fecha = '".$idReporte."' AND id_mantenimiento = '".$id."' ";
$result_mantenimiento = mysqli_query($con, $sql_mantenimiento);
$numero_mantenimiento = mysqli_num_rows($result_mantenimiento);	

if ($numero_mantenimiento > 0) {
$result = 1;
}else{
$result = 0;
}

return $result;

}
?>
<div class="pt-1 pb-1 text-secondary">Equipo o instalación: </div>
<select class="form-control rounded-0" id="Selectequipo" onchange="SelectEquipo(this)">
<option value="">Selecciona</option>   
<?php 
$sql_mantenimiento_lista = "SELECT * FROM po_mantenimiento_lista WHERE estado = 0";
$result_mantenimiento_lista = mysqli_query($con, $sql_mantenimiento_lista);
$numero_mantenimiento_lista = mysqli_num_rows($result_mantenimiento_lista);
while($row_mantenimiento_lista = mysqli_fetch_array($result_mantenimiento_lista, MYSQLI_ASSOC)){
$id = $row_mantenimiento_lista['id'];

$result = Comprobar($idReporte,$id,$con);

if ($result == 0) {
?>
<option value="<?=$id;?>"><?=$id.".- ".$row_mantenimiento_lista['detalle'];?></option>
<?php
}else{}

}
?>
</select>

<div class="pt-1 pb-1 text-secondary">Periodicidad:</div>
<select class="form-control rounded-0" disabled id="Periodicidad">
<option value="">Selecciona</option>
<option value="Mensual">Mensual</option>
<option value="Trimestral">Trimestral</option>
<option value="Cuatrimestral">Cuatrimestral</option>
<option value="Semestral">Semestral</option>
<option value="Anual">Anual</option> 
<option value="Bianual">Bianual</option> 
</select>

<div class="pt-1 pb-1 text-secondary">Ultima fecha:</div>
<input type="date" id="UltimaFecha" class="form-control rounded-0" max="<?=$Year;?>-12-31" disabled>