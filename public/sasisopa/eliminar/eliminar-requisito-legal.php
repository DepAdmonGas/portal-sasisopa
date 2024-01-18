<?php
require('../../../app/help.php');

$sql = "DELETE FROM rl_requisitos_legales_matriz WHERE idcalendario = '".$_POST['idre']."' ";

if(mysqli_query($con, $sql)){

$sql1 = "DELETE FROM rl_requisitos_legales_calendario WHERE id = '".$_POST['idre']."' ";
mysqli_query($con, $sql1);

echo 1;
}else{
echo 0;
}

