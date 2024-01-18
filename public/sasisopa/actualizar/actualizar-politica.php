<?php
require('../../../app/help.php');

$sql = "UPDATE tb_estaciones SET
politica = '".$_POST['politica']."',
mision = '".$_POST['mision']."',
vision = '".$_POST['vision']."'
 WHERE id= '".$_POST['idEstacion']."' ";
mysqli_query($con, $sql);

//------------------
mysqli_close($con);
//------------------
