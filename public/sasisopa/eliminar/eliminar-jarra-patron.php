<?php
require('../../../app/help.php');

$sql = "DELETE FROM tb_jarra_patron WHERE id = '".$_POST['idJarra']."'  ";

if(mysqli_query($con, $sql)){
echo 1;
}else{
echo 0;
}

//------------------
mysqli_close($con);
//------------------