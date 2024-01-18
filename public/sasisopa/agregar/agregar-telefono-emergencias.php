<?php
require('../../../app/help.php');

$sql_insert = "INSERT INTO tb_telefonos_emergencias (
id_estacion,
titulo,
telefono,
prioridad
)
VALUES (
'".$_POST['idEstacion']."',
'".$_POST['Titulo']."',
'".$_POST['Telefono']."',
0
)";
mysqli_query($con, $sql_insert);

//------------------
mysqli_close($con);
//------------------


?>

