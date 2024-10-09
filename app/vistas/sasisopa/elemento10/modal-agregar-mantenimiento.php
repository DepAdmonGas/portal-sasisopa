<?php
require('../../../../app/help.php');
include_once "../../../../app/modelo/ControlActividadProceso.php";
$class_control_actividad_proceso = new ControlActividadProceso();

$idReporte = $_GET['idReporte'];
$Year = $_GET['Year'];

?>
<div class="pt-1 pb-1 fw-bold">Equipo o instalación: </div>
<select class="form-control rounded-0" id="Selectequipo" onchange="SelectEquipo(this)">
<option value="">Selecciona</option>   
<?php 
$sql_mantenimiento_lista = "SELECT * FROM po_mantenimiento_lista WHERE estado = 0";
$result_mantenimiento_lista = mysqli_query($con, $sql_mantenimiento_lista);
$numero_mantenimiento_lista = mysqli_num_rows($result_mantenimiento_lista);
while($row_mantenimiento_lista = mysqli_fetch_array($result_mantenimiento_lista, MYSQLI_ASSOC)){
$id = $row_mantenimiento_lista['id'];

$result = $class_control_actividad_proceso->Comprobar($idReporte,$id);

if ($result == 0) {
?>
<option value="<?=$id;?>"><?=$id.".- ".$row_mantenimiento_lista['detalle'];?></option>
<?php
}
}
?>
</select>

<div class="pt-1 pb-1 fw-bold">Periodicidad:</div>
<select class="form-control rounded-0" disabled id="Periodicidad">
<option value="">Selecciona</option>
<option value="Semanal">Semanal</option>
<option value="Mensual">Mensual</option>
<option value="Trimestral">Trimestral</option>
<option value="Cuatrimestral">Cuatrimestral</option>
<option value="Semestral">Semestral</option>
<option value="Anual">Anual</option> 
<option value="Bianual">Bianual</option> 
</select>

<div class="pt-1 pb-1 fw-bold">Ultima fecha:</div>
<input type="date" id="UltimaFecha" class="form-control rounded-0" max="<?=$Year;?>-12-31" disabled>