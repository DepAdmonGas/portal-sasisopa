<?php
require('../../../app/help.php');

$sql = "UPDATE tb_implementacion_sasisopa_procedimientos SET
descripcion = '".$_POST['Descripcion']."'
 WHERE id = '".$_POST['id']."' ";
mysqli_query($con, $sql);

//------------------
mysqli_close($con);
//------------------