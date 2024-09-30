<?php
require('../../../../app/help.php');

$idRegistro = $_GET['idRegistro'];
$folio = $_GET['folio'];


$sql = "SELECT * FROM sgm_orden_servicio WHERE id = '".$idRegistro."' ";
$result = mysqli_query($con, $sql);
$numero = mysqli_num_rows($result);
if ($numero > 0) {
$row = mysqli_fetch_array($result, MYSQLI_ASSOC);
$descripcion = $row['descripcion'];
$justificacion = $row['justificacion'];
}else{
$descripcion =  "";
$justificacion = ""; 
}
?>
     <div class="modal-header">
       <h4 class="modal-title">Orden de servicio</h4>
         <button type="button" class="close" data-dismiss="modal" aria-label="Close">
       <span aria-hidden="true">&times;</span>
     </button>
     </div>
     <div class="modal-body">


    <b>Descripción detallada del servicio equipo que requiere:</b>
    <textarea class="form-control" id="descripcion"><?=$descripcion;?></textarea>

    <div class="mt-2"><b>Justificación del servicio que requiere:</b>
    <textarea class="form-control" id="justificacion"><?=$justificacion;?></textarea></div>

    </div>
    <div class="modal-footer">
	<button type="button" class="btn btn-primary rounded-0" onclick="GuardarOrden(<?=$idRegistro;?>,<?=$folio;?>)">Guardar</button>
	</div>

     	 	 	 	 
