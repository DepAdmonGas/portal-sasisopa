<?php
require('../../../app/help.php');

$sql1 = "DELETE FROM se_comunicacion_i_e WHERE id = '".$_POST['id']."' ";
mysqli_query($con, $sql1);

echo 1;