<?php
require('../../../app/help.php');

$sql = "UPDATE tb_usuarios SET
bitacora_app = 1
 WHERE id = '".$_POST['idUsuario']."' ";
mysqli_query($con, $sql);

//------------------
mysqli_close($con);
//------------------