<?php
require('../../../../app/help.php');
include_once "../../../../app/modelo/Cursos.php";

$class_cursos = new Cursos();
$idModulo = $_GET['idModulo'];
$idTema = $_GET['idTema'];
$idUsuario = $_GET['idUsuario'];
$tituloTema = $class_cursos->tituloTema($idTema);

?>
<div class="modal-header rounded-0 head-modal">
   <h4 class="modal-title text-white">CAPACITACIÓN INTERNA</h4>
   <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
 </div>
 <div class="modal-body">

<h5 class="text-center"><?=$tituloTema;?></h5>

<div class="mt-2 mb-2"><small class="text-secondary">* Fecha programada:</small></div>
<input type="date" class="form-control rounded-0" id="FechaCurso">

 </div>
 <div class="modal-footer">
   <button type="button" class="btn btn-primary" style="border-radius: 0px;" onclick="btnAgregar(<?=$idModulo;?>,<?=$idTema;?>,<?=$idUsuario;?>)">Agregar</button>
 </div>
