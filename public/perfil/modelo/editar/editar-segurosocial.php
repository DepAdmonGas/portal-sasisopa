<?php
require('../../../../app/help.php');

$sql = "UPDATE tb_usuarios SET
seguro_social = '".$_POST['NumeroSSocial']."'
WHERE id= '".$_POST['idUsuario']."' ";
mysqli_query($con, $sql);
mysqli_close($con);
?>
