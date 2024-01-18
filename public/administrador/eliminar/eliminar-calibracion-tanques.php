<?php
require('../../../app/help.php');

    $sql1 = "DELETE FROM tb_calibracion_tanques WHERE id = '".$_POST['id']."' ";
	mysqli_query($con, $sql1);

		

echo 1;
//------------------
mysqli_close($con);
//------------------
?>