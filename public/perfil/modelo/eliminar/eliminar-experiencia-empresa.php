<?php
require('../../../../app/help.php');

$sql = "DELETE FROM tb_usuarios_experiencia_empresa_grupo WHERE id = '".$_POST['id']."' ";
mysqli_query($con, $sql);

?>
