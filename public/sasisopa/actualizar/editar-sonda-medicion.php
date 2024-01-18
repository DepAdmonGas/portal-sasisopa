<?php
require('../../../app/help.php');

$sql = "UPDATE tb_sondas_medicion SET
no_sonda = '".$_POST['EditNoSonda']."',
marca = '".$_POST['EditMarca']."',
modelo = '".$_POST['EditModelo']."',
ubicacion = '".$_POST['EditUbicacion']."'
 WHERE id = '".$_POST['idSonda']."' ";


if(mysqli_query($con, $sql)){
echo 1;
}else{
echo 0;
}

//------------------
mysqli_close($con);
//------------------