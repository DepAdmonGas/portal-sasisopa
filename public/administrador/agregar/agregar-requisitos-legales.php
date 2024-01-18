<?php
require('../../../app/help.php');

$sql_insert = "INSERT INTO rl_requisitos_legales_lista (
nivel_gobierno,
mun_alc_est,
dependencia,
permiso,
fundamento,
id_estacion,
disabled,
estado
)
VALUES 
(
'".$_POST['NivelG']."',
'".$_POST['MuAlEs']."',
'".$_POST['Dependencia']."',
'".$_POST['Permiso']."',
'".$_POST['Fundamento']."',
0, 
1,
1
)";
mysqli_query($con, $sql_insert);

//------------------
mysqli_close($con);
//------------------