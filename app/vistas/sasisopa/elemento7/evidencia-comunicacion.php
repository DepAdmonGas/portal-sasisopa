<?php
require('../../../../app/help.php');
include_once "../../../../app/modelo/ComunicacionParticipacionConsulta.php";

$class_comunicacion = new ComunicacionParticipacionConsulta();
$temac = $class_comunicacion->temaComunicacion($_GET['idcomunicado']);

$sql = "SELECT id,archivo FROM se_comunicacion_evidencia WHERE id_comunicacion = '".$_GET['idcomunicado']."' ";
$result = mysqli_query($con, $sql);
$numero = mysqli_num_rows($result);
?>
<script type="text/javascript">
$(document).ready(function(){
  $('[data-toggle="tooltip"]').tooltip();
  });
</script>

 
<div class="modal-header rounded-0 head-modal">

<h5 class="modal-title text-white"><?=$temac;?></h5>
<button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
</div>

<div class="modal-body">

<h6>Evidencia:</h6>
<input type="file" id="FileEvidencia">
<div class="text-end">
<button type="button" class="btn btn-primary btn-sm" style="border-radius: 0px;" onclick="AgregarEvidencia(<?=$_GET['idcomunicado'];?>)">Agregar evidencia</button>
</div>
<div id="result"></div>
<hr>

<?php
if ($numero > 0) {
echo '<div class="row">';
while($row = mysqli_fetch_array($result, MYSQLI_ASSOC)){

echo '<div class="col-4">
<div class="border p-1">
<div class="text-right"><a onclick="EliminarE('.$_GET['idcomunicado'].','.$row['id'].')"><img src="'.RUTA_IMG_ICONOS.'eliminar-red-16.png" /></a></div>
<div class="mt-1"><img src="archivos/evidencias/'.$row['archivo'].'" width="100%" /></div>
</div>
</div>';


}
echo '</div>';
}else{
echo "<div class='text-center text-secondary'>No se encontraron evidencias</div>";	
}
?>


</div>