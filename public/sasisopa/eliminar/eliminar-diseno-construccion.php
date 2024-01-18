<?php
require('../../../app/help.php');

$sql_capacitacion = "SELECT * FROM tb_diseno_construccion WHERE id = '".$_POST['id']."' AND estado = '".$Session_IDEstacion."' ";
$result_capacitacion = mysqli_query($con, $sql_capacitacion);
$numero_capacitacion = mysqli_num_rows($result_capacitacion);

if ($numero_capacitacion > 0) {
$sql1 = "DELETE FROM tb_diseno_construccion WHERE id = '".$_POST['id']."' AND estado = '".$Session_IDEstacion."' ";
mysqli_query($con, $sql1);
echo 1;
}else{
echo 0;
}

//------------------
mysqli_close($con);
//------------------