<?php
require('../../../../app/help.php');

$sql = "UPDATE tb_usuarios SET
telefono = '".$_POST['Telefono']."'
WHERE id= '".$_POST['idUsuario']."' ";
mysqli_query($con, $sql);
mysqli_close($con);
?>
