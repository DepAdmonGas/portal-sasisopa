<?php
require('../../../../app/help.php');

if($_POST['cate'] == 1){

$sql_insert = "INSERT INTO sgm_plan_auditoria_auditor (
id_plan,
nombre,
area_actividad,
categoria
)
VALUES (
'".$_POST['id']."',
'".$_POST['auditor2']."',
'".$_POST['auditor3']."',
'".$_POST['auditor1']."'
)";

}else if($_POST['cate'] == 2){

$sql_insert = "INSERT INTO sgm_plan_auditoria_auditor (
id_plan,
nombre,
area_actividad,
categoria
)
VALUES (
'".$_POST['id']."',
'".$_POST['auditor2']."',
'',
'".$_POST['auditor1']."'
)";

}else if($_POST['cate'] == 3){

$sql_insert = "INSERT INTO sgm_plan_auditoria_agenda (
id_plan,
hora_inicio,
hora_termino,
proceso,
elemento_sistema,
nombre_rol,
guia 	
)
VALUES (
'".$_POST['id']."',
'".$_POST['agenda1']."',
'".$_POST['agenda2']."',
'".$_POST['agenda3']."',
'".$_POST['agenda4']."',
'".$_POST['agenda5']."',
'".$_POST['agenda6']."'
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