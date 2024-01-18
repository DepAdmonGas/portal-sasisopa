<?php
require('../../../app/help.php');

$sql = "DELETE FROM tb_revision_resultados WHERE id = '".$_POST['id']."'";

mysqli_query($con, $sql);

//------------------
mysqli_close($con);
//------------------