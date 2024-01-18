<?php
require('../../../app/help.php');

$sql = "UPDATE tb_implementacion_sasisopa_procedimientos SET
fecha_implementacion = '".$_POST['Fecha']."'
 WHERE id = '".$_POST['id']."' ";
mysqli_query($con, $sql);

//------------------
mysqli_close($con);
//------------------