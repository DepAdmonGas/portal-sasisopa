<?php
require('../../../../app/help.php');


$sql1 = "UPDATE sgm_inventario_equipo
SET estado = 2
WHERE id = '".$_POST['id']."' ";
mysqli_query($con, $sql1);
echo 1;


//------------------
mysqli_close($con);
//------------------