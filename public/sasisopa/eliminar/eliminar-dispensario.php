<?php
require('../../../app/help.php');

$sql = "UPDATE tb_dispensarios SET
estado = 0
 WHERE id = '".$_POST['idDispensario']."' ";


if(mysqli_query($con, $sql)){
echo 1;
}else{
echo 0;
}

//------------------
mysqli_close($con);
//------------------