<?php
require('../../../../app/help.php');

$sql = "DELETE FROM tb_usuarios_formacion_academica WHERE id = '".$_POST['id']."' ";
mysqli_query($con, $sql);

?>

