<?php
require('../../../app/help.php');
$idCapacitacion = $_GET['idCapacitacion'];

$sql_capacitacion = "SELECT * FROM tb_capacitacion_externa WHERE id = '".$idCapacitacion."' ";
$result_capacitacion = mysqli_query($con, $sql_capacitacion);
$numero_capacitacion = mysqli_num_rows($result_capacitacion);
while($row_capacitacion = mysqli_fetch_array($result_capacitacion, MYSQLI_ASSOC)){

$curso = $row_capacitacion['curso'];
$fecha = $row_capacitacion['fecha_programada'];
$duracion = $row_capacitacion['duracion'];
$duraciondetalle = $row_capacitacion['duraciondetalle'];
$instructor = $row_capacitacion['instructor'];
$fechareal = $row_capacitacion['fecha_real'];
}
?>
<div class="modal-header">
   <h4 class="modal-title">EDITAR CAPACITACIÓN EXTERNA</h4>
     <button type="button" class="close" data-dismiss="modal" aria-label="Close">
   <span aria-hidden="true">&times;</span>
 </button>
 </div>
 <div class="modal-body">

<div class="mb-2"><small class="text-secondary">* Nombre del curso:</small></div>
<textarea class="form-control rounded-0" id="Curso" ><?=$curso;?></textarea>

<div class="mt-2 mb-2"><small class="text-secondary">* Fecha programada:</small></div>
<input type="date" class="form-control rounded-0" id="FechaCurso" value="<?=$fecha;?>">

<div class="mt-2 mb-2"><small class="text-secondary">Duración:</small></div>
<div class="form-inline">
<input type="text" class="form-control rounded-0" id="Duracion" value="<?=$duracion;?>">
<select class="form-control rounded-0" id="DuracionDetalle">
<option value="<?=$duraciondetalle;?>"><?=$duraciondetalle;?></option>
<option value="Minutos">Minutos</option>
<option value="Horas">Horas</option>
</select>
</div>

<div class="mt-2 mb-2"><small class="text-secondary">Nombre del instructor:</small></div>
<input type="text" class="form-control rounded-0" id="Instructor" value="<?=$instructor;?>">
<hr>
<small><b>* Agrega la fecha real de cuando se impartió el curso</b></small>

<div class="mt-2 mb-2"><small class="text-secondary">Fecha real:</small></div>
<input type="date" class="form-control rounded-0" id="FechaCursoReal" min="<?=$fecha;?>" value="<?=$fechareal;?>">

 </div>
 <div class="modal-footer">
   <button type="button" class="btn btn-primary" style="border-radius: 0px;" onclick="btnEditar(<?=$idCapacitacion;?>)">Editar</button>
 </div>