<?php
require('../../../app/help.php');

$sql_insert1 = "INSERT INTO tb_sondas_medicion (
id_estacion,
no_sonda,
marca,
modelo,
ubicacion
)
VALUES 
(
'".$_POST['idEstacion']."',
'".$_POST['NoSonda']."',
'".$_POST['Marca']."',
'".$_POST['Modelo']."',
'".$_POST['Ubicacion']."'
)";

if(mysqli_query($con, $sql_insert1)){
echo 1;
}else{
echo 2;
}


//------------------
mysqli_close($con);
//------------------