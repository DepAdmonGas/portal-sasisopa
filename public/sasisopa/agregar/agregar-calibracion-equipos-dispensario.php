<?php
require('../../../app/help.php');

$sql_insert = "INSERT INTO tb_calibracion_equipos_dispensario (
id_calibracion,
id_dispensario,
resultado1,
resultado2,
resultado3,
resultado4
)
VALUES (
'".$_POST['Id']."',
'".$_POST['idDispensario']."',
'',
'',
'',
''
)";
mysqli_query($con, $sql_insert);
//------------------
mysqli_close($con);
//------------------