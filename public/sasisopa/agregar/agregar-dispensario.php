<?php
require('../../../app/help.php');

$sql_insert1 = "INSERT INTO tb_dispensarios (
id_estacion,
no_dispensario,
marca,
modelo,
serie,
producto1,
producto2,
producto3,
estado
)
VALUES 
(
'".$_POST['idEstacion']."',
'".$_POST['NoDispensario']."',
'".$_POST['Marca']."',
'".$_POST['Modelo']."',
'".$_POST['Serie']."',
'".$_POST['Producto1']."',
'".$_POST['Producto2']."',
'".$_POST['Producto3']."',
1
)";

if(mysqli_query($con, $sql_insert1)){
echo 1;
}else{
echo 2;
}


//------------------
mysqli_close($con);
//------------------