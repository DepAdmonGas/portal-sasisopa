<?php
require('../../../app/help.php');

$sql = "UPDATE po_programa_anual_mantenimiento SET
estado = 1
 WHERE id = '".$_POST['idreporte']."' ";
mysqli_query($con, $sql);

//------------------
mysqli_close($con);
//------------------