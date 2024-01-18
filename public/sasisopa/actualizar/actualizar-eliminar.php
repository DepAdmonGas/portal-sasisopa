<?php
require('../../../app/help.php');

$sql = "UPDATE tb_equipo_critico SET
estado = 3
 WHERE id = '".$_POST['IdEquipo']."' ";
mysqli_query($con, $sql);

//------------------
mysqli_close($con);
//------------------