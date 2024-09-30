<?php
require('../../../../app/help.php');

$sql_insert = "INSERT INTO sgm_politica (
id_estacion, fecha, contenido
)
VALUES (
'".$Session_IDEstacion."',
'".$_POST['fecha']."',
'".$_POST['contenido']."'
)";

if(mysqli_query($con, $sql_insert)){
echo 1;
}else{
echo 0;
}

//-----------------
mysqli_close($con);
//-----------------