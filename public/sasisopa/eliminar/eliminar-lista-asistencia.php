<?php
require('../../../app/help.php');

$sql = "DELETE FROM tb_lista_asistencia_detalle WHERE id_lista_asistencia = '".$_POST['id']."'  ";

if(mysqli_query($con, $sql)){

$sql1 = "DELETE FROM tb_lista_asistencia WHERE id = '".$_POST['id']."'  ";
if(mysqli_query($con, $sql1)){

$sql2 = "DELETE FROM se_comunicacion_i_e WHERE asistencia = '".$_POST['id']."'  ";
if(mysqli_query($con, $sql2)){
echo 1;
}else{
echo 0;
}

}else{
echo 0;
}


}else{
echo 0;
}

//------------------
mysqli_close($con);
//------------------