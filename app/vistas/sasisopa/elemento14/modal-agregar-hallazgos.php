<?php
require('../../../../app/help.php');
include_once "../../../../app/modelo/MonitoreoVerificacionEvaluacion.php";
$class_monitoreo_evaluacion = new MonitoreoVerificacionEvaluacion();

$idAtencion = $_GET['id'];
$idHallazgo = $_GET['idHallazgo'];

if($idHallazgo == 0){

$idSasisopa = "";
$Sasisopa = "";
$hallazgos = "";
$accion = "";
$fecha = "";

}else{

$sqlAH = "SELECT * FROM tb_atencion_hallazgos_detalle WHERE id = '".$idHallazgo."' ";
$resultAH = mysqli_query($con, $sqlAH);
$numeroAH = mysqli_num_rows($resultAH);
$rowAH = mysqli_fetch_array($resultAH, MYSQLI_ASSOC);
$idSasisopa = $rowAH['id_sasisopa'];
$Sasisopa = $class_monitoreo_evaluacion->sasisopa($rowAH['id_sasisopa']);
$hallazgos = $rowAH['hallazgos'];
$accion = $rowAH['accion'];
$fecha = $rowAH['fecha_implementacion'];

}

$sql = "SELECT * FROM sa_sasisopa";
$result = mysqli_query($con, $sql);
$numero = mysqli_num_rows($result);

?>
<div class="modal-header">
<h4 class="modal-title">Agregar Hallazgos</h4>
<button type="button" class="close" data-dismiss="modal" aria-label="Close">
<span aria-hidden="true">&times;</span>
</button>
</div>
<div class="modal-body">

<h6>SASISOPA:</h6>
<select class="form-control rounded-0" id="IdSasisopa">
<option value="<?=$idSasisopa;?>"><?=$Sasisopa;?></option>
<?php
while($row = mysqli_fetch_array($result, MYSQLI_ASSOC)){
$Validar = $class_monitoreo_evaluacion->validarHallazgo($idAtencion,$row['id']);

if($Validar == 0){
echo '<option value="'.$row['id'].'">'.$row['nombre'].'</option>';
}

}
?>
</select>
<div id="idResultado" class="text-center text-danger"></div>

<h6>Hallazgos:</h6>
<textarea class="form-control rounded-0" id="Hallazgos"><?=$hallazgos;?></textarea>

<h6>Acción preventiva por hallazgo:</h6>
<textarea class="form-control rounded-0" id="Accion"><?=$accion;?></textarea>

<h6>Fecha de implementación:</h6>
<input type="date" class="form-control rounded-0" id="FechaI" value="<?=$fecha;?>">

</div>
<div class="modal-footer">
<button type="button" class="btn btn-primary" style="border-radius: 0px;" onclick="GuardarHallazgo(<?=$idAtencion;?>,<?=$idHallazgo?>)">Guardar</button>
</div>