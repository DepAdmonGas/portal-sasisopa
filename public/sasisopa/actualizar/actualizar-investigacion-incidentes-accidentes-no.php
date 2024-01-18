<?php
require('../../../app/help.php');


$sql = "UPDATE tb_investigacion_incidente_accidente_no SET
fecha = '".$_POST['Fecha']."',
estatus = 1
 WHERE id = '".$_POST['id']."' ";
mysqli_query($con, $sql);



//------------------
mysqli_close($con);
//------------------