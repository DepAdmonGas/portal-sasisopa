<?php
require('../../../app/help.php');

$sql = "UPDATE tb_usuarios_firma_bitacora SET
fechatermino = '".$hoy."',
comentario = '".$_POST['Comentarios']."',
estado = 0
 WHERE id = '".$_POST['idFirma']."' ";
mysqli_query($con, $sql);

//------------------
mysqli_close($con);
//------------------