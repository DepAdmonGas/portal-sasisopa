<?php
require('../../../app/help.php');

$sql = "DELETE FROM tb_sondas_medicion WHERE id = '".$_POST['idSonda']."'  ";

if(mysqli_query($con, $sql)){
echo 1;
}else{
echo 0;
}

//------------------
mysqli_close($con);
//------------------