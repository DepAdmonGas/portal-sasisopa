<?php
require('../../../app/help.php');

$sql = "UPDATE tb_implementacionsa SET
fecha = '".$_POST['Fecha'].' '.$hora_del_dia."'
WHERE id = '".$_POST['idDetalle']."' ";
mysqli_query($con, $sql);

//------------------
mysqli_close($con);
//------------------