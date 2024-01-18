<?php
require('../../../app/help.php');


$sql = "DELETE FROM re_reporte_cre_pipas WHERE id = '".$_POST['id']."' ";
mysqli_query($con, $sql);

?>
