<?php
require('../../../app/help.php');

$sql1 = "DELETE FROM tb_capacitacion_externa WHERE id = '".$_POST['id']."' ";
mysqli_query($con, $sql1);

echo 1;