<?php
require('../../../app/help.php');


$dirigidoa = implode(",", $_POST['Editdirigidoa']);

$sql = "UPDATE se_comunicacion_i_e SET
fecha = '".$_POST['Editfecha']."',
tema = '".$_POST['Edittemacomunicar']."',
detalle = '".$_POST['Editdetalle']."',
tipo_comunicacion = '".$_POST['Edittipocomunicacion']."',
material = '".$_POST['Editmaterialcomunicar']."',
seguimiento = '".$_POST['Editseguimientocomunicacion']."',
dirigidoa = '".$dirigidoa."'
WHERE id = '".$_POST['id']."' ";


mysqli_query($con, $sql);
//------------------
mysqli_close($con);
//------------------