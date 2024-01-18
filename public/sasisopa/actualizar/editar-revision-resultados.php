<?php
require('../../../app/help.php');

$sql = "UPDATE tb_revision_resultados SET
fecha_hora = '".$_POST['EditFecha']." ".$hora_del_dia."'
 WHERE id = '".$_POST['id']."' ";


if(mysqli_query($con, $sql)){
echo 1;
}else{
echo 0;
}

//------------------
mysqli_close($con);
//------------------