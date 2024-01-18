<?php
require('../../../app/help.php');

$sql_insert = "INSERT INTO tb_diseno_construccion (
valor1,
valor2,
estado
)
VALUES (
'".$_POST['Codigo']."',
'".$_POST['Area']."',
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