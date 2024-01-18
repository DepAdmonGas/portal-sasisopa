<?php
require('../../../app/help.php');

if($_POST['dato'] == 1){

$sql = "UPDATE tb_atencion_hallazgos SET
fecha_auditoria = '".$_POST['valor']."'
WHERE id = '".$_POST['id']."' ";
mysqli_query($con, $sql);

}else if($_POST['dato'] == 2){

$sql = "UPDATE tb_atencion_hallazgos SET
no_control = '".$_POST['valor']."'
WHERE id = '".$_POST['id']."' ";
mysqli_query($con, $sql);

}else if($_POST['dato'] == 3){

$sql = "UPDATE tb_atencion_hallazgos SET
tipo_auditoria = '".$_POST['valor']."'
WHERE id = '".$_POST['id']."' ";
mysqli_query($con, $sql);

}



//------------------
mysqli_close($con);
//------------------