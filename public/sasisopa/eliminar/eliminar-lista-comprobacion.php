<?php
require('../../../app/help.php');

$sql1 = "DELETE FROM tb_politica_lista_comprobacion_detalle WHERE id_lista_comprobacion = '".$_POST['id']."'  ";

if(mysqli_query($con, $sql1)){

$sql2 = "DELETE FROM tb_politica_lista_comprobacion WHERE id = '".$_POST['id']."'  ";

if(mysqli_query($con, $sql2)){


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