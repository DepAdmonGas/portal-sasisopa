<?php
require('../../../app/help.php');

$sql_insert1 = "INSERT INTO tb_tanque_almacenamiento (
id_estacion,
no_tanque,
capacidad,
producto
)
VALUES 
(
'".$_POST['idEstacion']."',
'".$_POST['NoTanque']."',
'".$_POST['Capacidad']."',
'".$_POST['Producto']."'
)";

if(mysqli_query($con, $sql_insert1)){
echo 1;
}else{
echo 2;
}


//------------------
mysqli_close($con);
//------------------