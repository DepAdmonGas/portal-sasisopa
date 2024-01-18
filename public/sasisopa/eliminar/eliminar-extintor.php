<?php
require('../../../app/help.php');


$sql = "UPDATE po_extintores_estacion SET
estado = 0
 WHERE id = '".$_POST['idExtintor']."' ";
mysqli_query($con, $sql);

//------------------
mysqli_close($con);
//------------------