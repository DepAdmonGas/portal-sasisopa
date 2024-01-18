<?php
require('../../../app/help.php');

$sql = "SELECT * FROM rl_requisitos_legales_lista WHERE id = '".$_POST['id']."' AND disabled = 0 ";
$result = mysqli_query($con, $sql);
$numero = mysqli_num_rows($result);
if ($numero == 1) {

$sql = "UPDATE rl_requisitos_legales_lista SET
estado = 0
WHERE id = '".$_POST['id']."' ";

if(mysqli_query($con, $sql)){
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