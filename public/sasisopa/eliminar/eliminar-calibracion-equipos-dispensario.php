<?php
require('../../../app/help.php');

$sql1 = "DELETE FROM tb_calibracion_equipos_dispensario WHERE id = '".$_POST['Id']."' ";
mysqli_query($con, $sql1);

echo 1;