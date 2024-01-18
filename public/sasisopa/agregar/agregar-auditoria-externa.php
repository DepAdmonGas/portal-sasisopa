<?php
require('../../../app/help.php');

$sql_insert = "INSERT INTO tb_auditoria_externa (
id_estacion,
id_usuario,
prestador_servicio
)
VALUES (
'".$_POST['IdEstacion']."',
'".$_POST['IdUsuario']."',
'".$_POST['PrestadorS']."'
)";
mysqli_query($con, $sql_insert);
//------------------
mysqli_close($con);
//------------------