<?php
require('../../../app/help.php');

if($_POST['MA'] == "NA"){
$MA = "";	
}else{
$MA = $_POST['MA'];	
}

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
'".$_POST['NG']."',
'".$MA."',
'".$_POST['Dependencia']."',
'".$_POST['Permiso']."',
'".$_POST['Fundamento']."',

'".$Session_IDEstacion."', 
0,
1
)";

if(mysqli_query($con, $sql_insert)){
echo 1;
}else{
echo 0;
}

//------------------
mysqli_close($con);
//------------------