<?php
require('../../../app/help.php');


$sql2 = "UPDATE tb_cambio_precio SET
estado = 1
 WHERE id = '".$_POST['idReporte']."' ";
mysqli_query($con, $sql2);

?>