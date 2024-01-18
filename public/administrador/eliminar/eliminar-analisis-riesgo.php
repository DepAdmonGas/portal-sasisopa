<?php
require('../../../app/help.php');


$sql1 = "DELETE FROM tb_analisis_riesgo_anexos WHERE id_analisis = '".$_POST['id']."' ";
if(mysqli_query($con, $sql1)){

$sql1 = "DELETE FROM tb_analisis_riesgo WHERE id = '".$_POST['id']."' ";
if(mysqli_query($con, $sql1)){
echo 1;
}else{
echo 0;	
}


}else{
echo 0;
}

//------------------
mysqli_close($con);
//------------------