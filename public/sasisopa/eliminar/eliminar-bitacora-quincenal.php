<?php
require('../../../app/help.php');

$sql1 = "DELETE FROM bi_mantenimiento_quincenal WHERE id = '".$_POST['id']."' ";
mysqli_query($con, $sql1);

echo 1;