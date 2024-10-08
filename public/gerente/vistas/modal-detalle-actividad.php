<?php 
require ('../../../app/help.php');

$idActividad = $_GET['idActividad'];

$sql = "SELECT * FROM tb_calendario_actividades WHERE id  = '".$idActividad."' ";
$result = mysqli_query($con, $sql);
$numero = mysqli_num_rows($result);
while($row = mysqli_fetch_array($result, MYSQLI_ASSOC)){
$folio = $row['folio'];
$fecha = $row['fecha_inicio'];
$Array = Actividad($row['id_actividad'],$con);
$formato = $Array['formato'];
$Actividad = $Array['Actividad'];
$Periodicidad = $Array['Periodicidad'];
}

function Actividad($idActividad,$con){
$sql = "SELECT formato, actividad, periodicidad FROM sa_sasisopa_actividades WHERE id = '".$idActividad."' ";
$result = mysqli_query($con, $sql);
$numero = mysqli_num_rows($result);
while($row = mysqli_fetch_array($result, MYSQLI_ASSOC)){
$formato = $row['formato']; 
$actividad = $row['actividad']; 
$periodicidad = $row['periodicidad']; 
}

$array = array('formato' => $formato, 'Actividad' => $actividad,
                'Periodicidad' => $periodicidad );

return $array;
}
?>
<div class="modal-header rounded-0 head-modal">
  <h4 class="modal-title text-white">Detalle Actividad</h4>
  <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
  </div>

<div class="modal-body">
 
<small class="mt-3 fw-bold">Fecha:</small>
<div class="fs-5 fw-light border p-2 mt-2 mb-2">
<?=FormatoFecha($fecha);?>
</div>

<small class="mt-3 fw-bold">Folio:</small>
<div class="fs-5 fw-light border p-2 mt-2 mb-2">
<b>00<?=$folio;?></b>
</div>

<small class="mt-3 fw-bold">Actividad:</small>
<div class="fs-5 fw-light border p-2 mt-2 mb-2">
<?=$formato;?> <?=$Actividad;?>
</div>

<small class="mt-3 fw-bold">Periodicidad:</small>
<div class="fs-5 fw-light border p-2 mt-2 mb-2">
<?=$Periodicidad;?>
</div>


      </div>
