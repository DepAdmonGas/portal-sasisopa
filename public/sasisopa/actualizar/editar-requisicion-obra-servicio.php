<?php
require('../../../app/help.php');

$sql = "UPDATE tb_requisicion_obra SET
fecha = '".$_POST['EditFecha'].' '.$hora_del_dia."',
descripcion = '".$_POST['EditDescripcion']."',
justificacion = '".$_POST['EditJustificacion']."'
 WHERE id = '".$_POST['id']."' ";


mysqli_query($con, $sql);
//------------------
mysqli_close($con);
//------------------