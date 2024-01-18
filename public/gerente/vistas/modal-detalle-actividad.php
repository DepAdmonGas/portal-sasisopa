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

      <div class="modal-header">
      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
      <span aria-hidden="true">&times;</span>
      </button>
      </div>

<div class="modal-body">
 
<small class="text-secondary mt-3">Fecha:</small>
<div class="fs-5 fw-light border p-2 mt-2">
<?=FormatoFecha($fecha);?>
</div>

<small class="text-secondary mt-3">Folio:</small>
<div class="fs-5 fw-light border p-2 mt-2">
<b>00<?=$folio;?></b>
</div>

<small class="text-secondary mt-3">Actividad:</small>
<div class="fs-5 fw-light border p-2 mt-2">
<?=$formato;?> <?=$Actividad;?>
</div>

<small class="text-secondary mt-3">Periodicidad:</small>
<div class="fs-5 fw-light border p-2 mt-2">
<?=$Periodicidad;?>
</div>


      </div>
