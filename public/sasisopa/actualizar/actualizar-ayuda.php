<?php
require('../../../app/help.php');

$sql = "UPDATE pu_sasisopa_ayuda SET
estado = 1
 WHERE id = '".$_POST['idAyuda']."' ";
mysqli_query($con, $sql);

//------------------
mysqli_close($con);
//------------------
