<?php
require('../../../app/help.php');

$sql_insert = "INSERT INTO tb_operacion_mantenimiento (
fecha,
norma,
nombre,
link,
estado
)
VALUES (
'".$_POST['Fecha']."',
'".$_POST['Norma']."',
'".$_POST['Nombre']."',
'".$_POST['Link']."',
'".$Session_IDEstacion."'
)";

if(mysqli_query($con, $sql_insert)){
echo 1;
}else{
echo 0;
}

//------------------
mysqli_close($con);
//------------------