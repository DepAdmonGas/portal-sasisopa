<?php
require('../../../app/help.php');

if($_POST['categoria'] == 1){

$sql1 = "DELETE FROM tb_atencion_hallazgos WHERE id = '".$_POST['id']."' ";
mysqli_query($con, $sql1);

}else if($_POST['categoria'] == 2){

$sql1 = "DELETE FROM tb_atencion_hallazgos_evidencia WHERE id = '".$_POST['id']."' ";
mysqli_query($con, $sql1);

}

echo 1;