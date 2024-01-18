<?php
require('../../../app/help.php');

$sql = "UPDATE tb_capacitacion_externa SET
curso = '".$_POST['Curso']."',
fecha_programada = '".$_POST['FechaCurso']."',
duracion = '".$_POST['Duracion']."',
duraciondetalle = '".$_POST['DuracionDetalle']."',
instructor = '".$_POST['Instructor']."',
fecha_real = '".$_POST['FechaCursoReal']."'
 WHERE id = '".$_POST['idCurso']."' ";
mysqli_query($con, $sql);

//------------------
mysqli_close($con);
//------------------