<?php
require('../../../app/help.php');


if ($_POST['dato'] == 1) {

$sql = "UPDATE tb_requisicion_obra_formato_12 SET
municipio = '".$_POST['valor']."'
WHERE id = '".$_POST['id']."' ";
mysqli_query($con, $sql);

}else if ($_POST['dato'] == 2) {

$sql = "UPDATE tb_requisicion_obra_formato_12 SET
estado = '".$_POST['valor']."'
WHERE id = '".$_POST['id']."' ";
mysqli_query($con, $sql);

}else if ($_POST['dato'] == 3) {

$sql = "UPDATE tb_requisicion_obra_formato_12 SET
dia = '".$_POST['valor']."'
WHERE id = '".$_POST['id']."' ";
mysqli_query($con, $sql);

}else if ($_POST['dato'] == 4) {

$sql = "UPDATE tb_requisicion_obra_formato_12 SET
mes = '".$_POST['valor']."'
WHERE id = '".$_POST['id']."' ";
mysqli_query($con, $sql);

}else if ($_POST['dato'] == 5) {

$sql = "UPDATE tb_requisicion_obra_formato_12 SET
year = '".$_POST['valor']."'
WHERE id = '".$_POST['id']."' ";
mysqli_query($con, $sql);

}else if ($_POST['dato'] == 6) {

$sql = "UPDATE tb_requisicion_obra_formato_12 SET
trabajo_realizar = '".$_POST['valor']."'
WHERE id = '".$_POST['id']."' ";
mysqli_query($con, $sql);

}else if ($_POST['dato'] == 7) {

$sql = "UPDATE tb_requisicion_obra_formato_12 SET
descripcion = '".$_POST['valor']."'
WHERE id = '".$_POST['id']."' ";
mysqli_query($con, $sql);

}else if ($_POST['dato'] == 8) {

$sql = "UPDATE tb_requisicion_obra_formato_12 SET
area = '".$_POST['valor']."'
WHERE id = '".$_POST['id']."' ";
mysqli_query($con, $sql);

}else if ($_POST['dato'] == 9) {

$sql = "UPDATE tb_requisicion_obra_formato_12 SET
fecha_inicio = '".$_POST['valor']."'
WHERE id = '".$_POST['id']."' ";
mysqli_query($con, $sql);

}else if ($_POST['dato'] == 10) {

$sql = "UPDATE tb_requisicion_obra_formato_12 SET
fecha_termino = '".$_POST['valor']."'
WHERE id = '".$_POST['id']."' ";
mysqli_query($con, $sql);

}else if ($_POST['dato'] == 11) {

$sql = "UPDATE tb_requisicion_obra_formato_12 SET
hora_inicio = '".$_POST['valor']."'
WHERE id = '".$_POST['id']."' ";
mysqli_query($con, $sql);

}else if ($_POST['dato'] == 12) {

$sql = "UPDATE tb_requisicion_obra_formato_12 SET
hora_termino = '".$_POST['valor']."'
WHERE id = '".$_POST['id']."' ";
mysqli_query($con, $sql);

}else if ($_POST['dato'] == 13) {

$sql = "UPDATE tb_requisicion_obra_formato_12 SET
prestador_servicio = '".$_POST['valor']."'
WHERE id = '".$_POST['id']."' ";
mysqli_query($con, $sql);

}else if ($_POST['dato'] == 14) {

$sql = "UPDATE tb_requisicion_obra_formato_12_procedimiento SET
valor = '".$_POST['valor']."'
WHERE id = '".$_POST['id']."' ";
mysqli_query($con, $sql);

}else if ($_POST['dato'] == 15) {

$sql = "UPDATE tb_requisicion_obra_formato_12 SET
cprtp = '".$_POST['valor']."'
WHERE id = '".$_POST['id']."' ";
mysqli_query($con, $sql);

}else if ($_POST['dato'] == 16) {

$sql = "UPDATE tb_requisicion_obra_formato_12 SET
cteppc = '".$_POST['valor']."'
WHERE id = '".$_POST['id']."' ";
mysqli_query($con, $sql);

}else if ($_POST['dato'] == 17) {

$sql_insert = "INSERT INTO tb_requisicion_obra_formato_12_trabajador_encargado (
id_requisicion,
id_personal,
nombre,
puesto,
no_seguro,
categoria
)
VALUES (
'".$_POST['id']."',
'".$_POST['valor']."',

'".$_POST['NombreT']."',
'".$_POST['PuestoT']."',
'".$_POST['NoSeguroT']."',

'".$_POST['categoria']."'
)";

mysqli_query($con, $sql_insert);

}else if ($_POST['dato'] == 18) {

$sql = "UPDATE tb_requisicion_obra_formato_12 SET
nombre_empresa = '".$_POST['valor']."'
WHERE id = '".$_POST['id']."' ";
mysqli_query($con, $sql);

}else if ($_POST['dato'] == 19) {

$sql = "UPDATE tb_requisicion_obra_formato_12 SET
nombre_responsable = '".$_POST['valor']."'
WHERE id = '".$_POST['id']."' ";
mysqli_query($con, $sql);

}else if ($_POST['dato'] == 20) {

$sql1 = "DELETE FROM tb_requisicion_obra_formato_12_trabajador_encargado WHERE id = '".$_POST['id']."' ";
mysqli_query($con, $sql1);

}




//------------------
mysqli_close($con);
//------------------