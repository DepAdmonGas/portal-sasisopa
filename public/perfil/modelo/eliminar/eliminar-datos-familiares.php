<?php
require('../../../../app/help.php');

$sql = "DELETE FROM tb_usuarios_familiares WHERE id = '".$_POST['id']."' ";
mysqli_query($con, $sql);
?>
