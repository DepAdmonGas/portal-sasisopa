<?php
require('../../../../app/help.php');

if($_POST['cate'] == 1){
$sql = "UPDATE sgm_hallazgo_auditoria
SET fecha = '".$_POST['valor']."'
WHERE id = '".$_POST['id']."' ";
}else if($_POST['cate'] == 2){
$sql = "UPDATE sgm_hallazgo_auditoria
SET fecha_ubicacion = '".$_POST['valor']."'
WHERE id = '".$_POST['id']."' ";
}else if($_POST['cate'] == 3){
$sql = "UPDATE sgm_hallazgo_auditoria
SET objetivo_auditoria = '".$_POST['valor']."'
WHERE id = '".$_POST['id']."' ";
}else if($_POST['cate'] == 4){
$sql = "UPDATE sgm_hallazgo_auditoria
SET alcance_auditoria = '".$_POST['valor']."'
WHERE id = '".$_POST['id']."' ";
}else if($_POST['cate'] == 5){
$sql = "UPDATE sgm_hallazgo_auditoria
SET comentarios = '".$_POST['valor']."'
WHERE id = '".$_POST['id']."' ";
}else if($_POST['cate'] == 6){
$sql = "UPDATE sgm_hallazgo_auditoria
SET nota = '".$_POST['valor']."'
WHERE id = '".$_POST['id']."' ";
}else if($_POST['cate'] == 7){
$sql = "UPDATE sgm_hallazgo_auditoria
SET motivos = '".$_POST['valor']."'
WHERE id = '".$_POST['id']."' ";
}else if($_POST['cate'] == 8){
$sql = "UPDATE sgm_hallazgo_auditoria
SET conclusiones = '".$_POST['valor']."'
WHERE id = '".$_POST['id']."' ";
}else if($_POST['cate'] == 9){
$sql = "UPDATE sgm_hallazgo_auditoria
SET lugar_fecha = '".$_POST['valor']."'
WHERE id = '".$_POST['id']."' ";
}else if($_POST['cate'] == 10){
$sql = "UPDATE sgm_hallazgo_auditoria
SET auditor_lider = '".$_POST['valor']."'
WHERE id = '".$_POST['id']."' ";
}else if($_POST['cate'] == 11){
$sql = "UPDATE sgm_hallazgo_auditoria
SET responsable_sgm = '".$_POST['valor']."'
WHERE id = '".$_POST['id']."' ";
}else if($_POST['cate'] == 12){

$sql = "INSERT INTO sgm_hallazgo_auditoria_responsable (
id_hallazgo, id_responsable
)
VALUES (
'".$_POST['id']."',
'".$_POST['valor']."'
)";

}else if($_POST['cate'] == 13){

$sql = "DELETE FROM sgm_hallazgo_auditoria_responsable WHERE id = '".$_POST['id']."'  ";	

}else if($_POST['cate'] == 14){

$sql = "DELETE FROM sgm_hallazgo_auditoria_entrevistador WHERE id = '".$_POST['id']."'  ";	

}else if($_POST['cate'] == 15){

$sql = "DELETE FROM sgm_hallazgo_auditoria_auditor WHERE id = '".$_POST['id']."'  ";	

}else if($_POST['cate'] == 16){
$sql = "UPDATE sgm_hallazgo_auditoria_resultado
SET resultado = '".$_POST['valor']."'
WHERE id = '".$_POST['id']."' ";
}else if($_POST['cate'] == 17){

$sql = "DELETE FROM sgm_hallazgo_auditoria_conformes WHERE id = '".$_POST['id']."'  ";	

}else if($_POST['cate'] == 18){

$sql = "DELETE FROM sgm_hallazgo_auditoria_mejora WHERE id = '".$_POST['id']."'  ";	

}


mysqli_query($con, $sql);
//------------------
mysqli_close($con);
//------------------