<?php
require('../../../app/help.php');

$sql_insert1 = "INSERT INTO tb_jarra_patron (
id_estacion,
marca,
no_serie,
capacidad,
material
)
VALUES 
(
'".$_POST['idEstacion']."',
'".$_POST['Marca']."',
'".$_POST['NoSerie']."',
'".$_POST['Capacidad']."',
'".$_POST['Material']."'
)";

if(mysqli_query($con, $sql_insert1)){
echo 1;
}else{
echo 2;
}


//------------------
mysqli_close($con);
//------------------