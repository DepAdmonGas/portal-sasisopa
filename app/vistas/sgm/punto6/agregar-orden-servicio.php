<?php
require('../../../../app/help.php');

$sql = "SELECT
sgm_autorizado.id_usuario,
sgm_autorizado.estado,
tb_usuarios.id_gas
FROM sgm_autorizado 
INNER JOIN tb_usuarios 
ON sgm_autorizado.id_usuario = tb_usuarios.id WHERE tb_usuarios.id_gas = '".$Session_IDEstacion."' AND sgm_autorizado.estado = 1 LIMIT 1";
$result = mysqli_query($con, $sql);
$numero = mysqli_num_rows($result);
if ($numero > 0) {
$row = mysqli_fetch_array($result, MYSQLI_ASSOC);
$realizadopor = $row['id_usuario'];
}else{
$realizadopor = 0;
}

function folio($id_estacion,$con){
$sql_folio = "SELECT no_folio FROM tb_requisicion_obra WHERE id_estacion = '".$id_estacion."' ORDER BY no_folio desc LIMIT 1 ";
$result_folio = mysqli_query($con, $sql_folio);
$numero_folio = mysqli_num_rows($result_folio);
if ($numero_folio == 0) {
$NumFolio = 1;
}else{
while($row_folio = mysqli_fetch_array($result_folio, MYSQLI_ASSOC)){
$folio = $row_folio['no_folio'] + 1;
$NumFolio = $folio;
}
}
return $NumFolio;
}

if($_POST['idRegistro'] == 0){

	$NumFolio = folio($Session_IDEstacion,$con);

$sql = "INSERT INTO sgm_orden_servicio (
id_estacion,fecha,hora,id_solicitante,descripcion,justificacion,realizadopor,folio
)
VALUES (
'".$Session_IDEstacion."',
'".$fecha_del_dia."',
'".$hora_del_dia."',
'".$Session_IDUsuarioBD."',
'".$_POST['descripcion']."',
'".$_POST['justificacion']."',
'".$realizadopor."',
'".$NumFolio."'
)";

if(mysqli_query($con, $sql)){

$sql_insert1 = "INSERT INTO tb_requisicion_obra (id_estacion,id_usuario,no_folio,fecha,descripcion,justificacion,estado)
VALUES (
'".$Session_IDEstacion."',
'".$Session_IDUsuarioBD."',
'".$NumFolio."',
'".$fecha_del_dia." ".$hora_del_dia."',
'".$_POST['descripcion']."',
'".$_POST['justificacion']."',
1)";
mysqli_query($con, $sql_insert1);

echo 1;
}else{
echo 0;
}

}else{

$sql = "UPDATE sgm_orden_servicio
SET descripcion = '".$_POST['descripcion']."', justificacion = '".$_POST['justificacion']."'
WHERE id = '".$_POST['idRegistro']."' ";

if(mysqli_query($con, $sql)){

$sql1 = "UPDATE tb_requisicion_obra
SET descripcion = '".$_POST['descripcion']."', justificacion = '".$_POST['justificacion']."'
WHERE no_folio = '".$_POST['folio']."' AND id_estacion = '".$Session_IDEstacion."' ";
mysqli_query($con, $sql1);

echo 1;
}else{
echo 0;
}	

}




//-----------------
mysqli_close($con);
//-----------------