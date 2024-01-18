<?php
require('../../../app/help.php');

if($_POST['seccion'] == 1){

$sql1 = "DELETE FROM tb_seguimiento_objetivos_metas_detalle WHERE id_seguimiento = '".$_POST['id']."' ";
mysqli_query($con, $sql1);

$sql2 = "DELETE FROM tb_seguimiento_objetivos_metas WHERE id = '".$_POST['id']."' ";
mysqli_query($con, $sql2);

echo 1;


}else if($_POST['seccion'] == 2){

$sql1 = "DELETE FROM tb_seguimiento_reporte_indicador WHERE id = '".$_POST['id']."' ";
mysqli_query($con, $sql1);

echo 1;

}


//------------------
mysqli_close($con);
//------------------