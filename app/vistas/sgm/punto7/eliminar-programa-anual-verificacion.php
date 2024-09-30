<?php
require('../../../../app/help.php');


$sql1 = "DELETE FROM sgm_programa_anual_calibracion_verificacion WHERE id = '".$_POST['id']."' ";
mysqli_query($con, $sql1);
echo 1;


//------------------
mysqli_close($con);
//------------------