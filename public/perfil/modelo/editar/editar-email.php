<?php
require('../../../../app/help.php');

$sql = "UPDATE tb_usuarios SET
email = '".$_POST['Email']."'
WHERE id = '".$_POST['idUsuario']."' ";
mysqli_query($con, $sql);
mysqli_close($con);
?>