<?php 
require ('../../../app/help.php');

$idEstacion = $_GET['idEstacion'];

function ValidaActividad($idEstacion,$Actividad,$con){

$sql = "SELECT * FROM sa_sasisopa_estaciones_actividad WHERE id_estacion = '".$idEstacion."' AND id_actividad = '".$Actividad."' ";
$result = mysqli_query($con, $sql);
$numero = mysqli_num_rows($result);
if ($numero == 0) {
return 0;
}else{
return 1;
}

}
?>
<div class="modal-header rounded-0 head-modal">
  <h4 class="modal-title text-white">Agregar Actividades</h4>
  <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
  </div>
      <div class="modal-body">
      
      <div class="fw-bold">Actividad:</div>
      <select class="form-control rounded-0 mt-2" id="Actividad">
      <option value="">Seleccione</option>
      <?php 

    $sql = "SELECT * FROM sa_sasisopa_actividades ";
		$result = mysqli_query($con, $sql);
		$numero = mysqli_num_rows($result);
		while($row = mysqli_fetch_array($result, MYSQLI_ASSOC)){

    $valida = ValidaActividad($idEstacion,$row['id'],$con);
    if($valida == 0){
    echo '<option value="'.$row['id'].'">'.$row['actividad'].'</option>';
    }
		
		}
   	?>
      </select>

      <div class="fw-bold mt-2">Fecha:</div>
      <input type="date" class="form-control rounded-0 mt-2" id="Fecha">

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-primary rounded-0" onclick="AgregarActividad(<?=$idEstacion;?>)">Agregar actividad</button>
      </div>