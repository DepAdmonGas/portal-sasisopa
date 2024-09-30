<?php
require('../../../app/help.php');


$sql = "DELETE FROM sgm_control_documental WHERE id = '".$_POST['idDocumento']."' ";
if(mysqli_query($con, $sql)){
echo 1;
}else{
echo 0;
}



//------------------
mysqli_close($con);
//------------------