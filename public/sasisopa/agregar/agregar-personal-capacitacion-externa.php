<?php
require('../../../app/help.php');

$sql_insert = "INSERT INTO tb_capacitacion_externa_personal (
id_capacitacion,
id_empleado
)
VALUES (
'".$_POST['idCapacitacion']."',
'".$_POST['IdPersonal']."'
)";
mysqli_query($con, $sql_insert);

//------------------
mysqli_close($con);
//------------------