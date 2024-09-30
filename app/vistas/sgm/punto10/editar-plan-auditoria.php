<?php
require('../../../../app/help.php');

if($_POST['cate'] == 1){
$sql = "UPDATE sgm_plan_auditoria
SET fecha = '".$_POST['valor']."'
WHERE id = '".$_POST['id']."' ";
}else if($_POST['cate'] == 2){
$sql = "UPDATE sgm_plan_auditoria
SET nom_director = '".$_POST['valor']."'
WHERE id = '".$_POST['id']."' ";
}else if($_POST['cate'] == 3){
$sql = "UPDATE sgm_plan_auditoria
SET ubicacion_instalacion = '".$_POST['valor']."'
WHERE id = '".$_POST['id']."' ";
}else if($_POST['cate'] == 4){
$sql = "UPDATE sgm_plan_auditoria
SET objetivo_auditoria = '".$_POST['valor']."'
WHERE id = '".$_POST['id']."' ";
}else if($_POST['cate'] == 5){
$sql = "UPDATE sgm_plan_auditoria
SET alcance_auditoria = '".$_POST['valor']."'
WHERE id = '".$_POST['id']."' ";
}else if($_POST['cate'] == 6){
$sql = "UPDATE sgm_plan_auditoria
SET fecha_programada = '".$_POST['valor']."'
WHERE id = '".$_POST['id']."' ";
}else if($_POST['cate'] == 7){
$sql = "UPDATE sgm_plan_auditoria
SET sitio = '".$_POST['valor']."'
WHERE id = '".$_POST['id']."' ";
}else if($_POST['cate'] == 8){
$sql = "UPDATE sgm_plan_auditoria
SET metodo_auditoria = '".$_POST['valor']."'
WHERE id = '".$_POST['id']."' ";
}else if($_POST['cate'] == 9){
$sql = "UPDATE sgm_plan_auditoria
SET ajuste_plan = '".$_POST['valor']."'
WHERE id = '".$_POST['id']."' ";
}else if($_POST['cate'] == 10){
$sql = "UPDATE sgm_plan_auditoria
SET asignacion_recursos = '".$_POST['valor']."'
WHERE id = '".$_POST['id']."' ";
}else if($_POST['cate'] == 11){
$sql = "UPDATE sgm_plan_auditoria
SET preparativos_logisticos = '".$_POST['valor']."'
WHERE id = '".$_POST['id']."' ";
}else if($_POST['cate'] == 12){
$sql = "UPDATE sgm_plan_auditoria
SET acciones = '".$_POST['valor']."'
WHERE id = '".$_POST['id']."' ";
}else if($_POST['cate'] == 13){

$sql = "INSERT INTO sgm_plan_auditoria_responsable (
id_plan, id_responsable
)
VALUES (
'".$_POST['id']."',
'".$_POST['valor']."'
)";

}else if($_POST['cate'] == 14){

$sql = "DELETE FROM sgm_plan_auditoria_responsable WHERE id = '".$_POST['id']."'  ";

}else if($_POST['cate'] == 15){

$sql = "DELETE FROM sgm_plan_auditoria_agenda WHERE id = '".$_POST['id']."'  ";

}else if($_POST['cate'] == 16){

$sql = "DELETE FROM sgm_plan_auditoria_auditor WHERE id = '".$_POST['id']."'  ";

}


mysqli_query($con, $sql);
//------------------
mysqli_close($con);
//------------------