<?php
require('../../../app/help.php');

$sql_insert = "INSERT INTO rl_requisitos_legales_dependencias (
dependencia,
id_estacion,
disabled,
estado
)
VALUES 
(
'".$_POST['Detalle']."',
0, 
1,
1
)";
mysqli_query($con, $sql_insert);

//------------------
mysqli_close($con);
//------------------