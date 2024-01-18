<?php
require('../../../app/help.php');

$sql1 = "DELETE FROM tb_investigacion_incidente_accidente WHERE id = '".$_POST['id']."' ";
mysqli_query($con, $sql1);

echo 1;