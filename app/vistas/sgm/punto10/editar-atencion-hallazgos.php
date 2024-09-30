<?php
require('../../../../app/help.php');

if($_POST['cate'] == 1){
$sql = "UPDATE sgm_plan_atencion_hallazgos
SET fecha = '".$_POST['valor']."'
WHERE id = '".$_POST['id']."' ";
}else if($_POST['cate'] == 2){
$sql = "UPDATE sgm_plan_atencion_hallazgos
SET sitio_area = '".$_POST['valor']."'
WHERE id = '".$_POST['id']."' ";
}else if($_POST['cate'] == 3){
$sql = "UPDATE sgm_plan_atencion_hallazgos
SET responsable = '".$_POST['valor']."'
WHERE id = '".$_POST['id']."' ";
}else if($_POST['cate'] == 4){
$sql = "UPDATE sgm_plan_atencion_hallazgos
SET hallazgo = '".$_POST['valor']."'
WHERE id = '".$_POST['id']."' ";
}else if($_POST['cate'] == 5){
$sql = "UPDATE sgm_plan_atencion_hallazgos
SET analisis_causa = '".$_POST['valor']."'
WHERE id = '".$_POST['id']."' ";
}else if($_POST['cate'] == 6){
$sql = "UPDATE sgm_plan_atencion_hallazgos
SET acciones_hallazgos = '".$_POST['valor']."'
WHERE id = '".$_POST['id']."' ";
}else if($_POST['cate'] == 7){
$sql = "UPDATE sgm_plan_atencion_hallazgos
SET fecha_complimiento = '".$_POST['valor']."'
WHERE id = '".$_POST['id']."' ";
}else if($_POST['cate'] == 8){
$sql = "UPDATE sgm_plan_atencion_hallazgos
SET recursos_implementacion = '".$_POST['valor']."'
WHERE id = '".$_POST['id']."' ";
}else if($_POST['cate'] == 9){
$sql = "UPDATE sgm_plan_atencion_hallazgos
SET fecha_atencion_hallazgos = '".$_POST['valor']."'
WHERE id = '".$_POST['id']."' ";
}else if($_POST['cate'] == 10){
$sql = "UPDATE sgm_plan_atencion_hallazgos
SET responsable_sgm = '".$_POST['valor']."'
WHERE id = '".$_POST['id']."' ";
}else if($_POST['cate'] == 11){

$sql = "INSERT INTO sgm_plan_atencion_hallazgos_responsables (
id_plan, id_responsable
)
VALUES (
'".$_POST['id']."',
'".$_POST['valor']."'
)";

}else if($_POST['cate'] == 12){

$sql = "DELETE FROM sgm_plan_atencion_hallazgos_responsables WHERE id = '".$_POST['id']."'  ";

}


mysqli_query($con, $sql);
//------------------
mysqli_close($con);
//------------------