<?php
require('../../../../app/help.php');

if($_POST['cate'] == 1){

$sql_insert = "INSERT INTO sgm_hallazgo_auditoria_entrevistador (
id_hallazgo,
nombre,
puesto,
area_descripcion
)
VALUES (
'".$_POST['id']."',
'".$_POST['dato1']."',
'".$_POST['dato2']."',
'".$_POST['dato3']."'
)";

}else if($_POST['cate'] == 2){

$sql_insert = "INSERT INTO sgm_hallazgo_auditoria_auditor (
id_hallazgo,
nombre,
rol
)
VALUES (
'".$_POST['id']."',
'".$_POST['dato1']."',
'".$_POST['dato2']."'
)";

}else if($_POST['cate'] == 3){

$sql_insert = "INSERT INTO sgm_hallazgo_auditoria_conformes (
id_hallazgo,
descripcion,
evidencia,
criterio
)
VALUES (
'".$_POST['id']."',
'".$_POST['dato1']."',
'".$_POST['dato2']."',
'".$_POST['dato3']."'
)";

}else if($_POST['cate'] == 4){

$sql_insert = "INSERT INTO sgm_hallazgo_auditoria_mejora (
id_hallazgo,
descripcion
)
VALUES (
'".$_POST['id']."',
'".$_POST['dato1']."'
)";

}

if(mysqli_query($con, $sql_insert)){
echo 1;
}else{
echo 0;
}

//-----------------
mysqli_close($con);
//-----------------