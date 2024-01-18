<?php
require('../../../app/help.php');


$sql = "DELETE FROM tb_cambio_precio WHERE id = '".$_POST['idReporte']."' ";
mysqli_query($con, $sql);