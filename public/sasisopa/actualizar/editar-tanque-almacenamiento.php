<?php
require('../../../app/help.php');

$sql = "UPDATE tb_tanque_almacenamiento SET
no_tanque = '".$_POST['EditNoTanque']."',
capacidad = '".$_POST['EditCapacidad']."',
producto = '".$_POST['EditProducto']."'
 WHERE id = '".$_POST['idTanque']."' ";


if(mysqli_query($con, $sql)){
echo 1;
}else{
echo 0;
}

//------------------
mysqli_close($con);
//------------------