<?php
require('../../app/help.php');

$idCalendario = $_GET['idCalendario'];

$sql = "SELECT id_tema, estado, id_personal FROM tb_cursos_calendario WHERE id = '".$idCalendario."' "; 
$result = mysqli_query($con, $sql);
$numero  = mysqli_num_rows($result);
while($row = mysqli_fetch_array($result, MYSQLI_ASSOC)){
$idTema = $row['id_tema'];
$estado = $row['estado'];
$idPersonal = $row['id_personal'];
}
$sqlTema = "SELECT * FROM tb_cursos_temas WHERE id = '".$idTema."' "; 
$resultTema = mysqli_query($con, $sqlTema);
$numeroTema  = mysqli_num_rows($resultTema);
while($rowTema = mysqli_fetch_array($resultTema, MYSQLI_ASSOC)){
$numtema = $rowTema['num_tema'];
$titulo = $rowTema['titulo'];
$archivo = $rowTema['archivo'];
}

?>
  <div class="modal-header">
  <h5 class="modal-title">Programar Tema</h5>
  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
  </div>

  <div class="modal-body">

  	<h6><?=$numtema;?>. <?=$titulo;?></h6>

    <h6>Fecha:</h6>
    <input type="date" class="form-control rounded-0" id="FechaCurso">


  </div>

    <div class="modal-footer">
  <button type="button" class="btn btn-primary" style="border-radius: 0px;" onclick="Programar(<?=$idTema;?>,<?=$idPersonal;?>)">Programar</button>
  </div>