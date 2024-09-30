<?php
require('../../../../app/help.php');

$cadena = implode(",", $_POST['PersonalFirma']);
$array = explode(",", $cadena);

for ($i=0; $i < count($array) ; $i++) { 

$sql_insert = "INSERT INTO sgm_seguimiento_asistentes (
id_seguimiento, id_usuario
)
VALUES (
'".$_POST['idRegistro']."',
'".$array[$i]."'
)";

mysqli_query($con, $sql_insert);

}

echo 1;




//-----------------
mysqli_close($con);
//-----------------