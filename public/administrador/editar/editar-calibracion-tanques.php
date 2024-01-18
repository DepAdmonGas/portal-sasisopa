<?php
require('../../../app/help.php');


$sql2 = "UPDATE tb_calibracion_tanques SET
fecha = '".$_POST['fecha']."'
 WHERE id = '".$_POST['id']."' ";
mysqli_query($con, $sql2);

echo 1;
?>