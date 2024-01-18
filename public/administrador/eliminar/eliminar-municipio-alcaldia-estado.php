<?php
require('../../../app/help.php');

$sql = "UPDATE rl_requisitos_legales_munalcest SET
estado = 0
WHERE id = '".$_POST['id']."' ";

if(mysqli_query($con, $sql)){
echo 1;	
}else{
echo 0;
}


//------------------
mysqli_close($con);
//------------------