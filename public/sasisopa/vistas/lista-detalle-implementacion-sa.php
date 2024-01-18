<?php
require('../../../app/help.php');

$idDetalle = $_GET['idDetalle'];

$sql_implementacion = "SELECT * FROM tb_implementacionsa_detalle WHERE id_implementacion = '".$idDetalle."' ";
$result_implementacion = mysqli_query($con, $sql_implementacion);
$numero_implementacion = mysqli_num_rows($result_implementacion);
?>

 <div class="modal-header">
   <h4 class="modal-title">Detalle Implementación del SA</h4>
     <button type="button" class="close" data-dismiss="modal" aria-label="Close">
   <span aria-hidden="true">&times;</span>
 </button>
 </div>
 <div class="modal-body">

<table class="table table-bordered table-striped table-hover table-sm mt-3" style="font-size: .9em;">
<thead>
<th class="text-center">Pregunta</th>
<th width="100" class="text-center">Resultado</th>
</thead>
<tbody>
<?php 
if ($numero_implementacion > 0) {
while($row_implementacion = mysqli_fetch_array($result_implementacion, MYSQLI_ASSOC)){
$id = $row_implementacion['id'];
$pregunta = $row_implementacion['pregunta'];
$respuesta = $row_implementacion['respuesta'];


?>
<tr>
<td class="align-middle"><?=$pregunta;?></td>
<td class="align-middle text-center"><b><?=$respuesta;?></b></td>
</tr>
<?php
}
}else{
echo "<tr><td colspan='8' class='text-center'><small>No se encontró información para mostrar</small></td></tr>";	
}
?>	
</tbody>
</table>
</div>