<?php
require('../../../../app/help.php');

$sql = "UPDATE tb_usuarios SET
usuario = '".$_POST['NomUsuario']."',
password = '".$_POST['PasswordOriginal']."'
 WHERE id= '".$_POST['idUsuario']."' ";
mysqli_query($con, $sql);
mysqli_close($con);
?>
