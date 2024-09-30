<?php
require('../../../../app/help.php');


$sql_insert = "INSERT INTO sgm_responsable (
id_estacion, fecha, responsable, auxiliar
)
VALUES (
'".$Session_IDEstacion."',
'".$_POST['Fecha']."',
'".$_POST['UsuarioRISGM']."',
'".$_POST['UsuarioAISGM']."'
)";

if(mysqli_query($con, $sql_insert)){
echo 1;
}else{
echo 0;
}

//-----------------
mysqli_close($con);
//-----------------