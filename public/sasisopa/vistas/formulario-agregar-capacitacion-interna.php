<?php
require('../../../app/help.php');

$idTema = $_GET['idTema'];
$idUsuario = $_GET['idUsuario'];

$sql = "SELECT * FROM tb_cursos_temas  WHERE id = '".$idTema."' ";
$query = mysqli_query($con, $sql);
while($row_modulo = mysqli_fetch_array($query, MYSQLI_ASSOC)){
$tituloTema = $row_modulo['titulo'];
}
?>
<div class="modal-header">
   <h4 class="modal-title">CAPACITACIÓN INTERNA</h4>
     <button type="button" class="close" data-dismiss="modal" aria-label="Close">
   <span aria-hidden="true">&times;</span>
 </button>
 </div>
 <div class="modal-body">

<h5 class="text-center"><?=$tituloTema;?></h5>

<div class="mt-2 mb-2"><small class="text-secondary">* Fecha programada:</small></div>
<input type="date" class="form-control rounded-0" id="FechaCurso">

 </div>
 <div class="modal-footer">
   <button type="button" class="btn btn-primary" style="border-radius: 0px;" onclick="btnAgregar(<?=$idTema;?>,<?=$idUsuario;?>)">Agregar</button>
 </div>
