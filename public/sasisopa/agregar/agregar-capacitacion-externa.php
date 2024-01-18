<?php
require('../../../app/help.php');

 $sql_temas = "SELECT * FROM tb_capacitacion_externa ORDER BY id desc LIMIT 1 ";
  $result_temas = mysqli_query($con, $sql_temas);
  $count_temas = mysqli_num_rows($result_temas);
  if ($count_temas == 0) {
  $id = 1;
  }else{
  while($row_temas = mysqli_fetch_array($result_temas, MYSQLI_ASSOC)) {
  $id = $row_temas['id'] + 1;
  }	
  }

$sql_insert = "INSERT INTO tb_capacitacion_externa (
id,
id_estacion,
id_usuario,
curso,
fecha_programada,
duracion,
duraciondetalle,
instructor,
fecha_real
)
VALUES (
'".$id."',
'".$_POST['idEstacion']."',
'".$Session_IDUsuarioBD."',
'".$_POST['Curso']."',
'".$_POST['FechaCurso']."',
'".$_POST['Duracion']."',
'".$_POST['DuracionDetalle']."',
'".$_POST['Instructor']."',
''
)";
mysqli_query($con, $sql_insert);

$sql_usuario = "SELECT * FROM tb_usuarios WHERE id_gas = '".$_POST['idEstacion']."' AND estatus = 0 ";
$result_usuario = mysqli_query($con, $sql_usuario);
$numero_usuario = mysqli_num_rows($result_usuario);
while($row_usuario = mysqli_fetch_array($result_usuario, MYSQLI_ASSOC)){

$sql_insert2 = "INSERT INTO tb_capacitacion_externa_personal (
id_capacitacion,
id_empleado
)
VALUES (
'".$id."',
'".$row_usuario['id']."'
)";
mysqli_query($con, $sql_insert2);

}

//------------------
mysqli_close($con);
//------------------