<?php
require('../../../app/help.php');


$sql1 = "DELETE FROM tb_analisis_riesgo_anexos WHERE id = '".$_POST['idanexo']."' ";
if(mysqli_query($con, $sql1)){

echo 1;
}else{
echo 0;
}

//------------------
mysqli_close($con);
//------------------