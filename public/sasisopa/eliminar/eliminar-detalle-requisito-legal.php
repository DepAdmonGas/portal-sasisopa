<?php
require('../../../app/help.php');

$sql1 = "DELETE FROM rl_requisitos_legales_matriz WHERE id = '".$_POST['idmatriz']."' ";
mysqli_query($con, $sql1);

echo 1;