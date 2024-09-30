<?php
require('../../../../app/help.php');

$sql = "UPDATE sgm_seguimiento_objetivo_indicador SET
fecha = '".$_POST['fecha']."',
hora = '".$_POST['hora']."',
lugar = '".$_POST['lugar']."',
estado = 1
 WHERE id = '".$_POST['idRegistro']."' ";

if(mysqli_query($con, $sql)){
echo 1;
}else{
echo 0;
}

mysqli_close($con);