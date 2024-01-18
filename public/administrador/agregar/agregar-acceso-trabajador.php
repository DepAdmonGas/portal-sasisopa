<?php
require('../../../app/help.php');

$sql_insert = "INSERT INTO tb_usuarios_firma_bitacora (
id_estacion,
id_usuario,
categoria,
fechatermino,
comentario,
estado
)
VALUES 
(
'".$_POST['idEstacion']."', 
'".$_POST['idUsuario']."',
'".$_POST['categoria']."',
'',
'',
1
)";
mysqli_query($con, $sql_insert);

//------------------
mysqli_close($con);
//------------------