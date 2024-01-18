<?php
require('../../../app/help.php');

$sql1 = "DELETE FROM tb_capacitacion_externa_personal WHERE id = '".$_POST['id']."'  ";
mysqli_query($con, $sql1);

//Cerrar conexion BD
mysqli_close($con);