<?php
require('../../../app/help.php');

$sql1 = "DELETE FROM se_quejas_sugerencias WHERE id = '".$_POST['id']."' ";
mysqli_query($con, $sql1);

echo 1;