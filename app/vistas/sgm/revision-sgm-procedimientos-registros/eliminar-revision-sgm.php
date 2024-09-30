<?php
require('../../../../app/help.php');

$sql = "DELETE FROM sgm_revision_procedimiento_registro_detalle WHERE id_revision = '".$_POST['id']."'  ";
if(mysqli_query($con, $sql)){
$sql1 = "DELETE FROM sgm_revision_procedimiento_registro WHERE id = '".$_POST['id']."'  ";
if(mysqli_query($con, $sql1)){
echo 1;
}else{
echo 0;
}
}else{
echo 0;
}

//------------------
mysqli_close($con);
//------------------