<?php
require('../../../app/help.php');


$sql1 = "DELETE FROM rl_requisitos_legales_matriz WHERE idcalendario = '".$_GET['id']."' ";
mysqli_query($con, $sql1);

$sql2 = "DELETE FROM rl_requisitos_legales_calendario WHERE id = '".$_GET['id']."' ";
mysqli_query($con, $sql2);
?>