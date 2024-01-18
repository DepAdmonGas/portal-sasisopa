<?php
require('../../../app/help.php');

$sql = "DELETE FROM tb_tanque_almacenamiento WHERE id = '".$_POST['idTanque']."'  ";

if(mysqli_query($con, $sql)){
echo 1;
}else{
echo 0;
}

//------------------
mysqli_close($con);
//------------------