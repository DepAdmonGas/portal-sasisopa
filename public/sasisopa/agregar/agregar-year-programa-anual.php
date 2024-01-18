<?php
require('../../../app/help.php');
$year = date("Y");

$sql_programa = "SELECT * FROM po_programa_anual_mantenimiento WHERE id_estacion = '".$_POST['idestacion']."' AND year = '".$_POST['fecha']."'";
$result_programa = mysqli_query($con, $sql_programa);
$numero_programa = mysqli_num_rows($result_programa);

if ($numero_programa > 0) {
while($row_programa = mysqli_fetch_array($result_programa, MYSQLI_ASSOC)){
$idreporte = $row_programa['id'];
}
}else{

$sql_id = "SELECT id FROM po_programa_anual_mantenimiento ORDER BY id desc limit 1";
$result_id = mysqli_query($con, $sql_id);
$numero_id = mysqli_num_rows($result_id);
if ($numero_id > 0) {
while($row_id = mysqli_fetch_array($result_id, MYSQLI_ASSOC)){
$id = $row_id['id'] + 1;
}
}else{
$id = 1;
}

$idreporte = $id;

$sql_insert = "INSERT INTO po_programa_anual_mantenimiento (id, id_estacion,year,estado)
VALUES (
'".$idreporte."','".$_POST['idestacion']."','".$_POST['fecha']."',0)";
mysqli_query($con, $sql_insert);

}
echo $idreporte;

//------------------
mysqli_close($con);
//------------------
