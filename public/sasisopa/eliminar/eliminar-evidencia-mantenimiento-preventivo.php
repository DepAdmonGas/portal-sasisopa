<?php
require('../../../app/help.php');

$sql = "DELETE FROM po_mantenimiento_verificar_evidencias WHERE id = '".$_POST['idevidencia']."'";

mysqli_query($con, $sql);

//------------------
mysqli_close($con);
//------------------