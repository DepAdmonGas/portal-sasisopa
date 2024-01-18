<?php
require('../../../app/help.php');

$sql_insert2 = "INSERT INTO tb_cursos_calendario (
fecha_programada,
fecha_real,
id_estacion,
id_personal,
id_tema,
resultado,
estado
)
VALUES (
'".$_POST['FechaCurso']."',
'',
'".$Session_IDEstacion."',
'".$_POST['idUsuario']."',
'".$_POST['idTema']."',
0,
0
)";
mysqli_query($con, $sql_insert2);

echo $Diastrto = strtotime($_POST['FechaCurso']);

//------------------
mysqli_close($con);
//------------------