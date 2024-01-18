<?php
require('../../../app/help.php');

$sql = "UPDATE tb_usuarios SET estatus = 1 WHERE id= '".$_POST['IdUsuario']."' ";
mysqli_query($con, $sql);
mysqli_close($con);
?>
