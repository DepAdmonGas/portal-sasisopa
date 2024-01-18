<?php
require('../../../app/help.php');

$sql = "DELETE FROM tb_telefonos_emergencias WHERE id = '".$_POST['idTelefono']."'  ";
mysqli_query($con, $sql);

//------------------
mysqli_close($con);
//------------------