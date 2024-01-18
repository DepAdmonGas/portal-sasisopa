<?php
require('../../../../app/help.php');

$sql = "UPDATE tb_usuarios SET
estado_civil = '".$_POST['EstadoCivil']."'
WHERE id= '".$_POST['idUsuario']."' ";
mysqli_query($con, $sql);
mysqli_close($con);
?>
