<?php
require('../../../app/help.php');

$sql = "UPDATE tb_jarra_patron SET
marca = '".$_POST['EditMarca']."',
no_serie = '".$_POST['EditNoSerie']."',
capacidad = '".$_POST['EditCapacidad']."',
material = '".$_POST['EditMaterial']."'
 WHERE id = '".$_POST['idJarra']."' ";


if(mysqli_query($con, $sql)){
echo 1;
}else{
echo 0;
}

//------------------
mysqli_close($con);
//------------------